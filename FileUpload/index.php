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
$theFormId = '';
$theActionId = '';
if (isset($_GET['f']))
	$theFilePrefix = $_GET['f'];
if (isset($_GET['formId']))
	$theFormId = $_GET['formId'];
if (isset($_GET['actionId']))
	$theActionId = $_GET['actionId'];
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
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>File Upload</title>
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.form.min.js"></script>

    <script type="text/javascript">
		$(document).ready(function() {
			var options = {
				target:   '#output',   // target element(s) to be updated with server response
				beforeSubmit:  beforeSubmit,  // pre-submit callback
				success:       afterSuccess,  // post-submit callback
				uploadProgress: OnProgress, //upload progress callback
				resetForm: true        // reset the form after successful submit
			};
			
			$('#MyUploadForm').submit(function() {
				$(this).ajaxSubmit(options);
				// always return false to prevent standard browser submit and page navigation
				return false;
			});
			//function after succesful file upload (when server response)
			function afterSuccess() {
				//$('#submit-btn').attr('disabled', false);
				$('#FileInputButtonLabel').attr('disabled', false);
				$('#FileInputButtonLabel').html('<input name="FileInput[]" id="FileInput" class="FileInput" type="file" multiple="multiple" accept="image/*;capture=camera" /> ' +
					'<i class="fa fa-file-text" aria-hidden="true"></i> Choose File(s)');
				$('#FileInput').attr('disabled', false);
				
				//$('#submit-btn').html('<i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload');
				$('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar
				window.parent.window.onFileUploaded($('#formId').val(),$('#actionId').val());
			}
			
			//function to check file size before uploading.
			function beforeSubmit(){
				//check whether browser fully supports all File API
				if (window.File && window.FileReader && window.FileList && window.Blob) {
					if( !$('#FileInput').val()) //check empty input filed
					{
						alert('Hmmm... Please select a file first.');
						//$('#output').html('<div class="alert alert-warning" role="alert"><strong>Hmmm...</strong> Please select a file first.</div>');
						return false
					} else {
						if (!isValid($('#FileInput')[0].files[0].name)) {
							alert("Please check your file. It contains special characters that our upload robots are scared of. Check for \' and \" specifically.");
							//$("#output").html("Please check your file. It contains special characters that our upload robots are scared of. Check for \' and \" specifically.");
							return false;
						}
					}
					
					//var fsize = $('#FileInput')[0].files[0].size; //get file size
					var fsize = 0;
					for (i = 0; i < $('#FileInput')[0].files.length; i++) {
						fsize += $('#FileInput')[0].files[i].size;
					}
					var ftype = $('#FileInput')[0].files[0].type; // get file type
     
					//allow file types
					switch(ftype)
					{
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
							alert(ftype+': Unsupported file type!');
							//$('#output').html('<div class="alert alert-danger" role="alert"><strong>'+ftype+':</strong> Unsupported file type!</div>');
							return false;
							break;
					}
					
					//Allowed file size is less than specified in php.ini
					if(fsize > <?php echo file_upload_max_size();?>)
					{
						var TheSize = bytesToSize(fsize);
						var TheMaxSize = bytesToSize(<?php echo file_upload_max_size();?>);
						alert(TheSize+' Upload too big! Total upload size should be less than '+TheMaxSize);
						//$('#output').html('<div class="alert alert-danger" role="alert"><strong>'+bytesToSize(fsize)+':</strong> Upload too big! <br />Total upload size should be less than '+bytesToSize(<?php echo file_upload_max_size();?>)+'.</div>');
						return false
					}
					
					//$('#submit-btn').html('<i class="fa fa-cloud-upload" aria-hidden="true"></i> ');
					//$('#submit-btn').attr('disabled', true);
					//$('#loading-img').show(); //hide submit button
					$("#output").html("");
				}
				else {
					//Output error to older unsupported browsers that doesn't support HTML5 File API
					alert('Problem: Please upgrade your browser, because your current browser lacks some new features we need!');
					//$('#output').html('<div class="alert alert-danger" role="alert"><strong>Problem:</strong> Please upgrade your browser, because your current browser lacks some new features we need!</div>');
					$('#FileInputButtonLabel').attr('disabled', false);
					return false;
				}
			}
			
			//progress bar function
			function OnProgress(event, position, total, percentComplete) {
				//Progress bar
				$('#progressbox').show();
				$(".progress-bar").css( "width", percentComplete+"%" );
				//$('#submit-btn').html('<i class="fa fa-cloud-upload" aria-hidden="true"></i> '+percentComplete+'%');
				$('#FileInputButtonLabel').attr('disabled', true);
				$('#FileInputButtonLabel').html('<input name="FileInput[]" id="FileInput" class="FileInput"  type="file" multiple="multiple" accept="image/*;capture=camera" /> ' +
					'<i class="fa fa-file-text" aria-hidden="true"></i> Processing... '+percentComplete+'%');
				$('#FileInput').attr('disabled', true);
			}
			
			//function to format bites bit.ly/19yoIPO
			function bytesToSize(bytes) {
				var sizes = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB'];
				if (bytes == 0) return '0 Bytes';
				var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
				return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
			}
			addEventForFileSelected();
		});
		
		function isValid(str){
			//return true;
			//return /^[&\/\\#,+()$~%'":*?<>{}]*$/.test(str);
			return !/[&\/\\#,+()$~%'":*?<>{}]/g.test(str);
		}
		function addEventForFileSelected() {
			$(document).on('change', '.FileInput', function(e) {
				var fileName = '';
				if( this.files && this.files.length > 0 ) {
					var filesText = 'Files';
					if (this.files.length == 1)
						filesText = 'File';
					//$('#output').html('<div class="alert alert-info" role="alert"><strong>'+this.files.length+' '+filesText+'</strong> Waiting to upload</div>');
					invokeUpload();
				}
				else {
					alert('Nothing currently selected for upload');
				}
			})
		}
		function invokeUpload() {
			$('#MyUploadForm').submit();
		}
    </script>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/bootstrap.min.css");</style>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/bootstrapmodifications.css");</style>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/font-awesome.min.css");</style>
    <style>
        input[type="file"] {
            display: none;
        }
    </style>
</head>
<body style="padding:0px;">
<div class="container-fluid">
    <div class="row" style="padding:0px;">
        <form action="processupload.php?f=<?php echo $theFilePrefix;?>" method="post" id="MyUploadForm">
            <div class="col-md-12"  style="padding:0px;">
                <label id="FileInputButtonLabel" class="btn btn-default fullWidth rippleclick">
                    <input name="FileInput[]" id="FileInput" class="FileInput" type="file" multiple="multiple" accept="image/*;capture=camera" />
                    <i class="fa fa-file-text" aria-hidden="true"></i> Choose File(s)
                </label>
            </div>

            <input type="hidden" id="formId" value="<?php echo $theFormId; ?>" />
            <input type="hidden" id="actionId" value="<?php echo $theActionId; ?>" />
        </form>
        <div class="col-md-12"  style="padding:0px;">
            <div id="progressbox" class="progress mrg-top10" style="display:none;">
                <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>

            <div id="output">

            </div>
        </div>
    </div>
</div>
</body>
</html>