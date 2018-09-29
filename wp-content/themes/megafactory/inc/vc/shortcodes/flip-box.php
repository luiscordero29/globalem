<?php 
/**
 * Megafactory Flip Box
 */

if ( ! function_exists( "megafactory_vc_flip_box_shortcode" ) ) {
	function megafactory_vc_flip_box_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_flip_box", $atts );
		extract( $atts );

		$output = '';
	
		//Defined Variable
		$animation = isset( $animation ) ? $animation : '';
		$class = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';		
		$class .= isset( $text_align ) && $text_align != 'default' ? ' text-' . $text_align : '';	
		
		// Get VC Animation
		$class .= megafactoryGetCSSAnimation( $animation );
		
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		
		// VC Design Options
		$class .= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), "megafactory_vc_flip_box", $atts );
		
		//Shortcode css ccde here
		$shortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $rand_class ) . '.flip-box-wrapper { color: '. esc_attr( $font_color ) .'; }' : '';
		$shortcode_css .= isset( $font_hcolor ) && $font_hcolor != '' ? '.' . esc_attr( $rand_class ) . '.flip-box-wrapper .flip-back { color: '. esc_attr( $font_hcolor ) .'; }' : '';

		$shortcode_css .= isset( $front_bg ) && $front_bg != '' ? '.' . esc_attr( $rand_class ) . '.flip-box-wrapper .flip-front { background-color: '. esc_attr( $front_bg ) .'; }' : '';
		$shortcode_css .= isset( $back_bg ) && $back_bg != '' ? '.' . esc_attr( $rand_class ) . '.flip-box-wrapper .flip-back { background-color: '. esc_attr( $back_bg ) .'; }' : '';
		$shortcode_css .= isset( $front_padding ) && $front_padding != '' ? '.' . esc_attr( $rand_class ) . '.flip-box-wrapper .flip-front { padding-top: '. esc_attr( $front_padding ) .'px; padding-bottom: '. esc_attr( $front_padding ) .'px; }' : '';
		$shortcode_css .= isset( $back_padding ) && $back_padding != '' ? '.' . esc_attr( $rand_class ) . '.flip-box-wrapper .flip-back { padding-top: '. esc_attr( $back_padding ) .'px; padding-bottom: '. esc_attr( $back_padding ) .'px; }' : '';
		
		
		if( isset( $icon_size ) && $icon_size ){
			$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .flip-box-icon { font-size: '. esc_attr( $icon_size ) .'px; }';
			$dimension = absint( $icon_size ) * 2;
			if( isset( $icon_inner_space ) && !$icon_inner_space )
				$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .flip-box-icon { height: '. esc_attr( $dimension ) .'px; width: '. esc_attr( $dimension ) .'px; }';
		}
		if( isset( $icon_midd ) && $icon_midd ){
			if( isset( $icon_inner_space ) && !$icon_inner_space )
				$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .flip-box-icon { line-height: 2; }';
		}
		
		if( isset( $secondary_icon_size ) && $secondary_icon_size ){
			$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .flip-back .flip-box-icon { font-size: '. esc_attr( $secondary_icon_size ) .'px; }';
			$dimension = absint( $secondary_icon_size ) * 2;
			if( isset( $icon_inner_space ) && !$icon_inner_space )
				$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .flip-back .flip-box-icon { height: '. esc_attr( $dimension ) .'px; width: '. esc_attr( $dimension ) .'px; }';
		}
		
		$icon_type = isset( $icon_type ) ? 'icon_' . $icon_type : '';
		$icon = isset( $$icon_type ) ? $$icon_type : '';
		$icon_class = isset( $icon_style ) ? ' ' . $icon_style : '';
		
		if( isset( $icon_variation ) ){
			if( $icon_variation == 'c' ){
				$shortcode_css .= isset( $icon_color ) && $icon_color != '' ? '.' . esc_attr( $rand_class ) . ' .flip-box-icon { color: '. esc_attr( $icon_color ) .'; }' : '';
			}else{
				$icon_class .= ' ' . esc_attr( $icon_variation );
			}
		}
		$shortcode_css .= isset( $icon_hcolor ) && $icon_hcolor != '' ? '.' . esc_attr( $rand_class ) . ':hover .flip-box-icon { color: '. esc_attr( $icon_hcolor ) .'; }' : '';

		if( isset( $icon_bg_trans ) ){
			if( $icon_bg_trans == 't' ){
				$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .flip-box-icon { background: transparent; }';
			}elseif( $icon_bg_trans == 'c' ){
				$shortcode_css .= isset( $icon_bg_color ) && $icon_bg_color != '' ? '.' . esc_attr( $rand_class ) . ' .flip-box-icon { background-color: '. esc_attr( $icon_bg_color ) .'; }' : '';
			}else{
				$icon_class .= ' ' . esc_attr( $icon_bg_trans );
			}
		}

		if( isset( $icon_hbg_trans ) && $icon_hbg_trans == 't' ){
			$shortcode_css .= '.' . esc_attr( $rand_class ) . ':hover .flip-box-icon { background: transparent; }';
		}else{
			$shortcode_css .= isset( $icon_hbg_color ) && $icon_hbg_color != '' ? '.' . esc_attr( $rand_class ) . ':hover .flip-box-icon { background-color: '. esc_attr( $icon_hbg_color ) .'; }' : '';
		}
		
		if( isset( $border_color ) && $border_color != '' ){
			$shortcode_css .= '.' . esc_attr( $rand_class ) . ' .flip-box-icon { border-style: solid; border-color: '. esc_attr( $border_color ) .'; }';
			$shortcode_css .= isset( $border_size ) && $border_size != '' ? '.' . esc_attr( $rand_class ) . ' .icon-inner { border-width: '. esc_attr( $border_size ) .'px; }' : '';
		}
		
		//Button Properties
		$btnn_txt = $btnn_type = $btnn_url = '';
		if( isset( $btn_text ) && $btn_text != '' ){
			$btnn_txt = $btn_text;
			$btnn_url = isset( $btn_url ) ? $btn_url : '';
			$btnn_type = isset( $btn_type ) ? $btn_type : '';
		}
		
		if( $shortcode_css ) $class .= ' ' . $shortcode_rand_id . ' megafactory-inline-css';
		
		$title = isset( $title ) ? $title : '';
		$title_head = isset( $title_head ) ? $title_head : 'h2';

		$img_class = isset( $img_style ) ? ' ' . $img_style : ''; 
		$fbox_image = isset( $fbox_image ) ? ' ' . $fbox_image : '';
		
		$content = isset( $content ) && $content != '' ? $content : '';
		
		$layout = isset( $layout ) ? $layout : 'normal';
			
		$output .= '<div class="flip-box-wrapper'. esc_attr( $class ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
			
			$opt_array = array(
				'icon_class' => $icon_class,
				'icon' => $icon,
				'img_id' => $fbox_image,
				'img_class' => $img_class,
				'title' => $title,
				'title_head' => $title_head,
				'content' => $content,
				'btn_text' => $btnn_txt,
				'btn_url' => $btnn_url,
				'btn_type' => $btnn_type
			);
			
			$inner_class = isset( $flip_style ) ? ' ' . $flip_style : ' imghvr-push-up';

			$p_elemetns = isset( $fbox_primary_items ) ? megafactory_drag_and_drop_trim( $fbox_primary_items ) : array( 'Enabled' => '' );
			$s_elemetns = isset( $fbox_secondary_items ) ? megafactory_drag_and_drop_trim( $fbox_secondary_items ) : array( 'Enabled' => '' );
			
			$output .= '<div class="flip-inner'. esc_attr( $inner_class ) .'">';
				$output .= '<div class="flip-front">';
					if( isset( $p_elemetns['Enabled'] ) ) :
						foreach( $p_elemetns['Enabled'] as $element => $value ){
							$output .= megafactory_flip_box_shortcode_elements( $element, $opt_array );
						}
					endif;
				$output .= '</div><!-- .flip-front -->';
				
				$output .= '<div class="flip-back">';
					if( isset( $s_elemetns['Enabled'] ) ) :
						foreach( $s_elemetns['Enabled'] as $element => $value ){
							$output .= megafactory_flip_box_shortcode_elements( $element, $opt_array );
						}
					endif;
				$output .= '</div><!-- .flip-back -->';
			$output .= '</div><!-- .flip-inner -->';

		$output .= '</div><!-- .flip-box-wrapper -->';
		
		return $output;
	}
}

