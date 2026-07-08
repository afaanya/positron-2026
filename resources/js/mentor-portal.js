'use strict';
/* ══════════════════════════════════════════════════════
   SECTION CONFIG — aspects per section
   ══════════════════════════════════════════════════════ */
const SECTIONS = {
  forum: {
    label: 'FORUM MABA',
    aspects: [
      { name:'Kehadiran',       max:10,  guide:'Maksimum 10 poin (1 poin per sesi kehadiran).' },
      { name:'Penugasan Video', max:30,  guide:'Maksimum 30 poin (kreativitas, durasi, kesesuaian tema).' },
      { name:'Keaktifan',       max:20,  guide:'Maksimum 20 poin (partisipasi aktif dalam forum).' },
      { name:'Atribut',         max:20,  guide:'Maksimum 20 poin (kelengkapan atribut peserta).' },
      { name:'Dresscode',       max:20,  guide:'Maksimum 20 poin (kesesuaian dresscode kegiatan).' },
    ],
    noteMax: 100,
  },
  ioh: {
    label: 'IoH — Introduction of Himpunan',
    aspects: [
      { name:'Kehadiran IOH',   max:10,  guide:'Maksimum 10 poin (hadir di sesi pengenalan himpunan).' },
      { name:'Interaksi',       max:25,  guide:'Maksimum 25 poin (keterlibatan dengan anggota himpunan).' },
      { name:'Penugasan IoH',   max:25,  guide:'Maksimum 25 poin (tugas pengenalan himpunan).' },
      { name:'Sikap',           max:20,  guide:'Maksimum 20 poin (sikap dan sopan santun selama IoH).' },
      { name:'Dresscode',       max:20,  guide:'Maksimum 20 poin (kesesuaian dresscode sesi IoH).' },
    ],
    noteMax: 100,
  },
  ldk: {
    label: 'LDK — Latihan Dasar Kepemimpinan',
    aspects: [
      { name:'Kehadiran LDK',   max:15,  guide:'Maksimum 15 poin (absensi penuh seluruh sesi LDK).' },
      { name:'Kepemimpinan',    max:30,  guide:'Maksimum 30 poin (inisiatif dan kemampuan memimpin tim).' },
      { name:'Tugas Kelompok',  max:25,  guide:'Maksimum 25 poin (kualitas dan presentasi tugas kelompok).' },
      { name:'Komunikasi',      max:20,  guide:'Maksimum 20 poin (kemampuan komunikasi efektif).' },
      { name:'Kedisiplinan',    max:10,  guide:'Maksimum 10 poin (ketepatan waktu dan aturan).' },
    ],
    noteMax: 100,
  },
  nako: {
    label: 'NAKO 10.0',
    aspects: [
      { name:'Kehadiran NAKO',  max:10,  guide:'Maksimum 10 poin (kehadiran penuh sesi NAKO).' },
      { name:'Penugasan NAKO',  max:30,  guide:'Maksimum 30 poin (tugas dan proyek NAKO 10.0).' },
      { name:'Inovasi',         max:25,  guide:'Maksimum 25 poin (ide kreatif dan inovatif).' },
      { name:'Presentasi',      max:20,  guide:'Maksimum 20 poin (kualitas presentasi proyek).' },
      { name:'Kolaborasi',      max:15,  guide:'Maksimum 15 poin (kerja sama tim NAKO).' },
    ],
    noteMax: 100,
  },
};

const BADGE_MAP = {
  selesai:['b-s','Selesai'],proses:['b-p','Proses'],revisi:['b-r','Revisi'],belum:['b-b','Belum'],
};
const PAGE_SIZE = 8;

/* ══════════════════════════════════════════════════════
   STATE
   ══════════════════════════════════════════════════════ */
const S = {
  auth:false, user:'mentor',
  pill:'all', curPage:1,
  activeStu:null, activeSection:'forum', sidebarOpen:true,
  assessments:(window.__ASSESS__ && typeof window.__ASSESS__==='object') ? window.__ASSESS__ : {},  // { stuId: { sectionKey: { aspectIdx: value } } }
  students: Array.isArray(window.__STUDENTS__) ? window.__STUDENTS__ : [],
};

