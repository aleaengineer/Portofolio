<x-public-layout
    :title="$experience->position.' di '.$experience->company.' — Pengalaman Farhan Maulana Syidiq'"
    :description="$experience->excerpt(160)">

    <article class="bg-slate-900">
        <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 sm:py-14 lg:px-8">
            <x-breadcrumb :items="[
                ['label' => 'Beranda', 'url' => route('portfolio.index')],
                ['label' => 'Pengalaman', 'url' => route('portfolio.experience')],
                ['label' => $experience->position],
            ]" />

            {{-- H1: judul utama halaman --}}
            <header class="mt-2 border-b border-slate-800/70 pb-8">
                <p class="text-xs font-semibold uppercase tracking-widest text-cyan-400">Pengalaman Kerja</p>
                <h1 class="mt-3 text-balance break-words text-3xl font-bold leading-tight tracking-tight sm:text-4xl">
                    {{ $experience->position }}
                </h1>
                {{-- Sub H1: perusahaan & lokasi --}}
                <p class="mt-3 text-base text-slate-400 sm:text-lg">
                    {{ $experience->company }}{{ $experience->location ? ' — '.$experience->location : '' }}
                </p>
                <div class="mt-5 flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center rounded-full border border-slate-700 bg-slate-900/60 px-3.5 py-1.5 text-xs font-medium text-slate-300">
                        {{ $experience->period }}
                    </span>
                    @if (! $experience->end_date)
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3.5 py-1.5 text-xs font-medium text-emerald-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                            Aktif
                        </span>
                    @endif
                </div>
            </header>

            {{-- H2: isi utama (mendukung sub H2 / H3 dari Markdown) --}}
            <h2 class="mt-10 text-xl font-bold tracking-tight">Tentang Peran Ini</h2>
            @if ($experience->description)
                <div class="prose prose-invert mt-5 max-w-none break-words
                            prose-h1:text-2xl prose-h1:font-bold prose-h1:tracking-tight prose-h1:text-white
                            prose-h2:mt-8 prose-h2:border-l-2 prose-h2:border-cyan-500/60 prose-h2:pl-4 prose-h2:text-xl prose-h2:font-bold prose-h2:tracking-tight prose-h2:text-white
                            prose-h3:mt-6 prose-h3:text-base prose-h3:font-semibold prose-h3:text-cyan-200
                            prose-p:leading-relaxed prose-p:text-slate-300
                            prose-ul:text-slate-300 prose-ol:text-slate-300 prose-li:marker:text-cyan-400
                            prose-strong:text-white
                            prose-code:rounded-md prose-code:bg-slate-800 prose-code:px-1.5 prose-code:py-0.5 prose-code:text-cyan-300 prose-code:before:content-none prose-code:after:content-none
                            prose-pre:max-w-full prose-pre:overflow-x-auto prose-pre:border prose-pre:border-slate-800 prose-pre:bg-slate-950
                            prose-a:break-words prose-a:text-cyan-300 hover:prose-a:text-cyan-200">
                    {!! $experience->html_description !!}
                </div>
            @else
                <p class="mt-5 text-sm text-slate-500">Belum ada deskripsi untuk pengalaman ini.</p>
            @endif

            {{-- H2: navigasi terkait --}}
            @if ($others->isNotEmpty())
                <section class="mt-14 border-t border-slate-800/70 pt-10">
                    <h2 class="text-xl font-bold tracking-tight">Pengalaman Lain</h2>
                    <p class="mt-2 text-sm text-slate-500">Jelajahi peran lain dalam riwayat profesional.</p>
                    <div class="mt-6 grid gap-4 sm:grid-cols-3">
                        @foreach ($others as $other)
                            <a href="{{ route('portfolio.experience.show', $other) }}" class="group rounded-2xl border border-slate-800 bg-slate-800/40 p-5 transition hover:border-cyan-500/30">
                                {{-- H3: kartu terkait --}}
                                <h3 class="break-words text-sm font-semibold leading-snug text-slate-200 transition group-hover:text-cyan-300">
                                    {{ $other->position }}
                                </h3>
                                <p class="mt-1 truncate text-xs text-slate-500">{{ $other->company }}</p>
                                <p class="mt-2 text-xs text-slate-600">{{ $other->period }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </article>
</x-public-layout>
