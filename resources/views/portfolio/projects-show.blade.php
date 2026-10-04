<x-public-layout
    :title="$project->title.' — Proyek Farhan Maulana Syidiq'"
    :description="$project->excerpt(160)"
    :image="$project->thumbnail_url">

    <article class="bg-slate-900">
        <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 sm:py-14 lg:px-8">
            <x-breadcrumb :items="[
                ['label' => 'Beranda', 'url' => route('portfolio.index')],
                ['label' => 'Proyek', 'url' => route('portfolio.projects')],
                ['label' => $project->title],
            ]" />

            <header class="mt-2">
                <h1 class="text-balance break-words text-3xl font-bold leading-tight tracking-tight sm:text-4xl">
                    {{ $project->title }}
                </h1>

                @if (count((array) $project->tech_stack) > 0)
                    <div class="mt-5 flex flex-wrap gap-2">
                        @foreach ((array) $project->tech_stack as $tech)
                            <span class="rounded-md border border-indigo-500/30 bg-indigo-500/10 px-2.5 py-1 text-xs font-medium text-indigo-300">
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <div class="mt-6 flex flex-wrap gap-3">
                    @if ($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-700 bg-slate-900/50 px-5 py-2.5 text-sm font-medium text-slate-200 transition hover:border-slate-500 hover:text-white">
                            GitHub
                        </a>
                    @endif
                    @if ($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2 rounded-xl border border-cyan-400/40 bg-cyan-400/5 px-5 py-2.5 text-sm font-medium text-cyan-300 transition hover:border-cyan-300 hover:bg-cyan-400/10">
                            Live Demo
                        </a>
                    @endif
                </div>
            </header>

            @if ($project->thumbnail_url)
                <figure class="mt-8 overflow-hidden rounded-2xl border border-slate-800 shadow-2xl shadow-indigo-500/10">
                    <a href="{{ $project->thumbnail_url }}"
                       data-lightbox="{{ $project->thumbnail_url }}"
                       data-lightbox-caption="{{ $project->title }}"
                       class="block cursor-zoom-in" title="Klik untuk memperbesar">
                        <img src="{{ $project->thumbnail_url }}" alt="Thumbnail proyek {{ $project->title }}" class="aspect-video w-full object-cover" loading="lazy">
                    </a>
                </figure>
            @endif

            <div class="mt-8 space-y-4 text-sm leading-relaxed text-slate-300 sm:text-base">
                @foreach (preg_split('/\R{2,}/', trim($project->description)) as $paragraph)
                    <p class="break-words">{{ $paragraph }}</p>
                @endforeach
            </div>

            @if ($related->isNotEmpty())
                <section class="mt-14">
                    <h2 class="text-xl font-bold tracking-tight">Proyek Terkait</h2>
                    <div class="mt-6 grid gap-6 sm:grid-cols-3">
                        @foreach ($related as $relatedProject)
                            <a href="{{ route('portfolio.projects.show', $relatedProject) }}" class="group rounded-2xl border border-slate-800 bg-slate-800/40 p-5 transition hover:border-indigo-500/40">
                                <h3 class="break-words text-sm font-semibold leading-snug text-slate-200 transition group-hover:text-indigo-300">
                                    {{ $relatedProject->title }}
                                </h3>
                                <p class="mt-2 line-clamp-2 text-xs leading-relaxed text-slate-500">{{ $relatedProject->excerpt(100) }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </article>
</x-public-layout>
