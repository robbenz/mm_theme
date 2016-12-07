<?php
/*
All the functions are in the PHP pages in the `functions/` folder.
*/

require_once locate_template('/functions/cleanup.php');
require_once locate_template('/functions/setup.php');
require_once locate_template('/functions/enqueues.php');
require_once locate_template('/functions/navbar.php');
require_once locate_template('/functions/widgets.php');
require_once locate_template('/functions/search-widget.php');
require_once locate_template('/functions/index-pagination.php');
require_once locate_template('/functions/split-post-pagination.php');
require_once locate_template('/functions/feedback.php');

function benzy_enqueue_styles() {
    wp_enqueue_style( 'superfish', get_template_directory_uri() . '/theme/css/superfish.css', false, false, 'all' );
}
add_action( 'wp_enqueue_scripts', 'benzy_enqueue_styles' );

// --  ADD woocommerce support to theme
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '';
}

function my_theme_wrapper_end() {
  echo '';
}
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
/****** END THEME CORE ******/

/****** WOOCOMMERCE SPECIFIC FUNCTIONS ******/

// Change number or products per row, and number of products per page
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 4;
	}
}
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 14;' ), 20 );
if (is_woocommerce() && is_archive()) {
        wp_enqueue_script( 'frontend-custom', get_template_directory_uri() . '/js/frontend-custom.js', array("jquery"));
            add_thickbox();
}
/** END **/

//remove "Add to Cart" button on product listing page in WooCommerce
add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1 );

function remove_add_to_cart_buttons() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
}
/** END **/

// only 3 related products instead of 4
add_filter( 'woocommerce_output_related_products_args', 'benz_related_products_args' );
  function benz_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
	function woocommerce_output_upsells() {
	    woocommerce_upsell_display( 3,3 ); // Display 3 products in rows of 3
	}
}
/** END **/

//  --  Re-Order product page layouts
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );// Button

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 11 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',   10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );// Button
/** END **/

//  --  Price Things -- "From: $20" for variable products
add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );

function wc_wc20_variation_price_format( $price, $product ) {
  $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
  $price = $prices[0] !== $prices[1] ? sprintf( __( '<span class="var-price-wrap">From: %1$s</span>', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
  $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
  sort( $prices );
  $saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
  if ( $price !== $saleprice ) {
    //$price = '<span class="price-wrap-gal">' . $saleprice . '</span> <ins>' . $price . '</ins>';
  }
  return $price;
}
/** END **/

// --  PREFIX ORDERNUMMER ADD MM- BENZ
add_filter( 'woocommerce_order_number', 'prefix_woocommerce_order_number', 1, 2 );

function prefix_woocommerce_order_number( $oldnumber, $order ) {
    return 'MM-' . $order->id;
}
/** END **/

//  --  Custom Product meta for proactive product page
add_action( 'woocommerce_product_options_general_product_data', 'benz_general_product_data_custom_field' );
function benz_general_product_data_custom_field() {
   global $woocommerce, $post;
   echo '<div class="options_group">';
    woocommerce_wp_checkbox(
                array(
                    'id' => 'product_checkbox',
                    'wrapper_class' => 'checkbox_class',
                    'label' => __('Proactive Checkbox', 'woocommerce' ),
                    'description' => __( 'If checked, this will display the Good | Better | Best, or whatever Gillian is calling it', 'woocommerce' )
                )
            );
    echo '</div>';
}

add_action( 'woocommerce_process_product_meta', 'woocommerce_process_product_meta_fields_save' );
function woocommerce_process_product_meta_fields_save( $post_id ){
    $woo_checkbox = isset( $_POST['product_checkbox'] ) ? 'yes' : 'no';
    update_post_meta( $post_id, 'product_checkbox', $woo_checkbox );
}
/** END **/

//  --  Confirm password field on the register form under My Accounts BENZ
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}
	return $reg_errors;
}
add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );
function wc_register_form_password_repeat() {
	?>
<div id="left-col-confirm-pass">
	<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Confirm Password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p>
</div>
	<?php
}
/** END **/

