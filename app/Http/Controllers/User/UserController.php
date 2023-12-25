<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    public function logOut()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function userProfile()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('user.profile.view_profile',compact('user'));
    }
    public function userProfileEdit()
    {
        $id = Auth::user()->id;
        $editUser = User::findOrFail($id);
        return view('user.profile.edit_profile',compact('editUser'));
    }
    public function userProfileUpdate(Request $request)
    {
//        $request->validate([
//           'profile_photo_path'=>''
//        ]);
//        return $request->all();
        $data = User::find(Auth::user()->id);
        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'),$fileName);
            $data->profile_photo_path = $fileName;
        }
        $data->update([
            'name'=> $request->name,
            'email' => $request->email,
        ]);
//        return $data;
        $notification = [
            'message'=>'User Info Updated!!',
            'alert-type'=>'info'
        ];
        return redirect()->route('user.profile')->with($notification);
    }
    public function userPasswordChange()
    {
        return view('user.password.password_change');
    }
    public function userPasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
//        return $hashedPassword;

        if(Hash::check($request->old_password,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            $notification = [
                'alert-type'=>'success',
                'message'=>'Your password is successfully changed,please login with your new password'
            ];
            return redirect()->route('login')->with($notification);
        }else{
            $notification = [
              'alert-type'=>'error',
              'message'=>'Check your old and new password'
            ];
            return redirect()->back()->with($notification);
        }

    }
}
