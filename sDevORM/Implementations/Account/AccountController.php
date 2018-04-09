<?php
require_once(__SDEV_ORM__.'/Generated/Account/AccountController_Base.php');

class AccountController extends AccountController_Base {
    public function __construct($objParentObject,$InitObject = null) {
        parent::__construct($objParentObject,$InitObject);
        $this->lstUserRole->RemoveAllItems();
        $allRoles = UserRole::LoadAll();
        foreach ($allRoles as $role) {
            $this->lstUserRole->AddItem(new QListItem($role->Role,$role->Id));
        }
        $this->txtPassword->TextMode = QTextMode::Password;
        $this->txtPassword->SetCustomAttribute("autocomplete","new-password");
        $this->txtUsername->SetCustomAttribute("autocomplete","new-password");
    }
    public function setValues($Object) {
        $this->txtFullName->Text = '';
        $this->txtFirstName->Text = '';
        $this->txtLastName->Text = '';
        $this->txtEmailAddress->Text = '';
        $this->txtUsername->Text = '';
        $this->txtPassword->Text = '';
        $this->txtChangedBy->Text = '';
        $this->lstUserRole->SelectedIndex = 0;

        if (!$Object) {
            $this->refreshAll();
            return;
        }

        $this->txtFullName->Text = $Object->FullName;
        $this->txtFirstName->Text = $Object->FirstName;
        $this->txtLastName->Text = $Object->LastName;
        $this->txtEmailAddress->Text = $Object->EmailAddress;
        $this->txtUsername->Text = $Object->Username;
        $this->txtPassword->Text = '';
        if ($Object->UserRoleObject)
            $this->lstUserRole->SelectedValue = $Object->UserRoleObject->Id;
        $this->txtChangedBy->Text = $Object->ChangedBy;

        $this->resetValidation();
        $this->refreshAll();
    }
    public function saveObject($validate = true,$UserRole = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }

        if (!$this->Object)
            $this->Object = new Account();

        $this->Object->FullName = $this->txtFirstName->Text.' '.$this->txtLastName->Text;
        $this->Object->FirstName = $this->txtFirstName->Text;
        $this->Object->LastName = $this->txtLastName->Text;
        $this->Object->EmailAddress = $this->txtEmailAddress->Text;
        $this->Object->Username = $this->txtUsername->Text;
        if (strlen($this->txtPassword->Text) > 0)
            $this->Object->Password = QApplication::getHashedPassword($this->txtPassword->Text);
        $this->Object->ChangedBy = getCurrentAccount()->EmailAddress;
        $this->Object->UserRoleObject = UserRole::Load($this->lstUserRole->SelectedValue);

        /*try {
            $this->Object->Save();
            return true;
        } catch(QCallerException $e) {
            QApplication::DisplayAlert('Could not save right now. Please try again later...');
            return false;
        }*/
        return $this->saveWithAudit();
    }
    public function validateObject()  {
        $hasNoErrors = true;
        $this->resetValidation();
        $hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtFirstName);
        $hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->txtEmailAddress);
        if (!AppSpecificFunctions::validateFieldAsRequired($this->txtUsername)) {
            $hasNoErrors = false;
        } else {
            $existingAccount = null;
            if ($this->Object) {
                $existingAccount = Account::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::Account()->Username,$this->txtUsername->Text),
                    QQ::NotEqual(QQN::Account()->Id,$this->Object->Id)));
            } else {
                $existingAccount = Account::QuerySingle(QQ::Equal(QQN::Account()->Username,$this->txtUsername->Text));
            }
            AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(\''.$this->txtUsername->getJqControlId().'\')');
            if ($existingAccount) {
                AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(\''.$this->txtUsername->getJqControlId().'\',\'Already exists\')');
                $hasNoErrors = false;
            }
        }
        if (!$this->Object){
            $hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtPassword);
        }
        return $hasNoErrors;
    }
    /*public function saveWithAudit() {
        if ($this->Object)
            $previousValues = Account::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
            $changeText = 'FullName-> Value before: '.$previousValues->FullName.', Value after: '.$this->Object->FullName.'<br>
        FirstName-> Value before: '.$previousValues->FirstName.', Value after: '.$this->Object->FirstName.'<br>
        LastName-> Value before: '.$previousValues->LastName.', Value after: '.$this->Object->LastName.'<br>
        EmailAddress-> Value before: '.$previousValues->EmailAddress.', Value after: '.$this->Object->EmailAddress.'<br>
        Username-> Value before: '.$previousValues->Username.', Value after: '.$this->Object->Username.'<br>
        Password-> Value before: hidden for security reasons, Value after: hidden for security reasons<br>
        ChangedBy-> Value before: '.$previousValues->ChangedBy.', Value after: '.$this->Object->ChangedBy.'<br>
        ';
        } else {
            $changeText = 'FullName-> Value: '.$this->Object->FullName.'<br>
        FirstName-> Value: '.$this->Object->FirstName.'<br>
        LastName-> Value: '.$this->Object->LastName.'<br>
        EmailAddress-> Value: '.$this->Object->EmailAddress.'<br>
        Username-> Value: '.$this->Object->Username.'<br>
        Password-> Value: hidden for security reasons<br>
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
        }
    }*/
};
?>