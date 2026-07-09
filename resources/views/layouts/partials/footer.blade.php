{{-- ============================================================
     GLOBAL FOOTER — green satin background + POSITRON credits.
     ============================================================ --}}
<footer class="gfooter" aria-label="Footer">
  <div class="gfooter-inner">
    <p class="gf-copy">&copy; POSITRON 2026</p>
    <p class="gf-org">Himpunan Mahasiswa Departemen Teknik Elektro dan Informatika<br>Universitas Negeri Malang</p>
  </div>
</footer>

<style>
  .gfooter{
    position:relative;z-index:10;text-align:center;padding:13px 24px 11px;
    background:#06120b url('{{ asset('images/footer-bg.jpg') }}') center/cover no-repeat;
    border-top:1px solid rgba(140,100,15,.25);
    font-family:'Playfair Display',serif;overflow:hidden;
  }
  .gfooter::before{content:'';position:absolute;inset:0;background:linear-gradient(rgba(4,14,8,.62),rgba(4,14,8,.78));z-index:0}
  .gfooter-inner{position:relative;z-index:1}
  .gf-copy{color:#e7c766;font-size:.78rem;font-weight:700;letter-spacing:.09em;margin:0 0 3px}
  .gf-org{color:#cbb06a;font-size:.68rem;font-weight:600;line-height:1.55;letter-spacing:.04em;margin:0}
</style>
