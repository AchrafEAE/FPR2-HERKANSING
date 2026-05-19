@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Create your account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">Maak eerst een account aan om bio's en posts te beheren.</p>
        </div>

        <form class="mt-8 space-y-6 form-card" action="{{ route('register') }}" method="POST">
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
                <label for="email" class="form-label">Email address <div class="password-hint form-help form-tip" tabindex="0">
                        <span class="form-tip-trigger" aria-hidden="true">i</span>
                        <span class="form-tip-text">Gebruik een e-mailadres dat je direct kunt openen voor bevestigingen en meldingen.</span>
                    </div></label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autocomplete="email"
                    value="{{ old('email') }}"
                    class="form-input @error('email') is-invalid @enderror"
                    placeholder="jij@voorbeeld.nl">

                @error('email')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-field">
                <div class="form-label">
                    <span>Password</span>
                    <div class="password-hint form-help form-tip" tabindex="0">
                        <span class="form-tip-trigger" aria-hidden="true">i</span>
                        <span class="form-tip-text">Kies een sterk wachtwoord met letters en cijfers. Gebruik dit wachtwoord nergens anders opnieuw.</span>
                    </div>
                </div>
                <div class="input-with-action">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        class="form-input @error('password') is-invalid @enderror"
                        placeholder="Minimaal 8 tekens">
                    <button type="button" class="input-icon-btn" data-password-toggle="password" aria-label="Toon of verberg wachtwoord"></button>
                </div>

                @error('password')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-field">
                <label for="password_confirmation" class="form-label">Confirm password<div class="form-help form-tip" tabindex="0">
                        <span class="form-tip-trigger" aria-hidden="true">i</span>
                        <span class="form-tip-text">Typ exact hetzelfde wachtwoord nog een keer om typefouten te voorkomen.</span>
                    </div></label>
                <div class="input-with-action">
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        class="form-input @error('password_confirmation') is-invalid @enderror"
                        placeholder="Herhaal je wachtwoord">
                    <button type="button" class="input-icon-btn" data-password-toggle="password_confirmation" aria-label="Toon of verberg bevestiging"></button>
                </div>

                @error('password_confirmation')
                <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button
                    type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create account
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                        Sign in here
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

<script>
    function renderPasswordToggle(button, isVisible) {
        button.innerHTML = isVisible ?
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" width="18" height="18"><path d="M3 3l18 18"></path><path d="M10.58 10.58A3 3 0 0 0 12 15a3 3 0 0 0 2.12-.88"></path><path d="M9.9 5.24A10.94 10.94 0 0 1 12 5c6.5 0 10 7 10 7a19.77 19.77 0 0 1-3.11 4.23"></path><path d="M6.61 6.61C4.27 8.36 2 12 2 12s3.5 7 10 7c1.06 0 2.05-.16 2.97-.45"></path></svg>' :
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" width="18" height="18"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
    }

    document.querySelectorAll('[data-password-toggle]').forEach((button) => {
        const input = document.getElementById(button.dataset.passwordToggle);
        if (input) {
            renderPasswordToggle(button, input.type !== 'password');
        }

        button.addEventListener('click', () => {
            const input = document.getElementById(button.dataset.passwordToggle);
            if (!input) {
                return;
            }

            const nextType = input.type === 'password' ? 'text' : 'password';
            input.type = nextType;
            renderPasswordToggle(button, nextType !== 'password');
            button.setAttribute('aria-label', nextType === 'password' ? 'Toon wachtwoord' : 'Verberg wachtwoord');
        });
    });
</script>
@endsection