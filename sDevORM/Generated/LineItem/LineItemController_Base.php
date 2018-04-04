<?php
class LineItemController_Base {
    protected $Object;
    public $txtQuantity;
    public $txtLineTotal;
    public $lstProduct,$saveUsingLstProduct = false;
    public $lstInvoice,$saveUsingLstInvoice = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtQuantity = new QTextBox($objParentObject);
        $this->txtQuantity->Name = 'Quantity';

        $this->txtLineTotal = new QTextBox($objParentObject);
        $this->txtLineTotal->Name = 'Line Total';

        $this->lstProduct = new QListBox($objParentObject);
        $this->lstProduct->Name = 'Product';
        $this->lstProduct->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allProduct = Product::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allProduct as $Product) {
            $this->lstProduct->AddItem(new QListItem($Product->Id,$Product->Id));
        }

        $this->lstInvoice = new QListBox($objParentObject);
        $this->lstInvoice->Name = 'Invoice';
        $this->lstInvoice->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allInvoice = Invoice::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allInvoice as $Invoice) {
            $this->lstInvoice->AddItem(new QListItem($Invoice->Id,$Invoice->Id));
        }

        if ($InitObject)
            $this->Object = $InitObject;
        else
            $this->Object = null;
        $this->setValues($this->Object);
    }

    

    public function setObject($Object) {
        if ($Object)
            $this->Object = $Object;
        else
            $this->Object = null;
    }

    public function setReferenceListObjectDisplayAttribute($ReferenceObject = null,$ReferenceAttribute = null) {
        if ($ReferenceObject && $ReferenceAttribute) {
            if ($ReferenceObject == 'Product') {
                $this->lstProduct->RemoveAllItems();
                $allProduct_list = Product::LoadAll();
                foreach ($allProduct_list as $Product) {
                    $this->lstProduct->AddItem(new QListItem($Product->__get($ReferenceAttribute),$Product->Id));
                }
            }
            if ($ReferenceObject == 'Invoice') {
                $this->lstInvoice->RemoveAllItems();
                $allInvoice_list = Invoice::LoadAll();
                foreach ($allInvoice_list as $Invoice) {
                    $this->lstInvoice->AddItem(new QListItem($Invoice->__get($ReferenceAttribute),$Invoice->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'Product') {
                $this->saveUsingLstProduct = $useListValue;
            }
            if ($ReferenceObject == 'Invoice') {
                $this->saveUsingLstInvoice = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtQuantity->Text = '';
        $this->txtLineTotal->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->Quantity)) {
            $this->txtQuantity->Text = $Object->Quantity;
        }
        if (!is_null($Object->LineTotal)) {
            $this->txtLineTotal->Text = $Object->LineTotal;
        }
        
        if (!is_null($Object->ProductObject)) {
            $this->lstProduct->SelectedValue = $Object->ProductObject->Id;
        }
        if (!is_null($Object->InvoiceObject)) {
            $this->lstInvoice->SelectedValue = $Object->InvoiceObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'QUANTITY') {
            if (strlen($nameValue) > 0)
                $this->txtQuantity->Name = $nameValue;
            $output = $withName ? $this->txtQuantity->RenderWithName($blnPrintOutput):$this->txtQuantity->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'LINETOTAL') {
            if (strlen($nameValue) > 0)
                $this->txtLineTotal->Name = $nameValue;
            $output = $withName ? $this->txtLineTotal->RenderWithName($blnPrintOutput):$this->txtLineTotal->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PRODUCT') {
            if (strlen($nameValue) > 0)
                $this->lstProduct->Name = $nameValue;
            $output = $withName ? $this->lstProduct->RenderWithName($blnPrintOutput):$this->lstProduct->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'INVOICE') {
            if (strlen($nameValue) > 0)
                $this->lstInvoice->Name = $nameValue;
            $output = $withName ? $this->lstInvoice->RenderWithName($blnPrintOutput):$this->lstInvoice->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('QUANTITY',$withName);
        $this->renderControl('LINETOTAL',$withName);
        $this->renderControl('PRODUCT',$withName);
        $this->renderControl('INVOICE',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('Quantity',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('LineTotal',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtQuantity->Visible = false;
        $this->txtLineTotal->Visible = false;
        $this->lstProduct->Visible = false;
        $this->lstInvoice->Visible = false;
    }

    public function showAll() {
        $this->txtQuantity->Visible = true;
        $this->txtLineTotal->Visible = true;
        $this->lstProduct->Visible = true;
        $this->lstInvoice->Visible = true;
    }

    public function refreshAll() {
        $this->txtQuantity->Refresh();
        $this->txtLineTotal->Refresh();
        $this->lstProduct->Refresh();
        $this->lstInvoice->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'QUANTITY':
                $this->txtQuantity->Text = $value;
                break;
            case 'LINETOTAL':
                $this->txtLineTotal->Text = $value;
                break;
            case 'PRODUCT':
                $this->lstProduct->SelectedValue = $value;
                break;
            case 'INVOICE':
                $this->lstInvoice->SelectedValue = $value;
                break;
            default:
                break;
        }
        return null;
    }


    public function getValue($strAttr = '') {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'QUANTITY':
                if ($this->txtQuantity->Text)
                    return $this->txtQuantity->Text;
                break;
            case 'LINETOTAL':
                if ($this->txtLineTotal->Text)
                    return $this->txtLineTotal->Text;
                break;
            case 'PRODUCT':
                if ($this->lstProduct->SelectedValue)
                    return $this->lstProduct->SelectedValue;
                break;
            case 'INVOICE':
                if ($this->lstInvoice->SelectedValue)
                    return $this->lstInvoice->SelectedValue;
                break;
            default:
                break;
        }
        return null;
    }


    public function getControlId($strAttr = '') {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'QUANTITY':
                if ($this->txtQuantity)
                    return $this->txtQuantity->ControlId;
                break;
            case 'LINETOTAL':
                if ($this->txtLineTotal)
                    return $this->txtLineTotal->ControlId;
                break;
            case 'PRODUCT':
                if ($this->lstProduct)
                    return $this->lstProduct->ControlId;
                break;
            case 'INVOICE':
                if ($this->lstInvoice)
                    return $this->lstInvoice->ControlId;
                break;
            default:
                break;
        }
        return null;
    }


    public function hideControl($strAttr = '') {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'QUANTITY':
                $this->txtQuantity->Visible = false;
                $this->txtQuantity->Refresh();
                break;
            case 'LINETOTAL':
                $this->txtLineTotal->Visible = false;
                $this->txtLineTotal->Refresh();
                break;
            case 'PRODUCT':
                $this->lstProduct->Visible = false;
                $this->lstProduct->Refresh();
                break;
            case 'INVOICE':
                $this->lstInvoice->Visible = false;
                $this->lstInvoice->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function showControl($strAttr = '') {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'QUANTITY':
                $this->txtQuantity->Visible = true;
                $this->txtQuantity->Refresh();
                break;
            case 'LINETOTAL':
                $this->txtLineTotal->Visible = true;
                $this->txtLineTotal->Refresh();
                break;
            case 'PRODUCT':
                $this->lstProduct->Visible = true;
                $this->lstProduct->Refresh();
                break;
            case 'INVOICE':
                $this->lstInvoice->Visible = true;
                $this->lstInvoice->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtQuantity->getJqControlId();
    }

    public function getObject () {
        return $this->Object;
    }

    public function getObjectId() {
        if ($this->Object)
            return $this->Object->Id;
        else
            return -1;
    }

    public function applyValuesBeforeSaveObject($Product = null,$Invoice = null)  {
        if (!$this->Object)
            $this->Object = new LineItem();
        
        $this->Object->Quantity = $this->txtQuantity->Text;
        $this->Object->LineTotal = $this->txtLineTotal->Text;
        if ($Product) {
            $this->Object->ProductObject = $Product;
        }
        if ($this->saveUsingLstProduct) {
            $linkedProduct = Product::Load($this->lstProduct->SelectedValue);
            $this->Object->ProductObject = $linkedProduct;
        }
        if ($Invoice) {
            $this->Object->InvoiceObject = $Invoice;
        }
        if ($this->saveUsingLstInvoice) {
            $linkedInvoice = Invoice::Load($this->lstInvoice->SelectedValue);
            $this->Object->InvoiceObject = $linkedInvoice;
        }
    }

    public function saveObject($validate = true,$Product = null,$Invoice = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Product,$Invoice);
        
        return $this->saveWithAudit();
    }

    public function deleteObject()  {
        if (!$this->deleteWithAudit()) {
            AppSpecificFunctions::DisplayAlert('Could not delete the object right now. Please try again later...');
            return false;
        }
        return true;
    }

    public function validateObject()  {
        $hasNoErrors = true;
        //$this->resetValidation();
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtQuantity);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtLineTotal);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtQuantity->WrapperCssClass = 'form-group';
            $this->txtQuantity->Placeholder = '';
            $this->txtLineTotal->WrapperCssClass = 'form-group';
            $this->txtLineTotal->Placeholder = '';
        $js = AppSpecificFunctions::GetDatePickerInitJs();
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    public function saveWithAudit() {
        try {
            $this->Object->Save();
            return true;
        } catch(QCallerException $e) {
            error_log('Could not save object. Error: '.$e->getMessage());
            return false;
        }
        //This is the OLD method that is to be removed. Keeping it here for reference for the next few minor versions of sDev
        //sDev Version as of this comment: 1.4.1
        /*
        if ($this->Object)
            $previousValues = LineItem::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'Quantity-> Value before: '.$previousValues->Quantity.', Value after: '.$this->Object->Quantity.'<br>
        LineTotal-> Value before: '.$previousValues->LineTotal.', Value after: '.$this->Object->LineTotal.'<br>
        ';
        } else {
        $changeText = 'Quantity-> Value: '.$this->Object->Quantity.'<br>
        LineTotal-> Value: '.$this->Object->LineTotal.'<br>
        ';
        }
        try {
            $AuditLogEntry = new AuditLogEntry();
            $AuditLogEntry->EntryTimeStamp = QDateTime::Now(true);
            $AuditLogEntry->ModificationType = 'Create';
            if ($previousValues) {
                $AuditLogEntry->ObjectId = $this->Object->Id;
                $AuditLogEntry->ModificationType = 'Update';
            }
            $AuditLogEntry->ObjectName = 'LineItem';
            $AuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
            $AuditLogEntry->AuditLogEntryDetail = $changeText;
            $AuditLogEntry->Save();

            $this->Object->Save();
            return true;
        } catch(QCallerException $e) {
            AppSpecificFunctions::DisplayAlert('Could not save right now. Please try again later...');
            return false;
        }*/
    }

    public function deleteWithAudit() {
        $this->Object->Delete();
        return true;
        //This is the OLD method that is to be removed. Keeping it here for reference for the next few minor versions of sDev
        //sDev Version as of this comment: 1.4.1
        /*
        if ($this->Object){
            try {
                $AuditLogEntry = new AuditLogEntry();
                $AuditLogEntry->EntryTimeStamp = QDateTime::Now(true);
                $AuditLogEntry->ModificationType = 'Delete';
                $AuditLogEntry->ObjectName = 'LineItem';
                $AuditLogEntry->UserEmail = AppSpecificFunctions::getCurrentUserEmailForAudit();
                $AuditLogEntry->AuditLogEntryDetail = '';
                $AuditLogEntry->ObjectId = $this->Object->Id;
                $AuditLogEntry->Save();
                $this->Object->Delete();
                return true;
            } catch (QCallerException $e) {
                return false;
            }
        } else
            return false;
        */
    }

    
};
?>