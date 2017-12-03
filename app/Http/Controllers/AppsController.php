<?php

namespace App\Http\Controllers;

use App\Apps;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function single($id) {
        // Get the apps
        $app = Apps::with(['params'])->find($id);

        // Get logged user
        $user = User::find(Auth::user()->id);

        return response()->json([
            'ok'   => 'true',
            'app'  => $app,
            'user' => $user->makeVisible('password')
        ]);
    }

    public function redirect($id)
    {
        $url      = 'http://192.168.5.24/internalAPI/public/oauth/access_token';
        $client   = new \GuzzleHttp\Client();
        $response = null;

        try {
            $response = $client->request('POST', $url, [
                'timeout'     => 10,
                'http_errors' => false,
                'form_params' => [
                    'grant_type'    => 'client_credentials',
                    'client_id'     => 'api-hris',
                    'client_secret' => 'b7c53e8d93d208c408222f68db4cf2eda50a337b',
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return response('Application Timeout', 504);            
        }

        $result = json_decode($response->getBody());
        $token  = $result->access_token;
        if (!$token) abort(403, 'Unauthorized action.');

        return view('redirect', [
            'token'  => $token,
            'appsID' => $id
        ]);
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
    public function show2($id)
    {
        $apps = Apps::where('id',$id)->get();
        if(!$apps) return response('Invalid Request', 500);

        return response()->json([
            'ok'       => true,
            'apps' => $apps
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

    public function updApp(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $existing = Apps::find($id);

        $path = $request->file('icon_url')->store('icon-apps');   
        
        $existing->update(array(
            'url'           => $data['url'],
            'name'          => $data['name'],
            'description'   => $data['description'],
            'shown'         => $data['shown'],
            'icon_url'      => "/" . $path
        ));
     
        return redirect()->action('AppsController@index');
    }
}
