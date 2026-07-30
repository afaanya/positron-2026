/* ══════════════════════════════════════════════════════
   ASSESSMENT — beri nilai, section switching, scoring, save, riwayat
   ══════════════════════════════════════════════════════ */
import { S } from './state.js';
import { SECTIONS } from './config.js';
import { esc, showToast } from './utils.js';
import { goTo } from './nav.js';
import { render } from './dashboard.js';

export function beriNilai(id){
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

export function switchSection(key){
  // Save current scores before switching
  saveCurrentScores();
  S.activeSection=key;
  renderSection(key);
  setSbActive(key);
}

export function setSbActive(key){
  document.querySelectorAll('.sb-card').forEach(c=>c.classList.remove('active'));
  document.getElementById('sb-'+key)?.classList.add('active');
}

export function renderSection(key){
  const cfg=SECTIONS[key];
  if(!cfg)return;
  document.getElementById('sectionLabel').textContent=cfg.label;

  // Build assessment table rows
  const stu=S.activeStu;
  const storedScores=(stu&&S.assessments[stu.id]&&S.assessments[stu.id][key])||{};
  const isMultiKey = cfg.aspects.every(a => a.key);
  const tbody=document.getElementById('assessBody');
  tbody.innerHTML=cfg.aspects.map((a,i)=>{
    let val = storedScores[i];
    if(val===undefined && isMultiKey && a.key!==undefined){
      val = storedScores[a.key];
    }
    val = val!==undefined ? val : '';
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

export function validateScore(el){
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

export function calcTotal(){
  const inputs=document.querySelectorAll('#assessBody .score-inp');
  let total=0;
  inputs.forEach(inp=>{
    const v=parseFloat(inp.value);
    if(!isNaN(v)&&v>=0) total+=v;
  });
  document.getElementById('totalVal').textContent=Math.round(total);
}

export function saveCurrentScores(){
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

export function simpan(){
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
  const cfg=SECTIONS[key];
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

  // Section dengan aspek yang punya key unik -> simpan tiap aspek terpisah.
  // Section lain -> tetap simpan sebagai 1 total gabungan (behavior lama).
  const isMultiKey = cfg.aspects.every(a => a.key);

  const savePayloads = isMultiKey
    ? cfg.aspects
        .map((a,i) => ({ aspectKey: a.key, val: secScores[i] }))
        .filter(x => x.val !== undefined)
        .map(x => ({ mahasiswa_id: stu.id, kegiatan: x.aspectKey, poin: Math.round(x.val) }))
    : [{ mahasiswa_id: stu.id, kegiatan: key, poin: Math.round(secTotal) }];

  Promise.all(savePayloads.map(payload =>
    fetch(window.__SAVE_URL__,{
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':window.__CSRF__,'Accept':'application/json'},
      credentials:'same-origin',
      body:JSON.stringify(payload)
    }).then(r=>r.json().catch(()=>({})))
  )).then(results=>{
    const allOk = results.length>0 && results.every(res => res && res.ok);
    if(allOk){
      const lbl=cfg?cfg.label:key;
      showToast(`✓ Penilaian ${stu.nama} — ${lbl} tersimpan (${Math.round(secTotal)} poin).`,'ok',4000);
      setTimeout(()=>{render();goTo('page-dashboard');},1000);
    }else{
      showToast('Gagal menyimpan sebagian atau seluruh data ke server.','err',6000);
      render();
    }
  }).catch(()=>{showToast('Gagal terhubung ke server.','err',6000);render();});
}

export function riwayat(){
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