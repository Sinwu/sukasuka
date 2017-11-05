<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Activity;
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
    public function index($before)
    {
        // Get logged user
        $user = User::find(Auth::user()->id);
        
        $posts = Post::with('user')
            ->orderBy('created_at', 'desc')
            ->where('destination', 'normal')
            ->when($before > 0, function($query) use ($before){
                return $query->where('id', '<', $before);
            })
            ->take(5)
            ->get();
        \Log::info($posts);

        return response()->json([
            'ok' => 'true',
            'posts' => $posts
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
}
