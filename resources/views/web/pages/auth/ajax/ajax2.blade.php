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
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center text-warning">Insert Division</h3>
                </div>
                <div class="card-body">
                    <form action="" id="insert_form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="division_name" required>
                        </div>
                        <br>
                        <button class="btn btn-block btn-success" type="submit">Add</button>
                    </form>
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
                    url: 'api/get-districts/'+division_id,
                    dataType: 'json',
                    success:function(data){
                        $("#districts").html('<option value="">Choose Districts</option>');
                        var dis_len = data.districts.length;
                        for (var index = 0; index < dis_len; index++) {
                            var str = '<option value="'+data.districts[index].id+'">'+data.districts[index].name+'</option>';
                            $("#districts").append(str);

                        }
                    }
                });
            });

            $("#insert_form").submit(function(e){
                e.preventDefault();
                var division_name = $("#division_name").val();
                $.ajax({
                    url: 'api/insert-division',
                    type: "POST",
                    data:{
                        'name' : division_name,
                    },
                    dataType : 'json',
                    success:function(data){
                        alert("successfully inserted");
                    }
                });
            });
        })
    </script>
@endsection
