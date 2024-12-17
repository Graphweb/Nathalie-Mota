<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    /* ************ POUR RELIER LE CSS ET JS DU THÈME ENFANT ************* */
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style.css', array());
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/js/script.js', array(), false, true);
}

 /* ************ ACTIVER LE SUPPORT DU LOGO PERSONNALISÉ ************** */
 add_theme_support('custom-logo', array(
    'height'      => 22,
    'width'       => 345,
    'flex-height' => true,
    'flex-width'  => true,
));

/* **************** INCLURE JQUERY DEPUIS WORDPRESS (il est déjà intégré par défaut) ************* */
function custom_enqueue_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');


/* ********* ENREGISTRER UN MENU POUR LE HEADER ET FOOTER ********** */
register_nav_menus(array(
    'header-menu' => __('Menu Principal'),
    'footer-menu' => __('Menu Footer'),
));

/* ************ HERO AVEC LE SCRIPT DE CHARGEMENT D’UNE IMAGE ALÉATOIRE **************** */
function get_random_hero_image() {
    $upload_dir = wp_get_upload_dir(); // Récupère le répertoire des uploads
    $base_url = $upload_dir['baseurl']; // URL de base du dossier uploads

    // URLs des images
    $images = array(
        $base_url . '/2024/12/nathalie-0-scaled.jpeg',
        $base_url . '/2024/12/nathalie-1-scaled.jpeg',
        $base_url . '/2024/12/nathalie-9-scaled.jpeg',
        $base_url . '/2024/12/nathalie-11-scaled.jpeg',
    );

    // Retourne une image aléatoire
    return $images[array_rand($images)];
}

/* **************** AJAX BOUTON CHARGER PLUS *********************** */
function load_more_photos() {
    // Vérification de la sécurité avec un nonce
    if (!isset($_GET['page']) || !isset($_GET['posts_per_page'])) {
        wp_send_json_error();
    }

    // Paramètres de la requête AJAX
    $page = intval($_GET['page']);
    $posts_per_page = intval($_GET['posts_per_page']);

    // Arguments de la requête WP_Query
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    // Nouvelle requête pour charger les photos supplémentaires
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
            <article class="photo-item">
                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                    <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('medium', ['class' => 'photo-thumbnail']);
                    } else {
                        echo '<img src="' . get_stylesheet_directory_uri() . '/images/placeholder.jpg" alt="Image non disponible" class="photo-thumbnail">';
                    }
                    ?>
                </a>
            </article>
            <?php
        endwhile;
    else :
        echo ''; // Si aucune photo n'est trouvée, renvoyer rien
    endif;

    wp_reset_postdata(); // Réinitialiser la requête

    die(); // Terminer l'exécution de la requête AJAX
}

// Enregistrer l'action AJAX
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');


/* ************** SCRIPT POUR APPELER AJAX ************* */

function enqueue_load_more_script() {
    wp_enqueue_script('load-more-photos', get_template_directory_uri() . '', array('jquery'), null, true);

    // Localiser le script pour ajouter la variable ajaxurl
    wp_localize_script('load-more-photos', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_load_more_script');



/* ****** RÉPONDRE AUX REQUÊTES AJAX DÉCLENCHÉES PAR LES FILTRES ***** */

function filter_photos() {
    // Récupère les valeurs des filtres envoyées via Ajax
    $categorie = isset($_GET['categorie']) ? sanitize_text_field($_GET['categorie']) : '';
    $format = isset($_GET['format']) ? sanitize_text_field($_GET['format']) : '';
    $ordre = isset($_GET['ordre']) ? sanitize_text_field($_GET['ordre']) : 'DESC';

    // Arguments pour WP_Query
    $args = [
        'post_type'      => 'photo', // Type de contenu
        'posts_per_page' => -1,      // Charger toutes les photos
        'orderby'        => 'date', // Tri par date
        'order'          => $ordre, // Ordre ASC ou DESC
    ];

    // Filtrer par catégorie (taxonomie)
    if (!empty($categorie)) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie', 
            'field'    => 'slug',
            'terms'    => $categorie,
        ];
    }

    // Filtrer par format (autre taxonomie)
    if (!empty($format)) {
        $args['tax_query'][] = [
            'taxonomy' => 'format', 
            'field'    => 'slug',
            'terms'    => $format,
        ];
    }

    // Requête WP_Query
    $query = new WP_Query($args);

    // Génération du contenu à afficher
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post(); ?>
            <article class="photo-item">
                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                    <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('medium', ['class' => 'photo-thumbnail']);
                    } else {
                        echo '<img src="' . get_stylesheet_directory_uri() . '/Images/placeholder.jpg" alt="Image non disponible" class="photo-thumbnail">';
                    }
                    ?>
                </a>
            </article>
<?php }
    } else {
        echo ''; // Aucun contenu trouvé
    }

    wp_reset_postdata();
    wp_die(); // Terminer la requête Ajax
}

// Actions Ajax pour les utilisateurs connectés et non-connectés
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');


