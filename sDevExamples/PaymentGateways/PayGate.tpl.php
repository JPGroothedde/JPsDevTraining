<?php $strPageTitle = 'Entity Select Example';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h1>PayGate Payment (PayWeb3) Example</h1>
<?php $this->txtAmount->RenderWithName();?>
<?php $this->btnSubmit->Render();?>
<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>