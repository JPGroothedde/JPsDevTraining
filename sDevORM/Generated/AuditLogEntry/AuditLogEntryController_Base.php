<?php
class AuditLogEntryController_Base {
    protected $Object;
    public $txtEntryTimeStamp;
    public $lstEntryTimeStampHours,$lstEntryTimeStampMinutes;
    public $txtObjectName;
    public $txtModificationType;
    public $txtUserEmail;
    public $txtObjectId;
    public $txtAuditLogEntryDetail;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtEntryTimeStamp = new QTextBox($objParentObject);
        $this->txtEntryTimeStamp->Name = 'Entry Time Stamp';
        $this->txtEntryTimeStamp->CssClass = 'form-control input-date';

        $this->lstEntryTimeStampHours = new QListBox($objParentObject);
        $this->lstEntryTimeStampHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstEntryTimeStampMinutes = new QListBox($objParentObject);
        $this->lstEntryTimeStampMinutes->HtmlBefore = ' : ';
        $this->lstEntryTimeStampMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstEntryTimeStampHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstEntryTimeStampHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstEntryTimeStampMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstEntryTimeStampMinutes->AddItem(new QListItem($display,$i));
        }
        
        $this->txtObjectName = new QTextBox($objParentObject);
        $this->txtObjectName->Name = 'Object Name';

        $this->txtModificationType = new QTextBox($objParentObject);
        $this->txtModificationType->Name = 'Modification Type';

        $this->txtUserEmail = new QTextBox($objParentObject);
        $this->txtUserEmail->Name = 'User Email';

        $this->txtObjectId = new QTextBox($objParentObject);
        $this->txtObjectId->Name = 'Object Id';

        $this->txtAuditLogEntryDetail = new QTextBox($objParentObject);
        $this->txtAuditLogEntryDetail->Name = 'Audit Log Entry Detail';

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
        $this->txtEntryTimeStamp->Text = '';
        $this->setEntryTimeStampTime();
        $this->txtObjectName->Text = '';
        $this->txtModificationType->Text = '';
        $this->txtUserEmail->Text = '';
        $this->txtObjectId->Text = '';
        $this->txtAuditLogEntryDetail->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->EntryTimeStamp)) {
            $this->txtEntryTimeStamp->Text = $Object->EntryTimeStamp->format(DATE_TIME_FORMAT_HTML);
            $this->setEntryTimeStampTime($Object->EntryTimeStamp);
        }
        if (!is_null($Object->ObjectName)) {
            $this->txtObjectName->Text = $Object->ObjectName;
        }
        if (!is_null($Object->ModificationType)) {
            $this->txtModificationType->Text = $Object->ModificationType;
        }
        if (!is_null($Object->UserEmail)) {
            $this->txtUserEmail->Text = $Object->UserEmail;
        }
        if (!is_null($Object->ObjectId)) {
            $this->txtObjectId->Text = $Object->ObjectId;
        }
        if (!is_null($Object->AuditLogEntryDetail)) {
            $this->txtAuditLogEntryDetail->Text = $Object->AuditLogEntryDetail;
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setEntryTimeStampTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstEntryTimeStampHours->SelectedIndex = 0;
            $this->lstEntryTimeStampMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstEntryTimeStampHours->SelectedValue = $time->format('H');
        $this->lstEntryTimeStampMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'ENTRYTIMESTAMP') {
            if (strlen($nameValue) > 0)
                $this->txtEntryTimeStamp->Name = $nameValue;
            $output = $withName ? $this->txtEntryTimeStamp->RenderWithName($blnPrintOutput):$this->txtEntryTimeStamp->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ENTRYTIMESTAMPTIME') {
            if ($withName) {
                $this->lstEntryTimeStampHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstEntryTimeStampHours->HtmlBefore = '';
            }
            $output = $this->lstEntryTimeStampHours->Render($blnPrintOutput);
            $output .= $this->lstEntryTimeStampMinutes->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'OBJECTNAME') {
            if (strlen($nameValue) > 0)
                $this->txtObjectName->Name = $nameValue;
            $output = $withName ? $this->txtObjectName->RenderWithName($blnPrintOutput):$this->txtObjectName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'MODIFICATIONTYPE') {
            if (strlen($nameValue) > 0)
                $this->txtModificationType->Name = $nameValue;
            $output = $withName ? $this->txtModificationType->RenderWithName($blnPrintOutput):$this->txtModificationType->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'USEREMAIL') {
            if (strlen($nameValue) > 0)
                $this->txtUserEmail->Name = $nameValue;
            $output = $withName ? $this->txtUserEmail->RenderWithName($blnPrintOutput):$this->txtUserEmail->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'OBJECTID') {
            if (strlen($nameValue) > 0)
                $this->txtObjectId->Name = $nameValue;
            $output = $withName ? $this->txtObjectId->RenderWithName($blnPrintOutput):$this->txtObjectId->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'AUDITLOGENTRYDETAIL') {
            if (strlen($nameValue) > 0)
                $this->txtAuditLogEntryDetail->Name = $nameValue;
            $output = $withName ? $this->txtAuditLogEntryDetail->RenderWithName($blnPrintOutput):$this->txtAuditLogEntryDetail->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('ENTRYTIMESTAMP',$withName);
        $this->renderControl('ENTRYTIMESTAMPTIME',$withName);
        $this->renderControl('OBJECTNAME',$withName);
        $this->renderControl('MODIFICATIONTYPE',$withName);
        $this->renderControl('USEREMAIL',$withName);
        $this->renderControl('OBJECTID',$withName);
        $this->renderControl('AUDITLOGENTRYDETAIL',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('EntryTimeStamp',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('EntryTimeStampTIME',$withName, 'Time', false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('ObjectName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('ModificationType',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('UserEmail',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('ObjectId',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('AuditLogEntryDetail',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtEntryTimeStamp->Visible = false;
        $this->lstEntryTimeStampHours->Visible = false;
        $this->lstEntryTimeStampMinutes->Visible = false;
        $this->txtObjectName->Visible = false;
        $this->txtModificationType->Visible = false;
        $this->txtUserEmail->Visible = false;
        $this->txtObjectId->Visible = false;
        $this->txtAuditLogEntryDetail->Visible = false;
    }

    public function showAll() {
        $this->txtEntryTimeStamp->Visible = true;
        $this->lstEntryTimeStampHours->Visible = true;
        $this->lstEntryTimeStampMinutes->Visible = true;
        $this->txtObjectName->Visible = true;
        $this->txtModificationType->Visible = true;
        $this->txtUserEmail->Visible = true;
        $this->txtObjectId->Visible = true;
        $this->txtAuditLogEntryDetail->Visible = true;
    }

    public function refreshAll() {
        $this->txtEntryTimeStamp->Refresh();
        $this->lstEntryTimeStampHours->Refresh();
        $this->lstEntryTimeStampMinutes->Refresh();
        $this->txtObjectName->Refresh();
        $this->txtModificationType->Refresh();
        $this->txtUserEmail->Refresh();
        $this->txtObjectId->Refresh();
        $this->txtAuditLogEntryDetail->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'ENTRYTIMESTAMP':
                $this->txtEntryTimeStamp->Text = $value;
                break;
            case 'ENTRYTIMESTAMPTIME':
                $this->setEntryTimeStampTime($value);
                break;
            case 'OBJECTNAME':
                $this->txtObjectName->Text = $value;
                break;
            case 'MODIFICATIONTYPE':
                $this->txtModificationType->Text = $value;
                break;
            case 'USEREMAIL':
                $this->txtUserEmail->Text = $value;
                break;
            case 'OBJECTID':
                $this->txtObjectId->Text = $value;
                break;
            case 'AUDITLOGENTRYDETAIL':
                $this->txtAuditLogEntryDetail->Text = $value;
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
            case 'ENTRYTIMESTAMP':
                if ($this->txtEntryTimeStamp->Text)
                    return $this->txtEntryTimeStamp->Text;
                break;
            case 'ENTRYTIMESTAMPTIME':
                return $this->lstEntryTimeStampHours->SelectedValue.':'.$this->lstEntryTimeStampMinutes->SelectedValue;
                break;
            case 'OBJECTNAME':
                if ($this->txtObjectName->Text)
                    return $this->txtObjectName->Text;
                break;
            case 'MODIFICATIONTYPE':
                if ($this->txtModificationType->Text)
                    return $this->txtModificationType->Text;
                break;
            case 'USEREMAIL':
                if ($this->txtUserEmail->Text)
                    return $this->txtUserEmail->Text;
                break;
            case 'OBJECTID':
                if ($this->txtObjectId->Text)
                    return $this->txtObjectId->Text;
                break;
            case 'AUDITLOGENTRYDETAIL':
                if ($this->txtAuditLogEntryDetail->Text)
                    return $this->txtAuditLogEntryDetail->Text;
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
            case 'ENTRYTIMESTAMP':
                if ($this->txtEntryTimeStamp)
                    return $this->txtEntryTimeStamp->ControlId;
                break;
            case 'ENTRYTIMESTAMPHOURS':
                if ($this->lstEntryTimeStampHours)
                    return $this->lstEntryTimeStampHours->ControlId;
                break;
            case 'ENTRYTIMESTAMPMINUTES':
                if ($this->lstEntryTimeStampMinutes)
                    return $this->lstEntryTimeStampMinutes->ControlId;
                break;
            case 'OBJECTNAME':
                if ($this->txtObjectName)
                    return $this->txtObjectName->ControlId;
                break;
            case 'MODIFICATIONTYPE':
                if ($this->txtModificationType)
                    return $this->txtModificationType->ControlId;
                break;
            case 'USEREMAIL':
                if ($this->txtUserEmail)
                    return $this->txtUserEmail->ControlId;
                break;
            case 'OBJECTID':
                if ($this->txtObjectId)
                    return $this->txtObjectId->ControlId;
                break;
            case 'AUDITLOGENTRYDETAIL':
                if ($this->txtAuditLogEntryDetail)
                    return $this->txtAuditLogEntryDetail->ControlId;
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
            case 'ENTRYTIMESTAMP':
                $this->txtEntryTimeStamp->Visible = false;
                $this->txtEntryTimeStamp->Refresh();
                break;
            case 'ENTRYTIMESTAMPTIME':
                $this->lstEntryTimeStampHours->Visible = false;
                $this->lstEntryTimeStampMinutes->Visible = false;
                $this->lstEntryTimeStampHours->Refresh();
                $this->lstEntryTimeStampMinutes->Refresh();
                break;
            case 'OBJECTNAME':
                $this->txtObjectName->Visible = false;
                $this->txtObjectName->Refresh();
                break;
            case 'MODIFICATIONTYPE':
                $this->txtModificationType->Visible = false;
                $this->txtModificationType->Refresh();
                break;
            case 'USEREMAIL':
                $this->txtUserEmail->Visible = false;
                $this->txtUserEmail->Refresh();
                break;
            case 'OBJECTID':
                $this->txtObjectId->Visible = false;
                $this->txtObjectId->Refresh();
                break;
            case 'AUDITLOGENTRYDETAIL':
                $this->txtAuditLogEntryDetail->Visible = false;
                $this->txtAuditLogEntryDetail->Refresh();
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
            case 'ENTRYTIMESTAMP':
                $this->txtEntryTimeStamp->Visible = true;
                $this->txtEntryTimeStamp->Refresh();
                break;
            case 'ENTRYTIMESTAMPTIME':
                $this->lstEntryTimeStampHours->Visible = true;
                $this->lstEntryTimeStampMinutes->Visible = true;
                $this->lstEntryTimeStampHours->Refresh();
                $this->lstEntryTimeStampMinutes->Refresh();
                break;
            case 'OBJECTNAME':
                $this->txtObjectName->Visible = true;
                $this->txtObjectName->Refresh();
                break;
            case 'MODIFICATIONTYPE':
                $this->txtModificationType->Visible = true;
                $this->txtModificationType->Refresh();
                break;
            case 'USEREMAIL':
                $this->txtUserEmail->Visible = true;
                $this->txtUserEmail->Refresh();
                break;
            case 'OBJECTID':
                $this->txtObjectId->Visible = true;
                $this->txtObjectId->Refresh();
                break;
            case 'AUDITLOGENTRYDETAIL':
                $this->txtAuditLogEntryDetail->Visible = true;
                $this->txtAuditLogEntryDetail->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtEntryTimeStamp->getJqControlId();
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
            $this->Object = new AuditLogEntry();
        
        if (strlen($this->txtEntryTimeStamp->Text) > 0) {
            if ($this->lstEntryTimeStampHours->SelectedIndex > 0)
                $this->Object->EntryTimeStamp = new QDateTime($this->txtEntryTimeStamp->Text.' '.$this->lstEntryTimeStampHours->SelectedValue.':'.$this->lstEntryTimeStampMinutes->SelectedValue);
            else
                $this->Object->EntryTimeStamp = new QDateTime($this->txtEntryTimeStamp->Text);
        }
        $this->Object->ObjectName = $this->txtObjectName->Text;
        $this->Object->ModificationType = $this->txtModificationType->Text;
        $this->Object->UserEmail = $this->txtUserEmail->Text;
        $this->Object->ObjectId = $this->txtObjectId->Text;
        $this->Object->AuditLogEntryDetail = $this->txtAuditLogEntryDetail->Text;
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtEntryTimeStamp);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtObjectName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtModificationType);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtUserEmail);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtObjectId);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtAuditLogEntryDetail);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtEntryTimeStamp->WrapperCssClass = 'form-group';
            $this->txtEntryTimeStamp->Placeholder = '';
            $this->txtObjectName->WrapperCssClass = 'form-group';
            $this->txtObjectName->Placeholder = '';
            $this->txtModificationType->WrapperCssClass = 'form-group';
            $this->txtModificationType->Placeholder = '';
            $this->txtUserEmail->WrapperCssClass = 'form-group';
            $this->txtUserEmail->Placeholder = '';
            $this->txtObjectId->WrapperCssClass = 'form-group';
            $this->txtObjectId->Placeholder = '';
            $this->txtAuditLogEntryDetail->WrapperCssClass = 'form-group';
            $this->txtAuditLogEntryDetail->Placeholder = '';
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
            $previousValues = AuditLogEntry::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'EntryTimeStamp-> Value before: '.$previousValues->EntryTimeStamp.', Value after: '.$this->Object->EntryTimeStamp.'<br>
        ObjectName-> Value before: '.$previousValues->ObjectName.', Value after: '.$this->Object->ObjectName.'<br>
        ModificationType-> Value before: '.$previousValues->ModificationType.', Value after: '.$this->Object->ModificationType.'<br>
        UserEmail-> Value before: '.$previousValues->UserEmail.', Value after: '.$this->Object->UserEmail.'<br>
        ObjectId-> Value before: '.$previousValues->ObjectId.', Value after: '.$this->Object->ObjectId.'<br>
        AuditLogEntryDetail-> Value before: '.$previousValues->AuditLogEntryDetail.', Value after: '.$this->Object->AuditLogEntryDetail.'<br>
        ';
        } else {
        $changeText = 'EntryTimeStamp-> Value: '.$this->Object->EntryTimeStamp.'<br>
        ObjectName-> Value: '.$this->Object->ObjectName.'<br>
        ModificationType-> Value: '.$this->Object->ModificationType.'<br>
        UserEmail-> Value: '.$this->Object->UserEmail.'<br>
        ObjectId-> Value: '.$this->Object->ObjectId.'<br>
        AuditLogEntryDetail-> Value: '.$this->Object->AuditLogEntryDetail.'<br>
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
            $AuditLogEntry->ObjectName = 'AuditLogEntry';
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
                $AuditLogEntry->ObjectName = 'AuditLogEntry';
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