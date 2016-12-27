<?php
/*
The Default Loop (used by index.php and category.php)
=====================================================

If you require only post excerpts to be shown in index and category pages, then use the [---more---] line within blog posts.

If you require different templates for different post types, then simply duplicate this template, save the copy as, e.g. "content-aside.php", and modify it the way you like it. (The function-call "get_post_format()" within index.php, category.php and single.php will redirect WordPress to use your custom content template.)

Alternatively, notice that index.php, category.php and single.php have a post_class() function-call that inserts different classes for different post types into the section tag (e.g. <section id="" class="format-aside">). Therefore you can simply use e.g. .format-aside {your styles} in css/b4st.css style the different formats in different ways.
*/
?>

<?php if(have_posts()): while(have_posts()): the_post();?>
    <article role="article" id="post_<?php the_ID()?>">
        <header>
            <h4><a style="color:#2a6abb;" href="<?php the_permalink(); ?>"><?php the_title()?></a></h4>
            <h5>
              <em>
                <span class="text-muted author"><?php // _e('By', 'b4st'); echo " "; the_author() ?></span>
                <a href="<?php the_permalink(); ?>"><time  class="text-muted" datetime="<?php the_time('d-m-Y')?>"><?php the_time('F jS Y') ?></time></a>
              </em>
            </h5>
        </header>
        <section>
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
        </section>
        <footer>
            <p class="text-muted" style="margin-bottom: 20px;">
                <i class="fa fa-folder-open-o"></i>&nbsp; <?php _e('Category', 'b4st'); ?>: <?php the_category(', ') ?><br/>
            </p>
        </footer>
    </article>
<?php endwhile; ?>

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
