<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package flexstarter
 */

get_header(); ?>

	<div id="primary" class="content-area flexstarter-content-area-padding">
		<main id="main" class="site-main">
			<div class="frow-container">
				<div class="frow gutters">
					<div class="col-md-4-6">

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', get_post_format() );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>

					</div>

					<div class="col-lg-2-6">
						<?php get_sidebar(); ?>
					</div>
					
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();