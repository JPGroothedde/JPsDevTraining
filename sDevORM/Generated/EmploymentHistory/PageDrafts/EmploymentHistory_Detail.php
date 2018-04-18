<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/EmploymentHistory/EmploymentHistoryController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class EmploymentHistory_DetailForm extends QForm {
    // EmploymentHistory Object variables
    protected $EmploymentHistoryInstance;
    protected $btnSaveEmploymentHistory,$btnDeleteEmploymentHistory,$btnCancelEmploymentHistory;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitEmploymentHistoryInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = EmploymentHistory::Load($objId);
            if ($theObject) {
                $this->EmploymentHistoryInstance->setObject($theObject);
                $this->EmploymentHistoryInstance->setValues($theObject);
                $this->EmploymentHistoryInstance->refreshAll();
                $this->btnDeleteEmploymentHistory->Visible = true;
            } else {
                $this->EmploymentHistoryInstance->setObject(null);
                $this->EmploymentHistoryInstance->setValues(null);
                $this->btnDeleteEmploymentHistory->Visible = false;
            }
        } else {
            $this->EmploymentHistoryInstance->setObject(null);
            $this->EmploymentHistoryInstance->setValues(null);
            $this->btnDeleteEmploymentHistory->Visible = false;
        }
    }
    protected function InitEmploymentHistoryInstance() {
        $this->EmploymentHistoryInstance = new EmploymentHistoryController($this);

        $this->btnSaveEmploymentHistory = new QButton($this);
        $this->btnSaveEmploymentHistory->Text = 'Save';
        $this->btnSaveEmploymentHistory->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveEmploymentHistory->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmploymentHistory_Clicked'));

        $this->btnDeleteEmploymentHistory = new QButton($this);
        $this->btnDeleteEmploymentHistory->Text = 'Delete';
        $this->btnDeleteEmploymentHistory->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteEmploymentHistory->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteEmploymentHistory->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmploymentHistory_Clicked'));

        $this->btnCancelEmploymentHistory = new QButton($this);
        $this->btnCancelEmploymentHistory->Text = 'Cancel';
        $this->btnCancelEmploymentHistory->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelEmploymentHistory->AddAction(new QClickEvent(), new QAjaxAction('btnCancelEmploymentHistory_Clicked'));
    }
    protected function btnSaveEmploymentHistory_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmploymentHistoryInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteEmploymentHistory_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->EmploymentHistoryInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelEmploymentHistory_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
EmploymentHistory_DetailForm::Run('EmploymentHistory_DetailForm');
?>