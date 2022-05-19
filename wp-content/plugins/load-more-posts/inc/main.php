<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class loadmorepost_Admin {
	public function __construct()
	 {
	    add_action('admin_menu',array(&$this, 'loadmorepost_Admin_menue'));
    }


    public function loadmorepost_Admin_menue() 
  {
  add_menu_page('loadmorepost','Load More', 'administrator', 'loadmorepost_admin_menue', array(&$this,'loadmorepost_Admin_all'),"");
  }

  function loadmorepost_Admin_all()

  {
    include_once('setting-form.php');

  }
 



}
new loadmorepost_Admin() ;