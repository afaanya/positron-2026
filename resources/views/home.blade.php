@extends('layouts.app')

@section('styles')
<style>
    html {
        scroll-snap-type: y mandatory;
        scroll-behavior: smooth;
    }

    .snap-section {
        scroll-snap-align: start;
        scroll-snap-stop: always;
        height: 100vh; /* Strictly 1 layar */
        width: 100%;
        overflow: hidden; /* Mencegah elemen berlebih yang bikin bisa di scroll terus */
    }

    /* Optional: Ensure footer snaps nicely at the bottom */
    .gfooter {
        scroll-snap-align: end;
    }
</style>
@endsection

@section('content')
    <div class="snap-section" style="display: flex; align-items: center; justify-content: center; background: #081A12;">
        @include('homepage')
    </div>
    <div class="snap-section">
        @include('sambutan')
    </div>
    <div class="snap-section">
        @include('manual-book')
    </div>
    <div class="snap-section">
        @include('rangkaian')
    </div>
@endsection