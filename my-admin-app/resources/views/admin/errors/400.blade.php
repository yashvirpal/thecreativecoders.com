<x-admin.layout :breadcrumbs="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Error ' . ($status ?? 400)]
    ]">
    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow text-center">
        <h1 class="text-5xl font-extrabold text-red-600 mb-4">{{ $status ?? 400 }}</h1>

        @php
            $title = match ($status) {
                403 => 'Forbidden',
                404 => 'Page Not Found',
                405 => 'Method Not Allowed',
                default => 'Client Error',
            };
        @endphp

        <h2 class="text-2xl font-semibold text-gray-700 mb-6">{{ $title }}</h2>
        <p class="text-gray-600 mb-6">
            {{ $message ?? 'An error occurred while processing your request.' }}
        </p>

        <a href="{{ url()->previous() ?? route('admin.dashboard') }}"
            class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
            Go Back
        </a>
    </div>
</x-admin.layout>