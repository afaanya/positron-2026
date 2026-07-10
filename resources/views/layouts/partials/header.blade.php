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
    position:sticky;top:0;height:58px;
    background:rgba(6,15,9,.93);backdrop-filter:blur(8px);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 28px;z-index:1000;border-bottom:1px solid rgba(160,120,20,.22);
    font-family:'Libre Baskerville',serif;
  }
  .gnavbar .nav-logo{cursor:pointer;text-decoration:none;display:flex;align-items:center}
  .gnavbar .nav-logo img{height:30px;width:auto;display:block;mix-blend-mode:screen;filter:brightness(1.1)}
  .gnavbar .nav-links{display:flex;align-items:center;gap:2px;list-style:none;margin:0;padding:0}
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
  @media(max-width:560px){.gnavbar .nav-links{display:none}}
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
    <img src="{{ asset('images/portal-logo.png') }}" alt="POSITRON 2026">
  </a>
  <ul class="nav-links" role="list">
    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><span class="dot tl"></span><span class="dot tr"></span>HOME<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}"><span class="dot tl"></span><span class="dot tr"></span>ABOUT<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('filosofi') }}" class="{{ request()->routeIs('filosofi') ? 'active' : '' }}"><span class="dot tl"></span><span class="dot tr"></span>FILOSOFI<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('timeline') }}" class="{{ request()->routeIs('timeline') ? 'active' : '' }}"><span class="dot tl"></span><span class="dot tr"></span>TIMELINE<span class="dot bl"></span><span class="dot br"></span></a></li>
  </ul>
  <div class="nav-right">
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

        <a class="pd-item" href="https://docs.google.com/forms/d/e/1FAIpQLSfmCmaEVXqK1s1E3H0XGTLKYiFSYI0ciSAoy1iGQyDEYdWjBQ/viewform?usp=dialog" target="_blank" rel="noopener">Kritik &amp; Saran</a>

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

<script>
  function gToggleProfile(e){
    if(e) e.stopPropagation();
    var dd=document.getElementById('gProfileDrop');
    var btn=document.getElementById('gUserBtn');
    var open=dd.classList.toggle('open');
    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
  }
  document.addEventListener('click',function(e){
    if(!e.target.closest('#gProfileDrop') && !e.target.closest('#gUserBtn')){
      var dd=document.getElementById('gProfileDrop');
      if(dd) dd.classList.remove('open');
    }
  });
</script>