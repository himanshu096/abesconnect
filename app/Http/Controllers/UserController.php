<?php

namespace App\Http\Controllers;



use App\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{

    public function store(Request $request) {


        $user = new User($request->all());
        $user->password = $request->get('password');
        $user->save();

        $verifyData = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $token=JWTAuth::fromUser($user);
        return compact('token','user') ;
    }


    public function getUser(){
        $user = Auth::user();
        return $user;

    }

    public function update(Request $request) {
        $user = Auth::user();



        if ($request->has('name')) {
            $user->name = $request->get('name');
        }

        if ($request->has('email')) {
            $user->email = $request->get('email');
        }

        $user->save();

        return $user;
    }

}
