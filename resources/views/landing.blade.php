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
    height:100%;
    overflow:hidden;
    background:#081A12;
}

.landing{
    position:relative;
    width:100vw;
    height:100vh;
}

.landing-image{
    width:100%;
    height:100%;
    display:block;
    object-fit:contain;
}

/* Area klik tombol OPEN INVITATION */
.open-invitation{
    position:absolute;
    left:8%;
    bottom:17%;
    width:25%;
    height:10%;
    z-index:100;
}
</style>

<div class="landing">

    <img src="{{ asset('images/landing.png') }}" alt="Landing Page" class="landing-image">

    <a href="{{ route('login') }}" class="open-invitation"></a>

</div>

@endsection