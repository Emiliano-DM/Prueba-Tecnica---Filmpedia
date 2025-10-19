
<!DOCTYPE html><html>
    <head><?php wp_head(); ?></head>
    <body> 
        <div class="header-section">
        <h1>Recomanacions</h1>
        <p class="subtitle">Films que et recomanem per a tractar el tema</p>
        </div>
        <div class="movies-grid">
            <?php if ( have_posts() ) : while( have_posts()) : the_post();?>
                <div class="movie-card">
                    <h2><?php the_title(); ?></h2>
                    <?php if(has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php endif; ?>
                    <p><strong>Título:</strong> <?php the_field('titulo'); ?></p>
                    <p><strong>Edad:</strong> <?php the_field('edad'); ?></p>
                    <p><strong>Descripción:</strong> <?php the_field('descripcion'); ?></p>
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'etiquetas');
                    if ($terms) {
                        echo '<div class="tags">';
                        foreach ($terms as $term) {
                            echo '<span class="tag">#' . $term->name . ' </span>';
                        }
                        echo '</div>';
                    }
                    ?>
                    <div class="rating-bar">
                        <span>Lúdic:</span>
                        <div class="bar"><div class="fill" style="width: <?php the_field('ludic'); ?>%"></div></div>
                    </div>
                    <div class="rating-bar">
                        <span>Cultural:</span>
                        <div class="bar"><div class="fill" style="width: <?php the_field('cultural'); ?>%"></div></div>
                    </div>
                    <div class="rating-bar">
                        <span>Educatiu:</span>
                        <div class="bar"><div class="fill" style="width: <?php the_field('educatiu'); ?>%"></div></div>
                    </div>
                    <div class="rating-bar">
                        <span>Artístic:</span>
                        <div class="bar"><div class="fill" style="width: <?php the_field('artistic'); ?>%"></div></div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
            
        </div>
        <?php wp_footer(); ?>
    </body>
</html>
