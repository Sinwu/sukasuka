<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
use Westsworld\TimeAgo;
use Illuminate\Http\Request;

class AboutController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tID)
    {
        $UUIDv4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
        if(!preg_match($UUIDv4, $tID)) abort(404);

        $tUser = User::find($tID);
        if(!$tUser) abort(404);
        $tUser->birthday = date('d - m - Y', strtotime($tUser->birthday));

        $tUserActivityResults = Activity::where('user_id', $tUser->id)
        ->orderBy('id', 'desc')
        ->take(5)
        ->get();

        $timeAgo = new TimeAgo();
        $tUserActivities = array_map(function($a) use ($timeAgo) {
            $a['timeago'] = $timeAgo->inWords($a['created_at']);
            if($a['type'] == 'commented') {
                $a['target'] = 'on a post';
            } else {
                $a['target'] = 'a post';
            }
            return $a;
        }, $tUserActivityResults->toArray());

        return view('about', ['tUser' => $tUser, 'tUserActivities' => $tUserActivities]);
    }
}
