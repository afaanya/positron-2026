@extends('layouts.app')

@section('content')

    @if(session()->has('admin_login'))
        <div style="padding: 20px;">
            <a href="{{ route('home') }}"
               style="
                    display: inline-block;
                    background: #c8a96e;
                    color: white;
                    text-decoration: none;
                    padding: 10px 18px;
                    border-radius: 8px;
                    font-family: 'Libre Baskerville', serif;
                    font-weight: 600;
               ">
                ← Kembali ke Halaman Mahasiswa
            </a>
        </div>
    @endif
    
    @include('mentor.dashboard')
    @include('mentor.mahasiswa')
    @include('mentor.penilaian')
@endsection