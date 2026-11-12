<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $projects = Project::orderBy('order', 'asc')->latest()->get();

        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'category_label' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:50',
            'mock_url' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
            'full_desc' => 'nullable|string',
            'features' => 'nullable|array',
            'tags' => 'nullable|array',
            'hosted_url' => 'nullable|string|max:500',
            'github_url' => 'nullable|string|max:500',
            'gradient' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if (empty($validated['category_label'])) {
            $validated['category_label'] = match ($validated['category']) {
                'webapps' => 'اپلیکیشن وب',
                'js' => 'جاوااسکریپت & API',
                default => 'مینی پروژه',
            };
        }

        if (empty($validated['mock_url'])) {
            $validated['mock_url'] = 'https://iliya.dev/projects/'.str()->slug($validated['title']);
        }

        if (empty($validated['gradient'])) {
            $validated['gradient'] = 'bg-gradient-to-br from-amber-600 via-orange-700 to-slate-900';
        }

        $project = Project::create($validated);

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): ProjectResource
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:50',
            'category_label' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:50',
            'mock_url' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
            'full_desc' => 'nullable|string',
            'features' => 'nullable|array',
            'tags' => 'nullable|array',
            'hosted_url' => 'nullable|string|max:500',
            'github_url' => 'nullable|string|max:500',
            'gradient' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $project->update($validated);

        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return response()->json([
            'message' => 'پروژه با موفقیت حذف شد.',
        ]);
    }
}
