<?php
/**
 * Megafactory functions and definitions
 *
 */

/**
 * Megafactory predifined vars
 */
define('MEGAFACTORY_ADMIN', get_template_directory().'/admin');
define('MEGAFACTORY_INC', get_template_directory().'/inc');
define('MEGAFACTORY_THEME_ELEMENTS', get_template_directory().'/admin/theme-elements');
define('MEGAFACTORY_ADMIN_URL', get_template_directory_uri().'/admin');
define('MEGAFACTORY_INC_URL', get_template_directory_uri().'/inc');
define('MEGAFACTORY_ASSETS', get_template_directory_uri().'/assets');

define( ‘WP_POST_REVISIONS’, true );

/* Custom Inline Css */
$megafactory_custom_styles = "";

//Theme Default
require_once MEGAFACTORY_ADMIN . '/theme-default/theme-default.php';

require_once MEGAFACTORY_THEME_ELEMENTS . '/theme-options.php';
require_once MEGAFACTORY_INC . '/theme-class/theme-class.php';
require_once MEGAFACTORY_INC . '/walker/wp_bootstrap_navwalker.php';
require_once MEGAFACTORY_ADMIN . '/mega-menu/custom_menu.php';

//CUSTOM SIDEBAR
require_once MEGAFACTORY_ADMIN . '/custom-sidebar/sidebar-generator.php';

//TGM
require_once MEGAFACTORY_ADMIN . '/tgm/tgm-init.php'; 
require_once MEGAFACTORY_ADMIN . '/welcome-page/welcome.php';

//ZOZO IMPORTER
if( class_exists( 'Megafactory_Zozo_Admin_Page' ) ){
	require_once MEGAFACTORY_ADMIN . '/welcome-page/importer/zozo-importer.php'; 	
}

//VC SHORTCODES
if ( class_exists( 'Vc_Manager' ) ) {
	require_once MEGAFACTORY_INC . '/vc/vc-init.php'; 	
}

