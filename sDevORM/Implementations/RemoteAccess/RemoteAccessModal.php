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
                <?php require(__SDEV_ORM__.'/Implementations/RemoteAccess/RemoteAccessFrontEnd.php');?>
            </div>
            <div class="modal-footer">
                <?php $this->btnSaveRemoteAccess->Render();?>
                <?php $this->btnDeleteRemoteAccess->Render();?>
                <button type="button" class="btn btn-default  <?php echo $this->buttonFullWidthCss;?>" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>