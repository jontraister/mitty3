# Domestic Theatrical Movie Templates

This site provides a microsite template for theatrical microsites. It is built for PHP 5.3+ with a minimal framework.
The [composer](http://getcomposer.org/) dependency manager is used for 3rd party library management.

## System Requirements
- PHP v5.3+

## Setup

If you do not have a copy of the application, you can check the the mainline code out from the subversion repository at [https://svn2.foxfilm.com/domth_template/trunk](https://svn2.foxfilm.com/domth_template/trunk)

Execute the composer to install any required components and libraries:
```sh bin/composer install```

Set up a host in our webserver:
- point the DocumentRoot to the ```web/``` directory
- redirect all html page requests to ```web/app.php```

Apache VirtualHost example:
<pre>
&lt;VirtualHost *:80&gt;
    ServerName domth-templates.foxfilm.com
    ServerAlias local.domth-templates.foxfilm.com
    Documentroot /content/domth-templates.foxfilm.com/web
    &lt;Directory /content/domth-templates.foxfilm.com/web&gt;
    	  AllowOverride None
		    Options FollowSymlinks
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^(.*)$ app.php [QSA,L]
    &lt;Directory&gt;
    SetEnv DEBUG true # FOR DEVELOPMENT ONLY
&lt;/VirtualHost&gt;
</pre>

As shown, you can pass the DEBUG parameter with a value of true in development environments 'true' for more verbose error messages.

## Production setup

The application uses rate limited webservices like the Youtube API. It is vital that these do not get hit for every request.
To **prevent denial of service, [memcached must be configured as the session handler](http://php.net/manual/en/memcached.sessions.php).**
Sessions aren't used in the application but the memcached session handler is used to set up a page cache with a 600 second expiry time.

Cacheing is turned off in DEBUG mode, so make sure DEBUG is not set in the production environment and your development URLs are not publicly accessible.

Check whether cacheing works in production by examining the HTTP headers for any of the html pages, e.g. index.html. When 'X-Server-Cached: no' is sent
it indicates the page has not been cached. If the header keeps getting sent with repeated requests there is an issue with your configuration.
Contact system administration if necessary!

## Deployment

Use ```bin/deploy-update``` to fetch updates from svn and perform composer setup. The script will output errors only.

## Directories
<pre>
.
+-- bin             <- composer
+-- classes         <- PSR-0 compliant source files
+-- data            <- editable site content and configuration
+-- templates       <- PHP templates
+-- resources       <- PSD files etc
+-- vendor          <- created by the composer for library components
+-- web             <- document root and static asset container
</pre>


## Content and configuration

The editable site content is in ```data/data.yml```. Configuration options are documented inline in this file.
The data is in [http://www.yaml.org/spec/1.2/spec.html(Yaml) format. DO NOT USE TABS when editing this file - set your editor to convert tabs to spaces.

## Assets

All title assets are to be placed into the ```web/assets/``` folder. Modifying any files outside of this folder the should not be necessary, except for the configuration file.

<pre>
bg_large_desktop_1400x1244.jpg JPEG 1400x1244 desktop background
bg_large_desktop_1800x1600.jpg JPEG 1800x1600 hires/large screen desktop background
bg_mobile640x1100.jpg JPEG 640x1100 mobile background
bg_tablet_portrait800x1200.jpg JPEG 800x1200 tablet background
billing.png PNG 570x133 billing credits
favicon.ico ICO 32x32 Site icon, required for Internet Explorer
icon.png PNG 72x72 Site icon, all other browsers
photo-1.jpg JPEG 1920x1080 Still photos, any amount
photo-2.jpg JPEG 1920x1080
photo-3.jpg JPEG 1920x1080
photo-4.jpg JPEG 1920x1080
title-treatment-mobile.png PNG 409x275 title treatment for mobile
title-treatment.png PNG 1247x282 title treatment for desktops and tablets
videoBG.mp4 16x9 aspect ratio video background
videoBG.ogv 16x9 aspect ratio video background
videoBG.webm 16x9 aspect ratio video background
custom.css CSS customize as necessary - do not edit css/template css
</pre>

## Static Pages

To generate a static copy of the site you can run the ```bin/generate-html``` script. It will render all html pages and copy all necessary assets into the ```static/``` folder.

---

###### Authors
christian.kissner@fox.com
matthew.michalowski@fox.com
devon.bleak@fox.com
