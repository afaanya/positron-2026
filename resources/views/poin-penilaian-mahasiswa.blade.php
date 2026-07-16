@extends('layouts.app')

@section('title', 'Poin Penilaian Mahasiswa')
@section('main-class', 'full-width')

@section('styles')
    @vite('resources/css/poin-penilaian.css')
@endsection

@section('main-class', 'main-full')

@section('content')

<div class="poin-page">
    <div class="content">
        <div class="points-panel">

            <div class="board-header">
                <div class="board-title">Poin Tugas Mahasiswa Baru</div>
                <div class="board-status">
                    Berikut adalah seluruh poin yang telah diperoleh mahasiswa selama kegiatan POSITRON.
                </div>
            </div>

            <div class="stats-row">
                <div class="stat-card" id="boardStatus">
                    <div class="stat-title">Total Poin</div>
                    <div class="stat-value">
                        <span id="totalPoints">0</span>/<span id="maxPoints">815</span>
                    </div>
                </div>

                <div class="stat-card" id="progressCard">
                    <div class="stat-title">Progress</div>
                    <div class="stat-value">
                        <span id="progressPercent">0%</span>
                    </div>

                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                </div>
            </div>

            <div id="horseAnim" class="horse-anim" aria-hidden="true">
                <svg viewBox="0 0 280 110" preserveAspectRatio="xMinYMid meet" width="100%" height="100%">
                    <g fill="#ffd7b8" stroke="#ff8b6b" stroke-width="2" transform="scale(0.7)">
                        <path d="M40 60 C40 40, 80 30, 110 36 C130 40, 140 54, 160 56 C170 57, 185 50, 200 44 C210 40, 230 38, 250 42 L260 44 L256 60 L242 62 L238 70 L220 78 L200 80 L190 76 L176 82 L160 84 L140 80 L120 72 L100 66 L82 64 L64 62 Z"/>
                        <circle cx="68" cy="46" r="6" fill="#2b3b3a"/>
                        <path d="M96 38 C88 30, 80 28, 70 30" stroke="#2b3b3a" stroke-width="3" fill="none" stroke-linecap="round"/>
                    </g>
                </svg>
            </div>

            <section class="category-section">
                <div class="task-list" id="pokokList"></div>
            </section>

            <section class="category-section">
                <div class="task-list" id="bukuList"></div>
            </section>

            <section class="category-section">
                <div class="task-list" id="partisipasiList"></div>
            </section>

        </div>
    </div>
</div>

<script>
    window.nilaiMahasiswa = @json($nilai);
    window.totalPoin = {{ $total }};
</script>

@endsection

@section('scripts')
    @vite('resources/js/poin-penilaian.js')
@endsection