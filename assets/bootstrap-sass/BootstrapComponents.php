<?php require('../../sdev.inc.php');?>
<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap Components</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/bootstrap.min.css");</style>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/bootstrapmodifications.css");</style>
    <style type="text/css">
        body {
            padding-top:0px;
        }
        @media screen and (min-width: 992px) {
            .the-icons li {
                width: 12.5%;
            }
        }

        .the-buttons > li {
            float: left;
            height: 80px;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 12px;
            line-height: 1.25;
            text-align: center;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0 -1px -1px 0;
        }

        .the-icons .glyphicon {
            display: block;
            margin: 5px auto;
            vertical-align: middle;
            margin-right: 3px;
            font-size: 24px;
        }

        .the-icons li {
            float: left;
            width: 100px;
            height: 110px;
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 12px;
            line-height: 1.25;
            text-align: center;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0 auto;
        }

        .the-icons, .the-buttons {
            list-style:none;
        }

        .the-icons .glyphicon {
            display:inline;
        }
    </style>
</head>
<body>
<h1>Bootstrap Template</h1>
<!-- Typography
================================================== -->
<section id="typography">

    <!-- Headings & Paragraph Copy -->
    <div class="row">

        <div class="col-lg-6">
            <div class="well">
                <h1>h1. Heading 1</h1>
                <h2>h2. Heading 2</h2>
                <h3>h3. Heading 3</h3>
                <h4>h4. Heading 4</h4>
                <h5>h5. Heading 5</h5>
                <h6>h6. Heading 6</h6>
            </div>
        </div>

        <div class="col-lg-6">
            <h3>A Title</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in mauris a nibh porttitor varius. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent finibus non ex at aliquam. Cras aliquam sollicitudin nulla. Nullam non urna quis nisl viverra vulputate ac ut purus. Nam ac odio eros. Etiam in congue enim, at commodo metus. Sed sollicitudin condimentum sapien, eu facilisis tellus bibendum ac. Sed fermentum euismod sem ac venenatis. Nullam viverra aliquam metus, non viverra ipsum vehicula ac. Proin lacinia lorem nec finibus consequat. Donec diam sapien, placerat id arcu non, gravida varius nulla. Proin at finibus dui. Integer erat massa, egestas nec odio id, sodales condimentum mauris. Nullam viverra, quam a blandit pretium, quam urna tempus orci, sit amet tempus tortor magna in ante.</p>
            <hr>
            <blockquote class="pull-right">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in mauris a nibh porttitor varius. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent finibus non ex at aliquam. Cras aliquam sollicitudin nulla. Nullam non urna quis nisl viverra vulputate ac ut purus. Nam ac odio eros. Etiam in congue enim, at commodo metus. Sed sollicitudin condimentum sapien, eu facilisis tellus bibendum ac. Sed fermentum euismod sem ac venenatis. Nullam viverra aliquam metus, non viverra ipsum vehicula ac. Proin lacinia lorem nec finibus consequat. Donec diam sapien, placerat id arcu non, gravida varius nulla. Proin at finibus dui. Integer erat massa, egestas nec odio id, sodales condimentum mauris. Nullam viverra, quam a blandit pretium, quam urna tempus orci, sit amet tempus tortor magna in ante.</p>
                <small><cite title="Source Title">Quasipickle</cite></small>
            </blockquote>

        </div>
    </div>

</section>

<!-- Bootstrap 3 Navbar
================================================== -->
<section id="navbar">
    <div class="page-header">
        <h1>Navbar</h1>
    </div>

    <div class="container">

        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Title</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>

    </div>



    <div class="container">

        <nav class="navbar navbar-inverse" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Title</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>

    </div>

</section>

<section>
    <!--Bootstrap 3 Scaffolding-->
    <div class="page-header">
        <h1>Grid</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12"><div class="well"><p>col-lg-12</p></div></div>
        </div>
        <div class="row">
            <div class="col-lg-4"><div class="well"><p>col-lg-4</p></div></div>
            <div class="col-lg-4"><div class="well"><p>col-lg-4</p></div></div>
            <div class="col-lg-4"><div class="well"><p>col-lg-4</p></div></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6"><div class="well"><p>col-lg-6</p></div></div>
            <div class="col-lg-6 col-sm-6"><div class="well"><p>col-lg-6</p></div></div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-sm-6"><div class="well">col-lg-9 / col-sm-6</div></div>
            <div class="col-lg-3 col-sm-6"><div class="well">col-lg-3 / col-sm-6</div></div>
        </div>
    </div>
