<?php
require('../../../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/AuditLogEntry/AuditLogEntryController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        QApplication::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class AuditLogEntry_DetailForm extends QForm {
    // AuditLogEntry Object variables
    protected $AuditLogEntryInstance;
    protected $btnSaveAuditLogEntry,$btnDeleteAuditLogEntry,$btnCancelAuditLogEntry;

    //Mobile detection
    protected $deviceType;
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        $detect = new Mobile_Detect;
        $this->deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
        if ($this->deviceType == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitAuditLogEntryInstance();

        $objId = QApplication::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = AuditLogEntry::Load($objId);
            if ($theObject) {
                $this->AuditLogEntryInstance->setObject($theObject);
                $this->AuditLogEntryInstance->setValues($theObject);
                $this->AuditLogEntryInstance->refreshAll();
                $this->btnDeleteAuditLogEntry->Visible = true;
            } else {
                $this->AuditLogEntryInstance->setObject(null);
                $this->AuditLogEntryInstance->setValues(null);
                $this->btnDeleteAuditLogEntry->Visible = false;
            }
        } else {
            $this->AuditLogEntryInstance->setObject(null);
            $this->AuditLogEntryInstance->setValues(null);
            $this->btnDeleteAuditLogEntry->Visible = false;
        }
    }
    protected function InitAuditLogEntryInstance() {
        $this->AuditLogEntryInstance = new AuditLogEntryController($this);

        $this->btnSaveAuditLogEntry = new QButton($this);
        $this->btnSaveAuditLogEntry->Text = 'Save AuditLogEntry';
        $this->btnSaveAuditLogEntry->AddAction(new QClickEvent(), new QAjaxAction('btnSaveAuditLogEntry_Clicked'));

        $this->btnDeleteAuditLogEntry = new QButton($this);
        $this->btnDeleteAuditLogEntry->Text = 'Delete AuditLogEntry';
        $this->btnDeleteAuditLogEntry->CssClass = 'btn btn-danger';
        $this->btnDeleteAuditLogEntry->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteAuditLogEntry->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteAuditLogEntry_Clicked'));

        $this->btnCancelAuditLogEntry = new QButton($this);
        $this->btnCancelAuditLogEntry->Text = 'Cancel';
        $this->btnCancelAuditLogEntry->CssClass = 'btn btn-default';
        $this->btnCancelAuditLogEntry->AddAction(new QClickEvent(), new QAjaxAction('btnCancelAuditLogEntry_Clicked'));
    }
    protected function btnSaveAuditLogEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AuditLogEntryInstance->saveObject()) {
            QApplication::ShowNotedFeedback('Saved!');
        } else
            QApplication::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeleteAuditLogEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AuditLogEntryInstance->deleteObject()) {
            QApplication::ShowNotedFeedback('Deleted!');
        } else
            QApplication::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
}
AuditLogEntry_DetailForm::Run('AuditLogEntry_DetailForm');
?>