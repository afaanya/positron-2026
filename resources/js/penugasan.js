// penugasan.js
// Halaman Penugasan POSITRON 2026
// Catatan: kode HTML/Blade asli tidak memiliki logika JavaScript apa pun.
// Semua interaksi (hover, dsb.) ditangani murni lewat CSS (:hover) di penugasan.css.
// File ini disediakan sebagai tempat untuk menambahkan interaksi tambahan di masa depan,
// misalnya animasi saat buku diklik, lazy-load gambar, atau tracking klik.

document.addEventListener('DOMContentLoaded', function () {
  // Contoh: log setiap klik buku (opsional, aman dihapus jika tidak diperlukan)
  const bookItems = document.querySelectorAll('.book-item');

  bookItems.forEach(function (item) {
    item.addEventListener('click', function () {
      console.log('Buku diklik:', item.id);
    });
  });
});