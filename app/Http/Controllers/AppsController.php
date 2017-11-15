<?php

namespace App\Http\Controllers;

use App\Apps;
use Illuminate\Http\Request;

class AppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apps = Apps::all();
        
        return view('mod.shapi',['apps' => $apps]);
    }

    public function all()
    {
        $apps = Apps::all();
        
        return response()->json([
            'ok' => 'true',
            'apps' => $apps
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
        $data = $request->all();
        $path = $request->file('icon_url')->store('icon-apps');

        Apps::create(array(
            'url'           => $data['url'],
            'name'          => $data['name'],
            'description'   => $data['description'],
            'shown'         => $data['shown'],
            'icon_url'      => "/" . $path
        ));

        return redirect()->action('AppsController@index');
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

    public function delete(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $app = Apps::where('id',$data['id'])->first();

        $app->delete();

        return redirect()->action('AppsController@index');        
    }

    public function updShown(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $id = $data['id'];
        $curr = $data['state'];

        switch($curr){
            case 1:
                $next = 0;
                break;
            case 0:
                $next = 1;
                break;
            default:
                "Unknown current state, can't update active state.";
        }

        $app = Apps::where('id',$id)->first();
        $app->shown = $next;
        $app->save();

        return redirect()->action('AppsController@index');  
    }
}
