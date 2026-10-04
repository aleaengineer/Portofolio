{{--
    Partial form proyek — dipakai oleh create.blade.php dan edit.blade.php.
    Variabel yang diharapkan: $project (App\Models\Project).
    Aksi form dan method ditentukan oleh view pemanggil.
--}}
<section class="grid gap-8 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        {{-- Judul --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-slate-300">Judul Proyek <span class="text-rose-400">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required maxlength="255" placeholder="cth: Web Peta Sebaran & Coverage FTTH"
                   class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
            @error('title') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
        </div>

        {{-- Slug --}}
        <div>
            <label for="slug" class="mb-2 block text-sm font-medium text-slate-300">Slug URL</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug', $project->slug) }}" maxlength="255" placeholder="otomatis-dari-judul-jika-dikosongkan"
                   class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
            @error('slug') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            <p class="mt-2 text-xs text-slate-500">Biarkan kosong untuk membuat slug otomatis dari judul. Hanya huruf, angka, tanda hubung, dan garis bawah.</p>
        </div>

        {{-- Deskripsi --}}
        <div>
            <label for="description" class="mb-2 block text-sm font-medium text-slate-300">Deskripsi <span class="text-rose-400">*</span></label>
            <textarea id="description" name="description" rows="8" required placeholder="Jelaskan tujuan proyek, teknologi yang dipakai, dan peran Anda…"
                      class="w-full resize-y rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm leading-relaxed text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">{{ old('description', $project->description) }}</textarea>
            @error('description') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
        </div>

        {{-- Tech stack --}}
        <div>
            <label for="tech_stack" class="mb-2 block text-sm font-medium text-slate-300">Tech Stack</label>
            <input type="text" id="tech_stack" name="tech_stack" value="{{ old('tech_stack', implode(', ', (array) $project->tech_stack)) }}" maxlength="1000" placeholder="cth: Laravel, MySQL, Leaflet.js"
                   class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
            @error('tech_stack') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            <p class="mt-2 text-xs text-slate-500">Pisahkan dengan koma. Setiap teknologi akan tampil sebagai badge di halaman publik.</p>
        </div>

        {{-- URL --}}
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label for="github_url" class="mb-2 block text-sm font-medium text-slate-300">URL GitHub</label>
                <input type="url" id="github_url" name="github_url" value="{{ old('github_url', $project->github_url) }}" maxlength="255" placeholder="https://github.com/username/repo"
                       class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                @error('github_url') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="demo_url" class="mb-2 block text-sm font-medium text-slate-300">URL Live Demo</label>
                <input type="url" id="demo_url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" maxlength="255" placeholder="https://demo.contoh.com"
                       class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                @error('demo_url') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <div class="space-y-6">
        {{-- Thumbnail --}}
        <div class="rounded-2xl border border-slate-800 bg-slate-800/40 p-6">
            <label for="thumbnail" class="mb-2 block text-sm font-medium text-slate-300">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/webp"
                   class="w-full cursor-pointer rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-slate-400 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-500/20 file:px-4 file:py-1.5 file:text-xs file:font-semibold file:text-indigo-300 hover:file:bg-indigo-500/30">
            @error('thumbnail') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            <p class="mt-2 text-xs text-slate-500">JPG / PNG / WebP, rasio disarankan 16:9, maksimal 2MB.</p>

            @if ($project->thumbnail_url)
                <div class="mt-4">
                    <p class="mb-2 text-xs font-medium text-slate-400">Thumbnail saat ini:</p>
                    <img src="{{ $project->thumbnail_url }}" alt="Thumbnail saat ini" class="aspect-video w-full rounded-xl border border-slate-700 object-cover">
                    <label class="mt-3 flex items-center gap-2.5 text-sm text-slate-400">
                        <input type="checkbox" name="remove_thumbnail" value="1" class="h-4 w-4 rounded border-slate-700 bg-slate-950 text-rose-500 focus:ring-rose-500/40">
                        Hapus thumbnail ini
                    </label>
                </div>
            @endif
        </div>

        {{-- Toggle unggulan --}}
        <div class="rounded-2xl border border-slate-800 bg-slate-800/40 p-6">
            <label class="flex cursor-pointer items-center justify-between gap-4">
                <span>
                    <span class="block text-sm font-medium text-slate-300">Proyek Unggulan</span>
                    <span class="mt-1 block text-xs text-slate-500">Tampilkan di halaman publik.</span>
                </span>
                <span class="relative inline-flex">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }} class="peer sr-only">
                    <span class="h-6 w-11 rounded-full bg-slate-700 transition peer-checked:bg-gradient-to-r peer-checked:from-indigo-500 peer-checked:to-cyan-500"></span>
                    <span class="pointer-events-none absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition peer-checked:translate-x-5"></span>
                </span>
            </label>
        </div>

        {{-- Aksi --}}
        <div class="flex flex-col gap-3">
            <button type="submit"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
                {{ $submitLabel ?? 'Simpan Proyek' }}
            </button>
            <a href="{{ route('admin.projects.index') }}"
               class="inline-flex w-full items-center justify-center rounded-xl border border-slate-700 bg-slate-800/50 px-6 py-3 text-sm font-medium text-slate-300 transition hover:border-slate-500 hover:text-white">
                Batal
            </a>
        </div>
    </div>
</section>
