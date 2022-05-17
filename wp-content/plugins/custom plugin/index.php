<?php
/*
Plugin name: Custom PLugin
*/


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




/*================================*/

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

/*========================================================*/

add_shortcode('old_events_shortcode','shortCodeFunction');
function setShortcode() {
?>
<form method="post" style="margin: 20px;">
    <label for="numberpost">Enter number of posts</label>
    <input type="number" value="1" name="numberpost"><br><br>
    <label for="importance">Enter the importance of events</label>
    <input type="number" value="5" name="importance" placeholder="5" max="5">
    <input type="submit" name="submit" value="Generate shortcode">
</form>
<?php
    $numberpost = $_POST['numberpost'];
    $importance = $_POST['importance'];
    ?>

<p>Copy this after click on button:</p>[old_events_shortcode importance="<?php echo $importance?>"
numberposts="<?php echo $numberpost?>"]<?php }?>
<?php
 global $atts;
 function shortCodeFunction($atts) {
     $atts = shortcode_atts( array(
		'importance' => '5',
		'numberposts' => 5,
	), $atts );
    
    $oldposts = new WP_Query(array(
    'posts_per_page' => $atts['numberposts'],
    'importance'     => $atts['importance'],
    'post_type'      => 'old_events',
    'paged'          => 1
 ));
 
 
 
 while($oldposts -> have_posts()) {
     $oldposts -> the_post();?>

<div class="events__item">
    <div class="events__title">
        <a class="events__title-link" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>

        </a>
    </div>
    <div class="row">
        <div class="row__item">
            <div class="events__photo">
                <?php the_post_thumbnail(); ?>
            </div>
        </div>
        <div class="row__item">
            <div class="events_excerpt">
                <?php if(has_excerpt()){
                            echo get_the_excerpt();
                        }else{
                            echo wp_trim_words(get_the_content(), 18);
                        }?>
                <a href="<?php the_permalink(); ?>" class="read__more-link">Read More</a>
            </div>
        </div>

    </div>

</div>
<?php
    
     

};

}
add_action( 'admin_menu', 'my_plugin_page');
function my_plugin_page() {
    add_menu_page( 'MS Settings', 'Shortcode Settings', 'manage_options', 'mymenu', 'setShortcode','dashicons-shortcode',4);
}
?>