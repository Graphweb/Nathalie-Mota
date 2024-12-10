<?php get_header(); ?>
     

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<article class="post">
    <h2><?php the_title(); ?></h2>
    <?php 
    // Vérifie si ACF est actif
if (function_exists('get_field')) {
    // Récupère la valeur d'un champ personnalisé
    $reference = get_field('reference'); 
    // Affiche la référence si disponible
    if (!empty($reference)) {
        echo '<p><strong>Référence :</strong> ' . esc_html($reference) . '</p>';
    }
}
    // Récupérer les taxonomies
    $categories = get_the_terms(get_the_ID(), 'categorie');
    if ($categories && !is_wp_error($categories)) {
        echo '<p><strong>Catégorie :</strong> ';
        foreach ($categories as $category) {
            echo esc_html($category->name) . ' ';
        }
        echo '</p>';
    }
    // Récupérer les taxonomies
    $formats = get_the_terms(get_the_ID(), 'format');
    if ($formats && !is_wp_error($formats)) {
        echo '<p><strong>Format :</strong> ';
        foreach ($formats as $format) {
            echo esc_html($format->name) . ' ';
        }
        echo '</p>';
    }
   
// Vérifie si ACF est actif
if (function_exists('get_field')) {
    // Récupère la valeur d'un champ personnalisé
    $type = get_field('type'); // Remplacez 'type' par le nom exact du champ

    // Affiche le type si disponible
    if (!empty($type)) {
        echo '<p><strong>Type :</strong> ' . esc_html($type) . '</p>';
    }
}

    ?>
     <p><strong>Année :</strong> <?php echo get_the_date('Y'); ?></p>
     <p>Cette photo vous intéresse ?</p>
</article>
<?php endwhile; endif; ?>

<?php
// Afficher l'image mise en avant
if (has_post_thumbnail()) {
    the_post_thumbnail();
} 

get_footer(); ?>

