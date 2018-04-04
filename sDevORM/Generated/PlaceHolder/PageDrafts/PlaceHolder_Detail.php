<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PlaceHolder/PlaceHolderController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PlaceHolder_DetailForm extends QForm {
    // PlaceHolder Object variables
    protected $PlaceHolderInstance;
    protected $btnSavePlaceHolder,$btnDeletePlaceHolder,$btnCancelPlaceHolder;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPlaceHolderInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = PlaceHolder::Load($objId);
            if ($theObject) {
                $this->PlaceHolderInstance->setObject($theObject);
                $this->PlaceHolderInstance->setValues($theObject);
                $this->PlaceHolderInstance->refreshAll();
                $this->btnDeletePlaceHolder->Visible = true;
            } else {
                $this->PlaceHolderInstance->setObject(null);
                $this->PlaceHolderInstance->setValues(null);
                $this->btnDeletePlaceHolder->Visible = false;
            }
        } else {
            $this->PlaceHolderInstance->setObject(null);
            $this->PlaceHolderInstance->setValues(null);
            $this->btnDeletePlaceHolder->Visible = false;
        }
    }
    protected function InitPlaceHolderInstance() {
        $this->PlaceHolderInstance = new PlaceHolderController($this);

        $this->btnSavePlaceHolder = new QButton($this);
        $this->btnSavePlaceHolder->Text = 'Save';
        $this->btnSavePlaceHolder->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSavePlaceHolder->AddAction(new QClickEvent(), new QAjaxAction('btnSavePlaceHolder_Clicked'));

        $this->btnDeletePlaceHolder = new QButton($this);
        $this->btnDeletePlaceHolder->Text = 'Delete';
        $this->btnDeletePlaceHolder->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeletePlaceHolder->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePlaceHolder->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePlaceHolder_Clicked'));

        $this->btnCancelPlaceHolder = new QButton($this);
        $this->btnCancelPlaceHolder->Text = 'Cancel';
        $this->btnCancelPlaceHolder->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelPlaceHolder->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPlaceHolder_Clicked'));
    }
    protected function btnSavePlaceHolder_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PlaceHolderInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeletePlaceHolder_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PlaceHolderInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelPlaceHolder_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
    protected function btnDummyFour_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->PlaceHolderInstance->getControlId('DummyFour'))->Toggle(!$this->GetControl($this->PlaceHolderInstance->getControlId('DummyFour'))->IsToggled);
    }

    
}
PlaceHolder_DetailForm::Run('PlaceHolder_DetailForm');
?>