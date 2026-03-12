<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">
                
                <div class="mb-6 border-b pb-4 flex justify-between items-center">
                    <h2 class="text-2xl font-semibold text-gray-800">Add New Project</h2>
                    <a href="{{ route('project.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to List</a>
                </div>

                <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Project Name</label>
                        <input type="text" name="title" id="title" 
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2.5" 
                            placeholder="Enter project title" required>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2.5">
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="reset" class="mr-6 text-sm text-gray-600 hover:underline">Clear</button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-black font-bold py-2 px-6 rounded-lg transition duration-200 shadow-md">
                            Create Project
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
