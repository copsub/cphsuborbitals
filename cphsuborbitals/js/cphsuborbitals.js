
( function($) {

    var detectUnit = ( function() {
		var ua = navigator.userAgent;
		if ( /ipad/gi.test(ua) ) {
			$('body').addClass('ipad');
		}
	})();

    // twitter widget
    !function(d,s,id){
	var js,
	fjs=d.getElementsByTagName(s)[0];
	if( !d.getElementById(id) ){
	js=d.createElement(s);
	js.id=id;
	js.src="//platform.twitter.com/widgets.js";
	fjs.parentNode.insertBefore(js,fjs);
	}}(document,"script","twitter-wjs");
	

 	var PlayYoutubeFrontpage = ( function() {
		
		$('body.home').on( 'click', 'span.video', function() {
			var video_id = $(this).data('video');
			window.location = 'http://' + location.host + '/ressources/video/#'+video_id;
		});
		
		if ( location.hash && $('body.video').length > 0 )  {
			
			var timer = setInterval( function() {
				
				if ( $('.video_container').length > 0 ) {
					
					clearInterval( timer );
				
					var 
					youtube_id       =  location.hash.substring(1),
					video_pos        =  $('.'+youtube_id).offset().top;
					video_container  =  $('.entry-content').find('.' + youtube_id ), 
					youtube_embed    =  '<div class="video" class="play video clr"><span id="'+youtube_id+'"></span></div>';

					$('a.play.video').empty().text('Watch video').append('<span />');
					$('.entry-content').find('div.video').remove();
					video_container.append( youtube_embed );
	
					$('html, body').animate( { scrollTop: video_pos - 20 }, 500, function() {
						PlayYoutube( youtube_id );
					});
			   }
		
		  }, 60 );

		}
		
	})();

	 



	
	// youtube videos frontpage
	if ( $('body.home').length > 0 ) {
		//cphSubOrbiGeneral.youtubeVideosFrontpage();
	}
				
    
	// inserts alt text from image on single posts	
    if ( $('body').attr('class').indexOf('single-format-standard') >= 0 || $('body').attr('class').indexOf('page-child') >= 0 ) {
		//cphSubOrbiGeneral.addTitleAfterImage();
	}
	
//	cphSubOrbiGeneral.general();
//	cphSubOrbiGeneral.copSubOrbSupport();
//	cphSubOrbiGeneral.memberShip();
	
})(jQuery);