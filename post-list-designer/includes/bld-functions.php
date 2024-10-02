<?php
/**
 * Plugin generic functions file
 *
 * @package Post List Designer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to get post featured image
 * 
 * @package Post List Designer
 * @since 1.0
 */
function pld_get_post_featured_image( $post_id = '', $size = 'full', $default_img = false ) {

	$size	= !empty($size) ? $size : 'full';
	$image	= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

	if( ! empty( $image ) ) {
		$image = isset( $image[0] ) ? $image[0] : '';
	}

	return $image;
}

/**
 * Function to get post excerpt
 * 
 * @package Post List Designer
 * @since 1.0
 */
function pld_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

	$word_length = ! empty( $word_length ) ? $word_length : 55;

	// If post id is passed
	if( ! empty($post_id) ) {
		if ( has_excerpt( $post_id ) ) {
			$content = get_the_excerpt();
		} else {
			$content = ! empty( $content ) ? $content : get_the_content();
		}
	}
	
	/***** Divi Theme Tweak Starts *****/
	// Get content with Divi shortcodes
	if( function_exists('et_strip_shortcodes') ) {
		$content = et_strip_shortcodes( $content );
	}
	if( function_exists('et_builder_strip_dynamic_content') ) {
		$content = et_builder_strip_dynamic_content( $content );
	}
	/***** Divi Theme Tweak Ends *****/

	if( ! empty( $content ) ) {
		$content = strip_shortcodes( $content ); // Strip shortcodes
		$content = wp_trim_words( $content, $word_length, $more );
	}

	return $content;
}

/**
 * Pagination function for grid
 * 
 * @package  Post List Designer
 * @since 1.0
 */
function pld_post_pagination( $args = array() ) {

	$big = 999999999; // need an unlikely integer

	$paging = apply_filters('pld_pro_blog_paging_args', array(
					'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'	=> '?paged=%#%',
					'current'	=> max( 1, $args['paged'] ),
					'total'		=> $args['total'],
					'prev_next'	=> true,
					'prev_text'	=> "&laquo; " . esc_html__('Previous', 'post-list-designer'),
					'next_text'	=> esc_html__('Next', 'post-list-designer') . " &raquo;",
				));

	return paginate_links( $paging );
}

/**
 * Function to get 'pld_post_list' shortcode designs
 * 
 * @since 1.0.0
 */
function pld_post_list_designs() {
	
	$design_arr = array(
						'design-1'	=> __('Design 1', 'post-list-designer'),
						'design-2'	=> __('Design 2', 'post-list-designer'),		
					);
	
	return $design_arr;
}