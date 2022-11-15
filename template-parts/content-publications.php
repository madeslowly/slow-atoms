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

		$tmp = '<span class="author-first-name">' . $current_author['first_name'] . '</span> <span class="author-initials">' . $current_author['initials'] . '</span> <span class="author-last-name">' . $current_author['last_name'] . '</span>' ;

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

if ( is_singular() ) :
	
	$conditional_class = 'is__single-publication' ;

	$publication_entry = the_title( '<h2 class="publication-title">' , '</h2>' , false)  ;

	// Dont display the thumb on singular
	$publication_thumb = '' ;

	$publication_abstract = get_field('publication_abstract') ;

	$publication_doi = sprintf( '<a href="%s" rel="bookmark">' , esc_url( 'doi.org/' . get_field('publication_doi') ) ) . 'doi</a>';

	$data_aos = '' ;

else :

	$publication_entry = the_title( sprintf( '<h4 class="publication-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' , false ) ; 
	
	// if we have a thumbnail, use it and set the abstract word count to 200
	if ( $publication_thumb = get_field( 'publication_thumbnail' ) ) :

		$conditional_class = 'has_publication_thumb' ;
		
		$abstract_word_count = 200 ;
		
		$publication_thumb = '<figure class="publication-figure">' . wp_get_attachment_image( $publication_thumb , "full" ) . '</figure>' ;
	
	else :
		
		$conditional_class = 'no_publication_thumb' ;

		// No thumb so expand the word count for symetry
		$abstract_word_count = 300 ;
	
	endif ;

	$publication_abstract = substr( get_field('publication_abstract') , 0 , $abstract_word_count ) . ' ...' ;

	$publication_doi = sprintf( '<a href="%s" rel="bookmark">' , esc_url( get_permalink() ) ) . 'Abstract</a>' .  ' | ' . sprintf( '<a href="%s" rel="bookmark">' , esc_url( 'doi.org/' . get_field('publication_doi') ) ) . 'doi</a>' ;

	$data_aos = 'data-aos="fade-in"' ;

endif ;

?>

<article class="publication-entry <?php echo $conditional_class ; ?>" <?php echo $data_aos ?> >

	<?php echo $publication_entry  ; echo $publication_thumb ; ?>

	<section class="publication-meta">

		<p class="publication-authors"> <?php echo $author_list_string ; ?> </p>

		<p class="publication-journal">
			<?php echo get_field('publication_journal') . ' ' . get_field('publication_year') . ' ' . '<b>' . get_field('publication_volume') . '</b>' . ' ' . get_field('publication_page_number') ;?>
		</p>

		<p class="publication-abstract"> <?php echo $publication_abstract ; ?> </p>

		<p class="publication-doi">	<?php echo $publication_doi ; ?> </p>

	</section>

	<?php slow_atoms_edit_post_link() ; ?>

</article>