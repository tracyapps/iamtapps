<?php
/**
 * the front page
 *
 * @package iamtapps
 */

get_header();
require_once 'inc/Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'desktop');
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="scroll-down-arrows-intro">
				<img data-direction="bottom" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic-sm iconic scroll-down scroll-down1" alt="chevron" />
				<img data-direction="bottom" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic-sm iconic scroll-down scroll-down2" alt="chevron" />
				<img data-direction="bottom" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic-sm iconic scroll-down scroll-down3" alt="chevron" />
				<img data-direction="bottom" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic-sm iconic scroll-down scroll-down4" alt="chevron" />
				<img data-direction="bottom" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic-sm iconic scroll-down scroll-down5" alt="chevron" />
			</div>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php if ( $deviceType == 'tablet' || $deviceType == 'phone' ) { ?>
				<div id="iamtapps-intro-mobile-version">
					<div class="content-container">
						<?php echo the_content(); ?>
					</div>
				</div><!--/#iamtapps-intro-mobile-version-->
			<?php } elseif ( $deviceType == 'desktop' ) { ?>
				<div id="iamtapps-intro" class="bcg static-slide"
					data-start="opacity: 0; position: fixed; height:100%"
					data-200-start="opacity: 0"
					data-250-start="opacity: 1"
					data-700-start="opacity: 1"
					data-770-start="opacity: 0"
					data-773-start="position: relative; height:0px">
					<div class="sk-container">
						<div class="sk-content">
							<?php echo the_content(); ?>
							<div class="scroll-down-arrows-bio">
								<img data-direction="bottom" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic-sm iconic scroll-down scroll-down1" alt="chevron" />
								<img data-direction="bottom" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic-sm iconic scroll-down scroll-down2" alt="chevron" />
								<img data-direction="bottom" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic-sm iconic scroll-down scroll-down3" alt="chevron" />
								<img data-direction="bottom" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic-sm iconic scroll-down scroll-down4" alt="chevron" />
								<img data-direction="bottom" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic-sm iconic scroll-down scroll-down5" alt="chevron" />
							</div>
						</div>
					</div>
				</div><!--/#iamtapps-intro-->
			<?php } // end desktop code ?>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'section-bg-image' ); ?>
				<div class="bcg section with-bg category-boxes"
					 style="background-image: url('<?php echo esc_url( $image[0] ); ?>')"
					 data-bottom-top="background-position: 50% 0px;"
					 data-top-bottom="background-position: 50% -600px;">

					<div id="what-i-do" class="grid align-center">
						<?php //start category list box thing
							$args = array(
								'orderby'	=> 'id',
								'order'		=> 'ASC',
								'fields'	=> 'ids',
								'hide_empty' => 0,
							);
							$cat_ids = get_terms( 'category', $args );
							foreach ( $cat_ids as $cat_id ) :
								$the_category = get_category( $cat_id, 'category' );
								$the_category_icon = get_tax_meta( $cat_id, 'tm_category-icon' );
								$the_category_icon_path = get_template_directory_uri() .'/images/iconic/svg/smart/';
								echo '<div class="catbox" data-start="opacity: 0" data-center-top="opacity: 1" data-top="opacity:1" data-top-bottom="opacity:0" data-anchor-target="#what-i-do .catbox"><img class="iconic" data-src="' . $the_category_icon_path . $the_category_icon . '.svg" /><h6><a href="' . $the_category->slug . '">' . $the_category->name . '</a></h6><p>' . $the_category->category_description . '</p></div>';

							endforeach;
						?>
						</div>
					</div>
				</div>
				<div id="homepage-samples" class="section bg-color">
					<div class="grid wrap">

						<h3>some random samples</h3>
						<?php $args = array(
							'post_type' => 'portfolio',
							'posts_per_page' => '8',
							'orderby' => 'rand',
						);
						$query = new WP_Query( $args );
						?>
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="unit half example">
									<?php if ( has_post_thumbnail() ) : ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
									<?php endif; ?>
									<h6><?php the_title(); ?></h6>
								</div>
							<?php endwhile; ?>
						<?php wp_reset_query(); ?>
					</div>
				</div>
			<?php endwhile; // end of the loop. ?>
			<?php if ( $deviceType == 'desktop' ) { ?>
			<div id="skrollr-body" class="clearfix">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="signature">
					<path data-500-end="stroke-dashoffset:2000;"
						data-400-end="stroke-dashoffset:0;"
						d="M0.467,81.693c2.621-6.814,13.106-11.533,18.873-14.678c15.727-8.912,33.026-15.203,50.326-20.969c42.463-14.679,87.023-23.591,126.864-45.608" class="style0"/>
					<path data-420-end="stroke-dashoffset:2000;"
						  data-380-end="stroke-dashoffset:0;"
						  d="M83.295,53.385C65.996,77.5,47.648,100.566,32.969,126.777" class="style0"/>
					<path data-380-end="stroke-dashoffset:2000;"
						  data-200-end="stroke-dashoffset:0;"
						  d="M61.278,124.681c-3.146-0.524,3.146-6.291,5.242-8.912c3.146-4.193,5.767-11.533,11.533-11.009c-0.524,6.815-8.388,11.009-8.388,17.3c9.96-1.572,16.775-11.533,25.688-15.203 c-0.524,1.049-0.524,3.146-1.048,4.194c1.573-1.049,2.097-2.097,3.145-3.67c-7.339,1.049-18.872,9.437-20.445,17.3c7.339,0.524,15.203-9.437,19.396-14.679c-4.194,3.146-8.388,7.863-9.436,12.582c10.484-4.719,17.824-15.203,28.309-19.921c0,1.048-0.524,3.146-0.524,4.193c1.048-1.048,2.097-1.572,3.146-3.146c-8.388-1.572-22.542,12.582-24.639,19.921c6.815,6.291,26.736-12.581,33.027-15.727c-0.524,1.049-0.524,2.621-1.048,3.67c7.339-2.098,14.678-8.912,20.969-13.106c-13.63,14.679-25.688,30.406-39.317,45.084c-11.533,13.106-23.591,25.688-36.696,37.745c-6.815,6.815-14.679,16.251-24.115,19.921c-4.718-12.058,18.872-32.502,26.211-39.317c36.172-34.075,87.023-48.754,132.107-67.102" class="style0"/>
					<path data-200-end="stroke-dashoffset:2000;"
						  data-50-end="stroke-dashoffset:0;"
						  d="M311.337,29.794c3.67-5.242,5.242-12.057,0-16.251c-17.3-15.727-46.132,55.568-49.802,65.004c-5.242,13.106-12.057,28.309-13.105,42.463c-0.524,8.912-0.524,11.009,7.863,7.864 c6.291-2.098,13.106-13.631,16.251-17.824c8.912-11.533,16.251-24.115,23.066-37.221c6.815-13.106,13.106-27.26,20.445-40.89c-4.718,14.154-14.679,27.26-20.969,40.366c-4.194,8.912-22.018,41.938-12.058,50.326c7.339-2.097,11.009-11.009,17.3-15.202c-1.573,19.921-13.106,39.317-19.396,57.665c6.815-10.484,9.96-25.687,14.154-37.744c3.145-9.961,7.863-35.124,20.969-37.745c4.718,11.009-7.339,20.97-14.679,27.784c4.194-1.572,16.251-12.581,20.445-9.436c7.34,5.242-12.057,45.084-14.678,52.947c3.67-7.339,4.194-15.728,5.767-24.115c2.097-13.63,5.767-49.802,20.445-54.52c2.098,13.63-11.009,22.018-13.105,34.075c13.63-6.291,22.018-20.445,33.551-28.833c4.194,18.348-5.767,35.123-26.735,31.454" class="style0"/>
				</svg>
			</div><!--/#skrollr-body-->
			<?php } // end if desktop ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
