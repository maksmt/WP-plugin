<?php get_header();?>


<?php
    $old_events = new WP_Query(array(
        'post_per_page' => -1,
        'post_type' => 'old_events',
        'paged' => $paged
    ));

while($old_events->have_posts()){
        $old_events->the_post();?>
<div class="events container">
    <div class="events__body " id="ajax-posts">
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

            <div class="events__date">
                <span class="events__date-text">Date of Event:</span>
                <?php echo get_post_meta($post -> ID, '_event_date', true); ?>
            </div>
        </div>
    </div>
</div>
<div class="paginate__links container">
    <?php echo paginate_links();?>
</div>
<div class="loadmore container">

    <?php
global $wp_query;
 
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$max_pages = $wp_query->max_num_pages;
 
if( $paged < $max_pages ) {
	echo '<div id="loadmore" style="text-align:center;">
		<a href="" data-max_pages="' . $max_pages . '" data-paged="' . $paged . '" class="button">Load more </a>
	</div>';
}
?>
</div>
<?php
}

wp_reset_postdata();
?>



<?php get_footer(); 
?>