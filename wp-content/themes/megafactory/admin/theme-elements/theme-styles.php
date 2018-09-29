<?php

if( !class_exists( "MegafactoryThemeStyles" ) ){
	require_once MEGAFACTORY_INC . '/theme-class/theme-style-class.php';
}
$ats = new MegafactoryThemeStyles;

echo "
/*
 * Megafactory theme custom style
 */\n\n";
$megafactory_options = get_option( 'megafactory_options' );

echo "\n/* General Styles */\n";

$ats->megafactory_custom_font_check( 'body-typography' );
echo 'body{';
	$ats->megafactory_typo_generate( 'body-typography' );
	$ats->megafactory_bg_settings( 'body-background' );
echo '
}';
$ats->megafactory_custom_font_check( 'h1-typography' );
echo 'h1{';
	$ats->megafactory_typo_generate( 'h1-typography' );
echo '
}';
$ats->megafactory_custom_font_check( 'h2-typography' );
echo 'h2{';
	$ats->megafactory_typo_generate( 'h2-typography' );
echo '
}';
$ats->megafactory_custom_font_check( 'h3-typography' );
echo 'h3{';
	$ats->megafactory_typo_generate( 'h3-typography' );
echo '
}';
$ats->megafactory_custom_font_check( 'h4-typography' );
echo 'h4{';
	$ats->megafactory_typo_generate( 'h4-typography' );
echo '
}';
$ats->megafactory_custom_font_check( 'h5-typography' );
echo 'h5{';
	$ats->megafactory_typo_generate( 'h5-typography' );
echo '
}';
$ats->megafactory_custom_font_check( 'h6-typography' );
echo 'h6{';
	$ats->megafactory_typo_generate( 'h6-typography' );
echo '
}';

$gen_link = $ats->megafactory_theme_opt('theme-link-color');
if( $gen_link ):
echo 'a{';
	$ats->megafactory_link_color( 'theme-link-color', 'regular' );
echo '
}';
echo 'a:hover{';
	$ats->megafactory_link_color( 'theme-link-color', 'hover' );
echo '
}';
echo 'a:active{';
	$ats->megafactory_link_color( 'theme-link-color', 'active' );
echo '
}';
endif;

echo "\n/* Widget Typography Styles */\n";

$ats->megafactory_custom_font_check( 'widgets-content' );
echo '.widget{';
	$ats->megafactory_typo_generate( 'widgets-content' );
echo '
}';
$ats->megafactory_custom_font_check( 'widgets-title' );
echo '.widget .widget-title{';
	$ats->megafactory_typo_generate( 'widgets-title' );
echo '
}';


$page_loader = $ats->megafactory_theme_opt('page-loader') && $ats->megafactory_theme_opt('page-loader-img') != '' ? $megafactory_options['page-loader-img']['url'] : '';
if( $page_loader ):
	echo ".page-loader {background: url('". esc_url( $page_loader ). "') 50% 50% no-repeat rgb(249,249,249);}";
endif;

echo '.container, .boxed-container, .boxed-container .site-footer.footer-fixed {
	width: '. $ats->megafactory_container_width() .';
}';
echo '.megafactory-content > .megafactory-content-inner{';
	$ats->megafactory_padding_settings( 'page-content-padding' );
echo '
}';

echo "\n/* Header Styles */\n";
echo 'header.megafactory-header {';
	$ats->megafactory_bg_settings('header-background');
echo '}';

echo "\n/* Topbar Styles */\n";
$ats->megafactory_custom_font_check( 'header-topbar-typography' );
echo '.topbar{';
	$ats->megafactory_typo_generate( 'header-topbar-typography' );
	$ats->megafactory_bg_rgba( 'header-topbar-background' );
	$ats->megafactory_border_settings( 'header-topbar-border' );
	$ats->megafactory_padding_settings( 'header-topbar-padding' );
echo '
}';

echo '.topbar a{';
	$ats->megafactory_link_color( 'header-topbar-link-color', 'regular' );
echo '
}';
echo '.topbar a:hover{';
	$ats->megafactory_link_color( 'header-topbar-link-color', 'hover' );
echo '
}';
echo '.topbar a:active,.topbar a:focus {';
	$ats->megafactory_link_color( 'header-topbar-link-color', 'active' );
echo '
}';


echo '
.topbar-items > li{
    height: '. esc_attr( $ats->megafactory_dimension_height('header-topbar-height') ) .' ;
    line-height: '. esc_attr( $ats->megafactory_dimension_height('header-topbar-height') ) .' ;
}
.header-sticky .topbar-items > li,
.sticky-scroll.show-menu .topbar-items > li{
	height: '. esc_attr( $ats->megafactory_dimension_height('header-topbar-sticky-height') ) .' ;
    line-height: '. esc_attr( $ats->megafactory_dimension_height('header-topbar-sticky-height') ) .' ;
}';

echo '
.topbar-items > li img{
	max-height: '. esc_attr(  $ats->megafactory_dimension_height('header-topbar-height') ) .' ;
}';

echo "\n/* Logobar Styles */\n";
$ats->megafactory_custom_font_check( 'header-logobar-typography' );
echo '.logobar{';
	$ats->megafactory_typo_generate( 'header-logobar-typography' );
	$ats->megafactory_bg_rgba( 'header-logobar-background' );
	$ats->megafactory_border_settings( 'header-logobar-border' );
	$ats->megafactory_padding_settings( 'header-logobar-padding' );
echo '
}';

echo '.logobar a{';
	$ats->megafactory_link_color( 'header-logobar-link-color', 'regular' );
echo '
}';
echo '.logobar a:hover{';
	$ats->megafactory_link_color( 'header-logobar-link-color', 'hover' );
echo '
}';
echo '.logobar a:active,
.logobar a:focus, .logobar .megafactory-main-menu > li.current-menu-item > a, .logobar .megafactory-main-menu > li.current-menu-ancestor > a, .logobar a.active {';
	$ats->megafactory_link_color( 'header-logobar-link-color', 'active' );
echo '
}';

echo '
.logobar-items > li{
    height: '. esc_attr( $ats->megafactory_dimension_height('header-logobar-height') ) .' ;
    line-height: '. esc_attr( $ats->megafactory_dimension_height('header-logobar-height') ) .' ;
}
.header-sticky .logobar-items > li,
.sticky-scroll.show-menu .logobar-items > li{
	height: '. esc_attr( $ats->megafactory_dimension_height('header-logobar-sticky-height') ) .' ;
    line-height: '. esc_attr( $ats->megafactory_dimension_height('header-logobar-sticky-height') ) .' ;
}';

echo '
.logobar-items > li img{
	max-height: '. esc_attr( $ats->megafactory_dimension_height('header-logobar-height') ) .' ;
}';

