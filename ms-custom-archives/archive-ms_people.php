<?php
/**
* The template for displaying people archive pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package slow_atoms
*/

get_header() ; 

// Setup args for grabbing each role
$people_roles = array(
	'academic',
	'support',
	'postdoc',
	'student',
	'visitor',
) ;

// Loop and build args and get posts for each role, but not if 'alumni'
foreach	( $people_roles as $role ) {

	${ $role . '_args' } = array(
		'posts_per_page' => -1,
		'post_type'      => 'ms_people',
		'orderby'        => 'title',
		'order'          => 'ASC',
		'tax_query'      => array(
			
			array(
				'taxonomy'         => 'ms_taxonomy_people',
				'field'            => 'slug',
				'terms'            => $role,
				'include_children' => true,
			),
			array(
				'taxonomy'         => 'ms_taxonomy_people',
				'field'            => 'slug',
				'terms'            => 'alumni',
				'include_children' => true,
				'operator'		   => 'NOT IN'
			),
		)			
	) ;

	${ $role . '_posts' } = get_posts( ${ $role . '_args' } ) ;

} ;

// Get alumnis separately 
$alumni_args = array(
	'posts_per_page' => -1,
	'post_type'      => 'ms_people',
	'orderby'        => 'title',
	'order'          => 'ASC',
	'tax_query'      => array( array(
			'taxonomy'         => 'ms_taxonomy_people',
			'field'            => 'slug',
			'terms'            => 'alumni',
			'include_children' => true,
		) )			
) ;
$alumni_posts = get_posts( $alumni_args ) ;

// Add 'alumni' to our list of roles
$people_roles[] = 'alumni' ;

?>

<main id="primary" class="site-main is__people-archive">

	<section class="slow-atoms__page-hero">

		<header class="page-header is__theme-background-transparent">
			<!-- Needs moving to theme control -->
			<h1 class="page-title">Meet the Group</h1>
		</header><!-- .page-header -->
		
		<?php slow_atoms_get_random_hero('post-thumbnail' ,'attachment-post-thumbnail size-post-thumbnail wp-post-image'); ?>

	</section><!-- .slow-atoms__page-hero -->
	
	<?php

	foreach ( $people_roles as $role ) {
		
		echo '<h2 class="role--header" data-aos="fade-in">' . ucfirst( $role ) . '</h2>' ;

		echo '<section class="people__list role--' . $role . '" data-aos="fade-up">' ;

		foreach ( ${ $role . '_posts' } as $post ) {
			get_template_part( 'template-parts/content', get_post_type() );
		}

		echo '</section><!-- .people__list -->' ;
	} 
	?>
	
</main><!-- #main -->

<?php
get_footer();
