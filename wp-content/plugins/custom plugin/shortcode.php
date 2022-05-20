<?php

add_shortcode('old_events_shortcode','shortCodeFunction');
function setShortcode() {
?>
<form method="post" style="margin-top: 20px;">
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
add_action( 'admin_menu', 'shortcode_page' );
function shortcode_page() {
    add_menu_page( 'MS Settings', 'Shortcode Settings', 'manage_options', 'mymenu', 'setShortcode','dashicons-shortcode',4);
}