<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use carbon\Carbon;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Hash;
use App\File;


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
            'mobileNumber'     => $request->mobileNumber,
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

    public function change_password_index()
    {
        return view('profile.change_password', compact('user'));
    }

    public function change_password_update(Request $request)
    {
        $user = Auth::user();

        if (Hash::check(Input::get('oldpassword'), $user['password'])) {
                $this->validate($request, [
                    'password' => 'required|min:6|confirmed'
                    ]);
                $user->password = bcrypt(Input::get('password'));
                $user->save();
                session()->flash('status', 'You have successfully changed your password!');
                session()->flash('type', 'success');
                return redirect()->route('change.password.index');
              } else {
                session()->flash('status', 'Invalid Current Password');
                session()->flash('type', 'error');
                return redirect()->route('change.password.index');
              }

        // return $user

    }

    public function my_files()
    {
        $files = File::where('user_id', Auth::id())->get();
        return view('profile.my_files', compact('files'));
    }

    public function files_store(Request $request)
    {
        $request->validate([
            'file_upload' => 'required',
        ]);

        if ($request->hasFile('file_upload')) {
           $request->validate([
               'file_upload' => 'mimes:pdf,doc,ppt,xls,docx,pptx,xlsx,rar,zip|max:1000',
           ]);

           $fileUpload = $request->file_upload;
           time() . '.' .
           // $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
           $name = time().'-'.$fileUpload->getClientOriginalName();
           $type = $fileUpload->getClientOriginalExtension();
           $size = $fileUpload->getClientSize();
           $fileUpload->storeAs('public/userfiles', $name);
       }

        $files = new File;
        $files->user_id = Auth::id();
        $files->name = $name ?? "";
        $files->type = $type ?? "";
        $files->size = $size ?? "";
        $files->save();

        session()->flash('status', 'Successfully saved!');
        session()->flash('type', 'success');

        return redirect()->back();
    }


    public function files_download($file_id){

        $entry = File::findOrFail($file_id);
        $pathToFile = storage_path()."/app/public/userfiles/".$entry->name;
        return response()->download($pathToFile);
    }

    public function files_destroy($file_id){

        $entry = File::findOrFail($file_id);
        $entry->delete();

        session()->flash('status', 'Successfully deleted!');
        session()->flash('type', 'success');

        return redirect()->back();
    }


}
