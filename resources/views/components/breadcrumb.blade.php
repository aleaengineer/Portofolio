{{--
    Breadcrumb publik. Props: $items = [['label' => 'Beranda', 'url' => '...'], ...].
    Item terakhir tanpa url dianggap halaman aktif.
--}}
@props(['items' => []])

@if (count($items) > 0)
    <nav aria-label="Breadcrumb" class="mb-6">
        <ol class="flex min-w-0 flex-wrap items-center gap-1.5 text-xs sm:text-sm">
            @foreach ($items as $index => $item)
                @if ($index > 0)
                    <li aria-hidden="true" class="select-none text-slate-600">/</li>
                @endif
                <li class="min-w-0">
                    @if (! empty($item['url']) && ! $loop->last)
                        <a href="{{ $item['url'] }}" class="text-slate-400 transition hover:text-cyan-300">{{ $item['label'] }}</a>
                    @else
                        <span aria-current="page" class="block truncate font-medium text-slate-200">{{ $item['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
