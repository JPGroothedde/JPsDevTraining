<?php $strPageTitle = 'PersonSkillsTag Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PersonSkillsTag Detail</h3>
        <?php require(__SDEV_ORM__.'/Implementations/PersonSkillsTag/PersonSkillsTagFrontEnd.php');?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php $this->btnSavePersonSkillsTag->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnDeletePersonSkillsTag->Render();?>
    </div>
    <div class="col-md-4">
        <?php $this->btnCancelPersonSkillsTag->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>