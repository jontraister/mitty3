<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title><?php echo $meta->title ?></title>

    <meta name="description" content="<?php echo $meta->description ?>" />
    <meta name="keywords" content="<?php echo $meta->keywords ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $og->title ?>" />
    <meta property="og:site_name" content="<?php echo $og->site_name ?>" />
    <meta property="og:description" content="<?php echo $og->description ?>" />
    <meta property="og:url" content="<?php echo $url ?><?php echo ltrim($this->request['path'],'/'); ?>" />
<?php if (isset($og['isImage']) && $og['isImage']): ?>
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="1920" />
    <meta property="og:image:height" content="1080"/>
<?php endif ?>

<?php if (isset($og['video'])): ?>
    <meta property="og:image" content="<?php echo $og->image ?>" />
    <meta property="og:video" content="http://www.youtube.com/v/<?php echo $og['video']['id'] ?>?autohide=1&amp;version=3" />
    <meta property="og:video:type" content="application/x-shockwave-flash" />
    <meta property="og:video:release_date" content="<?php echo preg_replace('/T.*$/','',$og['video']['publishedAt']); ?>" />
    <meta property="og:video:width" content="1920" />
    <meta property="og:video:height" content="1080"/>
<?php else: ?>
    <meta property="og:image" content="<?php echo $url ?><?php echo $og->image ?>" />
<?php endif ?>

    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $meta->apple_touch_icon ?>" />
    <link rel="icon" type="image/png" href="<?php echo $meta->icon ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $meta->shortcut_icon ?>" />

    <link rel="stylesheet" media="screen" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" media="screen" href="css/bootstrap-responsive.css" type="text/css" />
    <link rel="stylesheet" media="screen" href="css/template.css" type="text/css" />
    <link rel="stylesheet" media="screen" href="assets/custom.css" type="text/css" />

    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/youtubetracker-src.js"></script>
    <script src="js/jquery.wipetouch.js"></script>
    <script src="js/jquery.backgroundSize.js"></script>
    <script src="js/css3-mediaqueries.js"></script>
    <script src="js/jquery.videoBG.js"></script>
    <?php if (!(isset($coppa) && $coppa && 'false'!==$coppa && !(is_object($coppa) && 'false'!==$coppa->literal()))): ?>
    <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
    <?php endif; ?>


    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
	<link rel="stylesheet" media="screen" href="css/ie.css" type="text/css" />
    <![endif]-->

    <!-- jQuery ScrollTo Plugin -->
    <script defer src="//balupton.github.io/jquery-scrollto/lib/jquery-scrollto.js"></script>

   <![if gt IE 8]>
    <!-- History.js -->
    <script defer src="js/jquery.history.js"></script>

    <!-- Ajaxify -->
    <script defer src="js/ajaxify.js"></script>
	<![endif]>

</head>

<body>
<script type="text/javascript" >
<?php if (isset($coppa) && $coppa && 'false'!==$coppa && !(is_object($coppa) && 'false'!==$coppa->literal())): ?>
    coppa=true;
<?php else: ?>
    coppa=false;
<?php endif; ?>
    </script>

<?php if (!(isset($coppa) && $coppa && 'false'!==$coppa && !(is_object($coppa) && 'false'!==$coppa->literal()))): ?>

<div id="fb-root"></div>
<script>

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}
(document, 'script', 'facebook-jssdk'));

window.fbAsyncInit = function() {
	FB.init(/*{ NEEDED 
				appId: APPID,
				channerUrl: http://www.yourdomain.com/channel.html,
				status: true,
				xfbml: true
			}*/);

	FB.Event.subscribe('edge.create', function(response) {
		dataLayer.push({'socialNetwork':'Facebook','socialActivity':'Like','socialTarget':response,'event':'socialEvent'});
	});
	
	FB.Event.subscribe('edge.remove', function(response) {
		dataLayer.push({'socialNetwork':'Facebook','socialActivity':'Unlike','socialTarget':response,'event':'socialEvent'});
	});
}

window.twttr = (function (d,s,id) {
  var t, js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return; js=d.createElement(s); js.id=id;
  js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
  return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
}(document, "script", "twitter-wjs"));

twttr.ready(function (twttr) {
	twttr.events.bind('tweet', function(event) {
		dataLayer.push({'socialNetwork':'Twitter','socialActivity':'Tweet','event':'socialEvent'});
	})
});

</script>
<?php endif; ?>

<?php if (isset($gtm_id)): ?>
<script>
	dataLayer = [{'UACode':'<?php echo $UACode?>'}]
</script>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=<?php echo $gtm_id?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>
dataLayer = [{'UACode':'<?php echo $UACode; ?>'}];