function megafactory_flip_box_shortcode_elements( $element, $opts ){
	$output = '';
	switch( $element ){
	
		case "title":
			$output .= '<div class="flip-box-title">';
				$output .= '<' . esc_attr( $opts['title_head'] ) . ' class="section-title">';
					$output .= esc_html( $opts['title'] );
				$output .= '</' . esc_attr( $opts['title_head'] ) . '>';
			$output .= '</div><!-- .flip-box-title -->';		
		break;
		
		case "icon":
			$icon_class = $opts['icon_class'];
			$icon = $opts['icon'];
			$output .= '<div class="flip-box-icon text-center'. esc_attr( $icon_class ) .'">';
				$output .= '<span class="'. esc_attr( $icon ) .'"></span>';
			$output .= '</div><!-- .flip-box-icon -->';
		break;
		
		case "image":
			$img_id = $opts['img_id'];
			$img_class = $opts['img_class'];
			$img_attr = wp_get_attachment_image_src( absint( $img_id ), 'full', true );
			if( isset( $img_attr ) ):
				$output .= '<div class="flip-box-thumb">';
					$image_alt = get_post_meta( absint( $img_id ), '_wp_attachment_image_alt', true);
					$image_alt = $image_alt != '' ? $image_alt : esc_html( $opts['title'] );
					$output .= isset( $img_attr[0] ) ? '<img class="img-fluid'. esc_attr( $img_class ) .'" src="'. esc_url( $img_attr[0] ) .'" width="'. esc_attr( $img_attr[1] ) .'" height="'. esc_attr( $img_attr[2] ) .'" alt="'. esc_html( $image_alt ) .'" />' : '';
				$output .= '</div><!-- .flip-box-thumb -->';
			endif;
		break;
		
		case "btn":
			if( $opts['btn_text'] != '' ):
				$output .= '<div class="flip-box-btn">';
					$output .= '<a class="btn '. esc_attr( $opts['btn_type'] ) .'" href="'. esc_html( $opts['btn_url'] ) .'" title="'. esc_html( $opts['btn_text'] ) .'">'. esc_html( $opts['btn_text'] ) .'</a>';
				$output .= '</div><!-- .flip-box-btn -->';
			endif;
		break;
		
		case "content":
			if( $opts['content'] != '' ):
				$output .= '<div class="flip-box-content">';
					$output .= wp_kses_post( $opts['content'] );
				$output .= '</div><!-- .flip-box-content -->';
			endif;
		break;
		
	}
	return $output; 
}

