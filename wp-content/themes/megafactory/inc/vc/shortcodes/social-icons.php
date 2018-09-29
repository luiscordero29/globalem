<?php 
/**
 * Megafactory Social Icons
 */

if ( ! function_exists( "megafactory_vc_social_icons_shortcode" ) ) {
	function megafactory_vc_social_icons_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_social_icons", $atts ); 
		extract( $atts );
		
		$output = '';
		
		//Define Variables
		$animation = isset( $animation ) ? $animation : '';
		$class = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';	
		$class .= isset( $text_align ) && $text_align != 'default' ? ' text-' . $text_align : '';	
		
		// Get VC Animation
		$class .= megafactoryGetCSSAnimation( $animation );
		
		// This is custom css options for main shortcode warpper
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		
		//Shortcode css ccde here
		$shortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $rand_class ) . '.social-icons-wrapper { color: '. esc_attr( $font_color ) .'; }' : '';
		
		if( $shortcode_css ) $class .= ' ' . $shortcode_rand_id . ' megafactory-inline-css';
		
		$output .= '<div class="social-icons-wrapper'. esc_attr( $class ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
			
			$output .= isset( $title ) && $title != '' ? '<h3 class="social-icons-title">'. esc_html( $title ) .'</h3>' : '';
			
			$social_media = array( 
				'social-fb' => 'fa fa-facebook', 
				'social-twitter' => 'fa fa-twitter', 
				'social-instagram' => 'fa fa-instagram', 
				'social-linkedin' => 'fa fa-linkedin', 
				'social-pinterest' => 'fa fa-pinterest-p', 
				'social-gplus' => 'fa fa-google-plus',  
				'social-youtube' => 'fa fa-youtube-play', 
				'social-vimeo' => 'fa fa-vimeo', 
				'social-soundcloud' => 'fa fa-soundcloud', 
				'social-yahoo' => 'fa fa-yahoo', 
				'social-tumblr' => 'fa fa-tumblr',  
				'social-paypal' => 'fa fa-paypal', 
				'social-mailto' => 'fa fa-envelope-o', 
				'social-flickr' => 'fa fa-flickr', 
				'social-dribbble' => 'fa fa-dribbble', 
				'social-rss' => 'fa fa-rss' 
			);

			// Actived social icons from theme option output generate via loop
			$social_icons = '';
			foreach( $social_media as $key => $icon_class ){
				
				$social_field = str_replace( "-", "_", $key );
				
				if( isset( $$social_field ) && $$social_field != '' ){
					$social_url = $$social_field;
					$social_icons .= '<li>
									<a href="'. esc_url( $social_url ) .'" class="nav-link '. esc_attr( $key ) .'">
										<i class="'. esc_attr( $icon_class ) .'"></i>
									</a>
								</li>';
				}
			}
	
			$social_class = isset( $social_icons_type ) ? ' social-' . $social_icons_type : '';
			$social_class .= isset( $social_icons_fore ) ? ' social-' . $social_icons_fore : '';
			$social_class .= isset( $social_icons_hfore ) ? ' social-' . $social_icons_hfore : '';
			$social_class .= isset( $social_icons_bg ) ? ' social-' . $social_icons_bg : '';
			$social_class .= isset( $social_icons_hbg ) ? ' social-' . $social_icons_hbg : '';
			
			$output .= '<ul class="nav social-icons '. esc_attr( $social_class ) .'">';
				$output .= $social_icons;
			$output .= '</ul>';

		$output .= '</div><!-- .social-icons-wrapper -->';

		return $output;
	}
}

