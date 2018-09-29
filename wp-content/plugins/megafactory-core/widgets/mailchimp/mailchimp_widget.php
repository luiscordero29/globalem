<?php

require_once( MEGAFACTORY_CORE_DIR . 'widgets/mailchimp/mcapi.class.php' );

add_action( 'widgets_init', 'megafactory_mailchimp_load_widget' );
function megafactory_mailchimp_load_widget() {
	
	register_widget( 'megafactory_mailchimp_widget' );
}
class megafactory_mailchimp_widget extends WP_Widget {
	private $default_failure_message;
	private $default_signup_text;
	private $default_success_message;
	private $default_title;
	private $successful_signup = false;
	private $subscribe_errors;
	private $api_key;
	
	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		
		$widget_ops = array( 'classname' => 'megafactory_mailchimp_widget', 'description' => esc_html__('Mailchimp Widget', 'megafactory-core') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'megafactory_mailchimp_widget' );
		
		$this->default_failure_message = esc_html__('There was a problem processing your submission.', 'megafactory-core');
		$this->default_signup_text = esc_html__('Join now!', 'megafactory-core');
		$this->default_success_message = esc_html__('Thank you for joining our mailing list. Please check your email for a confirmation link.', 'megafactory-core');
		$this->default_title = esc_html__('Sign up for our mailing list.', 'megafactory-core');
		$megafactory_option = get_option( 'megafactory_options' );
		$this->api_key = isset( $megafactory_option['mailchimp-api'] ) ? $megafactory_option['mailchimp-api'] : '';
		
