<?php
/*
The Single Posts Loop
=====================
*/
?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>
    <article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
        <header>
            <h2 style="display:block !important;"><?php the_title()?></h2>
            <h4>
                <em>
                    <time  class="text-muted" datetime="<?php the_time('d-m-Y')?>"><?php the_time('F jS Y') ?></time>
                </em>
            </h4>
            <p class="text-muted" style="margin-bottom: 30px;">
                <i class="glyphicon glyphicon-folder-open"></i>&nbsp; <?php _e('Filed under', 'b4st'); ?>: <?php the_category(', ') ?><br/>
            </p>
        </header>
        <section>
            <?php the_post_thumbnail('large'); ?>
            <?php the_content()?>
            <?php wp_link_pages(); ?>
        </section>
    </article>
<?php endwhile; ?>
<?php else: get_template_part('includes/loops/content', 'none'); ?>
<?php endif; ?>
