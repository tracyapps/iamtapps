<?php
/**
 * The template used for displaying page content in page.php
 *
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
			<h1 class="entry-title<?php echo ( strlen( get_the_title() ) > 30 ) ? ' long-title' : '' ?>">
				<?php esc_html_e( get_the_title(), 'iamtapps' ); ?>
			</h1>
		</div>
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
		<?php edit_post_link( __( 'Edit', 'iamtapps' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
