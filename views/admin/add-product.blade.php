@extends('layouts.admin')

@section('title')Add Product @endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="/css/image-picker.css">
    <style>
        .thumbnail img{
            width: 95px;
        }
        .tab-content{
            padding: 10px;
        }
        .row-price{
            margin-top: 20px !important;
        }
    </style>

@endsection

@section('content')
    <!-- Main content -->
        <!-- Modal -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                {{ print_select_picture_modal('picture', $picture_dimensions) }}

    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                <a href="#home1" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">Upload</a>
                            </li>
                            <li role="presentation" class="active" id="select">
                                <a href="#div-picture1" role="tab" id="div-picture-tab" data-toggle="tab" aria-controls="div-picture" aria-expanded="true">Select</a>
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
                                </form>
                            </div>
                            <div class="tab-pane fade active in" role="tabpanel" id="div-picture1" aria-labelledby="div-picture-tab">
                                <form id="form-picture1" method="post">
                                    {!! csrf() !!}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="save-changes1" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Product</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="/admin/products">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" @if(haveErrors())value="{{old('title', '')}}@endif">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="parent" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                <select name="category-id" class="form-control" >
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if(old('category-id')==$category->id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <textarea id="description" name="description" rows="10" cols="80"></textarea>
                        <div class="row-price">
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-3">
                                    <label for="">Price</label>
                                    <input type="number" step=".01" min="0.01" name="price" class="form-control" value="{{old('price', '0.01')}}">
                                </div>
                                <div class="form-group col-sm-4 col-md-3">
                                    <label for="">Promo Price</label>
                                    <input type="number" step=".01" min="0.01" name="promo-price" class="form-control" value="{{old('promo-price', '')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-3">
                                    <label for="variation-name">Variation Name</label>
                                    <input type="text" name="variation-name" class="form-control" value="{{old('variation-name', '')}}">
                                </div>
                                <div class="form-group col-sm-4 col-md-3">
                                    <label for="variation-value">Values</label>
                                    <input type="text" name="variation-value" class="form-control" value="{{old('variation-value', '')}}">
                                    <p><i>Separate variations with "|"</i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <!-- footer -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-default pull-right" name="submit">Save</button>
                </div>
                {!! csrf() !!}
                <div id="text"></div>
                <div id="text1"></div>
                <input type="hidden" id="picture-id-picture" name="picture-id-picture" value="">
            </form>
        </div>
    </div>

    <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Product Picture</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <a href="#" id="pictures" data-toggle="modal" class="text-center" data-target="#modal-picture">Select Product Picture</a>
                        <img src="" class="small-img img-stretch" id="picture" name="picture" alt="">
                    </div>
                    <!-- /.col -->
                </div>
                <!-- ./box-body -->

            </div>
            <!-- /.box -->

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Product Gallery</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="col-md-12">
                        <a href="#" id="pictures1" data-toggle="modal" data-target="#myModal1">Select Gallery Pictures</a>
                        <div id="profile-picture1"></div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
    </div>
    <form action="" id="files1">{!! csrf() !!}</form>
    <form action="" id="files">{!! csrf() !!}</form>
            </div>
        </div>
        <form action="/admin/add-variation" id="all-variations-form1" method="post">
            <div id="all-variations1">
            </div>
            {!! csrf() !!}
        </form>
        <form id="form-delete-file">{!! csrf() !!}<input type="hidden" name="filename" id="filename"></form>
    </section>
@endsection

@section('scripts')
    <!-- CK Editor -->
    <script src="/bower_components/ckeditor/ckeditor.js"></script>

    <script>
        $(document).ready(function(){
            $(document).on('click', '#pictures', function(){
                $("#form-picture").submit();
            });

        });
        var li;
        $('#form-picture').on('submit', function(e){
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
                    $('#div-picture').html(data);
                    $('.delete-file').on('click', function() {
                        var filename=$(this).parent().find("img").attr("src");
                        var delete_file=$('#filename').attr('value', filename);
                        li=$(this).closest('li');
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

        $(document).ready(function(){
            $(document).on('click', '#pictures1', function(){
                $("#form-picture1").submit();
            });

        });
        $('#form-picture1').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url:"/admin/get-gallery-pictures/",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                //cache:false,
                processData:false,
                success:function(data)
                {
                    $('#div-picture1').html(data);
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
    <script data-sample="1">
        var config = {
            extraPlugins: 'colorbutton, font',
            codeSnippet_theme: 'monokai_sublime',
            height: 250
        };

        CKEDITOR.replace( 'description', config );

    $(document).ready(function(){
        $('#variations-div').hide();
        $('#variations').hide();
        $(document).on('click', '#select-picture1', function(){
            $("#image_file").click();
        });
    });

    </script>
    <script src="/js/image-picker.js"></script>
    <script>
        $('#product-type').on('change', function () {
            var valueSelected = this.value;
            if(valueSelected=='variation product'){
                $('#variations-div').show();
                $('#variations').show();
            }else{
                $('#variations-div').hide();
                $('#variations').hide();
            }
        })
        $('#add-variation').on('click', function () {
        var html='                                               <div class="row">\n' +
                '                                                    <div class="form-group col-md-4">\n' +
                '                                                        <label for="">Name</label>\n' +
                '                                                        <input type="text" name="name[]" id="name[]" class="form-control">\n' +
                '                                                    </div>\n' +
                '                                                    <div class="form-group col-md-6">\n' +
                '                                                        <label for="">Values</label>\n' +
                '                                                        <input type="text" name="value[]" id="value[]" class="form-control" placeholder="Separate items with |">\n' +
                '                                                    </div>\n' +
                '                                                    <div class="form-group col-md-2">\n' +
            '                                                        <label for=""></label>\n' +
            '                                                        <button type="button" name="add-variation[0]" class="btn btn-default btn-block" style="margin-top:5px;">Add</button>\n' +
                '                                                    </div>\n' +
            '                                                    </div>';

            $('#ddd').on('click', function () {
                                    $('#all-variations-form1').submit();
                                });

            $('#all-variations').append(html);
        })
        $('#save-attributes').on('click', function () {
            alert(this.val());
        })
        $( "#gallery-pictures" )
            .change(function () {
                var str = $('#gallery-pictures').val();
            })
            .change();




        $('#variations-add').on('click', function () {
            var names = $("input[name='name[]']")
                .map(function(){return $(this).val();}).get();
            var values = $("input[name='value[]']")
                .map(function(){return $(this).val();}).get();

            var html='';
            html = '<div class="row"><div class="col-md-12">';

            var value='';
            for(f in values){
                if(values[f.valueOf()]!='' && names[f.valueOf()!='']) {
                    value += values[f.valueOf()] + '|';
                }
            }

            var decart=0;
            var mul=0;
            for (i = 0; i < names.length; i++) {
                if (names[i] != '') {
                    var value = values[i].split('|');
                    var mul_ = false;
                    for (j = 0; j < value.length; j++) {
                        if (value != '') {
                            if (mul_==false) {
                                mul++;
                                mul_ = true;
                            }
                            decart++;
                        }
                    }
                }
            }
            console.log(decart*mul);



            for(k=0; k<decart.length; k++) {
                for (i = 0; i < names.length; i++) {
                    var value = values[i].split('|');
                    if (value != '' && names[i] != '') {
                        html += '<select class="form-control"><option value="' + names[i] + '">Всеки ' + names[i] + '</option>';
                        for (j = 0; j < value.length; j++) {
                            html += '<option value="' + value[j] + '">' + value[j] + '</option>';
                        }
                        html += '</select>';
                    }
                }
            }
            html+='</div></div>';
            $('#variations').append(html);
        })

    </script>

@endsection