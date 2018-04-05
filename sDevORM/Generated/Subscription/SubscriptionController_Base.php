<?php
class SubscriptionController_Base {
    protected $Object;
    public $txtStartDate;
    public $txtEndDate;
    public $lstAccount,$saveUsingLstAccount = false;
    public $lstCourse,$saveUsingLstCourse = false;
    public $lstAssignment,$saveUsingLstAssignment = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtStartDate = new QTextBox($objParentObject);
        $this->txtStartDate->Name = 'Start Date';
        $this->txtStartDate->CssClass = 'form-control input-date';

        $this->txtEndDate = new QTextBox($objParentObject);
        $this->txtEndDate->Name = 'End Date';
        $this->txtEndDate->CssClass = 'form-control input-date';

        $this->lstAccount = new QListBox($objParentObject);
        $this->lstAccount->Name = 'Account';
        $this->lstAccount->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allAccount = Account::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allAccount as $Account) {
            $this->lstAccount->AddItem(new QListItem($Account->Id,$Account->Id));
        }

        $this->lstCourse = new QListBox($objParentObject);
        $this->lstCourse->Name = 'Course';
        $this->lstCourse->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allCourse = Course::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allCourse as $Course) {
            $this->lstCourse->AddItem(new QListItem($Course->Id,$Course->Id));
        }

        $this->lstAssignment = new QListBox($objParentObject);
        $this->lstAssignment->Name = 'Assignment';
        $this->lstAssignment->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allAssignment = Assignment::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allAssignment as $Assignment) {
            $this->lstAssignment->AddItem(new QListItem($Assignment->Id,$Assignment->Id));
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
            if ($ReferenceObject == 'Account') {
                $this->lstAccount->RemoveAllItems();
                $allAccount_list = Account::LoadAll();
                foreach ($allAccount_list as $Account) {
                    $this->lstAccount->AddItem(new QListItem($Account->__get($ReferenceAttribute),$Account->Id));
                }
            }
            if ($ReferenceObject == 'Course') {
                $this->lstCourse->RemoveAllItems();
                $allCourse_list = Course::LoadAll();
                foreach ($allCourse_list as $Course) {
                    $this->lstCourse->AddItem(new QListItem($Course->__get($ReferenceAttribute),$Course->Id));
                }
            }
            if ($ReferenceObject == 'Assignment') {
                $this->lstAssignment->RemoveAllItems();
                $allAssignment_list = Assignment::LoadAll();
                foreach ($allAssignment_list as $Assignment) {
                    $this->lstAssignment->AddItem(new QListItem($Assignment->__get($ReferenceAttribute),$Assignment->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'Account') {
                $this->saveUsingLstAccount = $useListValue;
            }
            if ($ReferenceObject == 'Course') {
                $this->saveUsingLstCourse = $useListValue;
            }
            if ($ReferenceObject == 'Assignment') {
                $this->saveUsingLstAssignment = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtStartDate->Text = '';
        $this->txtEndDate->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->StartDate)) {
            $this->txtStartDate->Text = $Object->StartDate->format(DATE_TIME_FORMAT_HTML);
        }
        if (!is_null($Object->EndDate)) {
            $this->txtEndDate->Text = $Object->EndDate->format(DATE_TIME_FORMAT_HTML);
        }
        
        if (!is_null($Object->AccountObject)) {
            $this->lstAccount->SelectedValue = $Object->AccountObject->Id;
        }
        if (!is_null($Object->CourseObject)) {
            $this->lstCourse->SelectedValue = $Object->CourseObject->Id;
        }
        if (!is_null($Object->AssignmentObject)) {
            $this->lstAssignment->SelectedValue = $Object->AssignmentObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
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
        if (strtoupper($strControl) == 'ACCOUNT') {
            if (strlen($nameValue) > 0)
                $this->lstAccount->Name = $nameValue;
            $output = $withName ? $this->lstAccount->RenderWithName($blnPrintOutput):$this->lstAccount->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'COURSE') {
            if (strlen($nameValue) > 0)
                $this->lstCourse->Name = $nameValue;
            $output = $withName ? $this->lstCourse->RenderWithName($blnPrintOutput):$this->lstCourse->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ASSIGNMENT') {
            if (strlen($nameValue) > 0)
                $this->lstAssignment->Name = $nameValue;
            $output = $withName ? $this->lstAssignment->RenderWithName($blnPrintOutput):$this->lstAssignment->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('STARTDATE',$withName);
        $this->renderControl('ENDDATE',$withName);
        $this->renderControl('ACCOUNT',$withName);
        $this->renderControl('COURSE',$withName);
        $this->renderControl('ASSIGNMENT',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('StartDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('EndDate',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtStartDate->Visible = false;
        $this->txtEndDate->Visible = false;
        $this->lstAccount->Visible = false;
        $this->lstCourse->Visible = false;
        $this->lstAssignment->Visible = false;
    }

    public function showAll() {
        $this->txtStartDate->Visible = true;
        $this->txtEndDate->Visible = true;
        $this->lstAccount->Visible = true;
        $this->lstCourse->Visible = true;
        $this->lstAssignment->Visible = true;
    }

    public function refreshAll() {
        $this->txtStartDate->Refresh();
        $this->txtEndDate->Refresh();
        $this->lstAccount->Refresh();
        $this->lstCourse->Refresh();
        $this->lstAssignment->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'STARTDATE':
                $this->txtStartDate->Text = $value;
                break;
            case 'ENDDATE':
                $this->txtEndDate->Text = $value;
                break;
            case 'ACCOUNT':
                $this->lstAccount->SelectedValue = $value;
                break;
            case 'COURSE':
                $this->lstCourse->SelectedValue = $value;
                break;
            case 'ASSIGNMENT':
                $this->lstAssignment->SelectedValue = $value;
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
            case 'STARTDATE':
                if ($this->txtStartDate->Text)
                    return $this->txtStartDate->Text;
                break;
            case 'ENDDATE':
                if ($this->txtEndDate->Text)
                    return $this->txtEndDate->Text;
                break;
            case 'ACCOUNT':
                if ($this->lstAccount->SelectedValue)
                    return $this->lstAccount->SelectedValue;
                break;
            case 'COURSE':
                if ($this->lstCourse->SelectedValue)
                    return $this->lstCourse->SelectedValue;
                break;
            case 'ASSIGNMENT':
                if ($this->lstAssignment->SelectedValue)
                    return $this->lstAssignment->SelectedValue;
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
            case 'STARTDATE':
                if ($this->txtStartDate)
                    return $this->txtStartDate->ControlId;
                break;
            case 'ENDDATE':
                if ($this->txtEndDate)
                    return $this->txtEndDate->ControlId;
                break;
            case 'ACCOUNT':
                if ($this->lstAccount)
                    return $this->lstAccount->ControlId;
                break;
            case 'COURSE':
                if ($this->lstCourse)
                    return $this->lstCourse->ControlId;
                break;
            case 'ASSIGNMENT':
                if ($this->lstAssignment)
                    return $this->lstAssignment->ControlId;
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
            case 'STARTDATE':
                $this->txtStartDate->Visible = false;
                $this->txtStartDate->Refresh();
                break;
            case 'ENDDATE':
                $this->txtEndDate->Visible = false;
                $this->txtEndDate->Refresh();
                break;
            case 'ACCOUNT':
                $this->lstAccount->Visible = false;
                $this->lstAccount->Refresh();
                break;
            case 'COURSE':
                $this->lstCourse->Visible = false;
                $this->lstCourse->Refresh();
                break;
            case 'ASSIGNMENT':
                $this->lstAssignment->Visible = false;
                $this->lstAssignment->Refresh();
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
            case 'STARTDATE':
                $this->txtStartDate->Visible = true;
                $this->txtStartDate->Refresh();
                break;
            case 'ENDDATE':
                $this->txtEndDate->Visible = true;
                $this->txtEndDate->Refresh();
                break;
            case 'ACCOUNT':
                $this->lstAccount->Visible = true;
                $this->lstAccount->Refresh();
                break;
            case 'COURSE':
                $this->lstCourse->Visible = true;
                $this->lstCourse->Refresh();
                break;
            case 'ASSIGNMENT':
                $this->lstAssignment->Visible = true;
                $this->lstAssignment->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtStartDate->getJqControlId();
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

    public function applyValuesBeforeSaveObject($Account = null,$Course = null,$Assignment = null)  {
        if (!$this->Object)
            $this->Object = new Subscription();
        
        if (strlen($this->txtStartDate->Text) > 0) {
            $this->Object->StartDate = new QDateTime($this->txtStartDate->Text);
        }
        if (strlen($this->txtEndDate->Text) > 0) {
            $this->Object->EndDate = new QDateTime($this->txtEndDate->Text);
        }
        if ($Account) {
            $this->Object->AccountObject = $Account;
        }
        if ($this->saveUsingLstAccount) {
            $linkedAccount = Account::Load($this->lstAccount->SelectedValue);
            $this->Object->AccountObject = $linkedAccount;
        }
        if ($Course) {
            $this->Object->CourseObject = $Course;
        }
        if ($this->saveUsingLstCourse) {
            $linkedCourse = Course::Load($this->lstCourse->SelectedValue);
            $this->Object->CourseObject = $linkedCourse;
        }
        if ($Assignment) {
            $this->Object->AssignmentObject = $Assignment;
        }
        if ($this->saveUsingLstAssignment) {
            $linkedAssignment = Assignment::Load($this->lstAssignment->SelectedValue);
            $this->Object->AssignmentObject = $linkedAssignment;
        }
    }

    public function saveObject($validate = true,$Account = null,$Course = null,$Assignment = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Account,$Course,$Assignment);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtStartDate);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtEndDate);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtStartDate->WrapperCssClass = 'form-group';
            $this->txtStartDate->Placeholder = '';
            $this->txtEndDate->WrapperCssClass = 'form-group';
            $this->txtEndDate->Placeholder = '';
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
            $previousValues = Subscription::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'StartDate-> Value before: '.$previousValues->StartDate.', Value after: '.$this->Object->StartDate.'<br>
        EndDate-> Value before: '.$previousValues->EndDate.', Value after: '.$this->Object->EndDate.'<br>
        ';
        } else {
        $changeText = 'StartDate-> Value: '.$this->Object->StartDate.'<br>
        EndDate-> Value: '.$this->Object->EndDate.'<br>
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
            $AuditLogEntry->ObjectName = 'Subscription';
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
                $AuditLogEntry->ObjectName = 'Subscription';
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