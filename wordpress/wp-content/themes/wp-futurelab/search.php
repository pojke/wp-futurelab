<?php
/**
 * The template for displaying search results pages
 *
 * @package wp-futurelab
 */

get_header(); ?>
  <?php if ( is_active_sidebar( 'sidebar-1' )  ) { ?>
    <div class="col-md-8">
  <?php }else{ ?>
    <div class="col-md-12">
  <?php } ?>
    <section id="primary" class="content-area">
      <main id="main" class="site-main" role="main">

      <?php if ( have_posts() ) : ?>

        <header class="page-header">
          <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'wp_futurelab' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
        </header><!-- .page-header -->

        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();

          /**
           * Run the loop for the search to output the results.
           * If you want to overload this in a child theme then include a file
           * called content-search.php and that will be used instead.
           */
          get_template_part( 'template-parts/content', 'search' );

        // End the loop.
        endwhile;

        // Previous/next page navigation.
        the_posts_pagination( array(
          'prev_text'          => __( 'Previous page', 'wp_futurelab' ),
          'next_text'          => __( 'Next page', 'wp_futurelab' ),
          'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wp_futurelab' ) . ' </span>',
        ) );

      // If no content, include the "No posts found" template.
      else :
        get_template_part( 'template-parts/content', 'none' );

      endif;
      ?>

      </main><!-- .site-main -->
    </section><!-- .content-area -->
  </div><!-- .col-md-12 -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
