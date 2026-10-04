<x-admin-layout title="Pesan Masuk">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-white">Pesan Masuk</h2>
            <p class="mt-1 text-sm text-slate-400">
                @if ($unreadCount > 0)
                    <span class="font-medium text-rose-400">{{ $unreadCount }} pesan belum dibaca</span> dari {{ $messages->total() }} total pesan.
                @else
                    Semua pesan sudah dibaca. Total {{ $messages->total() }} pesan.
                @endif
            </p>
        </div>
    </div>

    <div class="mt-8 overflow-hidden rounded-2xl border border-slate-800 bg-slate-800/40">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-left text-sm">
                <thead class="border-b border-slate-800 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-medium">Pengirim</th>
                        <th class="px-6 py-4 font-medium">Subjek</th>
                        <th class="px-6 py-4 font-medium">Waktu</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 text-right font-medium">Aksi</th>
                    </tr>
                </thead>

                @forelse ($messages as $message)
                    {{-- Satu tbody per pesan agar scope Alpine mencakup baris utama + baris detail --}}
                    <tbody x-data="{ expanded: false }" class="divide-y divide-slate-800/70 border-b border-slate-800/70 {{ $message->is_read ? '' : 'bg-indigo-500/[0.04]' }}">
                        <tr>
                            <td class="px-6 py-4">
                                <button type="button" @click="expanded = !expanded" class="group flex items-center gap-3 text-left">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500/30 to-cyan-500/30 text-xs font-semibold text-indigo-300">
                                        {{ strtoupper(substr($message->name, 0, 1)) }}
                                    </div>
                                    <span>
                                        <span class="block font-medium {{ $message->is_read ? 'text-slate-400' : 'text-white' }}">{{ $message->name }}</span>
                                        <span class="block text-xs text-slate-500">{{ $message->email }}</span>
                                    </span>
                                    <svg class="h-4 w-4 shrink-0 text-slate-600 transition group-hover:text-slate-400" :class="expanded && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                                    </svg>
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <button type="button" @click="expanded = !expanded" class="text-left transition hover:text-indigo-300 {{ $message->is_read ? 'text-slate-400' : 'font-medium text-white' }}">
                                    {{ $message->subject }}
                                </button>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-slate-400">
                                {{ $message->created_at?->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ $message->is_read ? 'bg-slate-500/10 text-slate-400 ring-1 ring-slate-600/40' : 'bg-rose-500/15 text-rose-400 ring-1 ring-rose-500/30' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $message->is_read ? 'bg-slate-500' : 'bg-rose-400' }}"></span>
                                    {{ $message->is_read ? 'Dibaca' : 'Baru' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <form method="POST" action="{{ route('admin.messages.toggleRead', $message) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" title="{{ $message->is_read ? 'Tandai belum dibaca' : 'Tandai sudah dibaca' }}"
                                                class="rounded-lg border border-slate-700 bg-slate-900/50 p-2 text-slate-400 transition hover:border-emerald-500/40 hover:text-emerald-400">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus pesan dari {{ addslashes($message->name) }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus pesan"
                                                class="rounded-lg border border-slate-700 bg-slate-900/50 p-2 text-slate-400 transition hover:border-rose-500/40 hover:text-rose-400">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- Baris detail: isi pesan lengkap --}}
                        <tr x-show="expanded" x-cloak x-transition:enter-opacity>
                            <td colspan="5" class="bg-slate-950/40 px-6 py-5">
                                <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">Isi Pesan</p>
                                <p class="whitespace-pre-line text-sm leading-relaxed text-slate-300">{{ $message->message }}</p>
                            </td>
                        </tr>
                    </tbody>
                @empty
                    <tbody>
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center text-sm text-slate-500">
                                Belum ada pesan masuk dari form kontak.
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
        </div>

        <div class="border-t border-slate-800 px-6 py-4">
            <x-pagination :paginator="$messages" />
        </div>
    </div>
</x-admin-layout>
