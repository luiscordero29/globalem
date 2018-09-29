<?php
/**
 * Additional features to allow styling of the templates
 */

function megafactory_custom_scripts() {
	
	global $megafactory_custom_styles;
	
	if( megafactory_po_exists() ):
		
		// Page Styles
		require_once MEGAFACTORY_THEME_ELEMENTS . '/page-styles.php';
		ob_start();
		megafactory_page_custom_styles();
		$megafactory_custom_styles = ob_get_clean();
		wp_add_inline_style( 'megafactory-theme-style', $megafactory_custom_styles );
		
	elseif( is_single() && has_post_format( 'quote' ) ):
		$meta_opt = get_post_meta( get_the_ID(), 'megafactory_post_quote_modal', true );
		if( $meta_opt != '' && $meta_opt != 'theme-default' ) :
			$aps = new MegafactoryPostSettings;
			$theme_color = $aps->megafactoryThemeColor();
			$rgba_08 = $aps->megafactoryHex2Rgba( $theme_color, '0.8' ); 
			$blockquote_bg_opt = $aps->megafactoryCheckMetaValue( 'megafactory_post_quote_modal', 'single-post-quote-format' );
			ob_start();
			$aps->megafactoryQuoteDynamicStyle( 'single-post', $blockquote_bg_opt, $theme_color, $rgba_08 );
			$megafactory_custom_styles .= ob_get_clean();
		endif;
	elseif( is_single() && has_post_format( 'link' ) ):
		$meta_opt = get_post_meta( get_the_ID(), 'megafactory_post_link_modal', true );
		if( $meta_opt != '' && $meta_opt != 'theme-default' ) :
			$aps = new MegafactoryPostSettings;
			$theme_color = $aps->megafactoryThemeColor();
			$rgba_08 = $aps->megafactoryHex2Rgba( $theme_color, '0.8' ); 
			$blockquote_bg_opt = $aps->megafactoryCheckMetaValue( 'megafactory_post_link_modal', 'single-post-link-format' );
			ob_start();
			$aps->megafactoryLinkDynamicStyle( 'single-post', $blockquote_bg_opt, $theme_color, $rgba_08 );
			$megafactory_custom_styles .= ob_get_clean();
		endif;
	endif;
	
	if( is_single() ){
		// Page Styles
		require_once MEGAFACTORY_THEME_ELEMENTS . '/page-styles.php';
		ob_start();
		megafactory_post_custom_styles();
		$megafactory_custom_styles .= ob_get_clean();
	}
	
	if( is_single() && !empty( $megafactory_custom_styles ) ):
		wp_add_inline_style( 'megafactory-theme-style', $megafactory_custom_styles );
	endif;
	
}
add_action( 'wp_enqueue_scripts', 'megafactory_custom_scripts' );

function megafactory_rtl_body_classes( $classes ) {
    $classes[] = 'rtl';
    return $classes;     
}

add_action('wp_ajax_megafactory-custom-sidebar-export', 'megafactory_custom_sidebar_export');
function megafactory_custom_sidebar_export(){

	$nonce = $_POST['nonce'];
  
    if ( ! wp_verify_nonce( $nonce, 'megafactory-sidebar-featured' ) )
        die ( esc_html__( 'Busted!', 'megafactory' ) );
	
	$sidebar = get_option('megafactory_custom_sidebars');
	echo ( $sidebar );
	
	exit;
}

function megafactory_ads_out( $field ){
	$ato = new MegafactoryThemeOpt;
	$output = '';
	if( $ato->megafactoryThemeOpt( $field.'-ads-text' ) ){
		$ads_hide = '';
		if( $ato->megafactoryThemeOpt( $field.'-ads-md' ) == 'no' ){
			$ads_hide .= 'hidden-xs-up ';
		}
		if( $ato->megafactoryThemeOpt( $field.'-ads-sm' ) == 'no' ){
			$ads_hide .= 'hidden-md-down ';
		}
		if( $ato->megafactoryThemeOpt( $field.'-ads-xs' ) == 'no' ){
			$ads_hide .= 'hidden-sm-down ';
		}
		$output = '<div class="adv-wrapper '. esc_attr( $ads_hide ) .'">'. do_shortcode( $ato->megafactoryThemeOpt( $field.'-ads-text' ) ) .'</div>';
	}
	return $output;
}

function megafactory_po_exists( $post_id = '' ){
	$post_id = $post_id ? $post_id : get_the_ID();
	$stat = get_post_meta( $post_id, 'megafactory_page_layout', true );
	
	if( $stat )
		return true;
	else
		return false;
}

if( ! function_exists('megafactory_mailchimp') ) {
	function megafactory_mailchimp(){

		$nonce = $_POST['nonce'];
	  
		if ( ! wp_verify_nonce( $nonce, 'megafactory-mailchimp' ) )
			die ( esc_html__( 'Busted', 'megafactory' ) );
		if( isset( $_POST['megafactory_mc_number'] ) ) {
			
			$first_name = 'zozo-mc-first_name' . esc_attr( $_POST['megafactory_mc_number'] );
			$last_name = 'zozo-mc-last_name' . esc_attr( $_POST['megafactory_mc_number'] );
			$email = 'zozo-mc-email' . esc_attr( $_POST['megafactory_mc_number'] );
			$success = 'megafactory_mc_success' . esc_attr( $_POST['megafactory_mc_number'] );
			$failure = 'megafactory_mc_failure' . esc_attr( $_POST['megafactory_mc_number'] );
			$listid = 'megafactory_mc_listid' . esc_attr( $_POST['megafactory_mc_number'] );
				
			$ato = new MegafactoryThemeOpt;
			$mc_key = $ato->megafactoryThemeOpt( 'mailchimp-api' );
			$mcapi = new MCAPI( $mc_key );
			
			$merge_vars = array();
			$merge_vars['FNAME'] = isset($_POST[$first_name]) ? strip_tags($_POST[$first_name]) : '';
			$merge_vars['LNAME'] = isset($_POST[$last_name]) ? strip_tags($_POST[$last_name]) : '';
			$subscribed = $mcapi->listSubscribe(strip_tags($_POST[$listid]), strip_tags($_POST[$email]), $merge_vars);
			
			if ($subscribed != false) {
				echo stripslashes($_POST[$success]);
			}else{
				echo stripslashes($_POST[$failure]);
			}
		}
		die();
	}
	add_action('wp_ajax_nopriv_zozo-mc', 'megafactory_mailchimp');
	add_action('wp_ajax_zozo-mc', 'megafactory_mailchimp');
}

