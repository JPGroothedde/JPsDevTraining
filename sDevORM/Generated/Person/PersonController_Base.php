<?php
class PersonController_Base {
    protected $Object;
    public $txtFirstName;
    public $txtSurname;
    public $txtIDPassportNumber;
    public $txtDateOfBirth;
    public $txtTelephoneNumber;
    public $txtAlternativeTelephoneNumber;
    public $txtNationality;
    public $txtEthnicGroup;
    public $txtDriversLicense;
    public $txtCurrentAddress;
    public $btnPhoneVerified;
    public $btnIdentityVerified;
    public $btnDriversLicenseVerified;
    public $lstFileDocument,$saveUsingLstFileDocument = false;
    
    public function __construct($objParentObject,$InitObject = null) {
        $this->txtFirstName = new QTextBox($objParentObject);
        $this->txtFirstName->Name = 'First Name';

        $this->txtSurname = new QTextBox($objParentObject);
        $this->txtSurname->Name = 'Surname';

        $this->txtIDPassportNumber = new QTextBox($objParentObject);
        $this->txtIDPassportNumber->Name = 'ID Passport Number';

        $this->txtDateOfBirth = new QTextBox($objParentObject);
        $this->txtDateOfBirth->Name = 'Date Of Birth';
        $this->txtDateOfBirth->CssClass = 'form-control input-date';

        $this->txtTelephoneNumber = new QTextBox($objParentObject);
        $this->txtTelephoneNumber->Name = 'Telephone Number';

        $this->txtAlternativeTelephoneNumber = new QTextBox($objParentObject);
        $this->txtAlternativeTelephoneNumber->Name = 'Alternative Telephone Number';

        $this->txtNationality = new QTextBox($objParentObject);
        $this->txtNationality->Name = 'Nationality';

        $this->txtEthnicGroup = new QTextBox($objParentObject);
        $this->txtEthnicGroup->Name = 'Ethnic Group';

        $this->txtDriversLicense = new QTextBox($objParentObject);
        $this->txtDriversLicense->Name = 'Drivers License';

        $this->txtCurrentAddress = new QTextBox($objParentObject);
        $this->txtCurrentAddress->Name = 'Current Address';

        $this->btnPhoneVerified = new QButton($objParentObject);
        $this->btnPhoneVerified->Name = 'Phone Verified';
        $this->btnPhoneVerified->HtmlEntities = false;
        $trueLabel = 'Phone # Verified';
        $falseLabel = 'Phone # Verified';
        if (strlen($trueLabel) < 1)
            $trueLabel = null;
        if (strlen($falseLabel) < 1)
            $falseLabel = null;
        $this->btnPhoneVerified->setAsToggle(true,$trueLabel,$falseLabel);
        $this->btnPhoneVerified->DisplayStyle = QDisplayStyle::Block;
        $this->btnPhoneVerified->AddAction(new QClickEvent(), new QAjaxAction('btnPhoneVerified_Clicked'));//btnPhoneVerified_Clicked must be implemented in Page Controller class (QForm class)

        $this->btnIdentityVerified = new QButton($objParentObject);
        $this->btnIdentityVerified->Name = 'Identity Verified';
        $this->btnIdentityVerified->HtmlEntities = false;
        $trueLabel = 'Identity Verified';
        $falseLabel = 'Identity Verified';
        if (strlen($trueLabel) < 1)
            $trueLabel = null;
        if (strlen($falseLabel) < 1)
            $falseLabel = null;
        $this->btnIdentityVerified->setAsToggle(true,$trueLabel,$falseLabel);
        $this->btnIdentityVerified->DisplayStyle = QDisplayStyle::Block;
        $this->btnIdentityVerified->AddAction(new QClickEvent(), new QAjaxAction('btnIdentityVerified_Clicked'));//btnIdentityVerified_Clicked must be implemented in Page Controller class (QForm class)

        $this->btnDriversLicenseVerified = new QButton($objParentObject);
        $this->btnDriversLicenseVerified->Name = 'Drivers License Verified';
        $this->btnDriversLicenseVerified->HtmlEntities = false;
        $trueLabel = 'Driver\'s License';
        $falseLabel = 'Driver\'s License';
        if (strlen($trueLabel) < 1)
            $trueLabel = null;
        if (strlen($falseLabel) < 1)
            $falseLabel = null;
        $this->btnDriversLicenseVerified->setAsToggle(true,$trueLabel,$falseLabel);
        $this->btnDriversLicenseVerified->DisplayStyle = QDisplayStyle::Block;
        $this->btnDriversLicenseVerified->AddAction(new QClickEvent(), new QAjaxAction('btnDriversLicenseVerified_Clicked'));//btnDriversLicenseVerified_Clicked must be implemented in Page Controller class (QForm class)

        $this->lstFileDocument = new QListBox($objParentObject);
        $this->lstFileDocument->Name = 'File Document';
        $this->lstFileDocument->AddCssClass('fullWidth');
        // This is limited to 20 objects to ensure no memory overrun for huge data sets. Customise if so desired...
        $allFileDocument = FileDocument::LoadAll(QQ::Clause(QQ::LimitInfo(20)));
        foreach ($allFileDocument as $FileDocument) {
            $this->lstFileDocument->AddItem(new QListItem($FileDocument->Id,$FileDocument->Id));
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
            if ($ReferenceObject == 'FileDocument') {
                $this->lstFileDocument->RemoveAllItems();
                $allFileDocument_list = FileDocument::LoadAll();
                foreach ($allFileDocument_list as $FileDocument) {
                    $this->lstFileDocument->AddItem(new QListItem($FileDocument->__get($ReferenceAttribute),$FileDocument->Id));
                }
            }
        }
    }

