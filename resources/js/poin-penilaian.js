const nilai = window.nilaiMahasiswa || {};   
    const assignmentData = {
        forum: {
            title: 'Forum Maba',
            tasks: [
                {
                    title: 'Forum Maba',
                    details: 'Ikuti forum dan berkontribusi aktif dalam diskusi.',
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
                    details: 'Hadiri dan jalankan kegiatan LDK dengan penuh tanggung jawab.',
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
                    details: 'Hadiri dan ikuti kegiatan IoH dengan penuh tanggung jawab.',
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
                    details: 'Ambil bagian dalam kegiatan Nako dan tunjukkan kontribusi nyata.',
                    points: nilai.nako || 0,
                    maxPoints: 100
                }
            ]
        },
        buku: {
            title: 'Buku Angkatan',
            tasks: [
                {
                    title: 'CV',
                    details: '',
                    points: nilai.cv || 0,
                    maxPoints: 15
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
                    maxPoints: 25
                },
                {
                    title: 'Denah',
                    details: '',
                    points: nilai.denah || 0,
                    maxPoints: 10
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
                    maxPoints: 30
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
                    points: nilai.tet || 0,
                    maxPoints: 25
                },
                {
                    title: 'Staff Muda',
                    details: '',
                    points: nilai.staff || 0,
                    maxPoints: 25
                },
                {
                    title: 'Arak-Arakan',
                    details: '',
                    points: nilai.arak || 0,
                    maxPoints: 10
                },
                {
                    title: 'Elektro Cup',
                    details: '',
                    points: nilai.ecup || 0,
                    maxPoints: 10
                },
                {
                    title: 'Arus',
                    details: '',
                    points: nilai.arus || 0,
                    maxPoints: 25
                },
                {
                    title: 'Admin IG Angkatan',
                    details: '',
                    points: nilai.adminig || 0,
                    maxPoints: 25
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

    function renderTasks(categoryKey, container) {
        const category = assignmentData[categoryKey];
        const tasks = category.tasks;

        container.innerHTML += tasks.map((task, index) => {
            return `
                <div class="task-card">
                    <div class="task-card-front" style="min-height:auto;padding:24px 28px;">
                        <div class="task-number">${index + 1}</div>

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
        pokokList.innerHTML = '';
        bukuList.innerHTML = '';
        partisipasiList.innerHTML = '';
        renderTasks('forum', pokokList);
        renderTasks('ldk', pokokList);
        renderTasks('ioh', pokokList);
        renderTasks('nako', pokokList);
        renderTasks('buku', bukuList);
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

    updateOverallPoints();
    updateProgress();
    renderAllCategories();