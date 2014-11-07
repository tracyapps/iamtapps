<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package iamtapps
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<div class="grid wrap">
					<h1 class="page-title<?php echo ( strlen( get_the_title() ) > 30 ) ? ' long-title' : '' ?>">
						<?php
							if ( is_category() ) :
								$category = get_category( get_query_var( 'cat' ) );
								$cat_id = $category->cat_ID;
								$the_category_icon = get_tax_meta( $cat_id, 'tm_category-icon' );
								echo '<img class="iconic iconic-md" data-src="' . get_template_directory_uri() .'/images/iconic/svg/smart/' . $the_category_icon . '.svg" />';
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								printf( __( 'Author: %s', 'iamtapps' ), '<span class="vcard">' . get_the_author() . '</span>' );

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'iamtapps' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'iamtapps' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'iamtapps' ) ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'iamtapps' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'iamtapps' ) ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								_e( 'Asides', 'iamtapps' );

							elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
								_e( 'Galleries', 'iamtapps' );

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'iamtapps' );

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								_e( 'Videos', 'iamtapps' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								_e( 'Quotes', 'iamtapps' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								_e( 'Links', 'iamtapps' );

							elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
								_e( 'Statuses', 'iamtapps' );

							elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
								_e( 'Audios', 'iamtapps' );

							elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
								_e( 'Chats', 'iamtapps' );

							else :
								_e( 'Archives', 'iamtapps' );

							endif;
						?>
					</h1>
					<div class="taxonomy-description">
						<?php
						// Show an optional term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
						?>
					</div>
				</div><!--/.grid-->
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php iamtapps_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
