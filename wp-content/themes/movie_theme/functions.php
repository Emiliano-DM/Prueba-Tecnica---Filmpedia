<?php
  function movie_theme_enqueue_assets() {
      wp_enqueue_style('main-styles', get_template_directory_uri() . '/dist/assets/main.css');
      wp_enqueue_script('main-scripts', get_template_directory_uri() . '/dist/assets/main.js', array(), null, true);
  }
  add_action('wp_enqueue_scripts', 'movie_theme_enqueue_assets');
  ?>