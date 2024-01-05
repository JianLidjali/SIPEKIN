<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data = Employee::orderBy('department')->get();
        
        return view('pages.employee.index', compact('data'));
    }
    public function create()
    {
        return view('pages.employee.create');
    }
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = Employee::create($request->all());
 
            return redirect()->route('employee.index')->with('success', 'Data created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function edit(Employee $employee)
    {

        return view('pages.employee.edit', compact('employee'));
    }
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            $employee->name = $request->name;
            $employee->staffIdentityCardNo = $request->staffIdentityCardNo;
            $employee->department = $request->department;
            $employee->position = $request->position;
            $employee->dateJoined = $request->dateJoined;
            $employee->dateInThePresentPosition = $request->dateInThePresentPosition;
            $employee->update();
            return redirect()->route('employee.index')->with('success', 'Data updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function destroy(Employee $employee)
    {

        if ($employee->user) {
            $employee->user->delete();
        }
        return redirect()->route('employee.index')->with('success', 'Data deleted successfully');
    }
    public function export()
    {
        $employee = Employee::orderBy('department')->get();
        return Excel::download(new EmployeeExport($employee), 'Daftar Karyawan.xlsx');
    }
}
