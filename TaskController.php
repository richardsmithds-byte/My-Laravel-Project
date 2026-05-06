<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $query = Task::where('user_id', Auth::id())
                     ->where('archived', false);

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($status === 'completed') {
            $query->where('completed', true);
        } elseif ($status === 'pending') {
            $query->where('completed', false);
        }

        $tasks = $query->latest()->paginate(5);

        return view('index', compact('tasks'));
    }


    public function store(StoreTaskRequest $request)
    {

        Task::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')
        ->with('success', 'Task created successfully!');
    }


    public function edit(Task $task)
    {
        $this->authorize('view', $task);

        return view('edit-task', compact('task'));
    }

    public function done(Task $task)
{
    $this->authorize('update', $task);

    $task->update([
        'completed' => true
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Task marked as completed!',
        'task_id' => $task->id
        ]);
}


    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update([
            'name' => $request->name,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }


    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }


    public function archive()
    {
        $tasks = Task::where('user_id', Auth::id())
                     ->where('archived', true)
                     ->latest()
                     ->get();

        return view('archive', compact('tasks'));
    }


    public function archiveTask(Task $task)
    {
        $this->authorize('update', $task);

        $task->update([
            'archived' => true
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task archived successfully!');
    }


    public function restore(Task $task)
    {
        $this->authorize('update', $task);

        $task->update([
            'archived' => false
        ]);

        return redirect()->route('tasks.archive')
            ->with('success', 'Task restored successfully!');
    }


    public function forceDelete(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.archive')
            ->with('success', 'Task permanently deleted!');
    }

};