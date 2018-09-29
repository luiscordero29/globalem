<?php
/**
 * Template maintenance
 */
 
 // Activate Maintenance or Coming Soon Mode
 add_action( 'template_redirect', 'megafactory_activate_maintenance_mode' );
 
 function megafactory_activate_maintenance_mode(){
 
	 $megafactory_option = get_option( 'megafactory_options' );
	 $maintenance_mode = isset( $megafactory_option['maintenance-mode'] ) ? $megafactory_option['maintenance-mode'] : false;
	 $maintenance_type = isset( $megafactory_option['maintenance-type'] ) ? $megafactory_option['maintenance-type'] : "cs";
	 
	 if(  $maintenance_mode && ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) ):

		if( $maintenance_type == 'cs' ){
			require_once( MEGAFACTORY_CORE_DIR . 'maintenance/templates/coming-soon.php' );
			die;
		}elseif( $maintenance_type == 'mn' ){
			require_once( MEGAFACTORY_CORE_DIR . 'maintenance/templates/maintenance-mode.php' );
			die;
		}elseif( $maintenance_type == 'cus' ){
			
			global $wp;
			$current_url = home_url( $wp->request );
			$current_url .= '/';
			$maintenance_custom = isset( $megafactory_option['maintenance-custom'] ) ? $megafactory_option['maintenance-custom'] : "";
			$maintenance_page_url = get_permalink( $maintenance_custom );
			if( $current_url != $maintenance_page_url ){
				wp_redirect( $maintenance_page_url );
			}
			
		}else{
			die;
		}
		
		
	 endif; // Maintenance Mode Check

 }