<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_statistics_from_the_database(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['nama_kategori' => 'Umum']);

        Book::create([
            'category_id' => $category->id,
            'judul' => 'Buku Satu',
            'penulis' => 'Penulis',
            'penerbit' => 'Penerbit',
            'tahun_terbit' => 2025,
        ]);
        Member::factory()->count(2)->create();
        Loan::create([
            'user_id' => $user->id,
            'tanggal_pinjam' => '2026-10-01',
            'tanggal_kembali' => '2026-10-08',
            'status' => 'dipinjam',
        ]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSeeInOrder([
                '<div class="value">1</div>',
                '<div class="value">2</div>',
                '<div class="value">1</div>',
            ], false);
    }
}
