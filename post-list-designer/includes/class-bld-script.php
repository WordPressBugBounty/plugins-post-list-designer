<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Post List Designer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pld_Script {

	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pld_front_style_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Post List Designer
	 * @since 1.0
	 */
	function pld_front_style_script() {		
		
		// Registring and enqueing public css
		wp_register_style( 'pld-public', PLD_URL.'assets/css/bld-public.css', array(), PLD_VERSION );
		wp_enqueue_style( 'pld-public' );
	}
}

$pld_script = new Pld_Script();