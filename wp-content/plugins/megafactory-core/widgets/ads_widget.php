<?php
add_action( 'widgets_init', 'megafactory_zozo_ads_load_widget' );
function megafactory_zozo_ads_load_widget() {
	register_widget( 'megafactory_zozo_ads_widget' );
}
class megafactory_zozo_ads_widget extends WP_Widget {
	/**
	 * Widget setup.
	 */
	public function __construct() {
		$widget_ops = array( 'classname' => 'zozo_ads_widget', 'description' => esc_html__('A widget that displays an Ads', 'megafactory-core') );
		$control_ops = array('id_base' => 'zozo_ads_widget' );
		parent::__construct( 'zozo_ads_widget', esc_html__('Megafactory Ads', 'megafactory-core'), $widget_ops, $control_ops );
	}
	/**
	 * How to display the widget on the screen.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$ads_field = esc_attr( $instance['ads_field'] );
		
		/* Before widget (defined by themes). */
		echo wp_kses_post( $before_widget );
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo ( $title != '' ? wp_kses_post( $before_title . $title . $after_title ) : '' );
	
			/* Ads Code */
			echo megafactory_ads_out( $ads_field );

		/* After widget (defined by themes). */
		echo wp_kses_post( $after_widget );
	}
	/**
	 * Update the widget settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['ads_field'] = esc_attr( $new_instance['ads_field'] );
		return $instance;
	}
	public function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'ads_field' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'megafactory-core'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:96%;" type="text" />
		</p>

		<!-- ads_field -->
		<p>
		<select id="<?php echo esc_attr( $this->get_field_id('ads_field') ); ?>" name="<?php echo esc_attr( $this->get_field_name('ads_field') ); ?>" class="widefat" >
			<option value='all' <?php if ('all' == $instance['ads_field']) echo 'selected="selected"'; ?>><?php esc_html_e('Choose Ads', 'megafactory-core'); ?></option>
			<?php 
				$ads = array( 
						'header' => esc_html__( 'Header', 'megafactory-core' ),
						'footer' => esc_html__( 'Footer', 'megafactory-core' ),
						'sidebar' => esc_html__( 'Sidebar', 'megafactory-core' ),
						'artical-top' => esc_html__( 'Artical Top', 'megafactory-core' ),
						'artical-inline' => esc_html__( 'Artical Inline', 'megafactory-core' ),
						'artical-bottom' => esc_html__( 'Artical Bottom', 'megafactory-core' ),
						'custom1' => esc_html__( 'Custom1', 'megafactory-core' ),
						'custom2' => esc_html__( 'Custom2', 'megafactory-core' ),
						'custom3' => esc_html__( 'Custom3', 'megafactory-core' ),
						'custom4' => esc_html__( 'Custom4', 'megafactory-core' ),
						'custom5' => esc_html__( 'Custom5', 'megafactory-core' )
					);
			?>
			<?php foreach( $ads as $key => $value ) { ?>
			<option value='<?php echo esc_attr($key); ?>' <?php if ( $key == $instance['ads_field']) echo 'selected="selected"'; ?>><?php echo esc_attr( $value ); ?></option>
			<?php } ?>
		</select>
		</p>

	<?php
	}
}
?>