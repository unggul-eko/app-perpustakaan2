{{-- File: resources/views/members/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
<h1>Daftar Anggota</h1>
<p><a href="{{ route('members.create') }}" class="btn">+ Tambah Member</a></p>

<!-- search by name -->
<form action="{{ route('members.index') }}" method="GET">
    <input type="text" name="search" placeholder="Cari berdasarkan nama" value="{{ request('search') }}">
    <button type="submit">Cari</button>
</form>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($members as $member)
        <tr>
            <td>{{ $member['id'] }}</td>
            <td>{{ $member['nama'] }}</td>
            <td>{{ $member['nim'] }}</td>
            <td>{{ $member['email'] }}</td>
            <td>{{ $member['nomor_telepon'] }}</td>
            <td>{{ $member['alamat'] }}</td>
            <td>{{ ucfirst($member['status']) }}</td>
            <td>
                <a href="{{ route('members.edit', $member['id']) }}">Edit</a>
                <form action="{{ route('members.destroy', $member['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus {{ $member['nama'] }}?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">Belum ada data anggota.</td>
        </tr>
        @endforelse
    </tbody>
</table>
{{ $members->links() }}

@endsection