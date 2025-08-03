{{-- resources/views/admin/errors/fallback.blade.php --}}
<x-admin.layout :breadcrumbs="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Error']
]">
    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow text-center">
        <h1 class="text-5xl font-extrabold text-red-600 mb-4">{{ $status ?? 500 }}</h1>
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Oops! Something went wrong.</h2>
        <p class="text-gray-600 mb-6">
            {{ $message ?? 'An unexpected error occurred while processing your request.' }}
        </p>
        <a href="{{ route('admin.dashboard') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
            Go to Dashboard
        </a>
    </div>
</x-admin.layout>
