@extends('layouts.app')

@section('title', 'Poin Penilaian Mahasiswa')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">

<style>
    /* Backmost page background */
    html,
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Libre Baskerville', serif;}

    body {
    min-height: 100vh;
    background: url('{{ asset('images/login-bg.png') }}') center/cover no-repeat;
    color: #f8eed0;}   body {
    min-height: 100vh;
    font-family: 'Libre Baskerville', serif;
    background: url('{{ asset('images/login-bg.png') }}') center/cover no-repeat;
    color: #f8eed0;
    }   

    .poin-page {
        display: grid;
        grid-template-columns: 72px 1fr;
        gap: 24px;
        padding: 44px 20px;
        min-height: calc(100vh - 48px);
        color: #f7f4e9;
        background: transparent;
    }

    .sidebar {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 72px;
        min-height: calc(100vh - 48px);
        background: transparent;
        border: none;
        padding: 0;
        box-shadow: none;
        backdrop-filter: none;
    }

    .sidebar-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: auto;
        height: auto;
        margin: 0;
        padding: 0;
        border: none;
        background: transparent;
        color: #ffd77d;
        font-size: 2.2rem;
        line-height: 1;
        cursor: pointer;
        transition: transform 0.2s ease, color 0.2s ease;
    }

    .sidebar-toggle:hover {
        transform: translateX(2px);
        color: #fff;
    }

    .sidebar-toggle span,
    .sidebar-toggle strong {
        display: block;
    }

    .category-list {
        position: absolute;
        top: 50%;
        left: 100%;
        transform: translate(12px, -50%);
        width: 240px;
        display: none;
        flex-direction: column;
        gap: 14px;
        padding: 16px;
        border-radius: 22px;
        background: rgba(8, 18, 12, 0.98);
        border: 1px solid rgba(255, 215, 115, 0.14);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.22);
        backdrop-filter: blur(16px);
        z-index: 10;
    }

    .category-list.show {
        display: flex;
    }

    .option-button {
        display: block;
        width: 100%;
        text-align: left;
        font-size: 1rem;
        padding: 16px 18px;
        margin-bottom: 14px;
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        background: rgba(8, 22, 14, 0.8);
        color: #f7f4e9;
        cursor: pointer;
        position: relative;
        transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
    }

    .option-button::before {
        content: '';
        position: absolute;
        left: 12px;
        top: 50%;
        width: 0;
        height: 0;
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
        border-left: 7px solid rgba(255, 215, 115, 0.6);
        opacity: 0;
        transform: translateY(-50%);
        transition: opacity 0.2s ease;
    }

    .option-button.active::before {
        opacity: 1;
    }

    .option-button:hover,
    .option-button.active {
        background: rgba(255, 215, 115, 0.14);
        border-color: rgba(255, 215, 115, 0.45);
        transform: translateX(3px);
    }

        .option-button.active {
            padding-left: 32px;
        }

    .content {
        position: relative;
        overflow: hidden;
    }

    .points-panel {
        width: 100%;
        min-height: calc(100vh - 88px);
        padding: 32px;
        border-radius: 40px;
        background: radial-gradient(circle at top left, rgba(255, 228, 158, 0.08), transparent 18%),
                    linear-gradient(180deg, rgba(14, 30, 16, 0.94), rgba(6, 14, 8, 0.98));
        border: 1px solid rgba(255, 215, 115, 0.12);
        box-shadow: inset 0 0 60px rgba(0, 0, 0, 0.25);
    }

    .board-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .board-title {
        font-size: 1.9rem;
        font-weight: 700;
        color: #ffb38a;
        letter-spacing: 0.02em;
    }

    .board-status {
        padding: 16px 20px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 215, 115, 0.16);
        color: #f7f4e9;
        font-size: 0.98rem;
        max-width: 46%;
        min-width: 240px;
        box-shadow: 0 0 18px rgba(0, 0, 0, 0.12);
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .stat-card {
        padding: 18px 20px;
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 215, 115, 0.14);
        box-shadow: inset 0 0 16px rgba(255, 255, 255, 0.04);
    }

    .stat-title {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.75);
    }

    .stat-value {
        font-size: 2.3rem;
        font-weight: 800;
        margin-top: 10px;
        color: #fff;
    }

    .progress-bar {
        width: 100%;
        height: 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        overflow: hidden;
        margin-top: 14px;
        border: 1px solid rgba(255, 215, 115, 0.12);
    }

    .progress-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, rgba(0,190,180,0.95), rgba(255,123,92,0.95));
        box-shadow: 0 0 20px rgba(0,190,180,0.12);
        transition: width 0.4s ease;
    }

    .task-list {
        display: grid;
        gap: 18px;
    }

    .task-card {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        background: linear-gradient(180deg, rgba(6, 24, 26, 0.96), rgba(10, 34, 36, 0.98));
        border: 1px solid rgba(255,123,92,0.10);
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.24), inset 0 1px 0 rgba(255,255,255,0.02);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .total-card {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 140px;
        padding: 36px;
        border-radius: 28px;
        background: linear-gradient(180deg, rgba(2,8,6,0.48), rgba(2,8,6,0.66)), url('{{ asset('images/login-bg.png') }}') center/cover no-repeat;
        background-size: cover;
        background-position: center;
        border: 1px solid rgba(255,215,115,0.08);
        box-shadow: inset 0 2px 24px rgba(0,0,0,0.45);
        text-align: center;
    }

    .task-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 40px 90px rgba(0, 0, 0, 0.44), 0 6px 40px rgba(0,190,180,0.06);
    }

    .task-card.completed {
        border-color: rgba(83, 188, 110, 0.55);
        background: linear-gradient(180deg, rgba(14, 34, 18, 0.98), rgba(18, 46, 24, 0.98));
    }

    .task-card-inner {
        position: relative;
        width: 100%;
        display: block;
    }

    .task-number {
          position: absolute;
          top: 18px;
          left: 18px;
          width: 38px;
          height: 38px;
          border-radius: 50%;
          background: rgba(255, 215, 115, 0.16);
          border: 1px solid rgba(255, 215, 115, 0.25);
          display: grid;
          place-items: center;
          color: #ffd77d;
          font-weight: 700;
          font-size: 0.95rem;
    }

    .task-card-front,
    .task-card-back {
        width: 100%;
        min-height: 220px;
        /* add extra top padding so the number badge doesn't overlap title */
        padding: 48px 28px 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 18px;
        background: linear-gradient(180deg, rgba(2,8,6,0.55), rgba(2,8,6,0.72)), url('{{ asset('images/login-bg.png') }}') center/cover no-repeat;
        background-size: cover;
        background-position: center;
    }

    .task-card-back {
        display: none;
    }

    .task-card.flipped .task-card-front {
        display: none;
    }

    .task-card.flipped .task-card-back {
        display: flex;
    }

    .task-title {
        margin: 0 0 6px 56px; /* push right so badge doesn't overlap */
        font-size: 1.15rem;
        font-weight: 700;
        color: #e6fff8;
        letter-spacing: 0.01em;
        text-shadow: 0 2px 12px rgba(0, 0, 0, 0.25);
    }

    .task-desc {
        margin: 0 0 0 56px; /* align under title */
        color: #cfeee8;
        line-height: 1.7;
        font-size: 0.95rem;
    }

    .task-meta {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        align-items: center;
    }

    .task-badge,
    .view-score {
          padding: 12px 18px;
          border-radius: 18px;
          font-size: 0.95rem;
          border: 1px solid rgba(255, 123, 92, 0.18);
          color: #f7f4e9;
          transition: transform 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
    }

    .task-badge {
        background: rgba(255, 255, 255, 0.05);
    }

    .view-score {
          cursor: pointer;
          background: linear-gradient(135deg, rgba(0,190,180,0.12), rgba(255,99,71,0.14));
          box-shadow: 0 10px 18px rgba(0,0,0,0.25), inset 0 1px 0 rgba(255,255,255,0.02);
    }

    .view-score:hover {
        transform: translateY(-1px);
        background: linear-gradient(135deg, rgba(255, 179, 80, 0.22), rgba(255, 215, 115, 0.28));
    }

    .task-card-back .task-title {
        color: #ffe7a6;
    }

    .task-card-back .task-desc {
        color: #f7f4e2;
    }

    .task-card-back .task-badge {
        background: rgba(255, 215, 115, 0.18);
        border-color: rgba(255, 215, 115, 0.30);
        color: #111;
    }

    .task-card .badge-label {
        white-space: nowrap;
    }

    /* Kingdom-themed animations */
    .horse-anim {
        position: absolute;
        top: 12px;
        right: -120px;
        width: 140px;
        height: 56px;
        pointer-events: none;
        opacity: 0;
        transform: translateX(0) scale(0.95);
        z-index: 60;
    }

    .horse-anim.run {
        animation: horseRun 1.1s cubic-bezier(.2,.9,.2,1) forwards;
        opacity: 1;
    }

    @keyframes horseRun {
        0% { right: -180px; opacity: 0; transform: translateX(0) scale(0.9); }
        20% { opacity: 1; transform: translateX(-8px) scale(1); }
        60% { right: 50%; transform: translateX(-50%) scale(1.02); }
        100% { right: 110%; opacity: 0; transform: translateX(-120%) scale(0.95); }
    }

    .score-value {
        font-size: 2.6rem;
        font-weight: 900;
        color: #ffe8d8;
        text-shadow: 0 6px 28px rgba(0,0,0,0.5);
        display: inline-block;
        transform-origin: center bottom;
    }

    .task-card.flipped .score-value {
        animation: parchmentPop 0.9s cubic-bezier(.16,.9,.2,1) both;
    }

    @keyframes parchmentPop {
        0% { transform: translateY(8px) scale(0.86) rotateX(10deg); opacity: 0; }
        60% { transform: translateY(-6px) scale(1.06) rotateX(0deg); opacity: 1; }
        100% { transform: translateY(0) scale(1) rotateX(0deg); opacity: 1; }
    }

    @media (max-width: 960px) {
        .poin-page {
            grid-template-columns: 1fr;
            padding: 24px 16px;
        }

        .sidebar {
            position: absolute;
            left: 16px;
            top: 20px;
            width: auto;
            min-height: auto;
        }

        .category-list {
            left: 0;
            transform: translate(0, -50%);
            top: 70px;
            width: 220px;
        }

        .points-panel {
            padding: 22px;
        }

        .board-title {
            font-size: 1.6rem;
        }

        .stats-row {
            grid-template-columns: 1fr;
        }

        .stat-card {
            min-height: 130px;
        }

        .task-card-front,
        .task-card-back {
            padding: 20px 22px 20px;
            min-height: 200px;
        }

        .task-title,
        .task-desc {
            margin-left: 44px;
        }

        .task-number {
            top: 14px;
            left: 14px;
            width: 34px;
            height: 34px;
        }
    }
