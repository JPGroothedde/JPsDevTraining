<?php $strPageTitle = 'Entity List Example';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h1>Entity List Example</h1>
<?php $this->DataList->RenderList();?>
<?php $this->RenderEnd();?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>