// La modale
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

//* *************************************** */
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


//  Menu burger pour la version mobile 
document.getElementById('burger-toggle').addEventListener('click', function() {
    document.getElementById('burger-menu').style.display = 'block';
});

document.getElementById('close-menu').addEventListener('click', function() {
    document.getElementById('burger-menu').style.display = 'none';
});

// Ajouter un événement pour fermer le menu et retourner à la page d'accueil lorsque l'on clique sur un lien
var links = document.querySelectorAll('.burger-links a');
links.forEach(function(link) {
    link.addEventListener('click', function() {
        window.location.href = '<?php echo home_url(); ?>';  // Redirige vers la page d'accueil
    });
});

