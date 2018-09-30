<?php

class MegafactoryThemeOpt
{

    public static $megafactory_option = '';

	public function __construct(){
		self::$megafactory_option = get_option( 'megafactory_options' );
	}

	public static function megafactoryStaticThemeOpt($field){
		$megafactory_options = self::$megafactory_option;
		return isset( $megafactory_options[$field] ) && $megafactory_options[$field] != '' ? $megafactory_options[$field] : '';
	}

	function megafactoryThemeOpt($field){
		$megafactory_options = self::$megafactory_option;
		return isset( $megafactory_options[$field] ) && $megafactory_options[$field] != '' ? $megafactory_options[$field] : '';
	}

	function megafactoryThemeColor(){
		$megafactory_options = self::$megafactory_option;
		return isset( $megafactory_options['theme-color'] ) && $megafactory_options['theme-color'] != '' ? $megafactory_options['theme-color'] : '#54a5f8';
	}

	function megafactoryHex2Rgba($color, $opacity = 1) {

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
			if($opacity){
				if(abs($opacity) > 1)
					$opacity = 1.0;
				$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
			} else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
			//Return rgb(a) color string
			return $output;
	}

	function megafactoryQuoteDynamicStyle( $field, $value, $theme_color, $rgba_08 ){
		if( $value == 'none' ):
			echo '.'. $field .'-template .post-quote-wrap > .blockquote{
				background-color: #333;
			}';
		elseif( $value == 'theme' ):
			echo '.'. $field .'-template .post-quote-wrap > .blockquote{
				background-color: '. $theme_color .';
				border-left-color: #333;
			}';
		elseif( $value == 'theme-overlay' ):
			echo '.'. $field .'-template .post-quote-wrap > .blockquote{
				background-color: '. $rgba_08 .';
			}';
		elseif( $value == 'featured' ):
			echo '.'. $field .'-template .post-quote-wrap > .blockquote{
				background-color: rgba(0, 0, 0, 0.7);
			}';
		endif;
	}

	function megafactoryLinkDynamicStyle( $field, $value, $theme_color, $rgba_08 ){
		if( $value == 'none' ):
			echo '.'. $field .'-template .post-link-inner{
				background-color: #333;
			}';
		elseif( $value == 'theme' ):
			echo '.'. $field .'-template .post-link-inner{
				background-color: '. $theme_color .';
			}';
		elseif( $value == 'theme-overlay' ):
			echo '.'. $field .'-template .post-link-inner{
				background-color: '. $rgba_08 .';
			}';
		elseif( $value == 'featured' ):
			echo '.'. $field .'-template .post-link-inner{
				background-color: rgba(0, 0, 0, 0.7);
			}';
		endif;
	}

	function megafactoryCheckMetaValue( $meta_key, $default_key ){
		$meta_opt = get_post_meta( get_the_ID(), $meta_key, true );
		$final_opt = isset( $meta_opt ) && ( $meta_opt == '' || $meta_opt == 'theme-default' ) ? $this->megafactoryThemeOpt( $default_key ) : $meta_opt;
		return $final_opt;
	}

	function megafactoryWidget($sidebar, $extra_class){
		if( is_active_sidebar($sidebar  ) ): ?>
			<div class="<?php echo esc_attr( $extra_class ); ?>">
				<?php dynamic_sidebar( $sidebar ); ?>
			</div>
		<?php
		endif;
	}

	function megafactorySocial($social_class = '', $footer = false){

		$megafactory_options = self::$megafactory_option; // Get theme option values from class variable
		$output = '';
		$social_media = array(
				'social-fb' => 'fa fa-facebook',
				'social-twitter' => 'fa fa-twitter',
				'social-instagram' => 'fa fa-instagram',
				'social-linkedin' => 'fa fa-linkedin',
				'social-pinterest' => 'fa fa-pinterest-p',
				'social-gplus' => 'fa fa-google-plus',
				'social-youtube' => 'fa fa-youtube-play',
				'social-vimeo' => 'fa fa-vimeo',
				'social-soundcloud' => 'fa fa-soundcloud',
				'social-yahoo' => 'fa fa-yahoo',
				'social-tumblr' => 'fa fa-tumblr',
				'social-paypal' => 'fa fa-paypal',
				'social-mailto' => 'fa fa-envelope-o',
				'social-flickr' => 'fa fa-flickr',
				'social-dribbble' => 'fa fa-dribbble',
				'social-linkedin' => 'fa fa-linkedin',
				'social-rss' => 'fa fa-rss'
			);



		// Actived social icons from theme option output generate via loop
		$social_icons = '';
		foreach( $social_media as $key => $class ){

			if( isset( $megafactory_options[$key] ) && $megafactory_options[$key] != '' ){
				$social_url = $megafactory_options[$key];
				$social_icons .= '<li class="nav-item">
								<a href="'. esc_url( $social_url ) .'" class="nav-link '. esc_attr( $key ) .'">
									<i class=" '. esc_attr( $class ) .'"></i>
								</a>
							</li>';
			}
		}

		if( !empty( $social_icons ) ):
			if( $footer ){
				$social_class .= isset( $megafactory_options['social-icons-type-footer'] ) ? ' social-' . $megafactory_options['social-icons-type-footer'] : '';
			}else{
				$social_class .= isset( $megafactory_options['social-icons-type'] ) ? ' social-' . $megafactory_options['social-icons-type'] : '';
			}
			$social_class .= isset( $megafactory_options['social-icons-fore'] ) ? ' social-' . $megafactory_options['social-icons-fore'] : '';
			$social_class .= isset( $megafactory_options['social-icons-hfore'] ) ? ' social-' . $megafactory_options['social-icons-hfore'] : '';
			$social_class .= isset( $megafactory_options['social-icons-bg'] ) ? ' social-' . $megafactory_options['social-icons-bg'] : '';
			$social_class .= isset( $megafactory_options['social-icons-hbg'] ) ? ' social-' . $megafactory_options['social-icons-hbg'] : '';

			$output .= '<ul class="nav social-icons '. esc_attr( $social_class ) .'">';
				$output .= $social_icons;
			$output .= '</ul>';
		endif;

		return $output;
	}

	function megafactoryWPMenu($menu_name, $parent_class = ''){
		ob_start();
		wp_nav_menu( array(
			'theme_location' => esc_attr( $menu_name ),
			'menu_class'	=> esc_attr( $parent_class )
		) );
		$output = ob_get_clean();
		return $output;
	}

} new MegafactoryThemeOpt;

class MegafactoryHeaderElements extends MegafactoryThemeOpt {

	private $header_top_elements;
	private $logo_url;
	private $megafactory_options;

	function __construct() {
		$this->megafactory_options = parent::$megafactory_option;
	 	$this->logo_url = get_template_directory_uri() . '/assets/images/logo.png';
		add_action('megafactory_body_action', array( $this, 'megafactoryMobileHeader' ), 10);
		add_action('megafactory_body_action', array( $this, 'megafactoryMobileBar' ), 20);
		add_action('megafactory_body_action', array( $this, 'megafactoryHeaderSecondarySpace' ), 30);
		add_action('megafactory_body_action', array( $this, 'megafactoryHeaderTopSliding' ), 40);


    }