echo "\n/* Logobar Sticky Styles */\n";
$color = $ats->megafactory_theme_opt('sticky-header-logobar-color');
echo '.header-sticky .logobar, .sticky-scroll.show-menu .logobar{
	'. ( $color != '' ? 'color: '. $color .';' : '' );
	$ats->megafactory_bg_rgba( 'sticky-header-logobar-background' );
	$ats->megafactory_border_settings( 'sticky-header-logobar-border' );
	$ats->megafactory_padding_settings( 'sticky-header-logobar-padding' );
echo '
}';

echo '.header-sticky .logobar a, .sticky-scroll.show-menu .logobar a{';
	$ats->megafactory_link_color( 'sticky-header-logobar-link-color', 'regular' );
echo '
}';
echo '.header-sticky .logobar a:hover, .sticky-scroll.show-menu .logobar a:hover{';
	$ats->megafactory_link_color( 'sticky-header-logobar-link-color', 'hover' );
echo '
}';
echo '.header-sticky .logobar a:active, .sticky-scroll.show-menu .logobar a:active,
.header-sticky .logobar .megafactory-main-menu .current-menu-item > a, .header-sticky .logobar .megafactory-main-menu .current-menu-ancestor > a,
.sticky-scroll.show-menu .logobar .megafactory-main-menu .current-menu-item > a, .sticky-scroll.show-menu .logobar .megafactory-main-menu .current-menu-ancestor > a ,
.header-sticky .logobar a.active, .sticky-scroll.show-menu .logobar a.active{';
	$ats->megafactory_link_color( 'sticky-header-logobar-link-color', 'active' );
echo '
}';
echo '
.header-sticky .logobar img.custom-logo, .sticky-scroll.show-menu .logobar img.custom-logo{
	max-height: '. esc_attr( $ats->megafactory_dimension_height('header-logobar-sticky-height') ) .' ;
}';

echo "\n/* Navbar Styles */\n";
$ats->megafactory_custom_font_check( 'header-navbar-typography' );
echo '.navbar{';
	$ats->megafactory_typo_generate( 'header-navbar-typography' );
	$ats->megafactory_bg_rgba( 'header-navbar-background' );
	$ats->megafactory_border_settings( 'header-navbar-border' );
	$ats->megafactory_padding_settings( 'header-navbar-padding' );
echo '
}';

echo '.navbar a{';
	$ats->megafactory_link_color( 'header-navbar-link-color', 'regular' );
echo '
}';
echo '.navbar a:hover{';
	$ats->megafactory_link_color( 'header-navbar-link-color', 'hover' );
echo '
}';
echo '.navbar a:active,.navbar a:focus, .navbar .megafactory-main-menu > li.current-menu-item > a, .navbar .megafactory-main-menu > li.current-menu-ancestor > a, .navbar a.active {';
	$ats->megafactory_link_color( 'header-navbar-link-color', 'active' );
echo '
}';

$color = $ats->megafactory_theme_opt( 'header-navbar-typography' );
$color = isset( $color['color'] ) && $color['color'] != '' ? $color['color'] : '';
$scolor = $ats->megafactory_theme_opt( 'sticky-header-navbar-color' );
if( $color ):
echo '.navbar .secondary-space-toggle > span{
	background-color: '. esc_attr( $color ) .';
}';
endif;
if( $scolor ):
echo '.header-sticky .navbar .secondary-space-toggle > span,
.sticky-scroll.show-menu .navbar .secondary-space-toggle > span{
	background-color: '. esc_attr( $scolor ) .';
}';
endif;

echo '
.navbar-items > li{
    height: '. esc_attr( $ats->megafactory_dimension_height('header-navbar-height') ) .' ;
    line-height: '. esc_attr( $ats->megafactory_dimension_height('header-navbar-height') ) .' ;
}
.header-sticky .navbar-items > li,
.sticky-scroll.show-menu .navbar-items > li{
	height: '. esc_attr( $ats->megafactory_dimension_height('header-navbar-sticky-height') ) .' ;
    line-height: '. esc_attr( $ats->megafactory_dimension_height('header-navbar-sticky-height') ) .' ;
}';

echo '
.navbar-items > li img{
	max-height: '. esc_attr( $ats->megafactory_dimension_height('header-navbar-height') ) .' ;
}';

echo "\n/* Navbar Sticky Styles */\n";
$color = $ats->megafactory_theme_opt('sticky-header-navbar-color');
echo '.header-sticky .navbar, .sticky-scroll.show-menu .navbar{
	'. ( $color != '' ? 'color: '. $color .';' : '' );
	$ats->megafactory_bg_rgba( 'sticky-header-navbar-background' );
	$ats->megafactory_border_settings( 'sticky-header-navbar-border' );
	$ats->megafactory_padding_settings( 'sticky-header-navbar-padding' );
echo '
}';

echo '.header-sticky .navbar a, .sticky-scroll.show-menu .navbar a {';
	$ats->megafactory_link_color( 'sticky-header-navbar-link-color', 'regular' );
echo '
}';
echo '.header-sticky .navbar a:hover, .sticky-scroll.show-menu .navbar a:hover {';
	$ats->megafactory_link_color( 'sticky-header-navbar-link-color', 'hover' );
echo '
}';
echo '.header-sticky .navbar a:active, .sticky-scroll.show-menu .navbar a:active,
.header-sticky .navbar .megafactory-main-menu .current-menu-item > a, .header-sticky .navbar .megafactory-main-menu .current-menu-ancestor > a,
.sticky-scroll.show-menu .navbar .megafactory-main-menu .current-menu-item > a, .sticky-scroll.show-menu .navbar .megafactory-main-menu .current-menu-ancestor > a,
.header-sticky .navbar a.active, .sticky-scroll.show-menu .navbar a.active {';
	$ats->megafactory_link_color( 'sticky-header-navbar-link-color', 'active' );
echo '
}';
echo '
.header-sticky .navbar img.custom-logo, .sticky-scroll.show-menu .navbar img.custom-logo{
	max-height: '. esc_attr( $ats->megafactory_dimension_height('header-navbar-sticky-height') ) .' ;
}';

echo "\n/* Secondary Menu Space Styles */\n";

$sec_menu_type = $ats->megafactory_theme_opt('secondary-menu-type');
$ats->megafactory_custom_font_check( 'secondary-space-typography' );
echo '.secondary-menu-area {';
	echo 'width: '. esc_attr( $ats->megafactory_dimension_width('secondary-menu-space-width') ) .' ;';
echo '}';
echo '.secondary-menu-area, .secondary-menu-area .widget {';
	$ats->megafactory_border_settings( 'secondary-space-border' );
	$ats->megafactory_typo_generate( 'secondary-space-typography' );
	$ats->megafactory_bg_settings('secondary-space-background');
	if( $sec_menu_type == 'left-overlay' || $sec_menu_type == 'left-push' ){
		echo 'left: -' . esc_attr( $ats->megafactory_dimension_width('secondary-menu-space-width') ) . ';';
	}elseif( $sec_menu_type == 'right-overlay' || $sec_menu_type == 'right-push' ){
		echo 'right: -' . esc_attr( $ats->megafactory_dimension_width('secondary-menu-space-width') ) . ';';
	}
