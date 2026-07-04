@extends('layouts.app')

@section('title', 'Poin Penilaian Mahasiswa')

@section('content')

<style>
    .poin-page {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 32px;
        padding: 48px 24px;
        min-height: calc(100vh - 48px);
        color: #f7f4e9;
        background: radial-gradient(circle at top left, rgba(255, 211, 117, 0.14), transparent 28%),
                    linear-gradient(180deg, #081a12 0%, #0a291d 100%);
    }

    .sidebar {
        background: rgba(17, 41, 28, 0.9);
        border: 1px solid rgba(255, 211, 117, 0.18);
        border-radius: 28px;
        padding: 28px 20px;
        box-shadow: 0 30px 75px rgba(0, 0, 0, 0.28);
        backdrop-filter: blur(12px);
    }

    .sidebar-header {
        font-size: 1.45rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        margin-bottom: 24px;
        text-transform: uppercase;
        color: #ffdf94;
    }

    .option-button {
        display: block;
        width: 100%;
        text-align: left;
        font-size: 1rem;
        padding: 16px 18px;
        margin-bottom: 16px;
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(8, 22, 14, 0.8);
        color: #f7f4e9;
        cursor: pointer;
        transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
    }

    .option-button:hover,
    .option-button.active {
        background: rgba(255, 215, 115, 0.14);
        border-color: rgba(255, 215, 115, 0.45);
        transform: translateX(4px);
    }

    .content {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .content-header {
        font-size: 2rem;
        font-weight: 700;
        color: #fff;
    }

    .summary {
        padding: 24px 26px;
        border-radius: 24px;
        background: rgba(14, 36, 25, 0.85);
        border: 1px solid rgba(255, 215, 115, 0.12);
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .card-list {
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
        <div class="sidebar-header">Kategori Tugas</div>
        <button class="option-button active" data-key="forum-maba">Forum Maba</button>
        <button class="option-button" data-key="ldk">LDK</button>
        <button class="option-button" data-key="ioh">IoH</button>
    </aside>

    <main class="content">
        <div class="content-header">Poin Penilaian</div>
        <div class="summary" id="summary">Pilih kategori di sisi kiri untuk melihat detail penugasan dan poinnya.</div>
        <div class="card-list" id="cardList"></div>
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
        }
    };

    const summaryEl = document.getElementById('summary');
    const cardListEl = document.getElementById('cardList');
    const buttons = document.querySelectorAll('.option-button');

    function renderCategory(key) {
        const category = assignmentData[key];
        if (!category) {
            summaryEl.textContent = 'Kategori tidak ditemukan.';
            cardListEl.innerHTML = '';
            return;
        }

        summaryEl.innerHTML = `<strong>${category.title}</strong><br>${category.description}`;
        cardListEl.innerHTML = category.tasks.map(task => `
            <article class="task-card">
                <h3>${task.title}</h3>
                <p>${task.details}</p>
                <div class="task-meta">
                    <span>Nilai: ${task.points}</span>
                </div>
            </article>
        `).join('');
    }

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            renderCategory(button.dataset.key);
        });
    });

    renderCategory('forum-maba');
</script>

@endsection
