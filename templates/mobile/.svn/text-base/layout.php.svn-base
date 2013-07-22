<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js mobile"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title><?php echo $meta->title; ?></title>

        <meta name="description" content="<?php echo $meta->description ?>" />
        <meta name="keywords" content="<?php echo $meta->keywords ?>" />

        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=.8,maximum-scale = .8" />

        <link rel="apple-touch-icon" href="assets/apple-touch-icon-57x57-precomposed.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $meta->apple_touch_icon ?>" />
        <link rel="apple-touch-icon" sizes="114x114" href="assets/apple-touch-icon-114x114-precomposed.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="assets/apple-touch-icon-144x144-precomposed.png" />

        <meta name="msapplication-TileColor"  content="#222" />
        <meta name="msapplication-TileImage" content="apple-touch-icon-144x144-precomposed.png" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php echo $og->title ?>" />
        <meta property="og:site_name" content="<?php echo $og->site_name ?>" />
        <meta property="og:description" content="<?php echo $og->description ?>" />
        <meta property="og:url" content="<?php echo $url ?>" />
        <meta property="og:image" content="<?php echo $og->image ?>" />

        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $meta->shortcut_icon ?>" />
        <link href='http://fonts.googleapis.com/css?family=Lusitana:400,700' rel='stylesheet' type='text/css' />

        <script type="text/javascript">
            var isIE8 = false;
        </script>
        <!--[if lt IE 9]>
			<script src="js/vendor/html5shiv.js"></script>
			<script src="js/vendor/background_size.js"></script>
			<script>isIE8 = true</script>
		<![endif]-->

        <link rel="stylesheet" href="css/mobile.css" />

		<script src="//www.youtube.com/iframe_api"></script>

    </head>

	<body style="zoom: 1;" class="is_mobile small square">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->


<?php if (isset($gtm_id)): ?>

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

	<div id="wrapper" style="display: block;">


		<article id="main_content" style="height: 1163px;">

            <div style="display: none;" id="lightbox_overlay"></div>

            <?php $this->render('templates/mobile/main.html',  $content->vars); ?>

      <?php if ($this->vars['tickets']): ?>
                    <section class="mobile tickets_content">
                    	<div class="tickets_wrap">
                            <span><?php echo $this->vars['tickets']['title']?></span>

                            <ul class="clearfix">
                                <?php foreach ($this->vars['tickets']['items'] as $ticketName => $ticket): ?>
                                  <li><a href="<?php echo $ticket->link ?>" target="_blank"><img src="../assets/<?php echo $ticketName ?>.jpg" alt="<?php echo $ticket->link ?>" /></a></li>
                                <?php endforeach ?>
                            </ul>
                    	</div>
                    </section>
      <?php endif ?>

                <?php if (isset($social) && count((array) $social->links)): ?>
                    <section class="mobile social_content">
                        <ul class="clearfix">
                            <?php foreach ($social->links as $link): ?>
                                    <li id="<?php echo $link->name?>">
                                        <a target="_blank" href="<?php if (isset($link['mobile'])) echo $link->mobile; else echo $link->link; ?>"><?php echo $link->name?></a>
                                    </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                <?php endif ?>

		<section id="mobile_content">
        	<?php foreach ($content->vars['sections'] as $section => $content) $this->render('templates/mobile/'.$section, $content); ?>
        </section>

		</article>

<footer class="clearfix">
	<div id="footer_content">

				<section id="legal">
                    <p>
                    <?php if (isset($copyright) && $copyright):?>
                        <?php echo $copyright->literal(); ?>
                    <?php else: ?>
                        <script type="text/javascript" >
                        function setLegalText(s) { document.getElementById('legal').innerHTML='<p>'+s+'</p>'};
                        document.write('<scri');
                        document.write('pt type="text/javascript" src="');
                        if (window.location.protocol != "https:")
                            document.write('http://legal.foxfilm.com/legal.js');
                        else
                            document.write('https://legal-ssl.foxfilm.com/legal.js');
                        document.write('"></scri');
                        document.write('pt>');

                        </script>
                    <?php endif ?>
                    </p>
				</section>

            <?php if (isset($ratings)): ?>

				<section id="ratings">
                    <div class="rating">
                        <img src="<?php echo $ratings->image?>" alt="<?php echo $ratings->text?>" />
                    </div>
					<p>
    					<?php echo $ratings->description->literal(); ?>
					</p>
				</section>

            <?php endif; ?>


		</div>
		</footer>
	</div><!-- END WRAPPER -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="mobile/js/vendor/youtube_tracker.js"></script>
        <script src="mobile/js/jquery.wipetouch.js"></script>

        <script src="mobile/js/plugins.js"></script>
        <script src="mobile/js/main.js"></script>




</body>
</html>
