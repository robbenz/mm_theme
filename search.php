<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div id="content" class="woocommerce" role="main">

      <?php if ( have_posts() ): ?>
        <div class="header-wrap-text-mattress">
          <h2 class="header-wrap-text-mattress-header">
            <span class="header4-spread_copy"><?php the_search_query(); ?></span>
          </h2>
        </div>

      <?php
      echo '<ul class="products">';
      while ( have_posts() ):  the_post(); wc_get_template_part( 'content', 'product' ); endwhile;
      echo '</ul>';
      mm_page_stuff();

      elseif (! have_posts() ):
        $args = array(
          'posts_per_page' => 20,
          'post_type' => 'product',
          'product_cat' => 'mental-health-mattresses,labor-delivery,pressure-redistribution',
          'orderby' => 'rand'
        );
        $wc_query = new WP_Query($args);
        if ($wc_query->have_posts()) :  ?>

        <div style="height:13vw;" class="header-wrap-text-mattress">
          <h2 style="color: #004ea8; text-transform: uppercase;font-size:3.2rem;">No Results Found</h2>
        </div>
        <h3 style="width:100%;border-bottom:4px dotted #78be20;">Browse Our Most Popular Mattresses</h3>
        <?php
        echo '<ul class="products">';
        while ($wc_query->have_posts()) :
          $wc_query->the_post();
          wc_get_template_part( 'content', 'product' );
        endwhile;
        echo '</ul>';
        wp_reset_postdata();
       else:
         echo '<p>No Products</p>';
       endif; // $wc_query->have_posts()
     endif; // have_posts()
     ?>

      </div><!-- /#content -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
