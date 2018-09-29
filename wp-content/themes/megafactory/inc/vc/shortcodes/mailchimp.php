<?php 
/**
 * Megafactory Mailchimp
 */

if ( ! function_exists( "megafactory_vc_mailchimp_shortcode" ) ) {
	function megafactory_vc_mailchimp_shortcode( $atts, $content = NULL ) {
		
		$atts = vc_map_get_attributes( "megafactory_vc_mailchimp", $atts );
		extract( $atts );
		
		//Define Variables
		$animation = isset( $animation ) ? $animation : '';
		$class = isset( $extra_class ) && $extra_class != '' ? $extra_class : '';		

		// Get VC Animation
		$class .= megafactoryGetCSSAnimation( $animation );
		
		//Get mailchimp list id's
		$megafactory_option = get_option( 'megafactory_options' );
		$mc_api_key = isset( $megafactory_option['mailchimp-api'] ) ? $megafactory_option['mailchimp-api'] : '';
		
		$output = '';

		$rand_id = megafactory_shortcode_rand_id();
		
		// This is custom css options for main shortcode warpper
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-'. megafactory_shortcode_rand_id();
		
		//Shortcode css ccde here
		$shortcode_css .= isset( $font_color ) && $font_color != '' ? '.' . esc_attr( $rand_class ) . '.mailchimp-wrapper { color: '. esc_attr( $font_color ) .'; }' : '';
		
		if( $shortcode_css ) $class .= ' ' . $shortcode_rand_id . ' megafactory-inline-css';

		$output .= '<div class="mailchimp-wrapper text-center'. esc_attr( $class ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';

			$output .= isset( $title ) && $title != '' ? '<h3 class="mailchimp-title">'. esc_html( $title ) .'</h3>' : '';
			$output .= isset( $sub_title ) && $sub_title != '' ? '<p class="mailchimp-sub-title">'. esc_html( $sub_title ) .'</p>' : '';
			
			$output .= '<div class="form-group">';
			
				$output .= '<form class="mc-form" method="post">';

					$output .= isset( $first_name ) && $first_name == 'on' ? '<input type="text" class="form-control" name="mc_first_name" placeholder="'. esc_html__( 'Enter First Name', 'megafactory' ) .'">' : '';
					$output .= isset( $last_name ) && $last_name == 'on' ? '<input type="text" class="form-control" name="mc_last_name" placeholder="'. esc_html__( 'Enter Last Name', 'megafactory' ) .'">' : '';
					
					$output .= isset( $mailchimp_list ) && $mailchimp_list != '' ? '<input type="hidden" class="form-control" name="mc_list_id" value="'. esc_attr( $mailchimp_list ) .'">' : '';
	
					$placeholder = isset( $placeholder ) && $placeholder != '' ? $placeholder : '';
					
					$button_style = isset( $button_style ) ? $button_style : 'icon';
					$btn_txt = '';
					if( $button_style == 'text' ){
						$btn_txt = isset( $button_text ) ? '<span class="subscribe-text">' . $button_text . '</span>' : '';
					}elseif( $button_style == 'icon' ){
						$btn_txt = apply_filters( 'megafactory_mailchimp_icon', '<span class="fa fa-paper-plane-o"></span>' );
					}else{
						$btn_txt = isset( $button_text ) ? '<span class="subscribe-text">' . $button_text . '</span>' . apply_filters( 'megafactory_mailchimp_icon', '<span class="fa fa-paper-plane-o"></span>' ) : '';
					}
					
					if( isset( $mailchimp_layout ) && $mailchimp_layout == '1' ){
						$output .= '<div class="input-group">';
							$output .= '<input type="text" class="form-control" name="mc_email" placeholder="'. esc_html( $placeholder ) .'">';
			
							$output .= '<span class="input-group-btn">';
								$output .= '<button class="btn btn-secondary mc-submit-btn" type="button">'. wp_kses_post( $btn_txt ) .'</button>';
							$output .= '</span>';
						$output .= '</div><!-- .input-group -->';
					}else{
						$output .= '<input type="text" class="form-control" name="mc_email" placeholder="'. esc_html( $placeholder ) .'">';
						$output .= '<span class="input-group-btn">';
							$output .= '<button class="btn btn-secondary mc-submit-btn" type="button">'. wp_kses_post( $btn_txt ) .'</button>';
						$output .= '</span>';
					}
				$output .= '</form><!-- .mc-form -->';
				
			$output .= '</div><!-- .form-group -->';
			
			$success = isset( $success_text ) && $success_text != '' ? $success_text : esc_html__( 'Success', 'megafactory' );
			$fail = isset( $fail_text ) && $fail_text != '' ? $fail_text : esc_html__( 'Failed', 'megafactory' );
			$output .= '<div class="mc-notice-group" data-success="'. esc_html( $success ) .'" data-fail="'. esc_html( $fail ) .'">';
				$output .= '<span class="mc-notice-msg"></span>';
			$output .= '</div><!-- .mc-notice-group -->';
			
		$output .= '</div><!-- .mailchimp-wrapper -->';

		return $output;
	}
}

function megafactory_get_mcapi(){
	$megafactory_option = get_option( 'megafactory_options' );
	$mc_api_key = isset( $megafactory_option['mailchimp-api'] ) ? $megafactory_option['mailchimp-api'] : '';

	$mcapi = '';
	if( class_exists( "MCAPI" ) ){
		$mcapi = new MCAPI( $mc_api_key );
	}
	
	return $mcapi;
}

function megafactory_get_mailchimp_list_ids(){

	$megafactory_option = get_option( 'megafactory_options' );
	$mc_api_key = isset( $megafactory_option['mailchimp-api'] ) ? $megafactory_option['mailchimp-api'] : '';

	$mcapi = megafactory_get_mcapi();
	$mc_lists = $mcapi ? $mcapi->lists() : '';
	
	$r_mc_lists = array();
	if( isset( $mc_lists['data'] ) ){
		foreach( $mc_lists['data'] as $key => $value ){
			$r_mc_lists[ $value['name'] ] = $value['id'];
		}
	}
	return $r_mc_lists; 
	
}

if( ! function_exists('megafactory_vc_mailchimp') ) {
	function megafactory_vc_mailchimp(){

		$nonce = $_POST['nonce'];
	  
		if ( ! wp_verify_nonce( $nonce, 'megafactory-mailchimp' ) )
			die ( esc_html__( 'Busted', 'megafactory' ) );
			
		if( isset( $_POST['mc_email'] ) && $_POST['mc_email'] != '' ){
			$email = esc_attr( $_POST['mc_email'] );
			$first_name = isset( $_POST['mc_first_name'] ) && $_POST['mc_first_name'] != '' ? esc_attr( $_POST['mc_first_name'] ) : '';
			$last_name = isset( $_POST['mc_last_name'] ) && $_POST['mc_last_name'] != '' ? esc_attr( $_POST['mc_last_name'] ) : '';
			$list_id = isset( $_POST['mc_list_id'] ) && $_POST['mc_list_id'] != '' ? esc_attr( $_POST['mc_list_id'] ) : '';
			
			$mcapi = megafactory_get_mcapi();
			
			$merge_vars = array();
			$merge_vars['FNAME'] = $first_name;
			$merge_vars['LNAME'] = $last_name;
			
			$subscribed = $mcapi->listSubscribe( $list_id, $email, $merge_vars );
			if ($subscribed != false) {
				echo 'mc_1';
			}else{
				echo 'mc_0';
			}
			
		}
		die();
	}
	add_action('wp_ajax_nopriv_megafactorymc', 'megafactory_vc_mailchimp');
	add_action('wp_ajax_megafactorymc', 'megafactory_vc_mailchimp');
}

if ( ! function_exists( "megafactory_vc_mailchimp_shortcode_map" ) ) {
	function megafactory_vc_mailchimp_shortcode_map() {
				
		vc_map( 
			array(
				"name"					=> esc_html__( "Mailchimp", "megafactory" ),
				"description"			=> esc_html__( "AJAX mailchimp.", "megafactory" ),
				"base"					=> "megafactory_vc_mailchimp",
				"category"				=> esc_html__( "Shortcodes", "megafactory" ),
				"mailchimp"					=> "zozo-vc-mailchimp",
				"params"				=> array(
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Extra Class", "megafactory" ),
						"param_name"	=> "extra_class",
						"value" 		=> "",
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Title", "megafactory" ),
						"param_name"	=> "title",
						"value" 		=> ""
					),
					array(
						"type"			=> "animation_style",
						"heading"		=> esc_html__( "Animation Style", "megafactory" ),
						"description"	=> esc_html__( "Choose your animation style.", "megafactory" ),
						"param_name"	=> "animation",
						'admin_label'	=> false,
                		'weight'		=> 0,
					),
					array(
						"type"			=> "colorpicker",
						"heading"		=> esc_html__( "Font Color", "megafactory" ),
						"description"	=> esc_html__( "Here you can put the font color.", "megafactory" ),
						"param_name"	=> "font_color",
						"group"			=> esc_html__( "Layouts", "megafactory" )
					),
					array(
						"type"			=> "img_select",
						"heading"		=> esc_html__( "Mailchimp Layout", "megafactory" ),
						"param_name"	=> "mailchimp_layout",
						"img_lists" => array ( 
							"1"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/services/1.png",
							"2"	=> MEGAFACTORY_ADMIN_URL . "/assets/images/services/2.png"
						),
						"default"		=> "1",
						"group"			=> esc_html__( "Mailchimp", "megafactory" )
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Select a Mailing List", "megafactory" ),
						"description" 	=> esc_html__( "This mailchimp list's showing by given mailchimp api key from theme options.", "megafactory" ),
						"value" 		=> megafactory_get_mailchimp_list_ids(),
						"param_name" 	=> "mailchimp_list",
						"group"			=> esc_html__( "Mailchimp", "megafactory" ),
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Signup Button Style", "megafactory" ),
						"description" 	=> esc_html__( "This is option for mailchimp button style.", "megafactory" ),
						"value" 		=> array(
							esc_html__( "Only Text", "megafactory" ) 	=> "text",
							esc_html__( "Only Icon", "megafactory" ) 	=> "icon",
							esc_html__( "Text with Icon", "megafactory" ) => "text-icon",
						),
						"param_name" 	=> "button_style",
						"group"			=> esc_html__( "Mailchimp", "megafactory" ),
					),		
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Signup Button Text", "megafactory" ),
						"description"		=> esc_html__( "This is the option for mailchimp singup button text. If no text need, then leave it empty.", "megafactory" ),
						"param_name"	=> "button_text",
						"value" 		=> "",
						"group"			=> esc_html__( "Mailchimp", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Placeholder Text", "megafactory" ),
						"description"		=> esc_html__( "This is for placeholder text.", "megafactory" ),
						"param_name"	=> "placeholder",
						"value" 		=> "",
						"group"			=> esc_html__( "Mailchimp", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "First Name Field", "megafactory" ),
						"description"	=> esc_html__( "This is option for collect first name.", "megafactory" ),
						"param_name"	=> "first_name",
						"value"			=> "off",
						"group"			=> esc_html__( "Mailchimp", "megafactory" )
					),
					array(
						"type"			=> "switch_bit",
						"heading"		=> esc_html__( "Last Name Field", "megafactory" ),
						"description"	=> esc_html__( "This is option for collect last name.", "megafactory" ),
						"param_name"	=> "last_name",
						"value"			=> "off",
						"group"			=> esc_html__( "Mailchimp", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Sub Title", "megafactory" ),
						"description"	=> esc_html__( "This subtitle text show below of mailchimp title.", "megafactory" ),
						"param_name"	=> "sub_title",
						"value" 		=> "",
						"group"			=> esc_html__( "Mailchimp", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Success Text", "megafactory" ),
						"description"	=> esc_html__( "This success message text for mailchimp.", "megafactory" ),
						"param_name"	=> "success_text",
						"value" 		=> "",
						"group"			=> esc_html__( "Mailchimp", "megafactory" )
					),
					array(
						"type"			=> "textfield",
						"heading"		=> esc_html__( "Failed Text", "megafactory" ),
						"description"	=> esc_html__( "This failed message text for mailchimp.", "megafactory" ),
						"param_name"	=> "fail_text",
						"value" 		=> "",
						"group"			=> esc_html__( "Mailchimp", "megafactory" )
					),
				)
			) 
		);
	}
}
add_action( "vc_before_init", "megafactory_vc_mailchimp_shortcode_map" );