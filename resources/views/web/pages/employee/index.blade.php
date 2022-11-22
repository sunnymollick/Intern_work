@extends('web.layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">All Employee</h3>
                <a href="{{ route('logout') }}" class="btn btn-danger" >Logout</a>
                <a href="{{ route('employee.create') }}" class="btn btn-dark" style="float: right">Add Employee</a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="myTable">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Address</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($employee as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->employee_name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td><img src="{{ asset($row->photo) }}" alt="" srcset="" height="100" width="100"></td>
                                <td>{{ $row->address }}</td>
                                <td>
                                    @if ($row->gender == 1)
                                        Male
                                    @else
                                        Female
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('downloadById.pdf',$row->id) }}" class="btn btn-warning btn-sm">Download pdf</a>
                                    <a href="{{ route('employee.edit',$row->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form action="{{ route('employee.delete',$row->id) }}">
                                        @csrf
                                        <button type="submit" class="show_confirm btn btn-danger btn-sm" id="delete" value="Delete" >Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
