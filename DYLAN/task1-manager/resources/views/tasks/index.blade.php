@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task Dashboard</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add New Task</a>

    @foreach ($tasks as $task)
        <div class="card mb-2">
            <div class="card-body">
                <h5>{{ $task->title }} @if($task->completed) ✅ @endif</h5>
                <p>{{ $task->description }}</p>
                <p><strong>Due:</strong> {{ $task->due_date }}</p>
                <p><strong>Priority:</strong> {{ ucfirst($task->priority) }}</p>

                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-secondary">Edit</a>

                @if(!$task->completed)
                    <form action="{{ route('tasks.complete', $task) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-success">Mark as Completed</button>
                    </form>
                @endif

                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
