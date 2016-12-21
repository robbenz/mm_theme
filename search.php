<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div id="content" class="woocommerce" role="main">
      <div class="header-wrap-text-mattress">
        <h2 class="header-wrap-text-mattress-header">
          <span class="header8-spread_copy" style="border-bottom: 5px solid #004ea8;padding-bottom: 14px;"><?php the_search_query(); ?></span>
        </h2>
      </div>
      <ul class="products">
        <?php if ( have_posts() ): while ( have_posts() ): the_post(); wc_get_template_part( 'content', 'product' ); endwhile; ?>
      </ul>

      <?php
      if ( function_exists('wp_pagenavi') ) {
        wp_pagenavi();
      } elseif ( function_exists('b4st_pagination') && !function_exists('wp_pagenavi') ) {
        b4st_pagination();
      } elseif ( is_paged() && !function_exists('b4st_pagination') && !function_exists('wp_pagenavi')) { ?>
            <ul class="pagination">
              <li class="older"><?php next_posts_link('<i class="fa fa-arrow-left"></i> ' . __('Previous', 'b4st')) ?></li>
              <li class="newer"><?php previous_posts_link(__('Next', 'b4st') . ' <i class="fa fa-arrow-right"></i>') ?></li>
            </ul>

            <?php } ?>

          <?php else: wp_redirect(get_bloginfo('siteurl').'/404', 404); exit; endif; ?>

      </div><!-- /#content -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
