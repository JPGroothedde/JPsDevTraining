<?php
class PlaceHolderController_Base {
    protected $Object;
    public $txtDummyOne;
    public $lstDummyTwo;
    public $txtDummyThree;
    public $btnDummyFour;
    public $txtDummyFive;
    public $lstDummyFiveHours,$lstDummyFiveMinutes;
    public $txtDummySix;
    public $lstAccount,$saveUsingLstAccount = false;
    public $lstUserRole,$saveUsingLstUserRole = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtDummyOne = new QTextBox($objParentObject);
        $this->txtDummyOne->Name = 'Dummy One';
        $this->txtDummyOne->CssClass = 'form-control input-date';

        $this->lstDummyTwo = new QListBox($objParentObject);
        $this->lstDummyTwo->Name = 'Dummy Two';
        $this->lstDummyTwo->DisplayStyle = QDisplayStyle::Block;
        $this->lstDummyTwo->AddCssClass('fullWidth');

        $this->txtDummyThree = new QTextBox($objParentObject);
        $this->txtDummyThree->Name = 'Dummy Three';
        $this->txtDummyThree->RenderAsInputGroup(true,'R','');
        $this->txtDummyThree->TextMode = QTextMode::Number;

        $this->btnDummyFour = new QButton($objParentObject);
        $this->btnDummyFour->Name = 'Dummy Four';
        $this->btnDummyFour->HtmlEntities = false;
        $trueLabel = 'Checked';
        $falseLabel = 'Unchecked';
        if (strlen($trueLabel) < 1)
            $trueLabel = null;
        if (strlen($falseLabel) < 1)
            $falseLabel = null;
        $this->btnDummyFour->setAsToggle(true,$trueLabel,$falseLabel);
        $this->btnDummyFour->DisplayStyle = QDisplayStyle::Block;
        $this->btnDummyFour->AddAction(new QClickEvent(), new QAjaxAction('btnDummyFour_Clicked'));//btnDummyFour_Clicked must be implemented in Page Controller class (QForm class)

        $this->txtDummyFive = new QTextBox($objParentObject);
        $this->txtDummyFive->Name = 'Dummy Five';
        $this->txtDummyFive->CssClass = 'form-control input-date';

        $this->lstDummyFiveHours = new QListBox($objParentObject);
        $this->lstDummyFiveHours->DisplayStyle = QDisplayStyle::Inline;
        $this->lstDummyFiveMinutes = new QListBox($objParentObject);
        $this->lstDummyFiveMinutes->HtmlBefore = ' : ';
        $this->lstDummyFiveMinutes->DisplayStyle = QDisplayStyle::Inline;
        $this->lstDummyFiveHours->AddItem(new QListItem('--',-1));
        for ($i=1;$i<=24;$i++) {
            $display = $i;
            $amPm = 'AM';
            if ($i>11 && $i < 24)
                $amPm = 'PM';
            if ($i > 12) {
                $display = $i - 12;
            }
            $this->lstDummyFiveHours->AddItem(new QListItem($display.' '.$amPm,$i));
        }
        $this->lstDummyFiveMinutes->AddItem(new QListItem('--',0));
        for ($i=0;$i<60;$i++) {
            $display = $i;
            if ($i < 10)
                $display = '0'.$i;
            $this->lstDummyFiveMinutes->AddItem(new QListItem($display,$i));
        }
        
        $this->txtDummySix = new QTextBox($objParentObject);
        $this->txtDummySix->Name = 'Dummy Six';

