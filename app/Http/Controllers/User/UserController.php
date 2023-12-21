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
//        return $request->all();
    }
}
