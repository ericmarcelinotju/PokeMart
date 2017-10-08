<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|alpha_num|confirmed',
            'profile_picture' => 'required|image',
            'gender' => 'required',
            'dob' => 'date_format:Y-m-d|olderThan:10,Y-m-d',
            'address' => 'required|min:10',
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
        $fileName = "";

        if (Input::file('profile_picture')->isValid()) {
            $destinationPath = public_path('img/profile_picture');
            $extension = Input::file('profile_picture')->getClientOriginalExtension();
            $fileName = uniqid().'.'.$extension;

            Input::file('profile_picture')->move($destinationPath, $fileName);
        }

        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profile_picture' => $fileName,
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'address' => $data['address'],
        ]);
    }
}
