<?php
class ApiKeyController_Base {
    protected $Object;
    public $txtApiKey;
    public $lstStatus;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtApiKey = new QTextBox($objParentObject);
        $this->txtApiKey->Name = 'Api Key';

        $this->lstStatus = new QListBox($objParentObject);
        $this->lstStatus->Name = 'Status';
        $this->lstStatus->DisplayStyle = QDisplayStyle::Block;
        $this->lstStatus->AddCssClass('fullWidth');

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
        $this->txtApiKey->Text = '';
        $this->lstStatus->RemoveAllItems();
        $this->lstStatus->AddItem(new QListItem('Active','Active'));
        $this->lstStatus->AddItem(new QListItem('Blocked','Blocked'));
        

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->ApiKey)) {
            $this->txtApiKey->Text = $Object->ApiKey;
        }
        if ($Object->Status) {
            $this->lstStatus->SelectedValue = $Object->Status;
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'APIKEY') {
            if (strlen($nameValue) > 0)
                $this->txtApiKey->Name = $nameValue;
            $output = $withName ? $this->txtApiKey->RenderWithName($blnPrintOutput):$this->txtApiKey->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'STATUS') {
            if (strlen($nameValue) > 0)
                $this->lstStatus->Name = $nameValue;
            $output = $withName ? $this->lstStatus->RenderWithName($blnPrintOutput):$this->lstStatus->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('APIKEY',$withName);
        $this->renderControl('STATUS',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('ApiKey',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Status',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtApiKey->Visible = false;
        $this->lstStatus->Visible = false;
    }

    public function showAll() {
        $this->txtApiKey->Visible = true;
        $this->lstStatus->Visible = true;
    }

    public function refreshAll() {
        $this->txtApiKey->Refresh();
        $this->lstStatus->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'APIKEY':
                $this->txtApiKey->Text = $value;
                break;
            case 'STATUS':
                $this->lstStatus->SelectedValue = $value;
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
            case 'APIKEY':
                if ($this->txtApiKey->Text)
                    return $this->txtApiKey->Text;
                break;
            case 'STATUS':
                if ($this->lstStatus->SelectedValue)
                    return $this->lstStatus->SelectedValue;
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
            case 'APIKEY':
                if ($this->txtApiKey)
                    return $this->txtApiKey->ControlId;
                break;
            case 'STATUS':
                if ($this->lstStatus)
                    return $this->lstStatus->ControlId;
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
            case 'APIKEY':
                $this->txtApiKey->Visible = false;
                $this->txtApiKey->Refresh();
                break;
            case 'STATUS':
                $this->lstStatus->Visible = false;
                $this->lstStatus->Refresh();
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
            case 'APIKEY':
                $this->txtApiKey->Visible = true;
                $this->txtApiKey->Refresh();
                break;
            case 'STATUS':
                $this->lstStatus->Visible = true;
                $this->lstStatus->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtApiKey->getJqControlId();
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
            $this->Object = new ApiKey();
        
        $this->Object->ApiKey = $this->txtApiKey->Text;
        $this->Object->Status = $this->lstStatus->SelectedValue;
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtApiKey);
        // Example of validating a field as required
        //AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(''.$this->txtUsername->getJqControlId().'')');
        /*if (!$this->lstStatus->SelectedValue){
            AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(''.$this->txtUsername->getJqControlId().'','Required')');
            $hasNoErrors = false;
        }*/
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtApiKey->WrapperCssClass = 'form-group';
            $this->txtApiKey->Placeholder = '';
            $this->lstStatus->WrapperCssClass = 'form-group';
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
            $previousValues = ApiKey::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'ApiKey-> Value before: '.$previousValues->ApiKey.', Value after: '.$this->Object->ApiKey.'<br>
        Status-> Value before: '.$previousValues->Status.', Value after: '.$this->Object->Status.'<br>
        ';
        } else {
        $changeText = 'ApiKey-> Value: '.$this->Object->ApiKey.'<br>
        Status-> Value: '.$this->Object->Status.'<br>
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
            $AuditLogEntry->ObjectName = 'ApiKey';
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
                $AuditLogEntry->ObjectName = 'ApiKey';
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