</section>

<!-- Bootstrap 3 Buttons
================================================== -->
<section id="buttons">
    <div class="page-header">
        <h1>Buttons</h1>
    </div>

    <h2>Button Sizes (4)</h2>
    <ul class="the-buttons clearfix">
        <li><a class="btn btn-xs btn-primary" href="#">btn-xs</a></li>
        <li><a class="btn btn-sm btn-primary" href="#">btn-sm</a></li>
        <li><a class="btn btn-primary" href="#">btn</a></li>
        <li><a class="btn btn-lg btn-primary" data-toggle="modal" href="#myModal">btn-lg (Opens a modal)</a></li>
    </ul>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Modal header</h3>
                </div>
                <div class="modal-body">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true" type="button">Close</button>
                    <button class="btn btn-primary" type="button">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <h2>Button Classes</h2>
    <ul class="the-buttons clearfix">
        <li><a class="btn btn-default" href="#">Default</a></li>
        <li><a class="btn btn-primary" href="#">Primary</a></li>
        <li><a class="btn btn-success" href="#">Success</a></li>
        <li><a class="btn btn-info" href="#">Info</a></li>
        <li><a class="btn btn-warning" href="#">Warning</a></li>
        <li><a class="btn btn-danger" href="#">Danger</a></li>
        <li><a class="btn btn-primary disabled" href="#">Disabled</a></li>
        <li><a class="btn btn-link" href="#">Link</a></li>
        <li>
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Dropdown <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>
        </li>
    </ul>



</section>

