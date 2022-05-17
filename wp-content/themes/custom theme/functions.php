<?php
add_action('wp_enqueue_scripts', 'plugin_scripts');


function plugin_scripts(){
wp_enqueue_style('plugin-style', get_stylesheet_uri());
// wp_deregister_script('jquery');
// wp_register_script('jquery','https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js');
// wp_enqueue_script('jquery');
wp_enqueue_script('plugin-scripts' , get_template_directory_uri() . '/js/script.js',array(), null , true);
wp_localize_script('main-js', 'pluginData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest'),
));
wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
};

add_theme_support('widgets');



function more_post_ajax(){
    $offset = $_POST["offset"];

     $args = array(
        'post_type' => 'old_events',
         'status' => 'publish',
         'order' => 'ASC',
         'offset' => $offset,
     );

    $loop = new WP_Query($args);
    while ($loop->have_posts()) { $loop->the_post(); 
       the_title();
    }

     exit; 
}

  add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax'); 
  add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

  