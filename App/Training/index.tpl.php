<?php $strPageTitle = 'index'; ?>
<?php require(__CONFIGURATION__.'/header_with_nav.inc.php'); ?>
<style>
    .NoPointer:hover {
        cursor:auto;
    }
</style>
<?php $this->RenderBegin(); ?>
<div class="row">
    <div class="col-md-12">
        <h1>Find a course</h1>
    </div>
    <div class="col-md-6">
        <?php $this->txtInputBox->RenderWithName(); ?>
    </div>
    <div class="col-md-6 mrg-top25">
	    <?php $this->btnProcessInput->Render(); ?>
    </div>
    <div class="col-md-12">
	    <?php $this->html_Result->Render(); ?>
    </div>
</div>



<?php $this->RenderEnd(); ?>

<?php require(__CONFIGURATION__.'/footer.inc.php'); ?>