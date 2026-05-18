@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-4xl mx-auto text-center py-20 px-6">
        <h1 class="hero-title">Welcome to my Portfolio</h1>
        <p class="hero-sub">I build web apps, APIs and delightful user experiences.</p>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('login') }}" class="btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn-outline">Register</a>
        </div>
    </div>
</div>

<section class="features max-w-4xl mx-auto py-12 px-6">
    <div class="grid md:grid-cols-3 gap-6">
        <div class="feature-card">
            <h3>Projects</h3>
            <p>Selected examples of my work.</p>
        </div>
        <div class="feature-card">
            <h3>About</h3>
            <p>Short bio and background.</p>
        </div>
        <div class="feature-card">
            <h3>Contact</h3>
            <p>Get in touch for collaborations.</p>
        </div>
    </div>
</section>
@endsection
