@extends('layouts.app')

@section('title', 'Frontend Fetch Demo')

@section('content')
<div class="hero">
    <div class="hero-inner max-w-3xl mx-auto px-6">
        <h1 class="hero-title">API Fetch Demo</h1>
        <p class="hero-sub">Deze pagina haalt data op via de interne API (`/api/v1/portfolio`) met behulp van JavaScript Fetch.</p>

        <div id="loading" class="mt-8 text-center">
            <p>Data ophalen...</p>
        </div>

        <div id="portfolio-card" class="feature-card mt-8 hidden">
            <h2 id="owner-name" class="text-2xl font-bold mb-2"></h2>
            <p id="headline" class="text-xl text-blue-600 mb-4"></p>
            <div id="summary" class="prose mb-6"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p><strong>Locatie:</strong> <span id="location"></span></p>
                    <p><strong>Beschikbaarheid:</strong> <span id="availability"></span></p>
                </div>
                <div>
                    <p id="website-link" class="hidden"><strong>Website:</strong> <a href="#" target="_blank" class="text-blue-500 hover:underline">Bezoek</a></p>
                    <p id="github-link" class="hidden"><strong>GitHub:</strong> <a href="#" target="_blank" class="text-blue-500 hover:underline">View Profile</a></p>
                </div>
            </div>
        </div>

        <div id="error" class="mt-8 hidden p-4 bg-red-100 text-red-700 rounded-lg">
            <p>Er is een fout opgetreden bij het laden van de portfolio data.</p>
        </div>

        <div class="mt-10">
            <a href="{{ route('home') }}" class="btn-primary">Terug naar Home</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const loading = document.getElementById('loading');
        const card = document.getElementById('portfolio-card');
        const error = document.getElementById('error');

        fetch('/api/v1/portfolio', {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('API request failed');
            return response.json();
        })
        .then(json => {
            const data = json.data;

            document.getElementById('owner-name').textContent = data.owner || 'Onbekende eigenaar';
            document.getElementById('headline').textContent = data.headline;
            document.getElementById('summary').textContent = data.summary;
            document.getElementById('location').textContent = data.location || 'Niet opgegeven';
            document.getElementById('availability').textContent = data.availability || 'Niet opgegeven';

            if (data.website_url) {
                const link = document.getElementById('website-link');
                link.classList.remove('hidden');
                link.querySelector('a').href = data.website_url;
            }

            if (data.github_url) {
                const link = document.getElementById('github-link');
                link.classList.remove('hidden');
                link.querySelector('a').href = data.github_url;
            }

            loading.classList.add('hidden');
            card.classList.remove('hidden');
        })
        .catch(err => {
            console.error(err);
            loading.classList.add('hidden');
            error.classList.remove('hidden');
        });
    });
</script>
@endsection
