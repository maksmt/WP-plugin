<?php
add_action('wp_enqueue_scripts', 'plugin_scripts');


function plugin_scripts(){
wp_enqueue_style('plugin-style', get_stylesheet_uri());
wp_deregister_script('jquery');
wp_register_script('jquery','https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js');
wp_enqueue_script('jquery');

wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
wp_enqueue_script('plugin-scripts' , get_template_directory_uri() . '/js/script.js',array(), null , true);

wp_enqueue_script( 'true_loadmore' );
wp_enqueue_script('jscustom'); // I assume you registered it somewhere else
wp_localize_script('true_loadmore', 'misha', array(
        'nonce' => wp_create_nonce('wp_rest'),
        'root_url' => get_site_url(),
));
wp_enqueue_script( 'plugin-scripts' );

wp_localize_script( 'plugin-scripts', 'more', array( 'ajaxurl' => admin_url( 'admin-ajax.php') , 'root_url'=> get_site_url(),'nonce' => wp_create_nonce('wp_rest'),  ));


};

add_theme_support('widgets');