    public function setOverrideSaveForReferenceObject($ReferenceObject = null,$useListValue = true) {
        if ($ReferenceObject) {
            if ($ReferenceObject == 'FileDocument') {
                $this->saveUsingLstFileDocument = $useListValue;
            }
        }
    }

    public function setValues($Object) {
        $this->txtFirstName->Text = '';
        $this->txtSurname->Text = '';
        $this->txtIDPassportNumber->Text = '';
        $this->txtDateOfBirth->Text = '';
        $this->txtTelephoneNumber->Text = '';
        $this->txtAlternativeTelephoneNumber->Text = '';
        $this->txtNationality->Text = '';
        $this->txtEthnicGroup->Text = '';
        $this->txtDriversLicense->Text = '';
        $this->txtCurrentAddress->Text = '';
        
        $this->btnPhoneVerified->IsToggled = false;
        
        $this->btnIdentityVerified->IsToggled = false;
        
        $this->btnDriversLicenseVerified->IsToggled = false;

        if (!$Object) {
            $this->refreshAll();
            return;
        }
        if (!is_null($Object->FirstName)) {
            $this->txtFirstName->Text = $Object->FirstName;
        }
        if (!is_null($Object->Surname)) {
            $this->txtSurname->Text = $Object->Surname;
        }
        if (!is_null($Object->IDPassportNumber)) {
            $this->txtIDPassportNumber->Text = $Object->IDPassportNumber;
        }
        if (!is_null($Object->DateOfBirth)) {
            $this->txtDateOfBirth->Text = $Object->DateOfBirth->format(DATE_TIME_FORMAT_HTML);
        }
        if (!is_null($Object->TelephoneNumber)) {
            $this->txtTelephoneNumber->Text = $Object->TelephoneNumber;
        }
        if (!is_null($Object->AlternativeTelephoneNumber)) {
            $this->txtAlternativeTelephoneNumber->Text = $Object->AlternativeTelephoneNumber;
        }
        if (!is_null($Object->Nationality)) {
            $this->txtNationality->Text = $Object->Nationality;
        }
        if (!is_null($Object->EthnicGroup)) {
            $this->txtEthnicGroup->Text = $Object->EthnicGroup;
        }
        if (!is_null($Object->DriversLicense)) {
            $this->txtDriversLicense->Text = $Object->DriversLicense;
        }
        if (!is_null($Object->CurrentAddress)) {
            $this->txtCurrentAddress->Text = $Object->CurrentAddress;
        }
        if ($Object->PhoneVerified == 1) {
            $this->btnPhoneVerified->Toggle();
        } else {
            $this->btnPhoneVerified->Toggle(false);
        }
        if ($Object->IdentityVerified == 1) {
            $this->btnIdentityVerified->Toggle();
        } else {
            $this->btnIdentityVerified->Toggle(false);
        }
        if ($Object->DriversLicenseVerified == 1) {
            $this->btnDriversLicenseVerified->Toggle();
        } else {
            $this->btnDriversLicenseVerified->Toggle(false);
        }
        
        if (!is_null($Object->FileDocumentObject)) {
            $this->lstFileDocument->SelectedValue = $Object->FileDocumentObject->Id;
        }

        $this->resetValidation();
        $this->refreshAll();
    }

    

