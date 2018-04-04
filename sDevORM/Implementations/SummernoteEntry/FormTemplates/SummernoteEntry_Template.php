<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/SummernoteEntry/SummernoteEntryController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        QApplication::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class SummernoteEntry_DetailForm extends QForm {
    // SummernoteEntry Object variables
    protected $SummernoteEntryInstance;
    protected $btnSaveSummernoteEntry,$btnDeleteSummernoteEntry,$btnCancelSummernoteEntry;

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

        $this->InitSummernoteEntryInstance();

        $objId = QApplication::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = SummernoteEntry::Load($objId);
            if ($theObject) {
                $this->SummernoteEntryInstance->setObject($theObject);
                $this->SummernoteEntryInstance->setValues($theObject);
                $this->SummernoteEntryInstance->refreshAll();
                $this->btnDeleteSummernoteEntry->Visible = true;
            } else {
                $this->SummernoteEntryInstance->setObject(null);
                $this->SummernoteEntryInstance->setValues(null);
                $this->btnDeleteSummernoteEntry->Visible = false;
            }
        } else {
            $this->SummernoteEntryInstance->setObject(null);
            $this->SummernoteEntryInstance->setValues(null);
            $this->btnDeleteSummernoteEntry->Visible = false;
        }
    }
    protected function InitSummernoteEntryInstance() {
        $this->SummernoteEntryInstance = new SummernoteEntryController($this);

        $this->btnSaveSummernoteEntry = new QButton($this);
        $this->btnSaveSummernoteEntry->Text = 'Save SummernoteEntry';
        $this->btnSaveSummernoteEntry->AddAction(new QClickEvent(), new QAjaxAction('btnSaveSummernoteEntry_Clicked'));

        $this->btnDeleteSummernoteEntry = new QButton($this);
        $this->btnDeleteSummernoteEntry->Text = 'Delete SummernoteEntry';
        $this->btnDeleteSummernoteEntry->CssClass = 'btn btn-danger';
        $this->btnDeleteSummernoteEntry->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteSummernoteEntry->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteSummernoteEntry_Clicked'));

        $this->btnCancelSummernoteEntry = new QButton($this);
        $this->btnCancelSummernoteEntry->Text = 'Cancel';
        $this->btnCancelSummernoteEntry->CssClass = 'btn btn-default';
        $this->btnCancelSummernoteEntry->AddAction(new QClickEvent(), new QAjaxAction('btnCancelSummernoteEntry_Clicked'));
    }
    protected function btnSaveSummernoteEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SummernoteEntryInstance->saveObject()) {
            QApplication::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteSummernoteEntry_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->SummernoteEntryInstance->deleteObject()) {
            QApplication::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelSummernoteEntry_Clicked($strFormId, $strControlId, $strParameter) {
        QApplication::Redirect(loadPreviousPage());
    }
}
SummernoteEntry_DetailForm::Run('SummernoteEntry_DetailForm');
?>