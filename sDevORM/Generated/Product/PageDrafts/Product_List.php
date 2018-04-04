<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Product/ProductController.php');
require(__SDEV_CONTROLS__.'/Implementations/Product/ProductDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Product_ListForm extends QForm {
    // Data list variables
    protected $ProductList;
    protected $btnNewProduct;

    // Product Object variables
    protected $ProductInstance;
    protected $btnSaveProduct,$btnDeleteProduct;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitProductDataList();
        $this->InitProductModal();
    }
    protected function InitProductModal() {
        $this->ProductInstance = new ProductController($this);

        $this->btnSaveProduct = new QButton($this);
        $this->btnSaveProduct->Text = 'Save';
        $this->btnSaveProduct->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveProduct->AddAction(new QClickEvent(), new QAjaxAction('btnSaveProduct_Clicked'));

        $this->btnDeleteProduct = new QButton($this);
        $this->btnDeleteProduct->Text = 'Delete';
        $this->btnDeleteProduct->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteProduct->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteProduct->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteProduct_Clicked'));
    }
    protected function btnSaveProduct_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProductInstance->saveObject()) {
            $this->ProductList->refreshList();
            AppSpecificFunctions::ToggleModal('ProductModal');
        }
    }
    protected function btnDeleteProduct_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProductInstance->deleteObject()) {
            $this->ProductList->refreshList();
            AppSpecificFunctions::ToggleModal('ProductModal');
        }
    }
    protected function InitProductDataList() {
        $searchableAttributes = array(QQN::Product()->Name,QQN::Product()->UnitPrice);
        $SortAttributesShown = array('Name','Unit Price');
        $SortAttributes = array(QQN::Product()->Name,QQN::Product()->UnitPrice);
        $columnItems = array('Name','UnitPrice');
        $this->btnNewProduct = AppSpecificFunctions::getNewActionButton($this,'Add Product','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewProduct_Clicked');
        $this->ProductList = new ProductDataList($this, QQN::Product(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Product_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProductList->getActiveId() != $strParameter)
                $this->ProductList->setActiveId($strParameter);
            else
                $this->ProductList->setActiveId(null);
        $theObject = Product::Load($strParameter);
        if ($theObject) {
            $this->ProductInstance->setObject($theObject);
            $this->ProductInstance->setValues($theObject);
            $this->ProductInstance->refreshAll();
            $this->btnDeleteProduct->Visible = true;
            AppSpecificFunctions::ToggleModal('ProductModal');
        }
    }
    protected function Product_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->ProductList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Product_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->ProductList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Product_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->ProductList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Product_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->ProductList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Product_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->ProductList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewProduct_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ProductList->setActiveId(null);
        $this->ProductInstance->setObject(null);
        $this->ProductInstance->setValues(null);
        $this->btnDeleteProduct->Visible = false;
        AppSpecificFunctions::ToggleModal('ProductModal');
    }
}
Product_ListForm::Run('Product_ListForm');
?>