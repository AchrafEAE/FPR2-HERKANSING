@extends('layouts.app')

@section('title', 'Mijn Bio')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-3xl mx-auto px-6">
        <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
            <div>
                <h1 class="hero-title">Mijn bio</h1>
                <p class="hero-sub">Bekijk je profielgegevens</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('bio.edit') }}" class="btn-primary">Bio bewerken</a>
            </div>
        </div>

        <div class="feature-card">
            @if ($bio)
                <h2 class="text-xl font-semibold">{{ $bio->headline }}</h2>
                <p class="mt-2">{{ $bio->summary }}</p>
                <p class="mt-4 text-sm text-gray-600">{{ $bio->availability }}</p>
            @else
                <p>Je hebt nog geen bio ingevuld. Klik op "Bio bewerken" om er één aan te maken.</p>
            @endif
        </div>
    </div>
</div>
@endsection
