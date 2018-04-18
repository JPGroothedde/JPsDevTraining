<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php _p(QApplication::$EncodingType); ?>" />
    <link href="<?php echo __VIRTUAL_DIRECTORY__.__APP_IMAGE_ASSETS__.'/apple-touch-icon-57x57.png';?>" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php _p(__APPNAME__)?>">
    <script type="text/javascript">
        (function(document,navigator,standalone) {
            // prevents links from apps from opening in mobile safari
            // this javascript must be the first script in your <head>
            if ((standalone in navigator) && navigator[standalone]) {
                var curnode, location=document.location, stop=/^(a|html)$/i;
                document.addEventListener('click', function(e) {
                    curnode=e.target;
                    while (!(stop).test(curnode.nodeName)) {
                        curnode=curnode.parentNode;
                    }
                    // Condidions to do this only on links to your own app
                    // if you want all links, use if('href' in curnode) instead.
                    if('href' in curnode && ( curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host) ) ) {
                        e.preventDefault();
                        location.href = curnode.href;
                    }
                },false);
            }
        })(document,window.navigator,'standalone');
    </script>
    <?php if (PROMPT_STANDALONE_MODE) { ?>
    <link rel="stylesheet" type="text/css" href="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/addtohomescreen.css">
    <script src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/addtohomescreen.js"></script>
    <script>
        addToHomescreen();
    </script>
    <?php } ?>
    <?php require(__CONFIGURATION__.'/js_config.inc.php');?>
    <!-- Icons -->

    <?php if (isset($strPageTitle)) { ?>
        <title><?php _p(__APPNAME__.' - '.$strPageTitle); ?></title>
    <?php } else
    {   ?><title><?php _p(__APPNAME__.' - Home'); ?></title>
    <?php }?>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/bootstrap.min.css?v=<?php echo filemtime(__DOCROOT__ . __APP_CSS_ASSETS__.'/bootstrap.min.css')?>");</style>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/bootstrapmodifications.css?v=<?php echo filemtime(__DOCROOT__ . __APP_CSS_ASSETS__.'/bootstrapmodifications.css')?>");</style>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/font-awesome.min.css?v=<?php echo filemtime(__DOCROOT__ . __APP_CSS_ASSETS__.'/font-awesome.min.css')?>");</style>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/jqueryui/jquery-ui.css?v=<?php echo filemtime(__DOCROOT__ . __APP_CSS_ASSETS__.'/jqueryui/jquery-ui.css')?>");</style>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/jscrollpane/jquery.jscrollpane.css?v=<?php echo filemtime(__DOCROOT__ . __APP_CSS_ASSETS__.'/jscrollpane/jquery.jscrollpane.css')?>");</style>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/Croppie/croppie.css?v=<?php echo filemtime(__DOCROOT__ . __APP_CSS_ASSETS__.'/Croppie/croppie.css')?>");</style>
    <style type="text/css">@import url("<?php _p(__SUBDIRECTORY__.'/assets/3rdPartyRepository/AnimateCss/'); ?>/animate.min.css?v=<?php echo filemtime(__DOCROOT__ . __SUBDIRECTORY__.'/assets/3rdPartyRepository/AnimateCss/animate.min.css')?>");</style>
    <script data-pace-options='{ "ajax": true }' src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/pace.min.js?v=<?php echo filemtime(__DOCROOT__ . __APP_JS_ASSETS__.'/pace.min.js');?>"></script>

    <?php require('additional_header_inits.inc.php');?>

    <!-- iOS 7 iPad (retina) -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-icon-152x152.png"
          sizes="152x152"
          rel="apple-touch-icon">

    <!-- iOS 6 iPad (retina) -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-icon-144x144.png"
          sizes="144x144"
          rel="apple-touch-icon">

    <!-- iOS 7 iPhone (retina) -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-icon-120x120.png"
          sizes="120x120"
          rel="apple-touch-icon">

    <!-- iOS 6 iPhone (retina) -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-icon-114x114.png"
          sizes="114x114"
          rel="apple-touch-icon">

    <!-- iOS 7 iPad -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-icon-76x76.png"
          sizes="76x76"
          rel="apple-touch-icon">

    <!-- iOS 6 iPad -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-icon-72x72.png"
          sizes="72x72"
          rel="apple-touch-icon">

    <!-- iOS 6 iPhone -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-icon-57x57.png"
          sizes="57x57"
          rel="apple-touch-icon">

    <!-- Startup images -->

    <!-- iOS 6 & 7 iPad (retina, portrait) -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-startup-image-portrait-1536x2008.png"
          media="(device-width: 768px) and (device-height: 1024px)
                     and (orientation: portrait)
                     and (-webkit-device-pixel-ratio: 2)"
          rel="apple-touch-startup-image">

    <!-- iOS 6 & 7 iPad (retina, landscape) -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-startup-image-landscape-1496x2048.png"
          media="(device-width: 768px) and (device-height: 1024px)
                     and (orientation: landscape)
                     and (-webkit-device-pixel-ratio: 2)"
          rel="apple-touch-startup-image">

    <!-- iOS 6 iPad (portrait) -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-startup-image-portrait-768x1004.png"
          media="(device-width: 768px) and (device-height: 1024px)
                     and (orientation: portrait)
                     and (-webkit-device-pixel-ratio: 1)"
          rel="apple-touch-startup-image">

    <!-- iOS 6 iPad (landscape) -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-startup-image-landscape-748x1024.png"
          media="(device-width: 768px) and (device-height: 1024px)
                     and (orientation: landscape)
                     and (-webkit-device-pixel-ratio: 1)"
          rel="apple-touch-startup-image">

    <!-- iOS 6 & 7 iPhone 5 -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-startup-image-640x1096.png"
          media="(device-width: 320px) and (device-height: 568px)
                     and (-webkit-device-pixel-ratio: 2)"
          rel="apple-touch-startup-image">

    <!-- iOS 6 & 7 iPhone (retina) -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-startup-image-640x920.png"
          media="(device-width: 320px) and (device-height: 480px)
                     and (-webkit-device-pixel-ratio: 2)"
          rel="apple-touch-startup-image">

    <!-- iOS 6 iPhone -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-startup-image-320x460.png"
          media="(device-width: 320px) and (device-height: 480px)
                     and (-webkit-device-pixel-ratio: 1)"
          rel="apple-touch-startup-image">

    <!-- iPhone 6 -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-startup-image-750x1294.png"
          media="(device-width: 375px) and (device-height: 667px)
                    and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)"
          rel="apple-touch-startup-image">

    <!-- iPhone 6+ Portrait -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-startup-image-portrait-1242x2148.png"
          media="(device-width: 414px) and (device-height: 736px)
                    and (orientation: portrait) and (-webkit-device-pixel-ratio: 3)"
          rel="apple-touch-startup-image">

    <!-- iPhone 6+ Landscape -->
    <link href="<?php _p(__VIRTUAL_DIRECTORY__ .__APP_IMAGE_ASSETS__)?>/apple-touch-startup-image-landscape-2208x1182.png"
          media="(device-width: 414px) and (device-height: 736px)
                    and (orientation: landscape) and (-webkit-device-pixel-ratio: 3)"
          rel="apple-touch-startup-image">

