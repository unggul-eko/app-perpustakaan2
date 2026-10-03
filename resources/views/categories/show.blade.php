<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Kategori</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
            max-width: 500px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 16px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            width: 160px;
            background: #f3f4f6;
        }
    </style>
</head>

<body>
    <h1>Detail Kategori</h1>
    <p><a href="{{ route('categories.index') }}">&larr; Kembali ke daftar kategori</a></p>

    <table>
        <tr>
            <th>Nama Kategori</th>
            <td>{{ $category['nama_kategori'] }}</td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <td>{{ $category['deskripsi'] }}</td>
        </tr>
        <tr>
            <th>ID</th>
            <td>{{ $category['id'] }}</td>
        </tr>
    </table>
</body>

</html>