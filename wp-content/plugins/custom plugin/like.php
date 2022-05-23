<?php


add_filter('comment_form_default_fields', 'ip_post_likes');

function ip_post_likes($content) {

if(is_singular('old_events') ){
  
    
    ?>
<ul class="likes">
    <li class="likes__item likes__item--like">
        <a href="<?php echo add_query_arg('post_action', 'like'); ?>">
            Like Event(<?php echo ip_get_like_count('likes') ?>)
        </a>
    </li>
    <li class="likes__item likes__item--dislike">
        <a href="<?php echo add_query_arg('post_action', 'dislike'); ?>">
            Dislike Event(<?php echo ip_get_like_count('dislikes') ?>)
        </a>
    </li>
</ul>
<?php

    return $content;
}
}
    
function ip_get_like_count($type = 'likes') {
    $current_count = get_post_meta(get_the_id(), $type, true);

    return ($current_count ? $current_count : 0);
}

function ip_process_like() {
    $processed_like = false;
    $redirect       = false;
    
    if(is_singular('old_events')) {
        if(isset($_GET['post_action'])) {
            if($_GET['post_action'] == 'like') {
                // Like
                $like_count = get_post_meta(get_the_id(), 'likes', true);

                if($like_count) {
                    $like_count = $like_count + 1;
                }else {
                    $like_count = 1;
                }

                $processed_like = update_post_meta(get_the_id(), 'likes', $like_count);
            }elseif($_GET['post_action'] == 'dislike') {
                // Dislike
                $dislike_count = get_post_meta(get_the_id(), 'dislikes', true);

                if($dislike_count) {
                    $dislike_count = $dislike_count + 1;
                }else {
                    $dislike_count = 1;
                }

                $processed_like = update_post_meta(get_the_id(), 'dislikes', $dislike_count);
            }

            if($processed_like) {
                $redirect = get_the_permalink();
            }
        }
    }

    if($redirect) {
        wp_redirect($redirect);
        die;
    }
}
    

add_action('template_redirect', 'ip_process_like');