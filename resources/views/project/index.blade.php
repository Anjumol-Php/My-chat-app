<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">My Projects</h2>
                    <form action="{{ route('project.index') }}" method="GET" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Search projects..." 
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                        
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm">
                            Search
                        </button>
                        
                        @if(request('search'))
                            <a href="{{ route('project.index') }}" class="text-sm text-red-500 mt-2 hover:underline">Clear</a>
                        @endif
                    </form>
                    <a href="{{ route('project.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-sm transition">
                        + Add Project
                    </a>
                </div>
                 @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="p-3 border">ID</th>
                            <th class="p-3 border">Project Name</th>
                            <th class="p-3 border">Status</th>
                            <th class="p-3 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($project as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ $item->id }}</td>
                            <td class="p-3 border font-semibold">{{ $item->project }}</td>
                            <td class="p-3 border">
                                <span class="px-2 py-1 rounded text-xs {{ $item->status == 'Completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="p-3 border flex gap-2">
                                <a href="{{ route('project.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                
                                <form action="{{ route('project.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $project->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>