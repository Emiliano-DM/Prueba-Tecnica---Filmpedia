
<!DOCTYPE html><html>
    <head>
        <?php wp_head(); ?>
    </head>
    <body>
        <!-- Header Section -->
        <div class="page-container">
            <div class="header-wrapper">
                <div class="header-square"></div>
                <div>
                    <h1 class="header-title">Recomanacions</h1>
                </div>
            </div>
            <div class="header-line-short"></div>
            <div class="header-line-full"></div>
            <p class="header-subtitle">Films que et recomanem per a tractar el tema</p>
        </div>

        <!-- Movies Container -->
        <div class="movies-container">
            <?php
            $args = array(
                'post_type' => 'peliculas',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'ASC'
            );
            $movie_query = new WP_Query($args);

            // Collect all posts first
            $all_movies = array();
            if ( $movie_query->have_posts() ) :
                while( $movie_query->have_posts()) : $movie_query->the_post();
                    $all_movies[] = array(
                        'id' => get_the_ID(),
                        'title' => get_the_title(),
                        'image' => get_field('imatge_de_fons'),
                        'edad' => get_field('edad'),
                        'descripcion' => get_field('descripcion'),
                        'ludic' => get_field('ludic'),
                        'cultural' => get_field('cultural'),
                        'educatiu' => get_field('educatiu'),
                        'artistic' => get_field('artistic'),
                        'terms' => get_the_terms(get_the_ID(), 'etiquetas'),
                        'ambits' => get_field('ambits')
                    );
                endwhile;
                wp_reset_postdata();
            endif;

            // Now render the cards with proper structure
            if (!empty($all_movies)) :
                $hero = $all_movies[0];
                $small_cards = array_slice($all_movies, 1);
            ?>

            <!-- Hero Card - Full Width -->
            <div class="hero-card" style="background-image:url(<?php echo esc_url($hero['image']); ?>);">
                <!-- Dark Gradient Overlay -->
                <div class="hero-gradient"></div>

                <!-- Age Badge -->
                <div class="hero-age-badge">
                    <?php echo esc_html($hero['edad']); ?>
                </div>

                <!-- Content - Left Side -->
                <div class="hero-content">
                    <div class="hero-content-inner">
                        <!-- Category -->
                        <span class="category-badge">Recomanació</span>

                        <!-- Title -->
                        <h2 class="hero-title">
                            <?php echo esc_html($hero['title']); ?>
                        </h2>

                        <!-- Tags -->
                        <?php if ($hero['terms']) : ?>
                            <div class="tags-container">
                                <?php foreach ($hero['terms'] as $term) : ?>
                                    <span class="tag">#<?php echo esc_html($term->name); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Description -->
                        <p class="hero-description">
                            <?php echo esc_html($hero['descripcion']); ?>
                        </p>

                        <!-- Ratings and Ambits Flex Container -->
                        <div class="hero-meta-container">
                            <!-- Valoració Section -->
                            <div>
                                <div class="valoracio-section">
                                    <span class="valoracio-title">Valoració</span>
                                    <div class="info-icon">
                                        <span>i</span>
                                    </div>
                                </div>

                                <div class="rating-bars">
                                    <div class="rating-row">
                                        <span class="rating-label">Lúdic</span>
                                        <div class="rating-bar-container">
                                            <div class="rating-bar-fill" style="width: <?php echo esc_attr($hero['ludic']); ?>%;"></div>
                                        </div>
                                    </div>
                                    <div class="rating-row">
                                        <span class="rating-label">Cultural</span>
                                        <div class="rating-bar-container">
                                            <div class="rating-bar-fill" style="width: <?php echo esc_attr($hero['cultural']); ?>%;"></div>
                                        </div>
                                    </div>
                                    <div class="rating-row">
                                        <span class="rating-label">Educatiu</span>
                                        <div class="rating-bar-container">
                                            <div class="rating-bar-fill" style="width: <?php echo esc_attr($hero['educatiu']); ?>%;"></div>
                                        </div>
                                    </div>
                                    <div class="rating-row">
                                        <span class="rating-label">Artístic</span>
                                        <div class="rating-bar-container">
                                            <div class="rating-bar-fill" style="width: <?php echo esc_attr($hero['artistic']); ?>%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ambits Section -->
                            <?php if ($hero['ambits']) : ?>
                            <div>
                                <div class="ambits-section">
                                    <span class="ambits-title">Àmbits</span>
                                </div>
                                <div class="ambits-grid">
                                    <?php foreach ($hero['ambits'] as $ambit) : ?>
                                        <span class="ambit-item"><?php echo esc_html($ambit); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Small Cards Grid -->
            <?php if (!empty($small_cards)) : ?>
                <div class="cards-grid">
                    <?php foreach ($small_cards as $card) : ?>
                        <div class="small-card" style="background-image:url(<?php echo esc_url($card['image']); ?>);">
                            <!-- Gradient Overlay -->
                            <div class="small-card-gradient"></div>

                            <!-- Age Badge -->
                            <div class="small-card-age-badge">
                                <?php echo esc_html($card['edad']); ?>
                            </div>

                            <!-- Content -->
                            <div class="small-card-content">
                                <!-- Top Section - Default Visible -->
                                <div class="small-card-default-content">
                                    <span class="category-badge">Recomanació</span>
                                    <h3 class="small-card-title">
                                        <?php echo esc_html($card['title']); ?>
                                    </h3>
                                    <?php if ($card['terms']) : ?>
                                        <div class="small-card-tags">
                                            <?php foreach ($card['terms'] as $term) : ?>
                                                <span class="tag">#<?php echo esc_html($term->name); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Bottom Section - Hover Content -->
                                <div class="small-card-hover-content">
                                    <!-- Description -->
                                    <p class="small-card-description">
                                        <?php echo esc_html($card['descripcion']); ?>
                                    </p>

                                    <!-- Valoració and Temes Flex Container -->
                                    <div class="small-card-meta">
                                        <!-- Valoració Section -->
                                        <div class="small-card-valoracio">
                                            <div class="valoracio-section">
                                                <span class="valoracio-title">Valoració</span>
                                                <div class="info-icon">
                                                    <span>i</span>
                                                </div>
                                            </div>

                                            <div class="rating-bars">
                                                <div class="rating-row">
                                                    <span class="rating-label">Lúdic</span>
                                                    <div class="rating-bar-container">
                                                        <div class="rating-bar-fill" style="width: <?php echo esc_attr($card['ludic']); ?>%;"></div>
                                                    </div>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="rating-label">Cultural</span>
                                                    <div class="rating-bar-container">
                                                        <div class="rating-bar-fill" style="width: <?php echo esc_attr($card['cultural']); ?>%;"></div>
                                                    </div>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="rating-label">Educatiu</span>
                                                    <div class="rating-bar-container">
                                                        <div class="rating-bar-fill" style="width: <?php echo esc_attr($card['educatiu']); ?>%;"></div>
                                                    </div>
                                                </div>
                                                <div class="rating-row">
                                                    <span class="rating-label">Artístic</span>
                                                    <div class="rating-bar-container">
                                                        <div class="rating-bar-fill" style="width: <?php echo esc_attr($card['artistic']); ?>%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Temes Section -->
                                        <?php if ($card['ambits']) : ?>
                                        <div class="small-card-temes">
                                            <div class="ambits-section">
                                                <span class="ambits-title">Temes</span>
                                            </div>
                                            <div class="ambits-list">
                                                <?php foreach ($card['ambits'] as $ambit) : ?>
                                                    <span class="ambit-item"><?php echo esc_html($ambit); ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php else: ?>
                <div class="no-movies">
                    <p>No s'han trobat pel·lícules. Si us plau, afegeix pel·lícules des de l'administració de WordPress.</p>
                </div>
            <?php endif; ?>

        </div>


        <?php wp_footer(); ?>
    </body>
</html>
