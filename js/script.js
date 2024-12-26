/* ****************** MODAL *********************** */

var modal = document.getElementById('contact-modal');

// Le bouton qui ouvre la fenêtre modale
var btn = document.getElementById("myBtn");

// Lien CONTACT pour le menu mobile
var mobileContactLink = document.getElementById("mobileContactLink");

//Récupérez l'élément <span> qui ferme la modale
var span = document.getElementsByClassName("close")[0];

// Lorsque l'utilisateur clique sur le bouton, ouvrez la fenêtre modale
btn.onclick = function() {
    modal.style.display = "block";
}

// Lorsque l'utilisateur clique sur le lien CONTACT (version téléphone)
mobileContactLink.onclick = function(event) {
  event.preventDefault(); // Empêche le comportement par défaut du lien
  modal.style.display = "block";
}

// Lorsque l'utilisateur clique sur <span> (x), fermez la fenêtre modale
span.onclick = function() {
    modal.style.display = "none";
}

// Lorsque l'utilisateur clique n'importe où en dehors de la fenêtre modale, fermez-la
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/* **************** POPUP *********************** */

jQuery(document).ready(function($) {
    // Afficher la popup au clic sur le bouton "Contact"
    $('#contact-button').on('click', function() {
        var reference = $('p:contains("Référence :")').text().replace('Référence :', '').trim();
        $('#ref-photo').val(reference); // Préremplir le champ Réf. PHOTO
        $('#popup').removeClass('hidden');
    });

    // Fermer la popup avec le bouton de fermeture
    $('.popup-close').on('click', function() {
        $('#popup').addClass('hidden');
    });

    // Fermer la popup en cliquant en dehors du contenu
    $(window).on('click', function(event) {
        var popup = $('#popup');
        if (event.target == popup[0]) {
            popup.addClass('hidden'); 
        }
    });
});
/* ******************************* ACTION AJAX CHARGER PLUS *********************************************** */

jQuery(document).ready(function ($) {

    // Bouton charger plus
    $('#load-more-photos').on('click', function () {
        var button = $(this);
        var page = button.data('page'); // Récupère la page suivante
        var data = {
            action: 'load_more_photos', // L'action AJAX
            page: page,
            posts_per_page: 8, // Nombre de photos à charger
        };

        $.ajax({
            url: ajaxurl, // URL pour l'appel AJAX (définie automatiquement par WordPress)
            type: 'GET',
            data: data,
            beforeSend: function () {
                button.text('Chargement...'); // Change le texte du bouton pendant le chargement
            },
            success: function (response) {
                if (response) {
                    // Ajoute les nouvelles photos à la galerie
                    $('.photo-gallery').append(response);
                    button.text('Charger plus'); // Remet le texte du bouton
                    button.data('page', page + 1); // Met à jour la page pour la prochaine requête
                }
            }
        });
    });
});


/* *************** TRAITEMENT DES FILTRES ***************** */
jQuery(document).ready(function ($) {
    // Fonction pour charger les photos en fonction des filtres
    function fetchPhotos() {
      var categorie = $("#categorie").val(); // Récupère la valeur de la catégorie
      var format = $("#format").val(); // Récupère la valeur du format
      var ordre = $("#ordre").val(); // Récupère l'ordre de tri
  
      var data = {
        action: "filter_photos", // Action AJAX que nous allons créer dans functions.php
        categorie: categorie,
        format: format,
        ordre: ordre,
      };
  
      $.ajax({
        url: ajaxurl, // URL pour les requêtes Ajax (localisé dans WordPress)
        type: "GET",
        data: data,
        beforeSend: function () {
          // Avant la requête, afficher un indicateur de chargement
          $(".photo-gallery").html("<p>Chargement des photos...</p>");
        },
        success: function (response) {
          if (response) {
            // Remplace le contenu de la galerie avec les nouvelles photos
            $(".photo-gallery").html(response);
          } else {
            // Si aucune photo n'est trouvée
            $(".photo-gallery").html("<p>Aucune photo trouvée.</p>");
          }
        },
      });
    }
  
    // Déclenche une requête Ajax chaque fois qu'un filtre est changé
    $("#categorie, #format, #ordre").on("change", function () {
      fetchPhotos();
    });
  });
/*********************************************************************** */

              //PARAMETRE SELECT2 //

  jQuery(document).ready(function ($) {
    // Initialiser Select2 sur tous les éléments de filtre
    $("#categorie, #format, #ordre").select2({
        allowClear: true, // Permet de vider la sélection
    });

    // Configurer spécifiquement #format et #ordre pour masquer le champ de recherche
    $("#format, #ordre").select2({
        minimumResultsForSearch: Infinity // Désactive complètement le champ de recherche
    });
});
/***************************************************************************** */


/* ***************** MENU BURGER ******************* */
document.addEventListener('DOMContentLoaded', function () {
  const burgerToggle = document.getElementById('burgerToggle');
  const mobileMenu = document.getElementById('mobileMenu');
  const body = document.body;

  // Ouvrir/fermer le menu mobile et transformer le burger
  burgerToggle.addEventListener('click', function () {
    burgerToggle.classList.toggle('active'); // Transformation en croix
    mobileMenu.classList.toggle('active'); // Affiche/masque le menu
    body.classList.toggle('no-scroll'); // Bloque le scroll
});
});



