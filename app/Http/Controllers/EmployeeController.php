<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::all();
        return view('employees', [
            'employees' => $employees
        ]);
    }

    public function store(Request $request) {

        $data = [
            'name'             => $request->input('name'),
            'designation'      => $request->input('designation'),
            'role'             => $request->input('role'),
            'email'            => $request->input('email'),
            'phone'            => $request->input('phone'),
            'salary'           => $request->input('salary'),
            'status'           => $request->input('status'),
            'resignation_date' => $request->input('resignation_date') ?? NULL,
            'password'         => $request->input('password')
        ];

        if (Employee::where('email', $request->input('email'))->exists()) {
            Employee::where('email', $request->input('email'))->update($data);
        } else {
            $emp = Employee::create($data);
        }

        return redirect('/employee');
    }

    public function edit($id) {
        $employees = Employee::all();
        $edit_emp = Employee::find($id);
        return view('employees', [
            'employees' => $employees,
            'edit_emp'  => $edit_emp
        ]);
    }

    public function destroy($id) {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('/employee');
    }
}
