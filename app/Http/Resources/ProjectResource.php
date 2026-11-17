<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category,
            'category_label' => $this->category_label,
            'categoryLabel' => $this->category_label,
            'icon' => $this->icon,
            'image' => $this->image,
            'mock_url' => $this->mock_url,
            'mockUrl' => $this->mock_url,
            'short_desc' => $this->short_desc,
            'shortDesc' => $this->short_desc,
            'full_desc' => $this->full_desc,
            'fullDesc' => $this->full_desc,
            'features' => $this->features ?? [],
            'tags' => $this->tags ?? [],
            'hosted_url' => $this->hosted_url,
            'hostedUrl' => $this->hosted_url,
            'github_url' => $this->github_url,
            'githubUrl' => $this->github_url,
            'gradient' => $this->gradient,
            'order' => $this->order,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
