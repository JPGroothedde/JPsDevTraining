<?php
require('../../sdev.inc.php');
require(__SDEV_ORM__.'/Implementations/Person/PersonController.php');
require(__SDEV_ORM__.'/Implementations/EmploymentHistory/EmploymentHistoryController.php');
require(__SDEV_ORM__.'/Implementations/Education/EducationController.php');
require('File_Uploader.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
//AppSpecificFunctions::CheckRemoteAdmin();
class Person_DetailForm extends QForm {
    protected $PersonInstance;
    protected $EmploymentHistoryInstance;
	protected $EducationInstance;
	protected $PersonId;
	
	protected $txtFirstName;
	protected $txtSurname;
	protected $txtIDPassportNumber;
	protected $txtDateOfBirth;
	protected $txtTelephoneNumber;
	protected $txtAlternativeTelephoneNumber;
	protected $txtNationality;
	protected $txtLanguage;
	protected $txtEthnicGroup;
	protected $txtDriversLicense;
	protected $txtCurrentAddress;
	
	protected $txtPeriodStartDate;
	protected $txtPeriodEndDate;
	protected $txtEmployerName;
	protected $txtTitle;
	protected $txtDuties;

	protected $txtInstitution;
	protected $txtStartDate;
	protected $txtEndDate;
	protected $txtQualification;
	
	protected $btnPersonNextButton;
	protected $btnPersonEmploymentNextButton;
	protected $btnSaveNewPerson;
	protected $btnAddIdPassportDriversLicense;
	protected $btnViewIdPassport;
	protected $btnViewDriversLicense;
	
	protected $checkboxIdVerified;
	protected $checkboxPhoneNumberVerified;
	protected $checkboxDriversLicense;
	protected $listIdPassportDriversLicense;
	
	protected $fileUploader;
	protected $sh_Feedback;
	protected $btnInvokeFileUpload;
	protected $btnUploadVIPPhoto;
    //Mobile detection
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonInstance();
	    $this->InitEmploymentHistoryInstance();
	    $this->InitEducationInstance();
	    $this->InitFileUploader();
		
        //$objId = AppSpecificFunctions::PathInfo(0);
    }
    protected function InitPersonInstance() {
        $this->PersonInstance = new PersonController($this);
        
	    $this->listIdPassportDriversLicense = new QListBox($this);
        $this->listIdPassportDriversLicense->AddItems(array('Please Select','ID / Passport','Drivers License'));
        $this->listIdPassportDriversLicense->Required;
        
        
        $this->checkboxDriversLicense = new QCheckBox($this);
        $this->checkboxDriversLicense->Text = "Driver's License";
        
        $this->checkboxPhoneNumberVerified = new QCheckBox($this);
        $this->checkboxPhoneNumberVerified->Text = 'Phone Number Verified';
        
        $this->checkboxIdVerified = new QCheckBox($this);
        $this->checkboxIdVerified->Text = 'Identity Verified';
	
	    $this->btnViewDriversLicense = new QButton($this);
	    $this->btnViewDriversLicense->Text = 'VIEW';
	    $this->btnViewDriversLicense->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        
        $this->btnViewIdPassport = new QButton($this);
        $this->btnViewIdPassport->Text = 'VIEW';
        $this->btnViewIdPassport->CssClass = 'btn btn-primary mrg-top10 rippleclick';
		
        $this->btnAddIdPassportDriversLicense = new QButton($this);
        $this->btnAddIdPassportDriversLicense->Text = 'ADD ANOTHER';
        $this->btnAddIdPassportDriversLicense->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnAddIdPassportDriversLicense->AddAction(new QClickEvent, new QAjaxAction('btnAddPassportDriversLicense_clicked'));
        
        $this->btnPersonNextButton = new QButton($this);
        $this->btnPersonNextButton->Text = 'NEXT';
        $this->btnPersonNextButton->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnPersonNextButton->AddAction(new QClickEvent(), new QAjaxAction('btnPersonNext_Clicked'));
        
	    $this->txtFirstName = new QTextBox($this);
	    $this->txtFirstName->Name = 'Name';
	
	    $this->txtSurname = new QTextBox($this);
	    $this->txtSurname->Name = 'Surname';
	
	    $this->txtIDPassportNumber = new QTextBox($this);
	    $this->txtIDPassportNumber->Name = 'ID Passport Number';
	
	    $this->txtDateOfBirth = new QTextBox($this);
	    $this->txtDateOfBirth->Name = 'Date Of Birth';
	    $this->txtDateOfBirth->CssClass = 'form-control input-date';
	
	    $this->txtTelephoneNumber = new QTextBox($this);
	    $this->txtTelephoneNumber->Name = 'Telephone Number';
	
	    $this->txtAlternativeTelephoneNumber = new QTextBox($this);
	    $this->txtAlternativeTelephoneNumber->Name = 'Alternative Telephone Number';
	
	    $this->txtNationality = new QTextBox($this);
	    $this->txtNationality->Name = 'Nationality';
	
	    $this->txtLanguage = new QTextBox($this);
	    $this->txtLanguage->Name = 'Languages';
	
	    $this->txtEthnicGroup = new QTextBox($this);
	    $this->txtEthnicGroup->Name = 'Ethnic Group';
	
	    $this->txtDriversLicense = new QTextBox($this);
	    $this->txtDriversLicense->Name = 'Drivers License';
	
	    $this->txtCurrentAddress = new QTextBox($this);
	    $this->txtCurrentAddress->Name = 'Current Address';
	    $this->txtCurrentAddress->TextMode = 'MultiLine';
	    $this->txtCurrentAddress->Rows  = 5;
    }
    protected  function btnPersonNext_Clicked($strFormId,$strControld,$strParameter) {
	    $FirstNameValidate      = AppSpecificFunctions::validateFieldAsRequired($this->txtFirstName);
	    $SurnameValidate        = AppSpecificFunctions::validateFieldAsRequired($this->txtSurname);
	    $DateOfBirthValidate    = AppSpecificFunctions::validateFieldAsRequired($this->txtDateOfBirth);
	    $IDNumberValidate       = AppSpecificFunctions::validateFieldAsRequired($this->txtIDPassportNumber);
	    if ($FirstNameValidate!='' && $SurnameValidate != '' && ($DateOfBirthValidate != '' || $IDNumberValidate != 0)) {
		    $PersonObj = new Person();
		    $PersonObj->FirstName = $this->txtFirstName->Text;
		    $PersonObj->Surname = $this->txtSurname->Text;
		    $PersonObj->DateOfBirth = new QDateTime($this->txtDateOfBirth->Text);
		    $PersonObj->IDPassportNumber = $this->txtIDPassportNumber->Text;
		    $PersonObj->TelephoneNumber = $this->txtTelephoneNumber->Text;
		    $PersonObj->AlternativeTelephoneNumber = $this->txtAlternativeTelephoneNumber->Text;
		    $PersonObj->Nationality = $this->txtNationality->Text;
		    $PersonObj->EthnicGroup = $this->txtEthnicGroup->Text;
		    $PersonObj->DriversLicense = $this->txtDriversLicense->Text;
		    $PersonObj->CurrentAddress = $this->txtCurrentAddress->Text;
		    try {
			    $PersonObj->Save();
		    } catch(QCallerException $e) {
			
		    }
		    $this->PersonId = $PersonObj->Id;
		    $this->txtFirstName->Text = '';
		    $this->txtSurname->Text = '';
		    $this->txtDateOfBirth->Text = '';
		    $this->txtIDPassportNumber->Text = '';
		    $this->txtTelephoneNumber->Text = '';
		    $this->txtAlternativeTelephoneNumber->Text = '';
		    $this->txtNationality->Text = '';
		    $this->txtEthnicGroup->Text = '';
		    $this->txtDriversLicense->Text = '';
		    $this->txtCurrentAddress->Text = '';
		    $js = "$('#captureNewPerson a[href=\"#Person_Employment-History\"]').tab('show')";
		    AppSpecificFunctions::ExecuteJavaScript($js);
		    
	    }  else {
		    AppSpecificFunctions::ShowNotedFeedback('First name, Surname and Date of Birth or ID Number needs to be supplied....',false);
		    $js = "$('#captureNewPerson a[href=\"#Person_Person-Details--Verification\"]').tab('show')";
		    AppSpecificFunctions::ExecuteJavaScript($js);
	    }
    }
	
	protected function InitEmploymentHistoryInstance() {
		$this->EmploymentHistoryInstance = new EmploymentHistoryController($this);
		
		$this->btnPersonEmploymentNextButton = new QButton($this);
		$this->btnPersonEmploymentNextButton->Text = 'NEXT';
		$this->btnPersonEmploymentNextButton->CssClass = 'btn btn-primary mrg-top10 rippleclick';
		$this->btnPersonEmploymentNextButton->AddAction(new QClickEvent(), new QAjaxAction('btnPersonEmploymentNext_Clicked'));
		
		$this->txtPeriodStartDate = new QTextBox($this);
		$this->txtPeriodStartDate->Name = 'Period Start Date';
		$this->txtPeriodStartDate->CssClass = 'form-control input-date';
		
		$this->txtPeriodEndDate = new QTextBox($this);
		$this->txtPeriodEndDate->Name = 'Period End Date';
		$this->txtPeriodEndDate->CssClass = 'form-control input-date';
		
		$this->txtEmployerName = new QTextBox($this);
		$this->txtEmployerName->Name = 'Employer Name';
		
		$this->txtTitle = new QTextBox($this);
		$this->txtTitle->Name = 'Title';
		
		$this->txtDuties = new QTextBox($this);
		$this->txtDuties->Name = 'Duties';

	}
	protected function btnAddPassportDriversLicense_clicked ($strFormId,$strControlId,$strParameter) {
    	AppSpecificFunctions::ToggleModal('AddIDPassportDriversLicenseModal');
	}
	protected  function btnPersonEmploymentNext_Clicked($strFormId,$strControld,$strParameter) {
		if (!empty($this->PersonId)) {
			$EmploymentHistoryObj = new EmploymentHistory();
			$EmploymentHistoryObj->PersonObject = $this->PersonId;
			$EmploymentHistoryObj->PeriodStartDate = new QDateTime($this->txtPeriodStartDate->Text);
			$EmploymentHistoryObj->PeriodEndDate = new QDateTime($this->txtPeriodEndDate->Text);
			$EmploymentHistoryObj->EmployerName = $this->txtEmployerName->Text;
			$EmploymentHistoryObj->Title = $this->txtTitle->Text;
			$EmploymentHistoryObj->Duties = $this->txtDuties->Text;
			try {
				$EmploymentHistoryObj->Save();
			} catch(QCallerException $e) {
			
			}
			$this->txtPeriodStartDate->Text = '';
			$this->txtPeriodEndDate->Text = '';
			$this->txtEmployerName->Text = '';
			$this->txtTitle->Text = '';
			$this->txtDuties->Text = '';
			$js = "$('#captureNewPerson a[href=\"#Person_Education\"]').tab('show')";
			AppSpecificFunctions::ExecuteJavaScript($js);
		} else {
			AppSpecificFunctions::ShowNotedFeedback('Please complete step 1.',false);
			$js = "$('#captureNewPerson a[href=\"#Person_Person-Details--Verification\"]').tab('show')";
			AppSpecificFunctions::ExecuteJavaScript($js);
		}
	}
	
	protected function InitEducationInstance() {
		$this->EducationInstance = new EducationController($this);
		
		$this->btnSaveNewPerson = new QButton($this);
		$this->btnSaveNewPerson->Text = 'SAVE';
		$this->btnSaveNewPerson->CssClass = 'btn btn-primary mrg-top10 rippleclick';
		$this->btnSaveNewPerson->AddAction(new QClickEvent(), new QAjaxAction('btnSavePerson_Clicked'));
		
		$this->txtInstitution = new QTextBox($this);
		$this->txtInstitution->Name = 'Institution';
		
		$this->txtStartDate = new QTextBox($this);
		$this->txtStartDate->Name = 'Start Date';
		$this->txtStartDate->CssClass = 'form-control input-date';
		
		$this->txtEndDate = new QTextBox($this);
		$this->txtEndDate->Name = 'End Date';
		$this->txtEndDate->CssClass = 'form-control input-date';
		
		$this->txtQualification = new QTextBox($this);
		$this->txtQualification->Name = 'Qualification';
		
	}
	protected  function btnSavePerson_Clicked($strFormId,$strControlId,$strParameter) {
		if (!empty($this->PersonId)) {
			$EducationObj = new Education();
			$EducationObj->PersonObject = $this->PersonId;
			$EducationObj->Institution = $this->txtInstitution->Text;
			$EducationObj->StartDate = new QDateTime($this->txtStartDate->Text);
			$EducationObj->EndDate = new QDateTime($this->txtEndDate->Text);
			$EducationObj->Qualification = $this->txtQualification->Text;
			try {
				$EducationObj->Save();
			} catch(QCallerException $e) {
			
			}
			$this->txtInstitution->Text = '';
			$this->txtStartDate->Text = '';
			$this->txtEndDate->Text = '';
			$this->txtQualification->Text = '';
			AppSpecificFunctions::ShowNotedFeedback('New VIP has been created.');
		} else {
			AppSpecificFunctions::ShowNotedFeedback('Please complete step 1.',false);
			$js = "$('#captureNewPerson a[href=\"#Person_Person-Details--Verification\"]').tab('show')";
			AppSpecificFunctions::ExecuteJavaScript($js);
		}
	}
	
    protected function executeParentFunction($parentFormId, $strControlId, $strParameter) {
        $js = 'window.parent.window.executeFormAction(\''.$parentFormId.'\',\''.$strControlId.'\',\''.$strParameter.'\');';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
	
	protected function InitFileUploader() {
		$this->fileUploader = new FileUploader($this,null,'fileUploaded');
		$this->btnUploadVIPPhoto = new QButton($this);
		$this->btnUploadVIPPhoto->Text = 'Upload Photo';
		$this->btnUploadVIPPhoto->CssClass = 'btn btn-primary mrg-top10 rippleclick';
		$this->sh_Feedback = new sUIElementsBase($this);
		$this->btnInvokeFileUpload = AppSpecificFunctions::getNewActionButton($this,'Force Upload','btn btn-default','InvokeFileUpload_Action');
		//$this->btnSendToRemoteServer = AppSpecificFunctions::getNewActionButton($this,'Upload','btn btn-warning','btnSendToRemoteServer_Clicked');
	}
	
	protected function fileUploaded($strFormId, $strControlId, $strParameter) {
    	AppSpecificFunctions::DisplayAlert($this->listIdPassportDriversLicense);
    	/*
		$uploadedArray = $this->fileUploader->HandleDocumentUpload($strFormId, $strControlId, $strParameter);
		$html = '<div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Result:</strong> The following files were uploaded: <br>';
		foreach ($uploadedArray as $file) {
			$html .= '<br>'.$file->Path;
		}
		$html .= '</div>';
		$this->sh_Feedback->updateControl($html);*/
	}
	protected function InvokeFileUpload_Action() {
		// A very useful way to invoke the file upload from say, the save button on a modal
		$this->fileUploader->invokeFileUpload();
	}
}
Person_DetailForm::Run('Person_DetailForm');
?>