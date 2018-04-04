<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/AuditLogEntry/AuditLogEntryController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class AuditLogEntry_DetailForm extends QForm {
    // AuditLogEntry Object variables
    protected $AuditLogEntryInstance;
    protected $btnSaveAuditLogEntry,$btnDeleteAuditLogEntry,$btnCancelAuditLogEntry;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitAuditLogEntryInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
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
        $this->btnSaveAuditLogEntry->Text = 'Save';
        $this->btnSaveAuditLogEntry->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveAuditLogEntry->AddAction(new QClickEvent(), new QAjaxAction('btnSaveAuditLogEntry_Clicked'));

        $this->btnDeleteAuditLogEntry = new QButton($this);
        $this->btnDeleteAuditLogEntry->Text = 'Delete';
        $this->btnDeleteAuditLogEntry->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteAuditLogEntry->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteAuditLogEntry->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteAuditLogEntry_Clicked'));

        $this->btnCancelAuditLogEntry = new QButton($this);
        $this->btnCancelAuditLogEntry->Text = 'Cancel';
        $this->btnCancelAuditLogEntry->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelAuditLogEntry->AddAction(new QClickEvent(), new QAjaxAction('btnCancelAuditLogEntry_Clicked'));
    }
    protected function btnSaveAuditLogEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AuditLogEntryInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteAuditLogEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->AuditLogEntryInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelAuditLogEntry_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
AuditLogEntry_DetailForm::Run('AuditLogEntry_DetailForm');
?>