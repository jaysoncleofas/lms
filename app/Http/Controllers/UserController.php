<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use carbon\Carbon;


class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'birthDate' => 'required|max:255',
        ]);

        if ($request->email != $user->email) {
            $request->validate([
                'email'     => 'required|string|email|unique:users|max:255',
            ]);
        }

        if ($request->username != $user->username) {
            $request->validate([
                'username'  => 'required|string|unique:users|max:255',
            ]);
        }

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'bail|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
                    $avatar = $request->avatar;
                    $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                    $name = $timestamp. '-' .$avatar->getClientOriginalName();
                    // $avatar->image = $name;
                    $avatar->storeAs('public/avatars', $name);
        }

        $user->update([
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName'  => $request->lastName,
            'birthDate' => $request->formatted_birthDate_submit,
            'username'  => $request->username,
            'email'     => $request->email,
            'avatar'     => $name ?? 'profile_pic.png',
            // 'password'  => $request->password == '' ? bcrypt('secrect') : bcrypt($request->password),
        ]);

        session()->flash('status', 'Update successful!');
        session()->flash('type', 'success');

        return redirect()->route('profile.update');
    }

    public function profile_remove(Request $request)
    {
        $user = Auth::user();
        $user->avatar = 'profile_pic.png';
        $user->save();

        session()->flash('status', 'Remove profile picture successful!');
        session()->flash('type', 'success');

        return redirect()->route('profile.update');
    }

    public function change_password_index(Request $request)
    {
        return view('profile.change_password', compact('user'));
    }


}
