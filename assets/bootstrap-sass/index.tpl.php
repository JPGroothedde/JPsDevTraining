<?php require(__CONFIGURATION__ . '/HeaderComponents/standard_header_init.inc.php');?>
    <style>
        body {
            padding-top:0px;
        }
    </style>
<div class="container-fluid">

<?php $this->RenderBegin();?>
    <div class="row">
        <div class="col-md-12 mrg-bottom5" style="text-align: center;border-bottom: 2px solid grey;padding-bottom:5px;">
            <h3 class="page-header">Bootstrap CSS Generator</h3>
            <div class="row">
                <div class="col-md-6"><?php $this->btnGenerateCss->Render();?></div>
                <div class="col-md-6"><?php $this->btnDone->Render();?></div>
            </div>
        </div>
        <div class="col-md-12">
            <?php $this->html_CurrentLookAndFeel->Render();?>
        </div>
    </div>
<?php $this->RenderEnd();?>
</div>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>