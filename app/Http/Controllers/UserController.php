<?php

namespace App\Http\Controllers;


use App\FavouriteContact;
use App\Project;
use App\Skill;
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
        $skills =Skill::where('user_id',Auth::id())->get();
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

    public function search(Request $request){

        if ($request->has('id')) {
            return User::where('id',$request->get('id'))->get();
        }

        if ($request->has('name')) {
            return User::where('name', 'like','%'. $request->get('name') .'%')->get();
        }

    }

    public function getUserById($id){
        return User::where('id',$id);
    }

    public function getContacts(){
        $userID = Auth::id();


        $user = Auth::user();
        return $user->favouriteContacts;

        //todo join query
        $contacts = User::join('favourite_contacts', 'users.id', '=','favourite_contacts.contact_id')
            ->where('favourite_contacts.user_id', Auth::id());


            //for friend request type

//            ->where(function ($query) use($userID) {
//                $query->where('favourite_contacts.user_id', $userID)
//                    ->orWhere('favourite_contacts.contact_id', $userID);
//            })



    }

    public function getProjects(){
        $projects= Project::where('user_id',Auth::id())->get();
        return $projects;

    }

    public function setProjects(Request $request){
        $projects= new Project();
        $projects->project=$request->get('project');
        $projects->user_id=Auth::id();
        $projects->save();

        return $projects;

    }

    public function setSkills(Request $request){
        $skills= new Skill();
        $skills->skill=$request->get('skill');
        $skills->user_id=Auth::id();
        $skills->save();

        return $skills;

    }

}
