@extends('layouts.app')

@section('title', 'About - POSITRON 2026')

@section('styles')
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
  @vite('resources/css/about.css')
@endsection

@section('content')
<div class="desk">
  <div class="decor decor-books"></div>
  <div class="decor decor-candle"></div>
 
  <div class="showcase">
    <div class="royal-figure royal-figure-left">
      <div class="particle-ring particle-ring-left">
        <span></span><span></span><span></span><span></span><span></span>
      </div>
      <img src="/images/ratu-1.webp" alt="Ratu">
    </div>

    <div class="book-wrapper">
      <div id="flipbook">
  
        <div class="page-content page-left paper-surface" id="pageLeft">
          <div class="age-spots"></div>
          <div class="watermark"></div>
          <div class="ornament tl"></div>
          <div class="ornament bl"></div>
          <div class="text-container page-fade" id="leftContent"></div>
          <div class="page-number" id="leftNumber"></div>
        </div>
  
        <div class="flipper-leaf" id="leaf1">
          <div class="leaf-front paper-surface" id="leaf1Front"><div class="flip-shadow"></div></div>
          <div class="leaf-back paper-surface" id="leaf1Back"><div class="flip-shadow"></div></div>
        </div>
  
        <div class="page-content page-right paper-surface" id="pageRight">
          <div class="age-spots"></div>
          <div class="watermark"></div>
          <div class="ornament tr"></div>
          <div class="ornament br"></div>
          <div class="text-container page-fade" id="rightContent"></div>
          <div class="page-number" id="rightNumber"></div>
        </div>
  
      </div>
      <div class="pen"></div>
    </div>

    <div class="royal-figure royal-figure-right">
      <div class="particle-ring particle-ring-right">
        <span></span><span></span><span></span><span></span><span></span>
      </div>
      <img src="/images/raja-1.webp" alt="Raja">
    </div>
  </div>
 
  <div class="controls">
    <button id="prevBtn" onclick="turnToPrevPage()">◀ SEBELUMNYA</button>
    <div class="page-indicator" id="pageIndicator"></div>
    <button id="nextBtn" onclick="turnToNextPage()">SELANJUTNYA ▶</button>
  </div>
</div>

@vite('resources/js/about.js')
@endsection