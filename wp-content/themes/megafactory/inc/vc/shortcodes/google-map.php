<?php 
/**
 * Megafactory Google Map
 */

if ( ! function_exists( "megafactory_vc_google_map_shortcode" ) ) {
	function megafactory_vc_google_map_shortcode( $atts, $content = NULL ) {
		
		wp_enqueue_script( 'megafactory-gmaps' );
		
		$atts = vc_map_get_attributes( "megafactory_vc_google_map", $atts ); 
		extract( $atts );
		
		$output = '';
		
		//Define Variables
		$animation = isset( $animation ) ? $animation : '';
		$class = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';	

		$map_height = isset( $map_height ) && $map_height != '' ? $map_height : '';
		$map_style = isset( $map_style ) && $map_style != '' ? $map_style : '';
		$scroll_wheel = isset( $scroll_wheel ) && $scroll_wheel == 'on' ? 'true' : 'false';
		$map_zoom = isset( $map_zoom ) && $map_zoom != '' ? $map_zoom : '14';
		$default_mstyle = '[]';
		
		$multi_map = isset( $multi_map ) ? $multi_map : '';
		$multi_map_values = json_decode( urldecode( $multi_map ), true );
		foreach( $multi_map_values as $key => $map ){
			if( isset( $map['map_marker'] ) && $map['map_marker'] != '' ){
				$img_attr = wp_get_attachment_image_src( absint( $map['map_marker'] ), 'full', true );
				$multi_map_values[$key]['map_marker'] = isset( $img_attr ) ? $img_attr[0] : '';
			}
		}
		$multi_map = json_encode( $multi_map_values );

		if( $map_style == 'custom' ){
			$default_mattr = array( "map_color", "map_text_stroke", "map_text_fill", "administrative", "poi_text_fill", "poi_park", "poi_park_text_fill", "road", "road_stroke", "road_text_fill", "road_highway", "road_highway_stroke", "road_highway_text_fill", "transit", "transit_station", "water", "water_text_fill", "water_text_stroke" );
			$map_styl = array();
			foreach( $default_mattr as $attr ){
				$map_styl[$attr] = isset( $$attr ) ? $$attr : '';
			}
			if( $map_styl ):
				$default_mstyle = '[ {"elementType": "geometry", "stylers": [{"color": "'. esc_attr( $map_styl["map_color"] ) .'"}]}, {"elementType": "labels.text.stroke", "stylers": [{"color": "'. esc_attr( $map_styl["map_text_stroke"] ) .'"}]}, {"elementType": "labels.text.fill", "stylers": [{"color": "'. esc_attr( $map_styl["map_text_fill"] ) .'"}]}, {  "featureType": "administrative.locality",  "elementType": "labels.text.fill",  "stylers": [{"color": "'. esc_attr( $map_styl["administrative"] ) .'"}] }, {  "featureType": "poi",  "elementType": "labels.text.fill",  "stylers": [{"color": "'. esc_attr( $map_styl["poi_text_fill"] ) .'"}] }, {  "featureType": "poi.park",  "elementType": "geometry",  "stylers": [{"color": "'. esc_attr( $map_styl["poi_park"] ) .'"}] }, {  "featureType": "poi.park",  "elementType": "labels.text.fill",  "stylers": [{"color": "'. esc_attr( $map_styl["poi_park_text_fill"] ) .'"}] }, {  "featureType": "road",  "elementType": "geometry",  "stylers": [{"color": "'. esc_attr( $map_styl["road"] ) .'"}] }, {  "featureType": "road",  "elementType": "geometry.stroke",  "stylers": [{"color": "'. esc_attr( $map_styl["road_stroke"] ) .'"}] }, {  "featureType": "road",  "elementType": "labels.text.fill",  "stylers": [{"color": "'. esc_attr( $map_styl["road_text_fill"] ) .'"}] }, {  "featureType": "road.highway",  "elementType": "geometry",  "stylers": [{"color": "'. esc_attr( $map_styl["road_highway"] ) .'"}] }, {  "featureType": "road.highway",  "elementType": "geometry.stroke",  "stylers": [{"color": "'. esc_attr( $map_styl["road_highway_stroke"] ) .'"}] }, {  "featureType": "road.highway",  "elementType": "labels.text.fill",  "stylers": [{"color": "'. esc_attr( $map_styl["road_highway_text_fill"] ) .'"}] }, {  "featureType": "transit",  "elementType": "geometry",  "stylers": [{"color": "'. esc_attr( $map_styl["transit"] ) .'"}] }, {  "featureType": "transit.station",  "elementType": "labels.text.fill",  "stylers": [{"color": "'. esc_attr( $map_styl["transit_station"] ) .'"}] }, {  "featureType": "water",  "elementType": "geometry",  "stylers": [{"color": "'. esc_attr( $map_styl["water"] ) .'"}] }, {  "featureType": "water",  "elementType": "labels.text.fill",  "stylers": [{"color": "'. esc_attr( $map_styl["water_text_fill"] ) .'"}] }, {  "featureType": "water",  "elementType": "labels.text.stroke",  "stylers": [{"color": "'. esc_attr( $map_styl["water_text_stroke"] ) .'"}] } ]';
			endif;
		}// if map style is custom
		
		// Get VC Animation
		$class .= megafactoryGetCSSAnimation( $animation );
		
		// This is custom css options for main shortcode warpper
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		
		//Shortcode css ccde here
		$shortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $rand_class ) . '.google-map-wrapper { color: '. esc_attr( $font_color ) .'; }' : '';
		
		if( $shortcode_css ) $class .= ' ' . $shortcode_rand_id . ' megafactory-inline-css';
		
		$output .= '<div class="google-map-wrapper'. esc_attr( $class ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
			$output .= isset( $title ) && $title != '' ? '<h3>' . $title . '</h3>' : '';
			
			$output .= '<div class="megafactorygmap" style="width:100%;height:'. absint( $map_height ) .'px;" data-map-style="'. esc_attr( $map_style ) .'" data-multi-map="true" data-maps="'. htmlspecialchars( $multi_map, ENT_QUOTES, 'UTF-8' ) .'" data-wheel="'. esc_attr( $scroll_wheel ) .'" data-zoom="'. esc_attr( $map_zoom ) .'" data-custom-style="'. htmlspecialchars( $default_mstyle, ENT_QUOTES, 'UTF-8' ) .'"></div>';
			
		$output .= '</div><!-- .google-map-wrapper -->';

		return $output;
	}
}

