<x-admin.layout :breadcrumbs="[
    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
    ['label' => 'Error 405']
]">
    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow text-center">
        <h1 class="text-5xl font-extrabold text-red-600 mb-4">405</h1>
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Method Not Allowed</h2>
        <p class="text-gray-600 mb-6">
            Sorry, the request method is not allowed for this action.
        </p>
        <a href="{{ url()->previous() ?? route('admin.dashboard') }}" 
           class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
            Go Back
        </a>
    </div>
</x-admin.layout>
