<?php 
/*
	Plugin Name: Megafactory Core
	Plugin URI: http://zozothemes.com/
	Description: Core plugin for megafactory theme.
	Version: 1.0.2
	Author: zozothemes
	Author URI: http://zozothemes.com/
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$cur_theme = wp_get_theme();	
if ( $cur_theme->get( 'Name' ) != 'Megafactory' && $cur_theme->get( 'Name' ) != 'Megafactory Child' ){
	return;
}

define( 'MEGAFACTORY_CORE_DIR', plugin_dir_path( __FILE__ ) );
define('MEGAFACTORY_CORE_URL', plugin_dir_url( __FILE__ ) );

load_plugin_textdomain( 'megafactory-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

//Maintenance 
require_once( MEGAFACTORY_CORE_DIR . 'maintenance/maintenance.php' );

require_once( MEGAFACTORY_CORE_DIR . 'megafactory-redux.php' );
require_once( MEGAFACTORY_CORE_DIR . 'admin/metabox/metaboxes/meta_box.php' );
require_once( MEGAFACTORY_CORE_DIR . 'admin/metabox/inc/megafactory-metabox.php' );

// Megafactory Shortcode
require_once( MEGAFACTORY_CORE_DIR . 'admin/shortcodes/shortcodes.php' );

// Megafactory Theme Custom Font Upload Option
require_once( MEGAFACTORY_CORE_DIR . 'custom-font-code/custom-fonts.php' );

// Megafactory AQ Resizer
require_once( MEGAFACTORY_CORE_DIR . 'inc/aq_resizer.php' );

// Megafactory Widgets
require_once( MEGAFACTORY_CORE_DIR . 'widgets/about_widget.php' );
require_once( MEGAFACTORY_CORE_DIR . 'widgets/ads_widget.php' );
require_once( MEGAFACTORY_CORE_DIR . 'widgets/latest_post_widget.php' );
require_once( MEGAFACTORY_CORE_DIR . 'widgets/popular_post_widget.php' );
require_once( MEGAFACTORY_CORE_DIR . 'widgets/tab_post_widget.php' );
require_once( MEGAFACTORY_CORE_DIR . 'widgets/author_widget.php' );
require_once( MEGAFACTORY_CORE_DIR . 'widgets/contact_info_widget.php' );
require_once( MEGAFACTORY_CORE_DIR . 'widgets/instagram_widget.php' );
require_once( MEGAFACTORY_CORE_DIR . 'widgets/social_widget.php' );
require_once( MEGAFACTORY_CORE_DIR . 'widgets/tweets_widget.php' );
require_once( MEGAFACTORY_CORE_DIR . 'widgets/mailchimp/mailchimp_widget.php' );

// Custom Post Types
require_once( MEGAFACTORY_CORE_DIR . 'cpt/cpt-class.php' );

// Category Meta Field
require_once( MEGAFACTORY_CORE_DIR . 'inc/megafactory-category-meta.php' );

function megafactory_core_admin_scripts_method() {

	wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/css/font-awesome.css' ), array(), '4.7.0' );
	wp_enqueue_style( 'simple-line-icons', get_theme_file_uri( '/assets/css/simple-line-icons.css' ), array(), '1.0' );

	wp_enqueue_style( 'megafactory-core-custom-style', plugins_url( '/admin/assets/css/theme-custom.css' , __FILE__ ), false, '1.0.0' );
    wp_enqueue_script( 'megafactory-core-custom', plugins_url( '/admin/assets/js/theme-custom.js' , __FILE__ ), array( 'jquery' ) );
	
	//Admin Localize Script
	wp_localize_script('megafactory-core-custom', 'megafactory_core_admin_ajax_var', array(
		'admin_ajax_url' => admin_url('admin-ajax.php'),
		'font_nonce' => wp_create_nonce('megafactory-font-nounce'), 
		'process' => esc_html__( 'Processing', 'megafactory-core' ),
		'font_del_pbm' => esc_html__( 'Font Deletion Problem', 'megafactory-core' )
	));
		
}
add_action( 'admin_enqueue_scripts', 'megafactory_core_admin_scripts_method' );

/*Author Social Links*/
if( ! function_exists('megafactory_author_contactmethods') ) {
	function megafactory_author_contactmethods( $contactmethods ) {
		$contactmethods['twitter'] = esc_html__('Twitter URL', 'megafactory-core');
		$contactmethods['facebook'] = esc_html__('Facebook URL', 'megafactory-core');
		$contactmethods['vimeo'] = esc_html__('Vimeo URL', 'megafactory-core');
		$contactmethods['youtube'] = esc_html__('Youtube URL', 'megafactory-core');
		
		return $contactmethods;
	}
	add_filter('user_contactmethods','megafactory_author_contactmethods',10,1);
}

/*Facebook Comments JS*/
if( ! function_exists('megafactory_fb_comments_js') ) {
	function megafactory_fb_comments_js(){
		$ato = new MegafactoryThemeOpt;
		$comment_type = $ato->megafactoryThemeOpt( 'comments-type' );
		if( $comment_type == 'fb' && is_single() ) :
			$fb_dev_api = $ato->megafactoryThemeOpt( 'fb-developer-key' );
		?>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=<?php echo esc_attr( $fb_dev_api ); ?>";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		<?php
		endif;
	}
	add_action( 'megafactory_body_action', 'megafactory_fb_comments_js', 50 );
}

