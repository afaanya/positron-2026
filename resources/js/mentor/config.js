/* ══════════════════════════════════════════════════════
   SECTION CONFIG — aspects per section
   ══════════════════════════════════════════════════════ */
export const SECTIONS = {
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

export const BADGE_MAP = {
  selesai:['b-s','Selesai'],proses:['b-p','Proses'],revisi:['b-r','Revisi'],belum:['b-b','Belum'],
};
export const PAGE_SIZE = 8;
