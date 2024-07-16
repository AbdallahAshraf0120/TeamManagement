<?php

namespace wdd\teammanagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use wdd\teammanagement\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('wdd/teammanagement::admin.employees.index', compact('employees'));
    }

    public function add()
    {
        return view('wdd/teammanagement::admin.employees.create');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:employees',
            'password' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:1024',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ]);
        } else {
            $employee = new Employee();

            $filename = "";
            if ($request->file('image')) {
                $filename = $request->file('image')->store('employee', 'public');
            }

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->dob = $request->dob;
            $employee->city = $request->city;
            $employee->phone = $request->phone;
            $employee->password = Hash::make($request->password);
            $employee->image = $filename;

            $result = $employee->save();
            if ($result) {
                return response()->json([
                    "success" => true,
                    'message' => [
                        'Employee created successfully'
                    ]
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    'message' => [
                        'Failed to create employee'
                    ]
                ]);
            }
        }
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('wdd.teammanagement::admin.employees.update', compact('employee'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:1024',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ]);
        } else {
            $employee = Employee::findOrFail($request->id);

            $filename = $employee->image; // Default to current image
            if ($request->hasFile('image')) {
                // Delete old image
                $path = public_path('storage/' . $employee->image);
                if (File::exists($path)) {
                    File::delete($path);
                }
                // Store new image
                $filename = $request->file('image')->store('employee', 'public');
            }

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->dob = $request->dob;
            $employee->city = $request->city;
            $employee->phone = $request->phone;
            $employee->image = $filename;

            $result = $employee->save();
            if ($result) {
                return response()->json([
                    "success" => true,
                    'message' => [
                        'Employee updated successfully'
                    ]
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    'message' => [
                        'Failed to update employee'
                    ]
                ]);
            }
        }
    }

    public function delete(Request $request)
    {
        $employee = Employee::findOrFail($request->id);
        $path = public_path('storage/' . $employee->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        $result = $employee->delete();
        if ($result) {
            return response()->json([
                "success" => true,
                'message' => [
                    'Employee deleted successfully'
                ]
            ]);
        } else {
            return response()->json([
                "success" => false,
                'message' => [
                    'Failed to delete employee'
                ]
            ]);
        }
    }
}
