<?php get_header();?>


<?php
    $old_events = new WP_Query(array(
        'post_per_page' => -1,
        'post_type' => 'old_events',
    ));

while($old_events->have_posts()){
        $old_events->the_post();?>
<div class="events container">
    <div class="events__body">
        <div class="events__item">
            <div class="events__title">
                <?php the_title(); ?>
            </div>
            <div class="row">
                <div class="row__item">
                    <div class="events__photo">
                        <?php the_post_thumbnail(); ?>
                    </div>
                </div>
                <div class="row__item">
                    <div class="events__text">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <div class="events__date">
                <span class="events__date-text">Date of Event:</span>
                <?php echo get_post_meta($post -> ID, '_event_date', true); ?>
            </div>
        </div>
    </div>
    <a href="<?php echo site_url('/old_events') ?>" class="">Old Events</a>
</div>
<div class="calendar container">

    <!-- <?php
    the_widget( 'WP_Widget_Calendar' );}
    ?> -->

</div>

<?php
wp_reset_postdata();
echo get_calendar();
?>


<?php get_footer(); ?>