<!-- Icons
================================================== -->
<!--<section id="icons">
  <div class="page-header">
    <h2>Bootstrap 3 Icons</h2>
    <p class="lead">The 2.x icons are now replaced by glyphicons in BS3.</p>
  </div>
  <div class="row">

  	<ul class="the-icons clearfix">
      <li><i class="glyphicon glyphicon-glass"></i> glyphicon-glass</li>
      <li><i class="glyphicon glyphicon-music"></i> glyphicon-music</li>
      <li><i class="glyphicon glyphicon-search"></i> glyphicon-search</li>
      <li><i class="glyphicon glyphicon-envelope"></i> glyphicon-envelope</li>
      <li><i class="glyphicon glyphicon-heart"></i> glyphicon-heart</li>
      <li><i class="glyphicon glyphicon-star"></i> glyphicon-star</li>
      <li><i class="glyphicon glyphicon-star-empty"></i> glyphicon-star-empty</li>
      <li><i class="glyphicon glyphicon-user"></i> glyphicon-user</li>
      <li><i class="glyphicon glyphicon-film"></i> glyphicon-film</li>
      <li><i class="glyphicon glyphicon-th-large"></i> glyphicon-th-large</li>
      <li><i class="glyphicon glyphicon-th"></i> glyphicon-th</li>
      <li><i class="glyphicon glyphicon-th-list"></i> glyphicon-th-list</li>
      <li><i class="glyphicon glyphicon-ok"></i> glyphicon-ok</li>
      <li><i class="glyphicon glyphicon-remove"></i> glyphicon-remove</li>
      <li><i class="glyphicon glyphicon-zoom-in"></i> glyphicon-zoom-in</li>
      <li><i class="glyphicon glyphicon-zoom-out"></i> glyphicon-zoom-out</li>
      <li><i class="glyphicon glyphicon-off"></i> glyphicon-off</li>
      <li><i class="glyphicon glyphicon-signal"></i> glyphicon-signal</li>
      <li><i class="glyphicon glyphicon-cog"></i> glyphicon-cog</li>
      <li><i class="glyphicon glyphicon-trash"></i> glyphicon-trash</li>
      <li><i class="glyphicon glyphicon-home"></i> glyphicon-home</li>
      <li><i class="glyphicon glyphicon-file"></i> glyphicon-file</li>
      <li><i class="glyphicon glyphicon-time"></i> glyphicon-time</li>
      <li><i class="glyphicon glyphicon-road"></i> glyphicon-road</li>
      <li><i class="glyphicon glyphicon-download-alt"></i> glyphicon-download-alt</li>
      <li><i class="glyphicon glyphicon-download"></i> glyphicon-download</li>
      <li><i class="glyphicon glyphicon-upload"></i> glyphicon-upload</li>
      <li><i class="glyphicon glyphicon-inbox"></i> glyphicon-inbox</li>

      <li><i class="glyphicon glyphicon-play-circle"></i> glyphicon-play-circle</li>
      <li><i class="glyphicon glyphicon-repeat"></i> glyphicon-repeat</li>
      <li><i class="glyphicon glyphicon-refresh"></i> glyphicon-refresh</li>
      <li><i class="glyphicon glyphicon-list-alt"></i> glyphicon-list-alt</li>
      <li><i class="glyphicon glyphicon-lock"></i> glyphicon-lock</li>
      <li><i class="glyphicon glyphicon-flag"></i> glyphicon-flag</li>
      <li><i class="glyphicon glyphicon-headphones"></i> glyphicon-headphones</li>
      <li><i class="glyphicon glyphicon-volume-off"></i> glyphicon-volume-off</li>
      <li><i class="glyphicon glyphicon-volume-down"></i> glyphicon-volume-down</li>
      <li><i class="glyphicon glyphicon-volume-up"></i> glyphicon-volume-up</li>
      <li><i class="glyphicon glyphicon-qrcode"></i> glyphicon-qrcode</li>
      <li><i class="glyphicon glyphicon-barcode"></i> glyphicon-barcode</li>
      <li><i class="glyphicon glyphicon-tag"></i> glyphicon-tag</li>
      <li><i class="glyphicon glyphicon-tags"></i> glyphicon-tags</li>
      <li><i class="glyphicon glyphicon-book"></i> glyphicon-book</li>
      <li><i class="glyphicon glyphicon-bookmark"></i> glyphicon-bookmark</li>
      <li><i class="glyphicon glyphicon-print"></i> glyphicon-print</li>
      <li><i class="glyphicon glyphicon-camera"></i> glyphicon-camera</li>
      <li><i class="glyphicon glyphicon-font"></i> glyphicon-font</li>
      <li><i class="glyphicon glyphicon-bold"></i> glyphicon-bold</li>
      <li><i class="glyphicon glyphicon-italic"></i> glyphicon-italic</li>
      <li><i class="glyphicon glyphicon-text-height"></i> glyphicon-text-height</li>
      <li><i class="glyphicon glyphicon-text-width"></i> glyphicon-text-width</li>
      <li><i class="glyphicon glyphicon-align-left"></i> glyphicon-align-left</li>
      <li><i class="glyphicon glyphicon-align-center"></i> glyphicon-align-center</li>
      <li><i class="glyphicon glyphicon-align-right"></i> glyphicon-align-right</li>
      <li><i class="glyphicon glyphicon-align-justify"></i> glyphicon-align-justify</li>
      <li><i class="glyphicon glyphicon-list"></i> glyphicon-list</li>

      <li><i class="glyphicon glyphicon-indent-left"></i> glyphicon-indent-left</li>
      <li><i class="glyphicon glyphicon-indent-right"></i> glyphicon-indent-right</li>
      <li><i class="glyphicon glyphicon-facetime-video"></i> glyphicon-facetime-video</li>
      <li><i class="glyphicon glyphicon-picture"></i> glyphicon-picture</li>
      <li><i class="glyphicon glyphicon-pencil"></i> glyphicon-pencil</li>
      <li><i class="glyphicon glyphicon-map-marker"></i> glyphicon-map-marker</li>
      <li><i class="glyphicon glyphicon-adjust"></i> glyphicon-adjust</li>
      <li><i class="glyphicon glyphicon-tint"></i> glyphicon-tint</li>
      <li><i class="glyphicon glyphicon-edit"></i> glyphicon-edit</li>
      <li><i class="glyphicon glyphicon-share"></i> glyphicon-share</li>
      <li><i class="glyphicon glyphicon-check"></i> glyphicon-check</li>
      <li><i class="glyphicon glyphicon-move"></i> glyphicon-move</li>
      <li><i class="glyphicon glyphicon-step-backward"></i> glyphicon-step-backward</li>
      <li><i class="glyphicon glyphicon-fast-backward"></i> glyphicon-fast-backward</li>
      <li><i class="glyphicon glyphicon-backward"></i> glyphicon-backward</li>
      <li><i class="glyphicon glyphicon-play"></i> glyphicon-play</li>
      <li><i class="glyphicon glyphicon-pause"></i> glyphicon-pause</li>
      <li><i class="glyphicon glyphicon-stop"></i> glyphicon-stop</li>
      <li><i class="glyphicon glyphicon-forward"></i> glyphicon-forward</li>
      <li><i class="glyphicon glyphicon-fast-forward"></i> glyphicon-fast-forward</li>
      <li><i class="glyphicon glyphicon-step-forward"></i> glyphicon-step-forward</li>
      <li><i class="glyphicon glyphicon-eject"></i> glyphicon-eject</li>
      <li><i class="glyphicon glyphicon-chevron-left"></i> glyphicon-chevron-left</li>
      <li><i class="glyphicon glyphicon-chevron-right"></i> glyphicon-chevron-right</li>
      <li><i class="glyphicon glyphicon-plus-sign"></i> glyphicon-plus-sign</li>
      <li><i class="glyphicon glyphicon-minus-sign"></i> glyphicon-minus-sign</li>
      <li><i class="glyphicon glyphicon-remove-sign"></i> glyphicon-remove-sign</li>
      <li><i class="glyphicon glyphicon-ok-sign"></i> glyphicon-ok-sign</li>

      <li><i class="glyphicon glyphicon-question-sign"></i> glyphicon-question-sign</li>
      <li><i class="glyphicon glyphicon-info-sign"></i> glyphicon-info-sign</li>
      <li><i class="glyphicon glyphicon-screenshot"></i> glyphicon-screenshot</li>
      <li><i class="glyphicon glyphicon-remove-circle"></i> glyphicon-remove-circle</li>
      <li><i class="glyphicon glyphicon-ok-circle"></i> glyphicon-ok-circle</li>
      <li><i class="glyphicon glyphicon-ban-circle"></i> glyphicon-ban-circle</li>
      <li><i class="glyphicon glyphicon-arrow-left"></i> glyphicon-arrow-left</li>
      <li><i class="glyphicon glyphicon-arrow-right"></i> glyphicon-arrow-right</li>
      <li><i class="glyphicon glyphicon-arrow-up"></i> glyphicon-arrow-up</li>
      <li><i class="glyphicon glyphicon-arrow-down"></i> glyphicon-arrow-down</li>
      <li><i class="glyphicon glyphicon-share-alt"></i> glyphicon-share-alt</li>
      <li><i class="glyphicon glyphicon-resize-full"></i> glyphicon-resize-full</li>
      <li><i class="glyphicon glyphicon-resize-small"></i> glyphicon-resize-small</li>
      <li><i class="glyphicon glyphicon-plus"></i> glyphicon-plus</li>
      <li><i class="glyphicon glyphicon-minus"></i> glyphicon-minus</li>
      <li><i class="glyphicon glyphicon-asterisk"></i> glyphicon-asterisk</li>
      <li><i class="glyphicon glyphicon-exclamation-sign"></i> glyphicon-exclamation-sign</li>
      <li><i class="glyphicon glyphicon-gift"></i> glyphicon-gift</li>
      <li><i class="glyphicon glyphicon-leaf"></i> glyphicon-leaf</li>
      <li><i class="glyphicon glyphicon-fire"></i> glyphicon-fire</li>
      <li><i class="glyphicon glyphicon-eye-open"></i> glyphicon-eye-open</li>
      <li><i class="glyphicon glyphicon-eye-close"></i> glyphicon-eye-close</li>
      <li><i class="glyphicon glyphicon-warning-sign"></i> glyphicon-warning-sign</li>
      <li><i class="glyphicon glyphicon-plane"></i> glyphicon-plane</li>
      <li><i class="glyphicon glyphicon-calendar"></i> glyphicon-calendar</li>
      <li><i class="glyphicon glyphicon-random"></i> glyphicon-random</li>
      <li><i class="glyphicon glyphicon-comment"></i> glyphicon-comment</li>
      <li><i class="glyphicon glyphicon-magnet"></i> glyphicon-magnet</li>

      <li><i class="glyphicon glyphicon-chevron-up"></i> glyphicon-chevron-up</li>
      <li><i class="glyphicon glyphicon-chevron-down"></i> glyphicon-chevron-down</li>
      <li><i class="glyphicon glyphicon-retweet"></i> glyphicon-retweet</li>
      <li><i class="glyphicon glyphicon-shopping-cart"></i> glyphicon-shopping-cart</li>
      <li><i class="glyphicon glyphicon-folder-close"></i> glyphicon-folder-close</li>
      <li><i class="glyphicon glyphicon-folder-open"></i> glyphicon-folder-open</li>
      <li><i class="glyphicon glyphicon-resize-vertical"></i> glyphicon-resize-vertical</li>
      <li><i class="glyphicon glyphicon-resize-horizontal"></i> glyphicon-resize-horizontal</li>
      <li><i class="glyphicon glyphicon-hdd"></i> glyphicon-hdd</li>
      <li><i class="glyphicon glyphicon-bullhorn"></i> glyphicon-bullhorn</li>
      <li><i class="glyphicon glyphicon-bell"></i> glyphicon-bell</li>
      <li><i class="glyphicon glyphicon-certificate"></i> glyphicon-certificate</li>
      <li><i class="glyphicon glyphicon-thumbs-up"></i> glyphicon-thumbs-up</li>
      <li><i class="glyphicon glyphicon-thumbs-down"></i> glyphicon-thumbs-down</li>
      <li><i class="glyphicon glyphicon-hand-right"></i> glyphicon-hand-right</li>
      <li><i class="glyphicon glyphicon-hand-left"></i> glyphicon-hand-left</li>
      <li><i class="glyphicon glyphicon-hand-up"></i> glyphicon-hand-up</li>
      <li><i class="glyphicon glyphicon-hand-down"></i> glyphicon-hand-down</li>
      <li><i class="glyphicon glyphicon-circle-arrow-right"></i> glyphicon-circle-arrow-right</li>
      <li><i class="glyphicon glyphicon-circle-arrow-left"></i> glyphicon-circle-arrow-left</li>
      <li><i class="glyphicon glyphicon-circle-arrow-up"></i> glyphicon-circle-arrow-up</li>
      <li><i class="glyphicon glyphicon-circle-arrow-down"></i> glyphicon-circle-arrow-down</li>
      <li><i class="glyphicon glyphicon-globe"></i> glyphicon-globe</li>
      <li><i class="glyphicon glyphicon-wrench"></i> glyphicon-wrench</li>
      <li><i class="glyphicon glyphicon-tasks"></i> glyphicon-tasks</li>
      <li><i class="glyphicon glyphicon-filter"></i> glyphicon-filter</li>
      <li><i class="glyphicon glyphicon-briefcase"></i> glyphicon-briefcase</li>
      <li><i class="glyphicon glyphicon-fullscreen"></i> glyphicon-fullscreen</li>

      <li><i class="glyphicon glyphicon-dashboard"></i> glyphicon-dashboard</li>
      <li><i class="glyphicon glyphicon-paperclip"></i> glyphicon-paperclip</li>
      <li><i class="glyphicon glyphicon-heart-empty"></i> glyphicon-heart-empty</li>
      <li><i class="glyphicon glyphicon-link"></i> glyphicon-link</li>
      <li><i class="glyphicon glyphicon-phone"></i> glyphicon-phone</li>
      <li><i class="glyphicon glyphicon-pushpin"></i> glyphicon-pushpin</li>
      <li><i class="glyphicon glyphicon-euro"></i> glyphicon-euro</li>
      <li><i class="glyphicon glyphicon-usd"></i> glyphicon-usd</li>
      <li><i class="glyphicon glyphicon-gbp"></i> glyphicon-gbp</li>
      <li><i class="glyphicon glyphicon-sort"></i> glyphicon-sort</li>
      <li><i class="glyphicon glyphicon-sort-by-alphabet"></i> glyphicon-sort-by-alphabet</li>
      <li><i class="glyphicon glyphicon-sort-by-alphabet-alt"></i> glyphicon-sort-by-alphabet-alt</li>
      <li><i class="glyphicon glyphicon-sort-by-order"></i> glyphicon-sort-by-order</li>
      <li><i class="glyphicon glyphicon-sort-by-order-alt"></i> glyphicon-sort-by-order-alt</li>
      <li><i class="glyphicon glyphicon-sort-by-attributes"></i> glyphicon-sort-by-attributes</li>
      <li><i class="glyphicon glyphicon-sort-by-attributes-alt"></i> glyphicon-sort-by-attributes-alt</li>
      <li><i class="glyphicon glyphicon-unchecked"></i> glyphicon-unchecked</li>
      <li><i class="glyphicon glyphicon-expand"></i> glyphicon-expand</li>
      <li><i class="glyphicon glyphicon-collapse"></i> glyphicon-collapse</li>
      <li><i class="glyphicon glyphicon-collapse-top"></i> glyphicon-collapse-top</li>
    </ul>
  </div>