	function megafactoryDimensionHeight($field){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options[$field] ) && absint( $megafactory_options[$field]['height'] ) != '' ? absint( $megafactory_options[$field]['height'] ) . $megafactory_options[$field]['units'] : '';
	}

	function megafactoryThemeLayout(){
		if( megafactory_po_exists() ):
			echo ( $this->megafactoryCheckMetaValue( 'megafactory_page_layout', 'page-layout' ) == 'boxed' ) ? ' boxed-container' : '';
		elseif( is_single() ):
			echo ( $this->megafactoryCheckMetaValue( 'megafactory_post_layout', 'page-layout' ) == 'boxed' ) ? ' boxed-container' : '';
		else:
			$megafactory_options = $this->megafactory_options;
			echo isset( $megafactory_options['page-layout'] ) && $megafactory_options['page-layout'] == 'boxed' ? ' boxed-container' : '';
		endif;
	}

	function megafactoryPageLoader(){
		$megafactory_options = $this->megafactory_options;
		$page_loader = $this->megafactoryThemeOpt('page-loader');
		if( $page_loader == 'yes' ){
			$page_load_img = $this->megafactoryThemeOpt('page-loader-img');
			return isset( $page_load_img['url'] ) ? $page_load_img['url'] : '';
		}
		return false;
	}

	function megafactoryHeaderLayout(){
		$class_name = '';

		if( megafactory_po_exists() ){
			$class_name .= $this->megafactoryCheckMetaValue( 'megafactory_page_header_absolute_opt', 'header-absolute' ) ? ' header-absolute' : '';
		}elseif( is_single() ){
			$class_name .= $this->megafactoryCheckMetaValue( 'megafactory_post_header_absolute_opt', 'header-absolute' ) ? ' header-absolute' : '';
		}else{
			$class_name .= $this->megafactoryThemeOpt('header-absolute') ? ' header-absolute' : '';
		}

		if( megafactory_po_exists() ):
			$class_name .= $this->megafactoryCheckMetaValue( 'megafactory_page_header_layout', 'header-layout' ) == 'boxed' ? ' boxed-container' : '';
		elseif( is_single() ):
			$class_name .= $this->megafactoryCheckMetaValue( 'megafactory_post_header_layout', 'header-layout' ) == 'boxed' ? ' boxed-container' : '';
		else:
			$megafactory_options = $this->megafactory_options;
			if( $this->megafactoryThemeOpt('header-type') == 'default' ):
				$class_name .= isset( $megafactory_options['header-layout'] ) && $megafactory_options['header-layout'] == 'boxed' ? ' boxed-container' : '';
			endif;
		endif;

		echo esc_attr( $class_name );
	}

	function megafactoryHeaderMenu($menu_name, $parent_class = ''){
		ob_start();
		wp_nav_menu( array(
			'theme_location' => esc_attr( $menu_name ),
			'menu_class'	=> esc_attr( $parent_class ),
			'megafactory_primary_stat'		=> 0,
			'fallback_cb'       => 'megafactory_wp_bootstrap_navwalker::fallback',
			'walker'            => new megafactory_wp_bootstrap_navwalker()
		) );
		$output = ob_get_clean();
		return $output;
	}

	function megafactoryHeaderMainMenu(){

		$menu_class = 'nav megafactory-main-menu';

		ob_start();

		$page_menu = get_post_meta( get_the_ID(), 'megafactory_page_nav_menu', true );

		if( isset( $page_menu ) && $page_menu != 'none' && $page_menu != '' ){
			wp_nav_menu( array(
				'menu'				=> $page_menu,
				'menu_id'			=> 'megafactory-main-menu',
				'depth'             => 5,
				'container'         => '',
				'container_class'   => '',
				'menu_class'        => esc_attr( $menu_class ),
				'fallback_cb'       => 'megafactory_wp_bootstrap_navwalker::fallback',
				'walker'            => new megafactory_wp_bootstrap_navwalker())
			);
		}else{
			wp_nav_menu( array(
				'theme_location'    => 'primary-menu',
				'menu_id'			=> 'megafactory-main-menu',
				'depth'             => 5,
				'container'         => '',
				'container_class'   => '',
				'menu_class'        => esc_attr( $menu_class ),
				'fallback_cb'       => 'megafactory_wp_bootstrap_navwalker::fallback',
				'walker'            => new megafactory_wp_bootstrap_navwalker())
			);
		}
		$output = ob_get_clean();
		return $output;
	}

	function megafactoryHeaderLogo(){
		$megafactory_options = $this->megafactory_options;
		$logo_url = isset( $megafactory_options['logo']['url'] ) && $megafactory_options['logo']['url'] != '' ? $megafactory_options['logo']['url'] : '';

		$custom_logo = get_post_meta( get_the_ID(), 'megafactory_page_custom_logo', true );
		$site_title = get_bloginfo( 'name' );

		if( $custom_logo ){
			$img_attributes = wp_get_attachment_image_src( $custom_logo, 'large' );
			$output = '
			<div class="main-logo">
				<a href="'. esc_url( home_url( '/' ) ) .'" title="'. esc_html( $site_title ) .'" ><img class="custom-logo img-responsive" src="'. esc_url( $img_attributes[0] ) .'" alt="'. esc_html( $site_title ) .'" title="'. esc_html( $site_title ) .'" /></a>
			</div>';
		}elseif( $logo_url ){
			$output = '
			<div class="main-logo">
				<a href="'. esc_url( home_url( '/' ) ) .'" title="'. esc_html( $site_title ) .'" ><img class="custom-logo img-responsive" src="'. esc_url( $logo_url ) .'" alt="'. esc_html( $site_title ) .'" title="'. esc_html( $site_title ) .'" /></a>
			</div>';
		}else{
			$output = '
			<div class="main-logo">
				<a class="site-title" href="'. esc_url( home_url( '/' ) ) .'" title="'. esc_html( $site_title ) .'" >'. esc_html( $site_title ) .'</a>
			</div>';
		}
		return $output;
	}

	function megafactoryAdditionalLogo($field){
		$megafactory_options = $this->megafactory_options;
		$logo_url = isset( $megafactory_options[$field]['url'] ) && $megafactory_options[$field]['url'] != '' ? $megafactory_options[$field]['url'] : '';

		$custom_sticky_logo = get_post_meta( get_the_ID(), 'megafactory_page_custom_sticky_logo', true );
		$site_title = get_bloginfo( 'name' );

		if( $field == 'sticky-logo' && $custom_sticky_logo ){
			$img_attributes = wp_get_attachment_image_src( $custom_sticky_logo, 'large' );
			$output = '<a href="'. esc_url( home_url( '/' ) ) .'" title="'. esc_html( $site_title ) .'" ><img class="custom-logo img-responsive" src="'. esc_url( $img_attributes[0] ) .'" alt="'. esc_html( $site_title ) .'" title="'. esc_html( $site_title ) .'" /></a>';
		}elseif( $logo_url ){
			$output = '<a href="'. esc_url( home_url( '/' ) ) .'" title="'. esc_html( $site_title ) .'" ><img class="img-responsive" src="'. esc_url( $logo_url ) .'" alt="'. esc_html( $site_title ) .'" title="'. esc_html( $site_title ) .'" /></a>';
		}else{
			$output = '<a class="site-title" href="'. esc_url( home_url( '/' ) ) .'" title="'. esc_html( $site_title ) .'" >'. esc_html( $site_title ) .'</a>';
		}
		return $output;
	}

	function megafactoryHeaderDate(){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options['header-topbar-date'] ) && $megafactory_options['header-topbar-date'] != '' ? $megafactory_options['header-topbar-date'] : 'l, F j, Y';
	}

	function megafactoryHeaderCustomText($key){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options[$key] ) ? $megafactory_options[$key] : '';
	}

	function megafactoryToggleSearchBarOut(){
		$output = '
				<div class="full-bar-search-wrap">
					<form method="get" class="search-form" action="'. esc_url( home_url( '/' ) ) .'">
						<div class="input-group">
							<input type="text" class="form-control" value="'. get_search_query() .'" placeholder="'. esc_html__('Search hit enter..', 'megafactory') .'">
						</div>
					</form>
					<a href="#" class="close full-bar-search-toggle"></a>
				</div>';
		return $output;
	}

	function megafactoryHeaderSearchModal(){
		$megafactory_options = $this->megafactory_options;
		$serach_opt = $this->megafactoryThemeOpt('search-toggle-form');
		$output = '';
		switch( $serach_opt ){

			case '1':
				$output .= '<a class="full-search-toggle" href="#"><i class="fa fa-search"></i></a>';
			break;

			case '2':
				$output .= '
				<div class="textbox-search-wrap">
					<form method="get" class="search-form" action="'. esc_url( home_url( '/' ) ) .'">
						<div class="input-group">
							<input type="text" class="form-control" value="'. get_search_query() .'" placeholder="'. esc_html__('Search hit enter..', 'megafactory') .'">
						</div>
					</form>
				</div>
				<a class="textbox-search-toggle" href="#"><i class="fa fa-search"></i></a>
				';
			break;

			case '3':
				add_filter( "megafactory_toggle_search_bar", array( $this , "megafactoryToggleSearchBarOut" ) , 10 );
				$output .= '<a class="full-bar-search-toggle" href="#"><i class="fa fa-search"></i></a>';
			break;

			case '4':
				ob_start();
				get_search_form();
				$form_out = ob_get_clean();
				$output .= '<div class="bottom-search-wrap">';
				$output .= $form_out;
				$output .= '</div>
				<a class="bottom-search-toggle" href="#"><i class="fa fa-search"></i></a>';
			break;

			default:
				 get_search_form();
			break;

		}

		return $output;
	}

	function megafactoryHeaderSecondarySpace(){
		$megafactory_options = $this->megafactory_options;
		$sec_opt = get_post_meta( get_the_ID(), 'megafactory_page_header_secondary_opt', true );
		if( $sec_opt != 'disable' && ( $sec_opt == 'enable' || ( $this->megafactoryThemeOpt('secondary-menu') == true && $this->megafactoryThemeOpt('header-type') == 'default' ) ) ):
			if ( is_active_sidebar( 'secondary-menu-sidebar' ) ) :
				$menu_type = '';
				if( $sec_opt == 'enable' ){
					$menu_type = get_post_meta( get_the_ID(), 'megafactory_page_header_secondary_animate', true );
				}else{
					$menu_type = $this->megafactoryThemeOpt('secondary-menu-type');
				}
				$secondary_pos = '';
				if( $menu_type == 'left-push' || $menu_type == 'left-overlay' )
					$secondary_pos = 'left';
				elseif( $menu_type == 'full-overlay' )
					$secondary_pos = 'overlay';
				else
					$secondary_pos = 'right';
			?>
				<div class="secondary-menu-area <?php echo esc_attr( $menu_type ); ?>" data-pos="<?php echo esc_attr($secondary_pos); ?>">
					<span class="close secondary-space-toggle" title="<?php esc_html_e( 'Close', 'megafactory' ); ?>"></span>
					<div class="secondary-menu-area-inner">
						<?php dynamic_sidebar( 'secondary-menu-sidebar' ); ?>
					</div>
				</div>
			<?php
			endif;
		endif;
	}

	function megafactoryWooCart(){
		ob_start();
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			do_action( 'megafactory_woo_cart_icon' );
		}
		$woo_cart_out = ob_get_clean();

		$woo_cart_out = '<ul class="nav"><li class="menu-item dropdown mini-cart-items">'. $woo_cart_out ."</li></ul>";

		return $woo_cart_out;
	}

	function megafactoryHeaderTopSliding(){
		$megafactory_options = $this->megafactory_options;
		if( $this->megafactoryThemeOpt('header-top-sliding-switch') ):

			$cols = $this->megafactoryThemeOpt('header-top-sliding-cols');
			$cols = $cols != '' ? $cols : '4';


			$enable_devices = $this->megafactoryThemeOpt('header-top-sliding-device');

			$en_dev_array = array();
			$class = '';
			if( $enable_devices ):
				foreach ( $enable_devices as $key => $value ) {
					array_push( $en_dev_array, $value );
				}
			endif;

			if( !in_array( "desktop", $en_dev_array ) ):
				$class = ' hidden-xl-down';
			elseif( !in_array( "tab", $en_dev_array ) ):
				$class = ' hidden-md-down';
			elseif( !in_array( "mobile", $en_dev_array ) ):
				$class = ' hidden-sm-down';
			endif;

		?>
			<div class="top-sliding-bar<?php echo esc_attr( $class ); ?>">
				<div class="top-sliding-bar-inner">
					<div class="container">
						<div class="row" data-col="<?php echo esc_attr( $cols ); ?>">

							<?php if( $cols <= 12 && is_active_sidebar( $this->megafactoryThemeOpt('header-top-sliding-sidebar-1') ) ): ?>
							<div class="col-sm-<?php echo esc_attr( $cols ); ?>">
								<?php dynamic_sidebar( $this->megafactoryThemeOpt('header-top-sliding-sidebar-1') ); ?>
							</div>
							<?php endif; ?>

							<?php if( $cols <= 6 && is_active_sidebar( $this->megafactoryThemeOpt('header-top-sliding-sidebar-2') ) ): ?>
							<div class="col-sm-<?php echo esc_attr( $cols ); ?>">
								<?php dynamic_sidebar( $this->megafactoryThemeOpt('header-top-sliding-sidebar-2') ); ?>
							</div>
							<?php endif; ?>

							<?php if( $cols <= 4 && is_active_sidebar( $this->megafactoryThemeOpt('header-top-sliding-sidebar-3') ) ): ?>
							<div class="col-sm-<?php echo esc_attr( $cols ); ?>">
								<?php dynamic_sidebar( $this->megafactoryThemeOpt('header-top-sliding-sidebar-3') ); ?>
							</div>
							<?php endif; ?>

							<?php if( $cols <= 3 && is_active_sidebar( $this->megafactoryThemeOpt('header-top-sliding-sidebar-4') ) ): ?>
							<div class="col-sm-<?php echo esc_attr( $cols ); ?>">
								<?php dynamic_sidebar( $this->megafactoryThemeOpt('header-top-sliding-sidebar-4') ); ?>
							</div>
							<?php endif; ?>

						</div>
					</div>
				</div>
				<a href="#" class="top-sliding-toggle"></a>
			</div>
		<?php
		endif;
	}

	function megafactoryHeaderTopBarElementsOut($key) {

		switch($key) {

			case 'header-topbar-menu':
				echo ( $this->megafactoryHeaderMenu('top-menu', 'topbar-items nav') );
			break;

			case 'header-topbar-social':
				echo ( $this->megafactorySocial() );
			break;

			case 'header-topbar-date':
				echo date_i18n( stripslashes( $this->megafactoryHeaderDate() ) );
			break;

			case 'header-topbar-search':
				 get_search_form();
			break;

			case 'header-topbar-text-1':
				echo do_shortcode( $this->megafactoryHeaderCustomText('header-topbar-text-1') );
			break;

			case 'header-topbar-text-2':
				echo do_shortcode( $this->megafactoryHeaderCustomText('header-topbar-text-2') );
			break;

			case 'header-topbar-ads-list':
				 echo megafactory_ads_out( $this->megafactoryThemeOpt( 'header-topbar-ads-list' ) );
			break;

			case 'header-phone':
				$header_phone = $this->megafactoryThemeOpt( 'header-phone-text' );
				if( $header_phone )
				echo '<div class="header-phone"><span class="fa fa-phone"></span> <a href="tel:'. esc_attr( $header_phone ) .'">'. esc_attr( $header_phone ) .'</a></div>';
			break;

			case 'header-address':
				$header_address = $this->megafactoryThemeOpt( 'header-address-text' );
				if( $header_address )
				echo '<div class="header-address"><span class="fa fa-map-marker"></span> '. wp_kses_post( $header_address ) .'</div>';
			break;

			case 'header-email':
				$header_email = $this->megafactoryThemeOpt( 'header-email-text' );
				if( $header_email )
				echo '<div class="header-email"><span class="fa fa-envelope-o"></span> <a href="mailto:'. esc_attr( $header_email ) .'">'. esc_attr( $header_email ) .'</a></div>';
			break;

		}
	}

	function megafactoryHeaderTopBarElements($item, $class = '') {

		$topbar_elements = '';
		if( megafactory_po_exists() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_header_topbar_items_opt', true );
			if( $post_items_opt == 'custom' ){
				$topbar_elements_json = get_post_meta( get_the_ID(), 'megafactory_page_header_topbar_items', true );
				$topbar_elements = json_decode( stripslashes( $topbar_elements_json ), true );
				$topbar_elements = $topbar_elements[$item];
			}else{
				$megafactory_options = $this->megafactory_options;
				$topbar_elements = $megafactory_options['header-topbar-items'][$item];
			}
		}elseif( is_single() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_header_topbar_items_opt', true );
			if( $post_items_opt == 'custom' ){
				$topbar_elements_json = get_post_meta( get_the_ID(), 'megafactory_post_header_topbar_items', true );
				$topbar_elements = json_decode( stripslashes( $topbar_elements_json ), true );
				$topbar_elements = $topbar_elements[$item];
			}else{
				$megafactory_options = $this->megafactory_options;
				$topbar_elements = $megafactory_options['header-topbar-items'][$item];
			}
		}else{
			$megafactory_options = $this->megafactory_options;
			$topbar_elements = $megafactory_options['header-topbar-items'][$item];
		}
		if( array_key_exists( "placebo", $topbar_elements ) ) unset( $topbar_elements['placebo'] );
		if ($topbar_elements):
		?>
			<ul class="topbar-items nav <?php echo esc_attr( $class ); ?>">
		<?php foreach ($topbar_elements as $element => $value ) {?>
				<li class="nav-item">
					<div class="nav-item-inner">
				<?php $this->megafactoryHeaderTopBarElementsOut($element); ?>
					</div>
				</li>
		<?php }	?>
			</ul>
		<?php
		endif;

	}

	function megafactoryHeaderLogoBarElementsOut($key) {

		switch($key) {

			case 'header-logobar-logo':
				echo ( $this->megafactoryHeaderLogo() );
			break;

			case 'header-logobar-menu':
				echo ( $this->megafactoryHeaderMainMenu() );
			break;

			case 'header-logobar-social':
				echo ( $this->megafactorySocial() );
			break;

			case 'header-logobar-search':
				 get_search_form();
			break;

			case 'header-logobar-text-1':
				echo do_shortcode( $this->megafactoryHeaderCustomText('header-logobar-text-1') );
			break;

			case 'header-logobar-text-2':
				echo do_shortcode( $this->megafactoryHeaderCustomText('header-logobar-text-2') );
			break;

			case 'header-logobar-search-toggle':
				 echo '<div class="search-toggle-wrap">' . $this->megafactoryHeaderSearchModal() . '</div>';
			break;

			case 'header-logobar-secondary-toggle':
				echo '<a class="secondary-space-toggle" href="#"><span></span><span></span><span></span></a>';
			break;

			case 'header-logobar-ads-list':
				 echo megafactory_ads_out( $this->megafactoryThemeOpt( 'header-logobar-ads-list' ) );
			break;

			case 'header-phone':
				$header_phone = $this->megafactoryThemeOpt( 'header-phone-text' );
				if( $header_phone )
				echo '<div class="header-phone"><span class="fa fa-phone"></span> '. wp_kses_post( $header_phone ) .'</div>';
			break;

			case 'header-address':
				$header_address = $this->megafactoryThemeOpt( 'header-address-text' );
				if( $header_address )
				echo '<div class="header-address"><span class="fa fa-map-marker"></span> '. wp_kses_post( $header_address ) .'</div>';
			break;

			case 'header-email':
				$header_email = $this->megafactoryThemeOpt( 'header-email-text' );
				if( $header_email )
				echo '<div class="header-email"><span class="fa fa-envelope-o"></span> '. wp_kses_post( $header_email ) .'</div>';
			break;

			case 'header-cart':
				echo do_shortcode( $this->megafactoryWooCart() );
			break;

		}
	}

	function megafactoryHeaderLogoBarElements($item, $class = '') {

		$logobar_elements = '';
		if( megafactory_po_exists() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_header_logo_bar_items_opt', true );
			if( $post_items_opt == 'custom' ){
				$logobar_elements_json = get_post_meta( get_the_ID(), 'megafactory_page_header_logo_bar_items', true );
				$logobar_elements = json_decode( stripslashes( $logobar_elements_json ), true );
				$logobar_elements = $logobar_elements[$item];
			}else{
				$megafactory_options = $this->megafactory_options;
				$logobar_elements = $megafactory_options['header-logobar-items'][$item];
			}
		}elseif( is_single() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_header_logo_bar_items_opt', true );
			if( $post_items_opt == 'custom' ){
				$logobar_elements_json = get_post_meta( get_the_ID(), 'megafactory_post_header_logo_bar_items', true );
				$logobar_elements = json_decode( stripslashes( $logobar_elements_json ), true );
				$logobar_elements = $logobar_elements[$item];
			}else{
				$megafactory_options = $this->megafactory_options;
				$logobar_elements = $megafactory_options['header-logobar-items'][$item];
			}
		}else{
			$megafactory_options = $this->megafactory_options;
			$logobar_elements = $megafactory_options['header-logobar-items'][$item];
		}

		if( array_key_exists( "placebo", $logobar_elements ) ) unset( $logobar_elements['placebo'] );
		if ($logobar_elements):
		?>
			<ul class="logobar-items nav <?php echo esc_attr( $class ); ?>">
		<?php foreach ($logobar_elements as $element => $value ) {?>
				<li class="nav-item">
					<div class="nav-item-inner">
				<?php $this->megafactoryHeaderLogoBarElementsOut($element); ?>
					</div>
				</li>
		<?php }	?>
			</ul>
		<?php
		endif;

	}

	/* Header Navbar Items */
	function megafactoryHeaderNavBarElementsOut($key) {

		switch($key) {

			case 'header-navbar-logo':
				echo ( $this->megafactoryHeaderLogo() );
			break;

			case 'header-navbar-sticky-logo':
				echo '<div class="sticky-logo">' . $this->megafactoryAdditionalLogo( 'sticky-logo' ) . '</div>';
			break;

			case 'header-navbar-menu':
				echo ( $this->megafactoryHeaderMainMenu() );
			break;

			case 'header-navbar-social':
				echo ( $this->megafactorySocial() );
			break;

			case 'header-navbar-search':
				 get_search_form();
			break;

			case 'header-navbar-search-toggle':
				 echo '<div class="search-toggle-wrap">' . $this->megafactoryHeaderSearchModal() . '</div>';
			break;

			case 'header-navbar-text-1':
				echo do_shortcode( $this->megafactoryHeaderCustomText('header-navbar-text-1') );
			break;

			case 'header-navbar-text-2':
				echo do_shortcode( $this->megafactoryHeaderCustomText('header-navbar-text-2') );
			break;

			case 'header-navbar-secondary-toggle':
				echo '<a class="secondary-space-toggle" href="#"><span></span><span></span><span></span></a>';
			break;

			case 'header-cart':
				echo do_shortcode( $this->megafactoryWooCart() );
			break;

			case 'header-navbar-ads-list':
				 echo megafactory_ads_out( $this->megafactoryThemeOpt( 'header-navbar-ads-list' ) );
			break;

			case 'header-phone':
				$header_phone = $this->megafactoryThemeOpt( 'header-phone-text' );
				if( $header_phone )
				echo '<div class="header-phone"><span class="fa fa-phone"></span> '. wp_kses_post( $header_phone ) .'</div>';
			break;

			case 'header-address':
				$header_address = $this->megafactoryThemeOpt( 'header-address-text' );
				if( $header_address )
				echo '<div class="header-address"><span class="fa fa-map-marker"></span> '. wp_kses_post( $header_address ) .'</div>';
			break;

			case 'header-email':
				$header_email = $this->megafactoryThemeOpt( 'header-email-text' );
				if( $header_email )
				echo '<div class="header-email"><span class="fa fa-envelope-o"></span> '. wp_kses_post( $header_email ) .'</div>';
			break;

		}
	}

	function megafactoryHeaderNavBarElements($item, $class = '') {

		$navbar_elements = '';
		if( megafactory_po_exists() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_header_navbar_items_opt', true );
			if( $post_items_opt == 'custom' ){
				$navbar_elements_json = get_post_meta( get_the_ID(), 'megafactory_page_header_navbar_items', true );
				$navbar_elements = json_decode( stripslashes( $navbar_elements_json ), true );
				$navbar_elements = $navbar_elements[$item];
			}else{
				$megafactory_options = $this->megafactory_options;
			$navbar_elements = $megafactory_options['header-navbar-items'][$item];
			}
		}elseif( is_single() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_header_navbar_items_opt', true );
			if( $post_items_opt == 'custom' ){
				$navbar_elements_json = get_post_meta( get_the_ID(), 'megafactory_post_header_navbar_items', true );
				$navbar_elements = json_decode( stripslashes( $navbar_elements_json ), true );
				$navbar_elements = $navbar_elements[$item];
			}else{
				$megafactory_options = $this->megafactory_options;
			$navbar_elements = $megafactory_options['header-navbar-items'][$item];
			}
		}else{
			$megafactory_options = $this->megafactory_options;
			$navbar_elements = $megafactory_options['header-navbar-items'][$item];
		}

		if( array_key_exists( "placebo", $navbar_elements ) ) unset( $navbar_elements['placebo'] );
		if ($navbar_elements):
		?>
			<ul class="navbar-items nav <?php echo esc_attr( $class ); ?>">
		<?php foreach ($navbar_elements as $element => $value ) {?>
				<li class="nav-item">
					<div class="nav-item-inner">
				<?php $this->megafactoryHeaderNavBarElementsOut($element); ?>
					</div>
				</li>
		<?php }	?>
			</ul>
		<?php
		endif;

	}

	function megafactoryHeaderBarElements($state = '', $elements) {
		$megafactory_options = $this->megafactory_options;
		$header_elements = $elements;

		if( array_key_exists( "placebo", $header_elements ) ) unset( $header_elements['placebo'] );

		if ($header_elements):

			$sticky_opt = '';
			$sticky = $sticky_scroll = '';

			if( megafactory_po_exists() ){
				$sticky_opt = get_post_meta( get_the_ID(), 'megafactory_page_header_sticky_opt', true );
			}elseif( is_single() ){
				$sticky_opt = get_post_meta( get_the_ID(), 'megafactory_post_header_sticky_opt', true );
			}else{
				$sticky_opt = 'theme-default';
			}


			if( $sticky_opt == '' || $sticky_opt == 'theme-default' ){
				$sticky = $this->megafactoryThemeOpt('sticky-part');
				$sticky_scroll = $this->megafactoryThemeOpt('sticky-part-scrollup');
			}elseif( $sticky_opt == 'sticky' ){
				$sticky = 1;
				$sticky_scroll = 0;
			}elseif( $sticky_opt == 'sticky-scroll' ){
				$sticky = 1;
				$sticky_scroll = 1;
			}else{
				$sticky = 0;
			}

			if( $state == 'sticky' && $sticky == 1 ):
			?> <div class="sticky-outer"> <?php
				if( $sticky_scroll == 1 ):
				?> <div class="sticky-scroll"> <?php
				else:
				?> <div class="sticky-head"> <?php
				endif;
			endif;

			foreach ($header_elements as $element => $value ) {
				switch($element){
					case 'header-topbar':
					?>
						<div class="topbar clearfix">
							<div class="container topbar-inner">
								<?php
									$this->megafactoryHeaderTopBarElements('Left', 'pull-left');
									$this->megafactoryHeaderTopBarElements('Center', 'pull-center text-center');
									$this->megafactoryHeaderTopBarElements('Right', 'pull-right');
								?>
							</div>
						</div>
					<?php
					break;

					case 'header-logo':
					?>
						<div class="logobar clearfix">
							<div class="container logobar-inner">
								<?php
									$this->megafactoryHeaderLogoBarElements('Left', 'pull-left');
									$this->megafactoryHeaderLogoBarElements('Center', 'pull-center text-center');
									$this->megafactoryHeaderLogoBarElements('Right', 'pull-right');
								?>
							</div>
							<?php
								/*$serach_bar = $this->megafactoryThemeOpt('header-logobar-items');
								if (
									array_key_exists( "header-logobar-search-toggle", $serach_bar['Left'] ) ||
									array_key_exists( "header-logobar-search-toggle", $serach_bar['Center'] ) ||
									array_key_exists( "header-logobar-search-toggle", $serach_bar['Right'] )
								)*/
									echo apply_filters( 'megafactory_toggle_search_bar', '');
							?>
						</div>
					<?php
					break;

					case 'header-nav':
					?>
						<nav class="navbar clearfix">
							<div class="container navbar-inner">
								<?php
									$this->megafactoryHeaderNavBarElements('Left', 'pull-left');
									$this->megafactoryHeaderNavBarElements('Center', 'pull-center text-center');
									$this->megafactoryHeaderNavBarElements('Right', 'pull-right');
								?>
							</div>
							<?php
								/*$serach_bar = $this->megafactoryThemeOpt('header-navbar-items');
								if (
									array_key_exists( "header-navbar-search-toggle", $serach_bar['Left'] ) ||
									array_key_exists( "header-navbar-search-toggle", $serach_bar['Center'] ) ||
									array_key_exists( "header-navbar-search-toggle", $serach_bar['Right'] )
								)*/
									echo apply_filters( 'megafactory_toggle_search_bar', '');
							?>
						</nav>
					<?php
					break;
				}
			}

			if( $state == 'sticky' && $sticky == 1 ):
				?> </div><!--stikcy outer-->
				</div><!-- sticky-head or sticky-scroll --> <?php
			endif;

		endif;
	}

	/* Header Navbar Items */
	function megafactoryStickyHeaderSpaceElements($key) {

		switch($key) {

			case 'header-fixed-logo':
				echo ( $this->megafactoryHeaderLogo() );
			break;

			case 'header-fixed-menu':
				echo ( $this->megafactoryWPMenu('primary-menu', 'megafactory-main-menu') );
			break;

			case 'header-fixed-social':
				echo ( $this->megafactorySocial() );
			break;

			case 'header-fixed-search':
				 get_search_form();
			break;

			case 'header-fixed-text-1':
				echo do_shortcode( $this->megafactoryHeaderCustomText('header-navbar-text-1') );
			break;

			case 'header-fixed-text-2':
				echo do_shortcode( $this->megafactoryHeaderCustomText('header-navbar-text-2') );
			break;

		}
	}

	function megafactoryStickyHeaderSpace(){
		//$megafactory_options = $this->megafactory_options;
		$elements = array( 'Top', 'Middle', 'Bottom' );

		$class_name = '';
		if( megafactory_po_exists() ):
			$class_name = $this->megafactoryCheckMetaValue( 'megafactory_page_header_type', 'header-type' );
		elseif( is_single() ):
			$class_name = $this->megafactoryCheckMetaValue( 'megafactory_post_header_type', 'header-type' );
		else:
			$class_name = $this->megafactoryThemeOpt('header-type');
		endif;

	?>
		<div class="sticky-header-space <?php echo esc_attr( $class_name ); ?>">
			<div class="sticky-header-space-inner">
	<?php
		foreach( $elements as $part ){

			$header_fixed_array = $header_fixed_elements = '';

			if( megafactory_po_exists() ){
				$header_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_header_stikcy_items_opt', true );
				if( $header_items_opt == 'custom' ){
					$header_items = get_post_meta( get_the_ID(), 'megafactory_page_header_stikcy_items', true );
					$header_fixed_array = json_decode( stripslashes( $header_items ), true );
				}else{
					$header_fixed_array = $this->megafactoryThemeOpt( 'header-fixed-items' );
				}
			}elseif( is_single() ){
				$header_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_header_stikcy_items_opt', true );
				if( $header_items_opt == 'custom' ){
					$header_items = get_post_meta( get_the_ID(), 'megafactory_post_header_stikcy_items', true );
					$header_fixed_array = json_decode( stripslashes( $header_items ), true );
				}else{
					$header_fixed_array = $this->megafactoryThemeOpt( 'header-fixed-items' );
				}
			}else{
				$header_fixed_array = $this->megafactoryThemeOpt( 'header-fixed-items' );
			}

			if( is_array( $header_fixed_array ) ){
				$header_fixed_elements = $header_fixed_array[$part];
				//unset unwanted redux auto generate item
				if( array_key_exists( "placebo", $header_fixed_elements ) ) unset( $header_fixed_elements['placebo'] );
			}

			if ($header_fixed_elements):
			?>
				<ul class="header-fixed-items nav flex-column header-fixed-<?php echo sanitize_title( $part ); ?>">
			<?php foreach ($header_fixed_elements as $element => $value ) {?>
					<li class="nav-item">
						<div class="nav-item-inner">
							<?php $this->megafactoryStickyHeaderSpaceElements($element); ?>
						</div>
					</li>
			<?php } ?>
				</ul>
			<?php
			endif;

		}// end foreach
	?>
			</div>
		</div>
	<?php
	}

	function megafactoryFullSearchWrap(){
	?>
		<div class="full-search-wrapper">
			<a class="full-search-toggle close" href="#"></a>
			<?php get_search_form(); ?>
		</div>
	<?php
	}

	/* Header Navbar Items */
	function megafactoryMobileHeaderElements($key) {

		switch($key) {

			case 'mobile-header-logo':
				echo '<div class="mobile-logo">' . $this->megafactoryAdditionalLogo( 'mobile-logo' ) . '</div>';
			break;

			case 'mobile-header-cart':
				echo '<a class="cart-bar-toggle" href="#"><i class="icon-basket"></i></a>';
			break;

			case 'mobile-header-menu':
				echo '<a class="mobile-bar-toggle" href="#"><i class="fa fa-bars"></i></a>';
			break;

			case 'mobile-header-search':
				echo '<a class="full-search-toggle" href="#"><i class="fa fa-search"></i></a>';
				add_action('megafactory_body_action', array( $this, 'megafactoryFullSearchWrap' ), 50);
			break;

		}
	}

	/* Header Mobile Bar Items */
	function megafactoryMobileBarElements($key) {

		switch($key) {

			case 'mobile-menu-logo':
				echo '<div class="mobile-logo">' . $this->megafactoryAdditionalLogo( 'mobile-logo' ) . '</div>';
			break;

			case 'mobile-menu-mainmenu':
				echo '<div class="megafactory-mobile-main-menu"></div>';//( $this->megafactoryWPMenu('primary-menu', 'megafactory-main-menu') );
			break;

			case 'mobile-menu-social':
				echo ( $this->megafactorySocial() );
			break;

			case 'mobile-menu-search':
				 get_search_form();
			break;

			case 'mobile-menu-text-1':
				echo do_shortcode( $this->megafactoryHeaderCustomText('header-navbar-text-1') );
			break;

			case 'mobile-menu-text-2':
				echo do_shortcode( $this->megafactoryHeaderCustomText('header-navbar-text-2') );
			break;

		}
	}

	function megafactoryMobileBar(){
		$megafactory_options = $this->megafactory_options;
		$animate_from = ' animate-from-'. $this->megafactoryThemeOpt('mobile-menu-animate-from');
		$elements = array( 'Top', 'Middle', 'Bottom' );
		?>
		<div class="mobile-bar<?php echo esc_attr( $animate_from ); ?>">
			<a class="mobile-bar-toggle close" href="#"></a>
			<div class="mobile-bar-inner">
				<div class="container">
		<?php
			foreach( $elements as $part ){

				$mobile_bar_elements = $megafactory_options['mobile-menu-items'][$part];
				if( is_array( $mobile_bar_elements ) && array_key_exists( "placebo", $mobile_bar_elements ) ) unset( $mobile_bar_elements['placebo'] );
				if ($mobile_bar_elements):
				?>
					<ul class="mobile-bar-items nav flex-column mobile-bar-<?php echo sanitize_title( $part ); ?>">
				<?php foreach ($mobile_bar_elements as $element => $value ) {?>
						<li class="nav-item">
							<div class="nav-item-inner">
						<?php $this->megafactoryMobileBarElements($element); ?>
							</div>
						</li>
				<?php }	?>
					</ul>
				<?php
				endif;

			} // end foreach
		?>
				</div><!-- container -->
			</div>
		</div>
		<?php
	}

	function megafactoryMobileHeader(){
		$megafactory_options = $this->megafactory_options;
		$mh_array = array( 'Left' => 'pull-left', 'Center' => 'pull-center', 'Right' => 'pull-right' );
		$mobile_sticky = '';

		if( $this->megafactoryThemeOpt('mobile-header-sticky') ){
			if( $this->megafactoryThemeOpt('mobile-header-sticky-scrollup') )
				$mobile_sticky = 'sticky-scroll';
			else
				$mobile_sticky = 'sticky-head';
		}

		$mh_from = $this->megafactoryThemeOpt('mobile-header-from');
		$mh_class = '';

		if( $mh_from == 'mobile' ){
			$mh_class = 'hidden-md-up';
		}elseif( $mh_from == 'tab-port' ){
			$mh_class = 'hidden-lg-up';
		}else{
			$mh_class = 'hidden-lg-up hidden-lg-land-up';
		}

		?>
		<div class="mobile-header">
			<div class="mobile-header-inner <?php echo esc_attr( $mh_class ); ?>">
				<?php echo ( $mobile_sticky != '' ? '<div class="sticky-outer"><div class="'. esc_attr( $mobile_sticky ) .'">' : '' ); ?>
						<div class="container">
		<?php
		foreach( $mh_array as $item => $class ){

			$mobile_header_elements = $megafactory_options['mobile-header-items'][$item];
			if( is_array( $mobile_header_elements ) && array_key_exists( "placebo", $mobile_header_elements ) ) unset( $mobile_header_elements['placebo'] );
			if ($mobile_header_elements):
			?>
				<ul class="mobile-header-items nav <?php echo esc_attr( $class ); ?>">
			<?php foreach ($mobile_header_elements as $element => $value ) {?>
					<li class="nav-item">
						<div class="nav-item-inner">
					<?php $this->megafactoryMobileHeaderElements($element); ?>
						</div>
					</li>
			<?php }	?>
				</ul>
			<?php
			endif;

		}
		?>
						</div><!-- container -->
				<?php echo ( $mobile_sticky != '' ? '</div></div>' : '' ); ?>
			</div>
		</div>
		<?php
	}

	function megafactoryHeaderBar(){
		$megafactory_options = $this->megafactory_options;

		$hide_from = $this->megafactoryThemeOpt('mobile-header-from');
		$hide_class = '';

		if( $hide_from == 'mobile' ){
			$hide_class = ' hidden-sm-down';
		}elseif( $hide_from == 'tab-port' ){
			$hide_class = ' hidden-md-down';
		}else{
			$hide_class =  ' hidden-md-down hidden-md-land-down';
		}

		$header_type = $header_items = '';

		if( megafactory_po_exists() ){
			$header_type = $this->megafactoryCheckMetaValue( 'megafactory_page_header_type', 'header-type' );
			$header_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_header_items_opt', true );
			if( $header_items_opt == 'custom' ){
				$header_items = get_post_meta( get_the_ID(), 'megafactory_page_header_items', true );
				$header_items = json_decode( stripslashes( $header_items ), true );
			}else{
				$header_items = $this->megafactoryThemeOpt( 'header-items' );
			}
		}elseif( is_single() ){
			$header_type = $this->megafactoryCheckMetaValue( 'megafactory_post_header_type', 'header-type' );
			$header_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_header_items_opt', true );
			if( $header_items_opt == 'custom' ){
				$header_items = get_post_meta( get_the_ID(), 'megafactory_post_header_items', true );
				$header_items = json_decode( stripslashes( $header_items ), true );
			}else{
				$header_items = $this->megafactoryThemeOpt( 'header-items' );
			}
		}else{
			$header_type = $this->megafactoryThemeOpt( 'header-type' );
			$header_items = $this->megafactoryThemeOpt( 'header-items' );
		}

	?>
		<div class="header-inner<?php echo esc_attr( $hide_class ); ?>">
	<?php
		if( $header_type == 'default' ):
			/* Header Normal Elements */
			echo isset( $header_items['Normal'] ) ? $this->megafactoryHeaderBarElements( 'normal', $header_items['Normal'] ) : '';

			/* Header Sticky Elements */
			echo isset( $header_items['Sticky'] ) ? $this->megafactoryHeaderBarElements( 'sticky', $header_items['Sticky'] ) : '';

		else:
			$this->megafactoryStickyHeaderSpace();
		endif;
	?>
		</div>
	<?php
	}

	function megafactoryFeaturedSlider($template){
	?>
		<div class="featured-slider-wrapper">
			<?php echo get_template_part('template-parts/slider/featured'); ?>
		</div>
	<?php
	}

	function megafactoryHeaderSlider( $cur_position ){
		$slide_shortcode = $slide_opt = '';

		if( megafactory_po_exists() ){
			$slide_opt = $this->megafactoryCheckMetaValue( 'megafactory_page_header_slider_opt', 'header-slider-position' );
			$slide_shortcode = get_post_meta( get_the_ID(), 'megafactory_page_header_slider', true );
		}elseif( is_single() ){
			$slide_opt = $this->megafactoryCheckMetaValue( 'megafactory_post_header_slider_opt', 'header-slider-position' );
			$slide_shortcode = get_post_meta( get_the_ID(), 'megafactory_post_header_slider', true );
		}

		if( $slide_opt != 'none' && !empty( $slide_shortcode ) && $cur_position == $slide_opt ) :
	?>
		<div class="header-slider-wrapper">
			<?php echo do_shortcode( $slide_shortcode ); ?>
		</div>
	<?php
		endif;
	}

	function megafactoryBreadcrumbs() {

	  $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	  $delimiter = ''; // delimiter between crumbs
	  $home = esc_html__('Home', 'megafactory'); // text for the 'Home' link
	  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	  $before = '<span class="current">'; // tag before the current crumb
	  $after = '</span>'; // tag after the current crumb

	  global $post;
	  $homeLink = home_url( '/' );
	  echo '<div id="breadcrumb" class="breadcrumb">';

	  if (is_home() || is_front_page()) {

		if ($showOnHome == 1) echo wp_kses_post( $before . $home . $after );//'<a href="' . $homeLink . '">' . $home . '</a>';

	  } else {

		echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

		if ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

			$post_type = get_post_type_object(get_post_type());
			if( $post_type ){
				echo wp_kses_post( $before . $post_type->labels->singular_name . $after );
        switch ($post_type->labels->singular_name) {
          case 'Services':
            // Servicios
            echo wp_kses_post( $before . 'Servicios' . $after );
            break;
          default:
            // global
            echo wp_kses_post( $before . $post_type->labels->singular_name . $after );
            break;
        }
			}else{
				$queried_object = get_queried_object();
				if( $queried_object )
				echo wp_kses_post( $before . $queried_object->name . $after );
			}


		} elseif ( is_category() ) {
		  $thisCat = get_category(get_query_var('cat'), false);
		  if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
		  echo wp_kses_post( $before . single_cat_title('', false) . $after );

		} elseif ( is_search() ) {
		  echo wp_kses_post( $before . get_search_query() . $after );

		} elseif ( is_day() ) {
		  echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		  echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
		  echo wp_kses_post( $before . get_the_time('d') . $after );

		} elseif ( is_month() ) {
		  echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
		  echo wp_kses_post( $before . get_the_time('F') . $after );

		} elseif ( is_year() ) {
		  echo wp_kses_post( $before . get_the_time('Y') . $after );

		} elseif ( is_single() && !is_attachment() ) {
		  if ( get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
			echo '<a href="' . $homeLink . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
			if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		  } else {
			$cat = get_the_category(); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
			echo wp_kses_post( $cats );
			if ($showCurrent == 1) echo wp_kses_post( $before . get_the_title() . $after );
		  }

		} elseif ( is_attachment() ) {
		  $parent = get_post($post->post_parent);
		  $cat = get_the_category($parent->ID); $cat = $cat[0];
		  echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		  echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
		  if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
		  if ($showCurrent == 1) echo wp_kses_post( $before . get_the_title() . $after );

		} elseif ( is_page() && $post->post_parent ) {
		  $parent_id  = $post->post_parent;
		  $breadcrumbs = array();
		  while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id  = $page->post_parent;
		  }
		  $breadcrumbs = array_reverse($breadcrumbs);
		  for ($i = 0; $i < count($breadcrumbs); $i++) {
			echo wp_kses_post( $breadcrumbs[$i] );
			if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
		  }
		  if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
		  echo wp_kses_post( $before . single_tag_title('', false) . $after );

		} elseif ( is_author() ) {
		   global $author;
		  $userdata = get_userdata($author);
		  echo wp_kses_post( $before . esc_html__('Posts by ', 'megafactory') . $userdata->display_name . $after );

		} elseif ( is_404() ) {
		  echo wp_kses_post( $before . esc_html__('Error 404', 'megafactory') . $after );
		}

		if ( get_query_var('paged') ) {
		  if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
		  echo esc_html__('Page', 'megafactory') . ' ' . get_query_var('paged');
		  if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
	  }
	  echo '</div>';
	}

	function megafactoryAuthorPageTitleOut(){
	?>
		<div class="author-info-wrapper">
			<?php get_template_part('template-parts/author/biography'); ?>
		</div>
	<?php
	}

	function megafactoryPageTitleForm($template, $custom_title = ''){

		$page_title = $page_title_desc = $page_tit_opt = '';

		$current_title = $custom_title ? $custom_title : esc_html( get_the_title() );

		if( $template == 'single-post' || $template == 'page' ):

			if( megafactory_po_exists() ){

				$page_tit_opt = get_post_meta( get_the_ID(), 'megafactory_page_header_page_title_opt', true );
				if( $page_tit_opt == '1' ){
					$page_title = esc_html( get_post_meta( get_the_ID(), 'megafactory_page_header_page_title_text', true ) );
					$page_title_desc = esc_html( get_post_meta( get_the_ID(), 'megafactory_page_header_page_title_desc', true ) );
					if( empty( $page_title ) ){
						$page_title = $current_title;
					}
				}else{
					$page_title = $current_title;
				}

			}elseif( is_single() ){

				$page_tit_opt = get_post_meta( get_the_ID(), 'megafactory_post_header_post_title_opt', true );
				if( $page_tit_opt == '1' ){
					$page_title = esc_html( get_post_meta( get_the_ID(), 'megafactory_post_header_post_title_text', true ) );
					$page_title_desc = esc_html( get_post_meta( get_the_ID(), 'megafactory_post_header_post_title_desc', true ) );
					if( empty( $page_title ) ){
						$page_title = $current_title;
					}
				}else{
					$page_title = $current_title;
				}

			}else{
				$page_title = $current_title;
			}

		elseif( $template == 'blog' ):
			$page_title = $this->megafactoryThemeOpt('blog-page-title');
			$page_title_desc = $this->megafactoryThemeOpt('blog-page-desc');
		elseif( $template == 'category' ):
			$page_title = single_cat_title( '', false );
			$page_title_desc = category_description();
		elseif( $template == 'tag' ):
			$page_title = single_tag_title( '', false );
			$page_title_desc = tag_description();
		elseif( $template == 'search' ):
			$page_title = esc_html__( 'Search Result for: ', 'megafactory' ) . sprintf( '%s', esc_attr( get_search_query() ) );
		else:
			$page_title = get_the_archive_title();
			$page_title_desc = get_the_archive_description();
		endif;

		return array( 'title' => $page_title, 'description' => $page_title_desc );

	}

	function megafactoryPageTitle( $template = 'archive', $custom_title = '' ){
		$megafactory_options = $this->megafactory_options;

		$parallax = '';
		if( megafactory_po_exists() ){
			$parallax = $this->megafactoryCheckMetaValue( 'megafactory_page_header_page_title_parallax', $template.'-page-title-parallax' );
		}elseif( is_single() ){
			$parallax = $this->megafactoryCheckMetaValue( 'megafactory_post_header_post_title_parallax', $template.'-page-title-parallax' );
		}else{
			$parallax = $this->megafactoryThemeOpt($template.'-page-title-parallax');
		}

		$page_tit_opt = '';
		if( megafactory_po_exists() ){
			$page_tit_opt = $this->megafactoryCheckMetaValue( 'megafactory_page_header_page_title_opt', $template.'-page-title-opt' );
		}elseif( is_single() ){
			$page_tit_opt = $this->megafactoryCheckMetaValue( 'megafactory_post_header_post_title_opt', $template.'-page-title-opt' );
		}else{
			$page_tit_opt = $this->megafactoryThemeOpt($template.'-page-title-opt');
		}

		if( $page_tit_opt == 1 ) :
			$id = 'page-title';
			$property = 'no-video';

			if( megafactory_po_exists() ){
				$video_opt = get_post_meta( get_the_ID(), 'megafactory_page_header_page_title_video_opt', true );
				if( $video_opt == '0' ){
					$video_id = '';
				}elseif( $video_opt == '1' ){
					$video_id = get_post_meta( get_the_ID(), 'megafactory_page_header_page_title_video', true );
				}else{
					$video_opt = $this->megafactoryThemeOpt( $template.'-page-title-bg' );
					$video_id = $this->megafactoryThemeOpt( $template.'-page-title-video' );
				}
			}elseif( is_single() ){
				$video_opt = get_post_meta( get_the_ID(), 'megafactory_post_header_post_title_video_opt', true );
				if( $video_opt == '0' ){
					$video_id = '';
				}elseif( $video_opt == '1' ){
					$video_id = get_post_meta( get_the_ID(), 'megafactory_post_header_post_title_video', true );
				}else{
					$video_opt = $this->megafactoryThemeOpt( $template.'-page-title-bg' );
					$video_id = $this->megafactoryThemeOpt( $template.'-page-title-video' );
				}
			}else{
				$video_opt = $this->megafactoryThemeOpt( $template.'-page-title-bg' );
				$video_id = $this->megafactoryThemeOpt( $template.'-page-title-video' );
			}
			if(  $video_opt && $video_id ){
				$id = 'page-title-bg';
				$property = "{videoURL:'http://youtu.be/". esc_attr( $video_id ) ."',containment:'self',autoPlay:true, mute:true, startAt:0, opacity:1, loop:1, showControls:0}";
			}
	?>
		<header id="<?php echo esc_attr( $id ); ?>" class="page-title-wrap">
			<div class="page-title-wrap-inner<?php echo ( $parallax == 1 ? ' parallax-item' : '' ); ?>"<?php echo ( $parallax == 1 ? ' data-stellar-background-ratio="0.5"' : '' ); ?> data-property="<?php echo ( $property ); ?>">
				<?php
				if( megafactory_po_exists() ){
					$page_tit_opt = get_post_meta( get_the_ID(), 'megafactory_page_page_title_skin_opt', true );
					if( $page_tit_opt == 'custom' ){
						$page_tit_overlay = get_post_meta( get_the_ID(), 'megafactory_page_page_title_overlay', true );
						if( $page_tit_overlay ){
							echo '<span class="page-title-overlay"></span>';
						}
					}else{
						if( $this->megafactoryThemeOpt( $template.'-page-title-overlay' ) ){
							echo '<span class="page-title-overlay"></span>';
						}
					}
				}elseif( is_single() ){
					$page_tit_opt = get_post_meta( get_the_ID(), 'megafactory_post_post_title_skin_opt', true );
					if( $page_tit_opt == 'custom' ){
						$page_tit_overlay = get_post_meta( get_the_ID(), 'megafactory_post_post_title_overlay', true );
						if( $page_tit_overlay ){
							echo '<span class="page-title-overlay"></span>';
						}
					}else{
						if( $this->megafactoryThemeOpt( $template.'-page-title-overlay' ) ){
							echo '<span class="page-title-overlay"></span>';
						}
					}
				}else{
					if( $this->megafactoryThemeOpt( $template.'-page-title-overlay' ) ){
						echo '<span class="page-title-overlay"></span>';
					}
				}
				?>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="page-title-inner">
							<?php

								$pt_out = $this->megafactoryPageTitleForm($template, $custom_title);
								$pt_array = array( 'Left' => 'pull-left', 'Center' => 'pull-center', 'Right' => 'pull-right' );
								foreach( $pt_array as $item => $class ){
									if( megafactory_po_exists() ){
										$page_tit_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_page_title_items_opt', true );
										if( $page_tit_items_opt == 'custom' ){
											$page_tit_items = get_post_meta( get_the_ID(), 'megafactory_page_page_title_items', true );
											$pt_elements = json_decode( stripslashes( $page_tit_items ), true );
											$pt_elements = isset( $pt_elements[$item] ) ? $pt_elements[$item] : array();
										}else{
											$pt_elements = isset( $megafactory_options['template-'. $template .'-pagetitle-items'][$item] ) ? $megafactory_options['template-'. $template .'-pagetitle-items'][$item] : array();
										}
									}elseif( is_single() ){
										$page_tit_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_post_title_items_opt', true );
										if( $page_tit_items_opt == 'custom' ){
											$page_tit_items = get_post_meta( get_the_ID(), 'megafactory_post_post_title_items', true );
											$pt_elements = json_decode( stripslashes( $page_tit_items ), true );
											$pt_elements = isset( $pt_elements[$item] ) ? $pt_elements[$item] : array();
										}else{
											$pt_elements = isset( $megafactory_options['template-'. $template .'-pagetitle-items'][$item] ) ? $megafactory_options['template-'. $template .'-pagetitle-items'][$item] : array();
										}
									}else{
										$pt_elements = isset( $megafactory_options['template-'. $template .'-pagetitle-items'][$item] ) ? $megafactory_options['template-'. $template .'-pagetitle-items'][$item] : array();
									}
									if( array_key_exists( "placebo", $pt_elements ) ) unset( $pt_elements['placebo'] );
									if( $pt_elements ):
								?>
									<div class="<?php echo esc_attr( $class ); ?>">
								<?php
									foreach ( $pt_elements as $element => $value ) {
										switch($element) {

											case 'title':
											?>
												<h1 class="page-title"><?php echo do_shortcode( $pt_out[$element] ); ?></h1>
											<?php
											break;

											case 'description':
											?>
												<p class="page-title-desc"><?php echo do_shortcode( $pt_out[$element] ); ?></p>
											<?php
											break;

											case 'breadcrumb':
												$this->megafactoryBreadcrumbs();
											break;

											case 'author-info':
												$this->megafactoryAuthorPageTitleOut();
											break;

										}

									} // inner foreach
								?>
									</div>
								<?php
									endif;
								} //main foreach
							?>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- .page-title-wrap-inner -->
		</header>
	<?php
		endif;
	}

}