echo '
}';
echo '.secondary-menu-area.left-overlay, .secondary-menu-area.left-push{';
	if( $sec_menu_type == 'left-overlay' || $sec_menu_type == 'left-push' ){
		echo 'left: -' . esc_attr( $ats->megafactory_dimension_width('secondary-menu-space-width') ) . ';';
	}
echo '
}';
echo '.secondary-menu-area.right-overlay, .secondary-menu-area.right-push{';
	if( $sec_menu_type == 'right-overlay' || $sec_menu_type == 'right-push' ){
		echo 'right: -' . esc_attr( $ats->megafactory_dimension_width('secondary-menu-space-width') ) . ';';
	}
echo '
}';
echo '.secondary-menu-area .secondary-menu-area-inner{';
	$ats->megafactory_padding_settings( 'secondary-space-padding' );
echo '
}';
echo '.secondary-menu-area a{';
	$ats->megafactory_link_color( 'secondary-space-link-color', 'regular' );
echo '
}';
echo '.secondary-menu-area a:hover{';
	$ats->megafactory_link_color( 'secondary-space-link-color', 'hover' );
echo '
}';
echo '.secondary-menu-area a:active{';
	$ats->megafactory_link_color( 'secondary-space-link-color', 'active' );
echo '
}';

echo "\n/* Sticky Header Styles */\n";

if( $ats->megafactory_theme_opt('header-type') != 'default' ):
$sticky_width = $ats->megafactory_dimension_width('header-fixed-width');
echo '.sticky-header-space{
	width: '. esc_attr( $sticky_width ) .';
}';
	if( $ats->megafactory_theme_opt('header-type') == 'left-sticky' ):
	echo 'body, .top-sliding-bar{
		padding-left: '. esc_attr( $sticky_width ) .';
	}';
	else:
	echo 'body, .top-sliding-bar{
		padding-right: '. esc_attr( $sticky_width ) .';
	}';
	endif;
endif;
$ats->megafactory_custom_font_check( 'header-fixed-typography' );
echo '.sticky-header-space{';
	$ats->megafactory_typo_generate( 'header-fixed-typography' );
	$ats->megafactory_bg_settings( 'header-fixed-background' );
	$ats->megafactory_border_settings( 'header-fixed-border' );
	$ats->megafactory_padding_settings( 'header-fixed-padding' );
echo '
}';
echo '.sticky-header-space li a{';
	$ats->megafactory_link_color( 'header-fixed-link-color', 'regular' );
echo '
}';
echo '.sticky-header-space li a:hover{';
	$ats->megafactory_link_color( 'header-fixed-link-color', 'hover' );
echo '
}';
echo '.sticky-header-space li a:active{';
	$ats->megafactory_link_color( 'header-fixed-link-color', 'active' );
echo '
}';

echo "\n/* Mobile Header Styles */\n";
echo '
.mobile-header-items > li{
    height: '. esc_attr( $ats->megafactory_dimension_height('mobile-header-height') ) .' ;
    line-height: '. esc_attr( $ats->megafactory_dimension_height('mobile-header-height') ) .' ;
}
.mobile-header .mobile-header-inner ul > li img {
	max-height: '. esc_attr( $ats->megafactory_dimension_height('mobile-header-height') ) .' ;
}
.mobile-header{';
	$ats->megafactory_bg_rgba('mobile-header-background');
echo '
}';
echo '.mobile-header-items li a{';
	$ats->megafactory_link_color( 'mobile-header-link-color', 'regular' );
echo '
}';
echo '.mobile-header-items li a:hover{';
	$ats->megafactory_link_color( 'mobile-header-link-color', 'hover' );
echo '
}';
echo '.mobile-header-items li a:active{';
	$ats->megafactory_link_color( 'mobile-header-link-color', 'active' );
echo '
}';
echo '
.header-sticky .mobile-header-items > li, .show-menu .mobile-header-items > li{
    height: '. esc_attr( $ats->megafactory_dimension_height('mobile-header-sticky-height') ) .' ;
    line-height: '. esc_attr( $ats->megafactory_dimension_height('mobile-header-sticky-height') ) .' ;
}
.header-sticky .mobile-header-items > li .mobile-logo img, .show-menu .mobile-header-items > li .mobile-logo img{
	max-height: '. esc_attr( $ats->megafactory_dimension_height('mobile-header-sticky-height') ) .' ;
}
.mobile-header .header-sticky, .mobile-header .show-menu{';
	$ats->megafactory_bg_rgba('mobile-header-sticky-background');
echo '}';
echo '.header-sticky .mobile-header-items li a, .show-menu .mobile-header-items li a{';
	$ats->megafactory_link_color( 'mobile-header-sticky-link-color', 'regular' );
echo '
}';
echo '.header-sticky .mobile-header-items li a:hover, .show-menu .mobile-header-items li a:hover{';
	$ats->megafactory_link_color( 'mobile-header-sticky-link-color', 'hover' );
echo '
}';
echo '.header-sticky .mobile-header-items li a:hover, .show-menu .mobile-header-items li a:hover{';
	$ats->megafactory_link_color( 'mobile-header-sticky-link-color', 'active' );
echo '
}';
$mm_max = $ats->megafactory_dimension_width( 'mobile-menu-max-width' );
if( $mm_max ):
echo '.mobile-bar, .mobile-bar .container{
	max-width: '. $mm_max .';
}';
endif;

echo "\n/* Mobile Bar Styles */\n";
$ats->megafactory_custom_font_check( 'mobile-menu-typography' );
echo '.mobile-bar{';
	$ats->megafactory_typo_generate( 'mobile-menu-typography' );
	$ats->megafactory_bg_settings( 'mobile-menu-background' );
	$ats->megafactory_border_settings( 'mobile-menu-border' );
	$ats->megafactory_padding_settings( 'mobile-menu-padding' );
echo '
}';
echo '.mobile-bar li a{';
	$ats->megafactory_link_color( 'mobile-menu-link-color', 'regular' );
echo '
}';
echo '.mobile-bar li a:hover{';
	$ats->megafactory_link_color( 'mobile-menu-link-color', 'hover' );
echo '
}';
echo '.mobile-bar li a:active, ul > li.current-menu-item > a, 
ul > li.current-menu-parent > a, ul > li.current-menu-ancestor > a{';
	$ats->megafactory_link_color( 'mobile-menu-link-color', 'active' );
echo '
}';

echo "\n/* Top Sliding Bar Styles */\n";
$ats->megafactory_custom_font_check( 'top-sliding-typography' );
if( $ats->megafactory_theme_opt( 'header-top-sliding-switch' ) ):
echo '.top-sliding-bar-inner{';
	$ats->megafactory_typo_generate( 'top-sliding-typography' );
	$ats->megafactory_bg_rgba( 'top-sliding-background' );
	$ats->megafactory_border_settings( 'top-sliding-border' );
	$ats->megafactory_padding_settings( 'top-sliding-padding' );
