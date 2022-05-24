<?php

class deleteCommand{
    public function delete($args, $assoc_args) {
    $importance = $assoc_args['importance'];
    $date = $assoc_args['date'];
    $importance_terms = get_terms([
    'taxonomy' => 'importance',
    'hide_empty' => false
    ]);
    for ($i = 0; $i < $importance; $i++) { $importance_ids=array_map(function($importance){ return $importance->term_id;
        }, $importance_terms);
        $allposts= get_posts( array('post_type'=>'old_events', 'importance'=>$importance) );
        foreach ($allposts as $eachpost) {
        wp_trash_post( $eachpost->ID, true );
        }
    }
    }
}
    
        if (class_exists('WP_CLI')){
        WP_CLI::add_command( 'old_events', 'deleteCommand');
        WP_CLI::success( 'Post(s) deleted');
    
        }