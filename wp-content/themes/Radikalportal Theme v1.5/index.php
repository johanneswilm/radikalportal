<?php get_header(); ?>
<div class="row">
  <div class="span5 visible-desktop"><?php get_sidebar(left); ?></div>
  <div class="span13">
    <style> .post { margin-bottom: 30px; } </style>

  <!--/.<?php if ( is_home() ) {
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts($query_string . '&cat=-387&cat=-388&paged='.$paged);
  } ?>-->

  <!--/.<?php
  if (is_home()) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    query_posts("cat=-1&cat=-415&cat=-427&cat=-428&paged=$paged");
  }
  ?>-->

<?php
  if ( is_home() ) {
	query_posts('cat=-415,-427,-428,-1,-525');
  }
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <a class="front-page-img" href="<?php the_permalink() ?>"><?php
if ( is_sticky() && has_post_thumbnail() ) {
       the_post_thumbnail('full');
}
?></a>

<?php
  $custom_fields = get_post_custom();
  $my_custom_field = $custom_fields['forfatterid'];
?>
    <div class="post row" style="margin-top: 10px;">
      <div class="span3 hidden-phone">
        <div style="height: 5px;"></div>
  <?php if ($my_custom_field) { ?>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img alt="" src="http://radikalportal.no/wp-content/uploads/userphoto/51.jpg" class="img-rounded hidden-phone"></a>
  <?php } else { ?>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
  <?php userphoto_the_author_photo(
                  '',
                  '',
                  array('class' => 'img-rounded'),
                  get_template_directory_uri() . '/img/anon.gif'
  ); ?>
        </a>
  <?php } ?>
      </div>
      <div class="span10">
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
/* Dum hack for å fikse kategorivisning. (Tore Norderud 15. mai 2014.) */
$klartale_eller_skrivekonkurranse = false;

foreach (get_the_category() as $category) {
    if ($category->cat_name != 'Skjult fra forsiden'
     && $category->cat_name != 'Romtekst'
     && $category->cat_name != 'Romvideo'
     && $category->cat_name != 'Romkronikk') {
        if ($klartale_eller_skrivekonkurranse == false) {
            echo ' ' . $category->cat_name . ' ';
        }

        if ($category->cat_name == 'Klar tale'
         || $category->cat_name == 'Aktuelt'
         || $category->cat_name == 'Skrivekonkurranse') {
            $klartale_eller_skrivekonkurranse = true;
        }
	}
}
?>
        </div>	
        <div class="author-frontpage" style="font-weight: bold; text-transform: uppercase;">
  <?php the_author(); ?>
  <?php
    foreach ( $my_custom_field as $key => $value ) {
  	$userdata = get_userdata($value);
  	echo ' og ' . $userdata->display_name;
    }
  ?> 
        </div>
        <div class="clearfloat"></div>
        <h3>
          <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="entry">
        <?php global $more; $more = 0; ?>
          <div class="ingress">
	    <!--<p><?php /*the_excerpt();*/ ?></p>-->
            <?php the_excerpt(); ?>
          </div>
        </div>
        <a style="font-weight: bold;" href="<?php the_permalink() ?>#disqus_thread">
          <span></span>
        </a>
        <br>
      </div>
    </div> <!--/.post -->

<?php endwhile; else: ?>
    <p>Siden ikke funnet.</p>
<?php endif; ?>

    <br>
    <div class="navigation-prev-next">
      <p> <?php posts_nav_link(' — ', __('&laquo; Nyere innlegg'), __('Eldre innlegg &raquo;')); ?>	</p>
    </div>
  </div>
  <div class="span6 visible-desktop">
    <?php get_sidebar(); ?>
  </div>
</div>
<!--/.row -->
<div class="row">
  <div class="span15">
  </div>
</div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'radikalportal'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>
<?php get_footer(); ?>
