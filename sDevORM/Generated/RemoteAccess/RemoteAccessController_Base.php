<?php
class RemoteAccessController_Base {
    protected $Object;
    public $txtIpAddress;
    public $txtAccessDateTime;
    public $lstAccessDateTimeHours,$lstAccessDateTimeMinutes;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtIpAddress = new QTextBox($objParentObject);
        $this->txtIpAddress->Name = 'Ip Address';

        $this->txtAccessDateTime = new QTextBox($objParentObject);
        $this->txtAccessDateTime->Name = 'Access Date Time';
        $this->txtAccessDateTime->CssClass = 'form-control input-date';

        $this->lstAccessDateTimeHours = new QListBox($objParentObject);
        $this->lstAccessDateTimeHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstAccessDateTimeMinutes = new QListBox($objParentObject);
        $this->lstAccessDateTimeMinutes->HtmlBefore = ' : ';
        $this->lstAccessDateTimeMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstAccessDateTimeHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstAccessDateTimeHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstAccessDateTimeMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstAccessDateTimeMinutes->AddItem(new QListItem($display,$i));
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
        $this->txtIpAddress->Text = '';
        $this->txtAccessDateTime->Text = '';$this->setAccessDateTimeTime();

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->IpAddress) {
            $this->txtIpAddress->Text = $Object->IpAddress;
        }
        if ($Object->AccessDateTime) {
            $this->txtAccessDateTime->Text = $Object->AccessDateTime->format(DATE_TIME_FORMAT_HTML);
            $this->setAccessDateTimeTime($Object->AccessDateTime);
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setAccessDateTimeTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstAccessDateTimeHours->SelectedIndex = 0;
            $this->lstAccessDateTimeMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstAccessDateTimeHours->SelectedValue = $time->format('H');
        $this->lstAccessDateTimeMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'IPADDRESS') {
            if (strlen($nameValue) > 0)
                $this->txtIpAddress->Name = $nameValue;
            $output = $withName ? $this->txtIpAddress->RenderWithName($blnPrintOutput):$this->txtIpAddress->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ACCESSDATETIME') {
            if (strlen($nameValue) > 0)
                $this->txtAccessDateTime->Name = $nameValue;
            $output = $withName ? $this->txtAccessDateTime->RenderWithName($blnPrintOutput):$this->txtAccessDateTime->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ACCESSDATETIMETIME') {
            if ($withName) {
                $this->lstAccessDateTimeHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstAccessDateTimeHours->HtmlBefore = '';
            }
            $output = $this->lstAccessDateTimeHours->Render($blnPrintOutput);
            $output .= $this->lstAccessDateTimeMinutes->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('IPADDRESS',$withName);
        $this->renderControl('ACCESSDATETIME',$withName);
        $this->renderControl('ACCESSDATETIMETIME',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('IpAddress',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('AccessDateTime',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('AccessDateTimeTIME',$withName, 'Time', false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtIpAddress->Visible = false;
        $this->txtAccessDateTime->Visible = false;
        $this->lstAccessDateTimeHours->Visible = false;
        $this->lstAccessDateTimeMinutes->Visible = false;
    }

    public function showAll() {
        $this->txtIpAddress->Visible = true;
        $this->txtAccessDateTime->Visible = true;
        $this->lstAccessDateTimeHours->Visible = true;
        $this->lstAccessDateTimeMinutes->Visible = true;
    }

    public function refreshAll() {
        $this->txtIpAddress->Refresh();
        $this->txtAccessDateTime->Refresh();
        $this->lstAccessDateTimeHours->Refresh();
        $this->lstAccessDateTimeMinutes->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'IPADDRESS':
                $this->txtIpAddress->Text = $value;
                break;
            case 'ACCESSDATETIME':
                $this->txtAccessDateTime->Text = $value;
                break;
            case 'ACCESSDATETIMETIME':
                $this->setAccessDateTimeTime($value);
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
            case 'IPADDRESS':
                if ($this->txtIpAddress->Text)
                    return $this->txtIpAddress->Text;
                break;
            case 'ACCESSDATETIME':
                if ($this->txtAccessDateTime->Text)
                    return $this->txtAccessDateTime->Text;
                break;
            case 'ACCESSDATETIMETIME':
                return $this->lstAccessDateTimeHours->SelectedValue.':'.$this->lstAccessDateTimeMinutes->SelectedValue;
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
            case 'IPADDRESS':
                if ($this->txtIpAddress)
                    return $this->txtIpAddress->ControlId;
                break;
            case 'ACCESSDATETIME':
                if ($this->txtAccessDateTime)
                    return $this->txtAccessDateTime->ControlId;
                break;
            case 'ACCESSDATETIMEHOURS':
                if ($this->lstAccessDateTimeHours)
                    return $this->lstAccessDateTimeHours->ControlId;
                break;
            case 'ACCESSDATETIMEMINUTES':
                if ($this->lstAccessDateTimeMinutes)
                    return $this->lstAccessDateTimeMinutes->ControlId;
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
            case 'IPADDRESS':
                $this->txtIpAddress->Visible = false;
                $this->txtIpAddress->Refresh();
                break;
            case 'ACCESSDATETIME':
                $this->txtAccessDateTime->Visible = false;
                $this->txtAccessDateTime->Refresh();
                break;
            case 'ACCESSDATETIMETIME':
                $this->lstAccessDateTimeHours->Visible = false;
                $this->lstAccessDateTimeMinutes->Visible = false;
                $this->lstAccessDateTimeHours->Refresh();
                $this->lstAccessDateTimeMinutes->Refresh();
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
            case 'IPADDRESS':
                $this->txtIpAddress->Visible = true;
                $this->txtIpAddress->Refresh();
                break;
            case 'ACCESSDATETIME':
                $this->txtAccessDateTime->Visible = true;
                $this->txtAccessDateTime->Refresh();
                break;
            case 'ACCESSDATETIMETIME':
                $this->lstAccessDateTimeHours->Visible = true;
                $this->lstAccessDateTimeMinutes->Visible = true;
                $this->lstAccessDateTimeHours->Refresh();
                $this->lstAccessDateTimeMinutes->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtIpAddress->getJqControlId();
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
            $this->Object = new RemoteAccess();
        
        $this->Object->IpAddress = $this->txtIpAddress->Text;
        if (strlen($this->txtAccessDateTime->Text) > 0) {
            if ($this->lstAccessDateTimeHours->SelectedIndex > 0)
                $this->Object->AccessDateTime = new QDateTime($this->txtAccessDateTime->Text.' '.$this->lstAccessDateTimeHours->SelectedValue.':'.$this->lstAccessDateTimeMinutes->SelectedValue);
            else
                $this->Object->AccessDateTime = new QDateTime($this->txtAccessDateTime->Text);
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtIpAddress);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtAccessDateTime);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtIpAddress->WrapperCssClass = 'form-group';
            $this->txtIpAddress->Placeholder = '';
            $this->txtAccessDateTime->WrapperCssClass = 'form-group';
            $this->txtAccessDateTime->Placeholder = '';
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
            $previousValues = RemoteAccess::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'IpAddress-> Value before: '.$previousValues->IpAddress.', Value after: '.$this->Object->IpAddress.'<br>
        AccessDateTime-> Value before: '.$previousValues->AccessDateTime.', Value after: '.$this->Object->AccessDateTime.'<br>
        ';
        } else {
        $changeText = 'IpAddress-> Value: '.$this->Object->IpAddress.'<br>
        AccessDateTime-> Value: '.$this->Object->AccessDateTime.'<br>
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
            $AuditLogEntry->ObjectName = 'RemoteAccess';
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
                $AuditLogEntry->ObjectName = 'RemoteAccess';
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