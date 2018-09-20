<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/student/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'firstName' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'middleName'=> 'nullable|regex:/^[\pL\s\-]+$/u|max:255',
            'lastName'  => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'birthDate' => 'required|max:255',
            'username'  => 'required|alpha_dash|unique:users|max:255',
            'email'     => 'required|string|email|unique:users|max:255',
            'password'  => 'required|string|min:6|confirmed',
            'mobileNumber'=> 'nullable|alpha_num|digits:11|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'role'      => 'student',
            'firstName' => $data['firstName'],
            'middleName'=> $data['middleName'],
            'lastName'  => $data['lastName'],
            'birthDate' => $data['formatted_birthDate_submit'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'mobileNumber'  => $data['mobileNumber'],
            'password'  => Hash::make($data['password']),
        ]);

        $user->sections()->sync($data['sections'], false);

        return $user;
    }
}
