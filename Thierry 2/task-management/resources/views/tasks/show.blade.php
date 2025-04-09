<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Task Details') }}
            </h2>
            <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 focus:bg-gray-400 dark:focus:bg-gray-600 active:bg-gray-500 dark:active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Back to Tasks
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <div class="flex justify-between items-start">
                            <h1 class="text-2xl font-bold {{ $task->status === 'completed' ? 'line-through text-gray-500 dark:text-gray-400' : '' }}">
                                {{ $task->title }}
                            </h1>
                            <span class="px-3 py-1 text-sm rounded-full 
                                {{ $task->priority === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 
                                   ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200') }}">
                                {{ ucfirst($task->priority) }} Priority
                            </span>
                        </div>
                        
                        <div class="mt-4">
                            <span class="px-3 py-1 text-sm rounded-full 
                                {{ $task->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                                   ($task->status === 'in-progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200') }}">
                                Status: {{ ucfirst($task->status) }}
                            </span>
                            <span class="ml-4 text-gray-500 dark:text-gray-400">
                                Due: {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-2">Description</h3>
                        <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-md">
                            <p class="whitespace-pre-line">{{ $task->description ?: 'No description provided.' }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-between">
                        <div class="flex space-x-2">
                            <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Edit Task
                            </a>
                        </div>
                        
                        <div class="flex space-x-2">
                            <!-- Status Update Form -->
                            <form method="POST" action="{{ route('tasks.update-status', $task) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                
                                @if($task->status !== 'completed')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Mark as Completed
                                    </button>
                                @else
                                    <input type="hidden" name="status" value="to-do">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Reopen Task
                                    </button>
                                @endif
                            </form>
                            
                            <!-- Delete Form -->
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Delete Task
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                        <p>Created: {{ $task->created_at->format('M d, Y H:i') }}</p>
                        <p>Last Updated: {{ $task->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
