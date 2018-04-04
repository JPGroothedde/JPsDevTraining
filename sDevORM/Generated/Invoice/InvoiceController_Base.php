<?php
class InvoiceController_Base {
    protected $Object;
    public $txtInvoiceNo;
    public $lstCustomer,$saveUsingLstCustomer = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtInvoiceNo = new QTextBox($objParentObject);
        $this->txtInvoiceNo->Name = 'Invoice No';

        $this->lstCustomer = new QListBox($objParentObject);
        $this->lstCustomer->Name = 'Customer';
        $this->lstCustomer->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allCustomer = Customer::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allCustomer as $Customer) {
            $this->lstCustomer->AddItem(new QListItem($Customer->Id,$Customer->Id));
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
            if ($ReferenceObject == 'Customer') {
                $this->lstCustomer->RemoveAllItems();
                $allCustomer_list = Customer::LoadAll();
                foreach ($allCustomer_list as $Customer) {
                    $this->lstCustomer->AddItem(new QListItem($Customer->__get($ReferenceAttribute),$Customer->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'Customer') {
                $this->saveUsingLstCustomer = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtInvoiceNo->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->InvoiceNo)) {
            $this->txtInvoiceNo->Text = $Object->InvoiceNo;
        }
        
        if (!is_null($Object->CustomerObject)) {
            $this->lstCustomer->SelectedValue = $Object->CustomerObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'INVOICENO') {
            if (strlen($nameValue) > 0)
                $this->txtInvoiceNo->Name = $nameValue;
            $output = $withName ? $this->txtInvoiceNo->RenderWithName($blnPrintOutput):$this->txtInvoiceNo->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'CUSTOMER') {
            if (strlen($nameValue) > 0)
                $this->lstCustomer->Name = $nameValue;
            $output = $withName ? $this->lstCustomer->RenderWithName($blnPrintOutput):$this->lstCustomer->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('INVOICENO',$withName);
        $this->renderControl('CUSTOMER',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('InvoiceNo',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtInvoiceNo->Visible = false;
        $this->lstCustomer->Visible = false;
    }

    public function showAll() {
        $this->txtInvoiceNo->Visible = true;
        $this->lstCustomer->Visible = true;
    }

    public function refreshAll() {
        $this->txtInvoiceNo->Refresh();
        $this->lstCustomer->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'INVOICENO':
                $this->txtInvoiceNo->Text = $value;
                break;
            case 'CUSTOMER':
                $this->lstCustomer->SelectedValue = $value;
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
            case 'INVOICENO':
                if ($this->txtInvoiceNo->Text)
                    return $this->txtInvoiceNo->Text;
                break;
            case 'CUSTOMER':
                if ($this->lstCustomer->SelectedValue)
                    return $this->lstCustomer->SelectedValue;
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
            case 'INVOICENO':
                if ($this->txtInvoiceNo)
                    return $this->txtInvoiceNo->ControlId;
                break;
            case 'CUSTOMER':
                if ($this->lstCustomer)
                    return $this->lstCustomer->ControlId;
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
            case 'INVOICENO':
                $this->txtInvoiceNo->Visible = false;
                $this->txtInvoiceNo->Refresh();
                break;
            case 'CUSTOMER':
                $this->lstCustomer->Visible = false;
                $this->lstCustomer->Refresh();
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
            case 'INVOICENO':
                $this->txtInvoiceNo->Visible = true;
                $this->txtInvoiceNo->Refresh();
                break;
            case 'CUSTOMER':
                $this->lstCustomer->Visible = true;
                $this->lstCustomer->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtInvoiceNo->getJqControlId();
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

    public function applyValuesBeforeSaveObject($Customer = null)  {
        if (!$this->Object)
            $this->Object = new Invoice();
        
        $this->Object->InvoiceNo = $this->txtInvoiceNo->Text;
        if ($Customer) {
            $this->Object->CustomerObject = $Customer;
        }
        if ($this->saveUsingLstCustomer) {
            $linkedCustomer = Customer::Load($this->lstCustomer->SelectedValue);
            $this->Object->CustomerObject = $linkedCustomer;
        }
    }

    public function saveObject($validate = true,$Customer = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Customer);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtInvoiceNo);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtInvoiceNo->WrapperCssClass = 'form-group';
            $this->txtInvoiceNo->Placeholder = '';
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
            $previousValues = Invoice::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'InvoiceNo-> Value before: '.$previousValues->InvoiceNo.', Value after: '.$this->Object->InvoiceNo.'<br>
        ';
        } else {
        $changeText = 'InvoiceNo-> Value: '.$this->Object->InvoiceNo.'<br>
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
            $AuditLogEntry->ObjectName = 'Invoice';
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
                $AuditLogEntry->ObjectName = 'Invoice';
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