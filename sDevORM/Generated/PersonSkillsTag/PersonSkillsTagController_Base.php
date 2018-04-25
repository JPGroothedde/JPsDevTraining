<?php
class PersonSkillsTagController_Base {
    protected $Object;
    public $txtSkillTag;
    public $lstPerson,$saveUsingLstPerson = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtSkillTag = new QTextBox($objParentObject);
        $this->txtSkillTag->Name = 'Skill Tag';

        $this->lstPerson = new QListBox($objParentObject);
        $this->lstPerson->Name = 'Person';
        $this->lstPerson->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allPerson = Person::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allPerson as $Person) {
            $this->lstPerson->AddItem(new QListItem($Person->Id,$Person->Id));
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
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'Person') {
                $this->saveUsingLstPerson = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtSkillTag->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->SkillTag)) {
            $this->txtSkillTag->Text = $Object->SkillTag;
        }
        
        if (!is_null($Object->PersonObject)) {
            $this->lstPerson->SelectedValue = $Object->PersonObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'SKILLTAG') {
            if (strlen($nameValue) > 0)
                $this->txtSkillTag->Name = $nameValue;
            $output = $withName ? $this->txtSkillTag->RenderWithName($blnPrintOutput):$this->txtSkillTag->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PERSON') {
            if (strlen($nameValue) > 0)
                $this->lstPerson->Name = $nameValue;
            $output = $withName ? $this->lstPerson->RenderWithName($blnPrintOutput):$this->lstPerson->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('SKILLTAG',$withName);
        $this->renderControl('PERSON',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('SkillTag',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtSkillTag->Visible = false;
        $this->lstPerson->Visible = false;
    }

    public function showAll() {
        $this->txtSkillTag->Visible = true;
        $this->lstPerson->Visible = true;
    }

    public function refreshAll() {
        $this->txtSkillTag->Refresh();
        $this->lstPerson->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'SKILLTAG':
                $this->txtSkillTag->Text = $value;
                break;
            case 'PERSON':
                $this->lstPerson->SelectedValue = $value;
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
            case 'SKILLTAG':
                if ($this->txtSkillTag->Text)
                    return $this->txtSkillTag->Text;
                break;
            case 'PERSON':
                if ($this->lstPerson->SelectedValue)
                    return $this->lstPerson->SelectedValue;
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
            case 'SKILLTAG':
                if ($this->txtSkillTag)
                    return $this->txtSkillTag->ControlId;
                break;
            case 'PERSON':
                if ($this->lstPerson)
                    return $this->lstPerson->ControlId;
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
            case 'SKILLTAG':
                $this->txtSkillTag->Visible = false;
                $this->txtSkillTag->Refresh();
                break;
            case 'PERSON':
                $this->lstPerson->Visible = false;
                $this->lstPerson->Refresh();
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
            case 'SKILLTAG':
                $this->txtSkillTag->Visible = true;
                $this->txtSkillTag->Refresh();
                break;
            case 'PERSON':
                $this->lstPerson->Visible = true;
                $this->lstPerson->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtSkillTag->getJqControlId();
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

    public function applyValuesBeforeSaveObject($Person = null)  {
        if (!$this->Object)
            $this->Object = new PersonSkillsTag();
        
        $this->Object->SkillTag = $this->txtSkillTag->Text;
        if ($Person) {
            $this->Object->PersonObject = $Person;
        }
        if ($this->saveUsingLstPerson) {
            $linkedPerson = Person::Load($this->lstPerson->SelectedValue);
            $this->Object->PersonObject = $linkedPerson;
        }
    }

    public function saveObject($validate = true,$Person = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Person);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtSkillTag);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtSkillTag->WrapperCssClass = 'form-group';
            $this->txtSkillTag->Placeholder = '';
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
            $previousValues = PersonSkillsTag::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'SkillTag-> Value before: '.$previousValues->SkillTag.', Value after: '.$this->Object->SkillTag.'<br>
        ';
        } else {
        $changeText = 'SkillTag-> Value: '.$this->Object->SkillTag.'<br>
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
            $AuditLogEntry->ObjectName = 'PersonSkillsTag';
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
                $AuditLogEntry->ObjectName = 'PersonSkillsTag';
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