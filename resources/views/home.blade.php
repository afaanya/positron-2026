@extends('layouts.app')

@section('content')
    @include('homepage')
    @include('sambutan')
    @include('rangkaian')
    @include('penugasan')

    <img src="{{ asset('images/footer.png') }}" class="footer">
@endsection