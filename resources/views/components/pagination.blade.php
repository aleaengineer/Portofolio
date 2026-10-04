{{--
    Pagination minimalis bertema gelap.
    Props: $paginator (instance LengthAwarePaginator/ Paginator).
--}}
@props(['paginator'])

@if ($paginator->hasPages())
    <nav class="mt-12 flex items-center justify-between gap-4" aria-label="Navigasi halaman">
        {{-- Tombol sebelumnya --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex cursor-not-allowed items-center gap-2 rounded-xl border border-slate-800 bg-slate-800/30 px-4 py-2.5 text-sm font-medium text-slate-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
                Sebelumnya
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-800/50 px-4 py-2.5 text-sm font-medium text-slate-200 transition hover:border-indigo-500/40 hover:text-white">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
                Sebelumnya
            </a>
        @endif

        <span class="text-sm text-slate-500">
            Halaman <span class="font-semibold text-slate-300">{{ $paginator->currentPage() }}</span>
            dari <span class="font-semibold text-slate-300">{{ $paginator->lastPage() }}</span>
        </span>

        {{-- Tombol berikutnya --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-800/50 px-4 py-2.5 text-sm font-medium text-slate-200 transition hover:border-indigo-500/40 hover:text-white">
                Berikutnya
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        @else
            <span class="inline-flex cursor-not-allowed items-center gap-2 rounded-xl border border-slate-800 bg-slate-800/30 px-4 py-2.5 text-sm font-medium text-slate-600">
                Berikutnya
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </span>
        @endif
    </nav>
@endif
