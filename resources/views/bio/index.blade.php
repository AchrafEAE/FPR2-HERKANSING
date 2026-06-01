@extends('layouts.app')

@section('title', 'Profielen')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-6xl mx-auto px-6">
        <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
            <div>
                <h1 class="hero-title">Alle profielen</h1>
                <p class="hero-sub">Bekijk alle gebruikers en hun korte bio.</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            @foreach ($users as $user)
                <article class="feature-card">
                    <h3 class="font-semibold">{{ $user->email }}</h3>
                    @if ($user->bio)
                        <p class="text-sm text-gray-700 mt-2">{{ \Illuminate\Support\Str::limit($user->bio->summary, 160) }}</p>
                        <div class="mt-3 flex gap-3">
                            <a href="{{ route('bio.public', $user) }}" class="btn-outline">Bekijk profiel</a>
                            <a href="{{ route('bio.public', $user) }}#contact" class="btn-outline">Contact</a>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 mt-2">Geen bio beschikbaar</p>
                    @endif
                </article>
            @endforeach
        </div>
    </div>
</div>
@endsection
