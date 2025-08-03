<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow text-center">
    <h1 class="text-5xl font-extrabold text-gray-700 mb-4">{{ $status ?? 400 }}</h1>
    <h2 class="text-2xl font-semibold text-gray-600 mb-6">Page Not Found</h2>
    <p class="text-gray-500 mb-6">
        {{ $message ?? 'Sorry, the page you are looking for does not exist or has been moved.'}}
    </p>
    <a href="{{ route('/') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
        Home
    </a>
</div>