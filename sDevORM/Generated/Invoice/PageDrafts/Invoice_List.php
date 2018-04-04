<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Invoice/InvoiceController.php');
require(__SDEV_CONTROLS__.'/Implementations/Invoice/InvoiceDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Invoice_ListForm extends QForm {
    // Data list variables
    protected $InvoiceList;
    protected $btnNewInvoice;

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

        $this->InitInvoiceDataList();
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
            $this->InvoiceList->refreshList();
            AppSpecificFunctions::ToggleModal('InvoiceModal');
        }
    }
    protected function btnDeleteInvoice_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->InvoiceInstance->deleteObject()) {
            $this->InvoiceList->refreshList();
            AppSpecificFunctions::ToggleModal('InvoiceModal');
        }
    }
    protected function InitInvoiceDataList() {
        $searchableAttributes = array(QQN::Invoice()->InvoiceNo,QQN::Invoice()->CustomerObject->Id);
        $SortAttributesShown = array('Invoice No','Customer Object');
        $SortAttributes = array(QQN::Invoice()->InvoiceNo,QQN::Invoice()->CustomerObject->Id);
        $columnItems = array('InvoiceNo','Customer');
        $this->btnNewInvoice = AppSpecificFunctions::getNewActionButton($this,'Add Invoice','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewInvoice_Clicked');
        $this->InvoiceList = new InvoiceDataList($this, QQN::Invoice(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Invoice_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->InvoiceList->getActiveId() != $strParameter)
                $this->InvoiceList->setActiveId($strParameter);
            else
                $this->InvoiceList->setActiveId(null);
        $theObject = Invoice::Load($strParameter);
        if ($theObject) {
            $this->InvoiceInstance->setObject($theObject);
            $this->InvoiceInstance->setValues($theObject);
            $this->InvoiceInstance->refreshAll();
            $this->btnDeleteInvoice->Visible = true;
            AppSpecificFunctions::ToggleModal('InvoiceModal');
        }
    }
    protected function Invoice_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->InvoiceList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Invoice_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->InvoiceList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Invoice_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->InvoiceList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Invoice_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->InvoiceList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Invoice_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->InvoiceList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewInvoice_Clicked($strFormId, $strControlId, $strParameter) {
        $this->InvoiceList->setActiveId(null);
        $this->InvoiceInstance->setObject(null);
        $this->InvoiceInstance->setValues(null);
        $this->btnDeleteInvoice->Visible = false;
        AppSpecificFunctions::ToggleModal('InvoiceModal');
    }
}
Invoice_ListForm::Run('Invoice_ListForm');
?>