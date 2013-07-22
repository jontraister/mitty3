function forceRedraw(el){

	el.style.display='none';
	el.offsetHeight;
	el.style.display='block';
	
}


var isOpera = !!(window.opera && window.opera.version);  // Opera 8.0+
var isFirefox = testCSS('MozBoxSizing');                 // FF 0.8+
var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
    // At least Safari 3+: "[object HTMLElementConstructor]"
var isChrome = !isSafari && testCSS('WebkitTransform');  // Chrome 1+
var isIE = /*@cc_on!@*/false || testCSS('msTransform');  // At least IE6

function testCSS(prop) {
    return prop in document.documentElement.style;
}
function downgradeVideo(){
	var video = $('#iframe_container iframe');
	var src 	= video.attr('src');
	src 		= src.replace('hd1080','hd720');
	
	video.attr('src',src);	
}
var isIPad = navigator.userAgent.match(/iPad/i) != null;

  
  
function doBackgroundSizeFallback(){

/*TODO FALLBACK
	$('.slideshow_image').each(function(){
	
		$(this).css('background-size','cover');
		
	});
	
*/
}
function responsiveVideoSize(){
	
	
    // The element that is fluid width
    $fluidEl = $("#trailer_content");
    $target	 = $('.ytVideo');

		$target
			.data('aspectRatio',  $target.height() /  $target.width())
			
			// and remove the hard coded width/height
			.removeAttr('height')
			.removeAttr('width');

		var newWidth = $fluidEl.width();
		$('#iframe_container').width(newWidth);
		// Resize all videos according to their own aspect ratio
	
		$target
			.width(newWidth)
			.height(newWidth * $target.data('aspectRatio'));
		
			
	
	
}



