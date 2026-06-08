<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Portfolio</title>

    {{-- Always load fallback CSS as safety net --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    {{-- Load Vite compiled assets in production/dev with HMR --}}
    @if (app()->environment('production') || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">
                        Portfolio
                    </a>
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-4 w-full">
                        @auth
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900">Posts</a>
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">Dashboard</a>
                            <a href="{{ route('profiles.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profielen</a>

                            <a href="{{ route('frontend-demo') }}" class="text-gray-600 hover:text-gray-900">API Demo</a>
                        </div>

                        <div class="ml-auto relative">
                            <details class="relative">
                                <summary class="cursor-pointer text-gray-700 list-none">{{ auth()->user()->email }} ▼</summary>
                                <div class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-50 py-2">
                                    <a href="{{ route('bio.public', auth()->user()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ auth()->user()->email }}</a>
                                    <a href="{{ route('bio.edit') }}" class="text-gray-600 hover:text-gray-900">Bio</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                    </form>
                                </div>
                            </details>
                        </div>

                        @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white mt-8 py-8 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} Portfolio. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
