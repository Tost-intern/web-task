<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all tasks associated with the authenticated user, ordered by the most recent
        $tasks = auth()->user()->tasks()->latest()->get();

        // Return the 'tasks.index' view with the tasks data
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Return the view to create a new task
        return view('tasks.create');
    }

    /**
     * Store a newly created task in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in progress,completed',
        ]);

        // Create the task for the authenticated user
        auth()->user()->tasks()->create($request->all());

        // Redirect back to the tasks index with a success message
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        // Ensure the user has authorization to edit the task
        try {
            $this->authorize('update', $task);
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access: You cannot edit this task.');
        }

        // Return the view to edit the task
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        // Ensure the user has authorization to update the task
        try {
            $this->authorize('update', $task);
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access: You cannot update this task.');
        }

        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to-do,in progress,completed',
        ]);

        // Update the task with the new data
        $task->update($request->only(['title', 'description', 'due_date', 'priority', 'status']));

        // Redirect back to the tasks index with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from the database.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        // Ensure the user has authorization to delete the task
        try {
            $this->authorize('delete', $task);
        } catch (AuthorizationException $e) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access: You cannot delete this task.');
        }

        // Delete the task
        $task->delete();

        // Redirect back to the tasks index with a success message
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
