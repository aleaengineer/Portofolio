<x-admin-layout title="Kelola Pengalaman">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-white">Daftar Pengalaman</h2>
            <p class="mt-1 text-sm text-slate-400">Riwayat kerja yang tampil di halaman pengalaman publik.</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Pengalaman
        </a>
    </div>

    <div class="mt-8 overflow-hidden rounded-2xl border border-slate-800 bg-slate-800/40">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-left text-sm">
                <thead class="border-b border-slate-800 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-medium">Posisi / Perusahaan</th>
                        <th class="px-6 py-4 font-medium">Periode</th>
                        <th class="px-6 py-4 font-medium">Urutan</th>
                        <th class="px-6 py-4 text-right font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/70">
                    @forelse ($experiences as $experience)
                        <tr class="transition hover:bg-slate-800/30">
                            <td class="px-6 py-4">
                                <p class="font-medium text-white">{{ $experience->position }}</p>
                                <p class="mt-0.5 text-xs text-slate-500">{{ $experience->company }}{{ $experience->location ? ' — '.$experience->location : '' }}</p>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-slate-400">{{ $experience->period }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $experience->sort_order }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.experiences.edit', $experience) }}"
                                       class="rounded-lg border border-slate-700 bg-slate-900/50 p-2 text-slate-400 transition hover:border-indigo-500/40 hover:text-indigo-300" title="Edit">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.experiences.destroy', $experience) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus pengalaman &quot;{{ addslashes($experience->position) }}&quot;?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg border border-slate-700 bg-slate-900/50 p-2 text-slate-400 transition hover:border-rose-500/40 hover:text-rose-400" title="Hapus">
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
                            <td colspan="4" class="px-6 py-14 text-center text-sm text-slate-500">
                                Belum ada pengalaman. <a href="{{ route('admin.experiences.create') }}" class="font-medium text-indigo-400 hover:text-indigo-300">Tambahkan yang pertama</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-800 px-6 py-4">
            <x-pagination :paginator="$experiences" />
        </div>
    </div>
</x-admin-layout>
