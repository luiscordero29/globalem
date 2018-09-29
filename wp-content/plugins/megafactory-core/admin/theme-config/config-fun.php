<?php
/* Megafactory Config Repeated Code Class */

class MegafactoryConfigFun {

	private $megafactory_options;
   
    function __construct() {
		$this->megafactory_options = get_option( 'megafactory_options' );
    }
	
	function megafactoryGetAdminThemeOpt( $field ){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options[$field] ) && $megafactory_options[$field] != '' ? $megafactory_options[$field] : '';
	}
	
	function themeCategories(){
		$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );
		$category_array = array();
		foreach ( $categories as $category ) {
			$category_array['category-'.$category->term_id] = $category->name;
		}
		return $category_array;
	}
	
	function themeMarginFields( $field ){
		
		$dimesin_array = array(
			'id'             => $field.'-margin',
			'type'           => 'spacing',
			'mode'           => 'margin',
			'units'          => array('px'),
			'units_extended' => 'false',
			'title'          => esc_html__('Margin Option', 'megafactory-core'),
			'subtitle'       => esc_html__('Set margin top/right/bottom/left.', 'megafactory-core'),
			'default'            => array(
				'margin-top'     => '', 
				'margin-right'   => '', 
				'margin-bottom'  => '', 
				'margin-left'    => '',
			)
		);
		
		return $dimesin_array;
		
	}
	
	function themeAdsList( $field, $template_name, $position = '' ){
		$ads_list = array(
			'id'       => $field.'-ads-list',
			'type'     => 'select',
			'title'    => sprintf( esc_html__( 'Ads List %1$s', 'megafactory-core' ), $position ),
			'desc'     => sprintf( esc_html__( 'Choose ads list to show in %1$s.', 'megafactory-core' ), $template_name ),
			'options'  => array(
				'header' => esc_html__( 'Header Ads', 'megafactory-core' ),
				'footer' => esc_html__( 'Footer Ads', 'megafactory-core' ),
				'sidebar' => esc_html__( 'Sidebar Ads', 'megafactory-core' ),
				'artical-top' => esc_html__( 'Artical Top Ads', 'megafactory-core' ),
				'artical-inline' => esc_html__( 'Artical Inline Ads', 'megafactory-core' ),
				'artical-bottom' => esc_html__( 'Artical Bottom Ads', 'megafactory-core' ),
				'custom1' => esc_html__( 'Custom 1 Ads', 'megafactory-core' ),
				'custom2' => esc_html__( 'Custom 2 Ads', 'megafactory-core' ),
				'custom3' => esc_html__( 'Custom 3 Ads', 'megafactory-core' ),
				'custom4' => esc_html__( 'Custom 4 Ads', 'megafactory-core' ),
				'custom5' => esc_html__( 'Custom 5 Ads', 'megafactory-core' ),
			),
			'default'  => ''
		);
		return $ads_list;
	}
	
	function themeAdsFields( $field ){
		
		$ads = array(
				array(
					'id'       => $field.'-ads-text',
					'type'     => 'textarea',
					'title'    => esc_html__( 'Adsense Code', 'megafactory-core' ),
					'subtitle'     => esc_html__( 'Place your Google adsense code here or enter custom ad link code', 'megafactory-core' ),
					'default'  => ''
				),
				array(
					'id'       => $field.'-ads-md',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Enable on Desktop', 'megafactory-core' ),
					'subtitle'     => esc_html__( 'choose yes to enable ads on desktop view.', 'megafactory-core' ),
					'options' => array(
						'yes' => esc_html__( 'Yes', 'megafactory-core' ),
						'no'  => esc_html__( 'No', 'megafactory-core' ),
					),
					'default'  => 'yes'
				),
				array(
					'id'       => $field.'-ads-sm',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Enable on Tablet', 'megafactory-core' ),
					'subtitle'     => esc_html__( 'choose yes to enable ads on tablet view.', 'megafactory-core' ),
					'options' => array(
						'yes' => esc_html__( 'Yes', 'megafactory-core' ),
						'no'  => esc_html__( 'No', 'megafactory-core' ),
					),
					'default'  => 'yes'
				),
				array(
					'id'       => $field.'-ads-xs',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Enable on Mobile', 'megafactory-core' ),
					'subtitle'     => esc_html__( 'choose yes to enable ads on mobile view.', 'megafactory-core' ),
					'options' => array(
						'yes' => esc_html__( 'Yes', 'megafactory-core' ),
						'no'  => esc_html__( 'No', 'megafactory-core' ),
					),
					'default'  => 'yes'
				),
			);
		return $ads;
	}
	
	function themeSkinSettings($field, $extras = array()){
	
		$line_height = isset( $extras['line_height'] ) ? $extras['line_height'] : false;
		
		$theme_skin_set = array(
			array(
                'id'       => $field.'-typography',
                'type'     => 'typography',
                'title'    => __( 'Typography', 'megafactory-core' ),
                'subtitle' => __( 'Specify the font properties.', 'megafactory-core' ),
                'google'   => true,
				'letter-spacing'=> true,
				'line-height'=> $line_height,
                'default'  => array(
                    'color'       => '',
                    'font-size'   => '',
                    'font-family' => '',
                    'font-weight' => '',
                ),
            ),
			array(
                'id'       => $field.'-background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Choose background color.', 'megafactory-core' ),
                'default'  => array(
                    'color' => '',
                    'alpha' => ''
                ),
                'mode'     => 'background',
            ),
			array(
                'id'       => $field.'-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Links Color', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Choose link color options.', 'megafactory-core' ),
                'default'  => array(
                    'regular' => '',
                    'hover'   => '',
                    'active'  => '',
                )
            ),
			array(
                'id'       => $field.'-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Border', 'megafactory-core' ),
                'subtitle' => esc_html__( 'Set border option.', 'megafactory-core' ),
				'all'      => false,
                'default'  => array(
                    'border-color'  => '',
                    'border-style'  => 'none',
                    'border-top'    => '',
                    'border-right'  => '',
                    'border-bottom' => '',
                    'border-left'   => ''
                )
            ),
			array(
				'id'             => $field.'-padding',
				'type'           => 'spacing',
				'mode'           => 'padding',
				'units'          => array('px'),
				'units_extended' => 'false',
				'title'          => __('Padding Option', 'megafactory-core'),
				'subtitle'       => __('Set padding for this bar.', 'megafactory-core'),
				'default'            => array(
					'pading-top'     => '', 
					'pading-right'   => '', 
					'pading-bottom'  => '', 
					'pading-left'    => '',
				)
			),
			array(
                'id'       => $field.'-background-all',
                'type'     => 'background',
                'title'    => esc_html__( 'Background Settings', 'megafactory-core' ),
                'subtitle' => esc_html__( 'This is settings for background.', 'megafactory-core' ),
                'default'   => '',
            ),
			array(
				'id'             => $field.'-margin',
				'type'           => 'spacing',
				'mode'           => 'margin',
				'units'          => array('px'),
				'units_extended' => 'false',
				'title'          => __('Margin Option', 'megafactory-core'),
				'subtitle'       => __('Set margin for this bar.', 'megafactory-core'),
				'default'            => array(
					'margin-top'     => '', 
					'margin-right'   => '', 
					'margin-bottom'  => '', 
					'margin-left'    => '',
				)
			),
		);
		return $theme_skin_set;
	}
	
	function themeSidebarsList( $field, $extras ){
	
		$default = isset( $extras['default'] ) ? $extras['default'] : '';
		$title = isset( $extras['title'] ) ? $extras['title'] : '';
	
		$sidebars_array = array(
			array(
                'id'       => $field.'-layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layouts', 'megafactory-core' ),
                'desc'     => esc_html__( 'Choose your layouts.', 'megafactory-core' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '3-3-3-3' => array(
                        'alt' => esc_html__( 'Layout 1', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/footer-layouts/footer-1.png'
                    ),
                    '4-4-4' => array(
                        'alt' => esc_html__( 'Layout 2', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/footer-layouts/footer-2.png'
                    ),
                    '3-6-3' => array(
                        'alt' => esc_html__( 'Layout 3', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/footer-layouts/footer-3.png'
                    ),
					'6-6' => array(
                        'alt' => esc_html__( 'Layout 4', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/footer-layouts/footer-4.png'
                    ),
					'9-3' => array(
                        'alt' => esc_html__( 'Layout 5', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/footer-layouts/footer-5.png'
                    ),
					'3-9' => array(
                        'alt' => esc_html__( 'Layout 6', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/footer-layouts/footer-6.png'
                    ),
					'12' => array(
                        'alt' => esc_html__( 'Layout 7', 'megafactory-core' ),
                        'img' => ReduxFramework::$_url . 'assets/img/footer-layouts/footer-7.png'
                    ),
                ),
                'default'  => '3-3-3-3'
            ),
			array(
                'id'       => $field.'-sidebar-1',
                'type'     => 'select',
                'title'    => esc_html__( 'Choose First Column', 'megafactory-core' ),
                'desc'     => esc_html__( 'Select widget area for showing first column.', 'megafactory-core' ),
                'data'     => 'sidebars'
            ),
			array(
                'id'       => $field.'-sidebar-2',
                'type'     => 'select',
                'title'    => esc_html__( 'Choose Second Column', 'megafactory-core' ),
                'desc'     => esc_html__( 'Select widget area for showing second column.', 'megafactory-core' ),
                'data'     => 'sidebars',
            ),
			array(
                'id'       => $field.'-sidebar-3',
                'type'     => 'select',
                'title'    => esc_html__( 'Choose Third Column', 'megafactory-core' ),
                'desc'     => esc_html__( 'Select widget area for showing third column.', 'megafactory-core' ),
                'data'     => 'sidebars',
            ),
			array(
                'id'       => $field.'-sidebar-4',
                'type'     => 'select',
                'title'    => esc_html__( 'Choose Fourth Column', 'megafactory-core' ),
                'desc'     => esc_html__( 'Select widget area for showing fourth column.', 'megafactory-core' ),
                'data'     => 'sidebars',
            )
		);
		
		return $sidebars_array;
	}
	
	function themeFontColor( $field ){
		$color_array = array(
			array(
				'id'      => $field.'-color',
				'type'    => 'color',
				'title'   => esc_html__( 'Font Color', 'megafactory-core' ),
				'desc'    => esc_html__( 'This is font color for current field.', 'megafactory-core' ),
				'validate' => 'color',
			)
		);
		return $color_array;
	}
	
	function themePageTitleItems( $field ){
		$page_title_array = '';
		if( $field == 'template-blog' ){
			$page_title_array = array(
				array(
					'id'      => $field.'-pagetitle-items',
					'type'    => 'sorter',
					'title'   => esc_html__( 'Page Title Items', 'megafactory-core' ),
					'desc'    => esc_html__( 'Needed page title items drag from disabled and put enabled.', 'megafactory-core' ),
					'options' => array(
						'disabled' => array(
							'description' => esc_html__( 'Page Title Description', 'megafactory-core' )
						),
						'Left'  => array(
							'title' => esc_html__( 'Page Title Text', 'megafactory-core' ),
						),
						'Center'  => array(
							
						),
						'Right'  => array(
							'breadcrumb'	=> esc_html__( 'Breadcrumb', 'megafactory-core' )
						)
					),
				)
			);
		}elseif( $field == 'template-author' ){
			$page_title_array = array(
				array(
					'id'      => $field.'-pagetitle-items',
					'type'    => 'sorter',
					'title'   => esc_html__( 'Page Title Items', 'megafactory-core' ),
					'desc'    => esc_html__( 'Needed page title items drag from disabled and put enabled.', 'megafactory-core' ),
					'options' => array(
						'disabled' => array(

						),
						'Left'  => array(
							'author-info' => esc_html__( 'Author Info', 'megafactory-core' ),
						),
						'Center' => array(

						),
						'Right'  => array(
							'breadcrumb'	=> esc_html__( 'Breadcrumb', 'megafactory-core' )
						)						
					),
				)
			);
		}elseif( strpos( $field, 'category' ) ){
			$page_title_array = array(
				array(
					'id'      => $field.'-pagetitle-items',
					'type'    => 'sorter',
					'title'   => esc_html__( 'Category Page Title Items', 'megafactory-core' ),
					'desc'    => esc_html__( 'Needed page title items drag from disabled and put enabled.', 'megafactory-core' ),
					'options' => array(
						'disabled' => array(
							'description' => esc_html__( 'Category Description', 'megafactory-core' )
						),
						'Left'  => array(
							'title' => esc_html__( 'Category Title', 'megafactory-core' ),
						),
						'Center'  => array(
							
						),
						'Right'  => array(
							'breadcrumb'	=> esc_html__( 'Breadcrumb', 'megafactory-core' )
						)
					),
				)
			);
		}else{
			$page_title_array = array(
				array(
					'id'      => $field.'-pagetitle-items',
					'type'    => 'sorter',
					'title'   => esc_html__( 'Page Title Items', 'megafactory-core' ),
					'desc'    => esc_html__( 'Needed page title items drag from disabled and put enabled.', 'megafactory-core' ),
					'options' => array(
						'disabled' => array(

						),
						'Left'  => array(
							'title' => esc_html__( 'Page Title Text', 'megafactory-core' ),
						),
						'Center' => array(

						),
						'Right'  => array(
							'breadcrumb'	=> esc_html__( 'Breadcrumb', 'megafactory-core' )
						)						
					),
				)
			);
		}
		return $page_title_array;
	}
	
	function themeSliders( $slide ){
	
		$items = $margin = array();
		
		if( $slide == 'blog' ){
			$items = array(
				'id'       => $slide.'-slide-items',
				'type'     => 'text',
				'title'    => esc_html__( 'Items to Display', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter slider items to display', 'megafactory-core' ),
				'default'  => '1'
			);
		}else{
			$items = array(
				'id'       => $slide.'-slide-items',
				'type'     => 'text',
				'title'    => esc_html__( 'Items to Display', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter slider items to display', 'megafactory-core' ),
				'default'  => '3'
			);
		}
		
		if( $slide == 'related' ){
			$margin = array(
				'id'       => $slide.'-slide-margin',
				'type'     => 'text',
				'title'    => esc_html__( 'Margin', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter margin( item spacing )', 'megafactory-core' ),
				'default'  => '10'
			);
		}else{
			$margin = array(
				'id'       => $slide.'-slide-margin',
				'type'     => 'text',
				'title'    => esc_html__( 'Margin', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter margin( item spacing )', 'megafactory-core' ),
				'default'  => '0'
			);
		}
	
		$slider_array = array(
			$items,
			array(
				'id'       => $slide.'-slide-tab',
				'type'     => 'text',
				'title'    => esc_html__( 'Items to Display Tab', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter items to display tablet', 'megafactory-core' ),
				'default'  => '1'
			),
			array(
				'id'       => $slide.'-slide-mobile',
				'type'     => 'text',
				'title'    => esc_html__( 'Items to Display on Mobile', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter items to display on mobile view', 'megafactory-core' ),
				'default'  => '1'
			),
			array(
				'id'       => $slide.'-slide-scrollby',
				'type'     => 'text',
				'title'    => esc_html__( 'Items Scrollby', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter slider items scrollby', 'megafactory-core' ),
				'default'  => '1'
			),
			array(
				'id'       => $slide.'-slide-autoplay',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Slide Autoplay', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable slide autoplay', 'megafactory-core' ),
				'options' => array(
					'true' => esc_html__( 'Yes', 'megafactory-core' ),
					'false'  => esc_html__( 'No', 'megafactory-core' ),
				),
				'default'  => 'true'
			),
			array(
				'id'       => $slide.'-slide-center',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Slide Center', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable slide center', 'megafactory-core' ),
				'options' => array(
					'true' => esc_html__( 'Yes', 'megafactory-core' ),
					'false'  => esc_html__( 'No', 'megafactory-core' ),
				),
				'default'  => 'false'
			),
			array(
				'id'       => $slide.'-slide-duration',
				'type'     => 'text',
				'title'    => esc_html__( 'Slide Duration', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter slide duration for each (in Milli Seconds)', 'megafactory-core' ),
				'default'  => '5000'
			),
			array(
				'id'       => $slide.'-slide-smartspeed',
				'type'     => 'text',
				'title'    => esc_html__( 'Slide Smart Speed', 'megafactory-core' ),
				'desc'     => esc_html__( 'Enter slide smart speed for each (in Milli Seconds)', 'megafactory-core' ),
				'default'  => '250'
			),
			array(
				'id'       => $slide.'-slide-infinite',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Infinite Loop', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable infinite loop', 'megafactory-core' ),
				'options' => array(
					'true' => esc_html__( 'Yes', 'megafactory-core' ),
					'false'  => esc_html__( 'No', 'megafactory-core' ),
				),
				'default'  => 'false'
			),
			$margin,
			array(
				'id'       => $slide.'-slide-pagination',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Pagination', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable pagination', 'megafactory-core' ),
				'options' => array(
					'true' => esc_html__( 'Yes', 'megafactory-core' ),
					'false'  => esc_html__( 'No', 'megafactory-core' ),
				),
				'default'  => 'false'
			),
			array(
				'id'       => $slide.'-slide-navigation',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Navigation', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable navigation', 'megafactory-core' ),
				'options' => array(
					'true' => esc_html__( 'Yes', 'megafactory-core' ),
					'false'  => esc_html__( 'No', 'megafactory-core' ),
				),
				'default'  => 'false'
			),
			array(
				'id'       => $slide.'-slide-autoheight',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Auto Height', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable slide item auto height', 'megafactory-core' ),
				'options' => array(
					'true' => esc_html__( 'Yes', 'megafactory-core' ),
					'false'  => esc_html__( 'No', 'megafactory-core' ),
				),
				'default'  => 'false'
			)
		);
		
		return $slider_array;
	}
	
	function megafactoryThemeOptTemplate( $template, $template_cname, $template_sname ){

		$template_t = $this->themeSkinSettings('template-'.$template);
		$template_article = $this->themeSkinSettings($template.'-article');
		$page_title_items = $this->themePageTitleItems('template-'.$template);
		$color = $this->themeFontColor('template-'.$template);
		$template_article_color = $this->themeFontColor($template.'-article');
		
		$page_tit = $page_tit_desc = '';
		if( $template == 'blog' ){
			$page_tit = array(
				'id'       => $template.'-page-title',
				'type'     => 'text',
				'title'    => sprintf( esc_html__( '%1$s Page Title', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'This is a title for %1$s page. HTML code allowed here.', 'megafactory-core' ), $template_sname ),
				'default'  => esc_html__( 'Multiuse Theme', 'megafactory-core' )
			);
			$page_tit_desc = array(
				'id'		=> $template.'-page-desc',
				'type'		=> 'textarea',
				'title'		=> sprintf( esc_html__( '%1$s Page Description', 'megafactory-core' ), $template_cname ),
				'subtitle'	=> sprintf( esc_html__( 'This is description for %1$s page. HTML code allowed here.', 'megafactory-core' ), $template_sname ),
				'default'	=> '',
			);
		}
		
		$template_array = array(
			array(
				'id'       => $template.'-page-title-opt',
				'type'     => 'switch',
				'title'    => sprintf( esc_html__( '%1$s Page Title', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable %1$s page title.', 'megafactory-core' ), $template_sname ),
				'default'  => 1,
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
			$page_tit,
			$page_tit_desc,
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
				'id'       => $template.'-article-style-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Article Style', 'megafactory-core' ),
				'subtitle' => sprintf( esc_html__( 'This is layout style settings for each %1$s article', 'megafactory-core' ), $template_sname ),
				'indent'   => true
			),
			array(
				'id'       => $template.'-article-style',
				'type'     => 'select',
				'title'    => esc_html__( 'Choose Article Style', 'megafactory-core' ),
				'desc'     => sprintf( esc_html__( 'Choose %1$s article style.', 'megafactory-core' ), $template_sname ),
				'options'  => array(
					'default' => esc_html__( 'Default', 'megafactory-core' ),
					'1' => esc_html__( 'Style 1', 'megafactory-core' ),
					'2' => esc_html__( 'Style 2', 'megafactory-core' ),
					'3' => esc_html__( 'Style 3', 'megafactory-core' )
				),
				'default'  => 'default'
			),
			array(
				'id'     => $template.'-article-style-end',
				'type'   => 'section',
				'indent' => false, 
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
				'id'       => $template.'-post-template',
				'type'     => 'image_select',
				'title'    => sprintf( esc_html__( '%1$s Post Template', 'megafactory-core' ), $template_cname ),
				'desc'     => sprintf( esc_html__( 'Choose your current %1$s post template.', 'megafactory-core' ), $template_sname ),
				'options'  => array(
					'standard' => array(
						'alt' => esc_html__( 'Standard', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/post-layouts/1.png'
					),
					'grid' => array(
						'alt' => esc_html__( 'Grid', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/post-layouts/2.png'
					),
					'list' => array(
						'alt' => esc_html__( 'List', 'megafactory-core' ),
						'img' => get_template_directory_uri() . '/assets/images/post-layouts/3.png'
					)
				),
				'default'  => 'standard'
			),
			array(
				'id'       => $template.'-top-standard-post',
				'type'     => 'switch',
				'title'    => esc_html__( 'Top Standard Post', 'megafactory-core' ),
				'subtitle' => esc_html__( 'Enable/Disable to show top post layout standard others selected layout.', 'megafactory-core' ),
				'default'  => 0,
				'on'       => esc_html__( 'Enable', 'megafactory-core' ),
				'off'      => esc_html__( 'Disable', 'megafactory-core' ),
				'required' => array($template.'-post-template', '!=', 'standard')
			),
			array(
				'id'       => $template.'-grid-cols',
				'type'     => 'select',
				'title'    => esc_html__( 'Grid Columns', 'megafactory-core' ),
				'desc'     => esc_html__( 'Select grid columns.', 'megafactory-core' ),
				'options'  => array(
					'4'		=> esc_html__( '4 Columns', 'megafactory-core' ),
					'3'		=> esc_html__( '3 Columns', 'megafactory-core' ),
					'2'		=> esc_html__( '2 Columns', 'megafactory-core' ),
				),
				'default'  => '2',
				'required' 		=> array($template.'-post-template', '=', 'grid')
			),
			array(
				'id'       => $template.'-grid-gutter',
				'type'     => 'text',
				'title'    => sprintf( esc_html__( '%1$s Grid Gutter', 'megafactory-core' ), $template_cname ),
				'subtitle' => esc_html__( 'Enter grid gutter size. Example 20.', 'megafactory-core' ),
				'default'  => esc_html__( '20', 'megafactory-core' ),
				'required' 		=> array($template.'-post-template', '=', 'grid')
			),
			array(
				'id'       => $template.'-grid-type',
				'type'     => 'select',
				'title'    => esc_html__( 'Grid Type', 'megafactory-core' ),
				'desc'     => esc_html__( 'Select grid type normal or isotope.', 'megafactory-core' ),
				'options'  => array(
					'normal'		=> esc_html__( 'Normal Grid', 'megafactory-core' ),
					'isotope'		=> esc_html__( 'Isotope Grid', 'megafactory-core' ),
				),
				'default'  => 'isotope',
				'required' 		=> array($template.'-post-template', '=', 'grid')
			),
			array(
				'id'       => $template.'-infinite-scroll',
				'type'     => 'switch',
				'title'    => esc_html__( 'Infinite Scroll', 'megafactory-core' ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable infinite scroll for %1$s post.', 'megafactory-core' ), $template_sname ),
				'default'  => 0,
				'on'       => esc_html__( 'On', 'megafactory-core' ),
				'off'      => esc_html__( 'Off', 'megafactory-core' ),
				'required' => array($template.'-grid-type', '=', 'isotope')
			),
			array(
				'id'       => $template.'-more-text',
				'type'     => 'text',
				'title'    => sprintf( esc_html__( '%1$s Page Read More Text', 'megafactory-core' ), $template_cname ),
				'default'  => esc_html__( 'Read More', 'megafactory-core' )
			),
			array(
				'id'       => $template.'-excerpt',
				'type'     => 'text',
				'title'    => sprintf( esc_html__( '%1$s Excerpt Length', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'This is excerpt length for %1$s layout.', 'megafactory-core' ), $template_sname ),
				'default'  => esc_html__( '30', 'megafactory-core' )
			),
			array(
				'id'      => $template.'-topmeta-items',
				'type'    => 'sorter',
				'title'   => sprintf( esc_html__( '%1$s Post Top Meta Items', 'megafactory-core' ), $template_cname ),
				'desc'    => sprintf( esc_html__( 'Needed %1$s post top meta items drag from disabled and put enabled part. ie: Left or Right.', 'megafactory-core' ), $template_sname ),
				'options' => array(
					'Left'  => array(
						'date'	=> esc_html__( 'Date', 'megafactory-core' )
					),
					'Right'  => array(
						'category'	=> esc_html__( 'Category', 'megafactory-core' )
					),
					'disabled' => array(
						'social'	=> esc_html__( 'Social Share', 'megafactory-core' ),
						'comments'	=> esc_html__( 'Comments', 'megafactory-core' ),
						'likes'	=> esc_html__( 'Likes', 'megafactory-core' ),
						'author'	=> esc_html__( 'Author', 'megafactory-core' ),
						'views'	=> esc_html__( 'Views', 'megafactory-core' ),
						'more'	=> esc_html__( 'Read More', 'megafactory-core' ),
						'favourite'	=> esc_html__( 'Favourite', 'megafactory-core' )
					)
				),
			),
			array(
				'id'      => $template.'-bottommeta-items',
				'type'    => 'sorter',
				'title'   => sprintf( esc_html__( '%1$s Post Bottom Meta Items', 'megafactory-core' ), $template_cname ),
				'desc'    => sprintf( esc_html__( 'Needed %1$s post bottom meta items drag from disabled and put enabled part. ie: Left or Right.', 'megafactory-core' ), $template_sname ),
				'options' => array(
					'Left'  => array(
						'more'	=> esc_html__( 'Read More', 'megafactory-core' ),
					),
					'Right'  => array(
					),
					'disabled' => array(
						'comments'	=> esc_html__( 'Comments', 'megafactory-core' ),
						'category'	=> esc_html__( 'Category', 'megafactory-core' ),
						'social'	=> esc_html__( 'Social Share', 'megafactory-core' ),
						'comments'	=> esc_html__( 'Comments', 'megafactory-core' ),
						'likes'	=> esc_html__( 'Likes', 'megafactory-core' ),
						'author'	=> esc_html__( 'Author', 'megafactory-core' ),
						'views'	=> esc_html__( 'Views', 'megafactory-core' ),
						'date'	=> esc_html__( 'Date', 'megafactory-core' ),
						'favourite'	=> esc_html__( 'Favourite', 'megafactory-core' )
					)
				),
			),
			array(
				'id'      => $template.'-items',
				'type'    => 'sorter',
				'title'   => sprintf( esc_html__( '%1$s Post Items', 'megafactory-core' ), $template_cname ),
				'desc'    => sprintf( esc_html__( 'Needed %1$s post items drag from disabled and put enabled part. Thumbnail part covers the post format either image/audio/video/gallery/quote/link.', 'megafactory-core' ), $template_sname ),
				'options' => array(
					'Enabled'  => array(
						'title'	=> esc_html__( 'Title', 'megafactory-core' ),
						'top-meta'	=> esc_html__( 'Top Meta', 'megafactory-core' ),
						'thumb'	=> esc_html__( 'Thumbnail', 'megafactory-core' ),
						'content'	=> esc_html__( 'Content', 'megafactory-core' ),
						'bottom-meta'	=> esc_html__( 'Bottom Meta', 'megafactory-core' )
					),
					'disabled' => array(
						
					)
				),
			),
			array(
				'id'       => $template.'-overlay-opt',
				'type'     => 'switch',
				'title'    => sprintf( esc_html__( '%1$s Post Overlay', 'megafactory-core' ), $template_cname ),
				'subtitle' => sprintf( esc_html__( 'Enable/Disable %1$s post overlay.', 'megafactory-core' ), $template_sname ),
				'default'  => 0,
				'on'       => esc_html__( 'Enabled', 'megafactory-core' ),
				'off'      => esc_html__( 'Disabled', 'megafactory-core' ),
			),
			array(
				'id'      => $template.'-overlay-items',
				'type'    => 'sorter',
				'title'   => sprintf( esc_html__( '%1$s Post Overlay Items', 'megafactory-core' ), $template_cname ),
				'desc'    => sprintf( esc_html__( 'Needed %1$s post overlay items drag from disabled and put enabled part.', 'megafactory-core' ), $template_sname ),
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
				'id'     => $template.'-settings-end',
				'type'   => 'section',
				'indent' => false, 
			),
		);
		
		return $template_array;
	}
	
	function megafactoryThemeOptCPT( $field_name, $field_sname, $default ){
		$cpt_array = array(
			array(
				'id'       => 'cpt-'. esc_attr( $field_sname ) .'-slug',
				'type'     => 'text',
				'title'    => sprintf( esc_html__( '%1$s Slug', 'megafactory-core' ), $field_name ),
				'desc'     => sprintf( esc_html__( 'Enter %1$s slug for register custom post type.', 'megafactory-core' ), $field_sname ),
				'default'  => $default['slug']
			),
			array(
				'id'       => 'cpt-'. esc_attr( $field_sname ) .'-category-slug',
				'type'     => 'text',
				'title'    => sprintf( esc_html__( '%1$s Category Slug', 'megafactory-core' ), $field_name ),
				'desc'     => sprintf( esc_html__( 'Enter category slug for %1$s custom post type.', 'megafactory-core' ), $field_sname ),
				'default'  => $default['cat_slug']
			),
			array(
				'id'       => 'cpt-'. esc_attr( $field_sname ) .'-tag-slug',
				'type'     => 'text',
				'title'    => sprintf( esc_html__( '%1$s Tag Slug', 'megafactory-core' ), $field_name ),
				'desc'     => sprintf( esc_html__( 'Enter %1$s slug for portfolio custom post type.', 'megafactory-core' ), $field_sname ),
				'default'  => $default['tag_slug']
			)
		);
		
		return $cpt_array;
	}
	
	function megafactoryGetThemeTemplatesKey(){
		$megafactory_opt = $this->megafactory_options;
		return isset( $megafactory_opt['theme-templates'] ) ? $megafactory_opt['theme-templates'] : array();
	}
}
