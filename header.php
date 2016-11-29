<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title('•', true, 'right'); bloginfo('name'); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php if ( ! function_exists( '_wp_render_title_tag' ) ) : ?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php endif; ?>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
			<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800italic,800' rel='stylesheet' type='text/css'>
			<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
			<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
			<script type="text/javascript" src="<?php echo site_url(); ?>/wp-content/themes/medmattress/theme/js/b4st.js"></script>
	<?php wp_head(); ?>
	<script>
 jQuery( ".menu-item-1917" ).addClass( "menu-white-link" );
	</script>
	<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-30035896-1', 'auto');
ga('send', 'pageview');

</script>
</head>

<body itemtype="http://schema.org/WebPage" itemscope="itemscope" <?php body_class(); ?>>
<header id="masthead" role-"banner" class="">
	<div id="landing_nav-wrap">
		<div class="container">
			<a class="landing_nav hvr-shutter-out-horizontal landing_nav-hospital" href="http://www.diamedicalusa.com/hospital-equipment">Hospitals</a>
			<a class="landing_nav hvr-shutter-out-horizontal landing_nav-mattresses" target="_blank" href="<?php echo site_url(); ?>">Mattresses</a>
			<a class="landing_nav hvr-shutter-out-horizontal landing_nav-schools" href="http://www.diamedicalusa.com/healthcare-education">Healthcare Education</a>
			<a class="landing_nav hvr-shutter-out-horizontal landing_nav-simlab" href="http://www.diamedicalusa.com/simlabsolutions">SimLabSolutions</a>
			<a class="landing_nav hvr-shutter-out-horizontal landing_nav-ems" href="http://www.diamedicalusa.com/emergency-rescue">Emergency &amp; Rescue</a>
			<a class="landing_nav hvr-shutter-out-horizontal landing_nav-ltc" href="http://www.diamedicalusa.com/long-term-care">Long Term Care</a>
			<a class="landing_nav hvr-shutter-out-horizontal landing_nav-qq" href="http://www.diamedicalusa.com/request-quote">Quick Quote</a>
		</div>
		<div class="container">
			<div id="fixed-row" class="row">
		<div id="logo" class="size-tablet size-laptop size-desktop">
    	<a href="<?php echo site_url(); ?>">
			<img class="med-logo" src="<?php echo site_url(); ?>/wp-content/imgs/medmattresslogo.png"></a>
		</div>
		<div id="search-place" class="size-tablet size-laptop size-desktop">
			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
				<div id="">
					<input type="text" size="20" name="s" id="s" class="search-bar" value="Search Here" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
					<input type="submit" id="searchsubmit" value="" class="btn"/>
					<i class="fa icon-search" style="pointer-events:none; color:#9ed05e; position:relative; left:-41px; top:2px;"></i>
				</div>
			</form>
		</div>
		<div id="mm-right-contact">
		<?php
		$benzitems = '<ul id="%1$s" class="%2$s sf-menu sf-js-enabled">%3$s</ul>';
		$benzmenu ='benz-menu';


		echo '<span class="mm-right-contact-1">' . 'CONTACT US: (877) 593-6011' . '</span>';
		echo '<span class="mm-right-contact-2">' . '   (M-F: 7-6 EST)' . '</span>' . '<br />';

		wp_nav_menu( array( 'theme_location'  => 'header-menu',
		                    'items_wrap'      => $benzitems,
		                    'walker' => new BENZ_Walker_Nav_Menu
		                     ) );

		 if ( is_user_logged_in() ) {
		    wp_nav_menu( array( 'theme_location'  => 'myaccount',
		                        'items_wrap'      => $benzitems,
		                        'walker'          => new BENZ_Walker_Nav_Menu_MYACCOUNT
		                      ) );
		} else {
		    wp_nav_menu( array( 'theme_location'  => 'sign-in-menu',
		                        'items_wrap'      => $benzitems,
		                        'walker'          => new BENZ_Walker_Nav_Menu_SIGNIN
		                     ) );
		};

		echo do_shortcode('[WooCommerceWooCartPro]');

		?>
		</div>

		<?php do_action( 'generate_after_header_content'); ?>

		</div><!-- .inside-header -->
		</header><!-- #masthead -->

		<div id="benz-main-menu-wrap">
		<div id="benz-main-menu-box" class="grid-container">
		<?php


		wp_nav_menu( array( 'theme_location'  => 'mattresses',
		                    'items_wrap'      => $benzitems,
		                    'container_class' => $benzmenu . ' ' . $benzmenu . '-mattress',
		                    'walker'          => new BENZ_Walker_Nav_Menu_MATT
		            ) );

		wp_nav_menu( array( 'theme_location'  => 'replacement-covers',
		                    'items_wrap'      => $benzitems,
		                    'container_class' => $benzmenu . ' ' . $benzmenu . '-covers',
		                    'walker'          => new BENZ_Walker_Nav_Menu_COV
		            ) );

		wp_nav_menu( array( 'theme_location'  => 'accessories',
		                    'items_wrap'      => $benzitems,
		                    'container_class' => $benzmenu . ' ' . $benzmenu . '-accessories',
		                    'walker'          => new BENZ_Walker_Nav_Menu_ACC
		            ) );
		wp_nav_menu( array( 'theme_location'  => 'manufacturers',
		                    'items_wrap'      => $benzitems,
		                    'container_class' => $benzmenu . ' ' . $benzmenu . '-manufacturers',
		                    'walker'          => new BENZ_Walker_Nav_Menu_MFT
		            ) );
		wp_nav_menu( array( 'theme_location'  => 'about-us',
		                    'items_wrap'      => $benzitems,
		                    'container_class' => $benzmenu . ' ' . $benzmenu . '-about',
		                    'walker'          => new BENZ_Walker_Nav_Menu_ABOUT
		            ) );

		 ?>
		</div>
		</div>

		<?php

if ( 'failed' == $_GET["login"] ) {
	echo '<p class="woo-ma-login-failed woo-ma-error error-home-class-red">';
	_e('Login failed, please try again','woocommerce-my-account-widget');
	echo '</p>';
}

?>

<?php woocommerce_breadcrumb(); ?>

		<!--WHAT DOES THIS DO-->	<!--INSERTS SEARCH BAR ON GREEN BAR FOR MOBILE-->
			<div class="navbar navbar-topbar med-mat-mobile">
				<form method="get" id="searchform-mobile" action="<?php bloginfo('home'); ?>/">
					<div>
						<input type="text" size="20" name="m" id="m" class="search-bar" value="Search Here" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
						<input type="submit" id="searchsubmit" value="" class="btn">
						<i class="fa icon-search magnifying-icon"></i>
					</div>
				</form>
			</div>
</div>
<?php /*
Site Title
==========
If you are displaying your site title in the "brand" link in the Bootstrap navbar,
then you probably don't require a site title. Alternatively you can use the example below.
See also the accompanying CSS example in theme/css/b4st.css .

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h1 id="site-title">
      	<a class="text-muted" href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
      </h1>
    </div>
  </div>
</div>
*/ ?>
