{{-- ============================================================
     GLOBAL NAVBAR — replica of the mentor portal navbar.
     Self-contained (own fonts / CSS / JS) so it works on every
     page regardless of that page's asset pipeline.
     ============================================================ --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<style>
  .gnavbar{
    position:fixed;top:0;left:0;right:0;height:58px;
    background:rgba(6,15,9,.93);backdrop-filter:blur(8px);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 28px;z-index:1000;border-bottom:1px solid rgba(160,120,20,.22);
    font-family:'Libre Baskerville',serif;
  }
  .gnavbar .nav-logo{cursor:pointer;text-decoration:none;display:flex;align-items:center}
  .gnavbar .nav-logo img{height:30px;width:auto;display:block}
  /* nav-links di-center absolut supaya benar-benar di tengah navbar,
     tidak bergeser gara-gara lebar logo vs ikon user yang beda. */
  .gnavbar .nav-links{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);display:flex;align-items:center;gap:2px;list-style:none;margin:0;padding:0}
  .gnavbar .nav-links a{
    font-family:'Libre Baskerville',serif;font-size:.67rem;font-weight:700;
    color:#c8a030;text-decoration:none;text-transform:uppercase;letter-spacing:.13em;
    padding:6px 11px;position:relative;transition:color .2s;
  }
  .gnavbar .nav-links a::before,.gnavbar .nav-links a::after{content:'';position:absolute;left:5px;right:5px;border-color:transparent;border-style:solid;transition:border-color .2s}
  .gnavbar .nav-links a::before{top:1px;border-width:1px 1px 0 1px}
  .gnavbar .nav-links a::after{bottom:1px;border-width:0 1px 1px 1px}
  .gnavbar .nav-links a:hover,.gnavbar .nav-links a.active{color:#e0c050}
  .gnavbar .nav-links a:hover::before,.gnavbar .nav-links a.active::before,
  .gnavbar .nav-links a:hover::after,.gnavbar .nav-links a.active::after{border-color:#b88c28}
  .gnavbar .nav-links a .dot{position:absolute;width:3px;height:3px;background:#b88c28;border-radius:50%;opacity:0;transition:opacity .2s}
  .gnavbar .nav-links a:hover .dot,.gnavbar .nav-links a.active .dot{opacity:1}
  .gnavbar .nav-links a .dot.tl{top:0;left:5px}.gnavbar .nav-links a .dot.tr{top:0;right:5px}
  .gnavbar .nav-links a .dot.bl{bottom:0;left:5px}.gnavbar .nav-links a .dot.br{bottom:0;right:5px}
  .gnavbar .nav-right{display:flex;align-items:center;gap:10px}
  .gnavbar .nav-user-wrap{position:relative}
  .gnavbar .nav-user{
    width:32px;height:32px;border:1.5px solid #a08020;border-radius:50%;
    display:flex;align-items:center;justify-content:center;cursor:pointer;
    background:transparent;transition:border-color .2s,background .2s;
  }
  .gnavbar .nav-user:hover{background:rgba(160,120,20,.15);border-color:#c8a030}
  .gnavbar .nav-user svg{width:16px;height:16px;pointer-events:none}
  .gnav-dropdown{
    position:absolute;top:calc(100% + 8px);right:0;
    background:linear-gradient(160deg,#d8bc6a,#b09030);
    border:1.5px solid rgba(180,135,25,.55);border-radius:10px;
    box-shadow:0 8px 28px rgba(0,0,0,.55);min-width:210px;
    overflow:hidden;display:none;z-index:2000;
  }
  .gnav-dropdown.open{display:block}
  .gnav-dropdown .pd-header{padding:14px 16px 12px;border-bottom:1px solid rgba(80,50,10,.25)}
  .gnav-dropdown .pd-name{font-family:'Libre Baskerville',serif;font-size:.85rem;font-weight:700;color:#1a0e00}
  .gnav-dropdown .pd-role{font-size:.68rem;color:#3a2200;margin-top:2px;opacity:.75}
  .gnav-dropdown .pd-item{
    display:flex;align-items:center;gap:9px;padding:10px 16px;width:100%;
    font-family:'Libre Baskerville',serif;font-size:.75rem;font-weight:700;
    color:#1a0e00;cursor:pointer;transition:background .15s;text-decoration:none;
    border:none;background:transparent;text-align:left;
    border-bottom:1px solid rgba(80,50,10,.15);
  }
  .gnav-dropdown .pd-item:last-child{border-bottom:none}
  .gnav-dropdown .pd-item:hover{background:rgba(255,255,255,.2)}
  .gnav-dropdown .pd-item.danger{color:#7a1010}
  @media(max-width:820px){.gnavbar .nav-links{gap:0}.gnavbar .nav-links a{padding:5px 7px;font-size:.6rem}}
  @media(max-width:768px){.gnavbar .nav-links{display:none}}

  /* ── Hamburger button ── */
  .gnav-hamburger{
    display:none;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    gap:5px;
    width:34px;
    height:34px;
    background:transparent;
    border:none;
    cursor:pointer;
    padding:4px;
    margin-right:4px;
  }
  .gnav-hamburger span{
    display:block;
    width:22px;
    height:2px;
    background:#c8a030;
    border-radius:2px;
    transition:transform .3s, opacity .3s;
  }
  @media(max-width:768px){
    .gnav-hamburger{display:flex;}
  }

  /* ── Mobile full-screen nav overlay ── */
  /* ── Mobile dropdown nav (bukan fullscreen) ── */
  .gnav-mobile-overlay{
    display:none;
    position:fixed;
    top:58px;              /* nempel persis di bawah navbar */
    left:0;
    right:0;
    z-index:900;            /* di bawah navbar (1000), bukan nutup semua (9000) */
    background:rgba(6,15,9,.97);
    backdrop-filter:blur(8px);
    flex-direction:column;
    align-items:stretch;
    gap:0;
    max-height:0;
    overflow:hidden;
    border-bottom:1px solid rgba(160,120,20,.22);
    box-shadow:0 8px 20px rgba(0,0,0,.35);
    transition:max-height .3s ease;
  }
  .gnav-mobile-overlay.open{
    display:flex;
    max-height:400px;       /* sesuaikan kalau item menu bertambah */
  }
  .gnav-mobile-overlay a{
    display:block;
    font-family:'Libre Baskerville',serif;
    font-size:.95rem;
    font-weight:700;
    color:#c8a030;
    text-decoration:none;
    text-transform:uppercase;
    letter-spacing:.13em;
    padding:14px 28px;
    width:100%;
    text-align:left;
    border-bottom:1px solid rgba(180,135,25,.15);
    transition:color .2s,background .2s;
  }
  .gnav-mobile-overlay a:hover{
    color:#e0c050;
    background:rgba(180,135,25,.08);
  }
</style>

@php
    $isAdmin = session()->has('admin_login');
    $isMentor = session()->has('mentor_login');
    $isMahasiswa = session()->has('mahasiswa_login');
    if ($isAdmin)        { $gName = session('admin_user', 'Admin');  $gRole = 'Administrator'; }
    elseif ($isMentor)   { $gName = session('mentor_user', 'Mentor'); $gRole = 'Kakak Mentor'; }
    elseif ($isMahasiswa){ $gName = 'Mahasiswa';                      $gRole = 'Peserta MABA'; }
    else                 { $gName = 'Tamu';                           $gRole = 'Belum masuk'; }
@endphp

<nav class="gnavbar" aria-label="Navigasi utama">
  <a class="nav-logo" href="{{ route('home') }}" aria-label="POSITRON 2026">
    <img src="{{ asset('images/portal-logo.webp') }}?v=2" alt="POSITRON 2026">
  </a>
  <ul class="nav-links" role="list">
    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><span class="dot tl"></span><span class="dot tr"></span>HOME<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}"><span class="dot tl"></span><span class="dot tr"></span>ABOUT<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('filosofi') }}" class="{{ request()->routeIs('filosofi') ? 'active' : '' }}"><span class="dot tl"></span><span class="dot tr"></span>FILOSOFI<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('timeline') }}" class="{{ request()->routeIs('timeline') ? 'active' : '' }}"><span class="dot tl"></span><span class="dot tr"></span>TIMELINE<span class="dot bl"></span><span class="dot br"></span></a></li>
  </ul>
  <div class="nav-right">
    {{-- Hamburger — hanya muncul di mobile --}}
    <button class="gnav-hamburger" id="gHamburgerBtn" onclick="gToggleMobileMenu()" aria-label="Buka menu navigasi">
      <span></span><span></span><span></span>
    </button>
    <div class="nav-user-wrap">
      <button class="nav-user" id="gUserBtn" onclick="gToggleProfile(event)" aria-label="Menu profil" aria-haspopup="true" aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="#c8a030" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
      </button>
      <div class="gnav-dropdown" id="gProfileDrop" role="menu">
        <div class="pd-header"><div class="pd-name">{{ $gName }}</div><div class="pd-role">{{ $gRole }}</div></div>

        @if ($isMahasiswa)
          <a class="pd-item" href="{{ route('biodata') }}">Biodata</a>
          <a class="pd-item" href="{{ route('poin') }}">Poin Penilaian</a>
          <a class="pd-item" href="{{ route('sertifikat') }}">Sertifikat</a>
        @endif
        @if ($isMentor || $isAdmin)
          <a class="pd-item" href="{{ route('mentor.home') }}">Halaman Mentor</a>
        @endif
        @if ($isAdmin)
          <a class="pd-item" href="{{ route('admin.home') }}">Halaman Admin</a>
        @endif

        <a class="pd-item" href="https://forms.gle/Zn5ZR7WWp7P87vGw9" target="_blank" rel="noopener">Kritik &amp; Saran</a>

        @if ($isAdmin || $isMentor || $isMahasiswa)
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="pd-item danger">Keluar</button>
          </form>
        @else
          <a class="pd-item" href="{{ route('login') }}">Masuk</a>
        @endif
      </div>
    </div>
  </div>
</nav>

{{-- Mobile full-screen overlay menu --}}
<div class="gnav-mobile-overlay" id="gMobileOverlay" role="dialog" aria-modal="true" aria-label="Navigasi mobile">
  <button class="gnav-mobile-close" onclick="gToggleMobileMenu()" aria-label="Tutup menu">✕</button>
  <a href="{{ route('home') }}"   onclick="gToggleMobileMenu()">HOME</a>
  <a href="{{ route('about') }}"  onclick="gToggleMobileMenu()">ABOUT</a>
  <a href="{{ route('filosofi') }}" onclick="gToggleMobileMenu()">FILOSOFI</a>
  <a href="{{ route('timeline') }}" onclick="gToggleMobileMenu()">TIMELINE</a>
  @if ($isMahasiswa || $isMentor || $isAdmin)
    <a href="{{ route('rangkaian') }}" onclick="gToggleMobileMenu()">RANGKAIAN</a>
  @endif
</div>

<script>
  function gToggleProfile(e){
  if(e) e.stopPropagation();
  var dd=document.getElementById('gProfileDrop');
  var btn=document.getElementById('gUserBtn');

  // tutup menu mobile dulu kalau lagi kebuka
  var overlay=document.getElementById('gMobileOverlay');
  if(overlay) overlay.classList.remove('open');

  var open=dd.classList.toggle('open');
  btn.setAttribute('aria-expanded', open ? 'true' : 'false');
}

document.addEventListener('click',function(e){
  if(!e.target.closest('#gProfileDrop') && !e.target.closest('#gUserBtn')){
    var dd=document.getElementById('gProfileDrop');
    if(dd) dd.classList.remove('open');
  }
});

function gToggleMobileMenu(){
  var overlay = document.getElementById('gMobileOverlay');

  // tutup dropdown profil dulu kalau lagi kebuka
  var dd=document.getElementById('gProfileDrop');
  var btn=document.getElementById('gUserBtn');
  if(dd) dd.classList.remove('open');
  if(btn) btn.setAttribute('aria-expanded','false');

  if(overlay) overlay.classList.toggle('open');
}

document.addEventListener('click', function(e){
  if(!e.target.closest('#gMobileOverlay') && !e.target.closest('#gHamburgerBtn')){
    var overlay = document.getElementById('gMobileOverlay');
    if(overlay) overlay.classList.remove('open');
  }
});
</script>