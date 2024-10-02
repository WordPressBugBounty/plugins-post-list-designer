<?php
/**
 * 'pld_archive_list' Shortcode
 * 
 * @package Post List Designer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to handle the `pld_archive_list` shortcode
 * 
 * @package Post List Designer
 * @since 1.0
 */
function pld_get_archive_posts_list( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> 20,
		'category' 				=> '',
		'title_tag'				=> 'div',
		'list_style'			=> 'ul',
		'show_author' 			=> 'false',
		'show_date' 			=> 'false',
		'show_category_name' 	=> 'false',
		'show_tags'				=> 'false',
		'show_content' 			=> 'false',
		'content_words_limit'	=> 20,
		'show_comments'			=> 'false',
		'show_read_more'		=> 'false',
		'show_image'			=> 'false',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'pagination'			=> 'true',
		'pagination_type'		=> 'numeric',
	), $atts, 'pld_archive_list'));

	$allowed_title_tag	= array( 'div', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span', 'label' );
	$title_tag			= in_array( $title_tag, $allowed_title_tag )	? $title_tag 		: 'div';
	$posts_per_page 	= ! empty($limit) 					? $limit 						: 20;
	$list_style			= ($list_style == 'ol') 			? 'ol'							: 'ul';
	$cat 				= (!empty($category))				? explode(',', $category) 		: '';
	$show_author 		= ($show_author == 'false')			? 'false'						: 'true';
	$show_date 			= ( $show_date == 'false' ) 		? 'false'						: 'true';
	$show_category 		= ( $show_category_name == 'false' )? 'false' 						: 'true';
	$show_tags 			= ( $show_tags == 'false' ) 		? 'false'						: 'true';
	$show_content 		= ( $show_content == 'false' ) 		? 'false' 						: 'true';
	$show_read_more 	= ( $show_read_more == 'false' ) 	? 'false' 						: 'true';
	$words_limit 		= !empty( $content_words_limit ) 	? $content_words_limit 			: 20;
	$show_image 		= ( $show_image == 'false' ) 		? 'false'						: 'true';
	$show_comments 		= ( $show_comments == 'false' ) 	? 'false'						: 'true';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby 			= !empty($orderby)					? $orderby 						: 'date';
	$postpagination 	= ($pagination == 'false')			? 'false'						: 'true';
	$pagination_type 	= ($pagination_type == 'prev-next')	? 'prev-next' 					: 'numeric';
	
	// Taking some globals
	global $post;

	// Taking some variables
	$count			= 0;
	$archive_year	= '';

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
		'post_type'				=> PLD_POST_TYPE,
		'post_status'			=> array('publish'),
		'order'					=> $order ,
		'orderby'				=> $orderby, 
		'posts_per_page'		=> $posts_per_page,
		'paged'					=> $paged,
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
		<div class="pld-archive-list pld-design-1 pld-clearfix">
			<?php while ( $query->have_posts() ) : $query->the_post();
				
				$count++;
				$cat_links	= array();
				$feat_image = pld_get_post_featured_image( $post->ID, 'thumbnail', true );
				$terms 		= get_the_terms( $post->ID, 'category' );
				$tags 		= get_the_tag_list( __('Tags: ', 'post-list-designer'), ', ' );
				
				$comments 	= get_comments_number( $post->ID );
				$reply		= ( $comments <= 1 ) ? __('Reply', 'post-list-designer') : __('Replies', 'post-list-designer');
				$post_year  = date_i18n( 'Y', strtotime( $post->post_date ) );
				
				if( empty( $archive_year ) || $archive_year != $post_year ) {
					$archive_year = $post_year;
					$year_flag = 1;
				} else {
					$year_flag = 0;
				}

				if( $terms ) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name = join( ", ", $cat_links );
				
				if( $year_flag ) {
					
					if( $count > 1 ) {
						echo '</'.esc_attr( $list_style ).'>';
					}
					
					echo '<div class="pld-archive-title">'.esc_html( $post_year ).'</div>';
					echo '<'.esc_attr( $list_style ).' class="pld-minimal-list-inr">';
				}

				// Include shortcode html file
				include( PLD_DIR."/templates/archive-list/design-1.php" );
				
			endwhile;
			
				echo '</'.esc_attr( $list_style ).'>';
			?>

		<?php if( $postpagination == "true" && ($query->max_num_pages > 1) ) { ?>
			<div class="pld-pagination pld-clearfix">
				<?php if( $pagination_type == "numeric" ) {
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

// Post Archive List Shortcode
add_shortcode( 'pld_archive_list', 'pld_get_archive_posts_list' );