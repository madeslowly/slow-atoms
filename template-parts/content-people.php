<?php
/**
 * Template part for displaying people
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

?>

<article id="post-<?php the_ID(); ?>"

	<?php if ( !is_singular() ) :

		post_class('is__people-archive-entry');

	else :

		post_class('is__single-person');

	endif; ?>>

	<div class="person__thumbnail-wrap">

		<?php if ( has_post_thumbnail() ) :

			the_post_thumbnail('full', array('class' => 'person__thumbnail'));

		else :

			// Grab random image from front page
			$rand_img = 'image_' . rand( 1 , 5 ) ;
			$pageID = get_option('page_on_front'); ?>
			<!-- Needs improving so we get the same markup as the_post_thumbnail(); -->
			<img class="person__thumbnail" src="<?php the_field($rand_img, $pageID); ?> "/>

		<?php	endif; ?>

	</div>

	<header class="person__name-header"

		<?php if ( is_singular() ) : // single post ?>

			data-aos="fade-left" >

			<?php the_title( '<h1 class="person__name">', '</h1>' );

			$post_role = get_the_terms( get_the_ID(), 'roles' );

			echo "<div class='person__meta-entry'><p class='person__role'>" . $post_role[0]->name . "</p></div>";

		else : // archive page so wrap each header in href ?>

			><a href="<?php the_permalink() ; ?>" rel="bookmark">
				<?php	the_title( '<h4 class="person__name">', '</h4>' ); ?>
			</a>

		<?php	endif; ?>

		<ul class="person__meta">

			<?php

			$bio								= get_field('bio', $post->ID);
			$email_address			= get_field('email_address', $post->ID);
			$phone_number				= get_field('phone_number', $post->ID);
			$office							= get_field('office', $post->ID);
			$internal_postcode	= get_field('internal_postcode', $post->ID);



			while( have_rows('field_62a82bb7b3e30') ): the_row();

				$twitter						= get_sub_field('twitter', $post->ID);
				$LinkedIn						= get_sub_field('LinkedIn', $post->ID);
				$google_scholar			= get_sub_field('google_scholar', $post->ID);
				$personal_website		= get_sub_field('personal_website', $post->ID);

			endwhile ;

			if ( ! empty( $email_address ) ) :
				echo "<li class='person__meta-item person__email'><a class='person__meta-entry' href='mailto:$email_address'> <i class='fas fa-envelope'></i><p>$email_address</p></a></li>" ;
			endif ;

			if ( ! empty( $phone_number ) ) :
				echo "<li class='person__meta-item person__phone-number'><a class='person__meta-entry' href='tel:+31$phone_number'> <i class='fas fa-phone-square'></i><p>+31(0)$phone_number</p></a></li>"	;
			endif ;


			if ( ! empty( $twitter ) ) :
				echo "<li class='person__meta-item person__twitter'><a class='person__meta-entry' href='$twitter'> <i class='fab fa-twitter'></i></a></li>" ;
			endif ;

			if ( ! empty( $LinkedIn ) ) :
				echo "<li class='person__meta-item person__LinkedIn'><a class='person__meta-entry' href='$LinkedIn'> <i class='fab fa-linkedin-in'></i></a></li>" ;
			endif ;

			if ( ! empty( $google_scholar ) ) :
				echo "<li class='person__meta-item person__google-scholar'><a class='person__meta-entry' href='$google_scholar'> <i class='fas fa-graduation-cap'></i></a></li>" ;
			endif ;

			if ( ! empty( $personal_website ) ) :
				echo "<li class='person__meta-item person__personal-website'><a class='person__meta-entry' href='$personal_website'> <i class='fas fa-globe'></i></a></li>" ;
			endif ;

			if ( ! empty( $office ) ) :
				echo "<li class='person__meta-item person__office'><p class='person__meta-entry'>Office: 	" . $office . "</p><li>" ;
			endif ;

			?>
		</ul><!-- .person__meta -->

		<?php

		if ( is_singular() ) : // single post ?>

		<div class="person__bio-wrap">
			<?php	echo "<p class='person__bio-entry'>" . $bio . "</p>" ; ?>
		</div><!-- .person__bio -->

		<?php	endif; ?>

	</header><!-- .person__name -->

</article><!-- #post-<?php the_ID(); ?> -->
