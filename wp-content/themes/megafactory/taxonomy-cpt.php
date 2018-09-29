<?php
/**
 * The template for displaying all custom post types
 */
 
get_header(); 

$ahe = new MegafactoryHeaderElements;
$aps = new MegafactoryPostSettings;

$template = 'blog'; // template id

if( $aps->megafactoryCheckTemplateExists( 'archive' ) ){
	$template = 'archive';
}

$aps->megafactorySetPostTemplate( $template );
$template_class = $aps->megafactoryTemplateContentClass();
//print_r( $template_class );
$full_width_class = '';

$acpt = new MegafactoryCPT;
?>

<div class="megafactory-content <?php echo esc_attr( 'megafactory-' . $template ); ?>">
		
		<?php $ahe->megafactoryHeaderSlider('bottom'); ?>
		
		<?php $ahe->megafactoryPageTitle( $template ); ?>

		<div class="megafactory-content-inner">
			<div class="container">
	
				<div class="row">
					
					<div class="<?php echo esc_attr( $template_class['content_class'] ); ?>">
						<div id="primary" class="content-area">
							<?php
								$q_object = get_queried_object();
								$taxonomy = '';
								if( isset($q_object->taxonomy) )
									$taxonomy = $q_object->taxonomy;
								
								$acpt->megafactoryCPTCallTaxTemplate( $taxonomy );
							?>				
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
					
				</div><!-- row -->
			
		</div><!-- .container -->
	</div><!-- .megafactory-content-inner -->
</div><!-- .megafactory-content -->

<?php get_footer();
