@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="hero">
    <div class="hero-inner max-w-4xl mx-auto px-6">
        <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
                <div>
                <h1 class="hero-title">{{ $post->title }}</h1>
                <p class="hero-sub">{{ $post->published_at ? 'Gepubliceerd op ' . $post->published_at->format('d-m-Y') : 'Concept' }}</p>
            </div>
            <div class="flex gap-3 flex-wrap">
                <a href="{{ route('posts.edit', $post) }}" class="btn-primary">Bewerken</a>
                <a href="{{ route('posts.index') }}" class="btn-outline">Terug</a>
            </div>
        </div>

        @if (session('status'))
            <div class="feature-card mb-6 text-left">
                {{ session('status') }}
            </div>
        @endif

        <article class="feature-card text-left">
            <p>{!! nl2br(e($post->body)) !!}</p>
            <div class="mt-6 flex gap-3 flex-wrap">
                @if (is_null($post->published_at))
                    <form method="POST" action="{{ route('posts.publish', $post) }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-outline">Publiceren</button>
                    </form>
                @endif
                <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-outline">Verwijderen</button>
                </form>
            </div>
        </article>
    </div>
</div>
@endsection
