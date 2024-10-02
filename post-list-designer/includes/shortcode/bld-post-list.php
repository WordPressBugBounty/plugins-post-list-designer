<?php
/**
 * 'pld_post_list' Shortcode
 * 
 * @package Post List Designer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to handle the `pld_post_list` shortcode
 * 
 * @package Post List Designer
 * @since 1.0
 */
function pld_get_posts_list( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> 20,
		'category' 				=> '',		
		'design'                => 'design-1',
		'show_author' 			=> 'true',
		'show_date' 			=> 'true',
		'show_category_name' 	=> 'true',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> 20,
		'show_tags'				=> 'true',
		'show_comments'			=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'pagination'			=> 'true',
		'pagination_type'		=> 'numeric',
	), $atts, 'pld_post_list'));

	$shortcode_designs 	= pld_post_list_designs();
	$posts_per_page 	= ! empty( $limit ) 				? $limit 						: 20;
	$design 			= ( $design && (array_key_exists( trim($design), $shortcode_designs )) ) ? trim( $design )	: 'design-1';
	$cat 				= (!empty($category))				? explode(',', $category) 		: '';
	$show_author 		= ($show_author == 'false')			? 'false'						: 'true';
	$show_date 			= ( $show_date == 'false' ) 		? 'false'						: 'true';
	$show_category 		= ( $show_category_name == 'false' )? 'false' 						: 'true';
	$show_content 		= ( $show_content == 'false' ) 		? 'false' 						: 'true';
	$words_limit 		= !empty( $content_words_limit ) 	? $content_words_limit 			: 20;
	$show_tags 			= ( $show_tags == 'false' ) 		? 'false'						: 'true';
	$show_comments 		= ( $show_comments == 'false' ) 	? 'false'						: 'true';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby 			= !empty($orderby)					? $orderby 						: 'date';
	$postpagination 	= ($pagination == 'false')			? 'false'						: 'true';
	$pagination_type 	= ($pagination_type == 'prev-next')	? 'prev-next' 					: 'numeric';
	
	// Taking some globals
	global $post;

	// Pagination parameter
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	} else {
		$paged = 1;
	}

	// WP Query Parameters
	$args = array ( 
		'post_type'      		=> PLD_POST_TYPE,
		'post_status' 			=> array('publish'),
		'order'          		=> $order ,
		'orderby'        		=> $orderby,  
		'posts_per_page' 		=> $posts_per_page,
		'paged'         		=> $paged,
		'ignore_sticky_posts'	=> true,
	);

	// Category Parameter
	if( ! empty( $cat ) ) {
		
		$args['tax_query'] = array(
								array( 
									'taxonomy'	=> PLD_CAT,
									'terms'		=> $cat,
									'field' 	=> ( isset($cat[0]) && is_numeric($cat[0]) ) ? 'term_id' : 'slug',
								));
	}

	// WP Query
	$query = new WP_Query( $args );

	ob_start();

	// If post is there
	if ( $query->have_posts() ) {
?>
	
		<div class="pld-post-list pld-<?php echo esc_attr( $design ); ?> pld-clearfix">
			
			<?php while ( $query->have_posts() ) : $query->the_post();
				
				$cat_links	= array();
				$feat_image = pld_get_post_featured_image( $post->ID, 'medium_large', true );
				$terms 		= get_the_terms( $post->ID, 'category' );

				$tags 		= get_the_tag_list( __('Tags: ', 'post-list-designer'), ', ' );
				$comments 	= get_comments_number( $post->ID );
				$reply		= ($comments <= 1) ? __('Reply', 'post-list-designer') : __('Replies', 'post-list-designer');
				
				if( $terms ) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name = join( " ", $cat_links );

				// Include shortcode html file
				include( PLD_DIR."/templates/list/{$design}.php" );

			endwhile; ?>

		<?php if( $postpagination == "true" && ($query->max_num_pages > 1) ) { ?>
			<div class="pld-pagination pld-clearfix">

				<?php if($pagination_type == "numeric") {

					echo pld_post_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages ) );

				} else { ?>
					<div class="button-blog-list-p"><?php next_posts_link( __('Next', 'post-list-designer') . " &raquo;", $query->max_num_pages ); ?></div>
					<div class="button-blog-list-n"><?php previous_posts_link( "&laquo; " . __('Previous', 'post-list-designer') ); ?> </div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<?php
	} // end of have_post()

	wp_reset_postdata(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'pld_post_list' Shortcode
add_shortcode( 'pld_post_list', 'pld_get_posts_list' );