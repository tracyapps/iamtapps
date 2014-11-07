<?php
/**
 * @package iamtapps
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'light-bg grid wrap' ); ?>>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="unit golden-small">
				<?php the_post_thumbnail( 'portfolio-thumbnail' ); ?>
			</div>
			<div class="unit golden-large">
		<?php else : ?>
			<div class="unit whole">
		<?php endif; ?>
				<?php the_title( sprintf( '<h3 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

				<?php if ( 'post' == get_post_type() ) : ?>
					<div class="post-meta">
						<?php iamtapps_posted_on(); ?>
					</div><!-- .post-meta -->
				<?php endif; ?>

				<div class="post-content">
					<p>
						<?php echo esc_html( excerpt(50), 'iamtapps' ); ?>
						<a href="<?php the_permalink(); ?>" class="button subtle-white">
							<?php if ( 'post' == get_post_type() ) { ?>
								Read More
							<?php } elseif ( 'portfolio' == get_post_type() ) { ?>
								View Project
							<?php } else { ?>
								More
							<?php } ?>
							<img data-direction="right" data-src="<?php echo get_template_directory_uri(); ?>/images/iconic/svg/smart/chevron.svg" class="iconic iconic-sm" alt="chevron" />
						</a>
					</p>

					<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'iamtapps' ),
						'after'  => '</div>',
					) );
					?>
				</div><!-- .post-content -->
				<footer class="post-footer">
					<?php iamtapps_entry_footer(); ?>
				</footer><!-- .post-footer -->
			</div><!--/.unit-->

</article><!-- #post-## -->