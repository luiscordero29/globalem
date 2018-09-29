<?php 
/**
 * Megafactory Services
 */

if ( ! function_exists( "megafactory_vc_services_shortcode" ) ) {
	function megafactory_vc_services_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_services", $atts );
		extract( $atts );

		$output = '';
	
		//Defined Variable
		$class_names = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';
		$post_per_page = isset( $post_per_page ) && $post_per_page != '' ? $post_per_page : '';
		$excerpt_length = isset( $excerpt_length ) && $excerpt_length != '' ? $excerpt_length : 0;
		$class_names .= isset( $services_layout ) ? ' services-' . $services_layout : ' services-1';
		$class_names .= isset( $text_align ) && $text_align != 'default' ? ' text-' . $text_align : '';
		$class_names .= isset( $variation ) ? ' services-' . $variation : '';
		$cols = isset( $service_cols ) ? $service_cols : 1;
		$read_more = isset( $read_more ) ? $read_more : '';
		$button_type = isset( $button_type ) && $button_type == 'button' ? ' btn btn-default' : '';
		
		// This is custom css options for main shortcode warpper
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		
		//Shortcode css ccde here
		$shortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $rand_class ) . '.services-wrapper, .' . esc_attr( $rand_class ) . '.services-wrapper.services-dark .services-inner { color: '. esc_attr( $font_color ) .'; }' : '';
		
		if( $shortcode_css ) $class_names .= ' ' . $shortcode_rand_id . ' megafactory-inline-css';
		
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
			'post_type' => 'mf-service',
			'posts_per_page' => absint( $post_per_page ),
			'ignore_sticky_posts' => 1
		);
		
		$thumb_size = 'large';
		if( ( 12 / absint( $cols ) ) > 3 ){
			$thumb_size = 'megafactory-grid-medium';
		}elseif( ( 12 / absint( $cols ) ) > 2 ){
			$thumb_size = 'megafactory-grid-large';
		}elseif( ( 12 / absint( $cols ) ) > 1 ){
			$thumb_size = 'medium';
		}else{
			$thumb_size = 'large';
		}
		
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			
			$output .= '<div class="services-wrapper'. esc_attr( $class_names ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
				$row_stat = 0;
				
					//Services Slide
					if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '<div class="owl-carousel" '. ( $data_atts ) .'>';	
					
					// Start the Loop
					while ( $query->have_posts() ) : $query->the_post();
					
						if( $row_stat == 0 && $slide_opt != 'on' ) :
							$output .= '<div class="row">';
						endif;
					
						//Services Slide Item
						if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '<div class="item">';	
					
					
						$col_class = "col-lg-". absint( $cols );
						$col_class .= " " . ( $cols == 3 ? "col-md-6" : "col-md-". absint( $cols ) );
						$output .= '<div class="'. esc_attr( $col_class ) .'">';
							$output .= '<div class="services-inner">';
							
							$post_id = get_the_ID();
							
							$testimoanil_array = array(
								'post_id' => $post_id,
								'excerpt_length' => $excerpt_length,
								'thumb_size' => $thumb_size,
								'more' => $read_more,
								'button_type' => $button_type
							);

							$elemetns = isset( $services_items ) ? megafactory_drag_and_drop_trim( $services_items ) : array( 'Enabled' => '' );

							if( isset( $elemetns['Enabled'] ) ) :
								foreach( $elemetns['Enabled'] as $element => $value ){
									$output .= megafactory_services_shortcode_elements( $element, $testimoanil_array );
								}
							endif;
							
							$output .= '</div><!-- .services-inner -->';
						$output .= '</div><!-- .cols -->';
						
						//Services Slide Item End
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
					
					//Services Slide End
					if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '</div><!-- .owl-carousel -->';

			$output .= '</div><!-- .services-wrapper -->';
			
		}// query exists
		
		// use reset postdata to restore orginal query
		wp_reset_postdata();
		
		return $output;
	}
}

function megafactory_services_shortcode_elements( $element, $opts = array() ){
	$output = '';
	switch( $element ){
	
		case "title":
			$output .= '<div class="services-title">';
				$output .= '<h3><a href="'. esc_url( get_the_permalink() ) .'" class="entry-title">'. esc_html( get_the_title() ) .'</a></h3>';
			$output .= '</div><!-- .services-title -->';		
		break;

		case "thumb":
			if ( has_post_thumbnail() ) {
				$output .= '<div class="services-thumb">';
					$output .= get_the_post_thumbnail( $opts['post_id'], $opts['thumb_size'], array( 'class' => 'img-fluid m-auto' ) );
				$output .= '</div><!-- .services-thumb -->';
			}
		break;
		
		case "excerpt":
			$excerpt = isset( $opts['excerpt_length'] ) && $opts['excerpt_length'] != '' ? $opts['excerpt_length'] : 20;
			$output .= '<div class="services-excerpt">';
				add_filter( 'excerpt_length', __return_value( $excerpt ) );
				ob_start();
				the_excerpt();
				$excerpt_cont = ob_get_clean();
				$output .= $excerpt_cont;
			$output .= '</div><!-- .services-excerpt -->';	
		break;
		
		case "more":
			$more = $opts['more'];
			if( $more ) :
				$output .= '<div class="services-read-more">';
					$output .= '<a href="'. esc_url( get_the_permalink() ) .'" class="read-more'. esc_attr( $opts['button_type'] ) .'">'. esc_html( $more ) .'</a>';
				$output .= '</div><!-- .services-read-more -->';		
			endif;
		break;
		
	}
	return $output; 
}

