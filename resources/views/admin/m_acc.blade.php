@extends('admin.layout')
@section('title','হিসাব')
@section('page_header', 'হিসাব ব্যবস্থাপনা')
@section('content')
@section('extracss')
    <style>
        .allButton{
            background-color: darkgreen;
            margin-top: 10px;
            color: white;
        }
        .medicine_text{
            color: darkgreen;
            font-size: 20px;
        }
    </style>
@endsection
@if ($message = Session::get('successMessage'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Thanjs</h4>
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
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title addbut"><button type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus-square"></i> Add Bew </button></h3>
                <h3 class="box-title rembut" style="display:none;"><button type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-minus-square"></i> Remove </button></h3>
                <h3 class="box-title rembut2" ><button type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-eye"></i> Report </button></h3>
            </div>
            <div class="divform" style="display:none">
                {{ Form::open(array('url' => 'insertM_acc',  'method' => 'post')) }}
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label>Company Name</label>
                        <select class="form-control select2 company" name="company" style="width: 100%;" required>
                            <option value="" selected>Select Company Name</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Project Name</label>
                        <select class="form-control select2 project" name="project" style="width: 100%;" required>
                            <option value="" selected>Select Project</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Account Type</label>
                        <select class="form-control select2 type" name="type" style="width: 100%;" required>
                            <option value="" selected>Select Account Type</option>
                            <option value="Cash In" >Cash In</option>
                            <option value="Cash Out" >Cash Out</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="text" class="form-control date" id="date"  name="date" placeholder="Date" required>
                    </div>
                    <div class="form-group">
                        <label for="">Purpose</label>
                        <input type="text" class="form-control purpose" id="purpose"  name="purpose" placeholder="Purpose" required>
                    </div>
                    <div class="form-group">
                        <label for="">Reference</label>
                        <input type="text" class="form-control reference" id="reference"  name="reference" placeholder="Reference" required>
                    </div>
                    <div class="form-group">
                        <label for="">Person</label>
                        <input type="text" class="form-control person" id="person"  name="person" placeholder="Personal" required>
                    </div>
                    <div class="form-group">
                        <label for="">Amount</label>
                        <input type="number" class="form-control amount" id="amount"  name="amount" placeholder="Amount" required>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="id" id="id" class="id">
                    <button type="submit" class="btn allButton">সেভ করুন</button>
                </div>
                {{ Form::close() }}
            </div>
            <div class="divform2" style="display:none;">
                {{ Form::open(array('url' => 'getM_accReportByDate',  'method' => 'post')) }}
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label>Company Name</label>
                        <select class="form-control select2 company" name="company" style="width: 100%;" required>
                            <option value="" selected>Select Company Name</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Project Name</label>
                        <select class="form-control select2 project" name="project" style="width: 100%;" required>
                            <option value="" selected>Select Project</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">From Date</label>
                        <input type="text" class="form-control from_date" id="from_date"  name="from_date" placeholder="ফ্রম ডেট লিখুন" required value="@if(isset($from_date)){{$from_date}} @endif">
                    </div>
                    <div class="form-group">
                        <label for="">To Date</label>
                        <input type="text" class="form-control to_date" id="to_date"  name="to_date" placeholder="টু ডেট লিখুন" required value="@if(isset($to_date)){{$to_date}} @endif">
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="id" id="id" class="id">
                    <button type="submit" class="btn allButton">Submit</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Account List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Tool</th>
                        <th>Date  </th>
                        <th>Type  </th>
                        <th>company  </th>
                        <th>Project  </th>
                        <th>Purpose  </th>
                        <th>Reference  </th>
                        <th>Person  </th>
                        <th>Income  </th>
                        <th>Outcome</th>
                    </tr>
                    @php
                        $sumIn=0;
                        $sumOut=0;
                    @endphp
                    @foreach($accountings as $accounting)
                        <tr>
                            <td class="td-actions text-center">
                                <button type="button" rel="tooltip" class="btn btn-success edit" data-id="{{$accounting->m_id}}">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td style="text-align: right;"> {{$accounting-> date}} </td>
                            <td style="text-align: right;"> {{$accounting->type}} </td>
                            <td style="text-align: right;"> {{$accounting->c_name}} </td>
                            <td style="text-align: right;"> {{$accounting->p_name}} </td>
                            <td style="text-align: right;"> {{$accounting->purpose}} </td>
                            <td style="text-align: right;"> {{$accounting->reference}} </td>
                            <td style="text-align: right;"> {{$accounting->person}} </td>
                            @if($accounting->type == 'Cash In')
                                <td style="text-align: right;"> {{$accounting->amount}}/- </td>
                                @php
                                    $sumIn = $sumIn + $accounting->amount;
                                @endphp
                            @else
                                <td style="text-align: right;"> {{0}}/- </td>
                            @endif
                            @if($accounting->type == 'Cash Out')
                                <td style="text-align: right;"> {{$accounting->amount}}/- </td>
                                @php
                                    $sumOut = $sumOut + $accounting->amount
                                @endphp
                            @else
                                <td style="text-align: right;"> {{0}}/- </td>
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="8" style="text-align: right;">মোটঃ-</td>
                        <td style="text-align: right;">{{$sumIn}} /-</td>
                        <td style="text-align: right;">{{$sumOut}} /-</td>
                    </tr>
                </table>
                {{ $accountings->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
    <script>
        $( function() {
            $('#date').datepicker({
                autoclose: true,
                dateFormat: "yy-m-dd",
            })
        } );
        $( function() {
            $('#from_date').datepicker({
                autoclose: true,
                dateFormat: "yy-m-dd",
            })
        } );
        $( function() {
            $('#to_date').datepicker({
                autoclose: true,
                dateFormat: "yy-m-dd",
            })
        } );
        $(document).ready(function(){
            $(".addbut").click(function(){
                $(".divform").show();
                $(".rembut").show();
                $(".addbut").hide();
                $(".divform2").hide();
            });
            $(".rembut").click(function(){
                $(".divform").hide();
                $(".addbut").show();
                $(".rembut").hide();
                $(".divform2").hide();
            });
            $(".rembut2").click(function(){
                $(".divform2").show();
                $(".divform").hide();
            });

        });
        $(function(){
            $('.select2').select2()
            $(document).on('click', '.edit', function(e){
                e.preventDefault();
                $('.divform').show();
                var id = $(this).data('id');
                getRow(id);
            });
        });
        function getRow(id){
            $.ajax({
                type: 'POST',
                url: 'getM_accListById',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                dataType: 'json',
                success: function(response){
                    var data = response.data;
                    $('.type').val(data.type);
                    $('.date').val(data.date);
                    $('.purpose').val(data.purpose);
                    $('.amount').val(data.amount);
                    $('.person').val(data.person);
                    $('.reference').val(data.reference);
                    $('.id').val(data.id);
                    $('.select2').select2()
                }
            });
        }
        $(document).ready(function(){
            $.ajax({
                url: 'getAllCompany',
                type: "GET",
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (response) {
                    var data = response.data;
                    var len = data.length;
                    for( var i = 0; i<len; i++){
                        var id = data[i]['id'];
                        var name = data[i]['name'];
                        $(".company").append("<option value='"+id+"'>"+name+"</option>");
                    }

                },
                failure: function (msg) {
                    alert('an error occured');
                }
            });
            $('.company').change(function() {
                var id =$(this).val();
                $('.project').find('option:not(:first)').remove();
                $.ajax({
                    type: 'GET',
                    url: 'getAllProject',
                    data: {id:id},
                    dataType: 'json',
                    success: function(response){
                        var data = response.data;
                        var len = data.length;
                        for( var i = 0; i<len; i++){
                            var id = data[i]['id'];
                            var name = data[i]['name'];
                            $(".project").append("<option value='"+id+"'>"+name+"</option>");
                        }
                    }
                });
            });
        });
    </script>
@endsection
