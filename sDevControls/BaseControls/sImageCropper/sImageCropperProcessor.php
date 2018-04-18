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
require('../../../sdev.inc.php');

if (!isset($_POST['sImageCropperSessionToken']))
    die('Invalid Token');
if (!isset($_SESSION['sImageCropperSessionToken']))
    die('Invalid Token');
if ($_POST['sImageCropperSessionToken'] != $_SESSION['sImageCropperSessionToken'])
    die('Invalid Token');
if (!isset($_POST['ImgData']))
    die('Invalid Data');
if (!isset($_POST['file']))
    die('Invalid Filename');

$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['ImgData']));
$result = file_put_contents(__DOCROOT__.__FILE_UPLOADED_PATH__.'/'.$_POST['file'], $data);
if ($result !== false)
    die('Success');
else
    die('Failed');
die('Failed');
?>

