'use strict';
/* ══════════════════════════════════════════════════════
   ASSESSMENT — beri nilai, section switching, scoring, save, riwayat
   ══════════════════════════════════════════════════════ */
import { S } from './state.js';
import { SECTIONS } from './config.js';
import { esc, showToast } from './utils.js';
import { goTo } from './nav.js';
import { render } from './dashboard.js';

const ASPECT_TO_SECTION = {};
Object.entries(SECTIONS).forEach(([section, cfg]) => {
  cfg.aspects.forEach((aspect, index) => {
    ASPECT_TO_SECTION[aspect.key || `${section}_${index}`] = section;
  });
});
const aspectKey = (section, aspect, index) => aspect.key || `${section}_${index}`;

function sectionTotals(assessments) {
  const totals = {};
  const detailedSections = new Set();
  Object.entries(assessments || {}).forEach(([activity, value]) => {
    const section = SECTIONS[activity] ? activity : ASPECT_TO_SECTION[activity];
    if (!section) return;
    if (activity !== section) detailedSections.add(section);
    const points = value && typeof value === 'object'
      ? Object.values(value).reduce((sum, score) => sum + (Number(score) || 0), 0)
      : Number(value) || 0;
    totals[section] = (totals[section] || 0) + points;
  });
  // Avoid counting both a legacy section total and its detailed aspect rows.
  detailedSections.forEach(section => {
    if (Object.hasOwn(assessments || {}, section)) totals[section] -= Number(assessments[section]) || 0;
  });
  return totals;
}

export function beriNilai(id) {
  const student = S.students.find(item => String(item.id) === String(id));
  if (!student) {
    showToast('Data mahasiswa tidak ditemukan.', 'err');
    return;
  }
  S.activeStu = student;
  S.activeSection = Object.keys(SECTIONS)[0];
  document.getElementById('penName').textContent = 'PENILAIAN MAHASISWA: ' + student.nama.toUpperCase();
  document.getElementById('penNIM').textContent = 'NIM ' + student.nim;
  goTo('page-penilaian');
  requestAnimationFrame(() => {
    renderSection(S.activeSection);
    setSbActive(S.activeSection);
  });
  showToast('Membuka penilaian: ' + student.nama, '');
}

export function switchSection(key) {
  saveCurrentScores();
  S.activeSection = key;
  renderSection(key);
  setSbActive(key);
}

export function setSbActive(key) {
  document.querySelectorAll('.sb-card').forEach(card => card.classList.remove('active'));
  document.getElementById('sb-' + key)?.classList.add('active');
}

export function renderSection(key) {
  const cfg = SECTIONS[key];
  if (!cfg) {
    console.error('Section tidak ditemukan:', key);
    return;
  }
  S.draft ??= {};
  S.assessments ??= {};
  document.getElementById('sectionLabel').textContent = cfg.label;

  const student = S.activeStu;
  const draftScores = student?.id ? (S.draft[student.id]?.[key] || {}) : {};
  const saved = student?.id ? (S.assessments[student.id] || {}) : {};
  const legacyTotal = typeof saved[key] === 'number' ? saved[key] : null;
  const hasSavedAspects = cfg.aspects.some((aspect, index) => saved[aspectKey(key, aspect, index)] !== undefined);

  document.getElementById('assessBody').innerHTML = cfg.aspects.map((aspect, index) => {
    const value = draftScores[index] ?? saved[aspectKey(key, aspect, index)] ?? '';
    return `<tr>
      <td class="num">${index + 1}</td>
      <td class="asp">${esc(aspect.name)}</td>
      <td class="max-hint">${aspect.max}</td>
      <td class="inp">
        <input class="score-inp" type="number" data-idx="${index}"
          data-key="${aspectKey(key, aspect, index)}" data-max="${aspect.max}"
          value="${value}" placeholder="0-${aspect.max}" min="0" max="${aspect.max}"
          oninput="validateScore(this)" onchange="calcTotal()">
      </td>
    </tr>`;
  }).join('');

  const legacyNotice = legacyTotal !== null && !hasSavedAspects
    ? `<p><strong>Total lama yang tersimpan: ${legacyTotal}/${cfg.noteMax}.</strong> Data lama hanya menyimpan total, bukan rincian aspek. Total ini tidak dapat dibagi otomatis; masukkan rincian aspek yang benar untuk memperbaruinya.</p>`
    : '';
  document.getElementById('guideBody').innerHTML = cfg.aspects
    .map(aspect => `<p><strong>${esc(aspect.name)}:</strong> ${esc(aspect.guide)}</p>`)
    .join('')
    + `<p style="margin-top:9px"><em>Catatan: Total poin maksimum adalah ${cfg.noteMax} poin.</em></p>`
    + legacyNotice;

  document.getElementById('totalMax').textContent = '/ ' + cfg.noteMax;
  calcTotal();
  // Preserve visibility of the old total without inventing per-aspect values.
  if (legacyTotal !== null && !hasSavedAspects && !Object.keys(draftScores).length) {
    document.getElementById('totalVal').textContent = legacyTotal;
  }
}

