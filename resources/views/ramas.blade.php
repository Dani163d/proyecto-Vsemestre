@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/ramas.css') }}">
@endsection
@section('content')
<div class="branches-container">
    <div class="header">
        <a href="{{ url()->previous() }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            <span>Volver</span>
        </a>
        <button class="theme-toggle">
            <i class="fas fa-sun"></i>
        </button>
    </div>

    <h1 class="career-title">Ramas de {{ $carrera }}</h1>

    <div class="branches-grid">
        @foreach($branches as $branch)
            <div class="branch-card">
                <i class="{{ $branch['icon'] }} branch-icon"></i>
                <h3 class="branch-title">{{ $branch['title'] }}</h3>
                <p class="branch-description">{{ $branch['description'] }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/ramas.js') }}"></script>
@endsection