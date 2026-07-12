<section id="page-penilaian" class="page" aria-label="Penilaian Mahasiswa">
<div class="pen-outer">
  <aside class="sidebar" id="penSidebar" aria-label="Navigasi sub-portal">
    <div class="sidebar-inner">
      <div class="sb-card active" id="sb-forum" onclick="switchSection('forum')" role="button" tabindex="0" aria-label="Forum Maba" style="background-image:url('{{ asset('images/portal-forum.png') }}')">
        <span class="sb-main">FORUM<br>MABA</span>
      </div>
      <div class="sb-card" id="sb-ioh"   onclick="switchSection('ioh')"   role="button" tabindex="0" aria-label="IoH"   style="background-image:url('{{ asset('images/portal-ioh.png') }}')">
        <span class="sb-main">IoH</span><span class="sb-sub">Introduction of<br>Himpunan</span>
      </div>
      <div class="sb-card" id="sb-ldk"   onclick="switchSection('ldk')"   role="button" tabindex="0" aria-label="LDK"   style="background-image:url('{{ asset('images/portal-ldk.png') }}')">
        <span class="sb-main">LDK</span><span class="sb-sub">Latihan Dasar<br>Kepemimpinan</span>
      </div>
      <div class="sb-card" id="sb-nako"  onclick="switchSection('nako')"  role="button" tabindex="0" aria-label="NAKO 10.0" style="background-image:url('{{ asset('images/portal-nako.png') }}')">
        <span class="sb-main">NAKO 10.0</span>
      </div>
      <div class="sb-card" id="sb-tet"  onclick="switchSection('tet')"  role="button" tabindex="0" aria-label="PESERTA TET" style="background-image:url('{{ asset('images/portal-nako.png') }}')">
        <span class="sb-main">PESERTA<br>TET</span>
      </div>
      <div class="sb-card" id="sb-arak"  onclick="switchSection('arak')"  role="button" tabindex="0" aria-label="ARAK ARAKAN" style="background-image:url('{{ asset('images/portal-nako.png') }}')">
        <span class="sb-main">ARAK<br>ARAKAN</span>
      </div>
      <div class="sb-card" id="sb-adminig"  onclick="switchSection('adminig')"  role="button" tabindex="0" aria-label="ADMIN IG OFF" style="background-image:url('{{ asset('images/portal-nako.png') }}')">
        <span class="sb-main">ADMIN<br> IG OFF</span>
      </div>
      <div class="sb-card" id="sb-dewan"  onclick="switchSection('dewan')"  role="button" tabindex="0" aria-label="DEWAN KOMUNAL" style="background-image:url('{{ asset('images/portal-nako.png') }}')">
        <span class="sb-main">DEWAN<br>KOMUNAL</span>
      </div>
      <div class="sb-card" id="sb-staff"  onclick="switchSection('staff')"  role="button" tabindex="0" aria-label="STAFF MUDA" style="background-image:url('{{ asset('images/portal-nako.png') }}')">
        <span class="sb-main">STAFF<br>MUDA</span>
      </div>
    </div>
  </aside>
  <main class="pen-main" id="penMain">
    <div class="panel stu-hdr">
      <span class="section-label" id="sectionLabel">FORUM MABA</span>
      <div class="stu-title" id="penName">PENILAIAN MAHASISWA: —</div>
      <div class="stu-nim" id="penNIM"></div>
    </div>
    <div class="panel assess-card">
      <table class="atbl" aria-label="Tabel aspek penilaian">
        <thead><tr><th colspan="2">Aspek Penilaian</th><th>Maks</th><th>Input Poin</th></tr></thead>
        <tbody id="assessBody"></tbody>
      </table>
      <div class="total-row">
        <span class="total-lbl">Total Poin:</span>
        <span class="total-val" id="totalVal" aria-live="polite">0</span>
        <span style="font-size:.68rem;color:var(--txt-mid);opacity:.65" id="totalMax">/ 0</span>
        <button class="btn-hitung" onclick="calcTotal()" aria-label="Hitung ulang">Σ Hitung Ulang</button>
      </div>
    </div>
    <div class="panel guide-card" id="guideCard">
      <h3 class="guide-title">Panduan Penilaian (Max Poin)</h3>
      <div class="guide-body" id="guideBody"></div>
    </div>
    <div class="act-row">
      <button class="btn-brn" onclick="simpan()">Simpan Penilaian</button>
      <button class="btn-brn" onclick="goTo('page-dashboard')">Batal</button>
      <button class="btn-brn" onclick="riwayat()">Lihat Riwayat</button>
    </div>
  </main>
</div>
</section>
