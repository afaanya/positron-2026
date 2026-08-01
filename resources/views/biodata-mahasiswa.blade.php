@extends('layouts.app')

@section('content')
@vite('resources/css/biodata-mahasiswa.css')

<a href="{{ route('home') }}" class="close-btn">
    &times;
</a>

<div class="overlay">
    <div class="card">
        <div class="title">BIODATA</div>

        @if(session('success'))
            <div style="
                background:#d4edda;
                color:#155724;
                padding:10px;
                border-radius:8px;
                margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="row"><div class="label">Nama</div>{{ $biodata->nama }}</div>
        <div class="row"><div class="label">Jenis Kelamin</div>{{ $biodata->jenis_kelamin}}</div>
        <div class="row"><div class="label">NIM</div>{{ $biodata->id}}</div>
        
        <div class="row-auto">
            <div class="label">No WA</div>
            @if($biodata->no_wa)
                <a class="wa-link"
                   href="https://wa.me/62{{ ltrim($biodata->no_wa, '0') }}"
                   target="_blank">
                    Chat WhatsApp
                </a>
            @else
                <span class="no-wa">Tambah No WA</span>
            @endif
        </div>

        <div class="row"><div class="label">Program Studi</div>{{ $biodata->program_studi }}</div>
        <div class="row"><div class="label">Offering</div>{{ $biodata->offering }}</div>
        <div class="row">
        <div class="label">Kakak Mentor</div>
            <div>
                @forelse($mentors as $mentor)
                    {{ $mentor->nama }}<br>
                @empty
                    -
                @endforelse
            </div>
        </div>

        <div class="row">
            <div class="label">Contact</div>
            <div>
                @forelse($mentors as $mentor)
                    <a class="wa-link"
                    href="https://wa.me/62{{ ltrim($mentor->no_wa, '0') }}"
                    target="_blank">
                        Chat WhatsApp
                    </a><br>
                @empty
                    -
                @endforelse
            </div>
        </div>

        <div style="display:flex; justify-content:flex-end; margin-top:25px;">
            <a href="{{ route('biodata.edit') }}"
            style="
                    background:#284139;
                    color:white;
                    padding:10px 24px;
                    border-radius:8px;
                    text-decoration:none;
                    font-weight:bold;">
                Edit Biodata
            </a>
        </div>
    </div>
</div>

@endsection