@extends('layouts.app')

@section('title', $isOwner ? 'Mijn bio' : 'Bio van '.($user->name ?: $user->email))

@section('content')
    <div class="hero">
        <div class="hero-inner max-w-3xl mx-auto px-6">
            <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
                <div>
                    <h1 class="hero-title">{{ $bio ? $bio->headline : ($isOwner ? 'Mijn bio' : 'Bio van '.($user->name ?: $user->email)) }}</h1>
                    <p class="hero-sub">{{ $isOwner ? 'Bekijk je profielgegevens' : 'Bekijk de bio van de eigenaar' }}</p>
                </div>
                @if ($isOwner)
                    <div class="flex gap-3">
                        <a href="{{ route('bio.edit') }}" class="btn-primary">Bio bewerken</a>
                    </div>
                @endif
            </div>

            @if ($bio)
                <div class="feature-card">
                    <div class="prose">
                        @if ($bio->avatar_path)
                            <div style="margin-bottom:1rem;display:flex;align-items:center;gap:1rem;">
                                <img src="{{ asset('storage/' . $bio->avatar_path) }}" alt="Avatar van {{ $user->name ?? $user->email }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover;">
                            </div>
                        @endif
                        <p class="lead">{{ $bio->summary }}</p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                        <div>
                            @if ($bio->location)
                                <p><strong>Locatie:</strong> {{ $bio->location }}</p>
                            @endif
                            @if ($bio->availability)
                                <p><strong>Beschikbaarheid:</strong> {{ $bio->availability }}</p>
                            @endif
                            @if (! is_null($bio->years_experience))
                                <p><strong>Jaren ervaring:</strong> {{ $bio->years_experience }}</p>
                            @endif
                        </div>

                        <div>
                            @if ($bio->website_url)
                                <p><strong>Website:</strong> <a href="{{ $bio->website_url }}" target="_blank"
                                                                rel="noopener">{{ $bio->website_url }}</a></p>
                            @endif
                            @if ($bio->linkedin_url)
                                <p><strong>LinkedIn:</strong> <a href="{{ $bio->linkedin_url }}" target="_blank"
                                                                 rel="noopener">{{ $bio->linkedin_url }}</a></p>
                            @endif
                            @if ($bio->github_url)
                                <p><strong>GitHub:</strong> <a href="{{ $bio->github_url }}" target="_blank"
                                                               rel="noopener">{{ $bio->github_url }}</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="feature-card text-left">
                    <h3>Geen bio gevonden</h3>
                    <p>{{ $isOwner ? 'Je hebt nog geen bio ingevuld. Klik op "Bio bewerken" om er één aan te maken.' : 'Deze gebruiker heeft nog geen bio ingevuld.' }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
