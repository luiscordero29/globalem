<?php
/*
 * Custom Post Types Class
 */

class MegafactoryCPT{ 
	
	public $megafactory_options;
	public $cpts;
	public $cpt_slug;
	public $cpt_category_slug;
	public $cpt_tag_slug;
	
	public $cpt_array;
	
	function __construct(){
		$this->megafactory_options = get_option( 'megafactory_options' );
		$this->cpts = $this->megafactoryGetThemeOpt( 'cpt-opts' );
		$this->cpt_array =  array( 'portfolio' => esc_html( 'Portfolio', 'megafactory-core' ), 'team' => esc_html( 'Team', 'megafactory-core' ), 'testimonial' => esc_html( 'Testimonial', 'megafactory-core' ), 'event' => esc_html( 'Events', 'megafactory-core' ), 'service' => esc_html( 'Services', 'megafactory-core' ) );
	}
	
	public function megafactoryGetThemeOpt( $field ){
		$megafactory_options = $this->megafactory_options;
		return isset( $megafactory_options[$field] ) && $megafactory_options[$field] != '' ? $megafactory_options[$field] : '';
	}
	
	public function megafactoryCPTUniqueKey(){
		static $cpt_video_key = 1;
		return $cpt_video_key++;
	}
	
	public function megafactoryCPTRegister( $cpt, $cpt_slug ){
		
		$cpt_labels = $this->megafactoryCPTLabels( $cpt );
		$cpt_theme_slug = $this->megafactoryGetThemeOpt( 'cpt-'. $cpt_slug .'-slug' );
		$has_arch = $cpt_slug == 'portfolio' ? true : false;
		$cpt_args = array(
			'labels' 				=> $cpt_labels,
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'show_ui' 				=> true,
			'show_in_menu'       	=> true,
			'query_var' 			=> true,
			'rewrite' 				=> array( 'with_front' => false, 'slug' => $cpt_theme_slug ),
			'capability_type' 		=> 'post',
			'hierarchical' 			=> false,
			'has_archive' 			=> $has_arch,
			'exclude_from_search' 	=> true,
			'supports' 				=> array( 'title', 'thumbnail', 'excerpt', 'editor' )
		);
		
		return $cpt_args;
	}
	
	public function megafactoryCPTCategoryRegister( $cpt, $cpt_slug ){
		$cpt_labels = $this->megafactoryCPTCategoryLabels( $cpt );
		$cpt_theme_cat_slug = $this->megafactoryGetThemeOpt( 'cpt-'. $cpt_slug .'-category-slug' );
		
		$cpt_category_args = array(
			'hierarchical'      	=> true,
			'labels'            	=> $cpt_labels,
			'show_ui'           	=> true,
			'show_admin_column' 	=> true,
			'show_in_nav_menus' 	=> true,
			'query_var'         	=> true,
			'rewrite'           	=> array( 'with_front' => false, 'slug' => $cpt_theme_cat_slug ),
		);	
		
		return $cpt_category_args;	
	}
	
	public function megafactoryCPTTagRegister( $cpt, $cpt_slug ){
		
		$cpt_labels = $this->megafactoryCPTTagLabels( $cpt );
		$cpt_theme_tag_slug = $this->megafactoryGetThemeOpt( 'cpt-'. $cpt_slug .'-tag-slug' );
		
		$cpt_tag_args = array(
			'hierarchical'      	=> true,
			'labels'            	=> $cpt_labels,
			'show_ui'           	=> true,
			'show_admin_column' 	=> true,
			'show_in_nav_menus' 	=> true,
			'query_var'         	=> true,
			'rewrite'           	=> array( 'with_front' => false, 'slug' => $cpt_theme_tag_slug ),
		);	
		
		return $cpt_tag_args;
	}
	
