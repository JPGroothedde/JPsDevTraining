<?php $strPageTitle = 'File Upload Example';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h1>CSV Import Example</h1>

<?php $this->CSVImporter->Render();?>

<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>