<?php
	
class MegafactoryRedux{

	function __construct(){
		define( 'MEGAFACTORY_CORE_REDUX', plugin_dir_path(__FILE__) . 'admin/ReduxCore' );
	}
	
	function megafactoryReduxInit(){
		require_once( MEGAFACTORY_CORE_REDUX . '/framework.php' );
		require_once( MEGAFACTORY_CORE_DIR . 'admin/theme-config/config.php' );
	}

}

$megafactory_redux = new MegafactoryRedux();
$megafactory_redux->megafactoryReduxInit();