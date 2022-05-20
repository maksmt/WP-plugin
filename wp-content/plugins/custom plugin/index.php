<?php
/*
Plugin name: Custom PLugin
*/



require __DIR__ . '/post-type_old-events.php';

require __DIR__ . '/taxonomy.php';

require __DIR__ . '/shortcode.php';

require __DIR__ . '/wpcli-command.php';

require __DIR__ . '/custom-css-widget.php';

require __DIR__ . '/like.php';


/*========================================================*/





/*=======================================*/

/*==========================*/

//Custom CSS Widget




/*=======================================================*/


// add_action('admin_menu', 'loadMoreSettings');

function loadMoreSettings() {
add_menu_page('setLoadMore', 'LM settings', 'manage_options', 'mymenu', 'setLoadMore', 'dashicons-', 2);

}