<?php 
/**
 * Megafactory Section Title
 */

if ( ! function_exists( "megafactory_vc_section_title_shortcode" ) ) {
	function megafactory_vc_section_title_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_section_title", $atts ); 
		extract( $atts );
		
		$output = '';
		
		//Define Variables
		$animation = isset( $animation ) ? $animation : '';
		$class = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';		
		$class .= isset( $text_align ) && $text_align != 'default' ? ' text-' . $text_align : '';	
		
		$title = isset( $title ) ? $title : '';
		$title_head = isset( $title_head ) ? $title_head : 'h1';
		
		// Get VC Animation
		$class .= megafactoryGetCSSAnimation( $animation );
		
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		
		// Title Color/ Title Prefix / Title Suffix Coloe CSS / Title Typo Settings
		$shortcode_css .= isset( $title_prefix_color ) && $title_prefix_color != '' ? '.' . esc_attr( $rand_class ) . ' .section-title .title-prefix { color: '. esc_attr( $title_prefix_color ) .'; }' : '';
		$shortcode_css .= isset( $title_suffix_color ) && $title_suffix_color != '' ? '.' . esc_attr( $rand_class ) . ' .section-title .title-suffix { color: '. esc_attr( $title_suffix_color ) .'; }' : '';
		$shortcode_css .= isset( $title_margin ) && $title_margin != '' ? '.' . esc_attr( $rand_class ) . ' .title-wrap { margin: '. esc_attr( $title_margin ) .'; }' : '';
		
		
		$sep_border_color = isset( $sep_border_color ) ? $sep_border_color : '';
		$shortcode_css .= isset( $sep_type ) && $sep_type == 'border' ? '.' . esc_attr( $rand_class ) . ' .title-separator.separator-border { background-color: '. esc_attr( $sep_border_color ) .'; }' : '';
		
		$shortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $rand_class ) . '.section-title-wrapper { color: '. esc_attr( $font_color ) .'; }' : '';
		$shortcode_css .= isset( $sub_title_color ) && $sub_title_color != '' ? '.' . esc_attr( $rand_class ) . '.section-title-wrapper .sub-title { color: '. esc_attr( $sub_title_color ) .'; }' : '';
		
		
		$title_css = isset( $title_color ) && $title_color != '' ? ' color: '. esc_attr( $title_color ) .';' : '';
		$title_css .= isset( $font_size ) && $font_size != '' ? ' font-size: '. esc_attr( $font_size ) .'px;' : '';
		$title_css .= isset( $line_height ) && $line_height != '' ? ' line-height: '. esc_attr( $line_height ) .'px;' : '';
		$title_css .= isset( $title_trans ) && $title_trans != '' ? ' text-transform: '. esc_attr( $title_trans ) .';' : '';
		
		$shortcode_css .= $title_css != '' ? '.' . esc_attr( $rand_class ) . ' .section-title {' . $title_css . ' }' : '';
		
		if( $shortcode_css ) $class .= ' ' . $shortcode_rand_id . ' megafactory-inline-css';
		
		$sub_title = isset( $sub_title ) && $sub_title != '' ? '<span class="sub-title">'. esc_html( $sub_title ) .'</span>' : '';
		$sub_title_pos = isset( $sub_title_pos ) ? $sub_title_pos : 'bottom';
		
		$output .= '<div class="section-title-wrapper'. esc_attr( $class ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
			
			$output .= '<div class="title-wrap">';
				// Section title 
				$output .= $sub_title != '' && $sub_title_pos == 'top' ? $sub_title : '';
				$output .= '<' . esc_attr( $title_head ) . ' class="section-title">';
					$output .= isset( $title_prefix ) && $title_prefix != '' ? '<span class="title-prefix theme-color">' . esc_html( $title_prefix ) . '</span> ' : '';
					$output .= esc_html( $title );
					$output .= isset( $title_suffix ) && $title_suffix != '' ? ' <span class="title-suffix theme-color">' . esc_html( $title_suffix ) . '</span>' : '';
				$output .= '</' . esc_attr( $title_head ) . '>';
				$output .= $sub_title != '' && $sub_title_pos == 'bottom' ? $sub_title : '';
				
				// Section title separator 
				$sep_type = isset( $sep_type ) ? $sep_type : 'border';
				if( $sep_type == 'border' ){
					$output .= '<span class="title-separator separator-border theme-color-bg"></span>';
				}elseif( $sep_type == 'image' ){
					$img_attr = wp_get_attachment_image_src( absint( $sep_image ), 'full', true );
					$image_alt = get_post_meta( absint( $sep_image ), '_wp_attachment_image_alt', true);
					$output .= isset( $img_attr[0] ) ? '<span class="title-separator separator-img"><img class="img-fluid" src="'. esc_url( $img_attr[0] ) .'" width="'. esc_attr( $img_attr[1] ) .'" height="'. esc_attr( $img_attr[2] ) .'" alt="'. esc_html( $image_alt ) .'" /></span>' : '';
				}
			$output .= '</div><!-- .title-wrap -->';
			
			$output .= '<div class="section-description">';
				$output .= isset( $content ) && $content != '' ? wp_kses_post( $content ) : '';
				$btn_url = isset( $btn_url ) ? $btn_url : '';
				$btn_type = isset( $btn_type ) ? $btn_type : '';
				$output .= isset( $btn_text ) && $btn_text != '' ? '<p><a class="btn '. esc_attr( $btn_type ) .'" href="'. esc_html( $btn_url ) .'" title="'. esc_html( $btn_text ) .'">'. esc_html( $btn_text ) .'</a></p>' : '';
			$output .= '</div><!-- .section-description -->';
			
		$output .= '</div><!-- .section-title-wrapper -->';

		return $output;
	}
}