(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo $gtm_id?>');</script>
<!-- End Google Tag Manager -->
<?php endif; ?>


    <!-- Header -->

	<div id="header" class="navbar container-fluid">
    	<div class="navbar-inner">
            <ul id="nav" class="nav">
                <?php foreach ($navigation as $nav): ?>
                <li>
                    <a href="<?php echo $nav->link ?>" class="nav-link"><?php echo $nav->title;?></a>
                </li>
                <?php endforeach; ?>
            </ul>
            <a id="shareToggle" class="share-icon no-ajaxy" href="#share-buttons" data-toggle="collapse" ></a>
		</div>
	</div>
    
    <?php if (isset($this->vars['audio'])): ?>
        <audio id="player" loop preload="auto">
            <source src="<?php echo $this->vars['audio']->src; ?>.mp3" type="audio/mp3">
            <source src="<?php echo $this->vars['audio']->src; ?>.ogg" type="audio/ogg">
        </audio>
    <?php endif ?>

    <!-- Content -->
    <script src="js/main.js"></script>
    <div class="main-container container-fluid" id="main-container">

        <?php if (isset($videoBG) && $videoBG): ?>
        <div id="homeBG"></div>
        <?php endif ?>

        <div class="row-fluid">
            <div class="title-treatment-wrap">
          		<h1 class="title-treatment"><a href="home.html"><img src="../assets/title-treatment.png" alt="title of movie" ></a></h1>
            </div>
            <!-- Shutter Fly -->
            <div id="shutter-fly-wrap">
                <div id="shutter-fly">
                    <a href="#" target="_blank"><img src="../assets/shutter_fly_ad.png" alt="Shutter Fly" /></a>
                </div>
            </div>

            <?php if (isset($social) && isset($social->links) && !empty($social->links)): ?>
            <div class="social-links-wrap">
                <div class="social-links">
                    <span><?php echo $social->title ?></span>
                    <?php foreach ($social->links as $link): ?>
                        <a target="_blank" class="social-icon-button <?php echo $link->name?>-button" href="<?php echo $link->link; ?>"></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif ?>
        </div>
        <?php $this->render($content->file,  $content->vars); ?>
    </div>


    <!-- Footer -->

    <div id="footer" class="container-fluid">

        <?php if (isset($billing)): ?>
        <div id="billing" class="collapse">
        	<div class="row-fluid">
                     <div class="span12">
                        <img src="<?php echo $billing->url ?>" alt="<?php echo $billing->description->literal(); ?>" />
            		</div>
        	</div>
        </div>
        <?php endif ?>

        <div class="row-fluid">
            <div class="span3">
                <ul class="nav-footer">
                    <?php if (isset($billing) && !empty($billing)): ?>
                    <li>
                        <a href="#billing" data-toggle="collapse" id="billingToggle" class="down-icon no-ajaxy"><?php echo $billing->title; ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (isset($languages) && !empty($languages)): ?>
                    <li class="menu-parent">
                        <a href="#language" data-toggle="collapse" id="languageToggle" class="down-icon no-ajaxy"><?php echo $language->title; ?></a>
                        <ul id="language" class="collapse">
                          <?php foreach ($languages as $language): ?>
                            <li>
                                <a href="<?php echo $language->link; ?>" class="<?php echo "active"; ?>"><?php echo $language->name ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if (isset($sitemap) && !empty($sitemap)): ?>
                    <li><a href="sitemap.html"><?php echo $sitemap->title?></a></li>
                    <?php endif ?>
                    <?php if (isset($signup) && !empty($signup)): ?>
                    <li><a href="signup.html"><?php echo $signup->title?></a></li>
                    <?php endif ?>
                </ul>
            </div>
            <div class="span6" id="copyright-wrap">
                <span class="copyright">
                    <?php if (isset($copyright) && $copyright):?>
                        <?php echo $copyright->literal(); ?>
                    <?php elseif($coppa): ?>
                        <?php trigger_error("You must manually define copyright lines for this title. See https://wiki.foxfilm.com/Footers for details."); ?>
                    <?php else: ?>
                        <script type="text/javascript" src="//www.foxprivacy.com/us/footer.js"></script>
                    <?php endif ?>
                </span>
            </div>
            <?php if (isset($ratings)): ?>
            <div class="span3" id="rating-block">
                <div class="rating">
                    <img src="<?php echo $ratings->image?>" alt="<?php echo $ratings->text?>" />
                </div>
                <span>
                  <?php echo $ratings->description->literal() ?>
                </span>
            </div>
            <?php endif ?>
        </div>
    </div>

    <?php echo $include->literal(); ?>



<?php if (!(isset($coppa) && $coppa && 'false'!==$coppa && !(is_object($coppa) && 'false'!==$coppa->literal()))): ?>

    <!-- Pinterest -->

    <script type="text/javascript">
        (function() {
            window.PinIt = window.PinIt || { loaded:false };
            if (window.PinIt.loaded) return;
            window.PinIt.loaded = true;
            function async_load(){
                var s = document.createElement("script");
                s.type = "text/javascript";
                s.async = true;
                if (window.location.protocol == "https:")
                    s.src = "https://assets.pinterest.com/js/pinit.js";
                else
                    s.src = "http://assets.pinterest.com/js/pinit.js";
                var x = document.getElementsByTagName("script")[0];
                x.parentNode.insertBefore(s, x);
            }
            if (window.attachEvent)
                window.attachEvent("onload", async_load);
            else
                window.addEventListener("load", async_load, false);
        })();
    </script>

<?php endif; ?>

</body>

</html>
