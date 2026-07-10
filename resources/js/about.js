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
          <p>Departemen Teknik Elektro dan Informatika di Universitas Negeri Malang menggabungkan ilmu teknik elektro dan informatika dalam pendekatan komprehensif. Kurikulum berfokus pada pemecahan masalah, pengembangan kreatif, dan penerapan teknologi modern. Dosen berkualitas, fasilitas laboratorium lengkap, serta program pengabdian masyarakat terintegrasi membuat departemen ini ideal bagi pendidikan teknik elektro dan informatika. Lulusan siap berkompetisi di dunia profesional yang terus berkembang.</p>`
      },
      {
        title: 'HIMPUNAN MAHASISWA DEPARTEMEN TEKNIK ELEKTRO DAN INFORMATIKA',
        num: 'III',
        html: `
          <p class="quote-style">
            "Mewujudkan Departemen Teknik Elektro dan Informatika sebagai departemen yang unggul dan menjadi rujukan nasional dalam pengembangan bidang pendidikan dan sains khususnya dalam bidang pendidikan teknik elektro dan informatika yang relevan dengan kebutuhan pembangunan, masyarakat dan kemanusiaan."
          </p>
        `
      },
      {
        title: 'VISI',
        num: 'IV',
        html: `
          <p class="quote-style">
            "Menjadi Himpunan Mahasiswa Departemen Teknik Elketro dan Informatika yang profesional dan kolaboratif dalam mendukung pengembangan potensi serta daya saing mahasiswa."
          </p>
        `
      },
      {
        title: 'MISI',
        num: 'V',
        html: `
          <ol class="misi-list">
            <li>Meningkatkan kualitas tata kelola organisai yang solid, komunikasi, dan adaptif melalui pembinaan internal yang konsisten.</li>
            <li>Menyelenggarakan program yang relevan dengan kebutuhan dan perkembangan mahasiswa untuk mendukung penguatan potensi akademik, sosial, dan keterampila mahasiswa.</li>
            <li>Mengembangkan kolaborasi dan kemitraan strategis dengan pihak eksternal guna meningkatkan kualitas dan daya saing organisasi serta mahasiswa.</li>
          </ol>
        `
      },
      {
        title: 'PRODI KEPENDIDIKAN (S.Pd)',
        num: 'VI',
        html: `
          <p><b>S1 Pendidikan Teknik Elektro (PTE)</b></p>
          <p>Fokus: Mempelajari ilmu ketenagalistrikan, sistem energi, otomasi industri, sekaligus dibekali ilmu pedagogi (cara mengajar).</p>
          <p style="margin-top:10px;"><b>S1 Pendidikan Teknik Informatika (PTI)</b></p>
          <p>Fokus: Menggabungkan ilmu komputer (pemrograman, jaringan, multimedia) dengan metode pengajaran.</p>
          <p style="margin-top:10px;">`
      },
      {
        title: 'PRODI TEKNIK MURNI (S.T)', 
        num: 'VII',
        html: `
          <p><b>S1 Teknik Elektro (TE)</b></p>
          <p>Fokus: Mempelajari sistem tenaga listrik (pembangkitan, transmisi, distribusi), elektronika, sistem kendali (control system), robotika, dan sistem tertanam (embedded system).</p>
          <p style="margin-top:10px;"><b>S1 Teknik Informatika (TI)</b></p>
          <p>Fokus: Menitikberatkan pada pengembangan perangkat lunak skala besar, pengolahan data, kecerdasan buatan (AI/Machine Learning), algoritma, dan arsitektur komputasi.</p>
          <p style="margin-top:10px;">`
      },
      {
        title: 'PROGRAM PASCASARJANA',
        num: 'VIII',
        html: `
          <ol class="pascasarjana-list">
            <li>S2 Teknik Elektro</li>
            <li>S2 Data Sains</li>
            <li>S2 Pendidikan Teknik Elektro dan Informatika</li>
            <li>S3 Pendidikan Teknik Elektro dan Informatika</li>
          </ol>`
      }
      
    ];
 
    const leftContent  = document.getElementById('leftContent');
    const rightContent = document.getElementById('rightContent');
    const leftNumber   = document.getElementById('leftNumber');
    const rightNumber  = document.getElementById('rightNumber');
 
    const leaf      = document.getElementById('leaf1');
    const leafFront = document.getElementById('leaf1Front');
    const leafBack  = document.getElementById('leaf1Back');
 
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const indicatorContainer = document.getElementById('pageIndicator');
    let dots = [];
 
    let currentPage = 0;
    const totalSpreads = Math.ceil(allPages.length / 2);
    let isAnimating = false;
    const DURATION = 1150;
 
    function getPage(pageIndex) {
      return allPages[pageIndex] || null;
    }
 
    function pageMarkup(page) {
      if (!page) return '';
      return '<h2 class="title-style">' + page.title + '</h2>' + page.html;
    }
 
    function buildLeafFace(target, ornamentClasses, pageIndex) {
      target.innerHTML = '';
      const shadow = document.createElement('div');
      shadow.className = 'flip-shadow';
      target.appendChild(shadow);
 
      const spots = document.createElement('div');
      spots.className = 'age-spots';
      target.appendChild(spots);
 
      const wm = document.createElement('div');
      wm.className = 'watermark';
      target.appendChild(wm);
 
      ornamentClasses.forEach(function(c) {
        const orn = document.createElement('div');
        orn.className = 'ornament ' + c;
        target.appendChild(orn);
      });
 
      const text = document.createElement('div');
      text.className = 'text-container';
      const page = getPage(pageIndex);
      if (page) text.innerHTML = pageMarkup(page);
      target.appendChild(text);
 
      const num = document.createElement('div');
      num.className = 'page-number';
      if (page) num.textContent = '\u2014 ' + page.num + ' \u2014';
      target.appendChild(num);
    }
 
    function spreadLeft(spread) {
      return spread * 2;
    }

    function spreadRight(spread) {
      return spread * 2 + 1;
    }

    function primeLeaf(spread) {
      buildLeafFace(leafFront, ['tr', 'br'], spreadRight(spread));
      buildLeafFace(leafBack, ['tl', 'bl'], spreadLeft(spread + 1));
    }
 
    function setStatic(contentEl, numberEl, pageIndex) {
      const page = getPage(pageIndex);
      if (!page) {
        contentEl.innerHTML = '';
        numberEl.textContent = '';
        return;
      }
      contentEl.innerHTML = pageMarkup(page);
      numberEl.textContent = '\u2014 ' + page.num + ' \u2014';
    }

    function renderSpread(spread) {
      setStatic(leftContent, leftNumber, spreadLeft(spread));
      setStatic(rightContent, rightNumber, spreadRight(spread));
    }
 
    function renderPageIndicators() {
      dots = [];
      indicatorContainer.innerHTML = '';
      for (let i = 0; i < totalSpreads; i++) {
        const dot = document.createElement('span');
        if (i === currentPage) dot.classList.add('active');
        indicatorContainer.appendChild(dot);
        dots.push(dot);
      }
    }
 
    function updateUI() {
      prevBtn.disabled = currentPage <= 0 || isAnimating;
      nextBtn.disabled = currentPage >= totalSpreads - 1 || isAnimating;
      dots.forEach(function(dot, i) { dot.classList.toggle('active', i === currentPage); });
    }
 
    function init() {
      leaf.classList.remove('flipped', 'flipping', 'anim-forward', 'anim-backward');
      currentPage = 0;
      isAnimating = false;
      primeLeaf(currentPage);
      leaf.classList.remove('flipped');
      setStatic(leftContent, leftNumber, currentPage);
      setStatic(rightContent, rightNumber, currentPage + 1);
      renderPageIndicators();
      updateUI();
    }
 
    window.turnToNextPage = function() {
      if (currentPage >= totalSpreads - 1 || isAnimating) return;
      isAnimating = true;
      updateUI();
 
      const nextPage = currentPage + 1;
      primeLeaf(currentPage);
      leaf.classList.remove('flipped');
      leaf.style.zIndex = 100;
      leaf.classList.add('flipping', 'anim-forward');
 
      leaf.addEventListener('animationend', function handler(e) {
        if (e.animationName !== 'leafFlipForward') return;
 
        leaf.classList.remove('anim-forward', 'flipping');
        leaf.classList.add('flipped');
        leaf.style.zIndex = 6;
 
        currentPage = nextPage;
        renderSpread(currentPage);
        isAnimating = false;
        updateUI();
      }, { once: true });
    };
 
    window.turnToPrevPage = function() {
      if (currentPage <= 0 || isAnimating) return;
 
      isAnimating = true;
      updateUI();
 
      const prevPage = currentPage - 1;
      primeLeaf(prevPage);
      leaf.classList.add('flipped');
      leaf.style.zIndex = 100;
      leaf.classList.add('flipping', 'anim-backward');
 
      leaf.addEventListener('animationend', function handler(e) {
        if (e.animationName !== 'leafFlipBackward') return;
 
        leaf.classList.remove('anim-backward', 'flipping');
        leaf.classList.remove('flipped');
        leaf.style.zIndex = 10;
 
        currentPage = prevPage;
        renderSpread(currentPage);
        isAnimating = false;
        updateUI();
      }, { once: true });
    };
 
    let startX = 0, startY = 0, isDragging = false;
    const flipbook = document.getElementById('flipbook');
 
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
      if (isAnimating) return;
      const rect = this.getBoundingClientRect();
      const x = e.clientX - rect.left;
      if (x > rect.width * 0.7) window.turnToNextPage();
      else if (x < rect.width * 0.3) window.turnToPrevPage();
    });
 
    let touchStartX = 0, touchStartY = 0;
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
 
    init();
  })();
