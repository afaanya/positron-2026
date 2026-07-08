<section class="relative w-screen h-screen flex items-center justify-center overflow-hidden">
    <div class="relative w-full h-full">
        <!-- Background Image (Sambutan) -->
        <img src="{{ asset('images/sambutan.png') }}" class="w-full h-full object-cover">

        <!-- Video YouTube Overlay di Papan Tulis -->
        <div class="absolute" style="top: 56%; left: 59%; width: 35%; aspect-ratio: 16/9; transform: translate(-50%, -50%);">
            <iframe 
                class="w-full h-full rounded shadow-2xl"
                src="https://www.youtube.com/embed/msP2pVi8DfA"
                title="Sambutan" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>
