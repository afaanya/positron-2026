@extends('layouts.app')

@section('content')

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background-image: url('{{ asset('images/login-bg.png') }}') center/cover no-repeat !important;
            font-family: 'Times New Roman', serif;
        }

        .overlay {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            background: rgba(0,0,0,0.35);
        }

        .card {
            width: 100%;
            max-width: 720px;
            background: rgba(255, 255, 255, 0.92);
            border: 2px solid #b89a63;
            border-radius: 14px;
            padding: 28px;
        }

        .title {
            text-align: center;
            font-size: 34px;
            font-weight: bold;
            color: #d4af37;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(0,0,0,0.08);
        }

        .label {
            font-weight: bold;
        }

        .wa-link {
            color: green;
            font-weight: bold;
        }
    </style>

<div class="overlay">
    <div class="card">
        <div class="title">BIODATA</div>

        <div class="row"><div class="label">Nama</div>{{ $biodata->nama }}</div>
        <div class="row"><div class="label">NIM</div>{{ $biodata->nim }}</div>
        <div class="row"><div class="label">Program Studi</div>{{ $biodata->program_studi }}</div>
        <div class="row"><div class="label">Offering</div>{{ $biodata->offering }}</div>
        <div class="row"><div class="label">Kakak Mentor</div>{{ $biodata->kakak_mentor }}</div>

        <div class="row">
            <div class="label">Contact</div>
            <a class="wa-link"
               href="https://wa.me/62{{ ltrim($biodata->contact, '0') }}"
               target="_blank">
                Chat WhatsApp
            </a>
        </div>

        <div class="row"><div class="label">Kelompok</div>{{ $biodata->kelompok }}</div>
        <div class="row"><div class="label">Mentor Kelompok</div>{{ $biodata->mentor_kelompok }}</div>

    </div>
</div>

@endsection