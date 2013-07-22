/*### YOUTUBE VIEW TRACKER v1 - Custom ###
Original: http://lunametrics.wpengine.netdna-cdn.com/js/lunametrics-youtube.js
*/
console.log('loading youtubetracker-v1-src.js');
/*var tag = document.createElement('script');
tag.src = "//www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
*/
var videoArray;
var playerArray;


var _pauseFlag = false;
var _initPlay = true;
var intervalId = 0;
var num = 1;
var youtubeid;
var duration;
var _playing = false;

var ytfn = (function($) { 

	videoArray = new Array();
	playerArray = new Array();
	
	var temp = function trackYouTube()
	{

		var i = 0;
		jQuery('iframe').each(function() {
			var video = $(this);
			
			var vidSrc = "";
			vidSrc = video.attr('src');
			if(vidSrc.length>29){
				if(vidSrc.substr(0,29)=="http://www.youtube.com/embed/"){
					youtubeid = vidSrc.substr(29);
					if(youtubeid.substr(-6)=="?rel=0"){
						cutlength = youtubeid.length - 6;
						youtubeid = youtubeid.substr(0,cutlength);
					}
					videoArray[i] = youtubeid;
					$(this).attr('id', youtubeid);
					i++;			
				}else if(vidSrc.substr(0,30)=="https://www.youtube.com/embed/"){
					var youtubeid = vidSrc.substr(30);
					if(youtubeid.substr(-6)=="?rel=0"){
						cutlength = youtubeid.length - 6;
						youtubeid = youtubeid.substr(0,cutlength);
					}
					videoArray[i] = youtubeid;
					$(this).attr('id', youtubeid);
					i++;					
					}
				else{
				}
			}
		});	
		
	}
	
	return temp;
})(jQuery);

	//$(document).ready(function() {
		//
	//});
	
function onYouTubeIframeAPIReady() {
	for (var i = 0; i < videoArray.length; i++) {
		playerArray[i] = new YT.Player(videoArray[i], {
			events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
			}
		});		
	}

}
function onPlayerReady(event) {
	//event.target.playVideo();
}

function updateYouTubePlayer(title) {

	try {
			
		var time = 	Math.floor(playerArray[0].getCurrentTime());
		
		dataLayer.push({'optOut':'false'});

		if(time == Math.floor(duration * 0.05))
		{
			num++;
			
			dataLayer.push({'youtubeId':youtubeid, 'youtubeEvent':'Play 5%', 'event':'ytAction'});
		}

		if(time == Math.floor(duration * 0.5))
		{
			num++;
			dataLayer.push({'youtubeId':youtubeid,'youtubeEvent':'Play 50%', 'event':'ytAction'});
		}

		if(time == Math.floor(duration * 0.9))
		{
			num++;
			dataLayer.push({'youtubeId':youtubeid,'youtubeEvent':'Play 90%', 'event':'ytAction'});
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

function ytStop() {
	
	try {
		playerArray[0].pauseVideo();
	}
	catch(err) {
		return;
	}
}

function ytPlay() {
	playerArray[0].seekTo(0,false);
	playerArray[0].playVideo();
}

function IsytPlaying() {
	if(playerArray[0].getPlayerState() == 1) {
		_playing = true;
	}
	else {
		_playing = false;
	};
}

function onPlayerStateChange(event) { 
	videoarraynum = event.target.id - 1;
	youtubeid = playerArray[0].a.id.substr(0, playerArray[0].a.id.indexOf('?'));
	duration = Math.floor(playerArray[0].getDuration());
	
	if (event.data ==YT.PlayerState.PLAYING){
				
		if(IsAutoPlay() == true  && _initPlay) {
			dataLayer.push({'youtubeId':youtubeid,'youtubeEvent':'Play', 'event':'ytAction', 'optOut':'true'});
		}	
		else {
			dataLayer.push({'youtubeId':youtubeid,'youtubeEvent':'Play', 'event':'ytAction', 'optOut':'false'});
		}
		intervalId = setInterval(updateYouTubePlayer, 1000);
		
		_initPlay = false;
		_pauseFlag = false;
		_playing = true;
	} 
	if (event.data ==YT.PlayerState.ENDED){
		//_gaq.push(['_trackEvent', 'Videos', 'Watch to End', videoArray[videoarraynum] ]); 
		dataLayer.push({'youtubeId':youtubeid,'youtubeEvent':'Ended', 'event':'ytAction'});
		clearInterval(intervalId);
	} 
	if (event.data ==YT.PlayerState.PAUSED && _pauseFlag == false){
		dataLayer.push({'youtubeId':youtubeid,'youtubeEvent':'Stopped', 'event':'ytAction'});
		_pauseFlag = true;
		clearInterval(intervalId);
		
	}
	if (event.data ==YT.PlayerState.PAUSED && _playing != true){
		dataLayer.push({'youtubeId':youtubeid,'youtubeEvent':'Stopped', 'event':'ytAction'});
		_pauseFlag = true;
		_playing = false;
		clearInterval(intervalId);
		
	}
	if (event.data ==YT.PlayerState.CUED){
	} 
} 