<div class="modal-bg" id="profileModal" role="dialog" aria-modal="true" aria-label="Profil Mentor">
  <div class="panel modal-box">
    <button class="modal-close" onclick="closeModal('profileModal')" aria-label="Tutup">✕</button>
    <h2 class="modal-title">Profil Mentor</h2>
    <div class="prof-row"><span class="prof-lbl">Nama</span><span class="prof-val">Kakak Mentor {{ $mentorProfile['offering'] ?? '' }}</span></div>
    <div class="prof-row"><span class="prof-lbl">Role</span><span class="prof-val">Kakak Mentor</span></div>
    <div class="prof-row"><span class="prof-lbl">Username</span><span class="prof-val" id="profUser">{{ $mentorProfile['user'] ?? session('mentor_user', 'mentor') }}</span></div>
    <div class="prof-row"><span class="prof-lbl">Status</span><span class="prof-val"><span class="badge b-s">Online</span></span></div>
    <div class="modal-div"></div>
    <div class="prof-row"><span class="prof-lbl">Offering</span><span class="prof-val">{{ $mentorProfile['offering'] ?? '—' }}</span></div>
    <div class="prof-row"><span class="prof-lbl">Prodi</span><span class="prof-val">{{ $mentorProfile['prodi'] ?? '—' }}</span></div>
    <div class="prof-row"><span class="prof-lbl">Universitas</span><span class="prof-val">Universitas Negeri Malang</span></div>
    <div style="margin-top:18px"><button class="btn-brn" onclick="closeModal('profileModal')" style="width:100%;justify-content:center">Tutup</button></div>
  </div>
</div>
