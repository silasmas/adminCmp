<!-- ============================================
       MODALS
       ============================================ -->

  <!-- Auth Dialog -->
  <dialog id="authDialog" class="modal auth-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Connexion</h2>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="authForm" class="auth-form">
        <div class="form-group">
          <label for="userName">Votre nom</label>
          <input type="text" id="userName" class="form-input" placeholder="Ex: Jean Dupont" required>
        </div>
        <button type="submit" class="form-submit-btn">Se connecter</button>
      </form>
    </div>
  </dialog>

  <!-- Testimony Dialog (Texte) -->
  <dialog id="testimonyDialog" class="modal testimony-modal">
    <!-- Bande colorée en haut (AVANT modal-content) -->
    <div class="modal-color-strip"></div>
    
    <div class="modal-content">
      <div class="modal-header">
        <button class="modal-nav-btn modal-prev" type="button">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>
        <h2 class="modal-title testimony-modal-title"></h2>
        <button class="modal-nav-btn modal-next" type="button">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <div class="testimony-modal-body">
        <div class="testimony-meta">
          <div class="testimony-avatar"></div>
          <div class="testimony-author-info">
            <div class="testimony-author"></div>
            <div class="testimony-location"></div>
          </div>
          <div class="testimony-date"></div>
        </div>
        <div class="testimony-content"></div>
        <div class="testimony-actions">
          <button class="amen-button" type="button">
            <span>🙌</span>
            Amen (<span class="amen-count">0</span>)
          </button>
          <div class="share-buttons">
            <button class="share-btn" data-platform="twitter" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
              </svg>
            </button>
            <button class="share-btn" data-platform="whatsapp" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
            </button>
            <button class="share-btn" data-platform="copy" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="18" cy="5" r="3"></circle>
                <circle cx="6" cy="12" r="3"></circle>
                <circle cx="18" cy="19" r="3"></circle>
                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </dialog>

  <!-- Video Dialog -->
  <dialog id="videoDialog" class="modal video-modal">
    <!-- Bande colorée en haut (AVANT modal-content) -->
    <div class="modal-color-strip"></div>
    
    <div class="modal-content">
      <div class="modal-header">
        <button class="modal-nav-btn modal-prev" type="button">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>
        <h2 class="modal-title video-modal-title"></h2>
        <button class="modal-nav-btn modal-next" type="button">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <div class="video-modal-body">
        <video id="videoPlayer" controls></video>
        <div class="video-meta">
          <div class="video-author"></div>
          <div class="video-location"></div>
          <div class="video-date"></div>
        </div>
        <div class="testimony-actions">
          <button class="amen-button" type="button">
            <span>🙌</span>
            Amen (<span class="amen-count">0</span>)
          </button>
          <div class="share-buttons">
            <button class="share-btn" data-platform="twitter" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
              </svg>
            </button>
            <button class="share-btn" data-platform="whatsapp" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
            </button>
            <button class="share-btn" data-platform="copy" type="button">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="18" cy="5" r="3"></circle>
                <circle cx="6" cy="12" r="3"></circle>
                <circle cx="18" cy="19" r="3"></circle>
                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </dialog>

  <!-- Testimony Form Dialog -->
