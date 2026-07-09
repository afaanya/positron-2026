<nav class="navbar" aria-label="Navigasi utama">
  <a class="nav-logo" href="#" onclick="goTo('page-dashboard');return false;" aria-label="POSITRON 2026">
    <img src="{{ asset('images/portal-logo.png') }}" alt="POSITRON 2026" style="mix-blend-mode:screen;filter:brightness(1.15)">
  </a>
  <ul class="nav-links" role="list">
    <li><a href="{{ route('home') }}"><span class="dot tl"></span><span class="dot tr"></span>HOME<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('about') }}"><span class="dot tl"></span><span class="dot tr"></span>ABOUT<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('filosofi') }}"><span class="dot tl"></span><span class="dot tr"></span>FILOSOFI<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('timeline') }}"><span class="dot tl"></span><span class="dot tr"></span>TIMELINE<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('rangkaian') }}"><span class="dot tl"></span><span class="dot tr"></span>GROUP<span class="dot bl"></span><span class="dot br"></span></a></li>
    <li><a href="{{ route('manualbook') }}"><span class="dot tl"></span><span class="dot tr"></span>CONTACT<span class="dot bl"></span><span class="dot br"></span></a></li>
  </ul>
  <div class="nav-right">
    {{-- Sidebar toggle — shown only on penilaian page --}}
    <button class="sb-toggle" id="sbToggleBtn" onclick="toggleSidebar()" aria-label="Toggle sidebar">
      <svg viewBox="0 0 18 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="0" y1="1" x2="18" y2="1"/><line x1="0" y1="7" x2="18" y2="7"/><line x1="0" y1="13" x2="18" y2="13"/></svg>
      Sidebar
    </button>
    <div class="nav-user-wrap">
      <button class="nav-user" id="userBtn" onclick="toggleProfile()" aria-label="Menu profil" aria-haspopup="true" aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="#c8a030" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
      </button>
      <div class="profile-dropdown" id="profileDrop" role="menu">
        <div class="pd-header"><div class="pd-name" id="pdName">{{ $mentorProfile['user'] ?? session('mentor_user', 'Mentor') }}</div><div class="pd-role">Kakak Mentor · {{ $mentorProfile['offering'] ?? '—' }}</div></div>
        <div class="pd-item" role="menuitem" onclick="openProfileModal()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>Lihat Profil
        </div>
        <div class="pd-item" role="menuitem" onclick="showToast('Fitur pengaturan segera hadir.','')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>Pengaturan
        </div>
        <div class="pd-item danger" role="menuitem" onclick="doLogout()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>Keluar
        </div>
      </div>
    </div>
  </div>
</nav>
