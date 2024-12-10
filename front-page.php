<?php
get_header(); // Inclure l'en-tête

// Boucle pour afficher les photos
$args = array(
    'post_type'      => 'photo',  // Custom Post Type "photo"
    'posts_per_page' => 8,        // Limiter à 8 photos 
);
/* affiche image scf*/
$query = new WP_Query($args);

if ($query->have_posts()) :
    echo '<div class="photo-gallery">';
    while ($query->have_posts()) : $query->the_post(); ?>
        <div class="photo-item">
            <a href="<?php the_permalink(); ?>"> <!-- Lien vers la photo -->
                <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail('medium'); // Affiche l'image mise en avant
                }
                ?>
            </a>
        </div>
    <?php endwhile;
    echo '</div>';
    wp_reset_postdata(); // Réinitialiser la requête principale
else :
    echo '<p>Aucune photo trouvée.</p>';
endif;

get_footer(); ?> 



