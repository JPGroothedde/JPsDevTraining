<?php
?>
<div id="AuditLogEntryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AuditLogEntryModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="AuditLogEntryModalLabel">AuditLogEntry Details</h4>
            </div>
            <div class="modal-body">
                <?php require(__SDEV_ORM__.'/Implementations/AuditLogEntry/AuditLogEntryFrontEnd.php');?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>