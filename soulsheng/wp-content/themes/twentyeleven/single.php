<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php if(function_exists('the_views')) { the_views(); } ?>

					<nav id="nav-single">
						<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
						<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '<br>&larr;', 'Previous post link', 'twentyeleven' ) . '</span> 上一篇：%title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '<br>下一篇：%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyeleven' ) . '</span>' ); ?></span>
					</nav><!-- #nav-single -->
					</nav><!-- #nav-single -->

					<?php get_template_part( 'content-single', get_post_format() ); ?>

<nav id="nav-single">
						<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
						<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '<br>&larr;', 'Previous post link', 'twentyeleven' ) . '</span> 上一篇：%title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '<br>下一篇：%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyeleven' ) . '</span>' ); ?></span>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>