<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Invoice/InvoiceController.php');
require(__SDEV_CONTROLS__.'/Implementations/Invoice/InvoiceDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Invoice_OverviewForm extends QForm {
    // Data grid variables
    protected $InvoiceGrid;
    protected $InvoiceWaitControlIcon;
    protected $btnNewInvoice;
    protected $selectedInvoiceId = -1;

    // Invoice Object variables
    protected $InvoiceInstance;
    protected $btnSaveInvoice,$btnDeleteInvoice;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitInvoiceDataGrid();
        $this->InitInvoiceModal();
    }
    protected function InitInvoiceModal() {
        $this->InvoiceInstance = new InvoiceController($this);

        $this->btnSaveInvoice = new QButton($this);
        $this->btnSaveInvoice->Text = 'Save';
        $this->btnSaveInvoice->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveInvoice->AddAction(new QClickEvent(), new QAjaxAction('btnSaveInvoice_Clicked'));

        $this->btnDeleteInvoice = new QButton($this);
        $this->btnDeleteInvoice->Text = 'Delete';
        $this->btnDeleteInvoice->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteInvoice->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteInvoice->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteInvoice_Clicked'));
    }
    protected function btnSaveInvoice_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->InvoiceInstance->saveObject()) {
            $this->InvoiceGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('InvoiceModal');
        }
    }
    protected function btnDeleteInvoice_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->InvoiceInstance->deleteObject()) {
            $this->InvoiceGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('InvoiceModal');
        }
    }
    protected function InitInvoiceDataGrid() {
        $searchableAttributes = array(QQN::Invoice()->InvoiceNo,QQN::Invoice()->CustomerObject->Id);
        $headerItems = array('Invoice No','Customer Object');
        $headerSortNodes = array(QQN::Invoice()->InvoiceNo,QQN::Invoice()->CustomerObject->Id);
        $columnItems = array('InvoiceNo','Customer');
        $this->InvoiceWaitControlIcon = new QWaitIcon($this);
        $this->btnNewInvoice = new QButton($this);
        $this->btnNewInvoice->Text = 'Add Invoice';
        $this->btnNewInvoice->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewInvoice->AddAction(new QClickEvent(), new QAjaxAction('btnNewInvoice_Clicked'));
        $this->InvoiceGrid = new InvoiceDataGrid($this, QQN::Invoice(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->InvoiceWaitControlIcon, 'InvoiceGrid');
    }
    protected function InvoiceGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->InvoiceGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function InvoiceGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->InvoiceGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function InvoiceGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->InvoiceGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function InvoiceGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->InvoiceGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function InvoiceGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->InvoiceGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function InvoiceGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedInvoiceId = $strParameter;
        $theObject = Invoice::Load($this->selectedInvoiceId);
        if ($theObject) {
            $this->InvoiceInstance->setObject($theObject);
            $this->InvoiceInstance->setValues($theObject);
            $this->InvoiceInstance->refreshAll();
            $this->btnDeleteInvoice->Visible = true;
            AppSpecificFunctions::ToggleModal('InvoiceModal');
        }
    }
    protected function btnNewInvoice_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedInvoiceId = -1;
        $this->InvoiceInstance->setObject(null);
        $this->InvoiceInstance->setValues(null);
        $this->btnDeleteInvoice->Visible = false;
        AppSpecificFunctions::ToggleModal('InvoiceModal');
    }
}
Invoice_OverviewForm::Run('Invoice_OverviewForm');
?>