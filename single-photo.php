<?php get_header(); ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<article class="post">
    
    
    <div class="photo-meta">
    <h1><?php the_title(); ?></h1>
    

       <?php 
        // Afficher la référence
        if (function_exists('get_field') && $reference = get_field('reference')) {
            echo '<p><strong>Référence :</strong> ' . esc_html($reference) . '</p>';
        }
        // Afficher les catégories
        if ($categories = get_the_terms(get_the_ID(), 'categorie')) {
            echo '<p><strong>Catégorie :</strong> ';
            echo implode(', ', wp_list_pluck($categories, 'name'));
            echo '</p>';
        }
        // Afficher les formats
        if ($formats = get_the_terms(get_the_ID(), 'format')) {
            echo '<p><strong>Format :</strong> ';
            echo implode(', ', wp_list_pluck($formats, 'name'));
            echo '</p>';
        }
        // Afficher le type
        if (function_exists('get_field') && $type = get_field('type')) {
            echo '<p><strong>Type :</strong> ' . esc_html($type) . '</p>';
        }
        ?>
        <p><strong>Année :</strong> <?php echo get_the_date('Y'); ?></p>
    </div>
     <!-- Afficher la photo -->
    <div class="photo-image">
        <?php 
        if (has_post_thumbnail()) {
            the_post_thumbnail('original', ['class' => 'photo-display']);
        } 
        ?>
    </div>
</article>
<section class="pagination-btn">
    <div class="info">
        <p>Cette photo vous intéresse ?</p>
        <button id="contact-button" class="btn-contact">Contact</button>
    </div>

    <!-- Popup contact -->
    <div id="popup" class="popup hidden">
        <div class="popup-content">
            <span class="popup-close">&times;</span>
            <img src="<?php echo get_stylesheet_directory_uri() . '/images/contact-header.png'; ?>" alt="Mot contact répété en boucle">
            <form>
                <label for="name">NOM :</label>
                <input type="text" id="name" name="name" autocomplete="name" required>
                <label for="email">E-MAIL :</label>
                <input type="email" id="email" name="email" autocomplete="email" required>
                <label for="ref-photo">REF. PHOTO :</label>
                <input type="text" id="ref-photo" readonly>
                <label for="message">MESSAGE :</label>
                <textarea id="message" rows="4"></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
    </section>
    <!-- Navigation entre les photos -->
    <section class="photo-navigation">
    <!-- Lien pour la photo précédente -->
    <div class="prev-photo">
        <?php 
        $prev_post = get_previous_post(true, '', 'categorie'); 
        if (!empty($prev_post)) : ?>
            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-link prev-link">
                <span class="arrow">←</span>
                <div class="thumbnail-hover">
                    <?php echo get_the_post_thumbnail($prev_post->ID, 'thumbnail', ['class' => 'hover-thumbnail']); ?>
                </div>
            </a>
        <?php endif; ?>
    </div>

    <!-- Lien pour la photo suivante -->
    <div class="next-photo">
        <?php 
        $next_post = get_next_post(true, '', 'categorie'); 
        if (!empty($next_post)) : ?>
            <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-link next-link">
                <span class="arrow">→</span>
                <div class="thumbnail-hover1">
                    <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail', ['class' => 'hover-thumbnail']); ?>
                </div>
            </a>
        <?php endif; ?>
    </div>
</section>


<!-- Section des photos apparentées -->
<section class="related-photos">
    <h2>VOUS AIMEREZ AUSSI</h2>
    <div class="related-photos-gallery">
        <?php
        // Afficher les photos apparentées
        $related_args = array(
            'post_type' => 'photo',
            'posts_per_page' => 2,
            'post__not_in' => array(get_the_ID()),
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field'    => 'id',
                    'terms'    => wp_list_pluck($categories, 'term_id'),
                ),
            ),
        );
        $related_query = new WP_Query($related_args);
        if ($related_query->have_posts()) :
            while ($related_query->have_posts()) : $related_query->the_post();
                get_template_part('templates_part/photo_block');
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Aucune photo apparentée trouvée.</p>';
        endif;
        ?>
    </div>
</section>


<?php endwhile; endif; ?>

<?php get_footer(); ?>