</section>-->


<!-- Forms
================================================== -->
<section id="forms">
    <div class="page-header">
        <h2>Forms</h2>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <h3>Form Inline</h3>

            <form class="form-inline well">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Email">
                </div>
                <div class="col-md-3">
                    <input type="password" class="form-control" placeholder="Password">
                </div>
                <button type="button" class="btn btn-default">Sign in</button>
            </form>

            <h3>Form Horizontal</h3>
            <form class="form-horizontal well">
                <fieldset>
                    <legend>Bootstrap 3 Inputs</legend>
                    <div class="control-group">
                        <label class="control-label" for="input01">Text input</label>
                        <div class="controls">
                            <input type="text" class="form-control input-xlarge" id="input01">
                            <p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="select01">Select list</label>
                        <div class="controls">
                            <select id="select01" class="form-control">
                                <option>something</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="multiSelect">Multicon-select</label>
                        <div class="controls">
                            <select multiple="multiple" id="multiSelect" class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="fileInput">File input</label>
                        <div class="controls">
                            <input class="form-control input-file" id="fileInput" type="file">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="textarea">Textarea</label>
                        <div class="controls">
                            <textarea class="form-control input-xlarge" id="textarea" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="control-group warning">
                        <label class="control-label" for="inputWarning">Input with warning</label>
                        <div class="controls">
                            <input type="text" id="inputWarning" class="form-control">
                            <span class="help-inline">Something may have gone wrong</span>
                        </div>
                    </div>
                    <hr>
                    <div class="form-actions">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn">Cancel</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</section>

