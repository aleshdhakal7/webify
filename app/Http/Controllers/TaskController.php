<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['assignedTo', 'assignedBy'])->paginate(10);
        return view('Task.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::all();
        return view('Task.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => $validated['user_id'],
            'assigned_by' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function show(Task $task)
    {
        return view('Task.view', compact('task'));
    }

    public function edit(Task $task)
    {
        $users = User::all();
        return view('Task.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => $validated['user_id'],
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
