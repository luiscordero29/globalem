<?php

/* Megafactory Page Options */
$prefix = 'megafactory_post_';

$fields = array(
	array( 
		'label'	=> esc_html__( 'Post General Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are single post general settings.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Post Layout', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose post layout for current post single view.', 'megafactory-core' ), 
		'id'	=> $prefix.'layout',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'wide' => esc_html__( 'Wide', 'megafactory-core' ),
			'boxed' => esc_html__( 'Boxed', 'megafactory-core' )			
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Post Content Padding Option', 'megafactory-core' ),
		'id'	=> $prefix.'content_padding_opt',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'		
	),
	array( 
		'label'	=> esc_html__( 'Post Content Padding', 'megafactory-core' ), 
		'desc'	=> esc_html__( 'Set the top/right/bottom/left padding of post content.', 'megafactory-core' ),
		'id'	=> $prefix.'content_padding',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'space',
		'required'	=> array( $prefix.'content_padding_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Post Template Option', 'megafactory-core' ),
		'id'	=> $prefix.'template_opt',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'		
	),
	array( 
		'label'	=> esc_html__( 'Post Template', 'megafactory-core' ),
		'id'	=> $prefix.'template',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'image_select',
		'options' => array(
			'no-sidebar'	=> get_theme_file_uri( '/assets/images/page-layouts/1.png' ), 
			'right-sidebar'	=> get_theme_file_uri( '/assets/images/page-layouts/2.png' ), 
			'left-sidebar'	=> get_theme_file_uri( '/assets/images/page-layouts/3.png' ), 
			'both-sidebar'	=> get_theme_file_uri( '/assets/images/page-layouts/4.png' ), 
		),
		'default'	=> 'right-sidebar',
		'required'	=> array( $prefix.'template_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Left Sidebar', 'megafactory-core' ),
		'id'	=> $prefix.'left_sidebar',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'template_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Right Sidebar', 'megafactory-core' ),
		'id'	=> $prefix.'right_sidebar',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'template_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Sidebar On Mobile', 'megafactory-core' ),
		'id'	=> $prefix.'sidebar_mobile',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'1' => esc_html__( 'Show', 'megafactory-core' ),
			'0' => esc_html__( 'Hide', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Featured Slider', 'megafactory-core' ),
		'id'	=> $prefix.'featured_slider',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'1' => esc_html__( 'Enable', 'megafactory-core' ),
			'0' => esc_html__( 'Disable', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Full Width Wrap', 'megafactory-core' ),
		'id'	=> $prefix.'full_wrap',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'1' => esc_html__( 'Enable', 'megafactory-core' ),
			'0' => esc_html__( 'Disable', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Post Items Option', 'megafactory-core' ),
		'id'	=> $prefix.'items_opt',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'		
	),
	array( 
		'label'	=> esc_html__( 'Post Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Needed single post items drag from disabled and put enabled part.', 'megafactory-core' ),
		'id'	=> $prefix.'items',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'dragdrop',
		'options' => array ( 
			'all' => array( 'title', 'top-meta', 'thumb', 'content', 'bottom-meta' ),
			'items' => array( 
				'title' 	=> esc_html__( 'Title', 'megafactory-core' ),
				'top-meta'	=> esc_html__( 'Top Meta', 'megafactory-core' ),
				'thumb' 	=> esc_html__( 'Thumbnail', 'megafactory-core' ),
				'content' 	=> esc_html__( 'Content', 'megafactory-core' ),
				'bottom-meta'		=> esc_html__( 'Bottom Meta', 'megafactory-core' )
			)
		),
		'default'	=> 'title,top-meta,thumb,content,bottom-meta',
		'required'	=> array( $prefix.'items_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Post Overlay', 'megafactory-core' ),
		'id'	=> $prefix.'overlay_opt',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'1' => esc_html__( 'Enable', 'megafactory-core' ),
			'0' => esc_html__( 'Disable', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Post Overlay Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Needed overlay post items drag from disabled and put enabled part.', 'megafactory-core' ),
		'id'	=> $prefix.'overlay_items',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'dragdrop',
		'options' => array ( 
			'all' => array( 'title', 'top-meta', 'bottom-meta' ),
			'items' => array( 
				'title' 	=> esc_html__( 'Title', 'megafactory-core' ),
				'top-meta'	=> esc_html__( 'Top Meta', 'megafactory-core' ),
				'bottom-meta'		=> esc_html__( 'Bottom Meta', 'megafactory-core' )
			)
		),
		'default'	=> 'title',
		'required'	=> array( $prefix.'overlay_opt', '1' )
	),
	array( 
		'label'	=> esc_html__( 'Post Page Items Option', 'megafactory-core' ),
		'id'	=> $prefix.'page_items_opt',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'		
	),
	array( 
		'label'	=> esc_html__( 'Post Page Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Needed post page items drag from disabled and put enabled part.', 'megafactory-core' ),
		'id'	=> $prefix.'page_items',
		'tab'	=> esc_html__( 'General', 'megafactory-core' ),
		'type'	=> 'dragdrop',
		'options' => array ( 
			'all' => array( 'post-items', 'author-info', 'related-slider', 'post-nav', 'comment' ),
			'items' => array( 
				'post-items' 	=> esc_html__( 'Post Items', 'megafactory-core' ),
				'author-info'	=> esc_html__( 'Author Info', 'megafactory-core' ),
				'related-slider'=> esc_html__( 'Related Slider', 'megafactory-core' ),
				'post-nav' 	=> esc_html__( 'Post Nav', 'megafactory-core' ),
				'comment' 	=> esc_html__( 'Comment', 'megafactory-core' )
			)
		),
		'default'	=> 'post-items,author-info,related-slider,post-nav,comment',
		'required'	=> array( $prefix.'page_items_opt', 'custom' )
	),
	//Header
	array( 
		'label'	=> esc_html__( 'Header General Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header general settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Header Layout', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose post layout for current post header layout.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_layout',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'wide' => esc_html__( 'Wide', 'megafactory-core' ),
			'boxed' => esc_html__( 'Boxed', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Type', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose post layout for current post header type.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_type',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'default' => esc_html__( 'Default', 'megafactory-core' ),
			'left-sticky' => esc_html__( 'Left Sticky', 'megafactory-core' ),
			'right-sticky' => esc_html__( 'Right Sticky', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Background Image', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header background image for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'image',
		'id'	=> $prefix.'header_bg_img',
		'required'	=> array( $prefix.'header_type', 'default' )
	),
	array( 
		'label'	=> esc_html__( 'Header Items Options', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header items options for enable header drag and drop items.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_items_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header general items for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dragdrop_multi',
		'id'	=> $prefix.'header_items',
		'dd_fields' => array ( 
			'Normal' => array( 
				'header-topbar' 	=> esc_html__( 'Topbar', 'megafactory-core' ),
				'header-logo'	=> esc_html__( 'Logo Bar', 'megafactory-core' )
			),
			'Sticky' => array( 
				'header-nav' 	=> esc_html__( 'Navbar', 'megafactory-core' )
			),
			'disabled' => array()
		),
		'required'	=> array( $prefix.'header_items_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Absolute Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header absolute to change header look transparent.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_absolute_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'1' => esc_html__( 'Enable', 'megafactory-core' ),
			'0' => esc_html__( 'Disable', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header sticky options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_sticky_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'sticky' => esc_html__( 'Header Sticky Part', 'megafactory-core' ),
			'sticky-scroll' => esc_html__( 'Sticky Scroll Up', 'megafactory-core' ),
			'none' => esc_html__( 'None', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header topbar settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Options', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header items options for enable header drag and drop items.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_topbar_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Height', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header topbar height for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dimension',
		'id'	=> $prefix.'header_topbar_height',
		'property' => 'height',
		'required'	=> array( $prefix.'header_topbar_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Sticky Height', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header topbar sticky height for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dimension',
		'id'	=> $prefix.'header_topbar_sticky_height',
		'property' => 'height',
		'required'	=> array( $prefix.'header_topbar_opt', 'custom' )
	),
	array( 
		'label'	=> '',
		'desc'	=> esc_html__( 'These all are header topbar skin settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Skin Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header topbar skin settings options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_topbar_skin_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header topbar font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'header_topbar_font',
		'required'	=> array( $prefix.'header_topbar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Background', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header topbar background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'header_topbar_bg',
		'required'	=> array( $prefix.'header_topbar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header topbar link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'header_topbar_link',
		'required'	=> array( $prefix.'header_topbar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header topbar border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'header_topbar_border',
		'required'	=> array( $prefix.'header_topbar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header topbar padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'header_topbar_padding',
		'required'	=> array( $prefix.'header_topbar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Sticky Skin Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header top barsticky skin settings options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_topbar_sticky_skin_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Sticky Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header top barsticky font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'header_topbar_sticky_font',
		'required'	=> array( $prefix.'header_topbar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Sticky Background', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header top barsticky background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'header_topbar_sticky_bg',
		'required'	=> array( $prefix.'header_topbar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Sticky Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header top barsticky link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'header_topbar_sticky_link',
		'required'	=> array( $prefix.'header_topbar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Sticky Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header top barsticky border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'header_topbar_sticky_border',
		'required'	=> array( $prefix.'header_topbar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Sticky Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header top barsticky padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'header_topbar_sticky_padding',
		'required'	=> array( $prefix.'header_topbar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Items Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header topbar items enable options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_topbar_items_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Top Bar Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header topbar items for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dragdrop_multi',
		'id'	=> $prefix.'header_topbar_items',
		'dd_fields' => array ( 
			'Left'  => array(
				'header-topbar-date' => esc_html__( 'Date', 'megafactory-core' ),						
			),
			'Center' => array(),
			'Right' => array(),
			'disabled' => array(
				'header-topbar-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
				'header-topbar-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
				'header-topbar-menu'    => esc_html__( 'Top Bar Menu', 'megafactory-core' ),
				'header-topbar-social'	=> esc_html__( 'Social', 'megafactory-core' ),
				'header-topbar-search'	=> esc_html__( 'Search', 'megafactory-core' )
			)
		),
		'required'	=> array( $prefix.'header_topbar_items_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Options', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header items options for enable header drag and drop items.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_logo_bar_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Height', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar height for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dimension',
		'id'	=> $prefix.'header_logo_bar_height',
		'property' => 'height',
		'required'	=> array( $prefix.'header_logo_bar_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Sticky Height', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar sticky height for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dimension',
		'id'	=> $prefix.'header_logo_bar_sticky_height',
		'property' => 'height',
		'required'	=> array( $prefix.'header_logo_bar_opt', 'custom' )
	),
	array( 
		'label'	=> '',
		'desc'	=> esc_html__( 'These all are header logo bar skin settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Skin Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header logo bar skin settings options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_logo_bar_skin_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'header_logo_bar_font',
		'required'	=> array( $prefix.'header_logo_bar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Background', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'header_logo_bar_bg',
		'required'	=> array( $prefix.'header_logo_bar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'header_logo_bar_link',
		'required'	=> array( $prefix.'header_logo_bar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'header_logo_bar_border',
		'required'	=> array( $prefix.'header_logo_bar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'header_logo_bar_padding',
		'required'	=> array( $prefix.'header_logo_bar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Sticky Skin Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header logo bar sticky skin settings options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_logobar_sticky_skin_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Sticky Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar sticky font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'header_logobar_sticky_font',
		'required'	=> array( $prefix.'header_logobar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Sticky Background', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar sticky background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'header_logobar_sticky_bg',
		'required'	=> array( $prefix.'header_logobar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Sticky Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar sticky link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'header_logobar_sticky_link',
		'required'	=> array( $prefix.'header_logobar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Sticky Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar sticky border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'header_logobar_sticky_border',
		'required'	=> array( $prefix.'header_logobar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Sticky Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar sticky padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'header_logobar_sticky_padding',
		'required'	=> array( $prefix.'header_logobar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Items Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header logo bar items enable options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_logo_bar_items_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Logo Bar Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header logo bar items for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dragdrop_multi',
		'id'	=> $prefix.'header_logo_bar_items',
		'dd_fields' => array ( 
			'Left'  => array(),
			'Center' => array(
				'header-logobar-logo'	=> esc_html__( 'Logo', 'megafactory-core' ),
			),
			'Right' => array(),
			'disabled' => array(
				'header-logobar-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
				'header-logobar-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
				'header-logobar-menu'    => esc_html__( 'Main Menu', 'megafactory-core' ),
				'header-logobar-social'	=> esc_html__( 'Social', 'megafactory-core' ),
				'header-logobar-search'	=> esc_html__( 'Search', 'megafactory-core' ),
				'header-logobar-secondary-toggle'	=> esc_html__( 'Secondary Toggle', 'megafactory-core' ),
				'header-logobar-search-toggle'	=> esc_html__( 'Search Toggle', 'megafactory-core' )
			)
		),
		'required'	=> array( $prefix.'header_logo_bar_items_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Options', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header items options for enable header drag and drop items.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_navbar_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Height', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar height for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dimension',
		'id'	=> $prefix.'header_navbar_height',
		'property' => 'height',
		'required'	=> array( $prefix.'header_navbar_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Sticky Height', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar sticky height for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dimension',
		'id'	=> $prefix.'header_navbar_sticky_height',
		'property' => 'height',
		'required'	=> array( $prefix.'header_navbar_opt', 'custom' )
	),
	array( 
		'label'	=> '',
		'desc'	=> esc_html__( 'These all are header navbar skin settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Skin Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header navbar skin settings options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_navbar_skin_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'header_navbar_font',
		'required'	=> array( $prefix.'header_navbar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Background', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'header_navbar_bg',
		'required'	=> array( $prefix.'header_navbar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'header_navbar_link',
		'required'	=> array( $prefix.'header_navbar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'header_navbar_border',
		'required'	=> array( $prefix.'header_navbar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'header_navbar_padding',
		'required'	=> array( $prefix.'header_navbar_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Sticky Skin Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header navbar sticky skin settings options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_navbar_sticky_skin_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Sticky Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar sticky font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'header_navbar_sticky_font',
		'required'	=> array( $prefix.'header_navbar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Sticky Background', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar sticky background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'header_navbar_sticky_bg',
		'required'	=> array( $prefix.'header_navbar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Sticky Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar sticky link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'header_navbar_sticky_link',
		'required'	=> array( $prefix.'header_navbar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Sticky Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar sticky border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'header_navbar_sticky_border',
		'required'	=> array( $prefix.'header_navbar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Sticky Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar sticky padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'header_navbar_sticky_padding',
		'required'	=> array( $prefix.'header_navbar_sticky_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Items Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header navbar items enable options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_navbar_items_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Navbar Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header navbar items for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dragdrop_multi',
		'id'	=> $prefix.'header_navbar_items',
		'dd_fields' => array ( 
			'Left'  => array(											
				'header-navbar-menu'    => esc_html__( 'Main Menu', 'megafactory-core' ),
			),
			'Center' => array(
			),
			'Right' => array(
				'header-navbar-search'	=> esc_html__( 'Search', 'megafactory-core' ),
			),
			'disabled' => array(
				'header-navbar-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
				'header-navbar-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
				'header-navbar-logo'	=> esc_html__( 'Logo', 'megafactory-core' ),
				'header-navbar-social'	=> esc_html__( 'Social', 'megafactory-core' ),
				'header-navbar-secondary-toggle'	=> esc_html__( 'Secondary Toggle', 'megafactory-core' ),
				'header-navbar-search-toggle'	=> esc_html__( 'Search Toggle', 'megafactory-core' ),
				'header-navbar-sticky-logo'	=> esc_html__( 'Stikcy Logo', 'megafactory-core' ),
			)
		),
		'required'	=> array( $prefix.'header_navbar_items_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header stikcy settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part Options', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header sticky part option.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_stikcy_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part Width', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header stikcy part width for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dimension',
		'id'	=> $prefix.'header_stikcy_width',
		'property' => 'width',
		'required'	=> array( $prefix.'header_stikcy_opt', 'custom' )
	),
	array( 
		'label'	=> '',
		'desc'	=> esc_html__( 'These all are header stikcy skin settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part Skin Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header stikcy skin settings options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_stikcy_skin_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header stikcy font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'header_stikcy_font',
		'required'	=> array( $prefix.'header_stikcy_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part Background', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header stikcy background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'header_stikcy_bg',
		'required'	=> array( $prefix.'header_stikcy_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header stikcy link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'header_stikcy_link',
		'required'	=> array( $prefix.'header_stikcy_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header stikcy border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'header_stikcy_border',
		'required'	=> array( $prefix.'header_stikcy_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header stikcy padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'header_stikcy_padding',
		'required'	=> array( $prefix.'header_stikcy_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part Items Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose header stikcy items enable options.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_stikcy_items_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Header Sticky/Fixed Part Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are header stikcy items for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dragdrop_multi',
		'id'	=> $prefix.'header_stikcy_items',
		'dd_fields' => array ( 
			'Top'  => array(
				'header-fixed-logo' => esc_html__( 'Logo', 'megafactory-core' )
			),
			'Middle'  => array(
				'header-fixed-menu'	=> esc_html__( 'Menu', 'megafactory-core' )					
			),
			'Bottom'  => array(
				'header-fixed-social'	=> esc_html__( 'Social', 'megafactory-core' )					
			),
			'disabled' => array(
				'header-fixed-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
				'header-fixed-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
				'header-fixed-search'	=> esc_html__( 'Search Form', 'megafactory-core' )
			)
		),
		'required'	=> array( $prefix.'header_stikcy_items_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Bar', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are post title bar settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Post Title Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose post title enable or disable.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_post_title_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'1' => esc_html__( 'Enable', 'megafactory-core' ),
			'0' => esc_html__( 'Disable', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Post Title Text', 'megafactory-core' ),
		'desc'	=> esc_html__( 'If this post title is empty, then showing current post default title.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_post_title_text',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'text',
		'default'	=> '',
		'required'	=> array( $prefix.'header_post_title_opt', '1' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Description', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Enter post title description.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_post_title_desc',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'textarea',
		'default'	=> '',
		'required'	=> array( $prefix.'header_post_title_opt', '1' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Background Parallax', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose post title background parallax.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_post_title_parallax',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'1' => esc_html__( 'Enable', 'megafactory-core' ),
			'0' => esc_html__( 'Disable', 'megafactory-core' )
		),
		'default'	=> 'theme-default',
		'required'	=> array( $prefix.'header_post_title_opt', '1' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Background Video Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose post title background video option.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_post_title_video_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'1' => esc_html__( 'Enable', 'megafactory-core' ),
			'0' => esc_html__( 'Disable', 'megafactory-core' )
		),
		'default'	=> 'theme-default',
		'required'	=> array( $prefix.'header_post_title_opt', '1' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Background Video', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Enter youtube video ID. Example: ZSt9tm3RoUU.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_post_title_video',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'text',
		'default'	=> '',
		'required'	=> array( $prefix.'header_post_title_video_opt', '1' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Bar Items Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose post title bar items option.', 'megafactory-core' ), 
		'id'	=> $prefix.'post_title_items_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default',
		'required'	=> array( $prefix.'header_post_title_opt', '1' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Bar Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are post title bar items for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'dragdrop_multi',
		'id'	=> $prefix.'post_title_items',
		'dd_fields' => array ( 
			'Left'  => array(
				'title' => esc_html__( 'Post Title Text', 'megafactory-core' ),
			),
			'Center'  => array(
				
			),
			'Right'  => array(
				'breadcrumb'	=> esc_html__( 'Breadcrumb', 'megafactory-core' )
			),
			'disabled' => array()
		),
		'required'	=> array( $prefix.'post_title_items_opt', 'custom' )
	),
	array( 
		'label'	=> '',
		'desc'	=> esc_html__( 'These all are post title skin settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'label',
		'required'	=> array( $prefix.'header_post_title_opt', '1' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Skin Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose post title skin settings options.', 'megafactory-core' ), 
		'id'	=> $prefix.'post_title_skin_opt',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default',
		'required'	=> array( $prefix.'header_post_title_opt', '1' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are post title font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'post_title_font',
		'required'	=> array( $prefix.'post_title_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Background Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are post title background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'post_title_bg',
		'required'	=> array( $prefix.'post_title_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Background Image', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Enter post title background image url.', 'megafactory-core' ), 
		'id'	=> $prefix.'post_title_bg_img',
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'url',
		'default'	=> '',
		'required'	=> array( $prefix.'post_title_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are post title link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'post_title_link',
		'required'	=> array( $prefix.'post_title_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are post title border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'post_title_border',
		'required'	=> array( $prefix.'post_title_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are post title padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'post_title_padding',
		'required'	=> array( $prefix.'post_title_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Post Title Overlay', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are post title overlay color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'post_title_overlay',
		'required'	=> array( $prefix.'post_title_skin_opt', 'custom' )
	),
	//Footer
	array( 
		'label'	=> 'Footer General',
		'desc'	=> esc_html__( 'These all are header footer settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Footer Layout', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer layout for current post.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_layout',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'wide' => esc_html__( 'Wide', 'megafactory-core' ),
			'boxed' => esc_html__( 'Boxed', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Hidden Footer', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose hidden footer option.', 'megafactory-core' ), 
		'id'	=> $prefix.'hidden_footer',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'1' => esc_html__( 'Enable', 'megafactory-core' ),
			'0' => esc_html__( 'Disable', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> '',
		'desc'	=> esc_html__( 'These all are footer skin settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Footer Skin Settings', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer skin settings options.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_skin_opt',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Footer Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'footer_font',
		'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Background Image', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer background image for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'image',
		'id'	=> $prefix.'footer_bg_img',
		'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Background Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'footer_bg',
		'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Background Overlay', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer background overlay color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'footer_bg_overlay',
		'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'footer_link',
		'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'footer_border',
		'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'footer_padding',
		'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Items Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer items enable options.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_items_opt',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Footer Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer items for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'dragdrop_multi',
		'id'	=> $prefix.'footer_items',
		'dd_fields' => array ( 
			'Enabled'  => array(
				'footer-bottom'	=> esc_html__( 'Footer Bottom', 'megafactory-core' )
			),
			'disabled' => array(
				'footer-top' => esc_html__( 'Footer Top', 'megafactory-core' ),
				'footer-middle'	=> esc_html__( 'Footer Middle', 'megafactory-core' )
			)
		),
		'required'	=> array( $prefix.'footer_items_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Top',
		'desc'	=> esc_html__( 'These all are footer top settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Footer Top Skin', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer top skin options.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_top_skin_opt',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Footer Top Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer top font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'footer_top_font',
		'required'	=> array( $prefix.'footer_top_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Top Background', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'footer_top_bg',
		'required'	=> array( $prefix.'footer_top_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Top Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer top link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'footer_top_link',
		'required'	=> array( $prefix.'footer_top_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Top Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer top border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'footer_top_border',
		'required'	=> array( $prefix.'footer_top_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Top Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer top padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'footer_top_padding',
		'required'	=> array( $prefix.'footer_top_skin_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Top Columns and Sidebars Settings',
		'desc'	=> esc_html__( 'These all are footer top columns and sidebar settings.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Footer Layout Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer layout option.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_top_layout_opt',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Footer Layout', 'megafactory-core' ),
		'id'	=> $prefix.'footer_top_layout',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'image_select',
		'options' => array(
			'3-3-3-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-1.png', 
			'4-4-4'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-2.png', 
			'3-6-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-3.png', 
			'6-6'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-4.png', 
			'9-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-5.png', 
			'3-9'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-6.png', 
			'12'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-7.png'
		),
		'default'	=> '4-4-4',
		'required'	=> array( $prefix.'footer_top_layout_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer First Column',
		'desc'	=> esc_html__( 'Select footer first column widget.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'id'	=> $prefix.'footer_top_sidebar_1',
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'footer_top_layout_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Second Column',
		'desc'	=> esc_html__( 'Select footer second column widget.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'id'	=> $prefix.'footer_top_sidebar_2',
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'footer_top_layout_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Third Column',
		'desc'	=> esc_html__( 'Select footer third column widget.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'id'	=> $prefix.'footer_top_sidebar_3',
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'footer_top_layout_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Fourth Column',
		'desc'	=> esc_html__( 'Select footer fourth column widget.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'id'	=> $prefix.'footer_top_sidebar_4',
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'footer_top_layout_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Middle',
		'desc'	=> esc_html__( 'These all are footer middle settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Footer Middle Skin', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer middle skin options.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_middle_skin_opt',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Footer Middle Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer middle font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'footer_middle_font',
		'required'	=> array( $prefix.'footer_middle_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Middle Background', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'footer_middle_bg',
		'required'	=> array( $prefix.'footer_middle_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Middle Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer middle link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'footer_middle_link',
		'required'	=> array( $prefix.'footer_middle_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Middle Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer middle border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'footer_middle_border',
		'required'	=> array( $prefix.'footer_middle_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Middle Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer middle padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'footer_middle_padding',
		'required'	=> array( $prefix.'footer_middle_skin_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Middle Columns and Sidebars Settings',
		'desc'	=> esc_html__( 'These all are footer middle columns and sidebar settings.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Footer Layout Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer layout option.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_middle_layout_opt',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Footer Layout', 'megafactory-core' ),
		'id'	=> $prefix.'footer_middle_layout',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'image_select',
		'options' => array(
			'3-3-3-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-1.png', 
			'4-4-4'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-2.png', 
			'3-6-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-3.png', 
			'6-6'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-4.png', 
			'9-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-5.png', 
			'3-9'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-6.png', 
			'12'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-7.png'
		),
		'default'	=> '4-4-4',
		'required'	=> array( $prefix.'footer_middle_layout_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer First Column',
		'desc'	=> esc_html__( 'Select footer first column widget.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'id'	=> $prefix.'footer_middle_sidebar_1',
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'footer_middle_layout_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Second Column',
		'desc'	=> esc_html__( 'Select footer second column widget.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'id'	=> $prefix.'footer_middle_sidebar_2',
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'footer_middle_layout_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Third Column',
		'desc'	=> esc_html__( 'Select footer third column widget.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'id'	=> $prefix.'footer_middle_sidebar_3',
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'footer_middle_layout_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Fourth Column',
		'desc'	=> esc_html__( 'Select footer fourth column widget.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'id'	=> $prefix.'footer_middle_sidebar_4',
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'footer_middle_layout_opt', 'custom' )
	),
	array( 
		'label'	=> 'Footer Bottom',
		'desc'	=> esc_html__( 'These all are footer bottom settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Footer Bottom Fixed', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer bottom fixed option.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_bottom_fixed',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'1' => esc_html__( 'Enable', 'megafactory-core' ),
			'0' => esc_html__( 'Disable', 'megafactory-core' )			
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> '',
		'desc'	=> esc_html__( 'These all are footer bottom skin settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Footer Bottom Skin', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer bottom skin options.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_bottom_skin_opt',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Footer Bottom Font Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer bottom font color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'color',
		'id'	=> $prefix.'footer_bottom_font',
		'required'	=> array( $prefix.'footer_bottom_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Bottom Background', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer bottom background color for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'alpha_color',
		'id'	=> $prefix.'footer_bottom_bg',
		'required'	=> array( $prefix.'footer_bottom_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Bottom Link Color', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer bottom link color settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'link_color',
		'id'	=> $prefix.'footer_bottom_link',
		'required'	=> array( $prefix.'footer_bottom_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Bottom Border', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer bottom border settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'space',
		'color' => 1,
		'border_style' => 1,
		'id'	=> $prefix.'footer_bottom_border',
		'required'	=> array( $prefix.'footer_bottom_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Bottom Padding', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer bottom padding settings for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'space',
		'id'	=> $prefix.'footer_bottom_padding',
		'required'	=> array( $prefix.'footer_bottom_skin_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Bottom Widget Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer bottom widget options.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_bottom_widget_opt',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> 'Footer Bottom Widget',
		'desc'	=> esc_html__( 'Select footer bottom widget.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'id'	=> $prefix.'footer_bottom_widget',
		'type'	=> 'sidebar',
		'required'	=> array( $prefix.'footer_bottom_widget_opt', 'custom' )
	),
	array( 
		'label'	=> esc_html__( 'Footer Bottom Items Option', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose footer bottom items options.', 'megafactory-core' ), 
		'id'	=> $prefix.'footer_bottom_items_opt',
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Footer Bottom Items', 'megafactory-core' ),
		'desc'	=> esc_html__( 'These all are footer bottom items for currrent post.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
		'type'	=> 'dragdrop_multi',
		'id'	=> $prefix.'footer_bottom_items',
		'dd_fields' => array ( 
			'Left'  => array(
				'copyright' => esc_html__( 'Copyright Text', 'megafactory-core' )
			),
			'Center'  => array(
				'menu'	=> esc_html__( 'Footer Menu', 'megafactory-core' )
			),
			'Right'  => array(),
			'disabled' => array(
				'social'	=> esc_html__( 'Footer Social Links', 'megafactory-core' ),
				'widget'	=> esc_html__( 'Custom Widget', 'megafactory-core' )
			)
		),
		'required'	=> array( $prefix.'footer_bottom_items_opt', 'custom' )
	),
	//Header Slider
	array( 
		'label'	=> esc_html__( 'Slider', 'megafactory-core' ),
		'desc'	=> esc_html__( 'This header slider settings.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Slider', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Slider Option', 'megafactory-core' ),
		'id'	=> $prefix.'header_slider_opt',
		'tab'	=> esc_html__( 'Slider', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'bottom' => esc_html__( 'Below Header', 'megafactory-core' ),
			'top' => esc_html__( 'Above Header', 'megafactory-core' ),
			'none' => esc_html__( 'None', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Slider Shortcode', 'megafactory-core' ),
		'desc'	=> esc_html__( 'This is the place for enter slider shortcode. Example revolution slider shortcodes.', 'megafactory-core' ), 
		'id'	=> $prefix.'header_slider',
		'tab'	=> esc_html__( 'Slider', 'megafactory-core' ),
		'type'	=> 'textarea',
		'default'	=> ''
	),
	//Post Format
	array( 
		'label'	=> esc_html__( 'Video', 'megafactory-core' ),
		'desc'	=> esc_html__( 'This part for if you choosed video format, then you must choose video type and give video id.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Video Modal', 'megafactory-core' ),
		'id'	=> $prefix.'video_modal',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'onclick' => esc_html__( 'On Click Run Video', 'megafactory-core' ),
			'overlay' => esc_html__( 'Modal Box Video', 'megafactory-core' ),
			'direct' => esc_html__( 'Direct Video', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Video Type', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose video type.', 'megafactory-core' ), 
		'id'	=> $prefix.'video_type',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'' => esc_html__( 'None', 'megafactory-core' ),
			'youtube' => esc_html__( 'Youtube', 'megafactory-core' ),
			'vimeo' => esc_html__( 'Vimeo', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom Video', 'megafactory-core' )
		),
		'default'	=> ''
	),
	array( 
		'label'	=> esc_html__( 'Video ID', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Enter Video ID Example: ZSt9tm3RoUU. If you choose custom video type then you enter custom video url and video must be mp4 format.', 'megafactory-core' ), 
		'id'	=> $prefix.'video_id',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'text',
		'default'	=> ''
	),
	array( 
		'type'	=> 'line',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' )
	),
	array( 
		'label'	=> esc_html__( 'Audio', 'megafactory-core' ),
		'desc'	=> esc_html__( 'This part for if you choosed audio format, then you must give audio id.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Audio Type', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Choose audio type.', 'megafactory-core' ), 
		'id'	=> $prefix.'audio_type',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'' => esc_html__( 'None', 'megafactory-core' ),
			'soundcloud' => esc_html__( 'Soundcloud', 'megafactory-core' ),
			'custom' => esc_html__( 'Custom Audio', 'megafactory-core' )
		),
		'default'	=> ''
	),
	array( 
		'label'	=> esc_html__( 'Audio ID', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Enter soundcloud audio ID. Example: 315307209.', 'megafactory-core' ), 
		'id'	=> $prefix.'audio_id',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'text',
		'default'	=> ''
	),
	array( 
		'type'	=> 'line',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' )
	),
	array( 
		'label'	=> esc_html__( 'Gallery', 'megafactory-core' ),
		'desc'	=> esc_html__( 'This part for if you choosed gallery format, then you must choose gallery images here.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Gallery Modal', 'megafactory-core' ),
		'id'	=> $prefix.'gallery_modal',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'default' => esc_html__( 'Default Gallery', 'megafactory-core' ),
			'popup' => esc_html__( 'Popup Gallery', 'megafactory-core' ),
			'grid' => esc_html__( 'Grid Popup Gallery', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Choose Gallery Images', 'megafactory-core' ),
		'id'	=> $prefix.'gallery',
		'type'	=> 'gallery',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' )
	),
	array( 
		'type'	=> 'line',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' )
	),
	array( 
		'label'	=> esc_html__( 'Quote', 'megafactory-core' ),
		'desc'	=> esc_html__( 'This part for if you choosed quote format, then you must fill the quote text and author name box.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Quote Modal', 'megafactory-core' ),
		'id'	=> $prefix.'quote_modal',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'featured' => esc_html__( 'Dark Overlay', 'megafactory-core' ),
			'theme-overlay' => esc_html__( 'Theme Overlay', 'megafactory-core' ),
			'theme' => esc_html__( 'Theme Color Background', 'megafactory-core' ),
			'none' => esc_html__( 'None', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Quote Text', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Enter quote text.', 'megafactory-core' ), 
		'id'	=> $prefix.'quote_text',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'textarea',
		'default'	=> ''
	),
	array( 
		'label'	=> esc_html__( 'Quote Author', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Enter quote author name.', 'megafactory-core' ), 
		'id'	=> $prefix.'quote_author',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'text',
		'default'	=> ''
	),
	array( 
		'type'	=> 'line',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' )
	),
	array( 
		'label'	=> esc_html__( 'Link', 'megafactory-core' ),
		'desc'	=> esc_html__( 'This part for if you choosed link format, then you must fill the external link box.', 'megafactory-core' ), 
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'label'
	),
	array( 
		'label'	=> esc_html__( 'Link Modal', 'megafactory-core' ),
		'id'	=> $prefix.'link_modal',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'select',
		'options' => array ( 
			'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
			'featured' => esc_html__( 'Dark Overlay', 'megafactory-core' ),
			'theme-overlay' => esc_html__( 'Theme Overlay', 'megafactory-core' ),
			'theme' => esc_html__( 'Theme Color Background', 'megafactory-core' ),
			'none' => esc_html__( 'None', 'megafactory-core' )
		),
		'default'	=> 'theme-default'
	),
	array( 
		'label'	=> esc_html__( 'Link Text', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Enter link text to show.', 'megafactory-core' ), 
		'id'	=> $prefix.'link_text',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'text',
		'default'	=> ''
	),
	array( 
		'label'	=> esc_html__( 'External Link', 'megafactory-core' ),
		'desc'	=> esc_html__( 'Enter external link.', 'megafactory-core' ), 
		'id'	=> $prefix.'extrenal_link',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
		'type'	=> 'url',
		'default'	=> ''
	),
	array( 
		'type'	=> 'line',
		'tab'	=> esc_html__( 'Format', 'megafactory-core' )
	),
	
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
 
$post_box = new Custom_Add_Meta_Box( 'megafactory_post_metabox', esc_html__( 'Megafactory Post Options', 'megafactory-core' ), $fields, 'post', true );


/* Megafactory Page Options */
//$prefix = 'megafactory_page_';

function megafactoryMetaboxFields( $prefix ){
	
	$megafactory_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
	$megafactory_nav_menus = array( "none" => esc_html__( "None", "megafactory" ) );
	foreach( $megafactory_menus as $menu ){
		$megafactory_nav_menus[$menu->slug] = $menu->name;
	}
			
	$fields = array(
		array( 
			'label'	=> esc_html__( 'Page General Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are page general settings.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Page Layout', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose page layout for current post single view.', 'megafactory-core' ), 
			'id'	=> $prefix.'layout',
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'wide' => esc_html__( 'Wide', 'megafactory-core' ),
				'boxed' => esc_html__( 'Boxed', 'megafactory-core' )			
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Page Content Padding Option', 'megafactory-core' ),
			'id'	=> $prefix.'content_padding_opt',
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'		
		),
		array( 
			'label'	=> esc_html__( 'Page Content Padding', 'megafactory-core' ), 
			'desc'	=> esc_html__( 'Set the top/right/bottom/left padding of page content.', 'megafactory-core' ),
			'id'	=> $prefix.'content_padding',
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'space',
			'required'	=> array( $prefix.'content_padding_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Page Background Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose color setting for current page background.', 'megafactory-core' ),
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'main_bg_color'
		),
		array( 
				'label'	=> esc_html__( 'Page Background Image', 'megafactory-core' ),
				'desc'	=> esc_html__( 'Choose custom logo image for current page.', 'megafactory-core' ), 
				'tab'	=> esc_html__( 'General', 'megafactory-core' ),
				'type'	=> 'image',
				'id'	=> $prefix.'main_bg_image'
			),
		array( 
			'label'	=> esc_html__( 'Page Margin', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are margin settings for current page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'main_margin'
		),
		array( 
			'label'	=> esc_html__( 'Page Template Option', 'megafactory-core' ),
			'id'	=> $prefix.'template_opt',
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'		
		),
		array( 
			'label'	=> esc_html__( 'Page Template', 'megafactory-core' ),
			'id'	=> $prefix.'template',
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'image_select',
			'options' => array(
				'no-sidebar'	=> get_theme_file_uri( '/assets/images/page-layouts/1.png' ), 
				'right-sidebar'	=> get_theme_file_uri( '/assets/images/page-layouts/2.png' ), 
				'left-sidebar'	=> get_theme_file_uri( '/assets/images/page-layouts/3.png' ), 
				'both-sidebar'	=> get_theme_file_uri( '/assets/images/page-layouts/4.png' ), 
			),
			'default'	=> 'right-sidebar',
			'required'	=> array( $prefix.'template_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Left Sidebar', 'megafactory-core' ),
			'id'	=> $prefix.'left_sidebar',
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'template_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Right Sidebar', 'megafactory-core' ),
			'id'	=> $prefix.'right_sidebar',
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'template_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Sidebar On Mobile', 'megafactory-core' ),
			'id'	=> $prefix.'sidebar_mobile',
			'tab'	=> esc_html__( 'General', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'1' => esc_html__( 'Show', 'megafactory-core' ),
				'0' => esc_html__( 'Hide', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header General Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header general settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Header Layout', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose page layout for current page header layout.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_layout',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'wide' => esc_html__( 'Wide', 'megafactory-core' ),
				'boxed' => esc_html__( 'Boxed', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Type', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose page layout for current page header type.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_type',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'default' => esc_html__( 'Default', 'megafactory-core' ),
				'left-sticky' => esc_html__( 'Left Sticky', 'megafactory-core' ),
				'right-sticky' => esc_html__( 'Right Sticky', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Background Image', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header background image for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'image',
			'id'	=> $prefix.'header_bg_img',
			'required'	=> array( $prefix.'header_type', 'default' )
		),
		array( 
			'label'	=> esc_html__( 'Header Items Options', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header items options for enable header drag and drop items.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_items_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Items', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header general items for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'header_items',
			'dd_fields' => array ( 
				'Normal' => array( 
					'header-topbar' 	=> esc_html__( 'Topbar', 'megafactory-core' ),
					'header-logo'	=> esc_html__( 'Logo Bar', 'megafactory-core' )
				),
				'Sticky' => array( 
					'header-nav' 	=> esc_html__( 'Navbar', 'megafactory-core' )
				),
				'disabled' => array()
			),
			'required'	=> array( $prefix.'header_items_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Absolute Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header absolute to change header look transparent.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_absolute_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'1' => esc_html__( 'Enable', 'megafactory-core' ),
				'0' => esc_html__( 'Disable', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header sticky options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_sticky_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'sticky' => esc_html__( 'Header Sticky Part', 'megafactory-core' ),
				'sticky-scroll' => esc_html__( 'Sticky Scroll Up', 'megafactory-core' ),
				'none' => esc_html__( 'None', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Secondary Space Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose secondary space option for enable secondary menu space for current page.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_secondary_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'enable' => esc_html__( 'Enable', 'megafactory-core' ),
				'disable' => esc_html__( 'Disable', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Secondary Space Animate Type', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose secondary space option animate type for current page.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_secondary_animate',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array(
				'left-push'		=> esc_html__( 'Left Push', 'megafactory-core' ),
				'left-overlay'	=> esc_html__( 'Left Overlay', 'megafactory-core' ),
				'right-push'	=> esc_html__( 'Right Push', 'megafactory-core' ),
				'right-overlay'	=> esc_html__( 'Right Overlay', 'megafactory-core' ),
				'full-overlay'	=> esc_html__( 'Full Page Overlay', 'megafactory-core' ),
			),
			'default'	=> 'left-push',
			'required'	=> array( $prefix.'header_secondary_opt', 'enable' )
		),
		array( 
			'label'	=> esc_html__( 'Secondary Space Width', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Set secondary space width for current page. Example 300', 'megafactory-core' ), 
			'id'	=> $prefix.'header_secondary_width',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> '',
			'required'	=> array( $prefix.'header_secondary_opt', 'enable' )
		),
		array( 
			'label'	=> esc_html__( 'Custom Logo', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose custom logo image for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'image',
			'id'	=> $prefix.'custom_logo',
		),
		array( 
			'label'	=> esc_html__( 'Custom Sticky Logo', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose custom sticky logo image for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'image',
			'id'	=> $prefix.'custom_sticky_logo',
		),
		array( 
			'label'	=> esc_html__( 'Select Navigation Menu', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose navigation menu for current page.', 'megafactory-core' ), 
			'id'	=> $prefix.'nav_menu',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => $megafactory_nav_menus
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header topbar settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Options', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header items options for enable header drag and drop items.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_topbar_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Height', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header topbar height for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dimension',
			'id'	=> $prefix.'header_topbar_height',
			'property' => 'height',
			'required'	=> array( $prefix.'header_topbar_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Sticky Height', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header topbar sticky height for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dimension',
			'id'	=> $prefix.'header_topbar_sticky_height',
			'property' => 'height',
			'required'	=> array( $prefix.'header_topbar_opt', 'custom' )
		),
		array( 
			'label'	=> '',
			'desc'	=> esc_html__( 'These all are header topbar skin settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Skin Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header topbar skin settings options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_topbar_skin_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header topbar font color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'header_topbar_font',
			'required'	=> array( $prefix.'header_topbar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header topbar background color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'header_topbar_bg',
			'required'	=> array( $prefix.'header_topbar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header topbar link color settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'header_topbar_link',
			'required'	=> array( $prefix.'header_topbar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header topbar border settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'header_topbar_border',
			'required'	=> array( $prefix.'header_topbar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header topbar padding settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'header_topbar_padding',
			'required'	=> array( $prefix.'header_topbar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Sticky Skin Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header top barsticky skin settings options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_topbar_sticky_skin_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Sticky Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header top barsticky font color for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'header_topbar_sticky_font',
			'required'	=> array( $prefix.'header_topbar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Sticky Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header top barsticky background color for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'header_topbar_sticky_bg',
			'required'	=> array( $prefix.'header_topbar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Sticky Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header top barsticky link color settings for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'header_topbar_sticky_link',
			'required'	=> array( $prefix.'header_topbar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Sticky Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header top barsticky border settings for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'header_topbar_sticky_border',
			'required'	=> array( $prefix.'header_topbar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Sticky Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header top barsticky padding settings for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'header_topbar_sticky_padding',
			'required'	=> array( $prefix.'header_topbar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Items Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header topbar items enable options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_topbar_items_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Top Bar Items', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header topbar items for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'header_topbar_items',
			'dd_fields' => array ( 
				'Left'  => array(
					'header-topbar-date' => esc_html__( 'Date', 'megafactory-core' ),						
				),
				'Center' => array(),
				'Right' => array(),
				'disabled' => array(
					'header-topbar-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
					'header-topbar-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
					'header-topbar-menu'    => esc_html__( 'Top Bar Menu', 'megafactory-core' ),
					'header-topbar-social'	=> esc_html__( 'Social', 'megafactory-core' ),
					'header-topbar-search'	=> esc_html__( 'Search', 'megafactory-core' )
				)
			),
			'required'	=> array( $prefix.'header_topbar_items_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Options', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header items options for enable header drag and drop items.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_logo_bar_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Height', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar height for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dimension',
			'id'	=> $prefix.'header_logo_bar_height',
			'property' => 'height',
			'required'	=> array( $prefix.'header_logo_bar_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Sticky Height', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar sticky height for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dimension',
			'id'	=> $prefix.'header_logo_bar_sticky_height',
			'property' => 'height',
			'required'	=> array( $prefix.'header_logo_bar_opt', 'custom' )
		),
		array( 
			'label'	=> '',
			'desc'	=> esc_html__( 'These all are header logo bar skin settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Skin Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header logo bar skin settings options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_logo_bar_skin_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar font color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'header_logo_bar_font',
			'required'	=> array( $prefix.'header_logo_bar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar background color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'header_logo_bar_bg',
			'required'	=> array( $prefix.'header_logo_bar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar link color settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'header_logo_bar_link',
			'required'	=> array( $prefix.'header_logo_bar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar border settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'header_logo_bar_border',
			'required'	=> array( $prefix.'header_logo_bar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar padding settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'header_logo_bar_padding',
			'required'	=> array( $prefix.'header_logo_bar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Sticky Skin Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header logo bar sticky skin settings options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_logobar_sticky_skin_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Sticky Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar sticky font color for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'header_logobar_sticky_font',
			'required'	=> array( $prefix.'header_logobar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Sticky Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar sticky background color for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'header_logobar_sticky_bg',
			'required'	=> array( $prefix.'header_logobar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Sticky Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar sticky link color settings for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'header_logobar_sticky_link',
			'required'	=> array( $prefix.'header_logobar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Sticky Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar sticky border settings for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'header_logobar_sticky_border',
			'required'	=> array( $prefix.'header_logobar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Sticky Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar sticky padding settings for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'header_logobar_sticky_padding',
			'required'	=> array( $prefix.'header_logobar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Items Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header logo bar items enable options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_logo_bar_items_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Logo Bar Items', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header logo bar items for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'header_logo_bar_items',
			'dd_fields' => array ( 
				'Left'  => array(),
				'Center' => array(
					'header-logobar-logo'	=> esc_html__( 'Logo', 'megafactory-core' ),
				),
				'Right' => array(),
				'disabled' => array(
					'header-logobar-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
					'header-logobar-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
					'header-logobar-menu'    => esc_html__( 'Main Menu', 'megafactory-core' ),
					'header-logobar-social'	=> esc_html__( 'Social', 'megafactory-core' ),
					'header-logobar-search'	=> esc_html__( 'Search', 'megafactory-core' ),
					'header-logobar-secondary-toggle'	=> esc_html__( 'Secondary Toggle', 'megafactory-core' ),
					'header-logobar-search-toggle'	=> esc_html__( 'Search Toggle', 'megafactory-core' )
				)
			),
			'required'	=> array( $prefix.'header_logo_bar_items_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Options', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header items options for enable header drag and drop items.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_navbar_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Height', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar height for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dimension',
			'id'	=> $prefix.'header_navbar_height',
			'property' => 'height',
			'required'	=> array( $prefix.'header_navbar_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Sticky Height', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar sticky height for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dimension',
			'id'	=> $prefix.'header_navbar_sticky_height',
			'property' => 'height',
			'required'	=> array( $prefix.'header_navbar_opt', 'custom' )
		),
		array( 
			'label'	=> '',
			'desc'	=> esc_html__( 'These all are header navbar skin settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Skin Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header navbar skin settings options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_navbar_skin_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar font color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'header_navbar_font',
			'required'	=> array( $prefix.'header_navbar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar background color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'header_navbar_bg',
			'required'	=> array( $prefix.'header_navbar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar link color settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'header_navbar_link',
			'required'	=> array( $prefix.'header_navbar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar border settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'header_navbar_border',
			'required'	=> array( $prefix.'header_navbar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar padding settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'header_navbar_padding',
			'required'	=> array( $prefix.'header_navbar_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Sticky Skin Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header navbar sticky skin settings options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_navbar_sticky_skin_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Sticky Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar sticky font color for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'header_navbar_sticky_font',
			'required'	=> array( $prefix.'header_navbar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Sticky Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar sticky background color for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'header_navbar_sticky_bg',
			'required'	=> array( $prefix.'header_navbar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Sticky Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar sticky link color settings for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'header_navbar_sticky_link',
			'required'	=> array( $prefix.'header_navbar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Sticky Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar sticky border settings for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'header_navbar_sticky_border',
			'required'	=> array( $prefix.'header_navbar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Sticky Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar sticky padding settings for currrent post.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'header_navbar_sticky_padding',
			'required'	=> array( $prefix.'header_navbar_sticky_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Items Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header navbar items enable options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_navbar_items_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Navbar Items', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header navbar items for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'header_navbar_items',
			'dd_fields' => array ( 
				'Left'  => array(											
					'header-navbar-menu'    => esc_html__( 'Main Menu', 'megafactory-core' ),
				),
				'Center' => array(
				),
				'Right' => array(
					'header-navbar-search'	=> esc_html__( 'Search', 'megafactory-core' ),
				),
				'disabled' => array(
					'header-navbar-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
					'header-navbar-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
					'header-navbar-logo'	=> esc_html__( 'Logo', 'megafactory-core' ),
					'header-navbar-social'	=> esc_html__( 'Social', 'megafactory-core' ),
					'header-navbar-secondary-toggle'	=> esc_html__( 'Secondary Toggle', 'megafactory-core' ),
					'header-navbar-search-toggle'	=> esc_html__( 'Search Toggle', 'megafactory-core' ),
					'header-navbar-sticky-logo'	=> esc_html__( 'Stikcy Logo', 'megafactory-core' ),
				)
			),
			'required'	=> array( $prefix.'header_navbar_items_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header stikcy settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part Options', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header sticky part option.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_stikcy_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part Width', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header stikcy part width for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dimension',
			'id'	=> $prefix.'header_stikcy_width',
			'property' => 'width',
			'required'	=> array( $prefix.'header_stikcy_opt', 'custom' )
		),
		array( 
			'label'	=> '',
			'desc'	=> esc_html__( 'These all are header stikcy skin settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part Skin Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header stikcy skin settings options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_stikcy_skin_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header stikcy font color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'header_stikcy_font',
			'required'	=> array( $prefix.'header_stikcy_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header stikcy background color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'header_stikcy_bg',
			'required'	=> array( $prefix.'header_stikcy_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header stikcy link color settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'header_stikcy_link',
			'required'	=> array( $prefix.'header_stikcy_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header stikcy border settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'header_stikcy_border',
			'required'	=> array( $prefix.'header_stikcy_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header stikcy padding settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'header_stikcy_padding',
			'required'	=> array( $prefix.'header_stikcy_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part Items Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose header stikcy items enable options.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_stikcy_items_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Header Sticky/Fixed Part Items', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are header stikcy items for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'header_stikcy_items',
			'dd_fields' => array ( 
				'Top'  => array(
					'header-fixed-logo' => esc_html__( 'Logo', 'megafactory-core' )
				),
				'Middle'  => array(
					'header-fixed-menu'	=> esc_html__( 'Menu', 'megafactory-core' )					
				),
				'Bottom'  => array(
					'header-fixed-social'	=> esc_html__( 'Social', 'megafactory-core' )					
				),
				'disabled' => array(
					'header-fixed-text-1'	=> esc_html__( 'Custom Text 1', 'megafactory-core' ),
					'header-fixed-text-2'	=> esc_html__( 'Custom Text 2', 'megafactory-core' ),
					'header-fixed-search'	=> esc_html__( 'Search Form', 'megafactory-core' )
				)
			),
			'required'	=> array( $prefix.'header_stikcy_items_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Bar', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are page title bar settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Page Title Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose page title enable or disable.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_page_title_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'1' => esc_html__( 'Enable', 'megafactory-core' ),
				'0' => esc_html__( 'Disable', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Page Title Text', 'megafactory-core' ),
			'desc'	=> esc_html__( 'If this page title is empty, then showing current page default title.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_page_title_text',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> '',
			'required'	=> array( $prefix.'header_page_title_opt', '1' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Description', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter page title description.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_page_title_desc',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'textarea',
			'default'	=> '',
			'required'	=> array( $prefix.'header_page_title_opt', '1' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Background Parallax', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose page title background parallax.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_page_title_parallax',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'1' => esc_html__( 'Enable', 'megafactory-core' ),
				'0' => esc_html__( 'Disable', 'megafactory-core' )
			),
			'default'	=> 'theme-default',
			'required'	=> array( $prefix.'header_page_title_opt', '1' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Background Video Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose page title background video option.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_page_title_video_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'1' => esc_html__( 'Enable', 'megafactory-core' ),
				'0' => esc_html__( 'Disable', 'megafactory-core' )
			),
			'default'	=> 'theme-default',
			'required'	=> array( $prefix.'header_page_title_opt', '1' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Background Video', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter youtube video ID. Example: ZSt9tm3RoUU.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_page_title_video',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> '',
			'required'	=> array( $prefix.'header_page_title_video_opt', '1' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Bar Items Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose page title bar items option.', 'megafactory-core' ), 
			'id'	=> $prefix.'page_title_items_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default',
			'required'	=> array( $prefix.'header_page_title_opt', '1' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Bar Items', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are page title bar items for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'page_title_items',
			'dd_fields' => array ( 
				'Left'  => array(
					'title' => esc_html__( 'Page Title Text', 'megafactory-core' ),
				),
				'Center'  => array(
					
				),
				'Right'  => array(
					'breadcrumb'	=> esc_html__( 'Breadcrumb', 'megafactory-core' )
				),
				'disabled' => array(
					'description' => esc_html__( 'Page Title Description', 'megafactory-core' )
				)
			),
			'required'	=> array( $prefix.'page_title_items_opt', 'custom' )
		),
		array( 
			'label'	=> '',
			'desc'	=> esc_html__( 'These all are page title skin settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'label',
			'required'	=> array( $prefix.'header_page_title_opt', '1' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Skin Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose page title skin settings options.', 'megafactory-core' ), 
			'id'	=> $prefix.'page_title_skin_opt',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default',
			'required'	=> array( $prefix.'header_page_title_opt', '1' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are page title font color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'page_title_font',
			'required'	=> array( $prefix.'page_title_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are page title background color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'page_title_bg',
			'required'	=> array( $prefix.'page_title_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Background Image', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter page title background image url.', 'megafactory-core' ), 
			'id'	=> $prefix.'page_title_bg_img',
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> '',
			'required'	=> array( $prefix.'page_title_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are page title link color settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'page_title_link',
			'required'	=> array( $prefix.'page_title_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are page title border settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'page_title_border',
			'required'	=> array( $prefix.'page_title_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are page title padding settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'page_title_padding',
			'required'	=> array( $prefix.'page_title_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Page Title Overlay', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are page title overlay color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Header', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'page_title_overlay',
			'required'	=> array( $prefix.'page_title_skin_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer General',
			'desc'	=> esc_html__( 'These all are header footer settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Footer Layout', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer layout for current page.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_layout',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'wide' => esc_html__( 'Wide', 'megafactory-core' ),
				'boxed' => esc_html__( 'Boxed', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Hidden Footer', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose hidden footer option.', 'megafactory-core' ), 
			'id'	=> $prefix.'hidden_footer',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'1' => esc_html__( 'Enable', 'megafactory-core' ),
				'0' => esc_html__( 'Disable', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> '',
			'desc'	=> esc_html__( 'These all are footer skin settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Footer Skin Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer skin settings options.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_skin_opt',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Footer Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer font color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'footer_font',
			'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Background Image', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer background image for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'image',
			'id'	=> $prefix.'footer_bg_img',
			'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Background Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer background color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'footer_bg',
			'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Background Overlay', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer background overlay color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'footer_bg_overlay',
			'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer link color settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'footer_link',
			'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer border settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'footer_border',
			'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer padding settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'footer_padding',
			'required'	=> array( $prefix.'footer_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Items Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer items enable options.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_items_opt',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Footer Items', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer items for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'footer_items',
			'dd_fields' => array ( 
				'Enabled'  => array(
					'footer-bottom'	=> esc_html__( 'Footer Bottom', 'megafactory-core' )
				),
				'disabled' => array(
					'footer-top' => esc_html__( 'Footer Top', 'megafactory-core' ),
					'footer-middle'	=> esc_html__( 'Footer Middle', 'megafactory-core' )
				)
			),
			'required'	=> array( $prefix.'footer_items_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Top',
			'desc'	=> esc_html__( 'These all are footer top settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Footer Top Skin', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer top skin options.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_top_skin_opt',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Footer Top Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer top font color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'footer_top_font',
			'required'	=> array( $prefix.'footer_top_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Top Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer background color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'footer_top_bg',
			'required'	=> array( $prefix.'footer_top_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Top Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer top link color settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'footer_top_link',
			'required'	=> array( $prefix.'footer_top_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Top Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer top border settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'footer_top_border',
			'required'	=> array( $prefix.'footer_top_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Top Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer top padding settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'footer_top_padding',
			'required'	=> array( $prefix.'footer_top_skin_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Top Columns and Sidebars Settings',
			'desc'	=> esc_html__( 'These all are footer top columns and sidebar settings.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Footer Layout Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer layout option.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_top_layout_opt',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Footer Layout', 'megafactory-core' ),
			'id'	=> $prefix.'footer_top_layout',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'image_select',
			'options' => array(
				'3-3-3-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-1.png', 
				'4-4-4'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-2.png', 
				'3-6-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-3.png', 
				'6-6'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-4.png', 
				'9-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-5.png', 
				'3-9'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-6.png', 
				'12'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-7.png'
			),
			'default'	=> '4-4-4',
			'required'	=> array( $prefix.'footer_top_layout_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer First Column',
			'desc'	=> esc_html__( 'Select footer first column widget.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'id'	=> $prefix.'footer_top_sidebar_1',
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'footer_top_layout_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Second Column',
			'desc'	=> esc_html__( 'Select footer second column widget.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'id'	=> $prefix.'footer_top_sidebar_2',
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'footer_top_layout_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Third Column',
			'desc'	=> esc_html__( 'Select footer third column widget.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'id'	=> $prefix.'footer_top_sidebar_3',
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'footer_top_layout_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Fourth Column',
			'desc'	=> esc_html__( 'Select footer fourth column widget.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'id'	=> $prefix.'footer_top_sidebar_4',
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'footer_top_layout_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Middle',
			'desc'	=> esc_html__( 'These all are footer middle settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Footer Middle Skin', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer middle skin options.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_middle_skin_opt',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Footer Middle Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer middle font color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'footer_middle_font',
			'required'	=> array( $prefix.'footer_middle_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Middle Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer background color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'footer_middle_bg',
			'required'	=> array( $prefix.'footer_middle_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Middle Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer middle link color settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'footer_middle_link',
			'required'	=> array( $prefix.'footer_middle_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Middle Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer middle border settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'footer_middle_border',
			'required'	=> array( $prefix.'footer_middle_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Middle Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer middle padding settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'footer_middle_padding',
			'required'	=> array( $prefix.'footer_middle_skin_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Middle Columns and Sidebars Settings',
			'desc'	=> esc_html__( 'These all are footer middle columns and sidebar settings.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Footer Layout Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer layout option.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_middle_layout_opt',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Footer Layout', 'megafactory-core' ),
			'id'	=> $prefix.'footer_middle_layout',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'image_select',
			'options' => array(
				'3-3-3-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-1.png', 
				'4-4-4'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-2.png', 
				'3-6-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-3.png', 
				'6-6'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-4.png', 
				'9-3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-5.png', 
				'3-9'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-6.png', 
				'12'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/footer-layouts/footer-7.png'
			),
			'default'	=> '4-4-4',
			'required'	=> array( $prefix.'footer_middle_layout_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer First Column',
			'desc'	=> esc_html__( 'Select footer first column widget.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'id'	=> $prefix.'footer_middle_sidebar_1',
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'footer_middle_layout_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Second Column',
			'desc'	=> esc_html__( 'Select footer second column widget.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'id'	=> $prefix.'footer_middle_sidebar_2',
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'footer_middle_layout_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Third Column',
			'desc'	=> esc_html__( 'Select footer third column widget.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'id'	=> $prefix.'footer_middle_sidebar_3',
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'footer_middle_layout_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Fourth Column',
			'desc'	=> esc_html__( 'Select footer fourth column widget.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'id'	=> $prefix.'footer_middle_sidebar_4',
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'footer_middle_layout_opt', 'custom' )
		),
		array( 
			'label'	=> 'Footer Bottom',
			'desc'	=> esc_html__( 'These all are footer bottom settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Footer Bottom Fixed', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer bottom fixed option.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_bottom_fixed',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'1' => esc_html__( 'Enable', 'megafactory-core' ),
				'0' => esc_html__( 'Disable', 'megafactory-core' )			
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> '',
			'desc'	=> esc_html__( 'These all are footer bottom skin settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Footer Bottom Skin', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer bottom skin options.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_bottom_skin_opt',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Footer Bottom Font Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer bottom font color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'color',
			'id'	=> $prefix.'footer_bottom_font',
			'required'	=> array( $prefix.'footer_bottom_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Bottom Background', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer bottom background color for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'alpha_color',
			'id'	=> $prefix.'footer_bottom_bg',
			'required'	=> array( $prefix.'footer_bottom_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Bottom Link Color', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer bottom link color settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'link_color',
			'id'	=> $prefix.'footer_bottom_link',
			'required'	=> array( $prefix.'footer_bottom_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Bottom Border', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer bottom border settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'space',
			'color' => 1,
			'border_style' => 1,
			'id'	=> $prefix.'footer_bottom_border',
			'required'	=> array( $prefix.'footer_bottom_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Bottom Padding', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer bottom padding settings for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'space',
			'id'	=> $prefix.'footer_bottom_padding',
			'required'	=> array( $prefix.'footer_bottom_skin_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Bottom Widget Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer bottom widget options.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_bottom_widget_opt',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> 'Footer Bottom Widget',
			'desc'	=> esc_html__( 'Select footer bottom widget.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'id'	=> $prefix.'footer_bottom_widget',
			'type'	=> 'sidebar',
			'required'	=> array( $prefix.'footer_bottom_widget_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Footer Bottom Items Option', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose footer bottom items options.', 'megafactory-core' ), 
			'id'	=> $prefix.'footer_bottom_items_opt',
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Footer Bottom Items', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are footer bottom items for currrent page.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Footer', 'megafactory-core' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'footer_bottom_items',
			'dd_fields' => array ( 
				'Left'  => array(
					'copyright' => esc_html__( 'Copyright Text', 'megafactory-core' )
				),
				'Center'  => array(
					'menu'	=> esc_html__( 'Footer Menu', 'megafactory-core' )
				),
				'Right'  => array(),
				'disabled' => array(
					'social'	=> esc_html__( 'Footer Social Links', 'megafactory-core' ),
					'widget'	=> esc_html__( 'Custom Widget', 'megafactory-core' )
				)
			),
			'required'	=> array( $prefix.'footer_bottom_items_opt', 'custom' )
		),
		//Header Slider
		array( 
			'label'	=> esc_html__( 'Slider', 'megafactory-core' ),
			'desc'	=> esc_html__( 'This header slider settings.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Slider', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Slider Option', 'megafactory-core' ),
			'id'	=> $prefix.'header_slider_opt',
			'tab'	=> esc_html__( 'Slider', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'bottom' => esc_html__( 'Below Header', 'megafactory-core' ),
				'top' => esc_html__( 'Above Header', 'megafactory-core' ),
				'none' => esc_html__( 'None', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Slider Shortcode', 'megafactory-core' ),
			'desc'	=> esc_html__( 'This is the place for enter slider shortcode. Example revolution slider shortcodes.', 'megafactory-core' ), 
			'id'	=> $prefix.'header_slider',
			'tab'	=> esc_html__( 'Slider', 'megafactory-core' ),
			'type'	=> 'textarea',
			'default'	=> ''
		),
	);

	return $fields;
}

$page_fields = megafactoryMetaboxFields( 'megafactory_page_' );
$page_box = new Custom_Add_Meta_Box( 'megafactory_page_metabox', esc_html__( 'Megafactory Page Options', 'megafactory-core' ), $page_fields, 'page', true );


/* Custom Post Type Options */
$megafactory_option = get_option( 'megafactory_options' );

// Portfolio Options
if( isset( $megafactory_option['cpt-opts'] ) && is_array( $megafactory_option['cpt-opts'] ) && in_array( "portfolio", $megafactory_option['cpt-opts'] ) ){
	
	// CPT Portfolio Metabox
	$prefix = 'megafactory_portfolio_';
	$portfolio_fields = array(
		array( 
			'label'	=> esc_html__( 'Portfolio General Settings', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are single portfolio general settings.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Portfolio', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Portfolio Layout Option', 'megafactory-core' ),
			'id'	=> $prefix.'layout_opt',
			'tab'	=> esc_html__( 'Portfolio', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'		
		),
		array( 
			'label'	=> esc_html__( 'Portfolio Layout', 'megafactory-core' ),
			'id'	=> $prefix.'layout',
			'tab'	=> esc_html__( 'Portfolio', 'megafactory-core' ),
			'type'	=> 'image_select',
			'options' => array(
				'1'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/portfolio-layouts/1.png', 
				'2'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/portfolio-layouts/2.png',
				'3'	=> MEGAFACTORY_CORE_URL . '/admin/ReduxCore/assets/img/portfolio-layouts/3.png'
	
			),
			'default'	=> '1',
			'required'	=> array( $prefix.'layout_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Sticky Column', 'megafactory-core' ),
			'id'	=> $prefix.'sticky',
			'tab'	=> esc_html__( 'Portfolio', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'none' => esc_html__( 'None', 'megafactory-core' ),
				'right' => esc_html__( 'Right Column', 'megafactory-core' ),
				'left' => esc_html__( 'Left Column', 'megafactory-core' )
			),
			'default'	=> 'none'		
		),
		array( 
			'label'	=> esc_html__( 'Portfolio Format', 'megafactory-core' ),
			'id'	=> $prefix.'format',
			'tab'	=> esc_html__( 'Portfolio', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'standard' => esc_html__( 'Standard', 'megafactory-core' ),
				'video' => esc_html__( 'Video', 'megafactory-core' ),
				'audio' => esc_html__( 'Audio', 'megafactory-core' ),
				'gallery' => esc_html__( 'Gallery', 'megafactory-core' ),
				'gmap' => esc_html__( 'Google Map', 'megafactory-core' )
			),
			'default'	=> 'standard'		
		),
		array( 
			'label'	=> esc_html__( 'Portfolio Meta Items Options', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose portfolio meta items option.', 'megafactory-core' ), 
			'id'	=> $prefix.'items_opt',
			'tab'	=> esc_html__( 'Portfolio', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom', 'megafactory-core' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Portfolio Meta Items', 'megafactory-core' ),
			'desc'	=> esc_html__( 'These all are meta items for portfolio. drag and drop needed items from disabled part to enabled.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Portfolio', 'megafactory-core' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'items',
			'dd_fields' => array ( 
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
			),
			'required'	=> array( $prefix.'items_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Custom Redirect URL', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter url for custom webpage redirection. This link only for portfolio archive layout not for single portfolio.', 'megafactory-core' ), 
			'id'	=> $prefix.'custom_url',
			'tab'	=> esc_html__( 'Portfolio', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Custom Redirect URL Target', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose custom url page navigate to blank or same page.', 'megafactory-core' ), 
			'id'	=> $prefix.'custom_url_target',
			'tab'	=> esc_html__( 'Portfolio', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'_blank' => esc_html__( 'Blank', 'megafactory-core' ),
				'_self' => esc_html__( 'Self', 'megafactory-core' )
			),
			'default'	=> '_blank'
		),
		array( 
			'label'	=> esc_html__( 'Portfolio Date', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose/Enter portfolio date.', 'megafactory-core' ), 
			'id'	=> $prefix.'date',
			'tab'	=> esc_html__( 'Info', 'megafactory-core' ),
			'type'	=> 'date',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Date Format', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter date format to show selcted portfolio date. Example: F j, Y', 'megafactory-core' ), 
			'id'	=> $prefix.'date_format',
			'tab'	=> esc_html__( 'Info', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> 'F j, Y'
		),
		array( 
			'label'	=> esc_html__( 'Client Name', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter client name.', 'megafactory-core' ), 
			'id'	=> $prefix.'client_name',
			'tab'	=> esc_html__( 'Info', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Duration', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter duration years or months.', 'megafactory-core' ), 
			'id'	=> $prefix.'duration',
			'tab'	=> esc_html__( 'Info', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Estimation', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter project estimation.', 'megafactory-core' ), 
			'id'	=> $prefix.'estimation',
			'tab'	=> esc_html__( 'Info', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Place', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter project place.', 'megafactory-core' ), 
			'id'	=> $prefix.'place',
			'tab'	=> esc_html__( 'Info', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'URL', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter project URL.', 'megafactory-core' ), 
			'id'	=> $prefix.'url',
			'tab'	=> esc_html__( 'Info', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		//Portfolio Format
		array( 
			'label'	=> esc_html__( 'Video', 'megafactory-core' ),
			'desc'	=> esc_html__( 'This part for if you choosed video format, then you must choose video type and give video id.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Video Modal', 'megafactory-core' ),
			'id'	=> $prefix.'video_modal',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'onclick' => esc_html__( 'On Click Run Video', 'megafactory-core' ),
				'overlay' => esc_html__( 'Modal Box Video', 'megafactory-core' ),
				'direct' => esc_html__( 'Direct Video', 'megafactory-core' )
			),
			'default'	=> 'direct'
		),
		array( 
			'label'	=> esc_html__( 'Video Type', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose video type.', 'megafactory-core' ), 
			'id'	=> $prefix.'video_type',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'' => esc_html__( 'None', 'megafactory-core' ),
				'youtube' => esc_html__( 'Youtube', 'megafactory-core' ),
				'vimeo' => esc_html__( 'Vimeo', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom Video', 'megafactory-core' )
			),
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Video ID', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter Video ID Example: ZSt9tm3RoUU. If you choose custom video type then you enter custom video url and video must be mp4 format.', 'megafactory-core' ), 
			'id'	=> $prefix.'video_id',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'type'	=> 'line',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' )
		),
		array( 
			'label'	=> esc_html__( 'Audio', 'megafactory-core' ),
			'desc'	=> esc_html__( 'This part for if you choosed audio format, then you must give audio id.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Audio Type', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose audio type.', 'megafactory-core' ), 
			'id'	=> $prefix.'audio_type',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'' => esc_html__( 'None', 'megafactory-core' ),
				'soundcloud' => esc_html__( 'Soundcloud', 'megafactory-core' ),
				'custom' => esc_html__( 'Custom Audio', 'megafactory-core' )
			),
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Audio ID', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter soundcloud audio ID. Example: 315307209.', 'megafactory-core' ), 
			'id'	=> $prefix.'audio_id',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'type'	=> 'line',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' )
		),
		array( 
			'label'	=> esc_html__( 'Gallery', 'megafactory-core' ),
			'desc'	=> esc_html__( 'This part for if you choosed gallery format, then you must choose gallery images here.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Gallery Modal', 'megafactory-core' ),
			'id'	=> $prefix.'gallery_modal',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'default' => esc_html__( 'Default Gallery', 'megafactory-core' ),
				'normal' => esc_html__( 'Normal Gallery', 'megafactory-core' ),
				'grid' => esc_html__( 'Grid/Masonry Gallery', 'megafactory-core' )
			),
			'default'	=> 'default'
		),
		array( 
			'label'	=> esc_html__( 'Grid Gutter Size', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter gallery grid gutter size. Example 20', 'megafactory-core' ), 
			'id'	=> $prefix.'grid_gutter',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> '',
			'required'	=> array( $prefix.'gallery_modal', 'grid' )
		),
		array( 
			'label'	=> esc_html__( 'Grid Columns', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter gallery grid columns count. Example 2', 'megafactory-core' ), 
			'id'	=> $prefix.'grid_cols',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> '',
			'required'	=> array( $prefix.'gallery_modal', 'grid' )
		),
		array( 
			'label'	=> esc_html__( 'Choose Gallery Images', 'megafactory-core' ),
			'id'	=> $prefix.'gallery',
			'type'	=> 'gallery',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' )
		),
		array( 
			'type'	=> 'line',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' )
		),
		array( 
			'label'	=> esc_html__( 'Google Map', 'megafactory-core' ),
			'desc'	=> esc_html__( 'This part for if you choosed google map format, then you must give google map lat, lang and map style.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Google Map Latitude', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter google latitude.', 'megafactory-core' ), 
			'id'	=> $prefix.'gmap_latitude',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Map Longitude', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter google longitude.', 'megafactory-core' ), 
			'id'	=> $prefix.'gmap_longitude',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Map Marker URL', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter google map custom marker url.', 'megafactory-core' ), 
			'id'	=> $prefix.'gmap_marker',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Map Style', 'megafactory-core' ),
			'id'	=> $prefix.'gmap_style',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'standard' => esc_html__( 'Standard', 'megafactory-core' ),
				'silver' => esc_html__( 'Silver', 'megafactory-core' ),
				'retro' => esc_html__( 'Retro', 'megafactory-core' ),
				'dark' => esc_html__( 'Dark', 'megafactory-core' ),
				'night' => esc_html__( 'Night', 'megafactory-core' ),
				'aubergine' => esc_html__( 'Aubergine', 'megafactory-core' )
			),
			'default'	=> 'standard'
		),
		array( 
			'type'	=> 'line',
			'tab'	=> esc_html__( 'Format', 'megafactory-core' )
		),
	);
	// CPT Portfolio Options
	$portfolio_box = new Custom_Add_Meta_Box( 'megafactory_portfolio_metabox', esc_html__( 'Megafactory Portfolio Options', 'megafactory-core' ), $portfolio_fields, 'mf-portfolio', true );
	
	// CPT Portfolio Page Options
	$portfolio_page_box = new Custom_Add_Meta_Box( 'megafactory_portfolio_page_metabox', esc_html__( 'Megafactory Page Options', 'megafactory-core' ), $page_fields, 'mf-portfolio', true );

} // In theme option CPT option if portfolio exists

// Testimonial Options
if( isset( $megafactory_option['cpt-opts'] ) && is_array( $megafactory_option['cpt-opts'] ) && in_array( "testimonial", $megafactory_option['cpt-opts'] ) ){
	
	$prefix = 'megafactory_testimonial_';
	$testimonial_fields = array(	
		array( 
			'label'	=> esc_html__( 'Author Designation', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter author designation.', 'megafactory-core' ), 
			'id'	=> $prefix.'designation',
			'tab'	=> esc_html__( 'Testimonial', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Company Name', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter company name.', 'megafactory-core' ), 
			'id'	=> $prefix.'company_name',
			'tab'	=> esc_html__( 'Testimonial', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Company URL', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter company URL.', 'megafactory-core' ), 
			'id'	=> $prefix.'company_url',
			'tab'	=> esc_html__( 'Testimonial', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Rating', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Set user rating.', 'megafactory-core' ), 
			'id'	=> $prefix.'rating',
			'tab'	=> esc_html__( 'Testimonial', 'megafactory-core' ),
			'type'	=> 'rating',
			'default'	=> ''
		)
	);
	
	// CPT Testimonial Options
	$testimonial_box = new Custom_Add_Meta_Box( 'megafactory_testimonial_metabox', esc_html__( 'Megafactory Testimonial Options', 'megafactory-core' ), $testimonial_fields, 'mf-testimonial', true );
	
	// CPT Testimonial Page Options
	$testimonial_page_box = new Custom_Add_Meta_Box( 'megafactory_testimonial_page_metabox', esc_html__( 'Megafactory Page Options', 'megafactory-core' ), $page_fields, 'mf-testimonial', true );
	
} // In theme option CPT option if testimonial exists

// Team Options
if( isset( $megafactory_option['cpt-opts'] ) && is_array( $megafactory_option['cpt-opts'] ) && in_array( "team", $megafactory_option['cpt-opts'] ) ){
	
	$prefix = 'megafactory_team_';
	$team_fields = array(	
		array( 
			'label'	=> esc_html__( 'Member Designation', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter member designation.', 'megafactory-core' ), 
			'id'	=> $prefix.'designation',
			'tab'	=> esc_html__( 'Team', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Member Email', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter member email.', 'megafactory-core' ), 
			'id'	=> $prefix.'email',
			'tab'	=> esc_html__( 'Team', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Link Target', 'megafactory-core' ),
			'id'	=> $prefix.'link_target',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'_blank' => esc_html__( 'New Window', 'megafactory-core' ),
				'_self' => esc_html__( 'Self Window', 'megafactory-core' )
			),
			'default'	=> '_blank'
		),
		array( 
			'label'	=> esc_html__( 'Facebook', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Facebook profile link.', 'megafactory-core' ), 
			'id'	=> $prefix.'facebook',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Twitter', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Twitter profile link.', 'megafactory-core' ), 
			'id'	=> $prefix.'twitter',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Instagram', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Instagram profile link.', 'megafactory-core' ), 
			'id'	=> $prefix.'instagram',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Plus', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Google Plus profile link.', 'megafactory-core' ), 
			'id'	=> $prefix.'gplus',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Linkedin', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Linkedin profile link.', 'megafactory-core' ), 
			'id'	=> $prefix.'linkedin',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Pinterest', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Pinterest profile link.', 'megafactory-core' ), 
			'id'	=> $prefix.'pinterest',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Dribbble', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Dribbble profile link.', 'megafactory-core' ), 
			'id'	=> $prefix.'dribbble',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Flickr', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Flickr profile link.', 'megafactory-core' ), 
			'id'	=> $prefix.'flickr',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Youtube', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Youtube profile link.', 'megafactory-core' ), 
			'id'	=> $prefix.'youtube',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Vimeo', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Vimeo profile link.', 'megafactory-core' ), 
			'id'	=> $prefix.'vimeo',
			'tab'	=> esc_html__( 'Social', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		)
	);
	
	// CPT Team Options
	$team_box = new Custom_Add_Meta_Box( 'megafactory_team_metabox', esc_html__( 'Megafactory Team Options', 'megafactory-core' ), $team_fields, 'mf-team', true );
	
	// CPT Team Page Options
	$team_page_box = new Custom_Add_Meta_Box( 'megafactory_team_page_metabox', esc_html__( 'Megafactory Page Options', 'megafactory-core' ), $page_fields, 'mf-team', true );
	
} // In theme option CPT option if team exists

// Event Options
if( isset( $megafactory_option['cpt-opts'] ) && is_array( $megafactory_option['cpt-opts'] ) && in_array( "event", $megafactory_option['cpt-opts'] ) ){
	
	$prefix = 'megafactory_event_';
	$event_fields = array(	
		array( 
			'label'	=> esc_html__( 'Event Organiser Name', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter event organiser name.', 'megafactory-core' ), 
			'id'	=> $prefix.'organiser_name',
			'tab'	=> esc_html__( 'Events', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Event Organiser Designation', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter event organiser designation.', 'megafactory-core' ), 
			'id'	=> $prefix.'organiser_designation',
			'tab'	=> esc_html__( 'Events', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Event Start Date', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter event start date.', 'megafactory-core' ), 
			'id'	=> $prefix.'start_date',
			'tab'	=> esc_html__( 'Events', 'megafactory-core' ),
			'type'	=> 'date',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Event End Date', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter event end date.', 'megafactory-core' ), 
			'id'	=> $prefix.'end_date',
			'tab'	=> esc_html__( 'Events', 'megafactory-core' ),
			'type'	=> 'date',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Date Format', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter date format to show selcted event date. Example: F j, Y', 'megafactory-core' ), 
			'id'	=> $prefix.'date_format',
			'tab'	=> esc_html__( 'Events', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> 'F j, Y'
		),
		array( 
			'label'	=> esc_html__( 'Event Start Time', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter event start time.', 'megafactory-core' ), 
			'id'	=> $prefix.'time',
			'tab'	=> esc_html__( 'Events', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Event Cost', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter event cost.', 'megafactory-core' ), 
			'id'	=> $prefix.'cost',
			'tab'	=> esc_html__( 'Events', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Custom Link for Event Item', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter custom link to redirect custom event page.', 'megafactory-core' ), 
			'id'	=> $prefix.'link',
			'tab'	=> esc_html__( 'Events', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Custom Link Target', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Choose custom link target to new window or self window.', 'megafactory-core' ), 
			'id'	=> $prefix.'link_target',
			'tab'	=> esc_html__( 'Events', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'_blank' => esc_html__( 'New Window', 'megafactory-core' ),
				'_self' => esc_html__( 'Self Window', 'megafactory-core' )
			),
			'default'	=> '_blank'
		),
		array( 
			'label'	=> esc_html__( 'Custom Link Button Text', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter custom link buttom text: Example More About Event.', 'megafactory-core' ), 
			'id'	=> $prefix.'link_text',
			'tab'	=> esc_html__( 'Events', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Venue Name', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter event venue name.', 'megafactory-core' ), 
			'id'	=> $prefix.'venue_name',
			'tab'	=> esc_html__( 'Address', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Venue Address', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter event venue address.', 'megafactory-core' ), 
			'id'	=> $prefix.'venue_address',
			'tab'	=> esc_html__( 'Address', 'megafactory-core' ),
			'type'	=> 'textarea',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'E-mail', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter email id for clarification about event.', 'megafactory-core' ), 
			'id'	=> $prefix.'email',
			'tab'	=> esc_html__( 'Address', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Phone', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter phone number for contact about event.', 'megafactory-core' ), 
			'id'	=> $prefix.'phone',
			'tab'	=> esc_html__( 'Address', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Website', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter event website.', 'megafactory-core' ), 
			'id'	=> $prefix.'website',
			'tab'	=> esc_html__( 'Address', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Latitude', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter map latitude.', 'megafactory-core' ), 
			'id'	=> $prefix.'gmap_latitude',
			'tab'	=> esc_html__( 'GMap', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Longitude', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter map longitude.', 'megafactory-core' ), 
			'id'	=> $prefix.'gmap_longitude',
			'tab'	=> esc_html__( 'GMap', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Map Marker URL', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter google map custom marker url.', 'megafactory-core' ), 
			'id'	=> $prefix.'gmap_marker',
			'tab'	=> esc_html__( 'GMap', 'megafactory-core' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Map Style', 'megafactory-core' ),
			'id'	=> $prefix.'gmap_style',
			'tab'	=> esc_html__( 'GMap', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'standard' => esc_html__( 'Standard', 'megafactory-core' ),
				'silver' => esc_html__( 'Silver', 'megafactory-core' ),
				'retro' => esc_html__( 'Retro', 'megafactory-core' ),
				'dark' => esc_html__( 'Dark', 'megafactory-core' ),
				'night' => esc_html__( 'Night', 'megafactory-core' ),
				'aubergine' => esc_html__( 'Aubergine', 'megafactory-core' )
			),
			'default'	=> 'standard'
		),
		array( 
			'label'	=> esc_html__( 'Google Map Height', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter map height in values. Example 400', 'megafactory-core' ), 
			'id'	=> $prefix.'gmap_height',
			'tab'	=> esc_html__( 'GMap', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> '400'
		),
		array( 
			'label'	=> esc_html__( 'Contact Form', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Contact form shortcode here.', 'megafactory-core' ), 
			'id'	=> $prefix.'contact_form',
			'tab'	=> esc_html__( 'Contact', 'megafactory-core' ),
			'type'	=> 'textarea',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Event Info Columns', 'megafactory-core' ),
			'desc'	=> esc_html__( 'Enter column division values like given format. Example 3-3-6', 'megafactory-core' ), 
			'id'	=> $prefix.'col_layout',
			'tab'	=> esc_html__( 'Layout', 'megafactory-core' ),
			'type'	=> 'text',
			'default'	=> '3-3-6'
		),
		array( 
			'label'	=> esc_html__( 'Event Detail Items', 'megafactory-core' ),
			'desc'	=> esc_html__( 'This is layout settings for event.', 'megafactory-core' ), 
			'tab'	=> esc_html__( 'Layout', 'megafactory-core' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'event_info_items',
			'dd_fields' => array ( 
				'Enable'  => array(
					'event-details' => esc_html__( 'Event Details', 'megafactory-core' ),
					'event-venue' => esc_html__( 'Event Venue', 'megafactory-core' ),
					'event-map' => esc_html__( 'Event Map', 'megafactory-core' )
				),
				'disabled' => array(
					'event-form'	=> esc_html__( 'Event Form', 'megafactory-core' ),
				)
			),
		),
		array( 
			'label'	=> esc_html__( 'Navigation', 'megafactory-core' ),
			'id'	=> $prefix.'nav_position',
			'tab'	=> esc_html__( 'Layout', 'megafactory-core' ),
			'type'	=> 'select',
			'options' => array ( 
				'top' => esc_html__( 'Top', 'megafactory-core' ),
				'bottom' => esc_html__( 'Bottom', 'megafactory-core' )
			),
			'default'	=> 'top'
		),
	);
	
	// CPT Events Options
	$event_box = new Custom_Add_Meta_Box( 'megafactory_event_metabox', esc_html__( 'Megafactory Event Options', 'megafactory-core' ), $event_fields, 'mf-event', true );
	
	// CPT Events Page Options
	$event_page_box = new Custom_Add_Meta_Box( 'megafactory_event_page_metabox', esc_html__( 'Megafactory Page Options', 'megafactory-core' ), $page_fields, 'mf-event', true );
	
} // In theme option CPT option if event exists

// Service Options
if( isset( $megafactory_option['cpt-opts'] ) && is_array( $megafactory_option['cpt-opts'] ) && in_array( "service", $megafactory_option['cpt-opts'] ) ){
	
	$prefix = 'megafactory_service_';
	
	// CPT Events Page Options
	$service_page_box = new Custom_Add_Meta_Box( 'megafactory_service_page_metabox', esc_html__( 'Megafactory Page Options', 'megafactory-core' ), $page_fields, 'mf-service', true );
	
}