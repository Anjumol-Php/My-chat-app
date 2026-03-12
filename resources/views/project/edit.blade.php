<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">
                
                <div class="mb-6 border-b pb-4">
                    <h2 class="text-2xl font-semibold text-gray-800">Edit Project</h2>
                </div>

                <form action="{{ route('project.update', $project->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT') <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Project Name</label>
                        <input type="text" name="title" value="{{ $project->project }}" 
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2.5" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2.5">
                            <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ $project->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('project.index') }}" class="mr-4 text-sm text-gray-600 hover:underline">Cancel</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                            Update Project
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>