//  --  Display Price For Variable Product With Same Variations Prices
add_filter('woocommerce_available_variation', function ($value, $object = null, $variation = null) {
if ($value['price_html'] == '') {
$value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
}
return $value;
}, 10, 3);
/** END **/

//  --  remove '(Free)' or '(FREE!)' label text on cart page for Shipping and Handling if cost equal to $0
function benz_custom_shipping_free_label( $label ) {
    $label =  str_replace( "(Free)", " ", $label );
    $label =  str_replace( "(FREE!)", " ", $label );

    return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label' , 'benz_custom_shipping_free_label' );
/** END **/

//  --  LOG IN || OUT Redirect
add_filter('woocommerce_login_redirect', 'login_redirect');
function login_redirect($redirect_to) {
    wp_redirect( home_url() );
    exit();
}

add_action('wp_logout','logout_redirect');
function logout_redirect(){
    wp_redirect( home_url() );
    exit();
}
/** END **/

/**
 * Hide ALL shipping options when free shipping is available and customer is NOT in certain states
 * Hide Free Shipping if customer IS in those states
 */
add_filter( 'woocommerce_package_rates', 'hide_all_shipping_when_free_is_available' , 10, 2 );

// Hide ALL Shipping option when free shipping is available
function hide_all_shipping_when_free_is_available( $rates, $package ) {

	$excluded_states = array( 'AK','HI', 'GU', 'PR', 'AB', 'BC', 'MB', 'NB', 'NL', 'NT', 'NS', 'NU', 'ON', 'PE', 'QC', 'SK', 'YT' );
	if( isset( $rates['free_shipping'] ) AND !in_array( WC()->customer->shipping_state, $excluded_states ) ) :
		// Get Free Shipping array into a new array
		$freeshipping = array();
		$freeshipping = $rates['free_shipping'];

		// Empty the $available_methods array
		unset( $rates );

		// Add Free Shipping back into $avaialble_methods
		$rates = array();
		$rates[] = $freeshipping;

	endif;

	if( isset( $rates['free_shipping'] ) AND in_array( WC()->customer->shipping_state, $excluded_states ) ) {
		unset( $rates['free_shipping'] );
	}
	return $rates;
}

/**
 * Disable free shipping for select products
 */

// make global array for later use & in other files
add_action( 'after_theme_setup', 'dia_free_shipping_array' );
function dia_free_shipping_array() {
  global $product_notfree_ship;
  $product_notfree_ship = array( '799', '781', '768', '748', '2175', '2177', '2179', '2181', '2183', '2185', '2186', '2188', '2190', '2192', '2194', '2196', '2198' );
  return $product_notfree_ship;
}
// -- set the products that DONT get free shipping
add_filter( 'woocommerce_shipping_free_shipping_is_available', 'my_free_shipping', 20 );
function my_free_shipping( $is_available ) {
  global $woocommerce;

  // set the product ids that are $product_notfree_ship returns above array
  global $product_notfree_ship;
  if (function_exists('dia_free_shipping_array')) {
    dia_free_shipping_array();
  }

	// get cart contents
	$cart_items = $woocommerce->cart->get_cart();

	// loop through the items looking for one in the $product_notfree_ship=array();
	foreach ( $cart_items as $key => $item ) {
		if( in_array( $item['product_id'], $product_notfree_ship ) ) {
			return false;
		}
	}

	// nothing found return the default value
	return $is_available;
}
/** END SHIPPING STUFF **/

//  --  Email preview file to include
$preview = get_stylesheet_directory() . '/woocommerce/emails/woo-preview-emails.php';
if(file_exists($preview)) {
     require $preview;
 }
/** END **/

/****** END WOOCOMMERCE SPECIFIC  ******/

//Benz fix for multiple html input field in category edit smashboard becuase of tnymce plugin
function benz_chromefix_inline_css() {
  wp_add_inline_style( 'wp-admin', '.term-description-wrap { display: none ; }' );
  wp_add_inline_style( 'wp-admin', '#posts-filter .column-description { display: none ; }' );
 }
add_action('admin_enqueue_scripts', 'benz_chromefix_inline_css');

//  -- New Class to add Sortable Registered date in users wp dash -- HOT

class RRHE {

//  -- roll the ball
    public function __construct() {
        add_action( 'init', array( &$this, 'init' ) );
    }

//  -- All init functions
    public function init() {
		add_filter( 'manage_users_columns', array( $this,'users_columns') );
		add_action( 'manage_users_custom_column',  array( $this ,'users_custom_column'), 10, 3);
		add_filter( 'manage_users_sortable_columns', array( $this ,'users_sortable_columns') );
		add_filter( 'request', array( $this ,'users_orderby_column') );
		add_action( 'plugins_loaded', array( $this ,'load_this_textdomain') );
		// add_filter( 'plugin_row_meta', array( $this ,'donate_link'), 10, 2 );

	}

//  -- Registers column for display
    public static function users_columns($columns) {
		$columns['registerdate'] = _x('Registered', 'user', 'recently-registered');
		return $columns;
	}

//  -- Handles the registered date column output.
    public static function users_custom_column( $value, $column_name, $user_id ) {

		global $mode;
		$mode = empty( $_REQUEST['mode'] ) ? 'list' : $_REQUEST['mode'];

        if ( 'registerdate' != $column_name ) {
           return $value;
        } else {
	        $user = get_userdata( $user_id );

          if ( is_multisite() && ( 'list' == $mode ) ) {
            $formated_date = __( 'm/d/Y' );
          } else {
            $formated_date = __( 'm/d/Y | g:i:s a' );
          }

          $registered   = strtotime(get_date_from_gmt($user->user_registered));
	        $registerdate = '<span>'. date_i18n( $formated_date, $registered ) .'</span>' ;

			return $registerdate;
		}
	}

//  --  Makes the column sortable
    public static function users_sortable_columns($columns) {
          $custom = array(
		  // meta column id => sortby value used in query
          'registerdate'    => 'registered',
          );
      return wp_parse_args($custom, $columns);
	}

//  --  Calculate the order if we sort by date.
    public static function users_orderby_column( $vars ) {
        if ( isset( $vars['orderby'] ) && 'registerdate' == $vars['orderby'] ) {
                $vars = array_merge( $vars, array(
                        'meta_key' => 'registerdate',
                        'orderby' => 'meta_value'
                ) );
        }
        return $vars;
	}

//  --  Internationalization - We're just going to use the language packs for this.

	public function load_this_textdomain() {
	    load_plugin_textdomain( 'recently-registered' );
	}
}
new RRHE();


//  -- Sidebars Register
add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
    register_sidebar(
        array(
            'id'            => 'blog_sidebar',
            'name'          => __( 'Blog Sidebar' ),
            'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}

//  --  CUSTOM MENU SHIT
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu'          => __( 'Header Menu' ),
      'sign-in-menu'         => __( 'Sign In Menu' ),
      'mattresses'           => __( 'Mattresses Menu' ),
      'replacement-covers'   => __( 'Replacement Covers Menu' ),
      'accessories'          => __( 'Accessories Menu' ),
      'manufacturers'        => __( 'Manufacturers Menu' ),
      'myaccount'            => __( 'My Account' ),
      'home'                 => __( 'Home' ),
      'about-us'             => __( 'About Us Menu' )
    )
  );
}

