<?php
?>
<div id="RemoteAccessModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="RemoteAccessModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="RemoteAccessModalLabel">RemoteAccess Details</h4>
            </div>
            <div class="modal-body">
                <?php require(__SDEV_ORM__.'/Generated/RemoteAccess/RemoteAccessFrontEnd.php');?>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4">
                        <?php $this->btnSaveRemoteAccess->Render();?>
                    </div>
                    <div class="col-md-4">
                        <?php $this->btnDeleteRemoteAccess->Render();?>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-default rippleclick mrg-top10 fullWidth" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>