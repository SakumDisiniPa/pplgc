<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
        // Update data dasar profil
        $user = $request->user();
        $user->fill($request->validated());

        // Reset verifikasi email jika email diubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle upload foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo_path) {
                Storage::delete(str_replace('storage/', 'public/', $user->profile_photo_path));
            }

            // Simpan foto baru
            $path = $request->file('profile_photo')->store('public/profile-photos');
            $user->profile_photo_path = str_replace('public/', 'storage/', $path);
        }

        $user->save();

        return Redirect::route('profile.edit')
               ->with('status', 'Profil berhasil diperbarui!')
               ->with('success', true);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Hapus foto profil jika ada
        if ($user->profile_photo_path) {
            Storage::delete(str_replace('storage/', 'public/', $user->profile_photo_path));
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Akun Anda berhasil dihapus.');
    }

    /**
     * Remove the user's profile photo.
     */
    public function destroyPhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Hapus foto dari storage
        if ($user->profile_photo_path) {
            Storage::delete(str_replace('storage/', 'public/', $user->profile_photo_path));
            $user->profile_photo_path = null;
            $user->save();
        }

        return Redirect::route('profile.edit')
               ->with('status', 'Foto profil berhasil dihapus')
               ->with('success', true);
    }

    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user()
        ]);
    }
}