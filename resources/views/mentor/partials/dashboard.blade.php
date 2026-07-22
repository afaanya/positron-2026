<section id="page-dashboard" class="page" aria-label="Dashboard Mentor">
<div class="dash-wrap">
  <div class="panel mentor-card">
    <p class="mc-label">Mentor Profil</p>
    <div class="mc-body">
      <div class="mc-avatar"><svg viewBox="0 0 34 34" fill="none"><circle cx="17" cy="13" r="7" fill="#888"/><path d="M2 33c0-8.3 6.7-15 15-15s15 6.7 15 15" fill="#888"/></svg></div>
      <div><div class="mc-name">KAKAK MENTOR {{ strtoupper($mentorProfile['offering'] ?? '') }}</div><div class="mc-role">{{ $mentorProfile['prodi'] ?? 'Mentor' }}</div></div>
    </div>
  </div>
  <div class="stats-row">
    <button class="stat-pill active" id="pill-all"     onclick="setPill('all')"     aria-pressed="true">Total Maba :</button>
    <button class="stat-pill"        id="pill-selesai" onclick="setPill('selesai')" aria-pressed="false">Selesai Dinilai :</button>
    <button class="stat-pill"        id="pill-belum"   onclick="setPill('belum')"   aria-pressed="false">Belum Dinilai :</button>
    <div class="search-group">
      <label class="sr-only" for="searchQ">Cari mahasiswa</label>
      <input class="srch-inp" type="search" id="searchQ" placeholder="Cari Maba......." oninput="render()" aria-label="Cari mahasiswa">
      <select class="filter-sel" id="filterSel" onchange="render()" aria-label="Filter status">
        <option value="">Filter Lainnya ▾</option>
        <option value="selesai">Selesai</option>
        <option value="proses">Proses</option>
        <option value="revisi">Revisi</option>
        <option value="belum">Belum</option>
      </select>
    </div>
  </div>
  <div class="panel table-card">
    <div class="th-row">
      <h2 class="t-title">Daftar Mahasiswa Baru</h2>
      <div style="display:flex;gap:9px">
        <button class="btn-brn" onclick="exportCSV()">↓ Ekspor Data</button>
      </div>
    </div>
    <div class="tbl-wrap">
      <table class="dtbl" aria-label="Tabel daftar mahasiswa baru">
        <thead><tr>
          <th scope="col">No.</th><th scope="col">Nama Lengkap</th>
          <th scope="col">NIM</th><th scope="col">Prodi/Offering</th>
          <th scope="col">Status Penilaian</th><th scope="col">Aksi (Detail &amp; Evaluasi)</th>
          <th scope="col">Status Kelulusan</th>
        </tr></thead>
        <tbody id="tblBody"></tbody>
      </table>
    </div>
    <nav class="pagination" aria-label="Navigasi halaman">
      <button class="pg-btn" onclick="goPage('first')" aria-label="Pertama">|&lt;</button>
      <button class="pg-btn" onclick="goPage('prev')"  aria-label="Sebelumnya">&lt;</button>
      <span id="pgNums" style="display:flex;gap:4px"></span>
      <button class="pg-btn" onclick="goPage('next')"  aria-label="Berikutnya">&gt;</button>
      <button class="pg-btn" onclick="goPage('last')"  aria-label="Terakhir">&gt;|</button>
    </nav>
    <div class="pg-info" id="pgInfo"></div>
  </div>
</div>
</section>
