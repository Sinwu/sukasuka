<?php

namespace App\Http\Controllers;

use App\User;
use App\Notification;
use Westsworld\TimeAgo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  public function page(Request $request) {
    return view('notification');
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
    
    $notifications = Notification::with([
      'actor',
      'owner',
      'post'
    ])
    ->where('owner_id', $user->id)
    ->orderBy('id', 'desc')
    ->when($before > 0, function($query) use ($before){
      return $query->where('id', '<', $before);
    })
    ->take(20)
    ->get();

    Notification::with([
      'actor',
      'owner',
      'post'
    ])
    ->where('owner_id', $user->id)
    ->orderBy('id', 'desc')
    ->when($before > 0, function($query) use ($before){
      return $query->where('id', '<', $before);
    })
    ->take(20)
    ->update(['read' => true]);

    $results = array_map(function($n) use ($timeAgo) {
      $n['timeago'] = $timeAgo->inWords($n['created_at']);
      return $n;
    }, $notifications->toArray());
    
    $lastNotificationID = 0;
    
    if($before > -1 && count($results) > 0) {
      $lastNotificationID = $results[count($results) - 1]['id'];
    }

    return response()->json([
      'ok' => 'true',
      'notifications' => $results,
      'lastNotificationID' => $lastNotificationID,
      'requester' => Auth::user()->id
    ]);
  }

  public function part(Request $request)
  {
    $limit = $request->query('limit', 5);

    $notifications = Notification::with(['actor', 'owner', 'post'])
    ->where('owner_id', Auth::user()->id)
    ->take($limit)
    ->get();
    
    $count = Notification::where('owner_id', Auth::user()->id)
    ->where('read', false)
    ->count();

    return response()->json([
      'ok' => 'true',
      'notifications' => $notifications,
      'count' => $count
    ]);
  }

  public function update(Request $request)
  {
    $data = $request->only(['notifs']);

    Notification::whereIn('id', json_decode($data['notifs']))
    ->update(['read' => true]);

    return response()->json([
      'ok' => 'true'
    ]);
  }
}
