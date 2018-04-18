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
function getHighestZIndex() {
    var index_highest = 0;
    $('div').each(function(){
        var index_current = parseInt($(this).css("z-index"), 10);
        if(index_current > index_highest) {
            index_highest = index_current;
        }
    });
    return index_highest;
}
function showAjaxOverlay(style) {
    style = style || 'icon';
    $ajaxOverlayDiv = $( "<div class='ajaxoverlay'/>" );
    $ajaxOverlayDiv.css( "zIndex", getHighestZIndex()+1 );
    var newHighestIndex = getHighestZIndex()+2;
    $ajaxMessageDiv = $("<div class='ajaxoverlaymessage'/>");
    $ajaxMessageDiv.css( "zIndex", getHighestZIndex()+2 );
    var html = '';
    if (style == 'default'){
        $ajaxMessageDiv.css( "width","300px" );
        html = '<div class="row" style="text-align:center;"> ' +
            '<div class="col-md-4"></div><div class="col-md-4">Working...</div><div class="col-md-4"></div></div>' +
            '<div id="followingBallsG"> ' +
            '<div id="followingBallsG_1" class="followingBallsG"> ' +
            '</div> ' +
            '<div id="followingBallsG_2" class="followingBallsG"> ' +
            '</div> ' +
            '<div id="followingBallsG_3" class="followingBallsG"> ' +
            '</div> ' +
            '<div id="followingBallsG_4" class="followingBallsG"> ' +
            '</div>' +
            '</div>';
    } else if (style == 'icon') {
        $ajaxMessageDiv.css( "width","30px" );
        $ajaxMessageDiv.css( "height","30px" );
        $ajaxMessageDiv.css( "border-radius","100%" );
        $ajaxMessageDiv.css( "border-left","2px solid #ffffff" );
        $ajaxMessageDiv.css( "border-bottom","2px solid #ffffff" );
        $ajaxMessageDiv.css( "opacity", "1");
        $ajaxMessageDiv.css( "background-color", "transparent");
        $ajaxMessageDiv.css( "filter", "alpha(opacity=100)");
        $ajaxMessageDiv.addClass('BorderSpin');

        $ajaxOverlayDiv.css( "opacity", "0.7");
        $ajaxOverlayDiv.css( "background-color", "#000000");
        $ajaxOverlayDiv.css( "filter", "alpha(opacity=70)");

        $ajaxMessageIconDiv = $("<div class='ajaxoverlayicon'/>");
        $ajaxMessageIconDiv.css( "zIndex", getHighestZIndex()+3 );
        $ajaxMessageIconDiv.css( "width","36px" );
        $ajaxMessageIconDiv.css( "height","36px" );
        $ajaxMessageIconDiv.css( "border-radius","100%" );
        $ajaxMessageIconDiv.css( "margin-top","3px" );
        $ajaxMessageIconDiv.css( "background", "url("+FavIconUrl+") no-repeat center");
        $ajaxMessageIconDiv.css( "background-color", "#ffffff");
        $ajaxMessageIconDiv.css( "-webkit-background-size","contain" );
        $ajaxMessageIconDiv.css( "-moz-background-size","contain" );
        $ajaxMessageIconDiv.css( "-o-background-size","contain" );
        $ajaxMessageIconDiv.css( "background-size","contain" );
    }

    $ajaxMessageDiv.html(html);
    $( "body" ).append($ajaxOverlayDiv);
    $( "body" ).append($ajaxMessageDiv);
    $( "body" ).append($ajaxMessageIconDiv);
}
function removeAjaxOverlay() {
    $('.ajaxoverlay').remove();
    $('.ajaxoverlayicon').remove();
    $('.ajaxMessageIconDiv').remove();
    $('.ajaxoverlaymessage').remove();
}
function resizeIframe(iframe,bottomPadding) {
    var padding = 0;
    if (bottomPadding)
        padding += bottomPadding;
    iframe.height = '';
    iframe.height = iframe.contentWindow.document.body.offsetHeight+padding + "px";
    console.log(iframe.height);
}
function InitScrolling() {
    var isMac = (navigator.userAgent.indexOf('Macintosh') > 0);
    // Check for not Mac or not chrome and only then apply this jscrollpane
    if (navigator.userAgent.indexOf('AppleWebKit') > 0) {
        //console.log('Webkit Available: '+navigator.userAgent); // Debug purposes
        //console.log('Not applying jScrollPane...');
    } else {
        //console.log('Webkit not available: '+navigator.userAgent); // Debug purposes
        console.log('Applying jScrollPane since Webkit is not supported');
        $('.scrollPane').jScrollPane(); // Add the class scrollPane to any div that needs to not show scrollbars (if not Mac or Chrome - Webkit)
    }

    var myDiv = document.getElementById('mainNavbar'); //get #myDiv
    if (myDiv) {
        document.body.style.paddingTop = myDiv.clientHeight+'px';
        $( ".jspPane" ).css( "padding-top", myDiv.clientHeight+"px" );
    }

    //Prevent page "over scrolling"
    if (navigator.platform == 'iPad' || navigator.platform == 'iPhone' || navigator.platform == 'iPod' || navigator.platform == 'Linux armv6l') {

    } else {
        /*if (isMac) {
            setTimeout(function () {$('head').append('<style type="text/css">html, body {width: 100%;height: 100%;overflow: hidden;}body > div {height: 100%;overflow: scroll; -webkit-overflow-scrolling: touch;}</style>')}
                ,1000);
        }*/
        //Removing this for now as it is not working properly
    }
}
function ShowNotedFeedback(feedbackMessage,good,autoHide,duration,goodColor,badColor,textColor,position) {
    feedbackMessage = feedbackMessage || "Message";
    good = good && true;
    autoHide = autoHide && true;
    duration = duration || 5000;
    goodColor = goodColor || "#3c9a5f";
    badColor = badColor || "#dd3333";
    textColor = textColor || "#ffffff";
    position = position || "top";

    $('#notedFeedback').remove();
    $("body").append('<div id="notedFeedback">' +
        '<span id="notedFeedbackText">Notification Text</span> ' +
        '<button id="closeNotedFeedback" type="button" class="close" aria-label="Close" style="color:#000000;  top: 5px;position: absolute;right: 10px;"> ' +
        '<span aria-hidden="true">&times;</span> ' +
        '</button></div>');

    if (good) {
        $("#notedFeedback" ).css( "background-color", goodColor );
    } else {
        $("#notedFeedback" ).css( "background-color", badColor );
    }
    $("#notedFeedback" ).css( "z-index", getHighestZIndex()+1 );
    $("#notedFeedback" ).css( "color", textColor );
    $("#notedFeedback" ).css( position, "0px" );
    $("#notedFeedback" ).css( "position", "fixed" );
    $("#notedFeedback" ).css( "text-align", "center" );
    $("#notedFeedback" ).css( "padding-top", "5px" );
    $("#notedFeedback" ).css( "padding-bottom", "5px" );
    $("#notedFeedback" ).css( "line-height", "1.5" );
    $("#notedFeedback" ).css( "overflow", "hidden" );
    $("#notedFeedback" ).css( "-webkit-box-shadow", "0 0 5px black" );
    $("#notedFeedback" ).css( "-moz-box-shadow", "0 0 5px black" );
    $("#notedFeedback" ).css( "box-shadow", "0 0 5px black" );
    $("#notedFeedback" ).css( "display", "none" );
    $("#notedFeedback" ).css( "opacity", "0.95" );
    $("#notedFeedback" ).css( "font-weight", "100" );
    $("#notedFeedback" ).css( "height", "60px" );
    $("#notedFeedback" ).css( "width", "100%" );

    $("#notedFeedbackText").html(feedbackMessage);
    $("#notedFeedback").slideDown( 200, function() {
        // Animation complete.
    });
    if (autoHide) {
        ToggleCanRemoveNotedFeedback(true);
        setTimeout(function() {
            if (canRemoveNotedFeedback) {
                $("#notedFeedback").slideUp( 200, function() {
                    // Animation complete.
                    $('#notedFeedback').remove();
                });
            }
        }, duration);
    }
    close = document.getElementById("closeNotedFeedback");
    close.addEventListener('click', function() {
        $( "#notedFeedback" ).slideUp( 200, function() {
            // Animation complete.
            $('#notedFeedback').remove();
        });
    }, false);
}
function ToggleCanRemoveNotedFeedback(bValue) {
    canRemoveNotedFeedback = bValue;
}
function checkConnection(interval,callback,strForm, strControl, strEvent, mixParameter, strWaitIconControlId) {
    //console.log("Checking connection...");
	callback(true,strForm, strControl, strEvent, mixParameter, strWaitIconControlId); // For now, we are removing
    // this as it is unreliable
    return;
    /*if (navigator.online) {
	    setOffline();
	    callback(true,strForm, strControl, strEvent, mixParameter, strWaitIconControlId);
    } else {
        setOffline();
	    callback(false,strForm, strControl, strEvent, mixParameter, strWaitIconControlId);
    }
    return;*/
    /*try {
        $.ajax({url: baseUrl+"assets/_core/php/helpers/is_online.php/",
            type: "HEAD",
            timeout:3000,
            statusCode: {
                200: function (response) {
                    //Working
                    //console.log("Online...");
                    if ($('#OfflineNotification').length) {
                        //Remove the notification
                        setOnline();
                    }
                    callback(true,strForm, strControl, strEvent, mixParameter, strWaitIconControlId);
                },
                400: function (response) {
                    //Offline
                    //console.log("Offline...");
                    if ($('#OfflineNotification').length) {
                        //Do Nothing
                    } else {
                        //Add the notification
                        setOffline();
                    }
                    callback(false,strForm, strControl, strEvent, mixParameter, strWaitIconControlId);
                },
                0: function (response) {
                    //Offline
                    //console.log("Offline...");
                    if ($('#OfflineNotification').length) {
                        //Do Nothing
                    } else {
                        //Add the notification
                        setOffline();
                    }
                    callback(false,strForm, strControl, strEvent, mixParameter, strWaitIconControlId);
                }
            },
        });
    } catch (error){
        //Offline
        //console.log("Offline...");
        if ($('#OfflineNotification').length) {
            //Do Nothing
        } else {
            //Add the notification
            setOffline();
        }
        callback(false,strForm, strControl, strEvent, mixParameter, strWaitIconControlId);
    }*/
}
function checkConnectionOnInterval() {
    checkConnection(0,ConnectionCheckCallback);
}
function ConnectionCheckCallback(isOnline) {
    if (isOnline) {
        if ($('#OfflineNotification').length) {
            //Remove the notification
            setOnline();
        }
    } else {
        if ($('#OfflineNotification').length) {
            //Do Nothing
        } else {
            //Add the notification
            setOffline();
        }
    }
    setTimeout(function() {
        checkConnection(0,ConnectionCheckCallback);
    }, connectionCheckInterval);
}
function setOffline() {
    $("body").append('<div id="OfflineNotification"><p><i class="fa fa-chain-broken" aria-hidden="true" style="margin-right: 10px;"></i>' +
        ' You\'re' +
        ' Offline</p></div>');
    /*$( "#OfflineRecheck" ).click(function() {
        checkConnection(0);
    });
    connectionCheckInterval = 5000;*/
	$ajaxOverlayDiv = $( "<div class='OfflineOverlay'/>" );
	$ajaxOverlayDiv.css( "zIndex", getHighestZIndex()+1 );
	$( "body" ).append($ajaxOverlayDiv);
	$("#OfflineNotification").css("zIndex", getHighestZIndex()+1);
	$(".OfflineOverlay").fadeOut(3500);
}
function setOnline() {
    $('#OfflineNotification').remove();
    //connectionCheckInterval = 45000;
}

