<?php
/**
* Template Name: Full Width No Container
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<div <?php if(has_post_thumbnail()) : ?> style="background-image: url(<?php the_post_thumbnail_url( 'large' )?>);" <?php endif; ?> class="flexstarter-page-title-area">
		<div class="col-md-1-1">				
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php
				if(function_exists('bcn_display')){
					bcn_display();
				}
			?>
		<div class="blog-entry-meta">
			<?php
				flexstarter_posted_on();
			?>
		</div><!-- .entry-meta -->
				
				
		</div>
	</div> <!-- Title area end -->


	<div id="primary" class="content-area flexstarter-content-area-padding">
		<main id="main" class="site-main">
			<div class="col-md-1-1">
				<?php

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif; // End of the loop.
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php endwhile; // End of the loop. ?>

<?php
get_footer();
