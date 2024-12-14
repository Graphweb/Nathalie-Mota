<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    //POUR RELIER LE CSS ET JS DU THÈME ENFANT //
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style.css', array());
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/js/script.js', array(), false, true);
}

 // Activer le support du logo personnalisé
 add_theme_support('custom-logo', array(
    'height'      => 22,
    'width'       => 345,
    'flex-height' => true,
    'flex-width'  => true,
));

// Inclure jQuery depuis WordPress (il est déjà intégré par défaut)
function custom_enqueue_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');


// Enregistrer un menu pour le header et footer
register_nav_menus(array(
    'header-menu' => __('Menu Principal'),
    'footer-menu' => __('Menu Footer'),
));

// hero avec le script de chargement d’une image aléatoire 
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







