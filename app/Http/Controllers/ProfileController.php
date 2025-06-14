<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
{
    // 1. Validasi password untuk memastikan ini benar-benar pemilik akun
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    // 2. Simpan instance user saat ini ke dalam variabel
    $user = $request->user();

    // 3. Logout pengguna dari sesi saat ini
    Auth::logout();

    // 4. Hapus data pengguna dari database
    $user->delete();

    // 5. Batalkan sesi dan buat token baru untuk keamanan
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 6. Alihkan ke halaman utama (welcome page)
    return Redirect::to('/');
}
}
