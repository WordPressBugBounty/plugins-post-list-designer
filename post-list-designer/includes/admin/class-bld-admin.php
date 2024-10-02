<?php
/**
 * Admin Class
 * Handles the Admin side functionality of plugin
 *
 * @package Post List Designer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pld_Admin {

	function __construct() {

		// Filter to add row action in category table
		add_filter( 'category_row_actions', array($this, 'pld_add_tax_row_data'), 10, 2 );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'pld_register_menu') );
	}

	/**
	 * Function to add category row action
	 * 
	 * @package Post List Designer
	 * @since 1.0
	 */
	function pld_add_tax_row_data( $actions, $tag ) {
		return array_merge( array( 'pld_id' => "<span style='color:#555'>ID: {$tag->term_id}</span>" ), $actions );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package Post List Designer
	 * @since 1.0.4
	 */
	function pld_register_menu() {

		// Getting Started Page
		add_menu_page( __('Post List Designer', 'post-list-designer'), __('Post List Designer', 'post-list-designer'), 'manage_options', 'pld-about', array($this, 'pld_howitwork_page'), 'dashicons-sticky', 7 );
	}

	/**
	 * Function to get 'How It Works' HTML
	 *
	 * @package Post List Designer
	 * @package Post List Designer
	 * @package Post List Designer
	 * @since 1.0.0
	 */
	function pld_howitwork_page() { 

		$upgrade_link = add_query_arg( array('page' => 'pld-about-pricing'), admin_url('admin.php') ); ?>		
		
		<style type="text/css">
			.pld-pro-box .hndle{background-color:#0073AA; color:#fff;}			
			.pld-pro-box.postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
			.postbox-container .pld-list li{list-style: square inside;}
			.pld-wrap .pld-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
			.pld-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
			.postbox-container .pld-list .pld-tag {display: inline-block; background-color: #fd6448;padding: 1px 5px;color: #fff; border-radius: 3px; font-weight: 600; font-size: 12px;}
			.pld-pro-heading{font-size: 16px; font-weight: 600; text-align: center;}
			.pld-feedback{clear:both; text-align:center;}
			.pld-feedback h3{font-size:24px; margin-bottom:0px;}
			.pld-feedback p{font-size:15px;}
			.pld-feedback .pld-feedback-btn { font-weight: 600;  color: #fff;text-decoration: none;text-transform: uppercase;padding: 1em 2em; background: #008ec2; border-radius: 0.2em;}
			.pld-faq-section p{font-size:15px;}
			.pld-faq-section h4{font-size:15px; text-decoration: underline;}
			.pld-clearfix:before, .pld-clearfix:after{content: "";display: table;}
			.pld-clearfix::after{clear: both;}
			.pld-clearfix{clear: both;}
			.pld-pro-box .hndle{background-color:#0073AA; color:#fff;}
			.pld-pro-box.postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
			.postbox-container .pld-list li{list-style:square inside;}
			.postbox-container .pld-list .pld-tag{display: inline-block; background-color: #fd6448; padding: 1px 5px; color: #fff; border-radius: 3px; font-weight: 600; font-size: 12px;}
			.pld-wrap .pld-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
			.pld-shortcode-preview{background-color: #e7e7e7; font-weight:bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
			.pld-feedback{clear:both; text-align:center;}
			.pld-feedback h3{font-size:24px; margin-bottom:0px;}
			.pld-feedback p{font-size:15px;}
			.pld-box{width:50%; float: left; padding-left:10px; margin-bottom:20px; padding-right:10px;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;box-sizing: border-box;}
			.pld-box .pld-inside-box{ background:#f1f1f1; padding:15px;} 
			.pld-box .pld-inside-box h4{font-size:15px; margin-top:0px !important;}
			.pld-feedback .pld-feedback-btn { font-weight: 600;  color: #fff;text-decoration: none;text-transform: uppercase;padding: 1em 2em; background: #008ec2; border-radius: 0.2em;}
			.pld-header{background:#c2eeff; border-left:5px solid #50bfeb; padding:5px 10px; clear:both;}
			.pld-pro-header{background:#bbfcd3; border-left:5px solid #3a945b;}
		</style>

		<div class="wrap pld-wrap">	
			<div class="post-box-container">
				<div id="poststuff">
					<div id="post-body" class="metabox-holder columns-2">				
						<!--How it workd HTML -->
						<div id="post-body-content">
			
				<div class="meta-box-sortables">
					
					<div class="postbox">
						<div class="postbox-header">
							<h3 class="hndle">
								<span><?php _e( 'How it Work - Post List Designer', 'post-list-designer' ); ?></span>
							</h3>
						</div>
						<div class="inside">
							<h4 style="margin-bottom:0px;">This plugin is very simple and very easy to use.</h4>
							<h3>Post List Designer works with shortcode as a result you can use this plugin with : </h3>
							<ul>
								<li><strong> - Gutenberg :</strong> Add shortcode in "Gutenberg shortcode block".</li>
								<li><strong> - Classic Editor :</strong> Add shortcode in "TEXT" tab.</li>
								<li><strong> - Elementor :</strong> Add shortcode in "Elementor Shortcode Widget". (<a href="<?php echo esc_url( $upgrade_link ); ?>">Upgrade to pro for built-in widgets</a>)</li>
								<li><strong> - WPBakery / Visual Composer :</strong> Add shortcode in "Raw HTML" OR "Text Block". (<a href="<?php echo esc_url( $upgrade_link ); ?>">Upgrade to pro for built-in elements</a>)</li>
								<li><strong> - Widget :  </strong> Post list widget in your website </li>
							</ul>
							
							<h3 class="pld-header">1) List Shortcodes and Its Parameter Examples</h3>
						
							<div class="pld-shortcode-box pld-clearfix">
								<div class="pld-box">
									<div class="pld-inside-box">
										<h4>Post Limit</h4>
										<p>To display 5 posts use limit="5". To display all posts, use limit="-1"</p>
										<input class='large-text' type='text' value='[pld_post_list limit="5"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box">
										<h4>Post List Category Wise</h4>
										<p>Use the category ID or Slug. You can also add multiple categories id or slug with comma separated e.g. 4,6 or tech, sports</p>
										<input class='large-text' type='text' value='[pld_post_list category="5"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box">
										<h4>Post List Designs</h4>
										<p>Manage the post list design. Free version having 2 design. <a href="https://premium.infornweb.com/post-list-designer-pro-slider-demo/" target="_blank">Also check 10+ Premium designs. </a></p>
										<input class='large-text' type='text' value='[pld_post_list design="design-1"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Post List Order and Order By</h4>
										<p>Manage post order - ASC or DESC and orderby - One or more options can be passed. 'none',ID','author','title','name',rand'</p>
										<input class='large-text' type='text' value='[pld_post_list order="DESC" orderby="post_date"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Post List Meta Details</h4>
										<p>Manage post list meta data like show author, show category, show date, show content etc</p>
										<input class='large-text' type='text' value='[pld_post_slider show_author="false" show_category_name="false" show_date="true" show_content="false"]' readonly />
									</div>
								</div>
								
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Other Parameters</h4>
										<p>Manage other parameters like content_words_limit, Pagination. <a href="https://wordpress.org/plugins/post-list-designer/" target="_blank">Check all parameters</a></p>
									</div>
								</div>
							</div>
							
							<h3 class="pld-header">2) Simple/Minimal List Shortcodes and Its Parameter Examples</h3>
						
							<div class="pld-shortcode-box pld-clearfix">
								<div class="pld-box">
									<div class="pld-inside-box">
										<h4>Post Limit</h4>
										<p>To display 5 posts use limit="5". To display all posts, use limit="-1"</p>
										<input class='large-text' type='text' value='[pld_simple_list limit="5"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Post List Category Wise</h4>
										<p>Use the category ID or Slug. You can also add multiple categories id or slug with comma separated e.g. 4,6 or tech, sports</p>
										<input class='large-text' type='text' value='[pld_simple_list category="5"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box">
										<h4>List Style</h4>
										<p>Manage the list style. You can use list_style="ul" OR list_style="ol"</p>
										<input class='large-text' type='text' value='[pld_simple_list list_style="ul"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Post List Order and Order By</h4>
										<p>Manage post order - ASC or DESC and orderby - One or more options can be passed. 'none',ID','author','title','name',rand'</p>
										<input class='large-text' type='text' value='[pld_simple_list order="DESC" orderby="post_date"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box">
										<h4>Manage Title Tag</h4>
										<p>Manage title tag of heading. You can use 'div' OR 'h2' OR 'h3' etc</p>
										<input class='large-text' type='text' value='[pld_simple_list title_tag="div"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Meta Details</h4>
										<p>Manage post list meta data like show author, show category, show date, show content etc</p>
										<input class='large-text' type='text' value='[pld_simple_list show_author="false" show_category_name="false" show_date="true" show_content="true"]' readonly />
									</div>
								</div>
								
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Other Parameters</h4>
										<p>Manage other parameters like content_words_limit, pagination, show_read_more etc <a href="https://wordpress.org/plugins/post-list-designer/" target="_blank">Check all parameters</a></p>
									</div>
								</div>
							</div>

							<h3 class="pld-header">3) Archive Post List Shortcodes and Its Parameter Examples</h3>
								<div class="pld-shortcode-box pld-clearfix">
								<div class="pld-box">
									<div class="pld-inside-box">
										<h4>Post Limit</h4>
										<p>To display 5 posts use limit="5". To display all posts, use limit="-1"</p>
										<input class='large-text' type='text' value='[pld_archive_list limit="5"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Post List Category Wise</h4>
										<p>Use the category ID or Slug. You can also add multiple categories id or slug with comma separated e.g. 4,6 or tech, sports</p>
										<input class='large-text' type='text' value='[pld_archive_list category="5"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box">
										<h4>List Style</h4>
										<p>Manage the list style. You can use list_style="ul" OR list_style="ol"</p>
										<input class='large-text' type='text' value='[pld_archive_list list_style="ul"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Post List Order and Order By</h4>
										<p>Manage post order - ASC or DESC and orderby - One or more options can be passed. 'none',ID','author','title','name',rand'</p>
										<input class='large-text' type='text' value='[pld_archive_list order="DESC" orderby="post_date"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box">
										<h4>Manage Title Tag</h4>
										<p>Manage title tag of heading. You can use 'div' OR 'h2' OR 'h3' etc</p>
										<input class='large-text' type='text' value='[pld_archive_list title_tag="div"]' readonly />
									</div>
								</div>
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Meta Details</h4>
										<p>Manage post list meta data like show author, show category, show date, show content etc</p>
										<input class='large-text' type='text' value='[pld_archive_list show_author="false" show_category_name="false" show_date="true" show_content="true"]' readonly />
									</div>
								</div>
								
								<div class="pld-box">
									<div class="pld-inside-box"> 
										<h4>Other Parameters</h4>
										<p>Manage other parameters like content_words_limit, pagination, show_read_more etc. <a href="https://wordpress.org/plugins/post-list-designer/" target="_blank">Check all parameters</a></p>
									</div>
								</div>
							</div>
								<hr />
									<div class="pld-faq-section">
											<h3>Frequently Asked Questions (If you are creating a blog page with this plugin)</h3>
											<h4>1) Why My Blog Page is not changed OR Blog Page Design is same like Theme Design?</h4>
											<p>Ans : Blog page content is handled by WordPress it self.<br/>

												To enable plugin design on Blog page, you need to make sure that Blog page should not be selected on posts page of Reading settings. <br/>

												Please refer <a href="https://infornweb.com/subdomains/images/blog-designer-pack-pro/blog-designer-pack-blog-page-setting.png" target="_blank">screenshot</a> and make this changes with your WordPress setup.<br/><br/>

												<strong>Blog page is already created</strong><br/>
												If "Blog" page is already created and assigned that page as a "Posts page" under WordPress Settings > Reading then please de-select this setting. <br/>

												Once you de-select this setting, open your "Blog" page in edit mode and add the plugin shortcode (Shortcodes are shown under Getting Started section of plugin menu)<br/><br/>

												<strong>Blog page is not created</strong><br/>

												If Blog page is not created then go to Pages > Add New and create a blog page OR some other name as per your need and add the shortcode (Shortcodes are shown under Getting Started section of plugin menu)
											</p>

											<h4>2) How to display latest post list on my home page or any other place?</h4>
											<p>Ans : To display post list designs on your home page just use the following shortcode: <br/>

													<code>[pld_post_list limit="5" pagination="false"] </code>

													This code will display latest 5 posts on your desired place.</p>
											</div>
						</div><!-- .inside -->
					</div><!-- .postbox -->

				</div><!-- .meta-box-sortables -->
			
				<div class="meta-box-sortables">					
					<div class="postbox">
						<div class="postbox-header">
							<h3 class="hndle">
								<span><?php _e( 'Premium Demo - Post List Designer', 'post-list-designer' ); ?></span>
							</h3>
						</div>
						<div class="inside">
							<div class="pld-feedback">
								<h3 class="text-center"><?php _e('Want to Check Premium Demo and Features?', 'post-list-designer'); ?></h3>
								<p><?php _e('Checkout the premium demo with 3 Layouts, 10+ Designs and Widget', 'post-list-designer'); ?></p>
								<a href="https://premium.infornweb.com/post-list-designer-pro/" class="pld-feedback-btn pld-button-full" target="_blank"><?php _e('Premium Demo', 'post-list-designer'); ?></a>
							</div>
						</div><!-- .inside -->
					</div><!-- .postbox -->
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-body-content -->

						<div id="postbox-container-1" class="postbox-container">
							<div class="postbox pld-pro-box">
								<h3 class="hndle">
									<span><?php _e( 'Loking For More Layouts and Designs?', 'post-list-designer' ); ?></span>
								</h3>

								<div class="inside">
									
									<div class="pld-pro-heading">Upgrade to Post List Designer Pro</div><br/>

									<ul class="pld-list">
										<li>10+ Designs  <span class="pld-tag">Hot</span></li>
										<li>Shortcode Builder <span class="pld-tag">Hot</span></li>
										<li>Elementor Page Builder Supports <span class="pld-tag">Hot</span></li>
										<li>WPBakery Page Builder Supports <span class="pld-tag">Hot</span></li>
										<li>Style Manager  <span class="pld-tag">Hot</span></li> 
										<li>Works with any Custom Post Type <span class="pld-tag">Hot</span></li>										
										<li>Custom Tags Support</li>
										<li>Featured & Trending Post Functionality <span class="pld-tag">Hot</span></li>
										<li>Infinite Scroll Pagination <span class="pld-tag">Hot</span></li>
										<li>Load More Pagination <span class="pld-tag">Hot</span></li>
										<li>5 types of different pagination</li>
										<li>Social Sharing Options</li>										
										<li>Template Functionality - Override designs from your theme</li>
										<li>And Many More...</li>
									</ul>

									<a href="<?php echo esc_url( $upgrade_link ); ?>" class="button button-primary pld-button-full">Upgrade Now</a>
								</div><!-- end .inside -->
							</div>
						</div><!-- .postbox-container -->
					</div><!-- #post-body -->

				</div><!-- #poststuff -->
			</div><!-- #post-box-container -->
		</div>	
	<?php }
}

$pld_admin = new Pld_Admin();