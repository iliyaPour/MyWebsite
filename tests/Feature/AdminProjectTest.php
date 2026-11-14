<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_fetch_projects_list(): void
    {
        Project::factory()->count(3)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_guest_cannot_create_or_delete_project(): void
    {
        $project = Project::factory()->create();

        $storeResponse = $this->postJson('/api/admin/projects', [
            'title' => 'پروژه غیرمجاز',
            'category' => 'mini',
            'hosted_url' => 'https://example.com',
        ]);
        $storeResponse->assertStatus(401);

        $deleteResponse = $this->deleteJson("/api/admin/projects/{$project->id}");
        $deleteResponse->assertStatus(401);
    }

    public function test_admin_can_login_with_valid_password(): void
    {
        User::factory()->create([
            'email' => 'admin@iliya.dev',
            'password' => Hash::make('my-secret-password'),
        ]);

        $response = $this->postJson('/api/admin/login', [
            'email' => 'admin@iliya.dev',
            'password' => 'my-secret-password',
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'ورود با موفقیت انجام شد.']);

        $this->assertAuthenticated();
    }

    public function test_admin_cannot_login_with_invalid_password(): void
    {
        User::factory()->create([
            'email' => 'admin@iliya.dev',
            'password' => Hash::make('my-secret-password'),
        ]);

        $response = $this->postJson('/api/admin/login', [
            'email' => 'admin@iliya.dev',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(422);
        $this->assertGuest();
    }

    public function test_admin_can_create_project(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->postJson('/api/admin/projects', [
            'title' => 'پروژه جدید تست',
            'category' => 'webapps',
            'category_label' => 'اپلیکیشن وب',
            'icon' => '💻',
            'short_desc' => 'توضیحات تستی کوتاه',
            'full_desc' => 'توضیحات تستی کامل',
            'features' => ['قابلیت ۱', 'قابلیت ۲'],
            'tags' => ['Vue.js', 'Tailwind'],
            'hosted_url' => 'https://iliya-test.com',
            'github_url' => 'https://github.com/iliya/test',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.title', 'پروژه جدید تست');

        $this->assertDatabaseHas('projects', [
            'title' => 'پروژه جدید تست',
            'hosted_url' => 'https://iliya-test.com',
        ]);
    }

    public function test_admin_can_update_project(): void
    {
        $admin = User::factory()->create();
        $project = Project::factory()->create([
            'title' => 'عنوان قدیمی',
        ]);

        $response = $this->actingAs($admin)->putJson("/api/admin/projects/{$project->id}", [
            'title' => 'عنوان جدید و به‌روز',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.title', 'عنوان جدید و به‌روز');

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'عنوان جدید و به‌روز',
        ]);
    }

    public function test_admin_can_delete_project(): void
    {
        $admin = User::factory()->create();
        $project = Project::factory()->create();

        $response = $this->actingAs($admin)->deleteJson("/api/admin/projects/{$project->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'پروژه با موفقیت حذف شد.']);

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
    }

    public function test_admin_can_change_password(): void
    {
        $admin = User::factory()->create([
            'password' => Hash::make('old-password-123'),
        ]);

        $response = $this->actingAs($admin)->postJson('/api/admin/change-password', [
            'current_password' => 'old-password-123',
            'new_password' => 'new-secret-password-456',
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'رمز عبور با موفقیت تغییر یافت.']);

        $admin->refresh();
        $this->assertTrue(Hash::check('new-secret-password-456', $admin->password));
    }

    public function test_admin_cannot_change_password_with_invalid_current(): void
    {
        $admin = User::factory()->create([
            'password' => Hash::make('old-password-123'),
        ]);

        $response = $this->actingAs($admin)->postJson('/api/admin/change-password', [
            'current_password' => 'wrong-current-password',
            'new_password' => 'new-secret-password-456',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['current_password']);
    }
}
