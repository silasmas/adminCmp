@extends("parties.template")

@section("content")

<!-- ============================================
       HERO SECTION
       ============================================ -->
  <section id="hero" class="hero-section">
    <div class="hero-bg-black"></div>
    <div class="hero-bg-glow"></div>
    
    <!-- Auth Button -->
    <div class="auth-button-container" id="authContainer"></div>

    <!-- Main Content -->
    <div class="hero-content">
      <div class="hero-grid">
        
        <!-- LEFT: Text Content -->
        <div class="hero-text">
          <div class="hero-logo">
            <img src="assets/logo-b21.svg" alt="Bunda21 Logo" class="logo-img">
          </div>
          
          <h2 class="hero-title">Ce que Dieu a fait pour nous !</h2>
          <h3 class="hero-subtitle">Partagé, conservé, célébré.</h3>
          
          <p class="hero-description">
            Un espace vivant où chaque fidèle partage son action de grâce et proclame, comme il est écrit :
            <strong>« Ils l'ont vaincu à cause de la parole de leur témoignage » (Apocalypse 12:11).</strong>
          </p>
          
          <button class="cta-button" id="heroCTA">
            J'ai un témoignage
          </button>
          
          <div class="hero-counter">
            <span class="counter-number" id="testimoniesCount">0</span>
            <span class="counter-label">témoignages enregistrés</span>
          </div>
        </div>

        <!-- RIGHT: Carousel Columns -->
        <div class="hero-carousel-wrapper">
          <div class="carousel-columns">
            <div class="carousel-column" id="carouselCol1"></div>
            <div class="carousel-column" id="carouselCol2"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="6 9 12 15 18 9"></polyline>
      </svg>
    </div>
  </section>

@endsection