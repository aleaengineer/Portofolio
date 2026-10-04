<x-admin-layout title="Pengaturan Kontak">
    <div class="mb-8">
        <h2 class="text-xl font-bold tracking-tight text-white">Pengaturan Kontak</h2>
        <p class="mt-1 text-sm text-slate-400">Info ini tampil di halaman kontak publik (beranda &amp; halaman kontak).</p>
    </div>

    <form method="POST" action="{{ route('admin.contact-setting.update') }}" class="max-w-2xl rounded-2xl border border-slate-800 bg-slate-900/40 p-6 sm:p-8">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label for="email" class="mb-2 block text-sm font-medium text-slate-300">Email <span class="text-rose-400">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $setting->email) }}" required maxlength="150" placeholder="nama@email.com"
                       class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                @error('email') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="mb-2 block text-sm font-medium text-slate-300">Telepon / WA</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $setting->phone) }}" maxlength="50" placeholder="cth: +62 821 2944-8933"
                       class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                @error('phone') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="location" class="mb-2 block text-sm font-medium text-slate-300">Lokasi <span class="text-rose-400">*</span></label>
                <input type="text" id="location" name="location" value="{{ old('location', $setting->location) }}" required maxlength="255" placeholder="cth: Indonesia — Remote Friendly"
                       class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                @error('location') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="response_hours" class="mb-2 block text-sm font-medium text-slate-300">Jam Respons <span class="text-rose-400">*</span></label>
                <input type="text" id="response_hours" name="response_hours" value="{{ old('response_hours', $setting->response_hours) }}" required maxlength="255" placeholder="cth: Senin – Sabtu, 09.00 – 21.00 WIB"
                       class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                @error('response_hours') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
                    Simpan Perubahan
                </button>
                <a href="{{ route('portfolio.contact.show') }}" target="_blank" rel="noopener"
                   class="inline-flex items-center justify-center rounded-xl border border-slate-700 bg-slate-800/50 px-6 py-3 text-sm font-medium text-slate-300 transition hover:border-slate-500 hover:text-white">
                    Lihat Halaman Kontak
                </a>
            </div>
        </div>
    </form>
</x-admin-layout>