/* Add Admin Table Columns Head */
function megafactory_columns_head( $defaults ) {
	if ( current_user_can( 'manage_options' ) ) {
		$defaults['megafactory_post_featured_stat'] = esc_html__( 'Featured', 'megafactory-core' );
	}
    return $defaults;
}
add_filter('manage_post_posts_columns', 'megafactory_columns_head');

/* Add Admin Table Coulmn */
function megafactory_columns_content( $column_name, $post_ID ) {
	if ( current_user_can( 'manage_options' ) ) {
		if ( $column_name == 'megafactory_post_featured_stat' ) {
			$meta = get_post_meta( $post_ID, 'megafactory_post_featured_stat', true );
			$out = '<label class="megafactory-switch">
						<input type="checkbox" data-post="'.$post_ID.'" class="megafactory-post-featured-status" '. ( $meta == 1 ? 'checked' : '' ) .'>
						<div class="megafactory-slider round"></div>
					</label><br />
					<span id="post-featured-stat-msg-'.$post_ID.'"></span>';
			echo ( $out );
		}
	}
}
add_action('manage_post_posts_custom_column', 'megafactory_columns_content', 10, 2);

/* Active Featured Status */
add_action('wp_ajax_megafactory-post-featured-active', 'megafactory_post_featured_active');
function megafactory_post_featured_active(){

	$nonce = $_POST['nonce'];
  
    if ( ! wp_verify_nonce( $nonce, 'megafactory-post-featured' ) )
        die ( esc_html__( 'Busted!', 'megafactory-core' ) );
	
	update_post_meta( esc_attr( $_POST['postid'] ), 'megafactory_post_featured_stat', esc_attr($_POST['featured-stat']) );
	exit;
}

// Facebook Share Code
//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
	return $output . ' prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

function insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
	
	ob_start();
	the_excerpt();
	$excerpt = ob_get_clean();	
	
	echo '<meta property="og:title" content="' . get_the_title() . '"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="' . esc_url( get_permalink() ) . '"/>
<meta property="og:site_name" content="'. get_bloginfo( 'name' ) .'"/>
<meta property="og:description" content="'. $excerpt .'"/>';
	
	if( has_post_thumbnail( $post->ID ) ) {
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '
<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>
<meta property="og:image:width" content="' . esc_attr( $thumbnail_src[1] ) . '"/>
<meta property="og:image:height" content="' . esc_attr( $thumbnail_src[2] ) . '"/>
';
	}
	
    echo "";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

/* VC Shortcodes */
add_shortcode( 'megafactory_vc_circle_progress', 'megafactory_vc_circle_progress_shortcode' );
add_shortcode( 'megafactory_vc_compare_pricing', 'megafactory_vc_compare_pricing_shortcode' );
add_shortcode( 'megafactory_vc_content_carousel', 'megafactory_vc_content_carousel_shortcode' );
add_shortcode( 'megafactory_vc_counter', 'megafactory_vc_counter_shortcode' );
add_shortcode( 'megafactory_vc_day_counter', 'megafactory_vc_day_counter_shortcode' );
add_shortcode( 'megafactory_vc_events', 'megafactory_vc_events_shortcode' );
add_shortcode( 'megafactory_vc_feature_box', 'megafactory_vc_feature_box_shortcode' );
add_shortcode( 'megafactory_vc_flip_box', 'megafactory_vc_flip_box_shortcode' );
add_shortcode( 'megafactory_vc_google_map', 'megafactory_vc_google_map_shortcode' );
add_shortcode( 'megafactory_vc_icons', 'megafactory_vc_icons_shortcode' );
add_shortcode( 'megafactory_vc_mailchimp', 'megafactory_vc_mailchimp_shortcode' );
add_shortcode( 'megafactory_vc_modal_popup', 'megafactory_vc_modal_popup_shortcode' );
add_shortcode( 'megafactory_vc_portfolio', 'megafactory_vc_portfolio_shortcode' );
add_shortcode( 'megafactory_vc_blog', 'megafactory_vc_blog_shortcode' );
add_shortcode( 'megafactory_vc_pricing_table', 'megafactory_vc_pricing_table_shortcode' );
add_shortcode( 'megafactory_vc_section_title', 'megafactory_vc_section_title_shortcode' );
add_shortcode( 'megafactory_vc_services', 'megafactory_vc_services_shortcode' );
add_shortcode( 'megafactory_vc_social_icons', 'megafactory_vc_social_icons_shortcode' );
add_shortcode( 'megafactory_vc_team', 'megafactory_vc_team_shortcode' );
add_shortcode( 'megafactory_vc_testimonial', 'megafactory_vc_testimonial_shortcode' );
add_shortcode( 'megafactory_vc_timeline', 'megafactory_vc_timeline_shortcode' );
add_shortcode( 'megafactory_vc_twitter', 'megafactory_vc_twitter_shortcode' );
add_shortcode( 'megafactory_vc_image_grid', 'megafactory_vc_image_grid_shortcode' );
add_shortcode( 'megafactory_vc_contact_form', 'megafactory_vc_contact_form_shortcode' );
add_shortcode( 'megafactory_vc_contact_info', 'megafactory_vc_contact_info_shortcode' );
add_shortcode( 'megafactory_vc_list_item', 'megafactory_vc_list_item_shortcode' );
add_shortcode( 'megafactory_vc_portfolio_single', 'megafactory_vc_portfolio_single_shortcode' );

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');