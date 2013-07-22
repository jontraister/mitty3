/* Audio */
var audio = $('#player').get(0);
var wasPaused;
var loaded = false;

function init() {
	
	windowResize();
	
	if(IsAudioEnabled()) {
		
		if(!audio.paused)
			return false;
	
		if((IsPaused() && wasPaused == false) || typeof wasPaused == 'undefined') {
			//enable sound
			audio.play();
			$('#btnAudio').removeClass('muted');
			$('#btnAudio').addClass('unmuted');
		} else if(wasPaused){
			$('#btnAudio').removeClass('unmuted');
			$('#btnAudio').addClass('muted');
		} 
	}

}
		
$(document).keyup(function(e) {
  if (e.keyCode == 27) {
	$('.close').click();
	}
});

$('.nav-tab').on('click',function() {
	if ($('#feedToggle').hasClass('plus-icon')) {
		$('#feedToggle').click();
	}
});

$('.modal img').load(function(){
	windowResize();
});

<!-- Clear YT Player -->

function resetPlayer() {
	ClearPlayer();
	$('.youtube-player').attr('src','');
}

$('.carousel').each(function(){
	$(this).carousel({
		interval: false
	});
});

<!-- Audio-->
function pauseAudio()
{
	$('#btnAudio').removeClass('unmuted');
	$('#btnAudio').addClass('muted');
	audio.pause();
}

function toggleAudio()
{
	if(IsAudioEnabled()) {
	   var btnAudio = $('#btnAudio');

	   if (audio.paused)
	   {
		   btnAudio.removeClass('muted');
		   btnAudio.addClass('unmuted');
		   wasPaused = false;
		   audio.play();
	   } else if (!audio.paused){
		   btnAudio.removeClass('unmuted');
		   btnAudio.addClass('muted');
		   wasPaused = true;
		   audio.pause();
	   }
	}
}


<!-- Button Toggles -->

$('#feedContainer').on('show', function() {
   $('#feedToggle').removeClass('plus-icon').addClass('minus-icon');
});
$('#feedContainer').on('hide', function() {
   $('#feedToggle').removeClass('minus-icon').addClass('plus-icon');
});

$('#ticketsContainer').on('show', function() {
   $('#ticketsToggle').removeClass('plus-icon').addClass('minus-icon');
});
$('#ticketsContainer').on('hide', function() {
   $('#ticketsToggle').removeClass('minus-icon').addClass('plus-icon');
});

$('#language').on('show', function() {
   $('#languageToggle').removeClass('down-icon').addClass('up-icon');
   $('#language').css('bottom','59px');
});
$('#language').on('hide', function() {
   $('#languageToggle').removeClass('up-icon').addClass('down-icon');
   setTimeout( function(){
	$('#language').css('bottom','');
   },300);
});

$('#billing').on('show', function() {
   $('#billingToggle').removeClass('down-icon').addClass('up-icon');
});
$('#billing').on('hide', function() {
   $('#billingToggle').removeClass('up-icon').addClass('down-icon');
});


<!-- Swipe-to-navigate Photos -->

$('.swipe').wipetouch({
	wipeLeft: function(result) { $('.next').click();},
	wipeRight: function(result) { $('.prev').click();}
});


<!-- Responsive -->

$(document).ready(function(){

	//windowResize();
	window.onresize = function(event) {
		windowResize();
		//trailerResize();
	};

  if ($('#homeBG').length) {
    $('#homeBG').videoBG({
      mp4:'assets/videoBG.mp4',
      ogv:'assets/videoBG.ogv',
      webm:'assets/videoBG.webm',
      fullscreen:true,
      zIndex:0
    });
  }

  $(window).focus(function() {
   	  
	  //enable sound
	if(IsAudioEnabled()) {			
	  if (!wasPaused || wasPaused === 'undefined')
	  {
		  audio.play();
	  }
    }
  });

  $(window).blur(function() {
	  //disable sound

	  if(IsAudioEnabled()) 
	  {
		  audio.pause();
	  }    
  });


})



