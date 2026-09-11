<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private array $members = [
        ['id'=> 1, 'name'=>'Budi Santoso', 'nim'=>200101001, 'email'=>'budi@gmail.com', 'nomor_telepon'=> '081234567890', 'alamat'=> 'Jl. Mawar No. 123', 'status'=> 'Aktif'],
        ['id'=> 2, 'name'=>'Siti Aminah', 'nim'=>200101002, 'email'=>'siti@gmail.com', 'nomor_telepon'=> '081234567891', 'alamat'=> 'Jl. Melati No. 124', 'status'=> 'Tidak Aktif'],
        ['id'=> 3, 'name'=>'Rina Lestari', 'nim'=>200101003, 'email'=>'rina@gmail.com', 'nomor_telepon'=> '081234567892', 'alamat'=> 'Jl. Anggrek No. 125', 'status'=> 'Aktif'],
    ];

    /**
     * Display a listing of the resource.
     */
        public function index()
    {
        $members = $this->members;

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
       $validated = $request->validated();

        return redirect()->route('members.index')
            ->with('success', "Data {$validated['name']} berhasil ditambahkan (data dummy, belum tersimpan ke database).");
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "MemberController@show, id: {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "MemberController@edit, id: {$id}";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "MemberController@update, id: {$id}";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "MemberController@destroy, id: {$id}";
        
    }
}
