<!DOCTYPE html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </nav>
</header>