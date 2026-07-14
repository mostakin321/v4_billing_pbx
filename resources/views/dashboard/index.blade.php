<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<nav class="bg-white shadow px-6 py-4 flex items-center justify-between">
    <h1 class="text-xl font-bold text-gray-800">{{ config('app.name') }}</h1>
    <div class="flex items-center gap-4">
        <span class="text-sm text-gray-600">Hello, <strong>{{ auth()->user()->name }}</strong></span>
        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
            {{ auth()->user()->getRoleNames()->first() ?? 'user' }}
        </span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg transition">
                Logout
            </button>
        </form>
    </div>
</nav>
<div class="max-w-5xl mx-auto py-10 px-4">
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">{{ session('success') }}</div>
    @endif
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Your Role</p>
            <p class="text-2xl font-bold text-blue-600 mt-1 capitalize">{{ auth()->user()->getRoleNames()->first() ?? 'N/A' }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Email</p>
            <p class="text-lg font-semibold text-gray-700 mt-1">{{ auth()->user()->email }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Member Since</p>
            <p class="text-lg font-semibold text-gray-700 mt-1">{{ auth()->user()->created_at->format('d M Y') }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Your Permissions</h3>
        <div class="flex flex-wrap gap-2">
            @forelse(auth()->user()->getAllPermissions() as $permission)
                <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">{{ $permission->name }}</span>
            @empty
                <p class="text-sm text-gray-400">No permissions assigned.</p>
            @endforelse
        </div>
    </div>
    @if(auth()->user()->hasRole('admin'))
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4 flex items-center justify-between">
            <span class="text-sm text-yellow-800 font-medium">You have admin access</span>
            <a href="/admin" class="text-sm bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">
                Go to Admin Panel →
            </a>
        </div>
    @endif
</div>
</body>
</html>
