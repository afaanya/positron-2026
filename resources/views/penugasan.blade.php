<style>

.penugasan-section{
    width:100%;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#1a1a1a;
    padding:0;
    margin:0;
    overflow:hidden;
}

.penugasan-container{
    position:relative;
    width:100%;
    height:100%;
    display:flex;
    justify-content:center;
    align-items:center;
}

.penugasan-image{
    width:100%;
    height:100%;
    display:block;
    object-fit:cover;
}

.hotspot{
    position:absolute;
    cursor:pointer;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
}

.hotspot span{
    display:none;
}

/* Manual Book */
.manual{
    top:8%;
    left:15%;
    width:12%;
    height:18%;
}

/* ID Card */
.idcard{
    top:40%;
    left:43%;
    width:14%;
    height:20%;
}

/* Twibbon */
.twibbon{
    top:12%;
    right:15%;
    width:12%;
    height:18%;
}

</style>

<section id="penugasan" class="penugasan-section">

    <div class="penugasan-container">

        <img src="{{ asset('images/penugasan.png') }}"
             class="penugasan-image"
             alt="Penugasan">

        <a href="{{ route('manualbook') }}" class="hotspot manual"></a>

        <a href="{{ route('idcard') }}" class="hotspot idcard"></a>

        <a href="{{ route('twibbon') }}" class="hotspot twibbon"></a>

    </div>

</section>