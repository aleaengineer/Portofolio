{{-- Partial form pendidikan — dipakai create & edit. Variabel: $education. --}}
<div class="grid gap-6 sm:grid-cols-2">
    <div>
        <label for="institution" class="mb-2 block text-sm font-medium text-slate-300">Institusi <span class="text-rose-400">*</span></label>
        <input type="text" id="institution" name="institution" value="{{ old('institution', $education->institution) }}" required maxlength="255" placeholder="cth: Universitas Terbuka"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('institution') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="degree" class="mb-2 block text-sm font-medium text-slate-300">Gelar / Jurusan</label>
        <input type="text" id="degree" name="degree" value="{{ old('degree', $education->degree) }}" maxlength="255" placeholder="cth: Bachelor of Accounting"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('degree') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="location" class="mb-2 block text-sm font-medium text-slate-300">Lokasi</label>
        <input type="text" id="location" name="location" value="{{ old('location', $education->location) }}" maxlength="255" placeholder="cth: Pangandaran"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('location') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="sort_order" class="mb-2 block text-sm font-medium text-slate-300">Urutan</label>
        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $education->sort_order ?? 0) }}" min="0" max="9999"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('sort_order') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
        <p class="mt-2 text-xs text-slate-500">Kecil tampil lebih dulu.</p>
    </div>
    <div>
        <label for="start_date" class="mb-2 block text-sm font-medium text-slate-300">Tanggal Mulai</label>
        <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $education->start_date?->format('Y-m-d')) }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('start_date') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="end_date" class="mb-2 block text-sm font-medium text-slate-300">Tanggal Selesai</label>
        <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $education->end_date?->format('Y-m-d')) }}"
               class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
        @error('end_date') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
        <p class="mt-2 text-xs text-slate-500">Kosongkan bila masih berjalan.</p>
    </div>
    <div class="sm:col-span-2">
        <label for="description" class="mb-2 block text-sm font-medium text-slate-300">Deskripsi (Markdown)</label>
        <textarea id="description" name="description" rows="5" maxlength="5000" placeholder="Catatan tambahan (opsional)…"
                  class="w-full resize-y rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 font-mono text-sm leading-relaxed text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">{{ old('description', $education->description) }}</textarea>
        @error('description') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-8 flex flex-col gap-3 sm:flex-row">
    <button type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
        {{ $submitLabel ?? 'Simpan' }}
    </button>
    <a href="{{ route('admin.educations.index') }}"
       class="inline-flex items-center justify-center rounded-xl border border-slate-700 bg-slate-800/50 px-6 py-3 text-sm font-medium text-slate-300 transition hover:border-slate-500 hover:text-white">
        Batal
    </a>
</div>
