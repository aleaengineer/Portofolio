<x-admin-layout title="Edit Pengalaman">
    <div class="mb-8">
        <h2 class="text-xl font-bold tracking-tight text-white">Edit Pengalaman</h2>
        <p class="mt-1 text-sm text-slate-400">Perbarui riwayat kerja di bawah ini.</p>
    </div>

    <form method="POST" action="{{ route('admin.experiences.update', $experience) }}" class="rounded-2xl border border-slate-800 bg-slate-900/40 p-6 sm:p-8">
        @csrf
        @method('PUT')
        @include('admin.experiences._form', ['submitLabel' => 'Perbarui Pengalaman'])
    </form>
</x-admin-layout>