if ( ! function_exists( "megafactory_vc_social_icons_shortcode_map" ) ) {
	function megafactory_vc_social_icons_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Social Icons", "megafactory" ),
				"description"			=> esc_html__( "Social icons for link.", "megafactory" ),
				"base"					=> "megafactory_vc_social_icons",
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
						"description"	=> esc_html__( "Here you put the day social shortcode title.", "megafactory" ),
						"param_name"	=> "title",
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
						"type"			=> "img_select",
						"heading"		=> esc_html__( "Social Iocns Type", "megafactory" ),
						"param_name"	=> "social_icons_type",
						"img_lists" => array ( 
							"squared"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/social-icons/1.png",
							"rounded"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/social-icons/2.png",
							"circled"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/social-icons/3.png",
							"transparent"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/social-icons/4.png"
						),
						"default"		=> "transparent",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Text Align", "megafactory" ),
						"description"	=> esc_html__( "This is option for day social icons shortcode text align", "megafactory" ),
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
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Social Icons Fore", "megafactory" ),
						"description"	=> esc_html__( "This is option for day social icons fore color.", "megafactory" ),
						"param_name"	=> "social_icons_fore",
						"value"			=> array(
							esc_html__( "Black", "megafactory" )	=> "black",
							esc_html__( "White", "megafactory" )		=> "white",
							esc_html__( "Own Color", "megafactory" )	=> "own"
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Social Icons Fore Hover", "megafactory" ),
						"description"	=> esc_html__( "This is option for day social icons fore hover color.", "megafactory" ),
						"param_name"	=> "social_icons_hfore",
						"value"			=> array(
							esc_html__( "Own Color", "megafactory" )	=> "h-own",
							esc_html__( "Black", "megafactory" )	=> "h-black",
							esc_html__( "White", "megafactory" )		=> "h-white"
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Social Icons Background", "megafactory" ),
						"description"	=> esc_html__( "This is option for day social icons background color.", "megafactory" ),
						"param_name"	=> "social_icons_bg",
						"value"			=> array(
							esc_html__( "Transparent", "megafactory" )	=> "bg-transparent",
							esc_html__( "White", "megafactory" )		=> "bg-white",
							esc_html__( "Black", "megafactory" )		=> "bg-black",
							esc_html__( "Light", "megafactory" )		=> "bg-light",
							esc_html__( "Dark", "megafactory" )		=> "bg-dark",
							esc_html__( "Own Color", "megafactory" )	=> "bg-own"
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Social Icons Background Hover", "megafactory" ),
						"description"	=> esc_html__( "This is option for day social icons background hover color.", "megafactory" ),
						"param_name"	=> "social_icons_hbg",
						"value"			=> array(
							esc_html__( "Transparent", "megafactory" )	=> "hbg-transparent",
							esc_html__( "White", "megafactory" )		=> "hbg-white",
							esc_html__( "Black", "megafactory" )		=> "hbg-black",
							esc_html__( "Light", "megafactory" )		=> "hbg-light",
							esc_html__( "Dark", "megafactory" )		=> "hbg-dark",
							esc_html__( "Own Color", "megafactory" )	=> "hbg-own"
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Facebook", "megafactory" ),
						"description"	=> esc_html__( "This is option for facebook social icon.", "megafactory" ),
						"param_name"	=> "social_fb",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Twitter", "megafactory" ),
						"description"	=> esc_html__( "This is option for twitter social icon.", "megafactory" ),
						"param_name"	=> "social_twitter",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Instagram", "megafactory" ),
						"description"	=> esc_html__( "This is option for instagram social icon.", "megafactory" ),
						"param_name"	=> "social_instagram",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Pinterest", "megafactory" ),
						"description"	=> esc_html__( "This is option for pinterest social icon.", "megafactory" ),
						"param_name"	=> "social_pinterest",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Google Plus", "megafactory" ),
						"description"	=> esc_html__( "This is option for google plus social icon.", "megafactory" ),
						"param_name"	=> "social_gplus",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Youtube", "megafactory" ),
						"description"	=> esc_html__( "This is option for youtube social icon.", "megafactory" ),
						"param_name"	=> "social_youtube",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Vimeo", "megafactory" ),
						"description"	=> esc_html__( "This is option for vimeo social icon.", "megafactory" ),
						"param_name"	=> "social_vimeo",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Soundcloud", "megafactory" ),
						"description"	=> esc_html__( "This is option for soundcloud social icon.", "megafactory" ),
						"param_name"	=> "social_soundcloud",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Yahoo", "megafactory" ),
						"description"	=> esc_html__( "This is option for yahoo social icon.", "megafactory" ),
						"param_name"	=> "social_yahoo",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Tumblr", "megafactory" ),
						"description"	=> esc_html__( "This is option for tumblr social icon.", "megafactory" ),
						"param_name"	=> "social_tumblr",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Paypal", "megafactory" ),
						"description"	=> esc_html__( "This is option for paypal social icon.", "megafactory" ),
						"param_name"	=> "social_paypal",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Mailto", "megafactory" ),
						"description"	=> esc_html__( "This is option for mailto social icon.", "megafactory" ),
						"param_name"	=> "social_mailto",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Flickr", "megafactory" ),
						"description"	=> esc_html__( "This is option for flickr social icon.", "megafactory" ),
						"param_name"	=> "social_flickr",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Dribbble", "megafactory" ),
						"description"	=> esc_html__( "This is option for dribbble social icon.", "megafactory" ),
						"param_name"	=> "social_dribbble",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "RSS", "megafactory" ),
						"description"	=> esc_html__( "This is option for rss social icon.", "megafactory" ),
						"param_name"	=> "social_rss",
						"value" 		=> "",
						"group"			=> esc_html__( "Links", "megafactory" )
					),
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_social_icons_shortcode_map" );