echo '
}';
$ts_bg = $ats->megafactory_theme_opt( 'top-sliding-background' );
echo '.top-sliding-toggle{
	'. ( $ts_bg != '' ? 'border-top-color: '. $ts_bg['rgba'] . ';' : '' ) .'
}';
echo '.top-sliding-bar-inner li a{';
	$ats->megafactory_link_color( 'top-sliding-link-color', 'regular' );
echo '
}';
echo '.top-sliding-bar-inner li a:hover{';
	$ats->megafactory_link_color( 'top-sliding-link-color', 'hover' );
echo '
}';
echo '.top-sliding-bar-inner li a:active{';
	$ats->megafactory_link_color( 'top-sliding-link-color', 'active' );
echo '
}';
endif;

echo "\n/* General Menu Styles */\n";
echo '.menu-tag-hot{
	background-color: '. $ats->megafactory_theme_opt( 'menu-tag-hot-bg' ) .';
}';
echo '.menu-tag-new{
	background-color: '. $ats->megafactory_theme_opt( 'menu-tag-new-bg' ) .';
}';
echo '.menu-tag-trend{
	background-color: '. $ats->megafactory_theme_opt( 'menu-tag-trend-bg' ) .';
}';

echo "\n/* Main Menu Styles */\n";
$ats->megafactory_custom_font_check( 'main-menu-typography' );
echo 'ul.megafactory-main-menu > li > a,
ul.megafactory-main-menu > li > .main-logo{';
	$ats->megafactory_typo_generate( 'main-menu-typography' );
echo '
}';

echo "\n/* Dropdown Menu Styles */\n";
echo 'ul.dropdown-menu{';
	$ats->megafactory_bg_rgba( 'dropdown-menu-background' );
	$ats->megafactory_border_settings( 'dropdown-menu-border' );
echo '
}';

$ats->megafactory_custom_font_check( 'dropdown-menu-typography' );
echo 'ul.dropdown-menu > li{';
	$ats->megafactory_typo_generate( 'dropdown-menu-typography' );
echo '
}';

echo 'ul.dropdown-menu > li a,
ul.mega-child-dropdown-menu > li a,
.header-sticky ul.dropdown-menu > li a, .sticky-scroll.show-menu ul.dropdown-menu > li a,
.header-sticky ul.mega-child-dropdown-menu > li a, .sticky-scroll.show-menu ul.mega-child-dropdown-menu > li a {';
	$ats->megafactory_link_color( 'dropdown-menu-link-color', 'regular' );
echo '
}';

echo 'ul.dropdown-menu > li a:hover,
ul.mega-child-dropdown-menu > li a:hover,
.header-sticky ul.dropdown-menu > li a:hover, .sticky-scroll.show-menu ul.dropdown-menu > li a:hover,
.header-sticky ul.mega-child-dropdown-menu > li a:hover, .sticky-scroll.show-menu ul.mega-child-dropdown-menu > li a:hover {';
	$ats->megafactory_link_color( 'dropdown-menu-link-color', 'hover' );
echo '
}';

echo 'ul.dropdown-menu > li a:active,
ul.mega-child-dropdown-menu > li a:active,
.header-sticky ul.dropdown-menu > li a:active, .sticky-scroll.show-menu ul.dropdown-menu > li a:active,
.header-sticky ul.mega-child-dropdown-menu > li a:active, .sticky-scroll.show-menu ul.mega-child-dropdown-menu > li a:active,
ul.dropdown-menu > li.current-menu-item > a, ul.dropdown-menu > li.current-menu-parent > a, ul.dropdown-menu > li.current-menu-ancestor > a,
ul.mega-child-dropdown-menu > li.current-menu-item > a {';
	$ats->megafactory_link_color( 'dropdown-menu-link-color', 'active' );
echo '
}';

/* Template Page Title Styles */
echo "\n/* Template Page Title Styles */\n";
megafactoryPostTitileStyle( 'single-post' );
megafactoryPostTitileStyle( 'blog' );
megafactoryPostTitileStyle( 'page' );
$actived_tmplt = $ats->megafactory_theme_opt('theme-templates');
if( !empty( $actived_tmplt ) && is_array( $actived_tmplt ) ){
	foreach( $actived_tmplt as $template ){
		megafactoryPostTitileStyle( $template );
	}
}
$actived_cat_tmplt = $ats->megafactory_theme_opt('theme-categories');
if( !empty( $actived_cat_tmplt ) && is_array( $actived_cat_tmplt ) ){
	foreach( $actived_cat_tmplt as $template ){
		megafactoryPostTitileStyle( $template );
	}
}

function megafactoryPostTitileStyle( $field ){
	$ats = new MegafactoryThemeStyles; 
	echo '.megafactory-'. $field .' .page-title-wrap-inner{
		color: '. $ats->megafactory_theme_opt( 'template-'. $field .'-color' ) .';';
		$ats->megafactory_bg_settings( 'template-'. $field .'-background-all' );
		$ats->megafactory_border_settings( 'template-'. $field .'-border' );
		$ats->megafactory_padding_settings( 'template-'. $field .'-padding' );
	echo '
	}';
	echo '.megafactory-'. $field .' .page-title-wrap a{';
		$ats->megafactory_link_color( 'template-'. $field .'-link-color', 'regular' );
	echo '
	}';
	echo '.megafactory-'. $field .' .page-title-wrap a:hover{';
		$ats->megafactory_link_color( 'template-'. $field .'-link-color', 'hover' );
	echo '
	}';
	echo '.megafactory-'. $field .' .page-title-wrap a:active{';
		$ats->megafactory_link_color( 'template-'. $field .'-link-color', 'active' );
	echo '
	}';
	echo '.megafactory-'. $field .' .page-title-wrap-inner > .page-title-overlay{';
		$ats->megafactory_bg_rgba( $field .'-page-title-overlay' );
	echo '
	}';
}

/* Template Article Styles */
echo "\n/* Template Article Styles */\n";
megafactoryPostArticleStyle( 'single-post' );
megafactoryPostArticleStyle( 'blog' );
$actived_tmplt = $ats->megafactory_theme_opt('theme-templates');
if( !empty( $actived_tmplt ) && is_array( $actived_tmplt ) ){
	foreach( $actived_tmplt as $template ){
		megafactoryPostArticleStyle( $template );
	}
}
$actived_cat_tmplt = $ats->megafactory_theme_opt('theme-categories');
if( !empty( $actived_cat_tmplt ) && is_array( $actived_cat_tmplt ) ){
	foreach( $actived_cat_tmplt as $template ){
		megafactoryPostArticleStyle( $template );
	}
}

