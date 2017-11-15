<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Comment;
use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
  }

  public function list(Request $request)
  {
    // Get logged user
    $user = User::find(Auth::user()->id);
    $data = $request->all();

    return response()->json([
      'ok' => 'true'
    ]);
  }
}
