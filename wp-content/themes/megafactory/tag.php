<?php
/**
 * The template for displaying tag pages
 */

get_header(); 
$ahe = new MegafactoryHeaderElements;

$template = 'blog'; // template id
$aps = new MegafactoryPostSettings;

if( $aps->megafactoryCheckTemplateExists( 'tag' ) ){
	$template = 'tag';
}elseif( $aps->megafactoryCheckTemplateExists( 'archive' ) ){
	$template = 'archive';
}
$aps->megafactorySetPostTemplate( $template );

add_filter( 'excerpt_length', array( &$aps, 'megafactorySetExcerptLength' ), 999 );
$template_class = $aps->megafactoryTemplateContentClass();
$extra_class = $layout = $aps->megafactoryGetCurrentLayout();
$top_standard = $aps->megafactoryGetThemeOpt( $template.'-top-standard-post' );

$gutter = $cols = $infinite = $isotope = '';
if( $layout == 'grid-layout' ){
	$cols = $aps->megafactoryGetThemeOpt( $template.'-grid-cols' );
	$gutter = $aps->megafactoryGetThemeOpt( $template.'-grid-gutter' );
	$infinite = $aps->megafactoryGetThemeOpt( $template.'-infinite-scroll' ) ? 'true' : 'false';
	$isotope = $aps->megafactoryGetThemeOpt( $template.'-grid-type' );
	$extra_class .= $aps->megafactoryGetThemeOpt( $template.'-grid-type' ) == 'normal' ? ' grid-normal' : '';
}
?>

<div class="megafactory-content <?php echo esc_attr( 'megafactory-' . $template ); ?>">

	<?php $ahe->megafactoryPageTitle( $template ); ?>
	
	<?php 
		if( $aps->megafactoryThemeOpt( $template.'-featured-slider' ) ){
			$ahe->megafactoryFeaturedSlider( $template );
		}
	?>
	
	<div class="megafactory-content-inner">
		<div class="container">
		
			<div class="row">
		
				<div class="<?php echo esc_attr( $template_class['content_class'] ); ?>">
					<div id="primary" class="content-area">
						<main id="main" class="site-main <?php echo esc_attr( $template ); ?>-template <?php echo esc_attr( $extra_class ); ?>" data-cols="<?php echo esc_attr( $cols ); ?>" data-gutter="<?php echo esc_attr( $gutter ); ?>">
							
							<?php
							
							if ( have_posts() ) :
		
								$chk = $isotope_stat = 1;
								/* Start the Loop */
								while ( have_posts() ) : the_post();
								
									if( $top_standard && $layout != 'standard-layout' ) : ?>
										
										<div class="top-standard-post clearfix">
											<?php
											$aps::$top_standard = true;
											get_template_part( 'template-parts/post/content' );
											$aps::$top_standard = false;
											$top_standard = false;
											?>
										</div><?php
										
									else :
									
										if( $layout == 'grid-layout' && $isotope == 'isotope' && $isotope_stat == 1 ) : $isotope_stat = 0; ?>
											<div class="isotope" data-cols="<?php echo esc_attr( $cols ); ?>" data-gutter="<?php echo esc_attr( $gutter ); ?>" data-infinite="<?php echo esc_attr( $infinite ); ?>"><?php
										endif;
		
										if( $chk == 1 && $layout == 'grid-layout' && $isotope == 'normal' ) : echo '<div class="grid-parent clearfix">';  endif;
										
										get_template_part( 'template-parts/post/content' );
										
										if( $chk == $cols && $layout == 'grid-layout' && $isotope == 'normal' ) : echo '</div><!-- .grid-parent -->'; $chk = 0; endif;
										
										$chk++;
									
									endif;
				
								endwhile;
								
									if( $layout == 'grid-layout' && $isotope == 'isotope' ) : $isotope_stat = 0; ?>
										</div><!-- .isotope --><?php
									endif;
		
									if( $chk != 1 && $layout == 'grid-layout' && $isotope == 'normal' ) : echo '</div><!-- .grid-parent -->'; endif; // Unexpected if odd grid
					
							else :
				
								get_template_part( 'template-parts/post/content', 'none' );
				
							endif;
							?>
				
						</main><!-- #main -->
							<?php $aps->megafactoryWpBootstrapPagination(); ?>
					</div><!-- #primary -->
				</div><!-- main col -->
				
				<?php if( $template_class['lsidebar_class'] != '' ) : ?>
				<div class="<?php echo esc_attr( $template_class['lsidebar_class'] ); ?>">
					<aside class="widget-area left-widget-area<?php echo esc_attr( $template_class['sticky_class'] ); ?>">
						<?php dynamic_sidebar( $template_class['left_sidebar'] ); ?>
					</aside>
				</div><!-- sidebar col -->
				<?php endif; ?>
				
				<?php if( $template_class['rsidebar_class'] != '' ) : ?>
				<div class="<?php echo esc_attr( $template_class['rsidebar_class'] ); ?>">
					<aside class="widget-area right-widget-area<?php echo esc_attr( $template_class['sticky_class'] ); ?>">
						<?php dynamic_sidebar( $template_class['right_sidebar'] ); ?>
					</aside>
				</div><!-- sidebar col -->
				<?php endif; ?>
				
			</div><!-- .row -->
			
		</div><!-- .container -->
	</div><!-- .megafactory-content-inner -->
</div><!-- .megafactory-content -->

<?php get_footer();