class MegafactoryPostSettings extends MegafactoryThemeOpt {

	private $megafactory_options;
	private static $c_template; // current template i.e blog, archive..
	private static $c_sidebars_layout; // get sidebar layout
	private $c_layout;	// current layout i.e standard, grid or list
	private $thumb_guess;
	public static $unique_key = 1; // Unique Key generate random
	public static $top_standard; // Top standard post status

	function __construct() {
		$this->megafactory_options = parent::$megafactory_option;
    }

	function megafactoryGetThemeOpt( $field ){
		return $this->megafactoryThemeOpt( $field );
	}

	function megafactorySetPostTemplate( $template ){
		self::$c_template = $template;
	}

	function megafactorySetPageLayout( $template ){
		self::$c_sidebars_layout = $template;
	}

	function megafactoryGetPageLayout(){
		return self::$c_sidebars_layout;
	}

	function megafactoryGetThumbSize(){

		$main_layout = self::$c_template;
		$layout = $this->megafactoryGetPageLayout();
		$post_layout = $this->c_layout;
		$top_standard = self::$top_standard;

		if( is_single() ){

			$this->thumb_guess = 'large';

		}elseif( $post_layout == 'standard' || $top_standard == true ){

			if( $layout == 'right-sidebar' || $layout == 'left-sidebar' ){
				$this->thumb_guess = 'large';
			}elseif( $layout == 'both-sidebar' ){
				$this->thumb_guess = 'medium';
			}else{
				$this->thumb_guess = 'large';
			}

		}elseif( $post_layout == 'grid' ){

			$cols = $this->megafactoryThemeOpt( $main_layout . '-grid-cols' );

			if( $layout == 'no-sidebar' ){
				if( $cols == 2 ){
					$this->thumb_guess = 'medium';
				}elseif( $cols == 3 ){
					$this->thumb_guess = 'megafactory-grid-large';
				}else{
					$this->thumb_guess = 'megafactory-grid-medium';
				}
			}else{
				if( $cols == 2 ){
					$this->thumb_guess = 'megafactory-grid-medium';
				}else{
					$this->thumb_guess = 'megafactory-grid-small';
				}
			}

		}elseif( $post_layout == 'list' ){

			if( $layout == 'no-sidebar' ){
				$this->thumb_guess = 'medium';
			}else{
				$this->thumb_guess = 'megafactory-grid-medium';
			}

		}else{

			$this->thumb_guess = 'large';

		}

	}

