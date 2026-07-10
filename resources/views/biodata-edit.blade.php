@extends('layouts.app')

@section('content')
@vite('resources/css/biodata-mahasiswa.css')

<button class="close-btn" onclick="history.back()">
    &times;
</button>

<div class="overlay">
    <div class="card">

        <div class="title">EDIT BIODATA</div>

        @if ($errors->any())
            <div style="color:red; margin-bottom:15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('biodata.update') }}" method="POST">
            @csrf

            <div class="row">
                <div class="label">Nama</div>
                {{ $biodata->nama }}
            </div>

            <div class="row">
                <div class="label">NIM</div>
                {{ $biodata->id }}
            </div>

            <div class="row">
                <div class="label">No WA</div>

                <input
                    type="text"
                    name="no_wa"
                    value="{{ old('no_wa', $biodata->no_wa) }}"
                    placeholder="08xxxxxxxxxx"
                    style="
                        width:220px;
                        padding:8px;
                        border:1px solid #ccc;
                        border-radius:6px;
                    ">
            </div>

            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:30px;">

                <a href="{{ route('biodata') }}"
                   style="
                        padding:10px 20px;
                        background:#999;
                        color:white;
                        border-radius:8px;
                        text-decoration:none;">
                    Batal
                </a>

                <button
                    type="submit"
                    style="
                        padding:10px 20px;
                        background:#284139;
                        color:white;
                        border:none;
                        border-radius:8px;
                        cursor:pointer;">
                    Simpan
                </button>

            </div>

        </form>

    </div>
</div>

@endsection