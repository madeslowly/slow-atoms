<?php
/**
 * Template part for displaying teaching
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

?>

<article id="post-<?php the_ID(); ?>"

	<?php if ( !is_singular() ) :

		post_class('is__teaching-archive-entry');

	else :

		post_class('is__single-teaching');

	endif; ?> >

	<header class="teaching__name-header"

		<?php if ( is_singular() ) : // single post ?>

			data-aos="fade-left" >

			<?php the_title( '<h1 class="teaching__name">', '</h1>' );

			$post_role = get_the_terms( get_the_ID(), 'roles' );

			echo "<div class='teaching__meta-entry'><p class='teaching__role'>" . $post_role[0]->name . "</p></div>";

		else : // archive page so wrap each header in href ?>

			><!-- .teaching__name-header -->
			<a href="<?php the_permalink() ; ?>" rel="bookmark">
				<?php	the_title( '<h4 class="teaching__name">', '</h4>' ); ?>
			</a>

		<?php endif;

		if ( is_singular() ) : // single post

			// get URLs for teaching material

			$lecture_notes							= get_field('lecture_notes', $post->ID);
			$problems								= get_field('problems', $post->ID);
			$solutions								= get_field('solutions', $post->ID);

		 ?>

		<div class="teaching__wrap">
		<?php
			echo "<a href='" . $lecture_notes . "' class='teaching__entry'>Lecture Notes</a>" ;
			echo "<a href='" . $problems . "' class='teaching__entry'>Problems</a>" ;
			echo "<a href='" . $solutions . "' class='teaching__entry'>Solutions</a>" ;
		?>
		</div><!-- .teaching__bio -->

		<?php	endif; ?>

	</header><!-- .teaching__name -->

</article><!-- #post-<?php the_ID(); ?> -->
