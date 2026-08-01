@extends('layouts.app')

@section('content')
@vite('resources/css/biodata-mahasiswa.css')

<a href="{{ route('biodata') }}" class="close-btn">
    &times;
</a>

<div class="overlay">
    <div class="card">
        <div class="corner tl">❦</div>
        <div class="corner tr">❦</div>
        <div class="corner bl">❦</div>
        <div class="corner br">❦</div>

        <div class="title">EDIT BIODATA</div>
        <p class="subtitle">
            Perbarui Nomor WhatsApp
        </p>

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

            <hr class="royal-divider">

            <div class="section-title">
                🛡️ Verifikasi Keamanan 
            </div>

            <div class="row">
                <div class="label">Password Lama</div>

                <input
                    type="password"
                    name="password_lama"
                    placeholder="Masukkan password lama"
                    style="
                        width:220px;
                        padding:8px;
                        border:1px solid #ccc;
                        border-radius:6px;
                    ">
            </div>

            <div class="row">
                <div class="label">Password Baru</div>

                <input
                    type="password"
                    name="password_baru"
                    placeholder="Minimal 8 karakter"
                    style="
                        width:220px;
                        padding:8px;
                        border:1px solid #ccc;
                        border-radius:6px;
                    ">
            </div>

            <div class="row">
                <div class="label">Konfirmasi Password</div>

                <input
                    type="password"
                    name="password_baru_confirmation"
                    placeholder="Ulangi password baru"
                    style="
                        width:220px;
                        padding:8px;
                        border:1px solid #ccc;
                        border-radius:6px;
                    ">
            </div>

            <p class="password-note">
                👑 Kosongkan bagian password jika tidak ingin mengubah password
            </p>

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
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>
</div>

@endsection