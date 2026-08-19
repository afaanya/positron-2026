@extends('layouts.app')

@section('title', 'Penugasan - POSITRON 2026')

@section('styles')
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  @vite(['resources/css/penugasan.css'])
@endsection

@section('content')
<div class="penugasan-page" style="background-image: url('{{ asset('images/bg.penugasan.2.webp') }}');">

  {{-- Judul Halaman --}}
  <div class="penugasan-title-wrap">
    <h1 class="penugasan-title">Penugasan POSITRON 2026</h1>
    <p class="penugasan-subtitle">Klik buku untuk melihat penugasan</p>
  </div>

  {{-- 5 Buku di atas meja --}}
  <div class="books-container">

    {{-- Buku 1 --}}
    <a href="https://drive.google.com/drive/folders/1Y-7OzWSVJn1O-FKGdFaonZS43d-FL1be?usp=drive_link/" target="_blank" class="book-item" id="buku-penugasan-1">
      <div class="book-img-wrap">
        <img src="{{ asset('images/penugasan-1.webp') }}" alt="Penugasan 1">
      </div>
      <p class="book-label">Logo Positron</p>
    </a>

    {{-- Buku 2 --}}
    <a href="https://drive.google.com/drive/u/0/mobile/folders/1nXCjpoCS7Cl5gtaml1AaARjA0tIWjqXO?usp=drive_link" target="_blank" class="book-item" id="buku-penugasan-2">
      <div class="book-img-wrap">
        <img src="{{ asset('images/penugasan-2.webp') }}" alt="Penugasan 2">
      </div>
      <p class="book-label">Denah Gedung</p>
    </a>

    {{-- Buku 3 --}}
    <a href="https://drive.google.com/drive/folders/1xNd1Gs6-Ui3zvVL7obyr8SPmgeAcmZPp?usp=drive_link" target="_blank" class="book-item" id="buku-penugasan-3">
      <div class="book-img-wrap">
        <img src="{{ asset('images/penugasan-3.webp') }}" alt="Penugasan 3">
      </div>
      <p class="book-label">Kartu Disiplin</p>
    </a>

    {{-- Buku 4 --}}
    <a href="https://drive.google.com/drive/folders/1IILUy__Re2kEUazVn4fESB-9ubsoBsLf?usp=drive_link" target="_blank" class="book-item" id="buku-penugasan-4">
      <div class="book-img-wrap">
        <img src="{{ asset('images/penugasan-4.webp') }}" alt="Penugasan 4">
      </div>
      <p class="book-label">Twibbon</p>
    </a>

    {{-- Buku 5 --}}
    <a href="https://drive.google.com/drive/folders/1oyp7w-J22B06kimop5eQA7J7bDgZYVNb?usp=drive_link" target="_blank" class="book-item" id="buku-penugasan-5">
      <div class="book-img-wrap">
        <img src="{{ asset('images/penugasan-5.webp') }}" alt="Penugasan 5">
      </div>
      <p class="book-label">Template Id Card</p>
    </a>

  </div>

</div>
@endsection

@section('scripts')
  @vite(['resources/js/penugasan.js'])
@endsection