/* ══════════════════════════════════════════════════════
   ROUTING
   ══════════════════════════════════════════════════════ */
function goTo(id){
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  // Show sidebar toggle button only on penilaian page
  document.body.classList.toggle('show-sb-toggle', id==='page-penilaian');
  window.scrollTo({top:0,behavior:'smooth'});
  closeAllDropdowns();
}

/* ══════════════════════════════════════════════════════
   AUTH
   ══════════════════════════════════════════════════════ */
function doLogout(){
  closeAllDropdowns();
  const f=document.getElementById('realLogoutForm');
  if(f){showToast('Keluar...','');f.submit();return;}
  window.location.href = '/login';
}

/* ══════════════════════════════════════════════════════
   PROFILE DROPDOWN
   ══════════════════════════════════════════════════════ */
function toggleProfile(){
  const dd=document.getElementById('profileDrop');
  const btn=document.getElementById('userBtn');
  const open=dd.classList.contains('open');
  closeAllDropdowns();
  if(!open){dd.classList.add('open');btn.setAttribute('aria-expanded','true');}
}
function closeAllDropdowns(){
  document.querySelectorAll('.profile-dropdown,.edit-dd-menu').forEach(d=>d.classList.remove('open'));
  document.getElementById('userBtn')?.setAttribute('aria-expanded','false');
}
document.addEventListener('click',e=>{
  if(!e.target.closest('.nav-user-wrap')&&!e.target.closest('.edit-dd-wrap')) closeAllDropdowns();
});
// Close the fixed-position edit menu when the page scrolls so it doesn't detach.
window.addEventListener('scroll',()=>{ if(document.querySelector('.edit-dd-menu.open')) closeAllDropdowns(); },{passive:true,capture:true});
function openProfileModal(){closeAllDropdowns();document.getElementById('profileModal').classList.add('open')}
function closeModal(id){document.getElementById(id).classList.remove('open')}
document.querySelectorAll('.modal-bg').forEach(m=>m.addEventListener('click',e=>{if(e.target===m)m.classList.remove('open')}));

/* ══════════════════════════════════════════════════════
   SIDEBAR TOGGLE (penilaian page)
   ══════════════════════════════════════════════════════ */
function toggleSidebar(){
  S.sidebarOpen=!S.sidebarOpen;
  const sb=document.getElementById('penSidebar');
  sb.classList.toggle('collapsed',!S.sidebarOpen);
  const btn=document.getElementById('sbToggleBtn');
  btn.innerHTML=S.sidebarOpen
    ?`<svg viewBox="0 0 18 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="0" y1="1" x2="18" y2="1"/><line x1="0" y1="7" x2="18" y2="7"/><line x1="0" y1="13" x2="18" y2="13"/></svg> Sidebar`
    :`<svg viewBox="0 0 18 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="0" y1="1" x2="18" y2="1"/><line x1="0" y1="7" x2="12" y2="7"/><line x1="0" y1="13" x2="18" y2="13"/></svg> Sidebar`;
}

/* ══════════════════════════════════════════════════════
   DASHBOARD — RENDER TABLE
   ══════════════════════════════════════════════════════ */
function getFiltered(){
  const q=(document.getElementById('searchQ')?.value||'').toLowerCase().trim();
  const sf=document.getElementById('filterSel')?.value||'';
  return S.students.filter(s=>{
    const qOk=!q||s.nama.toLowerCase().includes(q)||s.nim.includes(q);
    const sfOk=!sf||s.status===sf;
    const pfOk=S.pill==='all'||s.status===S.pill;
    return qOk&&sfOk&&pfOk;
  });
}