if ( ! function_exists( "megafactory_vc_flip_box_shortcode_map" ) ) {
	function megafactory_vc_flip_box_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Flip Box", "megafactory" ),
				"description"			=> esc_html__( "Animated flip box.", "megafactory" ),
				"base"					=> "megafactory_vc_flip_box",
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
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Text Align", "megafactory" ),
						"description"	=> esc_html__( "This is option for flip box text align", "megafactory" ),
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
						'type'			=> 'drag_drop',
						'heading'		=> esc_html__( 'Primary Box Items', 'megafactory' ),
						"description"	=> esc_html__( "This is settings for primary box custom layout. here you can set your own layout. Drag and drop needed flip items to enabled part.", "megafactory" ),
						'param_name'	=> 'fbox_primary_items',
						'dd_fields' => array ( 
							'Enabled' => array( 
								'icon'	=> esc_html__( 'Icon', 'megafactory' ),
								'title'	=> esc_html__( 'Title', 'megafactory' ),
								'content'	=> esc_html__( 'Content', 'megafactory' )					
							),
							'disabled' => array(
								'btn'	=> esc_html__( 'Button', 'megafactory' ),
								'image'	=> esc_html__( 'Image', 'megafactory' )
							)
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						'type'			=> 'drag_drop',
						'heading'		=> esc_html__( 'Secondary Box Items', 'megafactory' ),
						"description"	=> esc_html__( "This is settings for secondary box custom layout. here you can set your own layout. Drag and drop needed flip items to enabled part.", "megafactory" ),
						'param_name'	=> 'fbox_secondary_items',
						'dd_fields' => array ( 
							'Enabled' => array( 
								'icon'	=> esc_html__( 'Icon', 'megafactory' ),
								'title'	=> esc_html__( 'Title', 'megafactory' ),
								'content'	=> esc_html__( 'Content', 'megafactory' )					
							),
							'disabled' => array(
								'btn'	=> esc_html__( 'Button', 'megafactory' ),
								'image'	=> esc_html__( 'Image', 'megafactory' )
							)
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Font Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the font color.", "megafactory" ),
						"param_name"	=> "font_color",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Flip Box Secondary Font Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the flip box secondary color.", "megafactory" ),
						"param_name"	=> "font_hcolor",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Flip Box Primary Background Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for before animate box background.", "megafactory" ),
						"param_name"	=> "front_bg",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Flip Box Secondary Background Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for after animate box background.", "megafactory" ),
						"param_name"	=> "back_bg",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Flip Box Primary Padding", "megafactory" ),
						"description"	=> esc_html__( "This is padding top and bottom settings for before animate box( primary box ). Example 20", "megafactory" ),
						"param_name"	=> "front_padding",
						"value" 		=> "20",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Flip Box Secondary Padding", "megafactory" ),
						"description"	=> esc_html__( "This is padding top and bottom settings for after animate box( secondary box ). Example 20", "megafactory" ),
						"param_name"	=> "back_padding",
						"value" 		=> "20",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Flip Box Hover Styles", "megafactory" ),
						"description"	=> esc_html__( "This is option for hover animation style flip box.", "megafactory" ),
						"param_name"	=> "flip_style",
						"value"			=> array(
							esc_html__( "Fade", "megafactory" )=> "imghvr-fade",
							esc_html__( "Push Up", "megafactory" )=> "imghvr-push-up",
							esc_html__( "Push Down", "megafactory" )=> "imghvr-push-down",
							esc_html__( "Push Left", "megafactory" )=> "imghvr-push-left",
							esc_html__( "Push Right", "megafactory" )=> "imghvr-push-right",
							esc_html__( "Slide Up", "megafactory" )=> "imghvr-slide-up",
							esc_html__( "Slide Down", "megafactory" )=> "imghvr-slide-down",
							esc_html__( "Slide Left", "megafactory" )=> "imghvr-slide-left",
							esc_html__( "Slide Right", "megafactory" )=> "imghvr-slide-right",
							esc_html__( "Reveal Up", "megafactory" )=> "imghvr-reveal-up",
							esc_html__( "Reveal Down", "megafactory" )=> "imghvr-reveal-down",
							esc_html__( "Reveal Left", "megafactory" )=> "imghvr-reveal-left",
							esc_html__( "Reveal Right", "megafactory" )=> "imghvr-reveal-right",
							esc_html__( "Hinge Up", "megafactory" )=> "imghvr-hinge-up",
							esc_html__( "Hinge Down", "megafactory" )=> "imghvr-hinge-down",
							esc_html__( "Hinge Left", "megafactory" )=> "imghvr-hinge-left",
							esc_html__( "Hinge Right", "megafactory" )=> "imghvr-hinge-right",
							esc_html__( "Flip Horizontal", "megafactory" )=> "imghvr-flip-horiz",
							esc_html__( "Flip Vertical", "megafactory" )=> "imghvr-flip-vert",
							esc_html__( "Diagonal 1", "megafactory" )=> "imghvr-flip-diag-1",
							esc_html__( "Diagonal 2", "megafactory" )=> "imghvr-flip-diag-2",
							esc_html__( "Shutter Out Horizontal", "megafactory" )=> "imghvr-shutter-out-horiz",
							esc_html__( "Shutter Out Vertical", "megafactory" )=> "imghvr-shutter-out-vert",
							esc_html__( "Shutter Out Diagonal 1", "megafactory" )=> "imghvr-shutter-out-diag-1",
							esc_html__( "Shutter Out Diagonal 2", "megafactory" )=> "imghvr-shutter-out-diag-2",
							esc_html__( "Shutter In Horizontal", "megafactory" )=> "imghvr-shutter-in-horiz",
							esc_html__( "Shutter In Vertical", "megafactory" )=> "imghvr-shutter-in-vert",
							esc_html__( "Shutter In Out Horizontal", "megafactory" )=> "imghvr-shutter-in-out-horiz",
							esc_html__( "Shutter In Out Vertical", "megafactory" )=> "imghvr-shutter-in-out-vert",
							esc_html__( "Shutter In Out Diagonal 1", "megafactory" )=> "imghvr-shutter-in-out-diag-1",
							esc_html__( "Shutter In Out Diagonal 2", "megafactory" )=> "imghvr-shutter-in-out-diag-2",
							esc_html__( "Fold Up", "megafactory" )=> "imghvr-fold-up",
							esc_html__( "Fold Down", "megafactory" )=> "imghvr-fold-down",
							esc_html__( "Fold Left", "megafactory" )=> "imghvr-fold-left",
							esc_html__( "Fold Right", "megafactory" )=> "imghvr-fold-right",
							esc_html__( "Zoom In", "megafactory" )=> "imghvr-zoom-in",
							esc_html__( "Zoom Out", "megafactory" )=> "imghvr-zoom-out",
							esc_html__( "Zoom Out Up", "megafactory" )=> "imghvr-zoom-out-up",
							esc_html__( "Zoom Out Down", "megafactory" )=> "imghvr-zoom-out-down",
							esc_html__( "Zoom Out Left", "megafactory" )=> "imghvr-zoom-out-left",
							esc_html__( "Zoom Out Right", "megafactory" )=> "imghvr-zoom-out-right",
							esc_html__( "Zoom Out Flip Horizontal", "megafactory" )=> "imghvr-zoom-out-flip-horiz",
							esc_html__( "Zoom Out Flip Vertical", "megafactory" )=> "imghvr-zoom-out-flip-vert",
							esc_html__( "Blur", "megafactory" )=> "imghvr-blur",
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Title", "megafactory" ),
						"param_name"	=> "title",
						"value" 		=> "",
						"group"			=> esc_html__( "Title", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Title Heading Tag", "megafactory" ),
						"description"	=> esc_html__( "This is option for title heading tag", "megafactory" ),
						"param_name"	=> "title_head",
						"value"			=> array(
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
						"heading"		=> esc_html__( "Primary Box Icon Size", "megafactory" ),
						"description" 	=> esc_html__( "This is option for set primary icon size. Example 30", "megafactory" ),
						"param_name"	=> "icon_size",
						"value" 		=> "24",
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Secondary Box Icon Size", "megafactory" ),
						"description" 	=> esc_html__( "This is option for set secondary icon size. Example 30", "megafactory" ),
						"param_name"	=> "secondary_icon_size",
						"value" 		=> "",
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Icon Vertical Middle", "megafactory" ),
						"description"	=> esc_html__( "This is option for feature box icon set vertically middle.", "megafactory" ),
						"param_name"	=> "icon_midd",
						"value"			=> array(
							esc_html__( "Yes", "megafactory" )	=> "1",
							esc_html__( "No", "megafactory" )	=> "0"
						),
						"group"			=> esc_html__( "Icon", "megafactory" )
					),
					array(
						"type"        => "checkbox",
						"heading"     => esc_html__( "Icon Inner Space Empty", "megafactory" ),
						"description" => esc_html__( "check this to empty icon inner space.", "megafactory" ),
						"param_name"  => "icon_inner_space",
						"value"       => array(
							'Check to 0 space' => '1'
						), //value
						"group"			=> esc_html__( "Icon", "megafactory" )
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
					array(
						"type" => "attach_image",
						"heading" => esc_html__( "Flip Box Image", "megafactory" ),
						"description" => esc_html__( "Choose flip box image.", "megafactory" ),
						"param_name" => "fbox_image",
						"value" => '',
						"group"			=> esc_html__( "Image", "megafactory" ),
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Image Style", "megafactory" ),
						"value" 		=> array(
							esc_html__( "Squared", "megafactory" ) => "squared",
							esc_html__( "Rounded", "megafactory" ) => "rounded",
							esc_html__( "Circled", "megafactory" ) => "rounded-circle",
						),
						"param_name" 	=> "img_style",
						"group"			=> esc_html__( "Image", "megafactory" ),
					),
					array(
						"type"			=> "textarea_html",
						"heading"		=> esc_html__( "Content", "megafactory" ),
						"description" 	=> esc_html__( "You can give the flip box content here. HTML allowed here.", "megafactory" ),
						"param_name"	=> "content",
						"value" 		=> "",
						"group"			=> esc_html__( "Content", "megafactory" )
					),
					array(
						'type'		=> "css_editor",
						'heading'	=> esc_html__( "Css", 'megafactory' ),
						'param_name'=> "css",
						'group'		=> esc_html__( "Design options", "megafactory" ),
					),
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_flip_box_shortcode_map" );