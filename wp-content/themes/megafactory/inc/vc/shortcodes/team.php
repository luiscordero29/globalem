<?php 
/**
 * Megafactory Team
 */

if ( ! function_exists( "megafactory_vc_team_shortcode" ) ) {
	function megafactory_vc_team_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_team", $atts );
		extract( $atts );

		$output = '';
	
		//Defined Variable
		$class_names = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';
		$post_per_page = isset( $post_per_page ) && $post_per_page != '' ? $post_per_page : '';
		$excerpt_length = isset( $excerpt_length ) && $excerpt_length != '' ? $excerpt_length : 0;
		$class_names .= isset( $team_layout ) ? ' team-' . $team_layout : ' team-1';
		$class_names .= isset( $text_align ) && $text_align != 'default' ? ' text-' . $text_align : '';
		$class_names .= isset( $variation ) ? ' team-' . $variation : '';
		$cols = isset( $team_cols ) ? $team_cols : 12;
		$more_text = isset( $more_text ) && $more_text != '' ? $more_text : '';
		
		$sclass_name = isset( $social_style ) && !empty( $social_style ) ? ' social-' . $social_style : '';
		$sclass_name .= isset( $social_color ) && !empty( $social_color ) ? ' social-' . $social_color : '';
		$sclass_name .= isset( $social_hcolor ) && !empty( $social_hcolor ) ? ' social-' . $social_hcolor : '';
		$sclass_name .= isset( $social_bg ) && !empty( $social_bg ) ? ' social-' . $social_bg : '';
		$sclass_name .= isset( $social_hbg ) && !empty( $social_hbg ) ? ' social-' . $social_hbg : '';
		
		$overlay_class = '';
		$overlay_class .= isset( $team_overlay_position ) ? ' overlay-'.$team_overlay_position : ' overlay-center';
		
		// This is custom css options for main shortcode warpper
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		
		//Shortcode css ccde here
		$shortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $rand_class ) . '.team-wrapper, .' . esc_attr( $rand_class ) . '.team-wrapper.team-dark .team-inner { color: '. esc_attr( $font_color ) .'; }' : '';
		
		//Overlay Styles
		$overlay_class .= isset( $overlay_text_align ) && $overlay_text_align != 'default' ? ' text-' . $overlay_text_align : '';
		$shortcode_css .= isset( $team_overlay_font_color ) && $team_overlay_font_color != '' ? '.' . esc_attr( $rand_class ) . '.team-wrapper .team-overlay { color: '. esc_attr( $team_overlay_font_color ) .'; }' : '';
		$shortcode_css .= isset( $team_overlay_custom_color ) && $team_overlay_custom_color != '' ? '.' . esc_attr( $rand_class ) . '.team-wrapper .team-thumb .overlay-custom { background: '. esc_attr( $team_overlay_custom_color ) .'; }' : '';
		
		$overlay_link = isset( $team_overlay_link_colors ) ? $team_overlay_link_colors : '';
		if( $overlay_link ){
			$overlay_link = preg_replace('/\s+/', '', $overlay_link);
			$overlay_link_arr = explode(",",$overlay_link);
			if( isset( $overlay_link_arr[0] ) && $overlay_link_arr[0] != '' ){
				$shortcode_css .= '.' . esc_attr( $rand_class ) . '.team-wrapper .team-overlay a.client-name { color: '. esc_attr( $overlay_link_arr[0] ) .'; }';
			}
			if( isset( $overlay_link_arr[1] ) && $overlay_link_arr[1] != '' ){
				$shortcode_css .= '.' . esc_attr( $rand_class ) . '.team-wrapper .team-overlay a.client-name:hover { color: '. esc_attr( $overlay_link_arr[1] ) .'; }';
			}
		}	
		
		$gal_atts = '';
		if( isset( $slide_opt ) && $slide_opt == 'on' ){
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
		}
		
		$args = array(
			'post_type' => 'mf-team',
			'posts_per_page' => absint( $post_per_page ),
			'ignore_sticky_posts' => 1
		);
		
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
		
			if( $shortcode_css ) $class_names .= ' ' . $shortcode_rand_id . ' megafactory-inline-css';
			
			$output .= '<div class="team-wrapper'. esc_attr( $class_names ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
				$row_stat = 0;
				
					//Team Slide
					if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '<div class="owl-carousel" '. ( $data_atts ) .'>';	

					// Start the Loop
					while ( $query->have_posts() ) : $query->the_post();
						
						// Parameters Defined
						$post_id = get_the_ID();
						$team_array = array(
							'post_id' => $post_id,
							'excerpt_length' => $excerpt_length,
							'cols' => $cols,
							'more_text' => $more_text,
							'social_class' => $sclass_name
						);
					
						//Overlay Output Formation
						$overlay_out = '';
						if( isset( $team_overlay_opt ) && $team_overlay_opt == 'enable' ) {
							if( isset( $team_overlay_type ) && $team_overlay_type != 'none' ){
								$overlay_out .= '<span class="overlay-bg overlay-'. esc_attr( $team_overlay_type ) .'"></span>';
							}
							$overlay_out .= '<div class="team-overlay'. esc_attr( $overlay_class ) .'">';
								
								$overlay_elemetns = isset( $overlay_team_items ) ? megafactory_drag_and_drop_trim( $overlay_team_items ) : array( 'Enabled' => '' );

								if( isset( $overlay_elemetns['Enabled'] ) ) :
									foreach( $overlay_elemetns['Enabled'] as $element => $value ){
										$overlay_out .= megafactory_team_shortcode_elements( $element, $team_array );
									}
								endif;
								
							$overlay_out .= '</div><!-- .team-overlay -->';
						}
					
						if( $row_stat == 0 && $slide_opt != 'on' ) :
							$output .= '<div class="row">';
						endif;
					
						//Team Slide Item
						if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '<div class="item">';	

						$col_class = "col-lg-". absint( $cols );
						$col_class .= " " . ( $cols == 3 ? "col-md-6" : "col-md-". absint( $cols ) );
						$output .= '<div class="'. esc_attr( $col_class ) .'">';
							$inner_class = $overlay_out ? ' team-overlay-actived' : '';
							$output .= '<div class="team-inner'. esc_attr( $inner_class ) .'">';

							$elemetns = isset( $team_items ) ? megafactory_drag_and_drop_trim( $team_items ) : array( 'Enabled' => '' );

							if( isset( $elemetns['Enabled'] ) ) :
								foreach( $elemetns['Enabled'] as $element => $value ){
									if( $element == 'thumb' ){
										$team_array['overlay'] = $overlay_out;
									}
									$output .= megafactory_team_shortcode_elements( $element, $team_array );
								}
							endif;
							
							$output .= '</div><!-- .team-inner -->';
						$output .= '</div><!-- .cols -->';
						
						//Team Slide Item End
						if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '</div><!-- .item -->';	
									
						$row_stat++;
						if( $row_stat == ( 12/ $cols ) && $slide_opt != 'on' ) :
							$output .= '</div><!-- .row -->';
							$row_stat = 0;
						endif;
						
					endwhile;
					
					if( $row_stat != 0 && $slide_opt != 'on' ){
						$output .= '</div><!-- .row -->'; // Unexpected row close
					}
					
					//Team Slide End
					if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '</div><!-- .owl-carousel -->';

			$output .= '</div><!-- .team-wrapper -->';
			
		}// query exists
		
		// use reset postdata to restore orginal query
		wp_reset_postdata();
		
		return $output;
	}
}

