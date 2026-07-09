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
