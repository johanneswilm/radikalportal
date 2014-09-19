<?php
if ( is_home() ) {
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
query_posts($query_string . 'cat=-1,-387,-388,-415,-427,-428,-525&paged=' . $paged);
}
?>

<?php get_header(); ?>

<div class="row">

  <div class="col-md-3 hidden-xs hidden-sm">
    <?php get_sidebar(left); ?>
  </div>

  <div id="main-content" class="main-content col-md-9">
    <div id="primary" class="content-area">
      <div id="content" class="site-content" role="main">

    <?php
      if ( have_posts() ) :
        // Start the Loop.
        while ( have_posts() ) : the_post();

          /*
           * Include the post format-specific template for the content. If you want to
           * use this in a child theme, then include a file called called content-___.php
           * (where ___ is the post format) and that will be used instead.
           */
          get_template_part( 'content', get_post_format() );
        
        endwhile;

        ?>
<ul class="pager">
  <li class="previous"><?php previous_posts_link('&larr; Forrige'); ?></li>
  <li class="next"><?php next_posts_link('Neste &rarr;'); ?></li>
</ul>
        <?php

      else :
        // If no content, include the "No posts found" template.
        get_template_part( 'content', 'none' );

      endif;
    ?>

      </div><!-- #content -->
    </div><!-- #primary -->
  </div><!-- #main-content -->
</div>

<?php get_footer(); ?>
