@extends('user.master')
@section('title','Edit User Profile')
@section('main_content')
    <div class="row" style="padding: 20px;">
        <div class="col-md-12">
            <form action="{{ route('update_user_profile',$editUser->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">User Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $editUser->name }}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">User Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $editUser->email }}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" >
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input type="file" name="profile_photo_path" class="form-control">
                </div>
                <div class="mb-1">
                    <img src="{{ !empty($editUser->profile_photo_path)?url('upload/user_images/'.$editUser->profile_photo_path):url('upload/no_image.jpg') }}" style="height: 150px;width: 150px;">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-info form-control">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