</style>

<div class="poin-page">
    <aside class="sidebar">
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Buka kategori">›</button>
        <div class="category-list" id="categoryList">
            <button class="option-button" data-key="penugasan">PENUGASAN</button>
            <button class="option-button" data-key="pelanggaran">PELANGGARAN</button>
            <button class="option-button" data-key="total-poin">TOTAL POIN</button>
        </div>
    </aside>

    <main class="content">
        <div class="points-panel">
            <div class="board-header">
                <div class="board-title">Poin Tugas Mahasiswa Baru</div>
                <div class="board-status" id="boardStatus">Pilih kategori di sisi kiri untuk melihat tugas dan raih poin.</div>
            </div>
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-title">Total Poin</div>
                    <div class="stat-value" id="totalPoints">0</div>
                </div>
                <div class="stat-card" id="progressCard">
                    <div class="stat-title">Progress</div>
                    <div class="stat-value"><span id="progressPercent">0%</span></div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                </div>
                <!-- Removed duplicate overall stat; main Total Poin now shows aggregated total -->
            </div>
            <!-- Decorative kingdom horse animation (appears on reveal) -->
            <div id="horseAnim" class="horse-anim" aria-hidden="true">
                <!-- simple stylized horse silhouette -->
                <svg viewBox="0 0 280 110" preserveAspectRatio="xMinYMid meet" width="100%" height="100%">
                    <g fill="#ffd7b8" stroke="#ff8b6b" stroke-width="2" transform="scale(0.7)">
                        <path d="M40 60 C40 40, 80 30, 110 36 C130 40, 140 54, 160 56 C170 57, 185 50, 200 44 C210 40, 230 38, 250 42 L260 44 L256 60 L242 62 L238 70 L220 78 L200 80 L190 76 L176 82 L160 84 L140 80 L120 72 L100 66 L82 64 L64 62 Z"/>
                        <circle cx="68" cy="46" r="6" fill="#2b3b3a" />
                        <path d="M96 38 C88 30, 80 28, 70 30" stroke="#2b3b3a" stroke-width="3" fill="none" stroke-linecap="round"/>
                    </g>
                </svg>
            </div>
            <div class="task-list" id="taskList"></div>
        </div>
    </main>
</div>

<script>
    const assignmentData = {
        'penugasan': {
            title: 'Penugasan',
            description: 'Daftar penugasan mahasiswa baru yang wajib dipenuhi.',
            tasks: [
                {
                    title: 'Forum Maba',
                    details: 'Ikuti forum dan berkontribusi aktif dalam diskusi.',
                    points: '20 poin'
                },
                {
                    title: 'LDK',
                    details: 'Hadiri dan jalankan kegiatan LDK dengan penuh tanggung jawab.',
                    points: '20 poin'
                },
                {
                    title: 'Nako',
                    details: 'Ambil bagian dalam kegiatan Nako dan tunjukkan kontribusi nyata.',
                    points: '20 poin'
                },
                {
                    title: 'Coffee Offering',
                    details: 'Hadiri Coffee Offering dan ikut mendukung suasana kegiatan.',
                    points: '15 poin'
                },
                {
                    title: 'Peserta TET',
                    details: 'Jadilah peserta TET dengan partisipasi aktif dan disiplin.',
                    points: '15 poin'
                },
                {
                    title: 'Arak-arakan',
                    details: 'Ikuti arak-arakan sesuai aturan dan tunjukkan semangat kebersamaan.',
                    points: '20 poin'
                },
                {
                    title: 'Admin IG Offering',
                    details: 'Bantu administrasi dan dokumentasi IG Offering dengan baik.',
                    points: '15 poin'
                },
                {
                    title: 'Dewan Komunal',
                    details: 'Berperan aktif dalam Dewan Komunal selama kegiatan berlangsung.',
                    points: '18 poin'
                },
                {
                    title: 'Staff Muda',
                    details: 'Tunjukkan kerja sama dan tanggung jawab sebagai Staff Muda.',
                    points: '18 poin'
                }
            ]
        },
        'pelanggaran': {
            title: 'Pelanggaran',
            description: 'Pelanggaran yang dilakukan akan dikurangi dari total poin.',
            tasks: [
                {
                    title: 'Tidak hadir pada Forum Maba',
                    details: 'Pelanggaran karena tidak hadir atau tidak mengikuti forum.',
                    points: '-10 poin'
                },
                {
                    title: 'Tidak hadir LDK',
                    details: 'Pelanggaran karena tidak mengikuti kegiatan LDK.',
                    points: '-12 poin'
                },
                {
                    title: 'Tidak hadir Nako',
                    details: 'Pelanggaran karena tidak mengikuti kegiatan Nako.',
                    points: '-10 poin'
                },
                {
                    title: 'Tidak hadir Coffee Offering',
                    details: 'Pelanggaran karena tidak mengikuti Coffee Offering.',
                    points: '-8 poin'
                },
                {
                    title: 'Tidak hadir TET',
                    details: 'Pelanggaran karena tidak mengikuti kegiatan TET.',
                    points: '-10 poin'
                },
                {
                    title: 'Tidak mengikuti Arak-arakan',
                    details: 'Pelanggaran karena tidak mengikuti arak-arakan.',
                    points: '-12 poin'
                },
                {
                    title: 'Tidak menjalankan tugas Admin IG Offering',
                    details: 'Pelanggaran karena tidak menjalankan tanggung jawab administrasi.',
                    points: '-8 poin'
                },
                {
                    title: 'Tidak hadir Dewan Komunal',
                    details: 'Pelanggaran karena tidak menghadiri Dewan Komunal.',
                    points: '-10 poin'
                },
                {
                    title: 'Tidak menjalankan tugas Staff Muda',
                    details: 'Pelanggaran karena tidak menjalankan tanggung jawab staff muda.',
                    points: '-10 poin'
                }
            ]
        }
    };

    const boardStatus = document.getElementById('boardStatus');
    const totalPointsEl = document.getElementById('totalPoints');
    const progressPercentEl = document.getElementById('progressPercent');
    const progressFill = document.getElementById('progressFill');
    const taskList = document.getElementById('taskList');
    const buttons = document.querySelectorAll('.option-button');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const categoryList = document.getElementById('categoryList');

    let currentCategoryKey = null;
    const revealedTasks = {
        'penugasan': [false, false, false, false, false, false, false, false, false],
        'pelanggaran': [false, false, false, false, false, false, false, false, false]
    };

    function parsePoints(value) {
        const match = String(value).match(/-?\d+/);
        return match ? Number(match[0]) : 0;
    }

    function updateProgress(categoryKey) {
        const category = assignmentData[categoryKey];
        const revealed = revealedTasks[categoryKey].filter(Boolean).length;
        const total = category.tasks.length;
        const percent = Math.round((revealed / total) * 100);
        // per-category points are not shown on the main stat; only progress updates here
        const points = category.tasks.reduce((sum, task, index) => {
            return revealedTasks[categoryKey][index] ? sum + parsePoints(task.points) : sum;
        }, 0);
        progressPercentEl.textContent = `${percent}%`;
        progressFill.style.width = `${percent}%`;
        updateOverallPoints();
    }

    function updateOverallPoints() {
        let total = 0;
        Object.keys(assignmentData).forEach(key => {
            const category = assignmentData[key];
            const status = revealedTasks[key] || [];
            const points = category.tasks.reduce((sum, task, index) => {
                return status[index] ? sum + parsePoints(task.points) : sum;
            }, 0);
            total += points;
        });
        totalPointsEl.textContent = `${total}`;
    }

    function renderTasks(categoryKey) {
        const category = assignmentData[categoryKey];
        const tasks = category.tasks;
        const status = revealedTasks[categoryKey];
        taskList.innerHTML = tasks.map((task, index) => {
            const revealed = status[index];
            return `
                <div class="task-card ${revealed ? 'flipped' : ''}" data-index="${index}">
                    <div class="task-card-inner">
                        <div class="task-card-front">
                            <div class="task-number">${index + 1}</div>
                            <h3 class="task-title">${task.title}</h3>
                            <p class="task-desc">${task.details}</p>
                            <div class="task-meta">
                                <button class="view-score" data-index="${index}">${revealed ? 'Tutup' : 'Lihat Skor'}</button>
                            </div>
                        </div>
                        <div class="task-card-back">
                            <div class="task-number">${index + 1}</div>
                            <h3 class="task-title">Skor Tugas</h3>
                            <p class="task-desc">Point yang diperoleh setelah dikerjakan.</p>
                            <div style="display:flex;align-items:center;gap:18px;justify-content:flex-end;flex-wrap:wrap">
                                <div style="text-align:right">
                                    <div class="score-value">${parsePoints(task.points)}</div>
                                    <div style="font-size:0.85rem;color:rgba(255,255,255,0.7)">poin</div>
                                </div>
                            </div>
                            <div class="task-meta" style="margin-top:12px;">
                                <button class="view-score" data-index="${index}">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }).join('');

        const revealedCount = status.filter(Boolean).length;
        if (revealedCount === tasks.length) {
            boardStatus.textContent = `Semua tugas ${category.title} sudah bisa dilihat skor poinnya.`;
        } else {
            boardStatus.textContent = `Klik Lihat Skor untuk melihat poin setiap tugas setelah Anda mengerjakannya.`;
        }
    }

    function triggerHorseAnimation() {
        const el = document.getElementById('horseAnim');
        if (!el) return;
        el.classList.remove('run');
        // reflow to restart animation
        void el.offsetWidth;
        el.classList.add('run');
        // auto-remove class after animation duration
        setTimeout(() => el.classList.remove('run'), 1200);
    }

    function renderCategory(key) {
        // Special view: show aggregated total when selected
        if (key === 'total-poin') {
            currentCategoryKey = 'total-poin';
            updateOverallPoints();
            boardStatus.textContent = 'Ringkasan: Total akumulasi poin dari semua penugasan dan pelanggaran.';
            taskList.innerHTML = `
                <div class="task-card total-card">
                    <div>
                        <div class="score-value">${totalPointsEl.textContent}</div>
                        <div style="font-size:0.95rem;color:rgba(255,255,255,0.85);margin-top:6px">Total Akumulasi Poin</div>
                    </div>
                </div>
            `;
            // hide progress when viewing totals
            const progressCard = document.getElementById('progressCard');
            if (progressCard) progressCard.style.display = 'none';
            categoryList.classList.remove('show');
            sidebarToggle.textContent = '›';
            return;
        }

        const category = assignmentData[key];
        if (!category) {
            boardStatus.textContent = 'Kategori tidak ditemukan.';
            taskList.innerHTML = '';
            totalPointsEl.textContent = '0';
            progressPercentEl.textContent = '0%';
            progressFill.style.width = '0%';
            return;
        }

        currentCategoryKey = key;
        // Hide progress when viewing pelanggaran; show otherwise
        const progressCard = document.getElementById('progressCard');
        if (progressCard) progressCard.style.display = (key === 'pelanggaran') ? 'none' : '';

        updateProgress(key);
        renderTasks(key);
        categoryList.classList.remove('show');
        sidebarToggle.textContent = '›';
    }

    function toggleScoreView(index) {
        if (!currentCategoryKey) return;
        revealedTasks[currentCategoryKey][index] = !revealedTasks[currentCategoryKey][index];
        updateProgress(currentCategoryKey);
        renderTasks(currentCategoryKey);
    }

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            renderCategory(button.dataset.key);
        });
    });

    taskList.addEventListener('click', event => {
        const button = event.target.closest('.view-score');
        if (!button) return;
        const index = Number(button.dataset.index);
        toggleScoreView(index);
    });

    sidebarToggle.addEventListener('click', () => {
        categoryList.classList.toggle('show');
        sidebarToggle.textContent = categoryList.classList.contains('show') ? '▾' : '›';
    });

    boardStatus.textContent = 'Pilih kategori di sisi kiri untuk mulai mengumpulkan poin.';
    totalPointsEl.textContent = '0';
    progressPercentEl.textContent = '0%';
    progressFill.style.width = '0%';
    taskList.innerHTML = '';
    document.querySelector('.option-button[data-key="penugasan"]').classList.add('active');
    renderCategory('penugasan');
    // ensure aggregated total is computed on load
    updateOverallPoints();
</script>

@endsection
