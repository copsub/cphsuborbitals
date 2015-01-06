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
		
			$youtube  = '<div class="video">';
			$youtube .= '<iframe style="background:#fff;" src="//www.youtube.com/embed/' . $id . '?rel=0&showinfo=0&wmode=opaque"';
			$youtube .= ' width="100%" height="100%" frameborder="0">';
			$youtube .= '</iframe></div>';
	
		return $youtube;
	}
  }
}

$shortCodes = new CphSuborbitalShortcodes();

