<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            //return redirect()->intended('dashboard');
            $user = Auth::user();
            $data['token'] =  $user->createToken('MyApp')->accessToken;
            $data['user'] = auth()->user();
            auth()->user()->UserType;
            return response()->json(['data' => $data, 'code' => $this->successStatus]);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function details()
    {
        $user = Auth::user();
        // $user->token;
        return response()->json(['success' => $user], $this->successStatus);
    }
}
