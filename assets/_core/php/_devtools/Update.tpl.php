<?php $strPageTitle = 'sDev Auto Updater';
require (__CONFIGURATION__.'/HeaderComponents/standard_header_init.inc.php'); ?>
<?php $this->RenderBegin();?>
<div class="modal fade" id="UpdateIssues" tabindex="-1" role="dialog" aria-labelledby="UpdateIssuesLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="UpdateIssuesLabel">Update Notice</h4>
            </div>
            <div class="modal-body" style="word-wrap: break-word;">
                <?php $this->html_UpdateIssues->Render();?>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-default rippleclick mrg-top10 fullWidth" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">sDev Auto Updater</h1>
            <h4>Latest sDev version: <?php echo $this->LatestVersion;?> <small>Update Size: <?php echo $this->UpdateSize;?></small></h4>
        </div>
        <div class="col-xs-12">
	        <?php $this->btnUpdateNow->Render();?>
            <a href="start_page.php" class="btn btn-link"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
        </div>
        <div class="col-xs-12">
	        <?php $this->html_UpdateFeedback->Render();?>
        </div>
    </div>
</div>
<?php $this->RenderEnd();?>

<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>
<script>
    $('#DevModeWrapperSideButton').remove();
</script>