        $this->lstAccount = new QListBox($objParentObject);
        $this->lstAccount->Name = 'Account';
        $this->lstAccount->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allAccount = Account::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allAccount as $Account) {
            $this->lstAccount->AddItem(new QListItem($Account->Id,$Account->Id));
        }

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
            if ($ReferenceObject == 'Account') {
                $this->lstAccount->RemoveAllItems();
                $allAccount_list = Account::LoadAll();
                foreach ($allAccount_list as $Account) {
                    $this->lstAccount->AddItem(new QListItem($Account->__get($ReferenceAttribute),$Account->Id));
                }
            }
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
            if ($ReferenceObject == 'Account') {
                $this->saveUsingLstAccount = $useListValue;
            }
            if ($ReferenceObject == 'UserRole') {
                $this->saveUsingLstUserRole = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtDummyOne->Text = '';
        $this->lstDummyTwo->RemoveAllItems();
        $this->lstDummyTwo->AddItem(new QListItem('Test,Result','Test,Result'));
        $this->lstDummyTwo->AddItem(new QListItem('Result,Test','Result,Test'));
        $this->lstDummyTwo->AddItem(new QListItem('One more item','One more item'));
        
        $this->txtDummyThree->Text = '';
        
        $this->btnDummyFour->IsToggled = false;
        $this->txtDummyFive->Text = '';$this->setDummyFiveTime();
        $this->txtDummySix->Text = '';

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if ($Object->DummyOne) {
            $this->txtDummyOne->Text = $Object->DummyOne->format(DATE_TIME_FORMAT_HTML);
        }
        if ($Object->DummyTwo) {
            $this->lstDummyTwo->SelectedValue = $Object->DummyTwo;
        }
        if ($Object->DummyThree) {
            $this->txtDummyThree->Text = $Object->DummyThree;
        }
        if ($Object->DummyFour == 1) {
            $this->btnDummyFour->Toggle();
        } else {
            $this->btnDummyFour->Toggle(false);
        }
        if ($Object->DummyFive) {
            $this->txtDummyFive->Text = $Object->DummyFive->format(DATE_TIME_FORMAT_HTML);
            $this->setDummyFiveTime($Object->DummyFive);
        }
        if ($Object->DummySix) {
            $this->txtDummySix->Text = $Object->DummySix;
        }
        
        if ($Object->AccountObject) {
            $this->lstAccount->SelectedValue = $Object->AccountObject->Id;
        }
        if ($Object->UserRoleObject) {
            $this->lstUserRole->SelectedValue = $Object->UserRoleObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    public function setDummyFiveTime(QDateTime $time = null) {
        if (!$time) {
            $this->lstDummyFiveHours->SelectedIndex = 0;
            $this->lstDummyFiveMinutes->SelectedIndex = 0;
            return;
        }
        $this->lstDummyFiveHours->SelectedValue = $time->format('H');
        $this->lstDummyFiveMinutes->SelectedValue = $time->format('i');
    }

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'DUMMYONE') {
            if (strlen($nameValue) > 0)
                $this->txtDummyOne->Name = $nameValue;
            $output = $withName ? $this->txtDummyOne->RenderWithName($blnPrintOutput):$this->txtDummyOne->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DUMMYTWO') {
            if (strlen($nameValue) > 0)
                $this->lstDummyTwo->Name = $nameValue;
            $output = $withName ? $this->lstDummyTwo->RenderWithName($blnPrintOutput):$this->lstDummyTwo->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DUMMYTHREE') {
            if (strlen($nameValue) > 0)
                $this->txtDummyThree->Name = $nameValue;
            $output = $withName ? $this->txtDummyThree->RenderWithName($blnPrintOutput):$this->txtDummyThree->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DUMMYFOUR') {
            if (strlen($nameValue) > 0)
                $this->btnDummyFour->Name = $nameValue;
            $output = $withName ? $this->btnDummyFour->RenderWithName($blnPrintOutput):$this->btnDummyFour->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DUMMYFIVE') {
            if (strlen($nameValue) > 0)
                $this->txtDummyFive->Name = $nameValue;
            $output = $withName ? $this->txtDummyFive->RenderWithName($blnPrintOutput):$this->txtDummyFive->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DUMMYFIVETIME') {
            if ($withName) {
                $this->lstDummyFiveHours->HtmlBefore = '<label style="display:block;">'.$nameValue.'</label>';
            } else {
                $this->lstDummyFiveHours->HtmlBefore = '';
            }
            $output = $this->lstDummyFiveHours->Render($blnPrintOutput);
            $output .= $this->lstDummyFiveMinutes->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DUMMYSIX') {
            if (strlen($nameValue) > 0)
                $this->txtDummySix->Name = $nameValue;
            $output = $withName ? $this->txtDummySix->RenderWithName($blnPrintOutput):$this->txtDummySix->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ACCOUNT') {
            if (strlen($nameValue) > 0)
                $this->lstAccount->Name = $nameValue;
            $output = $withName ? $this->lstAccount->RenderWithName($blnPrintOutput):$this->lstAccount->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'USERROLE') {
            if (strlen($nameValue) > 0)
                $this->lstUserRole->Name = $nameValue;
            $output = $withName ? $this->lstUserRole->RenderWithName($blnPrintOutput):$this->lstUserRole->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('DUMMYONE',$withName);
        $this->renderControl('DUMMYTWO',$withName);
        $this->renderControl('DUMMYTHREE',$withName);
        $this->renderControl('DUMMYFOUR',$withName);
        $this->renderControl('DUMMYFIVE',$withName);
        $this->renderControl('DUMMYFIVETIME',$withName);
        $this->renderControl('DUMMYSIX',$withName);
        $this->renderControl('ACCOUNT',$withName);
        $this->renderControl('USERROLE',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('DummyOne',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DummyTwo',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DummyThree',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DummyFour',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DummyFive',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DummyFiveTIME',$withName, 'Time', false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DummySix',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtDummyOne->Visible = false;
        $this->lstDummyTwo->Visible = false;
        $this->txtDummyThree->Visible = false;
        $this->btnDummyFour->Visible = false;
        $this->txtDummyFive->Visible = false;
        $this->lstDummyFiveHours->Visible = false;
        $this->lstDummyFiveMinutes->Visible = false;
        $this->txtDummySix->Visible = false;
        $this->lstAccount->Visible = false;
        $this->lstUserRole->Visible = false;
    }

    public function showAll() {
        $this->txtDummyOne->Visible = true;
        $this->lstDummyTwo->Visible = true;
        $this->txtDummyThree->Visible = true;
        $this->btnDummyFour->Visible = true;
        $this->txtDummyFive->Visible = true;
        $this->lstDummyFiveHours->Visible = true;
        $this->lstDummyFiveMinutes->Visible = true;
        $this->txtDummySix->Visible = true;
        $this->lstAccount->Visible = true;
        $this->lstUserRole->Visible = true;
    }

    public function refreshAll() {
        $this->txtDummyOne->Refresh();
        $this->lstDummyTwo->Refresh();
        $this->txtDummyThree->Refresh();
        $this->btnDummyFour->Refresh();
        $this->txtDummyFive->Refresh();
        $this->lstDummyFiveHours->Refresh();
        $this->lstDummyFiveMinutes->Refresh();
        $this->txtDummySix->Refresh();
        $this->lstAccount->Refresh();
        $this->lstUserRole->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'DUMMYONE':
                $this->txtDummyOne->Text = $value;
                break;
            case 'DUMMYTWO':
                $this->lstDummyTwo->SelectedValue = $value;
                break;
            case 'DUMMYTHREE':
                $this->txtDummyThree->Text = $value;
                break;
            case 'DUMMYFOUR':
                $this->btnDummyFour->IsToggled = $value;
                break;
            case 'DUMMYFIVE':
                $this->txtDummyFive->Text = $value;
                break;
            case 'DUMMYFIVETIME':
                $this->setDummyFiveTime($value);
                break;
            case 'DUMMYSIX':
                $this->txtDummySix->Text = $value;
                break;
            case 'ACCOUNT':
                $this->lstAccount->SelectedValue = $value;
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
            case 'DUMMYONE':
                if ($this->txtDummyOne->Text)
                    return $this->txtDummyOne->Text;
                break;
            case 'DUMMYTWO':
                if ($this->lstDummyTwo->SelectedValue)
                    return $this->lstDummyTwo->SelectedValue;
                break;
            case 'DUMMYTHREE':
                if ($this->txtDummyThree->Text)
                    return $this->txtDummyThree->Text;
                break;
            case 'DUMMYFOUR':
                if ($this->btnDummyFour->IsToggled)
                    return $this->btnDummyFour->IsToggled;
                break;
            case 'DUMMYFIVE':
                if ($this->txtDummyFive->Text)
                    return $this->txtDummyFive->Text;
                break;
            case 'DUMMYFIVETIME':
                return $this->lstDummyFiveHours->SelectedValue.':'.$this->lstDummyFiveMinutes->SelectedValue;
                break;
            case 'DUMMYSIX':
                if ($this->txtDummySix->Text)
                    return $this->txtDummySix->Text;
                break;
            case 'ACCOUNT':
                if ($this->lstAccount->SelectedValue)
                    return $this->lstAccount->SelectedValue;
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
            case 'DUMMYONE':
                if ($this->txtDummyOne)
                    return $this->txtDummyOne->ControlId;
                break;
            case 'DUMMYTWO':
                if ($this->lstDummyTwo)
                    return $this->lstDummyTwo->ControlId;
                break;
            case 'DUMMYTHREE':
                if ($this->txtDummyThree)
                    return $this->txtDummyThree->ControlId;
                break;
            case 'DUMMYFOUR':
                if ($this->btnDummyFour)
                    return $this->btnDummyFour->ControlId;
                break;
            case 'DUMMYFIVE':
                if ($this->txtDummyFive)
                    return $this->txtDummyFive->ControlId;
                break;
            case 'DUMMYFIVEHOURS':
                if ($this->lstDummyFiveHours)
                    return $this->lstDummyFiveHours->ControlId;
                break;
            case 'DUMMYFIVEMINUTES':
                if ($this->lstDummyFiveMinutes)
                    return $this->lstDummyFiveMinutes->ControlId;
                break;
            case 'DUMMYSIX':
                if ($this->txtDummySix)
                    return $this->txtDummySix->ControlId;
                break;
            case 'ACCOUNT':
                if ($this->lstAccount)
                    return $this->lstAccount->ControlId;
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
            case 'DUMMYONE':
                $this->txtDummyOne->Visible = false;
                $this->txtDummyOne->Refresh();
                break;
            case 'DUMMYTWO':
                $this->lstDummyTwo->Visible = false;
                $this->lstDummyTwo->Refresh();
                break;
            case 'DUMMYTHREE':
                $this->txtDummyThree->Visible = false;
                $this->txtDummyThree->Refresh();
                break;
            case 'DUMMYFOUR':
                $this->btnDummyFour->Visible = false;
                $this->btnDummyFour->Refresh();
                break;
            case 'DUMMYFIVE':
                $this->txtDummyFive->Visible = false;
                $this->txtDummyFive->Refresh();
                break;
            case 'DUMMYFIVETIME':
                $this->lstDummyFiveHours->Visible = false;
                $this->lstDummyFiveMinutes->Visible = false;
                $this->lstDummyFiveHours->Refresh();
                $this->lstDummyFiveMinutes->Refresh();
                break;
            case 'DUMMYSIX':
                $this->txtDummySix->Visible = false;
                $this->txtDummySix->Refresh();
                break;
            case 'ACCOUNT':
                $this->lstAccount->Visible = false;
                $this->lstAccount->Refresh();
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
            case 'DUMMYONE':
                $this->txtDummyOne->Visible = true;
                $this->txtDummyOne->Refresh();
                break;
            case 'DUMMYTWO':
                $this->lstDummyTwo->Visible = true;
                $this->lstDummyTwo->Refresh();
                break;
            case 'DUMMYTHREE':
                $this->txtDummyThree->Visible = true;
                $this->txtDummyThree->Refresh();
                break;
            case 'DUMMYFOUR':
                $this->btnDummyFour->Visible = true;
                $this->btnDummyFour->Refresh();
                break;
            case 'DUMMYFIVE':
                $this->txtDummyFive->Visible = true;
                $this->txtDummyFive->Refresh();
                break;
            case 'DUMMYFIVETIME':
                $this->lstDummyFiveHours->Visible = true;
                $this->lstDummyFiveMinutes->Visible = true;
                $this->lstDummyFiveHours->Refresh();
                $this->lstDummyFiveMinutes->Refresh();
                break;
            case 'DUMMYSIX':
                $this->txtDummySix->Visible = true;
                $this->txtDummySix->Refresh();
                break;
            case 'ACCOUNT':
                $this->lstAccount->Visible = true;
                $this->lstAccount->Refresh();
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
        return $this->txtDummyOne->getJqControlId();
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

    public function applyValuesBeforeSaveObject($Account = null,$UserRole = null)  {
        if (!$this->Object)
            $this->Object = new PlaceHolder();
        
        if (strlen($this->txtDummyOne->Text) > 0) {
            $this->Object->DummyOne = new QDateTime($this->txtDummyOne->Text);
        }
        $this->Object->DummyTwo = $this->lstDummyTwo->SelectedValue;
        $this->Object->DummyThree = $this->txtDummyThree->Text;
        $this->Object->DummyFour = $this->btnDummyFour->IsToggled?1:0;
        if (strlen($this->txtDummyFive->Text) > 0) {
            if ($this->lstDummyFiveHours->SelectedIndex > 0)
                $this->Object->DummyFive = new QDateTime($this->txtDummyFive->Text.' '.$this->lstDummyFiveHours->SelectedValue.':'.$this->lstDummyFiveMinutes->SelectedValue);
            else
                $this->Object->DummyFive = new QDateTime($this->txtDummyFive->Text);
        }
        $this->Object->DummySix = $this->txtDummySix->Text;
        if ($Account) {
            $this->Object->AccountObject = $Account;
        }
        if ($this->saveUsingLstAccount) {
            $linkedAccount = Account::Load($this->lstAccount->SelectedValue);
            $this->Object->AccountObject = $linkedAccount;
        }
        if ($UserRole) {
            $this->Object->UserRoleObject = $UserRole;
        }
        if ($this->saveUsingLstUserRole) {
            $linkedUserRole = UserRole::Load($this->lstUserRole->SelectedValue);
            $this->Object->UserRoleObject = $linkedUserRole;
        }
    }

    public function saveObject($validate = true,$Account = null,$UserRole = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($Account,$UserRole);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtDummyOne);
        // Example of validating a field as required
        //AppSpecificFunctions::ExecuteJavaScript('removeValidationStateFromInput(''.$this->txtUsername->getJqControlId().'')');
        /*if (!$this->lstDummyTwo->SelectedValue){
            AppSpecificFunctions::ExecuteJavaScript('addValidationStateToInput(''.$this->txtUsername->getJqControlId().'','Required')');
            $hasNoErrors = false;
        }*/
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtDummyThree);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtDummyFive);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtDummySix);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtDummyOne->WrapperCssClass = 'form-group';
            $this->txtDummyOne->Placeholder = '';
            $this->lstDummyTwo->WrapperCssClass = 'form-group';
            $this->txtDummyThree->WrapperCssClass = 'form-group';
            $this->txtDummyThree->Placeholder = '';
            $this->txtDummyFive->WrapperCssClass = 'form-group';
            $this->txtDummyFive->Placeholder = '';
            $this->txtDummySix->WrapperCssClass = 'form-group';
            $this->txtDummySix->Placeholder = '';
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
            $previousValues = PlaceHolder::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'DummyOne-> Value before: '.$previousValues->DummyOne.', Value after: '.$this->Object->DummyOne.'<br>
        DummyTwo-> Value before: '.$previousValues->DummyTwo.', Value after: '.$this->Object->DummyTwo.'<br>
        DummyThree-> Value before: '.$previousValues->DummyThree.', Value after: '.$this->Object->DummyThree.'<br>
        DummyFour-> Value before: '.$previousValues->DummyFour.', Value after: '.$this->Object->DummyFour.'<br>
        DummyFive-> Value before: '.$previousValues->DummyFive.', Value after: '.$this->Object->DummyFive.'<br>
        DummySix-> Value before: '.$previousValues->DummySix.', Value after: '.$this->Object->DummySix.'<br>
        ';
        } else {
        $changeText = 'DummyOne-> Value: '.$this->Object->DummyOne.'<br>
        DummyTwo-> Value: '.$this->Object->DummyTwo.'<br>
        DummyThree-> Value: '.$this->Object->DummyThree.'<br>
        DummyFour-> Value: '.$this->Object->DummyFour.'<br>
        DummyFive-> Value: '.$this->Object->DummyFive.'<br>
        DummySix-> Value: '.$this->Object->DummySix.'<br>
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
            $AuditLogEntry->ObjectName = 'PlaceHolder';
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
                $AuditLogEntry->ObjectName = 'PlaceHolder';
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