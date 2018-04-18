<?php
?>

<div class="row">
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('SentDate');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('SentDateTime',true,'Time');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('FromAddress');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('ReplyEmail');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('Recipients');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('Cc');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('Bcc');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('Subject');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('EmailMessage');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('Attachments');?>
    </div>
    <div class="col-md-6">
        <?php $this->EmailMessageInstance->renderControl('ErrorInfo');?>
    </div>
</div>