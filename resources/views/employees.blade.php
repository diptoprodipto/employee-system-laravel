@extends('layout')

@section('content')
<div>
    <div class="container mt-5">
        <h2 style="margin-top: 100px;">Employee Information</h2>

        <form action="/employee" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    Employee Name:<br>
                    <input type="text" name="name" @if (isset($edit_emp)) value="{{$edit_emp->name}}" @endif />
                </div>
                <div class="col-md-3">
                    Designation:<br>
                    <input type="text" name="designation" @if (isset($edit_emp)) value="{{$edit_emp->designation}}" @endif />
                </div>
                <div class="col-md-2">
                    Role:<br>
                    <select name="role" id="role" @if (isset($edit_emp)) value="{{$edit_emp->role}}" @endif>
                        <option @if (isset($edit_emp)) @if ($edit_emp->role == 1) selected @endif @endif value="1">Admin</option>
                        <option @if (isset($edit_emp)) @if ($edit_emp->role == 2) selected @endif @endif value="2">Dev</option>
                        <option @if (isset($edit_emp)) @if ($edit_emp->role == 3) selected @endif @endif value="3">User</option>
                    </select>
                </div>
                <div class="col-md-2">
                    Email:<br>
                    <input type="email" name="email" @if (isset($edit_emp)) value="{{$edit_emp->email}}" @endif />
                </div>
                <div class="col-md-2">
                    Phone:<br>
                    <input type="text" name="phone" @if (isset($edit_emp)) value="{{$edit_emp->phone}}" @endif />
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-lg-3">
                    Salary:<br>
                    <input type="text" name="salary" @if (isset($edit_emp)) value="{{$edit_emp->salary}}" @endif />
                </div>
                <div class="col-lg-3">
                    Status:<br>
                    <input type="radio" id="not-resigned" name="status" onclick="checkStatus(this)" value="0" checked />Not Resigned
                    <input type="radio" id="resigned" name="status" onclick="checkStatus(this)" value="1" />Resigned
                </div>
                <div class="col-lg-3">
                    Resignation Date:<br>
                    <input type="datetime-local" id="resignation_date" name="resignation_date" disabled/>
                </div>
                <div class="col-lg-3">
                    Password:<br>
                    <input type="password" id="password" name="password" @if (isset($edit_emp)) value="{{$edit_emp->password}}" @endif />
                </div>
            </div>
            <div class="mt-4">
                <input type="submit" class="btn btn-info bg-primary" name="save" value="submit">
            </div>
        </form>

    </div>

    <div class="container mt-5">
        <h2>Employees</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Resignation Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->designation }}</td>
                    <td>{{ $employee->role }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>{{ $employee->status }}</td>
                    <td>{{ $employee->resignation_date }}</td>
                    <td><a class="btn btn-info" href={{ route('employee.edit', ['id' => $employee->id]) }}>Edit</a>&nbsp;
                    <!-- <form style="display:inline" action={{ route('employee.delete', ['id' => $employee->id]) }} method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="deleteRecordAlert(this)" class="btn btn-danger">Delete</button>
                    </form> -->
                        <button id={{$employee->id}} onclick="deleteRecordAlert(this)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>
    <div class="container">
        <a class="btn btn-success" href="/attendance">Attendance</a>
    </div>
        
</div>
@endsection