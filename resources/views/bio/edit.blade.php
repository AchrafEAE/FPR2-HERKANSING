@extends('layouts.app')

@section('title', 'Bio beheren')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-4xl mx-auto px-6">
        <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
            <div>
                <h1 class="hero-title">Bio beheren</h1>
                <p class="hero-sub">Werk je profieltekst, links en beschikbaarheid bij.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-outline">Terug naar dashboard</a>
        </div>

        @if (session('status'))
        <div class="feature-card mb-6 text-left">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('bio.update') }}" class="feature-card text-left">
            @csrf
            @method('PUT')

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

            <div class="form-grid form-grid--two">
                <div class="form-field">
                    <label for="headline" class="form-label">Headline <p class="form-help form-tip" tabindex="0">
                            <span class="form-tip-trigger" aria-hidden="true">i</span>
                            <span class="form-tip-text">Een korte titel die meteen laat zien wat je doet.</span>
                        </p></label>
                    <input id="headline" name="headline" type="text" value="{{ old('headline', $bio->headline) }}" class="form-input @error('headline') is-invalid @enderror" placeholder="Laravel developer / Front-end engineer">

                    @error('headline')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-field">
                    <label for="years_experience" class="form-label">Ervaring (jaren) <p class="form-help form-tip" tabindex="0">
                            <span class="form-tip-trigger" aria-hidden="true">i</span>
                            <span class="form-tip-text">Vul een realistisch aantal jaren in.</span>
                        </p></label>
                    <input id="years_experience" name="years_experience" type="number" min="0" max="60" value="{{ old('years_experience', $bio->years_experience) }}" class="form-input @error('years_experience') is-invalid @enderror" placeholder="5">

                    @error('years_experience')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-field">
                    <label for="location" class="form-label">Locatie <p class="form-help form-tip" tabindex="0">
                            <span class="form-tip-trigger" aria-hidden="true">i</span>
                            <span class="form-tip-text">Plaats of regio waar je werkt of woont.</span>
                        </p></label>
                    <input id="location" name="location" type="text" value="{{ old('location', $bio->location) }}" class="form-input @error('location') is-invalid @enderror" placeholder="Amsterdam">

                    @error('location')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-field">
                    <label for="availability" class="form-label">Beschikbaarheid <p class="form-help form-tip" tabindex="0">
                            <span class="form-tip-trigger" aria-hidden="true">i</span>
                            <span class="form-tip-text">Bijvoorbeeld full-time, freelance of open for work.</span>
                        </p></label>
                    <input id="availability" name="availability" type="text" value="{{ old('availability', $bio->availability) }}" class="form-input @error('availability') is-invalid @enderror" placeholder="Open for work">

                    @error('availability')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-field">
                    <label for="website_url" class="form-label">Website <p class="form-help form-tip" tabindex="0">
                            <span class="form-tip-trigger" aria-hidden="true">i</span>
                            <span class="form-tip-text">Laat leeg als je geen eigen website hebt.</span>
                        </p></label>
                    <input id="website_url" name="website_url" type="url" value="{{ old('website_url', $bio->website_url) }}" class="form-input @error('website_url') is-invalid @enderror" placeholder="https://jouwsite.nl">

                    @error('website_url')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-field">
                    <label for="linkedin_url" class="form-label">LinkedIn <p class="form-help form-tip" tabindex="0">
                            <span class="form-tip-trigger" aria-hidden="true">i</span>
                            <span class="form-tip-text">Zorg dat de link direct naar jouw profiel verwijst.</span>
                        </p></label>
                    <input id="linkedin_url" name="linkedin_url" type="url" value="{{ old('linkedin_url', $bio->linkedin_url) }}" class="form-input @error('linkedin_url') is-invalid @enderror" placeholder="https://linkedin.com/in/jij">

                    @error('linkedin_url')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-field">
                    <label for="github_url" class="form-label">GitHub <p class="form-help form-tip" tabindex="0">
                            <span class="form-tip-trigger" aria-hidden="true">i</span>
                            <span class="form-tip-text">Deel hier je profiel als je werk wilt laten zien.</span>
                        </p></label>
                    <input id="github_url" name="github_url" type="url" value="{{ old('github_url', $bio->github_url) }}" class="form-input @error('github_url') is-invalid @enderror" placeholder="https://github.com/jij">

                    @error('github_url')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-4 form-field">
                <label for="summary" class="form-label">Summary <p class="form-help form-tip" tabindex="0">
                        <span class="form-tip-trigger" aria-hidden="true">i</span>
                        <span class="form-tip-text">Schrijf in gewone taal en houd het concreet.</span>
                    </p></label>
                <textarea id="summary" name="summary" rows="7" class="form-textarea @error('summary') is-invalid @enderror" placeholder="Beschrijf kort wie je bent, wat je doet en waar je goed in bent.">{{ old('summary', $bio->summary) }}</textarea>

                @error('summary')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            <div class="mt-6 flex gap-3 flex-wrap">
                <button type="submit" class="btn-primary">Opslaan</button>
                <a href="{{ route('dashboard') }}" class="btn-outline">Annuleren</a>
            </div>
        </form>
    </div>
</div>
@endsection
