<?php

if ( ! class_exists ( 'CphSuborbitalShortcodes' ) ) {
	
	class tinyMCEButtons {
		
		function __construct() {
			add_action( 'init',  array( $this, 'addTinyMCEButtons' ) );
		}
		
		function addTinyMCEButtons() {
			add_filter( 'mce_external_plugins', array( $this, 'wptuts_add_buttons' ) );
			add_filter( 'mce_buttons', array( $this, 'wptuts_register_buttons' ) );
		}
		
		function wptuts_add_buttons( $plugin_array ) {
			$plugin_array['wptuts'] =  trailingslashit( CHILD_THEME_URI ) . 'editor-buttons/wptuts-plugin.js';
			return $plugin_array;
		}
		
		function wptuts_register_buttons( $buttons ) {
			array_push( $buttons, 'dropcap', 'youtube' ); // dropcap', 'recentposts
			return $buttons;
		}
		
	}
}

$tinyMCEButtons = new tinyMCEButtons();


?>