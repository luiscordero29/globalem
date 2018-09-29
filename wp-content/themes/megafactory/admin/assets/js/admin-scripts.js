(function( $ ) {
	"use strict";

	jQuery( document ).ready(function() {

		$(".megafactory-post-featured-status").change(function(){
												 
			var postid = $(this).attr('data-post');
			var stat;
			if( $(this).is( ":checked" ) ) {
				stat = 1;
			}else{
				stat = 0;
			}
			$( "#post-featured-stat-msg-" + postid ).text( megafactory_admin_ajax_var.process + "..." );
			if( postid ){
				// Ajax call
				$.ajax({
					type: "post",
					url: megafactory_admin_ajax_var.admin_ajax_url,
					data: "action=megafactory-post-featured-active&nonce="+megafactory_admin_ajax_var.featured_nonce+"&featured-stat="+ stat +"&postid="+ postid,
					success: function(data){
						$( "#post-featured-stat-msg-"+ postid ).text( "" );
					}
				});
			}
		});
		
		$( ".export-custom-sidebar" ).click(function() {
			// Ajax call
			$.ajax({
				type: "post",
				url: megafactory_admin_ajax_var.admin_ajax_url,
				data: "action=megafactory-custom-sidebar-export&nonce="+megafactory_admin_ajax_var.sidebar_nounce,
				success: function( data ){
					
					$("<a />", {
						"download": "custom-sidebars.json",
						"href" : "data:application/json," + encodeURIComponent( data )
					}).appendTo("body").click(function() {
						$(this).remove();
					})[0].click();
					
				}
			});
			return false;
		});
		
		if( $( '#import-code-value' ).length ){
			$( '#redux-import' ).click(
				function( e ) {
					$( '#redux-import' ).attr( "disabled", "disabled" );
					if ( $( '#import-code-value' ).val() === "" && $( '#import-link-value' ).val() === "" ) {
						e.preventDefault();
						return false;
					}else{
						var json_data = '';
						var stat = '';
						if( $( '#import-code-value' ).val() != "" ){
							json_data = $( '#import-code-value' ).val();
							stat = 'data';
						}else if( $( '#import-link-value' ).val() != "" ){
							json_data = $( '#import-link-value' ).val()
							stat = 'url';
						}
						var post_data = { action: "megafactory-redux-themeopt-import", nonce: megafactory_admin_ajax_var.redux_themeopt_import, json_data : json_data, stat: stat };
						jQuery.post(megafactory_admin_ajax_var.admin_ajax_url, post_data, function( response ) {
							location.reload(true);
							$( '#redux-import' ).removeAttr( "disabled" );
						});
						
						return false;
					}
				}
			);
		}
	
	});
	
})(jQuery);

