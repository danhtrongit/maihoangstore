<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::active()->withCount('projects')->orderBy('sort_order')->get();
        $projects = Project::active()->with('projectCategory')->latest()->paginate(12);
        $category = request('category');

        if ($category) {
            $cat = ProjectCategory::where('slug', $category)->firstOrFail();
            $projects = $cat->projects()->active()->with('projectCategory')->latest()->paginate(12);
        }

        return view('projects.index', compact('projects', 'categories', 'category'));
    }

    public function show(Project $project)
    {
        $relatedProjects = Project::active()
            ->where('id', '!=', $project->id)
            ->where('project_category_id', $project->project_category_id)
            ->take(4)->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }
}
