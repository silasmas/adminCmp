// ================================================
// REACTIVE STATE MANAGEMENT
// ================================================

const state = {
  userName: localStorage.getItem('bunda21_user') || null,
  userLocation: localStorage.getItem('bunda21_user_location') || null,
  selectedCategory: 'Tous',
  currentPage: 1,
  amenCounts: {},
  amenedTestimonies: new Set(JSON.parse(localStorage.getItem('bunda21_amened') || '[]')),
  
  // Form state
  testimonyType: 'text',
  selectedColor: window.CONFIG.POST_IT_COLORS[0],
  selectedFont: window.CONFIG.FONT_STYLES[0],
  uploadedImages: [],
  videoFile: null,
  videoPreview: null,
  mediaRecorder: null,
  recordedChunks: [],
  
  // UI state
  isCarouselPaused: false
};

// Save amened testimonies to localStorage
function saveAmenedTestimonies() {
  localStorage.setItem('bunda21_amened', JSON.stringify([...state.amenedTestimonies]));
}

// Export state
window.STATE = state;
window.saveAmenedTestimonies = saveAmenedTestimonies;
