@extends('web.layouts.default')

@section('content')
<style>
    .cls{
        margin-bottom: 20px;
        margin-top: 20px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Dynamic Jquery</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="insert_form">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="">Session</label>
                            <select name="session_id" class="form-control" id="session">
                                <option value="">Select Session</option>
                                @foreach ($sessions as $row)
                                    <option value="{{ $row->id }}">{{ $row->title  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Course</label>
                            <select name="course_id" class="form-control" id="course">
                                <option value="">Choose Course</option>
                                @foreach ($courses as $row)
                                    <option value="{{ $row->id }}">{{ $row->short_code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-danger btn-sm" id="add_btn">+</button>
                    </div>
                    <div class="form-group row" id="dynamic_section">

                    </div>
                    <div class="form-group">
                        <input type="submit" value="Assign" class="btn btn-primary" id="submit_btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $("#add_btn").hide();
        $("#submit_btn").hide();
        $("#dynamic_section").hide();

        $("#course").change(function(){
            var course_val = $("#course").val();
            if (course_val != '') {
                $("#add_btn").show();
            }else{
                $("#add_btn").hide() && $("#submit_btn").hide() && $("#dynamic_section").empty();
            }
        });

        $("#add_btn").click(function(e){
            e.preventDefault();
            var str = '<div class="col-md-6 cls ">\
                            <input type="text" name="category_name[]"  class="form-control " placeholder="Enter Category Name" id="">\
                        </div>\
                        <div class="col-md-6 cls">\
                            <input type="number" name="category_value[]" class="form-control " placeholder="Enter Category Value" id="">\
                        </div>';

            $("#dynamic_section").append(str);
            $("#dynamic_section").show() && $("#submit_btn").show();

        })

        $("#insert_form").submit(function(e){
            e.preventDefault();
            e.preventDefault();
            var form = $(this);
            var session = $("#session").val();
            var course = $("#course").val();
            var category_name = $("#category_name").val();
            var category_value = $("#category_value").val();

            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/insert_dynamic",
                data : $('#insert_form').serialize(),
                dataType : "json",
                success: function(data)
                {
                    console.log(data);
                }
            });

        })


    })
</script>
@endsection