	public function megafactoryCPTLabels( $cpt_name ){
		$cpt_labels = array(
			'name' 					=> sprintf( esc_html__( '%1$s', 'megafactory-core' ), $cpt_name ),
			'singular_name' 		=> sprintf( esc_html__( '%1$s', 'megafactory-core' ), $cpt_name ),
			'add_new' 				=> esc_html__( 'Add New', 'megafactory-core' ),
			'add_new_item' 			=> sprintf( esc_html__( 'Add New %1$s', 'megafactory-core' ), $cpt_name ),
			'edit_item' 			=> sprintf( esc_html__( 'Edit %1$s', 'megafactory-core' ), $cpt_name ),
			'new_item' 				=> sprintf( esc_html__( 'New %1$s', 'megafactory-core' ), $cpt_name ),
			'all_items' 			=> sprintf( esc_html__( '%1$s', 'megafactory-core' ), $cpt_name ),
			'view_item' 			=> sprintf( esc_html__( 'View %1$s', 'megafactory-core' ), $cpt_name ),
			'search_items' 			=> sprintf( esc_html__( 'Search %1$s', 'megafactory-core' ), $cpt_name ),
			'not_found' 			=> sprintf( esc_html__( 'No %1$s found', 'megafactory-core' ), $cpt_name ),
			'not_found_in_trash' 	=> sprintf( esc_html__( 'No %1$s found in Trash', 'megafactory-core' ), $cpt_name ),
			'parent_item_colon' 	=> ''
		);
		
		return $cpt_labels;
	}
	
	public function megafactoryCPTCategoryLabels( $cpt_name ){
		$cpt_category_labels = array(
			'name'              	=> sprintf( esc_html__( '%1$s Categories', 'megafactory-core' ), $cpt_name ),
			'singular_name'     	=> esc_html__( 'Category', 'megafactory-core' ),
			'search_items'      	=> esc_html__( 'Search Categories', 'megafactory-core' ),
			'all_items'         	=> esc_html__( 'All Categories', 'megafactory-core' ),
			'parent_item'       	=> esc_html__( 'Parent Category', 'megafactory-core' ),
			'parent_item_colon' 	=> esc_html__( 'Parent Category:', 'megafactory-core' ),
			'edit_item'         	=> esc_html__( 'Edit Category', 'megafactory-core' ),
			'update_item'       	=> esc_html__( 'Update Category', 'megafactory-core' ),
			'add_new_item'      	=> esc_html__( 'Add New Category', 'megafactory-core' ),
			'new_item_name'     	=> esc_html__( 'New Category Name', 'megafactory-core' ),
			'menu_name'         	=> esc_html__( 'Categories', 'megafactory-core' ),
		);

		return $cpt_category_labels;
	}
	
	public function megafactoryCPTTagLabels( $cpt_name ){
		$cpt_tags_labels = array(
			'name'              	=> sprintf( esc_html__( '%1$s Tags', 'megafactory-core' ), $cpt_name ),
			'singular_name'     	=> esc_html__( 'Tag', 'megafactory-core' ),
			'search_items'      	=> esc_html__( 'Search Tags', 'megafactory-core' ),
			'all_items'         	=> esc_html__( 'All Tags', 'megafactory-core' ),
			'parent_item'       	=> esc_html__( 'Parent Tag', 'megafactory-core' ),
			'parent_item_colon' 	=> esc_html__( 'Parent Tag:', 'megafactory-core' ),
			'edit_item'         	=> esc_html__( 'Edit Tag', 'megafactory-core' ),
			'update_item'       	=> esc_html__( 'Update Tag', 'megafactory-core' ),
			'add_new_item'      	=> esc_html__( 'Add New Tag', 'megafactory-core' ),
			'new_item_name'     	=> esc_html__( 'New Tag Name', 'megafactory-core' ),
			'menu_name'         	=> esc_html__( 'Tags', 'megafactory-core' ),
		);
		
		return $cpt_tags_labels;
	}
	
	function megafactoryCPTCallTemplate( $template ){
		include MEGAFACTORY_CORE_DIR . 'cpt-templates/' . $template . '.php';
	}
	
	function megafactoryCPTCallTaxTemplate( $template ){
		include MEGAFACTORY_CORE_DIR . 'cpt-templates/' . $template . '.php';
	}	

}

