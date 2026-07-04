@extends('layouts.app')

@section('title', 'Manual Book')

@section('styles')
    <style>
    .manualbook-page {
        position: relative;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        background-image: url("{{ asset('images/manualbook.png') }}");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100% 100%;
    }

    .manualbook-page::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 50% 62%, rgba(255, 220, 130, .08), transparent 26%),
            linear-gradient(to bottom, rgba(0, 0, 0, .12), rgba(0, 0, 0, .18));
        pointer-events: none;
    }

    .back-btn {
        position: absolute;
        top: 28px;
        left: 34px;
        z-index: 5;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 11px 20px;
        border: 1px solid rgba(238, 198, 94, .58);
        border-radius: 8px;
        color: #f8e6aa;
        text-decoration: none;
        font-size: clamp(14px, 1.35vw, 18px);
        font-weight: 700;
        background: rgba(15, 22, 16, .66);
        box-shadow: 0 10px 30px rgba(0, 0, 0, .28);
        backdrop-filter: blur(4px);
        transition: transform .25s ease, color .25s ease, background .25s ease;
    }

    .back-btn:hover {
        color: #fff2c7;
        background: rgba(20, 31, 21, .86);
        transform: translateX(-5px);
    }

    /* Pengaturan Link Buku Global */
    .book-link {
        position: absolute;
        z-index: 3;
        display: grid;
        place-items: center;
        text-decoration: none;
        transition: transform .25s ease, filter .25s ease;
    }

    /* Efek Hover Agar Ikut Masing-Masing Rotasi Buku */
    .book-left:hover { transform: rotate(-14deg) scale(1.03); }
    .book-main:hover { transform: scale(1.03); }
    .book-right:hover { transform: rotate(14deg) scale(1.03); }
    .book-brown:hover { transform: rotate(-15deg) scale(1.03); }
    .book-bottom:hover { transform: rotate(-6deg) scale(1.03); }

    /* Pengaturan Tulisan Judul Menempel Alami ke Buku */
    .book-title {
        display: block;
        width: 100%;
        text-align: center;
        font-size: clamp(14px, 1.4vw, 20px);
        font-weight: 800;
        line-height: 1.2;
        text-transform: uppercase;
        
        /* Pewarnaan Efek Cetak Tenggelam (Debossed) di Kulit Buku */
        color: #e5c158; 
        text-shadow: 0px 2px 3px rgba(0, 0, 0, 0.9), inset 0px 0px 5px rgba(229, 193, 88, 0.3);
        letter-spacing: 0.8px;
    }

    /* Warna Tulisan Khusus Buku Tengah (Warna Terang) */
    .book-main {
        display: grid;
        place-items: center;
        left: 39.0%;
        top: 55.0%; /* Fine-tuned untuk presisi di tengah */
        width: 13.5%;
        height: 12.0%;
    }

    .book-main .book-title {
        color: #422b11;
        text-shadow: 0px 1px 1px rgba(255, 255, 255, 0.6);
        display: block;
        margin: 0;
        padding: 0;
    }

    /* Warna Tulisan Khusus Buku Cokelat */
    .book-brown .book-title {
        color: #f1d37c;
        text-shadow: 0px 2px 3px rgba(0, 0, 0, 0.9);
    }

    /* KORRDINAT PRESET BARU AGAR PAS DI TENGAH COVBER BUKU */
    .book-left {
        display: grid;
        place-items: center;
        left: 12.0%;
        top: 55.5%; /* Diturunkan agar pas di tengah */
        width: 18.0%;
        height: 12.0%;
        transform: rotate(-14deg);
    }

    .book-right {
        display: grid;
        place-items: center;
        left: 64.8%;
        top: 55.8%; /* Fine-tuned untuk presisi di tengah */
        width: 18.0%;
        height: 12.0%;
        transform: rotate(14deg);
    }

   .book-brown {
        display: grid;
        place-items: center;
        left: 23.5%;
        top: 77.0%; /* Diturunkan agar pas di tengah */
        width: 18.0%;
        height: 12.0%;
        transform: rotate(-15deg);
    }

    .book-bottom {
        display: grid;
        place-items: center;
        left: 51.8%;
        top: 77.8%; /* Fine-tuned untuk presisi di tengah */
        width: 16.0%;
        height: 12.0%;
        transform: rotate(-6deg);
    } 

    /* Responsif untuk Tablet/Mobile */
    @media (max-width: 900px) {
        .back-btn {
            top: 18px;
            left: 18px;
            padding: 9px 15px;
        }
        .book-title {
            font-size: clamp(9px, 1.8vw, 12px);
        }
    }

    @media (max-width: 560px) {
        body {
            overflow: auto;
        }
        .manualbook-page {
            min-height: 100vh;
            background-size: auto 100%;
        }
        .book-title {
            font-size: 9px;
        }
    }
</style>

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