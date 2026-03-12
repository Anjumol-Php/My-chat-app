<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $project = Project::where('user_id', auth()->id())
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                $q->where('project', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5);

        return view('project.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|max:255',
        'status' => 'required',
        ]);
        Project::create([
            'project'    => $request->title,      
            'user_id' => auth()->id(),         
            'status'  => $request->status,     
        ]);
        return redirect()->route('project.index')->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        if($project->user_id !== auth()->id()){
            abort(403);
        }
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
        'title' => 'required|max:255',
        'status' => 'required',
        ]);

        $project->update([
            'project' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->route('project.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->back();
    }
}
