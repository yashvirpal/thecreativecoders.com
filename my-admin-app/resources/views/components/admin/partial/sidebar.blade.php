<!-- SIDEBAR -->
<aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-gray-800 text-white transition-all duration-300 flex flex-col">

    <!-- App Logo / Title -->
    <div class="h-16 flex items-center justify-center border-b border-gray-700">
        <span x-show="sidebarOpen" x-cloak class="text-xl font-bold">{{config('app.name')}}</span>
        <span x-show="!sidebarOpen" x-cloak class="text-xl font-bold">{{ getAppInitials() }}</span>
    </div>

    <!-- User Info -->
    @php $admin = auth('admin')->user(); @endphp
    <div class="p-4 text-center border-b border-gray-700">
        @if ($admin->avatar)
            <img src="{{ asset('storage/avatars/' . $admin->avatar) }}"
                class="w-12 h-12 rounded-full mx-auto object-cover" />
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=4B5563&color=fff"
                class="w-12 h-12 mx-auto rounded-full" />
        @endif
        <div x-show="sidebarOpen" x-cloak class="mt-2">
            <div class="font-semibold">{{ $admin->name }}</div>
            <div class="text-sm text-gray-400">{{ str_replace("_", " ", ucfirst($admin->role)) }}</div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-2 space-y-2">
        <a href="#" class="flex items-center space-x-3 hover:bg-gray-700 p-2 rounded">
            <x-heroicon-o-home class="w-5 h-5 text-gray-500" />
            <span x-show="sidebarOpen" x-cloak>Dashboard</span>
        </a>
        <a href="{{ route('admin.blogs.index') }}" class="flex items-center space-x-3 hover:bg-gray-700 p-2 rounded">
            <x-heroicon-o-book-open class="w-5 h-5 text-gray-500" />
            <span x-show="sidebarOpen" x-cloak>Blogs</span>
        </a>
    </nav>
    {{-- Logout --}}
    <form method="POST" action="{{ route('admin.logout') }}" class="mt-auto border-t border-red-500">
        @csrf
        <button type="submit" class="flex items-center gap-3 p-2 w-full bg-red-500 transition duration-200">
            <x-heroicon-o-power class="w-5 h-5 text-white-500" />
            <span x-show="sidebarOpen" x-cloak>Logout</span>
        </button>
    </form>
</aside>