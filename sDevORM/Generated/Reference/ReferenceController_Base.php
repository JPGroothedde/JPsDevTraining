<?php
class ReferenceController_Base {
    protected $Object;
    public $txtFirstName;
    public $txtSurname;
    public $txtRelationship;
    public $txtTelephoneNumber;
    public $lstPerson,$saveUsingLstPerson = false;
    public $lstFileDocument,$saveUsingLstFileDocument = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtFirstName = new QTextBox($objParentObject);
        $this->txtFirstName->Name = 'First Name';

        $this->txtSurname = new QTextBox($objParentObject);
        $this->txtSurname->Name = 'Surname';

        $this->txtRelationship = new QTextBox($objParentObject);
        $this->txtRelationship->Name = 'Relationship';

        $this->txtTelephoneNumber = new QTextBox($objParentObject);
        $this->txtTelephoneNumber->Name = 'Telephone Number';

        $this->lstPerson = new QListBox($objParentObject);
        $this->lstPerson->Name = 'Person';
        $this->lstPerson->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allPerson = Person::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allPerson as $Person) {
            $this->lstPerson->AddItem(new QListItem($Person->Id,$Person->Id));
        }

        $this->lstFileDocument = new QListBox($objParentObject);
        $this->lstFileDocument->Name = 'File Document';
        $this->lstFileDocument->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allFileDocument = FileDocument::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allFileDocument as $FileDocument) {
            $this->lstFileDocument->AddItem(new QListItem($FileDocument->Id,$FileDocument->Id));
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
            if ($ReferenceObject == 'FileDocument') {
                $this->lstFileDocument->RemoveAllItems();
                $allFileDocument_list = FileDocument::LoadAll();
                foreach ($allFileDocument_list as $FileDocument) {
                    $this->lstFileDocument->AddItem(new QListItem($FileDocument->__get($ReferenceAttribute),$FileDocument->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'Person') {
                $this->saveUsingLstPerson = $useListValue;
            }
            if ($ReferenceObject == 'FileDocument') {
                $this->saveUsingLstFileDocument = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtFirstName->Text = '';
        $this->txtSurname->Text = '';
        $this->txtRelationship->Text = '';
        $this->txtTelephoneNumber->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->FirstName)) {
            $this->txtFirstName->Text = $Object->FirstName;
        }
        if (!is_null($Object->Surname)) {
            $this->txtSurname->Text = $Object->Surname;
        }
        if (!is_null($Object->Relationship)) {
            $this->txtRelationship->Text = $Object->Relationship;
        }
        if (!is_null($Object->TelephoneNumber)) {
            $this->txtTelephoneNumber->Text = $Object->TelephoneNumber;
        }
        
        if (!is_null($Object->PersonObject)) {
            $this->lstPerson->SelectedValue = $Object->PersonObject->Id;
        }
        if (!is_null($Object->FileDocumentObject)) {
            $this->lstFileDocument->SelectedValue = $Object->FileDocumentObject->Id;
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
        if (strtoupper($strControl) == 'SURNAME') {
            if (strlen($nameValue) > 0)
                $this->txtSurname->Name = $nameValue;
            $output = $withName ? $this->txtSurname->RenderWithName($blnPrintOutput):$this->txtSurname->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'RELATIONSHIP') {
            if (strlen($nameValue) > 0)
                $this->txtRelationship->Name = $nameValue;
            $output = $withName ? $this->txtRelationship->RenderWithName($blnPrintOutput):$this->txtRelationship->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'TELEPHONENUMBER') {
            if (strlen($nameValue) > 0)
                $this->txtTelephoneNumber->Name = $nameValue;
            $output = $withName ? $this->txtTelephoneNumber->RenderWithName($blnPrintOutput):$this->txtTelephoneNumber->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PERSON') {
            if (strlen($nameValue) > 0)
                $this->lstPerson->Name = $nameValue;
            $output = $withName ? $this->lstPerson->RenderWithName($blnPrintOutput):$this->lstPerson->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'FILEDOCUMENT') {
            if (strlen($nameValue) > 0)
                $this->lstFileDocument->Name = $nameValue;
            $output = $withName ? $this->lstFileDocument->RenderWithName($blnPrintOutput):$this->lstFileDocument->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('FIRSTNAME',$withName);
        $this->renderControl('SURNAME',$withName);
        $this->renderControl('RELATIONSHIP',$withName);
        $this->renderControl('TELEPHONENUMBER',$withName);
        $this->renderControl('PERSON',$withName);
        $this->renderControl('FILEDOCUMENT',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('FirstName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Surname',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Relationship',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('TelephoneNumber',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtFirstName->Visible = false;
        $this->txtSurname->Visible = false;
        $this->txtRelationship->Visible = false;
        $this->txtTelephoneNumber->Visible = false;
        $this->lstPerson->Visible = false;
        $this->lstFileDocument->Visible = false;
    }

    public function showAll() {
        $this->txtFirstName->Visible = true;
        $this->txtSurname->Visible = true;
        $this->txtRelationship->Visible = true;
        $this->txtTelephoneNumber->Visible = true;
        $this->lstPerson->Visible = true;
        $this->lstFileDocument->Visible = true;
    }

    public function refreshAll() {
        $this->txtFirstName->Refresh();
        $this->txtSurname->Refresh();
        $this->txtRelationship->Refresh();
        $this->txtTelephoneNumber->Refresh();
        $this->lstPerson->Refresh();
        $this->lstFileDocument->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'FIRSTNAME':
                $this->txtFirstName->Text = $value;
                break;
            case 'SURNAME':
                $this->txtSurname->Text = $value;
                break;
            case 'RELATIONSHIP':
                $this->txtRelationship->Text = $value;
                break;
            case 'TELEPHONENUMBER':
                $this->txtTelephoneNumber->Text = $value;
                break;
            case 'PERSON':
                $this->lstPerson->SelectedValue = $value;
                break;
            case 'FILEDOCUMENT':
                $this->lstFileDocument->SelectedValue = $value;
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
            case 'SURNAME':
                if ($this->txtSurname->Text)
                    return $this->txtSurname->Text;
                break;
            case 'RELATIONSHIP':
                if ($this->txtRelationship->Text)
                    return $this->txtRelationship->Text;
                break;
            case 'TELEPHONENUMBER':
                if ($this->txtTelephoneNumber->Text)
                    return $this->txtTelephoneNumber->Text;
                break;
            case 'PERSON':
                if ($this->lstPerson->SelectedValue)
                    return $this->lstPerson->SelectedValue;
                break;
            case 'FILEDOCUMENT':
                if ($this->lstFileDocument->SelectedValue)
                    return $this->lstFileDocument->SelectedValue;
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
            case 'SURNAME':
                if ($this->txtSurname)
                    return $this->txtSurname->ControlId;
                break;
            case 'RELATIONSHIP':
                if ($this->txtRelationship)
                    return $this->txtRelationship->ControlId;
                break;
            case 'TELEPHONENUMBER':
                if ($this->txtTelephoneNumber)
                    return $this->txtTelephoneNumber->ControlId;
                break;
            case 'PERSON':
                if ($this->lstPerson)
                    return $this->lstPerson->ControlId;
                break;
            case 'FILEDOCUMENT':
                if ($this->lstFileDocument)
                    return $this->lstFileDocument->ControlId;
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
            case 'SURNAME':
                $this->txtSurname->Visible = false;
                $this->txtSurname->Refresh();
                break;
            case 'RELATIONSHIP':
                $this->txtRelationship->Visible = false;
                $this->txtRelationship->Refresh();
                break;
            case 'TELEPHONENUMBER':
                $this->txtTelephoneNumber->Visible = false;
                $this->txtTelephoneNumber->Refresh();
                break;
            case 'PERSON':
                $this->lstPerson->Visible = false;
                $this->lstPerson->Refresh();
                break;
            case 'FILEDOCUMENT':
                $this->lstFileDocument->Visible = false;
                $this->lstFileDocument->Refresh();
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
            case 'SURNAME':
                $this->txtSurname->Visible = true;
                $this->txtSurname->Refresh();
                break;
            case 'RELATIONSHIP':
                $this->txtRelationship->Visible = true;
                $this->txtRelationship->Refresh();
                break;
            case 'TELEPHONENUMBER':
                $this->txtTelephoneNumber->Visible = true;
                $this->txtTelephoneNumber->Refresh();
                break;
            case 'PERSON':
                $this->lstPerson->Visible = true;
                $this->lstPerson->Refresh();
                break;
            case 'FILEDOCUMENT':
                $this->lstFileDocument->Visible = true;
                $this->lstFileDocument->Refresh();
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

    public function applyValuesBeforeSaveObject($Person = null,$FileDocument = null)  {
        if (!$this->Object)
            $this->Object = new Reference();
        
        $this->Object->FirstName = $this->txtFirstName->Text;
        $this->Object->Surname = $this->txtSurname->Text;
        $this->Object->Relationship = $this->txtRelationship->Text;
        $this->Object->TelephoneNumber = $this->txtTelephoneNumber->Text;
        if ($Person) {
            $this->Object->PersonObject = $Person;
        }
        if ($this->saveUsingLstPerson) {
            $linkedPerson = Person::Load($this->lstPerson->SelectedValue);
            $this->Object->PersonObject = $linkedPerson;
        }
        if ($FileDocument) {
            $this->Object->FileDocumentObject = $FileDocument;
        }
        if ($this->saveUsingLstFileDocument) {
            $linkedFileDocument = FileDocument::Load($this->lstFileDocument->SelectedValue);
            $this->Object->FileDocumentObject = $linkedFileDocument;
        }
    }

    public function saveObject($validate = true,$Person = null,$FileDocument = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Person,$FileDocument);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtSurname);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtRelationship);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtTelephoneNumber);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtFirstName->WrapperCssClass = 'form-group';
            $this->txtFirstName->Placeholder = '';
            $this->txtSurname->WrapperCssClass = 'form-group';
            $this->txtSurname->Placeholder = '';
            $this->txtRelationship->WrapperCssClass = 'form-group';
            $this->txtRelationship->Placeholder = '';
            $this->txtTelephoneNumber->WrapperCssClass = 'form-group';
            $this->txtTelephoneNumber->Placeholder = '';
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
            $previousValues = Reference::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'FirstName-> Value before: '.$previousValues->FirstName.', Value after: '.$this->Object->FirstName.'<br>
        Surname-> Value before: '.$previousValues->Surname.', Value after: '.$this->Object->Surname.'<br>
        Relationship-> Value before: '.$previousValues->Relationship.', Value after: '.$this->Object->Relationship.'<br>
        TelephoneNumber-> Value before: '.$previousValues->TelephoneNumber.', Value after: '.$this->Object->TelephoneNumber.'<br>
        ';
        } else {
        $changeText = 'FirstName-> Value: '.$this->Object->FirstName.'<br>
        Surname-> Value: '.$this->Object->Surname.'<br>
        Relationship-> Value: '.$this->Object->Relationship.'<br>
        TelephoneNumber-> Value: '.$this->Object->TelephoneNumber.'<br>
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
            $AuditLogEntry->ObjectName = 'Reference';
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
                $AuditLogEntry->ObjectName = 'Reference';
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