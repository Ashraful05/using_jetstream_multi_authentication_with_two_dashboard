<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainAdminController extends Controller
{
    public function viewProfile()
    {
        $adminData = Admin::find(1);
        return view('admin.profile.view_profile',compact('adminData'));
    }
    public function editProfile()
    {
        $editAdmin = Admin::find(1);
        return view('admin.profile.edit_profile',compact('editAdmin'));
    }
    public function updateAdminProfile(Request $request)
    {
        $data = Admin::find(1);
        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'),$fileName);
            $data->profile_photo_path = $fileName;
        }
        $data->update([
            'name'=> $request->name,
            'email' => $request->email,
        ]);
        $notification = [
            'message'=>'Admin Info Updated!!',
            'alert-type'=>'info'
        ];
        return redirect()->route('view_profile')->with($notification);
    }
    public function passwordChange()
    {
        return view('admin.password.change_password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|confirmed',
        ]);

        $hashedPassword = Admin::find(1)->password;
//        return $hashedPassword;

        if(Hash::check($request->old_password,$hashedPassword)){
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            $notification = [
                'alert-type'=>'success',
                'message'=>'Your password is successfully changed,please login with your new password'
            ];
            return redirect()->route('admin.login')->with($notification);
        }else{
            $notification = [
                'alert-type'=>'error',
                'message'=>'Check your old and new password'
            ];
            return redirect()->back()->with($notification);
        }
    }
}
