<?php
/**
 * Template part for displaying publications
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */


// Get authors from ACF

$author_list =  get_field('author_list') ;

$cnt = 1;

$author_list_array = array() ;

while( $cnt <= 999 ):

	$author = 'author_' . $cnt ;

	if ( empty( $author_list[ $author ]['first_name'] ) ) :
		// if we have reached the last author, break
		break ;

	else :

		$current_author =  $author_list[ $author ] ;

		$tmp = $current_author['first_name'] . ' ' . $current_author['initials'] . ' ' . $current_author['last_name'] ;

		array_push( $author_list_array , $tmp ) ;

		$cnt++;

	endif ;

endwhile;

$author_list_string = '' ;

$cnt = 1 ;

foreach( $author_list_array as $current_author ) :

	if ( $cnt != count( $author_list_array ) ) :

		$author_list_string = $author_list_string . $current_author . ', ' ;

	else :

		$author_list_string = $author_list_string . ' and ' . $current_author ;

	endif ;

$cnt++ ;

endforeach ;


?>

<article class="publication-entry <?php

	if ( is_singular() ) : ?>
	 is__single-publication <?php
	endif ; ?>

	 ">

	<?php

	if ( is_singular() ) :

		the_title( '<h2 class="publication-title">' , '</h2>' )  ;

	else :

		the_title( sprintf( '<h4 class="publication-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>

		<figure class="publication-figure">
			<?php echo wp_get_attachment_image( get_field( 'publication_thumbnail' ) , 'full' ) ; ?>
		</figure> <?php

	endif ;?>

	<section class="publication-meta">

		<p class="publication-authors">
			<?php echo $author_list_string ; ?>
		</p>

		<p class="publication-journal">
			<?php echo get_field('publication_journal') . ' ' . get_field('publication_year') . ' ' . '<b>' . get_field('publication_volume') . '</b>' . ' ' . get_field('publication_page_number') ;?>
		</p>

		<p class="publication-abstract">

			<?php
			if ( is_singular() ) :

				$abstract = get_field('publication_abstract') ;

				echo $abstract ; ?>

		</p> <?php

			echo sprintf( '<a href="%s" rel="bookmark">' , esc_url( 'doi.org/' . get_field('publication_doi') ) ) . 'doi</a>';

			else :

				$abstract = substr( get_field('publication_abstract') , 0 , 200 ) . ' ...' ;

				echo $abstract ; ?>

		</p>

		<p> <?php

			echo sprintf( '<a href="%s" rel="bookmark">' , esc_url( get_permalink() ) ) . 'Abstract</a>' .  ' | ' . sprintf( '<a href="%s" rel="bookmark">' , esc_url( 'doi.org/' . get_field('publication_doi') ) ) . 'doi</a>'; ?>

		</p><?php

			endif ; ?>



	</section>

</article>
