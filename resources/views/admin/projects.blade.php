@extends('admin.layout')
@section('title', 'Projects Management')
@section('page_header', 'Projects Management')
@section('projects','active')
@section('extracss')
    <link rel="stylesheet" href="{{url('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection
@section('content')
    @if ($message = Session::get('successMessage'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thank You!!</h4>
            {{ $message }}</b>
        </div>
    @endif
    @if ($message = Session::get('errorMessage'))

        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Sorry!</h4>
            {{ $message }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                    <h3 class="box-title addbut"><button type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus-square"></i> Add New </button></h3>
                    <h3 class="box-title rembut" style="display:none;"><button type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-minus-square"></i> Remove </button></h3>
                    <div class="divform" style="display:none">
                        {{ Form::open(array('url' => 'insertProjects',  'method' => 'post','enctype'=> 'multipart/form-data')) }}
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label> Project Category</label>
                                <select class="form-control select2 type" name="type" style="width: 100%;" required>
                                    <option value="" selected>Select Project Category</option>
                                    <option value="Building">Building Design</option>
                                    <option value="Interior">Interior Design</option>
                                    <option value="Commercial">Commercial Design</option>
                                    <option value="Landscape">Landscape Design</option>
                                    <option value="Floor-Plan">Floor Plan</option>
                                    <option value="Swimming-Pool">Swimming Pool Design</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Animation">Animation</option>
                                    <option value="Rooftop">Rooftop Design</option>
                                    <option value="Fountain">Fountain Design</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Project Name</label>
                                <input type="text" class="form-control name" id="name" name="name" placeholder="Project Name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Cover Photo</label>
                                <input type="file" class="form-control image" id="image" accept="image/*"  name="image" placeholder="Enter image" required>
                            </div>
                            <div class="form-group">
                                <label for="">Slider Photo (Must be W-1920px * H-1280px)</label>
                                <input type="file" class="form-control slider" id="slider" accept="image/*"  name="slider[]" placeholder="Enter slider" required multiple>
                            </div>
                            <div id="newRow">

                            </div>
                            <div class="form-group">
                                <a type="submit" class="btn btn-primary" id="addMore"><i class="fa-fa ion-plus"></i>আরও যোগ করুন</a>
                            </div>
                            <div class="form-group">
                                <label for="">Project Info</label>
                                <textarea class="textarea info" id="info" placeholder="Project Info" name="info"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Project Description</label>
                                <textarea class="textarea description" id="description" placeholder="Project Description" name="description"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" id="id" class="id">
                            <button type="submit" class="btn btn-success btn-flat">Save Info</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Projects</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Cover Photo </th>
                            <th>Name </th>
                        </tr>
                        @foreach($projects as $project)
                            <tr>
                                <td> <img src="{{'public/images/'.$project->cover_phote}}" height="50" width="50"> </td>
                                <td> {{$project->name}} </td>
                                <td class="td-actions text-center">
                                    <button type="button" rel="tooltip" class="btn btn-success edit" data-id="{{$project->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger delete" data-id="{{$project->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{$projects->links()}}
                    <div class="modal modal-danger fade" id="modal-danger">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">মুছে ফেলতে চান</h4>
                                </div>
                                <div class="modal-body">
                                    <center><p>মুছে ফেলতে চান?</p></center>
                                </div>
                                <div class="modal-footer">
                                    {{ Form::open(array('url' => 'deleteProjectList',  'method' => 'post')) }}
                                    {{ csrf_field() }}
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">না</button>
                                    <button type="submit" class="btn btn-outline">হ্যা</button>
                                    <input type="hidden" name="id" id="id" class="id">
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script>
        $("#addMore").click(function () {
            var html = '';
            html += '<div class="form-group" id="inputFormRow">';
            html += '<div class="input-group">';
            html += '<input class="form-control" type="file" accept="image/*"name="slider[]" required>';
            html += '<span class="input-group-btn">';
            html += '<a class="btn btn-danger" id="remove">Remove</a>';
            html += '</span>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });
        $(document).on('click', '#remove', function () {
            $(this).closest('#inputFormRow').remove();
        });
        $(document).ready(function(){
            $('.textarea').wysihtml5();
            $('.select2').select2();
            $(".addbut").click(function(){
                $(".divform").show();
                $(".rembut").show();
                $(".addbut").hide();
            });
            $(".rembut").click(function(){
                $(".divform").hide();
                $(".addbut").show();
                $(".rembut").hide();
            });

        });
        $(function(){
            $(document).on('click', '.edit', function(e){
                e.preventDefault();
                $('.divform').show();
                var id = $(this).data('id');
                getRow(id);
            });
            $(document).on('click', '.delete', function(e){
                e.preventDefault();
                $('#modal-danger').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });
        });
        function getRow(id){
            $.ajax({
                type: 'POST',
                url: 'getProjectById',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('.id').val(data.id);
                    $('.type').val(data.type);
                    $('.name').val(data.name);
                    $('#description ~ iframe').contents().find('.wysihtml5-editor').html(data.description);
                    $('#info ~ iframe').contents().find('.wysihtml5-editor').html(data.info);
                    $(".image").prop('required',false);
                    $('.select2').select2();
                }
            });
        }
    </script>
@endsection
