<?php
$upload_dir = wp_upload_dir();
$filename = $upload_dir['basedir'] . '/custom-fonts/';
if ( !file_exists( $filename ) ) {
	wp_mkdir_p( $filename );
}

add_action('admin_menu', 'register_megafactory_custom_fonts');
 
function register_megafactory_custom_fonts() {
    add_submenu_page(
        'themes.php',
        esc_html__( 'Megafactory Custom Fonts', 'megafactory-core' ),
        esc_html__( 'Megafactory Custom Fonts', 'megafactory-core' ),
        'manage_options',
        'megafactory-custom-fonts',
        'megafactory_custom_fonts_submenu_page_callback' );
}
function megafactory_custom_fonts_submenu_page_callback() {
	require_once( MEGAFACTORY_CORE_DIR . 'custom-font-code/custom-fonts-uploads.php' );
}

/*Custom Fonts Name Include to Redux*/
if( ! function_exists('megafactory_custom_fonts_names_hook') ) {
	function megafactory_custom_fonts_names_hook(){
		$cf_names = get_option( 'megafactory_custom_fonts_names' );
		$cf_names = isset( $cf_names ) && $cf_names != '' ? $cf_names : array();
		return $cf_names;
	}
	add_filter( 'megafactory_custom_fonts_array', 'megafactory_custom_fonts_names_hook' );
}

add_action( 'wp_ajax_megafactory_custom_font_del', 'megafactory_custom_font_deletion' );
add_action( 'wp_ajax_nopriv_megafactory_custom_font_del', 'megafactory_custom_font_deletion' );
function megafactory_custom_font_deletion(){

	$nonce = esc_attr( $_POST['f_nounce'] );  
    if ( ! wp_verify_nonce( $nonce, 'megafactory-font-nounce' ) )
        die ( esc_html__( 'Busted', 'megafactory-core' ) );
		
		
	$font_id = "'". esc_attr( $_POST['font_id'] ) ."'";
	$t_font_id = esc_attr( $_POST['font_id'] );
	
	$destination = wp_upload_dir();
	$destination_path = $destination['basedir'] . '/custom-fonts/' . $t_font_id;
	
	$custom_fonts_names = get_option( 'megafactory_custom_fonts_names' );
	
	if ( array_key_exists( $font_id, $custom_fonts_names ) ){
		unset($custom_fonts_names[$font_id]);
		update_option( 'megafactory_custom_fonts_names', $custom_fonts_names );

		rmdir_recurse( $destination_path );
		
		$result['type'] = 'success';
		$result['res'] = esc_html__( 'Font Deleted', 'megafactory-core' );
	}else{
		$result['type'] = 'failed';
		$result['res'] = esc_html__( 'Failed to delete.', 'megafactory-core' );
	}
	$result = json_encode($result);
    echo $result;
	die();
}

function rmdir_recurse($path) {
    $path = rtrim($path, '/').'/';
    $handle = opendir($path);
    while(false !== ($file = readdir($handle))) {
        if($file != '.' and $file != '..' ) {
            $fullpath = $path.$file;
            if(is_dir($fullpath)) rmdir_recurse($fullpath); else unlink($fullpath);
        }
    }
    closedir($handle);
    rmdir($path);
}

function megafactory_custom_fonts_table(){
	$custom_fonts_names = get_option( 'megafactory_custom_fonts_names' );
	$i = 1;
	if( $custom_fonts_names != '' ){
		echo '<table class="widefat fixed custom-fonts-table" cellspacing="0">
				<tr>
					<th>'. esc_html__( 'Sno', 'megafactory-core' ) .'</th>
					<th>'. esc_html__( 'Font Name', 'megafactory-core' ) .'</th>
					<th>'. esc_html__( 'Delete', 'megafactory-core' ) .'</th>
				</tr>';
	
		foreach($custom_fonts_names as $key => $val){
			echo '<tr>';
				echo '<td>'. $i .'</td>';
				echo '<td>'. $key .'</td>';
				echo '<td><a href="#" class="megafactory-cus-font-del" data-font="'. esc_attr( $key ) .'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
			echo '</tr>';
			$i++;
		}
	}
}