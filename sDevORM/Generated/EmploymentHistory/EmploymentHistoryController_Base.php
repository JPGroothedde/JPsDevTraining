<?php
class EmploymentHistoryController_Base {
    protected $Object;
    public $txtPeriodStartDate;
    public $txtPeriodEndDate;
    public $txtEmployerName;
    public $txtTitle;
    public $txtDuties;
    public $lstPerson,$saveUsingLstPerson = false;
    public $lstFileDocument,$saveUsingLstFileDocument = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtPeriodStartDate = new QTextBox($objParentObject);
        $this->txtPeriodStartDate->Name = 'Period Start Date';
        $this->txtPeriodStartDate->CssClass = 'form-control input-date';

        $this->txtPeriodEndDate = new QTextBox($objParentObject);
        $this->txtPeriodEndDate->Name = 'Period End Date';
        $this->txtPeriodEndDate->CssClass = 'form-control input-date';

        $this->txtEmployerName = new QTextBox($objParentObject);
        $this->txtEmployerName->Name = 'Employer Name';

        $this->txtTitle = new QTextBox($objParentObject);
        $this->txtTitle->Name = 'Title';

        $this->txtDuties = new QTextBox($objParentObject);
        $this->txtDuties->Name = 'Duties';

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
        $this->txtPeriodStartDate->Text = '';
        $this->txtPeriodEndDate->Text = '';
        $this->txtEmployerName->Text = '';
        $this->txtTitle->Text = '';
        $this->txtDuties->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->PeriodStartDate)) {
            $this->txtPeriodStartDate->Text = $Object->PeriodStartDate->format(DATE_TIME_FORMAT_HTML);
        }
        if (!is_null($Object->PeriodEndDate)) {
            $this->txtPeriodEndDate->Text = $Object->PeriodEndDate->format(DATE_TIME_FORMAT_HTML);
        }
        if (!is_null($Object->EmployerName)) {
            $this->txtEmployerName->Text = $Object->EmployerName;
        }
        if (!is_null($Object->Title)) {
            $this->txtTitle->Text = $Object->Title;
        }
        if (!is_null($Object->Duties)) {
            $this->txtDuties->Text = $Object->Duties;
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
        if (strtoupper($strControl) == 'PERIODSTARTDATE') {
            if (strlen($nameValue) > 0)
                $this->txtPeriodStartDate->Name = $nameValue;
            $output = $withName ? $this->txtPeriodStartDate->RenderWithName($blnPrintOutput):$this->txtPeriodStartDate->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PERIODENDDATE') {
            if (strlen($nameValue) > 0)
                $this->txtPeriodEndDate->Name = $nameValue;
            $output = $withName ? $this->txtPeriodEndDate->RenderWithName($blnPrintOutput):$this->txtPeriodEndDate->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'EMPLOYERNAME') {
            if (strlen($nameValue) > 0)
                $this->txtEmployerName->Name = $nameValue;
            $output = $withName ? $this->txtEmployerName->RenderWithName($blnPrintOutput):$this->txtEmployerName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'TITLE') {
            if (strlen($nameValue) > 0)
                $this->txtTitle->Name = $nameValue;
            $output = $withName ? $this->txtTitle->RenderWithName($blnPrintOutput):$this->txtTitle->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DUTIES') {
            if (strlen($nameValue) > 0)
                $this->txtDuties->Name = $nameValue;
            $output = $withName ? $this->txtDuties->RenderWithName($blnPrintOutput):$this->txtDuties->Render($blnPrintOutput);
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
        $this->renderControl('PERIODSTARTDATE',$withName);
        $this->renderControl('PERIODENDDATE',$withName);
        $this->renderControl('EMPLOYERNAME',$withName);
        $this->renderControl('TITLE',$withName);
        $this->renderControl('DUTIES',$withName);
        $this->renderControl('PERSON',$withName);
        $this->renderControl('FILEDOCUMENT',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('PeriodStartDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('PeriodEndDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('EmployerName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Title',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Duties',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtPeriodStartDate->Visible = false;
        $this->txtPeriodEndDate->Visible = false;
        $this->txtEmployerName->Visible = false;
        $this->txtTitle->Visible = false;
        $this->txtDuties->Visible = false;
        $this->lstPerson->Visible = false;
        $this->lstFileDocument->Visible = false;
    }

    public function showAll() {
        $this->txtPeriodStartDate->Visible = true;
        $this->txtPeriodEndDate->Visible = true;
        $this->txtEmployerName->Visible = true;
        $this->txtTitle->Visible = true;
        $this->txtDuties->Visible = true;
        $this->lstPerson->Visible = true;
        $this->lstFileDocument->Visible = true;
    }

    public function refreshAll() {
        $this->txtPeriodStartDate->Refresh();
        $this->txtPeriodEndDate->Refresh();
        $this->txtEmployerName->Refresh();
        $this->txtTitle->Refresh();
        $this->txtDuties->Refresh();
        $this->lstPerson->Refresh();
        $this->lstFileDocument->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'PERIODSTARTDATE':
                $this->txtPeriodStartDate->Text = $value;
                break;
            case 'PERIODENDDATE':
                $this->txtPeriodEndDate->Text = $value;
                break;
            case 'EMPLOYERNAME':
                $this->txtEmployerName->Text = $value;
                break;
            case 'TITLE':
                $this->txtTitle->Text = $value;
                break;
            case 'DUTIES':
                $this->txtDuties->Text = $value;
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
            case 'PERIODSTARTDATE':
                if ($this->txtPeriodStartDate->Text)
                    return $this->txtPeriodStartDate->Text;
                break;
            case 'PERIODENDDATE':
                if ($this->txtPeriodEndDate->Text)
                    return $this->txtPeriodEndDate->Text;
                break;
            case 'EMPLOYERNAME':
                if ($this->txtEmployerName->Text)
                    return $this->txtEmployerName->Text;
                break;
            case 'TITLE':
                if ($this->txtTitle->Text)
                    return $this->txtTitle->Text;
                break;
            case 'DUTIES':
                if ($this->txtDuties->Text)
                    return $this->txtDuties->Text;
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
            case 'PERIODSTARTDATE':
                if ($this->txtPeriodStartDate)
                    return $this->txtPeriodStartDate->ControlId;
                break;
            case 'PERIODENDDATE':
                if ($this->txtPeriodEndDate)
                    return $this->txtPeriodEndDate->ControlId;
                break;
            case 'EMPLOYERNAME':
                if ($this->txtEmployerName)
                    return $this->txtEmployerName->ControlId;
                break;
            case 'TITLE':
                if ($this->txtTitle)
                    return $this->txtTitle->ControlId;
                break;
            case 'DUTIES':
                if ($this->txtDuties)
                    return $this->txtDuties->ControlId;
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
            case 'PERIODSTARTDATE':
                $this->txtPeriodStartDate->Visible = false;
                $this->txtPeriodStartDate->Refresh();
                break;
            case 'PERIODENDDATE':
                $this->txtPeriodEndDate->Visible = false;
                $this->txtPeriodEndDate->Refresh();
                break;
            case 'EMPLOYERNAME':
                $this->txtEmployerName->Visible = false;
                $this->txtEmployerName->Refresh();
                break;
            case 'TITLE':
                $this->txtTitle->Visible = false;
                $this->txtTitle->Refresh();
                break;
            case 'DUTIES':
                $this->txtDuties->Visible = false;
                $this->txtDuties->Refresh();
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
            case 'PERIODSTARTDATE':
                $this->txtPeriodStartDate->Visible = true;
                $this->txtPeriodStartDate->Refresh();
                break;
            case 'PERIODENDDATE':
                $this->txtPeriodEndDate->Visible = true;
                $this->txtPeriodEndDate->Refresh();
                break;
            case 'EMPLOYERNAME':
                $this->txtEmployerName->Visible = true;
                $this->txtEmployerName->Refresh();
                break;
            case 'TITLE':
                $this->txtTitle->Visible = true;
                $this->txtTitle->Refresh();
                break;
            case 'DUTIES':
                $this->txtDuties->Visible = true;
                $this->txtDuties->Refresh();
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
        return $this->txtPeriodStartDate->getJqControlId();
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
            $this->Object = new EmploymentHistory();
        
        if (strlen($this->txtPeriodStartDate->Text) > 0) {
            $this->Object->PeriodStartDate = new QDateTime($this->txtPeriodStartDate->Text);
        }
        if (strlen($this->txtPeriodEndDate->Text) > 0) {
            $this->Object->PeriodEndDate = new QDateTime($this->txtPeriodEndDate->Text);
        }
        $this->Object->EmployerName = $this->txtEmployerName->Text;
        $this->Object->Title = $this->txtTitle->Text;
        $this->Object->Duties = $this->txtDuties->Text;
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPeriodStartDate);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPeriodEndDate);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtEmployerName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtTitle);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtDuties);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtPeriodStartDate->WrapperCssClass = 'form-group';
            $this->txtPeriodStartDate->Placeholder = '';
            $this->txtPeriodEndDate->WrapperCssClass = 'form-group';
            $this->txtPeriodEndDate->Placeholder = '';
            $this->txtEmployerName->WrapperCssClass = 'form-group';
            $this->txtEmployerName->Placeholder = '';
            $this->txtTitle->WrapperCssClass = 'form-group';
            $this->txtTitle->Placeholder = '';
            $this->txtDuties->WrapperCssClass = 'form-group';
            $this->txtDuties->Placeholder = '';
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
            $previousValues = EmploymentHistory::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'PeriodStartDate-> Value before: '.$previousValues->PeriodStartDate.', Value after: '.$this->Object->PeriodStartDate.'<br>
        PeriodEndDate-> Value before: '.$previousValues->PeriodEndDate.', Value after: '.$this->Object->PeriodEndDate.'<br>
        EmployerName-> Value before: '.$previousValues->EmployerName.', Value after: '.$this->Object->EmployerName.'<br>
        Title-> Value before: '.$previousValues->Title.', Value after: '.$this->Object->Title.'<br>
        Duties-> Value before: '.$previousValues->Duties.', Value after: '.$this->Object->Duties.'<br>
        ';
        } else {
        $changeText = 'PeriodStartDate-> Value: '.$this->Object->PeriodStartDate.'<br>
        PeriodEndDate-> Value: '.$this->Object->PeriodEndDate.'<br>
        EmployerName-> Value: '.$this->Object->EmployerName.'<br>
        Title-> Value: '.$this->Object->Title.'<br>
        Duties-> Value: '.$this->Object->Duties.'<br>
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
            $AuditLogEntry->ObjectName = 'EmploymentHistory';
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
                $AuditLogEntry->ObjectName = 'EmploymentHistory';
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