$(document).ready(function(){
	if(isIPad){
		downgradeVideo();
	
	}
	
	//CG:
	//Load up YouTube tracker..
	$(window).load(function(){
		ytfn();
		onYouTubeIframeAPIReady();

	});
	
	
	
	$('html').addClass('mobile');
	
	$('.story_text,#wrapper').hide();
	
	
	var SV 							= 	 [];
	SV.isWebkit						= 	 false;
	
	if(isChrome || isSafari || isOpera){
		
		SV.isWebkit = true;
		
	}
		
	SV.portraitSwitchWidth			=    730;
	SV.isIE8						=    false;
	SV.LightboxOpen					= 	 true;
	SV.GalleryOpen					=  	 false;
	SV.aspectRatio     				=    0;			
	SV.trailerEmbed 				=    '<iframe class="ytVideo" width="853" height="480" src="http://www.youtube.com/embed/WI3rlRHVrTQ?rel=0&vq=hd1080&autoplay=1&wmode=transparent" frameborder="0" allowfullscreen></iframe>';
	
	SV.isPhone = false;
	
	if( /Android|webOS|BlackBerry/i.test(navigator.userAgent) ) {
			SV.isPhone = true;
			SV.portraitSwitchWidth = 900;
	}

	if($('html.audio').length){
		
		SV.hasAudio 				=   true;
		
	}else{
	
		SV.hasAudio					=   false;
		$('#audio_icon').remove();
		
	}
	SV.isTouch 						= 	false;
	if(!$('html.no-touch').length){
		
		SV.isTouch   				=   true;
		
	}
	
	function checkAspectRatio(){
		///  console.log(SV.aspectRatio);
		SV.aspectRatio 			=   SV.WW/SV.WH;
		                        
		if(SV.aspectRatio <= 1.3 && SV.isMobile == false && SV.WH >= 860 ){
		
			$('#mobile_logos').addClass('portrait');
			////vertically align logos
			
			var containerHeight  		= $('#main_image_container').height();
	
			var leftOverSpace		    = containerHeight - $('#main_image').height();
			if(leftOverSpace <= 200){
				
				$('#epic_logo').addClass('shrink');
			}else{
				
				$('#epic_logo').removeClass('shrink');
			}
			$('#mobile_logos').css({
				height: leftOverSpace + 'px'
				
			});
			$('#epic_logo').css({
				maxHeight:leftOverSpace - 26+'px'
				
			});
				
			////end vertically align logos
			$('#bottom_logo_containers').hide();
					
		}else if(!SV.isMobile){
		
			$('#mobile_logos').removeClass('portrait');
			$('#bottom_logo_containers').show();
			$('#mobile_logos').css({
				height: 'auto'
					
			});
			$('#epic_logo').css('max-height','auto');
		}else{
			$('#mobile_logos').removeClass('portrait');
			$('#mobile_logos').css({
					height:'auto'
					
			});
			$('#epic_logo').css('max-height','auto');
		}
		
		
		if(SV.aspectRatio >= 2.2 && SV.WH <= 800 && !SV.isTouch){
			$('body').removeClass('square');
			$('body').addClass('super_wide');
		}else{
			$('body').removeClass('super_wide square');
			
		}
		
		if(SV.aspectRatio >= 1.8 && SV.aspectRatio < 1.94){
			///widescreen mode
/*
			SV.wideScreen 			=   true;
			$('body').addClass('wide_screen');
			
			$('#bottom_logo_containers').css({
				width: $('#main_image').width() +'px'
				
			});
			$('body').removeClass('square')
*/
/*
			$('#left_logo_container img').css({
			
				left:$('#left_logo_container img').css('')	
				
			});	
*/	
		}else{
			SV.wideScreen			= 	false;
			$('body').removeClass('wide_screen square');
			$('#main_image').show();
			$('#bottom_logo_containers').css({
				width:'100%'
				
			});
			
			
			if(SV.aspectRatio <= 1.4 && SV.WH >= 800){
				
				//square ish
				$('body').addClass('square');

			}else{
				$('body').removeClass('square');
				
			}
			
		}
		var leftLogo = $('#left_logo');
		var rightLogo = $('#right_logo');
		if(SV.aspectRatio >= 1.8){
			///CHANGE LAYOUT TO NEVER CROP
			if(!SV.isMobile){
				$('#bottom_logo_containers').css({
					width: $('#main_image').width() +'px',
					left:'50%',	
					marginLeft:	 $('#main_image').width()/2*-1+'px'		
				
				});
				$('body').addClass('never_crop');
				
			}
			
	
		}else{
			$('#bottom_logo_containers').css({
				width:'100%',
				left:0,	
				marginLeft:0	
				
			});
			$('body').removeClass('never_crop');
		
		}
		
		
		
		
	}
	
		
		
	
		$(window).load(function(){
			if(SV.isTouch){
				 setTimeout(function(){
				 // Hide the address bar!
				  window.scrollTo(0, 1);
				  }, 50);
			  }
			$('#main_nav').fadeIn();
		
	
			checkAspectRatio();
			
			windowResize();
		});
	
	SV.imageSize    = 'large';
	SV.imageFolder	= './images';

	function setImageSize(){

		var folder;
		if(SV.WW <= 480 && SV.WW > 0){
			SV.imageSize 	= 'small';
			
		}else if(SV.WW <= 959){
			SV.imageSize  	= 'medium';
			
		}else if(SV.WW <= 1600){
			
			SV.imageSize 	= 'large';
			
		}else{
			SV.imageSize	= 'giant';
			
		}
		
	}
	var trailerRanOnce = false;
	function setDataFromJSON(){
		data = SV.JSON;
		setImageSize();

		if(!$('body').hasClass(SV.imageSize)){	
			var mainBackground 	= 	data.template.mainBackground;
			mainBackground		=   '<img id="main_image" src="./images/'+SV.imageSize+'/'+mainBackground+'" alt="main_background" />';

			var rightLogo 		= 	data.template.right;
			rightLogo			= 	'<img id="right_logo" src="./images/'+rightLogo+'" alt="Real D 3D" />';
		
			var leftLogo		= 	data.template.left;		
			leftLogo 			= 	'<img id="left_logo" src="./images/'+leftLogo+'" alt="Epic The Movie" />';
		
			var billing			=   data.template.billing;
			billing				= 	'<img id="billing_icon" src="./images/'+billing+'" alt="Billing Info" />';
			
			
			$('#billing_image_container').html(billing);	
			$('#image_load_here').html(mainBackground);
			
			$('#wrapper').fadeIn(function(){
				$('#main_image').fadeIn(2000,function(){
					
/*
					if(!SV.isMobile && !trailerRanOnce){
					
						$('#trailer').trigger('click');	
						trailerRanOnce = true;
					}
*/

				});
				
			});
			
			//$('#bottom_logo_containers').html(logos).fadeIn(2000);
			//slides
			var slides		 	= 	data.slides;
			SV.slideCount		= 	slides.length;
			var i 				= 	1;
			var html			=  '';
			while(SV.slideCount >= i){
				var slideUrl  	=  slides[i];
				var classToAdd 	=  '';
				if(i == 1){
					classToAdd 	=  'first active';
					
				}else if(i == SV.slideCount){
					classToAdd 	=  'last';
					
				}
				html  	   		+= '<div id="'+slideUrl+'" style="background-image: url(./images/gallery/'+SV.imageSize+'/'+slideUrl+');" class="slideshow_image '+classToAdd+'"></div>';				
				i++;
				
			}
			$('#slides').html(html);
			
			if(SV.isIE8){
				
				//doBackgroundSizeFallback();
			}
			$('body').removeClass('large medium small giant');			
			$('body').addClass(SV.imageSize);
		}
		
		$('#main_image').bind('dragstart', function(event) { event.preventDefault(); });
	}	
		
	var audioPlayer 	= 	$('#background_music_player')[0];
	var stepTime		= 	50;
	var increment		= 	.1;
	volume				= 	0;
	
	function playPauseAudio(onOrOff){
		
		if(onOrOff == 'on'){
			
			$('#audio_icon').addClass('on');
			audioPlayer.play();
			
			function turnUp(){
				
				volume += increment;
				
				volume = Math.round(volume * 10) / 10; 
				
				
				
				if(volume < 1){	
					audioPlayer.volume = volume;
					setTimeout(function(){turnUp()},stepTime);	
						
				}
			}	
			turnUp();
			
		}else{
			
			$('#audio_icon').removeClass('on');
			volume 			= 1;
			function turnDown(){
				volume 				-= increment;
				volume 				=  Math.round(volume * 10) / 10; // 4.6
				
				
				
				if(volume > 0){	
					audioPlayer.volume 	= volume;
					setTimeout(function(){turnDown()},stepTime);		
				}else{
					audioPlayer.pause();
				}
			}	
			turnDown();

			
			
			
			
		}
		
		
		
	}
	$('#audio_icon').click(function(){
		
		if($(this).hasClass('on')){
			//turn audio off
			$.cookie('audio_on', false);
			playPauseAudio('off');
			
			
		}else{
			//turn audio on
			$.cookie('audio_on', true);
			playPauseAudio('on');
			
		}
		
	});		

	function centerActiveContent(){
		var el      	= 	$('.lightbox_content.active');
		var height  	= 	el.outerHeight();	
		
		if(!el.find('iframe').length){
	
			el.css({
				marginTop:(height/2)*-1+'px',	
				top:'50%'
			});
			
		}else{
			height = $('#iframe_container iframe').height();
			el.css({
				marginTop:(height/2)*-1+'px',	
				top:'50%'
			});
			
		}
		
	}
	
	$('#social_media_links ul li').click(function(){
	
		var id = $(this).attr('id');
		if(id == 'youtube'){
			
			dataLayer.push({'eventLabel': 'YouTube Channel', 'event':'exitSite'})
			
		}else if(id == 'facebook'){
			dataLayer.push({'eventLabel': 'Facebook Page','event':'exitSite'})
			
		}else if(id == 'twitter'){
			
			dataLayer.push({'eventLabel': 'Twitter','event':'exitSite'})
		}
		
		
	});
	
	var socialMediaLinks = $('#social_media_links ul').clone();
	SV.layoutMemory;
	function toggleMobile(isMobile){
			
		if(isMobile){
			
			
			SV.layoutMemory = 'mobile';
			SV.isMobile = true;
			$('header').hide();
			$('body').addClass('is_mobile');
			$('#social_media_links').fadeOut();
			var html = $('#story_content .text').html();
			$('#mobile_content .story_text').html(html);
			$('.mobile.social_content').html(socialMediaLinks);
			$('#billing').prependTo('#footer_content');
			
		}else{
			if(SV.layoutMemory == 'mobile'){
				
				//ytfn();
				//ytStop();
			}
			SV.layoutMemory = 'desktop';
			SV.isMobile = false;
			$('header').show();
			$('body').removeClass('is_mobile');
			$('#social_media_links').fadeIn();
			$('#story').show();
			$('#mobile_content .story_text').html('');
			$('.mobile.social_content').html('');
			$('#billing').appendTo('#footer_content');
			
		}
		
	}	
	
	function toggleAudio(){

		if(!SV.isMobile && SV.hasAudio){
				
			if($.cookie('audio_on')){
			
				if($.cookie('audio_on') == 'false'){
					
					playPauseAudio('off');
					
				}else{
					
					playPauseAudio('on');
						
				}
				
			}
			else{
			
				playPauseAudio('on');
			}
		}	
		
		
	}
	
	var stopVideotimeout;
	function hideLightBox(){
	
		if(!SV.isMobile){
			
			windowResize();
			var timeout = setTimeout(function(){windowResize()},2000);
		
		}
		
		
		
	

		if($('#trailer_content').hasClass('active')){
				
			if(!SV.isMobile){
			
				
				ytStop();
				
			}else{
				
				//CG:
				//stopVideotimeout = setTimeout(function(){playerArray[0].stopVideo();}, 2000);
				$('.ytVideo').remove();
				
			}
			toggleAudio();
		}else{
			dataLayer.push({
			'pageName':'/',
			'event':'pageView'
		});
			
		}
		var time = 0;
		if(SV.isMobile){
			time  = 2000;
		
		}
		
			
		$('#main_nav li.active, .lightbox_content.active').removeClass('active');
		
		
		$('.lightbox_content').fadeOut();
		$('#lightbox_overlay').fadeOut();
		SV.LightboxOpen = false;
	
	}
		
	

	var ranOnce 		= false;	
	var hd				= '&hd=1';
	var autoPlay		= '&autoplay=1';

	
	function windowResize(){
		///FIX WEBKIT SPECIFIC BUG WHEN Swithing CSS with Javascript
		//Force redraw on windowResize in webkit
		if(SV.isWebkit){
		
			forceRedraw(document.getElementById('left_logo'));
			
		}
		
		SV.WW						=	$(window).width();
		SV.WH						=	$(window).height();
		
		checkAspectRatio();
		setDataFromJSON();	
	
		if(SV.WW <= SV.portraitSwitchWidth){
			///START MOBILE
			//CG:
			//Check to see if Desktop ytVideo is rendered
			if($('.ytVideo').length > 0) {
				$('.ytVideo').remove();					
			}	
			
			$('html').addClass('mobile');
			if(SV.WW <= 446){
			
				$('#mobile_logos').addClass('squish');

			}else{
		
				$('#mobile_logos').removeClass('squish');		
			
			}
			///IS MOBILE
			toggleMobile(true);
		
			if(SV.LightboxOpen){
			
				hideLightBox();

			}

		}else{
			///START DESKTOP
			
			//CG:
			//Add ytVideo if it doesn't exist;
			if($('.ytVideo').length == 0) {
				$('.m-ytVideo').remove();
				SV.trailerEmbed = SV.trailerEmbed.replace('autoplay=1','');
				$('#iframe_container .close_x').after(SV.trailerEmbed);
				
				//CG:
			
				//Reload YouTube Tracker
				
				ytfn();
				onYouTubeIframeAPIReady();
			}

			responsiveVideoSize();
			$('html').removeClass('mobile');
			$('.story_text').hide();
			
			//NOT MOBILE
			toggleMobile(false);
			SV.HeaderHeight				=   $('header').outerHeight();
			SV.FooterHeight				=   $('footer').outerHeight();
		
			SV.FooterOffset				= 	parseInt($('footer').css('bottom'));
			SV.MainContentHeight		=   SV.WH - (SV.HeaderHeight + SV.FooterHeight + SV.FooterOffset);	
		
			$('#main_content').css({
				height: SV.MainContentHeight + 'px'			
			});
			
			if(SV.LightboxOpen && !SV.GalleryOpen){
				
				centerActiveContent();		
			}


			

						
		}

						
	}
	
	$(window).resize(function(){
		windowResize();
	});
	
	
	$.getJSON('./files/json/images.json', function(data) {
	  	SV.JSON = data;
	  	
		windowResize();  	
	});	

	
	SV.trailerIsPlaying = true;;

	function showContent(el){
		
		var id 	= el.attr('id');
		
		
		if(id != 'trailer' && SV.trailerIsPlaying){
			toggleAudio();
			ytStop();
			SV.trailerIsPlaying = false;
		}
		
		
		if(id == 'gallery'){
			
			var firstImage = $('.slideshow_image.first').attr('id');
			
			dataLayer.push({
				'pageName':'/gallery/'+firstImage,
				'event':'pageView'
			});
			
		}else{
			dataLayer.push({'pageName': '/'+id,'event':'pageView'});
			
		}
		id 		= id+'_content';
		
		
		
		if(id == 'trailer_content'){
			
		 	
			
			
			$('#iframe_container').fadeIn(function(){
				SV.trailerIsPlaying = true;
				ytPlay();
				
			});
			
			/* $('#iframe_container').html(SV.trailerEmbed); */
			
			if($('#audio_icon').hasClass('on')){
				
				playPauseAudio('off');
				
			}
			
		}else{
			
			$('#iframe_container').fadeOut();
						
		}
		
		
		$('#lightbox_overlay').fadeIn();
		$('.lightbox_content').hide().removeClass('active');
			
		if(id == 'gallery_content'){
			
			$('#'+id).show();
		
		}
		
		$('#'+id).fadeIn(function(){
			$(this).addClass('active');
			SV.LightboxOpen = true;
			
			if(id == 'gallery_content'){
				SV.GalleryOpen = true;
				
			}else{
				
				SV.GalleryOpen = false;
				centerActiveContent();
			}
		
		});		 	
			
	}		
	
	$('.close_x,.gallery_close').click(function(){
		
		hideLightBox();
		toggleAudio();
		
	});
	
	$('#lightbox_overlay').click(function(){
		if(!$('#trailer_content').hasClass('active')){
			
			hideLightBox();
		}
				
	});
	

	$('#main_nav li').click(function(){
		if(!$(this).hasClass('active')){
			$('#main_nav li.active').removeClass('active');
			$(this).addClass('active');
			
			showContent($(this));		
			
		}
	});

	$('.arrow').click(function(e){
		
		var activeImage	= $('.slideshow_image.active');
		var nextImage;
		if($(this).hasClass('prev')){
			
			///SHOW PREVIOUS
			if(activeImage.hasClass('first')){
				nextImage = $('.slideshow_image.last');
				
			}else{
				nextImage = activeImage.prev();
				
			}
			
		}else{
			///SHOW NEXT
			
			if(activeImage.hasClass('last')){
				nextImage = $('.slideshow_image.first');

			}else{
				nextImage = activeImage.next();
				
			}
			
		}
		
		activeImage.fadeOut(function(){
			$(this).removeClass('active');
		});
		nextImage.fadeIn(function(){
			$(this).addClass('active');
			
			
			dataLayer.push({'pageName': '/gallery/'+$(this).attr('id'),'event':'pageView'});
			
		});
		
		
		
	});
	
	
	$('.hit_zone').click(function(){
		$(this).next().trigger('click');
		
	});
	
	
	var hoverTimeout;
	var time 			= 200;
	var originalMargin 	= $('footer').css('margin-top');
	var killHover;
	
	function showBilling(){
		$('footer').animate({
			bottom:0
		},function(){
			$('.up_arrow').addClass('down');
			
		});
		
	}
	function hideBilling(){
		
		$('footer').animate({
			bottom:'0'
		},function(){
			$('.up_arrow').removeClass('down');
			
		});
		
	}
	function closeAllOpenTabs(){
	
		$('.open').each(function(){
			var el = $(this);
			el.removeClass('open');
			el.next().slideUp();
			$('#gallery_content').slideUp();
		});		
				
	}	

	$('.mobile_tab').click(function(){
	
		
		
		var attr   		 	=    $(this).attr('id');
		var content;
		var el 				= 	 $(this); 
	
		
		
		if(attr 	== 'gallery_tab'){
			
			content = $('#gallery_content');
			
		}else{
		
			content = el.next();
			
		}		
		
		if(!el.hasClass('open')){
			//open it
				
				closeAllOpenTabs();
				el.addClass('open');
				dataLayer.push({'pageName': '/mobile/'+attr+'','event':'pageView'});
				
				if(attr == 'trailer_tab'){
															
						//$('#mobile_video iframe').remove();	
						
						//CG
						//Added class="m-ytVideo
						//Check if m-ytVideo does not  exisits"
						if($('.m-ytVideo').length == 0) {
							$('#mobile_video').prepend('<iframe class="m-ytVideo" width="385" height="217" src="http://www.youtube.com/embed/WI3rlRHVrTQ" frameborder="0" allowfullscreen></iframe>');
						
							//CG
							//Reload YouTube Tracker - CG: 2/12/13
							ytfn();
							onYouTubeIframeAPIReady();
						}
						
						$('#mobile_video').css({height:$('#mobile_video iframe').height()});
						content.fadeIn(function(){
							
							$('#mobile_video iframe').show();
							$('html,body').animate({scrollTop:el.offset().top });
								
						});
					
					
					

				
				}else{
					
					//$('#mobile_video iframe').remove();	
					if(_playing){
						
						ytStop();
					}	
					content.slideDown(function(){
						
						$('html,body').animate({scrollTop:el.offset().top});
						
					});
				
				}						
				
				
						
				

			
			
		}else{
			//close it
			
			//CG:
			//Stop YouTube video
			if(_playing){
				
				ytStop();
			}	
			
				
			//$('#mobile_video iframe').remove();
			el.removeClass('open');	
			if(attr == 'trailer_tab'){
				
			
				$('#mobile_video iframe').fadeOut(function(){
					
					
					$('#mobile_video').animate({
						height:0
						
					});
				});
				content.slideUp();
			}else{
				content.slideUp();	
				
			}
			content.slideUp(function(){					
				//$('#mobile_video').html('');
				//ytStop();
				
			});
			
		}

	
	});

/*
	var billingOpen = false;
	$('#billing').mouseover(function(){
		showBilling();
		billingOpen = true;
		//clearTimeout(hoverTimeout);
	});
	
	$('#main_content').mouseover(function(e){
		if(!SV.isMobile && billingOpen){
			
			if(SV.WH - e.clientY > 100){
				hideBilling();
				billingOpen = false;
			}
		}
	});
*/
	var buffer =200;
	
	$("#gallery_content").touchwipe({
	     wipeLeft: function() { 
	     	$('.arrow.prev').trigger('click');
		     $('.arrow').fadeOut();
	     },
	     wipeRight: function() { 
	     	$('.arrow.next').trigger('click');
		      $('.arrow').fadeOut();
	     },
		 wipeUp: function() { 
		 	$('html,body').stop().animate({
			 	scrollTop:'-='+buffer+'px'
			 	
		 	});
			 
		 },
	     wipeDown: function() { 
	    	$('html,body').stop().animate({
			 	scrollTop:'+='+buffer+'px'
			 	
		 	});
		     
	     },
	
	     min_move_x: 20,
	     min_move_y: 20
	});	
		
	
	$(document).keydown(function(e){
		var key = e.which;
		if(key == '27'){
			//escape
			hideLightBox();			
		}
		if(SV.GalleryOpen){				
			if(key =='37'){
	
				$('.arrow.prev').trigger('click');	
			}else if(key =='39'){
				$('.arrow.next').trigger('click');
			}				
		}

		
	});
	
	centerActiveContent();
	
	function ipadRedraw(el){	

		$('#epic_logo').hide()
		$('#epic_logo').fadeIn();	
		windowResize();
	}
	function detectIPadOrientation () {  
	
	  	var el = document.getElementById('body');
	    if ( orientation == 0 ) {  
	       ipadRedraw(el);
	    }  
	    else if ( orientation == 90 ) {  
	      ipadRedraw(el);
	    }  
	    else if ( orientation == -90 ) {  
	      ipadRedraw(el);
	    }  
	    else if ( orientation == 180 ) {  
	    	
	    	ipadRedraw(el);
	    }  
	 }
	 window.onorientationchange = detectIPadOrientation;

	
});
