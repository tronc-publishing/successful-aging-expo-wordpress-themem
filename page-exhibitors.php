<?php
  /* Template Name: Exhibitors Page */
  get_header();

  // Check if ads are shown
  $args = array( 'post_type' => 'ads-page', 'name' => 'halfpage' );
  $adHalfpage = new WP_Query($args);
  $showAds = get_post_meta($adHalfpage->post->ID, 'ad-show', true);

  wp_reset_postdata();

  $args = array(
    'post_type' => 'exhibitors-page',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'showposts' => -1
  );
  $exhibitors = new WP_Query($args);

  function add_styles($content) {
    $listItems = ['<ul>', '<li>'];
    $listClasses = ['<ul class="fa-ul colorDarkGREY des-inner">', '<li><i fa-li class="fa fa-check-square" aria-hidden="true"></i>'];
    $content = str_replace($listItems, $listClasses, $content);

    return $content;
  }
  add_filter('the_content', 'add_styles');
  remove_filter('the_content', 'wpautop');
?>

<section id="exhibitors" class="container clearfix sectionBlk">

  <div class="des-column col_8">
    <div class="des-inner">
      <?php if ($exhibitors->have_posts()) : ?>
        <?php while ($exhibitors->have_posts()) : $exhibitors->the_post(); $postNum = $exhibitors->current_post; ?>

          <?php if ($postNum == 0) : ?>
            <h3 class="txtCaps colorDarkGREY mb30 list-header"><strong class="mdBold"><?php the_title(); ?></strong></h3>
            <?php the_content(); ?>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; wp_reset_postdata(); ?>
    </div>
  </div>

  <?php if ($showAds) : ?>
    <div class="des-column col_4">
      <div class="des-inner fr">
        <?php get_template_part('./template-parts/ad-halfpage') ?>
      </div>
    </div>
  <?php endif; ?>

</section>

<?php get_template_part('./template-parts/ad-leaderboard'); ?>

<?php get_footer(); ?>