		/* Create the widget. */
		parent::__construct( 'megafactory_mailchimp_widget', esc_html__('Megafactory Mailchimp', 'megafactory-core'), $widget_ops, $control_ops );
	}
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract($args);
		
		$mcapi = new MCAPI($this->api_key);
		echo wp_kses_post( $before_widget );
		echo ( $instance['title'] != '' ? wp_kses_post( $before_title . $instance['title'] . $after_title ) : '' );
			?>	
			
			<form class="zozo-mc-form" id="<?php echo 'zozo-mc-form' . $this->number; ?>" method="post">
				<?php	
					if ($instance['subtitle']) {
				?>	
				<p class="zozo-mc-subtitle"><?php echo stripslashes($instance['subtitle']); ?></p>
				<p class="mc-aknowlegement" id="<?php echo 'zozo-mc-err' . $this->number; ?>"></p>
				<?php	
					}
					if ($instance['collect_first']) {
				?>
				<div class="form-group">
					<input type="text" placeholder="<?php esc_html_e('First Name', 'megafactory-core'); ?>" class="form-control first-name" name="<?php echo 'zozo-mc-first_name' . $this->number; ?>" />
				</div>
				<?php
					}
					if ($instance['collect_last']) {
				?>	
				<div class="form-group">
					<input type="text" placeholder="<?php esc_html_e('Last Name', 'megafactory-core'); ?>" class="form-control last-name" name="<?php echo 'zozo-mc-last_name' . $this->number; ?>" />
				</div>
				<?php	
					}
					$options = get_option($this->option_name);
				?>
					<input type="hidden" name="megafactory_mc_number" value="<?php echo esc_attr( $this->number ); ?>" />
					<input type="hidden" name="megafactory_mc_listid<?php echo esc_attr( $this->number ); ?>" value="<?php echo stripslashes($options[$this->number]['current_mailing_list']); ?>" />
					<input type="hidden" name="megafactory_mc_success<?php echo esc_attr( $this->number ); ?>" value="<?php echo stripslashes($instance['success_message']); ?>" />
					<input type="hidden" name="megafactory_mc_failure<?php echo esc_attr( $this->number ); ?>" value="<?php echo stripslashes($instance['failure_message']); ?>" />
					
					<div class="form-group" data-toggle="tooltip" data-placement="top">
					  <input type="text" class="form-control zozo-mc-email" id="zozo-mc-email-<?php echo esc_attr( $this->number ); ?>" placeholder="<?php esc_html_e('Email Address', 'megafactory-core'); ?>" name="<?php echo 'zozo-mc-email' . esc_attr( $this->number ); ?>">
					</div>

					<input class="zozo-mc btn btn-default btn-block" data-id="<?php echo esc_attr( $this->number ); ?>" type="button" name="<?php echo stripslashes($instance['signup_text']); ?>" value="<?php echo stripslashes($instance['signup_text']); ?>" />
				</form>
				<!--Mailchimp Custom Script-->
				<?php
			echo wp_kses_post( $after_widget );
		}
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['collect_first'] = ! empty($new_instance['collect_first']);
		
		$instance['collect_last'] = ! empty($new_instance['collect_last']);
		
		$instance['current_mailing_list'] = esc_attr($new_instance['current_mailing_list']);
		
		$instance['failure_message'] = esc_attr(stripslashes_deep($new_instance['failure_message']));
		
		$instance['signup_text'] = esc_attr(stripslashes_deep($new_instance['signup_text']));
		
		$instance['success_message'] = esc_attr(stripslashes_deep($new_instance['success_message']));
		
		$instance['subtitle'] = esc_attr(stripslashes_deep($new_instance['subtitle']));
		
		$instance['title'] = esc_attr(stripslashes_deep($new_instance['title']));
		return $instance;
	}
	function form( $instance ) {
	
		$defaults = array( 'title' => '', 'current_mailing_list' => '', 'signup_text' => '', 'collect_first' => '', 'collect_last' => '', 'subtitle' => '', 'success_message' => esc_html__('Success.', 'megafactory-core'), 'failure_message' => esc_html__('Failure.', 'megafactory-core'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$mcapi = new MCAPI($this->api_key);

		if ($mcapi){
			$this->lists = $mcapi->lists();
			?>
					<h3><?php echo  esc_html__('General Settings', 'megafactory-core');?></h3>
					<!-- Widget Title: Text Input -->
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'zozo-mc-title' ) ); ?>"><?php esc_html_e('Title:', 'megafactory-core'); ?></label>
						<input  class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" />
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('current_mailing_list') ); ?>"><?php echo esc_html__('Select a Mailing List :', 'megafactory-core'); ?></label>
						<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('current_mailing_list') );?>" name="<?php echo esc_attr( $this->get_field_name('current_mailing_list') ); ?>">
			<?php	
			if( isset( $this->lists['data'] ) && !empty( $this->lists['data'] ) && is_array( $this->lists['data'] ) ){
				foreach ($this->lists['data'] as $key => $value) {
					$selected = (isset($instance['current_mailing_list']) && $instance['current_mailing_list'] == $value['id']) ? '1' : '';
					?>	
							<option <?php echo ( $selected == '1' ? ' selected="selected" ' : '' ); ?>value="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_attr( $value['name'] ); ?></option>
					<?php
				}
			}
			?>
						</select>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('signup_text') ); ?>"><?php echo esc_html__('Sign Up Button Text :', 'megafactory-core'); ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('signup_text') ); ?>" name="<?php echo esc_attr( $this->get_field_name('signup_text') ); ?>" value="<?php echo esc_attr( $instance['signup_text'] ); ?>" type="text"  />
					</p>
					<h3><?php echo esc_html__('Personal Information', 'megafactory-core'); ?></h3>
					<p>
						<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('collect_first') ); ?>" name="<?php echo esc_attr( $this->get_field_name('collect_first') ); ?>" <?php echo checked($instance['collect_first'], true, false); ?> />
						<label for="<?php echo esc_attr( $this->get_field_id('collect_first') ); ?>"><?php echo esc_html__('Collect first name.', 'megafactory-core'); ?></label>
						<br />
						<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id('collect_last') ); ?>" name="<?php echo esc_attr( $this->get_field_name('collect_last') ); ?>" <?php echo checked($instance['collect_last'], true, false); ?> />
						<label><?php echo esc_html__('Collect last name.', 'megafactory-core'); ?></label>
					</p>
					<h3><?php echo esc_html__('Notifications', 'megafactory-core'); ?></h3>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('subtitle') ); ?>"><?php echo esc_html__('Sub Title:', 'megafactory-core'); ?></label>
						<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('subtitle') ); ?>" name="<?php echo esc_attr( $this->get_field_name('subtitle') ); ?>"><?php echo esc_attr( $instance['subtitle'] ); ?></textarea>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('success_message') ); ?>"><?php echo esc_html__('Success Message:', 'megafactory-core'); ?></label>
						<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('success_message') ); ?>" name="<?php echo esc_attr( $this->get_field_name('success_message') ); ?>"><?php echo esc_attr( $instance['success_message'] ); ?></textarea>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('failure_message') ); ?>"><?php echo esc_html__('Failure Message:', 'megafactory-core'); ?></label>
						<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('failure_message') ); ?>" name="<?php echo esc_attr( $this->get_field_name('failure_message') ); ?>"><?php echo esc_attr( $instance['failure_message'] ); ?></textarea>
					</p>
			<?php
			
		}
	}
		
}
