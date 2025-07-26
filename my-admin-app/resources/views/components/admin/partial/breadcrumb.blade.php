<nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
    <ol class="list-reset flex items-center space-x-2">
        @foreach ($items as $index => $item)
            @if ($index === 0)
                <li>
                    <a href="{{ $item['url'] ?? '#' }}" class="hover:text-gray-700 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                        </svg>
                        {{ $item['label'] }}
                    </a>
                </li>
            @elseif (!empty($item['url']) && $index !== count($items) - 1)
                <li><a href="{{ $item['url'] }}" class="hover:text-gray-700">{{ $item['label'] }}</a></li>
                <li class="text-gray-400">/</li>
            @else
                <li class="text-gray-700 font-medium">{{ $item['label'] }}</li>
            @endif
        @endforeach

    </ol>
</nav>