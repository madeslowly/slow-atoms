<?php
/**
 * Template part for displaying people
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */


// Get authors from ACF

$author_list =  get_field('author_list') ;

$cnt = 1;

$ordered_author_list = '' ;


while( $cnt <= 20 ):

	$author = 'author_' . $cnt ;

	if ( empty( $author_list[$author]['first_name'] ) ){
		break ;
	};

	$current_author =  $author_list[$author] ;

	$ordered_author_list = $ordered_author_list . $current_author['first_name'] . ' ' . $current_author['initials'] . ' ' . $current_author['last_name'] . ', ' ;

	$cnt++;

endwhile;

?>

<article class="publication-entry">

	<?php the_title( sprintf( '<h2 class="publication-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<figure class="publication-figure">
		<?php echo wp_get_attachment_image( get_field( 'publication_thumbnail' ) , 'full' ) ; ?>
	</figure>

	<section class="publication-meta">

		<p class="publication-authors">
			<?php echo $ordered_author_list; ?>
		</p>

		<p class="publication-journal">
			<?php echo get_field('publication_journal') . ' ' . get_field('publication_year')  . ' ' . get_field('publication_volume') . ' ' . get_field('publication_page_number') ;?>
		</p>

		<p class="publication-abstract">
			<?php	echo get_field('publication_abstract'); ?>
		</p>

	</section>

</article>
