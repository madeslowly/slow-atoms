<?php
/**
 * Google optimisation using og meta https://ogp.me/
 *
 * This template is added to our  <head> section using slow
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package slow_atoms
 */


function slow_atoms_structured_data() { 
    
    $site_title = get_bloginfo();
    $site_description = get_bloginfo('description');
    $site_admin_email = get_bloginfo('admin_email') ;
    $site_url = get_site_url() ;
    
    $current_page_title = wp_title('&raquo;',FALSE) ;
    $post_ID = get_the_ID() ;

    // Get current url
    global $wp;
    $current_page_url = home_url( $wp->request ) ;
    
    // Get featured image url
    $post_thumb_url = get_the_post_thumbnail_url() ;
    $post_thumb_type = end( explode('.', $post_thumb_url ) );
    // Get featured image alt text
    $post_thumb_id = get_post_thumbnail_id();
    $post_thumb_alt = get_post_meta($post_thumb_id, '_wp_attachment_image_alt', true);
    
    if ( is_front_page() ) :
        $og_title = $site_title . ' &raquo; ' . $site_description ;
    else : 
        $og_title = $site_title .  $current_page_title ;
        
    endif ;

    if ( is_single() ) :

        $og_type = 'article' ;

        // Retrieve all taxonomy names for the given post.
        $post_taxonomies = get_post_taxonomies();

        $term_obj_list = get_the_terms( $post_ID, $post_taxonomies[0] );
        // All tags for current post 
        $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));        

    else :
    
        $og_type = 'website' ;

    endif ;
    
    ?>

    <!-- *** STRUCTURED DATA *** -->
    <!-- WebSite -->
    <!-- const -->
    <script type="application/ld+json">
        { 
            "@context":"https://schema.org",
            "@graph":[ {
                "@type":"WebSite",
                "@id":"<?php echo $site_url ; ?>/#website",
                "url": "<?php echo $site_url ; ?>/",
                "sameAs":[
                "mailto:<?php echo $site_admin_email ; ?>",
                "{{ twitter[0].url }}/",
                "{{ facebook[0].url }}/" ],
                "name": "{{ site.title }} | {{ site.subtitle }}",
                "description": "<?php echo $site_description ; ?>",
                "image": "<?php echo $post_thumb_url ; ?>",
                "author":[ {
                /* Person */
                "@type": "Person",
                "@context": "http://schema.org",
                "name": "<?php echo get_the_author_meta( 'display_name', $author_id ); ?>",
                "description": "<?php echo $site_description ; ?>",
                "image": "{{ site.url }}{{ site.baseurl }}{{ site.fallback_path }}{{ site.brand }}"} ]
            } , {
                /* WePage */
                /* var */
                "@type":"WebPage",
                "@id":"{{ site.url }}{{ site.baseurl }}{{ page.url }}#webpage",
                "url":"{{ site.url }}{{ site.baseurl }}{{ page.url }}",
                "inLanguage":"en-GB",
                "name":"{%- if page.title -%} {{ page.title }} | {{ site.title }} {%- else -%} {{ site.title }} | {{ site.subtitle }} {% endif %}",
                "description": "<?php echo $site_description ; ?>",
                "datePublished":"{{ page.date }}",
                "dateModified":"{{ 'now' | date_to_xmlschema }}",
                "isPartOf":[{
                "@id":"{{ site.url }}{{ site.baseurl }}/#website"}] 
            }]
        } 
    </script>

    <!-- Organization -->
    <script type="application/ld+json">
    { "@context": "http://schema.org",
    "@type": "Organization",
    "url": "{{ site.url }}{{ site.baseurl }}/",
    /* only applies to registered business */
    "legalName": "{{ site.title }} Limited",
    "description": "{{ site.description }}",
    "image": "{{ site.url }}{{ site.baseurl }}{{ site.fallback_path }}{{ site.brand }}",
    "logo": "{{ site.url }}{{ site.baseurl }}{{ site.fallback_path }}{{ site.logo }}",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ site.postal_add.street }}",
        "addressLocality": "{{ site.postal_add.city }}",
        "addressRegion": "{{ site.postal_add.region }}",
        "addressCountry": "{{ site.postal_add.country }}",
        "postalCode": "{{ site.postal_add.postcode }}" },
    "telephone": "{{ site.phone }}",
    "sameAs":[
        "mailto:{{ site.email }}",
        "{{ twitter[0].url }}/",
        "{{ facebook[0].url }}/" ] } </script>

    <!-- Article -->
    {% if page.id %}<!-- this is a post -->
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Article",
        "author": {
        "@type": "Person",
        "name":
        "{%- if page.author -%}{{ site.data.authors[page.author].name }}{%- else -%}{{ site.data.authors.default.name }}{% endif %}"
        },
        "creator": {
        "@type": "Person",
        "name":
        "{%- if page.author -%}{{ site.data.authors[page.author].name }}{%- else -%}{{ site.data.authors.default.name }}{% endif %}"
        },
        "publisher": {
        "@type": "Organization",
        "name": "{{ site.title }}",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ site.url }}{{ site.baseurl }}{{ site.fallback_path }}{{ site.logo }}"
        }
        },
        "headline": "{{ page.title }} | {{ site.title }}",
        "datePublished": "{{ page.date | date_to_xmlschema }}",
        "dateModified": "{{ 'now' | date_to_xmlschema }}",
        "description": "{{ page.description }}",
        "inLanguage": "en",
        "url": "{{ page.url }}",
        "name": "{{ page.title }} | {{ site.title }}",
        "image": {
        "@type": "ImageObject",
        "url": "{%- if page.image -%}{{ site.url }}{{ site.baseurl }}{{ site.default_path }}{{ page.image | prepend: 'posts/' }}{%- else -%}{{ site.url }}{{ site.baseurl }}{{ site.fallback_path }}{{ site.brand }}{%- endif -%}"
        },
        "mainEntityOfPage": "{{ site.url }}{{ site.baseurl }}{{ page.url }}"
    }
    </script>

    {% endif %}

<?php } ?>