function render(){
  const rows=getFiltered();
  const total=rows.length;
  const totalPages=Math.max(1,Math.ceil(total/PAGE_SIZE));
  if(S.curPage>totalPages) S.curPage=totalPages;
  const start=(S.curPage-1)*PAGE_SIZE;
  const pageRows=rows.slice(start,start+PAGE_SIZE);

  const tbody=document.getElementById('tblBody');
  if(!pageRows.length){
    tbody.innerHTML=`<tr><td colspan="6" style="text-align:center;padding:28px;font-style:italic;color:var(--txt-mid);opacity:.7">Tidak ada data yang sesuai.</td></tr>`;
  }else{
    tbody.innerHTML=pageRows.map((s,i)=>{
      const [bc,bl]=BADGE_MAP[s.status]||BADGE_MAP.belum;
      const a=S.assessments[s.id];
      const scoreTip=a?Object.values(a).reduce((tot,sec)=>tot+Object.values(sec).reduce((x,y)=>x+y,0),0):null;
      return `<tr>
        <td class="td-no">${start+i+1}</td>
        <td class="td-nm">${esc(s.nama)}</td>
        <td class="td-nim">${esc(s.nim)}</td>
        <td>${esc(s.jurusan)}</td>
        <td><span class="badge ${bc}" title="${scoreTip!==null?'Total: '+scoreTip+' poin':'Belum dinilai'}">${bl}</span></td>
        <td>
          <div class="act-g">
            <button class="btn-sm" onclick="lihat(${s.id})">Lihat</button>
            <button class="btn-sm" onclick="beriNilai(${s.id})">Beri Nilai</button>
            <div class="edit-dd-wrap">
              <button class="btn-sm" onclick="toggleEditDd(event,${s.id})" aria-haspopup="true">Edit ▾</button>
              <div class="edit-dd-menu" id="edd-${s.id}" role="menu">
                <div class="edit-dd-item" onclick="setStatus(${s.id},'selesai')"><span class="ds" style="background:#1a9050"></span>Selesai</div>
                <div class="edit-dd-item" onclick="setStatus(${s.id},'proses')"><span class="ds" style="background:#c88020"></span>Proses</div>
                <div class="edit-dd-item" onclick="setStatus(${s.id},'revisi')"><span class="ds" style="background:#8a7030"></span>Revisi</div>
                <div class="edit-dd-item" onclick="setStatus(${s.id},'belum')"><span class="ds" style="background:#c03020"></span>Belum</div>
              </div>
            </div>
          </div>
        </td>
      </tr>`;
    }).join('');
  }

  // Pagination numbers
  const pgNums=document.getElementById('pgNums');
  const maxVisible=5;
  let pnHTML='';
  let startP=Math.max(1,S.curPage-Math.floor(maxVisible/2));
  let endP=Math.min(totalPages,startP+maxVisible-1);
  if(endP-startP<maxVisible-1) startP=Math.max(1,endP-maxVisible+1);
  for(let p=startP;p<=endP;p++){
    pnHTML+=`<button class="pg-btn${p===S.curPage?' cur':''}" onclick="goPage(${p})" aria-current="${p===S.curPage?'page':'false'}">${p}</button>`;
  }
  pgNums.innerHTML=pnHTML;
  document.getElementById('pgInfo').textContent=`Menampilkan ${total===0?0:start+1}–${Math.min(start+PAGE_SIZE,total)} dari ${total} mahasiswa`;
}

function goPage(dir){
  const rows=getFiltered();
  const totalPages=Math.max(1,Math.ceil(rows.length/PAGE_SIZE));
  if(dir==='first')      S.curPage=1;
  else if(dir==='prev')  S.curPage=Math.max(1,S.curPage-1);
  else if(dir==='next')  S.curPage=Math.min(totalPages,S.curPage+1);
  else if(dir==='last')  S.curPage=totalPages;
  else                   S.curPage=Math.min(totalPages,Math.max(1,dir));
  render();
  document.querySelector('.table-card')?.scrollIntoView({behavior:'smooth',block:'nearest'});
}

/* ══════════════════════════════════════════════════════
   PILLS / SEARCH
   ══════════════════════════════════════════════════════ */
function setPill(k){
  S.pill=k; S.curPage=1;
  ['all','selesai','belum'].forEach(p=>{
    const el=document.getElementById('pill-'+p);
    if(el){el.classList.toggle('active',p===k);el.setAttribute('aria-pressed',p===k?'true':'false');}
  });
  document.getElementById('filterSel').value='';
  render();
}

