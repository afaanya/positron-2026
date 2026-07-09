@extends('layouts.app')

@section('title', 'Kartu Kendali')

@section('styles')
@vite('resources/css/kartu-kendali.css')
@endsection

@section('content')
    @php
        $profile = [
            ['label' => 'Nama', 'value' => 'Rizky Ananda'],
            ['label' => 'NIM', 'value' => '2026101010'],
            ['label' => 'Prodi', 'value' => 'Teknik Elektro Informatika'],
            ['label' => 'Offering', 'value' => 'TI A'],
            ['label' => 'Kelompok', 'value' => 'Kelompok 1'],
        ];

        $activities = [
            ['label' => 'Forum Maba', 'done' => true],
            ['label' => 'LDK', 'done' => true],
            ['label' => 'IOH', 'done' => true],
            ['label' => 'NAKO', 'done' => false],
            ['label' => 'Coffee Offering', 'done' => false],
            ['label' => 'Peserta Tet', 'done' => false],
            ['label' => 'Arak-Arakan', 'done' => false],
            ['label' => 'Admin IG Angkatan', 'done' => false],
            ['label' => 'Admin IG Offering', 'done' => false],
            ['label' => 'Dewan Komunal', 'done' => false],
            ['label' => 'Staff Muda', 'done' => false],
        ];
    @endphp

    <main class="kartu-kendali-page" aria-label="Kartu Kendali Positron 2026">
        <div class="kartu-card">
            <img src="{{ asset('images/kartu kendali.png') }}" alt="Kartu Kendali" class="kartu-bg">
            <div class="kartu-content">
                <div class="field-value field-name">Rizky Ananda</div>
                <div class="field-value field-nim">2026101010</div>
                <div class="field-value field-prodi">Teknik Elektro Informatika</div>
                <div class="field-value field-offering">TI A</div>
                <div class="field-value field-kelompok">Kelompok 1</div>

                @if ($activities[0]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel Forum Maba" class="stamp stamp-forum">
                @endif
                @if ($activities[1]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel LDK" class="stamp stamp-ldk">
                @endif
                @if ($activities[2]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel IOH" class="stamp stamp-ioh">
                @endif
                @if ($activities[3]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel NAKO" class="stamp stamp-nako">
                @endif
                @if ($activities[4]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel Coffee Offering" class="stamp stamp-coffee">
                @endif
                @if ($activities[5]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel Peserta Tet" class="stamp stamp-peserta">
                @endif
                @if ($activities[6]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel Arak-Arakan" class="stamp stamp-arak">
                @endif
                @if ($activities[7]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel Admin IG Angkatan" class="stamp stamp-adminangkatan">
                @endif
                @if ($activities[8]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel Admin IG Offering" class="stamp stamp-adminoffering">
                @endif
                @if ($activities[9]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel Dewan Komunal" class="stamp stamp-dewan">
                @endif
                @if ($activities[10]['done'])
                    <img src="{{ asset('images/logo.png') }}" alt="stempel Staff Muda" class="stamp stamp-staff">
                @endif

                <div class="points-value">POIN: 124</div>
            </div>
        </div>
    </main>
@endsection
