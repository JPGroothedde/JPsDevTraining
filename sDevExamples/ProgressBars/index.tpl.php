<?php $strPageTitle = 'Entity Select Example';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h1>Progress Bars Example</h1>
<div class="row">
    <div class="col-md-12" style="text-align: center;">
        <?php $this->txtValueToUpdate->RenderWithName();?>
        <?php $this->btnUpdateValue->Render();?>
        <?php $this->ProgressBar->Render();?>
    </div>
</div>
<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>