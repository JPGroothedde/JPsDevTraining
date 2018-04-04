<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/LineItem/LineItemController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class LineItem_DetailForm extends QForm {
    // LineItem Object variables
    protected $LineItemInstance;
    protected $btnSaveLineItem,$btnDeleteLineItem,$btnCancelLineItem;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitLineItemInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = LineItem::Load($objId);
            if ($theObject) {
                $this->LineItemInstance->setObject($theObject);
                $this->LineItemInstance->setValues($theObject);
                $this->LineItemInstance->refreshAll();
                $this->btnDeleteLineItem->Visible = true;
            } else {
                $this->LineItemInstance->setObject(null);
                $this->LineItemInstance->setValues(null);
                $this->btnDeleteLineItem->Visible = false;
            }
        } else {
            $this->LineItemInstance->setObject(null);
            $this->LineItemInstance->setValues(null);
            $this->btnDeleteLineItem->Visible = false;
        }
    }
    protected function InitLineItemInstance() {
        $this->LineItemInstance = new LineItemController($this);

        $this->btnSaveLineItem = new QButton($this);
        $this->btnSaveLineItem->Text = 'Save';
        $this->btnSaveLineItem->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveLineItem->AddAction(new QClickEvent(), new QAjaxAction('btnSaveLineItem_Clicked'));

        $this->btnDeleteLineItem = new QButton($this);
        $this->btnDeleteLineItem->Text = 'Delete';
        $this->btnDeleteLineItem->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteLineItem->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteLineItem->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteLineItem_Clicked'));

        $this->btnCancelLineItem = new QButton($this);
        $this->btnCancelLineItem->Text = 'Cancel';
        $this->btnCancelLineItem->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelLineItem->AddAction(new QClickEvent(), new QAjaxAction('btnCancelLineItem_Clicked'));
    }
    protected function btnSaveLineItem_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->LineItemInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteLineItem_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->LineItemInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelLineItem_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
LineItem_DetailForm::Run('LineItem_DetailForm');
?>