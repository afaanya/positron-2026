@extends('layouts.app')

@section('title', 'Manual Book')

@section('styles')
@vite('resources/css/manualbook.css')
@endsection


@section('content')
    @php
        $books = [
            ['class' => 'book-left', 'title' => 'FORUM MABA'],
            ['class' => 'book-main', 'title' => 'POSITRON'],
            ['class' => 'book-right', 'title' => 'LDK'],
            ['class' => 'book-brown', 'title' => 'IoH'],
            ['class' => 'book-bottom', 'title' => 'NAKO 10.0'],
        ];
    @endphp

    <main class="manualbook-page" aria-label="Manual Book Positron">
        <a href="{{ route('home') }}" class="back-btn">← Kembali</a>

        @foreach ($books as $book)
            <a href="#" class="book-link {{ $book['class'] }}" aria-label="{{ $book['title'] }}">
                <span class="book-title">{{ $book['title'] }}</span>
            </a>
        @endforeach
    </main>
@endsection