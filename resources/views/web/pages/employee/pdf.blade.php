@extends('web.layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center text-primary">Info of this Employee</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-dark">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Photo</th>
                            <th>Address</th>
                            <th>Gender</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $employee->employee_name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td><img src="{{ asset($employee->photo) }}" height="80px" width="8px" alt="" srcset=""></td>
                                <td>{{ $employee->address }}</td>
                                <td>
                                    @if ($employee->gender == 1)
                                        Male
                                    @else
                                        Female
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
