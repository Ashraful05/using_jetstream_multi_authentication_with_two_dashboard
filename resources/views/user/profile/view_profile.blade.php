@extends('user.master')
@section('title','User Profile')
@section('main_content')
    <div class="card" style="width: 18rem;">
        <img src="{{ (!empty($user->profile_photo_path))?url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">User Name: {{ $user->name }}</h5>
            <p class="card-text">User Email: {{ $user->email }}</p>
            <a href="{{ route('user_profile_edit') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
@endsection