function megafactory_team_shortcode_elements( $element, $opts = array() ){
	$output = '';
	switch( $element ){
	
		case "name":
			$output .= '<div class="team-name">';
				$output .= '<p><a href="'. esc_url( get_the_permalink() ) .'" class="client-name">'. esc_html( get_the_title() ) .'</a></p>';
			$output .= '</div><!-- .team-name -->';		
		break;
		
		case "designation":
			$designation = get_post_meta( $opts['post_id'], 'megafactory_team_designation', true );
			if( $designation ) :
				
				$output .= '<div class="team-designation">';
					$output .= '<p>'. esc_html( $designation ) .'</p>';
				$output .= '</div><!-- .team-designation -->';		
			endif;
		break;
		
		case "thumb":
			if ( has_post_thumbnail() ) {
			
				$thumb_size = 'large';
				if( ( 12 / absint( $opts['cols'] ) ) > 3 ){
					$thumb_size = 'mf-team-medium';
				}else{
					$thumb_size = 'large';
				}
				
				$output .= '<div class="team-thumb">';
					$output .= isset( $opts['overlay'] ) ? $opts['overlay'] : '';
					$output .= get_the_post_thumbnail( $opts['post_id'], $thumb_size, array( 'class' => 'img-fluid' ) );
				$output .= '</div><!-- .team-thumb -->';
			}
		break;
		
		case "excerpt":
			$excerpt = isset( $opts['excerpt_length'] ) && $opts['excerpt_length'] != '' ? $opts['excerpt_length'] : 20;
			$output .= '<div class="team-excerpt">';
				add_filter( 'excerpt_length', __return_value( $excerpt ) );
				ob_start();
				the_excerpt();
				$excerpt_cont = ob_get_clean();
				$output .= $excerpt_cont;
			$output .= '</div><!-- .team-excerpt -->';	
		break;
		
		case "more":
			$read_more_text = isset( $opts['more_text'] ) ? $opts['more_text'] : esc_html__( 'Read more', 'megafactory' );
			$output = '<div class="post-more"><a class="read-more" href="'. esc_url( get_permalink( get_the_ID() ) ) . '">'. esc_html( $read_more_text ) .'</a></div>';
		break;
		
		case "social":
			$output .= '<div class="team-social-wrap clearfix">';
				$output .= '<ul class="nav social-icons team-social'. esc_attr( $opts['social_class'] ) .'">';
					$taget = get_post_meta( get_the_ID(), 'megafactory_team_link_target', true );
					$social_media = array( 
						'social-fb' => 'fa fa-facebook', 
						'social-twitter' => 'fa fa-twitter', 
						'social-instagram' => 'fa fa-instagram',
						'social-linkedin' => 'fa fa-linkedin', 
						'social-pinterest' => 'fa fa-pinterest-p', 
						'social-gplus' => 'fa fa-google-plus',  
						'social-youtube' => 'fa fa-youtube-play', 
						'social-vimeo' => 'fa fa-vimeo',
						'social-flickr' => 'fa fa-flickr', 
						'social-dribbble' => 'fa fa-dribbble'
					);
					$social_opt = array(
						'social-fb' => 'megafactory_team_facebook', 
						'social-twitter' => 'megafactory_team_twitter',
						'social-instagram' => 'megafactory_team_instagram',
						'social-linkedin' => 'megafactory_team_linkedin',
						'social-pinterest' => 'megafactory_team_pinterest',
						'social-gplus' => 'megafactory_team_gplus',
						'social-youtube' => 'megafactory_team_youtube',
						'social-vimeo' => 'megafactory_team_vimeo',
						'social-flickr' => 'megafactory_team_flickr',
						'social-dribbble' => 'megafactory_team_dribbble',
					);
					// Actived social icons from theme option output generate via loop
					foreach( $social_media as $key => $class ){
						$social_url = get_post_meta( get_the_ID(), $social_opt[$key], true );
						if( $social_url ):
							$output .= '<li>';
								$output .= '<a class="'. esc_attr( $key ) .'" href="'. esc_url( $social_url ) .'" target="'. esc_attr( $taget ) .'">';
									$output .= '<i class="'. esc_attr( $class ) .'"></i>';
								$output .= '</a>';
							$output .= '</li>';
						endif;
					}
				$output .= '</ul>';
			$output .= '</div> <!-- .team-social-wrap -->';
		break;
		
	}
	return $output; 
}

