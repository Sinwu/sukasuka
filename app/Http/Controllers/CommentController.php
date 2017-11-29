<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Comment;
use App\Activity;
use App\Notification;
use Westsworld\TimeAgo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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

    DB::transaction(function () use ($user, &$data) {
      $postID = $data['post'];
      $post = Post::find($postID);

      // Commenting
      $comment = new Comment([
        'user_id' => $user->id,
        'content' => $data['content']
      ]);
      $postComment = $post->comments()->save($comment);

      $timeAgo = new TimeAgo();
      $data['timeago'] = $timeAgo->inWords($postComment->created_at);

      // Creating commented activity
      $activity = new Activity([
        'type' => 'commented',
        'comment_id' => $postComment->id,
        'post_id' => $postID
      ]);
      $user->activities()->save($activity);

      // Creating commented activity
      if($post->user_id != $user->id) {
        Notification::create([
          'owner_id' => $post->user_id,
          'actor_id' => $user->id,
          'post_id'  => $postID,
          'action'   => 'commented',
          'read'     => false
        ]);
      }
    });

    return response()->json([
      'ok' => 'true',
      'user' => $user,
      'content' => $data['content'],
      'timeago' => $data['timeago']
    ]);
  }
}
