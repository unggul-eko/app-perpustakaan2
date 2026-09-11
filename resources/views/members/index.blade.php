<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Member</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background-color: #f3f4f6; }
        .btn { display: inline-block; padding: 8px 16px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #1d4ed8; }
        .alert { padding: 10px; background: #dcfce3; color: #166534; margin-bottom: 20px; border-radius: 4px; border: 1px solid #bbf7d0; }
        .action-form { display: inline; }
        .btn-delete { color: #b91c1c; background: none; border: none; cursor: pointer; text-decoration: underline; padding: 0; font-size: 16px; }
    </style>
</head>
<body>
    <h1>Daftar Member</h1>
    
    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <p><a href="{{ route('members.create') }}" class="btn">+ Tambah Member</a></p>

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
                    {{-- Menggunakan format array $member['key'] karena datanya array asosiatif --}}
                    <td>{{ $member['id'] }}</td>
                    <td>{{ $member['name'] }}</td>
                    <td>{{ $member['nim'] }}</td>
                    <td>{{ $member['email'] }}</td>
                    <td>{{ $member['nomor_telepon'] }}</td>
                    <td>{{ $member['alamat'] }}</td>
                    <td>{{ $member['status'] }}</td>
                    <td>
                        <a href="{{ route('members.edit', $member['id']) }}">Edit</a> | 
                        <form action="{{ route('members.destroy', $member['id']) }}" method="POST" class="action-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus member ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Belum ada data member.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>