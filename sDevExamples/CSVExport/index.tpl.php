<?php $strPageTitle = 'File Upload Example';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h1>CSV Import Example</h1>
<?php $this->btnDownloadDirectly->Render();?>
<?php $this->btnExportForDownload->Render();?>
<?php echo $this->tableData;?>

<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>