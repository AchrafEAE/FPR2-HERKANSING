@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-5xl mx-auto px-6">
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <div>
                <h1 class="hero-title">Dashboard</h1>
                <p class="hero-sub">Beheer je bio en workflow-content vanuit één overzicht.</p>
            </div>
            <div class="flex gap-3 flex-wrap">
                <a href="{{ route('bio.edit') }}" class="btn-primary">Bio beheren</a>
                <a href="{{ route('posts.index') }}" class="btn-primary">Posts beheren</a>
            </div>
        </div>

        <div class="mt-10">
            @include('partials.study-progress', ['studyProgress' => $studyProgress])
        </div>



        <section class="mt-10">
            <div class="flex items-center justify-between gap-3 mb-4">
                <h2 class="text-2xl font-bold">Recente posts</h2>
                <a href="{{ route('posts.create') }}" class="btn-primary">Nieuwe post</a>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                @forelse ($posts as $post)
                <article class="feature-card text-left">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit($post->body, 140) }}</p>
                    <div class="mt-4 flex gap-3 flex-wrap">
                        <a href="{{ route('posts.show', $post) }}" class="btn-primary">Bekijk</a>
                        <a href="{{ route('posts.edit', $post) }}" class="btn-primary">Bewerk</a>
                    </div>
                </article>
                @empty
                <div class="feature-card text-left md:col-span-2">
                    <h3>Nog geen posts</h3>
                    <p>Maak je eerste concept aan om je workflow op te starten.</p>
                </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection
