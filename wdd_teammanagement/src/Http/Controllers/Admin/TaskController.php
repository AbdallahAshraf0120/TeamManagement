<?php

namespace wdd\teammanagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use wdd\teammanagement\Models\Employee;
use wdd\teammanagement\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('wdd/teammanagement::admin.tasks.index', compact('tasks'));
    }

    public function add()
    {
        $employees = Employee::latest()->get();
        return view('wdd.teammanagement::admin.tasks.create', compact('employees'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'employee' => 'required',
            'content' => 'required',
            'status' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ]);
        } else {
            $task = new Task();

            $task->title = $request->title;
            $task->content = $request->content;
            $task->emp_id = $request->employee;
            $task->date = $request->date;
            $task->status = $request->status;

            $result = $task->save();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => ['Task added successfully']
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => ['Failed to add task']
                ]);
            }
        }
    }

    public function delete(Request $request)
    {
        $result = Task::findOrFail($request->id)->delete();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => ['Task deleted successfully']
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => ['Failed to delete task']
            ]);
        }
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $employees = Employee::latest()->get();
        return view('wdd.teammanagement::admin.tasks.update', compact('task', 'employees'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'employee' => 'required',
            'content' => 'required',
            'status' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ]);
        } else {
            $task = Task::findOrFail($request->id);
            $task->title = $request->title;
            $task->content = $request->content;
            $task->emp_id = $request->employee;
            $task->date = $request->date;
            $task->status = $request->status;

            $result = $task->save();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => ['Task updated successfully']
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => ['Failed to update task']
                ]);
            }
        }
    }
}
