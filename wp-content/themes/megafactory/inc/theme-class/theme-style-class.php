<?php

class MegafactoryThemeStyles {
   
   	private $megafactory_options;
	private $exists_fonts = array();
   
    function __construct() {
		$this->megafactory_options = get_option( 'megafactory_options' );
    }
	
	function megafactoryThemeColor(){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options['theme-color'] ) && $megafactory_options['theme-color'] != '' ? $megafactory_options['theme-color'] : '#54a5f8';
	}
	
	function megafactory_theme_opt($field){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options[$field] ) && $megafactory_options[$field] != '' ? $megafactory_options[$field] : '';
	}
	
	function megafactory_check_meta_value( $meta_key, $default_key ){
		$meta_opt = get_post_meta( get_the_ID(), $meta_key, true );
		$final_opt = isset( $meta_opt ) && ( empty( $meta_opt ) || $meta_opt == 'theme-default' ) ? $this->megafactory_theme_opt( $default_key ) : $meta_opt;
		return $final_opt;
	}
	
	function megafactory_container_width(){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options['site-width'] ) && $megafactory_options['site-width']['width'] != '' ? absint( $megafactory_options['site-width']['width'] ) . $megafactory_options['site-width']['units'] : '1140px';
	}
	
	function megafactory_dimension_width($field){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options[$field] ) && absint( $megafactory_options[$field]['width'] ) != '' ? absint( $megafactory_options[$field]['width'] ) . $megafactory_options[$field]['units'] : '';
	}
	
	function megafactory_dimension_height($field){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options[$field] ) && absint( $megafactory_options[$field]['height'] ) != '' ? absint( $megafactory_options[$field]['height'] ) . $megafactory_options[$field]['units'] : '';
	}
	
	function megafactory_border_settings($field){
		$megafactory_options = $this->megafactory_options;
		if( isset( $megafactory_options[$field] ) ):
		
			$boder_style = isset( $megafactory_options[$field]['border-style'] ) && $megafactory_options[$field]['border-style'] != '' ? $megafactory_options[$field]['border-style'] : '';
			$border_color = isset( $megafactory_options[$field]['border-color'] ) && $megafactory_options[$field]['border-color'] != '' ? $megafactory_options[$field]['border-color'] : '';
			
			if( isset( $megafactory_options[$field]['border-top'] ) && $megafactory_options[$field]['border-top'] != '' ):
				echo '
				border-top-width: '. $megafactory_options[$field]['border-top'] .';
				border-top-style: '. $boder_style .';
				border-top-color: '. $border_color .';';
			endif;
			
			if( isset( $megafactory_options[$field]['border-right'] ) && $megafactory_options[$field]['border-right'] != '' ):
				echo '
				border-right-width: '. $megafactory_options[$field]['border-right'] .';
				border-right-style: '. $boder_style .';
				border-right-color: '. $border_color .';';
			endif;
			
			if( isset( $megafactory_options[$field]['border-bottom'] ) && $megafactory_options[$field]['border-bottom'] != '' ):
				echo '
				border-bottom-width: '. $megafactory_options[$field]['border-bottom'] .';
				border-bottom-style: '. $boder_style .';
				border-bottom-color: '. $border_color .';';
			endif;
			
			if( isset( $megafactory_options[$field]['border-left'] ) && $megafactory_options[$field]['border-left'] != '' ):
				echo '
				border-left-width: '. $megafactory_options[$field]['border-left'] .';
				border-left-style: '. $boder_style .';
				border-left-color: '. $border_color .';';
			endif;
			
		endif;
	}
	
	function megafactory_padding_settings($field){
		$megafactory_options = $this->megafactory_options;
	if( isset( $megafactory_options[$field] ) ):
	
		echo isset( $megafactory_options[$field]['padding-top'] ) && $megafactory_options[$field]['padding-top'] != '' ? 'padding-top: '. $megafactory_options[$field]['padding-top'] .';' : '';
		echo isset( $megafactory_options[$field]['padding-right'] ) && $megafactory_options[$field]['padding-right'] != '' ? 'padding-right: '. $megafactory_options[$field]['padding-right'] .';' : '';
		echo isset( $megafactory_options[$field]['padding-bottom'] ) && $megafactory_options[$field]['padding-bottom'] != '' ? 'padding-bottom: '. $megafactory_options[$field]['padding-bottom'] .';' : '';
		echo isset( $megafactory_options[$field]['padding-left'] ) && $megafactory_options[$field]['padding-left'] != '' ? 'padding-left: '. $megafactory_options[$field]['padding-left'] .';' : '';
	endif;
	}
	
	function megafactory_margin_settings( $field ){
		$megafactory_options = $this->megafactory_options;
	if( isset( $megafactory_options[$field] ) ):
	
		echo isset( $megafactory_options[$field]['margin-top'] ) && $megafactory_options[$field]['margin-top'] != '' ? 'margin-top: '. $megafactory_options[$field]['margin-top'] .';' : '';
		echo isset( $megafactory_options[$field]['margin-right'] ) && $megafactory_options[$field]['margin-right'] != '' ? 'margin-right: '. $megafactory_options[$field]['margin-right'] .';' : '';
		echo isset( $megafactory_options[$field]['margin-bottom'] ) && $megafactory_options[$field]['margin-bottom'] != '' ? 'margin-bottom: '. $megafactory_options[$field]['margin-bottom'] .';' : '';
		echo isset( $megafactory_options[$field]['margin-left'] ) && $megafactory_options[$field]['margin-left'] != '' ? 'margin-left: '. $megafactory_options[$field]['margin-left'] .';' : '';
	endif;
	}
	
	function megafactory_link_color($field, $fun){
		$megafactory_options = $this->megafactory_options;
	echo isset( $megafactory_options[$field][$fun] ) && $megafactory_options[$field][$fun] != '' ? '
	color: '. $megafactory_options[$field][$fun] .';' : '';
	}
	
	function megafactory_get_link_color($field, $fun){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options[$field][$fun] ) && $megafactory_options[$field][$fun] != '' ? $megafactory_options[$field][$fun] : '';
	}
	
	function megafactory_bg_rgba($field){
		$megafactory_options = $this->megafactory_options;
	echo isset( $megafactory_options[$field]['rgba'] ) && $megafactory_options[$field]['rgba'] != '' ? 'background: '. $megafactory_options[$field]['rgba'] .';' : '';
	}
	
	function megafactory_bg_settings($field){
		$megafactory_options = $this->megafactory_options;
		if( isset( $megafactory_options[$field] ) ):
	echo '
	'. ( isset( $megafactory_options[$field]['background-color'] ) && $megafactory_options[$field]['background-color'] != '' ?  'background-color: '. $megafactory_options[$field]['background-color'] .';' : '' ) .'
	'. ( isset( $megafactory_options[$field]['background-image'] ) && $megafactory_options[$field]['background-image'] != '' ?  'background-image: url('. $megafactory_options[$field]['background-image'] .');' : '' ) .'
	'. ( isset( $megafactory_options[$field]['background-repeat'] ) && $megafactory_options[$field]['background-repeat'] != '' ?  'background-repeat: '. $megafactory_options[$field]['background-repeat'] .';' : '' ) .'
	'. ( isset( $megafactory_options[$field]['background-position'] ) && $megafactory_options[$field]['background-position'] != '' ?  'background-position: '. $megafactory_options[$field]['background-position'] .';' : '' ) .'
	'. ( isset( $megafactory_options[$field]['background-size'] ) && $megafactory_options[$field]['background-size'] != '' ?  'background-size: '. $megafactory_options[$field]['background-size'] .';' : '' ) .'
	'. ( isset( $megafactory_options[$field]['background-attachment'] ) && $megafactory_options[$field]['background-attachment'] != '' ?  'background-attachment: '. $megafactory_options[$field]['background-attachment'] .';' : '' ) .'
	';
		endif;
	}
	
	function megafactory_custom_font_face_create( $font_family, $cf_names ){
	
		$upload_dir = wp_upload_dir();
		$f_type = array('eot', 'otf', 'svg', 'ttf', 'woff');
		if ( in_array( $font_family, $cf_names ) ){
			$t_font_folder = $font_family;
			$t_font_name = sanitize_title( $font_family );
			$font_path = $upload_dir['baseurl'] . '/custom-fonts/' . str_replace( "'", "", $t_font_folder .'/'. $t_font_name );
			echo '@font-face { font-family: '. $t_font_folder .';';
			echo "src: url('". esc_url( $font_path ) .".eot'); /* IE9 Compat Modes */ src: url('". esc_url( $font_path ) .".eot') format('embedded-opentype'), /* IE6-IE8 */ url('". esc_url( $font_path ) .".woff2') format('woff2'), /* Super Modern Browsers */ url('". esc_url( $font_path ) .".woff') format('woff'), /* Pretty Modern Browsers */ url('". esc_url( $font_path ) .".ttf')  format('truetype'), /* Safari, Android, iOS */ url('". esc_url( $font_path ) .".svg') format('svg'); /* Legacy iOS */ }";
		}
		
	}
	
	function megafactory_custom_font_check($field){
		$megafactory_options = $this->megafactory_options;
		$cf_names = get_option( 'megafactory_custom_fonts_names' );

		if ( !empty( $cf_names ) && !in_array( $megafactory_options[$field]['font-family'], $this->exists_fonts ) ){
			$this->megafactory_custom_font_face_create( $megafactory_options[$field]['font-family'], $cf_names );
			array_push( $this->exists_fonts, $megafactory_options[$field]['font-family'] );
		}
	}
	
	function megafactory_typo_generate($field){
		$megafactory_options = $this->megafactory_options;

		if( isset( $megafactory_options[$field] ) ):
	echo '
	'. ( isset( $megafactory_options[$field]['color'] ) && $megafactory_options[$field]['color'] != '' ?  'color: '. $megafactory_options[$field]['color'] .';' : '' ) .'
	'. ( isset( $megafactory_options[$field]['font-family'] ) && $megafactory_options[$field]['font-family'] != '' ?  'font-family: '. $megafactory_options[$field]['font-family'] .';' : '' ) .'
	'. ( isset( $megafactory_options[$field]['font-weight'] ) && $megafactory_options[$field]['font-weight'] != '' ?  'font-weight: '. $megafactory_options[$field]['font-weight'] .';' : '' ) .'
	'. ( isset( $megafactory_options[$field]['font-size'] ) && $megafactory_options[$field]['font-size'] != '' ?  'font-size: '. $megafactory_options[$field]['font-size'] .';' : '' ) .'
	'. ( isset( $megafactory_options[$field]['line-height'] ) && $megafactory_options[$field]['line-height'] != '' ?  'line-height: '. $megafactory_options[$field]['line-height'] .';' : '' ) .'
	'. ( isset( $megafactory_options[$field]['letter-spacing'] ) && $megafactory_options[$field]['letter-spacing'] != '' ?  'letter-spacing: '. $megafactory_options[$field]['letter-spacing'] .';' : '' ) .'
	'. ( isset( $megafactory_options[$field]['text-align'] ) && $megafactory_options[$field]['text-align'] != '' ?  'text-align: '. $megafactory_options[$field]['text-align'] .';' : '' ) .'
	';
		endif;
	}
	
	function megafactory_hex2rgba($color, $opacity = 1) {
	 
		$default = '';
		//Return default if no color provided
		if(empty($color))
			  return $default; 
		//Sanitize $color if "#" is provided 
			if ($color[0] == '#' ) {
				$color = substr( $color, 1 );
			}
			//Check if color has 6 or 3 characters and get values
			if (strlen($color) == 6) {
					$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
					$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
					return $default;
			}
			//Convert hexadec to rgb
			$rgb =  array_map('hexdec', $hex);
	 
			//Check if opacity is set(rgba or rgb)
			if( $opacity == 'none' ){
				$output = implode(",",$rgb);
			}elseif( $opacity ){
				if(abs($opacity) > 1)
					$opacity = 1.0;
				$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
			}else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
			//Return rgb(a) color string
			return $output;
	}

}