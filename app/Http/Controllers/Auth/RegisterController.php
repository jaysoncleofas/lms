<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use carbon\Carbon;
use App\Rules\ValidUsername;

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
            'firstName'    => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'lastName'     => 'required|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'middleName'   => 'nullable|regex:/^[\pL\s\-]+$/u|min:2|max:255',
            'suffix'   => 'nullable|regex:/^[\pL\s\-]+$/u|min:1|max:255',
            'studentNumber'         => 'required|alpha_num|unique:users|digits:10',
            // 'birthDate'             => 'required|max:255|16Above',
            'birthDate'             => 'required|max:255',
            // 'username'              => 'required|alpha_dash|unique:users|min:5|max:255',
            'username'     => ['required','unique:users','min:5','max:255', new ValidUsername],
            'email'                 => 'required|string|email|unique:users|max:255',
            'mobileNumber'          => 'nullable|alpha_num|digits:11|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}/',
            'password_confirmation' => 'required'
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
            'role'          => 'student',
            'firstName'     => $data['firstName'],
            'middleName'    => $data['middleName'],
            'lastName'      => $data['lastName'],
            'studentNumber' => $data['studentNumber'],
            'birthDate'     => $data['formatted_birthDate_submit'],
            'username'      => $data['username'],
            'email'         => $data['email'],
            'mobileNumber'  => $data['mobileNumber'],
            'password'      => Hash::make($data['password']),
            'avatar'        => 'profile_pic.png'
        ]);

        $user->sections()->sync($data['sections'], false);

        return $user;
    }
}
