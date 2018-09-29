<?php
/**
 * Template coming soon default
 */
 
 //get maintenance header
 require_once( MEGAFACTORY_CORE_DIR . 'maintenance/header.php' );
 
 $megafactory_option = get_option( 'megafactory_options' );
 $address = isset( $megafactory_option['maintenance-address'] ) ? $megafactory_option['maintenance-address'] : '';
 $email = isset( $megafactory_option['maintenance-email'] ) ? $megafactory_option['maintenance-email'] : '';
 $phone = isset( $megafactory_option['maintenance-phone'] ) ? $megafactory_option['maintenance-phone'] : '';
 
?>

<div class="container text-center maintenance-wrap">

	<div class="row">
		<div class="col-md-12">
			<h1 class="maintenance-title"><?php esc_html_e( 'Under Maintenance', 'megafactory' ); ?></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<h4><?php esc_html_e( 'Phone', 'megafactory' ); ?></h4>
			<div class="maintenance-phone">
				<?php echo esc_html(  $phone ); ?>
			</div>
		</div>
		<div class="col-md-4">
			<h4><?php esc_html_e( 'Address', 'megafactory' ); ?></h4>
			<div class="maintenance-address">
				<?php echo wp_kses_post( $address ); ?>
			</div>
		</div>
		<div class="col-md-4">
			<h4><?php esc_html_e( 'Email', 'megafactory' ); ?></h4>
			<div class="maintenance-email">
				<?php echo esc_html(  $email ); ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12 maintenance-footer">
			<p><?php esc_html_e( 'We are currently in maintenance mode. We will be back soon.', 'megafactory' ); ?></p>
		</div>
	</div>
	
</div>

<?php
 //get maintenance header
 require_once( MEGAFACTORY_CORE_DIR . 'maintenance/footer.php' );
?>