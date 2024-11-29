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

// Enregistrer un menu pour le header et footer
register_nav_menus(array(
    'header-menu' => __('Menu Principal'),
    'footer-menu' => __('Menu Footer'),
));

