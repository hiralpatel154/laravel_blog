@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Profile</h4>
                        <form method="post" action="{{route('store.profile')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name" value="{{$editData->name}}" id="name">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">User Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" name="email" value="{{$editData->email}}" id="email">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="username" class="col-sm-2 col-form-label">User Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="username" value="{{$editData->username}}" id="username">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="profile_image" id="profile_image">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="profile_image" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" src="{{(!empty($editData->profile_image))?url('upload/admin_images/'.$editData->profile_image) : url('upload/no_image.jpg')}}" alt="Profile Image" id="show_image">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-round btn-warning" value="Update Profile">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#profile_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#show_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection