@extends('layouts.app')

@section('title', 'Poin Penilaian Mahasiswa')

@section('content')

<style>
    .poin-page {
        display: grid;
        grid-template-columns: 72px 1fr;
        gap: 24px;
        padding: 44px 20px;
        min-height: calc(100vh - 48px);
        color: #f7f4e9;
        background: radial-gradient(circle at top left, rgba(255, 211, 117, 0.14), transparent 28%),
                    linear-gradient(180deg, #081a12 0%, #0a291d 100%);
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
        color: #ffe7a1;
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
        background: linear-gradient(90deg, rgba(255, 215, 115, 0.9), rgba(255, 183, 80, 0.95));
        box-shadow: 0 0 20px rgba(255, 215, 115, 0.22);
        transition: width 0.4s ease;
    }

    .task-list {
        display: grid;
        gap: 16px;
    }

    .task-card {
        position: relative;
        padding: 24px 24px 24px 28px;
        border-radius: 26px;
        background: rgba(10, 22, 16, 0.94);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 22px 40px rgba(0, 0, 0, 0.16);
        overflow: hidden;
        transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
    }

    .task-card:hover {
        transform: translateY(-2px);
    }

    .task-card.completed {
        border-color: rgba(83, 188, 110, 0.45);
        background: rgba(16, 36, 22, 0.95);
    }

    .task-number {
        position: absolute;
        top: 18px;
        right: 18px;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 215, 115, 0.15);
        border: 1px solid rgba(255, 215, 115, 0.25);
        display: grid;
        place-items: center;
        color: #ffd77d;
        font-weight: 700;
    }

    .task-title {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 700;
        color: #ffd77d;
    }

    .task-desc {
        margin-top: 10px;
        color: #d9d2b3;
        line-height: 1.7;
    }

    .task-meta {
        margin-top: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .task-badge,
    .complete-step {
        padding: 10px 16px;
        border-radius: 16px;
        font-size: 0.95rem;
        border: 1px solid rgba(255, 215, 115, 0.16);
        background: rgba(255, 255, 255, 0.06);
        color: #f7f4e9;
        transition: transform 0.2s ease, background 0.2s ease;
    }

    .complete-step {
        cursor: pointer;
        background: rgba(255, 215, 115, 0.12);
    }

    .complete-step:hover {
        transform: translateX(2px);
        background: rgba(255, 215, 115, 0.22);
    }

    .complete-step.completed {
        background: rgba(83, 188, 110, 0.18);
        border-color: rgba(83, 188, 110, 0.35);
        color: #b6f3b5;
        cursor: default;
    }

    .task-card.completed .task-badge {
        background: rgba(83, 188, 110, 0.16);
        color: #b6f3b5;
    }

    .task-card .badge-label {
        white-space: nowrap;
    }

    @media (max-width: 960px) {
        .poin-page {
            grid-template-columns: 1fr;
            padding: 32px 18px;
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
            transform: translate(0, 0);
            top: 60px;
        }
    }

    @keyframes boardDrift {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(6px); }
    }

    @keyframes shimmer {
        0%, 100% { text-shadow: 0 0 0 rgba(255, 255, 255, 0); }
        50% { text-shadow: 0 0 24px rgba(255, 215, 115, 0.55); }
    }

    @keyframes statusPulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.02); opacity: 0.92; }
    }

    @keyframes pathOrb {
        0%, 100% { top: 36px; }
        50% { top: calc(100% - 36px); }
    }

    @keyframes markerPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes markerGlow {
        0%, 100% { box-shadow: 0 0 0 rgba(255, 215, 115, 0.3); }
        50% { box-shadow: 0 0 18px rgba(255, 215, 115, 0.55); }
    }

    @keyframes floatCrown {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }

    @keyframes pointHover {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(4px); }
    }

    .option-button {
        opacity: 0.95;
        transition: opacity 0.25s ease, transform 0.25s ease, border-color 0.25s ease;
    }

    .option-button:hover {
        opacity: 1;
        transform: translateX(4px);
    }
        display: grid;
        gap: 18px;
    }

    .task-card {
        border-radius: 24px;
        padding: 22px 26px;
        background: rgba(10, 26, 19, 0.92);
        border: 1px solid rgba(255, 255, 255, 0.06);
        box-shadow: 0 18px 35px rgba(0, 0, 0, 0.22);
    }

    .task-card h3 {
        margin-bottom: 10px;
        font-size: 1.15rem;
        color: #ffd77d;
    }

    .task-card p {
        margin: 0;
        font-size: 0.98rem;
        line-height: 1.75;
        color: #e5e0cb;
    }

    .task-meta {
        margin-top: 16px;
        display: flex;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .task-meta span {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.05);
        color: #f7f4e9;
        font-size: 0.95rem;
    }

    @media (max-width: 960px) {
        .poin-page {
            grid-template-columns: 1fr;
            padding: 32px 18px;
        }

        .sidebar {
            padding: 22px 18px;
        }
    }
</style>

<div class="poin-page">
    <aside class="sidebar">
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Buka kategori">›</button>
        <div class="category-list" id="categoryList">
            <button class="option-button" data-key="forum-maba">Forum Maba</button>
            <button class="option-button" data-key="ldk">LDK</button>
            <button class="option-button" data-key="ioh">IoH</button>
            <button class="option-button" data-key="nako">Nako</button>
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
                <div class="stat-card">
                    <div class="stat-title">Progress</div>
                    <div class="stat-value"><span id="progressPercent">0%</span></div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Total Keseluruhan Poin</div>
                    <div class="stat-value" id="overallPoints">0</div>
                </div>
            </div>
            <div class="task-list" id="taskList"></div>
        </div>
    </main>
</div>

<script>
    const assignmentData = {
        'forum-maba': {
            title: 'Forum Maba',
            description: 'Kumpulan tugas untuk Forum Mahasiswa Baru yang menilai partisipasi, kesiapan, dan kolaborasi kelompok.',
            tasks: [
                {
                    title: 'Pengisian Formulir Kegiatan',
                    details: 'Isi semua data diri dan preferensi kegiatan dengan lengkap dan tepat waktu.',
                    points: '15 poin'
                },
                {
                    title: 'Diskusi Kelompok',
                    details: 'Ikuti sesi diskusi dengan aktif dan berikan gagasan konstruktif untuk tim.',
                    points: '20 poin'
                },
                {
                    title: 'Presentasi Ide Kelompok',
                    details: 'Presentasikan hasil diskusi secara jelas dan dukung tim dengan komunikasi yang baik.',
                    points: '25 poin'
                }
            ]
        },
        'ldk': {
            title: 'LDK',
            description: 'Penugasan dalam Latihan Dasar Kepemimpinan yang menilai kepemimpinan, kerjasama, dan refleksi diri.',
            tasks: [
                {
                    title: 'Materi Kepemimpinan',
                    details: 'Pelajari dan hadir dalam sesi materi kepemimpinan, lalu berikan ringkasan singkat.',
                    points: '18 poin'
                },
                {
                    title: 'Simulasi Teamwork',
                    details: 'Kerjakan simulasi tugas kelompok secara efektif dengan peran yang jelas.',
                    points: '22 poin'
                },
                {
                    title: 'Refleksi Pribadi',
                    details: 'Tuliskan pengalaman dan pembelajaran dari kegiatan kepemimpinan.',
                    points: '20 poin'
                }
            ]
        },
        'ioh': {
            title: 'IoH',
            description: 'Seri tugas IoH untuk menguji observasi, wawancara, dan penyajian hasil dalam bentuk dokumentasi.',
            tasks: [
                {
                    title: 'Observasi Kampus',
                    details: 'Lakukan observasi area kampus dan catat temuan penting untuk kelompok.',
                    points: '16 poin'
                },
                {
                    title: 'Interview Dosen',
                    details: 'Wawancarai dosen atau pembimbing dan ringkas hasil percakapan secara profesional.',
                    points: '24 poin'
                },
                {
                    title: 'Laporan Hasil',
                    details: 'Susun laporan ringkas berdasarkan observasi dan wawancara yang telah dilakukan.',
                    points: '20 poin'
                }
            ]
        },
        'nako': {
            title: 'Nako',
            description: 'Seri tugas Nako yang menilai inisiatif, kreativitas, dan kemampuan mewujudkan ide inovatif.',
            tasks: [
                {
                    title: 'Ide Kreatif Baru',
                    details: 'Usulkan ide kegiatan atau proyek yang dapat memperkuat rasa kebersamaan kampus.',
                    points: '18 poin'
                },
                {
                    title: 'Rencana Implementasi',
                    details: 'Susun langkah implementasi yang jelas agar ide dapat dieksekusi secara terstruktur.',
                    points: '22 poin'
                },
                {
                    title: 'Presentasi Nako',
                    details: 'Presentasikan ide dan dampak yang diharapkan dengan visualisasi sederhana.',
                    points: '20 poin'
                }
            ]
        }
    };

    const boardStatus = document.getElementById('boardStatus');
    const totalPointsEl = document.getElementById('totalPoints');
    const progressPercentEl = document.getElementById('progressPercent');
    const progressFill = document.getElementById('progressFill');
    const overallPointsEl = document.getElementById('overallPoints');
    const taskList = document.getElementById('taskList');
    const buttons = document.querySelectorAll('.option-button');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const categoryList = document.getElementById('categoryList');

    let currentCategoryKey = null;
    const completedTasks = {
        'forum-maba': [false, false, false],
        'ldk': [false, false, false],
        'ioh': [false, false, false],
        'nako': [false, false, false]
    };

    function parsePoints(value) {
        return Number(value.replace(/[^0-9]/g, '')) || 0;
    }

    function updateProgress(categoryKey) {
        const category = assignmentData[categoryKey];
        const completed = completedTasks[categoryKey].filter(Boolean).length;
        const total = category.tasks.length;
        const percent = Math.round((completed / total) * 100);

        const points = category.tasks.reduce((sum, task, index) => {
            return completedTasks[categoryKey][index] ? sum + parsePoints(task.points) : sum;
        }, 0);

        totalPointsEl.textContent = `${points}`;
        progressPercentEl.textContent = `${percent}%`;
        progressFill.style.width = `${percent}%`;
        updateOverallPoints();
    }

    function updateOverallPoints() {
        let total = 0;
        Object.keys(assignmentData).forEach(key => {
            const category = assignmentData[key];
            const status = completedTasks[key] || [];
            const points = category.tasks.reduce((sum, task, index) => {
                return status[index] ? sum + parsePoints(task.points) : sum;
            }, 0);
            total += points;
        });
        overallPointsEl.textContent = `${total}`;
    }

    function renderTasks(categoryKey) {
        const category = assignmentData[categoryKey];
        const tasks = category.tasks;
        const status = completedTasks[categoryKey];
        taskList.innerHTML = tasks.map((task, index) => {
            const completed = status[index];
            return `
                <div class="task-card ${completed ? 'completed' : ''}" data-index="${index}">
                    <div class="task-number">${index + 1}</div>
                    <h3 class="task-title">${task.title}</h3>
                    <p class="task-desc">${task.details}</p>
                    <div class="task-meta">
                        <div class="task-badge badge-label">${task.points}</div>
                        <button class="complete-step ${completed ? 'completed' : ''}" data-index="${index}" ${completed ? 'disabled' : ''}>
                            ${completed ? 'Selesai' : 'Tandai Selesai'}
                        </button>
                    </div>
                </div>
            `;
        }).join('');

        const doneCount = status.filter(Boolean).length;
        if (doneCount === tasks.length) {
            boardStatus.textContent = `Semua tugas ${category.title} selesai! Total poin: ${totalPointsEl.textContent}`;
        } else {
            boardStatus.textContent = `Kerjakan tugas berikutnya untuk dapat poin. ${doneCount}/${tasks.length} selesai.`;
        }
    }

    function renderCategory(key) {
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
        updateProgress(key);
        renderTasks(key);
        categoryList.classList.remove('show');
        sidebarToggle.textContent = '›';
    }

    function completeTask(index) {
        if (!currentCategoryKey) return;
        completedTasks[currentCategoryKey][index] = true;
        updateProgress(currentCategoryKey);
        renderTasks(currentCategoryKey);
        updateOverallPoints();
    }

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            renderCategory(button.dataset.key);
        });
    });

    taskList.addEventListener('click', event => {
        const button = event.target.closest('.complete-step');
        if (!button) return;
        const index = Number(button.dataset.index);
        completeTask(index);
    });

    sidebarToggle.addEventListener('click', () => {
        categoryList.classList.toggle('show');
        sidebarToggle.textContent = categoryList.classList.contains('show') ? '▾' : '›';
    });

    boardStatus.textContent = 'Pilih kategori di sisi kiri untuk mulai mengumpulkan poin.';
    totalPointsEl.textContent = '0';
    overallPointsEl.textContent = '0';
    progressPercentEl.textContent = '0%';
    progressFill.style.width = '0%';
    taskList.innerHTML = '';
</script>

@endsection
