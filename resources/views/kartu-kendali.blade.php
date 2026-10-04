@extends('layouts.app')

@section('title', 'Kartu Kendali')

@section('styles')
@vite('resources/css/kartu-kendali.css')
@endsection

@section('content')


    <main class="kartu-kendali-page" aria-label="Kartu Kendali Positron 2026">
        <div class="kartu-card">
            <img src="{{ asset('images/kartu kendali.webp') }}" alt="Kartu Kendali" class="kartu-bg">
            <div class="kartu-content">
                <div class="field-value field-name">{{ $mahasiswa->nama }}</div>
                <div class="field-value field-nim">{{ $mahasiswa->nim }}</div>
                <div class="field-value field-prodi">{{ $mahasiswa->program_studi }}</div>
                <div class="field-value field-offering">{{ $mahasiswa->offering }}</div>
                <div class="field-value field-kelompok">{{ $mahasiswa->kelompok_nama ?? '-' }}</div>

                @if ($activities[0]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel Forum Maba" class="stamp stamp-forum">
                @endif
                @if ($activities[1]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel LDK" class="stamp stamp-ldk">
                @endif
                @if ($activities[2]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel IOH" class="stamp stamp-ioh">
                @endif
                @if ($activities[3]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel NAKO" class="stamp stamp-nako">
                @endif
                @if ($activities[4]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel Coffee Offering" class="stamp stamp-coffee">
                @endif
                @if ($activities[5]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel Peserta Tet" class="stamp stamp-peserta">
                @endif
                @if ($activities[6]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel Arak-Arakan" class="stamp stamp-arak">
                @endif
                @if ($activities[7]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel Admin IG Angkatan" class="stamp stamp-adminangkatan">
                @endif
                @if ($activities[8]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel Admin IG Offering" class="stamp stamp-adminoffering">
                @endif
                @if ($activities[9]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel Dewan Komunal" class="stamp stamp-dewan">
                @endif
                @if ($activities[10]['done'])
                    <img src="{{ asset('images/logo.webp') }}" alt="stempel Staff Muda" class="stamp stamp-staff">
                @endif

                <div class="points-value">POIN: {{ $total }}</div>
            </div>
        </div>
    </main>
@endsection
