<?php $strPageTitle = 'File Upload Example';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h1>File Upload Example</h1>
<?php $this->fileUploader->renderUploader();?>
<?php //$this->btnInvokeFileUpload->Render(); //This has been removed since we now invoke the upload from the upload script once the file is selected?>
<?php $this->btnSendToRemoteServer->Render();?>
<?php $this->sh_Feedback->Render();?>
<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>