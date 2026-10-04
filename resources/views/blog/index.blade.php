<x-public-layout
    title="Blog — Farhan Maulana Syidiq"
    description="Catatan, pengalaman, dan pembelajaran seputar jaringan, DevOps, dan web development — ditulis oleh Farhan Maulana Syidiq.">

    {{-- ==================== HEADER BLOG ==================== --}}
    <section class="border-b border-slate-800/60 bg-slate-950/40">
        <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-cyan-400">Blog</p>
                <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">Catatan &amp; Pengalaman</h1>
                <p class="mt-4 text-slate-400">
                    Cerita di lapangan, pembelajaran, dan eksperimen seputar jaringan, server, dan web development.
                </p>
            </div>

            {{-- Pencarian --}}
            <form method="GET" action="{{ route('blog.index') }}" class="mx-auto mt-8 flex max-w-xl flex-col gap-3 sm:mt-10 sm:flex-row">
                @if (request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                @if (request('tag'))
                    <input type="hidden" name="tag" value="{{ request('tag') }}">
                @endif
                <div class="relative min-w-0 flex-1">
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari artikel…"
                           class="w-full rounded-xl border border-slate-700 bg-slate-900/60 py-3 pl-11 pr-4 text-sm text-white placeholder-slate-500 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30">
                </div>
                <button type="submit" class="rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
                    Cari
                </button>
            </form>

            {{-- Filter kategori --}}
            @if ($categories->isNotEmpty())
                <div class="mt-6 flex flex-wrap items-center justify-center gap-2">
                    <a href="{{ route('blog.index', array_filter(['q' => request('q'), 'tag' => request('tag')] )) }}"
                       class="rounded-full px-4 py-1.5 text-xs font-semibold transition {{ !request('kategori') ? 'bg-gradient-to-r from-indigo-500 to-cyan-500 text-white' : 'border border-slate-700 bg-slate-800/50 text-slate-300 hover:border-slate-500 hover:text-white' }}">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('blog.index', array_filter(['kategori' => $category, 'q' => request('q'), 'tag' => request('tag')])) }}"
                           class="rounded-full px-4 py-1.5 text-xs font-semibold transition {{ request('kategori') === $category ? 'bg-gradient-to-r from-indigo-500 to-cyan-500 text-white' : 'border border-slate-700 bg-slate-800/50 text-slate-300 hover:border-slate-500 hover:text-white' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Filter tag --}}
            @if (($tags ?? collect())->isNotEmpty())
                <div class="mt-4 flex flex-wrap items-center justify-center gap-2">
                    @foreach ($tags as $tag)
                        <a href="{{ route('blog.index', array_filter(['tag' => $tag, 'q' => request('q'), 'kategori' => request('kategori')])) }}"
                           class="rounded-full px-3 py-1 text-xs font-medium transition {{ request('tag') === $tag ? 'bg-gradient-to-r from-indigo-500 to-cyan-500 text-white' : 'border border-slate-700/80 bg-slate-800/40 text-slate-400 hover:border-slate-500 hover:text-white' }}">
                            #{{ $tag }}
                        </a>
                    @endforeach
                    @if (request('tag'))
                        <a href="{{ route('blog.index', array_filter(['q' => request('q'), 'kategori' => request('kategori')])) }}"
                           class="px-2 py-1 text-xs font-medium text-rose-400 transition hover:text-rose-300">
                            Hapus filter tag &times;
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    {{-- ==================== DAFTAR ARTIKEL ==================== --}}
    <section class="bg-slate-900">
        <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-8">
            @if ($posts->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-700 bg-slate-800/20 p-14 text-center">
                    <svg class="mx-auto mb-4 h-12 w-12 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
                    </svg>
                    @if (request('q') || request('kategori') || request('tag'))
                        <p class="text-slate-400">Tidak ada artikel yang cocok dengan pencarian atau filter Anda.</p>
                        <a href="{{ route('blog.index') }}" class="mt-3 inline-block text-sm font-medium text-cyan-400 transition hover:text-cyan-300">Reset pencarian &rarr;</a>
                    @else
                        <p class="text-slate-400">Belum ada artikel yang diterbitkan. Nantikan tulisan berikutnya!</p>
                    @endif
                </div>
            @else
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-800 bg-slate-800/40 transition hover:-translate-y-1 hover:border-cyan-500/40 hover:shadow-xl hover:shadow-cyan-500/10">
                            {{-- Thumbnail --}}
                            <a href="{{ route('blog.show', $post) }}" class="relative block aspect-video overflow-hidden bg-slate-800">
                                @if ($post->thumbnail_url)
                                    <img src="{{ $post->thumbnail_url }}" alt="Thumbnail artikel {{ $post->title }}"
                                         class="h-full w-full object-cover transition duration-300 group-hover:scale-105" loading="lazy">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-800 via-slate-800/60 to-cyan-900/30">
                                        <svg class="h-12 w-12 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
                                        </svg>
                                    </div>
                                @endif
                                @if ($post->category)
                                    <span class="absolute left-4 top-4 rounded-full bg-slate-950/80 px-3 py-1 text-xs font-semibold text-cyan-300 ring-1 ring-cyan-500/30 backdrop-blur">
                                        {{ $post->category }}
                                    </span>
                                @endif
                            </a>

                            <div class="flex flex-1 flex-col p-6">
                                <h2 class="text-lg font-semibold leading-snug text-white transition group-hover:text-cyan-300">
                                    <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                                </h2>
                                <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-400">
                                    {{ $post->excerpt_text }}
                                </p>

                                <div class="mt-5 flex items-center gap-3 text-xs text-slate-500">
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                                        </svg>
                                        {{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}
                                    </span>
                                    <span aria-hidden="true">&middot;</span>
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        {{ $post->reading_time }} menit baca
                                    </span>
                                </div>

                                @if (count((array) ($post->tags ?? [])) > 0)
                                    <div class="mt-3 flex flex-wrap gap-1.5">
                                        @foreach ((array) $post->tags as $cardTag)
                                            <a href="{{ route('blog.index', ['tag' => $cardTag]) }}"
                                               class="rounded-full border border-slate-700/80 bg-slate-900/50 px-2.5 py-0.5 text-[11px] font-medium text-slate-400 transition hover:border-cyan-500/40 hover:text-cyan-300">
                                                #{{ $cardTag }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif

                                <a href="{{ route('blog.show', $post) }}"
                                   class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-cyan-400 transition hover:gap-2.5 hover:text-cyan-300">
                                    Baca selengkapnya
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <x-pagination :paginator="$posts" />
            @endif
        </div>
    </section>
</x-public-layout>
