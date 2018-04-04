<?php $strPageTitle = 'Error Logs';
require (__CONFIGURATION__.'/HeaderComponents/standard_header_init.inc.php'); ?>
<?php $this->RenderBegin();?>
<div class="container-fluid">
<div class="row">
    <div class="col-xs-12">
        <h1 class="page-header">Error Logs</h1>
        <a href="start_page.php" class="btn btn-link" style="margin-top:-40px;"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
    </div>
    <div class="col-xs-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Custom Logs
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div id="ViewLogsCustomLogs" class="panel-body">
                        <?php echo file_get_contents(__DOCROOT__.__PHP_ASSETS__.'/DeveloperMode/CustomLog.txt'); ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            System Logs
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <div id="ViewLogsSystemLogs">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php $this->btnClearCustomLogs->Render();?>
    </div>
    <div class="col-md-6">
        <?php $this->btnClearSystemLogs->Render();?>
    </div>
</div>




<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
<script>
    $('#DevModeWrapperSideButton').remove();
</script>

