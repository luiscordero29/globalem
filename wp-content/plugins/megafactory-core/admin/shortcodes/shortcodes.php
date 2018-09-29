<?php
class MegafactoryShortcodes {

	public static function megafactorySoundcloud( $atts ) {
		$atts = shortcode_atts( array(
			'url' => 'https://api.soundcloud.com/tracks/',
			'height' => '',
			'width' => '',
			'params' => ''
		), $atts );

		return '<iframe width="'. esc_attr( $atts['width'] ) .'" height="'. esc_attr( $atts['height'] ) .'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='. esc_url( $atts['url'] ) .'&amp;'. esc_url( $atts['params'] ) .'"></iframe>';
	}
	
	public static function megafactoryVideoIframe( $atts ) {
		$atts = shortcode_atts( array(
			'url' => '',
			'height' => '',
			'width' => '',
			'params' => ''
		), $atts );

		return '<iframe width="'. esc_attr( $atts['width'] ) .'" height="'. esc_attr( $atts['height'] ) .'" src="'. esc_url( $atts['url'] ) .'?'. esc_attr( $atts['params'] ) .'" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	}
	
	public static function megafactoryVideo( $atts ) {
		$atts = shortcode_atts( array(
			'url' => '',
			'height' => '',
			'width' => '',
		), $atts );
		
		return '<video class="megafactory-custom-video" width="'. esc_attr( $atts['width'] ) .'" height="'. esc_attr( $atts['height'] ) .'" preload="true" style="max-width:100%;">
                    <source src="'. esc_url( $atts['url'] ) .'" type="video/mp4">
                </video>';
	}
 }
add_shortcode( 'soundcloud', array( 'MegafactoryShortcodes', 'megafactorySoundcloud' ) );
add_shortcode( 'videoframe', array( 'MegafactoryShortcodes', 'megafactoryVideoIframe' ) );
add_shortcode( 'video', array( 'MegafactoryShortcodes', 'megafactoryVideo' ) );