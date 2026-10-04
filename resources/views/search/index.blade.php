<x-public-layout
    title="Pencarian — Farhan Maulana Syidiq"
    description="Pencarian global proyek dan artikel di situs Farhan Maulana Syidiq.">

    <section class="border-b border-slate-800/60 bg-slate-950/40">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-cyan-400">Pencarian</p>
                <h1 class="mt-3 text-balance text-3xl font-bold tracking-tight sm:text-4xl">Cari di Situs Ini</h1>
                <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                    Cari proyek dan artikel blog sekaligus.
                </p>
            </div>

            <form method="GET" action="{{ route('search.index') }}" class="mx-auto mt-8 flex max-w-xl flex-col gap-3 sm:mt-10 sm:flex-row">
                <div class="relative min-w-0 flex-1">
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                    <input type="search" name="q" value="{{ $q }}" placeholder="cth: FTTH, Laravel, monitoring…"
                           class="w-full rounded-xl border border-slate-700 bg-slate-900/60 py-3 pl-11 pr-4 text-sm text-white placeholder-slate-500 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30">
                </div>
                <button type="submit" class="rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
                    Cari
                </button>
            </form>
        </div>
    </section>

    <section class="bg-slate-900">
        <div class="mx-auto max-w-6xl space-y-12 px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            @if ($q === '')
                <div class="rounded-2xl border border-dashed border-slate-700 bg-slate-800/20 p-10 text-center sm:p-14">
                    <p class="text-sm text-slate-400 sm:text-base">Ketik kata kunci di atas untuk mulai mencari.</p>
                </div>
            @else
                {{-- Proyek --}}
                <div>
                    <h2 class="text-xl font-bold tracking-tight">Proyek ({{ $projects->count() }})</h2>
                    @if ($projects->isEmpty())
                        <p class="mt-3 text-sm text-slate-400">Tidak ada proyek yang cocok dengan “{{ $q }}”.</p>
                    @else
                        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($projects as $project)
                                <a href="{{ route('portfolio.projects.show', $project) }}" class="group rounded-2xl border border-slate-800 bg-slate-800/40 p-5 transition hover:border-indigo-500/40">
                                    <h3 class="break-words text-sm font-semibold text-slate-200 transition group-hover:text-indigo-300">{{ $project->title }}</h3>
                                    <p class="mt-2 line-clamp-2 text-xs leading-relaxed text-slate-500">{{ $project->excerpt(120) }}</p>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Artikel --}}
                <div>
                    <h2 class="text-xl font-bold tracking-tight">Artikel ({{ $posts->count() }})</h2>
                    @if ($posts->isEmpty())
                        <p class="mt-3 text-sm text-slate-400">Tidak ada artikel yang cocok dengan “{{ $q }}”.</p>
                    @else
                        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($posts as $post)
                                <a href="{{ route('blog.show', $post) }}" class="group rounded-2xl border border-slate-800 bg-slate-800/40 p-5 transition hover:border-cyan-500/40">
                                    <p class="text-xs font-semibold text-cyan-400">{{ $post->category ?? 'Umum' }}</p>
                                    <h3 class="mt-2 break-words text-sm font-semibold leading-snug text-slate-200 transition group-hover:text-cyan-300">{{ $post->title }}</h3>
                                    <p class="mt-2 line-clamp-2 text-xs leading-relaxed text-slate-500">{{ $post->excerpt_text }}</p>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
</x-public-layout>
