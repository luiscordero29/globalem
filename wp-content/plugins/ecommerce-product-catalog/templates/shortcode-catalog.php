<?php
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Implements shortcode catalog functionality
 *
 * @version		1.1.3
 * @package		ecommerce-product-catalog/
 * @author 		impleCode
 */
class ic_shortcode_catalog {

	private $multiple_settings, $status	 = 'catalog', $title	 = '';

	function __construct() {
		add_shortcode( 'show_product_catalog', array( $this, 'catalog_shortcode' ) );

		add_action( 'init', array( $this, 'init' ) );
	}

	function init() {
		add_action( 'wp_ajax_ic_assign_listing', array( $this, 'assign_listing' ) );

		if ( !is_ic_shortcode_integration() ) {
			return;
		}
		add_action( 'ic_catalog_wp', array( $this, 'hooks' ) );

		if ( get_integration_type() !== 'advanced' ) {
//ic_catalog_theme_integration::enable_advanced_mode();
//permalink_options_update();
		}

		do_action( 'ic_shortcode_integration_init' );
	}

	function hooks() {

		if ( !is_ic_catalog_page() ) {
			return;
		}
		add_action( 'ic_catalog_template_redirect', array( $this, 'overwrite_query' ), 999 );
		add_action( 'get_header', array( $this, 'catalog_query' ), 999, 0 );

		add_filter( 'ic_catalog_body_class_start', array( $this, 'overwrite_query' ), 1 );
		add_filter( 'ic_catalog_single_body_class', array( $this, 'catalog_query' ), 99, 1 );
		add_filter( 'ic_catalog_tax_body_class', array( $this, 'catalog_query' ), 98, 1 );
		add_filter( 'ic_catalog_tax_body_class', array( $this, 'tax_body_class' ), 98, 1 );
		add_filter( 'ic_catalog_single_body_class', array( $this, 'single_body_class' ), 98, 1 );
//add_filter( 'ic_catalog_body_class', array( $this, 'catalog_query' ), 98 );

		add_filter( 'ic_catalog_pre_nav_menu', array( $this, 'remove_overwrite_filters' ), 99 );
//add_filter( 'ic_catalog_tax_nav_menu', array( $this, 'fake_tax_first_post' ), 99 );
//add_filter( 'ic_catalog_tax_nav_menu', array( $this, 'overwrite_query' ), 99 );

		add_filter( 'ic_catalog_single_nav_menu', array( $this, 'catalog_query' ), 99 );
		add_filter( 'ic_catalog_listing_nav_menu', array( $this, 'fake_listing_first_post' ), 99 );

//add_action( 'get_template_part_content', array( $this, 'overwrite_query' ), 99, 0 );
//add_action( 'get_template_part_index', array( $this, 'overwrite_query' ), 99, 0 );
//add_action( 'get_template_part_page', array( $this, 'overwrite_query' ), 99, 0 );

		add_filter( 'post_class', array( $this, 'check_post_class' ), 99 );

		add_action( 'ic_catalog_wp_head_start', array( $this, 'catalog_query' ), -1, 0 );
//add_action( 'ic_catalog_listing_wp_head', array( $this, 'overwrite_query' ), 999 );
		add_action( 'ic_catalog_search_wp_head', array( $this, 'overwrite_query' ), 999 );

		add_filter( 'single_post_title', array( $this, 'product_page_title' ), 99, 1 );

		add_action( 'loop_start', array( $this, 'loop_start' ), 10, 1 );

		add_action( 'shortcode_catalog_init', array( $this, 'catalog_query' ), 10, 0 );
		add_action( 'shortcode_catalog_init', array( $this, 'remove_overwrite_filters' ) );
		add_action( 'product_listing_begin', array( $this, 'remove_overwrite_filters' ) );

		add_action( 'admin_bar_menu', array( $this, 'catalog_query' ), -1, 0 );
		add_action( 'admin_bar_menu', array( $this, 'overwrite_query' ), 9999, 0 );

		add_action( 'wp_footer', array( $this, 'catalog_query' ), -1, 0 );
		add_action( 'wp_footer', array( $this, 'overwrite_query' ), 9999, 0 );

		add_action( 'ic_before_widget', array( $this, 'widget_switch_before' ) );
		add_action( 'ic_after_widget', array( $this, 'widget_switch_after' ) );

		add_filter( 'get_post_metadata', array( $this, 'listing_metadata' ), 10, 4 );

		$this->theme_specific();
	}

