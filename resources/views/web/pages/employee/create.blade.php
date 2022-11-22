@extends('web.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Add Employee</h2>
                <a href="{{ url('/dashboard') }}" class="btn btn-primary" style="float: right">All Employee</a>
            </div>
            <div class="card-body">
                <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Employee Name</label>
                        <input type="text" class="form-control" value="{{ old('employee_name') }}" name="employee_name" >
                        @error('employee_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Employee Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="number" name="phone" class="form-control" value="{{ old('phone') }}" id="" >
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Employee Photo</label>
                        <input type="file" name="photo" class="form-control" id="image">
                        @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <img id="preview-image-before-upload" src=""
                            style="max-height: 250px;">
                    </div>
                    <label for="">Address</label>
                    <div class="form-group">
                        <textarea name="address" class="form-control" id="" cols="10" rows="5">

                        </textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" name="gender" value="1" type="radio" name="gender" id="" checked>
                            <label class="form-check-label" for="">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="0" id="" >
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-block btn-primary" >Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(e){
            $("#image").change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            })
        })
    </script>
@endsection
