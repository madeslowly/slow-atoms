<?php
/**
 * Template part for displaying publications
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */


// Get authors from ACF

$ms_acf_pub_alist =  get_field('ms_acf_pub_alist') ;

$cnt = 1;

$ms_acf_pub_alist_array = array() ;

while( $cnt <= 999 ):

	$author = 'author_' . $cnt ;

	if ( empty( $ms_acf_pub_alist[ $author ]['ms_acf_alist_fname'] ) ) :
		// if we have reached the last author, break
		break ;

	else :

		$current_author =  $ms_acf_pub_alist[ $author ] ;

		$tmp = '<span class="author-first-name">' . $current_author['ms_acf_alist_fname'] . '</span> <span class="author-initials">' . $current_author['ms_acf_alist_initials'] . '</span> <span class="author-last-name">' . $current_author['ms_acf_alist_lname'] . '</span>' ;

		array_push( $ms_acf_pub_alist_array , $tmp ) ;

		$cnt++;

	endif ;

endwhile;

$ms_acf_pub_alist_string = '' ;

$cnt = 1 ;

foreach( $ms_acf_pub_alist_array as $current_author ) :

	if ( $cnt != count( $ms_acf_pub_alist_array ) ) :

		$ms_acf_pub_alist_string = $ms_acf_pub_alist_string . $current_author . ', ' ;

	else :

		$ms_acf_pub_alist_string = $ms_acf_pub_alist_string . ' and ' . $current_author ;

	endif ;

$cnt++ ;

endforeach ;

if ( is_singular() ) :
	
	$conditional_class = 'is__single-publication' ;

	$publication_entry = the_title( '<h2 class="publication-title">' , '</h2>' , false)  ;

	// Dont display the thumb on singular
	$publication_thumb = '' ;

	$ms_acf_pub_abstract_name = get_field('ms_acf_pub_abstract_name') ;

	$ms_acf_pub_doi_name = sprintf( '<a href="%s" rel="bookmark">' , esc_url( 'doi.org/' . get_field('ms_acf_pub_doi_name') ) ) . 'doi</a>';

	$data_aos = '' ;

else :

	$publication_entry = the_title( sprintf( '<h4 class="publication-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' , false ) ; 
	
	// if we have a thumbnail, use it and set the abstract word count to 200
	if ( $publication_thumb = get_field( 'ms_acf_pub_thumb_name' ) ) :

		$conditional_class = 'has_publication_thumb' ;
		
		$abstract_word_count = 200 ;
		
		$publication_thumb = '<figure class="publication-figure">' . wp_get_attachment_image( $publication_thumb , "full" ) . '</figure>' ;
	
	else :
		
		$conditional_class = 'no_publication_thumb' ;

		// No thumb so expand the word count for symetry
		$abstract_word_count = 300 ;
	
	endif ;

	$ms_acf_pub_abstract_name = substr( get_field('ms_acf_pub_abstract_name') , 0 , $abstract_word_count ) . ' ...' ;

	$ms_acf_pub_doi_name = sprintf( '<a href="%s" rel="bookmark">' , esc_url( get_permalink() ) ) . 'Abstract</a>' .  ' | ' . sprintf( '<a href="%s" rel="bookmark">' , esc_url( 'doi.org/' . get_field('ms_acf_pub_doi_name') ) ) . 'doi</a>' ;

	$data_aos = 'data-aos="fade-in"' ;

endif ;

?>

<article class="publication-entry <?php echo $conditional_class ; ?>" <?php echo $data_aos ?> >

	<?php echo $publication_entry  ; echo $publication_thumb ; ?>

	<section class="publication-meta">

		<p class="publication-authors"> <?php echo $ms_acf_pub_alist_string ; ?> </p>

		<p class="publication-journal">
			<?php echo get_field('ms_acf_pub_journal_name') . ' ' . get_field('ms_acf_pub_year_name') . ' ' . '<b>' . get_field('ms_acf_pub_vol_name') . '</b>' . ' ' . get_field('ms_acf_pub_page_name') ;?>
		</p>

		<p class="publication-abstract"> <?php echo $ms_acf_pub_abstract_name ; ?> </p>

		<p class="publication-doi">	<?php echo $ms_acf_pub_doi_name ; ?> </p>

	</section>

	<?php slow_atoms_edit_post_link() ; ?>

</article>