function megafactoryCPTReadyRegister(){
	$megafactory_cpt = new MegafactoryCPT();
	$cpt_opts = $megafactory_cpt->cpts;
	$cpt_all = $megafactory_cpt->cpt_array;

	$tax_needs = array( 'portfolio' );

	if( !empty( $cpt_opts ) ){
		foreach( $cpt_opts as $cpt ){
			
			if( !isset( $cpt_all[$cpt] ) ) continue;
			
			// CPT Register
			$cpt_args = $megafactory_cpt->megafactoryCPTRegister( $cpt_all[$cpt], $cpt );
			if( ! post_type_exists('mf-'.$cpt) ) {
				register_post_type( 'mf-'.$cpt, $cpt_args );
			}
			
			if( in_array( $cpt, $tax_needs ) ){
				// CPT Category Register
				$cpt_category_args = $megafactory_cpt->megafactoryCPTCategoryRegister( $cpt_all[$cpt], $cpt );
				if( ! taxonomy_exists( $cpt.'-categories' ) ) {
					register_taxonomy( $cpt.'-categories', 'mf-'.$cpt, $cpt_category_args );
				}
				
				// CPT Tag Register
				$cpt_tag_args = $megafactory_cpt->megafactoryCPTTagRegister( $cpt_all[$cpt], $cpt );
				if( ! taxonomy_exists( $cpt.'-tags' ) ) {
					register_taxonomy( $cpt.'-tags', 'mf-'.$cpt, $cpt_tag_args );
				}
			} //  if tax needs

		}
	}// if !empty $cpt_opts 
}
add_action( 'init', 'megafactoryCPTReadyRegister' );


class MegafactoryCPTElements extends MegafactoryCPT{ 
	
	function megafactoryCPTPortfolioLayout(){
		$p_layout_opt = get_post_meta( get_the_ID(), 'megafactory_portfolio_layout_opt', true );
		$p_layout = '1';
		if( $p_layout_opt == 'custom' ){
			$p_layout = get_post_meta( get_the_ID(), 'megafactory_portfolio_layout', true );
		}else{
			$p_layout = $this->megafactoryGetThemeOpt('portfolio-layout');
		}
		return $p_layout;
	}
	
	function megafactoryCPTPortfolioFormat(){
		$format = get_post_meta( get_the_ID(), 'megafactory_portfolio_format', true );
		switch( $format ){

			case "video":
				$video_type = get_post_meta( get_the_ID(), 'megafactory_portfolio_video_type', true );
				$video_id = get_post_meta( get_the_ID(), 'megafactory_portfolio_video_id', true );
				$video_modal = get_post_meta( get_the_ID(), 'megafactory_portfolio_video_modal', true );
				$video_atts = array(
					'video_type'	=> $video_type,
					'video_id'		=> $video_id,
					'video_modal'	=> $video_modal
				);
				$this->megafactoryCPTPortfolioVideo( $video_atts );
			break;
			
			case "audio":
				$this->megafactoryCPTPortfolioAudio();
			break;
			
			case "gallery":
				$this->megafactoryCPTPortfolioGallery();
			break;
			
			case "gmap":
				wp_enqueue_script( 'megafactory-gmaps' );
				$this->megafactoryCPTPortfolioGmap();
			break;
			
			case "standard":
			default:
				$this->megafactoryCPTPortfolioStandard();
			break;
			
		}
	}
	
