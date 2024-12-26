document.addEventListener("DOMContentLoaded", function () {
  const lightboxOverlay = document.getElementById("lightbox-overlay");
  const lightboxImage = document.querySelector(".lightbox-image");
  const lightboxTitle = document.querySelector(".lightbox-title");
  const lightboxCategory = document.querySelector(".lightbox-category");
  const closeButton = document.querySelector(".lightbox-close");
  const prevButton = document.querySelector(".lightbox-prev");
  const nextButton = document.querySelector(".lightbox-next");
  let currentPhotoIndex = 0;

  // Fonction pour récupérer les photos actuelles dans le DOM
  function getPhotos() {
    return document.querySelectorAll(".photo-item img");
  }

  // Affiche la lightbox avec la photo donnée
  function showLightbox(photo) {
    const originalSrc = photo.src.replace(/-\d+x\d+(.\w+)$/, "$1"); // Remplace les dimensions par l'original
    const category = photo.dataset.category; // Récupère la catégorie
    lightboxOverlay.style.display = "flex"; // Affiche la lightbox
    lightboxImage.src = originalSrc; // Charge l'image originale
    lightboxTitle.textContent = photo.alt || "Photo"; // Définit le titre
    lightboxCategory.textContent = category || ""; // Définit la catégorie
    document.body.classList.add("no-scroll"); // Ajoute la classe pour désactiver le scroll
  }

// Met à jour la lightbox pour une nouvelle photo
  function updateLightbox() {
    const photos = getPhotos(); // Récupère les photos actuelles
    const newPhoto = photos[currentPhotoIndex]; // Photo actuelle
    const category = newPhoto.dataset.category; // Récupère la catégorie
    const originalSrc = newPhoto.src.replace(/-\d+x\d+(.\w+)$/, "$1"); // Remplace les dimensions
    lightboxImage.src = originalSrc; // Charge l'image originale
    lightboxTitle.textContent = newPhoto.alt || "Photo"; // Définit le titre
    lightboxCategory.textContent = category || ""; // Définit la catégorie
  }

  // Gestionnaire d'événements délégué pour ouvrir la lightbox
  document.body.addEventListener("click", function (e) {
    const icon = e.target.closest(".icon-lightbox");
    if (icon) {
      e.preventDefault(); // Empêche le comportement par défaut
      const photos = getPhotos(); // Récupère les photos actuelles
      currentPhotoIndex = Array.from(photos).findIndex((photo) =>
        photo.closest(".photo-item").contains(icon)
      ); // Trouve l'index de la photo associée
      if (currentPhotoIndex !== -1) {
        showLightbox(photos[currentPhotoIndex]);
      }
    }
  });

  // Ferme la lightbox
  function closeLightbox() {
    lightboxOverlay.style.display = "none"; // Masque la lightbox
    document.body.classList.remove("no-scroll"); // Retire la classe pour réactiver le scroll
    lightboxImage.src = ""; // Vide l'image
    lightboxTitle.textContent = ""; // Vide le titre
    lightboxCategory.textContent = ""; // Vide la catégorie
  }

  // Bouton de fermeture
  closeButton.addEventListener("click", closeLightbox);

// Fermeture en cliquant en dehors de l'image
  lightboxOverlay.addEventListener("click", function (e) {
    if (e.target === lightboxOverlay) {
      closeLightbox();
    }
  });

  // Navigation vers la photo précédente
  prevButton.addEventListener("click", function () {
    const photos = getPhotos(); // Récupère les photos actuelles
    currentPhotoIndex = (currentPhotoIndex - 1 + photos.length) % photos.length; // Reculer
    updateLightbox();
  });

  // Navigation vers la photo suivante
  nextButton.addEventListener("click", function () {
    const photos = getPhotos(); // Récupère les photos actuelles
    currentPhotoIndex = (currentPhotoIndex + 1) % photos.length; // Avancer
    updateLightbox();
  });
});

