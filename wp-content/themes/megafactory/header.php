<?php
/*
 * The header for megafactory theme
 */

$ahe = new MegafactoryHeaderElements;

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<?php
	$rtl = $ahe->megafactoryThemeOpt('rtl');
	if( $rtl ) add_filter( 'body_class','megafactory_rtl_body_classes' );
	
	$smooth_scroll = $ahe->megafactoryThemeOpt('smooth-opt');
	$scroll_time = $scroll_dist = '';
	if( $smooth_scroll ){
		$scroll_time = $ahe->megafactoryThemeOpt('scroll-time');
		$scroll_dist = $ahe->megafactoryThemeOpt('scroll-distance');
	}
?>

<body <?php body_class(); ?> data-scroll-time="<?php echo esc_attr( $scroll_time ); ?>" data-scroll-distance="<?php echo esc_attr( $scroll_dist ); ?>">

<?php
	/*
	 * Mobile Header - megafactoryMobileHeader - 10
	 * Mobile Bar - megafactoryMobileBar - 20
	 * Secondary Menu Space - megafactoryHeaderSecondarySpace - 30
	 * Top Sliding Bar - megafactoryHeaderTopSliding - 40
	 * Full Search - megafactoryFullSearchWrap - 50
	 */
	do_action('megafactory_body_action');
?>

<?php if( $ahe->megafactoryPageLoader() ) : ?>
	<div class="page-loader"></div>
<?php endif; ?>

<div id="page" class="megafactory-wrapper<?php $ahe->megafactoryThemeLayout(); ?>">

	<?php $ahe->megafactoryHeaderSlider('top'); ?>

	<header class="megafactory-header<?php $ahe->megafactoryHeaderLayout(); ?>">
		
			<?php $ahe->megafactoryHeaderBar(); ?>
		
	</header>

	<div class="megafactory-content-wrapper">