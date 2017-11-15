<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Activity;
use Westsworld\TimeAgo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $before)
    {
        // Get logged user
        $user = User::find(Auth::user()->id);
        $timeAgo = new TimeAgo();
        
        $posts = Post::with([
                'user',
                'comments', 'comments.user',
                'likes' => function ($q) { $q->where('liked', true); }
            ])
            ->withCount('comments')
            ->when($before == -1, function($query){
                return $query->orderBy('comments_count', 'desc');
            })
            ->orderBy('id', 'desc')
            ->where(function ($query) use ($user){
                $query->where('destination', 'normal')
                ->orWhere(function ($query) use ($user) {
                    $query->where('destination', 'wall')
                        ->where('wall_id', '=', $user->id);
                });
            })
            ->when($before > 0, function($query) use ($before){
                return $query->where('id', '<', $before);
            })
            ->when($before == -1, function($query){
                return $query->take(10);
            })
            ->when($before > -1, function($query){
                return $query->take(5);
            })
            ->get();

        $results = array_map(function($p) use ($timeAgo) {
            $p['timeago'] = $timeAgo->inWords($p['created_at']);
            return $p;
        }, $posts->toArray());
        
        $lastPostID = 0;
        
        if($before > -1 && count($results) > 0) {
            $lastPostID = $results[count($results) - 1]['id'];
        }

        return response()->json([
            'ok' => 'true',
            'posts' => $results,
            'lastPostID' => $lastPostID,
            'requester' => Auth::user()->id
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function timeline($tID, $before)
    {
        // Get logged user
        $tUser = User::find($tID);
        $timeAgo = new TimeAgo();
        
        $posts = Post::with([
                'user',
                'comments', 'comments.user',
                'likes' => function ($q) { $q->where('liked', true); }
            ])
            ->orderBy('id', 'desc')
            ->where(function ($query) use ($tUser){
                $query->where('destination', 'normal')
                ->where('user_id', $tUser->id)
                ->orWhere(function ($query) use ($tUser) {
                    $query->where('destination', 'wall')
                        ->where('wall_id', '=', $tUser->id);
                });
            })
            ->when($before > 0, function($query) use ($before){
                return $query->where('id', '<', $before);
            })
            ->take(5)
            ->get();

        $results = array_map(function($p) use ($timeAgo) {
            $p['timeago'] = $timeAgo->inWords($p['created_at']);
            return $p;
        }, $posts->toArray());

        $lastPostID = 0;
        if(count($results) > 0) {
            $lastPostID = $results[count($results) - 1]['id'];
        }

        return response()->json([
            'ok' => 'true',
            'posts' => $results,
            'lastPostID' => $lastPostID,
            'requester' => Auth::user()->id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get logged user
        $user = User::find(Auth::user()->id);
        
        $data = $request->all();
        $post = new Post([
            'type' => $data['type'],
            'content' => $data['content'],
            'destination' => $data['destination'],
            'wall_id' => $data['wallid'] ?? null,
            'src' => $data['src'] ?? null
        ]);

        DB::transaction(function () use ($user, $post) {
            $userPost = $user->posts()->save($post);

            $activity = new Activity([
                'type' => 'posted',
                'post_id' => $userPost->id
            ]);
            $user->activities()->save($activity);
        });

        return response()->json([
            'ok' => 'true'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function media(Request $request)
    {
        $directory = 'post-images';

        $file = $request->file('file');
        $mime = \File::mimeType($file);

        $type = explode("/", $mime)[0];
        if($type == 'video') {
            $directory = 'post-videos';
        }

        $path = $file->store($directory);

        if($path) {
            return response()->json([
                'ok' => true,
                'src' => "/" . $path
            ]);
        } else {
            return response()->json([
                'ok' => false
            ]);
        }
    }

    protected function validator(array $data, $mime)
    {
        if($mime == 'image') {
            return Validator::make($data, [
                'file' => 'required|image|mimes:jpeg,png,jpg|max:5120'
            ]);
        } else {
            return Validator::make($data, [
                'file' => 'required|mimes:mp4,m3u8,ts,3gp,mov,avi,wmv|max:20971520'
            ]);
        }
    }
}