function megafactoryPostArticleStyle( $field ){
	$ats = new MegafactoryThemeStyles; 
	echo '.'. $field .'-template article.post{
		color: '. $ats->megafactory_theme_opt( $field .'-article-color' ) .';';
		$ats->megafactory_bg_rgba( $field .'-article-background' );
		$ats->megafactory_border_settings( $field .'-article-border' );
		$ats->megafactory_padding_settings( $field .'-article-padding' );
	echo '
	}';
	echo '.'. $field .'-template article.post a{';
		$ats->megafactory_link_color( $field .'-article-link-color', 'regular' );
	echo '
	}';
	echo '.'. $field .'-template article.post a:hover{';
		$ats->megafactory_link_color( $field .'-article-link-color', 'hover' );
	echo '
	}';
	echo '.'. $field .'-template article.post a:active{';
		$ats->megafactory_link_color( $field .'-article-link-color', 'active' );
	echo '
	}';
	$post_thumb_margin = $ats->megafactory_theme_opt( $field .'-article-padding' );
	if( $post_thumb_margin ):
		echo '.'. $field .'-template .post-format-wrap{
			'. ( isset( $post_thumb_margin['padding-left'] ) && $post_thumb_margin['padding-left'] != '' ? 'margin-left: -' . $post_thumb_margin['padding-left'] .';' : '' ) .'
			'. ( isset( $post_thumb_margin['padding-right'] ) && $post_thumb_margin['padding-right'] != '' ? 'margin-right: -' . $post_thumb_margin['padding-right'] .';' : '' ) .'
		}';
		echo '.'. $field .'-template .post-quote-wrap > .blockquote, .'. $field .'-template .post-link-inner, .'. $field .'-template .post-format-wrap .post-audio-wrap{
			'. ( isset( $post_thumb_margin['padding-left'] ) && $post_thumb_margin['padding-left'] != '' ? 'padding-left: ' . $post_thumb_margin['padding-left'] .';' : '' ) .'
			'. ( isset( $post_thumb_margin['padding-right'] ) && $post_thumb_margin['padding-right'] != '' ? 'padding-right: ' . $post_thumb_margin['padding-right'] .';' : '' ) .'
		}';
	endif;
}

$theme_color = $ats->megafactoryThemeColor();
echo "\n/* Blockquote / Audio / Link Styles */\n";
echo '.post-quote-wrap > .blockquote{
	border-left-color: '. esc_attr( $theme_color ) .';
}';

$rgba_08 = $ats->megafactory_hex2rgba( $theme_color, '0.8' );



// Single Post Blockquote
$blockquote_bg_opt = $ats->megafactory_theme_opt( 'single-post-quote-format' );
megafactoryQuoteDynamicStyle( 'single-post', $blockquote_bg_opt, $theme_color, $rgba_08 );

// Blog Blockquote
$blockquote_bg_opt = $ats->megafactory_theme_opt( 'blog-quote-format' );
megafactoryQuoteDynamicStyle( 'blog', $blockquote_bg_opt, $theme_color, $rgba_08 );

// Archive Blockquote
$blockquote_bg_opt = $ats->megafactory_theme_opt( 'archive-quote-format' );
megafactoryQuoteDynamicStyle( 'archive', $blockquote_bg_opt, $theme_color, $rgba_08 );

// Tag Blockquote
$blockquote_bg_opt = $ats->megafactory_theme_opt( 'tag-quote-format' );
megafactoryQuoteDynamicStyle( 'tag', $blockquote_bg_opt, $theme_color, $rgba_08 );

// Search Blockquote
$blockquote_bg_opt = $ats->megafactory_theme_opt( 'search-quote-format' );
megafactoryQuoteDynamicStyle( 'search', $blockquote_bg_opt, $theme_color, $rgba_08 );

// Author Blockquote
$blockquote_bg_opt = $ats->megafactory_theme_opt( 'author-quote-format' );
megafactoryQuoteDynamicStyle( 'author', $blockquote_bg_opt, $theme_color, $rgba_08 );

// Category Blockquote
$blockquote_bg_opt = $ats->megafactory_theme_opt( 'category-quote-format' );
megafactoryQuoteDynamicStyle( 'category', $blockquote_bg_opt, $theme_color, $rgba_08 );

// All Category Blockquote
$actived_cat_tmplt = $ats->megafactory_theme_opt('theme-categories');
if( !empty( $actived_cat_tmplt ) && is_array( $actived_cat_tmplt ) ){
	foreach( $actived_cat_tmplt as $template ){
		$blockquote_bg_opt = $ats->megafactory_theme_opt( $template.'-quote-format' );
		megafactoryQuoteDynamicStyle( $template, $blockquote_bg_opt, $theme_color, $rgba_08 );
	}
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

/* Single Post Link */
$link_bg_opt = $ats->megafactory_theme_opt( 'single-post-link-format' );
megafactoryLinkDynamicStyle( 'single-post', $link_bg_opt, $theme_color, $rgba_08 );

/* Blog Link */
$link_bg_opt = $ats->megafactory_theme_opt( 'blog-link-format' );
megafactoryLinkDynamicStyle( 'blog', $link_bg_opt, $theme_color, $rgba_08 );

/* Archive Link */
$link_bg_opt = $ats->megafactory_theme_opt( 'archive-link-format' );
megafactoryLinkDynamicStyle( 'archive', $link_bg_opt, $theme_color, $rgba_08 );

/* Tag Link */
$link_bg_opt = $ats->megafactory_theme_opt( 'tag-link-format' );
megafactoryLinkDynamicStyle( 'tag', $link_bg_opt, $theme_color, $rgba_08 );

/* Author Link */
$link_bg_opt = $ats->megafactory_theme_opt( 'author-link-format' );
megafactoryLinkDynamicStyle( 'author', $link_bg_opt, $theme_color, $rgba_08 );

/* Search Link */
$link_bg_opt = $ats->megafactory_theme_opt( 'search-link-format' );
megafactoryLinkDynamicStyle( 'search', $link_bg_opt, $theme_color, $rgba_08 );

/* Catgeory Link */
$link_bg_opt = $ats->megafactory_theme_opt( 'category-link-format' );
megafactoryLinkDynamicStyle( 'category', $link_bg_opt, $theme_color, $rgba_08 );

// All Category Link
$actived_cat_tmplt = $ats->megafactory_theme_opt('theme-categories');
if( !empty( $actived_cat_tmplt ) && is_array( $actived_cat_tmplt ) ){
	foreach( $actived_cat_tmplt as $template ){
		$link_bg_opt = $ats->megafactory_theme_opt( $template.'-link-format' );
		megafactoryLinkDynamicStyle( $template, $link_bg_opt, $theme_color, $rgba_08 );
	}
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

echo "\n/* Post Item Overlay Styles */\n";
echo '.post-overlay-items{
	color: '. $ats->megafactory_theme_opt( 'single-post-article-overlay-color' ) .';';
	$ats->megafactory_bg_rgba( 'single-post-article-overlay-background' );
	$ats->megafactory_border_settings( 'single-post-article-overlay-border' );
	$ats->megafactory_padding_settings( 'single-post-article-overlay-padding' );
	$ats->megafactory_margin_settings( 'single-post-article-overlay-margin' );
	
echo '
}';
echo '.post-overlay-items a{';
	$ats->megafactory_link_color( 'single-post-article-overlay-link-color', 'regular' );
echo '
}';
echo '.post-overlay-items a:hover{';
	$ats->megafactory_link_color( 'single-post-article-overlay-link-color', 'hover' );
echo '
}';
echo '.post-overlay-items a:hover{';
	$ats->megafactory_link_color( 'single-post-article-overlay-link-color', 'active' );
echo '
}';

/* Extra Styles */

echo "\n/* Footer Styles */\n";
echo '.site-footer{';
	$ats->megafactory_typo_generate( 'footer-typography' );
	$ats->megafactory_bg_settings( 'footer-background' );
	$ats->megafactory_border_settings( 'footer-border' );
	$ats->megafactory_padding_settings( 'footer-padding' );
echo '
}';
echo '.site-footer .widget{';
	$ats->megafactory_typo_generate( 'footer-typography' );
echo '
}';
$bg_overlay = $ats->megafactory_theme_opt( 'footer-background-overlay' );
if( !empty( $bg_overlay ) && isset( $bg_overlay['rgba'] ) ):
echo '
footer.site-footer:before {
	position: absolute;
	height: 100%;
	width: 100%;
	top: 0;
	left: 0;
	content: "";
	background-color: '. esc_attr( $bg_overlay['rgba'] ) .';
}';
endif;
echo '.site-footer a{';
	$ats->megafactory_link_color( 'footer-link-color', 'regular' );
echo '
}';
echo '.site-footer a:hover{';
	$ats->megafactory_link_color( 'footer-link-color', 'hover' );
echo '
}';
echo '.site-footer a:hover{';
	$ats->megafactory_link_color( 'footer-link-color', 'active' );
echo '
}';

echo "\n/* Footer Top Styles */\n";
$ats->megafactory_custom_font_check( 'footer-top-typography' );
echo '.footer-top-wrap{';
	$ats->megafactory_typo_generate( 'footer-top-typography' );
	$ats->megafactory_bg_rgba( 'footer-top-background' );
	$ats->megafactory_border_settings( 'footer-top-border' );
	$ats->megafactory_padding_settings( 'footer-top-padding' );
	$ats->megafactory_margin_settings( 'footer-top-margin' );
echo '
}';
echo '.footer-top-wrap .widget{';
	$ats->megafactory_typo_generate( 'footer-top-typography' );
echo '
}';
echo '.footer-top-wrap a{';
	$ats->megafactory_link_color( 'footer-top-link-color', 'regular' );
echo '
}';
echo '.footer-top-wrap a:hover{';
	$ats->megafactory_link_color( 'footer-top-link-color', 'hover' );
echo '
}';
echo '.footer-top-wrap a:hover{';
	$ats->megafactory_link_color( 'footer-top-link-color', 'active' );
echo '
}';
echo '.footer-top-wrap .widget .widget-title {
	color: '. esc_attr( $ats->megafactory_theme_opt( 'footer-top-title-color' ) ) .';
}';

echo "\n/* Footer Middle Styles */\n";
$ats->megafactory_custom_font_check( 'footer-middle-typography' );
echo '.footer-middle-wrap{';
	$ats->megafactory_typo_generate( 'footer-middle-typography' );
	$ats->megafactory_bg_rgba( 'footer-middle-background' );
	$ats->megafactory_border_settings( 'footer-middle-border' );
	$ats->megafactory_padding_settings( 'footer-middle-padding' );
	$ats->megafactory_margin_settings( 'footer-middle-margin' );
echo '
}';
echo '.footer-middle-wrap .widget{';
	$ats->megafactory_typo_generate( 'footer-middle-typography' );
echo '
}';
echo '.footer-middle-wrap a{';
	$ats->megafactory_link_color( 'footer-middle-link-color', 'regular' );
echo '
}';
echo '.footer-middle-wrap a:hover{';
	$ats->megafactory_link_color( 'footer-middle-link-color', 'hover' );
echo '
}';
echo '.footer-middle-wrap a:active{';
	$ats->megafactory_link_color( 'footer-middle-link-color', 'active' );
echo '
}';
echo '.footer-middle-wrap .widget .widget-title {
	color: '. esc_attr( $ats->megafactory_theme_opt( 'footer-middle-title-color' ) ) .';
}';

echo "\n/* Footer Bottom Styles */\n";
$ats->megafactory_custom_font_check( 'footer-bottom-typography' );
echo '.footer-bottom{';
	$ats->megafactory_typo_generate( 'footer-bottom-typography' );
	$ats->megafactory_bg_rgba( 'footer-bottom-background' );
	$ats->megafactory_border_settings( 'footer-bottom-border' );
	$ats->megafactory_padding_settings( 'footer-bottom-padding' );
	$ats->megafactory_margin_settings( 'footer-bottom-margin' );
echo '
}';
echo '.footer-bottom .widget{';
	$ats->megafactory_typo_generate( 'footer-bottom-typography' );
echo '
}';
echo '.footer-bottom a{';
	$ats->megafactory_link_color( 'footer-bottom-link-color', 'regular' );
echo '
}';
echo '.footer-bottom a:hover{';
	$ats->megafactory_link_color( 'footer-bottom-link-color', 'hover' );
echo '
}';
echo '.footer-bottom a:active{';
	$ats->megafactory_link_color( 'footer-bottom-link-color', 'active' );
echo '
}';
echo '.footer-bottom-wrap .widget .widget-title {
	color: '. esc_attr( $ats->megafactory_theme_opt( 'footer-bottom-title-color' ) ) .';
}';

echo "\n/* Theme Extra Styles */\n";
//Here your code
$theme_link_color = $ats->megafactory_get_link_color( 'theme-link-color', 'regular' );
$theme_link_hover = $ats->megafactory_get_link_color( 'theme-link-color', 'hover' );
$theme_link_active = $ats->megafactory_get_link_color( 'theme-link-color', 'active' );
$rgb = $ats->megafactory_hex2rgba( $theme_color, 'none' );
/*
 * Theme Color -> $theme_color
 * Theme RGBA -> $rgb example -> echo 'body{ background: rgba('. esc_attr( $rgb ) .', 0.5); }';
 * Link Colors -> $theme_link_color, $theme_link_hover, $theme_link_active
 */
echo '.theme-color {
	color: '. esc_attr( $theme_color ) .';
}';
echo '.theme-color-bg {
	background-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- General Style----------- */\n";

echo '::selection {
	background : '. esc_attr( $theme_color ) .';
}';

echo 'b {
	color : '. esc_attr( $theme_color ) .';
}';

echo '.secondary-space-toggle > span {
	background : '. esc_attr( $theme_color ) .';
}';

echo '.top-sliding-toggle.fa-minus {
	border-top-color : '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Header Topbar ----------- */\n";
echo '.topbar .topbar-inner .topbar-items .header-phone span,
.topbar .topbar-inner .topbar-items .header-address span,
.topbar .topbar-inner .topbar-items .header-email span {
	color : '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Header Logobar ----------- */\n";
echo '.header-inner .media i {
	color : '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Menu----------- */\n";
echo '.dropdown:hover > .dropdown-menu {
	border-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Search Style----------- */\n";

echo 'input[type="submit"], .search-form .input-group .btn {
	background: '. esc_attr( $theme_color ) .';
}';


echo "\n/*----------- Button Style----------- */\n";
echo '.btn, button , .btn.bordered:hover{
	background: '. esc_attr( $theme_color ) .';
}';

echo '.btn.classic:hover {
	background: '. esc_attr( $theme_color ) .';
}';

echo '.btn.link {
	color: '. esc_attr( $theme_color ) .';
}';

echo '.btn.bordered {
	border-color: '. esc_attr( $theme_color ) .';
	color: '. esc_attr( $theme_color ) .';
}';


echo "\n/* -----------Pagination Style----------- */\n";
echo '.nav.pagination > li.nav-item a {
	background: '. esc_attr( $theme_color ) .';
	border-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Select Style ----------- */\n";
echo 'select:focus {
	border-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Header Styles---------------- */\n";
echo '.close:before, .close:after { 
	background: '. esc_attr( $theme_color ) .';
}';

echo '.nav-link:focus, .nav-link:hover { 
	color: '. esc_attr( $theme_color ) .';
}';

echo '.zmm-dropdown-toggle { 
	color: '. esc_attr( $theme_color ) .';
}';

echo 'ul li.theme-color a {
	color: '. esc_attr( $theme_color ) .' !important;
}';

echo "\n/*----------- Post Style----------- */\n";

echo "\n/*----------- Post Navigation ---------*/\n";
echo '.post-navigation .nav-links .nav-next a, .post-navigation .nav-links .nav-previous a {
	border-color: '. esc_attr( $theme_color ) .';
}';

echo '.post-navigation .nav-links .nav-next a:hover, .post-navigation .nav-links .nav-previous a:hover {
	background-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Calender---------------- */\n";
echo '.calendar_wrap th ,tfoot td { 
	background: '. esc_attr( $theme_color ) .';
}';

echo '.widget_calendar caption {
	border-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Archive---------------- */\n";
echo '.widget_archive li:before { 
	color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Instagram widget---------------- */\n";
echo '.null-instagram-feed p a { 
	background: '. esc_attr( $theme_color ) .';
}';


echo "\n/*----------- Tag Cloud---------------- */\n";
echo '.widget.widget_tag_cloud a.tag-cloud-link { 
	background: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Service Menu---------------- */\n";
echo '.widget .menu-item-object-mf-service.current-menu-item a { 
	background: '. esc_attr( $theme_color ) .';
}';

echo '.widget .menu-item-object-mf-service a:hover,
.site-footer .widget .menu-item-object-mf-service.current-menu-item a:hover {
	color: '. esc_attr( $theme_color ) .';	
}';

echo "\n/*----------- Service Menu---------------- */\n";
echo '.widget .menu-item-object-mf-service a { 
	border-color: '. esc_attr( $theme_color ) .';
}';


echo "\n/*----------- Post Nav---------------- */\n";
echo '.zozo_advance_tab_post_widget .nav-tabs .nav-item.show .nav-link, .widget .nav-tabs .nav-link.active { 
	background: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Back to top---------------- */\n";
echo '.back-to-top > i { 
	background: '. esc_attr( $theme_color ) .';
}';


echo "\n/*----------- Owl Carousel---------------- */\n";
echo '.owl-dot span , .owl-prev, .owl-next  { 
	background: '. esc_attr( $theme_color ) .';
}';





echo "\n/*----------- Shortcodes---------------- */\n";

echo '.entry-title a:hover { 
	color: '. esc_attr( $theme_color ) .';
}';


echo '.title-separator.separator-border { 
	background-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Twitter---------------- */\n";
echo '.twitter-3 .tweet-info { 
	border-color: '. esc_attr( $theme_color ) .';
}';
echo '.twitter-wrapper.twitter-dark a { 
	color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*----------- Pricing table---------------- */\n";
echo '.price-text { 
	color: '. esc_attr( $theme_color ) .';
}';

echo '.pricing-style-3 .pricing-inner-wrapper,.pricing-table-wrapper .btn:hover { 
	border-color: '. esc_attr( $theme_color ) .';
}';

echo '.pricing-style-2 .price-text p { 
	color: '. esc_attr( $theme_color ) .';
}';

echo '.pricing-style-3 ul.pricing-features-list > li {
	box-shadow: 0 7px 10px -9px rgba('. esc_attr( $rgb ) .', 0.8);
}';



echo "\n/*-----------Compare Pricing table---------------- */\n";
echo '.compare-pricing-wrapper .pricing-table-head, .compare-features-wrap { 
	background: '. esc_attr( $theme_color ) .';
}';

echo '.compare-pricing-style-3.compare-pricing-wrapper .btn:hover { 
	background: '. esc_attr( $theme_color ) .';
}';

echo "\n/*-----------Counter Style---------------- */\n";
echo '.counter-wrapper.counter-style-2 { 
	border-color: '. esc_attr( $theme_color ) .';
}';


echo "\n/*-----------Testimonials---------------- */\n";
echo '.testimonial-wrapper.testimonial-1 .testimonial-excerpt , .testimonial-wrapper.testimonial-3 .testimonial-inner { 
	border-color: '. esc_attr( $theme_color ) .';
}';

echo '.testimonial-wrapper.testimonial-1 .testimonial-excerpt:after { 
	border-color: '. esc_attr( $theme_color ) .' transparent transparent;
}';
echo '.megafactory-content .testimonial-2 .testimonial-inner:hover, .megafactory-content .testimonial-2 .testimonial-inner:hover .testimonial-thumb img {
	border-color: '. esc_attr( $theme_color ) .';
}';
echo '.testimonial-3 .testimonial-name a { 
	background: '. esc_attr( $theme_color ) .';
}';


echo "\n/*-----------Events---------------- */\n";
echo '.events-date { 
	border-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*-----------Team---------------- */\n";
echo '.team-wrapper.team-3 .team-inner > .team-thumb { 
	border-color: '. esc_attr( $theme_color ) .';
}';
echo '.team-1 .team-designation > p{ 
	background: '. esc_attr( $theme_color ) .';
}';

echo "\n/*-----------Timeline---------------- */\n";
echo '.timeline-style-2 .timeline > li > .timeline-panel { 
	border-color: '. esc_attr( $theme_color ) .';
}';
echo '.timeline-style-2 .timeline > li > .timeline-panel:before { 
	border-left-color: '. esc_attr( $theme_color ) .';
	border-right-color: '. esc_attr( $theme_color ) .';
}';
echo '.timeline-style-2 .timeline > li > .timeline-panel:after { 
	border-left-color: '. esc_attr( $theme_color ) .';
	border-right-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*-----------Portfolio---------------- */\n";

echo '.portfolio-masonry-layout .portfolio-angle .portfolio-title h4:after {
	background-color: '. esc_attr( $theme_color ) .';
}';
/*Meta Icon*/
echo 'span.portfolio-meta-icon {
	color: '. esc_attr( $theme_color ) .';
}';
/*CPT Filter Styles*/
echo '.portfolio-filter.filter-1 ul > li.active > a, .portfolio-filter.filter-1 ul > li > a:hover {
	background-color: '. esc_attr( $theme_color ) .';
}';
echo '.portfolio-filter.filter-1 ul > li > a, .portfolio-filter.filter-1 ul > li > a:hover {
	border: solid 1px '. esc_attr( $theme_color ) .';
}';
echo '.portfolio-filter.filter-1 ul > li > a {
	border-color: '. esc_attr( $theme_color ) .';
}';
echo '.portfolio-masonry-layout .portfolio-classic .portfolio-content-wrap {
	background: '. esc_attr( $theme_color ) .';
}';

echo '.portfolio-filter.filter-2 .active a.portfolio-filter-item {
	color: '. esc_attr( $theme_color ) .';
}';

echo '.portfolio-filter.filter-2 li a:after {
	background-color: '. esc_attr( $theme_color ) .';
}';

echo '.portfolio-slide .portfolio-content-wrap {
	background: '. esc_attr( $theme_color ) .';
}'; 

echo '.portfolio-minimal .portfolio-overlay-wrap:before,
.portfolio-minimal .portfolio-overlay-wrap:after { 
 border-color: '. esc_attr( $theme_color ) .';
}';

echo '.portfolio-angle .portfolio-overlay-wrap:before { 
 background: linear-gradient(-45deg, rgba(0, 0, 0, 0.75) 0%, rgba('. esc_attr( $rgb ) .', 0.86) 100%);
 
}';

 

echo "\n/*-----------Feature Box---------------- */\n";
echo 'span.feature-box-ribbon { 
	background: '. esc_attr( $theme_color ) .';
}';




echo "\n/*-----------Flipbox---------------- */\n";
echo "[class^='imghvr-shutter-out-']:before, [class*=' imghvr-shutter-out-']:before,
[class^='imghvr-shutter-in-']:after, [class^='imghvr-shutter-in-']:before, [class*=' imghvr-shutter-in-']:after, [class*=' imghvr-shutter-in-']:before,
[class^='imghvr-reveal-']:before, [class*=' imghvr-reveal-']:before {
	background-color: ". esc_attr( $theme_color ) .";
}";

echo "\n/*-----------Progress Bar---------------- */\n";
echo '.vc_progress_bar .vc_single_bar .vc_bar { 
	background: '. esc_attr( $theme_color ) .';
}';


echo "\n/*-----------Services---------------- */\n";
echo '.services-2 .services-title a { 
	background: '. esc_attr( $theme_color ) .';
}';

echo '.services-wrapper.services-1 .services-inner > .services-thumb , .services-3 .services-inner > .services-thumb { 
	border-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*-----------Blog---------------- */\n";
echo '.blog-style-3 .post-thumb { 
	border-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*-----------Tour---------------- */\n";
echo '.vc_tta-style-modern .vc_tta-tab.vc_active a{ 
	background-color: '. esc_attr( $theme_color ) .' !important;
}';

echo "\n/*-----------Accordin---------------- */\n";
echo '.vc_tta.vc_tta-accordion.vc_tta-style-flat .vc_active .vc_tta-controls-icon-position-left.vc_tta-panel-title > a > i {
	color: '. esc_attr( $theme_color ) .' !important;
}';

echo "\n/*-----------Contact Info---------------- */\n";
echo '.contact-info-wrapper.contact-info-style-2 .contact-mail a:hover { 
	color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*-----------Contact form 7---------------- */\n";
echo '.wpcf7 input[type="submit"] { 
	background: '. esc_attr( $theme_color ) .';
}';

echo '.contact-form-classic .wpcf7 textarea, .contact-form-classic .wpcf7 input, .contact-form-classic .wpcf7 select { 
	border-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*-----------Woocommerce---------------- */\n";
echo '.woocommerce ul.products li.product .price,
.woocommerce .product .price,
.woocommerce.single  .product .price,
.woocommerce p.stars a { 
	color: '. esc_attr( $theme_color ) .';
}';

echo '.woocommerce .product .onsale { 
	background-color: '. esc_attr( $theme_color ) .';
}';

echo '.woocommerce ul.products li.product .woocommerce-loop-product__title:hover {
	color: '. esc_attr( $theme_color ) .';
}';

echo '.woocommerce .product .button, 
.woocommerce.single .product .button,
.woocommerce #review_form #respond .form-submit input,
.woocommerce button.button,
.woocommerce ul.products li.product .woo-thumb-wrap .button:hover,
.woocommerce ul.products li.product .woo-thumb-wrap .added_to_cart,
.woocommerce ul.products li.product .woo-thumb-wrap .added_to_cart:hover { 
	background-color: '. esc_attr( $theme_color ) .';
}';


echo '.woocommerce .widget_price_filter .ui-slider .ui-slider-range { 
	background-color: '. esc_attr( $theme_color ) .';
}';

echo '.dropdown-menu.cart-dropdown-menu .mini-view-cart a { 
	background-color: '. esc_attr( $theme_color ) .';
}';

echo '.woocommerce #content input.button, .woocommerce #respond input#submit, 
.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, 
.woocommerce-page #content input.button, .woocommerce-page #respond input#submit, 
.woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button,
.woocommerce input.button.alt, .woocommerce input.button.disabled, .woocommerce input.button:disabled[disabled],
.cart_totals .wc-proceed-to-checkout a.checkout-button {
	background-color: '. esc_attr( $theme_color ) .';
}';

echo '.woocommerce-info,
.woocommerce-message {
	border-top-color: '. esc_attr( $theme_color ) .';
}';

echo '.woocommerce-info::before,
.woocommerce-message::before {
	color: '. esc_attr( $theme_color ) .';
}';

echo '.form-control:focus {
 border-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*-----------Mailchimp Widget---------------- */\n";
echo '.megafactory_mailchimp_widget input.zozo-mc.btn {
	background-color: '. esc_attr( $theme_color ) .';
}';

echo "\n/*-----------Footer---------------- */\n";
echo '.site-footer .widget-title::after { 
	background-color: '. esc_attr( $theme_color ) .';
}';

echo '.current_page_item a { 
	color: '. esc_attr( $theme_color ) .';
}';

echo '.mptt-shortcode-wrapper ul.mptt-menu.mptt-navigation-tabs li.active a, .mptt-shortcode-wrapper ul.mptt-menu.mptt-navigation-tabs li:hover a { 
	border-color: '. esc_attr( $theme_color ) .';
}';




echo "\n/* Theme Option Custom Styles */\n";
$custom_css = $ats->megafactory_theme_opt('custom-css');
echo ( $custom_css );