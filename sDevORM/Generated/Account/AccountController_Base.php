<?php
class AccountController_Base {
    protected $Object;
    public $txtFullName;
    public $txtFirstName;
    public $txtLastName;
    public $txtEmailAddress;
    public $txtUsername;
    public $txtPassword;
    public $txtChangedBy;
    public $lstUserRole,$saveUsingLstUserRole = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtFullName = new QTextBox($objParentObject);
        $this->txtFullName->Name = 'Full Name';

        $this->txtFirstName = new QTextBox($objParentObject);
        $this->txtFirstName->Name = 'First Name';

        $this->txtLastName = new QTextBox($objParentObject);
        $this->txtLastName->Name = 'Last Name';

        $this->txtEmailAddress = new QTextBox($objParentObject);
        $this->txtEmailAddress->Name = 'Email Address';

        $this->txtUsername = new QTextBox($objParentObject);
        $this->txtUsername->Name = 'Username';

        $this->txtPassword = new QTextBox($objParentObject);
        $this->txtPassword->Name = 'Password';

        $this->txtChangedBy = new QTextBox($objParentObject);
        $this->txtChangedBy->Name = 'Changed By';

        $this->lstUserRole = new QListBox($objParentObject);
        $this->lstUserRole->Name = 'User Role';
        $this->lstUserRole->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allUserRole = UserRole::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allUserRole as $UserRole) {
            $this->lstUserRole->AddItem(new QListItem($UserRole->Id,$UserRole->Id));
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
            if ($ReferenceObject == 'UserRole') {
                $this->lstUserRole->RemoveAllItems();
                $allUserRole_list = UserRole::LoadAll();
                foreach ($allUserRole_list as $UserRole) {
                    $this->lstUserRole->AddItem(new QListItem($UserRole->__get($ReferenceAttribute),$UserRole->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'UserRole') {
                $this->saveUsingLstUserRole = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtFullName->Text = '';
        $this->txtFirstName->Text = '';
        $this->txtLastName->Text = '';
        $this->txtEmailAddress->Text = '';
        $this->txtUsername->Text = '';
        $this->txtPassword->Text = '';
        $this->txtChangedBy->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->FullName)) {
            $this->txtFullName->Text = $Object->FullName;
        }
        if (!is_null($Object->FirstName)) {
            $this->txtFirstName->Text = $Object->FirstName;
        }
        if (!is_null($Object->LastName)) {
            $this->txtLastName->Text = $Object->LastName;
        }
        if (!is_null($Object->EmailAddress)) {
            $this->txtEmailAddress->Text = $Object->EmailAddress;
        }
        if (!is_null($Object->Username)) {
            $this->txtUsername->Text = $Object->Username;
        }
        if (!is_null($Object->Password)) {
            $this->txtPassword->Text = $Object->Password;
        }
        if (!is_null($Object->ChangedBy)) {
            $this->txtChangedBy->Text = $Object->ChangedBy;
        }
        
        if (!is_null($Object->UserRoleObject)) {
            $this->lstUserRole->SelectedValue = $Object->UserRoleObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'FULLNAME') {
            if (strlen($nameValue) > 0)
                $this->txtFullName->Name = $nameValue;
            $output = $withName ? $this->txtFullName->RenderWithName($blnPrintOutput):$this->txtFullName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'FIRSTNAME') {
            if (strlen($nameValue) > 0)
                $this->txtFirstName->Name = $nameValue;
            $output = $withName ? $this->txtFirstName->RenderWithName($blnPrintOutput):$this->txtFirstName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'LASTNAME') {
            if (strlen($nameValue) > 0)
                $this->txtLastName->Name = $nameValue;
            $output = $withName ? $this->txtLastName->RenderWithName($blnPrintOutput):$this->txtLastName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'EMAILADDRESS') {
            if (strlen($nameValue) > 0)
                $this->txtEmailAddress->Name = $nameValue;
            $output = $withName ? $this->txtEmailAddress->RenderWithName($blnPrintOutput):$this->txtEmailAddress->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'USERNAME') {
            if (strlen($nameValue) > 0)
                $this->txtUsername->Name = $nameValue;
            $output = $withName ? $this->txtUsername->RenderWithName($blnPrintOutput):$this->txtUsername->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PASSWORD') {
            if (strlen($nameValue) > 0)
                $this->txtPassword->Name = $nameValue;
            $output = $withName ? $this->txtPassword->RenderWithName($blnPrintOutput):$this->txtPassword->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'CHANGEDBY') {
            if (strlen($nameValue) > 0)
                $this->txtChangedBy->Name = $nameValue;
            $output = $withName ? $this->txtChangedBy->RenderWithName($blnPrintOutput):$this->txtChangedBy->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'USERROLE') {
            if (strlen($nameValue) > 0)
                $this->lstUserRole->Name = $nameValue;
            $output = $withName ? $this->lstUserRole->RenderWithName($blnPrintOutput):$this->lstUserRole->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('FULLNAME',$withName);
        $this->renderControl('FIRSTNAME',$withName);
        $this->renderControl('LASTNAME',$withName);
        $this->renderControl('EMAILADDRESS',$withName);
        $this->renderControl('USERNAME',$withName);
        $this->renderControl('PASSWORD',$withName);
        $this->renderControl('CHANGEDBY',$withName);
        $this->renderControl('USERROLE',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('FullName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('FirstName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('LastName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('EmailAddress',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Username',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Password',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('ChangedBy',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtFullName->Visible = false;
        $this->txtFirstName->Visible = false;
        $this->txtLastName->Visible = false;
        $this->txtEmailAddress->Visible = false;
        $this->txtUsername->Visible = false;
        $this->txtPassword->Visible = false;
        $this->txtChangedBy->Visible = false;
        $this->lstUserRole->Visible = false;
    }

    public function showAll() {
        $this->txtFullName->Visible = true;
        $this->txtFirstName->Visible = true;
        $this->txtLastName->Visible = true;
        $this->txtEmailAddress->Visible = true;
        $this->txtUsername->Visible = true;
        $this->txtPassword->Visible = true;
        $this->txtChangedBy->Visible = true;
        $this->lstUserRole->Visible = true;
    }

    public function refreshAll() {
        $this->txtFullName->Refresh();
        $this->txtFirstName->Refresh();
        $this->txtLastName->Refresh();
        $this->txtEmailAddress->Refresh();
        $this->txtUsername->Refresh();
        $this->txtPassword->Refresh();
        $this->txtChangedBy->Refresh();
        $this->lstUserRole->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'FULLNAME':
                $this->txtFullName->Text = $value;
                break;
            case 'FIRSTNAME':
                $this->txtFirstName->Text = $value;
                break;
            case 'LASTNAME':
                $this->txtLastName->Text = $value;
                break;
            case 'EMAILADDRESS':
                $this->txtEmailAddress->Text = $value;
                break;
            case 'USERNAME':
                $this->txtUsername->Text = $value;
                break;
            case 'PASSWORD':
                $this->txtPassword->Text = $value;
                break;
            case 'CHANGEDBY':
                $this->txtChangedBy->Text = $value;
                break;
            case 'USERROLE':
                $this->lstUserRole->SelectedValue = $value;
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
            case 'FULLNAME':
                if ($this->txtFullName->Text)
                    return $this->txtFullName->Text;
                break;
            case 'FIRSTNAME':
                if ($this->txtFirstName->Text)
                    return $this->txtFirstName->Text;
                break;
            case 'LASTNAME':
                if ($this->txtLastName->Text)
                    return $this->txtLastName->Text;
                break;
            case 'EMAILADDRESS':
                if ($this->txtEmailAddress->Text)
                    return $this->txtEmailAddress->Text;
                break;
            case 'USERNAME':
                if ($this->txtUsername->Text)
                    return $this->txtUsername->Text;
                break;
            case 'PASSWORD':
                if ($this->txtPassword->Text)
                    return $this->txtPassword->Text;
                break;
            case 'CHANGEDBY':
                if ($this->txtChangedBy->Text)
                    return $this->txtChangedBy->Text;
                break;
            case 'USERROLE':
                if ($this->lstUserRole->SelectedValue)
                    return $this->lstUserRole->SelectedValue;
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
            case 'FULLNAME':
                if ($this->txtFullName)
                    return $this->txtFullName->ControlId;
                break;
            case 'FIRSTNAME':
                if ($this->txtFirstName)
                    return $this->txtFirstName->ControlId;
                break;
            case 'LASTNAME':
                if ($this->txtLastName)
                    return $this->txtLastName->ControlId;
                break;
            case 'EMAILADDRESS':
                if ($this->txtEmailAddress)
                    return $this->txtEmailAddress->ControlId;
                break;
            case 'USERNAME':
                if ($this->txtUsername)
                    return $this->txtUsername->ControlId;
                break;
            case 'PASSWORD':
                if ($this->txtPassword)
                    return $this->txtPassword->ControlId;
                break;
            case 'CHANGEDBY':
                if ($this->txtChangedBy)
                    return $this->txtChangedBy->ControlId;
                break;
            case 'USERROLE':
                if ($this->lstUserRole)
                    return $this->lstUserRole->ControlId;
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
            case 'FULLNAME':
                $this->txtFullName->Visible = false;
                $this->txtFullName->Refresh();
                break;
            case 'FIRSTNAME':
                $this->txtFirstName->Visible = false;
                $this->txtFirstName->Refresh();
                break;
            case 'LASTNAME':
                $this->txtLastName->Visible = false;
                $this->txtLastName->Refresh();
                break;
            case 'EMAILADDRESS':
                $this->txtEmailAddress->Visible = false;
                $this->txtEmailAddress->Refresh();
                break;
            case 'USERNAME':
                $this->txtUsername->Visible = false;
                $this->txtUsername->Refresh();
                break;
            case 'PASSWORD':
                $this->txtPassword->Visible = false;
                $this->txtPassword->Refresh();
                break;
            case 'CHANGEDBY':
                $this->txtChangedBy->Visible = false;
                $this->txtChangedBy->Refresh();
                break;
            case 'USERROLE':
                $this->lstUserRole->Visible = false;
                $this->lstUserRole->Refresh();
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
            case 'FULLNAME':
                $this->txtFullName->Visible = true;
                $this->txtFullName->Refresh();
                break;
            case 'FIRSTNAME':
                $this->txtFirstName->Visible = true;
                $this->txtFirstName->Refresh();
                break;
            case 'LASTNAME':
                $this->txtLastName->Visible = true;
                $this->txtLastName->Refresh();
                break;
            case 'EMAILADDRESS':
                $this->txtEmailAddress->Visible = true;
                $this->txtEmailAddress->Refresh();
                break;
            case 'USERNAME':
                $this->txtUsername->Visible = true;
                $this->txtUsername->Refresh();
                break;
            case 'PASSWORD':
                $this->txtPassword->Visible = true;
                $this->txtPassword->Refresh();
                break;
            case 'CHANGEDBY':
                $this->txtChangedBy->Visible = true;
                $this->txtChangedBy->Refresh();
                break;
            case 'USERROLE':
                $this->lstUserRole->Visible = true;
                $this->lstUserRole->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtFullName->getJqControlId();
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

    public function applyValuesBeforeSaveObject($UserRole = null)  {
        if (!$this->Object)
            $this->Object = new Account();
        
        $this->Object->FullName = $this->txtFullName->Text;
        $this->Object->FirstName = $this->txtFirstName->Text;
        $this->Object->LastName = $this->txtLastName->Text;
        $this->Object->EmailAddress = $this->txtEmailAddress->Text;
        $this->Object->Username = $this->txtUsername->Text;
        $this->Object->Password = $this->txtPassword->Text;
        $this->Object->ChangedBy = $this->txtChangedBy->Text;
        if ($UserRole) {
            $this->Object->UserRoleObject = $UserRole;
        }
        if ($this->saveUsingLstUserRole) {
            $linkedUserRole = UserRole::Load($this->lstUserRole->SelectedValue);
            $this->Object->UserRoleObject = $linkedUserRole;
        }
    }

    public function saveObject($validate = true,$UserRole = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($UserRole);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtFullName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtFirstName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtLastName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtEmailAddress);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtUsername);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPassword);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtChangedBy);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtFullName->WrapperCssClass = 'form-group';
            $this->txtFullName->Placeholder = '';
            $this->txtFirstName->WrapperCssClass = 'form-group';
            $this->txtFirstName->Placeholder = '';
            $this->txtLastName->WrapperCssClass = 'form-group';
            $this->txtLastName->Placeholder = '';
            $this->txtEmailAddress->WrapperCssClass = 'form-group';
            $this->txtEmailAddress->Placeholder = '';
            $this->txtUsername->WrapperCssClass = 'form-group';
            $this->txtUsername->Placeholder = '';
            $this->txtPassword->WrapperCssClass = 'form-group';
            $this->txtPassword->Placeholder = '';
            $this->txtChangedBy->WrapperCssClass = 'form-group';
            $this->txtChangedBy->Placeholder = '';
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
            $previousValues = Account::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'FullName-> Value before: '.$previousValues->FullName.', Value after: '.$this->Object->FullName.'<br>
        FirstName-> Value before: '.$previousValues->FirstName.', Value after: '.$this->Object->FirstName.'<br>
        LastName-> Value before: '.$previousValues->LastName.', Value after: '.$this->Object->LastName.'<br>
        EmailAddress-> Value before: '.$previousValues->EmailAddress.', Value after: '.$this->Object->EmailAddress.'<br>
        Username-> Value before: '.$previousValues->Username.', Value after: '.$this->Object->Username.'<br>
        Password-> Value before: '.$previousValues->Password.', Value after: '.$this->Object->Password.'<br>
        ChangedBy-> Value before: '.$previousValues->ChangedBy.', Value after: '.$this->Object->ChangedBy.'<br>
        ';
        } else {
        $changeText = 'FullName-> Value: '.$this->Object->FullName.'<br>
        FirstName-> Value: '.$this->Object->FirstName.'<br>
        LastName-> Value: '.$this->Object->LastName.'<br>
        EmailAddress-> Value: '.$this->Object->EmailAddress.'<br>
        Username-> Value: '.$this->Object->Username.'<br>
        Password-> Value: '.$this->Object->Password.'<br>
        ChangedBy-> Value: '.$this->Object->ChangedBy.'<br>
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
            $AuditLogEntry->ObjectName = 'Account';
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
                $AuditLogEntry->ObjectName = 'Account';
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