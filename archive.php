<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package flexstarter
 */

get_header();
?>

	<div class="flexstarter-page-title-area archive-title">
		<div class="frow-container">
			<div class="frow">
				<div class="col-md-1-1">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
					?>
					<?php 
						if(function_exists('bcn_display')){
							bcn_display();
						} 
					?>
				</div>
			</div>
		</div>
	</div>

	
	<div id="primary" class="content-area flexstarter-content-area-padding">
		<main id="main" class="site-main">

		<div class="frow-container">
				<div class="frow gutters">
					<div class="col-md-4-6">
						<div class="flexstarter-blog-list">
							<?php if ( have_posts() ) : ?>

								<?php
								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', get_post_type() );

								endwhile;

								the_posts_navigation();

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif;
							?>
						</div>
					</div>
					
					<div class="col-md-2-6">
						<?php 
							get_sidebar();
						?>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();