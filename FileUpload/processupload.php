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
require_once('../sdev.inc.php');
$theFilePrefix = '';
if (isset($_GET['f']))
    $theFilePrefix = $_GET['f'];
if(isset($_FILES["FileInput"])) {
	############ Edit settings ##############
	$UploadDirectory	= __FILE_UPLOADED_PATH__; //specify upload directory ends with / (slash)
	##########################################
	
	/*
	Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini". 
	Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit 
	and set them adequately, also check "post_max_size".
	*/
	
	//check if this is an ajax request
    //TODO: Add additional security here to ensure the post is allowable...
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die('Not an ajax request...');
	}

    $file_ary = reArrayFiles($_FILES['FileInput']);
    //var_dump($_FILES['FileInput']);
    $fileUploadArray = array();
    foreach ($file_ary as $file) {
        if (!checkFileSizeAllowed($file['size']))
            die('Some files are too big...');

        $NewFileName = date("d-m-Y_H-i-s",time()).'_'.$theFilePrefix.$file['name'];

        $tmpFilePath = $file['tmp_name'];
        //echo 'temp path: '.$tmpFilePath.' -> new path: '.__DOCROOT__.__FILE_UPLOADED_PATH__.$NewFileName.'... Attempting move...<br>';
        //Make sure we have a filepath
        if ($tmpFilePath != ""){
            if(move_uploaded_file($tmpFilePath, __DOCROOT__.__FILE_UPLOADED_PATH__.$NewFileName )) {
                //echo 'temp path: '.$tmpFilePath.' -> new path: '.__DOCROOT__.__FILE_UPLOADED_PATH__.$NewFileName.'... Moved!<br>';
                array_push($fileUploadArray,$NewFileName);
            } else {
                if (isset($_SESSION['FileUploaded']))
                    unset($_SESSION['FileUploaded']);
                die('Something wrong with upload! Please try again...'.$NewFileName);
            }
        } else{
            die('Something wrong with upload! No file path found. Please try again...'.$NewFileName);
        }
    }
    $_SESSION['FileUploaded'] = $fileUploadArray;
    //var_dump(get_defined_vars());
    die('');


    //saveSingleFile();

} else {
    if (isset($_SESSION['FileUploaded']))
        unset($_SESSION['FileUploaded']);
    die('Something wrong with upload! Incorrect file handle '.file_upload_max_size());
}
function checkFileSizeAllowed($size) {
    //Is file size is less than allowed size.
    if ($size > file_upload_max_size()) {
        return false;
    }
    return true;
}
function checkFileTypeAllowed($type) {
    //allowed file type Server side check
    switch(strtolower($type))
    {
        //allowed file types
	    case 'image/png':
	    case 'image/gif':
	    case 'image/jpeg':
	    case 'image/pjpeg':
	    case 'image/svg+xml':
	    case 'text/plain':
	    case 'text/html':
	    case 'text/csv':
	    case 'application/x-zip-compressed':
	    case 'application/pdf':
	    case 'application/msword':
	    case 'application/vnd.ms-excel':
	    case 'video/mp4':
	    case 'application/zip':
	    case 'application/octet-stream':
	    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
	    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            break;
        default:
            break;
        /*default:
            die('Unsupported File!'); //output error*/
    }
}
function saveFileInArray($key) {
    global $theFilePrefix;

}
function saveSingleFile() {
    global $theFilePrefix;
    if ($_FILES['FileInput']['error'] == UPLOAD_ERR_OK) {
        if (!checkFileSizeAllowed($_FILES['FileInput']['size']))
            die("File size is too big!");

        checkFileTypeAllowed($_FILES['FileInput']['type']);


        $File_Name          = $_FILES['FileInput']['name'];
        //$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extension
        //$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
        $NewFileName 	    = date("d-m-Y_H-i-s",time()).'_'.$theFilePrefix.$File_Name;

        $tmpFilePath = $_FILES['FileInput']['tmp_name'];

        //Make sure we have a filepath
        if ($tmpFilePath != ""){
            if(move_uploaded_file($tmpFilePath, __DOCROOT__.__FILE_UPLOADED_PATH__.$NewFileName )) {
                $_SESSION['FileUploaded'] = $NewFileName;
                die('');
            } else {
                if (isset($_SESSION['FileUploaded']))
                    unset($_SESSION['FileUploaded']);
                die('Something wrong with upload! Please try again...'.$NewFileName);
            }
        } else{
            die('Something wrong with upload! Please try again...'.$NewFileName);
        }
    }
}
function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
// Returns a file size limit in bytes based on the PHP upload_max_filesize
// and post_max_size
function file_upload_max_size() {
    static $max_size = -1;

    if ($max_size < 0) {
        // Start with post_max_size.
        $max_size = parse_size(ini_get('post_max_size'));

        // If upload_max_size is less, then reduce. Except if upload_max_size is
        // zero, which indicates no limit.
        $upload_max = parse_size(ini_get('upload_max_filesize'));
        if ($upload_max > 0 && $upload_max < $max_size) {
            $max_size = $upload_max;
        }
    }
    return $max_size;
}

function parse_size($size) {
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
    $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
    if ($unit) {
        // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
        return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
    }
    else {
        return round($size);
    }
}
?>