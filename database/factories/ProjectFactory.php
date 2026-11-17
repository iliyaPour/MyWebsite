<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'category' => fake()->randomElement(['webapps', 'mini', 'js']),
            'category_label' => 'پروژه فرانت‌اند',
            'icon' => '💻',
            'image' => null,
            'mock_url' => 'https://iliya.dev/projects/'.fake()->slug(),
            'short_desc' => fake()->paragraph(1),
            'full_desc' => fake()->paragraph(3),
            'features' => [fake()->sentence(), fake()->sentence(), fake()->sentence()],
            'tags' => ['HTML5', 'CSS3', 'Vue.js', 'Tailwind'],
            'hosted_url' => fake()->url(),
            'github_url' => 'https://github.com/example/'.fake()->slug(),
            'gradient' => 'bg-gradient-to-br from-amber-600 via-orange-700 to-slate-900',
            'order' => fake()->numberBetween(1, 10),
        ];
    }
}
