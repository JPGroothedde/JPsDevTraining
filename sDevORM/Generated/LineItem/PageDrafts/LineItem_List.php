<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/LineItem/LineItemController.php');
require(__SDEV_CONTROLS__.'/Implementations/LineItem/LineItemDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class LineItem_ListForm extends QForm {
    // Data list variables
    protected $LineItemList;
    protected $btnNewLineItem;

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

        $this->InitLineItemDataList();
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
            $this->LineItemList->refreshList();
            AppSpecificFunctions::ToggleModal('LineItemModal');
        }
    }
    protected function btnDeleteLineItem_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->LineItemInstance->deleteObject()) {
            $this->LineItemList->refreshList();
            AppSpecificFunctions::ToggleModal('LineItemModal');
        }
    }
    protected function InitLineItemDataList() {
        $searchableAttributes = array(QQN::LineItem()->Quantity,QQN::LineItem()->LineTotal,QQN::LineItem()->ProductObject->Id,QQN::LineItem()->InvoiceObject->Id);
        $SortAttributesShown = array('Quantity','Line Total','Product Object','Invoice Object');
        $SortAttributes = array(QQN::LineItem()->Quantity,QQN::LineItem()->LineTotal,QQN::LineItem()->ProductObject->Id,QQN::LineItem()->InvoiceObject->Id);
        $columnItems = array('Quantity','LineTotal','Product','Invoice');
        $this->btnNewLineItem = AppSpecificFunctions::getNewActionButton($this,'Add LineItem','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewLineItem_Clicked');
        $this->LineItemList = new LineItemDataList($this, QQN::LineItem(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function LineItem_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->LineItemList->getActiveId() != $strParameter)
                $this->LineItemList->setActiveId($strParameter);
            else
                $this->LineItemList->setActiveId(null);
        $theObject = LineItem::Load($strParameter);
        if ($theObject) {
            $this->LineItemInstance->setObject($theObject);
            $this->LineItemInstance->setValues($theObject);
            $this->LineItemInstance->refreshAll();
            $this->btnDeleteLineItem->Visible = true;
            AppSpecificFunctions::ToggleModal('LineItemModal');
        }
    }
    protected function LineItem_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->LineItemList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function LineItem_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->LineItemList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function LineItem_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->LineItemList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function LineItem_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->LineItemList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function LineItem_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->LineItemList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewLineItem_Clicked($strFormId, $strControlId, $strParameter) {
        $this->LineItemList->setActiveId(null);
        $this->LineItemInstance->setObject(null);
        $this->LineItemInstance->setValues(null);
        $this->btnDeleteLineItem->Visible = false;
        AppSpecificFunctions::ToggleModal('LineItemModal');
    }
}
LineItem_ListForm::Run('LineItem_ListForm');
?>