function InitDeveloperMode() {
    if (!isInDevMode)
        return;
    var wrapper_zIndex = getHighestZIndex()+1;
    var wrapper_toggle_zIndex = wrapper_zIndex + 1;
    $("body").append('<div id="DevModeWrapperSideButton" class="DevModeWrapperToggle" style="z-index:'+wrapper_toggle_zIndex+'">Developers</div>');
    $("body").append('<div id="DevModeWrapper" style="z-index:'+wrapper_zIndex+'"></div>');

    $("#DevModeWrapperSideButton").on("click", function () {
        // Set the effect type
        var effect = 'slide';

        // Set the options for the effect type chosen
        var options = { direction: 'right' };

        // Set the duration (default: 400 milliseconds)
        var duration = 500;

        $('#DevModeWrapper').toggle(effect, options, duration);
        $('#DevModeWrapperSideButton').toggle(effect, options, duration);

        if (!isDevContentLoaded) {
            $.post( baseUrl+"assets/_core/php/DeveloperMode/DeveloperModeContent.php/")
                .done(function( data ) {
                    $('#DevModeWrapper').html(data);
                    updateDeveloperLog();
                    isDevContentLoaded = true;
                    var position = $('#CustomLogsWrapper').position();
                    var totalHeight = $( window ).height();
                    var elHeight = totalHeight - position.top - 10;
                    $('#CustomLogsWrapper').height(elHeight);
                    $('#CustomLogsWrapper').css("overflow","scroll");
                    $('#CustomLogsWrapper').css("border","2px solid #f1f1f1");
                    $('#CustomLogsWrapper').css("border-radius","5px");
                });
        }
    });
}
function clearDeveloperLog() {
    $.post( baseUrl+"assets/_core/php/DeveloperMode/DeveloperModeActions.php/", { clearLog: "1"})
        .done(function( data ) {
            $('#CustomLogsWrapper').html('');
        });
}
function updateDeveloperLog() {
    $.post( baseUrl+"assets/_core/php/DeveloperMode/DeveloperModeActions.php/", { getLog: "1"})
        .done(function( data ) {
            $('#CustomLogsWrapper').html(data);
        });
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}

