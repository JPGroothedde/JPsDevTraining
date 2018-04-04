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
require_once('../../../sdev.inc.php');
$theSNId = -1;
$clickToEdit = false;
$isBasic = false;
$height = '';
$initialHeight = '';
if (isset($_GET['sn_id']))
    $theSNId = $_GET['sn_id'];
if (isset($_GET['click'])) {
    if ($_GET['click'] == 1)
        $clickToEdit = true;
    elseif ($_GET['click'] == 0)
        $clickToEdit = false;
}
if (isset($_GET['basic'])){
    if ($_GET['basic'] == 1)
        $isBasic = true;
}
if (isset($_GET['height'])){
    $holdHeight = $_GET['height'] - 100;
    $height = 'height: '.$holdHeight.',';
    $initialHeight = 'style="height:'.$holdHeight.'px"';
}
$SN = SummernoteEntry::QuerySingle(QQ::Equal(QQN::SummernoteEntry()->Id,$theSNId));
$theInitHtml = '';
if ($SN)
    $theInitHtml = $SN->EntryHtml;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>summernote</title>
    <!-- include libraries BS3 -->
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/bootstrap.min.css");</style>
    <style type="text/css">@import url("<?php _p(__VIRTUAL_DIRECTORY__ . __APP_CSS_ASSETS__); ?>/font-awesome.min.css");</style>
    <!-- include summernote -->
    <link rel="stylesheet" href="summernote.css">
    <link rel="stylesheet" href="summernote-bs3.css">
    <script src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php _p(__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__); ?>/bootstrap.min.js"></script>
    <script type="text/javascript" src="summernote.js"></script>
</head>
<body>
<progress id="progressBar" style="width:100%;height:20px;" max="100" value="0"></progress>
<?php if (!$clickToEdit) {?>
    <textarea id="summernote" class="summernote" <?php echo $initialHeight; ?> ><?php echo $theInitHtml;?></textarea>
<?php } else {?>
    <div id="summernoteClickToEdit" onclick="edit();" class="summernoteClickToEdit" title="Click to Edit" style="overflow: scroll;"><?php echo $theInitHtml;?></div>
<?php }?>

<label class="pull-right" style="display: block;clear: both;"><span id="lastSaved"></span></label>

<script type="text/javascript">
    var LastChange = new Date();
    var HasChanges = false;
    $(document).ready(function() {
        $('progress').hide();
        var dtSaved = new Date();
        $('#summernote').summernote({
            minHeight: 150,                               // set minimum height of editor
            <?php echo $height;?>
            focus: true,                 // set focus to editable area after initializing summernote
            onChange: function(contents, $editable) {
                LastChange = new Date();
                HasChanges = true;
            },
            onImageUpload: function(files) {
                sendFile(files[0],'summernote');
                LastChange = new Date();
                HasChanges = true;
            },
            <?php  if ($isBasic) { ?>
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture']]
            ]
            <?php } ?>
        });
        $("#lastSaved").text('No unsaved changes');
        saveOnTimer('summernote');
    });
    var edit = function() {
        $('#summernoteClickToEdit').summernote({
            minHeight: 250,                               // set minimum height of editor
            <?php echo $height;?>
            focus: true,
            onChange: function(contents, $editable) {
                LastChange = new Date();
                HasChanges = true;
            },
            onImageUpload: function(files) {
                sendFile(files[0],'summernoteClickToEdit');
                LastChange = new Date();
                HasChanges = true;
            },
            <?php  if ($isBasic) { ?>
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture']]
            ]
            <?php } ?>
        });
        $("#lastSaved").text('No unsaved changes');
        saveOnTimer('summernoteClickToEdit');
    };
    // send the file
    function sendFile(file,elem) {
        $('progress').show();
        data = new FormData();
        data.append("file", file);
        $.ajax({
            data: data,
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) myXhr.upload.addEventListener('progress',progressHandlingFunction, false);
                return myXhr;
            },
            url: 'SummernoteImageUploader.php',
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                //editor.insertImage(welEditable, url);
                //console.log('Url returned: '+url)
                $('#'+elem).summernote("insertImage", url, url);
            }
        });
        //$('progress').hide();
    };
    // update progress bar
    function progressHandlingFunction(e){
        if(e.lengthComputable){
            $('progress').show();
            $('progress').attr({value:e.loaded, max:e.total});
            // reset progress on complete
            if (e.loaded == e.total) {
                $('progress').attr('value','0.0');
                $('progress').hide();
            }
        }
    };
    function saveSummernote(SummerNoteId) {
        var code = encodeURI($('#'+SummerNoteId).code());
        $.ajax({
            url: 'commit.php',
            type: 'POST',
            data: { value: code,sn_id:<?php echo $theSNId;?>},
            success: function(result) {
                var dt = new Date();
                var hours = dt.getHours();
                if (hours < 10)
                    hours = "0"+hours;
                var mins = dt.getMinutes();
                if (mins < 10)
                    mins = "0"+mins;
                var secs = dt.getSeconds();
                if (secs < 10)
                    secs = "0"+secs;
                var time = hours+":"+mins+":"+secs;
                $("#lastSaved").text('Last saved at: '+time);
                LastSaved = dt;
            }
        });
    };
    $('#summerNote').on('summernote.paste', function (customEvent, nativeEvent) {
        setTimeout(function () {
            $('.note-editable').selectText();
            $("#summerNote").summernote("removeFormat");
        }, 100);
    });
    function saveOnTimer(SummerNoteId) {
        setInterval(function () {
            var DateNow = new Date();
            var seconds = (DateNow - LastChange)/1000;
            if ((seconds > 1) && HasChanges) {
                if (SummerNoteId == 'summernote')
                    saveSummernote('summernote');
                else
                    saveSummernote('summernoteClickToEdit');
                HasChanges = false;
            }
        },100);
    }
</script>
</body>
</html>
