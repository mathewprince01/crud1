@extends('layout.app')
@section('title', 'employee list')
@section('main')

    <div class="card">
        <div class="card-header d flex justify-content-between">
            <h3>Employee List</h3>
            <a href="{{ route('emp.create') }}" class="btn btn-primary">Add New</a>
        </div>
        <div class="card-body">
            <table class="table table-responsive table-bordered w-100">
                <tr class="bg-dark text-light">
                    <th>S.NO</th>
                    <th>Employee Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Date Of Join</th>
                    <th>Department</th>
                    <th>Skills</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Profile Image</th>
                    <th>Action</th>
                </tr>
                 <tbody>
                @foreach ($employees as $employee )
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$employee->employee_id}}</td>
                    <td>{{$employee->name}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->phonenumber}}</td>
                        <td>{{$employee->dateofjoin}}</td>
                        <td>{{$employee->department}}</td>
                        <td>{{$employee->skills}}</td>
                        <td>{{$employee->address}}</td>
                        <td>{{$employee->country->name}}</td>
                        <td>{{$employee->city->name}}</td>
                        <td><img src="{{ asset('storage/' . $employee->profile_image) }}"alt="image" class="img-responsive img-thumbnail" width="100px" height="100px"></td>

                        <td class="d-flex gap-2">
                            <a href="{{route('emp.edit',$employee->id)}}" class="btn btn-warning">Edit</a>
                            <form action="{{route('emp.destroy',$employee->id)}}" method="POST" onsubmit="return confirm('Are you sure')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                </tbody>

                @endforeach
            </table>
        </div>
    </div>
@endsection
