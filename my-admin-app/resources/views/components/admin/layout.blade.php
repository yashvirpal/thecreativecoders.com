<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - {{ $title ?? 'Dashboard' }}</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100">
    @props(['breadcrumbs' => []])

    @if(auth('admin')->check())
        <x-admin.partial.sidebar />
    @endif
    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col">

        @if(auth('admin')->check())
            <x-admin.partial.header />
        @endif

        <!-- Page Content -->
        <main class="p-6">
            @if (isset($breadcrumbs) && is_array($breadcrumbs))
                <x-admin.partial.breadcrumb :items="$breadcrumbs" />
            @endif
            {{ $slot ?? 'Main content goes here.' }}
        </main>
    </div>
</body>

</html>