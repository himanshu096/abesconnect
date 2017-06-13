<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if ( ! $token = JWTAuth::attempt($credentials)) {
                throw new HttpException(422, 'invalid token');
            }
        } catch (JWTException $e) {
            throw new HttpException(422, 'invalid token');
        }

        $user = User::where('email', $request->get('email'))->first();

//        $userTransformer = new UserTransformer();
//        $user = $userTransformer->transform($user);

        return compact('token', 'user');
    }
}