	function megafactoryCheckTemplateExists( $field ){
		$theme_templates = $this->megafactoryThemeOpt( 'theme-templates' );
		if( !empty( $theme_templates ) && in_array( $field, $theme_templates ) )
			return 1;
		else
			return 0;
	}

	function megafactoryCheckCategoryTemplateExists( $field ){
		$theme_templates = $this->megafactoryThemeOpt( 'theme-categories' );
		if( !empty( $theme_templates ) && in_array( $field, $theme_templates ) )
			return 1;
		else
			return 0;
	}

	public function megafactoryUniqueKey() {
        return self::$unique_key++;
    }

	function megafactoryGetCurrentLayout(){
		$layout = $this->megafactoryThemeOpt( self::$c_template.'-post-template' );
		$this->c_layout = $layout;
		$layout .= '-layout';
		$this->megafactoryGetThumbSize();
		return $layout;
	}

	function megafactoryGetExcerptLength() {
		 $template = self::$c_template;
	}

	function megafactorySetExcerptLength( $length ) {
		$megafactory_options = $this->megafactory_options;
		$excerpt_length = $this->megafactoryThemeOpt( self::$c_template.'-excerpt' );
		return $excerpt_length;
	}

	function megafactoryTemplateContentClass( $post_id = '' ){
		$megafactory_options = $this->megafactory_options;
		$template = self::$c_template;

		$hide_sidebar_opt = '';
		if( megafactory_po_exists() ){
			$hide_sidebar_opt = $this->megafactoryCheckMetaValue( 'megafactory_page_sidebar_mobile', $template.'-page-hide-sidebar' );
		}elseif( is_single() ){
			$hide_sidebar_opt = $this->megafactoryCheckMetaValue( 'megafactory_post_sidebar_mobile', $template.'-page-hide-sidebar' );
		}else{
			$hide_sidebar_opt = $this->megafactoryThemeOpt( $template.'-page-hide-sidebar' );
		}

		$sidebar_class = '';
		$sticky_class = $this->megafactoryThemeOpt( $template.'-sidebar-sticky' ) ? ' megafactory-sticky-obj' : '';
		$sidebar_class .= $hide_sidebar_opt == 0 ? ' hidden-sm-down' : '';

		$template_cls = array( 'content_class' => '', 'rsidebar_class' => '', 'lsidebar_class' => '', 'right_sidebar' => '', 'left_sidebar' => '', 'sticky_class' => $sticky_class );

		$page_template = '';

		$post_id = $post_id ? $post_id : get_the_ID();

		if( megafactory_po_exists( $post_id ) ){
			$page_template_opt = get_post_meta( $post_id, 'megafactory_page_template_opt', true );
			if( $page_template_opt == '' || $page_template_opt == 'theme-default' ){
				$page_template = $this->megafactoryThemeOpt( $template.'-page-template' );
			}else{
				$page_template = get_post_meta( $post_id, 'megafactory_page_template', true );
			}
		}elseif( is_single() ){
			$page_template_opt = get_post_meta( $post_id, 'megafactory_post_template_opt', true );
			if( $page_template_opt == '' || $page_template_opt == 'theme-default' ){
				$page_template = $this->megafactoryThemeOpt( $template.'-page-template' );
			}else{
				$page_template = get_post_meta( $post_id, 'megafactory_post_template', true );
			}
		}else{
			$page_template = $this->megafactoryThemeOpt( $template.'-page-template' );
		}

		if( $page_template == 'right-sidebar' ){
			$this->megafactorySetPageLayout( 'right-sidebar' );
			$template_cls['content_class'] = 'col-md-8';
			$template_cls['rsidebar_class'] = 'col-md-4'.$sidebar_class;
			if( megafactory_po_exists() ){
				$template_cls['right_sidebar'] = $page_template_opt != '' && $page_template_opt != 'theme-default' ?
					get_post_meta( $post_id, 'megafactory_page_right_sidebar', true ) :
					$this->megafactoryThemeOpt( $template.'-right-sidebar' );
			}elseif( is_single() ){
				$template_cls['right_sidebar'] = $page_template_opt != '' && $page_template_opt != 'theme-default' ?
					get_post_meta( $post_id, 'megafactory_post_right_sidebar', true ) :
					$this->megafactoryThemeOpt( $template.'-right-sidebar' );
			}else{
				$template_cls['right_sidebar'] = $this->megafactoryThemeOpt( $template.'-right-sidebar' );
			}
		}elseif( $page_template == 'left-sidebar' ){
			$this->megafactorySetPageLayout( 'left-sidebar' );
			$template_cls['content_class'] = 'col-md-8 push-md-4';
			$template_cls['lsidebar_class'] = 'col-md-4 pull-md-8'.$sidebar_class;
			if( megafactory_po_exists() ){
				$template_cls['left_sidebar'] = $page_template_opt != '' && $page_template_opt != 'theme-default' ?
					get_post_meta( $post_id, 'megafactory_page_left_sidebar', true ) :
					$this->megafactoryThemeOpt( $template.'-left-sidebar' );
			}elseif( is_single() ){
				$template_cls['left_sidebar'] = $page_template_opt != '' && $page_template_opt != 'theme-default' ?
					get_post_meta( $post_id, 'megafactory_post_left_sidebar', true ) :
					$this->megafactoryThemeOpt( $template.'-left-sidebar' );
			}else{
				$template_cls['left_sidebar'] = $this->megafactoryThemeOpt( $template.'-left-sidebar' );
			}
		}elseif( $page_template == 'both-sidebar' ){
			$this->megafactorySetPageLayout( 'both-sidebar' );
			$template_cls['content_class'] = 'col-md-6 push-md-3';
			$template_cls['rsidebar_class'] = 'col-md-3'.$sidebar_class;
			$template_cls['lsidebar_class'] = 'col-md-3 pull-md-6'.$sidebar_class;

			if( megafactory_po_exists() ){
				$template_cls['right_sidebar'] = $page_template_opt != '' && $page_template_opt != 'theme-default' ?
					get_post_meta( $post_id, 'megafactory_page_right_sidebar', true ) :
					$this->megafactoryThemeOpt( $template.'-right-sidebar' );
				$template_cls['left_sidebar'] = $page_template_opt != '' && $page_template_opt != 'theme-default' ?
					get_post_meta( $post_id, 'megafactory_page_left_sidebar', true ) :
					$this->megafactoryThemeOpt( $template.'-left-sidebar' );
			}elseif( is_single() ){
				$template_cls['right_sidebar'] = $page_template_opt != '' && $page_template_opt != 'theme-default' ?
					get_post_meta( $post_id, 'megafactory_post_right_sidebar', true ) :
					$this->megafactoryThemeOpt( $template.'-right-sidebar' );
				$template_cls['left_sidebar'] = $page_template_opt != '' && $page_template_opt != 'theme-default' ?
					get_post_meta( $post_id, 'megafactory_post_left_sidebar', true ) :
					$this->megafactoryThemeOpt( $template.'-left-sidebar' );
			}else{
				$template_cls['right_sidebar'] = $this->megafactoryThemeOpt($template.'-right-sidebar');
				$template_cls['left_sidebar'] =  $this->megafactoryThemeOpt($template.'-left-sidebar');
			}
		}else{
			$this->megafactorySetPageLayout( 'no-sidebar' );
			$template_cls['content_class'] = 'col-md-12';
		}

		return $template_cls;
	}

