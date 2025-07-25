<!-- SIDEBAR -->
<aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-gray-800 text-white transition-all duration-300 flex flex-col">

    <!-- App Logo / Title -->
    <div class="h-16 flex items-center justify-center border-b border-gray-700">
        <span x-show="sidebarOpen" x-cloak class="text-xl font-bold">AdminPanel</span>
        <span x-show="!sidebarOpen" x-cloak class="text-xl font-bold">AP</span>
    </div>

    <!-- User Info -->
    @php $admin = auth('admin')->user(); @endphp
    <div class="p-4 text-center">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=4B5563&color=fff"
            class="w-12 h-12 mx-auto rounded-full" />
        <div x-show="sidebarOpen" x-cloak class="mt-2">
            <div class="font-semibold">{{ $admin->name }}</div>
            <div class="text-sm text-gray-400">{{ ucfirst($admin->role) }}</div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-2 space-y-2">
        <a href="#" class="flex items-center space-x-3 hover:bg-gray-700 p-2 rounded">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M3 12h18M3 6h18M3 18h18"></path>
            </svg>
            <span x-show="sidebarOpen" x-cloak>Dashboard</span>
        </a>
        <a href="#" class="flex items-center space-x-3 hover:bg-gray-700 p-2 rounded">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <span x-show="sidebarOpen" x-cloak>Posts</span>
        </a>
    </nav>
    {{-- Logout --}}
    <form method="POST" action="{{ route('admin.logout') }}" class="mt-auto pt-4 border-t border-gray-700">
        @csrf
        <button type="submit"
            class="flex items-center gap-3 p-2 w-full rounded hover:bg-gray-700 transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
            </svg>
            <span x-show="sidebarOpen" x-cloak>Logout</span>
        </button>
    </form>
</aside>