function windowResize() {
	var width = $(window).width();
	var height = $(window).height();
		$('.main-container').height(($(window).height() -100));
		$('.modal').css('top',(($(window).height() - $('.modal').outerHeight())/2)-20);
			$('#trailer').css('top',(($(window).height() - $('#trailer').outerHeight())/2)-120);
		$('#games ul li').width(($('#games').width()-60)/3);
		if (($(window).width()) > ($(window).height())) {
			$('.photo').css("width",($(window).width()));
			$('.photo').css("height",($(".photo").width() * 0.5625));
			$('.youtube-player').css('width',($(window).height() * 1.1));
			$('.youtube-player').css('height',($(".youtube-player").width() * 0.61875));
			$('.video-player').css('max-width',($(window).width() * 0.9));
			$('.video-player').css('max-height',($(window).height() - 340));
			if ($('.video-player').css('max-height',($(window).height() - 340))) {
				$('.video-player').css('width',($(".video-player").height() * 1.777777777777777777777778));
			}
			$('.video').css('width',$(".youtube-player").width());
			$('.video').css('left', $(window).width()/2 - $('.video').width()/2);
			if ($('#videosCarousel').width() > 1000 ) {
				$('#videosCarousel .carousel-inner').css("margin-left",(($('#videosCarousel').width() - 740)/2));
				$('#videosCarousel .carousel-control').css("left",((($('#videosCarousel').width() - 740)/2)-50));
				$('#videosCarousel .carousel-control.right').css("right",((($('#videosCarousel').width() - 740)/2)-50));
				$('#videosCarousel .carousel-control.right').css("left","auto");
			}
			else {
				$('#videosCarousel .carousel-inner').css("margin-left","auto");
				$('#videosCarousel .carousel-control').css("left","");
				$('#videosCarousel .carousel-control.right').css("right","");
			}
			if ($(window).width < 768) {
			  $('.video').css('height',($(window).height() - 180));
			}
			if (($(window).height()) < ($(".photo").height())) {
				$('.photo').css("width",($(window).width()));
				$('.photo').css("height",($(".photo").width() * 0.5625));
				$('.photo').css("margin-top",(($(window).height() - $(".photo").height())/2));
				$('.photo').css("margin-left","0px");
				$('.cast-bio').css("top",(($(window).height() - $('.cast-bio').height())/2) - ($(window).height()/2 - $(".photo").height()/2) +20);
			}
			else {
				$('.photo').css("margin-top",0);
			}
			if (($(window).height()) > ($(".photo").height())) {
				$('.photo').css("height",$(window).height());
				$('.photo').css("width",($(".photo").height() * 1.777777777777777777777778));
				$('.photo').css("margin-left",(($(window).width() - $(".photo").width())/2));
        		$('.cast-bio').css("top",(($(window).height() - $('.cast-bio').height())/2) + 20);		
			}
		}
		if (($(window).height()) > ($(window).width())) {
			$('.photo').css("height",$(window).height());
			$('.photo').css("width",($(".photo").height() * 1.777777777777777777777778));
			$('.photo').css("margin-top","0px");
			$('.photo').css("margin-left",(($(window).width() - $(".photo").width())/2));
			$('.youtube-player').css('width',($(window).width() * 0.80));
			$('.youtube-player').css('height',($(window).width() * 0.45));
			$('.video').css('width',($(window).width() * 0.80));
			$('.video').css('left', '10%');
			if ($(window).width < 768) {
			  $('.youtube-player').css('width',($(window).width() * 0.60));
			  $('.video-player').css('max-width', "500px");
			  $('.video-player').css('height',($(window).width() * 0.33));
			  $('.media').css('width','20%');
			  $('.video').css('left', '20%');
			}
		}

	if (height < 600) {
		$('.title-treatment-wrap').css("padding-left","320px");
		$('.title-treatment-wrap').css("padding-right","320px");
	}
	if (width < 1031) {
		$('#home #share-buttons').addClass("collapse");
		$('#home #share-buttons').css("height","0");
		$('#home #share-buttons').on('show', function() {
		   $('#shareToggle').removeClass('share-icon').addClass('share-icon-a');
		});
		$('#home #share-buttons').on('hide', function() {
		   $('#shareToggle').removeClass('share-icon-a').addClass('share-icon');
		});
	}
	else {
		$('#home #share-buttons').removeClass("collapse");
		$('#home #share-buttons').css("height","auto");
	}
	if (width < 980) {
		$('.main-container').height(($(window).height() -180));
		$('#copyright-wrap').removeClass("span6").addClass("span8");
		$('#rating-block').removeClass("span3").addClass("span12").css("margin-left","-20px");
		$('.cast-photo').css("margin-left","0px");
		$('.cast-photo').css("height",($(window).height() * 0.7));
		$('.cast-photo').css("width",($(".cast-photo").height() * 1.777777777777777777777778));
		$('.cast-photo').css("min-width",($(window).width()));
		if (($('.cast-photo').width()) < ($(window).width())) {
			$('.cast-photo').css("height",($('.cast-photo').width() * 0.563));
		}
		$('.cast-bio').css('top','auto');
		$('.cast-bio').css('bottom','0');
		$('.cast-bio').css("height",($(window).height() * 0.3));
		$('.cast-bio-body').css("height",($('.cast-bio').height()-100));
		if (height < 600) {
			$('.title-treatment-wrap').css("padding-left","190px");
			$('.title-treatment-wrap').css("padding-right","190px");
		}
	}
	else {
		$('#copyright-wrap').removeClass("span8").addClass("span6");
		$('#rating-block').removeClass("span12").addClass("span3").css("margin-left","20px");
		$('.title-treatment-wrap').css("padding-left","0");
		$('.title-treatment-wrap').css("padding-right","0");
		$('.cast-bio').height(($(window).height()-300));
		$('.cast-bio-body').height(($('.cast-bio').height()-100));
	}
	if (width < 769) {
		$('#rating-block').css("margin-left","0px");
	}
	if (width > 481) {
		$('#video').css('top', (($(window).height()/2 - $('.video').height()/2)-60));
	}
	if (width > 980) {
		$('.video').css('top', ($(window).height()/2 - $('.video').height()/2));
	}
}