/* ══════════════════════════════════════════════════════
   LIHAT / EDIT
   ══════════════════════════════════════════════════════ */
function lihat(id){
  const s=S.students.find(x=>x.id===id);
  if(!s)return;
  const a=S.assessments[id];
  let totalAll=0;
  if(a) Object.values(a).forEach(sec=>totalAll+=Object.values(sec).reduce((x,y)=>x+y,0));
  const [,bl]=BADGE_MAP[s.status]||BADGE_MAP.belum;
  showToast(`${s.nama} · ${s.nim} · Status: ${bl} · Total Poin: ${a?totalAll:'–'}`,'');
}
function toggleEditDd(e,id){
  e.stopPropagation();
  const m=document.getElementById('edd-'+id);
  const wasOpen=m.classList.contains('open');
  closeAllDropdowns();
  if(!wasOpen){
    m.classList.add('open');
    // Position as fixed so the menu escapes the table's overflow clipping.
    const btn=e.currentTarget||e.target.closest('button');
    const r=btn.getBoundingClientRect();
    m.style.position='fixed';
    m.style.top=(r.bottom+4)+'px';
    m.style.left='auto';
    m.style.right=(window.innerWidth-r.right)+'px';
  }
}
function setStatus(id,status){
  const idx=S.students.findIndex(s=>s.id===id);
  if(idx===-1)return;
  S.students[idx].status=status;
  const [,bl]=BADGE_MAP[status]||BADGE_MAP.belum;
  showToast(`Status ${S.students[idx].nama} → ${bl}`,'ok');
  closeAllDropdowns();render();
}

/* ══════════════════════════════════════════════════════
   BERI NILAI — open penilaian page
   ══════════════════════════════════════════════════════ */
function beriNilai(id){
  const s=S.students.find(x=>x.id===id);
  if(!s)return;
  S.activeStu=s;
  S.activeSection='forum';
  document.getElementById('penName').textContent='PENILAIAN MAHASISWA: '+s.nama.toUpperCase();
  document.getElementById('penNIM').textContent='NIM '+s.nim;
  renderSection('forum');
  setSbActive('forum');
  if(!S.sidebarOpen){S.sidebarOpen=true;document.getElementById('penSidebar').classList.remove('collapsed');}
  goTo('page-penilaian');
  showToast('Membuka penilaian: '+s.nama,'');
}

/* ══════════════════════════════════════════════════════
   SECTION SWITCHING — only table + guide refreshes
   ══════════════════════════════════════════════════════ */
function switchSection(key){
  // Save current scores before switching
  saveCurrentScores();
  S.activeSection=key;
  renderSection(key);
  setSbActive(key);
}

function setSbActive(key){
  document.querySelectorAll('.sb-card').forEach(c=>c.classList.remove('active'));
  document.getElementById('sb-'+key)?.classList.add('active');
}

function renderSection(key){
  const cfg=SECTIONS[key];
  if(!cfg)return;
  document.getElementById('sectionLabel').textContent=cfg.label;

  // Build assessment table rows
  const stu=S.activeStu;
  const storedScores=(stu&&S.assessments[stu.id]&&S.assessments[stu.id][key])||{};
  const tbody=document.getElementById('assessBody');
  tbody.innerHTML=cfg.aspects.map((a,i)=>{
    const val=storedScores[i]!==undefined?storedScores[i]:'';
    return `<tr>
      <td class="num">${i+1}</td>
      <td class="asp">${esc(a.name)}</td>
      <td class="max-hint">${a.max}</td>
      <td class="inp">
        <input class="score-inp" type="number"
          data-idx="${i}" data-max="${a.max}"
          value="${val}" placeholder="0-${a.max}"
          min="0" max="${a.max}"
          oninput="validateScore(this)" onchange="calcTotal()"
          aria-label="Poin ${esc(a.name)} (0-${a.max})"/>
      </td>
    </tr>`;
  }).join('');

  // Build guide
  const guideBody=document.getElementById('guideBody');
  guideBody.innerHTML=cfg.aspects.map(a=>`<p><strong>${esc(a.name)}:</strong> ${esc(a.guide)}</p>`).join('')
    +`<p style="margin-top:9px"><em>Catatan: Total poin maksimum adalah ${cfg.noteMax} poin.</em></p>`;

  // Update max display
  document.getElementById('totalMax').textContent='/ '+cfg.noteMax;
  calcTotal();
}

