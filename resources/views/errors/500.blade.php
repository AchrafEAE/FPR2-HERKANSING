@extends('layouts.app')

@section('title', 'Serverfout')

@section('content')
<section class="error-page">
    <div class="error-card error-card--danger" role="alert">
        <p class="error-code">500</p>
        <h1 class="error-title">Er ging iets mis</h1>
        <p class="error-message">
            De applicatie kon je verzoek niet verwerken. Probeer het opnieuw.
            Blijft dit gebeuren, kom later terug of ga naar een veilige pagina.
        </p>

        <div class="error-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary">Naar dashboard</a>
            @else
                <a href="{{ route('home') }}" class="btn-primary">Naar home</a>
            @endauth
            <a href="{{ url()->current() }}" class="btn-outline">Opnieuw proberen</a>
        </div>
    </div>
</section>
@endsection
