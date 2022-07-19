<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function index() {
        $today_date = date('Y-m-d');
        $emp_all = DB::select('SELECT * FROM attendances a JOIN employees e ON a.employee_id=e.id WHERE date=?;', [$today_date]);
        if(count($emp_all) == 0) {
            $emp_abs = DB::select('SELECT * FROM employees;');
        } else {
            $emp_abs = DB::select('SELECT * FROM employees e WHERE e.id NOT IN (SELECT employee_id FROM attendances WHERE date=?);', [$today_date]);
        }
        return view('attendance', [
            "absent_emp" => $emp_abs,
            "emp_res" => $emp_all
        ]);
    }

    public function store(Request $request) {
        $data = $request->input();
        $data = $data['singleData'];
        $employee_id = $data[0];
        $employee_name = $data[1];
        $date = $data[2];
        $working_status = $data[3];

        // $attendance = Attendance::where('employee_id', '=', $employee_id, 'and')->where('date', '=', $date)->get();

        try {
            $attendance = Attendance::updateOrCreate(
                ['employee_id' => $employee_id, 'date' => $date],
                ['date' => $date, 'working_status' => $working_status]
            );
            return response()->json([
                'message' => 'success'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function store_all(Request $request) {
        $today_date = date('Y-m-d');
        try {
            $tableData = $request->input('tableData');

            foreach ($tableData as $data) {
                Attendance::updateOrCreate(
                    ['employee_id' => $data['employee_id'], 'date' => $today_date],
                    ['working_status' => $data['working_status']]
                );
            }
            
            return response()->json([
                'message' => 'success'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage() 
            ]);
        }
    }
}