if ( ! function_exists( "megafactory_vc_services_shortcode_map" ) ) {
	function megafactory_vc_services_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Services", "megafactory" ),
				"description"			=> esc_html__( "Services custom post type.", "megafactory" ),
				"base"					=> "megafactory_vc_services",
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
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Font Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the font color.", "megafactory" ),
						"param_name"	=> "font_color",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "img_select",
						"heading"		=> esc_html__( "Services Layout", "megafactory" ),
						"param_name"	=> "services_layout",
						"img_lists" => array ( 
							"1"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/services/1.png",
							"2"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/services/2.png",
							"3"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/services/3.png"
						),
						"default"		=> "1",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Services Variation", "megafactory" ),
						"description"	=> esc_html__( "This is option for services variatoin either dark or light.", "megafactory" ),
						"param_name"	=> "variation",
						"value"			=> array(
							esc_html__( "Light", "megafactory" )	=> "light",
							esc_html__( "Dark", "megafactory" )		=> "dark",
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Services Columns", "megafactory" ),
						"description"	=> esc_html__( "This is option for services columns.", "megafactory" ),
						"param_name"	=> "service_cols",
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
						'heading'		=> esc_html__( 'Drag and Drop', 'megafactory' ),
						"description"	=> esc_html__( "This is settings for services custom layout. here you can set your own layout. Drag and drop needed services items to Enabled part.", "megafactory" ),
						'param_name'	=> 'services_items',
						'dd_fields' => array ( 
							'Enabled' => array( 
								'thumb'	=> esc_html__( 'Image', 'megafactory' ),
								'title'	=> esc_html__( 'Title', 'megafactory' ),
								'excerpt'	=> esc_html__( 'Excerpt', 'megafactory' ),
								'more'	=> esc_html__( 'Read More', 'megafactory' )
							),
							'disabled' => array()
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Text Align", "megafactory" ),
						"description"	=> esc_html__( "This is option for services text align", "megafactory" ),
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
						"heading"		=> esc_html__( "Read More Text", "megafactory" ),
						"param_name"	=> "read_more",
						"value" 		=> esc_html__( "Read More", "megafactory" ),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Read More Button Style", "megafactory" ),
						"description"	=> esc_html__( "This is option for services read more button style.", "megafactory" ),
						"param_name"	=> "button_type",
						"value"			=> array(
							esc_html__( "Link Style", "megafactory" )	=> "link",
							esc_html__( "Button Style", "megafactory" )	=> "button"
						),
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Slide Option", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slider option.", "megafactory" ),
						"param_name"	=> "slide_opt",
						"value"			=> "off",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slide items shown on large devices.", "megafactory" ),
						"param_name"	=> "slide_item",
						"value" 		=> "2",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items on Tab", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slide items shown on tab.", "megafactory" ),
						"param_name"	=> "slide_item_tab",
						"value" 		=> "2",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items on Mobile", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slide items shown on mobile.", "megafactory" ),
						"param_name"	=> "slide_item_mobile",
						"value" 		=> "1",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Auto Play", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slider auto play.", "megafactory" ),
						"param_name"	=> "slide_item_autoplay",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Loop", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slider loop.", "megafactory" ),
						"param_name"	=> "slide_item_loop",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Items Center", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slider center, for this option must active loop and minimum items 2.", "megafactory" ),
						"param_name"	=> "slide_center",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Navigation", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slider navigation.", "megafactory" ),
						"param_name"	=> "slide_nav",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Pagination", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slider pagination.", "megafactory" ),
						"param_name"	=> "slide_dots",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Margin", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slider margin space.", "megafactory" ),
						"param_name"	=> "slide_margin",
						"value" 		=> "",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Duration", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slider duration.", "megafactory" ),
						"param_name"	=> "slide_duration",
						"value" 		=> "5000",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Smart Speed", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slider smart speed.", "megafactory" ),
						"param_name"	=> "slide_smart_speed",
						"value" 		=> "250",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Slideby", "megafactory" ),
						"description"	=> esc_html__( "This is option for services slider scroll by.", "megafactory" ),
						"param_name"	=> "slide_slideby",
						"value" 		=> "1",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_services_shortcode_map" );