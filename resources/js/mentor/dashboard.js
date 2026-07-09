/* ══════════════════════════════════════════════════════
   DASHBOARD — table render, filtering, pagination, status edit, CSV export
   ══════════════════════════════════════════════════════ */
import { S } from './state.js';
import { BADGE_MAP, PAGE_SIZE } from './config.js';
import { esc, showToast } from './utils.js';
import { closeAllDropdowns } from './nav.js';

export function getFiltered(){
  const q=(document.getElementById('searchQ')?.value||'').toLowerCase().trim();
  const sf=document.getElementById('filterSel')?.value||'';
  return S.students.filter(s=>{
    const qOk=!q||s.nama.toLowerCase().includes(q)||s.nim.includes(q);
    const sfOk=!sf||s.status===sf;
    const pfOk=S.pill==='all'||s.status===S.pill;
    return qOk&&sfOk&&pfOk;
  });
}

export function render(){
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

export function goPage(dir){
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

export function setPill(k){
  S.pill=k; S.curPage=1;
  ['all','selesai','belum'].forEach(p=>{
    const el=document.getElementById('pill-'+p);
    if(el){el.classList.toggle('active',p===k);el.setAttribute('aria-pressed',p===k?'true':'false');}
  });
  document.getElementById('filterSel').value='';
  render();
}

export function lihat(id){
  const s=S.students.find(x=>x.id===id);
  if(!s)return;
  const a=S.assessments[id];
  let totalAll=0;
  if(a) Object.values(a).forEach(sec=>totalAll+=Object.values(sec).reduce((x,y)=>x+y,0));
  const [,bl]=BADGE_MAP[s.status]||BADGE_MAP.belum;
  showToast(`${s.nama} · ${s.nim} · Status: ${bl} · Total Poin: ${a?totalAll:'–'}`,'');
}

export function toggleEditDd(e,id){
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

export function setStatus(id,status){
  const idx=S.students.findIndex(s=>s.id===id);
  if(idx===-1)return;
  S.students[idx].status=status;
  const [,bl]=BADGE_MAP[status]||BADGE_MAP.belum;
  showToast(`Status ${S.students[idx].nama} → ${bl}`,'ok');
  closeAllDropdowns();render();
}

export function exportCSV(){
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
