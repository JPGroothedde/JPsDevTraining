<?php
class ApiEntityController_Base {
    protected $Object;
    public $lstEntityName;
    public $lstApiKey,$saveUsingLstApiKey = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->lstEntityName = new QListBox($objParentObject);
        $this->lstEntityName->Name = 'Entity Name';
        $this->lstEntityName->DisplayStyle = QDisplayStyle::Block;
        $this->lstEntityName->AddCssClass('fullWidth');

        $this->lstApiKey = new QListBox($objParentObject);
        $this->lstApiKey->Name = 'Api Key';
        $this->lstApiKey->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allApiKey = ApiKey::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allApiKey as $ApiKey) {
            $this->lstApiKey->AddItem(new QListItem($ApiKey->Id,$ApiKey->Id));
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
            if ($ReferenceObject == 'ApiKey') {
                $this->lstApiKey->RemoveAllItems();
                $allApiKey_list = ApiKey::LoadAll();
                foreach ($allApiKey_list as $ApiKey) {
                    $this->lstApiKey->AddItem(new QListItem($ApiKey->__get($ReferenceAttribute),$ApiKey->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'ApiKey') {
                $this->saveUsingLstApiKey = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->lstEntityName->RemoveAllItems();
        $this->lstEntityName->AddItem(new QListItem('PlaceHolder','PlaceHolder'));
        $this->lstEntityName->AddItem(new QListItem('Account','Account'));
        $this->lstEntityName->AddItem(new QListItem('UserRole','UserRole'));
        

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->EntityName) {
            $this->lstEntityName->SelectedValue = $Object->EntityName;
        }
        
        if (!is_null($Object->ApiKeyObject)) {
            $this->lstApiKey->SelectedValue = $Object->ApiKeyObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'ENTITYNAME') {
            if (strlen($nameValue) > 0)
                $this->lstEntityName->Name = $nameValue;
            $output = $withName ? $this->lstEntityName->RenderWithName($blnPrintOutput):$this->lstEntityName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'APIKEY') {
            if (strlen($nameValue) > 0)
                $this->lstApiKey->Name = $nameValue;
            $output = $withName ? $this->lstApiKey->RenderWithName($blnPrintOutput):$this->lstApiKey->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('ENTITYNAME',$withName);
        $this->renderControl('APIKEY',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('EntityName',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->lstEntityName->Visible = false;
        $this->lstApiKey->Visible = false;
    }

    public function showAll() {
        $this->lstEntityName->Visible = true;
        $this->lstApiKey->Visible = true;
    }

    public function refreshAll() {
        $this->lstEntityName->Refresh();
        $this->lstApiKey->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'ENTITYNAME':
                $this->lstEntityName->SelectedValue = $value;
                break;
            case 'APIKEY':
                $this->lstApiKey->SelectedValue = $value;
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
            case 'ENTITYNAME':
                if ($this->lstEntityName->SelectedValue)
                    return $this->lstEntityName->SelectedValue;
                break;
            case 'APIKEY':
                if ($this->lstApiKey->SelectedValue)
                    return $this->lstApiKey->SelectedValue;
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
            case 'ENTITYNAME':
                if ($this->lstEntityName)
                    return $this->lstEntityName->ControlId;
                break;
            case 'APIKEY':
                if ($this->lstApiKey)
                    return $this->lstApiKey->ControlId;
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
            case 'ENTITYNAME':
                $this->lstEntityName->Visible = false;
                $this->lstEntityName->Refresh();
                break;
            case 'APIKEY':
                $this->lstApiKey->Visible = false;
                $this->lstApiKey->Refresh();
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
            case 'ENTITYNAME':
                $this->lstEntityName->Visible = true;
                $this->lstEntityName->Refresh();
                break;
            case 'APIKEY':
                $this->lstApiKey->Visible = true;
                $this->lstApiKey->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->lstEntityName->getJqControlId();
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

    public function applyValuesBeforeSaveObject($ApiKey = null)  {
        if (!$this->Object)
            $this->Object = new ApiEntity();
        
        $this->Object->EntityName = $this->lstEntityName->SelectedValue;
        if ($ApiKey) {
            $this->Object->ApiKeyObject = $ApiKey;
        }
        if ($this->saveUsingLstApiKey) {
            $linkedApiKey = ApiKey::Load($this->lstApiKey->SelectedValue);
            $this->Object->ApiKeyObject = $linkedApiKey;
        }
    }

    public function saveObject($validate = true,$ApiKey = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($ApiKey);
        
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
        //AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(''.$this->txtUsername->getJqControlId().'')');
        /*if (!$this->lstEntityName->SelectedValue){
            AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(''.$this->txtUsername->getJqControlId().'','Required')');
            $hasNoErrors = false;
        }*/
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->lstEntityName->WrapperCssClass = 'form-group';
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
            $previousValues = ApiEntity::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'EntityName-> Value before: '.$previousValues->EntityName.', Value after: '.$this->Object->EntityName.'<br>
        ';
        } else {
        $changeText = 'EntityName-> Value: '.$this->Object->EntityName.'<br>
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
            $AuditLogEntry->ObjectName = 'ApiEntity';
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
                $AuditLogEntry->ObjectName = 'ApiEntity';
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