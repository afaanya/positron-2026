@extends('layouts.app')

@section('content')

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html,
body{
    width:100%;
    min-height:100vh;
    overflow-x:hidden;
    font-family:'Times New Roman', serif;
    background: url('{{ asset('images/login-bg.png') }}') center center / cover no-repeat fixed;
}

.profile-page{
    width:100%;
    min-height:100vh;
    display:flex;
    flex-direction:column;
}

.header-container{
    position:relative;
    width:100%;
}

.header,
.footer{
    width:100%;
    display:block;
}

.menu{
    position:absolute;
    display:block;
    z-index:999;
    cursor:pointer;
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
}

/* Isi halaman */
.content{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:60px 20px;
}

.profile-card{
    width:90%;
    max-width:1100px;
    background:rgba(255,255,255,.92);
    border-radius:20px;
    padding:40px;
    box-shadow:0 10px 30px rgba(0,0,0,.2);
}

.profile-card h1{
    text-align:center;
    color:#284139;
    margin-bottom:30px;
}
</style>

<div class="profile-page">

    {{-- Header --}}
    <div class="header-container">
        <img src="{{ asset('images/header.png') }}" class="header">

        <a href="{{ route('homepage') }}" class="menu home"></a>
        <a href="{{ url('/about') }}" class="menu about"></a>
        <a href="{{ route('filosofi') }}" class="menu filosofi"></a>
        <a href="{{ url('/timeline') }}" class="menu timeline"></a>
        <a href="{{ route('profil') }}" class="menu profil"></a>
    </div>

    {{-- Isi --}}
    <div class="content">

        <div class="profile-card">

            <h1>Profil Mahasiswa</h1>

            {{-- Nanti isi UI profil kamu di sini --}}

        </div>

    </div>

    {{-- Footer --}}
    <img src="{{ asset('images/footer.png') }}" class="footer">

</div>

@endsection