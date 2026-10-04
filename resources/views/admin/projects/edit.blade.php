<x-admin-layout title="Edit Proyek">
    <div class="mb-8">
        <h2 class="text-xl font-bold tracking-tight text-white">Edit Proyek</h2>
        <p class="mt-1 text-sm text-slate-400">{{ $project->title }}</p>
    </div>

    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="rounded-2xl border border-slate-800 bg-slate-900/40 p-6 sm:p-8">
        @csrf
        @method('PUT')
        @include('admin.projects._form', ['submitLabel' => 'Perbarui Proyek'])
    </form>
</x-admin-layout>
