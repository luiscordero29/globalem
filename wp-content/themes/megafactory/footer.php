<?php
/**
 * The template for displaying the footer
 *
 */

$afe = new MegafactoryFooterElements;

?>


	</div><!-- .megafactory-content-wrapper -->

	<footer class="site-footer<?php $afe->megafactoryFooterLayout(); ?>">
		<?php echo megafactory_ads_out( $afe->megafactoryThemeOpt( 'footer-ads-list' ) );	?>
		<?php $afe->megafactoryFooterElements(); ?>
		
		<?php $afe->megafactoryFooterBacktoTop(); ?>
	</footer><!-- #colophon -->

</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
