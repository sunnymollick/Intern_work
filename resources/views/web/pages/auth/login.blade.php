@extends('web.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Login</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" id="">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="col-md-12">
                        <button type="submit" class="btn  btn-success btn-block">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
