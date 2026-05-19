@extends('layouts.app')

@section('title', 'Post bewerken')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-4xl mx-auto px-6">
        <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
            <div>
                <h1 class="hero-title">Post bewerken</h1>
                <p class="hero-sub">Wijzig titel, inhoud en status.</p>
            </div>
            <a href="{{ route('posts.index') }}" class="btn-outline">Terug</a>
        </div>

        @if (session('status'))
            <div class="feature-card mb-6 text-left">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('posts.update', $post) }}" class="feature-card text-left">
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

            @include('posts.form', ['post' => $post])

            <div class="mt-6 flex gap-3 flex-wrap">
                <button type="submit" class="btn-primary">Bijwerken</button>
                <a href="{{ route('posts.show', $post) }}" class="btn-outline">Bekijk</a>
            </div>
        </form>
    </div>
</div>
@endsection
