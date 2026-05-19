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

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="headline">Headline</label>
                    <input id="headline" name="headline" type="text" value="{{ old('headline', $bio->headline) }}">
                    @error('headline')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="years_experience">Ervaring (jaren)</label>
                    <input id="years_experience" name="years_experience" type="number" min="0" max="60" value="{{ old('years_experience', $bio->years_experience) }}">
                    @error('years_experience')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="location">Locatie</label>
                    <input id="location" name="location" type="text" value="{{ old('location', $bio->location) }}">
                    @error('location')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="availability">Beschikbaarheid</label>
                    <input id="availability" name="availability" type="text" value="{{ old('availability', $bio->availability) }}">
                    @error('availability')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="website_url">Website</label>
                    <input id="website_url" name="website_url" type="url" value="{{ old('website_url', $bio->website_url) }}">
                    @error('website_url')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="linkedin_url">LinkedIn</label>
                    <input id="linkedin_url" name="linkedin_url" type="url" value="{{ old('linkedin_url', $bio->linkedin_url) }}">
                    @error('linkedin_url')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="github_url">GitHub</label>
                    <input id="github_url" name="github_url" type="url" value="{{ old('github_url', $bio->github_url) }}">
                    @error('github_url')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-4">
                <label for="summary">Summary</label>
                <textarea id="summary" name="summary" rows="7">{{ old('summary', $bio->summary) }}</textarea>
                @error('summary')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>

            <div class="mt-6 flex gap-3 flex-wrap">
                <button type="submit" class="btn-primary">Opslaan</button>
                <a href="{{ route('dashboard') }}" class="btn-outline">Annuleren</a>
            </div>
        </form>
    </div>
</div>
@endsection
