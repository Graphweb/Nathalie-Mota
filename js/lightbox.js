document.addEventListener("DOMContentLoaded", function () {
  const lightboxOverlay = document.getElementById("lightbox-overlay");
  const lightboxImage = document.querySelector(".lightbox-image");
  const lightboxTitle = document.querySelector(".lightbox-title");
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
    const originalSrc = photo.src.replace(/-\d+x\d+(\.\w+)$/, "$1"); // Remplace les dimensions par l'original
    lightboxImage.src = originalSrc; // Charge l'image originale
    const category = photo.dataset.category; // Récupère la catégorie
    lightboxOverlay.style.display = "flex"; // Affiche la lightbox
    lightboxImage.src = photo.src; // Charge la source de l'image
    lightboxTitle.textContent = photo.alt || "Photo"; // Définit le titre
    document.querySelector(".lightbox-category").textContent = category || ""; // Définit la catégorie
  }

  // Met à jour la lightbox pour une nouvelle photo
  function updateLightbox() {
    const photos = getPhotos(); // Photos actuelles
    const newPhoto = photos[currentPhotoIndex];
    const category = newPhoto.dataset.category;
    lightboxImage.src = newPhoto.src;
    lightboxTitle.textContent = newPhoto.alt || "Photo";
    document.querySelector(".lightbox-category").textContent = category || "";
  }

  // Gestionnaire d'événements délégué pour ouvrir la lightbox
  document.body.addEventListener("click", function (e) {
    const icon = e.target.closest(".icon-lightbox");
    if (icon) {
      e.preventDefault(); // Empêche le comportement par défaut
      const photos = getPhotos(); // Récupère les photos actuelles
      currentPhotoIndex = Array.from(photos).findIndex(
        (photo) => photo.closest(".photo-item").contains(icon)
      ); // Trouve l'index de la photo associée
      if (currentPhotoIndex !== -1) {
        showLightbox(photos[currentPhotoIndex]);
      }
    }
  });

  // Ferme la lightbox
  closeButton.addEventListener("click", function () {
    lightboxOverlay.style.display = "none";
  });

  lightboxOverlay.addEventListener("click", function (e) {
    if (e.target === lightboxOverlay) {
      lightboxOverlay.style.display = "none";
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