</head>
<body>
<div class='ajaxoverlay' style="opacity: 0.7;filter:alpha(opacity=70);"></div>
<div class='ajaxoverlaymessage BorderSpin' style="width:30px;height:30px;border-radius:100%;
border-left:2px solid #ffffff;border-bottom:2px solid #ffffff;opacity: 1;filter:alpha(opacity=100);background-color:transparent;">
</div>
<div class='ajaxoverlayicon' style="width:36px;height:36px;border-radius:100%;margin-top:3px;z-index: 9999999;">
</div>
<script>
    var theIcon = document.getElementsByClassName('ajaxoverlayicon')[0];
    theIcon.style.background = "url("+FavIconUrl+") no-repeat center";
    theIcon.style["-webkit-background-size"] = "contain";
    theIcon.style["-moz-background-size"] = "contain";
    theIcon.style["-o-background-size"] = "contain";
    theIcon.style["background-size"] = "contain";
    theIcon.style["background-color"] = "#ffffff";
</script>
<?php
$compareTitle = '';
$currentUserRole = '';
if (isset($strPageTitle)) {
    $compareTitle = $strPageTitle;
}
if (isset ($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_UserRoleId"])) {
    $userRole = UserRole::LoadById($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_UserRoleId"]);
    if ($userRole)
        $currentUserRole = $userRole->Role;
}
//QApplication::DisplayAlert($deviceType); // Debug purposes
?>