if ( ! function_exists( "megafactory_vc_google_map_shortcode_map" ) ) {
	function megafactory_vc_google_map_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Google Map", "megafactory" ),
				"description"			=> esc_html__( "Multiple style google map.", "megafactory" ),
				"base"					=> "megafactory_vc_google_map",
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
						"description"	=> esc_html__( "This is text option for google map title.", "megafactory" ),
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
						'type' => 'param_group',
						"heading"		=> esc_html__( "Map Details", "megafactory" ),
						"description"	=> esc_html__( "This is options for google map latitude, longtitude etc..", "megafactory" ),
						'value' => '',
						'param_name' => 'multi_map',
						'params' => array(
							array(
								"type"			=> "textfield",
								"heading"		=> esc_html__( "Map Latitude", "megafactory" ),
								"description"	=> esc_html__( "This is set option for google map latitude. Example -25.363", "megafactory" ),
								"param_name"	=> "map_latitude",
								"value" 		=> "-25.363"
							),
							array(
								"type"			=> "textfield",
								"heading"		=> esc_html__( "Map Longitude", "megafactory" ),
								"description"	=> esc_html__( "This is set option for google map longitude. Example 131.044", "megafactory" ),
								"param_name"	=> "map_longitude",
								"value" 		=> "131.044"
							),
							array(
								"type" => "attach_image",
								"heading" => esc_html__( "Map Marker", "megafactory" ),
								"description" => esc_html__( "Choose map marker image.", "megafactory" ),
								"param_name" => "map_marker",
								"value" => ''
							),
							array(
								"type"			=> "dropdown",
								"heading"		=> esc_html__( "Map Info Window Option", "megafactory" ),
								"description" => esc_html__( "This is option for map info window enable or disable.", "megafactory" ),
								"param_name"	=> "map_info_opt",
								"value"			=> array(
									esc_html__( "Disable", "megafactory" )=> "off",
									esc_html__( "Enable", "megafactory" ) => "on"
								)
							),
							array(
								"type" => "textfield",
								"heading" => esc_html__( "Map Info Window Title", "megafactory" ),
								"param_name" => "map_info_title",
								"value" => '',
								"description" => esc_html__( "This is field for map info window title.", "megafactory" ),
								'dependency' => array(
									'element' => 'map_info_opt',
									'value' => 'on',
								)
							),
							array(
								"type" => "textarea",
								"heading" => esc_html__( "Map Info Window Address", "megafactory" ),
								"param_name" => "map_info_address",
								"value" => '',
								"description" => esc_html__( "This is field for map info window address. No HTML allowed here.", "megafactory" ),
								'dependency' => array(
									'element' => 'map_info_opt',
									'value' => 'on',
								)
							)
						),
						"group"			=> esc_html__( "Map", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Map Height", "megafactory" ),
						"description"	=> esc_html__( "This is set option for google map height.", "megafactory" ),
						"param_name"	=> "map_height",
						"value" 		=> "400",
						"group"			=> esc_html__( "Map", "megafactory" )
					),
					array(
						"type"			=> "dropdown",
						"heading"		=> esc_html__( "Map Style", "megafactory" ),
						"description"	=> esc_html__( "This is option for map style. If you want custom map style, then choose custom and set map colors to 'Color' tab.", "megafactory" ),
						"param_name"	=> "map_style",
						"value"			=> array(
							esc_html__( "Standard", "megafactory" )	=> "standard",
							esc_html__( "Aubergine", "megafactory" )	=> "aubergine",
							esc_html__( "Silver", "megafactory" )	=> "silver",
							esc_html__( "Retro", "megafactory" )		=> "retro",
							esc_html__( "Dark", "megafactory" )		=> "dark",
							esc_html__( "Night", "megafactory" )		=> "night",
							esc_html__( "Custom", "megafactory" )	=> "custom"
						),
						"group"			=> esc_html__( "Map", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Map Zoom", "megafactory" ),
						"description"	=> esc_html__( "This is set option for google map zoom level. Default value is 14", "megafactory" ),
						"param_name"	=> "map_zoom",
						"value" 		=> "14",
						"group"			=> esc_html__( "Map", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Map Scroll Wheel", "megafactory" ),
						"description"	=> esc_html__( "This is option for google map zoom on scroll at position of mouse on map.", "megafactory" ),
						"param_name"	=> "scroll_wheel",
						"value"			=> "off",
						"group"			=> esc_html__( "Map", "megafactory" )
					),
				
					// Custom Map Colors
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Map Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for general map.", "megafactory" ),
						"param_name"	=> "map_color",
						"value" 		=> "#242f3e",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Map Text Stroke Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for general map text stroke.", "megafactory" ),
						"param_name"	=> "map_text_stroke",
						"value" 		=> "#242f3e",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Map Text Fill Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for general map text fill.", "megafactory" ),
						"param_name"	=> "map_text_fill",
						"value" 		=> "#746855",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Administrative Text Fill Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for administrative text fill.", "megafactory" ),
						"param_name"	=> "administrative",
						"value" 		=> "#d59563",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "POI Text Fill Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for POI text fill.", "megafactory" ),
						"param_name"	=> "poi_text_fill",
						"value" 		=> "#d59563",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "POI Park Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for POI park.", "megafactory" ),
						"param_name"	=> "poi_park",
						"value" 		=> "#263c3f",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "POI Park Text Fill Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for POI park text fill.", "megafactory" ),
						"param_name"	=> "poi_park_text_fill",
						"value" 		=> "#6b9a76",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Road Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for road.", "megafactory" ),
						"param_name"	=> "road",
						"value" 		=> "#38414e",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Road Stroke Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for road stroke.", "megafactory" ),
						"param_name"	=> "road_stroke",
						"value" 		=> "#212a37",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Road Text Fill Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for road text fill.", "megafactory" ),
						"param_name"	=> "road_text_fill",
						"value" 		=> "#9ca5b3",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Road Highway Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for road highway.", "megafactory" ),
						"param_name"	=> "road_highway",
						"value" 		=> "#746855",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Road Highway Stroke Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for road highway stroke.", "megafactory" ),
						"param_name"	=> "road_highway_stroke",
						"value" 		=> "#1f2835",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Road Highway Text Fill Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for road highway text fill.", "megafactory" ),
						"param_name"	=> "road_highway_text_fill",
						"value" 		=> "#f3d19c",
						"group"			=> esc_html__( "Color", "megafactory" )
					),					
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Transit Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for transit.", "megafactory" ),
						"param_name"	=> "transit",
						"value" 		=> "#2f3948",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Transit Station Text Fill Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for transit station text fill.", "megafactory" ),
						"param_name"	=> "transit_station",
						"value" 		=> "#d59563",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Water Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for water.", "megafactory" ),
						"param_name"	=> "water",
						"value" 		=> "#17263c",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Water Text Fill Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for water text fill.", "megafactory" ),
						"param_name"	=> "water_text_fill",
						"value" 		=> "#515c6d",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Water Text Stroke Color", "megafactory" ),
						"description"	=> esc_html__( "This is color option for water text stroke.", "megafactory" ),
						"param_name"	=> "water_text_stroke",
						"value" 		=> "#17263c",
						"group"			=> esc_html__( "Color", "megafactory" )
					),
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_google_map_shortcode_map" );