<?php
class PageViewController_Base {
    protected $Object;
    public $txtTimeStamped;
    public $lstTimeStampedHours,$lstTimeStampedMinutes;
    public $txtIPAddress;
    public $txtPageDetails;
    public $txtUserAgentDetails;
    public $txtUserRole;
    public $txtUsername;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtTimeStamped = new QTextBox($objParentObject);
        $this->txtTimeStamped->Name = 'Time Stamped';
        $this->txtTimeStamped->CssClass = 'form-control input-date';

        $this->lstTimeStampedHours = new QListBox($objParentObject);
        $this->lstTimeStampedHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstTimeStampedMinutes = new QListBox($objParentObject);
        $this->lstTimeStampedMinutes->HtmlBefore = ' : ';
        $this->lstTimeStampedMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstTimeStampedHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstTimeStampedHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstTimeStampedMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstTimeStampedMinutes->AddItem(new QListItem($display,$i));
        }
        
        $this->txtIPAddress = new QTextBox($objParentObject);
        $this->txtIPAddress->Name = 'IP Address';

        $this->txtPageDetails = new QTextBox($objParentObject);
        $this->txtPageDetails->Name = 'Page Details';

        $this->txtUserAgentDetails = new QTextBox($objParentObject);
        $this->txtUserAgentDetails->Name = 'User Agent Details';

        $this->txtUserRole = new QTextBox($objParentObject);
        $this->txtUserRole->Name = 'User Role';

        $this->txtUsername = new QTextBox($objParentObject);
        $this->txtUsername->Name = 'Username';

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
        $this->txtTimeStamped->Text = '';$this->setTimeStampedTime();
        $this->txtIPAddress->Text = '';
        $this->txtPageDetails->Text = '';
        $this->txtUserAgentDetails->Text = '';
        $this->txtUserRole->Text = '';
        $this->txtUsername->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->TimeStamped) {
            $this->txtTimeStamped->Text = $Object->TimeStamped->format(DATE_TIME_FORMAT_HTML);
            $this->setTimeStampedTime($Object->TimeStamped);
        }
        if ($Object->IPAddress) {
            $this->txtIPAddress->Text = $Object->IPAddress;
        }
        if ($Object->PageDetails) {
            $this->txtPageDetails->Text = $Object->PageDetails;
        }
        if ($Object->UserAgentDetails) {
            $this->txtUserAgentDetails->Text = $Object->UserAgentDetails;
        }
        if ($Object->UserRole) {
            $this->txtUserRole->Text = $Object->UserRole;
        }
        if ($Object->Username) {
            $this->txtUsername->Text = $Object->Username;
        }
        

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setTimeStampedTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstTimeStampedHours->SelectedIndex = 0;
            $this->lstTimeStampedMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstTimeStampedHours->SelectedValue = $time->format('H');
        $this->lstTimeStampedMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'TIMESTAMPED') {
            if (strlen($nameValue) > 0)
                $this->txtTimeStamped->Name = $nameValue;
            $output = $withName ? $this->txtTimeStamped->RenderWithName($blnPrintOutput):$this->txtTimeStamped->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'TIMESTAMPEDTIME') {
            if ($withName) {
                $this->lstTimeStampedHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstTimeStampedHours->HtmlBefore = '';
            }
            $output = $this->lstTimeStampedHours->Render($blnPrintOutput);
            $output .= $this->lstTimeStampedMinutes->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'IPADDRESS') {
            if (strlen($nameValue) > 0)
                $this->txtIPAddress->Name = $nameValue;
            $output = $withName ? $this->txtIPAddress->RenderWithName($blnPrintOutput):$this->txtIPAddress->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PAGEDETAILS') {
            if (strlen($nameValue) > 0)
                $this->txtPageDetails->Name = $nameValue;
            $output = $withName ? $this->txtPageDetails->RenderWithName($blnPrintOutput):$this->txtPageDetails->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'USERAGENTDETAILS') {
            if (strlen($nameValue) > 0)
                $this->txtUserAgentDetails->Name = $nameValue;
            $output = $withName ? $this->txtUserAgentDetails->RenderWithName($blnPrintOutput):$this->txtUserAgentDetails->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'USERROLE') {
            if (strlen($nameValue) > 0)
                $this->txtUserRole->Name = $nameValue;
            $output = $withName ? $this->txtUserRole->RenderWithName($blnPrintOutput):$this->txtUserRole->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'USERNAME') {
            if (strlen($nameValue) > 0)
                $this->txtUsername->Name = $nameValue;
            $output = $withName ? $this->txtUsername->RenderWithName($blnPrintOutput):$this->txtUsername->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('TIMESTAMPED',$withName);
        $this->renderControl('TIMESTAMPEDTIME',$withName);
        $this->renderControl('IPADDRESS',$withName);
        $this->renderControl('PAGEDETAILS',$withName);
        $this->renderControl('USERAGENTDETAILS',$withName);
        $this->renderControl('USERROLE',$withName);
        $this->renderControl('USERNAME',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('TimeStamped',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('TimeStampedTIME',$withName, 'Time', false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('IPAddress',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('PageDetails',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('UserAgentDetails',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('UserRole',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Username',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtTimeStamped->Visible = false;
        $this->lstTimeStampedHours->Visible = false;
        $this->lstTimeStampedMinutes->Visible = false;
        $this->txtIPAddress->Visible = false;
        $this->txtPageDetails->Visible = false;
        $this->txtUserAgentDetails->Visible = false;
        $this->txtUserRole->Visible = false;
        $this->txtUsername->Visible = false;
    }

    public function showAll() {
        $this->txtTimeStamped->Visible = true;
        $this->lstTimeStampedHours->Visible = true;
        $this->lstTimeStampedMinutes->Visible = true;
        $this->txtIPAddress->Visible = true;
        $this->txtPageDetails->Visible = true;
        $this->txtUserAgentDetails->Visible = true;
        $this->txtUserRole->Visible = true;
        $this->txtUsername->Visible = true;
    }

    public function refreshAll() {
        $this->txtTimeStamped->Refresh();
        $this->lstTimeStampedHours->Refresh();
        $this->lstTimeStampedMinutes->Refresh();
        $this->txtIPAddress->Refresh();
        $this->txtPageDetails->Refresh();
        $this->txtUserAgentDetails->Refresh();
        $this->txtUserRole->Refresh();
        $this->txtUsername->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'TIMESTAMPED':
                $this->txtTimeStamped->Text = $value;
                break;
            case 'TIMESTAMPEDTIME':
                $this->setTimeStampedTime($value);
                break;
            case 'IPADDRESS':
                $this->txtIPAddress->Text = $value;
                break;
            case 'PAGEDETAILS':
                $this->txtPageDetails->Text = $value;
                break;
            case 'USERAGENTDETAILS':
                $this->txtUserAgentDetails->Text = $value;
                break;
            case 'USERROLE':
                $this->txtUserRole->Text = $value;
                break;
            case 'USERNAME':
                $this->txtUsername->Text = $value;
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
            case 'TIMESTAMPED':
                if ($this->txtTimeStamped->Text)
                    return $this->txtTimeStamped->Text;
                break;
            case 'TIMESTAMPEDTIME':
                return $this->lstTimeStampedHours->SelectedValue.':'.$this->lstTimeStampedMinutes->SelectedValue;
                break;
            case 'IPADDRESS':
                if ($this->txtIPAddress->Text)
                    return $this->txtIPAddress->Text;
                break;
            case 'PAGEDETAILS':
                if ($this->txtPageDetails->Text)
                    return $this->txtPageDetails->Text;
                break;
            case 'USERAGENTDETAILS':
                if ($this->txtUserAgentDetails->Text)
                    return $this->txtUserAgentDetails->Text;
                break;
            case 'USERROLE':
                if ($this->txtUserRole->Text)
                    return $this->txtUserRole->Text;
                break;
            case 'USERNAME':
                if ($this->txtUsername->Text)
                    return $this->txtUsername->Text;
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
            case 'TIMESTAMPED':
                if ($this->txtTimeStamped)
                    return $this->txtTimeStamped->ControlId;
                break;
            case 'TIMESTAMPEDHOURS':
                if ($this->lstTimeStampedHours)
                    return $this->lstTimeStampedHours->ControlId;
                break;
            case 'TIMESTAMPEDMINUTES':
                if ($this->lstTimeStampedMinutes)
                    return $this->lstTimeStampedMinutes->ControlId;
                break;
            case 'IPADDRESS':
                if ($this->txtIPAddress)
                    return $this->txtIPAddress->ControlId;
                break;
            case 'PAGEDETAILS':
                if ($this->txtPageDetails)
                    return $this->txtPageDetails->ControlId;
                break;
            case 'USERAGENTDETAILS':
                if ($this->txtUserAgentDetails)
                    return $this->txtUserAgentDetails->ControlId;
                break;
            case 'USERROLE':
                if ($this->txtUserRole)
                    return $this->txtUserRole->ControlId;
                break;
            case 'USERNAME':
                if ($this->txtUsername)
                    return $this->txtUsername->ControlId;
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
            case 'TIMESTAMPED':
                $this->txtTimeStamped->Visible = false;
                $this->txtTimeStamped->Refresh();
                break;
            case 'TIMESTAMPEDTIME':
                $this->lstTimeStampedHours->Visible = false;
                $this->lstTimeStampedMinutes->Visible = false;
                $this->lstTimeStampedHours->Refresh();
                $this->lstTimeStampedMinutes->Refresh();
                break;
            case 'IPADDRESS':
                $this->txtIPAddress->Visible = false;
                $this->txtIPAddress->Refresh();
                break;
            case 'PAGEDETAILS':
                $this->txtPageDetails->Visible = false;
                $this->txtPageDetails->Refresh();
                break;
            case 'USERAGENTDETAILS':
                $this->txtUserAgentDetails->Visible = false;
                $this->txtUserAgentDetails->Refresh();
                break;
            case 'USERROLE':
                $this->txtUserRole->Visible = false;
                $this->txtUserRole->Refresh();
                break;
            case 'USERNAME':
                $this->txtUsername->Visible = false;
                $this->txtUsername->Refresh();
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
            case 'TIMESTAMPED':
                $this->txtTimeStamped->Visible = true;
                $this->txtTimeStamped->Refresh();
                break;
            case 'TIMESTAMPEDTIME':
                $this->lstTimeStampedHours->Visible = true;
                $this->lstTimeStampedMinutes->Visible = true;
                $this->lstTimeStampedHours->Refresh();
                $this->lstTimeStampedMinutes->Refresh();
                break;
            case 'IPADDRESS':
                $this->txtIPAddress->Visible = true;
                $this->txtIPAddress->Refresh();
                break;
            case 'PAGEDETAILS':
                $this->txtPageDetails->Visible = true;
                $this->txtPageDetails->Refresh();
                break;
            case 'USERAGENTDETAILS':
                $this->txtUserAgentDetails->Visible = true;
                $this->txtUserAgentDetails->Refresh();
                break;
            case 'USERROLE':
                $this->txtUserRole->Visible = true;
                $this->txtUserRole->Refresh();
                break;
            case 'USERNAME':
                $this->txtUsername->Visible = true;
                $this->txtUsername->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtTimeStamped->getJqControlId();
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
            $this->Object = new PageView();
        
        if (strlen($this->txtTimeStamped->Text) > 0) {
            if ($this->lstTimeStampedHours->SelectedIndex > 0)
                $this->Object->TimeStamped = new QDateTime($this->txtTimeStamped->Text.' '.$this->lstTimeStampedHours->SelectedValue.':'.$this->lstTimeStampedMinutes->SelectedValue);
            else
                $this->Object->TimeStamped = new QDateTime($this->txtTimeStamped->Text);
        }
        $this->Object->IPAddress = $this->txtIPAddress->Text;
        $this->Object->PageDetails = $this->txtPageDetails->Text;
        $this->Object->UserAgentDetails = $this->txtUserAgentDetails->Text;
        $this->Object->UserRole = $this->txtUserRole->Text;
        $this->Object->Username = $this->txtUsername->Text;
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtTimeStamped);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtIPAddress);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPageDetails);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtUserAgentDetails);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtUserRole);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtUsername);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtTimeStamped->WrapperCssClass = 'form-group';
            $this->txtTimeStamped->Placeholder = '';
            $this->txtIPAddress->WrapperCssClass = 'form-group';
            $this->txtIPAddress->Placeholder = '';
            $this->txtPageDetails->WrapperCssClass = 'form-group';
            $this->txtPageDetails->Placeholder = '';
            $this->txtUserAgentDetails->WrapperCssClass = 'form-group';
            $this->txtUserAgentDetails->Placeholder = '';
            $this->txtUserRole->WrapperCssClass = 'form-group';
            $this->txtUserRole->Placeholder = '';
            $this->txtUsername->WrapperCssClass = 'form-group';
            $this->txtUsername->Placeholder = '';
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
            $previousValues = PageView::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'TimeStamped-> Value before: '.$previousValues->TimeStamped.', Value after: '.$this->Object->TimeStamped.'<br>
        IPAddress-> Value before: '.$previousValues->IPAddress.', Value after: '.$this->Object->IPAddress.'<br>
        PageDetails-> Value before: '.$previousValues->PageDetails.', Value after: '.$this->Object->PageDetails.'<br>
        UserAgentDetails-> Value before: '.$previousValues->UserAgentDetails.', Value after: '.$this->Object->UserAgentDetails.'<br>
        UserRole-> Value before: '.$previousValues->UserRole.', Value after: '.$this->Object->UserRole.'<br>
        Username-> Value before: '.$previousValues->Username.', Value after: '.$this->Object->Username.'<br>
        ';
        } else {
        $changeText = 'TimeStamped-> Value: '.$this->Object->TimeStamped.'<br>
        IPAddress-> Value: '.$this->Object->IPAddress.'<br>
        PageDetails-> Value: '.$this->Object->PageDetails.'<br>
        UserAgentDetails-> Value: '.$this->Object->UserAgentDetails.'<br>
        UserRole-> Value: '.$this->Object->UserRole.'<br>
        Username-> Value: '.$this->Object->Username.'<br>
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
            $AuditLogEntry->ObjectName = 'PageView';
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
                $AuditLogEntry->ObjectName = 'PageView';
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