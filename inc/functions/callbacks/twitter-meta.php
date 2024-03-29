<?php
/**
 * Twitter optimisation
 *
 * This template is added to our  <head> section slow_atoms_twitter_meta()
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package slow_atoms
 */


function slow_atoms_twitter_meta() { ?>
  <!-- *** TWITTER:CARD *** https://developer.twitter.com/en/docs/tweets/optimize-with-cards/overview/abouts-cards -->
  <meta name="twitter:card" content="summary_large_image" />

  <meta name="twitter:site" content="@{{ site.data.socials.twitter.username }}" />
  <meta name="twitter:creator" content="@{{ site.data.authors.default.twitter }}">
  <meta name="twitter:title" content="{% if page.url == "/" %} {{ site.title }} | {{ site.subtitle }} {% else %} {{ page.title }} | {{ site.title }}{% endif %}" />

  <meta name="twitter:description" content="{% if page.description == null %} {{ site.description }}
  {% else %} {{ page.description }} {% endif %}" />

  <meta name="twitter:image" content="
  {%- if page.id -%}
    {{ site.url }}{{ site.baseurl }}{{ site.default_path }}{{ page.hero | prepend: 'posts/' }}
  {%- else -%}
    {{ site.url }}{{ site.baseurl }}{{ site.fallback_path }}{{ site.brand }}
  {%- endif -%} "/>
  <!-- to implement this we need some kind of db recording the descriptors of our thumbs -->
  <meta name="twitter:image:alt" content="
  {%- if page.id -%}
    {{ page.hero_alt }}
  {%- else -%}
    {{ site.subtitle }}
  {%- endif -%} " />
  <!-- *** END TWITTER:CARD *** -->

  <?php }
