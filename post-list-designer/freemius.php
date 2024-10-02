<?php
/**
 * freemius helper function for easy SDK access. 
 * 
 * @package Post List Designer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'pld_fs' ) ) {

	// Create a helper function for easy SDK access.
	function pld_fs() {

		global $pld_fs;

		if ( ! isset( $pld_fs ) ) {

			// Include Freemius SDK.
			require_once dirname( __FILE__ ) . '/freemius/start.php';

			$pld_fs = fs_dynamic_init( array(
				'id'				=> '5587',
				'slug'				=> 'post-list-designer',
				'premium_slug'		=> 'post-list-designer-pro',
				'type'				=> 'plugin',
				'public_key'		=> 'pk_7d78459f24881adc4356537f76200',
				'is_premium'		=> false,
				'premium_suffix'	=> 'Pro',
				'has_addons'		=> false,
				'has_paid_plans'	=> true,
				'menu'				=> array(
										'slug'	=> 'pld-about',
									),
				'is_live'			=> true,
			) );
		}

		return $pld_fs;
	}

	// Init Freemius.
	pld_fs();

	// Signal that SDK was initiated.
	do_action( 'pld_fs_loaded' );
}