if ( ! function_exists( "megafactory_vc_section_title_shortcode_map" ) ) {
	function megafactory_vc_section_title_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Section Title", "megafactory" ),
				"description"			=> esc_html__( "Variant section title.", "megafactory" ),
				"base"					=> "megafactory_vc_section_title",
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
						"heading"		=> esc_html__( "Title Heading Tag", "megafactory" ),
						"description"	=> esc_html__( "This is option for title heading tag", "megafactory" ),
						"param_name"	=> "title_head",
						"value"			=> array(
							esc_html__( "H1", "megafactory" )=> "h1",
							esc_html__( "H2", "megafactory" )=> "h2",
							esc_html__( "H3", "megafactory" )=> "h3",
							esc_html__( "H4", "megafactory" )=> "h4",
							esc_html__( "H5", "megafactory" )=> "h5",
							esc_html__( "H6", "megafactory" )=> "h6"
						),
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Title", "megafactory" ),
						"description"	=> esc_html__( "Enter section title here.", "megafactory" ),
						"param_name"	=> "title",
						"value" 		=> "",
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Title Prefix", "megafactory" ),
						"description"	=> esc_html__( "Enter section title prefix. If no need title prefix, then leave this box blank.", "megafactory" ),
						"param_name"	=> "title_prefix",
						"value" 		=> "",
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Title Suffix", "megafactory" ),
						"description"	=> esc_html__( "Enter section title suffix. If no need title suffix, then leave this box blank.", "megafactory" ),
						"param_name"	=> "title_suffix",
						"value" 		=> "",
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Text Align", "megafactory" ),
						"description"	=> esc_html__( "This is option for section title text align.", "megafactory" ),
						"param_name"	=> "text_align",
						"value"			=> array(
							esc_html__( "Default", "megafactory" )	=> "default",
							esc_html__( "Left", "megafactory" )		=> "left",
							esc_html__( "Center", "megafactory" )	=> "center",
							esc_html__( "Right", "megafactory" )		=> "right"
						),
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Title Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can set the section title color.", "megafactory" ),
						"param_name"	=> "title_color",
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Title Prefix Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can set the section prefix title color.", "megafactory" ),
						"param_name"	=> "title_prefix_color",
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Title Suffix Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can set the section title suffix color.", "megafactory" ),
						"param_name"	=> "title_suffix_color",
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Font Size", "megafactory" ),
						"description"	=> esc_html__( "Enter title font size. Example 30.", "megafactory" ),
						"param_name"	=> "font_size",
						"value" 		=> "",
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Line Height", "megafactory" ),
						"description"	=> esc_html__( "Enter title line height. Example 30.", "megafactory" ),
						"param_name"	=> "line_height",
						"value" 		=> "",
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Title Text Transform", "megafactory" ),
						"param_name" 	=> "title_trans",
						"value" 		=> array(
							esc_html__( "None", "megafactory" ) => "none",
							esc_html__( "Capitalize", "megafactory" ) => "capitalize",
							esc_html__( "Upper Case", "megafactory" )=> "uppercase",
							esc_html__( "Lower Case", "megafactory" )=> "lowercase"
						),
						"group"			=> esc_html__( "Title", "megafactory" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Title Margin", "megafactory" ),
						"description"	=> esc_html__( "Enter title margin here. Example 30px 20px 30px 20px.", "megafactory" ),
						"param_name"	=> "title_margin",
						"value" 		=> "",
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Sub Title", "megafactory" ),
						"description"	=> esc_html__( "Enter section title here. If no need sub title, then leave this box blank.", "megafactory" ),
						"param_name"	=> "sub_title",
						"value" 		=> "",
						"group"			=> esc_html__( "Sub Title", "megafactory" ),
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Sub Title Position", "megafactory" ),
						"param_name" 	=> "sub_title_pos",
						"value" 		=> array(
							esc_html__( "Bottom", "megafactory" ) => "bottom",
							esc_html__( "Top", "megafactory" )=> "top"
						),
						"group"			=> esc_html__( "Sub Title", "megafactory" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Sub Title Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can set the section sub title color.", "megafactory" ),
						"param_name"	=> "sub_title_color",
						"group"			=> esc_html__( "Sub Title", "megafactory" )
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Separator Type", "megafactory" ),
						"param_name" 	=> "sep_type",
						"value" 		=> array(
							esc_html__( "None", "megafactory" ) => "none",
							esc_html__( "Border", "megafactory" ) => "border",
							esc_html__( "Image", "megafactory" )=> "image"
						),
						"group"			=> esc_html__( "Separator", "megafactory" ),
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Title Separator Border", "megafactory" ),
						"description"	=> esc_html__( "Here you can set the section title separator border color.", "megafactory" ),
						"param_name"	=> "sep_border_color",
						'dependency' => array(
							'element' => 'sep_type',
							'value' => 'border',
						),
						"group"			=> esc_html__( "Separator", "megafactory" )
					),
					array(
						"type" => "attach_image",
						"heading" => esc_html__( "Separator Image", "megafactory" ),
						"description" => esc_html__( "Choose section title separator image.", "megafactory" ),
						"param_name" => "sep_image",
						"value" => '',
						'dependency' => array(
							'element' => 'sep_type',
							'value' => 'image',
						),
						"group"			=> esc_html__( "Separator", "megafactory" ),
					),
					array(
						"type"			=> "textarea_html",
						"heading"		=> esc_html__( "Content", "megafactory" ),
						"description"	=> esc_html__( "Enter section title below content.", "megafactory" ),
						"param_name"	=> "content",
						"value" 		=> "",
						"group"			=> esc_html__( "Content", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Button Text", "megafactory" ),
						"description"	=> esc_html__( "Enter section button text here. If no need button, then leave this box blank.", "megafactory" ),
						"param_name"	=> "btn_text",
						"value" 		=> "",
						"group"			=> esc_html__( "Button", "megafactory" ),
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Button URL", "megafactory" ),
						"description"	=> esc_html__( "Enter section button url here. If no need button url, then leave this box blank.", "megafactory" ),
						"param_name"	=> "btn_url",
						"value" 		=> "",
						"group"			=> esc_html__( "Button", "megafactory" ),
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Button Type", "megafactory" ),
						"param_name" 	=> "btn_type",
						"value" 		=> array(
							esc_html__( "Default", "megafactory" )	=> "default",
							esc_html__( "Link", "megafactory" )		=> "link",
							esc_html__( "Classic", "megafactory" )	=> "classic",
							esc_html__( "Bordered", "megafactory" )	=> "bordered",
							esc_html__( "Inverse", "megafactory" )	=> "inverse"
						),
						"group"			=> esc_html__( "Button", "megafactory" ),
					),
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_section_title_shortcode_map" );