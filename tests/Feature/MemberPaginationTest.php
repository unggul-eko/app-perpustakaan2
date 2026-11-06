<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberPaginationTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_pages_keep_ids_in_ascending_order(): void
    {
        $this->actingAs(User::factory()->create());

        foreach (range(1, 11) as $number) {
            Member::create([
                'nama' => "Anggota {$number}",
                'nim' => (string) $number,
                'email' => "anggota{$number}@example.test",
                'nomor_telepon' => '081234567890',
                'alamat' => 'Kampus',
                'status' => 'aktif',
            ]);
        }

        $firstPage = $this->get(route('members.index'))
            ->assertOk()
            ->viewData('members');
        $secondPage = $this->get(route('members.index', ['page' => 2]))
            ->assertOk()
            ->viewData('members');

        $this->assertSame(range(1, 10), $firstPage->getCollection()->modelKeys());
        $this->assertSame([11], $secondPage->getCollection()->modelKeys());
    }
}
