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
        left:22%;
        width:8%;
        height:35%;
    }

    .about{
        top:22%;
        left:34%;
        width:8%;
        height:35%;
    }

    .filosofi{
        top:22%;
        left:46%;
        width:9%;
        height:35%;
    }

    .timeline{
        top:22%;
        left:59%;
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
    }

    .profile-panel.active{
        right:0;
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

<div class="homepage">

    <div class="header-container">
        <img src="{{ asset('images/header.png') }}" class="header">

        <a href="{{ route('homepage') }}" class="menu home"></a>
        <a href="{{ url('/about') }}" class="menu about"></a>
        <a href="{{ route('filosofi') }}" class="menu filosofi"></a>
        <a href="{{ url('/timeline') }}" class="menu timeline"></a>

        <div class="menu profil" onclick="toggleProfile()"></div>
    </div>

    <div class="hero">
        <a href="{{ route('profil') }}">
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
    </div>

</div>

<script>
function toggleProfile(){
    document.getElementById("profilePanel").classList.toggle("active");
}
</script>