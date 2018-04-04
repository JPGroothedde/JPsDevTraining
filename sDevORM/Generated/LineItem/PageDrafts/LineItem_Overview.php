<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/LineItem/LineItemController.php');
require(__SDEV_CONTROLS__.'/Implementations/LineItem/LineItemDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class LineItem_OverviewForm extends QForm {
    // Data grid variables
    protected $LineItemGrid;
    protected $LineItemWaitControlIcon;
    protected $btnNewLineItem;
    protected $selectedLineItemId = -1;

    // LineItem Object variables
    protected $LineItemInstance;
    protected $btnSaveLineItem,$btnDeleteLineItem;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitLineItemDataGrid();
        $this->InitLineItemModal();
    }
    protected function InitLineItemModal() {
        $this->LineItemInstance = new LineItemController($this);

        $this->btnSaveLineItem = new QButton($this);
        $this->btnSaveLineItem->Text = 'Save';
        $this->btnSaveLineItem->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveLineItem->AddAction(new QClickEvent(), new QAjaxAction('btnSaveLineItem_Clicked'));

        $this->btnDeleteLineItem = new QButton($this);
        $this->btnDeleteLineItem->Text = 'Delete';
        $this->btnDeleteLineItem->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteLineItem->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteLineItem->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteLineItem_Clicked'));
    }
    protected function btnSaveLineItem_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->LineItemInstance->saveObject()) {
            $this->LineItemGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('LineItemModal');
        }
    }
    protected function btnDeleteLineItem_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->LineItemInstance->deleteObject()) {
            $this->LineItemGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('LineItemModal');
        }
    }
    protected function InitLineItemDataGrid() {
        $searchableAttributes = array(QQN::LineItem()->Quantity,QQN::LineItem()->LineTotal,QQN::LineItem()->ProductObject->Id,QQN::LineItem()->InvoiceObject->Id);
        $headerItems = array('Quantity','Line Total','Product Object','Invoice Object');
        $headerSortNodes = array(QQN::LineItem()->Quantity,QQN::LineItem()->LineTotal,QQN::LineItem()->ProductObject->Id,QQN::LineItem()->InvoiceObject->Id);
        $columnItems = array('Quantity','LineTotal','Product','Invoice');
        $this->LineItemWaitControlIcon = new QWaitIcon($this);
        $this->btnNewLineItem = new QButton($this);
        $this->btnNewLineItem->Text = 'Add LineItem';
        $this->btnNewLineItem->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewLineItem->AddAction(new QClickEvent(), new QAjaxAction('btnNewLineItem_Clicked'));
        $this->LineItemGrid = new LineItemDataGrid($this, QQN::LineItem(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->LineItemWaitControlIcon, 'LineItemGrid');
    }
    protected function LineItemGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->LineItemGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function LineItemGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->LineItemGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function LineItemGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->LineItemGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function LineItemGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->LineItemGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function LineItemGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->LineItemGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function LineItemGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedLineItemId = $strParameter;
        $theObject = LineItem::Load($this->selectedLineItemId);
        if ($theObject) {
            $this->LineItemInstance->setObject($theObject);
            $this->LineItemInstance->setValues($theObject);
            $this->LineItemInstance->refreshAll();
            $this->btnDeleteLineItem->Visible = true;
            AppSpecificFunctions::ToggleModal('LineItemModal');
        }
    }
    protected function btnNewLineItem_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedLineItemId = -1;
        $this->LineItemInstance->setObject(null);
        $this->LineItemInstance->setValues(null);
        $this->btnDeleteLineItem->Visible = false;
        AppSpecificFunctions::ToggleModal('LineItemModal');
    }
}
LineItem_OverviewForm::Run('LineItem_OverviewForm');
?>