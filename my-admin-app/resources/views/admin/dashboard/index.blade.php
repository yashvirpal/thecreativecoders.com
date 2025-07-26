<x-admin.layout>
<div class="p-6">
    <h1 class="text-2xl font-bold">Admin Dashboard</h1>
    <p>Welcome, {{ auth('admin')->user()->name }} ({{ auth('admin')->user()->role }})</p>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Logout</button>
    </form>
</div>
</x-admin.layout>
