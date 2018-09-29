<?php 
/**
 * Megafactory Contact Form
 */

if ( ! function_exists( "megafactory_vc_contact_form_shortcode" ) ) {
	function megafactory_vc_contact_form_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_contact_form", $atts ); 
		extract( $atts );
		
		$output = '';
		
		//Define Variables
		$animation = isset( $animation ) ? $animation : '';
		$class = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';		
		$class .= isset( $contact_style ) ? ' contact-form-' . $contact_style : '';	
		$class .= isset( $text_align ) && $text_align != 'default' ? ' text-' . $text_align : '';
		$title = isset( $title ) && $title != '' ? $title : '';			
		
		// Get VC Animation
		$class .= megafactoryGetCSSAnimation( $animation );
		
		// This is custom css options for main shortcode warpper
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		
		//Shortcode css ccde here
		$shortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $rand_class ) . '.contact-form-wrapper { color: '. esc_attr( $font_color ) .'; }' : '';
		
		if( $shortcode_css ) $class .= ' ' . $shortcode_rand_id . ' megafactory-inline-css';

		$output .= '<div class="contact-form-wrapper'. esc_attr( $class ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
			$output .= $title ? '<h3 class="contact-form-title">'. esc_html( $title ) .'</h3>' : '';
			if( isset( $contact_form ) && $contact_form != '' ){
				$output .= '<div class="contact-form">';
					$output .= do_shortcode( '[contact-form-7 id="'. esc_attr( $contact_form ) .'"]' );
				$output .= '</div><!-- .contact-form -->';
			}
		$output .= '</div><!-- .contact-form-wrapper -->';

		return $output;
	}
}

if ( ! function_exists( "megafactory_vc_contact_form_shortcode_map" ) ) {
	function megafactory_vc_contact_form_shortcode_map() {
	
		$contact_forms = array();
		if( class_exists( "WPCF7" ) ){
			$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
			if( $data = get_posts( $args ) ){
				foreach( $data as $key ){
					$contact_forms[$key->post_title] = $key->ID;
				}
			}
		}	
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Contact Form", "megafactory" ),
				"description"			=> esc_html__( "Stylish Contact Form.", "megafactory" ),
				"base"					=> "megafactory_vc_contact_form",
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
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Contact Form Title", "megafactory" ),
						"description"	=> esc_html__( "Enter contact form title.", "megafactory" ),
						"param_name"	=> "title",
						"value" 		=> "",
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Contact Form", "megafactory" ),
						"description"	=> esc_html__( "Choose contact form which you want to show.", "megafactory" ),
						"param_name"	=> "contact_form",
						"value"			=> $contact_forms,
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
						"heading"		=> esc_html__( "Contact Form Style", "megafactory" ),
						"description"	=> esc_html__( "This is option for contact form layout.", "megafactory" ),
						"param_name"	=> "contact_style",
						"value"			=> array(
							esc_html__( "Default", "megafactory" )	=> "default",
							esc_html__( "Classic", "megafactory" )	=> "classic",
							esc_html__( "Material", "megafactory" )	=> "material",
							esc_html__( "Grey", "megafactory" )		=> "grey",
							esc_html__( "Minimal", "megafactory" )	=> "minimal"
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Text Align", "megafactory" ),
						"description"	=> esc_html__( "This is option for day counter text align", "megafactory" ),
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
add_action( "vc_before_init", "megafactory_vc_contact_form_shortcode_map" );