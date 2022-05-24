<?php get_header();?>


<?php

while(have_posts()){
    the_post();?>
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
                <?php
                $date = get_post_meta($post -> ID, '_event_date', true);
                 echo $date; 
                ?>
                <div class="post__date" data-date="<?php $date; ?>"></div>
                <?php
                // $date = '1233';
                
                ?>

            </div>
        </div>
    </div>


    <div class="commentlist">

        <?php
$args = array(
);
?>
        <?php      comment_form( $args );
        $comments = get_comments(array(
        'post_id' => get_the_ID(),
        'status' => 'approve',

        ));
        
        wp_list_comments(array(
        'per_page' => -1,
        'reverse_top_level' => false,
        ), $comments);

        ?>
    </div>

</div>

<?php 
}
wp_reset_postdata(); ?>

<?php get_footer();  

?>