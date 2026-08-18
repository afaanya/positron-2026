@extends('layouts.app')

@section('title', 'Penugasan - POSITRON 2026')

@section('styles')
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: #0a1a10 !important;
    }
    .penugasan-page {
      width: 100%;
      position: relative;
      font-family: 'Libre Baskerville', serif;
    }
    .penugasan-bg {
      width: 100%;
      display: block;
    }

    /* ============================
       JUDUL OVERLAY
    ============================*/
    .penugasan-title-wrap {
      position: absolute;
      top: 4%;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
      z-index: 10;
      width: 80%;
    }
    .penugasan-title {
      font-size: clamp(1.1rem, 3vw, 2.2rem);
      font-weight: 700;
      color: #f8d794;
      text-transform: uppercase;
      letter-spacing: 0.15em;
      text-shadow: 0 0 30px rgba(248,215,148,0.5), 0 2px 8px rgba(0,0,0,0.8);
    }
    .penugasan-subtitle {
      font-size: clamp(0.5rem, 1.2vw, 0.85rem);
      color: #d4b96a;
      margin-top: 0.4em;
      letter-spacing: 0.05em;
      text-shadow: 0 1px 6px rgba(0,0,0,0.9);
    }

    /* ============================
       BUKU CONTAINER — di atas meja
    ============================*/
    .books-container {
      position: absolute;
      bottom: 0%;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: flex-end;
      gap: 2%;
      padding: 0 6%;
      padding-bottom: 1%;
      z-index: 10;
    }

    /* ============================
       BUKU ITEM
    ============================*/
    .book-item {
      position: relative;
      cursor: pointer;
      transition: transform 0.35s ease, filter 0.35s ease;
      display: block;
      text-decoration: none;
      flex: 1;
      max-width: 14%;
    }
    .book-item img {
      width: 100%;
      height: auto;
      display: block;
      filter: drop-shadow(0 8px 20px rgba(0,0,0,0.7));
      transition: filter 0.35s ease, transform 0.35s ease;
    }
    .book-item:hover img {
      filter: drop-shadow(0 0 18px rgba(248,215,148,0.75)) drop-shadow(0 8px 20px rgba(0,0,0,0.7));
      transform: translateY(-6%) scale(1.04);
    }

    /* label penugasan di bawah buku */
    .book-label {
      text-align: center;
      color: #f8d794;
      font-size: clamp(0.45rem, 1vw, 0.75rem);
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      margin-top: 4%;
      text-shadow: 0 0 10px rgba(248,215,148,0.6), 0 1px 4px rgba(0,0,0,0.9);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    .book-item:hover .book-label {
      opacity: 1;
    }

    /* ============================
       RESPONSIF
    ============================*/
    @media (max-width: 768px) {
      .books-container {
        gap: 1.5%;
        padding: 0 3%;
        padding-bottom: 0.5%;
      }
      .book-item {
        max-width: 16%;
      }
    }
    @media (max-width: 480px) {
      .books-container {
        gap: 1%;
        padding: 0 2%;
      }
      .book-item {
        max-width: 18%;
      }
      .penugasan-title {
        letter-spacing: 0.05em;
      }
    }
  </style>
@endsection

@section('content')
<div class="penugasan-page">

  {{-- Background utama --}}
  <img src="{{ asset('images/bg-penugasan.webp') }}" class="penugasan-bg" alt="Background Penugasan">

  {{-- Judul Halaman --}}
  <div class="penugasan-title-wrap">
    <h1 class="penugasan-title">Penugasan POSITRON 2026</h1>
    <p class="penugasan-subtitle">Klik buku untuk melihat tugas dan mengumpulkan penugasan</p>
  </div>

  {{-- 5 Buku di atas meja --}}
  <div class="books-container">

    {{-- Buku 1 --}}
    <a href="https://drive.google.com/" target="_blank" class="book-item" id="buku-penugasan-1">
      <img src="{{ asset('images/penugasan-1.webp') }}" alt="Penugasan 1">
      <p class="book-label">Penugasan 1</p>
    </a>

    {{-- Buku 2 --}}
    <a href="https://drive.google.com/" target="_blank" class="book-item" id="buku-penugasan-2">
      <img src="{{ asset('images/penugasan-2.webp') }}" alt="Penugasan 2">
      <p class="book-label">Penugasan 2</p>
    </a>

    {{-- Buku 3 --}}
    <a href="https://drive.google.com/" target="_blank" class="book-item" id="buku-penugasan-3">
      <img src="{{ asset('images/penugasan-3.webp') }}" alt="Penugasan 3">
      <p class="book-label">Penugasan 3</p>
    </a>

    {{-- Buku 4 --}}
    <a href="https://drive.google.com/" target="_blank" class="book-item" id="buku-penugasan-4">
      <img src="{{ asset('images/penugasan-4.webp') }}" alt="Penugasan 4">
      <p class="book-label">Penugasan 4</p>
    </a>

    {{-- Buku 5 --}}
    <a href="https://drive.google.com/" target="_blank" class="book-item" id="buku-penugasan-5">
      <img src="{{ asset('images/penugasan-5.webp') }}" alt="Penugasan 5">
      <p class="book-label">Penugasan 5</p>
    </a>

  </div>

</div>
@endsection
