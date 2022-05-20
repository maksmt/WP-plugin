<?php

add_theme_support('post-thumbnails');

function pluginPostType(){
    register_post_type('old_events',array(
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'public' => true,
        'has_archive'=> true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Old Events',
            'add_new_item' => 'Add new Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Old Events',
            'singular_name' => 'Old Events',
        ),
        
        
        
        'menu_icon' => 'dashicons-clipboard',
    ));
};

add_action('init', 'pluginPostType');

function add_post_meta_boxes() {
    add_meta_box(
        "post_metadata_events_post",
        "Event Date",
        "post_meta_box_events_post", 
        "old_events", 

    );
}
add_action( "admin_init", "add_post_meta_boxes" );

function save_post_meta_boxes(){
    global $post;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    update_post_meta( $post->ID, "_event_date", sanitize_text_field( $_POST[ "_event_date" ] ) );
}
add_action( 'save_post', 'save_post_meta_boxes' );

function post_meta_box_events_post(){
    global $post;
    $custom = get_post_custom( $post->ID );
    $fieldData = $custom[ "_event_date" ][ 0 ];
    echo "<input type=\"date\" name=\"_event_date\" value=\"".$fieldData."\" placeholder=\"Event Date\">";
}