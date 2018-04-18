<?php
class PersonLanguageController_Base {
    protected $Object;
    public $txtLanguage;
    public $lstPerson,$saveUsingLstPerson = false;
    public $lstMasterLanguage,$saveUsingLstMasterLanguage = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtLanguage = new QTextBox($objParentObject);
        $this->txtLanguage->Name = 'Language';

        $this->lstPerson = new QListBox($objParentObject);
        $this->lstPerson->Name = 'Person';
        $this->lstPerson->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allPerson = Person::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allPerson as $Person) {
            $this->lstPerson->AddItem(new QListItem($Person->Id,$Person->Id));
        }

        $this->lstMasterLanguage = new QListBox($objParentObject);
        $this->lstMasterLanguage->Name = 'Master Language';
        $this->lstMasterLanguage->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allMasterLanguage = MasterLanguage::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allMasterLanguage as $MasterLanguage) {
            $this->lstMasterLanguage->AddItem(new QListItem($MasterLanguage->Id,$MasterLanguage->Id));
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
            if ($ReferenceObject == 'Person') {
                $this->lstPerson->RemoveAllItems();
                $allPerson_list = Person::LoadAll();
                foreach ($allPerson_list as $Person) {
                    $this->lstPerson->AddItem(new QListItem($Person->__get($ReferenceAttribute),$Person->Id));
                }
            }
            if ($ReferenceObject == 'MasterLanguage') {
                $this->lstMasterLanguage->RemoveAllItems();
                $allMasterLanguage_list = MasterLanguage::LoadAll();
                foreach ($allMasterLanguage_list as $MasterLanguage) {
                    $this->lstMasterLanguage->AddItem(new QListItem($MasterLanguage->__get($ReferenceAttribute),$MasterLanguage->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'Person') {
                $this->saveUsingLstPerson = $useListValue;
            }
            if ($ReferenceObject == 'MasterLanguage') {
                $this->saveUsingLstMasterLanguage = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtLanguage->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->Language)) {
            $this->txtLanguage->Text = $Object->Language;
        }
        
        if (!is_null($Object->PersonObject)) {
            $this->lstPerson->SelectedValue = $Object->PersonObject->Id;
        }
        if (!is_null($Object->MasterLanguageObject)) {
            $this->lstMasterLanguage->SelectedValue = $Object->MasterLanguageObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'LANGUAGE') {
            if (strlen($nameValue) > 0)
                $this->txtLanguage->Name = $nameValue;
            $output = $withName ? $this->txtLanguage->RenderWithName($blnPrintOutput):$this->txtLanguage->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PERSON') {
            if (strlen($nameValue) > 0)
                $this->lstPerson->Name = $nameValue;
            $output = $withName ? $this->lstPerson->RenderWithName($blnPrintOutput):$this->lstPerson->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'MASTERLANGUAGE') {
            if (strlen($nameValue) > 0)
                $this->lstMasterLanguage->Name = $nameValue;
            $output = $withName ? $this->lstMasterLanguage->RenderWithName($blnPrintOutput):$this->lstMasterLanguage->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('LANGUAGE',$withName);
        $this->renderControl('PERSON',$withName);
        $this->renderControl('MASTERLANGUAGE',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('Language',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtLanguage->Visible = false;
        $this->lstPerson->Visible = false;
        $this->lstMasterLanguage->Visible = false;
    }

    public function showAll() {
        $this->txtLanguage->Visible = true;
        $this->lstPerson->Visible = true;
        $this->lstMasterLanguage->Visible = true;
    }

    public function refreshAll() {
        $this->txtLanguage->Refresh();
        $this->lstPerson->Refresh();
        $this->lstMasterLanguage->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'LANGUAGE':
                $this->txtLanguage->Text = $value;
                break;
            case 'PERSON':
                $this->lstPerson->SelectedValue = $value;
                break;
            case 'MASTERLANGUAGE':
                $this->lstMasterLanguage->SelectedValue = $value;
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
            case 'LANGUAGE':
                if ($this->txtLanguage->Text)
                    return $this->txtLanguage->Text;
                break;
            case 'PERSON':
                if ($this->lstPerson->SelectedValue)
                    return $this->lstPerson->SelectedValue;
                break;
            case 'MASTERLANGUAGE':
                if ($this->lstMasterLanguage->SelectedValue)
                    return $this->lstMasterLanguage->SelectedValue;
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
            case 'LANGUAGE':
                if ($this->txtLanguage)
                    return $this->txtLanguage->ControlId;
                break;
            case 'PERSON':
                if ($this->lstPerson)
                    return $this->lstPerson->ControlId;
                break;
            case 'MASTERLANGUAGE':
                if ($this->lstMasterLanguage)
                    return $this->lstMasterLanguage->ControlId;
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
            case 'LANGUAGE':
                $this->txtLanguage->Visible = false;
                $this->txtLanguage->Refresh();
                break;
            case 'PERSON':
                $this->lstPerson->Visible = false;
                $this->lstPerson->Refresh();
                break;
            case 'MASTERLANGUAGE':
                $this->lstMasterLanguage->Visible = false;
                $this->lstMasterLanguage->Refresh();
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
            case 'LANGUAGE':
                $this->txtLanguage->Visible = true;
                $this->txtLanguage->Refresh();
                break;
            case 'PERSON':
                $this->lstPerson->Visible = true;
                $this->lstPerson->Refresh();
                break;
            case 'MASTERLANGUAGE':
                $this->lstMasterLanguage->Visible = true;
                $this->lstMasterLanguage->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtLanguage->getJqControlId();
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

    public function applyValuesBeforeSaveObject($Person = null,$MasterLanguage = null)  {
        if (!$this->Object)
            $this->Object = new PersonLanguage();
        
        $this->Object->Language = $this->txtLanguage->Text;
        if ($Person) {
            $this->Object->PersonObject = $Person;
        }
        if ($this->saveUsingLstPerson) {
            $linkedPerson = Person::Load($this->lstPerson->SelectedValue);
            $this->Object->PersonObject = $linkedPerson;
        }
        if ($MasterLanguage) {
            $this->Object->MasterLanguageObject = $MasterLanguage;
        }
        if ($this->saveUsingLstMasterLanguage) {
            $linkedMasterLanguage = MasterLanguage::Load($this->lstMasterLanguage->SelectedValue);
            $this->Object->MasterLanguageObject = $linkedMasterLanguage;
        }
    }

    public function saveObject($validate = true,$Person = null,$MasterLanguage = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Person,$MasterLanguage);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtLanguage);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtLanguage->WrapperCssClass = 'form-group';
            $this->txtLanguage->Placeholder = '';
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
            $previousValues = PersonLanguage::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'Language-> Value before: '.$previousValues->Language.', Value after: '.$this->Object->Language.'<br>
        ';
        } else {
        $changeText = 'Language-> Value: '.$this->Object->Language.'<br>
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
            $AuditLogEntry->ObjectName = 'PersonLanguage';
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
                $AuditLogEntry->ObjectName = 'PersonLanguage';
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