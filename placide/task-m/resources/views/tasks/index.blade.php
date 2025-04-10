<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tasks') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create Task
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Search and Filter -->
                    <div class="mb-6 flex flex-col md:flex-row justify-between gap-4">
                        <div class="flex space-x-2">
                            @foreach (['' => 'All', 'to-do' => 'To Do', 'in-progress' => 'In Progress', 'completed' => 'Completed'] as $key => $label)
                                <a href="{{ route('tasks.index', ['status' => $key]) }}" class="px-3 py-2 rounded-md {{ request('status') === $key ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700' }}">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>

                        <form method="GET" action="{{ route('tasks.index') }}" class="flex">
                            <input type="text" name="search" placeholder="Search tasks..." value="{{ request('search') }}" class="rounded-l-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            <button type="submit" class="rounded-r-md border border-l-0 border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-4 text-gray-700 dark:text-gray-300">
                                Search
                            </button>
                        </form>
                    </div>

                    <!-- Flash Message -->
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Tasks List -->
                    @if ($tasks->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">No tasks found. Create your first task!</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($tasks as $task)
                                <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200 
                                    {{ $task->status === 'completed' ? 'border-green-500 dark:border-green-700' : 
                                       ($task->status === 'in-progress' ? 'border-yellow-500 dark:border-yellow-700' : 'border-gray-300 dark:border-gray-700') }}">
                                    <div class="p-4 bg-white dark:bg-gray-800">
                                        <div class="flex justify-between items-start">
                                            <h3 class="text-lg font-semibold {{ $task->status === 'completed' ? 'line-through text-gray-500' : '' }}">
                                                {{ $task->title }}
                                            </h3>
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                {{ $task->priority === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 
                                                   ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200') }}">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </div>

                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ Str::limit($task->description, 100) }}
                                        </p>

                                        <div class="mt-4 flex justify-between items-center text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">
                                                Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                            </span>
                                            <span class="px-2 py-1 rounded-full text-xs
                                                {{ $task->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                                                   ($task->status === 'in-progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200') }}">
                                                {{ ucfirst($task->status) }}
                                            </span>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="mt-4 flex justify-end gap-2">
                                            <a href="{{ route('tasks.edit', $task) }}" class="px-3 py-1 text-xs text-white  bg-red-600  hover:bg-yellow-600 rounded">
                                                Edit
                                            </a>

                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 text-xs text-white bg-red-600 hover:bg-red-700 rounded">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