if( ! function_exists('megafactory_star_rating') ) {
	function megafactory_star_rating( $rate ){
		$out = '';
		for( $i=1; $i<=5; $i++ ){
			
			if( $i == round($rate) ){
				if ( $i-0.5 == $rate ) {
					$out .= '<i class="fa fa-star-half-o"></i>';
				}else{
					$out .= '<i class="fa fa-star"></i>';
				}
			}else{
				if( $i < $rate ){
					$out .= '<i class="fa fa-star"></i>';
				}else{
					$out .= '<i class="fa fa-star-o"></i>';
				}
			}
		}// for end
		
		return $out;
	}
}

/*Search Options*/
if( ! function_exists('megafactory_search_post') ) {
	function megafactory_search_post($query) {
		if ($query->is_search) {
			$query->set('post_type',array('post'));
		}
	return $query;
	}
}
if( ! function_exists('megafactory_search_page') ) {
	function megafactory_search_page($query) {
		if ($query->is_search) {
			$query->set('post_type',array('page'));
		}
	return $query;
	}
}
if( ! function_exists('megafactory_search_setup') ) {
	function megafactory_search_setup(){
		$ato = new MegafactoryThemeOpt;
		$search_cont = $ato->megafactoryThemeOpt( 'search-content' );
		if( $search_cont == "post" ){
			add_filter('pre_get_posts','megafactory_search_post');
		}elseif( $search_cont == "page" ){
			add_filter('pre_get_posts','megafactory_search_page');
		}
	}
	add_action( 'after_setup_theme', 'megafactory_search_setup' );
}

//Return same value for filter
if( ! function_exists('__return_value') ) {
	function __return_value( $value ) {
		return function () use ( $value ) {
			return $value; 
		};
	}
}

if( !function_exists( 'megafactoryGetCSSAnimation' ) && class_exists( 'Vc_Manager' ) ) {
	function megafactoryGetCSSAnimation( $css_animation ) {
		$output = '';
		if ( '' !== $css_animation && 'none' !== $css_animation ) {
			wp_enqueue_script( 'waypoints' );
			wp_enqueue_style( 'animate-css' );
			$output = ' wpb_animate_when_almost_visible wpb_' . $css_animation . ' ' . $css_animation;
		}
	
		return $output;
	}
}

/*Facebook Comments Code*/
if( ! function_exists('megafactory_fb_comments_code') ) {
	function megafactory_fb_comments_code(){
		$ato = new MegafactoryThemeOpt;
		$fb_width = $ato->megafactoryThemeOpt( 'fb-comments-width' );
		$fb_width = isset( $fb_width['width'] ) && $fb_width['width'] != '' ? esc_attr( $fb_width['width'] ) : '300px';
		$comment_num = $ato->megafactoryThemeOpt( 'fb-comments-number' );
		$fb_number = $comment_num != '' ? absint( $comment_num ) : '5';
?>
		<div class="fb-comments" data-href="<?php esc_url( the_permalink() ); ?>" data-width="<?php echo esc_attr( $fb_width ); ?>" data-numposts="<?php echo esc_attr( $fb_number ); ?>"></div>
	<?php
	}
}

if( !function_exists( 'megafactory_shortcode_rand_id' ) ) {
	function megafactory_shortcode_rand_id() {
		static $shortcode_rand = 1;
		return $shortcode_rand++;
	}
}

/*Image Size Check*/
function megafactory_custom_image_size_chk( $thumb_size, $custom_size = array() ){
	$img_sizes = $img_width = $img_height = $src = '';
	$img_stat = 0;
	$custom_img_size = '';
		
	if( class_exists('Aq_Resize') ) {
		
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full", false, '' );
		$img_width = $img_height = '';
		if( !empty( $custom_size ) ){
			$img_width = isset( $custom_size[0] ) ? $custom_size[0] : '';
			$img_height = isset( $custom_size[1] ) ? $custom_size[1] : '';
		}else{
			$custom_img_size = MegafactoryThemeOpt::megafactoryStaticThemeOpt($thumb_size);
			$img_width = isset( $custom_img_size['width'] ) ? $custom_img_size['width'] : '';
			$img_height = isset( $custom_img_size['height'] ) ? $custom_img_size['height'] : '';
		}
		
		$cropped_img = aq_resize( $src[0], $img_width, $img_height, true, false );
		if( $cropped_img ){
			$img_src = isset( $cropped_img[0] ) ? $cropped_img[0] : '';
			$img_width = isset( $cropped_img[1] ) ? $cropped_img[1] : '';
			$img_height = isset( $cropped_img[2] ) ? $cropped_img[2] : '';
		}else{
			$img_stat = 1;
		}
	}

	if( $img_stat ){
		$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $thumb_size, false, '' );
		$img_src = $src[0];
		$img_width = isset( $src[1] ) ? $src[1] : '';
		$img_height = isset( $src[2] ) ? $src[2] : '';
	}
	
	return array( $img_src, $img_width, $img_height );
}