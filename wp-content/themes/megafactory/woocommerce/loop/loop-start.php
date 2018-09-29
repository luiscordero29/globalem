<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

$product_class = $data_atts = '';
if( is_shop() ){
	$ato = new MegafactoryThemeOpt;
	$product_col = $ato->megafactoryThemeOpt('woo-shop-columns');
	$product_col = $product_col ? $product_col : 4;
	$product_class = ' shop-col-'. esc_attr( $product_col );
}elseif( is_product () ){
	$ato = new MegafactoryThemeOpt;
	$slide_template = 'woo-related';
	$gal_atts = array(
		'data-loop="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-infinite' ) .'"',
		'data-margin="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-margin' ) .'"',
		'data-center="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-center' ) .'"',
		'data-nav="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-navigation' ) .'"',
		'data-dots="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-pagination' ) .'"',
		'data-autoplay="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-autoplay' ) .'"',
		'data-items="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-items' ) .'"',
		'data-items-tab="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-tab' ) .'"',
		'data-items-mob="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-mobile' ) .'"',
		'data-duration="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-duration' ) .'"',
		'data-smartspeed="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-smartspeed' ) .'"',
		'data-scrollby="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-scrollby' ) .'"',
		'data-autoheight="'. $ato->megafactoryThemeOpt( $slide_template.'-slide-autoheight' ) .'"',
	);
	$data_atts = implode( " ", $gal_atts );
	$product_class .= ' owl-carousel related-slider';
	
	$cols = $ato->megafactoryThemeOpt( $slide_template.'-slide-items' );
	
}

if( is_shop() ){
	echo '</div><!-- .woo-top-meta -->';
}

?>
<ul class="products<?php echo esc_attr( $product_class ); ?>" <?php echo ( $data_atts ); ?>>