class BENZ_Walker_Nav_Menu extends Walker_Nav_Menu {
   function start_lvl(&$output, $depth) {
        $output .= '<ul class="sub-menu" style="color:#004ea8; font-weight:700;"><div class="arrow-up-mm"></div><div class="insert-img-here">NEED SOME ASSISTANCE?<br>';
        $output .= '<span style="color:#000; font-weight:normal;"><em>Browse these pages to read<br>our policies or to drop us a line!</em></span></div>';
    }
        function end_lvl(&$output, $depth) {
        $output .= '</ul>';
    }
}

$link = '<a href="' . wp_logout_url( $redirect ) . '" title="' .  __( 'Logout' ) .'">' . __( 'Logout' ) . '</a>';

class BENZ_Walker_Nav_Menu_MYACCOUNT extends Walker_Nav_Menu {
   function start_lvl(&$output, $depth) {
        $output .= '<ul class="sub-menu" style="color:#004ea8; font-weight:700;"><div class="arrow-up-mm"></div><div class="insert-img-here">MANAGE YOUR ACCOUNT<br></div>';

    }
        function end_lvl(&$output, $depth) {
        $output .= '<li class="log-in-out-link"><a href="'. wp_logout_url() .'">Log Out</a></li>';
        $output .= '</ul>';
    }
}