//Woo
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once MEGAFACTORY_INC . "/woo-functions.php";
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function megafactory_setup() {
	/* Megafactory Text Domain */
	load_theme_textdomain( 'megafactory' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	
	/* Custom background */
	$defaults = array(
		'default-color'          => '',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-background', $defaults );
	
	/* Custom header */
	$defaults = array(
		'default-image'          => '',
		'random-default'         => false,
		'width'                  => 0,
		'height'                 => 0,
		'flex-height'            => false,
		'flex-width'             => false,
		'default-text-color'     => '',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $defaults );
	
	/* Content width */
	if ( ! isset( $content_width ) ) $content_width = 640;
	
	$ao = new MegafactoryThemeOpt;
	$grid_large = $ao->megafactoryThemeOpt('megafactory_grid_large');
	$grid_medium = $ao->megafactoryThemeOpt('megafactory_grid_medium');
	$grid_small = $ao->megafactoryThemeOpt('megafactory_grid_small');
	$port_masonry = $ao->megafactoryThemeOpt('megafactory_portfolio_masonry');
	
	if( !empty( $grid_large ) && is_array( $grid_large ) ) add_image_size( 'megafactory-grid-large', $grid_large['width'], $grid_large['height'], true );
	if( !empty( $grid_medium ) && is_array( $grid_medium ) ) add_image_size( 'megafactory-grid-medium', $grid_medium['width'], $grid_medium['height'], true );
	if( !empty( $grid_small ) && is_array( $grid_small ) ) add_image_size( 'megafactory-grid-small', $grid_small['width'], $grid_small['height'], true );
	
	//Team
	$team_medium = $ao->megafactoryThemeOpt('megafactory_team_medium');
	if( !empty( $team_medium ) && is_array( $team_medium ) ) add_image_size( 'mf-team-medium', $team_medium['width'], $team_medium['height'], true );

	update_option( 'large_size_w', 1170 );
	update_option( 'large_size_h', 694 );
	update_option( 'large_crop', 1 );
	update_option( 'medium_size_w', 768 );
	update_option( 'medium_size_h', 456 );
	update_option( 'medium_crop', 1 );
	update_option( 'thumbnail_size_w', 80 );
	update_option( 'thumbnail_size_h', 80 );
	update_option( 'thumbnail_crop', 1 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top-menu'		=> esc_html__( 'Top Bar Menu', 'megafactory' ),
		'primary-menu'	=> esc_html__( 'Primary Menu', 'megafactory' ),
		'footer-menu'	=> esc_html__( 'Footer Menu', 'megafactory' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_editor_style( 'assets/css/editor-style.css' );

}
add_action( 'after_setup_theme', 'megafactory_setup' );

/**
 * Register widget area.
 *
 */
function megafactory_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'megafactory' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'megafactory' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Menu Sidebar', 'megafactory' ),
		'id'            => 'secondary-menu-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your secondary menu area.', 'megafactory' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'megafactory' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'megafactory' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'megafactory' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'megafactory' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'megafactory' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'megafactory' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'megafactory_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Megafactory 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function megafactory_excerpt_more( $link ) {
	return '';
}
add_filter( 'excerpt_more', 'megafactory_excerpt_more' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function megafactory_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'megafactory_pingback_header' );

/**
 * Admin Enqueue scripts and styles.
 */
function megafactory_enqueue_admin_script() { 

	wp_enqueue_style( 'megafactory-admin-style', get_theme_file_uri( '/admin/assets/css/admin-style.css' ), array(), '1.0' );
	
	// Meta Drag and Drop Script
	wp_enqueue_script( 'megafactory-admin-scripts', get_theme_file_uri( '/admin/assets/js/admin-scripts.js' ), array( 'jquery' ), '1.0', true ); 
	
	//Admin Localize Script
	wp_localize_script('megafactory-admin-scripts', 'megafactory_admin_ajax_var', array(
		'admin_ajax_url' => esc_url( admin_url('admin-ajax.php') ),
		'featured_nonce' => wp_create_nonce('megafactory-post-featured'), 
		'sidebar_nounce' => wp_create_nonce('megafactory-sidebar-featured'), 
		'redux_themeopt_import' => wp_create_nonce('megafactory-redux-import'),
		'unins_confirm' => esc_html__('Please backup your files and database before uninstall. Are you sure want to uninstall current demo?.', 'megafactory'),
		'yes' => esc_html__('Yes', 'megafactory'),
		'no' => esc_html__('No', 'megafactory'),
		'proceed' => esc_html__('Proceed', 'megafactory'),
		'cancel' => esc_html__('Cancel', 'megafactory'),
		'process' => esc_html__( 'Processing', 'megafactory' ),
		'uninstalling' => esc_html__('Uninstalling...', 'megafactory'),
		'uninstalled' => esc_html__('Uninstalled.', 'megafactory'),
		'unins_pbm' => esc_html__('Uninstall Problem!.', 'megafactory'),
		'downloading' => esc_html__('Downloading Demo Files...', 'megafactory'), 
		'import_xml' => esc_html__('Importing Xml...', 'megafactory'),
		'import_theme_opt' => esc_html__('Importing Theme Option...', 'megafactory'),
		'import_widg' => esc_html__('Importing Widgets...', 'megafactory'),
		'import_sidebars' => esc_html__('Importing Sidebars...', 'megafactory'),
		'import_revslider' => esc_html__('Importing Revolution Sliders...', 'megafactory'),
		'imported' => esc_html__('Successfully Imported, Check Above Message.', 'megafactory'),
		'import_pbm' => esc_html__('Import Problem.', 'megafactory'),
		'access_pbm' => esc_html__('File access permission problem.', 'megafactory')
	));
	
}
add_action( 'admin_enqueue_scripts', 'megafactory_enqueue_admin_script' );

/**
 * Enqueue scripts and styles.
 */
function megafactory_scripts() { 


	/*Visual Composer CSS*/
	if ( class_exists( 'Vc_Manager' ) ) {
		//wp_enqueue_script( 'wpb_composer_front_js' );
		wp_enqueue_style( 'js_composer_front' );
		wp_enqueue_style( 'js_composer_custom_css' );
	}

	/* Megafactory Theme Styles */

	// Megafactory Style Libraries
	
	$rto = new MegafactoryThemeOpt;
	$minify_js = $rto->megafactoryThemeOpt('js-minify');
	$minify_css = $rto->megafactoryThemeOpt('css-minify');
	
	if( $minify_js ){
		wp_enqueue_style( 'megafactory-min', get_theme_file_uri( '/assets/css/theme.min.css' ), array(), '1.0' );
	}else{
		wp_enqueue_style( 'bootstrap-beta', get_theme_file_uri( '/assets/css/bootstrap-beta.min.css' ), array(), '4.0.0' );
		wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/css/font-awesome.min.css' ), array(), '4.7.0' );
		wp_enqueue_style( 'simple-line-icons', get_theme_file_uri( '/assets/css/simple-line-icons.min.css' ), array(), '1.0' );
		wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/assets/css/owl-carousel.min.css' ), array(), '2.2.1' );
		wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/assets/css/magnific-popup.min.css' ), array(), '1.0' );
		wp_enqueue_style( 'media-element', get_theme_file_uri( '/assets/css/media-element.min.css' ), array(), '1.0' );
		wp_enqueue_style( 'image-hover', get_theme_file_uri( '/assets/css/image-hover.min.css' ), array(), '1.0' );
		wp_enqueue_style( 'ytplayer', get_theme_file_uri( '/assets/css/ytplayer.min.css' ), array(), '1.0' );
		wp_enqueue_style( 'animate', get_theme_file_uri( '/assets/css/animate.min.css' ), array(), '3.5.1' );
	}

	// Theme stylesheet.
	wp_enqueue_style( 'megafactory-style', get_template_directory_uri() . '/style.css', array(), '1.0' );
	
	// Shortcode Styles
	wp_enqueue_style( 'megafactory-shortcode', get_theme_file_uri( '/assets/css/shortcode.css' ), array(), '1.0' );

	
	/* Megafactory theme script files */
	
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
	
	// Megafactory JS Libraries
	if( $minify_css ){
		wp_enqueue_script( 'megafactory-theme-min', get_theme_file_uri( '/assets/js/theme.min.js' ), array( 'jquery' ), '1.0', true );
	}else{
		wp_enqueue_script( 'jquery-pooper', get_theme_file_uri( '/assets/js/jquery.pooper.min.js' ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'jquery-bootstrap-beta', get_theme_file_uri( '/assets/js/jquery.bootstrap.beta.min.js' ), array( 'jquery' ), '4.0.0', true );
		wp_enqueue_script( 'jquery-owl-carousel', get_theme_file_uri( '/assets/js/jquery.owl.carousel.min.js' ), array( 'jquery' ), '2.2.1', true );
		wp_enqueue_script( 'jquery-isotope', get_theme_file_uri( '/assets/js/jquery.isotope.pkgd.min.js' ), array( 'jquery' ), '3.0.3', true );
		wp_enqueue_script( 'jquery-infinitescroll', get_theme_file_uri( '/assets/js/jquery.infinitescroll.min.js' ), array( 'jquery' ), '2.0', true );
		wp_enqueue_script( 'jquery-imagesloaded', get_theme_file_uri( '/assets/js/jquery.imagesloaded.min.js' ), array( 'jquery' ), '4.1.1', true );
		wp_enqueue_script( 'jquery-stellar', get_theme_file_uri( '/assets/js/jquery.stellar.min.js' ), array( 'jquery' ), '0.6.2', true );
		wp_enqueue_script( 'jquery-sticky', get_theme_file_uri( '/assets/js/jquery.sticky.min.js' ), array( 'jquery' ), '1.1.3', true );
		wp_enqueue_script( 'jquery-YTPlayer', get_theme_file_uri( '/assets/js/jquery.YTPlayer.min.js' ), array( 'jquery' ), '1.0', true );	
		wp_enqueue_script( 'jquery-mediaelement', get_theme_file_uri( '/assets/js/jquery.mediaelement.min.js' ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'jquery-magnific', get_theme_file_uri( '/assets/js/jquery.magnific.popup.min.js' ), array( 'jquery' ), '1.1.0', true );
		wp_enqueue_script( 'jquery-easy-ticker', get_theme_file_uri( '/assets/js/jquery.easy.ticker.min.js' ), array( 'jquery' ), '2.0', true );
		wp_enqueue_script( 'jquery-easing', get_theme_file_uri( '/assets/js/jquery.easing.min.js' ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'jquery-countdown', get_theme_file_uri( '/assets/js/jquery.countdown.min.js' ), array( 'jquery' ), '2.2.0', true );
		wp_enqueue_script( 'jquery-circle-progress', get_theme_file_uri( '/assets/js/jquery.circle.progress.min.js' ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'jquery-appear', get_theme_file_uri( '/assets/js/jquery.appear.min.js' ), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'jquery-smoothscroll', get_theme_file_uri( '/assets/js/jquery.smoothscroll.min.js' ), array( 'jquery' ), '1.20.2', true );
	}
	
	// Theme Js
	wp_enqueue_script( 'megafactory-theme', get_theme_file_uri( '/assets/js/theme.js' ), array( 'jquery' ), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// Theme option stylesheet.
	$upload_dir = wp_upload_dir();
	$megafactory = wp_get_theme();
	$theme_style = $upload_dir['baseurl'] . '/megafactory/theme_'.get_current_blog_id().'.css';
	wp_enqueue_style( 'megafactory-theme-style', esc_url( $theme_style ), array(), $megafactory->get( 'Version' ) );
	
	$megafactory_option = get_option( 'megafactory_options' );
	
	//Google Map Script
	if( isset( $megafactory_option['google-api'] ) && $megafactory_option['google-api'] != '' ){
		wp_register_script( 'megafactory-gmaps', '//maps.googleapis.com/maps/api/js?key='. esc_attr( $megafactory_option['google-api'] ) , array('jquery'), null, true );
	}
		
	$infinite_image = isset( $megafactory_option['infinite-loader-img']['url'] ) && $megafactory_option['infinite-loader-img']['url'] != '' ? $megafactory_option['infinite-loader-img']['url'] : get_theme_file_uri( '/assets/images/infinite-loder.gif' );
	
	//Localize Script
	wp_localize_script('megafactory-theme', 'megafactory_ajax_var', array(
		'admin_ajax_url' => esc_url( admin_url('admin-ajax.php') ),
		'like_nonce' => wp_create_nonce('megafactory-post-like'), 
		'fav_nonce' => wp_create_nonce('megafactory-post-fav'),
		'infinite_loader' => $infinite_image,
		'load_posts' => apply_filters( 'infinite_load_msg', esc_html__( 'Loading next set of posts.', 'megafactory' ) ),
		'no_posts' => apply_filters( 'infinite_finished_msg', esc_html__( 'No more posts to load.', 'megafactory' ) ),
		'cmt_nonce' => wp_create_nonce('megafactory-comment-like'),
		'mc_nounce' => wp_create_nonce('megafactory-mailchimp'), 
		'wait' => esc_html__('Wait..', 'megafactory'),
		'must_fill' => esc_html__('Must Fill Required Details.', 'megafactory'),
		'valid_email' => esc_html__('Enter Valid Email ID.', 'megafactory'),
		'cart_update_pbm' => esc_html__('Cart Update Problem.', 'megafactory')		
	));
	
}
add_action( 'wp_enqueue_scripts', 'megafactory_scripts' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/*Theme Code*/
/*Search Form Filter*/
if( ! function_exists('megafactory_zozo_search_form') ) {
	function megafactory_zozo_search_form( $form ) {
		
		$search_out = '
		<form method="get" class="search-form" action="'. esc_url( home_url( '/' ) ) .'">
			<div class="input-group">
				<input type="text" class="form-control" name="s" value="'. get_search_query() .'" placeholder="'. esc_html__('Search for...', 'megafactory') .'">
				<span class="input-group-btn">
					<button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>';
		return $search_out;
	}
	add_filter( 'get_search_form', 'megafactory_zozo_search_form' );
}

$aps = new MegafactoryPostSettings;
add_action( 'wp_ajax_post_like_act', array( &$aps, 'megafactoryMetaLikeCheck' ) );
add_action( 'wp_ajax_nopriv_post_like_act', array( &$aps, 'megafactoryMetaLikeCheck' ) ); 
add_action( 'wp_ajax_post_fav_act', array( &$aps, 'megafactoryMetaFavouriteCheck' ) );
add_action( 'wp_ajax_nopriv_post_fav_act', array( &$aps, 'megafactoryMetaFavouriteCheck' ) );

if( $aps->megafactoryGetThemeOpt( 'comments-like' ) ){
	add_action('wp_ajax_nopriv_comment_like', array( &$aps, 'megafactoryCommentsLike' ) );
	add_action('wp_ajax_comment_like', array( &$aps, 'megafactoryCommentsLike' ) );
}

if( ! function_exists('megafactoryPostComments') ) {
	function megafactoryPostComments( $comment, $args, $depth ) {
	
		$GLOBALS['comment'] = $comment;
		
		$aps = new MegafactoryPostSettings;		
		
		$allowed_html = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			)
		);
		
		?>
		<li <?php comment_class('clearfix'); ?> id="comment-<?php comment_ID() ?>">
			
			<div class="media thecomment">
						
				<div class="media-left author-img">
					<?php echo get_avatar($comment,$args['avatar_size']); ?>
				</div>
				
				<div class="media-body comment-text">
					<p class="comment-meta">
					<?php if( $depth < $args['max_depth'] ) : ?>
					<span class="reply pull-right">
						<?php comment_reply_link( array_merge( $args, array('reply_text' => '<i class="icon-action-undo"></i> ' . esc_html__('Reply', 'megafactory'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID ); ?>
					</span>
					<?php endif; ?>
					<span class="author"><?php echo get_comment_author_link(); ?></span>
					<span class="date"><?php printf( wp_kses( __( '%1$s at %2$s', 'megafactory' ), $allowed_html ), get_comment_date(),  get_comment_time()) ?></span>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><i class="icon-info-sign"></i> <?php esc_html_e( 'Comment awaiting approval', 'megafactory' ); ?></em>
						<br />
					<?php endif; ?>
					</p>
					<?php comment_text(); ?>
					<!-- Custom Comments Meta -->
					<?php if( $aps->megafactoryGetThemeOpt( 'comments-like' ) || $aps->megafactoryGetThemeOpt( 'comments-share' ) ) : ?>
						<div class="comment-meta-wrapper clearfix">
							<ul class="list-inline">
								<?php if( $aps->megafactoryGetThemeOpt( 'comments-like' ) ) : ?>
								<li class="comment-like-wrapper"><?php echo do_shortcode( $aps->megafactoryCommentLikeOut( $comment->comment_ID ) ); ?></li>
								<?php endif; ?>
								<?php if( $aps->megafactoryGetThemeOpt( 'comments-social-shares' )) : ?>
								<li class="comment-share-wrapper pull-right"><?php echo do_shortcode( $aps->megafactoryCommentShare( $comment->comment_ID ) ); ?></li>
								<?php endif; ?>
							</ul>
						</div>
					<?php endif; // if comment meta need ?>
				</div>
						
			</div>
			
			
		</li>
		<?php
		
	} 
}
