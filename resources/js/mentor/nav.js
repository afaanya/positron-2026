/* ══════════════════════════════════════════════════════
   ROUTING, AUTH, PROFILE DROPDOWN, SIDEBAR TOGGLE
   ══════════════════════════════════════════════════════ */
import { S } from './state.js';
import { showToast } from './utils.js';

export function goTo(id){
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  // Show sidebar toggle button only on penilaian page
  document.body.classList.toggle('show-sb-toggle', id==='page-penilaian');
  window.scrollTo({top:0,behavior:'smooth'});
  closeAllDropdowns();
}

export function doLogout(){
  closeAllDropdowns();
  const f=document.getElementById('realLogoutForm');
  if(f){showToast('Keluar...','');f.submit();return;}
  window.location.href = '/login';
}

export function toggleProfile(){
  const dd=document.getElementById('profileDrop');
  const btn=document.getElementById('userBtn');
  const open=dd.classList.contains('open');
  closeAllDropdowns();
  if(!open){dd.classList.add('open');btn.setAttribute('aria-expanded','true');}
}

export function closeAllDropdowns(){
  document.querySelectorAll('.profile-dropdown,.edit-dd-menu').forEach(d=>d.classList.remove('open'));
  document.getElementById('userBtn')?.setAttribute('aria-expanded','false');
}

document.addEventListener('click',e=>{
  if(!e.target.closest('.nav-user-wrap')&&!e.target.closest('.edit-dd-wrap')) closeAllDropdowns();
});
// Close the fixed-position edit menu when the page scrolls so it doesn't detach.
window.addEventListener('scroll',()=>{ if(document.querySelector('.edit-dd-menu.open')) closeAllDropdowns(); },{passive:true,capture:true});

export function openProfileModal(){closeAllDropdowns();document.getElementById('profileModal').classList.add('open')}
export function closeModal(id){document.getElementById(id).classList.remove('open')}
document.querySelectorAll('.modal-bg').forEach(m=>m.addEventListener('click',e=>{if(e.target===m)m.classList.remove('open')}));

export function toggleSidebar(){
  S.sidebarOpen=!S.sidebarOpen;
  const sb=document.getElementById('penSidebar');
  sb.classList.toggle('collapsed',!S.sidebarOpen);
  const btn=document.getElementById('sbToggleBtn');
  btn.innerHTML=S.sidebarOpen
    ?`<svg viewBox="0 0 18 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="0" y1="1" x2="18" y2="1"/><line x1="0" y1="7" x2="18" y2="7"/><line x1="0" y1="13" x2="18" y2="13"/></svg> Sidebar`
    :`<svg viewBox="0 0 18 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="0" y1="1" x2="18" y2="1"/><line x1="0" y1="7" x2="12" y2="7"/><line x1="0" y1="13" x2="18" y2="13"/></svg> Sidebar`;
}