/* ══════════════════════════════════════════════════════
   SCORE VALIDATION — enforces max per aspect
   ══════════════════════════════════════════════════════ */
function validateScore(el){
  const max=parseInt(el.dataset.max)||100;
  if(el.value===''){el.classList.remove('invalid');return;}
  let v=parseFloat(el.value);
  if(isNaN(v)){el.classList.add('invalid');return;}
  if(v<0){v=0;el.value=0;}
  if(v>max){
    el.classList.add('invalid');
    showToast(`Nilai tidak boleh melebihi ${max} poin!`,'err',2000);
    // Auto-clamp after short delay for UX
    setTimeout(()=>{el.value=max;el.classList.remove('invalid');calcTotal();},800);
    return;
  }
  el.classList.remove('invalid');
  el.value=Math.round(v);
  calcTotal();
}

function calcTotal(){
  const inputs=document.querySelectorAll('#assessBody .score-inp');
  let total=0;
  inputs.forEach(inp=>{
    const v=parseFloat(inp.value);
    if(!isNaN(v)&&v>=0) total+=v;
  });
  document.getElementById('totalVal').textContent=Math.round(total);
}

function saveCurrentScores(){
  const stu=S.activeStu;
  if(!stu)return;
  const key=S.activeSection;
  const inputs=document.querySelectorAll('#assessBody .score-inp');
  if(!inputs.length)return;
  if(!S.assessments[stu.id]) S.assessments[stu.id]={};
  const secScores={};
  inputs.forEach(inp=>{const idx=parseInt(inp.dataset.idx);const v=parseFloat(inp.value);if(!isNaN(v))secScores[idx]=Math.round(v);});
  S.assessments[stu.id][key]=secScores;
}

/* ══════════════════════════════════════════════════════
   SIMPAN
   ══════════════════════════════════════════════════════ */
function simpan(){
  const stu=S.activeStu;
  if(!stu){showToast('Tidak ada mahasiswa dipilih.','err');return;}

  // Validate current section inputs first
  let hasInvalid=false;
  document.querySelectorAll('#assessBody .score-inp').forEach(inp=>{
    const max=parseInt(inp.dataset.max)||100;
    const v=parseFloat(inp.value);
    if(inp.value!==''&&(isNaN(v)||v<0||v>max)){inp.classList.add('invalid');hasInvalid=true;}
  });
  if(hasInvalid){showToast('Ada nilai yang tidak valid. Perbaiki sebelum menyimpan.','err');return;}

  // Save current section
  saveCurrentScores();

  // Current section scores + total
  const key=S.activeSection;
  const secScores=(S.assessments[stu.id]||{})[key]||{};
  if(!Object.keys(secScores).length){
    showToast('Belum ada nilai untuk bagian ini.','err');
    return;
  }
  const secTotal=Object.values(secScores).reduce((x,y)=>x+(parseFloat(y)||0),0);

  // Status from number of completed sections
  const done=Object.keys(S.assessments[stu.id]||{}).filter(k=>Object.keys((S.assessments[stu.id]||{})[k]||{}).length).length;
  const idx=S.students.findIndex(s=>s.id===stu.id);
  if(idx!==-1){
    S.students[idx].status=done>=4?'selesai':done>=1?'proses':'belum';
  }

  // Persist to Supabase via the mentor controller
  fetch(window.__SAVE_URL__,{
    method:'POST',
    headers:{'Content-Type':'application/json','X-CSRF-TOKEN':window.__CSRF__,'Accept':'application/json'},
    credentials:'same-origin',
    body:JSON.stringify({nim:stu.nim,section:key,scores:secScores,total:Math.round(secTotal)})
  }).then(r=>r.json().catch(()=>({}))).then(res=>{
    if(res&&res.ok){
      const lbl=SECTIONS[key]?SECTIONS[key].label:key;
      showToast(`✓ Penilaian ${stu.nama} — ${lbl} tersimpan (${Math.round(secTotal)} poin).`,'ok',4000);
      setTimeout(()=>{render();goTo('page-dashboard');},1000);
    }else{
      showToast((res&&res.error)?res.error:'Gagal menyimpan ke server.','err',6000);
      render();
    }
  }).catch(()=>{showToast('Gagal terhubung ke server.','err',6000);render();});
}

