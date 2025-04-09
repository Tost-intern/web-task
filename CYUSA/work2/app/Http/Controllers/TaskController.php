<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    public function markAsCompleted(Task $task)
    {
        $task->update(['completed' => true]);
        return redirect()->route('tasks.index')->with('success', 'Task marked as completed.');
    }
}