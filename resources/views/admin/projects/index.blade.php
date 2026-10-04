<x-admin-layout title="Kelola Proyek">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-white">Daftar Proyek</h2>
            <p class="mt-1 text-sm text-slate-400">Kelola proyek. Tandai unggulan untuk tampil di beranda.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Proyek
        </a>
    </div>

    <div class="mt-8 overflow-hidden rounded-2xl border border-slate-800 bg-slate-800/40">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] text-left text-sm">
                <thead class="border-b border-slate-800 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-medium">Proyek</th>
                        <th class="px-6 py-4 font-medium">Tech Stack</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Dibuat</th>
                        <th class="px-6 py-4 text-right font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/70">
                    @forelse ($projects as $project)
                        <tr class="transition hover:bg-slate-800/30">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    @if ($project->thumbnail_url)
                                        <img src="{{ $project->thumbnail_url }}" alt="" class="h-12 w-16 shrink-0 rounded-lg border border-slate-700 object-cover">
                                    @else
                                        <div class="flex h-12 w-16 shrink-0 items-center justify-center rounded-lg border border-slate-700 bg-slate-900/60">
                                            <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A1.5 1.5 0 0 0 21.75 19.5V4.5A1.5 1.5 0 0 0 20.25 3H3.75A1.5 1.5 0 0 0 2.25 4.5v15A1.5 1.5 0 0 0 3.75 21Z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-medium text-white">{{ $project->title }}</p>
                                        <p class="mt-0.5 text-xs text-slate-500">/{{ $project->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex max-w-[220px] flex-wrap gap-1.5">
                                    @foreach (array_slice((array) $project->tech_stack, 0, 3) as $tech)
                                        <span class="rounded-md border border-indigo-500/30 bg-indigo-500/10 px-2 py-0.5 text-xs font-medium text-indigo-300">{{ $tech }}</span>
                                    @endforeach
                                    @if (count((array) $project->tech_stack) > 3)
                                        <span class="px-1 py-0.5 text-xs text-slate-500">+{{ count((array) $project->tech_stack) - 3 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.projects.toggleFeatured', $project) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="{{ $project->is_featured ? 'Sembunyikan dari halaman publik' : 'Tampilkan di halaman publik' }}"
                                            class="inline-flex cursor-pointer items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold transition {{ $project->is_featured ? 'bg-emerald-500/15 text-emerald-400 ring-1 ring-emerald-500/30' : 'bg-slate-500/10 text-slate-400 ring-1 ring-slate-600/40' }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $project->is_featured ? 'bg-emerald-400' : 'bg-slate-500' }}"></span>
                                        {{ $project->is_featured ? 'Unggulan' : 'Biasa' }}
                                    </button>
                                </form>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-slate-400">
                                {{ $project->created_at?->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                       class="rounded-lg border border-slate-700 bg-slate-900/50 p-2 text-slate-400 transition hover:border-indigo-500/40 hover:text-indigo-300" title="Edit proyek">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus proyek &quot;{{ addslashes($project->title) }}&quot;?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg border border-slate-700 bg-slate-900/50 p-2 text-slate-400 transition hover:border-rose-500/40 hover:text-rose-400" title="Hapus proyek">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center text-sm text-slate-500">
                                Belum ada proyek. <a href="{{ route('admin.projects.create') }}" class="font-medium text-indigo-400 hover:text-indigo-300">Tambahkan proyek pertama</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-800 px-6 py-4">
            <x-pagination :paginator="$projects" />
        </div>
    </div>
</x-admin-layout>
