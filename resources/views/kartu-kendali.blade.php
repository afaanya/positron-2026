@extends('layouts.app')

@section('title', 'Kartu Kendali')

@section('styles')
    <style>
        .kartu-kendali-page {
            min-height: 100vh;
            background: #08150f;
            padding: 24px 12px;
            display: grid;
            place-items: center;
        }

        .kartu-card {
            position: relative;
            width: min(1080px, 100%);
            overflow: hidden;
        }

        .kartu-bg {
            width: 100%;
            display: block;
            height: auto;
        }

        .kartu-content {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .field-value {
            position: absolute;
            left: 68%;
            width: 26%;
            color: #000000;
            font-weight: 700;
            text-align: right;
            white-space: nowrap;
            letter-spacing: 0.02em;
            font-size: clamp(14px, 1.1vw, 18px);
        }

        .field-name { top: 31.0%; }
        .field-nim { top: 36.0%; }
        .field-prodi { top: 41.0%; }
        .field-offering { top: 46.0%; }
        .field-kelompok { top: 51.0%; }

        .stamp {
            position: absolute;
            width: 62px;
            height: 62px;
            object-fit: contain;
            pointer-events: none;
        }

        .stamp-forum { top: 65.0%; left: 23.0%; }
        .stamp-ldk { top: 65.0%; left: 39.0%; }
        .stamp-ioh { top: 65.0%; left: 56.0%; }
        .stamp-nako { top: 65.0%; left: 72.0%; }
        .stamp-coffee { top: 75.0%; left: 23.0%; }
        .stamp-peserta { top: 75.0%; left: 39.0%; }
        .stamp-arak { top: 75.0%; left: 56.0%; }
        .stamp-adminangkatan { top: 75.0%; left: 72.0%; }
        .stamp-adminoffering { top: 84.8%; left: 33.0%; }
        .stamp-dewan { top: 84.8%; left: 50.0%; }
        .stamp-staff { top: 84.8%; left: 67.0%; }

        .points-value {
            position: absolute;
            top: 90%;
            left: 50%;
            transform: translateX(-50%);
            color: #f5e8b5;
            font-size: clamp(20px, 2vw, 26px);
            font-weight: 700;
            letter-spacing: 0.12em;
        }

        @media (max-width: 900px) {
            .field-value { right: 12%; width: 36%; font-size: clamp(13px, 1.2vw, 16px); }
            .stamp { width: 42px; height: 42px; }
        }

        @media (max-width: 720px) {
            .field-value { right: 10%; width: 42%; }
            .stamp-forum { left: 24%; }
            .stamp-ldk { left: 38%; }
            .stamp-ioh { left: 52%; }
            .stamp-nako { left: 68%; }
            .stamp-coffee { left: 24%; }
            .stamp-peserta { left: 38%; }
            .stamp-arak { left: 52%; }
            .stamp-adminangkatan { left: 68%; }
            .stamp-adminoffering { left: 32%; }
            .stamp-dewan { left: 48%; }
            .stamp-staff { left: 64%; }
        }

        @media (max-width: 520px) {
            .field-value { right: 8%; width: 48%; font-size: 14px; }
            .stamp { width: 36px; height: 36px; }
            .stamp-forum { left: 22%; }
            .stamp-ldk { left: 34%; }
            .stamp-ioh { left: 46%; }
            .stamp-nako { left: 60%; }
            .stamp-coffee { left: 22%; }
            .stamp-peserta { left: 34%; }
            .stamp-arak { left: 46%; }
            .stamp-adminangkatan { left: 60%; }
            .stamp-adminoffering { left: 30%; }
            .stamp-dewan { left: 44%; }
            .stamp-staff { left: 58%; }
        }
    </style>
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
