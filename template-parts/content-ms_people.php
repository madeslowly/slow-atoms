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

	endif; ?>> <?php

	if ( has_post_thumbnail() ) : ?>

		<div class="person__thumbnail-wrap"> <?php
			the_post_thumbnail('full', array('class' => 'person__thumbnail')); ?>
		</div> <?php

	else :

			slow_atoms_get_random_hero('person__thumbnail-wrap' ,'person__thumbnail');

	endif; ?>

	<header class="person__name-header"

		<?php if ( is_singular() ) : // single post ?>

			data-aos="fade-left" >

			<?php the_title( '<h1 class="person__name">', '</h1>' );

			$post_roles = get_the_terms( get_the_ID(), 'ms_taxonomy_people' );

			echo "<div class='person__meta-entry'> " ;

			foreach ( $post_roles as $post_role ) {

				echo "<h4 class='person__role'>" ;
				
				if ( $post_role != $post_roles[0] ) {
					echo " | " ;
				}

				echo $post_role -> name ;

				echo "</h4> " ;


			};

			echo "</div>" ;
			
		else : // archive page so wrap each header in href ?>

			><a href="<?php the_permalink() ; ?>" rel="bookmark">
				<?php	the_title( '<h4 class="person__name">', '</h4>' ); ?>
			</a>

		<?php	endif; ?>

		<ul class="person__meta">

			<?php

			$bio				= get_field('ms_acf_people_bio_name', $post->ID);
			$project			= get_field('ms_acf_people_assignment_name', $post->ID);
			$email_address		= get_field('ms_acf_people_email_name', $post->ID);
			$phone_number		= get_field('ms_acf_people_tel_name', $post->ID);
			$office				= get_field('ms_acf_people_office_name', $post->ID);
			$internal_postcode	= get_field('ms_acf_people_postcode_name', $post->ID);

			while( have_rows('ms_acf_people_socials_group') ): the_row();

				$twitter			= get_sub_field('ms_acf_people_socials_twitter_name', $post->ID);
				$LinkedIn			= get_sub_field('ms_acf_people_socials_linkedin_name', $post->ID);
				$google_scholar		= get_sub_field('ms_acf_people_socials_scholar_name', $post->ID);
				$personal_website	= get_sub_field('ms_acf_people_socials_www_name', $post->ID);

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
			<?php	
			echo "<p class='person__bio-entry'>" . $bio . "</p>" ; 
			echo "<p class='person__bio-entry'>" . $project . "</p>" ;
			?>
		</div><!-- .person__bio -->

		<?php	endif; ?>

	</header><!-- .person__name -->

</article><!-- #post-<?php the_ID(); ?> -->
