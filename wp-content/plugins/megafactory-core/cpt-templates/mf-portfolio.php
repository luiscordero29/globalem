<?php

// Portfolio Content

$t = new MegafactoryCPTElements();
$p_layout = $t->megafactoryCPTPortfolioLayout();
while ( have_posts() ) : the_post();

	$sticky_col = get_post_meta( get_the_ID(), 'megafactory_portfolio_sticky', true );
	$sticky_lclass = $sticky_rclass = '';
	if( !empty( $sticky_col ) && $sticky_col != 'none' ){
		$sticky_lclass = $sticky_col == 'left' ? ' megafactory-sticky-obj' : '';
		$sticky_rclass = $sticky_col == 'right' ? ' megafactory-sticky-obj' : '';
	}

?>
	<?php if( $p_layout == '1' ) : ?>
		<div class="portfolio-single portfolio-model-1">
			<div class="row">
				
				<div class="col-sm-8">
					<div class="portfolio-format<?php echo esc_attr( $sticky_lclass ); ?>">
						<?php $t->megafactoryCPTPortfolioFormat(); ?>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="portfolio-info<?php echo esc_attr( $sticky_rclass ); ?>">
						<?php $t->megafactoryCPTNav(); ?>
						<?php $t->megafactoryCPTPortfolioTitle(); ?>
						<?php $t->megafactoryCPTPortfolioContent(); ?>
						<?php $t->megafactoryCPTMeta(); ?>
					</div>
				</div><!-- .col -->
		
			</div><!-- .row -->
		</div><!-- .portfolio-single -->
	<?php elseif( $p_layout == '2' ) : ?>
		<div class="portfolio-single portfolio-model-2">
			<div class="row">
			
				<div class="col-sm-12">
					<div class="portfolio-format">
						<?php $t->megafactoryCPTPortfolioFormat(); ?>
					</div>
				</div>
				
			</div><!-- .row -->
			<div class="row portfolio-details">
			
				<div class="col-sm-8">
					<div class="portfolio-content-wrap<?php echo esc_attr( $sticky_lclass ); ?>">
						<?php $t->megafactoryCPTNav(); ?>
						<?php $t->megafactoryCPTPortfolioTitle(); ?>
						<?php $t->megafactoryCPTPortfolioContent(); ?>
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="portfolio-meta<?php echo esc_attr( $sticky_rclass ); ?>">
						<?php $t->megafactoryCPTMeta(); ?>
					</div>
				</div>
				
			</div><!-- .row -->
		</div><!-- .portfolio-single -->
	<?php elseif( $p_layout == '3' ) : ?>
		<div class="portfolio-single portfolio-model-3">
			<div class="row">
				<div class="col-sm-4">
					<div class="portfolio-info<?php echo esc_attr( $sticky_lclass ); ?>">
						<?php $t->megafactoryCPTNav(); ?>
						<?php $t->megafactoryCPTPortfolioTitle(); ?>
						<?php $t->megafactoryCPTPortfolioContent(); ?>
						<?php $t->megafactoryCPTMeta(); ?>
					</div>
				</div><!-- .col -->
				<div class="col-sm-8">
					<div class="portfolio-format<?php echo esc_attr( $sticky_rclass ); ?>">
						<?php $t->megafactoryCPTPortfolioFormat(); ?>
					</div>
				</div>
			</div><!-- .row -->
		</div><!-- .portfolio-single -->
	<?php endif; 
	
	//Portfolio Related Slider
	$t->megafactoryCPTPortfolioRelated();
	
endwhile; // End of the loop.