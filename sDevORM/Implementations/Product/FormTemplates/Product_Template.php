<?php
require('../../../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/Product/ProductController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Product_DetailForm extends QForm {
    // Product Object variables
    protected $ProductInstance;
    protected $btnSaveProduct,$btnDeleteProduct,$btnCancelProduct;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitProductInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Product::Load($objId);
            if ($theObject) {
                $this->ProductInstance->setObject($theObject);
                $this->ProductInstance->setValues($theObject);
                $this->ProductInstance->refreshAll();
                $this->btnDeleteProduct->Visible = true;
            } else {
                $this->ProductInstance->setObject(null);
                $this->ProductInstance->setValues(null);
                $this->btnDeleteProduct->Visible = false;
            }
        } else {
            $this->ProductInstance->setObject(null);
            $this->ProductInstance->setValues(null);
            $this->btnDeleteProduct->Visible = false;
        }
    }
    protected function InitProductInstance() {
        $this->ProductInstance = new ProductController($this);

        $this->btnSaveProduct = new QButton($this);
        $this->btnSaveProduct->Text = 'Save';
        $this->btnSaveProduct->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveProduct->AddAction(new QClickEvent(), new QAjaxAction('btnSaveProduct_Clicked'));

        $this->btnDeleteProduct = new QButton($this);
        $this->btnDeleteProduct->Text = 'Delete';
        $this->btnDeleteProduct->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteProduct->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteProduct->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteProduct_Clicked'));

        $this->btnCancelProduct = new QButton($this);
        $this->btnCancelProduct->Text = 'Cancel';
        $this->btnCancelProduct->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelProduct->AddAction(new QClickEvent(), new QAjaxAction('btnCancelProduct_Clicked'));
    }
    protected function btnSaveProduct_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProductInstance->saveObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Saved!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
    }
    protected function btnDeleteProduct_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProductInstance->deleteObject()) {
            AppSpecificFunctions::ShowNotedFeedback('Deleted!');
        } else
            AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
    }
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
Product_DetailForm::Run('Product_DetailForm');
?>