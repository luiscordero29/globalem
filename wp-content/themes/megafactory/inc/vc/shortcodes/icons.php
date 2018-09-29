<?php 
/**
 * Megafactory Icon
 */

if ( ! function_exists( "megafactory_vc_icons_shortcode" ) ) {
	function megafactory_vc_icons_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_icons", $atts );
		extract( $atts );
		
		//Define Variables
		$animation = isset( $animation ) ? $animation : '';
		$class = isset( $extra_class ) && $extra_class != '' ? $extra_class : '';
		$class .= isset( $icon_layout ) && $icon_layout != '' ? ' icon-style-'.$icon_layout : '';				

		// Get VC Animation
		$class .= megafactoryGetCSSAnimation( $animation );
		
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		
		//Shortcode css ccde here
		$shortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $rand_class ) . '.icon-wrapper { color: '. esc_attr( $font_color ) .'; }' : '';
		
		//Shortcode css ccde here
		if( isset( $icon_size ) && $icon_size ){
			$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .icon-inner { font-size: '. esc_attr( $icon_size ) .'px; }';
			$dimension = absint( $icon_size ) * 2;
			$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .icon-inner { height: '. esc_attr( $dimension ) .'px; width: '. esc_attr( $dimension ) .'px; }';
		}
		
		$icon_type = isset( $icon_type ) ? 'icon_' . $icon_type : '';
		$icon = isset( $$icon_type ) ? $$icon_type : '';
		$icon_class = isset( $icon_style ) ? ' ' . $icon_style : '';
		
		if( isset( $icon_variation ) ){
			if( $icon_variation == 'c' ){
				$shortcode_css .= isset( $icon_color ) && $icon_color != '' ? '.' . esc_attr( $rand_class ) . ' .icon-inner { color: '. esc_attr( $icon_color ) .'; }' : '';
			}else{
				$icon_class .= ' ' . esc_attr( $icon_variation );
			}
		}
		$shortcode_css .= isset( $icon_hcolor ) && $icon_hcolor != '' ? '.' . esc_attr( $rand_class ) . ' .icon-inner:hover { color: '. esc_attr( $icon_hcolor ) .'; }' : '';

		if( isset( $icon_bg_trans ) ){
			if( $icon_bg_trans == 't' ){
				$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .icon-inner { background: transparent; }';
			}elseif( $icon_bg_trans == 'c' ){
				$shortcode_css .= isset( $icon_bg_color ) && $icon_bg_color != '' ? '.' . esc_attr( $rand_class ) . ' .icon-inner { background-color: '. esc_attr( $icon_bg_color ) .'; }' : '';
			}else{
				$icon_class .= ' ' . esc_attr( $icon_bg_trans );
			}
		}

		if( isset( $icon_hbg_trans ) && $icon_hbg_trans == 't' ){
			$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .icon-inner:hover { background: transparent; }';
		}else{
			$shortcode_css .= isset( $icon_hbg_color ) && $icon_hbg_color != '' ? '.' . esc_attr( $rand_class ) . ' .icon-inner:hover { background-color: '. esc_attr( $icon_hbg_color ) .'; }' : '';
		}
		
		if( isset( $border_color ) && $border_color != '' ){
			$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .icon-inner { border-style: solid; border-color: '. esc_attr( $border_color ) .'; }';
			$shortcode_css .= isset( $border_size ) && $border_size != '' ? '.' . esc_attr( $rand_class ) . ' .icon-inner { border-width: '. esc_attr( $border_size ) .'px; }' : '';
		}
		
		if( $shortcode_css ) $class .= ' ' . $shortcode_rand_id . ' megafactory-inline-css';
		
		$output = '';

		$output .= '<div class="icon-wrapper text-center'. esc_attr( $class ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
		
			$output .= '<div class="icon-inner'. esc_attr( $icon_class ) .'">';
				$output .= '<span class="'. esc_attr( $icon ) .'"></span>';
			$output .= '</div><!-- .icon-inner -->';
			
		$output .= '</div><!-- .icon-wrapper -->';

		return $output;
	}
}

