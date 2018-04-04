<?php
class BackgroundProcessController_Base {
    protected $Object;
    public $txtPId;
    public $txtUserId;
    public $txtUpdateDateTime;
    public $lstUpdateDateTimeHours,$lstUpdateDateTimeMinutes;
    public $lstStatus;
    public $txtSummary;
    public $txtStartDateTime;
    public $lstStartDateTimeHours,$lstStartDateTimeMinutes;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtPId = new QTextBox($objParentObject);
        $this->txtPId->Name = 'P Id';

        $this->txtUserId = new QTextBox($objParentObject);
        $this->txtUserId->Name = 'User Id';

        $this->txtUpdateDateTime = new QTextBox($objParentObject);
        $this->txtUpdateDateTime->Name = 'Update Date Time';
        $this->txtUpdateDateTime->CssClass = 'form-control input-date';

        $this->lstUpdateDateTimeHours = new QListBox($objParentObject);
        $this->lstUpdateDateTimeHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstUpdateDateTimeMinutes = new QListBox($objParentObject);
        $this->lstUpdateDateTimeMinutes->HtmlBefore = ' : ';
        $this->lstUpdateDateTimeMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstUpdateDateTimeHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstUpdateDateTimeHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstUpdateDateTimeMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstUpdateDateTimeMinutes->AddItem(new QListItem($display,$i));
        }
        
        $this->lstStatus = new QListBox($objParentObject);
        $this->lstStatus->Name = 'Status';
        $this->lstStatus->DisplayStyle = QDisplayStyle::Block;
        $this->lstStatus->AddCssClass('fullWidth');

        $this->txtSummary = new QTextBox($objParentObject);
        $this->txtSummary->Name = 'Summary';

        $this->txtStartDateTime = new QTextBox($objParentObject);
        $this->txtStartDateTime->Name = 'Start Date Time';
        $this->txtStartDateTime->CssClass = 'form-control input-date';

        $this->lstStartDateTimeHours = new QListBox($objParentObject);
        $this->lstStartDateTimeHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstStartDateTimeMinutes = new QListBox($objParentObject);
        $this->lstStartDateTimeMinutes->HtmlBefore = ' : ';
        $this->lstStartDateTimeMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstStartDateTimeHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstStartDateTimeHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstStartDateTimeMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstStartDateTimeMinutes->AddItem(new QListItem($display,$i));
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
        $this->txtPId->Text = '';
        $this->txtUserId->Text = '';
        $this->txtUpdateDateTime->Text = '';$this->setUpdateDateTimeTime();
        $this->lstStatus->RemoveAllItems();
        $this->lstStatus->AddItem(new QListItem('Pending','Pending'));
        $this->lstStatus->AddItem(new QListItem('Running','Running'));
        $this->lstStatus->AddItem(new QListItem('Completed Successfully','Completed Successfully'));
        $this->lstStatus->AddItem(new QListItem('Completed Failed','Completed Failed'));
        $this->lstStatus->AddItem(new QListItem('Completed Interrupted','Completed Interrupted'));
        
        $this->txtSummary->Text = '';
        $this->txtStartDateTime->Text = '';$this->setStartDateTimeTime();

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->PId) {
            $this->txtPId->Text = $Object->PId;
        }
        if ($Object->UserId) {
            $this->txtUserId->Text = $Object->UserId;
        }
        if ($Object->UpdateDateTime) {
            $this->txtUpdateDateTime->Text = $Object->UpdateDateTime->format(DATE_TIME_FORMAT_HTML);
            $this->setUpdateDateTimeTime($Object->UpdateDateTime);
        }
        if ($Object->Status) {
            $this->lstStatus->SelectedValue = $Object->Status;
        }
        if ($Object->Summary) {
            $this->txtSummary->Text = $Object->Summary;
        }
        if ($Object->StartDateTime) {
            $this->txtStartDateTime->Text = $Object->StartDateTime->format(DATE_TIME_FORMAT_HTML);
            $this->setStartDateTimeTime($Object->StartDateTime);
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setUpdateDateTimeTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstUpdateDateTimeHours->SelectedIndex = 0;
            $this->lstUpdateDateTimeMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstUpdateDateTimeHours->SelectedValue = $time->format('H');
        $this->lstUpdateDateTimeMinutes->SelectedValue = $time->format('i');
    }public function setStartDateTimeTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstStartDateTimeHours->SelectedIndex = 0;
            $this->lstStartDateTimeMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstStartDateTimeHours->SelectedValue = $time->format('H');
        $this->lstStartDateTimeMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'PID') {
            if (strlen($nameValue) > 0)
                $this->txtPId->Name = $nameValue;
            $output = $withName ? $this->txtPId->RenderWithName($blnPrintOutput):$this->txtPId->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'USERID') {
            if (strlen($nameValue) > 0)
                $this->txtUserId->Name = $nameValue;
            $output = $withName ? $this->txtUserId->RenderWithName($blnPrintOutput):$this->txtUserId->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'UPDATEDATETIME') {
            if (strlen($nameValue) > 0)
                $this->txtUpdateDateTime->Name = $nameValue;
            $output = $withName ? $this->txtUpdateDateTime->RenderWithName($blnPrintOutput):$this->txtUpdateDateTime->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'UPDATEDATETIMETIME') {
            if ($withName) {
                $this->lstUpdateDateTimeHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstUpdateDateTimeHours->HtmlBefore = '';
            }
            $output = $this->lstUpdateDateTimeHours->Render($blnPrintOutput);
            $output .= $this->lstUpdateDateTimeMinutes->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'STATUS') {
            if (strlen($nameValue) > 0)
                $this->lstStatus->Name = $nameValue;
            $output = $withName ? $this->lstStatus->RenderWithName($blnPrintOutput):$this->lstStatus->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'SUMMARY') {
            if (strlen($nameValue) > 0)
                $this->txtSummary->Name = $nameValue;
            $output = $withName ? $this->txtSummary->RenderWithName($blnPrintOutput):$this->txtSummary->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'STARTDATETIME') {
            if (strlen($nameValue) > 0)
                $this->txtStartDateTime->Name = $nameValue;
            $output = $withName ? $this->txtStartDateTime->RenderWithName($blnPrintOutput):$this->txtStartDateTime->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'STARTDATETIMETIME') {
            if ($withName) {
                $this->lstStartDateTimeHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstStartDateTimeHours->HtmlBefore = '';
            }
            $output = $this->lstStartDateTimeHours->Render($blnPrintOutput);
            $output .= $this->lstStartDateTimeMinutes->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('PID',$withName);
        $this->renderControl('USERID',$withName);
        $this->renderControl('UPDATEDATETIME',$withName);
        $this->renderControl('UPDATEDATETIMETIME',$withName);
        $this->renderControl('STATUS',$withName);
        $this->renderControl('SUMMARY',$withName);
        $this->renderControl('STARTDATETIME',$withName);
        $this->renderControl('STARTDATETIMETIME',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('PId',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('UserId',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('UpdateDateTime',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('UpdateDateTimeTIME',$withName, 'Time', false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Status',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Summary',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('StartDateTime',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('StartDateTimeTIME',$withName, 'Time', false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtPId->Visible = false;
        $this->txtUserId->Visible = false;
        $this->txtUpdateDateTime->Visible = false;
        $this->lstUpdateDateTimeHours->Visible = false;
        $this->lstUpdateDateTimeMinutes->Visible = false;
        $this->lstStatus->Visible = false;
        $this->txtSummary->Visible = false;
        $this->txtStartDateTime->Visible = false;
        $this->lstStartDateTimeHours->Visible = false;
        $this->lstStartDateTimeMinutes->Visible = false;
    }

    public function showAll() {
        $this->txtPId->Visible = true;
        $this->txtUserId->Visible = true;
        $this->txtUpdateDateTime->Visible = true;
        $this->lstUpdateDateTimeHours->Visible = true;
        $this->lstUpdateDateTimeMinutes->Visible = true;
        $this->lstStatus->Visible = true;
        $this->txtSummary->Visible = true;
        $this->txtStartDateTime->Visible = true;
        $this->lstStartDateTimeHours->Visible = true;
        $this->lstStartDateTimeMinutes->Visible = true;
    }

    public function refreshAll() {
        $this->txtPId->Refresh();
        $this->txtUserId->Refresh();
        $this->txtUpdateDateTime->Refresh();
        $this->lstUpdateDateTimeHours->Refresh();
        $this->lstUpdateDateTimeMinutes->Refresh();
        $this->lstStatus->Refresh();
        $this->txtSummary->Refresh();
        $this->txtStartDateTime->Refresh();
        $this->lstStartDateTimeHours->Refresh();
        $this->lstStartDateTimeMinutes->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'PID':
                $this->txtPId->Text = $value;
                break;
            case 'USERID':
                $this->txtUserId->Text = $value;
                break;
            case 'UPDATEDATETIME':
                $this->txtUpdateDateTime->Text = $value;
                break;
            case 'UPDATEDATETIMETIME':
                $this->setUpdateDateTimeTime($value);
                break;
            case 'STATUS':
                $this->lstStatus->SelectedValue = $value;
                break;
            case 'SUMMARY':
                $this->txtSummary->Text = $value;
                break;
            case 'STARTDATETIME':
                $this->txtStartDateTime->Text = $value;
                break;
            case 'STARTDATETIMETIME':
                $this->setStartDateTimeTime($value);
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
            case 'PID':
                if ($this->txtPId->Text)
                    return $this->txtPId->Text;
                break;
            case 'USERID':
                if ($this->txtUserId->Text)
                    return $this->txtUserId->Text;
                break;
            case 'UPDATEDATETIME':
                if ($this->txtUpdateDateTime->Text)
                    return $this->txtUpdateDateTime->Text;
                break;
            case 'UPDATEDATETIMETIME':
                return $this->lstUpdateDateTimeHours->SelectedValue.':'.$this->lstUpdateDateTimeMinutes->SelectedValue;
                break;
            case 'STATUS':
                if ($this->lstStatus->SelectedValue)
                    return $this->lstStatus->SelectedValue;
                break;
            case 'SUMMARY':
                if ($this->txtSummary->Text)
                    return $this->txtSummary->Text;
                break;
            case 'STARTDATETIME':
                if ($this->txtStartDateTime->Text)
                    return $this->txtStartDateTime->Text;
                break;
            case 'STARTDATETIMETIME':
                return $this->lstStartDateTimeHours->SelectedValue.':'.$this->lstStartDateTimeMinutes->SelectedValue;
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
            case 'PID':
                if ($this->txtPId)
                    return $this->txtPId->ControlId;
                break;
            case 'USERID':
                if ($this->txtUserId)
                    return $this->txtUserId->ControlId;
                break;
            case 'UPDATEDATETIME':
                if ($this->txtUpdateDateTime)
                    return $this->txtUpdateDateTime->ControlId;
                break;
            case 'UPDATEDATETIMEHOURS':
                if ($this->lstUpdateDateTimeHours)
                    return $this->lstUpdateDateTimeHours->ControlId;
                break;
            case 'UPDATEDATETIMEMINUTES':
                if ($this->lstUpdateDateTimeMinutes)
                    return $this->lstUpdateDateTimeMinutes->ControlId;
                break;
            case 'STATUS':
                if ($this->lstStatus)
                    return $this->lstStatus->ControlId;
                break;
            case 'SUMMARY':
                if ($this->txtSummary)
                    return $this->txtSummary->ControlId;
                break;
            case 'STARTDATETIME':
                if ($this->txtStartDateTime)
                    return $this->txtStartDateTime->ControlId;
                break;
            case 'STARTDATETIMEHOURS':
                if ($this->lstStartDateTimeHours)
                    return $this->lstStartDateTimeHours->ControlId;
                break;
            case 'STARTDATETIMEMINUTES':
                if ($this->lstStartDateTimeMinutes)
                    return $this->lstStartDateTimeMinutes->ControlId;
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
            case 'PID':
                $this->txtPId->Visible = false;
                $this->txtPId->Refresh();
                break;
            case 'USERID':
                $this->txtUserId->Visible = false;
                $this->txtUserId->Refresh();
                break;
            case 'UPDATEDATETIME':
                $this->txtUpdateDateTime->Visible = false;
                $this->txtUpdateDateTime->Refresh();
                break;
            case 'UPDATEDATETIMETIME':
                $this->lstUpdateDateTimeHours->Visible = false;
                $this->lstUpdateDateTimeMinutes->Visible = false;
                $this->lstUpdateDateTimeHours->Refresh();
                $this->lstUpdateDateTimeMinutes->Refresh();
                break;
            case 'STATUS':
                $this->lstStatus->Visible = false;
                $this->lstStatus->Refresh();
                break;
            case 'SUMMARY':
                $this->txtSummary->Visible = false;
                $this->txtSummary->Refresh();
                break;
            case 'STARTDATETIME':
                $this->txtStartDateTime->Visible = false;
                $this->txtStartDateTime->Refresh();
                break;
            case 'STARTDATETIMETIME':
                $this->lstStartDateTimeHours->Visible = false;
                $this->lstStartDateTimeMinutes->Visible = false;
                $this->lstStartDateTimeHours->Refresh();
                $this->lstStartDateTimeMinutes->Refresh();
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
            case 'PID':
                $this->txtPId->Visible = true;
                $this->txtPId->Refresh();
                break;
            case 'USERID':
                $this->txtUserId->Visible = true;
                $this->txtUserId->Refresh();
                break;
            case 'UPDATEDATETIME':
                $this->txtUpdateDateTime->Visible = true;
                $this->txtUpdateDateTime->Refresh();
                break;
            case 'UPDATEDATETIMETIME':
                $this->lstUpdateDateTimeHours->Visible = true;
                $this->lstUpdateDateTimeMinutes->Visible = true;
                $this->lstUpdateDateTimeHours->Refresh();
                $this->lstUpdateDateTimeMinutes->Refresh();
                break;
            case 'STATUS':
                $this->lstStatus->Visible = true;
                $this->lstStatus->Refresh();
                break;
            case 'SUMMARY':
                $this->txtSummary->Visible = true;
                $this->txtSummary->Refresh();
                break;
            case 'STARTDATETIME':
                $this->txtStartDateTime->Visible = true;
                $this->txtStartDateTime->Refresh();
                break;
            case 'STARTDATETIMETIME':
                $this->lstStartDateTimeHours->Visible = true;
                $this->lstStartDateTimeMinutes->Visible = true;
                $this->lstStartDateTimeHours->Refresh();
                $this->lstStartDateTimeMinutes->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtPId->getJqControlId();
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
            $this->Object = new BackgroundProcess();
        
        $this->Object->PId = $this->txtPId->Text;
        $this->Object->UserId = $this->txtUserId->Text;
        if (strlen($this->txtUpdateDateTime->Text) > 0) {
            if ($this->lstUpdateDateTimeHours->SelectedIndex > 0)
                $this->Object->UpdateDateTime = new QDateTime($this->txtUpdateDateTime->Text.' '.$this->lstUpdateDateTimeHours->SelectedValue.':'.$this->lstUpdateDateTimeMinutes->SelectedValue);
            else
                $this->Object->UpdateDateTime = new QDateTime($this->txtUpdateDateTime->Text);
        }
        $this->Object->Status = $this->lstStatus->SelectedValue;
        $this->Object->Summary = $this->txtSummary->Text;
        if (strlen($this->txtStartDateTime->Text) > 0) {
            if ($this->lstStartDateTimeHours->SelectedIndex > 0)
                $this->Object->StartDateTime = new QDateTime($this->txtStartDateTime->Text.' '.$this->lstStartDateTimeHours->SelectedValue.':'.$this->lstStartDateTimeMinutes->SelectedValue);
            else
                $this->Object->StartDateTime = new QDateTime($this->txtStartDateTime->Text);
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPId);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtUserId);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtUpdateDateTime);
        // Example of validating a field as required
        //AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(''.$this->txtUsername->getJqControlId().'')');
        /*if (!$this->lstStatus->SelectedValue){
            AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(''.$this->txtUsername->getJqControlId().'','Required')');
            $hasNoErrors = false;
        }*/
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtSummary);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtStartDateTime);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtPId->WrapperCssClass = 'form-group';
            $this->txtPId->Placeholder = '';
            $this->txtUserId->WrapperCssClass = 'form-group';
            $this->txtUserId->Placeholder = '';
            $this->txtUpdateDateTime->WrapperCssClass = 'form-group';
            $this->txtUpdateDateTime->Placeholder = '';
            $this->lstStatus->WrapperCssClass = 'form-group';
            $this->txtSummary->WrapperCssClass = 'form-group';
            $this->txtSummary->Placeholder = '';
            $this->txtStartDateTime->WrapperCssClass = 'form-group';
            $this->txtStartDateTime->Placeholder = '';
        $js = AppSpecificFunctions::GetDatePickerInitJs();
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    public function saveWithAudit() {
        try {
            $this->Object->Save();
            return true;
        } catch(QCallerException $e) {
            AppSpecificFunctions::AddCustomLog('Could not save object. Error: '.$e->getMessage());
            return false;
        }
        //This is the OLD method that is to be removed. Keeping it here for reference for the next few minor versions of sDev
        //sDev Version as of this comment: 1.4.1
        /*
        if ($this->Object)
            $previousValues = BackgroundProcess::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'PId-> Value before: '.$previousValues->PId.', Value after: '.$this->Object->PId.'<br>
        UserId-> Value before: '.$previousValues->UserId.', Value after: '.$this->Object->UserId.'<br>
        UpdateDateTime-> Value before: '.$previousValues->UpdateDateTime.', Value after: '.$this->Object->UpdateDateTime.'<br>
        Status-> Value before: '.$previousValues->Status.', Value after: '.$this->Object->Status.'<br>
        Summary-> Value before: '.$previousValues->Summary.', Value after: '.$this->Object->Summary.'<br>
        StartDateTime-> Value before: '.$previousValues->StartDateTime.', Value after: '.$this->Object->StartDateTime.'<br>
        ';
        } else {
        $changeText = 'PId-> Value: '.$this->Object->PId.'<br>
        UserId-> Value: '.$this->Object->UserId.'<br>
        UpdateDateTime-> Value: '.$this->Object->UpdateDateTime.'<br>
        Status-> Value: '.$this->Object->Status.'<br>
        Summary-> Value: '.$this->Object->Summary.'<br>
        StartDateTime-> Value: '.$this->Object->StartDateTime.'<br>
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
            $AuditLogEntry->ObjectName = 'BackgroundProcess';
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
                $AuditLogEntry->ObjectName = 'BackgroundProcess';
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