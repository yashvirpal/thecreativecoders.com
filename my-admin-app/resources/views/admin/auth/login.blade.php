<x-admin.layout>
    <div class="w-1/3 mx-auto mt-20 p-6 bg-white shadow rounded">
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <h2 class="text-xl font-bold mb-4">Admin Login</h2>

            <input type="email" name="email" placeholder="Email" class="w-full mb-3 p-2 border" required>
            <input type="password" name="password" placeholder="Password" class="w-full mb-3 p-2 border" required>

            <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">Login</button>
        </form>
    </div>
</x-admin.layout>
