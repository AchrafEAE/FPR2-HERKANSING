@extends('layouts.app')

@section('title', 'Pagina niet gevonden')

@section('content')
<section class="error-page">
    <div class="error-card error-card--warning" role="alert">
        <p class="error-code">404</p>
        <h1 class="error-title">Pagina niet gevonden</h1>
        <p class="error-message">
            De pagina die je probeert te openen bestaat niet of is verplaatst.
            Controleer de URL of ga terug naar een bekende pagina.
        </p>

        <div class="error-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary">Naar dashboard</a>
            @else
                <a href="{{ route('home') }}" class="btn-primary">Naar home</a>
            @endauth
            <a href="{{ url()->previous() }}" class="btn-outline">Terug</a>
        </div>
    </div>
</section>
@endsection
