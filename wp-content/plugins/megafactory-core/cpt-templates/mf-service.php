<?php

// Service Content
$t = new MegafactoryCPTElements();
$title_opt = $t->megafactoryGetThemeOpt('service-title-opt');

while ( have_posts() ) : the_post();
?>
	
	<div class="service">
		<div class="service-info-wrap">
		
			<div class="service-title">
				<?php if( $title_opt ) : ?>
					<h2><?php the_title(); ?></h2>
				<?php endif; // desg exists ?>
			</div>
		
			<?php if( has_post_thumbnail( get_the_ID() ) ): ?>
			<div class="service-img">
				<?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) ); ?>
			</div>
			<?php endif; // if thumb exists ?>
		
			<div class="service-content">
				<?php the_content(); ?>
			</div>
			
			<?php $t->megafactoryCPTNav(); ?>

		</div> <!-- .service-info-wrap -->
	</div><!-- .service -->

<?php
endwhile; // End of the loop.