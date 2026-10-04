<x-admin-layout title="Edit Pendidikan">
    <div class="mb-8">
        <h2 class="text-xl font-bold tracking-tight text-white">Edit Pendidikan</h2>
        <p class="mt-1 text-sm text-slate-400">Perbarui riwayat pendidikan di bawah ini.</p>
    </div>

    <form method="POST" action="{{ route('admin.educations.update', $education) }}" class="rounded-2xl border border-slate-800 bg-slate-900/40 p-6 sm:p-8">
        @csrf
        @method('PUT')
        @include('admin.educations._form', ['submitLabel' => 'Perbarui Pendidikan'])
    </form>
</x-admin-layout>
