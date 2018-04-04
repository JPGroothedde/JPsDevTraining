<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Customer/CustomerController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Customer_DetailForm extends QForm {
    // Customer Object variables
    protected $CustomerInstance;
    protected $btnSaveCustomer,$btnDeleteCustomer,$btnCancelCustomer;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitCustomerInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Customer::Load($objId);
            if ($theObject) {
                $this->CustomerInstance->setObject($theObject);
                $this->CustomerInstance->setValues($theObject);
                $this->CustomerInstance->refreshAll();
                $this->btnDeleteCustomer->Visible = true;
            } else {
                $this->CustomerInstance->setObject(null);
                $this->CustomerInstance->setValues(null);
                $this->btnDeleteCustomer->Visible = false;
            }
        } else {
            $this->CustomerInstance->setObject(null);
            $this->CustomerInstance->setValues(null);
            $this->btnDeleteCustomer->Visible = false;
        }
    }
    protected function InitCustomerInstance() {
        $this->CustomerInstance = new CustomerController($this);

        $this->btnSaveCustomer = new QButton($this);
        $this->btnSaveCustomer->Text = 'Save';
        $this->btnSaveCustomer->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveCustomer->AddAction(new QClickEvent(), new QAjaxAction('btnSaveCustomer_Clicked'));

        $this->btnDeleteCustomer = new QButton($this);
        $this->btnDeleteCustomer->Text = 'Delete';
        $this->btnDeleteCustomer->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteCustomer->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteCustomer->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteCustomer_Clicked'));

        $this->btnCancelCustomer = new QButton($this);
        $this->btnCancelCustomer->Text = 'Cancel';
        $this->btnCancelCustomer->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelCustomer->AddAction(new QClickEvent(), new QAjaxAction('btnCancelCustomer_Clicked'));
    }
    protected function btnSaveCustomer_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CustomerInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteCustomer_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CustomerInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelCustomer_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
Customer_DetailForm::Run('Customer_DetailForm');
?>