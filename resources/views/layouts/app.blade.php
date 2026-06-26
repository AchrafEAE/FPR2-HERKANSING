<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Portfolio</title>

    {{-- Always load fallback CSS as safety net --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ filemtime(public_path('css/styles.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}?v={{ filemtime(public_path('css/theme.css')) }}">

    {{-- Load Vite compiled assets in production/dev with HMR --}}
    @if (app()->environment('production') || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}?v={{ filemtime(public_path('css/theme.css')) }}">
    @endif
</head>

<body>
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
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}" @if (request()->routeIs('dashboard')) aria-current="page" style="border-bottom: 3px solid #2563eb; color: #111827;" @endif>Dashboard</a>
                            <a href="{{ route('bio.edit') }}" class="nav-link {{ request()->routeIs('bio.*') ? 'is-active' : '' }}" @if (request()->routeIs('bio.*')) aria-current="page" style="border-bottom: 3px solid #2563eb; color: #111827;" @endif>Bio</a>
                            <a href="{{ route('posts.index') }}" class="nav-link {{ request()->routeIs('posts.*') ? 'is-active' : '' }}" @if (request()->routeIs('posts.*')) aria-current="page" style="border-bottom: 3px solid #2563eb; color: #111827;" @endif>Posts</a>
                            <a href="{{ route('profiles.index') }}" class="nav-link {{ request()->routeIs('profiles.*') ? 'is-active' : '' }}" @if (request()->routeIs('profiles.*')) aria-current="page" style="border-bottom: 3px solid #2563eb; color: #111827;" @endif>Profielen</a>
                            <a href="{{ route('frontend-demo') }}" class="nav-link {{ request()->routeIs('frontend-demo') ? 'is-active' : '' }}" @if (request()->routeIs('frontend-demo')) aria-current="page" style="border-bottom: 3px solid #2563eb; color: #111827;" @endif>API Demo</a>
                        </div>

                        <div class="ml-auto relative">
                            <details class="relative">
                                <summary class="cursor-pointer text-gray-700 list-none">{{ auth()->user()->email }} ▼</summary>
                                <div class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-50 py-2">
                                    <a href="{{ route('bio.public', auth()->user()) }}" class="nav-menu-link {{ request()->routeIs('bio.public') ? 'is-active' : '' }}" @if (request()->routeIs('bio.public')) aria-current="page" @endif>{{ auth()->user()->email }}</a>
                                    <a href="{{ route('bio.edit') }}" class="nav-menu-link {{ request()->routeIs('bio.*') && ! request()->routeIs('bio.public') ? 'is-active' : '' }}" @if (request()->routeIs('bio.*') && ! request()->routeIs('bio.public')) aria-current="page" @endif>Bio</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                    </form>
                                </div>
                            </details>
                        </div>

                        @else
                        <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'is-active' : '' }}" @if (request()->routeIs('login')) aria-current="page" style="border-bottom: 3px solid #2563eb; color: #111827;" @endif>Login</a>
                        <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'is-active' : '' }}" @if (request()->routeIs('register')) aria-current="page" style="border-bottom: 3px solid #2563eb; color: #111827;" @endif>Register</a>
                        @endauth
                    </div>
                </div>
                <button id="theme-toggle" class="ml-4 p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" aria-label="Toggle dark mode">🌙</button>
            </div>
        </div>
    </nav>
    <script src="{{ asset('js/theme-toggle.js') }}"></script>

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
