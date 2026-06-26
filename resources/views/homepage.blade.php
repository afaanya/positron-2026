@extends('layouts.app')

@section('content')

<div class="homepage">
    <img src="{{ asset('images/header.png') }}" class="header">
    <div class="hero">
        <a href="{{ route('profil') }}">
            <img src="{{ asset('images/homepage.png') }}" class="home-image">
        </a>
    </div>

    <img src="{{ asset('images/footer.png') }}" class="footer">
</div>

@endsection