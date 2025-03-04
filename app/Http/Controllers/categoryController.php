<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class categoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tasks = Task::query();
            // Filter by category if not "all"
            if (!empty($request->category_id) && $request->category_id !== 'all') {
                $tasks->where('category_id', $request->category_id);
            }

            // Filter by status if not "all"
            if (!empty($request->status) && $request->status !== 'all') {
                $tasks->where('status', $request->status);
            }

            // Get the filtered results
            $tasks = $tasks->get();
            return DataTables::of($tasks)
                ->addColumn('category_name', function ($task) {
                    // Fetch the related category manually
                    $category = Category::where('_id', $task->category_id)->first();
                    return $category ? $category->name : 'N/A';
                })
                ->addColumn('Status', function ($task) {
                    // Dynamically set selected option
                    $pending = $task->status == 'pending' ? 'selected' : '';
                    $completed = $task->status == 'completed' ? 'selected' : '';
                    $inProgress = $task->status == 'in-progress' ? 'selected' : '';

                    return '
                        <select class="form-select status-dropdown task_dropdown_option" data-id="' . $task->_id . '">
                            <option value="pending" ' . $pending . '>Pending</option>
                            <option value="completed" ' . $completed . '>Completed</option>
                            <option value="in-progress" ' . $inProgress . '>In Progress</option>
                        </select>';
                })
                ->addColumn('Actions', function ($task) {
                    return
                        '<button type="button", class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' . $task->_id . '">View</button>
                        <button type="button", class="btn btn-danger delete-button"  data-id="' . $task->_id . '">Delete</button>
                    ';
                })
                ->rawColumns(['category_name', 'Status', 'Actions',])
                ->make(true);
        }
        $categories = Category::all();
        return view('home', [
            'categories' => $categories,
        ]);
    }

    public function add_task(Request $request)
    {
        $task_name = $request->task_name;
        $task_description = $request->task_description;
        $category_id = $request->task_category;
        $task_status = $request->task_status;

        $add_task = Task::create([
            'category_id' => $category_id,
            'title' => $task_name,
            'description' => $task_description,
            'status' => $task_status
        ]);
        if ($add_task) {
            return response()->json([
                'status' => true,
                'message' => 'Task added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Task not added'
            ]);
        }
    }

    public function viewTask(Request $request)
    {
        $task_id = $request->id;
        if ($task_id) {
            $task = Task::with('category')->find($task_id);
            if ($task) {
                return response()->json([
                    'status' => true,
                    'task' => $task
                ]);
            }
        }
    }

    public function save_task(Request $request)
    {
        $task_id = $request->task_id;
        $task_name = $request->task_name;
        $task_description = $request->task_description;
        $category_id = $request->tasks_category;
        $task_status = $request->task_status;

        if ($task_id) {
            $update_task = Task::find($task_id);
            if ($update_task) {
                $update_task->category_id = $category_id;
                $update_task->title = $task_name;
                $update_task->description = $task_description;
                $update_task->status = $task_status;
                if ($update_task->save()) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Task updated successfully'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Task not updated'
                    ]);
                }
            }
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $delete = Task::where('_id', $id)->delete();
        if ($delete) {
            return response()->json([
                'status' => true,
                'message' => 'Deleted',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Not delete',
            ]);
        }
    }

    public function status_change(Request $request)
    {
        $task_status = $request->task_value;
        $task_id = $request->task_id;
        if ($task_status) {
            $task_update = Task::where('_id', $task_id)->update(['status' => $task_status]);
            if ($task_update) {
                return response()->json([
                    'status' => true,
                    'message' => 'Task status updated',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Task status not updated',
                ]);
            }
        }
    }
}
