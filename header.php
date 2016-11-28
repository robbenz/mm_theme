<!DOCTYPE html>
<html class="no-js">
<head>
	<title><?php wp_title('•', true, 'right'); bloginfo('name'); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="landing_nav-wrap">
	<div class="container">
		<a class="landing_nav hvr-shutter-out-horizontal landing_nav-hospital" href="<?php echo site_url(); ?>/hospital-equipment">Hospitals</a>
		<a class="landing_nav hvr-shutter-out-horizontal landing_nav-mattresses" target="_blank" href="http://www.medmattress.com">Mattresses</a>
		<a class="landing_nav hvr-shutter-out-horizontal landing_nav-schools" href="<?php echo site_url(); ?>/healthcare-education">Healthcare Education</a>
		<a class="landing_nav hvr-shutter-out-horizontal landing_nav-simlab" href="<?php echo site_url(); ?>/simlabsolutions">SimLabSolutions</a>
		<a class="landing_nav hvr-shutter-out-horizontal landing_nav-ems" href="<?php echo site_url(); ?>/emergency-rescue">Emergency &amp; Rescue</a>
		<a class="landing_nav hvr-shutter-out-horizontal landing_nav-ltc" href="<?php echo site_url(); ?>/long-term-care">Long Term Care</a>
		<a class="landing_nav hvr-shutter-out-horizontal landing_nav-qq" href="<?php echo site_url(); ?>/request-quote">Quick Quote</a>
	</div>
	<header id="masthead" role-"banner" class="">
		<div class="container">
			<div id="fixed-row" class="row">
  <!--<button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
    	&#9776;
  	</button> -->
  	<!--<div class="collapse navbar-toggleable-xs" id="collapsingNavbar">-->
		<div id="logo" class="size-tablet size-laptop size-desktop">
    	<a href="<?php echo site_url(); ?>">
			<img class="med-logo" src="<?php echo site_url(); ?>/wp-content/imgs/medmattresslogo.png"></a>
		</div>
		<div class="size-tablet size-laptop size-desktop search-form"><?php get_template_part('navbar-search'); ?></div>
		<div id="mm-right-contact" class="size-laptop size-desktop">

			<?php

			$benzitems = '<ul id="%1$s" class="%2$s sf-menu sf-js-enabled">%3$s</ul>';

			echo '<span class="mm-right-contact-1">' . 'CONTACT US: (877) 593-6011' . '</span>';
			echo '<span class="mm-right-contact-2">' . '   (M-F: 7-6 EST)' . '</span>' . '<br />';

																		?>
</div> <!-- #mm-right-contact -->
	</div>
	</div>
			<nav id="desktop-navbar" class="navbar navbar-topbar med-mat">
				<div class="container">
					<div class="navbar-header">
						<a>MATTRESSES</a>
						<a>REPLACEMENT COVERS</a>
						<a>ACCESSORIES</a>
						<a>MANUFACTURERS</a>
						<a>ABOUT US</a>
					</div>
				</div>
			</nav>
			<div class="navbar navbar-topbar med-mat">
				<div class="mobile-search-bar"><?php get_template_part('navbar-search'); ?></div>
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
