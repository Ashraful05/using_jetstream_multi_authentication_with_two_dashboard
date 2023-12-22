<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect()->route('user.profile');


    }
}
