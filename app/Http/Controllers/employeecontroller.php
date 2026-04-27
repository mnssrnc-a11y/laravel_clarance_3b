<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;

class employeecontroller extends Controller
{
    public function index()
    {
        $employees = employee::all();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname'   => 'required|max:255',
            'lname'   => 'required|max:255',
            'midname' => 'required|max:255',
            'age'     => 'required',
            'address' => 'required|max:255',
            'zip'     => 'required',
        ]);

        employee::create($request->all());
        return redirect()->route('employee.index')->with('status', 'Employee Added Successfully!');
    }

    public function edit(int $id)
    {
        $employee = employee::findOrFail($id);
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'fname'   => 'required|max:255',
            'lname'   => 'required|max:255',
            'midname' => 'required|max:255',
            'age'     => 'required',
            'address' => 'required|max:255',
            'zip'     => 'required',
        ]);

        employee::findOrFail($id)->update($request->all());
        return redirect()->back()->with('status', 'Employee Updated Successfully!');
    }

    public function destroy(int $id)
    {
        $employee = employee::findOrFail($id);
        $employee->delete();
        return redirect()->back()->with('status', 'Employee Deleted');
    }
}
