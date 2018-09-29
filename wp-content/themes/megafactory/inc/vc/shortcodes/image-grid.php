<?php 
/**
 * Megafactory Image Grid
 */

if ( ! function_exists( "megafactory_vc_image_grid_shortcode" ) ) {
	function megafactory_vc_image_grid_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_image_grid", $atts );
		extract( $atts );

		$output = '';
	
		//Defined Variable
		$class_names = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';
		$class_names .= isset( $image_grid_layout ) ? ' image-grid-' . $image_grid_layout : ' image-grid-1';
		$cols = isset( $grid_cols ) ? $grid_cols : 12;
		$grids = '';
		
		$gal_atts = $data_atts = '';
		if( isset( $image_grid_images ) ){
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
			$grids = isset( $slide_item ) && $slide_item != '' ? absint( $slide_item ) : 2;
		}
		
		if( $grids === 1 ){
			$thumb_size = 'large';
		}elseif( $grids == 2 ){
			$thumb_size = 'medium';
		}elseif( $grids == 3 ){
			$thumb_size = 'megafactory-grid-large';
		}else{
			$thumb_size = 'megafactory-grid-medium';
		}
			
		if( isset( $image_grid_images ) ){
			
			$output .= '<div class="image-grid-wrapper'. esc_attr( $class_names ) .'">';
				$row_stat = 0;
				
				//Image Grid Slide
				if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '<div class="owl-carousel" '. ( $data_atts ) .'>';
				
					$image_ids = explode( ',', $image_grid_images );

					foreach( $image_ids as $image_id ){
					
						if( $row_stat == 0 && $slide_opt != 'on' ) :
							$output .= '<div class="row">';
						endif;
					
						//Image Grid Slide
						if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '<div class="item">';
						
							$col_class = "col-lg-". absint( $cols );
							$col_class .= " " . ( $cols == 3 ? "col-md-6" : "col-md-". absint( $cols ) );
							$output .= '<div class="'. esc_attr( $col_class ) .'">';
								$output .= '<div class="image-grid-inner">';
					
									$images = wp_get_attachment_image_src( $image_id, $thumb_size, true );
									$image_alt = get_post_meta( absint( $image_id ), '_wp_attachment_image_alt', true);
									$output .='<img class="img-fluid" src="'. $images[0] .'" alt="" data-mce-src="'. $images[0] .'" alt="'. esc_html( $image_alt ) .'" />';
									
								$output .= '</div><!-- .image-grid-inner -->';
							$output .= '</div><!-- .cols -->';
						
						//Team Slide Item End
						if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '</div><!-- .item -->';		
						
						$row_stat++;
						if( $row_stat == ( 12/ $cols ) && $slide_opt != 'on' ) :
							$output .= '</div><!-- .row -->';
							$row_stat = 0;
						endif;
						
					}
					
				//Image Grid Slide End
				if( isset( $slide_opt ) && $slide_opt == 'on' ) $output .= '</div><!-- .owl-carousel -->';
				
			$output .= '</div><!-- .image-grid-wrapper -->';
			
		}
		
		return $output;
	}
}

if ( ! function_exists( "megafactory_vc_image_grid_shortcode_map" ) ) {
	function megafactory_vc_image_grid_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Image Grid", "megafactory" ),
				"description"			=> esc_html__( "Image Grid custom post type.", "megafactory" ),
				"base"					=> "megafactory_vc_image_grid",
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
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Image Grid Columns", "megafactory" ),
						"description"	=> esc_html__( "This grid option using to divide columns as per given numbers. This option active only when slide inactive otherwise slide columns only focus to divide.", "megafactory" ),
						"param_name"	=> "grid_cols",
						"value"			=> array(
							esc_html__( "1 Column", "megafactory" )	=> "12",
							esc_html__( "2 Columns", "megafactory" )	=> "6",
							esc_html__( "3 Columns", "megafactory" )	=> "4",
							esc_html__( "4 Columns", "megafactory" )	=> "3",
						)
					),
					array(
						"type"			=> "img_select",
						"heading"		=> esc_html__( "Image Grid Layout", "megafactory" ),
						"param_name"	=> "image_grid_layout",
						"img_lists" => array ( 
							"1"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/image-grid/1.png",
							"2"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/image-grid/2.png"
						),
						"default"		=> "1"
					),
					array(
						"type" => "attach_images",
						"heading" => esc_html__( "Attach Images", "megafactory" ),
						"description" => esc_html__( "Choose image grid images.", "megafactory" ),
						"param_name" => "image_grid_images",
						"value" => '',
						"group"			=> esc_html__( "Image", "megafactory" ),
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Slide Enable", "megafactory" ),
						"description"	=> esc_html__( "This is option for enable or disable slide.", "megafactory" ),
						"param_name"	=> "slide_opt",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode slide items shown on large devices.", "megafactory" ),
						"param_name"	=> "slide_item",
						"value" 		=> "3",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items on Tab", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode slide items shown on tab.", "megafactory" ),
						"param_name"	=> "slide_item_tab",
						"value" 		=> "2",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items on Mobile", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode slide items shown on mobile.", "megafactory" ),
						"param_name"	=> "slide_item_mobile",
						"value" 		=> "1",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Auto Play", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode slider auto play.", "megafactory" ),
						"param_name"	=> "slide_item_autoplay",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Loop", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode slider loop.", "megafactory" ),
						"param_name"	=> "slide_item_loop",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Items Center", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode center, for this option must active loop and minimum items 2.", "megafactory" ),
						"param_name"	=> "slide_center",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Navigation", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode navigation.", "megafactory" ),
						"param_name"	=> "slide_nav",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Pagination", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode pagination.", "megafactory" ),
						"param_name"	=> "slide_dots",
						"value"			=> "off",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Margin", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode margin space.", "megafactory" ),
						"param_name"	=> "slide_margin",
						"value" 		=> "",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Duration", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode duration.", "megafactory" ),
						"param_name"	=> "slide_duration",
						"value" 		=> "5000",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Smart Speed", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode smart speed.", "megafactory" ),
						"param_name"	=> "slide_smart_speed",
						"value" 		=> "250",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Items Slideby", "megafactory" ),
						"description"	=> esc_html__( "This is option for image gird shortcode scroll by.", "megafactory" ),
						"param_name"	=> "slide_slideby",
						"value" 		=> "1",
						"group"			=> esc_html__( "Slide", "megafactory" )
					),
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_image_grid_shortcode_map" );