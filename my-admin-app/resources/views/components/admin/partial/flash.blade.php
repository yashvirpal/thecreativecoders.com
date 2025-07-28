@if (session()->has('flash_notification'))
    <div class="fixed top-5 right-5 z-50 space-y-3 w-80 max-w-full">
        @foreach (session('flash_notification') as $message)
            @php
                $level = $message['level'] ?? 'info';

                $styles = match ($level) {
                    'success' => 'bg-green-100 text-green-800 border-green-300',
                    'error', 'danger' => 'bg-red-100 text-red-800 border-red-300',
                    'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                    'info' => 'bg-blue-100 text-blue-800 border-blue-300',
                    default => 'bg-gray-100 text-gray-800 border-gray-300',
                };

                $icons = match ($level) {
                    'success' => '✓',
                    'error', 'danger' => '⚠',
                    'warning' => '⚠',
                    'info' => 'ℹ',
                    default => '🔔',
                };
            @endphp

            <div
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 4000)"
                x-transition
                class="flex items-start gap-3 border-l-4 p-4 rounded shadow {{ $styles }}"
            >
                <div class="text-xl">{{ $icons }}</div>
                <div class="text-sm font-medium leading-tight">
                    {{ $message['message'] }}
                </div>
                <button @click="show = false" class="ml-auto text-lg leading-none">&times;</button>
            </div>
        @endforeach
    </div>
@endif
