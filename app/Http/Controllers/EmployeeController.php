<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('pages.employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = null;
        return view('pages.employee.create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'mobile'    => 'required',
            'image'     => 'mimes:jpeg,png',
        ]);

        if(!empty($request->file('image')))
        {
            $file = $request->file('image') ;
            $image = time() . '.' . $file->getClientOriginalExtension() ;
            $destinationPath = public_path().'/images/employees/' ;
            $file->move($destinationPath,$image);
        }
        else {
            $image = 'avatar.jpg';
        }

        $employee = new Employee;
        $employee->create([
            'address'      => $request->address,
            'name'   => $request->name,
            'mobile'   => $request->mobile,
            'dob'   => $request->dob,
            'email'   => $request->email,
            'joining_date'   => $request->joining_date,
            'gender'   => $request->gender,
            'nid'   => $request->nid,
            'image'  => $image,
        ]);

        return redirect()
                    ->route('employee.index')
                    ->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('pages.employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('pages.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'      => 'required|string',
            'mobile'    => 'required',
            'image'     => 'mimes:jpeg,png',
        ]);

        if(!empty($request->file('image')))
        {
            $file = $request->file('image') ;
            $image = time() . '.' . $file->getClientOriginalExtension() ;
            $destinationPath = public_path().'/images/products/' ;
            $file->move($destinationPath,$image);
        }
        else {
            $image = $request->oldimage;
        }

        $employee->update([
            'address'      => $request->address,
            'name'   => $request->name,
            'mobile'   => $request->mobile,
            'dob'   => $request->dob,
            'email'   => $request->email,
            'joining_date'   => $request->joining_date,
            'gender'   => $request->gender,
            'nid'   => $request->nid,
            'image'  => $image,
        ]);

        return redirect()
                    ->route('employee.index')
                    ->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
                    ->route('employee.index')
                    ->with('success','Deleted Successfully');
    }
}
