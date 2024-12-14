/* ****************** MODAL *********************** */

var modal = document.getElementById('contact-modal');

// Le bouton qui ouvre la fenêtre modale
var btn = document.getElementById("myBtn");

//Récupérez l'élément <span> qui ferme la modale
var span = document.getElementsByClassName("close")[0];

// Lorsque l'utilisateur clique sur le bouton, ouvrez la fenêtre modale
btn.onclick = function() {
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
/* **************** ACTION AJAX *********************** */
jQuery(document).ready(function($) {
    $('#load-more-photos').on('click', function() {
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
            beforeSend: function() {
                button.text('Chargement...'); // Change le texte du bouton pendant le chargement
            },
            success: function(response) {
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
