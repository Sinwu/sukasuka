<?php

namespace App\Http\Controllers;

use App\Notification;
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

  public function part(Request $request)
  {
    $limit = $request->query('limit', 5);

    $notifications = Notification::with(['actor', 'owner', 'post'])
    ->where('owner_id', Auth::user()->id)
    ->take($limit)
    ->get();

    return response()->json([
      'ok' => 'true',
      'notifications' => $notifications
    ]);
  }
}
