<?php
get_header(); 

// Ajouter le Hero Banner //
?>
<section class="hero-banner" style="background-image: url('<?php echo get_random_hero_image(); ?>');">
    <div class="hero-content">
        <h1>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero-banner.png" alt="Bienvenue sur notre site">
        </h1>
    </div>
</section>

<?php
// Boucle pour afficher les photos //
$args = array(
    'post_type'      => 'photo',
    'posts_per_page' => 8,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'paged'          => 1,  // Initialisation de la page à 1
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    echo '<div class="photo-gallery">';
    while ($query->have_posts()) : $query->the_post(); ?>
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
    <?php endwhile;
    echo '</div>';
    echo '<button id="load-more-photos" data-page="2">Charger plus</button>'; // Le bouton "Charger plus" avec la page suivante
    wp_reset_postdata();
else :
    echo '<p>Aucune photo trouvée.</p>';
endif;

get_footer();
?>






