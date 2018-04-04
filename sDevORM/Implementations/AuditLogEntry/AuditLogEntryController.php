<?php
require_once(__SDEV_ORM__.'/Generated/AuditLogEntry/AuditLogEntryController_Base.php');

class AuditLogEntryController extends AuditLogEntryController_Base {
    public function __construct($objParentObject,$InitObject = null) {
        parent::__construct($objParentObject,$InitObject);
        $this->txtAuditLogEntryDetail->TextMode = QTextMode::MultiLine;
        $this->txtAuditLogEntryDetail->Rows = 20;
        $this->txtAuditLogEntryDetail->Enabled = false;

        $this->txtEntryTimeStamp->Enabled = false;
        $this->txtObjectName->Enabled = false;
        $this->txtObjectId->Enabled = false;
        $this->txtModificationType->Enabled = false;
        $this->txtUserEmail->Enabled = false;
    }
    public function setValues($Object) {
        $this->txtEntryTimeStamp->Text = '';$this->setEntryTimeStampTime();
        $this->txtObjectName->Text = '';
        $this->txtModificationType->Text = '';
        $this->txtUserEmail->Text = '';
        $this->txtObjectId->Text = '';
        $this->txtAuditLogEntryDetail->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->EntryTimeStamp) {
            $this->txtEntryTimeStamp->Text = $Object->EntryTimeStamp->format(DATE_TIME_FORMAT_HTML.' H:i:s');
            $this->setEntryTimeStampTime($Object->EntryTimeStamp);
        }
        if ($Object->ObjectName) {
            $this->txtObjectName->Text = $Object->ObjectName;
        }
        if ($Object->ModificationType) {
            $this->txtModificationType->Text = $Object->ModificationType;
        }
        if ($Object->UserEmail) {
            $this->txtUserEmail->Text = $Object->UserEmail;
        }
        if ($Object->ObjectId) {
            $this->txtObjectId->Text = $Object->ObjectId;
        }
        if ($Object->AuditLogEntryDetail) {
            $this->txtAuditLogEntryDetail->Text = AppSpecificFunctions::HtmlToTextArea(str_replace("  ",'',$Object->AuditLogEntryDetail));
        }


        $this->resetValidation();
        $this->refreshAll();
    }
};
?>