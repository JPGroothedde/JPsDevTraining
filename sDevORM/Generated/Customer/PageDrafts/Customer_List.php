<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Customer/CustomerController.php');
require(__SDEV_CONTROLS__.'/Implementations/Customer/CustomerDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Customer_ListForm extends QForm {
    // Data list variables
    protected $CustomerList;
    protected $btnNewCustomer;

    // Customer Object variables
    protected $CustomerInstance;
    protected $btnSaveCustomer,$btnDeleteCustomer;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitCustomerDataList();
        $this->InitCustomerModal();
    }
    protected function InitCustomerModal() {
        $this->CustomerInstance = new CustomerController($this);

        $this->btnSaveCustomer = new QButton($this);
        $this->btnSaveCustomer->Text = 'Save';
        $this->btnSaveCustomer->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveCustomer->AddAction(new QClickEvent(), new QAjaxAction('btnSaveCustomer_Clicked'));

        $this->btnDeleteCustomer = new QButton($this);
        $this->btnDeleteCustomer->Text = 'Delete';
        $this->btnDeleteCustomer->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteCustomer->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteCustomer->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteCustomer_Clicked'));
    }
    protected function btnSaveCustomer_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CustomerInstance->saveObject()) {
            $this->CustomerList->refreshList();
            AppSpecificFunctions::ToggleModal('CustomerModal');
        }
    }
    protected function btnDeleteCustomer_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CustomerInstance->deleteObject()) {
            $this->CustomerList->refreshList();
            AppSpecificFunctions::ToggleModal('CustomerModal');
        }
    }
    protected function InitCustomerDataList() {
        $searchableAttributes = array(QQN::Customer()->Name,QQN::Customer()->PhoneNumber);
        $SortAttributesShown = array('Name','Phone Number');
        $SortAttributes = array(QQN::Customer()->Name,QQN::Customer()->PhoneNumber);
        $columnItems = array('Name','PhoneNumber');
        $this->btnNewCustomer = AppSpecificFunctions::getNewActionButton($this,'Add Customer','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewCustomer_Clicked');
        $this->CustomerList = new CustomerDataList($this, QQN::Customer(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Customer_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->CustomerList->getActiveId() != $strParameter)
                $this->CustomerList->setActiveId($strParameter);
            else
                $this->CustomerList->setActiveId(null);
        $theObject = Customer::Load($strParameter);
        if ($theObject) {
            $this->CustomerInstance->setObject($theObject);
            $this->CustomerInstance->setValues($theObject);
            $this->CustomerInstance->refreshAll();
            $this->btnDeleteCustomer->Visible = true;
            AppSpecificFunctions::ToggleModal('CustomerModal');
        }
    }
    protected function Customer_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->CustomerList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Customer_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->CustomerList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Customer_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->CustomerList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Customer_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->CustomerList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Customer_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->CustomerList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewCustomer_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CustomerList->setActiveId(null);
        $this->CustomerInstance->setObject(null);
        $this->CustomerInstance->setValues(null);
        $this->btnDeleteCustomer->Visible = false;
        AppSpecificFunctions::ToggleModal('CustomerModal');
    }
}
Customer_ListForm::Run('Customer_ListForm');
?>