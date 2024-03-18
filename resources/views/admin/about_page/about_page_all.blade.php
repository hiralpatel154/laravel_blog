@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">About Page</h4>
                        <form method="post" action="{{route('update.about')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$aboutpage->id}}">
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title" value="{{$aboutpage->title}}" id="title">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="short_title" class="col-sm-2 col-form-label">Short title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="short_title" value="{{$aboutpage->short_title}}" id="short_title">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="short_desc" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea  class="form-control" rows="5" name="short_desc">
                                    {{$aboutpage->short_desc}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="long_desc" class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">
                                    <textarea id="elm1" name="long_desc">{{$aboutpage->long_desc}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="about_image" class="col-sm-2 col-form-label">About Images</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="about_image" id="about_image">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="aboutpage" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" src="{{(!empty($aboutpage->about_image))?url($aboutpage->about_image) : url('upload/no_image.jpg')}}" alt="About Images" id="show_image">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-round btn-warning" value="Update About Page">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#aboutpage').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#show_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection