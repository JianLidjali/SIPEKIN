<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data = Employee::all();
        return view('pages.employee.index', compact('data'));
    }
    public function create()
    {
        return view('pages.employee.create');
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'staffIdentityCardNo' => 'required',
            'department' => 'required',
            'position' => 'required',
            'dateJoined' => 'required',
            'dateInThePresentPosition' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            $employee = new Employee($request->all());
            dd('Data created successfully');
            return redirect()->route('employee.index')->with('success', 'Data created successfully');
        } catch (\Throwable $th) {
            return dd($th->getMessage());
            return redirect()->back()->with(['error', $th->getMessage()]);
        }
    }
}