	function megafactoryArticleStyle(){
		$template = self::$c_template;
		$article_style = $this->megafactoryThemeOpt( $template.'-article-style' );
		$class = $article_style != 'default' ? 'article-style-' . $article_style : '';
		return $class;
	}

	function megafactoryPostTitle($layout){
		if ( is_single() ) {
			return '<h1 class="entry-title">'. esc_html( get_the_title() ) .'</h1>';
		}else{
			if( $layout == 'grid' || $layout == 'list' )
				return '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'. esc_html( get_the_title() ) .'</a></h3>';
			else
				return '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">'. esc_html( get_the_title() ) .'</a></h2>';
		}
	}

	function megafactorySetPostViewCount( $postID ){
		$count_key = 'megafactory_post_views_count';
		$count = get_post_meta( $postID, $count_key, true );
		if($count==''){
			$count = 0;
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );
		}else{
			$count++;
			update_post_meta( $postID, $count_key, $count );
		}
	}

	function megafactoryLikeIPVerify( $postID ){
		// Retrieve post votes IPs
		$meta_IP = get_post_meta( $postID, 'megafactory_liked_IP', true );

		if( isset( $meta_IP ) && is_array( $meta_IP ) ){
			// Retrieve current user IP
			$ip = $_SERVER['REMOTE_ADDR'];

			// If user has already voted
			if( array_key_exists($ip, $meta_IP) ){
				return true;
			}else{
				return false;
			}
		}

		return false;
	}

	function megafactoryMetaLikes($postID){
		$output = '';
		$meta_IP = get_post_meta( $postID, 'megafactory_liked_IP', true );

		$ip = $_SERVER['REMOTE_ADDR'];

		$meta_count = get_post_meta( $postID, 'megafactory_post_like_count', true );
		$meta_count = $meta_count != '' ? $meta_count : '0';
		$meta_dcount = get_post_meta( $postID, 'megafactory_post_dislike_count', true );
		$meta_dcount = $meta_dcount != '' ? $meta_dcount : '0';
		$output .= '<ul class="nav post-like-wrap">';
		if( $this->megafactoryLikeIPVerify( $postID ) ){
			if( isset( $meta_IP[$ip] ) && $meta_IP[$ip] == 'like' ){
				$output .= '<li class="nav-item">
								<a href="#" class="fa fa-thumbs-up post-liked theme-color" data-toggle="tooltip" title="'. esc_attr( $meta_count ) .'" data-stat="1" data-id="'. esc_attr( $postID ) .'"></a>
							</li>
							<li>
								<a href="#" class="icon-dislike post-dislike" data-toggle="tooltip" title="'. esc_attr( $meta_dcount ) .'" data-stat="2" data-id="'. esc_attr( $postID ) .'"></a>
							</li>';
			}else{
				$output .= '<li class="nav-item">
								<a href="#" class="icon-like post-like" data-toggle="tooltip" title="'. esc_attr( $meta_count ) .'" data-stat="1" data-id="'. esc_attr( $postID ) .'"></a>
							</li>
							<li>
								<a href="#" class="fa fa-thumbs-down post-disliked theme-color" data-toggle="tooltip" title="'. esc_attr( $meta_dcount ) .'" data-stat="2" data-id="'. esc_attr( $postID ) .'"></a>
							</li>';
			}
		}else{
			$output .= '<li class="nav-item">
							<a href="#" class="icon-like post-like" data-toggle="tooltip" title="'. esc_attr( $meta_count ) .'" data-stat="1" data-id="'. esc_attr( $postID ) .'"></a>
						</li>
						<li>
							<a href="#" class="icon-dislike post-dislike" data-toggle="tooltip" title="'. esc_attr( $meta_dcount ) .'" data-stat="2" data-id="'. esc_attr( $postID ) .'"></a>
						</li>';
		}
		$output .= '</ul>';
		return $output;
	}

	function megafactoryMetaLikeCheck()
	{
		// Check for nonce security
		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'megafactory-post-like' ) )
			die ( esc_html__( 'Busted', 'megafactory' ) );
		$postID = isset( $_POST['post_id'] ) ? esc_attr( $_POST['post_id'] ) : '';

		if( isset( $_POST['like_stat'] ) && $postID != '' )
		{
			// Retrieve user IP address
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_stat = isset( $_POST['like_stat'] ) ? esc_attr( $_POST['like_stat'] ) : '1';

			// Get voters'IPs for the current post
			$meta_IP = get_post_meta( $postID, 'megafactory_liked_IP', true );

			// Get votes count for the current post
			$meta_key = '';
			$meta_count = 0;
			if( $post_stat == '1' ){
				$meta_key = 'megafactory_post_like_count';
				$meta_count = get_post_meta( $postID, $meta_key, true );
			}else{
				$meta_key = 'megafactory_post_dislike_count';
				$meta_count = get_post_meta( $postID, $meta_key, true );
			}

			// Use has already voted ?
			if( ! $this->megafactoryLikeIPVerify( $postID ) )
			{
				if( isset( $meta_IP ) && is_array( $meta_IP ) ){
					if( $post_stat == '1' ){
						$meta_IP[$ip] = 'like';
					}else{
						$meta_IP[$ip] = 'dislike';
					}
				}else{
					if( $post_stat == '1' ){
						$meta_IP = array( $ip => 'like' );
					}else{
						$meta_IP = array( $ip => 'dislike' );
					}
				}

				$meta_count = $meta_count != '' ? $meta_count : 0;
				// Save IP and increase votes count
				update_post_meta( $postID, "megafactory_liked_IP", $meta_IP );
				update_post_meta( $postID, $meta_key, ++$meta_count );

				// Display count (ie jQuery return value)
				echo ( $this->megafactoryMetaLikes( $postID ) );

			}else{

				$like_count = get_post_meta( $postID, 'megafactory_post_like_count', true );
				$dislike_count = get_post_meta( $postID, 'megafactory_post_dislike_count', true );

				if( $post_stat == '1' ){
					if( $meta_IP[$ip] == 'dislike' ){
						//going to like
						$meta_IP[$ip] = 'like';
						update_post_meta( $postID, "megafactory_liked_IP", $meta_IP );
						update_post_meta( $postID, 'megafactory_post_dislike_count', --$dislike_count );
						update_post_meta( $postID, 'megafactory_post_like_count', ++$like_count );
						echo ( $this->megafactoryMetaLikes( $postID ) );
					}else{
						echo "already liked";
					}
				}else{
					if( $meta_IP[$ip] == 'like' ){
						//going to dislike
						$meta_IP[$ip] = 'dislike';
						update_post_meta( $postID, "megafactory_liked_IP", $meta_IP );
						update_post_meta( $postID, 'megafactory_post_like_count', --$like_count );
						update_post_meta( $postID, 'megafactory_post_dislike_count', ++$dislike_count );
						echo ( $this->megafactoryMetaLikes( $postID ) );
					}else{
						echo "already disliked";
					}
				}

			}
		}
		exit;
	}

	function megafactoryFavouriteIPVerify( $postID ){
		// Retrieve post votes IPs
		$meta_IP = get_post_meta( $postID, 'megafactory_favourite_IP', true );

		if( isset( $meta_IP ) && is_array( $meta_IP ) ){
			// Retrieve current user IP
			$ip = $_SERVER['REMOTE_ADDR'];

			// If user has already voted
			if( in_array($ip, $meta_IP) ){
				return true;
			}else{
				return false;
			}
		}

		return false;
	}

	function megafactoryMetaFavourite($postID){
		$output = '';
		$meta_IP = get_post_meta( $postID, 'megafactory_favourite_IP', true );

		$ip = $_SERVER['REMOTE_ADDR'];

		$meta_count = get_post_meta( $postID, 'megafactory_post_fav_count', true );
		$meta_count = $meta_count != '' ? $meta_count : '0';

		$output .= '<ul class="nav post-fav-wrap">';
		if( $this->megafactoryFavouriteIPVerify( $postID ) ){
			$output .= '<li class="nav-item">
							<a href="#" class="icon icon-heart post-fav-done theme-color" data-toggle="tooltip" title="'. esc_attr( $meta_count ) .'"></a>
						</li>';
		}else{
			$output .= '<li class="nav-item">
								<a href="#" class="icon icon-heart post-favourite theme-color" data-toggle="tooltip" title="'. esc_attr( $meta_count ) .'" data-id="'. esc_attr( $postID ) .'"></a>
							</li>';
		}
		$output .= '</ul>';
		return $output;
	}

	function megafactoryMetaFavouriteCheck()
	{
		// Check for nonce security
		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'megafactory-post-fav' ) )
			die ( esc_html__( 'Busted', 'megafactory' ) );

		$postID = isset( $_POST['post_id'] ) ? esc_attr( $_POST['post_id'] ) : '';

		if( $postID != '' )
		{
			// Retrieve user IP address
			$ip = $_SERVER['REMOTE_ADDR'];

			// Get voters'IPs for the current post
			$meta_IP = get_post_meta( $postID, 'megafactory_favourite_IP', true );

			// Get votes count for the current post
			$meta_key = '';
			$meta_count = 0;
			$meta_key = 'megafactory_post_fav_count';
			$meta_count = get_post_meta( $postID, $meta_key, true );

			// Use has already voted ?
			if( ! $this->megafactoryFavouriteIPVerify( $postID ) )
			{
				$meta_IP = array($ip);
				$meta_count = $meta_count != '' ? $meta_count : 0;
				// Save IP and increase votes count
				update_post_meta( $postID, "megafactory_favourite_IP", $meta_IP );
				update_post_meta( $postID, $meta_key, ++$meta_count );

			}else{
				array_push($meta_IP, $ip);
				update_post_meta( $postID, "megafactory_favourite_IP", $meta_IP );
				update_post_meta( $postID, $meta_key, ++$meta_count );
			}
			echo ( $this->megafactoryMetaFavourite( $postID ) );
		}
		exit;
	}

	function megafactoryMetaDate(){
		$archive_year  = get_the_time('Y');
		$archive_month = get_the_time('m');
		$archive_day   = get_the_time('d');
		return '<div class="post-date"><span class="before-icon icon icon-calendar"></span><a href="'.get_day_link( $archive_year, $archive_month, $archive_day).'" >'. get_the_time( get_option('date_format') ) .'</a></div>';
	}

	function megafactoryMetaComment(){
		$comments_count = wp_count_comments(get_the_ID());
		return '<div class="post-comment"><a href="'.get_comments_link( get_the_ID() ).'" rel="bookmark" class="comments-count">'.$comments_count->total_comments.'</a></div>';
	}

	function megafactoryMetaAuthor(){
		return '<div class="post-author"><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) .'"><span class="author-img">'. get_avatar( get_the_author_meta('email'), '30' ) .'</span><span class="author-name">'. get_the_author() .'</span></a></div>';
	}

	function megafactoryMetaMore($read_more_text){
		return '<div class="post-more"><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'. esc_html( $read_more_text ) .'</a></div>';
	}

	function megafactoryMetaViews(){
		if( get_post_meta( get_the_ID(), 'megafactory_post_views_count', true ) )
			return '<div class="post-views"><span class="before-icon icon icon-eye"></span><span>'. esc_attr( get_post_meta( get_the_ID(), 'megafactory_post_views_count', true ) ) .'</span></div>';

		return '';
	}

	function megafactoryMetaCategory(){
		$categories = get_the_category();
		$output = '';
		if ( ! empty( $categories ) ){
			$output = '<div class="post-category"><span class="before-icon icon icon-folder-alt"></span>';
			foreach ( $categories as $category ) {
				$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>,';
			}
			$output = rtrim( $output, ',' );
			$output .= '</div>';
		}
		return $output;
	}

	function megafactoryMetaTags(){
		$tags = get_the_tags();
		$output = '';
		if ( ! empty( $tags ) ){
			$output = '<div class="post-tags"><span class="before-icon fa fa-tags"></span>';
			foreach ( $tags as $tag ) {
				$output .= '<a href="' . esc_url( get_category_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>,';
			}
			$output = rtrim( $output, ',' );
			$output .= '</div>';
		}
		return $output;
	}

	function megafactoryMetaSocial(){
		ob_start();
		$posts_shares = $this->megafactoryThemeOpt( 'post-social-shares' );
		$post_id = get_the_ID();
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id), 'large' );
		?>
		<div class="post-social">
			<ul class="nav social-icons">
				<?php
				if( $posts_shares ):
					foreach ( $posts_shares as $social_share ){

						switch( $social_share ){

							case "fb":
						?>
								<li><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink( $post_id ) ); ?>&t=<?php echo urlencode( get_the_title() ); ?>" target="blank" class="social-fb share-fb"><i class="fa fa-facebook"></i></a></li>

						<?php
							break; // fb
							case "twitter":
						?>

								<li><a href="http://twitter.com/home?status=Reading:<?php echo urlencode(get_the_title()); ?>-<?php echo  esc_url( home_url( '/' ) )."/?p=". esc_attr( $post_id ); ?>" class="social-twitter share-twitter" title="<?php esc_html_e( 'Click to send this page to Twitter!', 'megafactory' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>

						<?php
							break; // twitter
							case "linkedin":
						?>

								<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( the_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>&summary=&source=<?php echo urlencode( get_bloginfo('name') ); ?>" class="social-linkedin share-linkedin" target="blank"><i class="fa fa-linkedin"></i></a></li>

						<?php
							break; // linkedin
							case "gplus":
						?>

							<li><a href="https://plus.google.com/share?url=<?php urlencode( the_permalink() ); ?>" class="social-gplus share-gplus" target="blank"><i class="fa fa-google-plus"></i></a></li>

						<?php
							break; // gplus
							case "pinterest":
						?>

							<li><a href="http://pinterest.com/pin/create/button/?url=<?php urlencode( the_permalink() ); ?>&amp;media=<?php echo ( ! empty( $image[0] ) ? $image[0] : '' ); ?>&description=<?php echo urlencode(get_the_title()); ?>" class="social-pinterest share-pinterest" target="blank"><i class="fa fa-pinterest"></i></a></li>

						<?php
							break; // pinterest
						?>

				<?php
						} //switch
					} // foreach

				endif;
				?>

			</ul>
		</div>
		<?php
			$output = ob_get_clean();
			return $output;
	}

	function megafactoryPostMeta($meta_place){
		$megafactory_options = $this->megafactory_options;
		$template = self::$c_template;
		$postID = get_the_ID();

		$post_metas = array( 'Left' => 'pull-left', 'Right' => 'pull-right' );
		foreach( $post_metas as $meta => $class ){

			$meta_elements = isset( $megafactory_options[$template .'-'. $meta_place .'-items'][$meta] ) ? $megafactory_options[$template .'-'. $meta_place .'-items'][$meta] : array();
			if( array_key_exists( "placebo", $meta_elements ) ) unset( $meta_elements['placebo'] );
			if( $meta_elements ): ?>
				<div class="post-meta <?php echo esc_attr( $class ); ?>">
					<ul class="nav">
					<?php
					foreach ( $meta_elements as $element => $value ) {
						switch($element) {
							case 'date':
								echo '<li class="nav-item">';
								echo ( $this->megafactoryMetaDate() );
								echo '</li>';
							break;

							case 'category':
								echo '<li class="nav-item">';
								echo ( $this->megafactoryMetaCategory() );
								echo '</li>';
							break;

							case 'social':
								echo '<li class="nav-item">';
								echo ( $this->megafactoryMetaSocial() );
								echo '</li>';
							break;

							case 'comments':
								echo '<li class="nav-item">';
								echo ( $this->megafactoryMetaComment() );
								echo '</li>';
							break;

							case 'likes':
								echo '<li class="nav-item">';
								echo ( $this->megafactoryMetaLikes($postID) );
								echo '</li>';
							break;

							case 'author':
								echo '<li class="nav-item">';
								echo ( $this->megafactoryMetaAuthor() );
								echo '</li>';
							break;

							case 'views':
								echo '<li class="nav-item">';
								echo ( $this->megafactoryMetaViews() );
								echo '</li>';
							break;

							case 'favourite':
								echo '<li class="nav-item">';
								echo ( $this->megafactoryMetaFavourite($postID) );
								echo '</li>';
							break;

							case 'more':
								echo '<li class="nav-item">';
								$read_more_text = $this->megafactoryThemeOpt($template.'-more-text');
								echo ( $this->megafactoryMetaMore($read_more_text) );
								echo '</li>';
							break;

							case 'tag':
								$tags = $this->megafactoryMetaTags();
								if( $tags ):
								echo '<li class="nav-item">';
									echo ( $tags );
								echo '</li>';
								endif;
							break;

						}//post meta items switch
					}
				?>
					</ul>
				</div>
				<?php
			endif;
		}
	}

	function megafactoryVideoFormat( $video_atts ){

		extract( $video_atts );
		switch( $video_modal ){

			case 'onclick':
				$video_url = '';
				if( $video_type == 'youtube' ){
					$video_url = 'https://www.youtube.com/embed/';
					$video_url .= esc_attr( $video_id );
				}elseif( $video_type == 'vimeo' ){
					$video_url = 'https://player.vimeo.com/video/';
					$video_url .= esc_attr( $video_id );
				}else{
					$video_url = esc_url( $video_id );
				}

				if( $video_type != 'custom' ){ ?>
					<a class="onclick-video-post" href="<?php echo esc_url( $video_url ); ?>">
						<div class="video-play-icon text-center"><span class="fa fa-play-circle-o"></span></div>
						<?php
							if( '' !== get_the_post_thumbnail() ):
								the_post_thumbnail( $this->thumb_guess, array( 'class' => 'img-fluid' ) );
							endif;
						?>
					</a>
				<?php
				}else{
				?>
					<a class="onclick-custom-video" href="#" data-url="<?php echo esc_url( $video_url ); ?>">
						<div class="video-play-icon text-center"><span class="fa fa-play-circle-o"></span></div>
						<?php
							if( '' !== get_the_post_thumbnail() ):
								the_post_thumbnail( $this->thumb_guess, array( 'class' => 'img-fluid' ) );
							endif;
						?>
					</a>
					<?php
				}
			break;

			case 'overlay':
				$video_url = '';
				if( $video_type == 'youtube' ){
					$video_url = 'http://www.youtube.com/watch?v=';
					$video_url .= esc_attr( $video_id );
				}elseif( $video_type == 'vimeo' ){
					$video_url = 'https://vimeo.com/';
					$video_url .= esc_attr( $video_id );
				}else{
					$video_url = esc_url( $video_id );
				}

				if( $video_type != 'custom' ){ ?>
					<a class="popup-video-post" href="<?php echo esc_url( $video_url ); ?>">
						<div class="video-play-icon text-center"><span class="fa fa-play-circle-o"></span></div>
						<?php
							if( '' !== get_the_post_thumbnail() ):
								the_post_thumbnail( $this->thumb_guess, array( 'class' => 'img-fluid' ) );
							endif;
						?>
					</a>
				<?php
				}else{
					$u_key = $this->megafactoryUniqueKey();
				?>
					<a class="popup-video-post popup-with-zoom-anim popup-custom-video" href="#popup-custom-video-<?php echo esc_attr( $u_key ); ?>">
						<div class="video-play-icon text-center"><span class="fa fa-play-circle-o"></span></div>
						<?php
							if( '' !== get_the_post_thumbnail() ):
								the_post_thumbnail( $this->thumb_guess, array( 'class' => 'img-fluid' ) );
							endif;
						?>
					</a>
					<div id="popup-custom-video-<?php echo esc_attr( $u_key ); ?>" class="zoom-anim-dialog mfp-hide">
						<span data-url="<?php echo esc_url( $video_url ); ?>"></span>
					</div>
					<?php
				}
			break;

			default:
				$video_url = '';
				if( $video_type == 'youtube' ){
					$video_url = 'https://www.youtube.com/embed/';
					$video_url .= esc_attr( $video_id );
				}elseif( $video_type == 'vimeo' ){
					$video_url = 'https://player.vimeo.com/video/';
					$video_url .= esc_attr( $video_id );
				}else{
					$video_url = esc_url( $video_id );
				}

				if( $video_type != 'custom' ){
					echo do_shortcode( '[videoframe url="'. esc_url( $video_url ).'" width="100%" height="100%" params="byline=0&portrait=0&badge=0" /]' );
				}else{
					echo do_shortcode( '[video url="'. esc_url( $video_url ).'" width="100%" height="100%" /]' );
				}
			break;
		}
	}

	function megafactoryGalleryFormat(){

		$template = self::$c_template;

		$gallery_ids = get_post_meta( get_the_ID(), 'megafactory_post_gallery', true );
		if( $gallery_ids ):
			$gallery_array = explode( ",", $gallery_ids );
			$slide_id = '';

			$slide_template = 'blog';
			if( is_single() ) $slide_template = 'single';

			$gal_atts = array(
				'data-loop="'. $this->megafactoryThemeOpt( $slide_template.'-slide-infinite' ) .'"',
				'data-margin="'. $this->megafactoryThemeOpt( $slide_template.'-slide-margin' ) .'"',
				'data-center="'. $this->megafactoryThemeOpt( $slide_template.'-slide-center' ) .'"',
				'data-nav="'. $this->megafactoryThemeOpt( $slide_template.'-slide-navigation' ) .'"',
				'data-dots="'. $this->megafactoryThemeOpt( $slide_template.'-slide-pagination' ) .'"',
				'data-autoplay="'. $this->megafactoryThemeOpt( $slide_template.'-slide-autoplay' ) .'"',
				'data-items="'. $this->megafactoryThemeOpt( $slide_template.'-slide-items' ) .'"',
				'data-items-tab="'. $this->megafactoryThemeOpt( $slide_template.'-slide-tab' ) .'"',
				'data-items-mob="'. $this->megafactoryThemeOpt( $slide_template.'-slide-mobile' ) .'"',
				'data-duration="'. $this->megafactoryThemeOpt( $slide_template.'-slide-duration' ) .'"',
				'data-smartspeed="'. $this->megafactoryThemeOpt( $slide_template.'-slide-smartspeed' ) .'"',
				'data-scrollby="'. $this->megafactoryThemeOpt( $slide_template.'-slide-scrollby' ) .'"',
				'data-autoheight="'. $this->megafactoryThemeOpt( $slide_template.'-slide-autoheight' ) .'"',
			);
			$data_atts = implode( " ", $gal_atts );
			$gallery_modal = $this->megafactoryCheckMetaValue( 'megafactory_post_gallery_modal', $template.'-gallery-format' );
			if( $gallery_modal == 'default' ): // Gallery Model Default
				?>
				<div class="owl-carousel" <?php echo ( $data_atts ); ?>>
				<?php
				foreach( $gallery_array as $gal_id ): ?>
					<div class="item">
						<?php echo wp_get_attachment_image( $gal_id, $this->thumb_guess, "", array( "class" => "img-fluid" ) ); ?>
					</div>
				<?php
				endforeach;?>
				</div><!-- .owl-carousel -->
			<?php
			elseif( $gallery_modal == 'popup' ): // Gallery Model Popup
				?>
				<div class="zoom-gallery">
					<div class="owl-carousel" <?php echo ( $data_atts ); ?>>
					<?php
					foreach( $gallery_array as $gal_id ): ?>
						<div class="item">
								<?php $image_url = wp_get_attachment_url( $gal_id ); ?>
								<a href="<?php echo esc_url( $image_url ); ?>" title="<?php echo esc_html( get_the_title( $gal_id ) ); ?>">
									<?php $t = wp_get_attachment_image( $gal_id, $this->thumb_guess, "", array( "class" => "img-fluid" ) );
										if( $t ){
											echo wp_kses_post( $t );
										}else{
											echo esc_html__( 'Image Crop not exists.', 'megafactory' );
										}
									?>
								</a>
						</div>
					<?php
					endforeach;?>
					</div><!-- .owl-carousel -->
				</div><!-- .zoom-gallery -->
			<?php
			else: // Gallery Model Grid Popup
			?>
				<div class="zoom-gallery grid-zoom-gallery clearfix">
					<?php
					$chk = 1;
					foreach( $gallery_array as $gal_id ):
						if( $chk ): echo '<div class="left-gallery-grid">'; endif;
						?>
							<div class="grid-popup">
								<?php $image_url = wp_get_attachment_url( $gal_id ); ?>
								<a href="<?php echo esc_url( $image_url ); ?>" title="<?php echo esc_html( get_the_title( $gal_id ) ); ?>">
									<?php echo wp_get_attachment_image( $gal_id, $this->thumb_guess, "", array( "class" => "img-fluid" ) ); ?>
								</a>
							</div>
					<?php
						if( $chk ): echo '</div><!-- .left-gallery-grid --><div class="right-gallery-grid">';  $chk = 0; endif;
					endforeach;
					?>
					</div><!-- .right-gallery-grid -->
				</div><!-- .zoom-gallery -->
				<?php
			endif;
		endif;
	}

	function megafactoryLinkFormat(){
		$link_text = get_post_meta( get_the_ID(), 'megafactory_post_link_text', true );
		$link = get_post_meta( get_the_ID(), 'megafactory_post_extrenal_link', true );
		$thumbnail = '' !== get_the_post_thumbnail() ? get_the_post_thumbnail_url() : '';
		if( !empty( $link_text ) ):
		?>
			<div class="post-link-wrap" data-url="<?php echo esc_url( $thumbnail ); ?>">
				<div class="post-link-inner">
					<h4><a href="<?php echo esc_url( $link ); ?>" class="post-link" title="<?php echo esc_html( $link_text ); ?>"><?php echo esc_html( $link_text ); ?></a></h4>
				</div>
			</div>
		<?php
		endif;
	}

	function megafactoryQuoteFormat(){
		$quote_text = get_post_meta( get_the_ID(), 'megafactory_post_quote_text', true );
		$quote_author = get_post_meta( get_the_ID(), 'megafactory_post_quote_author', true );
		$thumbnail = '' !== get_the_post_thumbnail() ? get_the_post_thumbnail_url() : '';
		if( !empty( $quote_text ) ):
		?>
			<div class="post-quote-wrap" data-url="<?php echo esc_url( $thumbnail ); ?>">
				<blockquote class="blockquote">
					<p class="mb-0"><h4><?php echo esc_html( $quote_text ); ?></h4></p>
					<footer class="blockquote-footer"><?php echo esc_html( $quote_author ); ?></footer>
				</blockquote>
			</div>
		<?php
		endif;
	}

	function megafactoryAudioFormat(){
		$audio_type = get_post_meta( get_the_ID(), 'megafactory_post_audio_type', true );
		$audio_id = get_post_meta( get_the_ID(), 'megafactory_post_audio_id', true );
		if( !empty( $audio_type ) && !empty( $audio_id ) ): ?>
			<div class="post-audio-wrap">
				<?php if( $audio_type == 'soundcloud' ): ?>
						<?php echo do_shortcode('[soundcloud url="https://api.soundcloud.com/tracks/'. esc_attr( $audio_id ) .'" params="auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&visual=true" width="100%" height="150" /]'); ?>
				<?php else: ?>
					<audio preload="none" controls style="max-width:100%;">
						<source src="<?php echo esc_url( $audio_id ); ?>" type="audio/mp3">
					</audio>
				<?php endif; ?>
			</div>
		<?php
		endif;
	}

	function megafactoryPostFormat(){

		$template = self::$c_template;
		ob_start();

		if ( has_post_format( 'image' ) && '' !== get_the_post_thumbnail() ) :
		?>
			<div class="post-thumb-wrap">
				<?php echo the_post_thumbnail( $this->thumb_guess, array( 'class' => 'img-fluid' ) ); ?>

				<?php if( is_single() ):
					$theme_opt_overlay = $this->megafactoryThemeOpt( 'single-post-overlay-opt' );
					$post_oitems_opt = get_post_meta( get_the_ID(), 'megafactory_post_overlay_opt', true );
					if( $theme_opt_overlay == 1 || $post_oitems_opt == 1 ): ?>

					<div class="post-overlay-items"><?php
						$post_elements = array();
						$post_oitems_opt = get_post_meta( get_the_ID(), 'megafactory_post_overlay_opt', true );
						if( $post_oitems_opt == '' || $post_oitems_opt == 'theme-default' ){
							$post_elements = $this->megafactoryThemeOpt( 'single-post-overlay-items' );
							$post_elements = $post_elements['Enabled'];
							if( array_key_exists( "placebo", $post_elements ) ) unset( $post_elements['placebo'] );
						}else{
							$overlay_post_items = get_post_meta( get_the_ID(), 'megafactory_post_overlay_items', true );
							$t_post_items = explode( ',', $overlay_post_items );
							foreach ( $t_post_items as $element )
								$post_elements[$element] = $element;
						}
						$this->megafactoryPostOverlayItems( $post_elements );?>
					</div>

					<?php endif;
				endif; ?>

			</div>
		<?php

		elseif ( has_post_format( 'video' ) ) :
			$video_type = get_post_meta( get_the_ID(), 'megafactory_post_video_type', true );
			$video_id = get_post_meta( get_the_ID(), 'megafactory_post_video_id', true );
			if( !empty( $video_type ) ):

				$video_modal = '';
				if( is_single() ){
					$video_modal = $this->megafactoryCheckMetaValue( 'megafactory_post_video_modal', $template.'-video-format' );
				}else{
					$video_modal = $this->megafactoryThemeOpt($template.'-video-format');
				}

				$video_atts = array(
					'video_type'	=> $video_type,
					'video_id'		=> $video_id,
					'video_modal'	=> $video_modal
				);
			?>
				<div class="post-video-wrap">
					<?php $this->megafactoryVideoFormat( $video_atts ); ?>
				</div>
			<?php
			endif;

		elseif ( has_post_format( 'gallery' ) ) :
			$this->megafactoryGalleryFormat();

		elseif ( has_post_format( 'audio' ) ) :
			$this->megafactoryAudioFormat();

		elseif ( has_post_format( 'quote' ) ) :
			$this->megafactoryQuoteFormat();

		elseif ( has_post_format( 'link' ) ) :
			$this->megafactoryLinkFormat();
		elseif( get_the_post_thumbnail() ) :
		?>
			<div class="post-thumb-wrap">
				<?php echo the_post_thumbnail( $this->thumb_guess, array( 'class' => 'img-fluid' ) ); ?>

				<?php if( is_single() ):

					$theme_opt_overlay = $this->megafactoryThemeOpt( 'single-post-overlay-opt' );
					$post_oitems_opt = get_post_meta( get_the_ID(), 'megafactory_post_overlay_opt', true );
					if( $theme_opt_overlay == 1 || $post_oitems_opt == 1 ): ?>

					<div class="post-overlay-items"><?php
						$post_elements = array();
						$post_oitems_opt = get_post_meta( get_the_ID(), 'megafactory_post_overlay_opt', true );
						if( $post_oitems_opt == '' || $post_oitems_opt == 'theme-default' ){
							$post_elements = $this->megafactoryThemeOpt( 'single-post-overlay-items' );
							$post_elements = $post_elements['Enabled'];
							if( array_key_exists( "placebo", $post_elements ) ) unset( $post_elements['placebo'] );
						}else{
							$overlay_post_items = get_post_meta( get_the_ID(), 'megafactory_post_overlay_items', true );
							$t_post_items = explode( ',', $overlay_post_items );
							foreach ( $t_post_items as $element )
								$post_elements[$element] = $element;
						}
						$this->megafactoryPostOverlayItems( $post_elements );?>
					</div>

					<?php endif;
				endif; ?>

			</div><!-- .post-thumb-wrap -->
		<?php
		endif;


		if( !has_post_format( 'image' ) && is_single() && $this->megafactoryCheckMetaValue( 'megafactory_post_overlay_opt', 'single-post-overlay-opt' ) == 1 ): ?>
			<div class="post-overlay-items">
			<?php

				$post_elements = array();
				$post_oitems_opt = get_post_meta( get_the_ID(), 'megafactory_post_overlay_opt', true );
				if( $post_oitems_opt == '' || $post_oitems_opt == 'theme-default' ){
					$post_elements = $this->megafactoryThemeOpt( 'single-post-overlay-items' );
					$post_elements = $post_elements['Enabled'];
					if( array_key_exists( "placebo", $post_elements ) ) unset( $post_elements['placebo'] );
				}else{
					$overlay_post_items = get_post_meta( get_the_ID(), 'megafactory_post_overlay_items', true );
					$t_post_items = explode( ',', $overlay_post_items );
					foreach ( $t_post_items as $element )
						$post_elements[$element] = $element;
				}
				$this->megafactoryPostOverlayItems( $post_elements );
			?>
			</div>
		<?php endif;

		//Overlay items for non single
		if( !is_single() && $this->megafactoryThemeOpt( $template.'-overlay-opt' ) == 1 ): ?>
			<div class="post-overlay-items">
				<?php
					$post_elements = array();
					$post_elements = $this->megafactoryThemeOpt( $template.'-overlay-items' );
					$post_elements = $post_elements['Enabled'];
					if( array_key_exists( "placebo", $post_elements ) ) unset( $post_elements['placebo'] );
					$this->megafactoryPostOverlayItems( $post_elements );
				?>
			</div>
		<?php
		endif;

		return ob_get_clean();
	}

	function megafactoryPostOverlayItems( $post_elements ){

		foreach ( $post_elements as $element => $value ) {
			switch($element) {

				case 'title':
				?>
					<header class="entry-header">
						<?php echo ( $this->megafactoryPostTitle( 'standard' ) ); ?>
					</header>
				<?php
				break;

				case 'top-meta':
				?>
					<div class="entry-meta top-meta clearfix">
						<?php $this->megafactoryPostMeta( 'topmeta' ); ?>
					</div>
				<?php
				break;

				case 'bottom-meta':
				?>
					<footer class="entry-footer">
						<div class="entry-meta bottom-meta clearfix">
							<?php $this->megafactoryPostMeta( 'bottommeta' ); ?>
						</div>
					</footer>
				<?php
				break;


			} // switch
		} //foreach

	}

	function megafactoryPostItems(){
		$megafactory_options = $this->megafactory_options;

		$template = self::$c_template;

		$layout = $this->megafactoryGetCurrentLayout();
		$extra_class = $layout == 'list-layout' ? ' clearfix' : '';
		$post_elements = isset( $megafactory_options[$template .'-items']['Enabled'] ) ? $megafactory_options[$template .'-items']['Enabled'] : array();
		if( array_key_exists( "placebo", $post_elements ) ) unset( $post_elements['placebo'] );
		if( $post_elements ): ?>
			<div class="article-inner post-items<?php echo esc_attr( $extra_class ); ?>">
				<?php

					$format = get_post_format( get_the_ID() );
					if( isset( $post_elements['thumb'] ) && $layout == 'list-layout' ): ?>
						<div class="post-list-left-part">
					<?php
							$post_format = $this->megafactoryPostFormat();
							if( !empty( $post_format  ) ){
							?>
								<div class="post-format-wrap">
									<?php echo ( $post_format ); ?>
								</div>
							<?php
							}
					?>
						</div><!-- .post-list-left-part -->
						<div class="post-list-right-part">
					<?php
					elseif( $layout == 'list-layout' ):
						$list_class = empty( $format ) ? ' post-list-full' : '';
					?>
						<div class="post-list-right-part<?php echo esc_attr( $list_class ); ?>">
					<?php
					endif; // list-layout endif

				foreach ( $post_elements as $element => $value ) {
					switch($element) {

						case 'title':
							$layout = $this->megafactoryThemeOpt($template.'-post-template');
						?>
							<header class="entry-header">
								<?php echo ( $this->megafactoryPostTitle($layout) ); ?>
							</header>
						<?php
						break;

						case 'top-meta':
						?>
							<div class="entry-meta top-meta clearfix">
								<?php $this->megafactoryPostMeta('topmeta'); ?>
							</div>
						<?php
						break;

						case 'thumb':
							if( $layout != 'list-layout' && $layout != 'list' ):
								$post_format = $this->megafactoryPostFormat();
								if( !empty( $post_format  ) ){
								?>
									<div class="post-format-wrap">
										<?php echo ( $post_format ); ?>
									</div>
								<?php
								}
							endif;
						break;

						case 'content':

							if( '' !== get_the_content() ) {
						?>
							<div class="entry-content">
								<?php
								if( !is_single() ):
									the_excerpt();
								else:
									the_content();

									wp_link_pages( array(
										'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'megafactory' ),
										'after'       => '</div>',
										'link_before' => '<span class="page-number">',
										'link_after'  => '</span>',
									) );

								endif;

								?>
							</div>
						<?php
							}
						break;

						case 'bottom-meta':
						?>
							<footer class="entry-footer">
								<div class="entry-meta bottom-meta clearfix">
									<?php $this->megafactoryPostMeta('bottommeta'); ?>
								</div>
							</footer>
						<?php
						break;


					} // switch
				} //foreach ?>
				<?php if( $layout == 'list-layout' ): ?>
					</div><!-- post-list-right-part -->
				<?php endif; ?>
			</div>
		<?php
		endif;
	}

	function megafactoryWpBootstrapPagination( $args = array(), $max = '', $print = true ) {

		$defaults = array(
			'range'           => 4,
			'custom_query'    => false,
			'first_string' => esc_html__( 'First', 'megafactory' ),
			'previous_string' => esc_html__( 'Prev', 'megafactory' ),
			'next_string'     => esc_html__( 'Next', 'megafactory' ),
			'last_string'     => esc_html__( 'Last', 'megafactory' ),
			'before_output'   => '<div class="post-pagination-wrap"><ul class="nav pagination post-pagination justify-content-center">',
			'after_output'    => '</ul></div>'
		);

		$args = wp_parse_args(
			$args,
			apply_filters( 'megafactory_wp_bootstrap_pagination_defaults', $defaults )
		);

		$args['range'] = (int) $args['range'] - 1;
		if ( !$args['custom_query'] ){
			$args['custom_query'] = $GLOBALS['wp_query'];
		}
		$count = (int) $args['custom_query']->max_num_pages;
		$count = absint( $count ) ? absint( $count ) : (int) $max;
		$page  = intval( get_query_var( 'paged' ) );
		$ceil  = ceil( $args['range'] / 2 );

		if ( $count <= 1 )
			return FALSE;

		if ( !$page )
			$page = 1;

		if ( $count > $args['range'] ) {
			if ( $page <= $args['range'] ) {
				$min = 1;
				$max = $args['range'] + 1;
			} elseif ( $page >= ($count - $ceil) ) {
				$min = $count - $args['range'];
				$max = $count;
			} elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
				$min = $page - $ceil;
				$max = $page + $ceil;
			}
		} else {
			$min = 1;
			$max = $count;
		}

		$echo = '';
		$previous = intval($page) - 1;
		$previous = esc_attr( get_pagenum_link($previous) );

		// For theme check
		$t_next_post_link = get_next_posts_link();
		$t_prev_post_link = get_previous_posts_link();

		$firstpage = esc_attr( get_pagenum_link(1) );
		if ( $firstpage && (1 != $page) && isset( $args['first_string'] ) && $args['first_string'] != '' )
			$echo .= '<li class="nav-item previous"><a href="' . $firstpage . '" title="' . esc_html__( 'First', 'megafactory') . '">' . $args['first_string'] . '</a></li>';
		if ( $previous && (1 != $page) )
			$echo .= '<li class="nav-item"><a href="' . $previous . '" title="' . esc_html__( 'previous', 'megafactory') . '">' . $args['previous_string'] . '</a></li>';

		if ( !empty($min) && !empty($max) ) {
			for( $i = $min; $i <= $max; $i++ ) {
				if ($page == $i) {
					$echo .= '<li class="nav-item active"><span class="active">' . str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) . '</span></li>';
				} else {
					$echo .= sprintf( '<li class="nav-item"><a href="%s">%002d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
				}
			}
		}

		$next = intval($page) + 1;
		$next = esc_attr( get_pagenum_link($next) );
		if ($next && ($count != $page) )
			$echo .= '<li class="nav-item"><a href="' . $next . '" class="next-page" title="' . esc_html__( 'next', 'megafactory') . '">' . $args['next_string'] . '</a></li>';

		$lastpage = esc_attr( get_pagenum_link($count) );
		if ( $lastpage && isset( $args['last_string'] ) && $args['last_string'] != '' ) {
			$echo .= '<li class="nav-item next"><a href="' . $lastpage . '" title="' . esc_html__( 'Last', 'megafactory') . '">' . $args['last_string'] . '</a></li>';
		}
		if ( isset($echo) && $print ){
			echo ( $args['before_output'] . $echo . $args['after_output'] );
		}else{
			return $args['before_output'] . $echo . $args['after_output'];
		}
	}

	function megafactoryCommentIDVerify( $comment_id )
	{
		// Retrieve post votes IPs
		$meta_IP = get_comment_meta( $comment_id, 'comment_voted_IP', true );
		if( isset( $meta_IP ) && is_array( $meta_IP ) ){
			// Retrieve current user IP
			$ip = $_SERVER['REMOTE_ADDR'];

			// If user has already voted
			if( array_key_exists($ip, $meta_IP) ){
				return true;
			}else{
				return false;
			}
		}

		return false;
	}

	function megafactoryCommentsLike()
	{
		// Check for nonce security
		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'megafactory-comment-like' ) )
			die ( esc_html__( 'Busted', 'megafactory' ) );

		if(isset($_POST['cmt_id']))
		{
			// Retrieve user IP address
			$ip = $_SERVER['REMOTE_ADDR'];

			$comment_id = isset( $_POST['cmt_id'] ) ? esc_attr( $_POST['cmt_id'] ) : '';
			$comment_meta = isset( $_POST['cmt_meta'] ) ? esc_attr( $_POST['cmt_meta'] ) : '1';


			// Get voters'IPs for the current post
			$meta_IP = get_comment_meta( $comment_id, 'comment_voted_IP', true );

			// Get votes count for the current post
			$meta_key = '';
			$meta_count = 0;
			if( $comment_meta == '1' ){
				$meta_key = 'comment_like_count';
				$meta_count = get_comment_meta( $comment_id, 'comment_like_count', true );
			}else{
				$meta_key = 'comment_dislike_count';
				$meta_count = get_comment_meta( $comment_id, 'comment_dislike_count', true );
			}

			// Use has already voted ?
			if( !$this->megafactoryCommentIDVerify( $comment_id ) )
			{
				if( isset( $meta_IP ) && is_array( $meta_IP ) ){
					if( $comment_meta == '1' ){
						$meta_IP[$ip] = 'like';
					}else{
						$meta_IP[$ip] = 'dislike';
					}
				}else{
					if( $comment_meta == '1' ){
						$meta_IP = array( $ip => 'like' );
					}else{
						$meta_IP = array( $ip => 'dislike' );
					}
				}
				$meta_count = $meta_count != '' ? $meta_count : 0;
				// Save IP and increase votes count
				update_comment_meta( $comment_id, "comment_voted_IP", $meta_IP );
				update_comment_meta( $comment_id, $meta_key, ++$meta_count );

				// Display count (ie jQuery return value)
				echo ( $this->megafactoryCommentLikeOut( $comment_id ) );
			}else{

				$like_count = get_comment_meta( $comment_id, 'comment_like_count', true );
				$dislike_count = get_comment_meta( $comment_id, 'comment_dislike_count', true );

				if( $comment_meta == '1' ){
					if( $meta_IP[$ip] == 'dislike' ){
						//echo 'going to like';
						$meta_IP[$ip] = 'like';
						update_comment_meta( $comment_id, "comment_voted_IP", $meta_IP );
						update_comment_meta( $comment_id, 'comment_dislike_count', --$dislike_count );
						update_comment_meta( $comment_id, 'comment_like_count', ++$like_count );
						echo ( $this->megafactoryCommentLikeOut( $comment_id ) );
					}else{
						echo "already liked";
					}
				}else{
					if( $meta_IP[$ip] == 'like' ){
						//echo 'going to dislike';
						$meta_IP[$ip] = 'dislike';
						update_comment_meta( $comment_id, "comment_voted_IP", $meta_IP );
						update_comment_meta( $comment_id, 'comment_like_count', --$like_count );
						update_comment_meta( $comment_id, 'comment_dislike_count', ++$dislike_count );
						echo ( $this->megafactoryCommentLikeOut( $comment_id ) );
					}else{
						echo "already disliked";
					}
				}

			}
		}
		exit;
	}

	function megafactoryCommentLikeOut( $comment_id )
	{
		$output = '';
		$meta_IP = get_comment_meta( $comment_id, 'comment_voted_IP', true );
		//print_r($meta_IP);
		$ip = $_SERVER['REMOTE_ADDR'];

		$meta_count = get_comment_meta( $comment_id, 'comment_like_count', true );
		$meta_dcount = get_comment_meta( $comment_id, 'comment_dislike_count', true );
		$output .= '<ul class="nav comments-like-nav">';
		if( $this->megafactoryCommentIDVerify( $comment_id ) ){
			if( $meta_IP[$ip] == 'like' ){
				$output .= '<li><span class="fa fa-thumbs-up comment-liked theme-color" data-id="1" data-cmt-id="'. esc_attr( $comment_id ) .'"></span> '. $meta_count .'</li><li><span class="icon-dislike comment-like" data-id="2" data-cmt-id="'. esc_attr( $comment_id ) .'"></span> '. $meta_dcount .'</li>';
			}else{
				$output .= '<li><span class="icon-like comment-like" data-id="1" data-cmt-id="'. esc_attr( $comment_id ) .'"></span> '. $meta_count .'</li><li><span class="fa fa-thumbs-down comment-liked theme-color" data-id="2" data-cmt-id="'. esc_attr( $comment_id ) .'"></span> '. $meta_dcount .'</li>';
			}
		}else{
			$output .= '<li><span class="icon-like comment-like" data-id="1" data-cmt-id="'. esc_attr( $comment_id ) .'"></span> '. $meta_count .'</li><li><span class="icon-dislike comment-like" data-id="2" data-cmt-id="'. esc_attr( $comment_id ) .'"></span> '. $meta_dcount .'</li>';
		}
		$output .= '</ul>';
		return $output;
	}

	function megafactoryCommentShare( $comment_id ){
		$output = '';
		$comments_shares = $this->megafactoryThemeOpt( 'comments-social-shares' );
		ob_start();
	?>
		<ul class="nav comments-share social-icons social-circle">
			<?php foreach ( $comments_shares as $social_share ){

					switch( $social_share ){

						case "fb":
					?>
							<li><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( get_comment_link( $comment_id ) ); ?>&t=<?php echo urlencode( get_the_title() ); ?>" target="blank" class="social-fb share-fb"><i class="fa fa-facebook"></i></a></li>

					<?php
						break; // fb
						case "twitter":
					?>

							<li><a href="http://twitter.com/home?status=Reading:<?php echo urlencode( get_the_title() ); ?>-<?php echo urlencode(  get_comment_link( $comment_id ) ); ?>" class="social-twitter share-twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>

					<?php
						break; // twitter
						case "linkedin":
					?>

							<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_comment_link( $comment_id ) ); ?>&title=<?php echo urlencode( get_the_title() ); ?>&summary=&source=<?php echo urlencode( get_bloginfo('name') ); ?>" class="social-linkedin share-linkedin" target="_new"><i class="fa fa-linkedin"></i></a></li>

					<?php
						break; // linkedin
						case "gplus":
					?>

						<li><a href="https://plus.google.com/share?url=<?php echo urlencode( get_comment_link( $comment_id ) ); ?>" class="social-gplus share-gplus" target="blank"><i class="fa fa-google-plus"></i></a></li>

					<?php
						break; // gplus
						case "pinterest":
					?>

						<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url( get_comment_link( $comment_id ) ); ?>&description=<?php echo urlencode( get_the_title() ); ?>" class="social-pinterest share-pinterest" target="blank"><i class="fa fa-pinterest"></i></a></li>

					<?php
						break; // pinterest
					?>

			<?php
					} //switch
				} // foreach?>
		</ul>
	<?php
		$output .= ob_get_clean();
		return $output;
	}
}