if ( ! function_exists( "megafactory_vc_icons_shortcode_map" ) ) {
	function megafactory_vc_icons_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Icon", "megafactory" ),
				"description"			=> esc_html__( "Attractive icons.", "megafactory" ),
				"base"					=> "megafactory_vc_icons",
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
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Font Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the font color.", "megafactory" ),
						"param_name"	=> "font_color",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "animation_style",
						"heading"		=> esc_html__( "Animation Style", "megafactory" ),
						"description"	=> esc_html__( "Choose your animation style.", "megafactory" ),
						"param_name"	=> "animation",
						'admin_label'	=> false,
                		'weight'		=> 0,
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "img_select",
						"heading"		=> esc_html__( "Icon Layout", "megafactory" ),
						"param_name"	=> "icon_layout",
						"img_lists" => array ( 
							"1"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/icon/1.png",
							"2"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/icon/2.png",
							"3"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/icon/3.png"
						),
						"default"		=> "1",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Icon Size", "megafactory" ),
						"description" 	=> esc_html__( "This is option for set icon size. Example 30", "megafactory" ),
						"param_name"	=> "icon_size",
						"value" 		=> "30",
						"group"			=> esc_html__( "Icon", "megafactory" ),
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Choose from Icon library", "megafactory" ),
						"value" 		=> array(
							esc_html__( "None", "megafactory" ) 				=> "",
							esc_html__( "Font Awesome", "megafactory" ) 		=> "fontawesome",
							esc_html__( "Simple Line Icons", "megafactory" ) => "simplelineicons",
						),
						"admin_label" 	=> true,
						"param_name" 	=> "icon_type",
						"description" 	=> esc_html__( "Select icon library.", "megafactory" ),
						"group"			=> esc_html__( "Icon", "megafactory" ),
					),		
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'megafactory' ),
						'param_name' => 'icon_fontawesome',
						"value" 		=> "fa fa-heart-o",
						'settings' => array(
							'emptyIcon' => false,
							'type' => 'fontawesome',
							'iconsPerPage' => 675,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'fontawesome',
						),
						'description' => esc_html__( 'Select icon from library.', 'megafactory' ),
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'megafactory' ),
						'param_name' => 'icon_simplelineicons',
						"value" 	=> "vc_li vc_li-star",
						'settings' => array(
							'emptyIcon' => false,
							'type' => 'simplelineicons',
							'iconsPerPage' => 500,
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value' => 'simplelineicons',
						),
						'description' => esc_html__( 'Select icon from library.', 'megafactory' ),
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Icon Style", "megafactory" ),
						"description"	=> esc_html__( "This is option for feature box icon style.", "megafactory" ),
						"param_name"	=> "icon_variation",
						"value"			=> array(
							esc_html__( "Dark", "megafactory" )		=> "icon-dark",
							esc_html__( "Light", "megafactory" )		=> "icon-light",
							esc_html__( "Theme", "megafactory" )		=> "theme-color",
							esc_html__( "Custom", "megafactory" )	=> "c"
						),
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Icon Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the icons icon color.", "megafactory" ),
						"param_name"	=> "icon_color",
						'dependency' => array(
							'element' => 'icon_variation',
							'value' => 'c',
						),
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Icon Hover Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the icon hover color.", "megafactory" ),
						"param_name"	=> "icon_hcolor",
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Icon Background", "megafactory" ),
						"value" 		=> array(
							esc_html__( "Transparent", "megafactory" ) => "t",
							esc_html__( "Theme Color", "megafactory" ) => "theme-color-bg",
							esc_html__( "Set Color", "megafactory" )=> "c"
						),
						"param_name" 	=> "icon_bg_trans",
						"group"			=> esc_html__( "Icon", "megafactory" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Icon Background Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the icon background color.", "megafactory" ),
						"param_name"	=> "icon_bg_color",
						'dependency' => array(
							'element' => 'icon_bg_trans',
							'value' => 'c',
						),
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Icon Background Hover", "megafactory" ),
						"value" 		=> array(
							esc_html__( "Transparent", "megafactory" ) => "t",
							esc_html__( "Set Color", "megafactory" )=> "c"
						),
						"param_name" 	=> "icon_hbg_trans",
						"group"			=> esc_html__( "Icon", "megafactory" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Icon Background Hover Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the icon background hover color.", "megafactory" ),
						"param_name"	=> "icon_hbg_color",
						'dependency' => array(
							'element' => 'icon_hbg_trans',
							'value' => 'c',
						),
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Icon Style", "megafactory" ),
						"value" 		=> array(
							esc_html__( "Squared", "megafactory" ) => "squared",
							esc_html__( "Rounded", "megafactory" ) => "rounded",
							esc_html__( "Circled", "megafactory" ) => "rounded-circle",
						),
						"param_name" 	=> "icon_style",
						"group"			=> esc_html__( "Icon", "megafactory" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Border Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the border color.", "megafactory" ),
						"param_name"	=> "border_color",
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Border Size", "megafactory" ),
						"param_name"	=> "border_size",
						"value" 		=> "",
						"group"			=> esc_html__( "Icon", "megafactory" )
					)
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_icons_shortcode_map" );