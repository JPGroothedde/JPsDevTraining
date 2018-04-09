<?php
class StudentController_Base {
    protected $Object;
    public $txtFirstName;
    public $txtLastName;
    public $txtEmailAddress;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtFirstName = new QTextBox($objParentObject);
        $this->txtFirstName->Name = 'First Name';

        $this->txtLastName = new QTextBox($objParentObject);
        $this->txtLastName->Name = 'Last Name';

        $this->txtEmailAddress = new QTextBox($objParentObject);
        $this->txtEmailAddress->Name = 'Email Address';

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
        $this->txtFirstName->Text = '';
        $this->txtLastName->Text = '';
        $this->txtEmailAddress->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->FirstName)) {
            $this->txtFirstName->Text = $Object->FirstName;
        }
        if (!is_null($Object->LastName)) {
            $this->txtLastName->Text = $Object->LastName;
        }
        if (!is_null($Object->EmailAddress)) {
            $this->txtEmailAddress->Text = $Object->EmailAddress;
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'FIRSTNAME') {
            if (strlen($nameValue) > 0)
                $this->txtFirstName->Name = $nameValue;
            $output = $withName ? $this->txtFirstName->RenderWithName($blnPrintOutput):$this->txtFirstName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'LASTNAME') {
            if (strlen($nameValue) > 0)
                $this->txtLastName->Name = $nameValue;
            $output = $withName ? $this->txtLastName->RenderWithName($blnPrintOutput):$this->txtLastName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'EMAILADDRESS') {
            if (strlen($nameValue) > 0)
                $this->txtEmailAddress->Name = $nameValue;
            $output = $withName ? $this->txtEmailAddress->RenderWithName($blnPrintOutput):$this->txtEmailAddress->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('FIRSTNAME',$withName);
        $this->renderControl('LASTNAME',$withName);
        $this->renderControl('EMAILADDRESS',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('FirstName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('LastName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('EmailAddress',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtFirstName->Visible = false;
        $this->txtLastName->Visible = false;
        $this->txtEmailAddress->Visible = false;
    }

    public function showAll() {
        $this->txtFirstName->Visible = true;
        $this->txtLastName->Visible = true;
        $this->txtEmailAddress->Visible = true;
    }

    public function refreshAll() {
        $this->txtFirstName->Refresh();
        $this->txtLastName->Refresh();
        $this->txtEmailAddress->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'FIRSTNAME':
                $this->txtFirstName->Text = $value;
                break;
            case 'LASTNAME':
                $this->txtLastName->Text = $value;
                break;
            case 'EMAILADDRESS':
                $this->txtEmailAddress->Text = $value;
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
            case 'FIRSTNAME':
                if ($this->txtFirstName->Text)
                    return $this->txtFirstName->Text;
                break;
            case 'LASTNAME':
                if ($this->txtLastName->Text)
                    return $this->txtLastName->Text;
                break;
            case 'EMAILADDRESS':
                if ($this->txtEmailAddress->Text)
                    return $this->txtEmailAddress->Text;
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
            case 'FIRSTNAME':
                if ($this->txtFirstName)
                    return $this->txtFirstName->ControlId;
                break;
            case 'LASTNAME':
                if ($this->txtLastName)
                    return $this->txtLastName->ControlId;
                break;
            case 'EMAILADDRESS':
                if ($this->txtEmailAddress)
                    return $this->txtEmailAddress->ControlId;
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
            case 'FIRSTNAME':
                $this->txtFirstName->Visible = false;
                $this->txtFirstName->Refresh();
                break;
            case 'LASTNAME':
                $this->txtLastName->Visible = false;
                $this->txtLastName->Refresh();
                break;
            case 'EMAILADDRESS':
                $this->txtEmailAddress->Visible = false;
                $this->txtEmailAddress->Refresh();
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
            case 'FIRSTNAME':
                $this->txtFirstName->Visible = true;
                $this->txtFirstName->Refresh();
                break;
            case 'LASTNAME':
                $this->txtLastName->Visible = true;
                $this->txtLastName->Refresh();
                break;
            case 'EMAILADDRESS':
                $this->txtEmailAddress->Visible = true;
                $this->txtEmailAddress->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtFirstName->getJqControlId();
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
            $this->Object = new Student();
        
        $this->Object->FirstName = $this->txtFirstName->Text;
        $this->Object->LastName = $this->txtLastName->Text;
        $this->Object->EmailAddress = $this->txtEmailAddress->Text;
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtFirstName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtLastName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtEmailAddress);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtFirstName->WrapperCssClass = 'form-group';
            $this->txtFirstName->Placeholder = '';
            $this->txtLastName->WrapperCssClass = 'form-group';
            $this->txtLastName->Placeholder = '';
            $this->txtEmailAddress->WrapperCssClass = 'form-group';
            $this->txtEmailAddress->Placeholder = '';
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
            $previousValues = Student::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'FirstName-> Value before: '.$previousValues->FirstName.', Value after: '.$this->Object->FirstName.'<br>
        LastName-> Value before: '.$previousValues->LastName.', Value after: '.$this->Object->LastName.'<br>
        EmailAddress-> Value before: '.$previousValues->EmailAddress.', Value after: '.$this->Object->EmailAddress.'<br>
        ';
        } else {
        $changeText = 'FirstName-> Value: '.$this->Object->FirstName.'<br>
        LastName-> Value: '.$this->Object->LastName.'<br>
        EmailAddress-> Value: '.$this->Object->EmailAddress.'<br>
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
            $AuditLogEntry->ObjectName = 'Student';
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
                $AuditLogEntry->ObjectName = 'Student';
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