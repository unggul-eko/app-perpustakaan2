<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Password lama tidak cocok.',
            ]);
        }

        // Assuming User model has ID property, we can fetch it or just use model instance update
        /** @var \App\Models\User $user */
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profil.show')->with('success', 'Password berhasil diubah.');
    }
}
