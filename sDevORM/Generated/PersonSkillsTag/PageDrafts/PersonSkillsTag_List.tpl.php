<?php $strPageTitle = 'PersonSkillsTag List';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<?php require(__SDEV_ORM__.'/Implementations/PersonSkillsTag/PersonSkillsTagModal.php');?>
<div class="row">
    <div class="col-md-12">
            <h3 class="page-header">PersonSkillsTag List</h3>
        <?php $this->PersonSkillsTagList->RenderList();?>
        <?php $this->btnNewPersonSkillsTag->Render();?>
        </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>