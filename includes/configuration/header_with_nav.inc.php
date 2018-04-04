<?php
require ('HeaderComponents/standard_header_init.inc.php');
?>
<div id="wrapper">
    <?php echo AppMenus::getMenu('Default',MenuType::navbarInverseFixedTop,$strPageTitle,true,__APPNAME__,'mainNavbar',true);?>

    <div class="container-fluid" id="ieInfo"></div>
	<div class="container">

        <script> var isIE = /*@cc_on!@*/false || !!document.documentMode;
            if (isIE) {
                var html = '<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Warning!</strong> We have detected that you are using Internet Explorer. Please note that Internet Explorer is not fully supported since it poses significant performance and security drawbacks. You can download a supported browser <a href="http://www.google.com/chrome/" target=blank>here</a> </div>';
                document.getElementById("ieInfo").innerHTML = html;
                //alert('The browser you are using is not fully supported. Please use ANY other browser');
            }
        </script>

