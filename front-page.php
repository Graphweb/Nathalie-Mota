<?php
get_header(); 
?>
<!-- // Ajouter le Hero Banner // -->

<section class="hero-banner" style="background-image: url('<?php echo get_random_hero_image(); ?>');">
    <div class="hero-content">
        <h1>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero-banner.png" alt="Bienvenue sur notre site">
        </h1>
    </div>
</section>


<!-- // Ajouter le filtre // -->
<div class="select-0">
    <div class="select-1">
        <select id="categorie" name="categorie" data-placeholder="CATÉGORIES">
    
            <option value="" selected hidden>CATÉGORIES</option>
            <?php
            // Récupérer les catégories dynamiquement
            $categories = get_terms(array(
                'taxonomy' => 'categorie', 
                'hide_empty' => true, // Afficher uniquement les catégories utilisées
            ));
            foreach ($categories as $categorie) {
                echo '<option value="' . esc_attr($categorie->slug) . '">' . esc_html($categorie->name) . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="select-2">
        <select id="format" name="format" data-placeholder="FORMATS">
            <option value="" selected hidden>FORMATS</option>
                <?php
                // Récupérer les formats dynamiquement
                    $formats = get_terms(array(
                        'taxonomy' => 'format', // Votre taxonomie personnalisée
                        'hide_empty' => true, // Afficher uniquement les formats utilisés
                    ));
                    foreach ($formats as $format) {
                        echo '<option value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</option>';
                    }
                ?>
        </select>
    </div>
    <div class="select-3">
        <select id="ordre" name="ordre" data-placeholder="TRIER PAR">
            <option value="" selected hidden>TRIER PAR</option>
            <option value="desc">À partir des plus récentes</option>
            <option value="asc">À partir des plus anciennes</option>
        </select>
    </div>
</div>
<!-- // LISTE DES PHOTOS // -->
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






