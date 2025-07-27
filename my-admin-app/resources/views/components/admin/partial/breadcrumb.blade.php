<nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
    <ol class="list-reset flex items-center space-x-2">
        @foreach ($items as $index => $item)
            @if ($index === 0)
                <li class="flex items-center gap-1">
                    <a href="{{ $item['url'] ?? '#' }}" class="hover:text-gray-700 flex items-center gap-1">
                        <x-heroicon-o-home class="w-5 h-5 text-gray-500" />
                        {{ $item['label'] }}
                    </a>
                </li>
            @elseif (!empty($item['url']) && $index !== count($items) - 1)
                <li class="flex items-center gap-1">
                    <span class="text-gray-400">/</span>
                    <a href="{{ $item['url'] }}" class="hover:text-gray-700">{{ $item['label'] }}</a>
                </li>
            @else
                <li class="flex items-center gap-1">
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-700 font-medium">{{ $item['label'] }}</span>
                </li>
            @endif
        @endforeach


    </ol>
</nav>