<?php $strPageTitle = 'Person Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">Person Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/Person/PersonFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSavePerson->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeletePerson->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelPerson->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>