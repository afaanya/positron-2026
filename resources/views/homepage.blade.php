<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    html, body{
        width:100%;
        overflow-x:hidden;
        background:#081A12;
    }

    .homepage{
        width:100%;
    }

    .header-container{
        position:relative;
        width:100%;
        z-index:10;
    }

    .header,
    .selamat-datang,
    .footer{
        width:100%;
        display:block;
    }
    

    .hero{
        width:100%;
    }

    .menu{
        position:absolute;
        display:block;
        cursor:pointer;
        z-index:9999;
    }

    .home{ 
        top:22%;
        left:60%;
        width:8%;
        height:35%;
    }

    .about{
        top:22%;
        left:68%;
        width:8%;
        height:35%;
    }

    .filosofi{
        top:22%;
        left:76%;
        width:9%;
        height:35%;
    }

    .timeline{
        top:22%;
        left:84%;
        width:9%;
        height:35%;
    }

    .profil{
        top:12%;
        right:2.5%;
        width:4%;
        height:60%;
        border-radius:50%;
        z-index:99999;
        cursor:pointer;
        display:block;
    }

    .selamat-datang{
        cursor:pointer;
    }

    .profile-panel{
        position:fixed;
        top:0;
        right:-340px;
        width:340px;
        height:100vh;
        background:#0f1f17;
        color:white;
        z-index:999999;
        transition:0.3s ease;
        padding:20px;
        box-shadow:-10px 0 30px rgba(0,0,0,0.4);
        display:flex;
        flex-direction:column;
    }

    .profile-panel.active{
        right:0;
    }

    .profile-menu{
        flex:1;
        overflow-y:auto;
        display:flex;
        flex-direction:column;
        gap:10px;
    }

    .profile-menu-bottom{
        margin-top:auto;
    }

    .profile-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    .profile-header span{
        cursor:pointer;
        font-size:20px;
    }

    .profile-menu button{
        width:100%;
        margin-bottom:10px;
        padding:10px;
        background:#1c2f25;
        border:none;
        color:white;
        cursor:pointer;
        border-radius:6px;
    }

    .profile-menu button:hover{
        background:#2a4a38;
    }

    .profile-content{
        margin-top:20px;
        font-size:14px;
    }
</style>

    <div class="hero">
        <img src="{{ asset('images/selamat-datang.png') }}" class="selamat-datang">
        </a>
    </div>
</div>

<div id="profilePanel" class="profile-panel">
    <div class="profile-header">
        <h3>Mahasiswa</h3>
        <span onclick="toggleProfile()">✕</span>
    </div>

    <div class="profile-menu">
        <button onclick="window.location.href='{{ route('biodata') }}'">Biodata</button>
        <button onclick="window.location.href='{{ route('poin') }}'">Poin</button>
        <button onclick="window.location.href='{{ route('sertifikat') }}'">Sertifikat</button>
        
        <div class="profile-menu-bottom">
            <button onclick="window.open('https://docs.google.com/forms/d/e/1FAIpQLSfmCmaEVXqK1s1E3H0XGTLKYiFSYI0ciSAoy1iGQyDEYdWjBQ/viewform?usp=dialog', '_blank')" style="background:#1c2f25;">Kritik dan Saran</button>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
            <button onclick="document.getElementById('logoutForm').submit()" style="background:#c5453d;">Logout</button>
        </div>
    </div>

</div>

<script>
function toggleProfile(){
    document.getElementById("profilePanel").classList.toggle("active");
}
</script>