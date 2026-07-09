/* ══════════════════════════════════════════════════════
   TOAST & HTML-ESCAPE HELPERS
   ══════════════════════════════════════════════════════ */
export function showToast(msg,type,ms=3500){
  const box=document.getElementById('toastBox');
  const el=document.createElement('div');
  el.className='toast'+(type?' '+type:'');el.textContent=msg;
  box.appendChild(el);
  setTimeout(()=>{el.classList.add('out');setTimeout(()=>el.remove(),320);},ms);
}

export function esc(s){return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');}
