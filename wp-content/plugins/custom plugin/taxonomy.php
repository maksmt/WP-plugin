<?php


add_action('init', 'regTaxonomy');

function regTaxonomy() {
    $args = array(
        'labels' => array(
            'name' => 'Importance',
            'menu_name' => 'Importance',
            'singular_name' => 'Importance',
            'menu_name' => 'Importance',
        ),
        'hierarchical' => true,
        'public' => true,
        'capabilities'      => array(
            'assign_terms' => 'manage_options',
            'edit_terms'   => 'god',
            'manage_terms' => 'god',
        ),
        'show_in_nav_menus' => false,
  
    );
    register_taxonomy('importance', '',$args);
    register_taxonomy_for_object_type( 'importance', 'old_events');
}