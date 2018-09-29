<?php

if( class_exists( 'MegafactoryRedux' ) ){
	
	require_once MEGAFACTORY_INC . '/theme-class/theme-style-class.php';
	
	add_action('redux/options/megafactory_options/saved', 'megafactory_save_theme_options', 10, 2);
	add_action('redux/options/megafactory_options/import', 'megafactory_save_theme_options', 10, 1);
	add_action('redux/options/megafactory_options/reset', 'megafactory_save_theme_options');
	add_action('redux/options/megafactory_options/section/reset', 'megafactory_save_theme_options');
	
}

function megafactory_save_theme_options() {

	$theme_id = get_current_blog_id();
	$upload_dir = wp_upload_dir();
	$cus_dir_name = $upload_dir['basedir'] . '/megafactory';

	if ( ! file_exists( $cus_dir_name ) ) {
		wp_mkdir_p( $cus_dir_name );
	}

	// Custom Styles File
	ob_start();
	require_once MEGAFACTORY_THEME_ELEMENTS . '/theme-styles.php';
	$custom_content = ob_get_clean();
	$filename =  $cus_dir_name . '/theme_'. esc_attr( $theme_id ) .'.css';
	$custom_content = preg_replace("/[\r\n]+/", "\n", $custom_content);
	megafactory_file_access_permission($filename, $custom_content);
	
}

function megafactory_file_access_permission( $filename, $custom_content ){

	global $wp_filesystem;
	if( empty( $wp_filesystem ) ) {
		include_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();
	}
	
	if( $wp_filesystem ) {
	
		$wp_filesystem->put_contents(
			$filename,
			$custom_content,
			FS_CHMOD_FILE // predefined mode settings for WP files
		);
		
	}
	
}

add_action( 'wp_ajax_megafactory-redux-themeopt-import', 'megafactory_redux_themeopt_import' );
function megafactory_redux_themeopt_import(){

	$nonce = $_POST['nonce'];
	  
	if ( ! wp_verify_nonce( $nonce, 'megafactory-redux-import' ) )
		die ( esc_html__( 'Busted', 'megafactory' ) );
	
	$json_data = $json_url = '';isset( $_POST['json_data'] ) ? $_POST['json_data'] : '';
	if( isset( $_POST['stat'] ) && $_POST['stat'] == 'data' ){
		$json_data = isset( $_POST['json_data'] ) ? stripslashes( urldecode( $_POST['json_data'] ) ): '';
	}elseif( isset( $_POST['stat'] ) && $_POST['stat'] == 'url' ){
		$json_url = isset( $_POST['json_data'] ) ? urldecode( $_POST['json_data'] ) : '';
		$json_data = megafactory_get_server_files( $json_url );
	}
	// Reset new theme option values
	delete_option( 'megafactory_options' );
	$megafactory_options = json_decode( $json_data, true );
	update_option( 'megafactory_options', $megafactory_options );

	wp_die();
}