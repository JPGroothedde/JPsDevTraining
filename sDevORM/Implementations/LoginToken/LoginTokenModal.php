<?php
?>
<div id="LoginTokenModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="LoginTokenModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="LoginTokenModalLabel">LoginToken Details</h4>
            </div>
            <div class="modal-body">
                <?php require(__SDEV_ORM__.'/Implementations/LoginToken/LoginTokenFrontEnd.php');?>
            </div>
            <div class="modal-footer">
                <?php /*$this->btnSaveLoginToken->Render();*/?>
                <?php /*$this->btnDeleteLoginToken->Render();*/?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>