if ( ! function_exists( "megafactory_vc_team_shortcode_map" ) ) {
	function megafactory_vc_team_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Team", "megafactory" ),
				"description"			=> esc_html__( "Team custom post type.", "megafactory" ),
				"base"					=> "megafactory_vc_team",
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
						"heading"		=> esc_html__( "Post Per Page", "megafactory" ),
						"description"	=> esc_html__( "Here you can define post limits per page. Example 10", "megafactory" ),
						"param_name"	=> "post_per_page",
						"value" 		=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Excerpt Length", "megafactory" ),
						"param_name"	=> "excerpt_length",
						"value" 		=> "15"
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Read More Text", "megafactory" ),
						"description"	=> esc_html__( "Here you can enter read more text instead of default text.", "megafactory" ),
						"param_name"	=> "more_text",
						"value" 		=> esc_html__( "Read More", "megafactory" ),
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
						"heading"		=> esc_html__( "Team Layout", "megafactory" ),
						"param_name"	=> "team_layout",
						"img_lists" => array ( 
							"1"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/team/1.png",
							"2"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/team/2.png",
							"3"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/team/3.png"
						),
						"default"		=> "1",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Team Variation", "megafactory" ),
						"description"	=> esc_html__( "This is option for team variatoin either dark or light.", "megafactory" ),
						"param_name"	=> "variation",
						"value"			=> array(
							esc_html__( "Light", "megafactory" )	=> "light",
							esc_html__( "Dark", "megafactory" )		=> "dark",
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Team Columns", "megafactory" ),
						"description"	=> esc_html__( "This is option for team columns.", "megafactory" ),
						"param_name"	=> "team_cols",
						"value"			=> array(
							esc_html__( "1 Column", "megafactory" )	=> "12",
							esc_html__( "2 Columns", "megafactory" )	=> "6",
							esc_html__( "3 Columns", "megafactory" )	=> "4",
							esc_html__( "4 Columns", "megafactory" )	=> "3",
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						'type'			=> 'drag_drop',
						'heading'		=> esc_html__( 'Team Items', 'megafactory' ),
						"description"	=> esc_html__( "This is settings for team custom layout. here you can set your own layout. Drag and drop needed team items to Enabled part.", "megafactory" ),
						'param_name'	=> 'team_items',
						'dd_fields' => array ( 
							'Enabled' => array( 
								'thumb'	=> esc_html__( 'Image', 'megafactory' ),
								'name'	=> esc_html__( 'Name', 'megafactory' ),
								'designation'	=> esc_html__( 'Designation', 'megafactory' ),
								'excerpt'	=> esc_html__( 'Excerpt', 'megafactory' ),
								'social'	=> esc_html__( 'Social Links', 'megafactory' ),
							),
							'disabled' => array(
								'more'	=> esc_html__( 'Read More', 'megafactory' )
							)
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Text Align", "megafactory" ),
						"description"	=> esc_html__( "This is option for team text align", "megafactory" ),
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
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Slide Option", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slider option.", "megafactory" ),
						"param_name"	=> "slide_opt",
						"value"			=> "off",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Overlay Team Option", "megafactory" ),
						"description"	=> esc_html__( "This is option for enable overlay team option.", "megafactory" ),
						"param_name"	=> "team_overlay_opt",
						"value"			=> array(
							esc_html__( "Disable", "megafactory" )	=> "disable",
							esc_html__( "Enable", "megafactory" )	=> "enable"
						),
						"group"			=> esc_html__( "Overlay", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Overlay Font Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put team overlay font color.", "megafactory" ),
						"param_name"	=> "team_overlay_font_color",
						'dependency' => array(
							'element' => 'team_overlay_opt',
							'value' => 'enable',
						),
						"group"			=> esc_html__( "Overlay", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Overlay Link Colors", "megafactory" ),
						"description"	=> esc_html__( "Here you can put team overlay link normal, hover colors. Example #ffffff, #cccccc", "megafactory" ),
						"param_name"	=> "team_overlay_link_colors",
						'dependency' => array(
							'element' => 'team_overlay_opt',
							'value' => 'enable',
						),
						"group"			=> esc_html__( "Overlay", "megafactory" )
					),
					array(
						'type'			=> 'drag_drop',
						'heading'		=> esc_html__( 'Overlay Team Items', 'megafactory' ),
						"description"	=> esc_html__( "This is settings for team items(name, excerpt etc..) overlay on thumbnail. Drag and drop needed team items to Enabled part.", "megafactory" ),
						'param_name'	=> 'overlay_team_items',
						'dd_fields' => array ( 
							'Enabled' => array( 
								'name'	=> esc_html__( 'Name', 'megafactory' )
							),
							'disabled' => array(
								'designation'	=> esc_html__( 'Designation', 'megafactory' ),
								'excerpt'	=> esc_html__( 'Excerpt', 'megafactory' ),
								'social'	=> esc_html__( 'Social Links', 'megafactory' )
							)
						),
						'dependency' => array(
							'element' => 'team_overlay_opt',
							'value' => 'enable',
						),
						"group"			=> esc_html__( "Overlay", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Overlay Items Position", "megafactory" ),
						"description"	=> esc_html__( "This is option for overlay items position.", "megafactory" ),
						"param_name"	=> "team_overlay_position",
						"value"			=> array(
							esc_html__( "Center", "megafactory" )	=> "center",
							esc_html__( "Top Left", "megafactory" )	=> "top-left",
							esc_html__( "Top Right", "megafactory" )	=> "top-right",
							esc_html__( "Bottom Left", "megafactory" )	=> "bottom-left",
							esc_html__( "Bottom Right", "megafactory" )	=> "bottom-right",
						),
						'dependency' => array(
							'element' => 'team_overlay_opt',
							'value' => 'enable',
						),
						"group"			=> esc_html__( "Overlay", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Overlay Text Align", "megafactory" ),
						"description"	=> esc_html__( "This is option for team text align", "megafactory" ),
						"param_name"	=> "overlay_text_align",
						"value"			=> array(
							esc_html__( "Default", "megafactory" )	=> "default",
							esc_html__( "Left", "megafactory" )		=> "left",
							esc_html__( "Center", "megafactory" )	=> "center",
							esc_html__( "Right", "megafactory" )		=> "right"
						),
						'dependency' => array(
							'element' => 'team_overlay_opt',
							'value' => 'enable',
						),
						"group"			=> esc_html__( "Overlay", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Overlay Type", "megafactory" ),
						"description"	=> esc_html__( "This is option for team overlay type.", "megafactory" ),
						"param_name"	=> "team_overlay_type",
						"value"			=> array(
							esc_html__( "None", "megafactory" ) => "none",
							esc_html__( "Overlay Dark", "megafactory" ) => "dark",
							esc_html__( "Overlay White", "megafactory" ) => "light",
							esc_html__( "Custom Color", "megafactory" ) => "custom"
						),
						'dependency' => array(
							'element' => 'team_overlay_opt',
							'value' => 'enable',
						),
						"group"			=> esc_html__( "Overlay", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Overlay Custom Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put team overlay custom color.", "megafactory" ),
						"param_name"	=> "team_overlay_custom_color",
						'dependency' => array(
							'element' => 'team_overlay_type',
							'value' => 'custom',
						),
						"group"			=> esc_html__( "Overlay", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Social Icons Style", "megafactory" ),
						"description"	=> esc_html__( "This is option for team social icons style.", "megafactory" ),
						"param_name"	=> "social_style",
						"value"			=> array(
							esc_html__( "Circled", "megafactory" )	=> "circled",
							esc_html__( "Square", "megafactory" )	=> "squared",
							esc_html__( "Rounded", "megafactory" )	=> "rounded",
							esc_html__( "Transparent", "megafactory" )		=> "transparent"
						),
						"group"			=> esc_html__( "Social", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Social Icons Color", "megafactory" ),
						"description"	=> esc_html__( "This is option for team social icons color.", "megafactory" ),
						"param_name"	=> "social_color",
						"value"			=> array(
							esc_html__( "Black", "megafactory" )		=> "black",
							esc_html__( "White", "megafactory" )		=> "white",
							esc_html__( "Own Color", "megafactory" )	=> "own"
						),
						"group"			=> esc_html__( "Social", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Social Icons Hover Color", "megafactory" ),
						"description"	=> esc_html__( "This is option for team social icons hover color.", "megafactory" ),
						"param_name"	=> "social_hcolor",
						"value"			=> array(
							esc_html__( "White", "megafactory" )		=> "h-white",
							esc_html__( "Black", "megafactory" )		=> "h-black",
							esc_html__( "Own Color", "megafactory" )	=> "h-own"
						),
						"group"			=> esc_html__( "Social", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Social Icons Background", "megafactory" ),
						"description"	=> esc_html__( "This is option for team social icons background.", "megafactory" ),
						"param_name"	=> "social_bg",
						"value"			=> array(
							esc_html__( "White", "megafactory" )		=> "bg-white",
							esc_html__( "Black", "megafactory" )		=> "bg-black",
							esc_html__( "RGBA Light", "megafactory" )=> "bg-light",
							esc_html__( "RGBA Dark", "megafactory" )	=> "bg-dark",
							esc_html__( "Own Color", "megafactory" )	=> "bg-own"
						),
						"group"			=> esc_html__( "Social", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Social Icons Hover Background Color", "megafactory" ),
						"description"	=> esc_html__( "This is option for team social icons hover background.", "megafactory" ),
						"param_name"	=> "social_hbg",
						"value"			=> array(
							esc_html__( "Own Color", "megafactory" )	=> "hbg-own",
							esc_html__( "Black", "megafactory" )		=> "hbg-black",
							esc_html__( "White", "megafactory" )		=> "hbg-white",
							esc_html__( "RGBA Light", "megafactory" )=> "hbg-light",
							esc_html__( "RGBA Dark", "megafactory" )	=> "hbg-dark",
							esc_html__( "Transparent", "megafactory" )	=> "hbg-trans"						
						),
						"group"			=> esc_html__( "Social", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slide items shown on large devices.", "megafactory" ),
						"param_name"	=> "slide_item",
						"value" 		=> "2",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items on Tab", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slide items shown on tab.", "megafactory" ),
						"param_name"	=> "slide_item_tab",
						"value" 		=> "2",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items on Mobile", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slide items shown on mobile.", "megafactory" ),
						"param_name"	=> "slide_item_mobile",
						"value" 		=> "1",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Auto Play", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slider auto play.", "megafactory" ),
						"param_name"	=> "slide_item_autoplay",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Loop", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slider loop.", "megafactory" ),
						"param_name"	=> "slide_item_loop",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Items Center", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slider center, for this option must active loop and minimum items 2.", "megafactory" ),
						"param_name"	=> "slide_center",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Navigation", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slider navigation.", "megafactory" ),
						"param_name"	=> "slide_nav",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Pagination", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slider pagination.", "megafactory" ),
						"param_name"	=> "slide_dots",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Margin", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slider margin space.", "megafactory" ),
						"param_name"	=> "slide_margin",
						"value" 		=> "",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Duration", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slider duration.", "megafactory" ),
						"param_name"	=> "slide_duration",
						"value" 		=> "5000",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Smart Speed", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slider smart speed.", "megafactory" ),
						"param_name"	=> "slide_smart_speed",
						"value" 		=> "250",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Slideby", "megafactory" ),
						"description"	=> esc_html__( "This is option for team slider scroll by.", "megafactory" ),
						"param_name"	=> "slide_slideby",
						"value" 		=> "1",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_team_shortcode_map" );