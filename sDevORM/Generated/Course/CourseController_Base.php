<?php
class CourseController_Base {
    protected $Object;
    public $txtCourseName;
    public $txtCoursePrice;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtCourseName = new QTextBox($objParentObject);
        $this->txtCourseName->Name = 'Course Name';

        $this->txtCoursePrice = new QTextBox($objParentObject);
        $this->txtCoursePrice->Name = 'Course Price';

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
        $this->txtCourseName->Text = '';
        $this->txtCoursePrice->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->CourseName)) {
            $this->txtCourseName->Text = $Object->CourseName;
        }
        if (!is_null($Object->CoursePrice)) {
            $this->txtCoursePrice->Text = $Object->CoursePrice;
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'COURSENAME') {
            if (strlen($nameValue) > 0)
                $this->txtCourseName->Name = $nameValue;
            $output = $withName ? $this->txtCourseName->RenderWithName($blnPrintOutput):$this->txtCourseName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'COURSEPRICE') {
            if (strlen($nameValue) > 0)
                $this->txtCoursePrice->Name = $nameValue;
            $output = $withName ? $this->txtCoursePrice->RenderWithName($blnPrintOutput):$this->txtCoursePrice->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('COURSENAME',$withName);
        $this->renderControl('COURSEPRICE',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('CourseName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('CoursePrice',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtCourseName->Visible = false;
        $this->txtCoursePrice->Visible = false;
    }

    public function showAll() {
        $this->txtCourseName->Visible = true;
        $this->txtCoursePrice->Visible = true;
    }

    public function refreshAll() {
        $this->txtCourseName->Refresh();
        $this->txtCoursePrice->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'COURSENAME':
                $this->txtCourseName->Text = $value;
                break;
            case 'COURSEPRICE':
                $this->txtCoursePrice->Text = $value;
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
            case 'COURSENAME':
                if ($this->txtCourseName->Text)
                    return $this->txtCourseName->Text;
                break;
            case 'COURSEPRICE':
                if ($this->txtCoursePrice->Text)
                    return $this->txtCoursePrice->Text;
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
            case 'COURSENAME':
                if ($this->txtCourseName)
                    return $this->txtCourseName->ControlId;
                break;
            case 'COURSEPRICE':
                if ($this->txtCoursePrice)
                    return $this->txtCoursePrice->ControlId;
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
            case 'COURSENAME':
                $this->txtCourseName->Visible = false;
                $this->txtCourseName->Refresh();
                break;
            case 'COURSEPRICE':
                $this->txtCoursePrice->Visible = false;
                $this->txtCoursePrice->Refresh();
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
            case 'COURSENAME':
                $this->txtCourseName->Visible = true;
                $this->txtCourseName->Refresh();
                break;
            case 'COURSEPRICE':
                $this->txtCoursePrice->Visible = true;
                $this->txtCoursePrice->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtCourseName->getJqControlId();
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
        
        $this->Object->CourseName = $this->txtCourseName->Text;
        $this->Object->CoursePrice = $this->txtCoursePrice->Text;
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtCourseName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtCoursePrice);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtCourseName->WrapperCssClass = 'form-group';
            $this->txtCourseName->Placeholder = '';
            $this->txtCoursePrice->WrapperCssClass = 'form-group';
            $this->txtCoursePrice->Placeholder = '';
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
        $changeText = 'CourseName-> Value before: '.$previousValues->CourseName.', Value after: '.$this->Object->CourseName.'<br>
        CoursePrice-> Value before: '.$previousValues->CoursePrice.', Value after: '.$this->Object->CoursePrice.'<br>
        ';
        } else {
        $changeText = 'CourseName-> Value: '.$this->Object->CourseName.'<br>
        CoursePrice-> Value: '.$this->Object->CoursePrice.'<br>
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