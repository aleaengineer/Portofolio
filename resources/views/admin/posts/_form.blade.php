{{--
    Partial form artikel — dipakai oleh create.blade.php dan edit.blade.php.
    Variabel yang diharapkan: $post (App\Models\Post).
    Aksi form dan method ditentukan oleh view pemanggil.
--}}
<section class="grid gap-8 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        {{-- Judul --}}
        <div>
            <label for="title" class="mb-2 block text-sm font-medium text-slate-300">Judul Artikel <span class="text-rose-400">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required maxlength="255" placeholder="cth: Pengalaman Deploy Laravel Pertama ke VPS"
                   class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
            @error('title') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
        </div>

        {{-- Slug --}}
        <div>
            <label for="slug" class="mb-2 block text-sm font-medium text-slate-300">Slug URL</label>
            <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" maxlength="255" placeholder="otomatis-dari-judul-jika-dikosongkan"
                   class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
            @error('slug') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            <p class="mt-2 text-xs text-slate-500">Biarkan kosong untuk slug otomatis dari judul.</p>
        </div>

        {{-- Konten Markdown --}}
        <div>
            <label for="content" class="mb-2 block text-sm font-medium text-slate-300">Isi Artikel (Markdown) <span class="text-rose-400">*</span></label>
            <textarea id="content" name="content" rows="18" required
                      placeholder="{{ "# Judul\n\nTulis cerita Anda di sini. Mendukung **tebal**, *miring*, [tautan](https://…), daftar, dan blok kode:\n\n```bash\nphp artisan serve\n```" }}"
                      class="w-full resize-y rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 font-mono text-sm leading-relaxed text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">{{ old('content', $post->content) }}</textarea>
            @error('content') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            <p class="mt-2 text-xs text-slate-500">
                Mendukung format Markdown: <code class="rounded bg-slate-800 px-1"># Judul</code>,
                <code class="rounded bg-slate-800 px-1">**tebal**</code>,
                <code class="rounded bg-slate-800 px-1">- daftar</code>,
                <code class="rounded bg-slate-800 px-1">```blok kode```</code>,
                <code class="rounded bg-slate-800 px-1">[tautan](url)</code>.
            </p>
        </div>
    </div>

    <div class="space-y-6">
        {{-- Metadata --}}
        <div class="space-y-5 rounded-2xl border border-slate-800 bg-slate-800/40 p-6">
            <div>
                <label for="category" class="mb-2 block text-sm font-medium text-slate-300">Kategori</label>
                <input type="text" id="category" name="category" value="{{ old('category', $post->category) }}" maxlength="50" placeholder="cth: Networking, Web Dev"
                       class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                @error('category') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tags" class="mb-2 block text-sm font-medium text-slate-300">Tag</label>
                <input type="text" id="tags" name="tags" value="{{ old('tags', implode(', ', (array) ($post->tags ?? []))) }}" maxlength="500" placeholder="cth: ftth, monitoring, olt"
                       class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                @error('tags') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
                <p class="mt-2 text-xs text-slate-500">Pisahkan dengan koma.</p>
            </div>
            <div>
                <label for="excerpt" class="mb-2 block text-sm font-medium text-slate-300">Ringkasan</label>
                <textarea id="excerpt" name="excerpt" rows="3" maxlength="300" placeholder="Ringkasan singkat untuk kartu artikel. Kosongkan untuk dibuat otomatis."
                          class="w-full resize-y rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Thumbnail --}}
        <div class="rounded-2xl border border-slate-800 bg-slate-800/40 p-6">
            <label for="thumbnail" class="mb-2 block text-sm font-medium text-slate-300">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/webp"
                   class="w-full cursor-pointer rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-2.5 text-sm text-slate-400 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-500/20 file:px-4 file:py-1.5 file:text-xs file:font-semibold file:text-indigo-300 hover:file:bg-indigo-500/30">
            @error('thumbnail') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
            <p class="mt-2 text-xs text-slate-500">JPG / PNG / WebP, rasio disarankan 16:9, maksimal 2MB.</p>

            @if ($post->thumbnail_url)
                <div class="mt-4">
                    <p class="mb-2 text-xs font-medium text-slate-400">Thumbnail saat ini:</p>
                    <img src="{{ $post->thumbnail_url }}" alt="Thumbnail saat ini" class="aspect-video w-full rounded-xl border border-slate-700 object-cover">
                    <label class="mt-3 flex items-center gap-2.5 text-sm text-slate-400">
                        <input type="checkbox" name="remove_thumbnail" value="1" class="h-4 w-4 rounded border-slate-700 bg-slate-950 text-rose-500 focus:ring-rose-500/40">
                        Hapus thumbnail ini
                    </label>
                </div>
            @endif
        </div>

        {{-- Toggle terbit --}}
        <div class="rounded-2xl border border-slate-800 bg-slate-800/40 p-6">
            <label class="flex cursor-pointer items-center justify-between gap-4">
                <span>
                    <span class="block text-sm font-medium text-slate-300">Terbitkan</span>
                    <span class="mt-1 block text-xs text-slate-500">Tampilkan di halaman blog publik.</span>
                </span>
                <span class="relative inline-flex">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }} class="peer sr-only">
                    <span class="h-6 w-11 rounded-full bg-slate-700 transition peer-checked:bg-gradient-to-r peer-checked:from-indigo-500 peer-checked:to-cyan-500"></span>
                    <span class="pointer-events-none absolute left-1 top-1 h-4 w-4 rounded-full bg-white transition peer-checked:translate-x-5"></span>
                </span>
            </label>
            @if ($post->published_at)
                <p class="mt-3 text-xs text-slate-500">Diterbitkan: {{ $post->published_at->translatedFormat('d F Y, H:i') }}</p>
            @endif
        </div>

        {{-- Aksi --}}
        <div class="flex flex-col gap-3">
            <button type="submit"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
                {{ $submitLabel ?? 'Simpan Artikel' }}
            </button>
            <a href="{{ route('admin.posts.index') }}"
               class="inline-flex w-full items-center justify-center rounded-xl border border-slate-700 bg-slate-800/50 px-6 py-3 text-sm font-medium text-slate-300 transition hover:border-slate-500 hover:text-white">
                Batal
            </a>
        </div>
    </div>
</section>
