<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/BackgroundProcessUpdate/BackgroundProcessUpdateController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class BackgroundProcessUpdate_DetailForm extends QForm {
    // BackgroundProcessUpdate Object variables
    protected $BackgroundProcessUpdateInstance;
    protected $btnSaveBackgroundProcessUpdate,$btnDeleteBackgroundProcessUpdate,$btnCancelBackgroundProcessUpdate;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitBackgroundProcessUpdateInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = BackgroundProcessUpdate::Load($objId);
            if ($theObject) {
                $this->BackgroundProcessUpdateInstance->setObject($theObject);
                $this->BackgroundProcessUpdateInstance->setValues($theObject);
                $this->BackgroundProcessUpdateInstance->refreshAll();
                $this->btnDeleteBackgroundProcessUpdate->Visible = true;
            } else {
                $this->BackgroundProcessUpdateInstance->setObject(null);
                $this->BackgroundProcessUpdateInstance->setValues(null);
                $this->btnDeleteBackgroundProcessUpdate->Visible = false;
            }
        } else {
            $this->BackgroundProcessUpdateInstance->setObject(null);
            $this->BackgroundProcessUpdateInstance->setValues(null);
            $this->btnDeleteBackgroundProcessUpdate->Visible = false;
        }
    }
    protected function InitBackgroundProcessUpdateInstance() {
        $this->BackgroundProcessUpdateInstance = new BackgroundProcessUpdateController($this);

        $this->btnSaveBackgroundProcessUpdate = new QButton($this);
        $this->btnSaveBackgroundProcessUpdate->Text = 'Save';
        $this->btnSaveBackgroundProcessUpdate->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveBackgroundProcessUpdate->AddAction(new QClickEvent(), new QAjaxAction('btnSaveBackgroundProcessUpdate_Clicked'));

        $this->btnDeleteBackgroundProcessUpdate = new QButton($this);
        $this->btnDeleteBackgroundProcessUpdate->Text = 'Delete';
        $this->btnDeleteBackgroundProcessUpdate->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteBackgroundProcessUpdate->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteBackgroundProcessUpdate->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteBackgroundProcessUpdate_Clicked'));

        $this->btnCancelBackgroundProcessUpdate = new QButton($this);
        $this->btnCancelBackgroundProcessUpdate->Text = 'Cancel';
        $this->btnCancelBackgroundProcessUpdate->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelBackgroundProcessUpdate->AddAction(new QClickEvent(), new QAjaxAction('btnCancelBackgroundProcessUpdate_Clicked'));
    }
    protected function btnSaveBackgroundProcessUpdate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessUpdateInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteBackgroundProcessUpdate_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->BackgroundProcessUpdateInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelBackgroundProcessUpdate_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
BackgroundProcessUpdate_DetailForm::Run('BackgroundProcessUpdate_DetailForm');
?>