$('.main-container').css( "background-size", "cover" );
$('#trailer h1').css( "background-size", "contain" );
$('#video h1').css( "background-size", "contain" );

$('#carousel-control').css('top', ($(window).height()/2 - ($('#carousel-control').height())/2) - 100);
$('#carousel-image').css('top', ($(window).height()/2 - ($('#carousel-image').height())/2) - 100);


function ReloadShareButtons(url, text) {
	if (window.coppa) return;

	$('.fb-like').attr('data-href',url);
	$('#tweet-button iframe').remove();
	$('#plusone-button div').remove();
	$('#tweet-button').append('<a href="https://twitter.com/share" class="twitter-share-button" data-url="' + url + '" data-text="' + text + '">Tweet</a>');
	$('#plusone-button').append('<div class="g-plusone" data-size="medium" data-width="300" data-href="'+ url +'"></div>');

	// refresh the widgets
	twttr.widgets.load();
	gapi.plusone.go();
	FB.XFBML.parse();
};

var IsPaused = function() {
	
	if(IsAudioEnabled()) {

		if (audio.paused == true )
			return  true;
	}
}

var IsAudioEnabled = function() {
	
	var btn = $('#btnAudio')

	if(typeof audio == 'undefined'|| btn.length == 0) {
		return false;
	} else {
		return true;
	}
	
}

/* TRACKING */

function exitSiteEvent(site) {
	
	dataLayer.push({'eventLabel':site,'event':'exitSite'})
}

function gPlusEvent(jsonParam) {
	dataLayer.push({'socialNetwork':'Google+', 'socialAcivity':'+1','socialTarget':jsonParam.href,'event':'socialEvent'})
}
