<?php
/*
Plugin name: Custom PLugin
*/
add_action( 'admin_init', 'true_plugin_admin_init' );


function true_plugin_admin_init() {

	wp_register_script( 'myscript', plugins_url( 'js/loadmore.js', __FILE__ ) );
}


require __DIR__ . '/post-type_old-events.php';

require __DIR__ . '/taxonomy.php';

require __DIR__ . '/shortcode.php';

require __DIR__ . '/wpcli-command.php';

require __DIR__ . '/custom-css-widget.php';

require __DIR__ . '/like.php';

require __DIR__ . '/loadmore.php';