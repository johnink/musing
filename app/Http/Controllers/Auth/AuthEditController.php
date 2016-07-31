<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Tag;
use Validator;
use Config;
use Auth;
use Input;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthEditController extends Controller{

	 /**
     * Edit a users profile
     *
     * @param User current user
     * @return response
     */

    protected function getEdit(){
        return view('auth.edit')->withPage('main');

    }

    protected function postEdit(EditUserRequest $data){


    	if($data->name!=""){Auth::user()->name=$data->name;}
        Auth::user()->avatar=$data->avatar;
        Auth::user()->website=$data->website;
        Auth::user()->save();

        //save user tags
        $tags=Config::get('constants.TAGS');
        $userTags=[];

        foreach($tags as $tag){
            if(Input::has($tag[0])){
                $tagId=IntVal(Tag::where('name',$tag[0])->value('id'));
                array_push($userTags,$tagId);
            }
        }

        Auth::user()->tags()->sync($userTags);

    	\Session::flash('success_message','Changes Saved!');
    	return view('auth.edit')->withPage('main');

    }
        

    protected function getPwEdit(){
        return view('auth.edit')->withPage('pw');

    }

    protected function postPwEdit(EditUserRequest $data){
        if($data->password==$data->password_confirmation&&$data->password!=""){
            Auth::user()->password=bcrypt($data->password);
            Auth::user()->save();
            \Session::flash('success_message','New Password Saved!');
            return view('auth.edit')->withPage('main');

        }elseif($data->password==""){
            \Session::flash('failure_message','Password field is blank');
            return view('auth.edit')->withPage('pw');

        }else{
            \Session::flash('failure_message','New Password and Confirm Password don\'t match');
            return view('auth.edit')->withPage('pw');
        }

    }

    protected function getEmEdit(){
        return view('auth.edit')->withPage('em');

    }

    protected function postEmEdit(EditUserRequest $data){
        if($data->email==$data->confirmEmail&&$data->email!=""){
            Auth::user()->email=$data->email;
            Auth::user()->save();
            \Session::flash('success_message','New Email Saved!');
            return view('auth.edit')->withPage('main');

        }elseif($data->email==""){
            \Session::flash('failure_message','Email field is blank');
            return view('auth.edit')->withPage('em');
        }else{
            \Session::flash('failure_message','New Email and Confirm Email don\'t match');
            return view('auth.edit')->withPage('em');
        }
        

    }

    protected function postAvatar(){

        Auth::user()->avatar=Input::get('avatar');
        Auth::user()->save();
        return null;
        

    }




}