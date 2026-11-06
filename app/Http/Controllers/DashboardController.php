<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_buku' => Book::count(),
            'total_anggota' => Member::count(),
            'peminjaman_aktif' => Loan::where('status', 'dipinjam')->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