class MegafactoryFooterElements extends MegafactoryThemeOpt {

	private $megafactory_options;

	function __construct() {
		$this->megafactory_options = parent::$megafactory_option;
    }

	function megafactoryFooterLayout(){
		$megafactory_options = $this->megafactory_options;
		$footer_class = '';
		if( megafactory_po_exists() ){
			if( $this->megafactoryCheckMetaValue( 'megafactory_page_hidden_footer', 'hidden-footer' ) == 1 )
				$footer_class .= ' footer-fixed';

			if( $this->megafactoryCheckMetaValue( 'megafactory_page_footer_layout', 'footer-layout' ) == 'boxed' )
				$footer_class .= ' boxed-container';
		}elseif( is_single() ){
			if( $this->megafactoryCheckMetaValue( 'megafactory_post_hidden_footer', 'hidden-footer' ) == 1 )
				$footer_class .= ' footer-fixed';

			if( $this->megafactoryCheckMetaValue( 'megafactory_post_footer_layout', 'footer-layout' ) == 'boxed' )
				$footer_class .= ' boxed-container';
		}else{
			if( $this->megafactoryThemeOpt('hidden-footer') == 1 )
				$footer_class .= ' footer-fixed';

			if( $this->megafactoryThemeOpt('footer-layout') == 'boxed' )
				$footer_class .= ' boxed-container';
		}
		echo esc_attr( $footer_class );
	}

