/* ══════════════════════════════════════════════════════
   STATE — shared mutable state for the mentor portal SPA
   ══════════════════════════════════════════════════════ */
export const S = {
  auth:false, user:'mentor',
  pill:'all', curPage:1,
  activeStu:null, activeSection:'forum', sidebarOpen:true,
  assessments:(window.__ASSESS__ && typeof window.__ASSESS__==='object') ? window.__ASSESS__ : {},  // { stuId: { sectionKey: { aspectIdx: value } } }
  students: Array.isArray(window.__STUDENTS__) ? window.__STUDENTS__ : [],
};
