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

        /* Top info bar */
        .top-bar{ background: transparent; border-bottom: 1px solid rgba(255,215,115,0.06); position:relative; z-index:1000; }
        .top-bar .container{ padding: 8px 0; text-align: center; color: #f6d78d; font-weight: 600; font-size: 0.95rem; }

        /* Main decorative header */
        .main-header{ background: linear-gradient(180deg, rgba(6,24,16,0.98), rgba(4,18,12,0.98)); padding: 14px 0; border-bottom: 1px solid rgba(255,215,115,0.04); position:relative; z-index:1000; }
        .brand{ display:flex; align-items:center; gap:12px; }
        .brand img{ height:48px; width:auto; display:block; }
        .brand .brand-text{ color:#ffd77d; font-family: Georgia, serif; font-size:1.4rem; font-weight:700; letter-spacing:0.06em; }

        /* Navigation */
        .main-nav{ display:flex; gap:18px; align-items:center; }
        .main-nav a{ padding:12px 22px; border:2px solid rgba(255,215,115,0.18); color:#ffd77d; text-decoration:none; border-radius:6px; letter-spacing:0.06em; background: rgba(0,0,0,0.03); }
        .main-nav a:hover{ background: rgba(255,215,115,0.06); color:#fff; }

        /* User icon */
        .user-icon{ width:44px; height:44px; border-radius:50%; border:2px solid rgba(255,215,115,0.22); display:flex; align-items:center; justify-content:center; color:#ffd77d; font-weight:700; }

        /* Subtle footer strip */
        .site-footer{ padding:18px 0; margin-top:36px; text-align:center; color:#e8dfb9; font-size:0.95rem; position:relative; z-index:1000; }

        /* Ensure main page content sits below header visually */
        main{ position: relative; z-index: 1; }

        @media (max-width: 900px){
            .main-nav{ display:none; }
        }
    </style>
</head>
<body>

    <div class="top-bar">
        <div class="container">&copy; 2026 POSITRON 2026 &nbsp;&nbsp; Departemen Teknik Elektro dan Informatika - Universitas Negeri Malang</div>
    </div>

    <header class="main-header">
        <div class="container" style="display:flex;align-items:center;justify-content:space-between;gap:20px;">
            <div class="brand">
                <img src="/images/logo-small.png" alt="POSITRON">
                <div class="brand-text">POSITRON 2026</div>
            </div>

            <nav class="main-nav" aria-label="Main navigation">
                <a href="{{ route('home') }}">HOME</a>
                <a href="{{ route('about') }}">ABOUT</a>
                <a href="{{ route('filosofi') }}">FILOSOFI</a>
                <a href="{{ route('timeline') }}">TIMELINE</a>
            </nav>

            <div class="user-icon"><a href="{{ route('login') }}" style="color:inherit;text-decoration:none;display:block;width:100%;height:100%;text-align:center;line-height:40px">&#9711;</a></div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">Departemen Teknik Elektro dan Informatika - Universitas Negeri Malang</div>
    </footer>

</body>
</html>
