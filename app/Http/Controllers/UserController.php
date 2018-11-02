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
            'middleName'=> 'nullable|regex:/^[\pL\s\-]+$/u|max:255',
            'birthDate' => 'nullable|max:255',
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

        if ($request->mobileNumber != $user->mobileNumber) {
            $request->validate([
                'mobileNumber'=> 'nullable|digits:11|unique:users',
            ]);
        }

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'bail|image|mimes:jpg,png,jpeg,gif,svg|max:10000',
            ]);
            
            $avatar = $request->avatar;
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$avatar->getClientOriginalName();
            // $avatar->image = $name;
            $avatar->storeAs('public/avatars', $name);
            
            $user->avatar = $name;
        }

            
        if ($user->role == 'student' && $user->studentNumber == '') {
            $request->validate([
                'studentNumber'  => 'required|alpha_num|unique:users|digits:10',
            ]);

            $user->studentNumber = $request->studentNumber;
        }

        if ($user->role == 'student') {
            if(Carbon::parse($request->formatted_birthDate_submit)->age >= 16 ){
                $user->birthDate = $request->formatted_birthDate_submit;
            } else {
                session()->flash('statusError', '16 years old above only');
                return redirect()->route('profile.index');
            }
        }

        $user->firstName     = $request->firstName;
        $user->middleName    = $request->middleName;
        $user->lastName      = $request->lastName;
        $user->username      = $request->username;
        $user->email         = $request->email;
        $user->mobileNumber  = $request->mobileNumber;
        $user->save();

        session()->flash('status', 'Update successful');
        session()->flash('type', 'success');

        return redirect()->route('profile.index');
    }

    public function profile_remove(Request $request)
    {
        $user = Auth::user();
        $user->avatar = 'profile_pic.png';
        $user->save();

        session()->flash('status', 'Remove profile picture successful');
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

        $this->validate($request, [
            'currentPassword' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        if (Hash::check(Input::get('currentPassword'), $user['password'])) {
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
    }

    public function my_files()
    {
        $data['files'] = File::where('user_id', Auth::id())->latest()->get();
        return view('profile.my_files', $data);
    }

    public function files_store(Request $request)
    {
        $request->validate([
            'file_upload' => 'required',
        ]);

        if ($request->hasFile('file_upload')) {
           $request->validate([
               'file_upload' => 'mimes:pdf,doc,ppt,xls,docx,pptx,xlsx,rar,zip|max:10000',
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

        session()->flash('status', 'Successfully saved');
        session()->flash('type', 'success');

        return redirect()->back();
    }


    public function files_download($file_id){

        $entry = File::findOrFail($file_id);
        $pathToFile = storage_path()."/app/public/userfiles/".$entry->name;
        $name = substr($entry->name,11);
        return response()->download($pathToFile, $name);
    }

    public function files_destroy($file_id){

        $entry = File::findOrFail($file_id);
        $entry->delete();

        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return response('success', 200);
    }


}
