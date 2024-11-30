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

		// Action for admin scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'pld_admin_script_style' ) );

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'pld_front_style_script') );
	}

	/**
	 * Registring and enqueing admin sctipts and styles
	 *
 	 * @since 1.0
	 */
	function pld_admin_script_style( $hook_suffix ) {

		// FS Pricing CSS
		if( PLD_SCREEN_ID.'_page_pld-about-pricing' == $hook_suffix ) {
			wp_register_style( 'pld-fs-pricing', PLD_URL . 'assets/css/fs-pricing.css', array(), PLD_VERSION );
			wp_enqueue_style( 'pld-fs-pricing' );
		}
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