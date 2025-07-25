<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - {{ $title ?? 'Dashboard' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex bg-gray-100 min-h-screen">
    
    @if(auth('admin')->check())
        <x-admin.partial.sidebar />
    @endif

    <main class="flex-1 p-6">
        {{ $slot }}
    </main>
</body>
</html>
