{{-- Generic wrapper: renders a fragment view inside the global layout
     (navbar + damask background + footer). Used by routes whose views
     are section-fragments rather than full documents. --}}
@extends('layouts.app')

@section('title', $title ?? 'POSITRON 2026')

@section('content')
    @include($inner)
@endsection
