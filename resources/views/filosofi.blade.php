@extends('layouts.app')

@section('title', 'POSITRON 2026')

@section('content')

{{-- Pastikan semua CSS Framer ada di sini --}}
<style data-framer-css-ssr>
    #main { margin: 0; padding: 0; box-sizing: border-box; }
    /* Masukkan sisa CSS Framer lainnya di sini */
</style>

<div id="main">
    {{-- Salin semua konten elemen HTML dari Framer Anda di sini --}}
</div>

{{-- Bundle Script Framer --}}
<script type="module" async data-framer-bundle="main" fetchPriority="low" src="https://framerusercontent.com/sites/2OlsEc6bTAzSITpQNhK9Mi/script_main.TRnTmZmM.mjs"></script>

{{-- Script Anti-Override untuk Judul --}}
<script>
    // 1. Set judul saat pertama kali dimuat
    document.title = "POSITRON 2026";

    // 2. Observer untuk mencegah script Framer mengubah judul kembali
    const targetNode = document.querySelector('title');
    const observer = new MutationObserver((mutations) => {
        if (document.title !== "POSITRON 2026") {
            document.title = "POSITRON 2026";
        }
    });

    if (targetNode) {
        observer.observe(targetNode, { subtree: true, characterData: true, childList: true });
    }
</script>

@endsection