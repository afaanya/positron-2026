<section class="relative w-screen h-screen flex items-center justify-center overflow-hidden">
    <div class="relative w-full h-full">
        <!-- Background Image (Sambutan) -->
        <img src="{{ asset('images/sambutan.png') }}" class="w-full h-full object-cover">

        <!-- Video YouTube Overlay di Papan Tulis -->
                <div class="absolute" style="top: 56%; left: 59%; width: 35%; aspect-ratio: 16/9; transform: translate(-50%, -50%); overflow: hidden; border-radius: 0.375rem;">
                    <iframe 
                        id="videoSambutan"
                        style="position: absolute; top: -60px; left: -20px; width: calc(100% + 40px); height: calc(100% + 120px); pointer-events: none;"
                        class="rounded shadow-2xl"
                        src="https://www.youtube.com/embed/5AQN-rkHLhk?autoplay=1&mute=1&loop=1&playlist=5AQN-rkHLhk&controls=0&rel=0&enablejsapi=1"
                        title="Sambutan" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                    <button id="btnMuteSambutan" style="position: absolute; bottom: 10px; right: 10px; z-index: 999; background: rgba(0,0,0,0.7); border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; font-size: 18px;">
                        🔇
                    </button>
                </div>

<script>
let playerSambutan;
let ytApiReady = false;

// Load YouTube API cuma sekali
if (!window.YT) {
    let tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    document.body.appendChild(tag);
}

function onYouTubeIframeAPIReady() {
    ytApiReady = true;
    playerSambutan = new YT.Player('videoSambutan', {
        events: {
            'onReady': function(event) {
                console.log('Player siap');
            }
        }
    });
}

document.getElementById('btnMuteSambutan').addEventListener('click', function() {
    if (!playerSambutan || typeof playerSambutan.isMuted !== 'function') {
        console.warn('Player belum siap, coba lagi sebentar');
        return;
    }

    if (playerSambutan.isMuted()) {
        playerSambutan.unMute();
        playerSambutan.setVolume(100);
        this.innerText = '🔊';
    } else {
        playerSambutan.mute();
        this.innerText = '🔇';
    }
});
</script>
    </div>
</section>