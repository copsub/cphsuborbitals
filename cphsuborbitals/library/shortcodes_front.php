<?php 

if ( ! class_exists ( 'CphSuborbitalShortcodes' ) ) {

class CphSuborbitalShortcodes {
    
	function __construct() {
        add_shortcode( 'youtube',  array( $this, 'embed_youtube_func' ) );
    }
 
	function embed_youtube_func( $atts ) {
		extract( shortcode_atts( array(
			'id' => ''
		), $atts ) );
		
			return $id;
	}
  }
}

$shortCodes = new CphSuborbitalShortcodes();

