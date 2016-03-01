<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;

class EditUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
            return true;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules=['password' => 'confirmed|min:6'];

        if($this->name!=Auth::user()->name){
            $rules['name'] = 'min:3|max:15|unique:users|alpha_num';
        }
        if($this->email!=Auth::user()->email){
            $rules['email'] = 'email|max:255|unique:users';
        }
        if($this->website!=Auth::user()->website && $this->website!=""){
            $rules['website'] = 'url';
        }

        return $rules;
    }
}
