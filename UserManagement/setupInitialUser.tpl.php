<?php
require(__CONFIGURATION__ . '/HeaderComponents/standard_header_init.inc.php');
$this->RenderBegin();?>

    <style>
        body {
            padding-top:0px;
        }
    </style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">


            <h2 class="page-header">Create An Admin Account</h2>

            <?php $this->AdminName->RenderWithName(); ?>
            <?php $this->AdminPass->RenderWithName(); ?>
            <?php $this->MaintenancePass->RenderWithName(); ?>
            <?php $this->btnCreateAdmin->Render(); ?>

        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<?php $this->RenderEnd() ?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>