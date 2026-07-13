const nilai = window.nilaiMahasiswa || {};   
    const assignmentData = {
        forum: {
            title: 'Forum Maba',
            tasks: [
                {
                    title: 'Forum Maba',
                    details: 'Ikuti forum dan berkontribusi aktif dalam diskusi.',
                    points: nilai.forum || 0,
                }
            ]
        },
        ldk: {
            title: 'LDK',
            tasks: [
                {
                    title: 'LDK',
                    details: 'Hadiri dan jalankan kegiatan LDK dengan penuh tanggung jawab.',
                    points: nilai.ldk || 0,
                }
            ]
        },
        ioh: {
            title: 'IoH',
            tasks: [
                {
                    title: 'IoH',
                    details: 'Hadiri dan ikuti kegiatan IoH dengan penuh tanggung jawab.',
                    points: nilai.ioh || 0,
                }
            ]
        },
        nako: {
            title: 'Nako',
            tasks: [
                {
                    title: 'Nako',
                    details: 'Ambil bagian dalam kegiatan Nako dan tunjukkan kontribusi nyata.',
                    points: nilai.nako || 0
                }
            ]
        },
        buku: {
            title: 'Buku Angkatan',
            tasks: [
                {
                    title: 'CV',
                    details: '',
                    points: nilai.cv || 0
                },
                {
                    title: 'Mind Map',
                    details: '',
                    points: nilai.mindmap || 0
                },
                {
                    title: 'Struktur Organisasi',
                    details: '',
                    points: nilai.struktur || 0
                },
                {
                    title: 'Dosen DTEI',
                    details: '',
                    points: nilai.dosen || 0
                },
                {
                    title: 'Denah',
                    details: '',
                    points: nilai.denah || 0
                },
                {
                    title: 'TTD Offering',
                    details: '',
                    points: nilai.ttdoff || 0
                },
                {
                    title: 'TTD Kelompok',
                    details: '',
                    points: nilai.ttdkel || 0
                },
                {
                    title: 'TTD Pengurus HMD',
                    details: '',
                    points: nilai.ttdhmd || 0
                },
            ]
        },
        partisipasi: {
            title: 'Partisipasi',
            tasks: [
                {
                    title: 'Dewan Komunal',
                    details: '',
                    points: nilai.dewan || 0
                },
                {
                    title: 'Seven Segment',
                    details: '',
                    points: nilai.seven || 0
                },
                {
                    title: 'Coffe Offering',
                    details: '',
                    points: nilai.coffe || 0
                },
                {
                    title: 'Techno Extro Time',
                    details: '',
                    points: nilai.tet || 0
                },
                {
                    title: 'Staff Muda',
                    details: '',
                    points: nilai.staff || 0
                },
                {
                    title: 'Arak-Arakan',
                    details: '',
                    points: nilai.arak || 0
                },
                {
                    title: 'Elektro Cup',
                    details: '',
                    points: nilai.ecup || 0
                },
                {
                    title: 'Arus',
                    details: '',
                    points: nilai.arus || 0
                },
                {
                    title: 'Admin IG Angkatan',
                    details: '',
                    points: nilai.adminig || 0
                },
            ]
        },
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
        forum: [],
        ldk: [],
        ioh: [],
        nako: [],
        buku: [],
        partisipasi: []
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
        taskList.innerHTML = tasks.map((task, index) => {
            return `
                <div class="task-card" data-index="${index}">
                    <div class="task-card-front" style="min-height: auto; padding: 24px 28px 24px;">
                        <div class="task-number">${index + 1}</div>
                        <h3 class="task-title">${task.title}</h3>
                        <p class="task-desc">${task.details}</p>
                        <div class="task-meta" style="margin-left: 56px; margin-top: 12px; display: flex; align-items: baseline; gap: 6px;">
                            <span class="score-value" style="font-size: 1.8rem; line-height: 1;">${parsePoints(task.points)}</span>
                            <span style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.75);">poin</span>
                        </div>
                    </div>
                </div>
            `;
        }).join('');

        switch (categoryKey) {
            case 'forum':
                boardStatus.textContent = 'Poin yang diperoleh mahasiswa pada kegiatan Forum Maba.';
                break;

            case 'ldk':
                boardStatus.textContent = 'Poin yang diperoleh mahasiswa pada kegiatan LDK.';
                break;

            case 'ioh':
                boardStatus.textContent = 'Poin yang diperoleh mahasiswa pada kegiatan IoH.';
                break;

            case 'nako':
                boardStatus.textContent = 'Poin yang diperoleh mahasiswa pada kegiatan NAKO 10.0.';
                break;

            case 'buku':
                boardStatus.textContent = 'Daftar penugasan Buku Angkatan beserta poin yang diperoleh.';
                break;
            case 'partisipasi':
                boardStatus.textContent = 'Daftar kegiatan partisipasi beserta poin yang diperoleh.';
                break;
            default:
                boardStatus.textContent = 'Daftar poin mahasiswa.';
                break;   
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
    totalPointsEl.textContent = window.totalPoin || 0;    progressPercentEl.textContent = '0%';
    progressFill.style.width = '0%';
    taskList.innerHTML = '';
    document.querySelector('.option-button[data-key="forum"]')?.classList.add('active');    renderCategory('forum');
    // ensure aggregated total is computed on load
    updateOverallPoints();