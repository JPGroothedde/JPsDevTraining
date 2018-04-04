<?php
/**
 * Created by Stratusolve (Pty) Ltd in South Africa.
 * @author     johangriesel <info@stratusolve.com>
 *
 * Copyright (C) 2017 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 *
 *
 * THIS FILE SHOULD NOT BE EDITED. sDev assumes the integrity of this file. If you edit this file, it could be overridden by a future sDev update
 */
?>
<script type="text/javascript" src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/jquery/1.11.1/jquery.min.js?v=<?php echo filemtime(__DOCROOT__ . __APP_JS_ASSETS__.'/jquery/1.11.1/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/jquery/jquery.redirect.js?v=<?php echo filemtime(__DOCROOT__ . __APP_JS_ASSETS__.'/jquery/jquery.redirect.js')?>"></script>
<script type="text/javascript" src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/jquery/jquery.typing-0.2.0.min.js?v=<?php echo filemtime(__DOCROOT__ . __APP_JS_ASSETS__.'/jquery/jquery.typing-0.2.0.min.js')?>"></script>
<script type="text/javascript" src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/jquery/UI/1.11.4/jquery-ui.min.js?v=<?php echo filemtime(__DOCROOT__ . __APP_JS_ASSETS__.'/jquery/UI/1.11.4/jquery-ui.min.js')?>"></script>
<script type="text/javascript" src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/bootstrap.min.js?v=<?php echo filemtime(__DOCROOT__ . __APP_JS_ASSETS__.'/bootstrap.min.js')?>"></script>
<script type="text/javascript" src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/jquery/Mousewheel/3.1.12/jquery.mousewheel.js?v=<?php echo filemtime(__DOCROOT__ . __APP_JS_ASSETS__.'/jquery/Mousewheel/3.1.12/jquery.mousewheel.js')?>"></script>
<script type="text/javascript" src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/jquery/jScrollPane/2.0.23/jquery.jscrollpane.min.js?v=<?php echo filemtime(__DOCROOT__ . __APP_JS_ASSETS__.'/jquery/jScrollPane/2.0.23/jquery.jscrollpane.min.js')?>"></script>
<script type="text/javascript" src="<?php _p(__VIRTUAL_DIRECTORY__ . __JS_ASSETS__); ?>/helpers/helpers.js?v=<?php echo filemtime(__DOCROOT__ . __JS_ASSETS__.'/helpers/helpers.js')?>"></script>
<script>
    //Init click animations
    initClickAnimations();
    // Init developer mode (If enabled)
    InitDeveloperMode();
    // Init datepickers that are currently on page
    <?php echo AppSpecificFunctions::GetDatePickerInitJs();?>
    // Init Bootstrap Modals to ensure proper scrolling
    var prevScroll;
    $('.modal').on('show.bs.modal', function (e) {
        // do something...
        prevScroll = document.body.scrollTop;
    });
    $('.modal').on('shown.bs.modal', function (e) {
        // do something...
        $('body').addClass('modal-open');
        //Removing this since it is cause date picker issues
        //$(this).css( "zIndex", getHighestZIndex()+1);
        <?php echo AppSpecificFunctions::GetDatePickerInitJs();?>
    });
    $('.modal').on('hide.bs.modal', function (e) {
        // do something...
    });
    $('.modal').on('hidden.bs.modal', function (e) {
        // do something...
        document.documentElement.scrollTop = document.body.scrollTop = prevScroll;
	    if ($('.modal:visible').length) {
		    $('body').addClass('modal-open');
	    }
    });
    // Execute some functions once the page has fully loaded
    $( document ).ready(function() {
        // Remove the loading overlay
        //$('#loadingoverlay').fadeOut("slow");// Old loading overlay... To be removed
        removeAjaxOverlay();
        // Enable jScrollPane (if needed)
        InitScrolling();
        // Prevent the back button. The user can click "back" 5 times without anything happening. On try 6, the page reloads
        <?php if (!ALLOW_BACK_BUTTON) {?>
        window.history.forward();
        history.pushState(null, null, null);
        for (i=0;i<5;i++)
            history.pushState(null, null, null);
        window.addEventListener('popstate', function(e) {
            //Implement js function to handle back button here...
            return false;
        });
        <?php }?>
    });
    // Execute some functions just before leaving the current page (Not supported on Safari)
    window.onbeforeunload = function() {
        //$('#loadingoverlay').fadeIn("slow");
        //This is causing issues on Safari, removing for now...
        //showAjaxOverlay();
    };
    // Safari
    function pageHidden(evt)
    {
        if (evt.persisted) {
            showAjaxOverlay();
        }
        else {
            showAjaxOverlay();
        }
    }
    //This is causing issues on Safari, removing for now...
    //window.addEventListener("pagehide", pageHidden, false);
    //checkConnectionOnInterval();
    window.addEventListener('offline', networkStatus);
    window.addEventListener('online', networkStatus);
    function networkStatus(e) {
    	if (e.type == 'offline')
    		setOffline();
    	else
		    setOnline();
    }
</script>