<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    // File: app/Http/Controllers/MemberController.php
   

    public function index()
    {
        $members = Member::paginate(10);

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

       Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', "Data {$validated['nama']} berhasil ditambahkan.");
    
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
        // cari id yang sesuai
        $member = Member::findOrFail($id);

        if (!$member) {
            abort(404, 'Member tidak ditemukan');
        }

        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMemberRequest $request, string $id)
    {
        // cari id yang sesuai
        $member = Member::findOrFail($id);

        if (!$member) {
            abort(404, 'Member tidak ditemukan');
        }

        $validated = $request->validated();
        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', "Data {$validated['nama']} berhasil diupdate.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $members = Member::where('nama', 'LIKE', "%{$query}%")->paginate(10);

        return view('members.index', compact('members'));
    }
}
