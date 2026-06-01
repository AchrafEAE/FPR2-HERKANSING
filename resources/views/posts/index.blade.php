@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-5xl mx-auto px-6">
        <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
            <div>
                <h1 class="hero-title">Posts</h1>
                <p class="hero-sub">Werk aan je draft, review en publicatie workflow.</p>
            </div>
            <div class="flex gap-3 flex-wrap">
                <a href="{{ route('posts.create') }}" class="btn-primary">Nieuwe post</a>
                <a href="{{ route('dashboard') }}" class="btn-outline">Dashboard</a>
            </div>
        </div>

        @if (session('status'))
        <div class="feature-card mb-6 text-left">
            {{ session('status') }}
        </div>
        @endif

        <div class="grid md:grid-cols-2 gap-6">
            @forelse ($posts as $post)
            <article class="feature-card text-left">
                <h3>{{ $post->title }}</h3>
                <p>{{ \Illuminate\Support\Str::limit($post->body, 140) }}</p>
                <div class="mt-4 flex gap-3 flex-wrap">
                    <a href="{{ route('posts.show', $post) }}" class="btn-outline">Bekijk</a>
                    <a href="{{ route('posts.edit', $post) }}" class="btn-outline">Bewerk</a>
                    <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-outline">Verwijder</button>
                    </form>
                </div>
            </article>
            @empty
            <div class="feature-card text-left md:col-span-2">
                <h3>Geen posts gevonden</h3>
                <p>Maak je eerste concept aan om de workflow te starten.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
