<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactSettingController extends Controller
{
    /**
     * Form ubah info kontak yang tampil di halaman publik.
     */
    public function edit(): View
    {
        return view('admin.contact-setting.edit', [
            'setting' => ContactSetting::current(),
        ]);
    }

    /**
     * Simpan perubahan info kontak.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email:filter', 'max:150'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['required', 'string', 'max:255'],
            'response_hours' => ['required', 'string', 'max:255'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'location.required' => 'Lokasi wajib diisi.',
            'response_hours.required' => 'Jam respons wajib diisi.',
        ]);

        ContactSetting::current()->update($validated);

        return back()->with('success', 'Info kontak berhasil diperbarui.');
    }
}
