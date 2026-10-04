<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dapat_menambahkan_thumbnail_pada_proyek_yang_belum_punya_thumbnail(): void
    {
        Storage::fake('public');

        $project = Project::create([
            'title' => 'Netmon',
            'description' => 'Proyek tanpa thumbnail.',
            'tech_stack' => ['PHP'],
            'is_featured' => false,
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->put(route('admin.projects.update', $project), [
                'title' => $project->title,
                'description' => $project->description,
                'tech_stack' => 'PHP',
                'thumbnail' => UploadedFile::fake()->image('thumbnail.png'),
            ]);

        $response->assertRedirect(route('admin.projects.index'));

        $project->refresh();
        $this->assertNotNull($project->thumbnail);
        Storage::disk('public')->assertExists($project->thumbnail);
    }

    public function test_thumbnail_lama_terganti_dan_file_lama_dihapus(): void
    {
        Storage::fake('public');

        $project = Project::create([
            'title' => 'Netmon',
            'description' => 'Proyek dengan thumbnail lama.',
            'tech_stack' => [],
            'is_featured' => false,
        ]);

        $oldPath = UploadedFile::fake()->image('lama.png')->store('thumbnails', 'public');
        $project->update(['thumbnail' => $oldPath]);

        $response = $this->actingAs(User::factory()->create())
            ->put(route('admin.projects.update', $project), [
                'title' => $project->title,
                'description' => $project->description,
                'thumbnail' => UploadedFile::fake()->image('baru.png'),
            ]);

        $response->assertRedirect(route('admin.projects.index'));

        $project->refresh();
        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertExists($project->thumbnail);
    }

    public function test_admin_dapat_menghapus_proyek_yang_tidak_punya_thumbnail(): void
    {
        $project = Project::create([
            'title' => 'Tanpa Thumbnail',
            'description' => 'Proyek tanpa thumbnail.',
            'tech_stack' => [],
            'is_featured' => false,
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->delete(route('admin.projects.destroy', $project));

        $response->assertRedirect();
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
