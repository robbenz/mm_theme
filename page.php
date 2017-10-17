<?php get_header(); ?>

<?php if ( is_home() || is_front_page() ): ?>

<?php get_template_part('includes/home-index', 'page'); ?>

<?php elseif ( is_cart() || is_checkout() || is_account_page() || is_page('316') || is_page('3498') || is_page('3428') || is_page('4860')): ?>
  <div class="container">
    <div class="row">
      <div id="content" role="main">
        <?php get_template_part('loops/content', 'page'); ?>
      </div><!-- /#content -->
    </div><!-- /.row -->
  </div><!-- /.container -->
<?php else : ?>


<div class="container">
  <div class="row">

    <div class="col-sm-8">
      <div id="content" role="main">
        <?php get_template_part('loops/content', 'page'); ?>
      </div><!-- /#content -->
    </div>

    <div class="col-sm-4" id="sidebar" role="navigation">
       <?php get_sidebar(); ?>
    </div>

  </div><!-- /.row -->
</div><!-- /.container -->


<?php endif; ?>


<?php get_footer(); ?>
