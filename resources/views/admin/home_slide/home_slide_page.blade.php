@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Home Slide Page</h4>
                        <form method="post" action="{{route('update.slide')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$homeslide->id}}">
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title" value="{{$homeslide->title}}" id="title">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="short_title" class="col-sm-2 col-form-label">Short title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="short_title" value="{{$homeslide->short_title}}" id="short_title">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="video_url" class="col-sm-2 col-form-label">Video URL</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="video_url" value="{{$homeslide->video_url}}" id="video_url">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="home_slide" class="col-sm-2 col-form-label">Home Slide</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="home_slide" id="home_slide">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="home_slide" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" src="{{(!empty($homeslide->home_slide))?url($homeslide->home_slide) : url('upload/no_image.jpg')}}" alt="Profile Image" id="show_image">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-round btn-warning" value="Update Slide">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#home_slide').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#show_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection