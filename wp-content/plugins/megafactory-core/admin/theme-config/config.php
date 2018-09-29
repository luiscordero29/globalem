<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
	
	require_once( MEGAFACTORY_CORE_DIR . 'admin/theme-config/config-fun.php' );
	$acf = new MegafactoryConfigFun; 

    // This is your option name where all the Redux data is stored.
    $opt_name = "megafactory_options";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Megafactory Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    }

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */
	//General Tab
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'megafactory-core' ),
        'id'               => 'general',
        'desc'             => esc_html__( 'These are the general settings of Megafactory theme', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-home'
    ) );
	
	//General -> Layout
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Layout', 'megafactory-core' ),
        'id'         => 'general-layout',
        'desc'       => esc_html__( 'This is the setting for theme layouts', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'page-layout',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Page Layout', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Choose page layout', 'megafactory-core' ),
				'options' => array(
					'boxed' => esc_html__( 'Boxed', 'megafactory-core' ),
					'wide'  => esc_html__( 'Wide', 'megafactory-core' )
				),
				'default'  => 'wide'
			),
			array(
                'id'			=> 'site-width',
                'type'			=> 'dimensions',
                'units'			=> array( 'px' ),
                'units_extended'=> 'false',
                'title'			=> esc_html__( 'Site Width', 'megafactory-core' ),
                'subtitle'		=> esc_html__( 'Set the site width here.', 'megafactory-core' ),
                'height'		=> false,
                'default'		=> array(
                    'width'	=> 1200,
                    'units'=> 'px'
                ),
				'required' 		=> array('page-layout', '!=', 'full')
            ),
			array(
                'id'       => 'page-content-padding',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'units'    => array( 'px' ),
                'units_extended'=> 'false',
                'title'    => esc_html__( 'Page Content Padding', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Set the top/right/bottom/left padding of page content.', 'megafactory-core' ),
                'default'  => array(
                    'padding-top'    => '',
                    'padding-right'  => '',
                    'padding-bottom' => '',
                    'padding-left'   => ''
                )
            ),
		)
    ) );
	
	//General -> Loaders
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Loaders', 'megafactory-core' ),
        'id'         => 'general-loadres',
        'desc'       => esc_html__( 'This is the setting for Page Loader', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'page-loader',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Page Loader', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable Page Loader', 'megafactory-core' ),
				'options' => array(
					'yes' => esc_html__( 'Yes', 'megafactory-core' ),
					'no'  => esc_html__( 'No', 'megafactory-core' ),
				),
				'default'  => 'no'
			),
			array(
                'id'       => 'page-loader-img',
                'type'     => 'media',
				'library_filter'  => array('gif'),
                'url'      => true,
                'title'    => esc_html__( 'Page Loader Image', 'megafactory-core' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload Page Loader Image', 'megafactory-core' ),
				'required' 		=> array('page-loader', '=', 'yes')
            ),
			array(
                'id'       => 'infinite-loader-img',
                'type'     => 'media',
				'library_filter'  => array('gif'),
                'url'      => true,
                'title'    => esc_html__( 'Infinite Scroll Image', 'megafactory-core' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload Infinite Scroll Image', 'megafactory-core' ),
            )
		)
    ) );
	
	//General -> Theme Logo
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo', 'megafactory-core' ),
        'id'         => 'general-logo',
        'desc'       => esc_html__( 'This is the setting for Theme Logo', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'logo',
                'type'     => 'media',
                'url'      => true,
				'preview'  => true,
                'title'    => esc_html__( 'Logo', 'megafactory-core' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload theme logo', 'megafactory-core' ),
            ),
			array(
                'id'       => 'sticky-logo',
                'type'     => 'media',
                'url'      => true,
				'preview'  => true,
                'title'    => esc_html__( 'Sticky Logo', 'megafactory-core' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload theme sticky logo', 'megafactory-core' ),
            ),
			array(
                'id'       => 'mobile-logo',
                'type'     => 'media',
                'url'      => true,
				'preview'  => true,
                'title'    => esc_html__( 'Mobile Logo', 'megafactory-core' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload theme mobile logo', 'megafactory-core' ),
            )
		)
    ) );
	
	//General -> API's
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'API', 'megafactory-core' ),
        'id'         => 'general-api',
        'desc'       => esc_html__( 'This is the setting for API', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'mailchimp-api',
				'type'     => 'password',
				'title'    => esc_html__( 'Mailchimp API Key', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Place here your registered mailchimp API key.', 'megafactory-core' ),
			),
			array(
				'id'       => 'google-api',
				'type'     => 'password',
				'title'    => esc_html__( 'Google Map API Key', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Place here your registered google map API key.', 'megafactory-core' ),
			)
		)
    ) );
	
	//General -> Comments
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Comments', 'megafactory-core' ),
        'id'         => 'general-comments',
        'desc'       => esc_html__( 'This is the setting for comments', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'comments-type',
                'type'     => 'select',
                'title'    => esc_html__( 'Comments Type', 'megafactory-core' ),
				'subtitle' => esc_html__( 'This option will be showing comment like facebook or default wordpress.', 'megafactory-core' ),
                'options'  => array(
                    'wp' => esc_html__( 'WordPress Comment', 'megafactory-core' ),
                    'fb' => esc_html__( 'Facebook Comment', 'megafactory-core' ),
                ),
                'default'  => 'wp'
            ),
			array(
                'id'       => 'comments-like',
                'type'     => 'switch',
                'title'    => esc_html__( 'Comments Like', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable to show or hide comments likes to single post comments.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enable', 'megafactory-core' ),
				'off'      => esc_html__( 'Disable', 'megafactory-core' ),
				'required' 		=> array('comments-type', '=', 'wp')
            ),
			array(
                'id'       => 'comments-share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Comments Share', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable to show or hide comments share to single post comments.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enable', 'megafactory-core' ),
				'off'      => esc_html__( 'Disable', 'megafactory-core' ),
				'required' 		=> array('comments-type', '=', 'wp')
            ),
			array(
				'id'       => 'fb-developer-key',
				'type'     => 'password',
				'title'    => esc_html__( 'Facebook Developer API', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enter facebook developer API key.', 'megafactory-core' ),
				'required' 		=> array('comments-type', '=', 'fb')
			),
			array(
                'id'       => 'fb-comments-number',
                'type'     => 'text',
                'title'    => esc_html__( 'Number of Comments', 'megafactory-core' ),
                'subtitle'     => esc_html__( 'Enter number of comments to display.', 'megafactory-core' ),
                'default'  => '',
				'required' 		=> array('comments-type', '=', 'fb')
            ),
			array(
				'id'       => 'fb-comments-width',
				'type'     => 'dimensions',
				'units'    => array( 'px' ),
				'units_extended'=> 'false',
				'height'    => false,
				'title'    => esc_html__( 'Facebook Comments Width', 'megafactory-core' ),
				'subtitle'     => esc_html__( 'Increase or decrease facebook comments wrapper width.', 'megafactory-core' ),
				'default'  => array(
					'width'  => 500,
					'units'=> 'px'
				),
				'required' 		=> array('comments-type', '=', 'fb')
			),
		)
    ) );
	
	//General -> Smooth Scroll
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Smooth Scroll', 'megafactory-core' ),
        'id'         => 'general-smooth',
        'desc'       => esc_html__( 'This is the setting for page smooth scroll', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'smooth-opt',
                'type'     => 'switch',
                'title'    => esc_html__( 'Smooth Scroll Option', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable to append smooth scroll js to website.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enable', 'megafactory-core' ),
				'off'      => esc_html__( 'Disable', 'megafactory-core' )
            ),
			array(
                'id'       => 'scroll-time',
                'type'     => 'text',
                'title'    => esc_html__( 'Scroll Time', 'megafactory-core' ),
                'subtitle'     => esc_html__( 'Enter smooth scroll time in milliseconds. Example 600', 'megafactory-core' ),
                'default'  => '600',
				'required' 		=> array('smooth-opt', '=', '1')
            ),
			array(
                'id'       => 'scroll-distance',
                'type'     => 'text',
                'title'    => esc_html__( 'Scroll Distance', 'megafactory-core' ),
                'subtitle'     => esc_html__( 'Enter smooth scroll distance in value. Example 40', 'megafactory-core' ),
                'default'  => '40',
				'required' 		=> array('smooth-opt', '=', '1')
            )
		)
    ) );
	
	//General -> Media Settings
	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Media Settings', 'megafactory-core' ),
		'id'         => 'general-media',
		'desc'       => esc_html__( 'This is the setting for media sizes', 'megafactory-core' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'megafactory_grid_large',
				'type'     => 'dimensions',
				'title'    => esc_html__('Megafactory Grid Large Size', 'megafactory-core'),
				'desc'       => esc_html__( 'This image used in gallery large grid. If you don\'t want this size means just leave this empty. Default 440 x 260', 'megafactory-core' ),
				'default'  => array(
					'width'   => '440', 
					'height'  => '260'
				),
			),
			array(
				'id'       => 'megafactory_grid_medium',
				'type'     => 'dimensions',
				'title'    => esc_html__('Megafactory Grid Medium Size', 'megafactory-core'),
				'desc'       => esc_html__( 'This image used in gallery medium grid. If you don\'t want this size means just leave this empty. Default 390 x 231', 'megafactory-core' ),
				'default'  => array(
					'width'   => '390', 
					'height'  => '231'
				),
			),
			array(
				'id'       => 'megafactory_grid_small',
				'type'     => 'dimensions',
				'title'    => esc_html__('Megafactory Grid Small Size', 'megafactory-core'),
				'desc'       => esc_html__( 'This image used in gallery small grid. If you don\'t want this size means just leave this empty. Default 220 x 130', 'megafactory-core' ),
				'default'  => array(
					'width'   => '220', 
					'height'  => '130'
				),
			),
			array(
				'id'       => 'megafactory_team_medium',
				'type'     => 'dimensions',
				'title'    => esc_html__('Megafactory Team Medium Size', 'megafactory-core'),
				'desc'       => esc_html__( 'This image used in team shorcode. If you don\'t want this size means just leave this empty. Default 300 x 300', 'megafactory-core' ),
				'default'  => array(
					'width'   => '600', 
					'height'  => '600'
				),
			)
		)
	) );
	
	//General -> Custom CSS
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom Style', 'megafactory-core' ),
        'id'         => 'general-customcode',
        'desc'       => esc_html__( 'This is the setting for custom style/script code.', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'custom-css',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'CSS Code', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Paste your css code here.', 'megafactory-core' ),
                'mode'     => 'css',
                'theme'    => 'megafactory',
				'default'  => ""
            )
		)
    ) );
	
	//General -> RTL
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'RTL', 'megafactory-core' ),
        'id'         => 'general-rtl',
        'desc'       => esc_html__( 'This is the setting for theme view RTL', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'rtl',
                'type'     => 'switch',
                'title'    => esc_html__( 'RTL', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable RTL to change theme right to left view.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
            ),
		)
    ) );
	
	//ADS
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'ADS', 'megafactory-core' ),
        'id'               => 'ads',
        'desc'             => esc_html__( 'These are the ads settings of megafactory Theme', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-television'
    ) );
	//ADS -> Header Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Ads', 'megafactory-core' ),
        'id'         => 'ads-header',
        'desc'       => esc_html__( 'These are header ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('header')
    ) );
	//ADS -> Footer Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Ads', 'megafactory-core' ),
        'id'         => 'ads-footer',
        'desc'       => esc_html__( 'These are footer ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('footer')
    ) );
	//ADS -> Sidebar Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Sidebar Ads', 'megafactory-core' ),
        'id'         => 'ads-sidebar',
        'desc'       => esc_html__( 'These are sidebar ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('sidebar')
    ) );
	//ADS -> Artical Top Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Artical Top Ads', 'megafactory-core' ),
        'id'         => 'ads-artical-top',
        'desc'       => esc_html__( 'These are artical top ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('artical-top')
    ) );
	//ADS -> Artical Inline Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Artical Inline Ads', 'megafactory-core' ),
        'id'         => 'ads-artical-inline',
        'desc'       => esc_html__( 'These are artical inline ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('artical-inline')
    ) );
	//ADS -> Artical Bottom Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Artical Bottom Ads', 'megafactory-core' ),
        'id'         => 'ads-artical-bottom',
        'desc'       => esc_html__( 'These are artical bottom ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('artical-bottom')
    ) );
	//ADS -> Custom1 Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom1 Ads', 'megafactory-core' ),
        'id'         => 'ads-custom1',
        'desc'       => esc_html__( 'These are custom1 ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('custom1')
    ) );
	//ADS -> Custom2 Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom2 Ads', 'megafactory-core' ),
        'id'         => 'ads-custom2',
        'desc'       => esc_html__( 'These are custom2 ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('custom2')
    ) );
	//ADS -> Custom3 Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom3 Ads', 'megafactory-core' ),
        'id'         => 'ads-custom3',
        'desc'       => esc_html__( 'These are custom3 ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('custom3')
    ) );
	//ADS -> Custom4 Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom4 Ads', 'megafactory-core' ),
        'id'         => 'ads-custom4',
        'desc'       => esc_html__( 'These are custom4 ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('custom4')
    ) );
	//ADS -> Custom5 Ads
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom5 Ads', 'megafactory-core' ),
        'id'         => 'ads-custom5',
        'desc'       => esc_html__( 'These are custom5 ads settings of megafactory Theme', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $acf->themeAdsFields('custom5')
    ) );
	
	//Skin Tab
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Skin', 'megafactory-core' ),
        'id'               => 'skin',
        'desc'             => esc_html__( 'These are theme skin/color options', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-paint-brush'
    ) );
	
	//Skin -> Theme Skin
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Theme Skin', 'megafactory-core' ),
        'id'         => 'skin-general',
        'desc'       => esc_html__( 'This is the setting for theme skin', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'theme-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Theme Color', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Choose theme color.', 'megafactory-core' ),
				'validate' => 'color',
                'default'  => '#ffc811'
            ),
			array(
                'id'       => 'theme-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'General Links Color', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Choose general link color for theme.', 'megafactory-core' ),
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#ffc811',
                    'active'  => '#ffc811',
                )
            ),
		)
    ) );
	
	//Skin -> Body Background
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Body Background', 'megafactory-core' ),
        'id'         => 'skin-body',
        'desc'       => esc_html__( 'This is the setting for theme body background.', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(         
				'id'       => 'body-background',
				'type'     => 'background',
				'title'    => __( 'Body Background Settings', 'megafactory-core'),
				'subtitle' => __( 'This is settings for body background with image, color, etc.', 'megafactory-core' ),
				'default'  => array(
					'background-color' => '',
				)
			),
		)
    ) );
	
	//Typography Tab
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Typography', 'megafactory-core' ),
        'id'               => 'typography',
        'desc'             => esc_html__( 'These are the theme typograhpy options', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-font'
    ) );
	
	//Typography -> Theme General Typography
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General Typography', 'megafactory-core' ),
        'id'         => 'typography-general',
        'desc'       => esc_html__( 'This is the setting for theme general typograhpy', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'body-typography',
                'type'     => 'typography',
                'title'    => __( 'Body Fonts', 'megafactory-core' ),
                'subtitle' => __( 'Specify the body font properties.', 'megafactory-core' ),
                'google'   => true,
				'letter-spacing'=> true,
				'line-height'=> true,
                'default'  => array(
                    'color'       => '#777777',
                    'font-size'   => '15px',
                    'font-family' => 'Roboto',
                    'font-weight' => '400',
					'line-height' => '28px'
                ),
            ),
			array(
                'id'       => 'h1-typography',
                'type'     => 'typography',
                'title'    => __( 'H1 Fonts', 'megafactory-core' ),
                'subtitle' => __( 'Specify the h1 font properties.', 'megafactory-core' ),
                'google'   => true,
				'letter-spacing'=> true,
				'line-height'=> true,
                'default'  => array(
                    'color'       => '#333333',
                    'font-size'   => '36px',
                    'font-family' => 'Roboto',
                    'font-weight' => '',
					'line-height' => '42px'
                ),
            ),
			array(
                'id'       => 'h2-typography',
                'type'     => 'typography',
                'title'    => __( 'H2 Fonts', 'megafactory-core' ),
                'subtitle' => __( 'Specify the h2 font properties.', 'megafactory-core' ),
                'google'   => true,
				'letter-spacing'=> true,
				'line-height'=> true,
                'default'  => array(
                    'color'       => '#333333',
                    'font-size'   => '29px',
                    'font-family' => 'Roboto',
                    'font-weight' => '',
					'line-height' => '35px'
                ),
            ),
			array(
                'id'       => 'h3-typography',
                'type'     => 'typography',
                'title'    => __( 'H3 Fonts', 'megafactory-core' ),
                'subtitle' => __( 'Specify the h3 font properties.', 'megafactory-core' ),
                'google'   => true,
				'letter-spacing'=> true,
				'line-height'=> true,
                'default'  => array(
                    'color'       => '#333333',
                    'font-size'   => '22px',
                    'font-family' => 'Roboto',
                    'font-weight' => '',
					'line-height' => '29px'
                ),
            ),
			array(
                'id'       => 'h4-typography',
                'type'     => 'typography',
                'title'    => __( 'H4 Fonts', 'megafactory-core' ),
                'subtitle' => __( 'Specify the h4 font properties.', 'megafactory-core' ),
                'google'   => true,
				'letter-spacing'=> true,
				'line-height'=> true,
                'default'  => array(
                    'color'       => '#333333',
                    'font-size'   => '20px',
                    'font-family' => 'Roboto',
                    'font-weight' => '500',
					'line-height' => '24px'
                ),
            ),
			array(
                'id'       => 'h5-typography',
                'type'     => 'typography',
                'title'    => __( 'H5 Fonts', 'megafactory-core' ),
                'subtitle' => __( 'Specify the h5 font properties.', 'megafactory-core' ),
                'google'   => true,
				'letter-spacing'=> true,
				'line-height'=> true,
                'default'  => array(
                    'color'       => '',
                    'font-size'   => '17px',
                    'font-family' => 'Roboto',
                    'font-weight' => '',
					'line-height' => '25px'
                ),
            ),
			array(
                'id'       => 'h6-typography',
                'type'     => 'typography',
                'title'    => __( 'H6 Fonts', 'megafactory-core' ),
                'subtitle' => __( 'Specify the h6 font properties.', 'megafactory-core' ),
                'google'   => true,
				'letter-spacing'=> true,
				'line-height'=> true,
                'default'  => array(
                    'color'       => '',
                    'font-size'   => '16px',
                    'font-family' => 'Roboto',
                    'font-weight' => '',
					'line-height' => '20px'
                ),
            ),
		)
    ) );
	
	//Typography -> Theme Widgets Typography
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Widgets Typography', 'megafactory-core' ),
        'id'         => 'typography-widgets',
        'desc'       => esc_html__( 'This is the setting for theme widgets typograhpy', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'widgets-title',
                'type'     => 'typography',
                'title'    => __( 'Widgets Title Typography', 'megafactory-core' ),
                'subtitle' => __( 'Specify the widget title typography properties.', 'megafactory-core' ),
                'google'   => true,
				'letter-spacing'=> true,
				'line-height'=> true,
                'default'  => array(
                    'color'       => '',
                    'font-size'   => '20px',
                    'font-family' => 'Roboto',
                    'font-weight' => '',
					'line-height' => '28px'
                ),
            ),
			array(
                'id'       => 'widgets-content',
                'type'     => 'typography',
                'title'    => __( 'Widgets Content Typography', 'megafactory-core' ),
                'subtitle' => __( 'Specify the widget content typography properties.', 'megafactory-core' ),
                'google'   => true,
				'letter-spacing'=> true,
				'line-height'=> true,
                'default'  => array(
                    'color'       => '',
                    'font-size'   => '15px',
                    'font-family' => 'Roboto',
                    'font-weight' => '400',
					'line-height' => '26px'
                ),
            ),
		)
    ) );
	
	//Header Tab
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'megafactory-core' ),
        'id'               => 'header',
        'desc'             => esc_html__( 'These are header general settings of megafactory theme', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-credit-card-alt'
    ) );
	
	//Header -> Header General
	$header_mainmenu_skin = $acf->themeSkinSettings('main-menu');
	$secondary_space_skin = $acf->themeSkinSettings('secondary-space', array( 'line_height' => true )); 
	$header_dropdown_skin = $acf->themeSkinSettings('dropdown-menu', array( 'line_height' => true ));
	$header_top_slide_skin = $acf->themeSkinSettings('top-sliding', array( 'line_height' => true ));
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header General', 'megafactory-core' ),
        'id'         => 'header-general',
        'desc'       => esc_html__( 'This is the setting for Header General', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'header-layout',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Header Layout', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Choose header layout boxed or wide.', 'megafactory-core' ),
				'options' => array(
					'boxed' => esc_html__( 'Boxed', 'megafactory-core' ),
					'wide'  => esc_html__( 'Wide', 'megafactory-core' ),
				),
				'default'  => 'wide',
				'required' 		=> array('page-layout', '=', 'wide')
			),
			array(
                'id'       => 'header-type',
                'type'     => 'select',
                'title'    => esc_html__( 'Header Type', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Select header type for matching your site.', 'megafactory-core' ),
                'options'  => array(
					'default'		=> esc_html__( 'Default', 'megafactory-core' ),
					'left-sticky'	=> esc_html__( 'Left Sticky', 'megafactory-core' ),
                    'right-sticky'	=> esc_html__( 'Right Stikcy', 'megafactory-core' ),
                ),
                'default'  => 'default'
            ),
			array(         
				'id'       => 'header-background',
				'type'     => 'background',
				'title'    => __( 'Header Background Settings', 'megafactory-core'),
				'subtitle' => __( 'This is settings for header background with image, color, etc.', 'megafactory-core' ),
				'default'  => array(
					'background-color' => '#ffffff',
				),
				'required' 		=> array('header-type', '=', 'default')
			),
			array(
				'id'      => 'header-items',
				'type'    => 'sorter',
				'title'   => esc_html__( 'Header Items', 'megafactory-core' ),
				'desc'    => esc_html__( 'Needed items for header, drag from disabled and put enabled.', 'megafactory-core' ),
				'options' => array(
					'Normal' => array(
						
						'header-logo'	=> esc_html__( 'Logo Section', 'megafactory-core' )						
												
					),
					'Sticky' => array(
						
					),
					'disabled' => array(
						'header-topbar'	=> esc_html__( 'Top Bar', 'megafactory-core' ),
						'header-nav'	=> esc_html__( 'Nav Bar', 'megafactory-core' )
					)
				),
				'required' 		=> array('header-type', '=', 'default')
			),
			array(
                'id'       => 'header-fields-custom-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Custom Fields Settings', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for header custom fields.', 'megafactory-core' ),
                'indent'   => true, 
            ),
			array(
				'id'		=>'header-phone-text',
				'type' 		=> 'textarea',
				'title' 	=> esc_html__( 'Phone Number Custom Text', 'megafactory-core' ), 
				'desc'		=> esc_html__( 'This is the phone number field, you can assign here any custom text. Few HTML allowed here.', 'megafactory-core' ),
				'default' 	=> '1234567890',
			),
			array(
				'id'		=>'header-address-text',
				'type' 		=> 'textarea',
				'title' 	=> esc_html__( 'Address Custom Text', 'megafactory-core' ), 
				'desc'		=> esc_html__( 'This is the address field, you can assign here any custom text. Few HTML allowed here.', 'megafactory-core' ),
				'default' 	=> 'No. 12, Wales street, Australia.',
			),
			array(
				'id'		=>'header-email-text',
				'type' 		=> 'textarea',
				'title' 	=> esc_html__( 'Email Custom Text', 'megafactory-core' ), 
				'desc'		=> esc_html__( 'This is the email field, you can assign here any email id. Example companyname@yourdomain.com', 'megafactory-core' ),
				'default' 	=> 'info@yoursite.com',
			),
			array(
                'id'     => 'header-fields-custom-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-slider-setting-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Slider Settings', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for header slider.', 'megafactory-core' ),
                'indent'   => true, 
				'required' 		=> array('header-type', '=', 'default')
            ),
			array(
                'id'       => 'header-slider-position',
                'type'     => 'select',
                'title'    => esc_html__( 'Header Slider Position', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Select header slider position matching your page.', 'megafactory-core' ),
                'options'  => array(
					'bottom'		=> esc_html__( 'Below Header', 'megafactory-core' ),
					'top'	=> esc_html__( 'Above Header', 'megafactory-core' ),
                    'none'	=> esc_html__( 'None', 'megafactory-core' ),
                ),
                'default'  => 'none'
            ),
			array(
                'id'     => 'header-slider-setting-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-sticky-setting-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Sticky/Transparent Settings', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for sticky part.', 'megafactory-core' ),
                'indent'   => true, 
				'required' 		=> array('header-type', '=', 'default')
            ),
			array(
                'id'       => 'header-absolute',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Absolute', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable header absolute option to show transparent header for page.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
            ),
			array(
                'id'       => 'sticky-part',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Sticky Part', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable stciky part to sticky which items are placed in Sticky Part at Header Items.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
            ),
			array(
                'id'       => 'sticky-part-scrollup',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Scroll Up', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable stciky part to sticky only scroll up. This also only sticky which items are placed in Sticky Part at Header Items.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
				'required' 		=> array('sticky-part', '!=', 0)
            ),
			array(
                'id'     => 'header-sticky-setting-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-mainmenu-setting-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Main Menu Settings', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for mainmenu.', 'megafactory-core' ),
                'indent'   => true, 
				'required' 		=> array('header-type', '=', 'default')
            ),
			array(
                'id'       => 'mainmenu-menutype',
                'type'     => 'select',
                'title'    => esc_html__( 'Menu Type', 'megafactory-core' ),
                'options'  => array(
                    'advanced' => esc_html__( 'Advanced Menu', 'megafactory-core' ),
                    'normal' => esc_html__( 'Normal Menu', 'megafactory-core' ),
                ),
                'default'  => 'normal'
            ),
			array(
                'id'       => 'menu-tag',
                'type'     => 'switch',
                'title'    => esc_html__( 'Menu Tag', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable menu tag for menu items like Hot, Trend, New.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
				'required' 		=> array('mainmenu-menutype', '=', 'advanced')
            ),
			array(
				'id'       => 'menu-tag-hot-text',
				'type'     => 'text',
				'title'    => esc_html__('Hot Menu Tag Text', 'megafactory-core'),
				'subtitle' => esc_html__('Set this text to show hot menu tag.', 'megafactory-core'),
				'default'  => esc_html__( 'Hot', 'megafactory-core' ),
				'required' 		=> array('menu-tag', '!=', 0)
			),
			array(
				'id'       => 'menu-tag-hot-bg',
				'type'     => 'color',
				'title'    => esc_html__('Hot Menu Tag Background', 'megafactory-core'),
				'subtitle' => esc_html__('Set hot menu tag background color.', 'megafactory-core'),
				'default'  => '#333333',
				'validate' => 'color',
				'required' 		=> array('menu-tag', '!=', 0)
			),
			array(
				'id'       => 'menu-tag-new-text',
				'type'     => 'text',
				'title'    => esc_html__('New Menu Tag Text', 'megafactory-core'),
				'subtitle' => esc_html__('Set this text to show new menu tag.', 'megafactory-core'),
				'default'  => esc_html__( 'New', 'megafactory-core' ),
				'required' 		=> array('menu-tag', '!=', 0)
			),
			array(
				'id'       => 'menu-tag-new-bg',
				'type'     => 'color',
				'title'    => esc_html__('New Menu Tag Background', 'megafactory-core'),
				'subtitle' => esc_html__('Set new menu tag background color.', 'megafactory-core'),
				'default'  => '#333333',
				'validate' => 'color',
				'required' 		=> array('menu-tag', '!=', 0)
			),
			array(
				'id'       => 'menu-tag-trend-text',
				'type'     => 'text',
				'title'    => esc_html__('Trend Menu Tag Text', 'megafactory-core'),
				'subtitle' => esc_html__('Set this text to show trend menu tag.', 'megafactory-core'),
				'default'  => esc_html__( 'Trend', 'megafactory-core' ),
				'required' 		=> array('menu-tag', '!=', 0)
			),
			array(
				'id'       => 'menu-tag-trend-bg',
				'type'     => 'color',
				'title'    => esc_html__('Trend Menu Tag Background', 'megafactory-core'),
				'subtitle' => esc_html__('Set trend menu tag background color.', 'megafactory-core'),
				'default'  => '#333333',
				'validate' => 'color',
				'required' 		=> array('menu-tag', '!=', 0)
			),
			array(
                'id'     => 'header-mainmenu-setting-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-mainmenu-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Main Menu Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for mainmenu. Here you can set mainmenu font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			$header_mainmenu_skin[0],
			array(
                'id'     => 'header-mainmenu-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'secondary-menu-setting-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Secondary Menu Space Settings', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for secondary.', 'megafactory-core' ),
                'indent'   => true, 
				'required' 		=> array('header-type', '=', 'default')
            ),
			array(
                'id'       => 'secondary-menu',
                'type'     => 'switch',
                'title'    => esc_html__( 'Secondary Menu', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable secondary menu.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
            ),
			array(
                'id'       => 'secondary-menu-type',
                'type'     => 'select',
                'title'    => esc_html__( 'Secondary Menu Type', 'megafactory-core' ),
                'options'  => array(
                    'left-push'		=> esc_html__( 'Left Push', 'megafactory-core' ),
                    'left-overlay'	=> esc_html__( 'Left Overlay', 'megafactory-core' ),
					'right-push'		=> esc_html__( 'Right Push', 'megafactory-core' ),
                    'right-overlay'	=> esc_html__( 'Right Overlay', 'megafactory-core' ),
					'full-overlay'	=> esc_html__( 'Full Page Overlay', 'megafactory-core' ),
                ),
                'default'  => 'right-overlay',
				'required' 		=> array('secondary-menu', '!=', 0)
            ),
			array(
				'id'       => 'secondary-menu-space-width',
				'type'     => 'dimensions',
				'units'		=> array( 'px' ),
				'units_extended'=> 'false',
				'height'    => false,
				'title'    => esc_html__( 'Secondary Menu Space Width', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease secondary menu space width. this options only use if you enable secondary menu.', 'megafactory-core' ),
				'default'  => array(
					'width'  => 350,
					'units'=> 'px'
				),
				'required' 		=> array(
					array( 'secondary-menu', '!=', 0),
					array( 'secondary-menu-type', '!=', 'full-overlay')
				)
			),
			array(
                'id'     => 'secondary-menu-setting-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-secondary-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Secondary Menu Space Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for secondary menu space. Here you can set secondary menu space font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
				'required' 		=> array(
					array( 'header-type', '=', 'default' ),
					array( 'secondary-menu', '=', 1 )
				)
            ),
			$secondary_space_skin[0],
			$secondary_space_skin[2],
			$secondary_space_skin[3],
			$secondary_space_skin[4],
			array(         
				'id'       => 'secondary-space-background',
				'type'     => 'background',
				'title'    => __('Secondary Space Background', 'megafactory-core'),
				'subtitle' => __('Secondary space background with image, color, etc.', 'megafactory-core'),
				'default'  => array(
					'background-color' => '',
				)
			),
			array(
                'id'     => 'header-secondary-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-dropdown-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Dropdown Menu Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for dropdown menu. Here you can set dropdown menu font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
				'required' 		=> array('header-type', '=', 'default')
            ),
			$header_dropdown_skin[0],
			$header_dropdown_skin[1],
			$header_dropdown_skin[2],
			$header_dropdown_skin[3],
			array(
                'id'     => 'header-dropdown-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-top-sliding-switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Top Sliding Bar Enable', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable top sliding bar. Here you can show you sidebars width column based.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
            ),
			array(
                'id'       => 'header-top-sliding-device',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Show on Devices', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enable or disable top sliding bar for mobile, tab or desktop. This option from big devices. If desktop not enable and tab enable means it\'s hide sliding bar all the devices.', 'megafactory-core' ),
                'multi'    => true,
                'options'  => array(
                    'desktop' => 'Desktop',
                    'tab' => 'Tablet',
                    'mobile' => 'Mobile'
                ),
                'default'  => array( 'desktop', 'tab' ),
				'required' 		=> array('header-top-sliding-switch', '=', 1 )
            ),
			array(
                'id'       => 'header-top-slide-settings-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Top Slide Settings', 'megafactory-core' ),
                'indent'   => true, 
				'required' 		=> array( 
					array('header-type', '=', 'default' ),
					array('header-top-sliding-switch', '=', 1 )
				)
            ),
			array(
                'id'       => 'header-top-sliding-cols',
                'type'     => 'select',
                'title'    => esc_html__( 'Secondary Menu Type', 'megafactory-core' ),
                'options'  => array(
                    '3'		=> esc_html__( '4 Columns', 'megafactory-core' ),
                    '4'		=> esc_html__( '3 Columns', 'megafactory-core' ),
					'6'		=> esc_html__( '2 Columns', 'megafactory-core' ),
                    '12'	=> esc_html__( '1 Column', 'megafactory-core' ),
                ),
                'default'  => '3'
            ),
			array(
                'id'       => 'header-top-sliding-sidebar-1',
                'type'     => 'select',
                'title'    => esc_html__( 'Choose First Column', 'megafactory-core' ),
                'desc'     => esc_html__( 'Select widget area for showing first column of top sliding bar.', 'megafactory-core' ),
                'data'     => 'sidebars',
				'required' 		=> array('header-top-sliding-cols', '<=', '12')
            ),
			array(
                'id'       => 'header-top-sliding-sidebar-2',
                'type'     => 'select',
                'title'    => esc_html__( 'Choose Second Column', 'megafactory-core' ),
                'desc'     => esc_html__( 'Select widget area for showing second column of top sliding bar.', 'megafactory-core' ),
                'data'     => 'sidebars',
				'required' 		=> array('header-top-sliding-cols', '<=', '6')
            ),
			array(
                'id'       => 'header-top-sliding-sidebar-3',
                'type'     => 'select',
                'title'    => esc_html__( 'Choose Third Column', 'megafactory-core' ),
                'desc'     => esc_html__( 'Select widget area for showing third column of top sliding bar.', 'megafactory-core' ),
                'data'     => 'sidebars',
				'required' 		=> array('header-top-sliding-cols', '<=', '4')
            ),
			array(
                'id'       => 'header-top-sliding-sidebar-4',
                'type'     => 'select',
                'title'    => esc_html__( 'Choose Fourth Column', 'megafactory-core' ),
                'desc'     => esc_html__( 'Select widget area for showing fourth column of top sliding bar.', 'megafactory-core' ),
                'data'     => 'sidebars',
				'required' 		=> array('header-top-sliding-cols', '<=', '3')
            ),
			array(
                'id'     => 'header-top-slide-settings-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-top-sliding-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Top Sliding Bar Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for header top sliding bar. Here you can set top sliding bar font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
				'required' 		=> array( 
					array('header-type', '=', 'default' ),
					array('header-top-sliding-switch', '=', 1 )
				)
            ),
			$header_top_slide_skin[0],
			$header_top_slide_skin[1],
			$header_top_slide_skin[2],
			$header_top_slide_skin[3],
			$header_top_slide_skin[4],
			array(
                'id'     => 'header-top-sliding-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'search-toggle-form',
                'type'     => 'select',
                'title'    => esc_html__( 'Toggle Search Modal', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Select serach box toggle modal.', 'megafactory-core' ),
                'options'  => array(
                    '1' => esc_html__( 'Full Screen Search', 'megafactory-core' ),
                    '2' => esc_html__( 'Text Box Toggle Search', 'megafactory-core' ),
					'3' => esc_html__( 'Full Bar Toggle Search', 'megafactory-core' ),
					'4' => esc_html__( 'Bottom Seach Box Toggle', 'megafactory-core' ),
                ),
                'default'  => '1'
            ),
		)
    ) );
	
	//Header -> Header Top Bar
	$header_topbar_skin = $acf->themeSkinSettings('header-topbar');
	$header_topbar_ads = $acf->themeAdsList('header-topbar', 'top bar');
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Top Bar', 'megafactory-core' ),
        'id'         => 'header-topbar',
        'desc'       => esc_html__( 'This is the setting for Header top bar', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'header-topbar-height',
				'type'     => 'dimensions',
				'units'		=> array( 'px' ),
				'units_extended'=> 'false',
				'width'    => false,
				'title'    => esc_html__( 'Header Top Bar Height', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease header topbar height.', 'megafactory-core' ),
				'default'  => array(
					'height'  => '60',
					'units'=> 'px'
				),
			),
			array(
				'id'       => 'header-topbar-sticky-height',
				'type'     => 'dimensions',
				'units'			=> array( 'px' ),
				'units_extended'=> 'false',
				'width'    => false,
				'title'    => esc_html__( 'Header Top Bar Sticky Height', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease header topbar sticky height.', 'megafactory-core' ),
				'default'  => array(
					'height'  => '50',
					'units'=> 'px'
				),
			),
			array(
                'id'       => 'header-topbar-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Topbar Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for header topbar. Here you can set header topbar font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			$header_topbar_skin[0],
			$header_topbar_skin[1],
			$header_topbar_skin[2],
			$header_topbar_skin[3],
			$header_topbar_skin[4],
			array(
                'id'     => 'header-topbar-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-topbar-text-1',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 1', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Custom text shows header topbar. Here, you can place shortcode.', 'megafactory-core' )
            ),
			array(
                'id'       => 'header-topbar-text-2',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 2', 'megafactory-core' ),
                'subtitle' => esc_html__( 'One more custom text shows header topbar. Here, you can place shortcode.', 'megafactory-core' )
            ),
			array(
                'id'       => 'header-topbar-date',
                'type'     => 'text',
                'title'    => esc_html__( 'Date Format', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter date format like: l, F j, Y', 'megafactory-core' ),
                'default'  => 'l, F j, Y',
            ),
			$header_topbar_ads,
			array(
				'id'      => 'header-topbar-items',
				'type'    => 'sorter',
				'title'   => esc_html__( 'Header Top Bar Items', 'megafactory-core' ),
				'desc'    => esc_html__( 'Needed header topbar items drag from disabled and put enabled.', 'megafactory-core' ),
				'options' => array(
					'disabled' => array(
						'header-topbar-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
						'header-topbar-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
						'header-topbar-menu'    => esc_html__( 'Top Bar Menu', 'megafactory-core' ),
						'header-topbar-social'	=> esc_html__( 'Social', 'megafactory-core' ),
						'header-topbar-search'	=> esc_html__( 'Search', 'megafactory-core' ),
						'header-topbar-ads-list'    => esc_html__( 'Ads', 'megafactory-core' ),
						'header-topbar-date' => esc_html__( 'Date', 'megafactory-core' ),
						'header-phone'   		=> esc_html__( 'Phone Number', 'megafactory-core' ),
						'header-address'  		=> esc_html__( 'Address Text', 'megafactory-core' ),
						'header-email'   		=> esc_html__( 'Email', 'megafactory-core' )
					),
					'Left'  => array(												
					),
					'Center' => array(
					),
					'Right' => array(
						
					)
				),
			),
		)
    ) );
	
	//Header -> Header Logo Section
	$header_logobar_skin = $acf->themeSkinSettings('header-logobar');
	$sticky_header_logobar_skin = $acf->themeSkinSettings('sticky-header-logobar');
	$header_logobar_ads = $acf->themeAdsList('header-logobar', 'logo bar');
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Logo Section', 'megafactory-core' ),
        'id'         => 'header-logobar',
        'desc'       => esc_html__( 'This is the setting for header logo section.', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'header-logobar-height',
				'type'     => 'dimensions',
				'units'			=> array( 'px' ),
				'units_extended'=> 'false',
				'width'    => false,
				'title'    => esc_html__( 'Header Logo Section Height', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease header logo section height.', 'megafactory-core' ),
				'default'  => array(
					'height'  => 120,
					'units'=> 'px'
				),
			),
			array(
				'id'       => 'header-logobar-sticky-height',
				'type'     => 'dimensions',
				'units'			=> array( 'px' ),
				'units_extended'=> 'false',
				'width'    => false,
				'title'    => esc_html__( 'Header Logo Section Sticky Height', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease header logo section sticky height.', 'megafactory-core' ),
				'default'  => array(
					'height'  => 90,
					'units'=> 'px'
				),
			),
			array(
                'id'       => 'header-logobar-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Logo Section Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for header logo section. Here you can set header logo section font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			$header_logobar_skin[0],
			$header_logobar_skin[1],
			$header_logobar_skin[2],
			$header_logobar_skin[3],
			$header_logobar_skin[4],
			array(
                'id'     => 'header-logobar-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-logobar-text-1',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 1', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Custom text shows header logo section. Here, you can place shortcode.', 'megafactory-core' )
            ),
			array(
                'id'       => 'header-sticky-logobar-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Sticky Header Logo Section Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for sticky header logo section. Here you can set sticky header logo section font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			array(
				'id'       => 'sticky-header-logobar-color',
				'type'     => 'color',
				'title'    => __('Font Color', 'megafactory-core'), 
				'subtitle' => __('Pick a font color for sticky header logo section.', 'megafactory-core'),
				'validate' => 'color',
			),
			$sticky_header_logobar_skin[1],
			$sticky_header_logobar_skin[2],
			$sticky_header_logobar_skin[3],
			$sticky_header_logobar_skin[4],
			array(
                'id'     => 'header-sticky-logobar-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-logobar-text-1',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 1', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Custom text shows header logo section. Here, you can place shortcode.', 'megafactory-core' )
            ),
			array(
                'id'       => 'header-logobar-text-2',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 2', 'megafactory-core' ),
                'subtitle' => esc_html__( 'One more custom text shows header logo section. Here, you can place shortcode.', 'megafactory-core' )
            ),
			$header_logobar_ads,
			array(
				'id'      => 'header-logobar-items',
				'type'    => 'sorter',
				'title'   => esc_html__( 'Header Logo Section Items', 'megafactory-core' ),
				'desc'    => esc_html__( 'Needed header logo section items drag from disabled and put enabled.', 'megafactory-core' ),
				'options' => array(
					'disabled' => array(
						'header-logobar-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
						'header-logobar-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),						
						'header-logobar-ads-list'    => esc_html__( 'Ads', 'megafactory-core' ),
						'header-logobar-social'	=> esc_html__( 'Social', 'megafactory-core' ),
						'header-logobar-search'	=> esc_html__( 'Search', 'megafactory-core' ),
						'header-logobar-secondary-toggle'	=> esc_html__( 'Secondary Toggle', 'megafactory-core' ),						
						'header-phone'   		=> esc_html__( 'Phone Number', 'megafactory-core' ),
						'header-address'  		=> esc_html__( 'Address Text', 'megafactory-core' ),
						'header-email'   		=> esc_html__( 'Email', 'megafactory-core' )
					),
					'Left'  => array(
						'header-logobar-logo'	=> esc_html__( 'Logo', 'megafactory-core' ),											
					),
					'Center' => array(
						
					),
					'Right' => array(
						'header-logobar-menu'    => esc_html__( 'Main Menu', 'megafactory-core' ),
						'header-logobar-search-toggle'	=> esc_html__( 'Search Toggle', 'megafactory-core' )						
					)
				),
			),
		)
    ) );
	
	//Header -> Header Navbar
	$header_navbar_skin = $acf->themeSkinSettings('header-navbar');
	$sticky_header_navbar_skin = $acf->themeSkinSettings('sticky-header-navbar');
	$header_navbar_ads = $acf->themeAdsList('header-navbar', 'navbar');
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Navbar', 'megafactory-core' ),
        'id'         => 'header-navbar',
        'desc'       => esc_html__( 'This is the setting for header navbar section.', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'header-navbar-height',
				'type'     => 'dimensions',
				'units'			=> array( 'px' ),
				'units_extended'=> 'false',
				'width'    => false,
				'title'    => esc_html__( 'Header Navbar Height', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease header Navbar height.', 'megafactory-core' ),
				'default'  => array(
					'height'  => 75,
					'units'=> 'px'
				),
			),
			array(
				'id'       => 'header-navbar-sticky-height',
				'type'     => 'dimensions',
				'units'			=> array( 'px' ),
				'width'    => false,
				'title'    => esc_html__( 'Header Navbar Sticky Height', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease header navbar stikcy height.', 'megafactory-core' ),
				'default'  => array(
					'height'  => 75,
					'units'=> 'px'
				),
			),
			array(
                'id'       => 'header-navbar-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Navbar Section Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for header navbar section. Here you can set header navbar font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			$header_navbar_skin[0],
			$header_navbar_skin[1],
			$header_navbar_skin[2],
			$header_navbar_skin[3],
			$header_navbar_skin[4],
			array(
                'id'     => 'header-navbar-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-sticky-navbar-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Sticky Header Navbar Section Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for sticky header navbar section. Here you can set sticky header navbar section font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			array(
				'id'       => 'sticky-header-navbar-color',
				'type'     => 'color',
				'title'    => __('Font Color', 'megafactory-core'), 
				'subtitle' => __('Pick a font color for sticky header navbar section.', 'megafactory-core'),
				'validate' => 'color',
			),
			$sticky_header_navbar_skin[1],
			$sticky_header_navbar_skin[2],
			$sticky_header_navbar_skin[3],
			$sticky_header_navbar_skin[4],
			array(
                'id'     => 'header-sticky-navbar-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-navbar-text-1',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 1', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Custom text shows header navbar section. Here, you can place shortcode.', 'megafactory-core' )
            ),
			array(
                'id'       => 'header-navbar-text-2',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 2', 'megafactory-core' ),
                'subtitle' => esc_html__( 'One more custom text shows header navbar section. Here, you can place shortcode.', 'megafactory-core' )
            ),
			$header_navbar_ads,
			array(
				'id'      => 'header-navbar-items',
				'type'    => 'sorter',
				'title'   => esc_html__( 'Header Navbar Section Items', 'megafactory-core' ),
				'desc'    => esc_html__( 'Needed header navbar section items drag from disabled and put enabled.', 'megafactory-core' ),
				'options' => array(
					'disabled' => array(
						'header-navbar-menu'    => esc_html__( 'Main Menu', 'megafactory-core' ),
						'header-navbar-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
						'header-navbar-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
						'header-navbar-logo'	=> esc_html__( 'Logo', 'megafactory-core' ),
						'header-navbar-search-toggle'	=> esc_html__( 'Search Toggle', 'megafactory-core' ),
						'header-navbar-social'	=> esc_html__( 'Social', 'megafactory-core' ),
						'header-navbar-secondary-toggle'	=> esc_html__( 'Secondary Toggle', 'megafactory-core' ),
						'header-navbar-sticky-logo'	=> esc_html__( 'Stikcy Logo', 'megafactory-core' ),
						'header-navbar-search'	=> esc_html__( 'Search', 'megafactory-core' ),
						'header-navbar-ads-list'    => esc_html__( 'Ads', 'megafactory-core' ),
						'header-phone'   		=> esc_html__( 'Phone Number', 'megafactory-core' ),
						'header-address'  		=> esc_html__( 'Address Text', 'megafactory-core' ),
						'header-email'   		=> esc_html__( 'Email', 'megafactory-core' ),
						'header-cart'   		=> esc_html__( 'Cart', 'megafactory-core' )
					),
					'Left'  => array(						
					),
					'Center' => array(
					),
					'Right' => array(						
					)
				),
			),
		)
    ) );
	
	//Header -> Header Left
	$header_left_skin = $acf->themeSkinSettings('header-fixed');
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header Sticky/Fixed', 'megafactory-core' ),
        'id'         => 'header-fixed',
        'desc'       => esc_html__( 'This is the setting for fixed header left/right in body.', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'header-fixed-width',
				'type'     => 'dimensions',
				'units'		=> array( 'px' ),
				'units_extended'=> 'false',
				'height'    => false,
				'title'    => esc_html__( 'Sticky Header Width', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease left sticky header width.', 'megafactory-core' ),
				'default'  => array(
					'width'  => 350,
					'units'=> 'px'
				)
			),
			array(
                'id'       => 'header-fixed-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Sticky Header Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for sticky header. Here you can set sticky header font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			$header_left_skin[0],
			$header_left_skin[2],
			$header_left_skin[3],
			$header_left_skin[4],
			array(
                'id'       => 'header-fixed-background',
                'type'     => 'background',
                'title'    => esc_html__( 'Background', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for sticky header background.', 'megafactory-core' ),
                'default'   => '',
            ),
			array(
                'id'     => 'header-fixed-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'header-fixed-text-1',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 1', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Custom text shows on sticky header. Here, you can place shortcode.', 'megafactory-core' )
            ),
			array(
                'id'       => 'header-fixed-text-2',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 2', 'megafactory-core' ),
                'subtitle' => esc_html__( 'One more custom text shows on sticky header. Here, you can place shortcode.', 'megafactory-core' )
            ),
			array(
				'id'      => 'header-fixed-items',
				'type'    => 'sorter',
				'title'   => esc_html__( 'Sticky/Fixed Header Items', 'megafactory-core' ),
				'desc'    => esc_html__( 'Needed stciky header items drag from disabled and put enabled.', 'megafactory-core' ),
				'options' => array(
					'disabled' => array(
						'header-fixed-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
						'header-fixed-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
						'header-fixed-search'	=> esc_html__( 'Search Form', 'megafactory-core' ),
						'header-fixed-logo' => esc_html__( 'Logo', 'megafactory-core' ),
						'header-fixed-menu'	=> esc_html__( 'Menu', 'megafactory-core' ),
						'header-fixed-social'	=> esc_html__( 'Social', 'megafactory-core' )
					),
					'Top'  => array(						
					),
					'Middle'  => array(											
					),
					'Bottom'  => array(											
					)
				),
			),
		)
    ) );
	
	//Header -> Mobile Menu Space
	$mobile_menu_skin = $acf->themeSkinSettings('mobile-menu');
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Mobile Menu', 'megafactory-core' ),
        'id'         => 'mobile-menu',
        'desc'       => esc_html__( 'This is the setting for mobile menu', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'mobile-header-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Mobile Header Settings', 'megafactory-core' ),
                'indent'   => true, 
            ),
			array(
                'id'       => 'mobile-header-from',
                'type'     => 'select',
                'title'    => esc_html__( 'Mobile Header From', 'megafactory-core' ),
				'desc' => esc_html__( 'Choose your mobile header shows from tablet, tablet landscape or mobile', 'megafactory-core' ),
                'options'  => array(
                    'mobile' => esc_html__( 'Mobile', 'megafactory-core' ),
					'tab-port' => esc_html__( 'Tablet (portrait)', 'megafactory-core' ),
                    'tab-land' => esc_html__( 'Tablet (landscape)', 'megafactory-core' ),
                ),
                'default'  => 'tab-land'
            ),
			array(
				'id'       => 'mobile-header-height',
				'type'     => 'dimensions',
				'units'		=> array( 'px' ),
				'units_extended'=> 'false',
				'width'    => false,
				'title'    => esc_html__( 'Mobile Header Height', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease mobile header width.', 'megafactory-core' ),
				'default'  => array(
					'height'  => 80,
					'units'=> 'px'
				)
			),
			array(
                'id'       => 'mobile-header-background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Choose mobile header background color.', 'megafactory-core' ),
                'default'  => array(
                    'color' => '#000000',
                    'alpha' => ''
                ),
                'mode'     => 'background',
            ),
			array(
                'id'       => 'mobile-header-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Links Color', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Choose mobile header link color options.', 'megafactory-core' ),
                'default'  => array(
                    'regular' => '#ffffff',
                    'hover'   => '#ffc811',
                    'active'  => '#ffc811',
                )
            ),
			array(
                'id'       => 'mobile-header-sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Mobile Header Sticky', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable this option to sticky mobile header.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
            ),
			array(
                'id'       => 'mobile-header-sticky-scrollup',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Scroll Up', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable this option to sticky mobile header only scroll up.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
				'required' 		=> array('mobile-header-sticky', '!=', 0)
            ),
			array(
				'id'       => 'mobile-header-sticky-height',
				'type'     => 'dimensions',
				'units'		=> array( 'px' ),
				'units_extended'=> 'false',
				'width'    => false,
				'title'    => esc_html__( 'Mobile Header Sticky Height', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease mobile header sticky height.', 'megafactory-core' ),
				'default'  => array(
					'height'  => 60,
					'units'=> 'px'
				),
				'required' 		=> array('mobile-header-sticky', '!=', 0)
			),
			array(
                'id'       => 'mobile-header-sticky-background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Background', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Choose mobile header sticky background color.', 'megafactory-core' ),
                'default'  => array(
                    'color' => '',
                    'alpha' => ''
                ),
                'mode'     => 'background',
				'required' 		=> array('mobile-header-sticky', '!=', 0)
            ),
			array(
                'id'       => 'mobile-header-sticky-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Sticky Links Color', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Choose mobile header sticky link color options.', 'megafactory-core' ),
                'default'  => array(
                    'regular' => '',
                    'hover'   => '',
                    'active'  => '',
                ),
				'required' 		=> array('mobile-header-sticky', '!=', 0)
            ),
			array(
				'id'      => 'mobile-header-items',
				'type'    => 'sorter',
				'title'   => esc_html__( 'Mobile Header Items', 'megafactory-core' ),
				'desc'    => esc_html__( 'Needed mobile header items drag from disabled and put enabled parts like left, center or right.', 'megafactory-core' ),
				'options' => array(
					'disabled' => array(
						'mobile-header-cart'	=> esc_html__( 'Cart Icon', 'megafactory-core' )
					),
					'Left'  => array(
						'mobile-header-menu'	=> esc_html__( 'Menu Icon', 'megafactory-core' )		
					),
					'Center'  => array(
						'mobile-header-logo' => esc_html__( 'Logo', 'megafactory-core' )
					),
					'Right'  => array(
						'mobile-header-search'	=> esc_html__( 'Search Icon', 'megafactory-core' )
					)
				),
			),
			array(
                'id'     => 'mobile-header-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'mobile-menu-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Mobile Menu Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for mobile menu area. Here you can set mobile menu space font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			array(
				'id'       => 'mobile-menu-max-width',
				'type'     => 'dimensions',
				'units'		=> array( 'px' ),
				'units_extended'=> 'false',
				'height'    => false,
				'title'    => esc_html__( 'Mobile Menu Max Width', 'megafactory-core' ),
				'desc'     => esc_html__( 'Increase or decrease mobile menu maximum width. If you need full width means just leave this empty.', 'megafactory-core' ),
				'default'  => array(
					'width'  => '',
					'units'=> 'px'
				)
			),
			$mobile_menu_skin[0],
			$mobile_menu_skin[2],
			$mobile_menu_skin[3],
			$mobile_menu_skin[4],
			array(
                'id'       => 'mobile-menu-background',
                'type'     => 'background',
                'title'    => esc_html__( 'Background', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for mobile menu background.', 'megafactory-core' ),
                'default'   => '',
            ),
			array(
                'id'       => 'mobile-menu-animate-from',
                'type'     => 'select',
                'title'    => esc_html__( 'Mobile Header Animate From', 'megafactory-core' ),
				'desc' => esc_html__( 'Choose your mobile header animate from left, right, top or bottom.', 'megafactory-core' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'megafactory-core' ),
					'right' => esc_html__( 'Right', 'megafactory-core' ),
                    'top' => esc_html__( 'Top', 'megafactory-core' ),
					'bottom' => esc_html__( 'Bottom', 'megafactory-core' ),
                ),
                'default'  => 'left'
            ),
			array(
                'id'     => 'mobile-menu-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'mobile-menu-text-1',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 1', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Custom text shows on mobile menu space. Here, you can place shortcode.', 'megafactory-core' )
            ),
			array(
                'id'       => 'mobile-menu-text-2',
                'type'     => 'text',
                'title'    => esc_html__( 'Custom Text 2', 'megafactory-core' ),
                'subtitle' => esc_html__( 'One more custom text shows on mobile menu space. Here, you can place shortcode.', 'megafactory-core' )
            ),
			array(
				'id'      => 'mobile-menu-items',
				'type'    => 'sorter',
				'title'   => esc_html__( 'Mobile Menu Items', 'megafactory-core' ),
				'desc'    => esc_html__( 'Needed mobile menu items drag from disabled and put enabled.', 'megafactory-core' ),
				'options' => array(
					'disabled' => array(
						'mobile-menu-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
						'mobile-menu-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
						'mobile-menu-search'	=> esc_html__( 'Search Form', 'megafactory-core' ),
						'mobile-menu-social'	=> esc_html__( 'Social', 'megafactory-core' )
					),
					'Top'  => array(
						'mobile-menu-logo' => esc_html__( 'Logo', 'megafactory-core' )
					),
					'Middle'  => array(
						'mobile-menu-mainmenu'	=> esc_html__( 'Menu', 'megafactory-core' )
					),
					'Bottom'  => array(						
					)
				),
			),
		)
    ) );
	
	//Footer Tab
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Footer', 'megafactory-core' ),
        'id'               => 'footer',
        'desc'             => esc_html__( 'These are footer general settings of megafactory theme', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-credit-card'
    ) );
	
	//Footer -> Footer General
	$footer_skin = $acf->themeSkinSettings('footer');
	$footer_ads = $acf->themeAdsList('footer', 'footer');
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer General', 'megafactory-core' ),
        'id'         => 'footer-general',
        'desc'       => esc_html__( 'This is the setting for Footer General', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'footer-layout',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Footer Layout', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Choose footer layout boxed or wide.', 'megafactory-core' ),
				'options' => array(
					'boxed' => esc_html__( 'Boxed', 'megafactory-core' ),
					'wide'  => esc_html__( 'Wide', 'megafactory-core' ),
				),
				'default'  => 'wide',
				'required' 		=> array('page-layout', '=', 'wide')
			),
			array(
                'id'       => 'back-to-top',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back To Top', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable back to top icon.', 'megafactory-core' ),
                'default'  => 1,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
            ),
			array(
                'id'       => 'hidden-footer',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hidden Footer', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable hidden footer.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
            ),
			array(
                'id'       => 'footer-settings-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for footer. Here you can set footer font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			$footer_skin[0],
			$footer_skin[2],
			$footer_skin[3],
			$footer_skin[4],
			array(
                'id'       => 'footer-background',
                'type'     => 'background',
                'title'    => esc_html__( 'Background', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for footer background.', 'megafactory-core' ),
                'default'   => '',
            ),
			array(
                'id'       => 'footer-background-overlay',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background Overlay', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Choose background overlay color.', 'megafactory-core' ),
                'default'  => array(
                    'color' => '',
                    'alpha' => ''
                ),
                'mode'     => 'background',
            ),
			array(
                'id'     => 'footer-settings-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			$footer_ads,
			array(
				'id'      => 'footer-items',
				'type'    => 'sorter',
				'title'   => esc_html__( 'Footer Items', 'megafactory-core' ),
				'desc'    => esc_html__( 'Needed footer items drag from disabled and put enabled.', 'megafactory-core' ),
				'options' => array(
					'Enabled'  => array(
						'footer-middle'	=> esc_html__( 'Footer Middle', 'megafactory-core' ),
						'footer-bottom'	=> esc_html__( 'Footer Bottom', 'megafactory-core' )
					),
					'disabled' => array(
						'footer-top' => esc_html__( 'Footer Top', 'megafactory-core' )
					)
				),
			),
		)
    ) );
	
	//Footer -> Footer Top
	$footer_skin = $acf->themeSkinSettings('footer-top');
	$footer_top_sidebars = $acf->themeSidebarsList( 'footer-top', array( 'title' => esc_html__( 'Footer Top Columns', 'megafactory-core' ), 'default' => '4' ) );
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Top', 'megafactory-core' ),
        'id'         => 'footer-top',
        'desc'       => esc_html__( 'This is the setting for footer top.', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'footer-top-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Top Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for footer top. Here you can set footer top font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			array(
				'id'       => 'footer-top-container',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Footer Top Inner Layout', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Choose footer top layout boxed or wide.', 'megafactory-core' ),
				'options' => array(
					'boxed' => esc_html__( 'Boxed', 'megafactory-core' ),
					'wide'  => esc_html__( 'Wide', 'megafactory-core' ),
				),
				'default'  => 'boxed'
			),
			$footer_skin[0],
			$footer_skin[1],
			$footer_skin[2],
			$footer_skin[3],
			$footer_skin[4],
			$footer_skin[6],
			array(
                'id'       => 'footer-top-title-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Widget Title Color', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Choose footer top widgets title color.', 'megafactory-core' ),
				'validate' => 'color'
            ),
			array(
                'id'     => 'footer-top-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'footer-sidebars-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Top Columns and Sidebars Settings', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for footer top columns and sidebars. Choose number of columns and set needed widgets to selected sidebars.', 'megafactory-core' ),
                'indent'   => true, 
            ),
			$footer_top_sidebars[0],
			$footer_top_sidebars[1],
			$footer_top_sidebars[2],
			$footer_top_sidebars[3],
			$footer_top_sidebars[4],
			array(
                'id'     => 'footer-sidebars-end',
                'type'   => 'section',
                'indent' => false, 
            ),
		)
    ) );
	
	//Footer -> Footer Middle
	$footer_skin = $acf->themeSkinSettings('footer-middle');
	$footer_top_sidebars = $acf->themeSidebarsList( 'footer-middle', array( 'title' => esc_html__( 'Footer Middle Columns', 'megafactory-core' ), 'default' => '12' ) );
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Middle', 'megafactory-core' ),
        'id'         => 'footer-middle',
        'desc'       => esc_html__( 'This is the setting for footer middle.', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'footer-middle-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Middle Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for footer middle. Here you can set footer middle font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			array(
				'id'       => 'footer-middle-container',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Footer Middle Inner Layout', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Choose footer middle layout boxed or wide.', 'megafactory-core' ),
				'options' => array(
					'boxed' => esc_html__( 'Boxed', 'megafactory-core' ),
					'wide'  => esc_html__( 'Wide', 'megafactory-core' ),
				),
				'default'  => 'boxed'
			),
			$footer_skin[0],
			$footer_skin[1],
			$footer_skin[2],
			$footer_skin[3],
			$footer_skin[4],
			$footer_skin[6],
			array(
                'id'       => 'footer-middle-title-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Widget Title Color', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Choose footer middle widgets title color.', 'megafactory-core' ),
				'validate' => 'color'
            ),
			array(
                'id'     => 'footer-middle-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'footer-middle-sidebars-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Middle Columns and Sidebars Settings', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for footer middle columns and sidebars. Choose number of columns and set needed widgets to selected sidebars.', 'megafactory-core' ),
                'indent'   => true, 
            ),
			$footer_top_sidebars[0],
			$footer_top_sidebars[1],
			$footer_top_sidebars[2],
			$footer_top_sidebars[3],
			$footer_top_sidebars[4],
			array(
                'id'     => 'footer-middle-sidebars-end',
                'type'   => 'section',
                'indent' => false, 
            ),
		)
    ) );
	
	//Footer -> Footer Bottom
	$footer_skin = $acf->themeSkinSettings('footer-bottom');
	$footer_top_sidebars = $acf->themeSidebarsList( 'footer-bottom', array( 'title' => esc_html__( 'Footer Bottom Columns', 'megafactory-core' ), 'default' => '12' ) );
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer Bottom', 'megafactory-core' ),
        'id'         => 'footer-bottom',
        'desc'       => esc_html__( 'This is the setting for footer bottom.', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'footer-bottom-container',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Footer Bottom Inner Layout', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Choose footer bottom layout boxed or wide.', 'megafactory-core' ),
				'options' => array(
					'boxed' => esc_html__( 'Boxed', 'megafactory-core' ),
					'wide'  => esc_html__( 'Wide', 'megafactory-core' ),
				),
				'default'  => 'boxed'
			),
			array(
				'id'	=>'copyright-text',
				'type'	=> 'textarea',
				'title'	=> esc_html__( 'Copyright Text', 'megafactory-core' ), 
				'desc'	=> esc_html__( 'This is the copyright text. Shown on footer bottom if enable footer bottom in footer items', 'megafactory-core' ),
				'default'	=> '&copy; Copyright 2017. All Rights Reserved. Designed by <a href="http://zozothemes.com/">Zozo Themes</a>',
			),
			array(
                'id'       => 'footer-bottom-fixed',
                'type'     => 'switch',
                'title'    => esc_html__( 'Footer Bottom Fixed', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable footer bottom to fixed at bottom of page.', 'megafactory-core' ),
                'default'  => 0,
                'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
            ),
			array(
                'id'       => 'footer-bottom-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Bottom Skin', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is individual skin settings for footer bottom. Here you can set footer bottom font color, link color, etc..', 'megafactory-core' ),
                'indent'   => true, 
            ),
			$footer_skin[0],
			$footer_skin[1],
			$footer_skin[2],
			$footer_skin[3],
			$footer_skin[4],
			$footer_skin[6],
			array(
                'id'       => 'footer-bottom-title-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Widget Title Color', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Choose footer bottom widgets title color.', 'megafactory-core' ),
				'validate' => 'color'
            ),
			array(
                'id'     => 'footer-bottom-end',
                'type'   => 'section',
                'indent' => false, 
            ),
			array(
                'id'       => 'footer-bottom-widget',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Bottom Widget', 'megafactory-core' ),
                'desc'     => esc_html__( 'Select widget area for showing on footer copyright section.', 'megafactory-core' ),
                'data'     => 'sidebars',
            ),
			array(
				'id'      => 'footer-bottom-items',
				'type'    => 'sorter',
				'title'   => esc_html__( 'Footer Bottom Items', 'megafactory-core' ),
				'desc'    => esc_html__( 'Needed footer bottom items drag from disabled and put enabled.', 'megafactory-core' ),
				'options' => array(
					'disabled' => array(
						'social'	=> esc_html__( 'Footer Social Links', 'megafactory-core' ),
						'widget'	=> esc_html__( 'Custom Widget', 'megafactory-core' )

					),
					'Left'  => array(
						'copyright' => esc_html__( 'Copyright Text', 'megafactory-core' )
					),
					'Center'  => array(

					),
					'Right'  => array(
						'menu'	=> esc_html__( 'Footer Menu', 'megafactory-core' )
					)
				),
			),
		)
    ) );
	
	//Page Template
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Page Template', 'megafactory-core' ),
        'id'               => 'template',
        'desc'             => esc_html__( 'These is the template settings for page.', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-newspaper-o'
    ) );
	
	//Templates -> Page
	$template = 'page'; $template_cname = 'Page'; $template_sname = 'page';
	$template_t = $acf->themeSkinSettings('template-'.$template);
	$page_title_items = $acf->themePageTitleItems('template-'.$template);
	$color = $acf->themeFontColor('template-'.$template);
	
	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Page Template', 'megafactory-core' ),
		'id'         => 'template-page',
		'desc'       => esc_html__( 'This is the setting for page template', 'megafactory-core' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => $template.'-page-title-opt',
				'type'     => 'switch',
				'title'    => sprintf( esc_html__( '%1$s Title', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable %1$s page title.', 'megafactory-core' ), $template_sname ),
				'default'  => 0,
				'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
			),
			array(
				'id'       => $template.'-pagetitle-settings-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Page Title Settings', 'megafactory-core' ),
				'subtitle' => esc_html__( 'This is page title style settings for this template', 'megafactory-core' ),
				'indent'   => true, 
				'required' 		=> array($template.'-page-title-opt', '=', 1)
			),
			$color[0],
			$template_t[2],
			$template_t[3],
			$template_t[4],
			$template_t[5],
			array(
				'id'       => $template.'-page-title-parallax',
				'type'     => 'switch',
				'title'    => esc_html__( 'Background Parallax', 'megafactory-core' ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable %1$s page title background parallax.', 'megafactory-core' ), $template_sname ),
				'default'  => 0,
				'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
			),
			array(
				'id'       => $template.'-page-title-bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Background Video', 'megafactory-core' ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable %1$s page title background video.', 'megafactory-core' ), $template_sname ),
				'default'  => 0,
				'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
			),
			array(
				'id'       => $template.'-page-title-video',
				'type'     => 'text',
				'title'    => sprintf( esc_html__( '%1$s Page Title Background Video', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'Set page title background video for %1$s page. Only allowed youtube video id. Example: UWF7dZTLW4c', 'megafactory-core' ), $template_sname ),
				'required' => array($template.'-page-title-bg', '=', 1),
				'default'  => ''
			),
			array(
                'id'       => $template.'-page-title-overlay',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Page Title Overlay', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Choose page title overlay rgba color.', 'megafactory-core' ),
                'default'  => array(
                    'color' => '',
                    'alpha' => ''
                ),
                'mode'     => 'background',
            ),
			$page_title_items[0],
			array(
				'id'     => $template.'-pagetitle-settings-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => $template.'-settings-start',
				'type'     => 'section',
				'title'    => sprintf( esc_html__( '%1$s Settings', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'This is settings for %1$s', 'megafactory-core' ), $template_sname ),
				'indent'   => true
			),
			array(
				'id'       => $template.'-page-template',
				'type'     => 'image_select',
				'title'    => sprintf( esc_html__( '%1$s Template', 'megafactory-core' ), $template_cname ),
				'desc'     => sprintf( esc_html__( 'Choose your current %1$s page template.', 'megafactory-core' ), $template_sname ),
				'options'  => array(
					'no-sidebar' => array(
						'alt' => esc_html__( 'No Sidebar', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/page-layouts/1.png'
					),
					'right-sidebar' => array(
						'alt' => esc_html__( 'Right Sidebar', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/page-layouts/2.png'
					),
					'left-sidebar' => array(
						'alt' => esc_html__( 'Left Sidebar', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/page-layouts/3.png'
					),
					'both-sidebar' => array(
						'alt' => esc_html__( 'Both Sidebar', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/page-layouts/4.png'
					)
				),
				'default'  => 'right-sidebar'
			),
			array(
				'id'       => $template.'-left-sidebar',
				'type'     => 'select',
				'title'    => esc_html__( 'Choose Left Sidebar', 'megafactory-core' ),
				'desc'     => sprintf( esc_html__( 'Select widget area for showing %1$s on left sidebar.', 'megafactory-core' ), $template_sname ),
				'data'     => 'sidebars',
				'required' 		=> array($template.'-page-template', '=', array( 'left-sidebar', 'both-sidebar' ))
			),
			array(
				'id'       => $template.'-right-sidebar',
				'type'     => 'select',
				'title'    => esc_html__( 'Choose Right Sidebar', 'megafactory-core' ),
				'desc'     => sprintf( esc_html__( 'Select widget area for showing %1$s on right sidebar.', 'megafactory-core' ), $template_sname ),
				'data'     => 'sidebars',
				'default'  => 'sidebar-1',
				'required' 		=> array($template.'-page-template', '=', array( 'right-sidebar', 'both-sidebar' ))
			),
			array(
				'id'       => $template.'-sidebar-sticky',
				'type'     => 'switch',
				'title'    => esc_html__( 'Sidebar Sticky', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable sidebar sticky.', 'megafactory-core' ),
				'default'  => 1,
				'on'       => esc_html__( 'Enable', 'megafactory-core' ),
				'off'      => esc_html__( 'Disable', 'megafactory-core' ),
				'required' => array($template.'-page-template', '!=', 'no-sidebar')
			),
			array(
				'id'       => $template.'-page-hide-sidebar',
				'type'     => 'switch',
				'title'    => esc_html__( 'Sidebar on Mobile', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable to show or hide sidebar on mobile.', 'megafactory-core' ),
				'default'  => 1,
				'on'       => esc_html__( 'Show', 'megafactory-core' ),
				'off'      => esc_html__( 'Hide', 'megafactory-core' ),
				'required' => array($template.'-page-template', '!=', 'no-sidebar')
			),
			array(
				'id'     => $template.'-settings-end',
				'type'   => 'section',
				'indent' => false, 
			)
		)
    ) );
	
	//Templates Tab
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Theme Templates', 'megafactory-core' ),
        'id'               => 'templates',
        'desc'             => esc_html__( 'These are the template settings for theme like blog, archive, etc..', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-th-large'
    ) );
	
	//Templates -> General
	$categories_array = $acf->themeCategories();	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Template General', 'megafactory-core' ),
        'id'         => 'templates-general',
        'desc'       => esc_html__( 'This is the setting for template general', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'theme-templates',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Theme Templates', 'megafactory-core' ),
				'desc'     => esc_html__( 'Active needed theme templates. Actived theme templates are show once save and refresh theme option page. Unselected templates choosing archive template if enabled archive otherwise choosing blog template for default layout.', 'megafactory-core' ),
				'multi'    => true,
				'options' => array(
					'archive'	=> esc_html__( 'Archive', 'megafactory-core' ),
					'category'	=> esc_html__( 'Category', 'megafactory-core' ),
					'tag'		=> esc_html__( 'Tag', 'megafactory-core' ),
					'search'	=> esc_html__( 'Search', 'megafactory-core' ),
					'author'	=> esc_html__( 'Author', 'megafactory-core' )
				),
				'default' => '',
			),
			array(
				'id'       => 'theme-categories',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Theme Categories Template', 'megafactory-core' ),
				'desc'     => esc_html__( 'Active needed category templates. Actived category templates are show once save and refresh theme option page. Unselected templates choosing order category/archive/blog template for default layout.', 'megafactory-core' ),
				'multi'    => true,
				'options' => $categories_array
			),
			array(
				'id'       => 'search-content',
				'type'     => 'select',
				'title'    => esc_html__( 'Search Content', 'megafactory-core' ),
				'desc'	   => esc_html__( 'Choose this option for search content from site.', 'megafactory-core' ),
				'options'  => array(
					'all'	=> esc_html__( 'All', 'megafactory-core' ),
					'post'	=> esc_html__( 'Post Content Only', 'megafactory-core' ),
					'page'	=> esc_html__( 'Page Content Only', 'megafactory-core' )
				),
				'default'  => 'post'
			),
		)
    ) );
	
	//Templates -> Single Post
	$template = 'single-post'; $template_cname = 'Single Post'; $template_sname = 'single post';
	$template_t = $acf->themeSkinSettings('template-'.$template);
	$template_article = $acf->themeSkinSettings($template.'-article');
	$template_article_overlay = $acf->themeSkinSettings($template.'-article-overlay');
	$page_title_items = $acf->themePageTitleItems('template-'.$template);
	$color = $acf->themeFontColor('template-'.$template);
	$template_article_color = $acf->themeFontColor($template.'-article');
	$template_article_overlay_color = $acf->themeFontColor($template.'-article-overlay');
	$overlay_margin = $acf->themeMarginFields( $template.'-article-overlay' );
	
	$article_top_ads = $acf->themeAdsList('article-top', 'article top', 'Article Top');
	$article_inline_ads = $acf->themeAdsList('article-inline', 'article inline', 'Article Inline');
	$article_bottom_ads = $acf->themeAdsList('article-bottom', 'article bottom', 'Article Bottom');

	
	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Single Post Template', 'megafactory-core' ),
		'id'         => 'templates-single-post',
		'desc'       => esc_html__( 'This is the setting for single post template', 'megafactory-core' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => $template.'-page-title-opt',
				'type'     => 'switch',
				'title'    => sprintf( esc_html__( '%1$s Page Title', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable %1$s page title.', 'megafactory-core' ), $template_sname ),
				'default'  => 0,
				'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
			),
			array(
				'id'       => $template.'-pagetitle-settings-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Page Title Settings', 'megafactory-core' ),
				'subtitle' => esc_html__( 'This is page title style settings for this template', 'megafactory-core' ),
				'indent'   => true, 
				'required' 		=> array($template.'-page-title-opt', '=', 1)
			),
			$color[0],
			$template_t[2],
			$template_t[3],
			$template_t[4],
			$template_t[5],
			array(
				'id'       => $template.'-page-title-parallax',
				'type'     => 'switch',
				'title'    => esc_html__( 'Background Parallax', 'megafactory-core' ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable %1$s page title background parallax.', 'megafactory-core' ), $template_sname ),
				'default'  => 0,
				'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
			),
			array(
				'id'       => $template.'-page-title-bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Background Video', 'megafactory-core' ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable %1$s page title background video.', 'megafactory-core' ), $template_sname ),
				'default'  => 0,
				'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
			),
			array(
				'id'       => $template.'-page-title-video',
				'type'     => 'text',
				'title'    => sprintf( esc_html__( '%1$s Page Title Background Video', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'Set page title background video for %1$s page. Only allowed youtube video id. Example: UWF7dZTLW4c', 'megafactory-core' ), $template_sname ),
				'required' => array($template.'-page-title-bg', '=', 1),
				'default'  => ''
			),
			array(
                'id'       => $template.'-page-title-overlay',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Page Title Overlay', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Choose page title overlay rgba color.', 'megafactory-core' ),
                'default'  => array(
                    'color' => '',
                    'alpha' => ''
                ),
                'mode'     => 'background',
            ),
			$page_title_items[0],
			array(
				'id'     => $template.'-pagetitle-settings-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => $template.'-featured-slider',
				'type'     => 'switch',
				'title'    => sprintf( esc_html__( '%1$s Featured Slider', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable %1$s featured slider.', 'megafactory-core' ), $template_sname ),
				'default'  => 0,
				'on'       => esc_html__( 'Enable', 'megafactory-core' ),
				'off'      => esc_html__( 'Disable', 'megafactory-core' ),
			),
			array(
				'id'       => $template.'-article-settings-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Article Skin', 'megafactory-core' ),
				'subtitle' => sprintf( esc_html__( 'This is skin settings for each %1$s article', 'megafactory-core' ), $template_sname ),
				'indent'   => true
			),
			$template_article_color[0],
			$template_article[2],
			$template_article[3],
			$template_article[4],
			$template_article[1],
			array(
				'id'     => $template.'-article-settings-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => $template.'-article-overlay-settings-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Article Overlay Skin', 'megafactory-core' ),
				'subtitle' => sprintf( esc_html__( 'This is skin settings for each %1$s article overlay.', 'megafactory-core' ), $template_sname ),
				'indent'   => true,
			),
			$template_article_overlay_color[0],
			$template_article_overlay[2],
			$template_article_overlay[3],
			$template_article_overlay[4],
			$overlay_margin,
			$template_article_overlay[1],
			array(
				'id'     => $template.'-article-overlay-settings-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => $template.'-post-formats-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Post Format Settings', 'megafactory-core' ),
				'subtitle' => sprintf( esc_html__( 'This is post format settings for %1$s', 'megafactory-core' ), $template_sname ),
				'indent'   => true
			),
			array(
				'id'       => $template.'-video-format',
				'type'     => 'select',
				'title'    => esc_html__( 'Video Format', 'megafactory-core' ),
				'desc'	   => sprintf( esc_html__( 'Choose %1$s page video post format settings.', 'megafactory-core' ), $template_sname ),
				'options'  => array(
					'onclick' => esc_html__( 'On Click Run Video', 'megafactory-core' ),
					'overlay' => esc_html__( 'Modal Box Video', 'megafactory-core' ),
					'direct' => esc_html__( 'Direct Video', 'megafactory-core' )
				),
				'default'  => 'onclick'
			),
			array(
				'id'       => $template.'-quote-format',
				'type'     => 'select',
				'title'    => esc_html__( 'Quote Format', 'megafactory-core' ),
				'desc'     => sprintf( esc_html__( 'Choose %1$s page quote post format settings.', 'megafactory-core' ), $template_sname ),
				'options'  => array(
					'featured' => esc_html__( 'Dark Overlay', 'megafactory-core' ),
					'theme-overlay' => esc_html__( 'Theme Overlay', 'megafactory-core' ),
					'theme' => esc_html__( 'Theme Color Background', 'megafactory-core' ),
					'none' => esc_html__( 'None', 'megafactory-core' )
				),
				'default'  => 'featured'
			),
			array(
				'id'       => $template.'-link-format',
				'type'     => 'select',
				'title'    => esc_html__( 'Link Format', 'megafactory-core' ),
				'desc'     => sprintf( esc_html__( 'Choose %1$s page link post format settings.', 'megafactory-core' ), $template_sname ),
				'options'  => array(
					'featured' => esc_html__( 'Dark Overlay', 'megafactory-core' ),
					'theme-overlay' => esc_html__( 'Theme Overlay', 'megafactory-core' ),
					'theme' => esc_html__( 'Theme Color Background', 'megafactory-core' ),
					'none' => esc_html__( 'None', 'megafactory-core' )
				),
				'default'  => 'featured'
			),
			array(
				'id'       => $template.'-gallery-format',
				'type'     => 'select',
				'title'    => esc_html__( 'Gallery Format', 'megafactory-core' ),
				'desc'     => sprintf( esc_html__( 'Choose %1$s page gallery post format settings.', 'megafactory-core' ), $template_sname ),
				'options'  => array(
					'default' => esc_html__( 'Default Gallery', 'megafactory-core' ),
					'popup' => esc_html__( 'Popup Gallery', 'megafactory-core' ),
					'grid' => esc_html__( 'Grid Popup Gallery', 'megafactory-core' )
				),
				'default'  => 'default'
			),
			array(
				'id'     => $template.'-post-formats-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => $template.'-settings-start',
				'type'     => 'section',
				'title'    => sprintf( esc_html__( '%1$s Settings', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'This is settings for %1$s', 'megafactory-core' ), $template_sname ),
				'indent'   => true
			),
			array(
				'id'       => $template.'-page-template',
				'type'     => 'image_select',
				'title'    => sprintf( esc_html__( '%1$s Template', 'megafactory-core' ), $template_cname ),
				'desc'     => sprintf( esc_html__( 'Choose your current %1$s page template.', 'megafactory-core' ), $template_sname ),
				'options'  => array(
					'no-sidebar' => array(
						'alt' => esc_html__( 'No Sidebar', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/page-layouts/1.png'
					),
					'right-sidebar' => array(
						'alt' => esc_html__( 'Right Sidebar', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/page-layouts/2.png'
					),
					'left-sidebar' => array(
						'alt' => esc_html__( 'Left Sidebar', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/page-layouts/3.png'
					),
					'both-sidebar' => array(
						'alt' => esc_html__( 'Both Sidebar', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/page-layouts/4.png'
					)
				),
				'default'  => 'right-sidebar'
			),
			array(
				'id'       => $template.'-left-sidebar',
				'type'     => 'select',
				'title'    => esc_html__( 'Choose Left Sidebar', 'megafactory-core' ),
				'desc'     => sprintf( esc_html__( 'Select widget area for showing %1$s page on left sidebar.', 'megafactory-core' ), $template_sname ),
				'data'     => 'sidebars',
				'required' 		=> array($template.'-page-template', '=', array( 'left-sidebar', 'both-sidebar' ))
			),
			array(
				'id'       => $template.'-right-sidebar',
				'type'     => 'select',
				'title'    => esc_html__( 'Choose Right Sidebar', 'megafactory-core' ),
				'desc'     => sprintf( esc_html__( 'Select widget area for showing %1$s page on right sidebar.', 'megafactory-core' ), $template_sname ),
				'data'     => 'sidebars',
				'default'  => 'sidebar-1',
				'required' 		=> array($template.'-page-template', '=', array( 'right-sidebar', 'both-sidebar' ))
			),
			array(
				'id'       => $template.'-sidebar-sticky',
				'type'     => 'switch',
				'title'    => esc_html__( 'Sidebar Sticky', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable sidebar sticky.', 'megafactory-core' ),
				'default'  => 0,
				'on'       => esc_html__( 'Enable', 'megafactory-core' ),
				'off'      => esc_html__( 'Disable', 'megafactory-core' ),
				'required' => array($template.'-page-template', '!=', 'no-sidebar')
			),
			array(
				'id'       => $template.'-page-hide-sidebar',
				'type'     => 'switch',
				'title'    => esc_html__( 'Sidebar on Mobile', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable to show or hide sidebar on mobile.', 'megafactory-core' ),
				'default'  => 1,
				'on'       => esc_html__( 'Show', 'megafactory-core' ),
				'off'      => esc_html__( 'Hide', 'megafactory-core' ),
				'required' => array($template.'-page-template', '!=', 'no-sidebar')
			),
			array(
				'id'       => $template.'-full-wrap',
				'type'     => 'switch',
				'title'    => esc_html__( 'Full Width Wrap', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable to show or hide full width post wrapper.', 'megafactory-core' ),
				'default'  => 0,
				'on'       => esc_html__( 'Show', 'megafactory-core' ),
				'off'      => esc_html__( 'Hide', 'megafactory-core' )
			),
			$article_top_ads,
			$article_inline_ads,
			$article_bottom_ads,
			array(
				'id'      => $template.'-topmeta-items',
				'type'    => 'sorter',
				'title'   => sprintf( esc_html__( '%1$s Top Meta Items', 'megafactory-core' ), $template_cname ),
				'desc'    => sprintf( esc_html__( 'Needed %1$s top meta items drag from disabled and put enabled part. ie: Left or Right.', 'megafactory-core' ), $template_sname ),
				'options' => array(
					'Left'  => array(
						'author'	=> esc_html__( 'Author', 'megafactory-core' )						
					),
					'Right'  => array(
						'date'	=> esc_html__( 'Date', 'megafactory-core' )
					),
					'disabled' => array(
						'social'	=> esc_html__( 'Social Share', 'megafactory-core' ),						
						'likes'	=> esc_html__( 'Likes', 'megafactory-core' ),
						'author'	=> esc_html__( 'Author', 'megafactory-core' ),
						'views'	=> esc_html__( 'Views', 'megafactory-core' ),
						'tag'	=> esc_html__( 'Tags', 'megafactory-core' ),
						'favourite'	=> esc_html__( 'Favourite', 'megafactory-core' ),						
						'comments'	=> esc_html__( 'Comments', 'megafactory-core' ),
						'category'	=> esc_html__( 'Category', 'megafactory-core' )
					)
				),
			),
			array(
				'id'      => $template.'-bottommeta-items',
				'type'    => 'sorter',
				'title'   => sprintf( esc_html__( '%1$s Bottom Meta Items', 'megafactory-core' ), $template_cname ),
				'desc'    => sprintf( esc_html__( 'Needed %1$s bottom meta items drag from disabled and put enabled part. ie: Left or Right.', 'megafactory-core' ), $template_sname ),
				'options' => array(
					'Left'  => array(
						'category'	=> esc_html__( 'Category', 'megafactory-core' ),
					),
					'Right'  => array(						
					),
					'disabled' => array(
						'social'	=> esc_html__( 'Social Share', 'megafactory-core' ),
						'date'	=> esc_html__( 'Date', 'megafactory-core' ),						
						'social'	=> esc_html__( 'Social Share', 'megafactory-core' ),						
						'likes'	=> esc_html__( 'Likes', 'megafactory-core' ),
						'author'	=> esc_html__( 'Author', 'megafactory-core' ),
						'views'	=> esc_html__( 'Views', 'megafactory-core' ),
						'favourite'	=> esc_html__( 'Favourite', 'megafactory-core' ),
						'comments'	=> esc_html__( 'Comments', 'megafactory-core' ),
						'tag'	=> esc_html__( 'Tags', 'megafactory-core' )
					)
				),
			),
			array(
				'id'      => $template.'-items',
				'type'    => 'sorter',
				'title'   => sprintf( esc_html__( '%1$s Items', 'megafactory-core' ), $template_cname ),
				'desc'    => sprintf( esc_html__( 'Needed %1$s items drag from disabled and put enabled part.', 'megafactory-core' ), $template_sname ),
				'options' => array(
					'Enabled'  => array(
						'title'	=> esc_html__( 'Title', 'megafactory-core' ),
						'top-meta'	=> esc_html__( 'Top Meta', 'megafactory-core' ),
						'thumb'	=> esc_html__( 'Thumbnail', 'megafactory-core' ),
						'content'	=> esc_html__( 'Content', 'megafactory-core' ),
						'bottom-meta'	=> esc_html__( 'Bottom Meta', 'megafactory-core' ),
					),
					'disabled' => array(
						
					)
				),
			),
			array(
				'id'       => $template.'-overlay-opt',
				'type'     => 'switch',
				'title'    => sprintf( esc_html__( '%1$s Overlay', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable %1$s post overlay.', 'megafactory-core' ), $template_sname ),
				'default'  => 0,
				'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
			),
			array(
				'id'      => $template.'-overlay-items',
				'type'    => 'sorter',
				'title'   => sprintf( esc_html__( '%1$s Overlay Items', 'megafactory-core' ), $template_cname ),
				'desc'    => sprintf( esc_html__( 'Needed %1$s overlay items drag from disabled and put enabled part.', 'megafactory-core' ), $template_sname ),
				'options' => array(
					'Enabled'  => array(
						'title'	=> esc_html__( 'Title', 'megafactory-core' ),
					),
					'disabled' => array(
						'top-meta'	=> esc_html__( 'Top Meta', 'megafactory-core' ),
						'bottom-meta'	=> esc_html__( 'Bottom Meta', 'megafactory-core' )
					)
				),
				'required' 		=> array($template.'-overlay-opt', '=', 1)
			),
			array(
				'id'      => $template.'-page-items',
				'type'    => 'sorter',
				'title'   => sprintf( esc_html__( '%1$s Page Items', 'megafactory-core' ), $template_cname ),
				'desc'    => sprintf( esc_html__( 'Needed %1$s items drag from disabled and put enabled part.', 'megafactory-core' ), $template_sname ),
				'options' => array(
					'Enabled'  => array(
						'post-items'	=> esc_html__( 'Post Items', 'megafactory-core' ),
						'author-info'	=> esc_html__( 'Author Info', 'megafactory-core' ),
						'post-nav'	=> esc_html__( 'Post Navigation', 'megafactory-core' ),
						'related-slider'	=> esc_html__( 'Related Slider', 'megafactory-core' ),
						'comment'	=> esc_html__( 'Comment', 'megafactory-core' )
					),
					'disabled' => array(
						'article-inline-ads-list'	=> esc_html__( 'Article Inline Ads', 'megafactory-core' )
					)
				),
			),
			array(
				'id'       => 'related-max-posts',
				'type'     => 'text',
				'title'    => esc_html__('Related Post Max Limit', 'megafactory-core'),
				'desc'     => esc_html__('Enter related post maximum limit for get from posts query. Example 5.', 'megafactory-core'),
				'default'  => '5'
			),
			array(
				'id'       => 'related-posts-filter',
				'type'     => 'select',
				'title'    => esc_html__( 'Related Posts From', 'megafactory-core' ),
				'desc'     => esc_html__( 'Choose related posts from category or tag.', 'megafactory-core' ),
				'options'  => array(
					'category'	=> esc_html__( 'Category', 'megafactory-core' ),
					'tag'		=> esc_html__( 'Tag', 'megafactory-core' )
				),
				'default'  => 'category'
			),
			array(
				'id'     => $template.'-settings-end',
				'type'   => 'section',
				'indent' => false, 
			)
		)
	) );
	
	//Templates -> Blog
	$blog_array = $acf->megafactoryThemeOptTemplate( 'blog', esc_html__( 'Blog', 'megafactory-core' ), esc_html__( 'blog', 'megafactory-core' ) );
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog Template', 'megafactory-core' ),
        'id'         => 'templates-blog',
        'desc'       => esc_html__( 'This is the setting for blog template', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $blog_array
    ) );
	
	$theme_templates = $acf->megafactoryGetThemeTemplatesKey();
	if( !empty( $theme_templates ) && in_array( "archive", $theme_templates ) ):
		//Templates -> Archive
		$archive_array = $acf->megafactoryThemeOptTemplate( 'archive', esc_html__( 'Archive', 'megafactory-core' ), esc_html__( 'archive', 'megafactory-core' ) );
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Archive Template', 'megafactory-core' ),
			'id'         => 'templates-archive',
			'desc'       => esc_html__( 'This is the setting for archive template', 'megafactory-core' ),
			'subsection' => true,
			'fields'     => $archive_array
		) );
	endif;
	
	if( !empty( $theme_templates ) && in_array( "category", $theme_templates ) ):
		//Templates -> Category
		$category_array = $acf->megafactoryThemeOptTemplate( 'category', esc_html__( 'Category', 'megafactory-core' ), esc_html__( 'category', 'megafactory-core' ) );
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Category Template', 'megafactory-core' ),
			'id'         => 'templates-category',
			'desc'       => esc_html__( 'This is the setting for category template', 'megafactory-core' ),
			'subsection' => true,
			'fields'     => $category_array
		) );
	endif;
	
	if( !empty( $theme_templates ) && in_array( "tag", $theme_templates ) ):
		//Templates -> Tag
		$tag_array = $acf->megafactoryThemeOptTemplate( 'tag', esc_html__( 'Tag', 'megafactory-core' ), esc_html__( 'tag', 'megafactory-core' ) );
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Tag Template', 'megafactory-core' ),
			'id'         => 'templates-tag',
			'desc'       => esc_html__( 'This is the setting for tag template', 'megafactory-core' ),
			'subsection' => true,
			'fields'     => $tag_array
		) );
	endif;
	
	if( !empty( $theme_templates ) && in_array( "author", $theme_templates ) ):
		//Templates -> Author
		$author_array = $acf->megafactoryThemeOptTemplate( 'author', esc_html__( 'Author', 'megafactory-core' ), esc_html__( 'author', 'megafactory-core' ) );
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Author Template', 'megafactory-core' ),
			'id'         => 'templates-author',
			'desc'       => esc_html__( 'This is the setting for author template', 'megafactory-core' ),
			'subsection' => true,
			'fields'     => $author_array
		) );
	endif;
	
	if( !empty( $theme_templates ) && in_array( "search", $theme_templates ) ):
		//Templates -> Search
		$search_array = $acf->megafactoryThemeOptTemplate( 'search', esc_html__( 'Search', 'megafactory-core' ), esc_html__( 'search', 'megafactory-core' ) );
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Search Template', 'megafactory-core' ),
			'id'         => 'templates-search',
			'desc'       => esc_html__( 'This is the setting for search template', 'megafactory-core' ),
			'subsection' => true,
			'fields'     => $search_array
		) );
	endif;
	
	//Templates -> All Categories
	$cat_templates = $acf->megafactoryGetAdminThemeOpt( 'theme-categories' );

	if( !empty( $cat_templates ) ){
		
		Redux::setSection( $opt_name, array(
			'title'            => esc_html__( 'Categories Templates', 'megafactory-core' ),
			'id'               => 'templates-categories',
			'desc'             => esc_html__( 'This is the template setting for all theme categories.', 'megafactory-core' ),
			'customizer_width' => '400px',
			'icon'             => 'fa fa-newspaper-o'
		) );
		
		// Show only enabled category templates
		foreach( $cat_templates as $cat_name ){
			
			$cat_key = str_replace( "category-", "", $cat_name );
			$cat_name = get_cat_name( absint( $cat_key ) );
			
			$cat_key = "category-" . $cat_key;
			$cat_sname = strtolower( $cat_name );
			//Templates -> Dynamic Categories
			$cat_array = $acf->megafactoryThemeOptTemplate( $cat_key, $cat_name, $cat_sname );
			Redux::setSection( $opt_name, array(
				'title'      => sprintf( esc_html__( '%1$s Template', 'megafactory-core' ), $cat_name ),
				'id'         => 'templates-' . $cat_key,
				'desc'       => sprintf( esc_html__( 'This is the setting for %1$s category template', 'megafactory-core' ), $cat_name ),
				'subsection' => true,
				'fields'     => $cat_array
			) );
			
		} // Categories foreach
		
	} // All categories template if condition
		
	//Sliders Tab
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Sliders', 'megafactory-core' ),
        'id'               => 'sliders',
        'desc'             => esc_html__( 'These are the sliders settings of Megafactory Theme', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-film'
    ) );
	
	// Featured Slider
	$featured_slider = $acf->themeSliders('featured');
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Featured Slider', 'megafactory-core' ),
        'id'         => 'sliders-featured',
        'desc'       => esc_html__( 'This is the setting for featured slider', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $featured_slider
    ) );
	
	// Related Slider
	$related_slider = $acf->themeSliders('related');
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Related Slider', 'megafactory-core' ),
        'id'         => 'sliders-related',
        'desc'       => esc_html__( 'This is the setting for related slider', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $related_slider
    ) );
	
	// Blog Post Slider
	$blog_slider = $acf->themeSliders('blog');
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog Post Slider', 'megafactory-core' ),
        'id'         => 'sliders-blog',
        'desc'       => esc_html__( 'This is the setting for blog post slider', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $blog_slider
    ) );
	
	// Single Post Slider
	$single_slider = $acf->themeSliders('single');
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Post Slider', 'megafactory-core' ),
        'id'         => 'sliders-single',
        'desc'       => esc_html__( 'This is the setting for single post slider', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => $single_slider
    ) );
	
	//Social Tab
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Social', 'megafactory-core' ),
        'id'               => 'social',
        'desc'             => esc_html__( 'These are the Social settings of Megafactory Theme', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-users'
    ) );
	
	//Social -> Links
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Settings', 'megafactory-core' ),
        'id'         => 'social-links',
        'desc'       => esc_html__( 'This is the setting for social links', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'social-icons-type',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Social Iocns Type', 'megafactory-core' ),
                'desc'     => esc_html__( 'Choose your social icons type.', 'megafactory-core' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    'squared' => array(
                        'alt' => esc_html__( 'Squared', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/social-icons/1.png'
                    ),
                    'rounded' => array(
                        'alt' => esc_html__( 'Rounded', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/social-icons/2.png'
                    ),
                    'circled' => array(
                        'alt' => esc_html__( 'Circled', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/social-icons/3.png'
                    ),
					'transparent' => array(
                        'alt' => esc_html__( 'Nothing', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/social-icons/4.png'
                    )
                ),
                'default'  => 'transparent'
            ),
			array(
                'id'       => 'social-icons-type-footer',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Footer Bottom Social Iocns Type', 'megafactory-core' ),
                'desc'     => esc_html__( 'Choose your social icons type.', 'megafactory-core' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    'squared' => array(
                        'alt' => esc_html__( 'Squared', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/social-icons/1.png'
                    ),
                    'rounded' => array(
                        'alt' => esc_html__( 'Rounded', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/social-icons/2.png'
                    ),
                    'circled' => array(
                        'alt' => esc_html__( 'Circled', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/social-icons/3.png'
                    ),
					'transparent' => array(
                        'alt' => esc_html__( 'Nothing', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/social-icons/4.png'
                    )
                ),
                'default'  => 'squared'
            ),
			array(
                'id'       => 'social-icons-fore',
                'type'     => 'select',
                'title'    => esc_html__( 'Social Icons Fore', 'megafactory-core' ),
				'desc'     => esc_html__( 'Social icons fore color settings.', 'megafactory-core' ),
                'options'  => array(
                    'black'		=> esc_html__( 'Black', 'megafactory-core' ),
                    'white'		=> esc_html__( 'White', 'megafactory-core' ),
					'own'		=> esc_html__( 'Own Color', 'megafactory-core' ),
                ),
                'default'  => 'black'
            ),
			array(
                'id'       => 'social-icons-hfore',
                'type'     => 'select',
                'title'    => esc_html__( 'Social Icons Fore Hover', 'megafactory-core' ),
				'desc'     => esc_html__( 'Social icons fore hover color settings.', 'megafactory-core' ),
                'options'  => array(
                    'h-black'		=> esc_html__( 'Black', 'megafactory-core' ),
                    'h-white'		=> esc_html__( 'White', 'megafactory-core' ),
					'h-own'		=> esc_html__( 'Own Color', 'megafactory-core' ),
                ),
                'default'  => 'h-own'
            ),
			array(
                'id'       => 'social-icons-bg',
                'type'     => 'select',
                'title'    => esc_html__( 'Social Icons Background', 'megafactory-core' ),
				'desc'     => esc_html__( 'Social icons background color settings.', 'megafactory-core' ),
                'options'  => array(
                    'bg-black'		=> esc_html__( 'Black', 'megafactory-core' ),
                    'bg-white'		=> esc_html__( 'White', 'megafactory-core' ),
					'bg-light'		=> esc_html__( 'RGBA Light', 'megafactory-core' ),
					'bg-dark'		=> esc_html__( 'RGBA Dark', 'megafactory-core' ),
					'bg-own'		=> esc_html__( 'Own Color', 'megafactory-core' ),
                ),
                'default'  => ''
            ),
			array(
                'id'       => 'social-icons-hbg',
                'type'     => 'select',
                'title'    => esc_html__( 'Social Icons Background Hover', 'megafactory-core' ),
				'desc'     => esc_html__( 'Social icons background hover color settings.', 'megafactory-core' ),
                'options'  => array(
                    'hbg-black'		=> esc_html__( 'Black', 'megafactory-core' ),
                    'hbg-white'		=> esc_html__( 'White', 'megafactory-core' ),
					'hbg-light'		=> esc_html__( 'RGBA Light', 'megafactory-core' ),
					'hbg-dark'		=> esc_html__( 'RGBA Dark', 'megafactory-core' ),
					'hbg-own'		=> esc_html__( 'Own Color', 'megafactory-core' ),
                ),
                'default'  => ''
            ),
			array(
                'id'       => 'social-fb',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the facebook link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '#',
            ),
			array(
                'id'       => 'social-twitter',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the twitter link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '#',
            ),
			array(
                'id'       => 'social-instagram',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the instagram link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '#',
            ),
			array(
                'id'       => 'social-pinterest',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the pinterest link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-gplus',
                'type'     => 'text',
                'title'    => esc_html__( 'Google Plus', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the Google Plus link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-youtube',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the Youtube link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-vimeo',
                'type'     => 'text',
                'title'    => esc_html__( 'Vimeo', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the Vimeo link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-soundcloud',
                'type'     => 'text',
                'title'    => esc_html__( 'Soundcloud', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the Soundcloud link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-yahoo',
                'type'     => 'text',
                'title'    => esc_html__( 'Yahoo', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the Yahoo link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-tumblr',
                'type'     => 'text',
                'title'    => esc_html__( 'Tumblr', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the Tumblr link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-paypal',
                'type'     => 'text',
                'title'    => esc_html__( 'Paypal', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the Paypal link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-mailto',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailto', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the Mailto link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-flickr',
                'type'     => 'text',
                'title'    => esc_html__( 'Flickr', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the Flickr link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-dribbble',
                'type'     => 'text',
                'title'    => esc_html__( 'Dribbble', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the Dribbble link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-linkedin',
                'type'     => 'text',
                'title'    => esc_html__( 'LinkedIn', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the linkedin link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
			array(
                'id'       => 'social-rss',
                'type'     => 'text',
                'title'    => esc_html__( 'RSS', 'megafactory-core' ),
                'desc'     => esc_html__( 'Enter the rss link. If no link means just leave it blank', 'megafactory-core' ),
                'default'  => '',
            ),
		)
    ) );
	
	//Social -> Share
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Share', 'megafactory-core' ),
        'id'         => 'social-share',
        'desc'       => esc_html__( 'This is the setting for social share', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'post-social-shares',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Post Social Shares', 'megafactory-core' ),
				'desc'     => esc_html__( 'Actived social items only showing post share list.', 'megafactory-core' ),
				'multi'    => true,
				'options' => array(
					'fb'	=> esc_html__( 'Facebook', 'megafactory-core' ),
					'twitter'	=> esc_html__( 'Twitter', 'megafactory-core' ),
					'linkedin'		=> esc_html__( 'Linkedin', 'megafactory-core' ),
					'gplus'	=> esc_html__( 'Google Plus', 'megafactory-core' ),
					'pinterest'	=> esc_html__( 'Pinterest', 'megafactory-core' )
				),
				'default' => '',
			),
			array(
				'id'       => 'comments-social-shares',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Comments Social Shares', 'megafactory-core' ),
				'desc'     => esc_html__( 'Actived social items only showing comments share list.', 'megafactory-core' ),
				'multi'    => true,
				'options' => array(
					'fb'	=> esc_html__( 'Facebook', 'megafactory-core' ),
					'twitter'	=> esc_html__( 'Twitter', 'megafactory-core' ),
					'linkedin'		=> esc_html__( 'Linkedin', 'megafactory-core' ),
					'gplus'	=> esc_html__( 'Google Plus', 'megafactory-core' ),
					'pinterest'	=> esc_html__( 'Pinterest', 'megafactory-core' )
				),
				'default' => '',
			),
		)
    ) );
	
	//WooCommerce
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		Redux::setSection( $opt_name, array(
			'title'            => esc_html__( 'Woo', 'megafactory-core' ),
			'id'               => 'woo',
			'desc'             => esc_html__( 'These are the WooCommerce settings of Megafactory Theme', 'megafactory-core' ),
			'customizer_width' => '400px',
			'icon'             => 'fa fa-shopping-cart'
		) );
		
		//WooCommerce -> General
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'General Settings', 'megafactory-core' ),
			'id'         => 'woo-general',
			'desc'       => esc_html__( 'This is general WooCommerce setting.', 'megafactory-core' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'woo-page-template',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Woocommerce Shop Template', 'megafactory-core' ),
					'desc'     => esc_html__( 'Choose your current woocommerce shop page template.', 'megafactory-core' ),
					'options'  => array(
						'no-sidebar' => array(
							'alt' => esc_html__( 'No Sidebar', 'megafactory-core' ),
							'img' => get_template_directory_uri() . '/assets/images/page-layouts/1.png'
						),
						'right-sidebar' => array(
							'alt' => esc_html__( 'Right Sidebar', 'megafactory-core' ),
							'img' => get_template_directory_uri() . '/assets/images/page-layouts/2.png'
						),
						'left-sidebar' => array(
							'alt' => esc_html__( 'Left Sidebar', 'megafactory-core' ),
							'img' => get_template_directory_uri() . '/assets/images/page-layouts/3.png'
						),
						'both-sidebar' => array(
							'alt' => esc_html__( 'Both Sidebar', 'megafactory-core' ),
							'img' => get_template_directory_uri() . '/assets/images/page-layouts/4.png'
						)
					),
					'default'  => 'right-sidebar'
				),
				array(
					'id'       => 'woo-left-sidebar',
					'type'     => 'select',
					'title'    => esc_html__( 'Choose Left Sidebar', 'megafactory-core' ),
					'desc'     => esc_html__( 'Select widget area for showing woocommerce shop template on left sidebar.', 'megafactory-core' ),
					'data'     => 'sidebars',
					'required' 		=> array('woo-page-template', '=', array( 'left-sidebar', 'both-sidebar' ))
				),
				array(
					'id'       => 'woo-right-sidebar',
					'type'     => 'select',
					'title'    => esc_html__( 'Choose Right Sidebar', 'megafactory-core' ),
					'desc'     => esc_html__( 'Select widget area for showing woocommerce shop template on right sidebar.', 'megafactory-core' ),
					'data'     => 'sidebars',
					'default'  => 'sidebar-1',
					'required' 		=> array('woo-page-template', '=', array( 'right-sidebar', 'both-sidebar' ))
				),
				array(
					'id'       => 'woo-shop-columns',
					'type'     => 'select',
					'title'    => esc_html__( 'Shop Columns', 'megafactory-core' ),
					'desc'     => esc_html__( 'This is column settings woocommerce shop page products.', 'megafactory-core' ),
					'options'  => array(
						'2'		=> esc_html__( '2 Columns', 'megafactory-core' ),
						'3'		=> esc_html__( '3 Columns', 'megafactory-core' ),
						'4'		=> esc_html__( '4 Columns', 'megafactory-core' ),
						'5'		=> esc_html__( '5 Columns', 'megafactory-core' ),
						'6'		=> esc_html__( '6 Columns', 'megafactory-core' ),
					),
					'default'  => '3'
				),
				array(
					'id'       => 'woo-shop-ppp',
					'type'     => 'text',
					'title'    => esc_html__( 'Shop Product Per Page', 'megafactory-core' ),
					'desc'     => esc_html__( 'This is column settings woocommerce related products per page.', 'megafactory-core' ),
					'default'  => '12'
				),
				array(
					'id'       => 'woo-related-ppp',
					'type'     => 'text',
					'title'    => esc_html__( 'Related Product Per Page', 'megafactory-core' ),
					'desc'     => esc_html__( 'This is column settings woocommerce related products per page.', 'megafactory-core' ),
					'default'  => '3'
				),
			)
		) );
		
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Archive Template', 'megafactory-core' ),
			'id'         => 'woo-archive-page',
			'desc'       => esc_html__( 'This is the setting for woocommerce archive page template', 'megafactory-core' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'wooarchive-page-template',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Woocommerce Archive Template', 'megafactory-core' ),
					'desc'     => esc_html__( 'Choose your current Woocommerce Archive page template.', 'megafactory-core' ),
					'options'  => array(
						'no-sidebar' => array(
							'alt' => esc_html__( 'No Sidebar', 'megafactory-core' ),
							'img' => get_template_directory_uri() . '/assets/images/page-layouts/1.png'
						),
						'right-sidebar' => array(
							'alt' => esc_html__( 'Right Sidebar', 'megafactory-core' ),
							'img' => get_template_directory_uri() . '/assets/images/page-layouts/2.png'
						),
						'left-sidebar' => array(
							'alt' => esc_html__( 'Left Sidebar', 'megafactory-core' ),
							'img' => get_template_directory_uri() . '/assets/images/page-layouts/3.png'
						),
						'both-sidebar' => array(
							'alt' => esc_html__( 'Both Sidebar', 'megafactory-core' ),
							'img' => get_template_directory_uri() . '/assets/images/page-layouts/4.png'
						)
					),
					'default'  => 'right-sidebar'
				),
				array(
					'id'       => 'wooarchive-left-sidebar',
					'type'     => 'select',
					'title'    => esc_html__( 'Choose Left Sidebar', 'megafactory-core' ),
					'desc'     => esc_html__( 'Select widget area for showing woocommerce archive template on left sidebar.', 'megafactory-core' ),
					'data'     => 'sidebars',
					'required' 		=> array('wooarchive-page-template', '=', array( 'left-sidebar', 'both-sidebar' ))
				),
				array(
					'id'       => 'wooarchive-right-sidebar',
					'type'     => 'select',
					'title'    => esc_html__( 'Choose Right Sidebar', 'megafactory-core' ),
					'desc'     => esc_html__( 'Select widget area for showing woocommerce archive template on right sidebar.', 'megafactory-core' ),
					'data'     => 'sidebars',
					'default'  => 'sidebar-1',
					'required' 		=> array('wooarchive-page-template', '=', array( 'right-sidebar', 'both-sidebar' ))
				),
				array(
					'id'       => 'woo-shop-archive-columns',
					'type'     => 'select',
					'title'    => esc_html__( 'Product Archive Columns', 'megafactory-core' ),
					'desc'     => esc_html__( 'This is column settings woocommerce product archive columns.', 'megafactory-core' ),
					'options'  => array(
						'2'		=> esc_html__( '2 Columns', 'megafactory-core' ),
						'3'		=> esc_html__( '3 Columns', 'megafactory-core' ),
						'4'		=> esc_html__( '4 Columns', 'megafactory-core' ),
						'5'		=> esc_html__( '5 Columns', 'megafactory-core' ),
						'6'		=> esc_html__( '6 Columns', 'megafactory-core' ),
					),
					'default'  => '4'
				),
			)
		) );
		
		// Woo Related Slider
		$woo_related_slider = $acf->themeSliders('woo-related');
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Woo Related Slider', 'megafactory-core' ),
			'id'         => 'woo-related-slider',
			'desc'       => esc_html__( 'This is the setting for woocommerce related slider', 'megafactory-core' ),
			'subsection' => true,
			'fields'     => $woo_related_slider
		) );
		
	}
	
	//Custom Post Types
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Custom Post Types', 'megafactory-core' ),
        'id'               => 'cpt',
        'desc'             => esc_html__( 'These are the CPT settings of Megafactory Theme', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-bolt'
    ) );
	
	//General -> Custom Post Types
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'General Settings', 'megafactory-core' ),
        'id'         => 'cpt-general',
        'desc'       => esc_html__( 'This is general CPT setting.', 'megafactory-core' ),
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'cpt-opts',
				'type'     => 'button_set',
				'title'    => esc_html__('Custom Post Types', 'megafactory-core'),
				'desc'     => esc_html__('Enable needed custom post types here and save theme options. After refresh page CPT options are showing sub level and go to settings, resave permalinks settings.', 'megafactory-core'),
				'multi'    => true,
				'options' => array(
					'portfolio' 	=> esc_html__( 'Portfolio', 'megafactory-core' ),
					'team' 			=> esc_html__( 'Team', 'megafactory-core' ),
					'testimonial' 	=> esc_html__( 'Testimonial', 'megafactory-core' ),
					'event' 	=> esc_html__( 'Events', 'megafactory-core' ),
					'service' 	=> esc_html__( 'Services', 'megafactory-core' ),
				 ), 
				'default' => '',
			)
		)
    ) );
	
	//Custom Post Types -> Options like portfolio, team, etc..
	$cpt_opts = $acf->megafactoryGetAdminThemeOpt( 'cpt-opts' );
	$cpt_all = array( 'portfolio' => esc_html( 'Portfolio', 'megafactory-core' ), 'team' => esc_html( 'Team', 'megafactory-core' ), 'testimonial' => esc_html( 'Testimonial', 'megafactory-core' ), 'event' => esc_html( 'Events', 'megafactory-core' ), 'service' => esc_html( 'Services', 'megafactory-core' ) );

	if( !empty( $cpt_opts ) ){
	
		foreach( $cpt_opts as $cpt ){
			
			if( !isset( $cpt_all[$cpt] ) ) continue;
			$cpt_name = $cpt_all[$cpt];
			
			$cpt_array = array();
			
			if( $cpt == 'portfolio' ){
			
				$related_slider = $acf->themeSliders('portfolio-related');
				$single_slider = $acf->themeSliders('portfolio-single');
				
				$t_array = array(
					array(
						'id'       => 'portfolio-title-opt',
						'type'     => 'switch',
						'title'    => esc_html__( 'Portfolio Title', 'megafactory-core' ),
						'subtitle' => esc_html__( 'Enable/Disable portfolio title on single portfolio( not page title ).', 'megafactory-core' ),
						'default'  => 1,
						'on'       => esc_html__( 'Enable', 'megafactory-core' ),
						'off'      => esc_html__( 'Disable', 'megafactory-core' ),
					),
					array(
						'id'       => 'cpt-portfolio-slug',
						'type'     => 'text',
						'title'    => esc_html__( 'Portfolio Slug', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio slug for register custom post type.', 'megafactory-core' ),
						'default'  => 'portfolio'
					),
					array(
						'id'       => 'cpt-portfolio-category-slug',
						'type'     => 'text',
						'title'    => esc_html__( 'Portfolio Category Slug', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter category slug for portfolio custom post type.', 'megafactory-core' ),
						'default'  => 'portfolio-category'
					),
					array(
						'id'       => 'cpt-portfolio-tag-slug',
						'type'     => 'text',
						'title'    => esc_html__( 'Portfolio Tag Slug', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio slug for portfolio custom post type.', 'megafactory-core' ),
						'default'  => 'portfolio-tag'
					),
					array(
						'id'      => 'portfolio-meta-items',
						'type'    => 'sorter',
						'title'   => esc_html__( 'Portfolio Meta Items', 'megafactory-core' ),
						'desc'    => esc_html__( 'Needed portfolio meta items drag from disabled and put enabled part.', 'megafactory-core' ),
						'options' => array(
							'Enabled'  => array(
								'date'		=> esc_html__( 'Date', 'megafactory-core' ),
								'client'	=> esc_html__( 'Client', 'megafactory-core' ),
								'category'	=> esc_html__( 'Category', 'megafactory-core' ),
								'share'		=> esc_html__( 'Share', 'megafactory-core' ),
							),
							'disabled' => array(
								'tag'		=> esc_html__( 'Tags', 'megafactory-core' ),
								'duration'	=> esc_html__( 'Duration', 'megafactory-core' ),
								'url'		=> esc_html__( 'URL', 'megafactory-core' ),
								'place'		=> esc_html__( 'Place', 'megafactory-core' ),
								'estimation'=> esc_html__( 'Estimation', 'megafactory-core' ),
							)
						)
					),
					array(
						'id'       => 'portfolio-details-labels-start',
						'type'     => 'section',
						'title'    => esc_html__( 'Portfolio Details Labels', 'megafactory-core' ),
						'subtitle' => esc_html__( 'This is portfolio details labels settings for', 'megafactory-core' ),
						'indent'   => true,
					),
					array(
						'id'       => 'portfolio-client-label',
						'type'     => 'text',
						'title'    => esc_html__( 'Client', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio client label.', 'megafactory-core' ),
						'default'  => esc_html__( 'Client', 'megafactory-core' )
					),
					array(
						'id'       => 'portfolio-date-label',
						'type'     => 'text',
						'title'    => esc_html__( 'Date', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio date label.', 'megafactory-core' ),
						'default'  => esc_html__( 'Date', 'megafactory-core' )
					),
					array(
						'id'       => 'portfolio-duration-label',
						'type'     => 'text',
						'title'    => esc_html__( 'Duration', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio duration label.', 'megafactory-core' ),
						'default'  => esc_html__( 'Duration', 'megafactory-core' )
					),
					array(
						'id'       => 'portfolio-estimation-label',
						'type'     => 'text',
						'title'    => esc_html__( 'Estimation', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio estimation label.', 'megafactory-core' ),
						'default'  => esc_html__( 'Estimation', 'megafactory-core' )
					),
					array(
						'id'       => 'portfolio-place-label',
						'type'     => 'text',
						'title'    => esc_html__( 'Place', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio place label.', 'megafactory-core' ),
						'default'  => esc_html__( 'Place', 'megafactory-core' )
					),
					array(
						'id'       => 'portfolio-url-label',
						'type'     => 'text',
						'title'    => esc_html__( 'URL', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio URL label.', 'megafactory-core' ),
						'default'  => esc_html__( 'URL', 'megafactory-core' )
					),
					array(
						'id'       => 'portfolio-category-label',
						'type'     => 'text',
						'title'    => esc_html__( 'Category', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio category label.', 'megafactory-core' ),
						'default'  => esc_html__( 'Category', 'megafactory-core' )
					),
					array(
						'id'       => 'portfolio-tags-label',
						'type'     => 'text',
						'title'    => esc_html__( 'Tags', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio tags label.', 'megafactory-core' ),
						'default'  => esc_html__( 'Tags', 'megafactory-core' )
					),
					array(
						'id'       => 'portfolio-share-label',
						'type'     => 'text',
						'title'    => esc_html__( 'Share', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter portfolio share label.', 'megafactory-core' ),
						'default'  => esc_html__( 'Share', 'megafactory-core' )
					),
					array(
						'id'     => 'portfolio-details-labels-end',
						'type'   => 'section',
						'indent' => false, 
					),
					array(
						'id'       => 'portfolio-layout-settings-start',
						'type'     => 'section',
						'title'    => esc_html__( 'Portfolio Layouts', 'megafactory-core' ),
						'subtitle' => esc_html__( 'This is layout settings for portfolio single.', 'megafactory-core' ),
						'indent'   => true
					),
					array(
						'id'       => 'portfolio-layout',
						'type'     => 'image_select',
						'title'    => esc_html__( 'Portfolio Single Layouts', 'megafactory-core' ),
						'desc'     => esc_html__( 'This is layout settings for portfolio single.', 'megafactory-core' ),
						'options'  => array(
							'1' => array(
								'alt' => esc_html__( 'Left Thumb', 'megafactory-core' ),
								'img' => ReduxFramework::$_url . 'assets/img/portfolio-layouts/1.png'
							),
							'2' => array(
								'alt' => esc_html__( 'Bottom Thumb', 'megafactory-core' ),
								'img' => ReduxFramework::$_url . 'assets/img/portfolio-layouts/2.png'
							),
							'3' => array(
								'alt' => esc_html__( 'Right Thumb', 'megafactory-core' ),
								'img' => ReduxFramework::$_url . 'assets/img/portfolio-layouts/3.png'
							)
						),
						'default'  => '1'
					),
					array(
						'id'     => 'portfolio-layout-settings-end',
						'type'   => 'section',
						'indent' => false, 
					),
					array(
						'id'       => 'portfolio-archive-settings-start',
						'type'     => 'section',
						'title'    => esc_html__( 'Portfolio Archive Layouts', 'megafactory-core' ),
						'subtitle' => esc_html__( 'This is layout settings for portfolio archive.', 'megafactory-core' ),
						'indent'   => true
					),
					array(
						'id'       => 'portfolio-grid-cols',
						'type'     => 'select',
						'title'    => esc_html__( 'Grid Columns', 'megafactory-core' ),
						'desc'     => esc_html__( 'Select grid columns.', 'megafactory-core' ),
						'options'  => array(
							'4'		=> esc_html__( '4 Columns', 'megafactory-core' ),
							'3'		=> esc_html__( '3 Columns', 'megafactory-core' ),
							'2'		=> esc_html__( '2 Columns', 'megafactory-core' ),
						),
						'default'  => '2'
					),
					array(
						'id'       => 'portfolio-grid-gutter',
						'type'     => 'text',
						'title'    => esc_html__( 'Portfolio Grid Gutter', 'megafactory-core' ),
						'subtitle' => esc_html__( 'Enter grid gutter size. Example 20.', 'megafactory-core' ),
						'default'  => '20'
					),
					array(
						'id'       => 'portfolio-grid-type',
						'type'     => 'select',
						'title'    => esc_html__( 'Grid Type', 'megafactory-core' ),
						'desc'     => esc_html__( 'Select grid type normal or isotope.', 'megafactory-core' ),
						'options'  => array(
							'normal'		=> esc_html__( 'Normal Grid', 'megafactory-core' ),
							'isotope'		=> esc_html__( 'Isotope Grid', 'megafactory-core' ),
						),
						'default'  => 'isotope'
					),
					array(
						'id'     => 'portfolio-archive-settings-end',
						'type'   => 'section',
						'indent' => false, 
					),
					array(
						'id'       => 'portfolio-related-opt',
						'type'     => 'switch',
						'title'    => esc_html__( 'Related Slider', 'megafactory-core' ),
						'subtitle' => esc_html__( 'Enable/Disable portfolio related slider.', 'megafactory-core' ),
						'default'  => 0,
						'on'       => esc_html__( 'Enable', 'megafactory-core' ),
						'off'      => esc_html__( 'Disable', 'megafactory-core' ),
					),
					array(
						'id'       => 'portfolio-related-settings-start',
						'type'     => 'section',
						'title'    => esc_html__( 'Related Sliders Settings', 'megafactory-core' ),
						'subtitle' => esc_html__( 'This is settings for portfolio related slider.', 'megafactory-core' ),
						'indent'   => true,
						'required' 		=> array( 'portfolio-related-opt', '=', 1 )
					),
				);
				
				$t_array = array_merge( $t_array, $related_slider );
				
				$t1_array = array(
					array(
						'id'     => 'portfolio-related-settings-end',
						'type'   => 'section',
						'indent' => false, 
					)
				);
				
				$t_array = array_merge( $t_array, $t1_array );

				$t1_array = array(
					array(
						'id'       => 'portfolio-single-slider-opt',
						'type'     => 'switch',
						'title'    => esc_html__( 'Portfolio Single Slider Option', 'megafactory-core' ),
						'subtitle' => esc_html__( 'Enable/Disable portfolio single page slider.', 'megafactory-core' ),
						'default'  => 0,
						'on'       => esc_html__( 'Enable', 'megafactory-core' ),
						'off'      => esc_html__( 'Disable', 'megafactory-core' ),
					),
					array(
						'id'       => 'portfolio-single-settings-start',
						'type'     => 'section',
						'title'    => esc_html__( 'Portfolio Single Sliders Settings', 'megafactory-core' ),
						'subtitle' => esc_html__( 'This is settings for portfolio single page slider.', 'megafactory-core' ),
						'indent'   => true,
						'required' 		=> array( 'portfolio-single-slider-opt', '=', 1)
					),
				);
				
				$t_array = array_merge( $t_array, $t1_array );
				$t_array = array_merge( $t_array, $single_slider );
				
				$t1_array = array(
					array(
						'id'     => 'portfolio-single-settings-end',
						'type'   => 'section',
						'indent' => false, 
					)
				);
				
				$t_array = array_merge( $t_array, $t1_array );
				
				$cpt_array = array_merge( $cpt_array, $t_array );
			}elseif( $cpt == 'testimonial' ){
				$t_array = array(
					array(
						'id'       => 'testimonial-title-opt',
						'type'     => 'switch',
						'title'    => esc_html__( 'Testimonial Title', 'megafactory-core' ),
						'subtitle' => esc_html__( 'Enable/Disable testimonial title on single testimonial( not page title ).', 'megafactory-core' ),
						'default'  => 1,
						'on'       => esc_html__( 'Enable', 'megafactory-core' ),
						'off'      => esc_html__( 'Disable', 'megafactory-core' ),
					),
					array(
						'id'       => 'cpt-testimonial-slug',
						'type'     => 'text',
						'title'    => esc_html__( 'Testimonial Slug', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter testimonial slug for register custom post type.', 'megafactory-core' ),
						'default'  => 'testimonial'
					)
				);
				$cpt_array = array_merge( $cpt_array, $t_array );
			}elseif( $cpt == 'team' ){
				$t_array = array(
					array(
						'id'       => 'team-title-opt',
						'type'     => 'switch',
						'title'    => esc_html__( 'Team Title', 'megafactory-core' ),
						'subtitle' => esc_html__( 'Enable/Disable team title on single team( not page title ).', 'megafactory-core' ),
						'default'  => 1,
						'on'       => esc_html__( 'Enable', 'megafactory-core' ),
						'off'      => esc_html__( 'Disable', 'megafactory-core' ),
					),
					array(
						'id'       => 'cpt-team-slug',
						'type'     => 'text',
						'title'    => esc_html__( 'Team Slug', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter team slug for register custom post type.', 'megafactory-core' ),
						'default'  => 'team'
					)
				);
				$cpt_array = array_merge( $cpt_array, $t_array );
			}elseif( $cpt == 'event' ){
				$t_array = array(
					array(
						'id'       => 'event-title-opt',
						'type'     => 'switch',
						'title'    => esc_html__( 'Event Title', 'megafactory-core' ),
						'subtitle' => esc_html__( 'Enable/Disable event title on single event( not page title ).', 'megafactory-core' ),
						'default'  => 1,
						'on'       => esc_html__( 'Enable', 'megafactory-core' ),
						'off'      => esc_html__( 'Disable', 'megafactory-core' ),
					),
					array(
						'id'       => 'cpt-event-slug',
						'type'     => 'text',
						'title'    => esc_html__( 'Event Slug', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter event slug for register custom post type.', 'megafactory-core' ),
						'default'  => 'event'
					)
				);
				$cpt_array = array_merge( $cpt_array, $t_array );
			}elseif( $cpt == 'service' ){
				$t_array = array(
					array(
						'id'       => 'service-title-opt',
						'type'     => 'switch',
						'title'    => esc_html__( 'Service Title', 'megafactory-core' ),
						'subtitle' => esc_html__( 'Enable/Disable service title on single service( not page title ).', 'megafactory-core' ),
						'default'  => 1,
						'on'       => esc_html__( 'Enable', 'megafactory-core' ),
						'off'      => esc_html__( 'Disable', 'megafactory-core' ),
					),
					array(
						'id'       => 'cpt-service-slug',
						'type'     => 'text',
						'title'    => esc_html__( 'Service Slug', 'megafactory-core' ),
						'desc'     => esc_html__( 'Enter service slug for register custom post type.', 'megafactory-core' ),
						'default'  => 'service'
					)
				);
				$cpt_array = array_merge( $cpt_array, $t_array );
			}
			
			Redux::setSection( $opt_name, array(
				'title'      => sprintf( esc_html__( '%1$s', 'megafactory-core' ), $cpt_name ),
				'id'         => 'cpt-'.$cpt,
				'desc'       => sprintf( esc_html__( 'This is CPT %1$s setting.', 'megafactory-core' ), $cpt_name ),
				'subsection' => true,
				'fields'     => $cpt_array
			) );
			
		}
	}
	
	//Minifier Tab
	Redux::setSection( $opt_name, array(
		'title'            => esc_html__( 'Minifier', 'megafactory-core' ),
		'id'               => 'minifier',
		'desc'             => esc_html__( 'These are minifier general settings of megafactory theme', 'megafactory-core' ),
		'customizer_width' => '400px',
		'icon'             => 'fa fa-file-archive-o'
	) );
			
	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Minifier General', 'megafactory-core' ),
		'id'         => 'minifier-general',
		'desc'       => esc_html__( 'This is the setting for minifier general', 'megafactory-core' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'js-minify',
				'type'     => 'switch',
				'title'    => esc_html__( 'JS Minify', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable minify js for website.', 'megafactory-core' ),
				'default'  => 1,
				'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
			),
			array(
				'id'       => 'css-minify',
				'type'     => 'switch',
				'title'    => esc_html__( 'CSS Minify', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable minify css for website.', 'megafactory-core' ),
				'default'  => 1,
				'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
			),
		)
	) );
	
	//Maintenance Tab
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Maintenance', 'megafactory-core' ),
        'id'               => 'maintenance',
        'desc'             => esc_html__( 'These are the maintenance settings of Megafactory theme', 'megafactory-core' ),
        'customizer_width' => '400px',
        'icon'             => 'fa fa-sliders'
    ) );
	
	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'Maintenance General', 'megafactory-core' ),
		'id'         => 'maintenance-general',
		'desc'       => esc_html__( 'This is the setting for maintenance general', 'megafactory-core' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'maintenance-mode',
				'type'     => 'switch',
				'title'    => esc_html__( 'Maintenance Mode Option', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable maintenance mode.', 'megafactory-core' ),
				'default'  => 0,
				'on'       => esc_html__( 'Enable', 'megafactory-core' ),
				'off'      => esc_html__( 'Disable', 'megafactory-core' ),
			),
			array(
				'id'       => 'maintenance-type',
				'type'     => 'select',
				'title'    => esc_html__( 'Maintenance Type', 'megafactory-core' ),
				'desc'     => esc_html__( 'Select maintenance mode page coming soon or maintenance.', 'megafactory-core' ),
				'options'  => array(
					'cs'		=> esc_html__( 'Coming Soon Default', 'megafactory-core' ),
					'mn'		=> esc_html__( 'Maintenance Default', 'megafactory-core' ),
					'cus'		=> esc_html__( 'Custom', 'megafactory-core' )
				),
				'required' 		=> array( 'maintenance-mode', '=', 1)
			),
			array(
				'id'       => 'maintenance-custom',
				'type'     => 'select',
				'title'    => esc_html__( 'Maintenance Custom Page', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter service slug for register custom post type.', 'megafactory-core' ),
				'data'  => 'pages',
				'required' 		=> array( 'maintenance-type', '=', "cus")
			),
			array(
				'id'       => 'maintenance-phone',
				'type'     => 'text',
				'title'    => esc_html__( 'Phone Number', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter phone number shown on when maintenance mode actived.', 'megafactory-core' ),
				'default'  => ''
			),
			array(
				'id'       => 'maintenance-email',
				'type'     => 'text',
				'title'    => esc_html__( 'Email Id', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter email id shown on when maintenance mode actived.', 'megafactory-core' ),
				'default'  => ''
			),
			array(
				'id'		=>'maintenance-address',
				'type'		=> 'textarea',
				'title'		=> esc_html__( 'Address', 'megafactory' ), 
				'desc'		=> esc_html__( 'Place here your address and info.', 'megafactory' ),
				'validate'	=> 'html_custom',
				'allowed_html'	=> array(
					'a' => array(
					'href' => array(),
						'title' => array()
					),
					'br' => array(),
					'em' => array(),
					'strong' => array(),
					'p' => array()
				)
			)
		)
	) );
	
    /*
     * <--- END SECTIONS
     */
	
	/*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    add_action( 'redux/loaded', 'remove_demo' );
	/**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }
	