	function megafactoryCPTPortfolioStandard(){
		if ( has_post_thumbnail() ) { ?>
			<div class="portfolio-image"><!-- for sticky column megafactory-sticky-obj -->
				<div class="zoom-gallery">
					<?php  $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>
					<a href="<?php echo esc_url( $featured_img_url ); ?>" title="<?php esc_html( the_title() ); ?>">
						<?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) ); ?>
					</a>
				</div>
			</div>
		<?php
		}
	}
	
	function megafactoryCPTPortfolioGmap(){ 
		$lat = get_post_meta( get_the_ID(), 'megafactory_portfolio_gmap_latitude', true );
		$lang = get_post_meta( get_the_ID(), 'megafactory_portfolio_gmap_longitude', true );
		$marker = get_post_meta( get_the_ID(), 'megafactory_portfolio_gmap_marker', true );
		$map_style = get_post_meta( get_the_ID(), 'megafactory_portfolio_gmap_style', true );
		$info_title = get_the_title();
		$info_address = get_post_meta( get_the_ID(), 'megafactory_portfolio_place', true );
		$info_stat = $info_title || $info_address ? 1 : 0;
	?>
		<div class="portfolio-gmap">
			<div id="megafactorygmap" class="megafactorygmap" style="width:100%;height:400px;" data-map-lat="<?php echo esc_attr( $lat ); ?>" data-map-lang="<?php echo esc_attr( $lang ); ?>" data-map-style="<?php echo esc_attr( $map_style ); ?>" data-map-marker="<?php echo esc_url( $marker ); ?>" data-info-title="<?php echo esc_html( $info_title ); ?>" data-info-addr="<?php echo esc_html( $info_address ); ?>" data-info="<?php echo esc_attr( $info_stat ); ?>"></div>
		</div>
	<?php
	}
	
	function megafactoryCPTPortfolioGallery(){
			
		$gallery_ids = get_post_meta( get_the_ID(), 'megafactory_portfolio_gallery', true );
		if( $gallery_ids ):
			$gallery_array = explode( ",", $gallery_ids );
			$slide_id = '';

			$gal_atts = array(
				'data-loop="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-infinite' ) .'"',
				'data-margin="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-margin' ) .'"',
				'data-center="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-center' ) .'"',
				'data-nav="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-navigation' ) .'"',
				'data-dots="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-pagination' ) .'"',
				'data-autoplay="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-autoplay' ) .'"',
				'data-items="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-items' ) .'"',
				'data-items-tab="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-tab' ) .'"',
				'data-items-mob="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-mobile' ) .'"',
				'data-duration="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-duration' ) .'"',
				'data-smartspeed="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-smartspeed' ) .'"',
				'data-scrollby="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-scrollby' ) .'"',
				'data-autoheight="'. $this->megafactoryGetThemeOpt( 'portfolio-single-slide-autoheight' ) .'"',
			);
			$data_atts = implode( " ", $gal_atts );
			$gallery_modal = get_post_meta( get_the_ID(), 'megafactory_portfolio_gallery_modal', true );
			if( $gallery_modal == 'default' ): // Gallery Model Default
			?>
				<div class="zoom-gallery portfolio-default-gallery">
			<?php
				foreach( $gallery_array as $gal_id ): ?>
					<article class="cpt-item clearfix">
						<figure>
							<?php $image_url = wp_get_attachment_url( $gal_id ); ?>
							<a href="<?php echo esc_url( $image_url ); ?>" title="<?php echo esc_html( get_the_title( $gal_id ) ); ?>">
								<?php echo wp_get_attachment_image( $gal_id, 'large', "", array( "class" => "img-fluid cpt-img" ) ); ?>
							</a>
						</figure>
					</article>
				<?php
				endforeach;
			?>
				</div>
			<?php
			elseif( $gallery_modal == 'normal' ): // Gallery Model Popup
				?>
				<div class="zoom-gallery portfolio-owl-gallery">
					<div class="owl-carousel" <?php echo ( $data_atts ); ?>>
					<?php
					foreach( $gallery_array as $gal_id ): ?>
						<article class="cpt-item">
							<figure>
								<?php $image_url = wp_get_attachment_url( $gal_id ); ?>
								<a href="<?php echo esc_url( $image_url ); ?>" title="<?php echo esc_html( get_the_title( $gal_id ) ); ?>">
									<?php echo wp_get_attachment_image( $gal_id, 'large', "", array( "class" => "img-fluid" ) ); ?>
								</a>
							</figure>
						</article>
					<?php
					endforeach;?>
					</div><!-- .owl-carousel -->
				</div><!-- .zoom-gallery -->
			<?php
			else: // Gallery Model Grid Popup
			
				$gutter = get_post_meta( get_the_ID(), 'megafactory_portfolio_grid_gutter', true );
				$cols = get_post_meta( get_the_ID(), 'megafactory_portfolio_grid_cols', true );
				$cols = !empty( $cols ) ? $cols : '2';
			?>
				<div class="zoom-gallery portfolio-grid-gallery grid-layout clearfix">
					<div class="isotope" data-cols="<?php echo esc_attr( $cols ); ?>" data-gutter="<?php echo esc_attr( $gutter ); ?>">
						<?php
						$chk = 1;
						foreach( $gallery_array as $gal_id ): 
							?>
								<article class="cpt-item">
									<figure>
										<?php $image_url = wp_get_attachment_url( $gal_id ); ?>
										<a href="<?php echo esc_url( $image_url ); ?>" title="<?php echo esc_html( get_the_title( $gal_id ) ); ?>">
											<?php 
											$crop_width = '';
											if( $cols <= 2 ){
												$crop_width = 560;
											}else{
												$crop_width = 400;
											}
											$cropped_img = aq_resize( $image_url, $crop_width, 9999, false, false );
											if( $cropped_img ):
												$image_alt = get_post_meta( $gal_id, '_wp_attachment_image_alt', true);
												$img_src = isset( $cropped_img[0] ) ? $cropped_img[0] : '';
												$img_width = isset( $cropped_img[1] ) ? $cropped_img[1] : '';
												$img_height = isset( $cropped_img[2] ) ? $cropped_img[2] : '';
											?>
											<img class="img-fluid cpt-img" src="<?php echo esc_url( $img_src ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" alt="<?php echo esc_html( $image_alt ); ?>" />
											<?php else:
											echo wp_get_attachment_image( $gal_id, array( $crop_width, '9999' ), "", array( "class" => "img-fluid cpt-img" ) );
											endif; ?>
										</a>
									</figure>
								</article>
						<?php
						endforeach;
						?>
					</div><!-- .isotope -->
				</div><!-- .zoom-gallery -->
				<?php
			endif;
		endif;
	}
	
	function megafactoryCPTPortfolioRelated(){
		
		$rel_opt = $this->megafactoryGetThemeOpt( 'portfolio-related-opt' );
		
		if( $rel_opt ):
		
			$gal_atts = array(
				'data-loop="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-infinite' ) .'"',
				'data-margin="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-margin' ) .'"',
				'data-center="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-center' ) .'"',
				'data-nav="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-navigation' ) .'"',
				'data-dots="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-pagination' ) .'"',
				'data-autoplay="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-autoplay' ) .'"',
				'data-items="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-items' ) .'"',
				'data-items-tab="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-tab' ) .'"',
				'data-items-mob="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-mobile' ) .'"',
				'data-duration="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-duration' ) .'"',
				'data-smartspeed="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-smartspeed' ) .'"',
				'data-scrollby="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-scrollby' ) .'"',
				'data-autoheight="'. $this->megafactoryGetThemeOpt( 'portfolio-related-slide-autoheight' ) .'"',
			);
			$data_atts = implode( " ", $gal_atts );
			
			$post_id = get_the_ID();
			$custom_taxterms = wp_get_object_terms( $post_id, 'portfolio-categories', array('fields' => 'ids') );
			$tot_items = $this->megafactoryGetThemeOpt( 'portfolio-related-slide-items' );
			$thumb_size = '';
			if( $tot_items >= 2 ){
				$thumb_size = 'megafactory-grid-medium';
			}elseif( $tot_items >= 1 ){
				$thumb_size = 'medium';
			}else{
				$thumb_size = 'large';
			}
			
			if( $custom_taxterms ):
			
				$args = array(
				'post_type' => 'mf-portfolio',
					'post_status' => 'publish',
					'posts_per_page' => 10, // you may edit this number
					'orderby' => 'DESC',
					'post__not_in' => array ( $post_id ),
					'tax_query' => array(
						array(
							'taxonomy' => 'portfolio-categories',
							'field' => 'id',
							'terms' => $custom_taxterms
						)
					)
				);
	
				$related_query = new WP_Query( $args );
				if( $related_query->have_posts() ) : ?>
				
					<div class="portfolio-related-slider">
						<h4><?php echo apply_filters( 'megafactory_portfolio_related_title', esc_html__( 'Related Projects', 'megafactory-core' ) ); ?></h4>
						<div class="owl-carousel" <?php echo ( $data_atts ); ?>>
						<?php while( $related_query->have_posts() ) : $related_query->the_post(); ?>
							<article class="cpt-item">
								<figure>
									<?php 
										if ( has_post_thumbnail( get_the_ID() ) ) :
									?>
										<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_html( get_the_title() ); ?>">
											<?php echo get_the_post_thumbnail( get_the_ID(), $thumb_size, array( 'class' => 'img-fluid' ) ); ?>
										</a>
									<?php else: ?>
										<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
											<div class="empty-post-image text-center"><i class="fa fa-picture-o"></i></div>
										</a>
									<?php endif; ?>
									<h6 class="related-title">
										<a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark" title="<?php echo esc_html( get_the_title() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
									</h6>
								</figure>
							</article>
						<?php endwhile; ?>
						</div><!-- .owl-carousel -->
					</div><!-- .portfolio-related-slider -->
				<?php
				endif;
				wp_reset_postdata();
			endif;
		endif; // Releted Slider option
	}
	
	function megafactoryCPTPortfolioVideo( $video_atts ){
		?> <div class="portfolio-video post-video-wrap"> <?php
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
								the_post_thumbnail( 'large', array( 'class' => 'img-fluid mx-auto d-block' ) );
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
								the_post_thumbnail( 'large', array( 'class' => 'img-fluid mx-auto d-block' ) ); 
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
								the_post_thumbnail( 'large', array( 'class' => 'img-fluid mx-auto d-block' ) ); 
							endif;
						?>
					</a>
				<?php
				}else{
					$u_key = $this->megafactoryCPTUniqueKey();
				?>
					<a class="popup-video-post popup-with-zoom-anim popup-custom-video" href="#popup-custom-video-<?php echo esc_attr( $u_key ); ?>">
						<div class="video-play-icon text-center"><span class="fa fa-play-circle-o"></span></div>
						<?php 
							if( '' !== get_the_post_thumbnail() ):
								the_post_thumbnail( 'large', array( 'class' => 'img-fluid mx-auto d-block' ) ); 
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
		}?>
		</div><!-- .portfolio-video -->
		<?php
	}
	
	function megafactoryCPTPortfolioAudio(){
		$audio_type = get_post_meta( get_the_ID(), 'megafactory_portfolio_audio_type', true );
		$audio_id = get_post_meta( get_the_ID(), 'megafactory_portfolio_audio_id', true );
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

	function megafactoryCPTPortfolioTitle(){ ?>
		<div class="portfolio-title">
			<?php
				$port_tit = $this->megafactoryGetThemeOpt('portfolio-title-opt');
				if( is_singular( 'mf-portfolio' ) ) : ?>
					<?php if( $port_tit ) : ?>
				<h3><?php the_title(); ?></h3>
					<?php endif; ?>
			<?php else: ?>
				<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>
		</div>
	<?php
	}
	
	function megafactoryCPTPortfolioContent(){ ?>
		<div class="portfolio-content">
			<?php the_content(); ?>
		</div>
	<?php
	}
	
	function megafactoryCPTMeta(){ ?>
		<div class="portfolio-meta">
			<?php
			$portfolio_meta_items = '';
			$portfolio_items_opt = get_post_meta( get_the_ID(), 'megafactory_portfolio_items_opt', true );
			if( $portfolio_items_opt == 'custom' ){
				$portfolio_meta_items = get_post_meta( get_the_ID(), 'megafactory_portfolio_items', true );
				$portfolio_meta_items = json_decode( stripslashes( $portfolio_meta_items ), true );
			}else{
				$portfolio_meta_items = $this->megafactoryGetThemeOpt('portfolio-meta-items');
			}
			
			$portfolio_meta_items = $portfolio_meta_items['Enabled'];
			if( array_key_exists( "placebo", $portfolio_meta_items ) ) unset( $portfolio_meta_items['placebo'] );
			if( $portfolio_meta_items ): ?>
				<ul class="portfolio-meta-list"><?php						
					foreach ( $portfolio_meta_items as $key => $value ) {
						switch($key) {
							case 'date': ?>
								<li><?php $this->megafactoryCPTMetaDate() ?></li><?php 
							break;
							
							case 'client': ?> 
								<li><?php $this->megafactoryCPTMetaClient() ?></li><?php
							break;
							
							case 'category': ?>
								<li><?php $this->megafactoryCPTMetaCategory() ?></li><?php
							break;
							
							case 'share': ?> 
								<li><?php $this->megafactoryCPTMetaShare() ?></li><?php
							break;
							
							case 'tag': ?>
								<li><?php $this->megafactoryCPTMetaTag() ?></li><?php
							break;
							
							case 'duration': ?>
								<li><?php $this->megafactoryCPTMetaDuration() ?></li><?php
							break;
							
							case 'place': ?>
								<li><?php $this->megafactoryCPTMetaPlace() ?></li><?php
							break;
							
							case 'url': ?>
								<li><?php $this->megafactoryCPTMetaURL() ?></li><?php
							break;
							
							case 'estimation': ?>
								<li><?php $this->megafactoryCPTMetaEstimation() ?></li><?php
							break;
						}
					}?>
				</ul><?php
			endif;
			?>
		</div><!-- .portfolio-meta -->
	<?php
	}
	
	function megafactoryCPTMetaDate(){ 
		$title = $this->megafactoryGetThemeOpt( 'portfolio-date-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-calendar"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$date = get_post_meta( get_the_ID(), 'megafactory_portfolio_date', true );
			$date_format = get_post_meta( get_the_ID(), 'megafactory_portfolio_date_format', true );
			$date_text = $date;
			if( $date && $date_format ){
				$date_text = date( $date_format, strtotime( $date ) );
			}
		?>
		<span class="entry-date"><?php echo esc_attr( $date_text ); ?></span>
	<?php
	}
	
	function megafactoryCPTMetaClient(){
		$title = $this->megafactoryGetThemeOpt( 'portfolio-client-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-user-o"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$client_name = get_post_meta( get_the_ID(), 'megafactory_portfolio_client_name', true ); 
		?>
		<span class="entry-client"><?php echo esc_attr( $client_name ); ?></span>
	<?php
	}
	
	function megafactoryCPTMetaCategory(){
	
		$taxonomy = 'portfolio-categories';
		$terms = get_the_terms( get_the_ID(), $taxonomy ); // Get all terms of a taxonomy
		
		$title = $this->megafactoryGetThemeOpt( 'portfolio-category-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-folder-o"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif;
		
		if ( $terms && !is_wp_error( $terms ) ) :
		?>
			<ul class="portfolio-categories nav">
				<?php 
					$c = count( $terms ); 
					foreach ( $terms as $term ) { ?>
					<li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?><?php if( --$c != 0 ) echo ','; ?></a></li>
				<?php } ?>
			</ul>
		<?php endif;?>
	<?php
	}
	
	function megafactoryCPTMetaShare(){ 
	
		$posts_shares = $this->megafactoryGetThemeOpt( 'post-social-shares' );
		$post_id = get_the_ID();
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' );
		
		$title = $this->megafactoryGetThemeOpt( 'portfolio-share-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-share-square-o"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		
		<ul class="nav portfolio-share social-icons">
			<?php foreach ( $posts_shares as $social_share ){
		
					switch( $social_share ){
					
						case "fb": 
					?>
							<li class="nav-item"><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink( $post_id ) ); ?>&t=<?php echo urlencode( get_the_title() ); ?>" target="blank" class="social-facebook share-fb"><i class="fa fa-facebook"></i></a></li>
						
					<?php
						break; // fb
						case "twitter":
					?>
				
							<li class="nav-item"><a href="http://twitter.com/home?status=Reading:<?php echo urlencode(get_the_title()); ?>-<?php echo  esc_url( home_url( '/' ) )."/?p=". esc_attr( $post_id ); ?>" class="social-twitter share-twitter" title="<?php esc_html_e( 'Click to send this page to Twitter!', 'megafactory' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
				
					<?php
						break; // twitter
						case "linkedin":
					?>
				
							<li class="nav-item"><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() ); ?>&title=<?php echo urlencode(get_the_title()); ?>&summary=&source=<?php echo bloginfo('name'); ?>" class="social-linkedin share-linkedin" target="_new"><i class="fa fa-linkedin"></i></a></li>
				
					<?php
						break; // linkedin
						case "gplus":
					?>
				
						<li class="nav-item"><a href="https://plus.google.com/share?url=<?php esc_url( the_permalink() ); ?>" class="social-google-plus share-gplus" target="blank"><i class="fa fa-google-plus"></i></a></li>
				
					<?php
						break; // gplus
						case "pinterest":
					?>
				
						<li class="nav-item"><a href="http://pinterest.com/pin/create/button/?url=<?php esc_url( the_permalink() ); ?>&amp;media=<?php echo ( ! empty( $image[0] ) ? $image[0] : '' ); ?>&description=<?php echo urlencode(get_the_title()); ?>" class="social-pinterest share-pinterest" target="blank"><i class="fa fa-pinterest"></i></a></li>
				
					<?php
						break; // pinterest
					?>
				
			<?php 
					} //switch
				} // foreach?>

		</ul><?php
	}
	
	function megafactoryCPTMetaTag(){
		$taxonomy = 'portfolio-tags';
		$terms = get_the_terms( get_the_ID(), $taxonomy ); // Get all terms of a taxonomy
		
		$title = $this->megafactoryGetThemeOpt( 'portfolio-tags-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-tags"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif;
		
		if ( $terms && !is_wp_error( $terms ) ) :
		?>
			<ul class="portfolio-tags nav">
				<?php 
					$c = count( $terms ); 
					foreach ( $terms as $term ) { ?>
					<li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?><?php if( --$c != 0 ) echo ',';	?></a></li>
				<?php } ?>
			</ul>
		<?php endif;?>
	<?php
	}
	
	function megafactoryCPTMetaDuration(){ 
		$title = $this->megafactoryGetThemeOpt( 'portfolio-duration-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-clock-o"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$duration = get_post_meta( get_the_ID(), 'megafactory_portfolio_duration', true ); 
		?>
		<span class="entry-duration"><?php echo esc_html( $duration ); ?></span>
	<?php
	}
	
	function megafactoryCPTMetaPlace(){ 
		$title = $this->megafactoryGetThemeOpt( 'portfolio-place-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-map-marker"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$place = get_post_meta( get_the_ID(), 'megafactory_portfolio_place', true ); 
		?>
		<span class="entry-place"><?php echo esc_html( $place ); ?></span>
	<?php
	}
	
	function megafactoryCPTMetaURL(){ 
		$title = $this->megafactoryGetThemeOpt( 'portfolio-url-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-link"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$url = get_post_meta( get_the_ID(), 'megafactory_portfolio_url', true ); 
		?>
		<span class="entry-url"><?php echo esc_url( $url ); ?></span>
	<?php
	}
	
	function megafactoryCPTMetaEstimation(){ 
		$title = $this->megafactoryGetThemeOpt( 'portfolio-estimation-label' );
		if( $title ):
		?>
		<div class="portfolio-meta-title-wrap">
			<h6><span class="portfolio-meta-icon"><i class="fa fa-money"></i></span><?php echo esc_html( $title ); ?></h6>
		</div>
		<?php endif; ?>
		<?php
			$estimation = get_post_meta( get_the_ID(), 'megafactory_portfolio_estimation', true ); 
		?>
		<span class="entry-estimation"><?php echo esc_html( $estimation ); ?></span>
	<?php
	}
	
	function megafactoryCPTNav(){ ?>
		<div class="custom-post-nav">
			<?php $prev_post = get_previous_post();
			if (!empty( $prev_post )): ?>
				<a href="<?php echo $prev_post->guid ?>"><i class="fa fa-angle-double-left"></i></a>
			<?php else: ?>
				<a href="#" class="disabled"><i class="fa fa-angle-double-left"></i></a>
			<?php endif; ?>
		
			<?php $next_post = get_next_post();
			if (!empty( $next_post )): ?>
				<a href="<?php echo get_permalink( $next_post->ID ); ?>"><i class="fa fa-angle-double-right"></i></a>
			<?php else: ?>
				<a href="#" class="disabled"><i class="fa fa-angle-double-right"></i></a>
			<?php endif; ?>
		</div>
	<?php
	}
	
}