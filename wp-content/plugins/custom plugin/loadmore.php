<?php

 

function true_loadmore() {
 
	$paged = ! empty( $_POST[ 'paged' ] ) ? $_POST[ 'paged' ] : 1;
	$paged++;
 
	$args = array(
		'paged' => $paged,
		'post_status' => 'publish',
        'post_type' => 'old_events'
	);
 
	query_posts( $args );
 
	while( have_posts() ) : the_post();
 
?>
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
	endwhile;
 
	die;
}
    add_action( 'wp_ajax_loadmore', 'plugin-scripts' );
    add_action( 'wp_ajax_nopriv_loadmore', 'plugin-scripts' );