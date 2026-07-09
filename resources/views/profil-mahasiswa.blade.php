@extends('layouts.app')

@section('content')
@vite('resources/css/profil-mahasiswa.css')


<div class="profile-page">

    {{-- Header --}}
    <div class="header-container">
        <img src="{{ asset('images/header.png') }}" class="header">

        <a href="{{ route('homepage') }}" class="menu home"></a>
        <a href="{{ url('/about') }}" class="menu about"></a>
        <a href="{{ route('filosofi') }}" class="menu filosofi"></a>
        <a href="{{ url('/timeline') }}" class="menu timeline"></a>
        <a href="{{ route('profil') }}" class="menu profil"></a>
    </div>

    {{-- Isi --}}
    <div class="content">

        <div class="profile-card">

            <h1>Profil Mahasiswa</h1>

            {{-- Nanti isi UI profil kamu di sini --}}

        </div>

    </div>

    {{-- Footer --}}

</div>

@endsection