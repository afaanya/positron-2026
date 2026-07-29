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
        min-height: 100vh;
        width: 100%;
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
        @include('rangkaian')
    </div>
@endsection