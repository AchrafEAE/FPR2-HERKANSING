<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
                        @auth
                            <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900">
                                Posts
                            </a>
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">
                                Dashboard
                            </a>
                            <a href="{{ route('bio.edit') }}" class="text-gray-600 hover:text-gray-900">
                                Bio
                            </a>

                            <div class="relative">
                                <details class="relative">
                                    <summary class="cursor-pointer text-gray-700 list-none">Mijn profiel</summary>
                                    <div class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-50 py-2">
                                        <a href="{{ route('bio.public', auth()->user()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mijn profiel</a>
                                        <a href="{{ route('profiles.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profielen</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                                        </form>
                                    </div>
                                </details>
                            </div>

                        @else
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">
                        Portfolio
                    </a>
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-4">
                        @auth
                            <a href="{{ route('bio.public', auth()->user()) }}" class="text-gray-700">Mijn profiel</a>
                            <a href="{{ route('profiles.index') }}" class="text-gray-600 hover:text-gray-900">Profielen</a>
                            <a href="{{ route('bio.edit') }}" class="text-gray-600 hover:text-gray-900">
                                Bio
                            </a>
                            <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900">
                                Posts
                            </a>
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-gray-900">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Register
                            </a>
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