class BENZ_Walker_Nav_Menu_SIGNIN extends BENZ_Walker_Nav_Menu {

   function start_lvl(&$output, $depth) {
        $output .= '<ul class="sub-menu"><div class="arrow-up-mm"></div><div class="insert-img-here"><strong>SIGN IN</strong>' . do_shortcode('[wppb-login]') . '</div>';
    }
        function end_lvl(&$output, $depth) {
        $output .= '<div class="insert-img-here" style="line-height: 22px; width:auto; height:110px; color:#004ea8; font-weight:700; text-align:center; border-top: 1px solid #cccccc; ">';
        $output .= 'NEW CUSTOMER? <br><span style="color:#000; font-weight:normal;"><em>Registration is easy and<br>only takes a few seconds!</em></span>';
        $output .= '<a href="http://www.medmattress.com/my-account" id="benz-register-link">REGISTER</a></div></ul>';
    }

}

class BENZ_Walker_Nav_Menu_ACC extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $output .= '<ul class="sub-menu">';
    }

function end_lvl( &$output, $depth, $args ) {
    if( 0 == $depth ) {
        $output .= '<img src="https://www.medmattress.com/wp-content/imgs/Accessories-Menu-Airpal-Transfer-Pad.png" id="benz-menu-img-acc" class="benz-menu-img" />';
        $output .= '<div class="benz-bottom-colors" style="background-color:#6dc6b0">Our collection of accessories is the perfect way to complete any mattress purchase.</div>';
        $output .= '<div class="arrow-down"></div>';
    }
    $indent = str_repeat( "\t", $depth );
    $output .= "{$indent}</ul>\n";
}
}

    class BENZ_Walker_Nav_Menu_MFT extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $output .= '<ul class="sub-menu">';
    }

function end_lvl( &$output, $depth, $args ) {
    if( 0 == $depth ) {
        $output .= '<img src="https://www.medmattress.com/wp-content/imgs/Hill-Rom-MFT.png" id="benz-menu-img-mft1" class="benz-menu-img" />';
        $output .= '<img src="https://www.medmattress.com/wp-content/imgs/MFT-drop-Stryker.png" id="benz-menu-img-mft2" class="benz-menu-img"/>';
        $output .= '<img src="https://www.medmattress.com/wp-content/imgs/Span-America-MFT.png" id="benz-menu-img-mft3" class="benz-menu-img" />';
        $output .= '<div class="benz-bottom-colors" style="background-color:#9c7da0">Don’t want to browse manufacturers? Try searching your manufacturer at the top of the page!</div>';
        $output .= '<div class="arrow-down"></div>';
    }
    $indent = str_repeat( "\t", $depth );
    $output .= "{$indent}</ul>\n";
}
}

class BENZ_Walker_Nav_Menu_COV extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $output .= '<ul class="sub-menu">';
    }

function end_lvl( &$output, $depth, $args ) {
    if( 0 == $depth ) {
        $output .= '<img src="https://www.medmattress.com/wp-content/imgs/Custom-size-Mattress.png" id="benz-menu-img-cov1" class="benz-menu-img" />';
        $output .= '<a href="http://www.medmattress.com/custom-sizing-form/"><img src="https://www.medmattress.com/wp-content/imgs/custom-size-blue.png" id="benz-menu-img-cov2" class="benz-menu-img" /></a>';
        $output .= '<div id="benz-menu-img-cov3"><p class="benz-menu-copy">Use our custom sizing form to customize a<br>cover with your mattress’s unique dimensions!</p></div>';
        $output .= '<div class="benz-bottom-colors" style="background-color:#c67798">Can’t find a cover to fit your mattress? We can customize a cover for any mattresses or stretcher!</div>';
        $output .= '<div class="arrow-down"></div>';
    }
    $indent = str_repeat( "\t", $depth );
    $output .= "{$indent}</ul>\n";
}
}
class BENZ_Walker_Nav_Menu_MATT extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $output .= '<ul class="sub-menu">';
    }

