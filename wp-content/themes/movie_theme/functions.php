<?php
    function movie_theme_enqueue_assets() {
      $dist_path = get_template_directory() . '/dist/assets';
      $dist_uri = get_template_directory_uri() . '/dist/assets';

      $css_files = glob($dist_path . '/main-*.css');
      $js_files = glob($dist_path . '/main-*.js');

      if (!empty($css_files)) {
          $css_file = basename($css_files[0]);
          wp_enqueue_style('main-styles', $dist_uri . '/' . $css_file);
      }

      if (!empty($js_files)) {
          $js_file = basename($js_files[0]);
          wp_enqueue_script('main-scripts', $dist_uri . '/' . $js_file, array(), null, true);
      }
  }
  add_action('wp_enqueue_scripts', 'movie_theme_enqueue_assets');

  function create_peliculas_cpt() {
    register_post_type('peliculas', array(
        'labels' => array(
            'name' => 'Películas',
            'singular_name' => 'Película'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));
  }
  add_action('init','create_peliculas_cpt');

  function create_etiquetas_taxonomy() {
    register_taxonomy('etiquetas', 'peliculas', array(
        'labels' => array(
            'name' => 'Etiquetas',
            'singular_name' => 'Etiqueta'
        ),
        'hierarchical' => false,
        'show_in_rest' => true,
    ));
  }
  add_action('init', 'create_etiquetas_taxonomy');

  ?>