<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>POSITRON · Jurnal Klasik</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
  <style>
    * { margin:0; padding:0; box-sizing:border-box; }
 
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #0a0e0a;
      font-family: 'Playfair Display', serif;
      overflow: hidden;
      user-select: none;
      -webkit-user-select: none;
      touch-action: none;
    }
 
    .desk {
      width: 100%;
      height: 100%;
      background: radial-gradient(ellipse at 50% 40%, #2c3d27, #080d08 85%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
      box-shadow: inset 0 0 200px rgba(0,0,0,0.95);
      border: 22px solid #0c130e;
      padding: 20px;
    }
    .desk::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        repeating-linear-gradient(45deg, rgba(0,0,0,0.02) 0px, rgba(0,0,0,0.02) 3px, transparent 3px, transparent 15px),
        repeating-linear-gradient(-45deg, rgba(0,0,0,0.02) 0px, rgba(0,0,0,0.02) 3px, transparent 3px, transparent 15px);
      pointer-events: none;
    }
 
    .decor { position:absolute; z-index:5; pointer-events:none; opacity:0.35; }
    .decor-books {
      top:20px; left:20px; width:120px; height:75px;
      background: linear-gradient(160deg, #3d2818, #1a100a);
      border-radius: 4px 10px 10px 4px;
      box-shadow: 8px 15px 35px rgba(0,0,0,0.8);
      transform: rotate(-8deg);
      border-left: 5px solid #b8883a;
    }
    .decor-books::after {
      content: '✦ MANUSKRIP';
      position: absolute; bottom:6px; left:10px;
      font-family: 'Cinzel', serif; font-size:0.45rem; letter-spacing:3px;
      color:#c4a56a; opacity:0.6;
    }
    .decor-candle {
      top:28px; right:30px; width:16px; height:60px;
      background: linear-gradient(180deg, #e8d5b0, #b89f7a);
      border-radius: 4px 4px 3px 3px;
      box-shadow: 0 10px 35px rgba(0,0,0,0.5);
      transform: rotate(4deg);
    }
    .decor-candle::before {
      content:''; position:absolute; top:-12px; left:1px; width:14px; height:14px;
      background: radial-gradient(circle, #fce8b0, #d49c3a);
      border-radius:50%;
      box-shadow: 0 0 40px #f5b84a, 0 0 80px #d48c2a;
      opacity:0.6;
    }
    .decor-candle::after {
      content:'🕯'; position:absolute; top:-28px; left:-4px; font-size:1.4rem;
      filter: drop-shadow(0 0 25px #f5b84a); opacity:0.35;
    }
 
    .book-wrapper {
      position: relative;
      padding: 12px 16px;
      background: #0f1a12;
      border-radius: 18px;
      box-shadow:
        0 40px 100px rgba(0,0,0,0.95),
        0 20px 40px rgba(0,0,0,0.8),
        inset 0 0 30px #070f09;
      border: 2px solid #2a402e;
      max-width: 95vw;
      max-height: 85vh;
    }
    .book-wrapper::after {
      content:''; position:absolute; inset:10px; border-radius:14px;
      border: 1px solid rgba(180, 150, 90, 0.08);
      pointer-events: none;
    }
 
    #flipbook {
      width: 820px;
      height: 540px;
      max-width: 100%;
      max-height: 100%;
      background: #d8c9a8;
      position: relative;
      perspective: 3400px;
      -webkit-perspective: 3400px;
      overflow: hidden;
      border-radius: 10px;
      box-shadow:
        0 0 0 1px #2a3d2a,
        inset 0 0 60px rgba(60,40,15,0.18),
        inset 0 0 120px rgba(0,0,0,0.08);
    }
 
    @media (max-width: 900px) {
      #flipbook { width: 85vw; height: 68vh; }
      .page-content, .leaf-front, .leaf-back { padding: 24px 20px !important; }
      .title-style { font-size: 1.25rem !important; letter-spacing: 2px !important; }
      .text-container { font-size: 0.82rem !important; line-height: 1.6 !important; }
      .misi-list li { font-size: 0.72rem !important; }
      .decor { display: none; }
      .pen { display: none; }
    }
    @media (max-width: 600px) {
      #flipbook { width: 92vw; height: 72vh; }
      .page-content, .leaf-front, .leaf-back { padding: 15px 13px !important; }
      .title-style { font-size: 0.95rem !important; letter-spacing: 1px !important; }
      .text-container { font-size: 0.68rem !important; line-height: 1.5 !important; }
      .misi-list li { font-size: 0.63rem !important; }
      .page-number { font-size: 0.55rem !important; margin-top: 8px !important; }
      .ornament { display: none; }
      .controls button { padding: 6px 14px !important; font-size: 0.55rem !important; }
    }
 
    /* ===== TEKSTUR KERTAS TUA ===== */
    /* vignette dibakar langsung ke dalam stack gradient (bukan blend-mode terpisah)
       supaya elemen tetap bisa dipromosikan ke compositor layer & animasi tetap mulus */
    .paper-surface {
      background:
        radial-gradient(ellipse at 50% 50%, transparent 55%, rgba(70,50,25,0.10) 100%),
        radial-gradient(circle at 12% 18%, rgba(120,90,50,0.14) 0%, transparent 9%),
        radial-gradient(circle at 85% 12%, rgba(110,80,45,0.10) 0%, transparent 12%),
        radial-gradient(circle at 78% 85%, rgba(120,90,50,0.13) 0%, transparent 14%),
        radial-gradient(circle at 20% 90%, rgba(100,75,40,0.10) 0%, transparent 10%),
        radial-gradient(circle at 55% 45%, rgba(90,65,35,0.05) 0%, transparent 40%),
        repeating-radial-gradient(circle at 50% 50%, rgba(80,60,30,0.025) 0px, transparent 1.5px, transparent 3px),
        linear-gradient(rgba(110, 85, 50, 0.05) 1px, transparent 1px),
        linear-gradient(100deg, #e9dcbf, #f3e8cd 45%, #e6d8ba 100%);
      background-size: 100% 100%, 100% 100%, 100% 100%, 100% 100%, 100% 100%, 100% 100%, 9px 9px, 100% 2.6rem, 100% 100%;
    }
 
    .page-content {
      width: 50%;
      height: 100%;
      position: absolute;
      top: 0;
      padding: 38px 34px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      z-index: 1;
      transform: translateZ(0);
      background: none;
      overflow: hidden;
    }
    .page-content::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url('/images/logo buku.png') center center / 24% auto no-repeat;
      opacity: 0.16;
      pointer-events: none;
      z-index: 0;
    }
    .page-left  { left:0; border-radius:10px 0 0 10px; box-shadow: inset -45px 0 70px rgba(45,30,10,0.10); }
    .page-right { right:0; border-radius:0 10px 10px 0; box-shadow: inset 45px 0 70px rgba(45,30,10,0.10); }
 
    .page-fade { transition: opacity 0.18s ease; }
 
    .flipper-leaf {
      width: 50%;
      height: 100%;
      position: absolute;
      top: 0;
      right: 0;
      transform-origin: left center;
      transform-style: preserve-3d;
      -webkit-transform-style: preserve-3d;
      z-index: 10;
      will-change: transform;
      touch-action: none;
    }
    .flipper-leaf.flipped { transform: rotateY(-180deg); }
 
    /* Kurva tunggal dan menyatu (tanpa jeda datar di tengah) — kertas terangkat
       tipis dan menyempit sedikit persis di titik lipat, lalu turun kembali dengan
       tempo yang sama, meniru lengkungan alami kertas saat dibalik. */
    @keyframes leafFlipForward {
  0% {
    transform: rotateY(0deg) scaleX(1);
  }

  50% {
    transform: rotateY(-90deg) scaleX(0.94);
  }

  100% {
    transform: rotateY(-180deg) scaleX(1);
  }
}

@keyframes leafFlipBackward {
  0% {
    transform: rotateY(-180deg) scaleX(1);
  }

  50% {
    transform: rotateY(-90deg) scaleX(0.94);
  }

  100% {
    transform: rotateY(0deg) scaleX(1);
  }
}

.flipper-leaf.anim-forward {
  animation: leafFlipForward 0.3s ease-in-out forwards;
}

.flipper-leaf.anim-backward {
  animation: leafFlipBackward 0.3s ease-in-out forwards;
}
 
    .leaf-front, .leaf-back {
      width: 100%; height: 100%;
      position: absolute; top:0; left:0;
      backface-visibility: hidden;
      -webkit-backface-visibility: hidden;
      padding: 38px 34px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      overflow: hidden;
      will-change: transform;
    }
    .leaf-front { border-radius: 0 10px 10px 0; box-shadow: inset 45px 0 70px rgba(45,30,10,0.10); }
    .leaf-back  { transform: rotateY(180deg); border-radius: 10px 0 0 10px; box-shadow: inset -45px 0 70px rgba(45,30,10,0.10); }
 
    .flip-shadow {
      position: absolute; inset:0; pointer-events:none;
      opacity: 0;
      transition: opacity 0.5s ease-out;
      z-index: 5;
    }
    .leaf-front .flip-shadow { background: linear-gradient(to left, rgba(35,22,8,0.55) 0%, rgba(35,22,8,0.15) 35%, transparent 75%); }
    .leaf-back  .flip-shadow { background: linear-gradient(to right, rgba(35,22,8,0.55) 0%, rgba(35,22,8,0.15) 35%, transparent 75%); }
    .flipper-leaf.flipping .flip-shadow { opacity: 1; }
 
    .flipper-leaf::after {
      content:''; position:absolute; top:0; bottom:0; left:0; width:14px;
      background: linear-gradient(to right, rgba(30,20,8,0.20), transparent);
      z-index:6; pointer-events:none; opacity:0.7;
    }
 
    .watermark {
      position: absolute; top:50%; left:50%; transform: translate(-50%,-50%);
      width:18%; height:18%;
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120"><path d="M60 8L8 38v44l52 30 52-30V38L60 8zm0 18l34 20v34l-34 20-34-20V46l34-20z" fill="%237a6548" opacity="0.06"/><circle cx="60" cy="60" r="26" fill="none" stroke="%237a6548" stroke-width="1.5" opacity="0.03"/><text x="60" y="88" font-family="Cinzel" font-size="10" text-anchor="middle" fill="%237a6548" opacity="0.04">DTEI</text></svg>');
      background-size: contain; background-repeat: no-repeat; background-position: center;
      opacity: 0.14; pointer-events: none; z-index: 0;
    }
 
    .age-spots {
      position: absolute; inset:0; pointer-events:none; z-index:0; opacity:0.5;
      background-image:
        radial-gradient(circle, rgba(120,85,40,0.35) 0%, transparent 70%),
        radial-gradient(circle, rgba(110,75,35,0.30) 0%, transparent 65%),
        radial-gradient(circle, rgba(100,70,35,0.25) 0%, transparent 60%);
      background-size: 5% 4%, 4% 5%, 6% 5%;
      background-position: 14% 22%, 82% 68%, 68% 15%;
      background-repeat: no-repeat;
    }
 
    .text-container {
      position: relative; z-index: 2;
      font-family: 'Playfair Display', serif;
      color: #2d2013;
      text-shadow: 0.5px 0.5px 0 rgba(255,248,235,0.35);
      line-height: 1.75;
      font-size: 0.92rem;
    }
    .title-style {
      font-family: 'Cinzel', serif;
      font-size: 1.6rem;
      font-weight: 700;
      letter-spacing: 4px;
      color: #241708;
      margin-bottom: 12px;
      border-bottom: 1.5px solid rgba(120, 90, 50, 0.28);
      padding-bottom: 8px;
    }
    .quote-style {
      font-style: italic;
      font-size: 0.98rem;
      color: #362512;
      position: relative;
      padding: 4px 8px;
    }
    .quote-style::before {
      content: '\201C';
      font-family: 'Cinzel', serif;
      font-size: 2.2rem;
      color: rgba(120,90,50,0.35);
      position: absolute;
      left: -14px; top: -14px;
    }
 
    .misi-list {
      list-style: none;
      counter-reset: misi;
      margin-top: 4px;
    }
    .misi-list li {
      counter-increment: misi;
      position: relative;
      padding-left: 26px;
      margin-bottom: 9px;
      font-size: 0.8rem;
      line-height: 1.48;
    }
    .misi-list li::before {
      content: counter(misi);
      position: absolute;
      left: 0; top: 0;
      font-family: 'Cinzel', serif;
      font-weight: 700;
      font-size: 0.72rem;
      color: #7a5424;
      border: 1px solid rgba(120,90,50,0.4);
      width: 17px; height: 17px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .misi-list b {
      font-family: 'Cinzel', serif;
      font-size: 0.76rem;
      letter-spacing: 0.5px;
      color: #3a2712;
    }
 
    .page-number {
      font-family: 'Cinzel', serif;
      font-size: 0.7rem;
      color: #7a674e;
      text-align: center;
      margin-top: 16px;
      letter-spacing: 4px;
      opacity: 0.6;
    }
 
    .ornament { position:absolute; width:14px; height:14px; border: 1.5px solid rgba(120, 90, 50, 0.22); z-index:3; pointer-events:none; }
    .tl { top:20px; left:20px; border-right:none; border-bottom:none; }
    .tr { top:20px; right:20px; border-left:none; border-bottom:none; }
    .bl { bottom:20px; left:20px; border-right:none; border-top:none; }
    .br { bottom:20px; right:20px; border-left:none; border-top:none; }
 
    #flipbook::before {
      content:''; position:absolute; inset:0; z-index:0; pointer-events:none;
      box-shadow: inset 0 0 40px rgba(60,40,15,0.25), inset 0 0 90px rgba(30,20,8,0.12);
    }
    #flipbook::after {
      content:''; position:absolute; top:0; bottom:0; left:50%; width:34px; transform: translateX(-50%);
      background: linear-gradient(to right, rgba(35,22,8,0.14) 0%, transparent 32%, transparent 68%, rgba(35,22,8,0.14) 100%);
      z-index: 100; pointer-events:none;
    }
 
    .pen {
      position: absolute; bottom:10px; right:-24px; width:10px; height:140px;
      background: linear-gradient(180deg, #1a2a1e, #0a150e);
      border-radius: 2px 2px 10px 10px;
      transform: rotate(50deg);
      box-shadow: 15px 20px 35px rgba(0,0,0,0.5);
      z-index: 120; pointer-events:none; border: 1px solid #2d452f;
    }
    .pen::before {
      content:''; position:absolute; top:24px; left:-2px; right:-2px; height:5px;
      background: linear-gradient(90deg, #b88a3a, #f0d68a, #b88a3a);
      border-radius: 2px;
    }
    .pen::after {
      content:''; position:absolute; top:-15px; left:0px; width:0; height:0;
      border-left: 5px solid transparent; border-right: 5px solid transparent;
      border-bottom: 15px solid #d4b483;
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
    }
 
    .controls {
      margin-top: 20px; display:flex; gap:25px; z-index:110; position:relative;
      flex-wrap: wrap; justify-content:center; align-items:center;
    }
    .controls button {
      font-family: 'Cinzel', serif; font-size:0.7rem; padding:10px 28px;
      background: #1f3324; color:#dacbaa; border: 1px solid #3d5a42;
      border-radius: 50px; cursor:pointer; letter-spacing:2px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.4);
      transition: all 0.3s ease; backdrop-filter: blur(2px);
      touch-action: manipulation;
    }
    .controls button:hover { background:#2d4d36; color:#f5edd8; transform: translateY(-2px); box-shadow: 0 14px 35px rgba(0,0,0,0.5); }
    .controls button:active { transform: scale(0.94); }
    .controls button:disabled { opacity:0.3; cursor:not-allowed; transform:none !important; }
 
    .page-indicator { font-family:'Cinzel', serif; color:#8b7a64; font-size:0.7rem; letter-spacing:2px; display:flex; align-items:center; gap:8px; opacity:0.5; }
    .page-indicator span { display:inline-block; width:6px; height:6px; border-radius:50%; background:#5a4a34; transition: all 0.3s ease; }
    .page-indicator span.active { background:#b8883a; width:20px; border-radius:3px; }
  </style>
</head>
<body>
    @include('layouts.partials.header')
 
<div class="desk">
  <div class="decor decor-books"></div>
  <div class="decor decor-candle"></div>
 
  <div class="book-wrapper">
    <div id="flipbook">
 
      <div class="page-content page-left paper-surface" id="pageLeft">
        <div class="age-spots"></div>
        <div class="watermark"></div>
        <div class="ornament tl"></div>
        <div class="ornament bl"></div>
        <div class="text-container page-fade" id="leftContent"></div>
        <div class="page-number" id="leftNumber"></div>
      </div>
 
      <div class="flipper-leaf" id="leaf1">
        <div class="leaf-front paper-surface" id="leaf1Front"><div class="flip-shadow"></div></div>
        <div class="leaf-back paper-surface" id="leaf1Back"><div class="flip-shadow"></div></div>
      </div>
 
      <div class="page-content page-right paper-surface" id="pageRight">
        <div class="age-spots"></div>
        <div class="watermark"></div>
        <div class="ornament tr"></div>
        <div class="ornament br"></div>
        <div class="text-container page-fade" id="rightContent"></div>
        <div class="page-number" id="rightNumber"></div>
      </div>
 
    </div>
    <div class="pen"></div>
  </div>
 
  <div class="controls">
    <button id="prevBtn" onclick="turnToPrevPage()">◀ SEBELUMNYA</button>
    <div class="page-indicator" id="pageIndicator"></div>
    <button id="nextBtn" onclick="turnToNextPage()">SELANJUTNYA ▶</button>
  </div>
</div>
 
<script>
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
        title: 'VISI',
        num: 'III',
        html: `
          <p class="quote-style">
            "Mewujudkan Departemen Teknik Elektro dan Informatika sebagai departemen yang unggul dan menjadi rujukan nasional dalam pengembangan bidang pendidikan dan sains khususnya dalam bidang pendidikan teknik elektro dan informatika yang relevan dengan kebutuhan pembangunan, masyarakat dan kemanusiaan."
          </p>
        `
      },
      {
        title: 'MISI',
        num: 'IV',
        html: `
          <ol class="misi-list">
            <li>Menyelenggarakan pendidikan dan pembelajaran yang berkualitas tinggi untuk mengembangkan potensi dan kepribadian mahasiswa yang unggul secara nasional dan regional.</li>
            <li>Menyelenggarakan penelitian untuk memajukan ilmu pengetahuan dan teknologi elektro dan informatika, meningkatkan kesejahteraan masyarakat, dan mendapatkan pengakuan nasional dan internasional.</li>
            <li>Menyelenggarakan pengabdian kepada masyarakat sebagai pengamalan dan pembudayaan ilmu pengetahuan dan teknologi khususnya pada bidang elektro dan informatika untuk memajukan kesejahteraan masyarakat dan mencerdaskan kehidupan bangsa. </li>
            <li>Menyelenggarakan tata pamong departemen yang tangguh, akuntabel, dan transparan dan memperkuat kemitraan dalam rangka meningkatkan kualitas berkelanjutan. </li>
          </ol>
        `
      },
      {
        title: 'PRODI KEPENDIDIKAN (S.Pd)',
        num: 'V',
        html: `
          <p><b>S1 Pendidikan Teknik Elektro (PTE)</b></p>
          <p>Fokus: Mempelajari ilmu ketenagalistrikan, sistem energi, otomasi industri, sekaligus dibekali ilmu pedagogi (cara mengajar).</p>
          <p style="margin-top:10px;"><b>S1 Pendidikan Teknik Informatika (PTI)</b></p>
          <p>Fokus: Menggabungkan ilmu komputer (pemrograman, jaringan, multimedia) dengan metode pengajaran.</p>
          <p style="margin-top:10px;">`
      },
      {
        title: 'PRODI TEKNIK MURNI (S.T)', 
        num: 'VI',
        html: `
          <p><b>S1 Teknik Elektro (TE)</b></p>
          <p>Fokus: Mempelajari sistem tenaga listrik (pembangkitan, transmisi, distribusi), elektronika, sistem kendali (control system), robotika, dan sistem tertanam (embedded system).</p>
          <p style="margin-top:10px;"><b>S1 Teknik Informatika (TI)</b></p>
          <p>Fokus: Menitikberatkan pada pengembangan perangkat lunak skala besar, pengolahan data, kecerdasan buatan (AI/Machine Learning), algoritma, dan arsitektur komputasi.</p>
          <p style="margin-top:10px;">`
      },
      {
        title: 'PROGRAM PASCASARJANA',
        num: 'VII',
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
</script>

@include('layouts.partials.footer')
 
</body>
</html>