const nilai = window.nilaiMahasiswa || {};   
    const assignmentData = {
        forum: {
            title: 'Forum Maba',
            tasks: [
                {
                    title: 'Forum Maba',
                    details: '',
                    points: nilai.forum || 0,
                    maxPoints: 200
                }
            ]
        },
        ldk: {
            title: 'LDK',
            tasks: [
                {
                    title: 'LDK',
                    details: '',
                    points: nilai.ldk || 0,
                    maxPoints: 100
                }
            ]
        },
        ioh: {
            title: 'IoH',
            tasks: [
                {
                    title: 'IoH',
                    details: '',
                    points: nilai.ioh || 0,
                    maxPoints: 100
                }
            ]
        },
        nako: {
            title: 'Nako',
            tasks: [
                {
                    title: 'Nako',
                    details: '',
                    points: nilai.nako || 0,
                    maxPoints: 100
                }
            ]
        },
        arus:{
            title: 'Arus',
            tasks: [
                {
                    title: 'Arus',
                    details: '',
                    points: nilai.arus || 0,
                    maxPoints: 150
                }
            ]

        },
        buku: {
            title: 'Buku Angkatan',
            tasks: [
                {
                    title: 'Journey to DTEI',
                    details: '',
                    points: nilai.journeytodtei || 0,
                    maxPoints: 15
                },
                {
                    title: 'CV',
                    details: '',
                    points: nilai.cv || 0,
                    maxPoints: 10
                },
                {
                    title: 'Mind Map',
                    details: '',
                    points: nilai.mindmap || 0,
                    maxPoints: 10
                },
                {
                    title: 'Struktur Organisasi',
                    details: '',
                    points: nilai.struktur || 0,
                    maxPoints: 5
                },
                {
                    title: 'Dosen DTEI',
                    details: '',
                    points: nilai.dosen || 0,
                    maxPoints: 20
                },
                {
                    title: 'Denah',
                    details: '',
                    points: nilai.denah || 0,
                    maxPoints: 5
                },
                {
                    title: 'TTD Offering',
                    details: '',
                    points: nilai.ttdoff || 0,
                    maxPoints: 10
                },
                {
                    title: 'TTD Kelompok',
                    details: '',
                    points: nilai.ttdkel || 0,
                    maxPoints: 10
                },
                {
                    title: 'TTD Pengurus HMD',
                    details: '',
                    points: nilai.ttdhmd || 0,
                    maxPoints: 15
                },
            ]
        },
        partisipasi: {
            title: 'Partisipasi',
            tasks: [
                {
                    title: 'Dewan Komunal',
                    details: '',
                    points: nilai.dewan || 0,
                    maxPoints: 35
                },
                {
                    title: 'Seven Segment',
                    details: '',
                    points: nilai.seven || 0,
                    maxPoints: 50
                },
                {
                    title: 'Coffe Offering',
                    details: '',
                    points: nilai.coffe || 0,
                    maxPoints: 15
                },
                {
                    title: 'Techno Extro Time',
                    details: '',
                    points: nilai.tetp || 0,
                    maxPoints: 35
                },
                {
                    title: 'Arak-Arakan',
                    details: '',
                    points: nilai.arak || 0,
                    maxPoints: 20
                },
                {
                    title: 'Elektro Cup',
                    details: '',
                    points: nilai.ecup || 0,
                    maxPoints: 15
                },
                {
                    title: 'Admin IG Angkatan',
                    details: '',
                    points: nilai.adminig || 0,
                    maxPoints: 50
                },
                {
                    title: 'Admin IG Offering',
                    details: '',
                    points: nilai.adminig || 0,
                    maxPoints: 30
                },
            ]
        },
    };

    const totalPointsEl = document.getElementById('totalPoints');
    const progressPercentEl = document.getElementById('progressPercent');
    const progressFill = document.getElementById('progressFill');
    const pokokList = document.getElementById('pokokList');
    const bukuList = document.getElementById('bukuList');
    const partisipasiList = document.getElementById('partisipasiList');

    function parsePoints(value) {
        const match = String(value).match(/-?\d+/);
        return match ? Number(match[0]) : 0;
    }

    function updateProgress() {
        let totalTask = 0;
        let completedTask = 0;

        Object.values(assignmentData).forEach(category => {
            category.tasks.forEach(task => {
                totalTask++;

                if (parsePoints(task.points) > 0) {
                    completedTask++;
                }
            });
        });

        const percent = totalTask === 0
            ? 0
            : Math.round((completedTask / totalTask) * 100);

        progressPercentEl.textContent = `${percent}%`;
        progressFill.style.width = `${percent}%`;

        updateOverallPoints();
    }

    function updateOverallPoints() {
        let total = 0;

        Object.values(assignmentData).forEach(category => {
            category.tasks.forEach(task => {
                total += parsePoints(task.points);
            });
        });

        totalPointsEl.textContent = total;
    }

    let nomorTask = 1;

    function renderTasks(categoryKey, container) {
        const category = assignmentData[categoryKey];
        const tasks = category.tasks;

        container.innerHTML += tasks.map(task => {
            return `
                <div class="task-card">
                    <div class="task-card-front" style="min-height:auto;padding:24px 28px;">
                        <div class="task-number">${nomorTask++}</div>

                        <h3 class="task-title">${task.title}</h3>

                        <p class="task-desc">${task.details || ''}</p>

                        <div class="task-meta"
                            style="margin-left:56px;margin-top:12px;display:flex;align-items:baseline;gap:6px;">

                            <span class="score-value" style="font-size:1.8rem;line-height:1;">
                                ${parsePoints(task.points)} / ${task.maxPoints}
                            </span>

                            <span style="font-size:.9rem;color:rgba(255,255,255,.75)">
                                poin
                            </span>

                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }

   function renderAllCategories () {
        nomorTask = 1;
        pokokList.innerHTML = '';
        bukuList.innerHTML = '';
        
        renderTasks('forum', pokokList);
        renderTasks('ldk', pokokList);
        renderTasks('ioh', pokokList);
        renderTasks('nako', pokokList);
        renderTasks('arus', pokokList);
        renderTasks('buku', bukuList);

        nomorTask = 1;
        partisipasiList.innerHTML = '';
        renderTasks('partisipasi', partisipasiList);
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

    // Tambahkan fungsi switcher tab ini di file JS kamu
    window.switchTaskTab = function(tabId) {
        // 1. Sembunyikan semua konten tab tugas
        document.querySelectorAll('.task-tab-content').forEach(content => {
            content.classList.remove('active');
        });

        // 2. Nonaktifkan status class 'active' di tombol navigasi
        document.querySelectorAll('.tab-button-link').forEach(button => {
            button.classList.remove('active');
        });

        // 3. Tampilkan tab konten yang diklik
        const activeContent = document.getElementById('tasks-' + tabId);
        if (activeContent) {
            activeContent.classList.add('active');
        }

        // 4. Set tombol yang sedang diklik menjadi aktif
        if (event && event.currentTarget) {
            event.currentTarget.classList.add('active');
        }
    };

    updateOverallPoints();
    updateProgress();
    renderAllCategories();