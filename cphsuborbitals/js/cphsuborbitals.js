
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

	 

	var cphSubOrbiGeneral = ( function() {
		
		var a = {};
		
// 		a.general = function() {
// 			
// 			$('.download_file :last').addClass('last');
// 
// 			// Køb knap webshop
// 			$('input.wpsc-buy-now-button').attr({
// 				'src'  : '/wp_blog/wp_content/themes/cphsuborbitals/img/webshop_btn.png', 
// 			    'alt'  : 'Click her to pay'
// 			}).css({
// 				'background'  : '#000',
// 				'color'       : '#fff',
// 				'width'       : '140px',
// 				'height'      : '36px',
// 				'line-height' : '36px'
// 			}).addClass('clr')
// 			.show();
//            
// 		   setTimeout(function() {
//            $('#dgx-type-selector').addClass('clr');			
// 		   }, 400 );
// 
// 		}
		
// 		a.copSubOrbSupport = function() {
// 			setTimeout( function() {
// 				var amount = $('input[name="_dgx_donate_amount"]');
// 				amount.each( function(i,a) {
// 					
// 					/*$(a).wrap('<label />').attr({
// 						'class': 'sdds'
// 					});*/
// 				});
// 				
// 			}, 300 );
// 		}
		
// 		a.themeSettings = function() {
// 			
// 			$('ul.footer-menu li:last').addClass('last');
// 			
// 			// special settings picture gallery
// 			if ( $('body.picture-gallery').length > 0 ) {
// 				var picasa_timer = setInterval( function() {
// 					if ( $('.picasagallery_album').length > 0 ) {
// 						clearInterval( picasa_timer );
// 						$('.picasagallery_album').addClass('equal-height-picasa');
// 						setEqualHeight( $('.equal-height-picasa') );
// 					}
// 				}, 100 );
// 			}
// 			
// 	    };
// 	    

	   
	   a.addTitleAfterImage = function() {
		  
		   var img = $('.entry-content img');
			 
			if ( img ) {  
		   
			   img.each( function() {
				   var 
				   self      = $(this),
				   altText   = self.attr('alt'),
				   img_width = self.data('w'); 
				   
				   if ( altText ) {
					   var 
					   wrapper = $('<div />').attr({ 'class': 'img-wrapper clr' }).css({ 'width': '100%', 'max-width': img_width }),
					   text    = $('<span class="img-text clr" style="width:100%; max-width:'+img_width+'" />').append( altText );
					   
					   self.wrap( wrapper );
					   self.parent().append( text );
				   }
				   
			   });
		   }
	   }
	   	


	
		a.youtubeVideosFrontpage = function() {
			
				var 
				index_start = 1,
				max_results = 3,
				orderby = 'published';
				
				var
				orderby      = 'published',
				channel_user = 'CphSuborbitals',
				channel_url  = 'http://gdata.youtube.com/feeds/api/users/'
				+channel_user+'/uploads?start-index='+index_start
				+'&max-results='+max_results
				+'&orderby='+orderby
				+'&alt=json';
				
				$.getJSON( channel_url, function( data ) {
					
					$.each( data.feed.entry, function( i, item ) {
						
						var
						title         =  item['title']['$t'],
						descr         =  item['content']['$t'],
						thumb         =  item.media$group.media$thumbnail[0].url,
						publish_date  =  item['published']['$t'],
						publish_date  =  new Date( publish_date ).toLocaleDateString(),
						video_id      =  item.id['$t'].match(/\/videos.*/).toString().replace(/\/videos\//, '');
						
						publish_date  =  publish_date.replace( /(^\d{1}?\/)/g,'0$1' );
						publish_date  =  publish_date.replace( /(^\d{2}?\/)(\d{1}?\/)/g,'$10$2' );
						
						var videos = 
						'<div class="youtube clr">'
						+ '<div><img src="'+thumb+'"><span data-video="'+video_id+'" class="video"></span></div>'
						+ '<div>'
						+ '<span class="date">'+publish_date.replace(/\//g,'.')+'</span>'
						+ '<h4>'+title+'</h4>'
						+ descr 
						+ '</div></div>';
						
						$('.latest_youtube').append(videos);
						
				   });
				});
		  };




	a.memberShip = function() {
		$('form#loginform input').attr('size','');
		$('form.wpsc_checkout_forms input').attr('size','');
	}

		
	return a;
		
	
	})();

	
	// youtube videos frontpage
	if ( $('body.home').length > 0 ) {
		cphSubOrbiGeneral.youtubeVideosFrontpage();
	}
				
    
	// inserts alt text from image on single posts	
    if ( $('body').attr('class').indexOf('single-format-standard') >= 0 || $('body').attr('class').indexOf('page-child') >= 0 ) {
		//cphSubOrbiGeneral.addTitleAfterImage();
	}
	
	cphSubOrbiGeneral.general();
	cphSubOrbiGeneral.copSubOrbSupport();
	cphSubOrbiGeneral.memberShip();
	
})(jQuery);