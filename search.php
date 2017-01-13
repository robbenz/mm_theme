<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div id="content" class="woocommerce" role="main">


      <?php
      if ( have_posts() ): ?>
      <div class="header-wrap-text-mattress">
        <h2 class="header-wrap-text-mattress-header">
          <span class="header4-spread_copy"><?php the_search_query(); ?></span>
        </h2>
      </div>
      <?
        echo '<ul class="products">';
        while ( have_posts() ):  the_post(); wc_get_template_part( 'content', 'product' ); endwhile;
        echo '</ul>';
        mm_page_stuff();
      elseif (! have_posts() ):
      //  echo 'No Results Found';

        $params = array(
        'posts_per_page' => 12,
        'post_type' => 'product',
        'product_cat' => 'mental-health-mattresses'

      );
      $wc_query = new WP_Query($params); // (2)
        ?>
        <?php if ($wc_query->have_posts()) : // (3) ?>
          <div class="header-wrap-text-mattress">
            <h2 class="header-wrap-text-mattress-header">
              <span class="header4-spread_copy">No Results Found<br></span>
              <p>Browse<br>Mental Healh Mattresses<br>Below</p>
            </h2>
          </div>
        <?php echo '<ul class="products">';
        while ($wc_query->have_posts()) : // (4)
                        $wc_query->the_post(); // (4.1)
                            ?>
        <?php wc_get_template_part( 'content', 'product' ); // (4.2) ?>

        <?php endwhile; ?>
          <?php echo '</ul>'; ?>
        <?php wp_reset_postdata(); // (5) ?>
        <?php else:  ?>
        <p>
             <?php _e( 'No Products' ); // (6) ?>
        </p>
        <?php endif;

      endif;
        ?>

      </div><!-- /#content -->
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>
