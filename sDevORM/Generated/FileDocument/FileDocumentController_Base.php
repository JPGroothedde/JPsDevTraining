<?php
class FileDocumentController_Base {
    protected $Object;
    public $txtFileName;
    public $txtPath;
    public $txtCreatedDate;
    public $lstCreatedDateHours,$lstCreatedDateMinutes;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtFileName = new QTextBox($objParentObject);
        $this->txtFileName->Name = 'File Name';

        $this->txtPath = new QTextBox($objParentObject);
        $this->txtPath->Name = 'Path';

        $this->txtCreatedDate = new QTextBox($objParentObject);
        $this->txtCreatedDate->Name = 'Created Date';
        $this->txtCreatedDate->CssClass = 'form-control input-date';

        $this->lstCreatedDateHours = new QListBox($objParentObject);
        $this->lstCreatedDateHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstCreatedDateMinutes = new QListBox($objParentObject);
        $this->lstCreatedDateMinutes->HtmlBefore = ' : ';
        $this->lstCreatedDateMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstCreatedDateHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstCreatedDateHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstCreatedDateMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstCreatedDateMinutes->AddItem(new QListItem($display,$i));
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
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
        }
    }

    public function setValues($Object) {
        $this->txtFileName->Text = '';
        $this->txtPath->Text = '';
        $this->txtCreatedDate->Text = '';
        $this->setCreatedDateTime();

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->FileName)) {
            $this->txtFileName->Text = $Object->FileName;
        }
        if (!is_null($Object->Path)) {
            $this->txtPath->Text = $Object->Path;
        }
        if (!is_null($Object->CreatedDate)) {
            $this->txtCreatedDate->Text = $Object->CreatedDate->format(DATE_TIME_FORMAT_HTML);
            $this->setCreatedDateTime($Object->CreatedDate);
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setCreatedDateTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstCreatedDateHours->SelectedIndex = 0;
            $this->lstCreatedDateMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstCreatedDateHours->SelectedValue = $time->format('H');
        $this->lstCreatedDateMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'FILENAME') {
            if (strlen($nameValue) > 0)
                $this->txtFileName->Name = $nameValue;
            $output = $withName ? $this->txtFileName->RenderWithName($blnPrintOutput):$this->txtFileName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PATH') {
            if (strlen($nameValue) > 0)
                $this->txtPath->Name = $nameValue;
            $output = $withName ? $this->txtPath->RenderWithName($blnPrintOutput):$this->txtPath->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'CREATEDDATE') {
            if (strlen($nameValue) > 0)
                $this->txtCreatedDate->Name = $nameValue;
            $output = $withName ? $this->txtCreatedDate->RenderWithName($blnPrintOutput):$this->txtCreatedDate->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'CREATEDDATETIME') {
            if ($withName) {
                $this->lstCreatedDateHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstCreatedDateHours->HtmlBefore = '';
            }
            $output = $this->lstCreatedDateHours->Render($blnPrintOutput);
            $output .= $this->lstCreatedDateMinutes->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('FILENAME',$withName);
        $this->renderControl('PATH',$withName);
        $this->renderControl('CREATEDDATE',$withName);
        $this->renderControl('CREATEDDATETIME',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('FileName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Path',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('CreatedDate',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('CreatedDateTIME',$withName, 'Time', false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtFileName->Visible = false;
        $this->txtPath->Visible = false;
        $this->txtCreatedDate->Visible = false;
        $this->lstCreatedDateHours->Visible = false;
        $this->lstCreatedDateMinutes->Visible = false;
    }

    public function showAll() {
        $this->txtFileName->Visible = true;
        $this->txtPath->Visible = true;
        $this->txtCreatedDate->Visible = true;
        $this->lstCreatedDateHours->Visible = true;
        $this->lstCreatedDateMinutes->Visible = true;
    }

    public function refreshAll() {
        $this->txtFileName->Refresh();
        $this->txtPath->Refresh();
        $this->txtCreatedDate->Refresh();
        $this->lstCreatedDateHours->Refresh();
        $this->lstCreatedDateMinutes->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'FILENAME':
                $this->txtFileName->Text = $value;
                break;
            case 'PATH':
                $this->txtPath->Text = $value;
                break;
            case 'CREATEDDATE':
                $this->txtCreatedDate->Text = $value;
                break;
            case 'CREATEDDATETIME':
                $this->setCreatedDateTime($value);
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
            case 'FILENAME':
                if ($this->txtFileName->Text)
                    return $this->txtFileName->Text;
                break;
            case 'PATH':
                if ($this->txtPath->Text)
                    return $this->txtPath->Text;
                break;
            case 'CREATEDDATE':
                if ($this->txtCreatedDate->Text)
                    return $this->txtCreatedDate->Text;
                break;
            case 'CREATEDDATETIME':
                return $this->lstCreatedDateHours->SelectedValue.':'.$this->lstCreatedDateMinutes->SelectedValue;
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
            case 'FILENAME':
                if ($this->txtFileName)
                    return $this->txtFileName->ControlId;
                break;
            case 'PATH':
                if ($this->txtPath)
                    return $this->txtPath->ControlId;
                break;
            case 'CREATEDDATE':
                if ($this->txtCreatedDate)
                    return $this->txtCreatedDate->ControlId;
                break;
            case 'CREATEDDATEHOURS':
                if ($this->lstCreatedDateHours)
                    return $this->lstCreatedDateHours->ControlId;
                break;
            case 'CREATEDDATEMINUTES':
                if ($this->lstCreatedDateMinutes)
                    return $this->lstCreatedDateMinutes->ControlId;
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
            case 'FILENAME':
                $this->txtFileName->Visible = false;
                $this->txtFileName->Refresh();
                break;
            case 'PATH':
                $this->txtPath->Visible = false;
                $this->txtPath->Refresh();
                break;
            case 'CREATEDDATE':
                $this->txtCreatedDate->Visible = false;
                $this->txtCreatedDate->Refresh();
                break;
            case 'CREATEDDATETIME':
                $this->lstCreatedDateHours->Visible = false;
                $this->lstCreatedDateMinutes->Visible = false;
                $this->lstCreatedDateHours->Refresh();
                $this->lstCreatedDateMinutes->Refresh();
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
            case 'FILENAME':
                $this->txtFileName->Visible = true;
                $this->txtFileName->Refresh();
                break;
            case 'PATH':
                $this->txtPath->Visible = true;
                $this->txtPath->Refresh();
                break;
            case 'CREATEDDATE':
                $this->txtCreatedDate->Visible = true;
                $this->txtCreatedDate->Refresh();
                break;
            case 'CREATEDDATETIME':
                $this->lstCreatedDateHours->Visible = true;
                $this->lstCreatedDateMinutes->Visible = true;
                $this->lstCreatedDateHours->Refresh();
                $this->lstCreatedDateMinutes->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtFileName->getJqControlId();
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
            $this->Object = new FileDocument();
        
        $this->Object->FileName = $this->txtFileName->Text;
        $this->Object->Path = $this->txtPath->Text;
        if (strlen($this->txtCreatedDate->Text) > 0) {
            if ($this->lstCreatedDateHours->SelectedIndex > 0)
                $this->Object->CreatedDate = new QDateTime($this->txtCreatedDate->Text.' '.$this->lstCreatedDateHours->SelectedValue.':'.$this->lstCreatedDateMinutes->SelectedValue);
            else
                $this->Object->CreatedDate = new QDateTime($this->txtCreatedDate->Text);
        }
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtFileName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPath);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtCreatedDate);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtFileName->WrapperCssClass = 'form-group';
            $this->txtFileName->Placeholder = '';
            $this->txtPath->WrapperCssClass = 'form-group';
            $this->txtPath->Placeholder = '';
            $this->txtCreatedDate->WrapperCssClass = 'form-group';
            $this->txtCreatedDate->Placeholder = '';
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
            $previousValues = FileDocument::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'FileName-> Value before: '.$previousValues->FileName.', Value after: '.$this->Object->FileName.'<br>
        Path-> Value before: '.$previousValues->Path.', Value after: '.$this->Object->Path.'<br>
        CreatedDate-> Value before: '.$previousValues->CreatedDate.', Value after: '.$this->Object->CreatedDate.'<br>
        ';
        } else {
        $changeText = 'FileName-> Value: '.$this->Object->FileName.'<br>
        Path-> Value: '.$this->Object->Path.'<br>
        CreatedDate-> Value: '.$this->Object->CreatedDate.'<br>
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
            $AuditLogEntry->ObjectName = 'FileDocument';
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
                $AuditLogEntry->ObjectName = 'FileDocument';
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