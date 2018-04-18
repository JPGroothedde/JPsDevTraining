<?php $strPageTitle = 'Calendar Example';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');?>

<?php $this->RenderBegin();?>
<h1>Calendar Example</h1>
<div class="row">
    <div class="col-md-12">
        <?php $this->calendar->Render();?>
        <?php $this->btnGetEvent->Render();?>
    </div>
</div>
<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>