	function megafactoryFooterTopElements(){

		$boxed = $this->megafactoryThemeOpt('footer-top-container');
		$container = $boxed == 'wide' ? 'container-fluid' : 'container';

	?>
		<div class="footer-top-wrap">
			<div class="<?php echo esc_attr( $container ); ?>">
				<div class="row">
	<?php
		$layout = ''; $page_opt_stat = 0;
		if( megafactory_po_exists() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_footer_top_layout_opt', true );
			if( $post_items_opt == 'custom' ){
				$page_opt_stat = 1;
				$layout = $this->megafactoryCheckMetaValue( 'megafactory_page_footer_top_layout', 'footer-top-layout' );
			}else{
				$layout = $this->megafactoryThemeOpt('footer-top-layout');
			}
		}elseif( is_single() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_footer_top_layout_opt', true );
			if( $post_items_opt == 'custom' ){
				$page_opt_stat = 1;
				$layout = $this->megafactoryCheckMetaValue( 'megafactory_post_footer_top_layout', 'footer-top-layout' );
			}else{
				$layout = $this->megafactoryThemeOpt('footer-top-layout');
			}
		}else{
			$layout = $this->megafactoryThemeOpt('footer-top-layout');
		}
		$cols = preg_split("/[\s-]+/", $layout);
		$i = 1;
		foreach( $cols as $col ){

			$sidebar = '';
			if( $page_opt_stat ){
				if( megafactory_po_exists() ){
					$sidebar = $this->megafactoryCheckMetaValue( 'megafactory_page_footer_top_sidebar_'.$i, 'footer-top-sidebar-'.$i );
				}elseif( is_single() ){
					$sidebar = $this->megafactoryCheckMetaValue( 'megafactory_post_footer_top_sidebar_'.$i, 'footer-top-sidebar-'.$i );
				}else{
					$sidebar = $this->megafactoryThemeOpt('footer-top-sidebar-'.$i);
				}
				$i++;
			}else{
				$sidebar = $this->megafactoryThemeOpt('footer-top-sidebar-'.$i++);
			}

			if ( is_active_sidebar( $sidebar ) ) : ?>
			<div class="col-lg-<?php echo absint( $col ); ?>">
				<div class="footer-top-sidebar">
					<?php dynamic_sidebar( $sidebar ); ?>
				</div>
			</div>
			<?php endif; ?>
		<?php } ?>
				</div>
			</div>
		</div>
	<?php
	}

