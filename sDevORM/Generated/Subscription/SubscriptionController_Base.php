<?php
class SubscriptionController_Base {
    protected $Object;
    public $txtStartDate;
    public $txtEndDate;
    public $txtAverageMark;
    public $lstStudent,$saveUsingLstStudent = false;
    public $lstCourse,$saveUsingLstCourse = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtStartDate = new QTextBox($objParentObject);
        $this->txtStartDate->Name = 'Start Date';
        $this->txtStartDate->CssClass = 'form-control input-date';

        $this->txtEndDate = new QTextBox($objParentObject);
        $this->txtEndDate->Name = 'End Date';
        $this->txtEndDate->CssClass = 'form-control input-date';

        $this->txtAverageMark = new QTextBox($objParentObject);
        $this->txtAverageMark->Name = 'Average Mark';

        $this->lstStudent = new QListBox($objParentObject);
        $this->lstStudent->Name = 'Student';
        $this->lstStudent->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allStudent = Student::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allStudent as $Student) {
            $this->lstStudent->AddItem(new QListItem($Student->Id,$Student->Id));
        }

        $this->lstCourse = new QListBox($objParentObject);
        $this->lstCourse->Name = 'Course';
        $this->lstCourse->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allCourse = Course::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allCourse as $Course) {
            $this->lstCourse->AddItem(new QListItem($Course->Id,$Course->Id));
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
            if ($ReferenceObject == 'Student') {
                $this->lstStudent->RemoveAllItems();
                $allStudent_list = Student::LoadAll();
                foreach ($allStudent_list as $Student) {
                    $this->lstStudent->AddItem(new QListItem($Student->__get($ReferenceAttribute),$Student->Id));
                }
            }
            if ($ReferenceObject == 'Course') {
                $this->lstCourse->RemoveAllItems();
                $allCourse_list = Course::LoadAll();
                foreach ($allCourse_list as $Course) {
                    $this->lstCourse->AddItem(new QListItem($Course->__get($ReferenceAttribute),$Course->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'Student') {
                $this->saveUsingLstStudent = $useListValue;
            }
            if ($ReferenceObject == 'Course') {
                $this->saveUsingLstCourse = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtStartDate->Text = '';
        $this->txtEndDate->Text = '';
        $this->txtAverageMark->Text = '';

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
        if (!is_null($Object->AverageMark)) {
            $this->txtAverageMark->Text = $Object->AverageMark;
        }
        
        if (!is_null($Object->StudentObject)) {
            $this->lstStudent->SelectedValue = $Object->StudentObject->Id;
        }
        if (!is_null($Object->CourseObject)) {
            $this->lstCourse->SelectedValue = $Object->CourseObject->Id;
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
        if (strtoupper($strControl) == 'AVERAGEMARK') {
            if (strlen($nameValue) > 0)
                $this->txtAverageMark->Name = $nameValue;
            $output = $withName ? $this->txtAverageMark->RenderWithName($blnPrintOutput):$this->txtAverageMark->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'STUDENT') {
            if (strlen($nameValue) > 0)
                $this->lstStudent->Name = $nameValue;
            $output = $withName ? $this->lstStudent->RenderWithName($blnPrintOutput):$this->lstStudent->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'COURSE') {
            if (strlen($nameValue) > 0)
                $this->lstCourse->Name = $nameValue;
            $output = $withName ? $this->lstCourse->RenderWithName($blnPrintOutput):$this->lstCourse->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('STARTDATE',$withName);
        $this->renderControl('ENDDATE',$withName);
        $this->renderControl('AVERAGEMARK',$withName);
        $this->renderControl('STUDENT',$withName);
        $this->renderControl('COURSE',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('StartDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('EndDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('AverageMark',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtStartDate->Visible = false;
        $this->txtEndDate->Visible = false;
        $this->txtAverageMark->Visible = false;
        $this->lstStudent->Visible = false;
        $this->lstCourse->Visible = false;
    }

    public function showAll() {
        $this->txtStartDate->Visible = true;
        $this->txtEndDate->Visible = true;
        $this->txtAverageMark->Visible = true;
        $this->lstStudent->Visible = true;
        $this->lstCourse->Visible = true;
    }

    public function refreshAll() {
        $this->txtStartDate->Refresh();
        $this->txtEndDate->Refresh();
        $this->txtAverageMark->Refresh();
        $this->lstStudent->Refresh();
        $this->lstCourse->Refresh();
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
            case 'AVERAGEMARK':
                $this->txtAverageMark->Text = $value;
                break;
            case 'STUDENT':
                $this->lstStudent->SelectedValue = $value;
                break;
            case 'COURSE':
                $this->lstCourse->SelectedValue = $value;
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
            case 'AVERAGEMARK':
                if ($this->txtAverageMark->Text)
                    return $this->txtAverageMark->Text;
                break;
            case 'STUDENT':
                if ($this->lstStudent->SelectedValue)
                    return $this->lstStudent->SelectedValue;
                break;
            case 'COURSE':
                if ($this->lstCourse->SelectedValue)
                    return $this->lstCourse->SelectedValue;
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
            case 'AVERAGEMARK':
                if ($this->txtAverageMark)
                    return $this->txtAverageMark->ControlId;
                break;
            case 'STUDENT':
                if ($this->lstStudent)
                    return $this->lstStudent->ControlId;
                break;
            case 'COURSE':
                if ($this->lstCourse)
                    return $this->lstCourse->ControlId;
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
            case 'AVERAGEMARK':
                $this->txtAverageMark->Visible = false;
                $this->txtAverageMark->Refresh();
                break;
            case 'STUDENT':
                $this->lstStudent->Visible = false;
                $this->lstStudent->Refresh();
                break;
            case 'COURSE':
                $this->lstCourse->Visible = false;
                $this->lstCourse->Refresh();
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
            case 'AVERAGEMARK':
                $this->txtAverageMark->Visible = true;
                $this->txtAverageMark->Refresh();
                break;
            case 'STUDENT':
                $this->lstStudent->Visible = true;
                $this->lstStudent->Refresh();
                break;
            case 'COURSE':
                $this->lstCourse->Visible = true;
                $this->lstCourse->Refresh();
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

    public function applyValuesBeforeSaveObject($Student = null,$Course = null)  {
        if (!$this->Object)
            $this->Object = new Subscription();
        
        if (strlen($this->txtStartDate->Text) > 0) {
            $this->Object->StartDate = new QDateTime($this->txtStartDate->Text);
        }
        if (strlen($this->txtEndDate->Text) > 0) {
            $this->Object->EndDate = new QDateTime($this->txtEndDate->Text);
        }
        $this->Object->AverageMark = $this->txtAverageMark->Text;
        if ($Student) {
            $this->Object->StudentObject = $Student;
        }
        if ($this->saveUsingLstStudent) {
            $linkedStudent = Student::Load($this->lstStudent->SelectedValue);
            $this->Object->StudentObject = $linkedStudent;
        }
        if ($Course) {
            $this->Object->CourseObject = $Course;
        }
        if ($this->saveUsingLstCourse) {
            $linkedCourse = Course::Load($this->lstCourse->SelectedValue);
            $this->Object->CourseObject = $linkedCourse;
        }
    }

    public function saveObject($validate = true,$Student = null,$Course = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Student,$Course);
        
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
        $hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtStartDate);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtEndDate);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtAverageMark);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtStartDate->WrapperCssClass = 'form-group';
            $this->txtStartDate->Placeholder = '';
            $this->txtEndDate->WrapperCssClass = 'form-group';
            $this->txtEndDate->Placeholder = '';
            $this->txtAverageMark->WrapperCssClass = 'form-group';
            $this->txtAverageMark->Placeholder = '';
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
        AverageMark-> Value before: '.$previousValues->AverageMark.', Value after: '.$this->Object->AverageMark.'<br>
        ';
        } else {
        $changeText = 'StartDate-> Value: '.$this->Object->StartDate.'<br>
        EndDate-> Value: '.$this->Object->EndDate.'<br>
        AverageMark-> Value: '.$this->Object->AverageMark.'<br>
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