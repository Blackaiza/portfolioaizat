<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('tags')->latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.projects.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'explanation' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'role' => 'nullable',
            'what_learned' => 'nullable',
            'tags' => 'array',
            'files.*' => 'file|mimes:pdf,doc,docx,zip,jpg,png'
        ]);

        $project = Project::create($data);
        if ($request->has('tags')) {
            $project->tags()->sync($request->tags);
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('files', 'public');
                $project->files()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created!');
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
        $tags = Tag::all();
        $project->load('tags', 'files');
        return view('admin.projects.edit', compact('project', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'explanation' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'role' => 'nullable',
            'what_learned' => 'nullable',
            'tags' => 'array',
            'files.*' => 'file|mimes:pdf,doc,docx,zip,jpg,png'
        ]);

        $project->update($data);
        if ($request->has('tags')) {
            $project->tags()->sync($request->tags);
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('files', 'public');
                $project->files()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted!');
    }
}
