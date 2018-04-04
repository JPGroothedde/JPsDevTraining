<?php
?>
<div id="PasswordResetModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="PasswordResetModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="PasswordResetModalLabel">PasswordReset Details</h4>
            </div>
            <div class="modal-body">
                <?php require(__SDEV_ORM__.'/Implementations/PasswordReset/PasswordResetFrontEnd.php');?>
            </div>
            <div class="modal-footer">
                <?php /*$this->btnSavePasswordReset->Render();*/?>
                <?php /*$this->btnDeletePasswordReset->Render();*/?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>