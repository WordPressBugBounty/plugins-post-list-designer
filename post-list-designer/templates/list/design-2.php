<?php
/**
 * Post List Template 2
 * 
 * @package Post List Designer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="pld-post-list-inr">
	<div class="pld-post-list-content pld-clearfix pld-left-columns <?php if ( ! $feat_image ) { echo 'no-thumb-image'; } ?>">
		<?php if ( $feat_image ) { ?>
		<div class="pld-medium-6 pld-columns">
			<div class="pld-post-image-bg">
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo esc_url( $feat_image ); ?>" alt="<?php the_title(); ?>" />
				</a>
			</div>
		</div>
		<?php } ?>
		<div class="<?php if ( $feat_image ) { echo 'pld-right-columns pld-medium-6'; } else { echo ' pld-full-columns pld-medium-12'; } ?> pld-columns">
			<div class="pld-title-overlay-border">	
				<?php if( $show_category == "true" ) { ?>
					<div class="pld-post-categories">
						<?php echo wp_kses_post( $cate_name ); ?>
					</div>
				<?php } ?>

				<h2 class="pld-post-title">		
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<?php if( $show_date == "true" || $show_author == 'true' ) { ?>		
					<div class="pld-post-meta">
						<?php if( $show_author == 'true' ) { ?>
							<span>
								<?php esc_html_e( 'By', 'post-list-designer' ); ?> <?php the_author(); ?>
							</span>
						<?php }

						echo ( $show_author == 'true' && $show_date == 'true' ) ? '&nbsp;/&nbsp;' : '';
						
						if( $show_date == "true" ) { echo get_the_date(); } ?>
					</div>
				<?php } ?>
			</div>
			<?php if( $show_content == "true" ) { ?>
				<div class="pld-post-content">
					<div class="pld-post-content-inner">
						<?php echo pld_get_post_excerpt( $post->ID, get_the_content(), $words_limit); ?>
					</div>
					<a class="pld-readmorebtn" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'post-list-designer'); ?></a>					
				</div>
			<?php }

			if( ! empty( $tags ) && $show_tags == 'true' ) { ?>
				<div class="wpswp-post-tags">
					<?php echo wp_kses_post( $tags ); ?>
				</div>
			<?php }

			if( ! empty( $comments ) && $show_comments == 'true' ) { ?>
				<div class="wpswp-post-comments">					
					<a href="<?php the_permalink(); ?>/#comments"><?php echo esc_html( $comments.' '.$reply ); ?></a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>