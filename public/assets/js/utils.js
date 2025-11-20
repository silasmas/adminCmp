// ================================================
// UTILITY FUNCTIONS
// ================================================

function getAmensForTestimony(id) {
  if (window.STATE.amenCounts[id]) {
    return window.STATE.amenCounts[id];
  }
  const seed = id * 7 + 23;
  const count = 10 + Math.floor((Math.sin(seed) * 0.5 + 0.5) * 50);
  window.STATE.amenCounts[id] = count;
  return count;
}

function getFilteredTestimonies() {
  const { TESTIMONIES } = window.CONFIG;
  const { selectedCategory } = window.STATE;
  
  if (selectedCategory === 'Tous') {
    return TESTIMONIES;
  } else if (selectedCategory === 'Vidéos') {
    return TESTIMONIES.filter(t => t.type === 'video');
  } else {
    return TESTIMONIES.filter(t => t.category === selectedCategory);
  }
}

function getCurrentPageTestimonies() {
  const filtered = getFilteredTestimonies();
  const { currentPage } = window.STATE;
  const { ITEMS_PER_PAGE } = window.CONFIG;
  const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
  const endIndex = startIndex + ITEMS_PER_PAGE;
  return filtered.slice(startIndex, endIndex);
}

function getTotalPages() {
  const filtered = getFilteredTestimonies();
  const { ITEMS_PER_PAGE } = window.CONFIG;
  return Math.ceil(filtered.length / ITEMS_PER_PAGE);
}

function animateCounter(element, target, duration = 2000) {
  const increment = target / (duration / 16);
  let current = 0;
  
  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      element.textContent = target;
      clearInterval(timer);
    } else {
      element.textContent = Math.floor(current);
    }
  }, 16);
}

function triggerConfetti(x, y) {
  if (typeof confetti === 'function') {
    confetti({
      particleCount: 30,
      spread: 60,
      origin: { x, y },
      colors: ['#950000', '#F5D693', '#FFD6DC'],
      ticks: 40,
      gravity: 1.2,
      scalar: 0.8
    });
  }
}

function scrollToWall() {
  const wallSection = document.getElementById('wall');
  if (wallSection) {
    wallSection.scrollIntoView({ behavior: 'smooth' });
  }
}

function handleAmen(id, event) {
  console.log('🎊 handleAmen appelé', { id, event, hasEvent: !!event });
  
  if (window.STATE.amenedTestimonies.has(id)) return;
  
  window.STATE.amenCounts[id] = (window.STATE.amenCounts[id] || getAmensForTestimony(id)) + 1;
  window.STATE.amenedTestimonies.add(id);
  window.saveAmenedTestimonies();
  
  // Update UI
  const amenButtons = document.querySelectorAll(`[data-testimony-id="${id}"] .amen-button, .amen-button[data-testimony-id="${id}"]`);
  amenButtons.forEach(btn => {
    const countSpan = btn.querySelector('.amen-count');
    if (countSpan) {
      countSpan.textContent = window.STATE.amenCounts[id];
    }
    btn.disabled = true;
    btn.classList.add('disabled');
  });
  
  // Confetti
  if (event) {
    const btn = event.target.closest('.amen-button');
    console.log('🎊 Bouton trouvé pour confetti:', btn);
    if (btn) {
      const rect = btn.getBoundingClientRect();
      const x = (rect.left + rect.width / 2) / window.innerWidth;
      const y = (rect.top + rect.height / 2) / window.innerHeight;
      console.log('🎊 Position confetti:', { x, y });
      console.log('🎊 Fonction confetti existe?', typeof confetti === 'function');
      triggerConfetti(x, y);
    } else {
      console.warn('⚠️ Bouton non trouvé avec closest');
    }
  } else {
    console.warn('⚠️ Event non passé à handleAmen');
  }
  
  // Déclencher l'événement pour mettre à jour les stats
  window.dispatchEvent(new CustomEvent('amenClicked', { detail: { testimonyId: id } }));
}

function handleShare(testimony, platform) {
  const text = `${testimony.title} - Mur de Témoignages Bunda21`;
  const url = window.location.href;

  switch (platform) {
    case 'twitter':
      window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`, '_blank');
      break;
    case 'whatsapp':
      window.open(`https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`, '_blank');
      break;
    case 'copy':
      navigator.clipboard.writeText(url).then(() => {
        alert('Lien copié !');
      });
      break;
  }
  
  // Déclencher l'événement pour mettre à jour les stats
  window.dispatchEvent(new CustomEvent('testimonyShared', { 
    detail: { 
      testimonyId: testimony.id,
      platform: platform 
    } 
  }));
}

// Export functions
window.UTILS = {
  getAmensForTestimony,
  getFilteredTestimonies,
  getCurrentPageTestimonies,
  getTotalPages,
  animateCounter,
  triggerConfetti,
  scrollToWall,
  handleAmen,
  handleShare
};