<?php
class CourseController_Base {
    protected $Object;
    public $txtName;
    public $txtPrice;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtName = new QTextBox($objParentObject);
        $this->txtName->Name = 'Name';

        $this->txtPrice = new QTextBox($objParentObject);
        $this->txtPrice->Name = 'Price';

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
        $this->txtPrice->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->Name)) {
            $this->txtName->Text = $Object->Name;
        }
        if (!is_null($Object->Price)) {
            $this->txtPrice->Text = $Object->Price;
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
        if (strtoupper($strControl) == 'PRICE') {
            if (strlen($nameValue) > 0)
                $this->txtPrice->Name = $nameValue;
            $output = $withName ? $this->txtPrice->RenderWithName($blnPrintOutput):$this->txtPrice->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('NAME',$withName);
        $this->renderControl('PRICE',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('Name',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Price',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtName->Visible = false;
        $this->txtPrice->Visible = false;
    }

    public function showAll() {
        $this->txtName->Visible = true;
        $this->txtPrice->Visible = true;
    }

    public function refreshAll() {
        $this->txtName->Refresh();
        $this->txtPrice->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'NAME':
                $this->txtName->Text = $value;
                break;
            case 'PRICE':
                $this->txtPrice->Text = $value;
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
            case 'PRICE':
                if ($this->txtPrice->Text)
                    return $this->txtPrice->Text;
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
            case 'PRICE':
                if ($this->txtPrice)
                    return $this->txtPrice->ControlId;
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
            case 'PRICE':
                $this->txtPrice->Visible = false;
                $this->txtPrice->Refresh();
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
            case 'PRICE':
                $this->txtPrice->Visible = true;
                $this->txtPrice->Refresh();
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
            $this->Object = new Course();
        
        $this->Object->Name = $this->txtName->Text;
        $this->Object->Price = $this->txtPrice->Text;
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPrice);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtName->WrapperCssClass = 'form-group';
            $this->txtName->Placeholder = '';
            $this->txtPrice->WrapperCssClass = 'form-group';
            $this->txtPrice->Placeholder = '';
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
            $previousValues = Course::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'Name-> Value before: '.$previousValues->Name.', Value after: '.$this->Object->Name.'<br>
        Price-> Value before: '.$previousValues->Price.', Value after: '.$this->Object->Price.'<br>
        ';
        } else {
        $changeText = 'Name-> Value: '.$this->Object->Name.'<br>
        Price-> Value: '.$this->Object->Price.'<br>
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
            $AuditLogEntry->ObjectName = 'Course';
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
                $AuditLogEntry->ObjectName = 'Course';
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