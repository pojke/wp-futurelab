<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package wp-futurelab
 */

get_header(); ?>
	<div id="content" class="container">
		<?php do_action( 'before_content' ); ?>
		<div class="row">
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div class="col-md-8">
			<?php } else { ?>
			<div class="col-md-12">
			<?php } ?>
			<div id="primary" class="content-area">
			  <main id="main" class="site-main" role="main">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the single post content template.
					get_template_part( 'template-parts/content', 'single' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

					if ( is_singular( 'attachment' ) ) {
						// Parent post navigation.
						the_post_navigation( array(
							'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'wp_futurelab' ),
						) );
					} elseif ( is_singular( 'post' ) ) {
						// Previous/next post navigation.
						the_post_navigation( array(
							'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'wp_futurelab' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Next post:', 'wp_futurelab' ) . '</span> ' .
							'<span class="post-title">%title</span>',
							'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'wp_futurelab' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Previous post:', 'wp_futurelab' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						) );
					}

					// End of the loop.
				endwhile;
				?>

			  </main><!-- .site-main -->

				<?php get_sidebar( 'content-bottom' ); ?>

			</div><!-- .content-area -->
		  </div><!-- .col-md-12 -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
