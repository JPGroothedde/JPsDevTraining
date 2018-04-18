<?php $strPageTitle = 'EmailTemplate Detail';?>
<?php require(__CONFIGURATION__ . '/header_with_nav.inc.php');	?>

<?php $this->RenderBegin() ?>
<div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="contentModalLabel">Content</h4>
            </div>
            <div class="modal-body" style="height:450px;">
                <?php $this->SummerNoteInstance->renderSummernoteInstance();?>
            </div>
            <div class="modal-footer">
                <?php $this->btnSaveContent->Render();?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="previewModalLabel">Preview</h4>
            </div>
            <div class="modal-body">
                <?php $this->html_Preview->Render();?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3 class="page-header">Email Template Detail</h3>
    </div>
    <div class="col-md-10">
        <?php require(__SDEV_ORM__.'/Implementations/EmailTemplate/EmailTemplateFrontEnd.php');?>
        <h4 class="page-header">Content</h4>
        <?php $this->html_ContentBlocks->Render();?>
    </div>
    <div class="col-md-2">
        <h4 class="page-header">Tokens</h4>
        <ul class="list-group">
            <li class="list-group-item"><strong>[Example]</strong> Add tokens here for reference</li>
            <li class="list-group-item"><strong>[Example]</strong> Add tokens here for reference</li>
            <li class="list-group-item"><strong>[Example]</strong> Add tokens here for reference</li>
            <li class="list-group-item"><strong>[Example]</strong> Add tokens here for reference</li>
        </ul>
    </div>
    <div class="col-md-12 mrg-top10">
        <?php $this->btnSaveEmailTemplate->Render();?>
        <?php $this->btnPreviewTemplate->Render();?>
        <?php $this->btnDeleteEmailTemplate->Render();?>
        <?php $this->btnCancelEmailTemplate->Render();?>
    </div>
</div>

<?php $this->RenderEnd() ?>
<?php require(__CONFIGURATION__ . '/footer.inc.php');	?>