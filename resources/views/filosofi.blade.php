@extends('layouts.app')

@section('title', 'POSITRON 2026')

@section('content')

{{-- Pastikan semua CSS Framer ada di sini --}}
<style data-framer-css-ssr>
    #main { margin: 0; padding: 0; box-sizing: border-box; }
    /* Masukkan sisa CSS Framer lainnya di sini */
</style>

<div id="main"></div>

<script type="module" async data-framer-bundle="main" fetchPriority="low" src="https://framerusercontent.com/sites/2OlsEc6bTAzSITpQNhK9Mi/script_main.TRnTmZmM.mjs"></script>

<script>
    document.title = "Filosofi | POSITRON 2026";

    const replacementContent = '<h2>The Symphony of the Ton dan Diverse in Origin, United in Vision:</h2>' +
        '<p>Menggambarkan bahwa dunia kampus diisi oleh berbagai macam karakter, latar belakang, dan keahlian. Jika dipadukan dengan baik, perbedaan ini akan menciptakan harmoni yang indah (simfoni). Menegaskan bahwa meskipun mahasiswa baru berasal dari "keluarga" yang berbeda-beda, mereka kini berdiri di bawah satu nama almamater dan harus berkolaborasi untuk mencapai visi bersama.</p>';
    const searchRegex = /A special invitation awaits you\.[\s\S]*?Discover smething extraordinary inside\./i;

    function replaceFramerText() {
        const allElements = document.querySelectorAll('body *');
        for (const el of allElements) {
            if (el.children.length === 0 && el.innerHTML && searchRegex.test(el.innerHTML)) {
                el.innerHTML = replacementContent;
            }
        }
    }

    function observeFramer() {
        const observer = new MutationObserver(() => {
            replaceFramerText();
        });
        observer.observe(document.body, {
            childList: true,
            subtree: true,
            characterData: true
        });
        replaceFramerText();
    }

    if (document.readyState === 'complete') {
        observeFramer();
    } else {
        window.addEventListener('load', observeFramer);
    }
</script>

@endsection