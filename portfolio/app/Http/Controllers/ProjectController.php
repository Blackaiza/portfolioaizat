<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('tags')->latest()->get();
        $tags = Tag::all();
        return view('projects.index', compact('projects', 'tags'));
    }

    public function show(Project $project)
    {
        $project->load('tags', 'files');
        return view('projects.show', compact('project'));
    }
}
