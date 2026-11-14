<?php

/*
 * Batas poin penilaian — sinkron dengan resources/js/mentor/config.js.
 * Aspect keys untuk section lama dibuat stabil agar setiap nilai bisa disimpan terpisah.
 */
return [
    'sections' => [
        'forum' => ['max' => 200, 'aspects' => [
            'forum_0' => 60, 'forum_1' => 60, 'forum_2' => 40, 'forum_3' => 40,
        ]],
        'ioh' => ['max' => 100, 'aspects' => [
            'ioh_0' => 45, 'ioh_1' => 15, 'ioh_2' => 15, 'ioh_3' => 25,
        ]],
        'ldk' => ['max' => 100, 'aspects' => [
            'ldk_0' => 20, 'ldk_1' => 25, 'ldk_2' => 35, 'ldk_3' => 20,
        ]],
        'nako' => ['max' => 100, 'aspects' => [
            'nako_0' => 10, 'nako_1' => 30, 'nako_2' => 25,
        ]],
        'arus' => ['max' => 150, 'aspects' => [
            'arus_0' => 75, 'arus_1' => 75, 'arus_2' => 75, 'arus_3' => 75,
        ]],
        'buku' => ['max' => 100, 'aspects' => [
            'journeytodtei' => 15, 'cv' => 10, 'mindmap' => 10, 'struktur' => 5, 'dosen' => 20,
            'denah' => 5, 'ttdoff' => 10, 'ttdkel' => 10, 'ttdhmd' => 15,
        ]],
        'partisipasi' => ['max' => 275, 'aspects' => [
            'dewan' => 35, 'seven' => 50, 'coffe' => 15, 'tetp' => 35, 'staffmuda' => 25,
            'arak' => 20, 'ecup' => 15, 'adminigangkatan' => 50, 'adminigoffering' => 30,
        ]],
    ],
];
