<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Manages image sizes settings
 *
 * Here image sizes settings are defined and managed.
 *
 * @version		1.1.4
 * @package		ecommerce-product-catalog/functions
 * @author 		impleCode
 */
class ic_extension_settings_info {

	function __construct() {
		add_action( 'ic_simple_csv_bottom', array( $this, 'product_csv' ) );
	}

	function info_box( $content ) {
		$box = '<div class="extension-info-box">';
		//$box .= '<h4 style="margin-top: 0;">' . __( 'Did you know?', 'ecommerce-product-catalog' ) . '</h4>';
		$box .= $content;
		$box .= '</div>';
		return $box;
	}

	function product_csv() {
		if ( current_action() !== 'ic_plugin_logo_container' ) {
			add_action( 'ic_plugin_logo_container', array( $this, 'product_csv' ) );
		} else {
			$info = sprintf( __( 'With %sProduct CSV%s you can import, export and update unlimited number of products at once. It also supports all product fields and will import external images.', 'ecommerce-product-catalog' ), '<a href="https://implecode.com/wordpress/plugins/product-csv/?cam=extension-info&key=product-csv">', '</a>' );
			echo $this->info_box( $info );
		}
	}

}

$ic_extension_settings_info = new ic_extension_settings_info;