<dialog id="testimonyFormDialog" class="modal">
  <div class="modal-content testimony-form-modal-large">
    <div class="modal-header">
      <div>
        <h2 class="modal-title">Partagez votre témoignage</h2>
        <p class="modal-subtitle">Racontez-nous comment Dieu a agi dans votre vie. Votre histoire sera vérifiée avant d'être publiée.</p>
      </div>
      <button class="modal-close" type="button">&times;</button>
    </div>

    <form id="testimonyForm" class="testimony-form-complete">
      <!-- Type de témoignage -->
      <div class="form-group">
        <label>Type de témoignage</label>
        <div class="tabs-container" id="typeTabs" role="tablist" aria-label="Type de témoignage">
          <!-- pastille glissante -->
          <span class="tab-indicator" aria-hidden="true"></span>
          <button type="button" class="tab-btn active" data-type="text"
                  role="tab" aria-selected="true" aria-controls="textTestimonySection">
            <i data-lucide="file-text" style="width:16px;height:16px;vertical-align:-2px"></i>&nbsp;Texte & Photos
          </button>
          <button type="button" class="tab-btn" data-type="video"
                  role="tab" aria-selected="false" aria-controls="videoTestimonySection">
            <i data-lucide="video" style="width:16px;height:16px;vertical-align:-2px"></i>&nbsp;Vidéo
          </button>
        </div>
      </div>

      <!-- Titre -->
      <div class="form-group">
        <label for="formTitle">Titre du témoignage *</label>
        <input type="text" id="formTitle" class="form-input" placeholder="Ex: Guérison miraculeuse" required>
      </div>

      <!-- Section TEXTE -->
      <div id="textTestimonySection" class="testimony-section" role="tabpanel" aria-labelledby="text-tab">
        <div class="form-group">
          <label>Votre témoignage *</label>
          <div id="postItPreview" class="postit-preview">
            <div class="postit-controls">
              <!-- Font selector -->
              <div style="position: relative;">
                <button type="button" id="fontSelector" class="control-btn" aria-label="Choisir la police">
                  <span id="fontSelectorLabel" class="icon-aa">Aa</span>
                </button>
                <div id="fontPopover" class="popover hidden">
                  <h4>Style de police</h4>
                  <div class="font-grid">
                    <button type="button" class="font-option active" data-font="Sans-serif" style="font-family: Inter, sans-serif;">Aa</button>
                    <button type="button" class="font-option" data-font="Serif" style="font-family: Merriweather, serif;">Aa</button>
                    <button type="button" class="font-option" data-font="Indie Flower" style="font-family: 'Indie Flower', cursive;">Aa</button>
                    <button type="button" class="font-option" data-font="Caveat" style="font-family: Caveat, cursive;">Aa</button>
                    <button type="button" class="font-option" data-font="Patrick Hand" style="font-family: 'Patrick Hand', cursive;">Aa</button>
                    <button type="button" class="font-option" data-font="Kalam" style="font-family: Kalam, cursive;">Aa</button>
                    <button type="button" class="font-option" data-font="Permanent Marker" style="font-family: 'Permanent Marker', cursive;">Aa</button>
                    <button type="button" class="font-option" data-font="Shadows Into Light" style="font-family: 'Shadows Into Light', cursive;">Aa</button>
                  </div>
                </div>
              </div>

              <!-- Color selector -->
              <div style="position: relative;">
                <button type="button" id="colorSelector" class="control-btn"><i data-lucide="palette" style="width:18px;height:18px"></i></button>
                <div id="colorPopover" class="popover hidden">
                  <h4>Couleur du post-it</h4>
                  <div class="color-grid">
                    <button type="button" class="color-option active" data-color="#FFF6D9" style="background: #FFF6D9; border-color: #F5D693;"></button>
                    <button type="button" class="color-option" data-color="#FFE5E5" style="background: #FFE5E5; border-color: #FFD6DC;"></button>
                    <button type="button" class="color-option" data-color="#E4FFEB" style="background: #E4FFEB; border-color: #B8E6C3;"></button>
                    <button type="button" class="color-option" data-color="#F3E5F5" style="background: #F3E5F5; border-color: #E1BEE7;"></button>
                    <button type="button" class="color-option" data-color="#FFE0B2" style="background: #FFE0B2; border-color: #FFCC80;"></button>
                    <button type="button" class="color-option" data-color="#E3F2FD" style="background: #E3F2FD; border-color: #BBDEFB;"></button>
                    <button type="button" class="color-option" data-color="#FFE0E0" style="background: #FFE0E0; border-color: #FFCDD2;"></button>
                    <button type="button" class="color-option" data-color="#E0F7FA" style="background: #E0F7FA; border-color: #B2EBF2;"></button>
                  </div>
                </div>
              </div>
            </div>

            <div class="testimony-textarea-wrapper">
              <textarea id="formTestimony" placeholder="Partagez en détail comment Dieu est intervenu dans votre vie..." required></textarea>
            </div>
          </div>
          <p class="char-count"><span id="charCount">0</span> caractères</p>
        </div>

        <!-- Upload photos -->
        <div class="form-group">
          <div class="upload-header">
            <label>Photos (optionnel, max 5)</label>
            <button type="button" id="uploadPhotosBtn" class="upload-btn"><i data-lucide="camera" style="width:16px;height:16px"></i>&nbsp;Ajouter des photos</button>
            <input type="file" id="photoInput" accept="image/*" multiple hidden>
          </div>
          <div id="photosPreview" class="photos-grid"></div>
        </div>
      </div>

      <!-- Section VIDÉO -->
      <div id="videoTestimonySection" class="testimony-section hidden" role="tabpanel" aria-labelledby="video-tab">
        <div class="form-group">
          <label>Vidéo de témoignage (max 2 minutes) *</label>

          <div id="videoUploadOptions" class="video-options">
            <button type="button" id="recordVideoBtn" class="video-option-btn">
              <div class="option-icon"><i data-lucide="camera" style="width:26px;height:26px"></i></div>
              <div class="option-text">
                <strong>Enregistrer maintenant</strong>
                <span>Utiliser ma caméra</span>
              </div>
            </button>

            <button type="button" id="uploadVideoBtn" class="video-option-btn">
              <div class="option-icon"><i data-lucide="upload" style="width:26px;height:26px"></i></div>
              <div class="option-text">
                <strong>Uploader une vidéo</strong>
                <span>Depuis mon appareil</span>
              </div>
            </button>
            <input type="file" id="videoInput" accept="video/*" hidden>
          </div>

          <!-- Recording -->
          <div id="recordingSection" class="recording-section hidden" data-max-seconds="120">
            <video id="recordingPreview" autoplay muted></video>

            <div class="recording-controls">
              <div class="recording-status">
                <div class="recording-indicator">
                  <span class="recording-dot"></span>
                  Enregistrement en cours...
                </div>

                <!-- TIMER visuel -->
                <div class="rec-timer-inline" aria-live="polite">
                  <svg class="rec-ring" viewBox="0 0 44 44">
                    <circle class="ring-bg" cx="22" cy="22" r="20"></circle>
                    <circle class="ring-fg" cx="22" cy="22" r="20"></circle>
                  </svg>
                  <div class="rec-time">
                    <span id="recMinutes">02</span>:<span id="recSeconds">00</span>
                  </div>
                </div>
              </div>

              <button type="button" id="stopRecordingBtn" class="stop-btn">
                Arrêter
              </button>
            </div>
          </div>

          <!-- Preview -->
          <div id="videoPreviewSection" class="video-preview-section hidden">
            <video id="videoPreviewPlayer" controls></video>
            <button type="button" id="replaceVideoBtn" class="replace-btn">
              Remplacer la vidéo
            </button>
          </div>
        </div>
      </div>

      <!-- Info note -->
      <div class="info-note">
        <i data-lucide="info" style="width:16px;height:16px;vertical-align:-2px"></i>&nbsp;<strong>Note:</strong> Votre témoignage sera examiné par l'équipe du CMP avant publication 
        pour s'assurer de sa véracité et de son édification pour la communauté.
      </div>

      <!-- Actions -->
      <div class="form-actions">
        <button type="button" class="cancel-btn" id="formCancelBtn">Annuler</button>
        <button type="submit" class="submit-btn">Soumettre mon témoignage</button>
      </div>
    </form>
  </div>
</dialog>
