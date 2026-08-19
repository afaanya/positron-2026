@extends('layouts.app')

@section('title', 'Penugasan - POSITRON 2026')

@section('styles')
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    

    .penugasan-page {
      width: 100vw;
      height: 100vh;
      position: relative;
      font-family: 'Libre Baskerville', serif;
      overflow: hidden;
      /* Background baru dipasang via CSS agar tidak pecah/geser */
      background: #0a1a10 url('{{ asset("images/bg.penugasan.2.webp") }}') center center / cover no-repeat;
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
      bottom: 25%;
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
      display: block;
      text-decoration: none;
      flex: 1;
      max-width: 18%;
    }
    .book-img-wrap {
      position: relative;
      width: 100%;
      transition: transform 0.35s ease, filter 0.35s ease;
    }
    .book-img-wrap img {
      width: 100%;
      height: auto;
      display: block;
      filter: drop-shadow(0 8px 20px rgba(0,0,0,0.7));
    }
    .book-item:hover .book-img-wrap {
      filter: drop-shadow(0 0 18px rgba(248,215,148,0.75)) drop-shadow(0 8px 20px rgba(0,0,0,0.7));
      transform: translateY(-6%) scale(1.04);
    }

    /* Staggered Vertikal (Selang-seling Atas Bawah) */
    #buku-penugasan-1 { transform: translateY(10px); }
    #buku-penugasan-2 { transform: translateY(-35px); }
    #buku-penugasan-3 { transform: translateY(5px); }
    #buku-penugasan-4 { transform: translateY(-40px); }
    #buku-penugasan-5 { transform: translateY(-15px); }

    /* label penugasan di bawah buku */
    .book-label {
      text-align: center;
      color: #f8d794;
      font-size: clamp(0.75rem, 1.25vw, 1.15rem);
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      margin-top: 6px;
      text-shadow: 0 0 16px rgba(248,215,148,0.9), 0 2px 6px rgba(0,0,0,0.95);
      opacity: 0;
      transition: opacity 0.3s ease, transform 0.3s ease;
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
      #buku-penugasan-1 { transform: translateY(5px); }
      #buku-penugasan-2 { transform: translateY(-20px); }
      #buku-penugasan-3 { transform: translateY(3px); }
      #buku-penugasan-4 { transform: translateY(-25px); }
      #buku-penugasan-5 { transform: translateY(-10px); }
    }
    @media (max-width: 480px) {
      .books-container {
        gap: 1%;
        padding: 0 2%;
      }
      .book-item {
        max-width: 20%;
      }
      .penugasan-title {
        letter-spacing: 0.05em;
      }
      #buku-penugasan-1 { transform: translateY(3px); }
      #buku-penugasan-2 { transform: translateY(-12px); }
      #buku-penugasan-3 { transform: translateY(2px); }
      #buku-penugasan-4 { transform: translateY(-16px); }
      #buku-penugasan-5 { transform: translateY(-6px); }
    }
  </style>
@endsection

@section('content')
<div class="penugasan-page">

  {{-- Judul Halaman --}}
  <div class="penugasan-title-wrap">
    <h1 class="penugasan-title">Penugasan POSITRON 2026</h1>
    <p class="penugasan-subtitle">Klik buku untuk melihat penugasan</p>
  </div>

  {{-- 5 Buku di atas meja --}}
  <div class="books-container">

    {{-- Buku 1 --}}
    <a href="https://drive.google.com/" target="_blank" class="book-item" id="buku-penugasan-1">
      <div class="book-img-wrap">
        <img src="{{ asset('images/penugasan-1.webp') }}" alt="Penugasan 1">
      </div>
      <p class="book-label">Logo Positron</p>
    </a>

    {{-- Buku 2 --}}
    <a href="https://drive.google.com/" target="_blank" class="book-item" id="buku-penugasan-2">
      <div class="book-img-wrap">
        <img src="{{ asset('images/penugasan-2.webp') }}" alt="Penugasan 2">
      </div>
      <p class="book-label">Denah Gedung</p>
    </a>

    {{-- Buku 3 --}}
    <a href="https://drive.google.com/" target="_blank" class="book-item" id="buku-penugasan-3">
      <div class="book-img-wrap">
        <img src="{{ asset('images/penugasan-3.webp') }}" alt="Penugasan 3">
      </div>
      <p class="book-label">Kartu Disiplin</p>
    </a>

    {{-- Buku 4 --}}
    <a href="https://drive.google.com/" target="_blank" class="book-item" id="buku-penugasan-4">
      <div class="book-img-wrap">
        <img src="{{ asset('images/penugasan-4.webp') }}" alt="Penugasan 4">
      </div>
      <p class="book-label">Twibbon</p>
    </a>

    {{-- Buku 5 --}}
    <a href="https://drive.google.com/" target="_blank" class="book-item" id="buku-penugasan-5">
      <div class="book-img-wrap">
        <img src="{{ asset('images/penugasan-5.webp') }}" alt="Penugasan 5">
      </div>
      <p class="book-label">Template Id Card</p>
    </a>

  </div>

</div>
@endsection