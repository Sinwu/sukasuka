<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TimelineController extends Controller
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

        return view('timeline', ['tUser' => $tUser]);
    }

    public function about()
    {
        return view('about');
    }
}
