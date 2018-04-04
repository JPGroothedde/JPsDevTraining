<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Customer/CustomerController.php');
require(__SDEV_CONTROLS__.'/Implementations/Customer/CustomerDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Customer_OverviewForm extends QForm {
    // Data grid variables
    protected $CustomerGrid;
    protected $CustomerWaitControlIcon;
    protected $btnNewCustomer;
    protected $selectedCustomerId = -1;

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

        $this->InitCustomerDataGrid();
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
            $this->CustomerGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('CustomerModal');
        }
    }
    protected function btnDeleteCustomer_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CustomerInstance->deleteObject()) {
            $this->CustomerGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('CustomerModal');
        }
    }
    protected function InitCustomerDataGrid() {
        $searchableAttributes = array(QQN::Customer()->Name,QQN::Customer()->PhoneNumber);
        $headerItems = array('Name','Phone Number');
        $headerSortNodes = array(QQN::Customer()->Name,QQN::Customer()->PhoneNumber);
        $columnItems = array('Name','PhoneNumber');
        $this->CustomerWaitControlIcon = new QWaitIcon($this);
        $this->btnNewCustomer = new QButton($this);
        $this->btnNewCustomer->Text = 'Add Customer';
        $this->btnNewCustomer->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewCustomer->AddAction(new QClickEvent(), new QAjaxAction('btnNewCustomer_Clicked'));
        $this->CustomerGrid = new CustomerDataGrid($this, QQN::Customer(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->CustomerWaitControlIcon, 'CustomerGrid');
    }
    protected function CustomerGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CustomerGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CustomerGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CustomerGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CustomerGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CustomerGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CustomerGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CustomerGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CustomerGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->CustomerGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function CustomerGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedCustomerId = $strParameter;
        $theObject = Customer::Load($this->selectedCustomerId);
        if ($theObject) {
            $this->CustomerInstance->setObject($theObject);
            $this->CustomerInstance->setValues($theObject);
            $this->CustomerInstance->refreshAll();
            $this->btnDeleteCustomer->Visible = true;
            AppSpecificFunctions::ToggleModal('CustomerModal');
        }
    }
    protected function btnNewCustomer_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedCustomerId = -1;
        $this->CustomerInstance->setObject(null);
        $this->CustomerInstance->setValues(null);
        $this->btnDeleteCustomer->Visible = false;
        AppSpecificFunctions::ToggleModal('CustomerModal');
    }
}
Customer_OverviewForm::Run('Customer_OverviewForm');
?>