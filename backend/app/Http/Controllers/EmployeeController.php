<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        
        return view('auth.employees.index', compact('employees'));
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        
        return view('auth.employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        
        return view('auth.employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:employees,name,' . $employee->id,
            'password' => 'nullable|string|min:3|confirmed',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->only(['name', 'address', 'phone_number']);
        
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }
        
        if ($request->hasFile('profile_image')) {
            if ($employee->profile_image) {
                $oldImagePath = storage_path('app/public/' . $employee->profile_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $image = $request->file('profile_image');
            $imageName = 'profile_' . $employee->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('profile_images', $imageName, 'public');
            $data['profile_image'] = $path;
        }
        
        // Update using mass assignment
        $employee->update($data);
        
        return redirect()->route('employees.show', $employee->id)->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