function getHeightValueForPercentage(percentage) {
    percentage = percentage || 100;
    var height = $( window ).height();
    var perc = percentage/100;
    return Math.round(height*perc);
}
function getCheckableControlArray_Json() {
    if (typeof CheckableControlArray !== 'undefined') {
        return JSON.stringify(CheckableControlArray);
    } else {
        return '';
    }
}
function RegisterCheckableControls() {
    $('.CheckableControl').on('click', function() {
        CheckableControlArray[$(this).attr('id')].checked = !CheckableControlArray[$(this).attr('id')].checked;
        console.log((CheckableControlArray));
        if (CheckableControlArray[$(this).attr('id')].checked) {
            $(this).removeClass('label-default');
            $(this).addClass('label-success');
        } else {
            $(this).removeClass('label-success');
            $(this).addClass('label-default');
        }
    });
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function addValidationStateToInput(ctlId,message) {
    message = message || '';
    $('#'+ctlId).effect("highlight", {}, 3000);
    $( "#"+ctlId ).parent().addClass('has-error');
    $( "#"+ctlId ).parent().append('<label id="'+ctlId+'_validationLabel" class="control-label">'+message+'</label>');
}
function removeValidationStateFromInput(ctlId) {
    $( "#"+ctlId ).parent().removeClass('has-error');
    $("#"+ctlId+"_validationLabel").remove();
}

function addSideBar(Position,Width,BackgroundColor,CollapseIcon,ItemColor,ItemBackgroundColor,ItemColorHover,ItemBackgroundColorHover,ItemColorActive,ItemBackgroundColorActive,MenuName,ActiveLabel,StartCollapsed) {
    Position = Position || 'LEFT';
    Width = Width || '220';
    BackgroundColor = BackgroundColor || '#3a3a3a';
    CollapseIcon = CollapseIcon || '<i class="fa fa-bars" aria-hidden="true"></i>';
    ItemColor = ItemColor || '#ffffff';
    ItemBackgroundColor = ItemBackgroundColor || '#3a3a3a';
    ItemColorHover = ItemColorHover || '#ffffff';
    ItemBackgroundColorHover = ItemBackgroundColorHover || '#006687';
    ItemColorActive = ItemColorActive || '#ffffff';
    ItemBackgroundColorActive = ItemBackgroundColorActive || '#006687';
    ActiveLabel = ActiveLabel || '';
    StartCollapsed = StartCollapsed || false;

    var item = $('#mainNavbar');
    var minTop = 0;
    if (item) {
        minTop = item.height();
    }
    if (Position == 'LEFT') {
        LeftSideBarCollapsed = false;
        $("#wrapper").before('<div id="LeftSideBar"></div>');
        $( "#LeftSideBar" ).load(baseUrl+"/includes/configuration/SideBars/"+MenuName+".php?ActiveLabel="+ActiveLabel);
        $("#LeftSideBar").css("position","fixed");
        $("#LeftSideBar").css("top",(minTop)+"px");
        $("#LeftSideBar").css("padding-top","50px");
        $("#LeftSideBar").css("left","0px");
        $("#LeftSideBar").css("width",Width+"px");
        $("#LeftSideBar").css("height","100%");
        $("#LeftSideBar").css("background-color",BackgroundColor);
        $("#LeftSideBar").css("color",ItemColor);

        $('body').append('<style>#LeftSideBar .nav > li > a {color: '+ItemColor+';background-color: '+ItemBackgroundColor+';}' +
            '#LeftSideBar .nav > li > a:hover {color: '+ItemColorHover+';background-color: '+ItemBackgroundColorHover+';}' +
            '#LeftSideBar .nav > li > a:focus {color: '+ItemColorActive+';background-color: '+ItemBackgroundColorActive+';}' +
            '#LeftSideBar .nav > li.active > a {color: '+ItemColorActive+';background-color: '+ItemBackgroundColorActive+';}</style>');


        $("#wrapper").css("padding-left",Width+"px");

        $("body").append('<button id="btnLeftSideBarCollapse" type="button">'+CollapseIcon+'</button>');
        $("#btnLeftSideBarCollapse").css("position","fixed");
        $("#btnLeftSideBarCollapse").css("top",minTop+"px");
        $("#btnLeftSideBarCollapse").css("left","0px");
        $("#btnLeftSideBarCollapse").css("width",Width+"px");
        $("#btnLeftSideBarCollapse").css("height","50px");
        $("#btnLeftSideBarCollapse").css("background-color",BackgroundColor);
        $("#btnLeftSideBarCollapse").css("color",ItemColor);
        $("#btnLeftSideBarCollapse").css("text-align","center");
        $("#btnLeftSideBarCollapse").css("text-indent",(Width/2-25)+"px");
        $("#btnLeftSideBarCollapse").css("border","none");
        $("#btnLeftSideBarCollapse").css("outline","none");
        $("#btnLeftSideBarCollapse").css("box-shadow","0px -1px 0px "+shade(BackgroundColor,0.2)+" inset");

        if (StartCollapsed) {
            doSideBarAnimation($("#LeftSideBar"),$("#btnLeftSideBarCollapse"),'left','','',0,Width,50);
        } else {
            LeftSideBarCollapsed = false;
        }

        $("#btnLeftSideBarCollapse").on("click", function() {
            doSideBarAnimation($("#LeftSideBar"),$("#btnLeftSideBarCollapse"),'left','','',500,Width,50);
        });
    }
    else {
        if (Position == "RIGHT") {
            RightSideBarCollapsed = false;
            $("#wrapper").after('<div id="RightSideBar" class="RightSideBar"></div>');
            $( "#RightSideBar" ).load(baseUrl+"/includes/configuration/SideBars/"+MenuName+".php?ActiveLabel="+ActiveLabel);
            $("#RightSideBar").css("position","fixed");
            $("#RightSideBar").css("top",(minTop)+"px");
            $("#RightSideBar").css("padding-top","50px");
            $("#RightSideBar").css("right","0px");
            $("#RightSideBar").css("width",Width+"px");
            $("#RightSideBar").css("height","100%");
            $("#RightSideBar").css("background-color",BackgroundColor);
            $("#RightSideBar").css("text-align", "center");
            $('body').append('<style>#RightSideBar .nav > li > a {color: '+ItemColor+';background-color: '+ItemBackgroundColor+';}' +
                '#RightSideBar .nav > li > a:hover {color: '+ItemColorHover+';background-color: '+ItemBackgroundColorHover+';}' +
                '#RightSideBar .nav > li > a:focus {color: '+ItemColorActive+';background-color: '+ItemBackgroundColorActive+';}' +
                '#RightSideBar .nav > li.active > a {color: '+ItemColorActive+';background-color: '+ItemBackgroundColorActive+';}</style>');
            $("#wrapper").css("padding-right",Width+"px");

            $("body").append('<button id="btnRightSideBarCollapse" type="button">'+CollapseIcon+'</button>');
            $("#btnRightSideBarCollapse").css("position","fixed");
            $("#btnRightSideBarCollapse").css("top",minTop+"px");
            $("#btnRightSideBarCollapse").css("right","0px");
            $("#btnRightSideBarCollapse").css("width",Width+"px");
            $("#btnRightSideBarCollapse").css("height","50px");
            $("#btnRightSideBarCollapse").css("background-color",BackgroundColor);
            $("#btnRightSideBarCollapse").css("color",ItemColor);
            $("#btnRightSideBarCollapse").css("text-align","center");
            $("#btnRightSideBarCollapse").css("border","none");
            $("#btnRightSideBarCollapse").css("outline","none");
            $("#btnRightSideBarCollapse").css("box-shadow","0px -1px 0px "+shade(BackgroundColor,0.2)+" inset");

            if (StartCollapsed) {
                doSideBarAnimation($("#RightSideBar"),$("#btnRightSideBarCollapse"),'right','',{direction: "right"},0,Width,50);
            } else {
                RightSideBarCollapsed = false;
            }

            $("#btnRightSideBarCollapse").on("click", function() {
                doSideBarAnimation($("#RightSideBar"),$("#btnRightSideBarCollapse"),'right','',{direction: "right"},500,Width,50);
            });
        }
    }
}
function doSideBarAnimation(sidebar,togglebutton,side,effect,options,duration,barWidth,toggleBtnHeight) {
    effect = effect || 'slide';
    options = options || { direction: 'left' };
    duration = duration|| 500;
    side = side || 'left';
    var widthCorrection = barWidth;
    var btnSideBarCollapseHeight = toggleBtnHeight;
    var toggleBtnOpacity = 1;
    var WrapperPadding = barWidth;
    var toggleBtnTextIndent = 0;
    sidebar.toggle(effect, options, duration);

    if (side == 'left') {
        if (LeftSideBarCollapsed == false) {
            toggleBtnOpacity = 0.2;
            WrapperPadding = 0;
            widthCorrection = 30;
            btnSideBarCollapseHeight = 30;
            toggleBtnTextIndent = 0;
        } else {
            toggleBtnOpacity = 1;
            WrapperPadding = barWidth;
            widthCorrection = barWidth;
            btnSideBarCollapseHeight = toggleBtnHeight;
            if(barWidth < 100) {
                toggleBtnTextIndent = 0;
            } else {
                toggleBtnTextIndent = barWidth/2-25;
                if (toggleBtnTextIndent < 0)
                    toggleBtnTextIndent = 0;
            }
        }
        togglebutton.animate({
            opacity:toggleBtnOpacity,
            width:widthCorrection,
            textIndent:toggleBtnTextIndent,
            height:btnSideBarCollapseHeight
        }, duration, function() {
            // Animation complete.
            LeftSideBarCollapsed = !LeftSideBarCollapsed;
        });

        $( "#wrapper" ).animate({
            paddingLeft: WrapperPadding
        }, duration, function() {
            // Animation complete.
        });
    } else {
        if (side == 'right') {
            if (RightSideBarCollapsed == false) {
                toggleBtnOpacity = 0.2;
                WrapperPadding = 0;
                widthCorrection = 30;
                btnSideBarCollapseHeight = 30;
            } else {
                toggleBtnOpacity = 1;
                WrapperPadding = barWidth;
                widthCorrection = barWidth;
                btnSideBarCollapseHeight = toggleBtnHeight;
            }
            togglebutton.animate({
                opacity:toggleBtnOpacity,
                width:widthCorrection,
                height:btnSideBarCollapseHeight
            }, duration, function() {
                // Animation complete.
                RightSideBarCollapsed = !RightSideBarCollapsed;
            });

            $( "#wrapper" ).animate({
                paddingRight: WrapperPadding
            }, duration, function() {
                // Animation complete.
            });
        }
    }
}
function shadeColor(color, percent) {
    var f=parseInt(color.slice(1),16),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=f>>16,G=f>>8&0x00FF,B=f&0x0000FF;
    return "#"+(0x1000000+(Math.round((t-R)*p)+R)*0x10000+(Math.round((t-G)*p)+G)*0x100+(Math.round((t-B)*p)+B)).toString(16).slice(1);
}
function shadeRGBColor(color, percent) {
    var f=color.split(","),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=parseInt(f[0].slice(4)),G=parseInt(f[1]),B=parseInt(f[2]);
    return "rgb("+(Math.round((t-R)*p)+R)+","+(Math.round((t-G)*p)+G)+","+(Math.round((t-B)*p)+B)+")";
}
function shade(color, percent){
    if (color.length > 7 ) return shadeRGBColor(color,percent);
    else return shadeColor(color,percent);
}
function initClickAnimations() {
	var ink, d, x, y;
	$(document).on('click', '.rippleclick', function(e) {
		if ($(this).children('.ink').length > 0) {
			ink = $(this).find('.ink');
			ink.removeClass("doAnimate");
		} else {
			$(this).prepend("<span class='ink'></span>");
			ink = $(this).find('.ink');
		}
		
		//use parent's width or height whichever is larger for the diameter to make a circle which can cover the entire element.
		d = Math.max($(this).outerWidth(), $(this).outerHeight());
		ink.css({height: d, width: d});
		ink.css("background",$(this).css("color"));
		
		//get click coordinates
		//logic = click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center;
		x = e.pageX - $(this).offset().left - ink.width()/2;
		y = e.pageY - $(this).offset().top - ink.height()/2;
		
		//set the position and add class .doAnimate
		ink.css({top: y+'px', left: x+'px'}).addClass("doAnimate");
		setTimeout(function() {
		    ink.remove();
        },1000)
	});
}