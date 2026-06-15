<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edu Seria</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow mb-6">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('courses.index') }}" class="text-xl font-bold text-blue-600">Edu Seria</a>
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-blue-600">Courses</a>
                @auth
                    @if(auth()->user()->isEducator())
                        <a href="{{ route('courses.manage') }}" class="text-gray-600 hover:text-blue-600">My Courses</a>
                        <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-blue-600">Users</a>
                    @endif
                    @if(auth()->user()->isLearner())
                        <a href="{{ route('enrollments.my-learning') }}" class="text-gray-600 hover:text-blue-600">My Learning</a>
                    @endif
                    <span class="text-gray-400">{{ auth()->user()->name }}</span>
                    <a href="{{ route('profile') }}" class="text-gray-600 hover:text-blue-600">Profile</a>  {{-- ← add this --}}
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="text-red-500 hover:text-red-700">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-3 py-1 rounded">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 pb-12">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('header_title')
        @yield('content')
    </main>

</body>
</html>