<?php
class EducationController_Base {
    protected $Object;
    public $txtInstitution;
    public $txtStartDate;
    public $txtEndDate;
    public $txtQualification;
    public $lstPerson,$saveUsingLstPerson = false;
    public $lstFileDocument,$saveUsingLstFileDocument = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtInstitution = new QTextBox($objParentObject);
        $this->txtInstitution->Name = 'Institution';

        $this->txtStartDate = new QTextBox($objParentObject);
        $this->txtStartDate->Name = 'Start Date';
        $this->txtStartDate->CssClass = 'form-control input-date';

        $this->txtEndDate = new QTextBox($objParentObject);
        $this->txtEndDate->Name = 'End Date';
        $this->txtEndDate->CssClass = 'form-control input-date';

        $this->txtQualification = new QTextBox($objParentObject);
        $this->txtQualification->Name = 'Qualification';

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
        $this->txtInstitution->Text = '';
        $this->txtStartDate->Text = '';
        $this->txtEndDate->Text = '';
        $this->txtQualification->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->Institution)) {
            $this->txtInstitution->Text = $Object->Institution;
        }
        if (!is_null($Object->StartDate)) {
            $this->txtStartDate->Text = $Object->StartDate->format(DATE_TIME_FORMAT_HTML);
        }
        if (!is_null($Object->EndDate)) {
            $this->txtEndDate->Text = $Object->EndDate->format(DATE_TIME_FORMAT_HTML);
        }
        if (!is_null($Object->Qualification)) {
            $this->txtQualification->Text = $Object->Qualification;
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
        if (strtoupper($strControl) == 'INSTITUTION') {
            if (strlen($nameValue) > 0)
                $this->txtInstitution->Name = $nameValue;
            $output = $withName ? $this->txtInstitution->RenderWithName($blnPrintOutput):$this->txtInstitution->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'STARTDATE') {
            if (strlen($nameValue) > 0)
                $this->txtStartDate->Name = $nameValue;
            $output = $withName ? $this->txtStartDate->RenderWithName($blnPrintOutput):$this->txtStartDate->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ENDDATE') {
            if (strlen($nameValue) > 0)
                $this->txtEndDate->Name = $nameValue;
            $output = $withName ? $this->txtEndDate->RenderWithName($blnPrintOutput):$this->txtEndDate->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'QUALIFICATION') {
            if (strlen($nameValue) > 0)
                $this->txtQualification->Name = $nameValue;
            $output = $withName ? $this->txtQualification->RenderWithName($blnPrintOutput):$this->txtQualification->Render($blnPrintOutput);
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
        $this->renderControl('INSTITUTION',$withName);
        $this->renderControl('STARTDATE',$withName);
        $this->renderControl('ENDDATE',$withName);
        $this->renderControl('QUALIFICATION',$withName);
        $this->renderControl('PERSON',$withName);
        $this->renderControl('FILEDOCUMENT',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('Institution',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('StartDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('EndDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Qualification',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtInstitution->Visible = false;
        $this->txtStartDate->Visible = false;
        $this->txtEndDate->Visible = false;
        $this->txtQualification->Visible = false;
        $this->lstPerson->Visible = false;
        $this->lstFileDocument->Visible = false;
    }

    public function showAll() {
        $this->txtInstitution->Visible = true;
        $this->txtStartDate->Visible = true;
        $this->txtEndDate->Visible = true;
        $this->txtQualification->Visible = true;
        $this->lstPerson->Visible = true;
        $this->lstFileDocument->Visible = true;
    }

    public function refreshAll() {
        $this->txtInstitution->Refresh();
        $this->txtStartDate->Refresh();
        $this->txtEndDate->Refresh();
        $this->txtQualification->Refresh();
        $this->lstPerson->Refresh();
        $this->lstFileDocument->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'INSTITUTION':
                $this->txtInstitution->Text = $value;
                break;
            case 'STARTDATE':
                $this->txtStartDate->Text = $value;
                break;
            case 'ENDDATE':
                $this->txtEndDate->Text = $value;
                break;
            case 'QUALIFICATION':
                $this->txtQualification->Text = $value;
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
            case 'INSTITUTION':
                if ($this->txtInstitution->Text)
                    return $this->txtInstitution->Text;
                break;
            case 'STARTDATE':
                if ($this->txtStartDate->Text)
                    return $this->txtStartDate->Text;
                break;
            case 'ENDDATE':
                if ($this->txtEndDate->Text)
                    return $this->txtEndDate->Text;
                break;
            case 'QUALIFICATION':
                if ($this->txtQualification->Text)
                    return $this->txtQualification->Text;
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
            case 'INSTITUTION':
                if ($this->txtInstitution)
                    return $this->txtInstitution->ControlId;
                break;
            case 'STARTDATE':
                if ($this->txtStartDate)
                    return $this->txtStartDate->ControlId;
                break;
            case 'ENDDATE':
                if ($this->txtEndDate)
                    return $this->txtEndDate->ControlId;
                break;
            case 'QUALIFICATION':
                if ($this->txtQualification)
                    return $this->txtQualification->ControlId;
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
            case 'INSTITUTION':
                $this->txtInstitution->Visible = false;
                $this->txtInstitution->Refresh();
                break;
            case 'STARTDATE':
                $this->txtStartDate->Visible = false;
                $this->txtStartDate->Refresh();
                break;
            case 'ENDDATE':
                $this->txtEndDate->Visible = false;
                $this->txtEndDate->Refresh();
                break;
            case 'QUALIFICATION':
                $this->txtQualification->Visible = false;
                $this->txtQualification->Refresh();
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
            case 'INSTITUTION':
                $this->txtInstitution->Visible = true;
                $this->txtInstitution->Refresh();
                break;
            case 'STARTDATE':
                $this->txtStartDate->Visible = true;
                $this->txtStartDate->Refresh();
                break;
            case 'ENDDATE':
                $this->txtEndDate->Visible = true;
                $this->txtEndDate->Refresh();
                break;
            case 'QUALIFICATION':
                $this->txtQualification->Visible = true;
                $this->txtQualification->Refresh();
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
        return $this->txtInstitution->getJqControlId();
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
            $this->Object = new Education();
        
        $this->Object->Institution = $this->txtInstitution->Text;
        if (strlen($this->txtStartDate->Text) > 0) {
            $this->Object->StartDate = new QDateTime($this->txtStartDate->Text);
        }
        if (strlen($this->txtEndDate->Text) > 0) {
            $this->Object->EndDate = new QDateTime($this->txtEndDate->Text);
        }
        $this->Object->Qualification = $this->txtQualification->Text;
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtInstitution);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtStartDate);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtEndDate);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtQualification);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtInstitution->WrapperCssClass = 'form-group';
            $this->txtInstitution->Placeholder = '';
            $this->txtStartDate->WrapperCssClass = 'form-group';
            $this->txtStartDate->Placeholder = '';
            $this->txtEndDate->WrapperCssClass = 'form-group';
            $this->txtEndDate->Placeholder = '';
            $this->txtQualification->WrapperCssClass = 'form-group';
            $this->txtQualification->Placeholder = '';
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
            $previousValues = Education::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'Institution-> Value before: '.$previousValues->Institution.', Value after: '.$this->Object->Institution.'<br>
        StartDate-> Value before: '.$previousValues->StartDate.', Value after: '.$this->Object->StartDate.'<br>
        EndDate-> Value before: '.$previousValues->EndDate.', Value after: '.$this->Object->EndDate.'<br>
        Qualification-> Value before: '.$previousValues->Qualification.', Value after: '.$this->Object->Qualification.'<br>
        ';
        } else {
        $changeText = 'Institution-> Value: '.$this->Object->Institution.'<br>
        StartDate-> Value: '.$this->Object->StartDate.'<br>
        EndDate-> Value: '.$this->Object->EndDate.'<br>
        Qualification-> Value: '.$this->Object->Qualification.'<br>
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
            $AuditLogEntry->ObjectName = 'Education';
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
                $AuditLogEntry->ObjectName = 'Education';
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