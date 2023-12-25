@extends('user.master')
@section('title','User Password Change')
@section('main_content')

    <div class="row" style="padding: 20px;">
        <h4 class="title">Change Password</h4>
        <div class="col-md-12">
            <form action="{{ route('update_user_password') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="old_password" id="current_password">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="password" id="password" >
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Retype Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-info form-control">Update Password</button>
                </div>
            </form>
        </div>
    </div>


@endsection
