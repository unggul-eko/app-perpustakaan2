# Daftar Endpoint API Perpustakaan

**Base URL:** `http://127.0.0.1:8000/api`

## 📖 Books

| No. | Metode | Endpoint | Keterangan | Body |
|---:|---|---|---|---|
| 1 | GET | `/books` | Melihat daftar buku | — |
| 2 | GET | `/books/{id}` | Melihat detail buku | — |
| 3 | POST | `/books` | Menambahkan buku baru | `{"title":"...","author":"...","isbn":"...","published_year":2024,"stock":5}` |
| 4 | PUT | `/books/{id}` | Mengubah data buku | `{"title":"...","author":"...","isbn":"...","published_year":2024,"stock":10}` |
| 5 | DELETE | `/books/{id}` | Menghapus buku | — |

## 👤 Members

| No. | Metode | Endpoint | Keterangan | Body |
|---:|---|---|---|---|
| 6 | GET | `/members` | Melihat daftar anggota | — |
| 7 | GET | `/members/{id}` | Melihat detail anggota | — |

## 📋 Loans

| No. | Metode | Endpoint | Keterangan | Body |
|---:|---|---|---|---|
| 8 | GET | `/loans` | Melihat daftar peminjaman | — |
| 9 | POST | `/loans` | Membuat peminjaman baru | `{"member_id":1,"book_id":1,"loan_date":"2026-10-28","due_date":"2026-11-11"}` |
| 10 | PUT | `/loans/{id}/kembalikan` | Menandai peminjaman dikembalikan | `{"return_date":"2026-10-28"}` |

## 📊 Stats

| No. | Metode | Endpoint | Keterangan | Body |
|---:|---|---|---|---|
| 11 | GET | `/stats` | Melihat statistik perpustakaan | — |

> **Catatan:** Format body di atas mengikuti tabel tugas. Implementasi API project saat ini memakai nama field yang berbeda untuk beberapa endpoint: buku memakai `judul`, `penulis`, `penerbit`, `tahun_terbit`, `stok`, dan `category_id`; peminjaman memakai `member_id`, `user_id`, `tanggal_pinjam`, `tanggal_kembali`, dan `book_ids`. Endpoint pengembalian menetapkan tanggal pengembalian secara otomatis, sehingga body `return_date` pada tabel tugas belum digunakan oleh implementasi saat ini.
