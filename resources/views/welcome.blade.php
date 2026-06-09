@extends('layouts.app')

@section('title', 'Welkom')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-5xl mx-auto px-6 text-center">
        <h1 class="hero-title text-5xl mb-6">Mijn IT Development Portfolio</h1>
        @guest
            <div class="flex justify-center gap-4 mb-16">
                <a href="{{ route('login') }}" class="btn-primary px-8 py-3">Inloggen</a>
                <a href="{{ route('register') }}" class="btn-primary px-8 py-3">Registreren</a>
            </div>
        @else
            <div class="mb-16">
                <a href="{{ route('dashboard') }}" class="btn-primary px-8 py-3">Naar Dashboard</a>
            </div>
        @endguest
    </div>
</div>

<section class="max-w-6xl mx-auto px-6 py-20 border-t">
    <div class="grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="text-gray-700 text-lg mb-8">
                Als ambitieuze developer in opleiding focus ik op het bouwen van  webapplicaties.
                Bekijk mijn profiel om meer te leren over mijn achtergrond, vaardigheden en de projecten waaraan ik werk.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('profiles.index') }}" class="btn-primary">Bekijk alle profielen</a>
                <a href="{{ route('frontend-demo') }}" class="btn-outline">API Demo</a>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="feature-card p-8 bg-blue-50 border-blue-100">
                <h3 class="text-xl font-bold mb-2">Bio</h3>
                <p class="text-sm text-gray-600">Professionele achtergrond en vaardigheden.</p>
            </div>
            <div class="feature-card p-8 bg-green-50 border-green-100">
                <h3 class="text-xl font-bold mb-2">Progress</h3>
                <p class="text-sm text-gray-600">Real-time bijhouden van studiepunten.</p>
            </div>
            <div class="feature-card p-8 bg-purple-50 border-purple-100">
                <h3 class="text-xl font-bold mb-2">Blog</h3>
                <p class="text-sm text-gray-600">Insights over mijn leerproces.</p>
            </div>
            <div class="feature-card p-8 bg-yellow-50 border-yellow-100">
                <h3 class="text-xl font-bold mb-2">API</h3>
                <p class="text-sm text-gray-600">Moderne fetch-driven data integratie.</p>
            </div>
        </div>
    </div>
</section>
@endsection
