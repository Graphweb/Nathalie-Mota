
<div class="related-photo">
    <a href="<?php the_permalink(); ?>">
        <article class="photo-item">
    <div class="photo-wrapper">
    <?php 
    // Récupère les catégories
    $categories = get_the_terms(get_the_ID(), 'categorie'); // Remplace 'categorie' par le slug de ta taxonomie.
                if (has_post_thumbnail()) {
                    // Ajout de `data-category` directement à l'image
                    the_post_thumbnail('original', [
                        'class' => 'photo-thumbnail', 
                        'data-category' => !empty($categories) ? esc_attr($categories[0]->name) : 'Non catégorisé'
                    ]);
                } else {
                    echo '<img src="' . get_stylesheet_directory_uri() . '/Images/placeholder.jpg" alt="Image non disponible" class="photo-thumbnail" data-category="' . (!empty($categories) ? esc_attr($categories[0]->name) : 'Non catégorisé') . '">';
                }
                ?>
        <div class="photo-overlay">
            <div class="photo-info2">
                <h3 class="photo-title2"><?php the_title(); ?></h3>
                <p class="photo-category2">
                    <?php 
                    $categories = get_the_terms(get_the_ID(), 'categorie');
                    if ($categories) {
                        echo esc_html($categories[0]->name); // Affiche la première catégorie
                    }
                    ?>
                </p>
            </div>
            <div class="photo-icons">
                <!-- Icône pour aller à la page single-photo.php -->
                <a href="<?php the_permalink(); ?>" class="icon icon1 icon-view" aria-label="Voir la page">
                    <i class="fas fa-eye"></i>
                </a>
                <!-- Icône pour ouvrir la lightbox -->
                <a href="#" class="icon icon2 icon-lightbox" data-photo-id="<?php echo get_the_ID(); ?>" aria-label="Voir dans la lightbox">
                    <i class="fas fa-expand"></i>
                </a>
            </div>
        </div>
    </div>
</article>
    </a>
</div>