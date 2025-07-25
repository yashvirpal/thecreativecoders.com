<!-- Header -->
@php $admin = auth('admin')->user(); @endphp
<header class="h-16 bg-white shadow flex items-center justify-between px-4">
    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-700">
        <svg x-show="!sidebarOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <svg x-show="sidebarOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="flex items-center space-x-3">
        <span class="text-sm text-gray-600">{{ $admin->name }}</span>
        <span class="text-xs text-gray-400">({{ ucfirst($admin->role) }})</span>
    </div>
</header>