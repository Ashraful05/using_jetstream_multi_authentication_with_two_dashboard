@extends('admin.admin_master')
@section('title','Edit Admin Profile')
@section('main_content')
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="row" style="padding: 20px;">
        <div class="col-md-12">
            <form action="{{ route('update_admin_profile',$editAdmin->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">User Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $editAdmin->name }}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">User Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $editAdmin->email }}">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input type="file" id="image" name="profile_photo_path" class="form-control">
                </div>
                <div class="mb-2">
                    <img src="{{ !empty($editAdmin->profile_photo_path)?url('upload/admin_images/'.$editAdmin->profile_photo_path):url('upload/no_image.jpg') }}" style="height: 150px;width: 150px;" id="showImage">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-info form-control">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            $("#image").change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $("#showImage").attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>
@endsection
