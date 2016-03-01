<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Widget;
use App\Tag;
use Auth;
use Input;
use Validator;
use Config;
use App\Http\Controllers\Controller;
use Vendor\Google\Recaptcha\Src\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    protected $redirectPath = '/';
    protected $loginPath = '/auth/login';

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
        //recaptcha logic
        $recaptcha = new \ReCaptcha\ReCaptcha(env('RECAPTCHA_KEY'));
        $resp = $recaptcha->verify(Input::get('g-recaptcha-response'));
        if ($resp->isSuccess()) {
            // verified!
            $data['recaptcha']=true;
        } else {
            $errors = $resp->getErrorCodes();
            // Log these later.    
        }

        return Validator::make($data, [
            'name' => 'required|min:3|max:15|unique:users|alpha_num',
            'email' => 'required|email|max:255|unique:users', 
            'website' => 'url',
            'password' => 'required|confirmed|min:6',
            'terms'=>'required',
            'recaptcha'=>'required',
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
                $tagId=IntVal(Tag::where('name',$tag[0])->value('id'));
                array_push($userTags,$tagId);
            }
        }

        //set avatar
        $avatar = isset($data['avatar']) && $data['avatar']!=""  ? $data['avatar'] : "1";

        //make the new user

        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'website' => $data['website'],
            'password' => bcrypt($data['password']),
            'avatar' => $avatar
        ]);

        //attach the tags
        $newUser->tags()->attach($userTags);

        \Session::flash('success_message','You are now logged in! Thanks for registering.');//

        return $newUser;


    }

    /**
     * login function
     */

    public function login(Request $request)
    {
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {

            \Session::flash('success_message','You are now logged in!');

            return redirect('/');
        } 

        elseif (Auth::attempt(['email'=> $request->name, 'password' => $request->password])) {

            \Session::flash('success_message','You are now logged in!');

            return redirect('/');
        } 


        else {
            
            \Session::flash('failure_message','These credentials do not match our records.');

            return redirect('/auth/login');

        }

    }
}