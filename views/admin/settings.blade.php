@extends('layouts.admin')

@section('title')Settings @endsection

@section('styles')
    <style>
        .form-horizontal .control-label{
            text-align: left;
        }
         .thumbnail img{
             width: 95px;
         }
        .tab-content{
            padding: 10px;
        }
        .small-img{
            max-height: 50px;
            max-width: 100%;
            border: 1px solid lightgrey;
            border-radius: 5px;
            padding: 5px;
            -webkit-box-shadow: 0 0 10px lightgrey;
            box-shadow: 0 0 10px lightgrey;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="/css/image-picker.css">
@endsection


@section('content')
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="modal fade" id="modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Pictures</h4>
                        </div>
                        <div class="modal-body">
                            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                    <li role="presentation" id="upload">
                                        <a href="#home1" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">Upload</a>                            </li>
                                    <li role="presentation" class="active" id="select">
                                        <a href="#profile1" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="true">Select</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade" role="tabpanel" id="home1" aria-labelledby="home-tab">
                                        <form id="submit_form2" action="/admin/upload" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="file" name="file[]" id="image_file" multiple style="display: none"/>
                                                <div class="form-group">
                                                    <label for="width" class="col-sm-4 control-label">Crop</label>
                                                    <div class="col-sm-4">
                                                        <input type="number" min="1" class="form-control" name="width" placeholder="Width" value="{{ $picture_dimensions[0] }}">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="number" min="1" class="form-control" name="height" placeholder="Height" value="{{ $picture_dimensions[1] }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- checkbox -->
                                                <div class="form-group pull-right">
                                                    <label>
                                                        <input type="checkbox" class="minimal" name="crop" checked>
                                                        Crop
                                                    </label>
                                                </div>
                                            </div>
                                            {!! csrf() !!}
                                            <div class="form-group pull-right">
                                                <button type="button" class="btn btn-primary btn-sm" id="picture">Select Pictures</button>
                                                <input type="submit" name="upload_button" class="btn btn-primary btn-sm" value="Upload" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade active in" role="tabpanel" id="div-icon" aria-labelledby="profile-tab">
                                        <form id="form-icon" method="post">
                                            <input type="hidden" name="selected-id-icon" value="{{ $icon_id!=null ? $icon_id : null }}">
                                            <input type="hidden" name="suffix" value="icon">
                                            {!! csrf() !!}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="save-changes-icon" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modal-logo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Pictures</h4>
                        </div>
                        <div class="modal-body">
                            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                    <li role="presentation" id="upload">
                                        <a href="#upload-logo-tab" id="home-tab" role="tab" data-toggle="tab" aria-controls="upload-logo-tab" aria-expanded="false">Upload</a>                            </li>
                                    <li role="presentation" class="active" id="select">
                                        <a href="#div-logo" role="tab" id="profile-tab" data-toggle="tab" aria-controls="div-logo" aria-expanded="true">Select</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade" role="tabpanel" id="upload-logo-tab" aria-labelledby="home-tab">
                                        <form id="submit_form2" action="/admin/upload" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="file" name="file[]" id="image_file-logo" multiple style="display: none"/>
                                                <div class="form-group">
                                                    <label for="width" class="col-sm-4 control-label">Crop</label>
                                                    <div class="col-sm-4">
                                                        <input type="number" min="1" class="form-control" name="width" placeholder="Width" value="{{ $picture_dimensions[0] }}">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="number" min="1" class="form-control" name="height" placeholder="Height" value="{{ $picture_dimensions[1] }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <!-- checkbox -->
                                                <div class="form-group pull-right">
                                                    <label>
                                                        <input type="checkbox" class="minimal" name="crop" checked>
                                                        Crop
                                                    </label>
                                                </div>
                                            </div>
                                            {!! csrf() !!}
                                            <div class="form-group pull-right">
                                                <button type="button" class="btn btn-primary btn-sm" id="picture-logo">Select Pictures</button>
                                                <input type="submit" name="upload_button" class="btn btn-primary btn-sm" value="Upload" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade active in" role="tabpanel" id="div-logo" aria-labelledby="profile-tab">
                                        <form id="form-logo" method="post">
                                            <input type="hidden" name="selected-id-logo" value="{{ $logo!=null ? $logo->id : null }}">
                                            <input type="hidden" name="suffix" value="logo">
                                            {!! csrf() !!}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="save-changes-logo" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <form class="form-horizontal" method="post" action="/admin/thumbnails-settings">
            <div class="col-md-8 col-lg-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Settings</h3>
                    </div>
                    <div class="box-body">

                        <div class="col-md-12">
                            <fieldset>
                        <!-- form start -->
                                <legend>Pictures</legend>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="width" class="col-sm-4 control-label">Pictures</label>
                                    <div class="col-sm-4">
                                        <input type="number" min="1" class="form-control" name="picture-width" placeholder="Picture Width" value="{{ old('picture-width', $picture_dimensions[0] ) }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="number" min="1" class="form-control" name="picture-height" placeholder="Picture Height" value="{{ old('picture-height', $picture_dimensions[1] ) }}">
                                    </div>
                                </div>
                                    @foreach($thumbnails as $key=>$thumbnail)
                                    <div class="form-group">
                                        <label for="width" class="col-sm-4 control-label">Thumbnail #{{$key+1}}</label>
                                        <div class="col-sm-4">
                                            <input type="number" min="1" class="form-control" name="width[]" placeholder="Width" value="{{explode(':', $thumbnail)[0]}}">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="number" min="1" class="form-control" name="height[]" placeholder="Height" value="{{explode(':', $thumbnail)[1]}}">
                                        </div>
                                    </div>
                                    @endforeach
                                <div class="form-group">
                                    <div class="col-md-4">
                                    <a href="#" id="site-icon" data-toggle="modal" class="btn btn-sm btn-default pull-right" data-target="#modal-icon">Select Site Icon</a>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="{{ $icon }}" class="small-img" id="icon" name="icon" alt="">
                                        <input type="hidden" id="picture-id-icon" name="picture-id-icon" value="{{ $icon_id }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                    <a href="#" id="site-logo" data-toggle="modal" class="btn btn-sm btn-default pull-right" data-target="#modal-logo">Select Site Logo</a>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="{{ $logo!=null ? $logo->path : '' }}" class="small-img" id="logo" name="logo"  alt="">
                                        <input type="hidden" id="picture-id-logo" name="picture-id-logo" value="{{ $logo!=null ? $logo->id : null }}">
                                    </div>
                                </div>
                                    <!-- /.col -->
                            </div>
                            <!-- /.box-footer -->
                            {!! csrf() !!}
                            </fieldset>
                        <!-- /.box-header -->
                        <!-- form start -->
                            <fieldset>
                                <legend>Price</legend>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="currency-symbol" class="col-sm-6 control-label">Symbol</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="currency-symbol" value="{{ $currency_symbol}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="position-symbol" class="col-sm-6 control-label">Position</label>
                                    <div class="col-sm-6">
                                        <select name="position-symbol" id="position-symbol" class="form-control">
                                            <option value="left" @if($position_symbol=='left')selected @endif>Left</option>
                                            <option value="right" @if($position_symbol=='right')selected @endif>Right</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="position-symbol" class="col-sm-6 control-label">With Interval</label>
                                    <input type="checkbox" name="currency-with-interval" value="yes" @if($currency_with_interval=='yes')checked @endif class="minimal">
                                </div>
                            </div>
                            </fieldset>

                            <fieldset>
                                <legend>Other</legend>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="currency-symbol" class="col-sm-6 control-label">New Product in Days</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="new-product" value="{{ $new_product}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="currency-symbol" class="col-sm-6 control-label">Site Title</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="site-title" value="{{ $site_title}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="currency-symbol" class="col-sm-3 control-label">Footer Text</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="footer-text" rows="5">{{ $footer_text }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Save</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
    <form id="form-delete-file">{!! csrf() !!}<input type="hidden" name="filename" id="filename"></form>
    <!-- /Main content -->
@endsection

@section('scripts')
    <script src="/js/image-picker.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#picture', function(){
                $("#image_file").click();
            });
            $(document).on('click', '#picture-logo', function(){
                $("#image_file-logo").click();
            });

        });
        var li;

        $(document).on('click', '#site-icon', function(){
            $("#form-icon").submit();
        });
        $('#form-icon').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url:"/admin/select-picture/",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                //cache:false,
                processData:false,
                success:function(data)
                {
                    $('#div-icon').html(data);
                    $('.delete-file').on('click', function() {
                        var filename = $(this).parent().find("img").attr("src");
                        var delete_file = $('#filename').attr('value', filename);
                        li = $(this).closest('li');
                        $("#delete-form-submit").html("$('#form-delete-file').on('submit', function(e){\n" +
                            "                            e.preventDefault();\n" +
                            "                            $.ajax({\n" +
                            "                                url:\"/admin/delete-file/\",\n" +
                            "                                method:\"POST\",\n" +
                            "                                data:new FormData(this),\n" +
                            "                                contentType:false,\n" +
                            "                                //cache:false,\n" +
                            "                                processData:false,\n" +
                            "                                success:function(data)\n" +
                            "                                {\n" +
                            "                                   li.remove();\n" +
                            "                                }\n" +
                            "                            })\n" +
                            "                        });\n");

                        $('#form-delete-file').submit();
                    });
                }
            })
        });


        $(document).on('click', '#site-logo', function(){
            $("#form-logo").submit();
        });
        $('#form-logo').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url:"/admin/select-picture/",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                //cache:false,
                processData:false,
                success:function(data)
                {
                    $('#div-logo').html(data);
                    $('.delete-file').on('click', function() {
                        var filename = $(this).parent().find("img").attr("src");
                        var delete_file = $('#filename').attr('value', filename);
                        li = $(this).closest('li');
                        $("#delete-form-submit").html("$('#form-delete-file').on('submit', function(e){\n" +
                            "                            e.preventDefault();\n" +
                            "                            $.ajax({\n" +
                            "                                url:\"/admin/delete-file/\",\n" +
                            "                                method:\"POST\",\n" +
                            "                                data:new FormData(this),\n" +
                            "                                contentType:false,\n" +
                            "                                //cache:false,\n" +
                            "                                processData:false,\n" +
                            "                                success:function(data)\n" +
                            "                                {\n" +
                            "                                   li.remove();\n" +
                            "                                }\n" +
                            "                            })\n" +
                            "                        });\n");

                        $('#form-delete-file').submit();
                    });

                }
            })
        });
    </script>
    <script id="delete-form-submit"></script>

@endsection
