/*### YOUTUBE VIEW TRACKER v2 - Custom ###
Original: http://lunametrics.wpengine.netdna-cdn.com/js/lunametrics-youtube.js
*/
//console.log('loading youtubetracker-v1-src.js');
var tag = document.createElement('script');
tag.src = "//www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


var videoArray = new Array();
var playerArray = new Array();


var _pauseFlag = false;
var _initPlay = true;
var _continuePlay = false;
var intervalId = 0;
var num = 1;
var youtubeid;
var videoName;
var duration;
var debug=false;
 
 
/*(function($) { 
	function trackYouTube()
	{

		GetYouTubeIframe();
		
	}
	$(document)
        .ready(function() {
        //begin our quest to find the foul iframes
        //so infected with the source of the youtube
        trackYouTube();
    });
})(jQuery); */

function GetYouTubeIframe() {
	
	var i = 0;
		jQuery('.youtube-player').each(function() {
			var video = $(this);
			var vidSrc = "";
			vidSrc = video.attr('src');
			videoName = video.attr('data-name');
			if(vidSrc.length>29){
				if(vidSrc.substr(0,29)=="http://www.youtube.com/embed/"){
					youtubeid = vidSrc.substr(29,11);
					
					/*if(youtubeid.substr(-6)=="?rel=0&autoplay=1"){
						cutlength = youtubeid.length - 6;
						youtubeid = youtubeid.substr(0,cutlength);
					}*/
					videoArray[i] = youtubeid;
					$(this).attr('id', youtubeid);
					i++;			
				}else if(vidSrc.substr(0,30)=="https://www.youtube.com/embed/"){
					youtubeid = vidSrc.substr(30,11);
					/*if(youtubeid.substr(-6)=="?rel=0"){
						cutlength = youtubeid.length - 6;
						youtubeid = youtubeid.substr(0,cutlength);
					}*/
					videoArray[i] = youtubeid;
					$(this).attr('id', youtubeid);
					i++;					
					}
				else{
				}
			}
		});
	
}
	 
function onYouTubeIframeAPIReady() {

	//clear playerArray
	playerArray = [];
	
	//YouTubeTracker();

	GetYouTubeIframe();

	for (var i = 0; i < videoArray.length; i++) {
		playerArray[i] = new YT.Player(videoArray[i], {
			events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange,
			'onPlaybackQualityChange': onPlaybackQualityChange
			}
		});		
	}

}

function onPlayerReady(event) {
	//event.target.playVideo();
}

function updateYouTubePlayer() {

	try {
			
		var time = 	Math.floor(playerArray[0].getCurrentTime());
		
		if(debug)
			$('.yttime').html(time + 'sec');

		if(time == Math.floor(duration * 0.2))
		{
			num++;
			dataLayer.push({'videoName':videoName, 'videoAction':'Play_20', 'nonInteraction':false,  'event':'video'});
			if(debug)
				$('.ytevent').html('played 20%');
		}

		if(time == Math.floor(duration * 0.5))
		{
			num++;
			dataLayer.push({'videoName':videoName,'videoAction':'Play_50', 'event':'video'});
			if(debug)
				$('.ytevent').html('played 50%');
		}

		if(time == Math.floor(duration * 0.75))
		{
			num++;
			dataLayer.push({'videoName':videoName,'videoAction':'Play_75', 'event':'video'});
			if(debug)
				$('.ytevent').html('played 75%');
		}

		if(time == Math.floor(duration * 0.9))
		{
			num++;
			dataLayer.push({'videoName':videoName,'videoAction':'Play_90', 'event':'video'});
			if(debug)
				$('.ytevent').html('played 90%');
		}

	}
	catch (err)
	{
		clearInterval(intervalId);
	}
	
}

var IsAutoPlay = function () {
	
	var str = youtubeid.split('&');
	for(var i =0; i<str.length; i++)
	{
		if(str[i] = 'autoplay=1')
			return true;
		else
			return false;
	}	
}

function ClearPlayer() {

	clearInterval(intervalId);
	intervalId = 0;
	playerArray = [];
}

function ytStop() {
	
	clearInterval(intervalId);
	
	if(playerArray[0].getPlayerState() == YT.PlayerState.PLAYING) {
		try {
				playerArray[0].pauseVideo();
				//clearInterval(intervalId);
			}
		catch(err) {
	
		
				//clearInterval(intervalId);
				
				//Define the Player
				GetYouTubeIframe();
				onYouTubeIframeAPIReady();
			}
	}
}

function ytPlay() {
	
	try 
	{
		_continuePlay = true; 
		playerArray[0].playVideo();
	}
	catch(err) {
		//Define the Player
		GetYouTubeIframe();
		onYouTubeIframeAPIReady();
	}
}

function onPlayerStateChange(event) { 
	videoarraynum = event.target.id - 1;
	
	if(typeof videoName == 'undefined')
		videoName = videoArray[0];
	
	duration = Math.floor(playerArray[0].getDuration());
	
	if (event.data ==YT.PlayerState.PLAYING){
				
		if(IsAutoPlay() == true  && _initPlay) {
			dataLayer.push({'videoName':videoName,'videoAction':'Play', 'nonInteraction':true, 'event':'video'});
			if(debug)
				$('.ytevent').html('Playing');
		}	
		else if (_continuePlay)
		{
			dataLayer.push({'videoName':videoName,'videoAction':'Continue Play', 'event':'video'});
			if(debug)
				$('.ytevent').html('Playing');
		}
		else {
			dataLayer.push({'videoName':videoName,'videoAction':'Play', 'event':'video'});
			if(debug)
				$('.ytevent').html('Playing');
		}
		
		//Check if intevalId is set
		if(intervalId == 0)
			intervalId = setInterval(updateYouTubePlayer, 1000);
		
		_initPlay = false;
		_pauseFlag = false;
	} 
	if (event.data ==YT.PlayerState.ENDED){
		//_gaq.push(['_trackEvent', 'Videos', 'Watch to End', videoArray[videoarraynum] ]); 
		dataLayer.push({'videoName':videoName,'videoAction':'Ended', 'event':'video'});
		
		EndededAction();
		
		if(debug)
				$('.ytevent').html('Playing');
				
		_pauseFlag = true;
		clearInterval(intervalId);
	} 
	if (event.data ==YT.PlayerState.PAUSED )  {
				clearInterval(intervalId);
	}
	if (event.data ==YT.PlayerState.BUFFERING){
	}
	if (event.data ==YT.PlayerState.CUED){
	} 
} 

function EndededAction() {
	switch(window.location.pathname) {
		case "/index.html":
			//window.location = '../home.html';
			
			$('.close').trigger('click');
		
		break;
		default:
			PlayNextVideo($('.carousel .active-video a').data('index'));
		break;
	}
}

function onPlaybackQualityChange() {

	//Clear Interval
	clearInterval(intervalId);
	
}

function PlayNextVideo(currentIndex) {
	
	var carouselLength = $('.carousel .media').length;
	var nextItemIndex;
	var nextItem

	if(carouselLength == currentIndex) {
		nextItemIndex = 1;
	}
	else {
		nextItemIndex = currentIndex + 1;
	}
	
	nextItem = $('[data-index="'+ nextItemIndex +'"]');
	nextItem.trigger('click');
}