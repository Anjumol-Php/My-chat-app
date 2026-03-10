<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;

class TestController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->with('categories')->get();
        $categories = \App\Models\Category::all();
        return view('dashboard', compact('tasks', 'categories'));
        // $tasks = auth()->user()->tasks()->with('categories')->get();
        // $categories = \App\Models\Category::all();
        // return view('tasks.index', compact('tasks','categories'));
    }
   public function store(Request $request)
    {
        
    $request->validate([
        'title' => 'required',
        'image' => 'nullable|image|max:2048',
        'category_ids' => 'nullable|array', // ഇതൊരു array ആയിരിക്കണം
        'category_ids.*' => 'exists:categories,id', // കാറ്റഗറി ഡാറ്റാബേസിൽ ഉണ്ടോ എന്ന് നോക്കുന്നു
    ]);
     $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tasks', 'public');
        }

    // ടാസ്ക് സേവ് ചെയ്യുന്നു
    $task = auth()->user()->tasks()->create([
        'title' => $request->title,
        'image' => $imagePath, // (നേരത്തെ ഉള്ള കോഡ് ഇവിടെ വരണം)
    ]);

    // കാറ്റഗറി അറ്റാച്ച് ചെയ്യുന്നു
    if ($request->has('category_ids')) {
        $task->categories()->attach($request->category_ids);
    }

        return back();
    }
    public function destroy($id)
    {
        // ഐഡി വെച്ച് ടാസ്ക് കണ്ടുപിടിച്ച് ഡിലീറ്റ് ചെയ്യുന്നു
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back();
    }
    public function filter(Category $category)
    {
        // ആ കാറ്റഗറിയിലുള്ള ടാസ്ക്കുകൾ മാത്രം എടുക്കുന്നു
        $tasks = $category->tasks()->where('user_id', auth()->id())->get();
        $categories = Category::all();

        return view('dashboard', compact('tasks', 'categories'));
    }
    // എഡിറ്റ് പേജ് കാണിക്കാൻ
    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories'));
    }
    // മാറ്റങ്ങൾ സേവ് ചെയ്യാൻ
    public function update(Request $request, Task $task)
    {
        \DB::enableQueryLog();
        $request->validate([
            'title' => 'required',
            'category_ids' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ]);
        $imagePath = $task->image;
        if ($request->hasFile('image')) {
        // പഴയ ഫയൽ സ്റ്റോറേജിൽ ഉണ്ടെങ്കിൽ അത് ഡിലീറ്റ് ചെയ്യണം
        if ($task->image) {
            \Storage::disk('public')->delete($task->image);
        }
        // പുതിയ ഫയൽ സേവ് ചെയ്യുന്നു
        $imagePath = $request->file('image')->store('tasks', 'public');
    }
        $task->update([
            'title' => $request->title,
            'image' => $imagePath,
        ]);
        $task->categories()->sync($request->category_ids);
        //dd(\DB::getQueryLog());
        return redirect()->route('dashboard')->with('success', 'Task updated!');
    }
}
