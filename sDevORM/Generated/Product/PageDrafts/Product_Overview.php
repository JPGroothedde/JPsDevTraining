<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Product/ProductController.php');
require(__SDEV_CONTROLS__.'/Implementations/Product/ProductDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Product_OverviewForm extends QForm {
    // Data grid variables
    protected $ProductGrid;
    protected $ProductWaitControlIcon;
    protected $btnNewProduct;
    protected $selectedProductId = -1;

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

        $this->InitProductDataGrid();
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
            $this->ProductGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('ProductModal');
        }
    }
    protected function btnDeleteProduct_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProductInstance->deleteObject()) {
            $this->ProductGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('ProductModal');
        }
    }
    protected function InitProductDataGrid() {
        $searchableAttributes = array(QQN::Product()->Name,QQN::Product()->UnitPrice);
        $headerItems = array('Name','Unit Price');
        $headerSortNodes = array(QQN::Product()->Name,QQN::Product()->UnitPrice);
        $columnItems = array('Name','UnitPrice');
        $this->ProductWaitControlIcon = new QWaitIcon($this);
        $this->btnNewProduct = new QButton($this);
        $this->btnNewProduct->Text = 'Add Product';
        $this->btnNewProduct->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewProduct->AddAction(new QClickEvent(), new QAjaxAction('btnNewProduct_Clicked'));
        $this->ProductGrid = new ProductDataGrid($this, QQN::Product(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->ProductWaitControlIcon, 'ProductGrid');
    }
    protected function ProductGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ProductGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ProductGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ProductGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ProductGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ProductGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ProductGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ProductGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ProductGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->ProductGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function ProductGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedProductId = $strParameter;
        $theObject = Product::Load($this->selectedProductId);
        if ($theObject) {
            $this->ProductInstance->setObject($theObject);
            $this->ProductInstance->setValues($theObject);
            $this->ProductInstance->refreshAll();
            $this->btnDeleteProduct->Visible = true;
            AppSpecificFunctions::ToggleModal('ProductModal');
        }
    }
    protected function btnNewProduct_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedProductId = -1;
        $this->ProductInstance->setObject(null);
        $this->ProductInstance->setValues(null);
        $this->btnDeleteProduct->Visible = false;
        AppSpecificFunctions::ToggleModal('ProductModal');
    }
}
Product_OverviewForm::Run('Product_OverviewForm');
?>