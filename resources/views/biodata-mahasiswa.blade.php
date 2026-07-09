@extends('layouts.app')

@section('content')
@vite('resources/css/biodata-mahasiswa.css')

<button class="close-btn" onclick="history.back()">
    &times;
</button>


<div class="overlay">
    <div class="card">
        <div class="title">BIODATA</div>

        <div class="row"><div class="label">Nama</div>{{ $biodata->nama }}</div>
        <div class="row"><div class="label">Jenis Kelamin</div>{{ $biodata->jenis_kelamin}}</div>
        <div class="row"><div class="label">NIM</div>{{ $biodata->id}}</div>
        <div class="row"><div class="label">Program Studi</div>{{ $biodata->program_studi }}</div>
        <div class="row"><div class="label">Offering</div>{{ $biodata->offering }}</div>
        <div class="row"><div class="label">Kakak Mentor</div>{{ $biodata->mentor_offering}}</div>

        <div class="row">
            <div class="label">Contact</div>
            <a class="wa-link"
               href="https://wa.me/62{{ ltrim($biodata->contact, '0') }}"
               target="_blank">
                Chat WhatsApp
            </a>
        </div>

        <div class="row"><div class="label">Kelompok</div>{{ $biodata->kelompok }}</div>
        <div class="row">
            <div class="label">Mentor Kelompok</div>
            <a class="wa-link"
               href="https://wa.me/62{{ ltrim($biodata->mentor_kelompok, '0') }}"
               target="_blank">
                Chat WhatsApp
            </a>
        </div>

    </div>
</div>

@endsection