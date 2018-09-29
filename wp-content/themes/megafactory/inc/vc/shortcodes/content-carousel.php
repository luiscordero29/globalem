<?php 
/**
 * Megafactory Content Carousel
 */

if ( ! function_exists( "megafactory_vc_content_carousel_shortcode" ) ) {
	function megafactory_vc_content_carousel_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_content_carousel", $atts );
		extract( $atts );

		$output = $class = '';
		
		//Defined Variable
		$animation = isset( $animation ) ? $animation : '';
		$class_names = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';
		$class_names .= isset( $text_align ) && $text_align != 'default' ? ' text-' . $text_align : '';
		
		// Get VC Animation
		$class .= megafactoryGetCSSAnimation( $animation );
		
		$gal_atts = '';

		$gal_atts = array(
			'data-loop="'. ( isset( $slide_item_loop ) && $slide_item_loop == 'on' ? 1 : 0 ) .'"',
			'data-margin="'. ( isset( $slide_margin ) && $slide_margin != '' ? absint( $slide_margin ) : 0 ) .'"',
			'data-center="'. ( isset( $slide_center ) && $slide_center == 'on' ? 1 : 0 ) .'"',
			'data-nav="'. ( isset( $slide_nav ) && $slide_nav == 'on' ? 1 : 0 ) .'"',
			'data-dots="'. ( isset( $slide_dots ) && $slide_dots == 'on' ? 1 : 0 ) .'"',
			'data-autoplay="'. ( isset( $slide_item_autoplay ) && $slide_item_autoplay == 'on' ? 1 : 0 ) .'"',
			'data-items="'. ( isset( $slide_item ) && $slide_item != '' ? absint( $slide_item ) : 1 ) .'"',
			'data-items-tab="'. ( isset( $slide_item_tab ) && $slide_item_tab != '' ? absint( $slide_item_tab ) : 1 ) .'"',
			'data-items-mob="'. ( isset( $slide_item_mobile ) && $slide_item_mobile != '' ? absint( $slide_item_mobile ) : 1 ) .'"',
			'data-duration="'. ( isset( $slide_duration ) && $slide_duration != '' ? absint( $slide_duration ) : 5000 ) .'"',
			'data-smartspeed="'. ( isset( $slide_smart_speed ) && $slide_smart_speed != '' ? absint( $slide_smart_speed ) : 250 ) .'"',
			'data-scrollby="'. ( isset( $slide_slideby ) && $slide_slideby != '' ? absint( $slide_slideby ) : 1 ) .'"',
			'data-autoheight="false"',
		);
		$data_atts = implode( " ", $gal_atts );

				
		// This is custom css options for main shortcode warpper
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		
		//Shortcode css ccde here
		$shortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $rand_class ) . '.content-carousel-wrapper { color: '. esc_attr( $font_color ) .'; }' : '';
		
		if( $shortcode_css ) $class_names .= ' ' . $shortcode_rand_id . ' megafactory-inline-css';
			
		$output .= '<div class="content-carousel-wrapper'. esc_attr( $class_names ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
			//Content Carousel Slide
			$output .= '<div class="owl-carousel" '. ( $data_atts ) .'>';	
				$output .= do_shortcode( $content );
			//Content Carousel Slide End
			$output .= '</div><!-- .owl-carousel -->';
		$output .= '</div><!-- .content-carousel-wrapper -->';

		
		return $output;
	}
}

if ( ! function_exists( "megafactory_vc_content_carousel_shortcode_map" ) ) {
	function megafactory_vc_content_carousel_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Content Carousel", "megafactory" ),
				"description"			=> esc_html__( "Any content carousel.", "megafactory" ),
				"base"					=> "megafactory_vc_content_carousel",
				"is_container"			=> true,
				"content_element"		=> true,
				"js_view" 				=> 'VcColumnView',
				"category"				=> esc_html__( "Shortcodes", "megafactory" ),
				"icon"					=> "zozo-vc-icon",
				"params"				=> array(
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Extra Class", "megafactory" ),
						"param_name"	=> "extra_class",
						"value" 		=> "",
					),
					array(
						"type"			=> "animation_style",
						"heading"		=> esc_html__( "Animation Style", "megafactory" ),
						"description"	=> esc_html__( "Choose your animation style.", "megafactory" ),
						"param_name"	=> "animation",
						'admin_label'	=> false,
                		'weight'		=> 0,
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Font Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the font color.", "megafactory" ),
						"param_name"	=> "font_color",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Text Align", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel text align", "megafactory" ),
						"param_name"	=> "text_align",
						"value"			=> array(
							esc_html__( "Default", "megafactory" )	=> "default",
							esc_html__( "Left", "megafactory" )		=> "left",
							esc_html__( "Center", "megafactory" )	=> "center",
							esc_html__( "Right", "megafactory" )		=> "right"
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slide items shown on large devices.", "megafactory" ),
						"param_name"	=> "slide_item",
						"value" 		=> "2",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items on Tab", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slide items shown on tab.", "megafactory" ),
						"param_name"	=> "slide_item_tab",
						"value" 		=> "2",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items on Mobile", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slide items shown on mobile.", "megafactory" ),
						"param_name"	=> "slide_item_mobile",
						"value" 		=> "1",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Auto Play", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slider auto play.", "megafactory" ),
						"param_name"	=> "slide_item_autoplay",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Loop", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slider loop.", "megafactory" ),
						"param_name"	=> "slide_item_loop",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Items Center", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slider center, for this option must active loop and minimum items 2.", "megafactory" ),
						"param_name"	=> "slide_center",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Navigation", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slider navigation.", "megafactory" ),
						"param_name"	=> "slide_nav",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Pagination", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slider pagination.", "megafactory" ),
						"param_name"	=> "slide_dots",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Margin", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slider margin space.", "megafactory" ),
						"param_name"	=> "slide_margin",
						"value" 		=> "",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Duration", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slider duration.", "megafactory" ),
						"param_name"	=> "slide_duration",
						"value" 		=> "5000",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Smart Speed", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slider smart speed.", "megafactory" ),
						"param_name"	=> "slide_smart_speed",
						"value" 		=> "250",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Slideby", "megafactory" ),
						"description"	=> esc_html__( "This is option for content carousel slider scroll by.", "megafactory" ),
						"param_name"	=> "slide_slideby",
						"value" 		=> "1",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_content_carousel_shortcode_map" );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Megafactory_Vc_Content_Carousel extends WPBakeryShortCodesContainer {
    }
}