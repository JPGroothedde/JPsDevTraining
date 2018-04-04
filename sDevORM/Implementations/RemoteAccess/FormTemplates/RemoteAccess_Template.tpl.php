<?php $strPageTitle = 'RemoteAccess Template';?>
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
        <?php require(__SDEV_ORM__.'/Implementations/RemoteAccess/RemoteAccessFrontEnd.php');?>
    </div>
    <div class="col-md-12">
        <?php $this->btnSaveRemoteAccess->Render();?>
        <!--<?php $this->btnDeleteRemoteAccess->Render();?>
        <?php $this->btnCancelRemoteAccess->Render();?>-->
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>