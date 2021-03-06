<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        //
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
    public function update(Request $request)
    {
        // Get logged user
        $user = User::find(Auth::user()->id);

        $data = $request->all();

        if(isset($data['name'])) $user->name = $data['name'];
        // if(array_key_exists('sso_id', $data)) $user->sso_id = $data['sso_id'];
        if(isset($data['gender'])) $user->gender = $data['gender'];
        if(isset($data['birthday'])) $user->birthday = $data['birthday'];
        if(array_key_exists('about', $data)) $user->about = $data['about'];
        if(isset($data['src'])) $user->src = $data['src'];

        $user->save();

        return response()->json([
            'ok' => 'true'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();
        $valid = Validator::make($data, [
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string|min:6|confirmed',
        ])->validate();

        // Get logged user
        $user = User::find(Auth::user()->id)->makeVisible('password');
        $check = Hash::check($data['oldPassword'], $user->password);
        if (!$check) abort(403, 'Unauthorized action.');

        $user->password = bcrypt($data['newPassword']);

        $user->save();

        return response()->json([
            'ok' => true,
        ]);
    }

    public function photo(Request $request)
    {
        $file = $request->file('file');
        $path = $file->store('profile-images');

        if($path) {
            return response()->json([
                'ok' => true,
                'src' => "/" . $path
            ]);
        } else {
            return response()->json([
                'ok' => false
            ]);
        }
    }

    public function profile($id)
    {
        // Validate email before processing
        $user = User::find($id);
        if (!$user) abort(403, 'Unauthorized action.');
        $email = $user->email;

        if(!preg_match('/(.+)@edi-indonesia.co.id/', $email, $matches)) {
            return response()->json([
                'ok'      => false,
                'email'   => $email
            ]);
        }

        $url = 'http://192.168.5.24/internalAPI/public/oauth/access_token';

        $client   = new \GuzzleHttp\Client();
        $response = $client->request('POST', $url, [
            'timeout'     => 10,
            'form_params' => [
                'grant_type'    => 'client_credentials',
                'client_id'     => 'api-hris',
                'client_secret' => 'b7c53e8d93d208c408222f68db4cf2eda50a337b',
            ]
        ]);

        $result = json_decode($response->getBody());
        $token  = $result->access_token;
        if (!$token) abort(403, 'Unauthorized action.');

        $config  = [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ]
        ];
        $urlP      = 'http://192.168.5.24/internalAPI/public/api1/getProfilEmployee';
        $clientP   = new \GuzzleHttp\Client($config);
        $responseP = $clientP->request('POST', $urlP, [
            'timeout'     => 10,
            'form_params' => [
                'email'    => $matches[1]
            ]
        ]);

        $resultP = json_decode($responseP->getBody());

        return response()->json([
            'ok'      => true,
            'profile' => $resultP
        ]);
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

    public function editpassword()
    {
        return view('editpassword');
    }

    public function editbasic()
    {
        return view('editbasic');
    }

    public function modShUser()
    {
        $users = User::where('email','!=','admin.ediish@edi-indonesia.co.id')->get();
        //dd($users);
        return view('mod.shuser',['users' => $users]);
    }

    public function updateActive(Request $request)
    {
        $data = $request->all();
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

        $user = User::where('id',$id)->first();
        $user->active = $next;
        $user->save();

        return response()->json([
            'ok' => 'true',
            'id' => $id,
            'currState' => $curr,
            'nextState' => $next,
            'userdata' => $user
        ]);
    }

    public function updateAdmin(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $admin = $data['admin'];

        $user = User::where('id',$id)->first();
        $user->admin = $admin;
        $user->save();

        return response()->json([
            'ok' => 'true',
            'id' => $id,
        ]);
    }
}
