@extends('web.layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Dynamic Jquery</h3>
                </div>
                <div class="card-body">
                    <form action="" id="insert_form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <select name="session_id" id="session_id" class="form-control">
                                    <option value="">Select Session</option>
                                    @foreach ($sessions as $row)
                                        <option value="{{ $row->id }}">{{ $row->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="course_id" id="course_id" class="form-control">
                                    <option value="">Choose Course</option>
                                    @foreach ($courses as $row)
                                        <option value="{{ $row->id }}">{{ $row->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-sm btn-danger" id="add_btn">+</button>
                        </div>
                        <br>
                        <div class="form-group row" id="dynamic_section">

                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-block btn-primary" type="submit" id="submit_btn"> Assign </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .cls{
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $("#add_btn").hide();
        $("#dynamic_section").hide();
        $("#submit_btn").hide();

        $("#course_id").change(function(){
            var course_val = $("#course_id").val();
            if (course_val != '') {
                $("#add_btn").show();
            }else{
                $("#add_btn").hide() && $("#submit_btn").hide() && $("#dynamic_section").empty();
            }
        });

        $("#add_btn").click(function(e){
            e.preventDefault();
            var str = '<div class="col-md-6 cls">\
                        <input type="text" class="form-control" name="category_name[]" placeholder="Enter Category Name">\
                    </div>\
                    <div class="col-md-6 cls">\
                        <input type="text" class="form-control" name="category_value[]" placeholder="Enter Category Value">\
                    </div>';
            $("#dynamic_section").append(str);
            $("#dynamic_section").show() && $("#submit_btn").show();
        });

        $("#submit_btn").click(function(e){
            e.preventDefault();
            $.ajax({
                url: '/api/insert_dynamic',
                type: 'POST',
                dataType: 'json',
                data : $("#insert_form").serialize(),
                success: function(data){
                    console.log(data);
                }
            })
        });


    });
</script>

@endsection
