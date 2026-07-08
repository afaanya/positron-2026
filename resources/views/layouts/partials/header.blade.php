<header class="site-header" style="background: linear-gradient(90deg, #0a0e0d 0%, #0f1a12 50%, #0a0e0d 100%); border-bottom: 1px solid rgba(248, 215, 148, 0.1); backdrop-filter: blur(10px); position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);">
    <div class="container header-inner" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; height: 70px;">
        
        <!-- Logo -->
        <div class="site-logo" style="flex-shrink: 0;">
            <a href="{{ route('home') }}" style="display: flex; align-items: center; transition: opacity 0.3s ease; text-decoration: none;">
                <img src="{{ asset('images/logo-positron.png') }}" alt="POSITRON 2026" style="height: 45px; width: auto;">
            </a>
        </div>

        <!-- Navigation & User Menu -->
        <div class="header-right" style="display: flex; align-items: center; gap: 30px; flex: 1; justify-content: flex-end;">
            
            <!-- Main Navigation -->
            <nav class="main-nav" aria-label="Main navigation" style="display: flex; gap: 30px;">
                <a href="{{ route('home') }}" 
                   style="color: #f8d794; text-decoration: none; font-family: 'Libre Baskerville', serif; font-size: 14px; font-weight: 500; letter-spacing: 0.5px; transition: all 0.3s ease; position: relative;">
                    HOME
                    <span style="position: absolute; bottom: -5px; left: 0; width: 0; height: 2px; background: #f8d794; transition: width 0.3s ease;"></span>
                </a>
                <a href="{{ route('timeline') }}" 
                   style="color: #c8a96e; text-decoration: none; font-family: 'Libre Baskerville', serif; font-size: 14px; font-weight: 500; letter-spacing: 0.5px; transition: all 0.3s ease; position: relative;">
                    TIMELINE
                    <span style="position: absolute; bottom: -5px; left: 0; width: 0; height: 2px; background: #f8d794; transition: width 0.3s ease;"></span>
                </a>
                <a href="{{ route('about') }}" 
                   style="color: #c8a96e; text-decoration: none; font-family: 'Libre Baskerville', serif; font-size: 14px; font-weight: 500; letter-spacing: 0.5px; transition: all 0.3s ease; position: relative;">
                    ABOUT
                    <span style="position: absolute; bottom: -5px; left: 0; width: 0; height: 2px; background: #f8d794; transition: width 0.3s ease;"></span>
                </a>
                <a href="{{ route('filosofi') }}" 
                   style="color: #c8a96e; text-decoration: none; font-family: 'Libre Baskerville', serif; font-size: 14px; font-weight: 500; letter-spacing: 0.5px; transition: all 0.3s ease; position: relative;">
                    FILOSOFI
                    <span style="position: absolute; bottom: -5px; left: 0; width: 0; height: 2px; background: #f8d794; transition: width 0.3s ease;"></span>
                </a>

                @if(session()->has('admin_login'))
                <a href="{{ route('mentor.home') }}" 
                   style="color: #c8a96e; text-decoration: none; font-family: 'Libre Baskerville', serif; font-size: 14px; font-weight: 500; letter-spacing: 0.5px; transition: all 0.3s ease; position: relative;">
                    MENTOR
                    <span style="position: absolute; bottom: -5px; left: 0; width: 0; height: 2px; background: #f8d794; transition: width 0.3s ease;"></span>
                </a>
                @endif

                @if(session()->has('admin_login') && request()->routeIs('mentor.*'))
                <a href="{{ route('home') }}"
                   style="color: #c8a96e; text-decoration: none; font-family: 'Libre Baskerville', serif; font-size: 14px; font-weight: 500; letter-spacing: 0.5px; transition: all 0.3s ease; position: relative;">
                    <- Kebali ke home mahasiswa
                </a>
                @endif
            </nav>

            <!-- User Profile Button -->
            <button id="userPill" class="user-pill" aria-haspopup="true" aria-expanded="false"
                style="display:flex; align-items:center; justify-content:center; width:40px; height:40px; background:rgba(248,215,148,.1); border:1px solid rgba(248,215,148,.3); border-radius:50%; cursor:pointer; transition:all .3s ease;">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="#f8d794">
                    <path d="M12 12c2.76 0 5-2.24 5-5S14.76 2 12 2 7 4.24 7 7s2.24 5 5 5zm0 2c-3.33 0-10 1.67-10 5v3h20v-3c0-3.33-6.67-5-10-5z"/>
                </svg>

            </button>

            <!-- User Menu Dropdown -->
            <div class="user-menu" id="userMenu" role="menu" aria-hidden="true" 
                 style="position: absolute; top: 70px; right: 20px; width: 280px; background: #0f1a12; border: 1px solid rgba(248, 215, 148, 0.2); border-radius: 10px; padding: 20px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5); opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s ease; z-index: 2000;">
                
                <button id="userMenuClose" class="close-btn" aria-label="Tutup" 
                        style="position: absolute; top: 10px; right: 10px; background: none; border: none; color: #c8a96e; font-size: 24px; cursor: pointer; transition: color 0.3s ease;">
                    &times;
                </button>

                <h4 style="color: #f8d794; font-family: 'Libre Baskerville', serif; font-size: 16px; margin-bottom: 15px; margin-top: 5px;">Mahasiswa</h4>

                <a class="menu-item" href="{{ route('biodata') }}"
                style="display: block; color: #c8a96e; text-decoration: none; padding: 10px 0; border-bottom: 1px solid rgba(248, 215, 148, 0.1); transition: color 0.3s ease; font-size: 14px; font-family: 'Libre Baskerville', serif;">
                    Biodata
                </a>

                <a class="menu-item" href="{{ route('poin') }}"
                style="display: block; color: #c8a96e; text-decoration: none; padding: 10px 0; border-bottom: 1px solid rgba(248, 215, 148, 0.1); transition: color 0.3s ease; font-size: 14px; font-family: 'Libre Baskerville', serif;">
                    Poin
                </a>

                <a class="menu-item" href="{{ route('sertifikat') }}"
                style="display: block; color: #c8a96e; text-decoration: none; padding: 10px 0; border-bottom: 1px solid rgba(248, 215, 148, 0.1); transition: color 0.3s ease; font-size: 14px; font-family: 'Libre Baskerville', serif;">
                    Sertifikat
                </a>

                <a class="menu-item secondary"
                href="https://docs.google.com/forms/d/e/1FAIpQLSfmCmaEVXqK1s1E3H0XGTLKYiFSYI0ciSAoy1iGQyDEYdWjBQ/viewform?usp=dialog"
                target="_blank"
                rel="noopener"
                style="display: block; color: #c8a96e; text-decoration: none; padding: 10px 0; border-bottom: 1px solid rgba(248, 215, 148, 0.1); transition: color 0.3s ease; font-size: 14px; font-family: 'Libre Baskerville', serif;">
                    Kritik dan Saran
                </a>

                <form method="POST" action="{{ route('logout') }}" style="margin-top: 15px;">
                    @csrf
                    <button type="submit" class="logout-btn" 
                            style="width: 100%; padding: 10px; background: rgba(197, 69, 61, 0.2); border: 1px solid #c5453d; color: #ff6b5b; border-radius: 6px; cursor: pointer; transition: all 0.3s ease; font-family: 'Libre Baskerville', serif; font-size: 14px;">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </div>

    <style>
        .main-nav a:hover {
            color: #f8d794 !important;
        }

        .main-nav a:hover span {
            width: 100% !important;
        }

        #userPill:hover {
            background: rgba(248, 215, 148, 0.2) !important;
            border-color: rgba(248, 215, 148, 0.6) !important;
            transform: scale(1.05);
        }

        .user-menu.active {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
        }

        .menu-item:hover {
            color: #f8d794 !important;
            padding-left: 8px !important;
        }

        .logout-btn:hover {
            background: rgba(197, 69, 61, 0.4) !important;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .main-nav {
                gap: 15px !important;
                font-size: 12px !important;
            }

            .main-nav a {
                font-size: 12px !important;
            }
        }
    </style>
</header>

<script>
document.getElementById('userPill')?.addEventListener('click', function() {
    const menu = document.getElementById('userMenu');
    menu.classList.toggle('active');
    this.setAttribute('aria-expanded', menu.classList.contains('active'));
});

document.getElementById('userMenuClose')?.addEventListener('click', function() {
    const menu = document.getElementById('userMenu');
    menu.classList.remove('active');
    document.getElementById('userPill').setAttribute('aria-expanded', 'false');
});

document.addEventListener('click', function(e) {
    const menu = document.getElementById('userMenu');
    const pill = document.getElementById('userPill');
    if (menu && pill && !menu.contains(e.target) && !pill.contains(e.target)) {
        menu.classList.remove('active');
        pill.setAttribute('aria-expanded', 'false');
    }
});
</script>