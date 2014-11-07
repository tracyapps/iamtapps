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
								echo '<div class="catbox" data-start="opacity: 0" data-center-top="opacity: 1" data-top="opacity:1" data-top-bottom="opacity:0" data-anchor-target="#what-i-do .catbox"><img class="iconic" data-src="' . $the_category_icon_path . $the_category_icon . '.svg" /><h6><a href="/category/' . $the_category->slug . '">' . $the_category->name . '</a></h6><p>' . $the_category->category_description . '</p><a href="/category/' . $the_category->slug . '" class="button full subtle-white">More<img data-direction="right" data-src="' . $the_category_icon_path . 'chevron.svg" class="iconic iconic-sm" alt="chevron" /></a></div>';

							endforeach;
						?>
						</div>
					</div>
				</div>
				<div id="some-work-samples" class="section bg-color clearfix">
					<div class="grid wrap">

						<h4>Some examples:</h4>
						<?php $args = array(
							'post_type' => 'portfolio',
							'posts_per_page' => '8',
							'orderby' => 'rand',
						);
						$query = new WP_Query( $args );
						?>
							<?php while ( $query->have_posts() ) : $query->the_post();
								?>
								<figure class="example" >
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'portfolio-thumbnail' ); ?>
									<?php endif; ?>
									<figcaption>
										<h6><?php the_title(); ?></h6>
										<p><?php echo esc_html( excerpt(20), 'iamtapps' ); ?> <a href="<?php the_permalink(); ?>" class="button">More<img data-direction="right" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic iconic-sm" alt="chevron" /></a></p>
										<a href="<?php the_permalink(); ?>">Read More</a>
									</figcaption>
									<?php $category = get_the_category(); ?>
									<div class="example-category-tag <?php esc_html_e( $category[0]->slug , 'iamtapps' ); ?>">
										<?php the_category( ' ' ) ;?>
									</div>
									<div class="example-category-icon">
										<img class="iconic iconic-md" data-src="<?php echo get_template_directory_uri() . '/images/iconic/svg/smart/' . get_tax_meta( $category[0]->cat_ID, 'tm_category-icon' ) ; ?>.svg" />
									</div>
								</figure>
							<?php endwhile; ?>
						<?php wp_reset_query(); ?>
						<div class="textcenter more-examples">
							<p><a href="/portfolio/" class="button">See more examples here<img data-direction="right" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic iconic-sm" alt="chevron" /></a></p>
						</div>
					</div>
				</div>
			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
