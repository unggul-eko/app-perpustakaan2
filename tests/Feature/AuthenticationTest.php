<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_in_and_access_categories(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@pens.ac.id',
            'role' => 'admin',
        ]);

        $this->post('/login', [
            'email' => 'admin@pens.ac.id',
            'password' => 'password',
        ])->assertRedirect(route('books.index'));

        $this->assertAuthenticatedAs($admin);
        $this->get(route('categories.index'))->assertOk();
    }

    public function test_petugas_cannot_access_categories_and_sees_automatic_loan_clerk(): void
    {
        $petugas = User::factory()->create([
            'name' => 'Petugas Satu',
            'role' => 'petugas',
        ]);

        $this->actingAs($petugas)
            ->get(route('categories.index'))
            ->assertForbidden();

        $this->actingAs($petugas)
            ->get(route('loans.create'))
            ->assertOk()
            ->assertSee('Petugas pencatat: Petugas Satu')
            ->assertDontSee('name="user_id"');
    }

    public function test_loan_uses_the_authenticated_user_instead_of_a_submitted_user_id(): void
    {
        $petugas = User::factory()->create(['role' => 'petugas']);
        $category = Category::create(['nama_kategori' => 'Umum']);
        $member = Member::create([
            'nama' => 'Anggota Satu',
            'nim' => '12345',
            'email' => 'anggota@example.test',
            'nomor_telepon' => '081234567890',
            'alamat' => 'Kampus',
            'status' => 'aktif',
        ]);
        $book = Book::create([
            'category_id' => $category->id,
            'judul' => 'Buku Praktikum',
            'penulis' => 'Penulis',
            'penerbit' => 'Penerbit',
            'tahun_terbit' => 2025,
        ]);

        $this->actingAs($petugas)
            ->post(route('loans.store'), [
                'member_id' => $member->id,
                'tanggal_pinjam' => '2026-10-09',
                'tanggal_kembali' => '2026-10-16',
                'book_ids' => [$book->id],
                'user_id' => User::factory()->create(['role' => 'admin'])->id,
            ])
            ->assertRedirect(route('loans.index'));

        $this->assertDatabaseHas('loans', [
            'member_id' => $member->id,
            'user_id' => $petugas->id,
        ]);
        $this->assertDatabaseHas('loan_items', ['book_id' => $book->id]);
    }
}
