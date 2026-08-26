/* ══════════════════════════════════════════════════════
   SECTION CONFIG — aspects per section
   ══════════════════════════════════════════════════════ */
export const SECTIONS = {
  forum: {
    label: 'FORUM MABA',
    aspects: [
      { name:'Presensi Day 1', max:60, guide:'Maksimum 60 poin (panduan).' },
      { name:'Presensi Day 2',max:60, guide:'Maksimum 60 poin (panduan).' },
      { name:'Instagram Add Yours', max:20, guide:'Maksimum 40 poin (panduan).' },
      { name:'Penugasan video Recap Day 1', max:20, guide:'Maksimum 30 poin (panduan).' },
      { name:'Penugasan Video Recap Day 2', max:20, guide:'Maksimum 30 poin (panduan).' },
    ],
    noteMax: 200,
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
      { name:'Formal', max:10, guide:'Maksimum 40 poin (panduan).' },
      { name:'Non Formal', max:30, guide:'Maksimum 40 poin (panduan).' },
      { name:'Penampilan', max:25, guide:'Maksimum 20 poin (panduan).' },
    ],
    noteMax: 100,
  },
  arus: {
    label: 'ARUS',
    aspects: [
      { name:'Arus 1', max:50, guide:'Maksimum 50 poin (panduan).' },
      { name:'Arus 2', max:50, guide:'Maksimum 50 poin (panduan).' },
      { name:'Arus 3', max:50, guide:'Maksimum 50 poin (panduan).' },
    ],
    noteMax: 150,
  },
  buku: {
      label: 'BUKU ANGKATAN',
      aspects: [
        { key:'journeytodtei', name:'Journey to DTEI', max:15, guide:'Maksimum 15 poin (panduan).' },
        { key:'cv', name:'CV', max:10, guide:'Maksimum 10 poin (panduan).' },
        { key:'mindmap', name:'Mind Map', max:10, guide:'Maksimum 10 poin (panduan).' },
        { key:'struktur', name:'Struktur Organisasi', max:5, guide:'Maksimum 5 poin (panduan).' },
        { key:'dosen', name:'Dosen DTEI', max:20, guide:'Maksimum 20 poin (panduan).' },
        { key:'denah', name:'Denah', max:5, guide:'Maksimum 5 poin (panduan).' },
        { key:'ttdoff', name:'TTD Offering', max:10, guide:'Maksimum 10 poin (panduan).'},
        { key:'ttdkel', name:'TTD Kelompok', max:10, guide:'Maksimum 10 poin (panduan).'},
        { key:'ttdhmd', name:'TTD Pengurus HMD', max:15, guide:'Maksimum 15 poin (panduan).'},
      ],
      noteMax:100,
  },
  partisipasi: {
      label: 'PARTISIPASI',
      aspects: [
        { key:'dewan', name:'Dewan Komunal', max:35, guide:'Maksimum 35 poin.' },
        { key:'seven', name:'Seven Segment', max:50, guide:'Maksimum 50 poin.' },
        { key:'coffe', name:'Coffe Offering', max:15, guide:'Maksimum 15 poin.' },
        { key:'tetp', name:'Techno Extro Time', max:35, guide:'25 poin jika hanya berpartisipasi, 35 poin jika menang.' },
        { key:'staffmuda', name:'Staff Muda', max:25, guide:'Maksimum 25 poin.' },
        { key:'arak', name:'Arak-Arakan', max:20, guide:'Maksimum 20 poin.' },
        { key:'ecup', name:'Elektro Cup', max:15, guide:'Maksimum 15 poin.' },
        { key:'adminigangkatan', name:'Admin IG Angkatan', max:50, guide:'Maksimum 50 poin.' },
        { key:'adminigoffering', name:'Admin IG Offering', max:30, guide:'Maksimum 30 poin.' },
      ],
      noteMax:275,
  },
};

export const BADGE_MAP = {
  selesai:['b-s','Selesai'],proses:['b-p','Proses'],revisi:['b-r','Revisi'],belum:['b-b','Belum'],
};
export const PAGE_SIZE = 8;

export const BATAS_LULUS = 575;
export const MAX_NILAI = Object.values(SECTIONS).reduce((t, sec) => t + sec.noteMax, 0); // = 815

export const KELULUSAN_BADGE = {
  lulus: ['b-lulus', 'Lulus'],
  gagal: ['b-gagal', 'Tidak Lulus'],
  none:  ['b-none', '-'],
};