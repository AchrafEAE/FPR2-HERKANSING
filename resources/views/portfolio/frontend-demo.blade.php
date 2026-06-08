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

        <div id="stats-card" class="feature-card mt-6 hidden">
            <h3 class="font-bold mb-2 text-gray-700">Live Statistieken (Interne API Endpoint 2)</h3>
            <div class="grid grid-cols-2 gap-4 text-center">
                <div class="bg-gray-50 p-3 rounded">
                    <div id="stat-users" class="text-2xl font-bold text-blue-600">-</div>
                    <div class="text-xs text-gray-500 uppercase tracking-wide">Gebruikers</div>
                </div>
                <div class="bg-gray-50 p-3 rounded">
                    <div id="stat-posts" class="text-2xl font-bold text-blue-600">-</div>
                    <div class="text-xs text-gray-500 uppercase tracking-wide">Publicaties</div>
                </div>
            </div>
            <p class="text-[10px] text-gray-400 mt-4 text-right italic">Server tijd: <span id="stat-time"></span></p>
        </div>

        <div id="external-api-card" class="feature-card mt-6">
            <h3 class="font-bold mb-2 text-gray-700">Inspiratie (Externe API: ZenQuotes)</h3>
            <blockquote id="quote-text" class="italic text-gray-600">"Loading quote..."</blockquote>
            <p id="quote-author" class="text-sm mt-2 text-gray-500">- ...</p>
        </div>

        <div id="error" class="mt-8 hidden p-4 bg-red-100 text-red-700 rounded-lg">
            <p>Er is een fout opgetreden bij het laden van de portfolio data.</p>
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('home') }}" class="btn-primary">Terug naar Home</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const loading = document.getElementById('loading');
        const card = document.getElementById('portfolio-card');
        const statsCard = document.getElementById('stats-card');
        const error = document.getElementById('error');

        // 1. Fetch Portfolio Data (Internal API)
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

        // 2. Fetch Stats Data (Internal API Endpoint 2)
        fetch('/api/v1/stats', {
            headers: { 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(json => {
            document.getElementById('stat-users').textContent = json.data.total_users;
            document.getElementById('stat-posts').textContent = json.data.total_posts;
            document.getElementById('stat-time').textContent = json.data.server_time;
            statsCard.classList.remove('hidden');
        });

        // 3. Fetch Quote Data (External API)
        fetch('https://quoteslater.vercel.app/api/quote')
        .then(r => r.json())
        .then(data => {
            document.getElementById('quote-text').textContent = `"${data.quote}"`;
            document.getElementById('quote-author').textContent = `- ${data.author}`;
        })
        .catch(() => {
            document.getElementById('quote-text').textContent = "Blijf bouwen, blijf leren.";
            document.getElementById('quote-author').textContent = "- Portfolio Motivatie";
        });
    });
</script>
@endsection
