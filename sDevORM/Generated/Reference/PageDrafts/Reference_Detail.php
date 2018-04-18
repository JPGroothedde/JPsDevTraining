<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Reference/ReferenceController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Reference_DetailForm extends QForm {
    // Reference Object variables
    protected $ReferenceInstance;
    protected $btnSaveReference,$btnDeleteReference,$btnCancelReference;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitReferenceInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Reference::Load($objId);
            if ($theObject) {
                $this->ReferenceInstance->setObject($theObject);
                $this->ReferenceInstance->setValues($theObject);
                $this->ReferenceInstance->refreshAll();
                $this->btnDeleteReference->Visible = true;
            } else {
                $this->ReferenceInstance->setObject(null);
                $this->ReferenceInstance->setValues(null);
                $this->btnDeleteReference->Visible = false;
            }
        } else {
            $this->ReferenceInstance->setObject(null);
            $this->ReferenceInstance->setValues(null);
            $this->btnDeleteReference->Visible = false;
        }
    }
    protected function InitReferenceInstance() {
        $this->ReferenceInstance = new ReferenceController($this);

        $this->btnSaveReference = new QButton($this);
        $this->btnSaveReference->Text = 'Save';
        $this->btnSaveReference->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveReference->AddAction(new QClickEvent(), new QAjaxAction('btnSaveReference_Clicked'));

        $this->btnDeleteReference = new QButton($this);
        $this->btnDeleteReference->Text = 'Delete';
        $this->btnDeleteReference->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteReference->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteReference->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteReference_Clicked'));

        $this->btnCancelReference = new QButton($this);
        $this->btnCancelReference->Text = 'Cancel';
        $this->btnCancelReference->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelReference->AddAction(new QClickEvent(), new QAjaxAction('btnCancelReference_Clicked'));
    }
    protected function btnSaveReference_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ReferenceInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteReference_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ReferenceInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelReference_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
Reference_DetailForm::Run('Reference_DetailForm');
?>