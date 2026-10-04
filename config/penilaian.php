<?php

/*
 * Batas poin penilaian — WAJIB sinkron dengan resources/js/mentor/config.js (SECTIONS).
 * Kegiatan disimpan per-section (forum, ioh, ...) ATAU per-aspek (buku & partisipasi
 * memakai key aspek: cv, dosen, dewan, ...). Server menolak kegiatan di luar daftar
 * ini dan poin di atas maksimalnya.
 */
return [
    'sections' => [
        'forum' => ['max' => 200],
        'ioh'   => ['max' => 100],
        'ldk'   => ['max' => 100],
        'nako'  => ['max' => 100],
        'arus'  => ['max' => 150],
        'buku'  => ['max' => 100, 'aspects' => [
            'journeytodtei' => 15, 'cv' => 10, 'mindmap' => 10, 'struktur' => 5, 'dosen' => 20,
            'denah' => 5, 'ttdoff' => 10, 'ttdkel' => 10, 'ttdhmd' => 15,
        ]],
        'partisipasi' => ['max' => 275, 'aspects' => [
            'dewan' => 35, 'seven' => 50, 'coffe' => 15, 'tetp' => 35, 'staffmuda' => 25,
            'arak' => 20, 'ecup' => 15, 'adminigangkatan' => 50, 'adminigoffering' => 30,
        ]],
    ],
];
