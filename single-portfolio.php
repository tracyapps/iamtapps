<?php
/**
 * The template for displaying all single posts.
 *
 * @package iamtapps
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'portfolio' ); ?>
			<div id="some-work-samples" class="smaller-list">
				<div class="grid wrap">

					<h4>Here's some more projects I've done:</h4>
					<?php $args = array(
						'post_type' => 'portfolio',
						'posts_per_page' => '6',
						'orderby' => 'rand',
						'post__not_in' => array($post->ID),
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
								<p><?php echo esc_html( excerpt(10), 'iamtapps' ); ?> <a href="<?php the_permalink(); ?>" class="button">More<img data-direction="right" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic iconic-sm" alt="chevron" /></a></p>
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
				</div><!--/.grid-->
			</div><!--/#some-work-samples-->


		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
