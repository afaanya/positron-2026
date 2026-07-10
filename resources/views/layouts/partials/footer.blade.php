{{-- ============================================================
     GLOBAL FOOTER — green satin background + POSITRON credits.
     ============================================================ --}}
<footer class="gfooter" aria-label="Footer">
  <div class="gfooter-inner">
    <div class="gf-text">
      <p class="gf-copy">&copy; POSITRON 2026</p>
      <p class="gf-org">Himpunan Mahasiswa Departemen Teknik Elektro dan Informatika - Fakultas Teknik <br>Universitas Negeri Malang</p>
    </div>
    <div class="gf-social">
      <a class="gf-social-link" href="https://www.instagram.com/hmdteiftum" target="_blank" rel="noopener" aria-label="Instagram HMDTEI FTUM">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <rect x="3" y="3" width="18" height="18" rx="5"/>
          <circle cx="12" cy="12" r="4.2"/>
          <circle cx="17.3" cy="6.7" r="1.1" fill="currentColor" stroke="none"/>
        </svg>
      </a>
      <a class="gf-social-link" href="https://www.tiktok.com/@hmdteiftum" target="_blank" rel="noopener" aria-label="TikTok HMDTEI FTUM">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M16.6 3c.3 2.13 1.6 3.6 3.9 3.75v2.68c-1.34.13-2.52-.3-3.86-1.1v6.24c0 4.94-5.39 8.13-9.7 5.65-2.79-1.6-3.84-5.1-2.35-7.98 1.14-2.2 3.5-3.42 5.94-3.03v2.75c-.44-.13-.92-.15-1.4-.05-1.34.28-2.28 1.53-2.16 2.9.13 1.5 1.4 2.6 2.9 2.5 1.5-.1 2.6-1.37 2.6-2.87V3h4.13z"/>
        </svg>
      </a>
    </div>
  </div>
</footer>

<style>
  .gfooter{
    position:relative;z-index:10;padding:13px 24px 11px;
    background:#06120b url('{{ asset('images/footer-bg.jpg') }}') center/cover no-repeat;
    border-top:1px solid rgba(140,100,15,.25);
    font-family:'Libre Baskerville',serif;overflow:hidden;
  }
  .gfooter::before{content:'';position:absolute;inset:0;background:linear-gradient(rgba(4,14,8,.62),rgba(4,14,8,.78));z-index:0}
  .gfooter-inner{
    position:relative;z-index:1;display:flex;align-items:center;justify-content:space-between;
    gap:16px;max-width:1100px;margin:0 auto;
  }
  .gf-text{text-align:left}
  .gf-copy{color:#e7c766;font-size:.78rem;font-weight:700;letter-spacing:.09em;margin:0 0 3px}
  .gf-org{color:#cbb06a;font-size:.68rem;font-weight:400;line-height:1.55;letter-spacing:.04em;margin:0}
  .gf-social{display:flex;align-items:center;gap:10px;flex-shrink:0}
  .gf-social-link{
    width:30px;height:30px;border:1.3px solid rgba(199,163,80,.55);border-radius:50%;
    display:flex;align-items:center;justify-content:center;color:#e0c050;
    transition:background .2s,border-color .2s,color .2s;
  }
  .gf-social-link:hover{background:rgba(224,192,80,.14);border-color:#e0c050;color:#f2dd8c}
  .gf-social-link svg{width:15px;height:15px}
  @media(max-width:520px){
    .gfooter-inner{flex-direction:column;align-items:center;gap:10px;text-align:center}
    .gf-text{text-align:center}
  }
</style>