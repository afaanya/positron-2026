@extends('layouts.app')

@section('styles')
<style>
    html {
        scroll-snap-type: y mandatory;
        scroll-behavior: smooth;
        background: #081A12;
    }

    body {
        background: #081A12;
    }

    main {
        margin-top: 0 !important;
    }

    .snap-section {
        scroll-snap-align: start;
        scroll-snap-stop: always;
        height: 100dvh;
        min-height: 100dvh;
        width: 100vw;
        overflow: hidden;
        margin: 0;
        padding: 0;
        background: #081A12;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero {
        width: 100%;
        height: 100%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

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