<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- ഇവിടെ PUT ഉപയോഗിക്കണം --}}
                
                <input type="text" name="title" value="{{ $task->title }}" class="border-gray-300 rounded-md shadow-sm">
                
                <div class="flex flex-wrap gap-4 flex-1">
                    <p>Categories:</p>
                    @foreach($categories as $category)
                        <label class="mr-4">
                            <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                                {{ $task->categories->contains($category->id) ? 'checked' : '' }}>
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>
                
                <x-primary-button>Update Task</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>