<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div class="p-6 text-gray-900">
                    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="mb-4"> 
                        @csrf
                        <div class="flex flex-wrap items-end gap-4 mb-4">
                            <div class="flex-1 min-w-[200px]">
                                <label class="block text-sm font-medium text-gray-700">Task Name</label>
                                <input type="text" name="title" placeholder="എന്താണ് പരിപാടി?" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>

                            <div class="flex-1 min-w-[200px]">
                                <p class="text-sm font-medium text-gray-700 mb-1">Categories:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($categories as $category)
                                        <label class="inline-flex items-center text-sm">
                                            <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            <span class="ml-2">{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex-1 min-w-[200px]">
                                <label class="block text-sm font-medium text-gray-700">Image</label>
                                <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>

                            <div class="flex-none">
                                <x-primary-button class="h-10">Add Task</x-primary-button>
                            </div>
                        </div>
                       
                    </form>

                    <hr class="my-4">

                    <ul class="list-disc pl-5 flex items-end gap-4 ">
                        @foreach(auth()->user()->tasks as $task)
                            <li class="mb-2 flex-1">
                                <span style="{{ $task->completed ? 'text-decoration: line-through;' : '' }}">
                                    {{ $task->title }}
                                </span>
                                
                                @foreach($task->categories as $category)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                        {{ $category->name }}
                                    </span>
                                @endforeach

                                @if($task->image)
                                    <img src="{{ asset('storage/' . $task->image) }}" width="50" class="inline ml-2">
                                @endif
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 text-sm ml-2">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 text-sm">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
