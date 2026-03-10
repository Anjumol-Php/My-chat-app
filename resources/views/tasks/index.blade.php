<form action="/tasks" method="POST" enctype="multipart/form-data">
    @csrf
    @csrf
    <input type="text" name="title" placeholder="ടാസ്ക് ടൈപ്പ് ചെയ്യൂ" required>
    <input type="file" name="image">
    <button type="submit">Add Task</button>
</form>
</hr>
<h1>എന്റെ ടാസ്ക്കുകൾ</h1>

<ul>
    @foreach($tasks as $task)
        <li>{{ $task->title }}</li>
        <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <input type="file" name="image">
                <button type="submit" style="color:red; cursor:pointer;">Delete</button>
                @if($task->image)
                    <img src="{{ asset('storage/' . $task->image) }}" width="50">
                @endif
            </form> 
    @endforeach
</ul>