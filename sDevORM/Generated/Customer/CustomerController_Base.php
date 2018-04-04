<?php
class CustomerController_Base {
    protected $Object;
    public $txtName;
    public $txtPhoneNumber;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtName = new QTextBox($objParentObject);
        $this->txtName->Name = 'Name';

        $this->txtPhoneNumber = new QTextBox($objParentObject);
        $this->txtPhoneNumber->Name = 'Phone Number';

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
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
        }
    }

    public function setValues($Object) {
        $this->txtName->Text = '';
        $this->txtPhoneNumber->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->Name)) {
            $this->txtName->Text = $Object->Name;
        }
        if (!is_null($Object->PhoneNumber)) {
            $this->txtPhoneNumber->Text = $Object->PhoneNumber;
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'NAME') {
            if (strlen($nameValue) > 0)
                $this->txtName->Name = $nameValue;
            $output = $withName ? $this->txtName->RenderWithName($blnPrintOutput):$this->txtName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PHONENUMBER') {
            if (strlen($nameValue) > 0)
                $this->txtPhoneNumber->Name = $nameValue;
            $output = $withName ? $this->txtPhoneNumber->RenderWithName($blnPrintOutput):$this->txtPhoneNumber->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('NAME',$withName);
        $this->renderControl('PHONENUMBER',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('Name',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('PhoneNumber',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtName->Visible = false;
        $this->txtPhoneNumber->Visible = false;
    }

    public function showAll() {
        $this->txtName->Visible = true;
        $this->txtPhoneNumber->Visible = true;
    }

    public function refreshAll() {
        $this->txtName->Refresh();
        $this->txtPhoneNumber->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'NAME':
                $this->txtName->Text = $value;
                break;
            case 'PHONENUMBER':
                $this->txtPhoneNumber->Text = $value;
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
            case 'NAME':
                if ($this->txtName->Text)
                    return $this->txtName->Text;
                break;
            case 'PHONENUMBER':
                if ($this->txtPhoneNumber->Text)
                    return $this->txtPhoneNumber->Text;
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
            case 'NAME':
                if ($this->txtName)
                    return $this->txtName->ControlId;
                break;
            case 'PHONENUMBER':
                if ($this->txtPhoneNumber)
                    return $this->txtPhoneNumber->ControlId;
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
            case 'NAME':
                $this->txtName->Visible = false;
                $this->txtName->Refresh();
                break;
            case 'PHONENUMBER':
                $this->txtPhoneNumber->Visible = false;
                $this->txtPhoneNumber->Refresh();
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
            case 'NAME':
                $this->txtName->Visible = true;
                $this->txtName->Refresh();
                break;
            case 'PHONENUMBER':
                $this->txtPhoneNumber->Visible = true;
                $this->txtPhoneNumber->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtName->getJqControlId();
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

    public function applyValuesBeforeSaveObject()  {
        if (!$this->Object)
            $this->Object = new Customer();
        
        $this->Object->Name = $this->txtName->Text;
        $this->Object->PhoneNumber = $this->txtPhoneNumber->Text;
    }

    public function saveObject($validate = true)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject();
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPhoneNumber);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtName->WrapperCssClass = 'form-group';
            $this->txtName->Placeholder = '';
            $this->txtPhoneNumber->WrapperCssClass = 'form-group';
            $this->txtPhoneNumber->Placeholder = '';
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
            $previousValues = Customer::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'Name-> Value before: '.$previousValues->Name.', Value after: '.$this->Object->Name.'<br>
        PhoneNumber-> Value before: '.$previousValues->PhoneNumber.', Value after: '.$this->Object->PhoneNumber.'<br>
        ';
        } else {
        $changeText = 'Name-> Value: '.$this->Object->Name.'<br>
        PhoneNumber-> Value: '.$this->Object->PhoneNumber.'<br>
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
            $AuditLogEntry->ObjectName = 'Customer';
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
                $AuditLogEntry->ObjectName = 'Customer';
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