function end_lvl( &$output, $depth, $args ) {
    if( 0 == $depth ) {
        $output .= '<div id="custom-size-imgmenu">';
        $output .= '<a href="http://www.medmattress.com/custom-sizing-form/"><img src="https://www.medmattress.com/wp-content/imgs/custom-size-blue.png" id="benz-menu-img-matt1" class="benz-menu-img" /></a></div>';
        $output .= '<div id="benz-menu-img-matt2"><p class="benz-menu-copy">Looking for an unusual mattress size?<br>We’ll customize a mattress just for you!</p></div>';
        $output .= '<img src="https://www.medmattress.com/wp-content/imgs/Custom-size-Mattress-menu.png" id="benz-menu-img-matt3" class="benz-menu-img" />';
        $output .= '<div class="benz-bottom-colors" style="background-color:#efea43">Search over 500 healthcare mattresses or browse by manufacturer or part number.</div>';
        $output .= '<div class="arrow-down"></div>';
    }
    $indent = str_repeat( "\t", $depth );
    $output .= "{$indent}</ul>\n";
}
}

class BENZ_Walker_Nav_Menu_ABOUT extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth) {
        $output .= '<ul class="sub-menu">';
        $output .= '<div id="benz-menu-about"><p class="benz-menu-about-header">WHO ARE WE?</p>';
        $output .= '<p class="benz-menu-about-copy">MedMattress provides mattresses, stretcher pads, mattress covers and accessories<br>';
        $output .= 'at affordable prices. MedMattress began in 2008 as the mattress division<br>';
        $output .= 'of DiaMedical USA. DiaMedical USA opened in 2007 in Detroit, Michigan.</p>';
        $output .= '<p class="benz-menu-about-header">OUR MISSION</p>';
        $output .= '<p class="benz-menu-about-copy">We understand how tough it is to for hospitals and universities to build a budget<br>';
        $output .= 'without making sacrifices. That’s why we have no hidden fees nor built-in shipping<br>';
        $output .= 'costs! Our customers always have the lowest prices for their products without any <br>';
        $output .= 'sacrifice in quality. For every shipment we send we calculate the lowest price <br>';
        $output .= 'through our many shipping company affiliates. So you can always rest assured that<br>';
        $output .= 'we’re always getting you the lowest price - GUARANTEED. </p></div>';
        $output .= '<div class="arrow-down"></div>';
    }

function end_lvl( &$output, $depth, $args ) {
    if( 0 == $depth ) {
        $output .= '<p class="about-phone" style="color:#000;">Phone Number:</p>';
        $output .= '<p class="about-phone-number" style="color:#004ea8;"><i class="fa icon-phone fa-lg"></i>(877) 593-6011</p>';
        $output .= '<p class="about-fax" style="color:#000;">Fax Number:</p>';
        $output .= '<p class="about-fax-number" style="color:#004ea8;"><i class="fa icon-print fa-lg"></i>(248) 671-1550</p>';
        $output .= '<p class="about-email" style="color:#000;">Email Address:</p>';
        $output .= '<p class="about-email-number" style="color:#004ea8;"><i class="fa icon-laptop fa-lg"></i>Info@MedMattress.com</p>';
        $output .= '<p class="about-mail" style="color:#000;">Mailing Address: </p>';
        $output .= '<p class="about-mail-number" style="color:#004ea8;"><i class="fa icon-envelope fa-lg"></i>5807 W. Maple, Suite #175<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;West Bloomfield, MI 48322</p>';
        $output .= '<div class="benz-bottom-colors" style="background-color:#7fa6d3">Need help finding our policies? Visit our help page for our shipping and return policies.</div>';
    }
    $indent = str_repeat( "\t", $depth );
    $output .= "{$indent}</ul>\n";
  }
}
