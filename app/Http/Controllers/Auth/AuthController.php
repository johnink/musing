<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Widget;
use App\Tag;
use Validator;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $redirectPath = '/';
    protected $loginPath = '/user/login';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:15',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    protected function create(array $data)
    {
        //collect the users tags

        $tags=Config::get('constants.TAGS');
        $userTags=[];
        foreach($tags as $tag){
            if(isset($data[$tag[0]])){
                $tagId=IntVal(Tag::where('name',$tag[0])->pluck('id'));
                array_push($userTags,$tagId);
            }
        }

        //make the new user

        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        //attach the tags
        $newUser->tags()->attach($userTags);

        \Session::flash('success_message','You are now logged in! Thanks for registering.');

        return $newUser;


    }

    
}
