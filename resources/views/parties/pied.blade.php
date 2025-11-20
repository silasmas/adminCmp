 <!-- ============================================
       SCRIPTS
       ============================================ -->
  
  <!-- Confetti library -->
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

  <!-- Application modules (ORDRE IMPORTANT!) -->
  <script src="{{ asset('assets/js/config.js') }}"></script>
  <script src="{{ asset('assets/js/state.js') }}"></script>
  <script src="{{ asset('assets/js/utils.js') }}"></script>
  <script src="{{ asset('assets/js/carousel.js') }}"></script>
  <script src="{{ asset('assets/js/testimonies-grid.js') }}"></script>
  <script src="{{ asset('assets/js/modals.js') }}"></script>
  <script src="{{ asset('assets/js/form.js') }}"></script>
  <script src="{{ asset('assets/js/stats.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  
  <!-- Corrections finales (DOIT ÊTRE EN DERNIER) -->
  <script src="{{ asset('asstesjs/corrections-v2.js') }}"></script>
<!-- Hydrate les icônes Lucide une fois le DOM prêt -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (window.lucide && typeof lucide.createIcons === 'function') {
        lucide.createIcons();
      }
    });
  </script>
</body>
</html>