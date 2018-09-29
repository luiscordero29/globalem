<?php 
/**
 * Megafactory Counter
 */

if ( ! function_exists( "megafactory_vc_counter_shortcode" ) ) {
	function megafactory_vc_counter_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_counter", $atts );
		extract( $atts );
		
		//Define Variables
		$title = isset( $title ) && $title != '' ? $title : '';
		$content = isset( $content ) && $content != '' ? $content : '';
		$count_val = isset( $count_val ) && $count_val != '' ? $count_val : '';
		$icon_type = isset( $icon_type ) ? $icon_type : '';
		$animation = isset( $animation ) ? $animation : '';
		$icon = 'icon_' . esc_attr( $icon_type );
		$icon = isset( $$icon ) ? $$icon : '';
		$icon_variation = isset( $icon_variation ) ? $icon_variation : '';
		$icon_color = isset( $icon_color ) && $icon_variation == 'custom' ? $icon_color : '';
		
		$class = isset( $extra_class ) && $extra_class != '' ? $extra_class : '';	
		$counter_layout = isset( $counter_layout ) ? $counter_layout : '1';
		$class .= ' counter-style-' . $counter_layout;		
		$class .= isset( $text_align ) && $text_align != 'default' ? ' text-' . $text_align : '';		
		$icon_class = $icon_variation != 'custom' ? ' ' . $icon_variation : '';
		// Get VC Animation
		$class .= megafactoryGetCSSAnimation( $animation );
		
		// Shortcode Css
		$pshortcode_css = '';
		$pshortcode_rand_id = $prand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		$class .= ' ' . $pshortcode_rand_id;
		
		//Shortcode css code here
		$pshortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $prand_class ) . '.counter-wrapper, .' . esc_attr( $prand_class ) . '.counter-wrapper h3, .' . esc_attr( $prand_class ) . '.counter-wrapper h4 { color: '. esc_attr( $font_color ) .'; }' : '';
		
		if( $pshortcode_css ) $class .= ' megafactory-inline-css';
		
		$shortcode_css = '';
		if( $icon_color ){
			$rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
			$class .= ' ' . $rand_class;
			$icon_class .= ' megafactory-inline-css';
			$shortcode_css = '.' . esc_attr( $rand_class ) . ' .counter-icon > span { color: '. esc_attr( $icon_color ) .'; }';
		}
		
		$output = '';
		
		$elemetns = isset( $counter_items ) ? megafactory_drag_and_drop_trim( $counter_items ) : array( 'Enabled' => '' );
	
		if( isset( $elemetns['Enabled'] ) ) :
		
			$output .= '<div class="counter-wrapper'. esc_attr( $class ) .'" data-css="'. htmlspecialchars( json_encode( $pshortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
			
				if( $counter_layout == '4' ){
					$output .= '<div class="media">';
						$output .= '<div class="counter-icon'. esc_attr( $icon_class ) .' mr-3" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
							$output .= '<span class="'. esc_attr( $icon ) .'"></span>';
						$output .= '</div><!-- .counter-icon -->';
						$output .= '<div class="media-body">';		
				}
		
				foreach( $elemetns['Enabled'] as $element => $value ){
					switch( $element ){
		
						case "title":
							$output .= '<div class="counter-title">';
								$output .= '<h4>'. esc_html( $title ) .'</h4>';
							$output .= '</div><!-- .counter-title -->';		
						break;
				
						case "icon":
							if( $counter_layout != '4' ):
								$output .= '<div class="counter-icon'. esc_attr( $icon_class ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
									$output .= '<span class="'. esc_attr( $icon ) .'"></span>';
								$output .= '</div><!-- .counter-icon -->';
							endif;
						break;
						
						case "count":
							$output .= '<div class="counter-value">';
								$output .= '<h3><span class="counter-up" data-count="'. esc_attr( $count_val ) .'">0</span></h3>';
							$output .= '</div><!-- .counter-value -->';	
						break;
						
						case "content":
							$output .= '<div class="counter-content">';
								$output .= '<p>'. esc_textarea( $content ) .'</p>';
							$output .= '</div><!-- .counter-read-more -->';		
						break;
						
					}
				} // foreach end
				
				if( $counter_layout == '4' ){
						$output .= '</div><!-- .media-body -->';
					$output .= '</div><!-- .media -->';	
				}
				
			$output .= '</div><!-- .counter-wrapper -->';
				
		endif;

		return $output;
	}
}

if ( ! function_exists( "megafactory_vc_counter_shortcode_map" ) ) {
	function megafactory_vc_counter_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Counter", "megafactory" ),
				"description"			=> esc_html__( "Numeric counter.", "megafactory" ),
				"base"					=> "megafactory_vc_counter",
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
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Title", "megafactory" ),
						"description"	=> esc_html__( "Here you put the counter title.", "megafactory" ),
						"param_name"	=> "title",
						"value" 		=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Count", "megafactory" ),
						"description"	=> esc_html__( "Here you can place counter value. Example 200", "megafactory" ),
						"param_name"	=> "count_val",
						"value" 		=> "",
					),
					array(
						"type"			=> "textarea",
						"heading"		=> esc_html__( "Content", "megafactory" ),
						"description"	=> esc_html__( "Here you put the counter content.", "megafactory" ),
						"param_name"	=> "content",
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
						"heading"		=> esc_html__( "Counter Layout", "megafactory" ),
						"param_name"	=> "counter_layout",
						"img_lists" => array ( 
							"1"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/counter/1.png",
							"2"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/counter/2.png",
							"3"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/counter/3.png",
							"4"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/counter/4.png"
						),
						"default"		=> "1",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						'type'			=> 'drag_drop',
						'heading'		=> esc_html__( 'Counter Items', 'megafactory' ),
						"description"	=> esc_html__( "This is settings for counter custom layout. here you can set your own layout. Drag and drop needed counter items to Enabled part.", "megafactory" ),
						'param_name'	=> 'counter_items',
						'dd_fields' => array ( 
							'Enabled' => array( 
								'icon'	=> esc_html__( 'Icon', 'megafactory' ),
								'count'	=> esc_html__( 'Count Value', 'megafactory' ),
								'title'	=> esc_html__( 'Title', 'megafactory' )
								
							),
							'disabled' => array(
								'content'	=> esc_html__( 'Content', 'megafactory' )
							)
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
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
						"group"			=> esc_html__( "Layouts", "megafactory" ),
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
						"group"			=> esc_html__( "Layouts", "megafactory" )
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
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Icon Style", "megafactory" ),
						"description"	=> esc_html__( "This is option for counter icon style.", "megafactory" ),
						"param_name"	=> "icon_variation",
						"value"			=> array(
							esc_html__( "Dark", "megafactory" )		=> "icon-dark",
							esc_html__( "Light", "megafactory" )		=> "icon-light",
							esc_html__( "Theme", "megafactory" )		=> "theme-color",
							esc_html__( "Custom", "megafactory" )	=> "custom"
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Icon Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the counter icon color.", "megafactory" ),
						"param_name"	=> "icon_color",
						'dependency' => array(
							'element' => 'icon_variation',
							'value' => 'custom',
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),					
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Text Align", "megafactory" ),
						"description"	=> esc_html__( "This is option for counter text align", "megafactory" ),
						"param_name"	=> "text_align",
						"value"			=> array(
							esc_html__( "Default", "megafactory" )	=> "default",
							esc_html__( "Left", "megafactory" )		=> "left",
							esc_html__( "Center", "megafactory" )	=> "center",
							esc_html__( "Right", "megafactory" )		=> "right"
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_counter_shortcode_map" );