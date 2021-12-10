<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function user() {
        return auth()->user();
    }

    public function login(UserRequest $request) {
        $validated = $request->validated();
        if (! Auth::attempt($validated)){
            return response()->json(["message"=>"Invalid user data"], 403);
        }

        $access_token = auth()->user()->createToken("login")->accessToken;
        return response()->json(['user'=>Auth::user(), 'access_token'=>$access_token]);
    }

    public function logout(){
        $user = auth()->user()->token()->revoke();
        return response()->json(["message"=>"Logged out"]);
    }
}