	function listing_metadata( $value, $object_id, $meta_key, $single ) {
		if ( !is_ic_admin() && is_ic_product( $object_id ) ) {
			remove_filter( 'get_post_metadata', array( $this, 'listing_metadata' ), 10, 4 );
			$listing_id		 = get_product_listing_id();
			$listing_meta	 = get_post_meta( $listing_id, $meta_key, $single );
			if ( !empty( $listing_meta ) ) {
				$this_meta = get_post_meta( $object_id, $meta_key, $single );
				if ( empty( $this_meta ) ) {
					$value = $listing_meta;
				}
			}
			add_filter( 'get_post_metadata', array( $this, 'listing_metadata' ), 10, 4 );
		}
		return $value;
	}

	function theme_specific() {
//Customizr
		add_action( '__before_content', array( $this, 'overwrite_query' ), 99, 0 );
	}

	function fix_title( $title ) {
		if ( is_ic_taxonomy_page() ) {
			if ( !empty( $this->title ) ) {
				$title = $this->title;
			}
		}
		remove_filter( 'the_title', array( $this, 'fix_title' ) );
		return $title;
	}

	function widget_switch_before() {
		if ( !is_filter_bar() && !$this->is_inside_shortcode() ) {
			$this->catalog_query();
		}
	}

	function widget_switch_after() {
		if ( !is_filter_bar() && !$this->is_inside_shortcode() ) {
			$this->overwrite_query();
		}
	}

	function loop_start( &$wp_query ) {
		add_filter( 'the_title', array( $this, 'fix_title' ) );
		remove_action( 'loop_start', array( $this, 'loop_start' ), 10, 1 );
		return $wp_query;
	}

	function shortcode_init() {
		ic_save_global( 'inside_show_catalog_shortcode', 1 );
		$this->multiple_settings = get_multiple_settings();
		if ( !is_ic_catalog_page() ) {
			return;
		}
		remove_filter( 'the_title', array( $this, 'title' ), 99, 2 );

		remove_filter( 'the_content', array( $this, 'set_content' ), 99999999 );
		remove_all_filters( 'loop_start' );
		add_action( 'before_shortcode_catalog', array( $this, 'setup_postdata' ) );
		add_action( 'before_shortcode_catalog', array( $this, 'setup_loop' ) );
		add_action( 'after_shortcode_catalog', array( $this, 'end_query' ) );
//add_action( 'the_content', array( $this, 'end_query' ) );

		add_action( 'product_page_inside', 'content_product_adder_single_content' );

		$this->catalog_query( '', true );
		do_action( 'shortcode_catalog_init' );
		if ( !is_ic_product_listing() ) {
			rewind_posts();
		}
	}

	function catalog_shortcode() {
		$this->shortcode_init();
		ob_start();
		do_action( 'before_shortcode_catalog' );
		$this->shortcode_product_adder();
		do_action( 'after_shortcode_catalog' );
		$content = ob_get_clean();
		ic_save_global( 'inside_show_catalog_shortcode', 0 );
		return $content;
	}

	function is_inside_shortcode() {
		$test = ic_get_global( 'inside_show_catalog_shortcode' );
		if ( !empty( $test ) ) {
			return true;
		}
		return false;
	}

	function advanced_integration_type() {
		return 'advanced';
	}

