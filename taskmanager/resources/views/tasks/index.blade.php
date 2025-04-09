<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>View Registered Tasks</title>

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-4">
            <h1 class="text-center mb-4">Registered Tasks</h1>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Task Table -->
            @if(isset($tasks) && $tasks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($task->status == 'completed') bg-success 
                                            @elseif($task->status == 'in progress') bg-warning 
                                            @else bg-secondary @endif">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($task->priority == 'high') bg-danger 
                                            @elseif($task->priority == 'medium') bg-warning 
                                            @else bg-primary @endif">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td>{{ $task->due_date ?? 'N/A' }}</td>
                                    <td>
                                        <!-- Edit Task Link -->
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        
                                        <!-- Delete Task Form -->
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted">No tasks found.</p>
            @endif

            <!-- Add New Task Button -->
            <div class="text-center mt-3">
                <a href="{{ route('tasks.create') }}" class="btn btn-success">Add New Task</a>
            </div>
        </div>

        <!-- Bootstrap 5 JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
</x-app-layout>
