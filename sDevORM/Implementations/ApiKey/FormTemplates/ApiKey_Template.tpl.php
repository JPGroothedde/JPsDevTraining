<?php $strPageTitle = 'ApiKey Template';?>
<?php require(__CONFIGURATION__ . '/header_form_templates.inc.php');	?>
<style>
    body {
        padding: 0px;
        margin:0px;
    }
</style>
<?php $this->RenderBegin() ?>
<div class="row">
    <div class="col-md-12">
        <?php require(__SDEV_ORM__.'/Implementations/ApiKey/ApiKeyFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSaveApiKey->Render();?>
        <!--<?php $this->btnDeleteApiKey->Render();?>
        <?php $this->btnCancelApiKey->Render();?>-->
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>