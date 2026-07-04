
  (function() {
    const allPages = [
      {
        title: 'POSITRON',
        num: 'I',
        html: `
          <p>Kampus menjadi ruang untuk menempa integritas, memperluas wawasan, dan menyusun arah hidup dengan kesadaran.</p>
          <p style="margin-top:12px;">Pembelajaran sejati tak berhenti di dalam kelas. Pendidikan tidak berakhir saat tugas dikumpulkan atau ujian selesai.</p>
          <p style="margin-top:12px;">Justru setelah itu, kita akan diuji dalam bentuk lain: ujian karakter, kejujuran, keberanian, dan nilai-nilai kemanusiaan.</p>
          <p style="margin-top:12px;">Bergabunglah dengan kami dalam perjalanan menuju transformasi diri dan pencapaian prestasi yang membanggakan.</p>
        `
      },
      {
        title: 'DEPARTEMEN',
        num: 'II',
        html: `
          <p>Departemen Teknik Elektro dan Informatika merupakan salah satu departemen di bawah Fakultas Teknik, Universitas Negeri Malang.</p>
          <p style="margin-top:12px;">Departemen ini berfokus pada pengembangan sumber daya manusia di bidang teknologi, rekayasa elektro, serta informatika dan komputer, baik dalam ranah kependidikan (calon guru SMK/vokasi) maupun non-kependidikan (profesional industri).</p>
        `
      },
      {
        title: 'VISI',
        num: 'III',
        html: `
          <p class="quote-style">
            "Menjadi departemen yang unggul dan menjadi rujukan dalam penyelenggaraan tridharma perguruan tinggi di bidang teknik elektro, informatika, dan pembelajarannya untuk menghasilkan lulusan yang inovatif, berdaya saing global, serta berkarakter."
          </p>
        `
      },
      {
        title: 'MISI',
        num: 'IV',
        html: `
          <ol class="misi-list">
            <li><b>Pendidikan dan Pembelajaran:</b> Menyelenggarakan pendidikan dan pembelajaran yang bermutu tinggi, adaptif terhadap perkembangan teknologi, dan berbasis riset di bidang teknik elektro serta informatika untuk menghasilkan lulusan yang kompeten dan profesional.</li>
            <li><b>Penelitian dan Inovasi:</b> Meningkatkan kuantitas dan kualitas penelitian serta pengembangan teknologi yang inovatif, tepat guna, dan diakui secara nasional maupun internasional.</li>
            <li><b>Pengabdian kepada Masyarakat:</b> Menerapkan hasil-hasil riset dan inovasi teknologi untuk membantu memecahkan masalah di masyarakat, industri, dan dunia pendidikan vokasi.</li>
            <li><b>Kerjasama dan Jejaring:</b> Memperluas jejaring kemitraan dengan institusi pendidikan, industri, pemerintah, dan alumni, baik di tingkat nasional maupun internasional untuk mendukung penguatan kompetensi lulusan.</li>
          </ol>
        `
      },
      {
        title: 'PRODI',
        num: 'V',
        html: `
          <p>Lulusan dari rumpun ini akan mendapatkan gelar S.Pd. (Sarjana Pendidikan) dan dipersiapkan menjadi tenaga pendidik profesional di sekolah vokasi (SMK) maupun instansi pelatihan teknis.</p>
          <p style="margin-top:10px;"><b>S1 Pendidikan Teknik Elektro (PTE)</b></p>
          <p>Fokus: Mempelajari ilmu ketenagalistrikan, sistem energi, otomasi industri, sekaligus dibekali ilmu pedagogi (cara mengajar).</p>
          <p style="margin-top:10px;"><strong>Prospek Kerja:</strong> Guru SMK Jurusan Teknik Ketenagalistrikan/Instalasi Listrik, instruktur pelatihan kerja (balai latihan kerja), atau pengembang media pembelajaran teknik.</p>
          <p style="margin-top:10px;"><b>S1 Pendidikan Teknik Informatika (PTI)</b></p>
          <p>Fokus: Menggabungkan ilmu komputer (pemrograman, jaringan, multimedia) dengan metode pengajaran.</p>
          <p style="margin-top:10px;"><strong>Prospek Kerja:</strong> Guru SMK Jurusan Rekayasa Perangkat Lunak (RPL), Teknik Komputer dan Jaringan (TKJ), Multimedia, atau menjadi instruktur IT.</p>
        `
      },
      {
        title: 'PRODI',
        num: 'VI',
        html: `
          <p>Lulusan dari rumpun ini mendapatkan gelar S.T. (Sarjana Teknik) atau S.Kom. (Sarjana Komputer) dan dipersiapkan untuk langsung terjun sebagai praktisi ahli di dunia industri dan teknologi.</p>
          <p style="margin-top:10px;"><b>S1 Teknik Elektro (TE)</b></p>
          <p>Fokus: Mempelajari sistem tenaga listrik (pembangkitan, transmisi, distribusi), elektronika, sistem kendali (control system), robotika, dan sistem tertanam (embedded system).</p>
          <p style="margin-top:10px;"><strong>Prospek Kerja:</strong> Electrical Engineer, ahli sistem kontrol di manufaktur, system integrator, hingga teknisi di perusahaan energi (seperti PLN atau perusahaan pembangkit listrik).</p>
          <p style="margin-top:10px;"><b>S1 Teknik Informatika (TI)</b></p>
          <p>Fokus: Menitikberatkan pada pengembangan perangkat lunak skala besar, pengolahan data, kecerdasan buatan (AI/Machine Learning), algoritma, dan arsitektur komputasi.</p>
          <p style="margin-top:10px;"><strong>Prospek Kerja:</strong> Software Engineer, Full-stack Developer, Data Scientist, AI Specialist, atau System Analyst.</p>
        `
      },
      {
        title: 'PRODI',
        num: 'VII',
        html: `
          <p>Program Pascasarjana (S2 & S3)</p>
          <p style="margin-top:10px;"><b>S2 Teknik Elektro:</b> Fokus pengembangan riset lanjutan di bidang sistem tenaga, kontrol, elektronika, maupun teknologi informasi.</p>
          <p style="margin-top:10px;"><b>S3 Teknik Elektro dan Informatika:</b> Program doktor untuk menghasilkan peneliti dan ilmuwan tingkat lanjut yang mampu menciptakan inovasi orisinal di bidang elektro dan IT.</p>
        `
      }
    ];
 
    const leftContent  = document.getElementById('leftContent');
    const rightContent = document.getElementById('rightContent');
    const leftNumber   = document.getElementById('leftNumber');
    const rightNumber  = document.getElementById('rightNumber');
 
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const dots = Array.from(document.querySelectorAll('.page-indicator span'));
 
    let currentPage = 0;
 
    function pageMarkup(page) {
      if (!page) return '';
      return '<h2 class="title-style">' + page.title + '</h2>' + page.html;
    }
 
    function setStatic(contentEl, numberEl, page) {
      if (!page) {
        contentEl.innerHTML = '';
        numberEl.textContent = '';
        return;
      }
      contentEl.innerHTML = pageMarkup(page);
      numberEl.textContent = '\u2014 ' + page.num + ' \u2014';
    }
 
    function updateUI() {
      prevBtn.disabled = currentPage <= 0;
      nextBtn.disabled = currentPage >= allPages.length - 1;
      dots.forEach(function(dot, i) { dot.classList.toggle('active', i === currentPage); });
    }
 
    function renderPage(pageIndex) {
      currentPage = pageIndex;
      setStatic(leftContent, leftNumber, null);
      setStatic(rightContent, rightNumber, allPages[currentPage]);
      updateUI();
    }
 
    window.turnToNextPage = function() {
      if (currentPage >= allPages.length - 1) return;
      renderPage(currentPage + 1);
    };
 
    window.turnToPrevPage = function() {
      if (currentPage <= 0) return;
      renderPage(currentPage - 1);
    };
 
    const flipbook = document.getElementById('flipbook');
    let startX = 0, startY = 0, isDragging = false;
    let touchStartX = 0, touchStartY = 0;
 
    flipbook.addEventListener('pointerdown', function(e) {
      startX = e.clientX; startY = e.clientY; isDragging = true;
    });
    document.addEventListener('pointerup', function(e) {
      if (!isDragging) return;
      isDragging = false;
      const dx = e.clientX - startX, dy = e.clientY - startY;
      if (Math.abs(dx) > 30 && Math.abs(dx) > Math.abs(dy) * 1.2) {
        if (dx < 0) window.turnToNextPage(); else window.turnToPrevPage();
      }
    });
 
    document.addEventListener('keydown', function(e) {
      if (e.key === 'ArrowRight' || e.key === ' ') { e.preventDefault(); window.turnToNextPage(); }
      else if (e.key === 'ArrowLeft') { e.preventDefault(); window.turnToPrevPage(); }
    });
 
    flipbook.addEventListener('click', function(e) {
      const rect = this.getBoundingClientRect();
      const x = e.clientX - rect.left;
      if (x > rect.width * 0.7) window.turnToNextPage();
      else if (x < rect.width * 0.3) window.turnToPrevPage();
    });
 
    flipbook.addEventListener('touchstart', function(e) {
      touchStartX = e.touches[0].clientX; touchStartY = e.touches[0].clientY;
    }, { passive: true });
    flipbook.addEventListener('touchend', function(e) {
      const dx = e.changedTouches[0].clientX - touchStartX;
      const dy = e.changedTouches[0].clientY - touchStartY;
      if (Math.abs(dx) > 30 && Math.abs(dx) > Math.abs(dy) * 1.2) {
        if (dx < 0) window.turnToNextPage(); else window.turnToPrevPage();
      }
    }, { passive: true });
 
    renderPage(0);
  })();
