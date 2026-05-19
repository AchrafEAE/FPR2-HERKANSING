@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Sign in to your account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">Gebruik je e-mail en wachtwoord om verder te gaan.</p>
        </div>

        <form class="mt-8 space-y-6 form-card" action="{{ route('login') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="form-error-summary">
                    <strong>Controleer je invoer.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-field">
                <label for="email" class="form-label">Email address</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autocomplete="email"
                    value="{{ old('email') }}"
                    class="form-input @error('email') is-invalid @enderror"
                    placeholder="jij@voorbeeld.nl"
                >
                <p class="form-help">Gebruik het e-mailadres waarmee je een account hebt aangemaakt.</p>
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-field">
                <div class="form-label">
                    <span>Password</span>
                </div>
                <div class="input-with-action">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        class="form-input @error('password') is-invalid @enderror"
                        placeholder="Minimaal 8 tekens"
                    >
                    <button type="button" class="input-icon-btn" data-password-toggle="password" aria-label="Toon of verberg wachtwoord">👁</button>
                </div>
                <div class="password-hint form-help form-tip" tabindex="0">
                    <span class="form-tip-trigger" aria-hidden="true">i</span>
                    <span class="form-tip-text">Kies een wachtwoord dat je nog niet op andere plekken gebruikt en deel het nooit met iemand anders.</span>
                </div>
                @error('password')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    >
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Onthoud mij
                    </label>
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Sign in
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Geen account?
                    <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Registreer hier
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('[data-password-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const input = document.getElementById(button.dataset.passwordToggle);
            if (!input) {
                return;
            }

            const nextType = input.type === 'password' ? 'text' : 'password';
            input.type = nextType;
            button.textContent = nextType === 'password' ? '👁' : '🙈';
            button.setAttribute('aria-label', nextType === 'password' ? 'Toon wachtwoord' : 'Verberg wachtwoord');
        });
    });
</script>
@endsection
