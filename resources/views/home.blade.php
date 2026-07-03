@extends('layouts.app')

@section('content')
    @include('homepage')
    @include('sambutan')
    @include('rangkaian')

    <img src="{{ asset('images/footer.png') }}" class="footer">
@endsection