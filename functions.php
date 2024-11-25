<?php
function mon_theme_enqueue_styles() {
    // Charger le style du thème parent
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_styles');


// Logo personnalisé
add_theme_support('custom-logo');

// Menu personnalisé
register_nav_menus(array(
    'header-menu' => __('Menu Principal'),
));

