$(document).ready(function(){
	
<!-- Responsive -->

$(document).ready(function(){
	windowResize();
	window.onresize = function(event) {
		windowResize();
	}
})

$('#cast_tab').click(function(){windowResize();})

function windowResize() {
	$('#gallery_content').css("height",($("#gallery_content").width() * 0.5625));
	$('.bios_image_content').css("height",($(window).width() * 0.5625));
};

<!-- Swipe navigation -->

	$('.swipe').wipetouch({
		wipeLeft: function(result) { $('.next').click();},
		wipeRight: function(result) { $('.prev').click();},
	});

	window.addEventListener("load",function() {
	    setTimeout(function(){
	        window.scrollTo(0, 1);
	    }, 0);
	});
	
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
	
	$('div#slideshow_container .arrow').click(function(e){
		
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
	
	$('div#bios_image_container .arrow').click(function(e){
		
		var activeImage	= $('.bios_image.active');
		var nextImage;
		if($(this).hasClass('prev')){
			
			///SHOW PREVIOUS
			if(activeImage.hasClass('first')){
				nextImage = $('.bios_image.last');
				
			}else{
				nextImage = activeImage.prev();
				
			}
			
		}else{
			///SHOW NEXT
			
			if(activeImage.hasClass('last')){
				nextImage = $('.bios_image.first');

			}else{
				nextImage = activeImage.next();
				
			}
			
		}
		
		activeImage.fadeOut(function(){
			$(this).removeClass('active');
			var activeName = $(this).attr('data-name');
			$('div#bios_text_container div.'+activeName).removeClass('active');
			
		});
		nextImage.fadeIn(function(){
			$(this).addClass('active');
			var nextName = $(this).attr('data-name');
			//$('div#bios_text_container div.'+nextName).fadeIn(function(){
			//	$(this).addClass('active');
			//});
			$('div#bios_text_container div.'+nextName).addClass('active');
			
			
			
		});
		
		
		
	});
	
});