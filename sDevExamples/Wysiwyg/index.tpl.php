<?php $strPageTitle = 'Wysiwyg Example';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h1>Wysiwyg Example</h1>
<?php $this->sh_Summernote_New->renderSummernoteInstance();?>
<?php $this->btnSave->Render();?>
<?php $this->btnShow->Render();?>
<?php $this->btnHide->Render();?>
<?php $this->btnFitToScreen->Render();?>
<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>