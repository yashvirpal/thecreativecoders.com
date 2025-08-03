<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow text-center">
    <h1 class="text-5xl font-extrabold text-gray-700 mb-4">500</h1>
    <h2 class="text-2xl font-semibold text-gray-600 mb-6">Oops! Something went wrong on the server.</h2>
    <p class="text-gray-500 mb-6">
        {{ $message ?? 'Please try again later or contact support.'}}
    </p>
    <a href="{{ route('/') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
        Home
    </a>
</div>