	function megafactoryFooterMiddleElements(){

		$boxed = $this->megafactoryThemeOpt('footer-middle-container');
		$container = $boxed == 'wide' ? 'container-fluid' : 'container';
		ob_start();

		$layout = ''; $page_opt_stat = 0;
		if( megafactory_po_exists() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_footer_middle_layout_opt', true );
			if( $post_items_opt == 'custom' ){
				$page_opt_stat = 1;
				$layout = $this->megafactoryCheckMetaValue( 'megafactory_page_footer_middle_layout', 'footer-middle-layout' );
			}else{
				$layout = $this->megafactoryThemeOpt('footer-middle-layout');
			}
		}elseif( is_single() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_footer_middle_layout_opt', true );
			if( $post_items_opt == 'custom' ){
				$page_opt_stat = 1;
				$layout = $this->megafactoryCheckMetaValue( 'megafactory_post_footer_middle_layout', 'footer-middle-layout' );
			}else{
				$layout = $this->megafactoryThemeOpt('footer-middle-layout');
			}
		}else{
			$layout = $this->megafactoryThemeOpt('footer-middle-layout');
		}
		$cols = preg_split("/[\s-]+/", $layout);
		$i = 1;
		foreach( $cols as $col ){

			$sidebar = '';
			if( $page_opt_stat ){
				if( megafactory_po_exists() ){
					$sidebar = $this->megafactoryCheckMetaValue( 'megafactory_page_footer_middle_sidebar_'.$i, 'footer-middle-sidebar-'.$i );
				}elseif( is_single() ){
					$sidebar = $this->megafactoryCheckMetaValue( 'megafactory_post_footer_middle_sidebar_'.$i, 'footer-middle-sidebar-'.$i );
				}else{
					$sidebar = $this->megafactoryThemeOpt('footer-middle-sidebar-'.$i);
				}
				$i++;
			}else{
				$sidebar = $this->megafactoryThemeOpt('footer-middle-sidebar-'.$i++);
			}

			if ( is_active_sidebar( $sidebar ) ) : ?>
			<div class="col-lg-<?php echo absint( $col ); ?>">
				<div class="footer-middle-sidebar">
					<?php dynamic_sidebar( $sidebar ); ?>
				</div>
			</div>
			<?php endif; ?>
		<?php }
		$footer_mid_out = ob_get_clean();
		$footer_mid_out = trim( $footer_mid_out );
		if( !empty( $footer_mid_out ) ):
		?>
			<div class="footer-middle-wrap">
				<div class="<?php echo esc_attr( $container ); ?>">
					<div class="row">
						<?php echo ( $footer_mid_out ); ?>
					</div>
				</div>
			</div>
	<?php
		endif;
	}

	function megafactoryFooterBottomElements( $key ){
		switch( $key ) {

			case 'social':
				echo ( $this->megafactorySocial('footer-bottom-social', true) );
			break;

			case 'copyright':
				echo do_shortcode( $this->megafactoryThemeOpt('copyright-text') );
			break;

			case 'menu':
				echo ( $this->megafactoryWPMenu('footer-menu', 'footer-menu') );
			break;

			case 'widget':
				$footer_bottom_widget = '';
				if( megafactory_po_exists() ){
					$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_footer_bottom_widget_opt', true );
					if( $post_items_opt == 'custom' ){
						$footer_bottom_widget = get_post_meta( get_the_ID(), 'megafactory_page_footer_bottom_widget', true );
					}else{
						$footer_bottom_widget = $this->megafactoryThemeOpt('footer-bottom-widget');
					}
				}elseif( is_single() ){
					$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_footer_bottom_widget_opt', true );
					if( $post_items_opt == 'custom' ){
						$footer_bottom_widget = get_post_meta( get_the_ID(), 'megafactory_post_footer_bottom_widget', true );
					}else{
						$footer_bottom_widget = $this->megafactoryThemeOpt('footer-bottom-widget');
					}
				}else{
					$footer_bottom_widget = $this->megafactoryThemeOpt('footer-bottom-widget');
				}
				echo ( $this->megafactoryWidget( $footer_bottom_widget, 'footer-bottom-widget' ) );
			break;

		}
	}

	function megafactoryFooterBottomParts(){
		$megafactory_options = $this->megafactory_options;
		$fb_parts = array( 'Left' => 'pull-left', 'Center' => 'pull-center', 'Right' => 'pull-right' );

		$fixed_class = '';
		if( megafactory_po_exists() ){
			if( $this->megafactoryCheckMetaValue( 'megafactory_page_footer_bottom_fixed', 'footer-bottom-fixed' ) ){
				$fixed_class = ' footer-bottom-fixed';
			}
		}elseif( is_single() ){
			if( $this->megafactoryCheckMetaValue( 'megafactory_post_footer_bottom_fixed', 'footer-bottom-fixed' ) ){
				$fixed_class = ' footer-bottom-fixed';
			}
		}else{
			$fixed_class = $this->megafactoryThemeOpt('footer-bottom-fixed') ? ' footer-bottom-fixed' : '';
		}


		$boxed = $this->megafactoryThemeOpt('footer-bottom-container');
		$container = $boxed == 'wide' ? 'container-fluid' : 'container';

	?>
		<div class="footer-bottom<?php echo esc_attr( $fixed_class ); ?>">
			<div class="footer-bottom-inner <?php echo esc_attr( $container ); ?>">
				<div class="row">
					<div class="col-md-12">
	<?php

		foreach( $fb_parts as $part => $class ){

			$fb_elements = '';
			if( megafactory_po_exists() ){
				$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_footer_bottom_items_opt', true );
				if( $post_items_opt == 'custom' ){
					$fb_elements_json = get_post_meta( get_the_ID(), 'megafactory_page_footer_bottom_items', true );
					$fb_elements = json_decode( stripslashes( $fb_elements_json ), true );
					$fb_elements = $fb_elements[$part];
				}else{
					$fb_elements = $megafactory_options['footer-bottom-items'][$part];
				}
			}elseif( is_single() ){
				$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_footer_bottom_items_opt', true );
				if( $post_items_opt == 'custom' ){
					$fb_elements_json = get_post_meta( get_the_ID(), 'megafactory_post_footer_bottom_items', true );
					$fb_elements = json_decode( stripslashes( $fb_elements_json ), true );
					$fb_elements = $fb_elements[$part];
				}else{
					$fb_elements = $megafactory_options['footer-bottom-items'][$part];
				}
			}else{
				$fb_elements = $megafactory_options['footer-bottom-items'][$part];
			}

			if( array_key_exists( "placebo", $fb_elements ) ) unset( $fb_elements['placebo'] );
			if ($fb_elements):
			?>
				<ul class="footer-bottom-items nav <?php echo esc_attr( $class ); ?>">
			<?php foreach ($fb_elements as $element => $value ) {?>
					<li class="nav-item">
						<div class="nav-item-inner">
					<?php $this->megafactoryFooterBottomElements($element); ?>
						</div>
					</li>
			<?php }	?>
				</ul>
			<?php
			endif;
		}
	?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}

	function megafactoryFooterElementsSwitch($key){
		switch( $key ) {

			case 'footer-top':
				$this->megafactoryFooterTopElements();
			break;

			case 'footer-middle':
				$this->megafactoryFooterMiddleElements();
			break;

			case 'footer-bottom':
				$this->megafactoryFooterBottomParts();
			break;

		}
	}

	function megafactoryFooterBacktoTop(){
		$back_to_top = $this->megafactoryThemeOpt('back-to-top');
		if( $back_to_top == 1 ){ ?>
			<a href="#" class="back-to-top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
		<?php
		}
	}

	function megafactoryFooterElements(){

		$footer_elements = '';
		if( megafactory_po_exists() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_page_footer_items_opt', true );
			if( $post_items_opt == 'custom' ){
				$footer_elements_json = get_post_meta( get_the_ID(), 'megafactory_page_footer_items', true );
				$footer_elements = json_decode( stripslashes( $footer_elements_json ), true );
				$footer_elements = $footer_elements['Enabled'];
			}else{
				$megafactory_options = $this->megafactory_options;
				$footer_elements = $megafactory_options['footer-items']['Enabled'];
			}
		}elseif( is_single() ){
			$post_items_opt = get_post_meta( get_the_ID(), 'megafactory_post_footer_items_opt', true );
			if( $post_items_opt == 'custom' ){
				$footer_elements_json = get_post_meta( get_the_ID(), 'megafactory_post_footer_items', true );
				$footer_elements = json_decode( stripslashes( $footer_elements_json ), true );
				$footer_elements = $footer_elements['Enabled'];
			}else{
				$megafactory_options = $this->megafactory_options;
				$footer_elements = $megafactory_options['footer-items']['Enabled'];
			}
		}else{
			$megafactory_options = $this->megafactory_options;
			$footer_elements = $megafactory_options['footer-items']['Enabled'];
		}

		if( is_array( $footer_elements ) && array_key_exists( "placebo", $footer_elements ) ) unset( $footer_elements['placebo'] );
		if ($footer_elements):
			foreach ($footer_elements as $element => $value ) {
				$this->megafactoryFooterElementsSwitch($element);
			}
		endif;
	}
}