<!-- Tables
================================================== -->
<section id="tables">
    <div class="page-header">
        <h1>Tables</h1>
    </div>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
        </tr>
        </tbody>
    </table>
</section>


<!-- Miscellaneous
================================================== -->
<section id="miscellaneous">
    <div class="page-header">
        <h1>Miscellaneous</h1>
    </div>

    <div class="row">
        <div class="col-lg-4">

            <h3 id="breadcrumbs">Breadcrumbs</h3>
            <ul class="breadcrumb">
                <li><a href="#">Home</a> <span class="divider"></span></li>
                <li><a href="#">Library</a> <span class="divider"></span></li>
                <li class="active">Data</li>
            </ul>
        </div>
        <div class="col-lg-4">
            <h3 id="pagination">Pagination</h3>
            <ul class="pagination">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">»</a></li>
            </ul>
        </div>

        <div class="col-lg-4">
            <h3 id="pager">Pagers</h3>

            <ul class="pager">
                <li><a href="#">Previous</a></li>
                <li><a href="#">Next</a></li>
            </ul>

            <ul class="pager">
                <li class="previous disabled"><a href="#">? Older</a></li>
                <li class="next"><a href="#">Newer ?</a></li>
            </ul>
        </div>
    </div>


    <!-- Navs
    ================================================== -->

    <div class="row">
        <div class="col-lg-4">

            <h3 id="tabs">Tabs</h3>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#A" data-toggle="tab">Section 1</a></li>
                <li><a href="#B" data-toggle="tab">Section 2</a></li>
                <li><a href="#C" data-toggle="tab">Section 3</a></li>
            </ul>
            <div class="tabbable">
                <div class="tab-content">
                    <div class="tab-pane active" id="A">
                        <p></p>
                        <p>I'm in Section A.</p>
                    </div>
                    <div class="tab-pane" id="B">
                        <p>Howdy, I'm in Section B.</p>
                    </div>
                    <div class="tab-pane" id="C">
                        <p>What up girl, this is Section C.</p>
                    </div>
                </div>
            </div> <!-- /tabbable -->

        </div>
        <div class="col-lg-4">
            <h3 id="pills">Pills</h3>
            <ul class="nav nav-pills">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
                <li class="disabled"><a href="#">Disabled link</a></li>
            </ul>
        </div>

        <div class="col-lg-4">

            <h3 id="list">Nav Lists</h3>

            <div class="well" style="padding: 8px 0;">
                <ul class="nav nav-list">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li><a href="#">Applications</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Help</a></li>
                </ul>
            </div>
        </div>
    </div>


    <!-- Labels
    ================================================== -->

    <div class="row">
        <div class="col-lg-4">
            <h3 id="labels">Labels</h3>
            <span class="label label-default">Default</span>
            <span class="label label-success">Success</span>
            <span class="label label-warning">Warning</span>
            <span class="label label-danger">Danger</span>
            <span class="label label-info">Info</span>
        </div>
        <div class="col-lg-4">
            <h3 id="badges">Badges</h3>
            <span class="badge">Default</span>
        </div>
        <div class="col-lg-4">
            <h3 id="badges">Progress bars</h3>
            <div class="progress">
                <div class="progress-bar progress-bar-info" style="width: 20%"></div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-success" style="width: 40%"></div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <span class="sr-only">40% Complete (success)</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                    <span class="sr-only">20% Complete</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    <span class="sr-only">60% Complete (warning)</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80% Complete (danger)</span>
                </div>
            </div>
        </div>


    </div>
    <br>


    <!-- Panel & ListGroups
    ================================================== -->
    <hr>

    <h2>Panels</h2>

    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Panel default</div>
                <div class="panel-body">Some panel content.</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Panel primary</div>
                <div class="panel-body">Some panel content.</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-success">
                <div class="panel-heading">Panel success</div>
                <div class="panel-body">Some panel content.</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-info">
                <div class="panel-heading">Panel info</div>
                <div class="panel-body">Some panel content.</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-warning">
                <div class="panel-heading">Panel warning</div>
                <div class="panel-body">Some panel content.</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-danger">
                <div class="panel-heading">Panel danger</div>
                <div class="panel-body">Some panel content.</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-header">Alerts</h3>
            <div class="alert alert-success" role="alert">
                <a href="#" class="alert-link">Link</a> This is a <strong>success</strong> alert
            </div>
            <div class="alert alert-info" role="alert">
                <a href="#" class="alert-link">Link</a> This is an <strong>info</strong> alert
            </div>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="alert-link">Link</a> This is a <strong>warning</strong> alert
            </div>
            <div class="alert alert-danger" role="alert">
                <a href="#" class="alert-link">Link</a> This is a <strong>danger</strong> alert
            </div>
        </div>
    </div>


    <!-- ListGroups
    ================================================== -->
    <hr>

    <h2>List Groups</h2>

    <div class="row">
        <div class="col-lg-3">
            <ul class="list-group">
                <li class="list-group-item">List item 1</li>
                <li class="list-group-item">List item 2</li>
                <li class="list-group-item">Mobile-first</li>
                <li class="list-group-item">Responsive</li>
                <li class="list-group-item">Lightweight</li>
            </ul>
        </div>
        <div class="col-lg-3">
            <div class="list-group">
                <a href="#" class="list-group-item active">
                    Linked list group

                </a>
                <a href="#" class="list-group-item">Dapibus ac facilisis in

                </a>
                <a href="#" class="list-group-item">Morbi leo risus

                </a>
                <a href="#" class="list-group-item">Porta ac consectetur ac

                </a>
                <a href="#" class="list-group-item">Vestibulum at eros

                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <ul class="list-group"> <li class="list-group-item"> <span class="badge">14</span> Cras justo odio </li> <li class="list-group-item"> <span class="badge">2</span> Dapibus ac facilisis in </li> <li class="list-group-item"> <span class="badge">1</span> Morbi leo risus </li> </ul>
        </div>
        <div class="col-lg-3">
            <div class="list-group"> <a href="#" class="list-group-item active"> <h4 class="list-group-item-heading">List group item heading</h4> <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> </a> <a href="#" class="list-group-item"> <h4 class="list-group-item-heading">List group item heading</h4> <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> </a> <a href="#" class="list-group-item"> <h4 class="list-group-item-heading">List group item heading</h4> <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> </a> </div>
        </div>
    </div>


    <!-- Well Sizes
    ================================================== -->
    <hr>
    <h2>Well Sizes</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class="well well-sm">
                .well-sm
            </div>
            <div class="well">
                .well
            </div>
            <div class="well well-lg">
                .well-lg
            </div>
        </div>
    </div>
    <hr>


</section>
<script src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/bootstrap.min.js"></script>
</body>
</html>