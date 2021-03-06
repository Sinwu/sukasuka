<?php

namespace App\Http\Controllers;

use App\AppParams;
use Illuminate\Http\Request;

class AppParamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $id = AppParams::insertGetId(array(
            'apps_id'    => $data['apps_id'],
            'type'       => $data['type'],
            'name'       => $data['name'],
            'value'      => $data['value']
        ));

        return response()->json([
            'ok'    =>  'true',
            'data'  =>  $data,
            'id'    =>  $id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
        $params = AppParams::where('apps_id',$id)->get();
        if(!$params) return response('Invalid Request', 500);

        return response()->json([
            'ok'       => true,
            'params' => $params
        ]);
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
        
    }

    public function delete(Request $request)
    {
        $data = $request->all();

        $id  = $data['id'];

        $existing = AppParams::find($id);
        if(!$existing) return response('Invalid Request', 500);

        // Delete
        $ok = $existing->delete();

        return response()->json([
            'ok' => $ok
        ]);
    }
}