export function validateScore(element) {
  const max = parseInt(element.dataset.max) || 100;
  if (element.value === '') {
    element.classList.remove('invalid');
    return;
  }
  let value = parseFloat(element.value);
  if (Number.isNaN(value)) {
    element.classList.add('invalid');
    return;
  }
  if (value < 0) {
    value = 0;
    element.value = 0;
  }
  if (value > max) {
    element.classList.add('invalid');
    showToast(`Nilai tidak boleh melebihi ${max} poin!`, 'err', 2000);
    setTimeout(() => {
      element.value = max;
      element.classList.remove('invalid');
      calcTotal();
    }, 800);
    return;
  }
  element.classList.remove('invalid');
  element.value = Math.round(value);
  calcTotal();
}

export function calcTotal() {
  let total = 0;
  document.querySelectorAll('#assessBody .score-inp').forEach(input => {
    const value = parseFloat(input.value);
    if (!Number.isNaN(value) && value >= 0) total += value;
  });
  document.getElementById('totalVal').textContent = Math.round(total);
}

export function saveCurrentScores() {
  const student = S.activeStu;
  if (!student) return;
  S.draft ??= {};
  const inputs = document.querySelectorAll('#assessBody .score-inp');
  if (!inputs.length) return;
  S.draft[student.id] ??= {};
  const scores = {};
  inputs.forEach(input => {
    const index = Number(input.dataset.idx);
    const value = Number(input.value);
    if (input.value !== '' && !Number.isNaN(value)) scores[index] = Math.round(value);
  });
  S.draft[student.id][S.activeSection] = scores;
}

export function simpan() {
  const student = S.activeStu;
  if (!student) {
    showToast('Tidak ada mahasiswa dipilih.', 'err');
    return;
  }
  let invalid = false;
  document.querySelectorAll('#assessBody .score-inp').forEach(input => {
    const max = parseInt(input.dataset.max) || 100;
    const value = parseFloat(input.value);
    if (input.value !== '' && (Number.isNaN(value) || value < 0 || value > max)) {
      input.classList.add('invalid');
      invalid = true;
    }
  });
  if (invalid) {
    showToast('Ada nilai yang tidak valid. Perbaiki sebelum menyimpan.', 'err');
    return;
  }

  saveCurrentScores();
  const section = S.activeSection;
  const cfg = SECTIONS[section];
  const scores = S.draft[student.id]?.[section] || {};
  if (cfg.aspects.some((aspect, index) => scores[index] === undefined)) {
    showToast('Isi nilai untuk semua aspek sebelum menyimpan bagian ini.', 'err', 5000);
    return;
  }

  const total = Object.values(scores).reduce((sum, value) => sum + (parseFloat(value) || 0), 0);
  const payload = {
    mahasiswa_id: student.id,
    section,
    scores: Object.fromEntries(cfg.aspects.map((aspect, index) => [aspectKey(section, aspect, index), Math.round(scores[index])])),
  };

  fetch(window.__SAVE_URL__, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': window.__CSRF__,
      'Accept': 'application/json',
    },
    credentials: 'same-origin',
    body: JSON.stringify(payload),
  }).then(async response => {
    const result = await response.json().catch(() => ({}));
    if (!response.ok || !result.ok) throw new Error(result.error || 'Gagal menyimpan nilai.');

    S.assessments[student.id] ??= {};
    delete S.assessments[student.id][section];
    Object.assign(S.assessments[student.id], payload.scores);
    const done = Object.keys(sectionTotals(S.assessments[student.id])).length;
    const studentIndex = S.students.findIndex(item => String(item.id) === String(student.id));
    if (studentIndex !== -1) {
      S.students[studentIndex].status = done >= Object.keys(SECTIONS).length ? 'selesai' : done >= 1 ? 'proses' : 'belum';
    }
    showToast(`✓ Penilaian ${student.nama} — ${cfg.label} tersimpan (${Math.round(total)} poin).`, 'ok', 4000);
    setTimeout(() => { render(); goTo('page-dashboard'); }, 1000);
  }).catch(error => showToast(error.message || 'Gagal terhubung ke server.', 'err', 6000));
}

export function riwayat() {
  const student = S.activeStu;
  if (!student) {
    showToast('Pilih mahasiswa terlebih dahulu.', 'err');
    return;
  }
  const assessments = S.assessments[student.id];
  if (!assessments || !Object.keys(assessments).length) {
    showToast('Belum ada riwayat penilaian untuk ' + student.nama + '.', '');
    return;
  }
  const totals = sectionTotals(assessments);
  const lines = Object.entries(totals).map(([section, total]) => {
    const cfg = SECTIONS[section];
    return cfg ? `${cfg.label}: ${total}/${cfg.noteMax}` : null;
  }).filter(Boolean);
  const grandTotal = Object.values(totals).reduce((sum, value) => sum + value, 0);
  showToast(`Riwayat ${student.nama} → ${lines.join(' | ')} | Total: ${grandTotal}`, 'ok', 6000);
}
