@extends('layouts.app')

@section('title', 'Nieuwe post')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-4xl mx-auto px-6">
        <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
            <div>
                <h1 class="hero-title">Nieuwe post</h1>
                <p class="hero-sub">Start met een draft en zet hem daarna door naar review of publicatie.</p>
            </div>
            <a href="{{ route('posts.index') }}" class="btn-outline">Terug</a>
        </div>

        <form method="POST" action="{{ route('posts.store') }}" class="feature-card text-left">
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

            @include('posts.form', ['post' => $post])

            <div class="mt-6 flex gap-3 flex-wrap">
                <button type="submit" class="btn-primary">Opslaan</button>
                <a href="{{ route('posts.index') }}" class="btn-outline">Annuleren</a>
            </div>
        </form>
    </div>
</div>
@endsection
