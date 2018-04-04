<?php
?>
<div id="EmailMessageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="EmailMessageModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="EmailMessageModalLabel">EmailMessage Details</h4>
            </div>
            <div class="modal-body">
                <?php require(__SDEV_ORM__.'/Implementations/EmailMessage/EmailMessageFrontEnd.php');?>
            </div>
            <div class="modal-footer">
                <?php /*$this->btnSaveEmailMessage->Render();*/?>
                <?php /*$this->btnDeleteEmailMessage->Render();*/?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>