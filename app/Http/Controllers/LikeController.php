<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Like;
use App\Activity;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  public function index(Request $request)
  {
    // Get logged user
    $user = User::find(Auth::user()->id);
    $data = $request->all();

    DB::transaction(function () use ($user, $data) {
      $postID = $data['post'];
      $post = Post::find($postID);

      if(!$data['liked']) {
        // Liking
        $like = [
          'user_id' => $user->id
        ];
        $postLike = $post->likes()->updateOrCreate($like, ['liked' => true]);

        // Creating liked activity
        $activity = new Activity([
          'type' => 'liked',
          'like_id' => $postLike->id,
          'post_id' => $postID
        ]);
        $user->activities()->save($activity);

        // Creating commented activity
        if($post->user_id != $user->id) {
          $exists = Notification::where('owner_id', $post->user_id)
          ->where('actor_id', $user->id)
          ->where('post_id', $postID)
          ->where('action', 'liked')
          ->first();

          if(!$exists) {
            Notification::create([
              'owner_id' => $post->user_id,
              'actor_id' => $user->id,
              'post_id'  => $postID,
              'action'   => 'liked',
              'read'     => false
            ]);
          }
        }
      } else {
        // Unliking
        $like = [
          'user_id' => $user->id
        ];
        $postLike = $post->likes()->updateOrCreate($like, ['liked' => false]);
  
        // Creating unliked activity
        $activity = new Activity([
          'type' => 'unliked',
          'like_id' => $postLike->id,
          'post_id' => $postID
        ]);
        $user->activities()->save($activity);
      }
    });

    return response()->json([
      'ok' => 'true',
      'postID' => $data['post'],
      'liked' => !$data['liked']
    ]);
  }
}
