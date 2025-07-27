@if (session()->has('flash_notification'))
    <div class="fixed top-4 right-4 space-y-2 z-50">
        @foreach (session('flash_notification') as $message)
            @php
                $level = $message['level'] ?? 'info';
                $bgColor = match ($level) {
                    'success' => 'bg-green-500 text-white',
                    'danger' => 'bg-red-500 text-white',
                    'warning' => 'bg-yellow-400 text-black',
                    'info' => 'bg-blue-500 text-white',
                    default => 'bg-gray-700 text-white',
                };
            @endphp

            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                class="px-4 py-2 rounded shadow text-sm {{ $bgColor }} {{$level}}">
                {{ $message['message'] }}
            </div>
        @endforeach
    </div>
@endif