	function default_message() {
		if ( !current_user_can( 'manage_product_settings' ) ) {
			return;
		}
		$page_url	 = product_listing_url();
		$listing_id	 = get_product_listing_id();
		$page_id	 = get_the_ID();
		if ( $listing_id == $page_id || get_post_type() !== 'page' ) {
			return;
		}
		echo "<style>.ic_spinner{background: url(" . admin_url() . "/images/spinner.gif) no-repeat;display:none;width:20px;height:20px;margin-left:2px;vertical-align:middle;</style>";
		if ( !empty( $page_url ) ) {
			$message = '<p style="margin-bottom: 5px;font-weight: normal;">' . sprintf( __( 'Currently %sanother page%s is set to show main product listing. Would you like to show product listing here instead?', 'ecommerce-product-catalog' ), '<a href="' . $page_url . '">', '</a>' ) . '</p>';
		} else {
			$message = '<p style="margin-bottom: 5px;font-weight: normal;">' . __( 'Currently no page is set to show main product listing. Would you like to show product listing here?', 'ecommerce-product-catalog' ) . '</p>';
		}
		if ( !empty( $message ) && !empty( $page_id ) ) {
			$message .= '<p style="margin-bottom: 5px;">' . __( 'All your individual product pages will include this page slug as a parent.', 'ecommerce-product-catalog' ) . '</p>';
			$message .= '<button  style="margin-bottom: 5px;" type="button" class="button assign-listing-button ' . design_schemes( 'box', 0 ) . '">' . __( 'Yes', 'ecommerce-product-catalog' ) . '</button><div class="ic_spinner"></div>';
			//$message .= '<p style="font-size: 0.8em">* ' . sprintf( __( 'Please remove the %s shortcode to disable this info.', 'ecommerce-product-catalog' ), '[show_product_catalog]' ) . '</p>';
			$message .= '<p style="font-size: 0.8em">* ' . sprintf( __( 'Use the %s or %s shortcode if you just want to display products or categories.', 'ecommerce-product-catalog' ), '[show_products]', '[show_categories]' ) . '</p>';
			implecode_info( $message );
			echo "<script>jQuery('.assign-listing-button').click(function() {" . $this->assing_listing_script( $page_id ) . "});</script>";
		}
	}

