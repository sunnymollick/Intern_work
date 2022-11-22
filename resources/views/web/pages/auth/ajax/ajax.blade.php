@extends('web.layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Ajax</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select name="division" class="form-control" id="division">
                            <option value="">Select Division</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <select name="districts" class="form-control" id="districts">
                            <option value="">Choose Districts</option>
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Add Division</h3>
                    </div>
                    <div class="card-body">
                        <form action="" id="form_submit">
                            <div class="form-group">
                                <input type="text" class="form-control" id="div_name" placeholder="Enter Division" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-danger btn-block">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            $("#division").change(function(){
                var division_id = $("#division").val();
                $.ajax({
                    url: "api/get-districts/"+division_id,
                    dataType: 'json',
                    success : function(data){
                        $("#districts").html('<option value="">Choose Districts</option>');
                        var dis_len = data.districts.length;
                        for (var i = 0; i < dis_len; i++) {
                            var str = '<option value="'+data.districts[i].id+'">'+ data.districts[i].name +'</option>';
                            $("#districts").append(str);
                        }
                    }
                });
            });

            $("#form_submit").submit(function(e){
                e.preventDefault();
                var division_name = $("#div_name").val();
                $.ajax({
                    type: "POST",
                    url: "api/insert-division",
                data : {
                        'name' : division_name,
                        },
                dataType : "json",
                success: function(data)
                {
                    if(data.error == false){
                        $("#div_name").val = " ";
                        alert("Successfully inserted "+data.division.name);
                    }

                }
                });
            });
    });


    </script>
@endsection
