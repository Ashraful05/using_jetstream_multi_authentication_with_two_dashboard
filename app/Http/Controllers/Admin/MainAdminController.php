<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

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
}
