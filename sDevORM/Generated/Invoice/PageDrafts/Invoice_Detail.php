<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Invoice/InvoiceController.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Invoice_DetailForm extends QForm {
    // Invoice Object variables
    protected $InvoiceInstance;
    protected $btnSaveInvoice,$btnDeleteInvoice,$btnCancelInvoice;

    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitInvoiceInstance();

        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Invoice::Load($objId);
            if ($theObject) {
                $this->InvoiceInstance->setObject($theObject);
                $this->InvoiceInstance->setValues($theObject);
                $this->InvoiceInstance->refreshAll();
                $this->btnDeleteInvoice->Visible = true;
            } else {
                $this->InvoiceInstance->setObject(null);
                $this->InvoiceInstance->setValues(null);
                $this->btnDeleteInvoice->Visible = false;
            }
        } else {
            $this->InvoiceInstance->setObject(null);
            $this->InvoiceInstance->setValues(null);
            $this->btnDeleteInvoice->Visible = false;
        }
    }
    protected function InitInvoiceInstance() {
        $this->InvoiceInstance = new InvoiceController($this);

        $this->btnSaveInvoice = new QButton($this);
        $this->btnSaveInvoice->Text = 'Save';
        $this->btnSaveInvoice->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSaveInvoice->AddAction(new QClickEvent(), new QAjaxAction('btnSaveInvoice_Clicked'));

        $this->btnDeleteInvoice = new QButton($this);
        $this->btnDeleteInvoice->Text = 'Delete';
        $this->btnDeleteInvoice->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeleteInvoice->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteInvoice->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteInvoice_Clicked'));

        $this->btnCancelInvoice = new QButton($this);
        $this->btnCancelInvoice->Text = 'Cancel';
        $this->btnCancelInvoice->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelInvoice->AddAction(new QClickEvent(), new QAjaxAction('btnCancelInvoice_Clicked'));
    }
    protected function btnSaveInvoice_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->InvoiceInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnDeleteInvoice_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->InvoiceInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelInvoice_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
}
Invoice_DetailForm::Run('Invoice_DetailForm');
?>