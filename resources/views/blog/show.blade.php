<x-public-layout
    :title="$post->title.' — Blog Farhan Maulana Syidiq'"
    :description="$post->excerpt_text"
    :image="$post->thumbnail_url"
    type="article">

    <article class="bg-slate-900">
        <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 sm:py-14 lg:px-8">

            <x-breadcrumb :items="[
                ['label' => 'Beranda', 'url' => route('portfolio.index')],
                ['label' => 'Blog', 'url' => route('blog.index')],
                ['label' => $post->title],
            ]" />

            {{-- Kepala artikel --}}
            <header class="mt-2">
                <div class="flex flex-wrap items-center gap-2">
                    @if ($post->category)
                        <a href="{{ route('blog.index', ['kategori' => $post->category]) }}"
                           class="inline-flex rounded-full border border-cyan-500/30 bg-cyan-500/10 px-3.5 py-1 text-xs font-semibold text-cyan-300 transition hover:border-cyan-400 hover:bg-cyan-500/20">
                            {{ $post->category }}
                        </a>
                    @endif
                    @foreach ((array) ($post->tags ?? []) as $tag)
                        <a href="{{ route('blog.index', ['tag' => $tag]) }}"
                           class="inline-flex rounded-full border border-slate-700 bg-slate-800/50 px-3 py-1 text-xs font-medium text-slate-300 transition hover:border-slate-500 hover:text-white">
                            #{{ $tag }}
                        </a>
                    @endforeach
                </div>

                <h1 class="mt-4 text-3xl font-bold leading-tight tracking-tight sm:text-4xl">
                    {{ $post->title }}
                </h1>

                <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-slate-400">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                        </svg>
                        Farhan Maulana Syidiq
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                        </svg>
                        {{ $post->published_at?->translatedFormat('d F Y') ?? '-' }}
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        {{ $post->reading_time }} menit baca
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        {{ number_format($post->views) }}x dibaca
                    </span>
                </div>
            </header>

            {{-- Thumbnail --}}
            @if ($post->thumbnail_url)
                <figure class="mt-8 overflow-hidden rounded-2xl border border-slate-800 shadow-2xl shadow-indigo-500/10">
                    <img src="{{ $post->thumbnail_url }}" alt="Ilustrasi artikel {{ $post->title }}" class="aspect-video w-full object-cover">
                </figure>
            @endif

            {{-- Isi artikel --}}
            <div class="prose prose-invert mt-10 max-w-none break-words
                        prose-headings:font-bold prose-headings:tracking-tight prose-headings:break-words
                        prose-p:break-words
                        prose-a:break-words prose-a:text-cyan-300 prose-a:decoration-cyan-400/40 hover:prose-a:text-cyan-200
                        prose-code:rounded-md prose-code:bg-slate-800 prose-code:px-1.5 prose-code:py-0.5 prose-code:text-cyan-300 prose-code:before:content-none prose-code:after:content-none
                        prose-pre:max-w-full prose-pre:overflow-x-auto prose-pre:border prose-pre:border-slate-800 prose-pre:bg-slate-950
                        prose-blockquote:border-l-cyan-500/60 prose-blockquote:text-slate-300
                        prose-img:h-auto prose-img:max-w-full prose-img:rounded-2xl prose-hr:border-slate-800
                        prose-table:block prose-table:max-w-full prose-table:overflow-x-auto">
                {!! $post->html_content !!}
            </div>

            {{-- Bagikan --}}
            <div x-data="{ copied: false }" class="mt-12 flex flex-wrap items-center gap-3 rounded-2xl border border-slate-800 bg-slate-800/40 p-5">
                <span class="text-sm font-semibold text-slate-300">Bagikan artikel ini:</span>
                @php($shareUrl = urlencode(url()->current()))
                @php($shareText = urlencode($post->title))
                <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" rel="noopener noreferrer" title="Bagikan ke WhatsApp"
                   class="rounded-lg border border-slate-700 bg-slate-900/50 p-2.5 text-slate-300 transition hover:border-emerald-500/40 hover:text-emerald-400">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ $shareText }}&url={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" title="Bagikan ke X / Twitter"
                   class="rounded-lg border border-slate-700 bg-slate-900/50 p-2.5 text-slate-300 transition hover:border-sky-500/40 hover:text-sky-400">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" title="Bagikan ke Facebook"
                   class="rounded-lg border border-slate-700 bg-slate-900/50 p-2.5 text-slate-300 transition hover:border-blue-500/40 hover:text-blue-400">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
                <button type="button" @click='navigator.clipboard.writeText(@json(url()->current())); copied = true; setTimeout(() => copied = false, 2000)'
                        :class="copied && 'border-emerald-500/40 text-emerald-400'"
                        class="rounded-lg border border-slate-700 bg-slate-900/50 p-2.5 text-slate-300 transition hover:border-slate-500 hover:text-white" title="Salin tautan">
                    <svg x-show="!copied" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.85-.682 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"/>
                    </svg>
                    <svg x-show="copied" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                    </svg>
                </button>
            </div>

            {{-- Navigasi antar artikel --}}
            <nav class="mt-12 grid gap-4 sm:grid-cols-2" aria-label="Artikel sebelumnya dan berikutnya">
                @if ($previous)
                    <a href="{{ route('blog.show', $previous) }}" class="group rounded-2xl border border-slate-800 bg-slate-800/40 p-5 transition hover:border-indigo-500/40">
                        <span class="flex items-center gap-1.5 text-xs font-medium text-slate-500">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                            Artikel sebelumnya
                        </span>
                        <span class="mt-2 block font-semibold text-slate-200 transition group-hover:text-indigo-300">{{ $previous->title }}</span>
                    </a>
                @endif
                @if ($next)
                    <a href="{{ route('blog.show', $next) }}" class="group rounded-2xl border border-slate-800 bg-slate-800/40 p-5 text-right transition hover:border-cyan-500/40 {{ ! $previous ? 'sm:col-start-2' : '' }}">
                        <span class="flex items-center justify-end gap-1.5 text-xs font-medium text-slate-500">
                            Artikel berikutnya
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                        </span>
                        <span class="mt-2 block font-semibold text-slate-200 transition group-hover:text-cyan-300">{{ $next->title }}</span>
                    </a>
                @endif
            </nav>

            {{-- Artikel terkait --}}
            @if ($related->isNotEmpty())
                <section class="mt-16">
                    <h2 class="text-xl font-bold tracking-tight">Artikel Terkait</h2>
                    <div class="mt-6 grid gap-6 sm:grid-cols-3">
                        @foreach ($related as $relatedPost)
                            <a href="{{ route('blog.show', $relatedPost) }}" class="group rounded-2xl border border-slate-800 bg-slate-800/40 p-5 transition hover:border-cyan-500/40">
                                <p class="text-xs font-semibold text-cyan-400">{{ $relatedPost->category ?? 'Umum' }}</p>
                                <h3 class="mt-2 text-sm font-semibold leading-snug text-slate-200 transition group-hover:text-cyan-300">
                                    {{ $relatedPost->title }}
                                </h3>
                                <p class="mt-2 text-xs text-slate-500">{{ $relatedPost->published_at?->translatedFormat('d F Y') }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </article>

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => $post->excerpt_text,
            'author' => ['@type' => 'Person', 'name' => 'Farhan Maulana Syidiq'],
            'datePublished' => $post->published_at?->toAtomString(),
            'dateModified' => ($post->updated_at ?? $post->published_at)?->toAtomString(),
            'mainEntityOfPage' => url()->current(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
</x-public-layout>
