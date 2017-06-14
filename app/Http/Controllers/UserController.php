<?php

namespace App\Http\Controllers;


use App\Skills;
use App\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{

    public function store(Request $request)
    {


        $user = new User($request->all());
        $user->password = $request->get('password');
        $user->save();

        $verifyData = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $token = JWTAuth::fromUser($user);
        return compact('token', 'user');
    }


    public function getUser()
    {
        $user = Auth::user();
        $skills=$this->getSkills();
        return compact('user','skills');

    }

    public function getSkills()
    {
        $skills =Skills::where('user_id',Auth::id())->get();
        return $skills;
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($request->has('name')) {
            $user->name = $request->get('name');
        }
        if ($request->has('email')) {
            $user->email = $request->get('email');
        }
        if ($request->has('school')) {
            $user->school = $request->get('school');
        }
        if ($request->has('phone_no')) {
            $user->phone_no = $request->get('phone_no');
        }
        if ($request->has('facebook_id')) {
            $user->facebook_id = $request->get('facebook_id');
        }
        if ($request->has('linkedin_id')) {
            $user->linkedin_id = $request->get('linkedin_id');
        }
        if ($request->has('availability')) {
            $user->availability = $request->get('availability');
        }
        if ($request->has('position')) {
            $user->position = $request->get('position');
        }
        if ($request->has('batch')) {
            $user->batch = $request->get('batch');
        }
        if ($request->has('image_url')) {
            $user->image_url = $request->get('image_url');
        }
        if ($request->has('gender')) {
            $user->gender = $request->get('gender');
        }

        $user->save();
        return $user;
    }

}
