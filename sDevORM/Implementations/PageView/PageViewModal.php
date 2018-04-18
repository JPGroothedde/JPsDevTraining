<?php
?>
<div id="PageViewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="PageViewModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="PageViewModalLabel">PageView Details</h4>
            </div>
            <div class="modal-body">
                <?php require(__SDEV_ORM__.'/Implementations/PageView/PageViewFrontEnd.php');?>
            </div>
            <div class="modal-footer">
                <?php $this->btnSavePageView->Render();?>
                <?php $this->btnDeletePageView->Render();?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>