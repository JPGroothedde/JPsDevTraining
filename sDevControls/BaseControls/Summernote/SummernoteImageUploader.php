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
require('../../../includes/configuration/configuration.inc.php');
if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
        $name = 'ContentImage_'.Date('d-m-y_h-i-s').'_'.rand(0, 5000);
        $ext = explode('.', $_FILES['file']['name']);
        $filename = $name . '.' . $ext[1];
        $destination = __DOCROOT__.__FILE_UPLOADED_PATH_SUMMERNOTE__. $filename;
        $location = $_FILES["file"]["tmp_name"];
        move_uploaded_file($location, $destination);
        $protocol = 'http://';
        if (isSecure())
            $protocol = 'https://';
        $server = $_SERVER['SERVER_NAME'];
        echo $protocol.$server.__FILE_UPLOADED_PATH_SUMMERNOTE__. $filename;//change this URL
    }
    else
    {
        echo  $message = 'Oops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
    }
}
function isSecure() {
    return
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || $_SERVER['SERVER_PORT'] == 443;
}
?>