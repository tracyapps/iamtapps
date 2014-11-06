<?php
/**
 * @package iamtapps
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
		<div class="grid wrap">
			<?php the_title( sprintf( '<h1 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="post-meta">
				<?php iamtapps_posted_on(); ?>
			</div><!-- .post-meta -->
			<?php endif; ?>
		</div><!--/.grid-->
	</header><!-- .post-header -->

	<div class="post-content grid wrap light-bg">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'portfolio-thumbnail' ); ?>
		<?php endif; ?>
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'iamtapps' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'iamtapps' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .post-content -->

	<footer class="post-footer grid wrap">
		<?php iamtapps_entry_footer(); ?>
	</footer><!-- .post-footer -->
</article><!-- #post-## -->