    public function renderControl($strControl = '',$withName = true,$nameValue = '',$blnPrintOutput = true) {
        $output = '';
        if (strtoupper($strControl) == 'FIRSTNAME') {
            if (strlen($nameValue) > 0)
                $this->txtFirstName->Name = $nameValue;
            $output = $withName ? $this->txtFirstName->RenderWithName($blnPrintOutput):$this->txtFirstName->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'SURNAME') {
            if (strlen($nameValue) > 0)
                $this->txtSurname->Name = $nameValue;
            $output = $withName ? $this->txtSurname->RenderWithName($blnPrintOutput):$this->txtSurname->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'IDPASSPORTNUMBER') {
            if (strlen($nameValue) > 0)
                $this->txtIDPassportNumber->Name = $nameValue;
            $output = $withName ? $this->txtIDPassportNumber->RenderWithName($blnPrintOutput):$this->txtIDPassportNumber->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DATEOFBIRTH') {
            if (strlen($nameValue) > 0)
                $this->txtDateOfBirth->Name = $nameValue;
            $output = $withName ? $this->txtDateOfBirth->RenderWithName($blnPrintOutput):$this->txtDateOfBirth->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'TELEPHONENUMBER') {
            if (strlen($nameValue) > 0)
                $this->txtTelephoneNumber->Name = $nameValue;
            $output = $withName ? $this->txtTelephoneNumber->RenderWithName($blnPrintOutput):$this->txtTelephoneNumber->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ALTERNATIVETELEPHONENUMBER') {
            if (strlen($nameValue) > 0)
                $this->txtAlternativeTelephoneNumber->Name = $nameValue;
            $output = $withName ? $this->txtAlternativeTelephoneNumber->RenderWithName($blnPrintOutput):$this->txtAlternativeTelephoneNumber->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'NATIONALITY') {
            if (strlen($nameValue) > 0)
                $this->txtNationality->Name = $nameValue;
            $output = $withName ? $this->txtNationality->RenderWithName($blnPrintOutput):$this->txtNationality->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'ETHNICGROUP') {
            if (strlen($nameValue) > 0)
                $this->txtEthnicGroup->Name = $nameValue;
            $output = $withName ? $this->txtEthnicGroup->RenderWithName($blnPrintOutput):$this->txtEthnicGroup->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DRIVERSLICENSE') {
            if (strlen($nameValue) > 0)
                $this->txtDriversLicense->Name = $nameValue;
            $output = $withName ? $this->txtDriversLicense->RenderWithName($blnPrintOutput):$this->txtDriversLicense->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'CURRENTADDRESS') {
            if (strlen($nameValue) > 0)
                $this->txtCurrentAddress->Name = $nameValue;
            $output = $withName ? $this->txtCurrentAddress->RenderWithName($blnPrintOutput):$this->txtCurrentAddress->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'PHONEVERIFIED') {
            if (strlen($nameValue) > 0)
                $this->btnPhoneVerified->Name = $nameValue;
            $output = $withName ? $this->btnPhoneVerified->RenderWithName($blnPrintOutput):$this->btnPhoneVerified->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'IDENTITYVERIFIED') {
            if (strlen($nameValue) > 0)
                $this->btnIdentityVerified->Name = $nameValue;
            $output = $withName ? $this->btnIdentityVerified->RenderWithName($blnPrintOutput):$this->btnIdentityVerified->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'DRIVERSLICENSEVERIFIED') {
            if (strlen($nameValue) > 0)
                $this->btnDriversLicenseVerified->Name = $nameValue;
            $output = $withName ? $this->btnDriversLicenseVerified->RenderWithName($blnPrintOutput):$this->btnDriversLicenseVerified->Render($blnPrintOutput);
        }
        if (strtoupper($strControl) == 'FILEDOCUMENT') {
            if (strlen($nameValue) > 0)
                $this->lstFileDocument->Name = $nameValue;
            $output = $withName ? $this->lstFileDocument->RenderWithName($blnPrintOutput):$this->lstFileDocument->Render($blnPrintOutput);
        }
        
        return $output;
    }

