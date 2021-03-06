<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
	//	do_action( 'woocommerce_before_main_content' );
	?>

<?php if (is_product_category( array('camp-mattresses', 'bunk-beds', 'camp-dorm') ) ) : ?>
<?php else: ?>
		<span style="position: relative; top: -3px; font-size:1em; font-weight: 700; font-family: 'Open Sans', sans-serif; color:#d6001c;">FREE SHIPPING </span>
		<span style="position: relative; top: -3px;font-size:0.8em; font-family: 'Open Sans', sans-serif;">on Most Mattress Orders</span>
<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

		<!--	<h1 class="page-title"><?php //  woocommerce_page_title(); ?></h1> -->

		<?php endif; ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' );
			//		woocommerce_template_single_add_to_cart();
					?>
					<!-- <button class="eModal-9">Add to cart</button> -->

				<?php endwhile; // end of the loop. ?>

				<?php if ( is_product_category('build-your-mattress') ) : ?>
					<li style="margin-top:35px; " class="last product">
						<a href="<?php echo site_url(); ?>/custom-sizing-form/">
							<img src="<?php echo site_url(); ?>/wp-content/imgs/Build-your-own-mattress.png" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="Build Your Custom Size Mattress" height="275" width="250">
						</a>
					</li>
				<?php endif ; ?>


								<?php if ( is_product_category('stretcher-gurney') ) : ?>
									<li style="margin-top:35px; " class="last product">
										<a href="<?php echo site_url(); ?>/product-category/mattresses/build-your-mattress/">
											<img src="<?php echo site_url(); ?>/wp-content/imgs/Shop-By-Size.png" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="Build Your Custom Size Mattress" height="275" width="250">
										</a>
									</li>
								<?php endif ; ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php

		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	<?php //THIS IS CRUCIAL FOR DIVA PLUGIN
	$t_id = get_queried_object()->term_id;
	$term_meta = get_option( "taxonomy_$t_id" );?>
	<p class="diva"><?php echo $term_meta['custom_term_meta']; ?></p>
	<br>
	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
	//	do_action( 'woocommerce_sidebar' );
	?>

<?php// get_footer(); ?>