	function assing_listing_script( $page_id ) {
		return "var data = {
        'action': 'ic_assign_listing',
		'page_id': '" . $page_id . "',
    };
	jQuery('.ic_spinner').css('display', 'inline-block');
	jQuery('.assign-listing-button').prop('disabled', true);
	jQuery.post( product_object.ajaxurl, data, function() {
		window.location.reload(false);
});";
	}

	function assign_listing() {
		if ( !empty( $_POST[ 'page_id' ] ) ) {
			$page_id = intval( $_POST[ 'page_id' ] );
			if ( !empty( $page_id ) && is_ic_shortcode_integration( $page_id ) ) {
				update_option( 'product_archive_page_id', $page_id );
				update_option( 'product_archive', $page_id );
				permalink_options_update();
			}
		}
		wp_die();
	}

	function shortcode_product_adder() {
		$query = $this->get_pre_shortcode_query();
		if ( empty( $query ) ) {
			$listing_id = intval( get_product_listing_id() );
			if ( !empty( $listing_id ) ) {
				global $wp_query;
				$id			 = 'product_listing';
				$wp_query	 = $query		 = new WP_Query( array( 'page_id' => $listing_id ) );
			}
			$this->default_message();
		}
		$listing_status = ic_get_product_listing_status();
		if ( is_archive() || is_search() || is_home_archive() || is_ic_product_listing( $query ) || is_ic_taxonomy_page( $query ) || is_ic_product_search( $query ) ) {
			if ( !is_ic_product_listing( $query ) || (is_ic_product_listing( $query ) && ($listing_status === 'publish' || current_user_can( 'edit_private_products' ))) ) {
				$id = 'product_listing';
			}
		} else {
			$id = 'product_page';
		}
		if ( empty( $id ) ) {
			return;
		}
		$class_exists = ic_get_global( 'ic_post_class_exists' );
		if ( !$class_exists ) {
			?>
			<div id="<?php echo $id ?>" <?php post_class() ?>>
				<?php
			}
			if ( $id === 'product_listing' ) {
				$this->product_listing();
			} else {
				$this->product_page();
			}

			if ( !$class_exists ) {
				?>
			</div>
			<?php
		}
	}

	function product_page() {
//add_action( 'ic_shortcode_catalog_single_content', 'content_product_adder_single_content' );

		do_action( 'before_product_page' );
		$path = $this->get_custom_product_page_path();
		if ( file_exists( $path ) ) {
			ob_start();
			include apply_filters( 'content_product_adder_path', $path );
			$product_page = ob_get_clean();
			echo do_shortcode( $product_page );
		} else {
			include apply_filters( 'content_product_adder_path', AL_BASE_TEMPLATES_PATH . '/templates/full/shortcode-product-page.php' );
		}
		do_action( 'after_product_page' );
	}

	function get_custom_product_page_path() {
		$folder = get_custom_templates_folder();
		return $folder . 'shortcode-product-page.php';
	}

	function product_listing() {

		$archive_template = get_product_listing_template();
		do_action( 'product_listing_begin', $this->multiple_settings );

		do_action( 'before_product_archive' );

		do_action( 'product_listing_entry_inside', $archive_template, $this->multiple_settings );
		do_action( 'product_listing_end', $archive_template, $this->multiple_settings );
		do_action( 'after_product_archive' );
	}

	function catalog_query( $return = null, $force = false ) {
		if ( is_ic_shortcode_integration() && ($this->status == 'page' || $force) && is_ic_catalog_page() && !is_ic_product_listing() ) {
			$this->status	 = 'catalog';
			global $wp_query, $wp_the_query, $post;
			$pre_query		 = $this->get_pre_shortcode_query();
			$pre_post		 = $this->get_pre_shortcode_post();
			if ( empty( $pre_query ) || empty( $pre_post ) ) {
				return;
			}
			$wp_query		 = $pre_query;
//			if ( !$this->ended_query() ) {
			$wp_the_query	 = $pre_query;
//			}
			if ( is_ic_product_page() ) {
				$post = $pre_post;
			}
			if ( empty( $wp_query->posts ) && is_ic_only_main_cats() ) {
				$listing_id = intval( get_product_listing_id() );
				if ( !empty( $listing_id ) ) {
					$post					 = get_post( $listing_id );
					$wp_query->posts		 = array();
					$wp_query->posts[ 0 ]	 = $post;
				}
				$wp_query->post_count = 1;
				add_action( 'shortcode_catalog_init', array( $this, 'clear_posts' ) );
			}
			do_action( 'ic_catalog_shortcode_catalog_query' );
		}
		return $return;
	}

	function fake_tax_first_post( $return = null ) {
		if ( !is_ic_shortcode_integration() || is_ic_product_listing() ) {
			return $return;
		}
		global $wp_query;
		if ( !empty( $wp_query->queried_object->name ) || is_ic_taxonomy_page( $wp_query ) ) {
//add_filter( 'the_title', array( $this, 'fake_post_title' ), 10, 2 );
//add_filter( 'the_title', array( $this, 'title' ), 99, 2 );
		}

		return $return;
	}

	function fake_listing_first_post( $return = null ) {
		if ( !is_ic_shortcode_integration() || is_ic_product_listing() ) {
			return $return;
		}
		global $wp_query;
		$listing_id = get_product_listing_id();
		if ( (!empty( $wp_query->queried_object->ID ) && $wp_query->queried_object->ID == $listing_id) || is_ic_product_listing( $wp_query ) ) {
			add_filter( 'the_title', array( $this, 'fake_post_title' ), 10, 2 );
		}

		return $return;
	}

	function fake_post_title( $title, $id = null ) {
		if ( !empty( $id ) ) {
			global $wp_query;
			$post		 = get_post();
			$listing_id	 = get_product_listing_id();
			if ( is_ic_product_listing( $wp_query ) ) {
				remove_filter( 'the_title', array( $this, 'fake_post_title' ), 10, 2 );
				$title = get_product_listing_title();
			} else if ( ($post->ID == $id && $listing_id != $id) || is_ic_taxonomy_page( $wp_query ) ) {
//remove_filter( 'the_title', array( $this, 'fake_post_title' ), 10, 2 );
				if ( !empty( $wp_query->queried_object->name ) ) {
					$title = get_product_tax_title( $wp_query->queried_object->name );
				}
			}
		}
		return $title;
	}

	function product_page_title( $title ) {
		if ( is_ic_product_page() ) {
			return get_product_name();
		} else if ( is_ic_taxonomy_page() ) {
			$this->catalog_query();
			return get_product_tax_title( $title );
		}
		return $title;
	}

	function title( $title, $id = null ) {
		$listing_id = get_product_listing_id();
		if ( !is_admin() && is_ic_catalog_page() && !is_ic_product_page() && !in_the_ic_loop() && !is_filter_bar() && (empty( $id ) || (get_quasi_post_type( get_post_type( $id ) ) == 'al_product')) || $listing_id == $id ) {
			if ( is_ic_product_page() ) {
				return get_product_name();
			} else if ( is_ic_taxonomy_page() && (empty( $id ) || !is_ic_product( $id )) ) {
				$this->catalog_query();
				return get_product_tax_title( $title );
			}
		}

		return $title;
	}

	function remove_overwrite_filters() {
		remove_filter( 'the_title', array( $this, 'fake_post_title' ), 10, 2 );
	}

	function clear_posts() {
		if ( is_ic_only_main_cats() ) {
			global $wp_query;
			if ( $wp_query->post_count == 1 ) {
				$wp_query->post_count	 = 0;
				$wp_query->posts		 = array();
			}
		}
	}

	function end_query() {
		if ( is_ic_product_listing() || !is_ic_catalog_page() ) {
			return;
		}
//add_filter( 'the_content', array( $this, 'clear' ) );
		global $wp_query, $wp_the_query, $ic_catalog_shortcode_query_ended;
		$wp_query		 = $this->main_listing_query();
		$wp_the_query	 = $wp_query;
		if ( !empty( $wp_query->post ) ) {
			global $post;
			$post = $wp_query->post;
		}
		if ( !empty( $wp_query->post_count ) ) {
			$wp_query->post_count = 0;
		}
		if ( !empty( $wp_query->found_posts ) ) {
			$wp_query->found_posts = 0;
		}
		$wp_query->posts					 = array();
		$this->status						 = 'page';
		ic_save_global( 'in_the_loop', 0 );
		remove_filter( 'the_content', array( $this, 'set_content' ), 99999999 );
		$ic_catalog_shortcode_query_ended	 = 1;
	}

	function ended_query() {
		global $ic_catalog_shortcode_query_ended;
		if ( !empty( $ic_catalog_shortcode_query_ended ) ) {
			return true;
		}
		return false;
	}

	function main_listing_query() {
		$listing_query = ic_get_global( 'ic_main_listing_query' );
		if ( $listing_query ) {
			return $listing_query;
		}
		$args			 = array( 'pagename' => $this->get_listing_slug() );
		$listing_query	 = new WP_Query( $args );
		ic_save_global( 'ic_main_listing_query', $listing_query );
		return $listing_query;
	}

	function overwrite_query( $return = null ) {
		if ( is_ic_shortcode_integration() && $this->status == 'catalog' && is_ic_catalog_page() && !is_ic_product_listing() ) {
			$this->status = 'page';
			$this->get_pre_shortcode_query();
			$this->get_pre_shortcode_post();
			$this->page_query();
			if ( isset( $return->post ) ) {
				global $wp_query;
				$return = $wp_query;
			}
		}
		return $return;
	}

	function get_pre_shortcode_query() {
		if ( is_ic_catalog_page() && is_ic_shortcode_integration() ) {
			$pre_post = ic_get_global( 'pre_shortcode_query' );
			if ( !$pre_post ) {
//var_dump( $GLOBALS[ 'wp_query' ] );

				do_action( 'shortcode_catalog_query_first_save', $GLOBALS[ 'wp_query' ] );
				ic_save_global( 'pre_shortcode_query', $GLOBALS[ 'wp_query' ] );

				return $GLOBALS[ 'wp_query' ];
			}
			return $pre_post;
		}
		return false;
	}

	function main_listing_content() {
		$listing_id = intval( get_product_listing_id() );
		if ( !empty( $listing_id ) ) {
			$post = get_post( $listing_id );
			if ( isset( $post->post_content ) ) {
				return $post->post_content;
			}
		}
		return '';
	}

	function get_pre_shortcode_post() {
		if ( is_ic_catalog_page() && is_ic_shortcode_integration() ) {
			$pre_post = ic_get_global( 'pre_shortcode_post' );
			if ( !$pre_post ) {
//var_dump( $GLOBALS[ 'post' ] );
				if ( is_ic_product_page() && isset( $GLOBALS[ 'post' ]->post_content ) ) {
					$content = $this->main_listing_content();
					if ( !empty( $content ) && has_shortcode( $content, 'show_product_catalog' ) ) {
						$GLOBALS[ 'post' ]->post_content = $content;
					}
				}
				do_action( 'shortcode_catalog_post_first_save', $GLOBALS[ 'post' ] );
				ic_save_global( 'pre_shortcode_post', $GLOBALS[ 'post' ] );
				return $GLOBALS[ 'post' ];
			}
			return $pre_post;
		}
		return false;
	}

	function page_query( $return = null ) {
		if ( !is_admin() && is_ic_catalog_page() && is_ic_shortcode_integration() ) {
			global $wp_query, $wp_the_query, $post;
			$listing_slug = $this->get_listing_slug();
			if ( !empty( $wp_query->query[ 'pagename' ] ) && $wp_query->query[ 'pagename' ] === $listing_slug ) {
				return $return;
			}

			$new_query	 = ic_get_global( 'ic_shortcode_new_query' );
			$new_post	 = ic_get_global( 'ic_shortcode_new_post' );
			if ( $new_query && $new_post ) {
				$wp_query		 = $new_query;
				$wp_the_query	 = $wp_query;
				$post			 = $new_post;
				return $return;
			}
//query_posts( $args );
			$wp_query = $this->main_listing_query();


			$listing_id				 = get_product_listing_id();
			$listing_post			 = get_post( $listing_id );
			$post					 = $listing_post;
			$wp_query->post			 = $listing_post;
			$wp_query->posts		 = array( 0 => $listing_post );
//if ( empty( $wp_query->post_count ) ) {
			$wp_query->post_count	 = 1;
//}
//if ( empty( $wp_query->found_posts ) ) {
			$wp_query->found_posts	 = 1;
//$wp_query->current_post	 = 0;
//}
			$pre_post				 = $this->get_pre_shortcode_query();
			if ( is_ic_product_search( $pre_post ) ) {
				$search_title	 = ic_get_search_page_title();
				$this->title	 = $search_title;
			} else if ( !empty( $pre_post->queried_object->labels->name ) ) {
				$this->title = $pre_post->queried_object->labels->name;
			} else if ( is_ic_product_listing( $pre_post ) ) {
				$this->title = $listing_post->post_title;
//$wp_query->post->post_title			 = $listing_post->post_title;
//$wp_query->posts[ 0 ]->post_title	 = $listing_post->post_title;
			} else if ( !empty( $pre_post->queried_object->name ) ) {
				$tax_title			 = get_product_tax_title( $pre_post->queried_object->name );
				$this->title		 = $tax_title;
				$post->post_status	 = 'publish';
			} else if ( !empty( $pre_post->post->post_title ) ) {
				$this->title		 = $pre_post->post->post_title;
				$post->post_status	 = $pre_post->post->post_status;
			}
			if ( !empty( $this->title ) ) {
				$post->post_title					 = $this->title;
				$wp_query->post->post_title			 = $this->title;
				$wp_query->posts[ 0 ]->post_title	 = $this->title;
			}
			$wp_the_query = $wp_query;
			ic_save_global( 'ic_shortcode_new_query', $wp_query );
			ic_save_global( 'ic_shortcode_new_post', $post );
			add_filter( 'the_content', array( $this, 'set_content' ), 99999999 );
		}
		return $return;
	}

	function set_content( $content ) {
		$listing_id = intval( get_product_listing_id() );
		global $wp_query;
		if ( empty( $listing_id ) || (!empty( $wp_query->queried_object->ID ) && $wp_query->queried_object->ID == $listing_id) || is_ic_product_page() ) {
			return $content;
		}
		$page	 = get_post( $listing_id );
		$readd	 = false;
		if ( has_filter( 'the_content', array( $this, 'set_content' ) ) ) {
			remove_filter( 'the_content', array( $this, 'set_content' ), 99999999 );
			$readd = true;
		}
//if ( !has_shortcode( $page->post_content, 'show_product_catalog' ) ) {
//$page->post_content .= '[show_product_catalog]';
//}
//$content = apply_filters( 'the_content', $page->post_content );

		add_filter( 'ic_catalog_shortcode_default_content', 'wptexturize' );
		add_filter( 'ic_catalog_shortcode_default_content', 'convert_smilies', 20 );
		add_filter( 'ic_catalog_shortcode_default_content', 'wpautop' );
		add_filter( 'ic_catalog_shortcode_default_content', 'shortcode_unautop' );
		add_filter( 'ic_catalog_shortcode_default_content', 'prepend_attachment' );
		add_filter( 'ic_catalog_shortcode_default_content', 'wp_make_content_images_responsive' );
		add_filter( 'ic_catalog_shortcode_default_content', 'do_shortcode', 11 );
		$content = apply_filters( 'ic_catalog_shortcode_default_content', $page->post_content );
//$content = do_shortcode( '[show_product_catalog]' );
		if ( !$this->ended_query() ) {
			add_filter( 'the_content', array( $this, 'set_content' ), 99999999 );
		}
		return $content;
	}

	function clear() {
		return '';
	}

	function get_listing_slug() {
		$listing_id = intval( get_product_listing_id() );
		if ( !empty( $listing_id ) ) {
			$post = get_post( $listing_id );
			return $post->post_name;
		} else {
			return false;
		}
	}

	function setup_postdata() {
		global $post, $wp_query;
		if ( is_ic_catalog_page() ) {
			if ( is_ic_product_listing() ) {
				return;
			}
			if ( isset( $wp_query->queried_object->ID ) ) {
				$product_id	 = $wp_query->queried_object->ID;
				ic_save_global( 'product_id', $product_id );
				$post		 = get_post( $product_id );

				if ( empty( $post->post_content ) ) {
					$post->post_content = ' ';
				}
				setup_postdata( $post );
			}
		} else if ( !is_page() ) {
			$listing_id = intval( get_product_listing_id() );
			if ( !empty( $listing_id ) ) {
				$post		 = get_post( $listing_id );
				$wp_query	 = $this->main_listing_query();
			}
		}
	}

	function setup_loop() {
		ic_save_global( 'in_the_loop', 1 );
	}

	function check_post_class( $class ) {
		ic_save_global( 'ic_post_class_exists', 1 );
		$class[] = 'page';
		$class[] = 'type-page';
		return $class;
	}

	function tax_body_class( $body_class ) {
		$key = array_search( 'archive', $body_class );
		if ( $key !== false ) {
			unset( $body_class[ $key ] );
		}
		return $body_class;
	}

	function single_body_class( $body_class ) {
		$key = array_search( 'single', $body_class );
		if ( $key !== false ) {
			unset( $body_class[ $key ] );
		}
		return $body_class;
	}

}

global $ic_shortcode_catalog;
$ic_shortcode_catalog = new ic_shortcode_catalog;
