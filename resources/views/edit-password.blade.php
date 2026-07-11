@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Ubah Password</h2>

    @if(session('success'))
        <div style="color:green">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color:red">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <label>Password Lama</label>
        <input type="password" name="password_lama" required>

        <label>Password Baru</label>
        <input type="password" name="password_baru" required>

        <label>Konfirmasi Password Baru</label>
        <input type="password" name="password_baru_confirmation" required>

        <button type="submit">
            Simpan
        </button>

    </form>

</div>

@endsection