<?php

namespace wdd\teammanagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use wdd\teammanagement\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();
        return view('wdd/teammanagement::admin.departments.index', compact('departments'));
    }

    public function add()
    {
        
        return view('wdd/teammanagement::admin.departments.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ]);
        } else {
            $department = new Department();
            $department->name = $request->name;
            $department->save();

            return response()->json([
                'success' => true,
                'message' => ['Department added successfully']
            ]);
        }
    }


    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('wdd/teammanagement::admin.departments.update', compact('department'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ]);
        } else {
            $department = Department::findOrFail($request->id);
            $department->name = $request->name;
            $department->save();

            return response()->json([
                'success' => true,
                'message' => ['Department updated successfully']
            ]);
        }
    }

    public function delete(Request $request)
    {
        $department = Department::findOrFail($request->id)->delete();
        return response()->json([
            'success' => true,
            'message' => ['Department deleted successfully']
        ]);
    }
}
