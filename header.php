<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <?php wp_head(); ?>
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <?php the_custom_logo(); ?>
        </div>
            <?php wp_nav_menu( array(
            'theme_location' => 'header-menu',
            'menu_class' => 'menu-links',
            'container_class' => 'menu',
            ) );
            ?>
            <!-- Bouton qui ouvre la modale -->
            <button id="myBtn">CONTACT</button>
    </nav>
    <!-- charge la modale -->
    <?php get_template_part('templates_part/modal-contact'); ?>

</header>