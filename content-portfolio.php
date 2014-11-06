<?php
/**
 * @package iamtapps
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header<?php if ( has_post_thumbnail() ) :
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'page-header' );
		echo ' has-featured-image" style="background-image: url(' . esc_url( $image[0] ) . ');">';
	else :
		echo '">';
	endif; ?>
		<div class="grid wrap">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<div class="entry-meta">
				<?php iamtapps_posted_on(); ?>
			</div><!-- .entry-meta -->
		</div><!--/.grid-->
	</header><!-- .entry-header -->

	<div class="entry-content grid wrap light-bg">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'iamtapps' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php iamtapps_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
