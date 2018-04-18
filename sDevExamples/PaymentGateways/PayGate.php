<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
include(__DOCROOT__.__SUBDIRECTORY__.'/ExternalPlugins/PayGate/sPayGatePlugin.php');
AppSpecificFunctions::CheckRemoteAdmin();

class PayGateForm extends QForm {
    protected $PayGateObj;
    protected $txtAmount,$btnSubmit;
    public function Form_Create() {
        parent::Form_Create();
        $this->PayGateObj = new sPayGatePlugin('10011072130');
        $paymentResult = $this->PayGateObj->checkPaymentResult();
        if ($paymentResult != false)
            $this->handlePaymentResult($paymentResult);
        $this->txtAmount = new QTextBox($this);
        $this->txtAmount->Name = 'Amount';
        $this->btnSubmit = AppSpecificFunctions::getNewActionButton($this,'Submit Payment','btn btn-default','SubmitPayment');
    }
    protected function SubmitPayment() {
        $this->PayGateObj->makePayment($this->txtAmount->Text,'Test_Reference');
    }
    protected function handlePaymentResult($Result = '') {
        if (strlen($Result) > 0) {
            AppSpecificFunctions::ShowNotedFeedback('Payment was: '.$Result);
        } else
            AppSpecificFunctions::ShowNotedFeedback('Payment error occured',false);
    }
}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
PayGateForm::Run('PayGateForm');
?>