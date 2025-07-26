<x-admin.layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>

        <p class="mb-6 text-gray-700">
            Welcome, <span class="font-semibold">{{ auth('admin')->user()->name }}</span> 
            (<span class="capitalize">{{ auth('admin')->user()->role }}</span>)
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Users</h2>
                <p class="text-2xl">{{ $usersCount ?? '—' }}</p>
            </div>

            <div class="bg-white rounded shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Posts</h2>
                <p class="text-2xl">{{ $postsCount ?? '—' }}</p>
            </div>

            <div class="bg-white rounded shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Reports</h2>
                <p class="text-2xl">{{ $reportsCount ?? '—' }}</p>
            </div>
        </div>

        <div class="space-x-4">
            <a href="{{-- route('admin.users.index') --}}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Manage Users</a>
            <a href="{{-- route('admin.posts.index') --}}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Manage Posts</a>
            <a href="{{-- route('admin.reports.index') --}}" class="inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">View Reports</a>
        </div>
    </div>
</x-admin.layout>
