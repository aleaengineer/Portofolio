{{-- Partial form sertifikasi — dipakai create & edit. Variabel: $certification. --}}
<div class="grid gap-6 sm:grid-cols-2">
    <div>
        <label for="name" class="mb-2 block text-sm font-medium text-slate-300">Nama Sertifikasi <span class="text-rose-400">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $certification->name) }}" required maxlength="255" placeholder="cth: MTCNA"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('name') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="issuer" class="mb-2 block text-sm font-medium text-slate-300">Penerbit <span class="text-rose-400">*</span></label>
        <input type="text" id="issuer" name="issuer" value="{{ old('issuer', $certification->issuer) }}" required maxlength="255" placeholder="cth: MikroTik"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('issuer') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="issue_date" class="mb-2 block text-sm font-medium text-slate-300">Tanggal Terbit</label>
        <input type="date" id="issue_date" name="issue_date" value="{{ old('issue_date', $certification->issue_date?->format('Y-m-d')) }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('issue_date') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="expiry_date" class="mb-2 block text-sm font-medium text-slate-300">Tanggal Kedaluwarsa</label>
        <input type="date" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $certification->expiry_date?->format('Y-m-d')) }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('expiry_date') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
        <p class="mt-2 text-xs text-slate-500">Kosongkan bila tidak kedaluwarsa.</p>
    </div>
    <div>
        <label for="credential_id" class="mb-2 block text-sm font-medium text-slate-300">ID Kredensial</label>
        <input type="text" id="credential_id" name="credential_id" value="{{ old('credential_id', $certification->credential_id) }}" maxlength="255"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('credential_id') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="sort_order" class="mb-2 block text-sm font-medium text-slate-300">Urutan</label>
        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $certification->sort_order ?? 0) }}" min="0" max="9999"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('sort_order') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div class="sm:col-span-2">
        <label for="credential_url" class="mb-2 block text-sm font-medium text-slate-300">URL Kredensial</label>
        <input type="url" id="credential_url" name="credential_url" value="{{ old('credential_url', $certification->credential_url) }}" maxlength="500" placeholder="https://…"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('credential_url') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div class="sm:col-span-2">
        <label for="image" class="mb-2 block text-sm font-medium text-slate-300">Gambar Sertifikat</label>
        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp"
               class="w-full cursor-pointer rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-slate-400 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-500/20 file:px-4 file:py-1.5 file:text-xs file:font-semibold file:text-indigo-300 hover:file:bg-indigo-500/30">
        @error('image') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
        <p class="mt-2 text-xs text-slate-500">JPG / PNG / WebP, maksimal 2MB. Foto/scan sertifikat.</p>
        @if ($certification->image_url)
            <div class="mt-4">
                <p class="mb-2 text-xs font-medium text-slate-400">Gambar saat ini:</p>
                <img src="{{ $certification->image_url }}" alt="Gambar sertifikat" class="aspect-video w-full max-w-sm rounded-xl border border-slate-700 object-cover">
                <label class="mt-3 flex items-center gap-2.5 text-sm text-slate-400">
                    <input type="checkbox" name="remove_image" value="1" class="h-4 w-4 rounded border-slate-700 bg-slate-950 text-rose-500 focus:ring-rose-500/40">
                    Hapus gambar ini
                </label>
            </div>
        @endif
    </div>
</div>

<div class="mt-8 flex flex-col gap-3 sm:flex-row">
    <button type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
        {{ $submitLabel ?? 'Simpan' }}
    </button>
    <a href="{{ route('admin.certifications.index') }}"
       class="inline-flex items-center justify-center rounded-xl border border-slate-700 bg-slate-800/50 px-6 py-3 text-sm font-medium text-slate-300 transition hover:border-slate-500 hover:text-white">
        Batal
    </a>
</div>
