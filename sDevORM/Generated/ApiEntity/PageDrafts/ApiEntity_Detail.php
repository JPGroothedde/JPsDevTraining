<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/ApiEntity/ApiEntityController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class ApiEntity_DetailForm extends QForm {
    // ApiEntity Object variables
    protected $ApiEntityInstance;
    protected $btnSaveApiEntity,$btnDeleteApiEntity,$btnCancelApiEntity;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitApiEntityInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = ApiEntity::Load($objId);
            if ($theObject) {
                $this->ApiEntityInstance->setObject($theObject);
                $this->ApiEntityInstance->setValues($theObject);
                $this->ApiEntityInstance->refreshAll();
                $this->btnDeleteApiEntity->Visible = true;
            } else {
                $this->ApiEntityInstance->setObject(null);
                $this->ApiEntityInstance->setValues(null);
                $this->btnDeleteApiEntity->Visible = false;
            }
        } else {
            $this->ApiEntityInstance->setObject(null);
            $this->ApiEntityInstance->setValues(null);
            $this->btnDeleteApiEntity->Visible = false;
        }
    }
    protected function InitApiEntityInstance() {
        $this->ApiEntityInstance = new ApiEntityController($this);

        $this->btnSaveApiEntity = new QButton($this);
        $this->btnSaveApiEntity->Text = 'Save';
        $this->btnSaveApiEntity->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveApiEntity->AddAction(new QClickEvent(), new QAjaxAction('btnSaveApiEntity_Clicked'));

        $this->btnDeleteApiEntity = new QButton($this);
        $this->btnDeleteApiEntity->Text = 'Delete';
        $this->btnDeleteApiEntity->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteApiEntity->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteApiEntity->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteApiEntity_Clicked'));

        $this->btnCancelApiEntity = new QButton($this);
        $this->btnCancelApiEntity->Text = 'Cancel';
        $this->btnCancelApiEntity->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelApiEntity->AddAction(new QClickEvent(), new QAjaxAction('btnCancelApiEntity_Clicked'));
    }
    protected function btnSaveApiEntity_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiEntityInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteApiEntity_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ApiEntityInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelApiEntity_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
ApiEntity_DetailForm::Run('ApiEntity_DetailForm');
?>