<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');

class IndexForm extends QForm {
	public function Form_Create() {
		parent::Form_Create();
		$CustomerObj = new Customer();
		$CustomerObj->Name = "Test 1";
		try {
            $CustomerObj->Save();
        } catch (QCallerException $e) {

        }
		//AppSpecificFunctions::AddCustomLog("Customer Name" . $CustomerObj->getJson());
		$ProductObj = new Product();
		$ProductObj->Name = "Product 1";
		$ProductObj->UnitPrice = "20.00";
		try {
            $ProductObj->Save();
        } catch (QCallerException $e) {

        }
        //AppSpecificFunctions::AddCustomLog("Product:" . $ProductObj->getJson());
        $InvoiceObj = new Invoice();
        $InvoiceObj->CustomerObject = Customer::Load(1);
        try {
            $InvoiceObj->Save();
        } catch (QCallerException $e) {

        }
        $LineItemObj = new LineItem();
        $LineItemObj->ProductObject = $ProductObj;
        $LineItemObj->InvoiceObject = $InvoiceObj;
        try {
            $LineItemObj->Save();
        } catch (QCallerException $e) {

        }
        $InvoiceArray = Invoice::QueryArray(QQ::All());
        foreach ($InvoiceArray as $Item) {
            AppSpecificFunctions::AddCustomLog('Invoice:'.$Item->getJson());
        }
	}
}

IndexForm::Run('IndexForm');
?>