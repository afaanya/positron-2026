<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POSITRON 2026')</title>

    @vite(['resources/css/app.css'])

    <style>
        *{ margin: 0; padding: 0; box-sizing: border-box; }
        html, body{ width: 100%; overflow-x: hidden; background: #081a12; font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }

        .container{ max-width: 1200px; margin: 0 auto; padding: 0 18px; }

        /* Site header */
        .site-header {
            /* CSS-only textured header: subtle diagonal pattern over a green gradient */
            background-color: #12321f;
            background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.02) 0 1px, transparent 1px 6px), linear-gradient(180deg,#153922,#0f3326);
            background-size: auto, cover;
            background-position: center;
            padding: 10px 0;
            box-shadow: inset 0 -1px 0 rgba(0,0,0,0.2);
        }
        .site-header .header-inner{ display:flex; align-items:center; justify-content:space-between; gap:20px; }
        .site-logo{ display:flex; align-items:center; gap:14px; }
        .site-logo img{ height:34px; width:auto; }
        .main-nav{ display:flex; gap:18px; align-items:center; }
        .main-nav a{ color: #f3e7c9; text-decoration:none; padding:10px 14px; border-radius:6px; font-weight:600; letter-spacing:0.04em; background:rgba(0,0,0,0.05); border:1px solid rgba(255,255,255,0.03); }
        .main-nav a:hover{ background: rgba(255,255,255,0.04); color:#fff; }
        .user-pill{ display:inline-flex; align-items:center; gap:10px; padding:6px 12px; border-radius:18px; background: rgba(0,0,0,0.08); border:1px solid rgba(255,255,255,0.04); color:#ffd77d; cursor:pointer; }
        .user-pill .icon{ width:28px; height:28px; border-radius:50%; background: rgba(255,255,255,0.06); display:grid; place-items:center; }

        /* User menu (dropdown / panel) - styles tuned to match screenshot */
        .user-menu {
            position: absolute;
            right: 18px;
            top: 66px;
            width: 300px; /* narrow panel */
            max-width: calc(100% - 36px);
            background: linear-gradient(180deg, #071711, #081f18);
            border-radius: 12px;
            padding: 14px 14px 16px 14px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.6);
            display: none;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            z-index: 1200;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            gap: 12px;
            border: 1px solid rgba(255,255,255,0.03);
            overflow: hidden;
            transform: translateY(-8px);
            transition: opacity 0.18s ease, transform 0.18s ease;
        }
        .user-menu.show {
            display: flex;
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0);
        }
        .user-menu h4 { color:#fff; margin:0; font-weight:600; font-size:20px; }
        .user-menu .close-btn {
            position: absolute;
            right: 16px;
            top: 14px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            font-size: 22px;
            display: grid;
            place-items: center;
            cursor: pointer;
            transition: background 0.18s ease, transform 0.12s ease;
            z-index: 1301;
        }
        .user-menu .close-btn:hover { background: rgba(255,255,255,0.14); transform: scale(1.04); }

        .user-menu .menu-list { display:flex; flex-direction:column; gap:12px; margin-top:10px; }
        .user-menu .menu-item { display:block; width:100%; text-align:center; padding:12px 14px; border-radius:8px; background: transparent; color:#fff; text-decoration:none; border:1px solid rgba(255,255,255,0.08); font-size:16px; }
        .user-menu .menu-item:hover { background: rgba(255,255,255,0.06); }
        /* first item highlighted slightly lighter */
        .user-menu .menu-item:first-of-type { background: rgba(47,106,85,0.18); border-color: rgba(47,106,85,0.24); }

        .user-menu .menu-footer { margin-top: auto; display:flex; flex-direction:column; gap:12px; }
            .user-menu .menu-footer { margin-top: 8px; display:flex; flex-direction:column; gap:12px; }
            .user-menu .secondary { background: rgba(31,57,47,0.12); color:#fff; padding:12px 14px; border-radius:8px; text-align:center; text-decoration:none; border:1px solid rgba(255,255,255,0.02); }
        .user-menu .logout-btn { display:block; width:100%; padding:12px; border-radius:8px; background:#c84f47; color:#fff; border:none; cursor:pointer; font-weight:700; }
        .user-menu .logout-btn:hover { opacity:0.95; }
        /* .side-links removed - links moved into header-right */

        main{ position: relative; z-index: 1; }

        @media (max-width: 900px){
            .main-nav{ display:none; }
        }
        /* Mobile: full-screen user menu */
        @media (max-width: 520px) {
            .user-menu {
                position: fixed;
                inset: 0;
                top: 0;
                right: 0;
                width: 100%;
                height: 100%;
                max-width: 100%;
                padding: 28px 18px 36px 18px;
                border-radius: 0;
                display: none;
            }
            .user-menu.show { display: flex; }
            .user-menu h4 { font-size: 22px; }
            .user-menu .menu-list { gap:22px; }
            .user-menu .menu-item { padding:20px; font-size:18px; border-radius:12px; }
            .user-menu .logout-btn { padding:14px; font-size:16px; }
            .user-menu .close-btn { top: 18px; right: 18px; }
            /* Position footer buttons near bottom */
            .user-menu .menu-footer { margin-top: auto; }
        }
    </style>

    {{-- KUNCI UTAMA: Tempat untuk menyuntikkan CSS spesifik dari halaman manualbook --}}
    @yield('styles')
</head>
<body>

    @include('layouts.partials.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <script>
        (function(){
            const userPill = document.getElementById('userPill');
            const userMenu = document.getElementById('userMenu');
            if (!userPill || !userMenu) return;
            function openMenu(){
                userMenu.classList.add('show');
                userMenu.setAttribute('aria-hidden','false');
                userPill.setAttribute('aria-expanded','true');
            }
            function closeMenu(){
                userMenu.classList.remove('show');
                userMenu.setAttribute('aria-hidden','true');
                userPill.setAttribute('aria-expanded','false');
            }
            userPill.addEventListener('click', e => {
                if (userMenu.classList.contains('show')) closeMenu(); else openMenu();
            });
            document.addEventListener('click', e => {
                if (!userMenu.classList.contains('show')) return;
                if (e.target.closest('#userMenu') || e.target.closest('#userPill')) return;
                closeMenu();
            });
            // close button inside menu
            const userMenuClose = document.getElementById('userMenuClose');
            if (userMenuClose) userMenuClose.addEventListener('click', closeMenu);
        })();
    </script>

</body>
</html>