/* ══════════════════════════════════════════════════════
   RIWAYAT
   ══════════════════════════════════════════════════════ */
function riwayat(){
  const stu=S.activeStu;
  if(!stu){showToast('Pilih mahasiswa terlebih dahulu.','err');return;}
  const a=S.assessments[stu.id];
  if(!a||!Object.keys(a).length){showToast('Belum ada riwayat penilaian untuk '+stu.nama+'.','');return;}
  let lines=[];
  Object.entries(a).forEach(([secKey,scores])=>{
    const cfg=SECTIONS[secKey];
    if(!cfg)return;
    const tot=Object.values(scores).reduce((x,y)=>x+y,0);
    lines.push(`${cfg.label}: ${tot}/${cfg.noteMax}`);
  });
  const grand=lines.length?Object.values(a).reduce((tot,sec)=>tot+Object.values(sec).reduce((x,y)=>x+y,0),0):0;
  showToast(`Riwayat ${stu.nama} → ${lines.join(' | ')} | Total: ${grand}`,'ok',6000);
}

/* ══════════════════════════════════════════════════════
   EXPORT CSV
   ══════════════════════════════════════════════════════ */
function exportCSV(){
  const hdr=['No','Nama','NIM','Prodi/Offering','Status','Total Poin'];
  const rows=S.students.map((s,i)=>{
    const a=S.assessments[s.id];
    const t=a?Object.values(a).reduce((tot,sec)=>tot+Object.values(sec).reduce((x,y)=>x+y,0),0):'–';
    return [i+1,s.nama,s.nim,s.jurusan,BADGE_MAP[s.status]?.[1]||s.status,t].join(',');
  });
  const csv=[hdr.join(','),...rows].join('\n');
  const blob=new Blob([csv],{type:'text/csv;charset=utf-8;'});
  const url=URL.createObjectURL(blob);
  const a=Object.assign(document.createElement('a'),{href:url,download:'positron2026_maba.csv'});
  document.body.appendChild(a);a.click();document.body.removeChild(a);URL.revokeObjectURL(url);
  showToast('Data diekspor ke positron2026_maba.csv','ok');
}

/* ══════════════════════════════════════════════════════
   TOAST
   ══════════════════════════════════════════════════════ */
function showToast(msg,type,ms=3500){
  const box=document.getElementById('toastBox');
  const el=document.createElement('div');
  el.className='toast'+(type?' '+type:'');el.textContent=msg;
  box.appendChild(el);
  setTimeout(()=>{el.classList.add('out');setTimeout(()=>el.remove(),320);},ms);
}

function esc(s){return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');}

/* ══════════════════════════════════════════════════════
   INIT
   ══════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded',()=>{
  const M=window.__MENTOR__||{};
  S.auth=true;
  if(M.user){S.user=M.user;const pu=document.getElementById('profUser');if(pu)pu.textContent=M.user;}
  render();
  goTo('page-dashboard');
});

/* ──────────────────────────────────────────────────────
   Expose actions used by inline on* attributes in the Blade
   partials. Bundled modules are scoped, so attach explicitly.
   ────────────────────────────────────────────────────── */
Object.assign(window, {
  goTo, toggleSidebar, toggleProfile, openProfileModal, closeModal, doLogout,
  setPill, render, exportCSV, goPage, lihat, beriNilai, toggleEditDd, setStatus,
  switchSection, calcTotal, validateScore, simpan, riwayat, showToast,
});