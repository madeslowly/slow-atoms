<?php
/**
 * 
 * Using Thumbnails with Previous and Next Post Links
 *
 * @package slow_atoms
 * @since 0.0.0
 * 
 */

function slow_atoms_posts_nav( $archive_name , $show_thumb , $show_title ) {
	
	$next_post = get_next_post() ;
	$prev_post = get_previous_post() ;
	
	if ( $next_post || $prev_post ) : ?>
	
		<div class="slow-atoms-posts-nav">
			<h2 class="screen-reader-text">Post navigation</h2>
			<div> <?php

				if ( ! empty( $prev_post ) ) : ?>

				<a href="<?php echo get_permalink( $prev_post ); ?>"> <?php

					if ( $show_thumb == 'true' ) : ?>

					<div>
						<div class="slow-atoms-posts-nav__thumbnail slow-atoms-posts-nav__prev">
							<?php echo get_the_post_thumbnail( $prev_post, [ 100, 100 ] ); ?>
						</div>
					</div> <?php

					endif ; ?>


					<div>
						<strong>
							<i class="fas fa-arrow-circle-left"></i>
							<?php _e( 'Previous ' . $archive_name , 'textdomain' ) ?>
						</strong> <?php

						if( $show_title == 'true' ) : ?>

						<h4><?php echo get_the_title( $prev_post ); ?></h4> <?php

						endif ; ?>
					</div>

      			</a> <?php

				endif; ?>
    		</div>

    		<div> <?php

				if ( ! empty( $next_post ) ) : ?>

				<a href="<?php echo get_permalink( $next_post ); ?>">
					<div>
						<strong>
							<?php _e( 'Next ' . $archive_name , 'textdomain' ) ?>
							<i class="fas fa-arrow-circle-right"></i>
						</strong><?php

						if( $show_title == 'true' ) : ?>

						<h4><?php echo get_the_title( $next_post ); ?></h4> <?php

						endif ; ?>

					</div>

					<div>
						<div class="slow-atoms-posts-nav__thumbnail slow-atoms-posts-nav__next">
							<?php echo get_the_post_thumbnail( $next_post, [ 100, 100 ] ); ?>
						</div>
					</div>
   				</a> <?php

				endif; ?>
  			</div>
		</div> <!-- .slow-atoms-posts-nav --> <?php

	endif ; 
}