    public function renderAll($withName = true)  {
        $this->renderControl('FIRSTNAME',$withName);
        $this->renderControl('SURNAME',$withName);
        $this->renderControl('IDPASSPORTNUMBER',$withName);
        $this->renderControl('DATEOFBIRTH',$withName);
        $this->renderControl('TELEPHONENUMBER',$withName);
        $this->renderControl('ALTERNATIVETELEPHONENUMBER',$withName);
        $this->renderControl('NATIONALITY',$withName);
        $this->renderControl('ETHNICGROUP',$withName);
        $this->renderControl('DRIVERSLICENSE',$withName);
        $this->renderControl('CURRENTADDRESS',$withName);
        $this->renderControl('PHONEVERIFIED',$withName);
        $this->renderControl('IDENTITYVERIFIED',$withName);
        $this->renderControl('DRIVERSLICENSEVERIFIED',$withName);
        $this->renderControl('FILEDOCUMENT',$withName);
    }

    public function getRenderedFrontEnd($withName = true)  {
        $html = '<div class="row">
                <div class="col-md-6">
                   '.$this->renderControl('FirstName',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Surname',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('IDPassportNumber',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DateOfBirth',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('TelephoneNumber',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('AlternativeTelephoneNumber',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('Nationality',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('EthnicGroup',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DriversLicense',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('CurrentAddress',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('PhoneVerified',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('IdentityVerified',$withName, null, false).'
                </div>
                <div class="col-md-6">
                   '.$this->renderControl('DriversLicenseVerified',$withName, null, false).'
                </div>
            </div>';
        return $html;
    }

    public function hideAll() {
        $this->txtFirstName->Visible = false;
        $this->txtSurname->Visible = false;
        $this->txtIDPassportNumber->Visible = false;
        $this->txtDateOfBirth->Visible = false;
        $this->txtTelephoneNumber->Visible = false;
        $this->txtAlternativeTelephoneNumber->Visible = false;
        $this->txtNationality->Visible = false;
        $this->txtEthnicGroup->Visible = false;
        $this->txtDriversLicense->Visible = false;
        $this->txtCurrentAddress->Visible = false;
        $this->btnPhoneVerified->Visible = false;
        $this->btnIdentityVerified->Visible = false;
        $this->btnDriversLicenseVerified->Visible = false;
        $this->lstFileDocument->Visible = false;
    }

    public function showAll() {
        $this->txtFirstName->Visible = true;
        $this->txtSurname->Visible = true;
        $this->txtIDPassportNumber->Visible = true;
        $this->txtDateOfBirth->Visible = true;
        $this->txtTelephoneNumber->Visible = true;
        $this->txtAlternativeTelephoneNumber->Visible = true;
        $this->txtNationality->Visible = true;
        $this->txtEthnicGroup->Visible = true;
        $this->txtDriversLicense->Visible = true;
        $this->txtCurrentAddress->Visible = true;
        $this->btnPhoneVerified->Visible = true;
        $this->btnIdentityVerified->Visible = true;
        $this->btnDriversLicenseVerified->Visible = true;
        $this->lstFileDocument->Visible = true;
    }

    public function refreshAll() {
        $this->txtFirstName->Refresh();
        $this->txtSurname->Refresh();
        $this->txtIDPassportNumber->Refresh();
        $this->txtDateOfBirth->Refresh();
        $this->txtTelephoneNumber->Refresh();
        $this->txtAlternativeTelephoneNumber->Refresh();
        $this->txtNationality->Refresh();
        $this->txtEthnicGroup->Refresh();
        $this->txtDriversLicense->Refresh();
        $this->txtCurrentAddress->Refresh();
        $this->btnPhoneVerified->Refresh();
        $this->btnIdentityVerified->Refresh();
        $this->btnDriversLicenseVerified->Refresh();
        $this->lstFileDocument->Refresh();
    }

    public function setValue($strAttr = '',$value = null) {
        switch (strtoupper($strAttr)) {
            case '':
                break;
            case 'FIRSTNAME':
                $this->txtFirstName->Text = $value;
                break;
            case 'SURNAME':
                $this->txtSurname->Text = $value;
                break;
            case 'IDPASSPORTNUMBER':
                $this->txtIDPassportNumber->Text = $value;
                break;
            case 'DATEOFBIRTH':
                $this->txtDateOfBirth->Text = $value;
                break;
            case 'TELEPHONENUMBER':
                $this->txtTelephoneNumber->Text = $value;
                break;
            case 'ALTERNATIVETELEPHONENUMBER':
                $this->txtAlternativeTelephoneNumber->Text = $value;
                break;
            case 'NATIONALITY':
                $this->txtNationality->Text = $value;
                break;
            case 'ETHNICGROUP':
                $this->txtEthnicGroup->Text = $value;
                break;
            case 'DRIVERSLICENSE':
                $this->txtDriversLicense->Text = $value;
                break;
            case 'CURRENTADDRESS':
                $this->txtCurrentAddress->Text = $value;
                break;
            case 'PHONEVERIFIED':
                $this->btnPhoneVerified->IsToggled = $value;
                break;
            case 'IDENTITYVERIFIED':
                $this->btnIdentityVerified->IsToggled = $value;
                break;
            case 'DRIVERSLICENSEVERIFIED':
                $this->btnDriversLicenseVerified->IsToggled = $value;
                break;
            case 'FILEDOCUMENT':
                $this->lstFileDocument->SelectedValue = $value;
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
            case 'FIRSTNAME':
                if ($this->txtFirstName->Text)
                    return $this->txtFirstName->Text;
                break;
            case 'SURNAME':
                if ($this->txtSurname->Text)
                    return $this->txtSurname->Text;
                break;
            case 'IDPASSPORTNUMBER':
                if ($this->txtIDPassportNumber->Text)
                    return $this->txtIDPassportNumber->Text;
                break;
            case 'DATEOFBIRTH':
                if ($this->txtDateOfBirth->Text)
                    return $this->txtDateOfBirth->Text;
                break;
            case 'TELEPHONENUMBER':
                if ($this->txtTelephoneNumber->Text)
                    return $this->txtTelephoneNumber->Text;
                break;
            case 'ALTERNATIVETELEPHONENUMBER':
                if ($this->txtAlternativeTelephoneNumber->Text)
                    return $this->txtAlternativeTelephoneNumber->Text;
                break;
            case 'NATIONALITY':
                if ($this->txtNationality->Text)
                    return $this->txtNationality->Text;
                break;
            case 'ETHNICGROUP':
                if ($this->txtEthnicGroup->Text)
                    return $this->txtEthnicGroup->Text;
                break;
            case 'DRIVERSLICENSE':
                if ($this->txtDriversLicense->Text)
                    return $this->txtDriversLicense->Text;
                break;
            case 'CURRENTADDRESS':
                if ($this->txtCurrentAddress->Text)
                    return $this->txtCurrentAddress->Text;
                break;
            case 'PHONEVERIFIED':
                if ($this->btnPhoneVerified->IsToggled)
                    return $this->btnPhoneVerified->IsToggled;
                break;
            case 'IDENTITYVERIFIED':
                if ($this->btnIdentityVerified->IsToggled)
                    return $this->btnIdentityVerified->IsToggled;
                break;
            case 'DRIVERSLICENSEVERIFIED':
                if ($this->btnDriversLicenseVerified->IsToggled)
                    return $this->btnDriversLicenseVerified->IsToggled;
                break;
            case 'FILEDOCUMENT':
                if ($this->lstFileDocument->SelectedValue)
                    return $this->lstFileDocument->SelectedValue;
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
            case 'FIRSTNAME':
                if ($this->txtFirstName)
                    return $this->txtFirstName->ControlId;
                break;
            case 'SURNAME':
                if ($this->txtSurname)
                    return $this->txtSurname->ControlId;
                break;
            case 'IDPASSPORTNUMBER':
                if ($this->txtIDPassportNumber)
                    return $this->txtIDPassportNumber->ControlId;
                break;
            case 'DATEOFBIRTH':
                if ($this->txtDateOfBirth)
                    return $this->txtDateOfBirth->ControlId;
                break;
            case 'TELEPHONENUMBER':
                if ($this->txtTelephoneNumber)
                    return $this->txtTelephoneNumber->ControlId;
                break;
            case 'ALTERNATIVETELEPHONENUMBER':
                if ($this->txtAlternativeTelephoneNumber)
                    return $this->txtAlternativeTelephoneNumber->ControlId;
                break;
            case 'NATIONALITY':
                if ($this->txtNationality)
                    return $this->txtNationality->ControlId;
                break;
            case 'ETHNICGROUP':
                if ($this->txtEthnicGroup)
                    return $this->txtEthnicGroup->ControlId;
                break;
            case 'DRIVERSLICENSE':
                if ($this->txtDriversLicense)
                    return $this->txtDriversLicense->ControlId;
                break;
            case 'CURRENTADDRESS':
                if ($this->txtCurrentAddress)
                    return $this->txtCurrentAddress->ControlId;
                break;
            case 'PHONEVERIFIED':
                if ($this->btnPhoneVerified)
                    return $this->btnPhoneVerified->ControlId;
                break;
            case 'IDENTITYVERIFIED':
                if ($this->btnIdentityVerified)
                    return $this->btnIdentityVerified->ControlId;
                break;
            case 'DRIVERSLICENSEVERIFIED':
                if ($this->btnDriversLicenseVerified)
                    return $this->btnDriversLicenseVerified->ControlId;
                break;
            case 'FILEDOCUMENT':
                if ($this->lstFileDocument)
                    return $this->lstFileDocument->ControlId;
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
            case 'FIRSTNAME':
                $this->txtFirstName->Visible = false;
                $this->txtFirstName->Refresh();
                break;
            case 'SURNAME':
                $this->txtSurname->Visible = false;
                $this->txtSurname->Refresh();
                break;
            case 'IDPASSPORTNUMBER':
                $this->txtIDPassportNumber->Visible = false;
                $this->txtIDPassportNumber->Refresh();
                break;
            case 'DATEOFBIRTH':
                $this->txtDateOfBirth->Visible = false;
                $this->txtDateOfBirth->Refresh();
                break;
            case 'TELEPHONENUMBER':
                $this->txtTelephoneNumber->Visible = false;
                $this->txtTelephoneNumber->Refresh();
                break;
            case 'ALTERNATIVETELEPHONENUMBER':
                $this->txtAlternativeTelephoneNumber->Visible = false;
                $this->txtAlternativeTelephoneNumber->Refresh();
                break;
            case 'NATIONALITY':
                $this->txtNationality->Visible = false;
                $this->txtNationality->Refresh();
                break;
            case 'ETHNICGROUP':
                $this->txtEthnicGroup->Visible = false;
                $this->txtEthnicGroup->Refresh();
                break;
            case 'DRIVERSLICENSE':
                $this->txtDriversLicense->Visible = false;
                $this->txtDriversLicense->Refresh();
                break;
            case 'CURRENTADDRESS':
                $this->txtCurrentAddress->Visible = false;
                $this->txtCurrentAddress->Refresh();
                break;
            case 'PHONEVERIFIED':
                $this->btnPhoneVerified->Visible = false;
                $this->btnPhoneVerified->Refresh();
                break;
            case 'IDENTITYVERIFIED':
                $this->btnIdentityVerified->Visible = false;
                $this->btnIdentityVerified->Refresh();
                break;
            case 'DRIVERSLICENSEVERIFIED':
                $this->btnDriversLicenseVerified->Visible = false;
                $this->btnDriversLicenseVerified->Refresh();
                break;
            case 'FILEDOCUMENT':
                $this->lstFileDocument->Visible = false;
                $this->lstFileDocument->Refresh();
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
            case 'FIRSTNAME':
                $this->txtFirstName->Visible = true;
                $this->txtFirstName->Refresh();
                break;
            case 'SURNAME':
                $this->txtSurname->Visible = true;
                $this->txtSurname->Refresh();
                break;
            case 'IDPASSPORTNUMBER':
                $this->txtIDPassportNumber->Visible = true;
                $this->txtIDPassportNumber->Refresh();
                break;
            case 'DATEOFBIRTH':
                $this->txtDateOfBirth->Visible = true;
                $this->txtDateOfBirth->Refresh();
                break;
            case 'TELEPHONENUMBER':
                $this->txtTelephoneNumber->Visible = true;
                $this->txtTelephoneNumber->Refresh();
                break;
            case 'ALTERNATIVETELEPHONENUMBER':
                $this->txtAlternativeTelephoneNumber->Visible = true;
                $this->txtAlternativeTelephoneNumber->Refresh();
                break;
            case 'NATIONALITY':
                $this->txtNationality->Visible = true;
                $this->txtNationality->Refresh();
                break;
            case 'ETHNICGROUP':
                $this->txtEthnicGroup->Visible = true;
                $this->txtEthnicGroup->Refresh();
                break;
            case 'DRIVERSLICENSE':
                $this->txtDriversLicense->Visible = true;
                $this->txtDriversLicense->Refresh();
                break;
            case 'CURRENTADDRESS':
                $this->txtCurrentAddress->Visible = true;
                $this->txtCurrentAddress->Refresh();
                break;
            case 'PHONEVERIFIED':
                $this->btnPhoneVerified->Visible = true;
                $this->btnPhoneVerified->Refresh();
                break;
            case 'IDENTITYVERIFIED':
                $this->btnIdentityVerified->Visible = true;
                $this->btnIdentityVerified->Refresh();
                break;
            case 'DRIVERSLICENSEVERIFIED':
                $this->btnDriversLicenseVerified->Visible = true;
                $this->btnDriversLicenseVerified->Refresh();
                break;
            case 'FILEDOCUMENT':
                $this->lstFileDocument->Visible = true;
                $this->lstFileDocument->Refresh();
                break;
            default:
                break;
        }
        return null;
    }


    public function getFocusControlId() {
        return $this->txtFirstName->getJqControlId();
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

    public function applyValuesBeforeSaveObject($FileDocument = null)  {
        if (!$this->Object)
            $this->Object = new Person();
        
        $this->Object->FirstName = $this->txtFirstName->Text;
        $this->Object->Surname = $this->txtSurname->Text;
        $this->Object->IDPassportNumber = $this->txtIDPassportNumber->Text;
        if (strlen($this->txtDateOfBirth->Text) > 0) {
            $this->Object->DateOfBirth = new QDateTime($this->txtDateOfBirth->Text);
        }
        $this->Object->TelephoneNumber = $this->txtTelephoneNumber->Text;
        $this->Object->AlternativeTelephoneNumber = $this->txtAlternativeTelephoneNumber->Text;
        $this->Object->Nationality = $this->txtNationality->Text;
        $this->Object->EthnicGroup = $this->txtEthnicGroup->Text;
        $this->Object->DriversLicense = $this->txtDriversLicense->Text;
        $this->Object->CurrentAddress = $this->txtCurrentAddress->Text;
        $this->Object->PhoneVerified = $this->btnPhoneVerified->IsToggled?1:0;
        $this->Object->IdentityVerified = $this->btnIdentityVerified->IsToggled?1:0;
        $this->Object->DriversLicenseVerified = $this->btnDriversLicenseVerified->IsToggled?1:0;
        if ($FileDocument) {
            $this->Object->FileDocumentObject = $FileDocument;
        }
        if ($this->saveUsingLstFileDocument) {
            $linkedFileDocument = FileDocument::Load($this->lstFileDocument->SelectedValue);
            $this->Object->FileDocumentObject = $linkedFileDocument;
        }
    }

    public function saveObject($validate = true,$FileDocument = null)  {
        if ($validate){
            if (!$this->validateObject())
                return false;
        }
        $this->applyValuesBeforeSaveObject($FileDocument);
        
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
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtFirstName);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtSurname);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtIDPassportNumber);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtDateOfBirth);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtTelephoneNumber);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtAlternativeTelephoneNumber);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtNationality);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtEthnicGroup);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtDriversLicense);
        // Example of validating a field as required
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsRequired($this->txtCurrentAddress);
        // Example of validating an email address
        //$hasNoErrors &= AppSpecificFunctions::validateFieldAsEmailAddress($this->[FieldName]);';
        return $hasNoErrors;
    }

    public function resetValidation()  {
            $this->txtFirstName->WrapperCssClass = 'form-group';
            $this->txtFirstName->Placeholder = '';
            $this->txtSurname->WrapperCssClass = 'form-group';
            $this->txtSurname->Placeholder = '';
            $this->txtIDPassportNumber->WrapperCssClass = 'form-group';
            $this->txtIDPassportNumber->Placeholder = '';
            $this->txtDateOfBirth->WrapperCssClass = 'form-group';
            $this->txtDateOfBirth->Placeholder = '';
            $this->txtTelephoneNumber->WrapperCssClass = 'form-group';
            $this->txtTelephoneNumber->Placeholder = '';
            $this->txtAlternativeTelephoneNumber->WrapperCssClass = 'form-group';
            $this->txtAlternativeTelephoneNumber->Placeholder = '';
            $this->txtNationality->WrapperCssClass = 'form-group';
            $this->txtNationality->Placeholder = '';
            $this->txtEthnicGroup->WrapperCssClass = 'form-group';
            $this->txtEthnicGroup->Placeholder = '';
            $this->txtDriversLicense->WrapperCssClass = 'form-group';
            $this->txtDriversLicense->Placeholder = '';
            $this->txtCurrentAddress->WrapperCssClass = 'form-group';
            $this->txtCurrentAddress->Placeholder = '';
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
            $previousValues = Person::Load($this->Object->Id);
        $changeText = '';
        if ($previousValues) {
        $changeText = 'FirstName-> Value before: '.$previousValues->FirstName.', Value after: '.$this->Object->FirstName.'<br>
        Surname-> Value before: '.$previousValues->Surname.', Value after: '.$this->Object->Surname.'<br>
        IDPassportNumber-> Value before: '.$previousValues->IDPassportNumber.', Value after: '.$this->Object->IDPassportNumber.'<br>
        DateOfBirth-> Value before: '.$previousValues->DateOfBirth.', Value after: '.$this->Object->DateOfBirth.'<br>
        TelephoneNumber-> Value before: '.$previousValues->TelephoneNumber.', Value after: '.$this->Object->TelephoneNumber.'<br>
        AlternativeTelephoneNumber-> Value before: '.$previousValues->AlternativeTelephoneNumber.', Value after: '.$this->Object->AlternativeTelephoneNumber.'<br>
        Nationality-> Value before: '.$previousValues->Nationality.', Value after: '.$this->Object->Nationality.'<br>
        EthnicGroup-> Value before: '.$previousValues->EthnicGroup.', Value after: '.$this->Object->EthnicGroup.'<br>
        DriversLicense-> Value before: '.$previousValues->DriversLicense.', Value after: '.$this->Object->DriversLicense.'<br>
        CurrentAddress-> Value before: '.$previousValues->CurrentAddress.', Value after: '.$this->Object->CurrentAddress.'<br>
        PhoneVerified-> Value before: '.$previousValues->PhoneVerified.', Value after: '.$this->Object->PhoneVerified.'<br>
        IdentityVerified-> Value before: '.$previousValues->IdentityVerified.', Value after: '.$this->Object->IdentityVerified.'<br>
        DriversLicenseVerified-> Value before: '.$previousValues->DriversLicenseVerified.', Value after: '.$this->Object->DriversLicenseVerified.'<br>
        ';
        } else {
        $changeText = 'FirstName-> Value: '.$this->Object->FirstName.'<br>
        Surname-> Value: '.$this->Object->Surname.'<br>
        IDPassportNumber-> Value: '.$this->Object->IDPassportNumber.'<br>
        DateOfBirth-> Value: '.$this->Object->DateOfBirth.'<br>
        TelephoneNumber-> Value: '.$this->Object->TelephoneNumber.'<br>
        AlternativeTelephoneNumber-> Value: '.$this->Object->AlternativeTelephoneNumber.'<br>
        Nationality-> Value: '.$this->Object->Nationality.'<br>
        EthnicGroup-> Value: '.$this->Object->EthnicGroup.'<br>
        DriversLicense-> Value: '.$this->Object->DriversLicense.'<br>
        CurrentAddress-> Value: '.$this->Object->CurrentAddress.'<br>
        PhoneVerified-> Value: '.$this->Object->PhoneVerified.'<br>
        IdentityVerified-> Value: '.$this->Object->IdentityVerified.'<br>
        DriversLicenseVerified-> Value: '.$this->Object->DriversLicenseVerified.'<br>
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
            $AuditLogEntry->ObjectName = 'Person';
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
                $AuditLogEntry->ObjectName = 'Person';
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