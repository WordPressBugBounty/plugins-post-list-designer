<?php
/**
 * Archive Template 1
 * 
 * @package Post List Designer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<li class="pld-list">
	<?php if ( has_post_thumbnail() && $show_image == "true"  ) { ?>
			<div class="pld-list-image-bg">
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo esc_url($feat_image); ?>" alt="<?php the_title(); ?>" />
				</a>
			</div>
	<?php } ?>

	<<?php echo esc_attr( $title_tag ); ?> class="pld-list-title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</<?php echo esc_attr( $title_tag ); ?>>

	<?php if($show_category == "true" || $show_date == "true" || $show_author == 'true' || $show_comments == 'true') { ?>
		<div class="pld-post-meta">
			<?php if( $show_category == 'true' ) { echo '<span>'. wp_kses_post( $cate_name ) .'</span>'; }
			
			if( $show_author == 'true' ) { ?>
				<span><?php esc_html_e( 'By', 'post-list-designer' ); ?> <?php the_author(); ?></span>
			<?php }

			if( $show_date == "true" ) { echo '<span>'. get_the_date() .'</span>'; }
			
			if( ! empty( $comments ) && $show_comments == 'true' ) { echo '<span><a href="'.esc_url( get_the_permalink() ).'/#comments">'.esc_html( $comments.' '.$reply ).'</a></span>'; } ?>
		</div>
	<?php }

	if( $show_content == "true" ) { ?>
	<div class="pld-post-content">
		<div class="pld-post-content-inner">
			<?php echo pld_get_post_excerpt( $post->ID, get_the_content(), $words_limit);

			if ( $show_read_more == "true" ) { ?>
			<a class="pld-readmore-btn" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'post-list-designer'); ?></a>
		<?php } ?>
		</div>
	</div>
	<?php }

	if( ! empty( $tags ) && $show_tags == 'true' ) { ?>
	<div class="pld-post-tags">
		<?php echo wp_kses_post( $tags ); ?>
	</div>
	<?php } ?>
</li>