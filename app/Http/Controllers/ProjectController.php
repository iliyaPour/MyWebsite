<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

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
     * Upload a project screenshot/image.
     */
    public function uploadImage(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            ]);

            $file = $request->file('image');
            $fileName = 'project_'.time().'_'.str()->random(8).'.'.$file->getClientOriginalExtension();
            $targetDir = public_path('images/projects');

            if (! file_exists($targetDir)) {
                @mkdir($targetDir, 0775, true);
            }

            if (! is_writable($targetDir)) {
                @chmod($targetDir, 0775);
            }

            $file->move($targetDir, $fileName);

            $imageUrl = '/images/projects/'.$fileName;

            return response()->json([
                'message' => 'تصویر با موفقیت بارگذاری شد.',
                'url' => $imageUrl,
            ]);
        } catch (ValidationException $ve) {
            return response()->json([
                'message' => $ve->getMessage(),
                'errors' => $ve->errors(),
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'خطا در بارگذاری تصویر: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'required|string|max:50',
                'category_label' => 'nullable|string|max:100',
                'icon' => 'nullable|string|max:50',
                'image' => 'nullable',
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

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = 'project_'.time().'_'.str()->random(8).'.'.$file->getClientOriginalExtension();
                $targetDir = public_path('images/projects');
                if (! file_exists($targetDir)) {
                    @mkdir($targetDir, 0775, true);
                }
                $file->move($targetDir, $fileName);
                $validated['image'] = '/images/projects/'.$fileName;
            }

            if (! empty($validated['image']) && is_string($validated['image']) && ! str_starts_with($validated['image'], 'http') && ! str_starts_with($validated['image'], '/')) {
                $validated['image'] = '/'.$validated['image'];
            }

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

            if (! Schema::hasColumn('projects', 'image')) {
                Schema::table('projects', function (Blueprint $table) {
                    $table->string('image')->nullable()->after('icon');
                });
            }

            $project = Project::create($validated);

            return (new ProjectResource($project))
                ->response()
                ->setStatusCode(201);
        } catch (ValidationException $ve) {
            return response()->json([
                'message' => 'اطلاعات وارد شده معتبر نیست.',
                'errors' => $ve->errors(),
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Project store error: '.$e->getMessage());

            return response()->json([
                'message' => 'خطا در ثبت پروژه: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): JsonResponse|ProjectResource
    {
        try {
            $validated = $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'category' => 'sometimes|required|string|max:50',
                'category_label' => 'nullable|string|max:100',
                'icon' => 'nullable|string|max:50',
                'image' => 'nullable',
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

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = 'project_'.time().'_'.str()->random(8).'.'.$file->getClientOriginalExtension();
                $targetDir = public_path('images/projects');
                if (! file_exists($targetDir)) {
                    @mkdir($targetDir, 0775, true);
                }
                $file->move($targetDir, $fileName);

                // Delete old file if present
                if ($project->image && str_starts_with($project->image, '/images/projects/')) {
                    $oldPath = public_path(ltrim($project->image, '/'));
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }

                $validated['image'] = '/images/projects/'.$fileName;
            }

            if (! empty($validated['image']) && is_string($validated['image']) && ! str_starts_with($validated['image'], 'http') && ! str_starts_with($validated['image'], '/')) {
                $validated['image'] = '/'.$validated['image'];
            }

            if (! Schema::hasColumn('projects', 'image')) {
                Schema::table('projects', function (Blueprint $table) {
                    $table->string('image')->nullable()->after('icon');
                });
            }

            $project->update($validated);

            return new ProjectResource($project);
        } catch (ValidationException $ve) {
            return response()->json([
                'message' => 'اطلاعات وارد شده معتبر نیست.',
                'errors' => $ve->errors(),
            ], 422);
        } catch (\Throwable $e) {
            Log::error('Project update error: '.$e->getMessage());

            return response()->json([
                'message' => 'خطا در ویرایش پروژه: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        if ($project->image && str_starts_with($project->image, '/images/projects/')) {
            $filePath = public_path(ltrim($project->image, '/'));
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        $project->delete();

        return response()->json([
            'message' => 'پروژه با موفقیت حذف شد.',
        ]);
    }
}
