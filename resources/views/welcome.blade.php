@extends('layouts.app')

@section('title', 'Welkom')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-5xl mx-auto px-6 text-center">
        <h1 class="hero-title text-5xl mb-6">Mijn IT Development Portfolio</h1>
        <p class="hero-sub text-xl mb-10 max-w-2xl mx-auto">
            Welkom op mijn portfolio platform. Hier kun je mijn professionele bio bekijken,
            mijn studievoortgang volgen en mijn laatste blogposts lezen.
        </p>

        @guest
            <div class="flex justify-center gap-4 mb-16">
                <a href="{{ route('login') }}" class="btn-primary px-8 py-3">Inloggen</a>
                <a href="{{ route('register') }}" class="btn-outline px-8 py-3">Registreren</a>
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
            <h2 class="text-3xl font-bold mb-6">Ontdek mijn expertise</h2>
            <p class="text-gray-700 text-lg mb-8">
                Als ambitieuze developer in opleiding focus ik op het bouwen van robuuste webapplicaties.
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

<section class="bg-gray-50 py-20 border-t border-b">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-10">Functionele Eisen</h2>
        <div class="text-left space-y-4 max-w-2xl mx-auto">
            <div class="flex items-start gap-3">
                <span class="text-green-500 font-bold">✓</span>
                <p><strong>Blog Workflow:</strong> Beheer posts van concept naar publicatie.</p>
            </div>
            <div class="flex items-start gap-3">
                <span class="text-green-500 font-bold">✓</span>
                <p><strong>Study Dashboard:</strong> Visualisatie van behaalde EC's.</p>
            </div>
            <div class="flex items-start gap-3">
                <span class="text-green-500 font-bold">✓</span>
                <p><strong>Bio Management:</strong> Eenvoudig je professionele info bijwerken.</p>
            </div>
            <div class="flex items-start gap-3">
                <span class="text-green-500 font-bold">✓</span>
                <p><strong>Visitor View:</strong> Toegang tot bio en voortgang voor gasten.</p>
            </div>
        </div>
    </div>
</section>
@endsection
