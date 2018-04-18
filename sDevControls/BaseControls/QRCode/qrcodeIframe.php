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
require('../../../assets/php/phpqrcode.php');
if (isset($_GET['data'])) {
    $ec_level = QR_ECLEVEL_L;
    $pixelsize = 8;
    if (isset($_GET['ecl']))
        $ec_level = $_GET['ecl'];
    if (isset($_GET['size']))
        $pixelsize = $_GET['size'];
    QRcode::png($_GET['data'],false,$ec_level,$pixelsize); // creates code image and outputs it directly into browser
} else
    die('NO DATA!');
?>