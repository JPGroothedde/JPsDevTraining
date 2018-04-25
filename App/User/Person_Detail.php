<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Person/PersonController.php');
require(__SDEV_ORM__.'/Implementations/EmploymentHistory/EmploymentHistoryController.php');
require(__SDEV_ORM__.'/Implementations/Education/EducationController.php');
require(__SDEV_ORM__.'/Implementations/Reference/ReferenceController.php');
require('profilePictureUploader.php');
require('attachmentUploader.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Person_DetailForm extends QForm {
    // Person Object variables
    protected $PersonInstance;
    protected $btnSavePerson,$btnDeletePerson,$btnCancelPerson;
    protected $btnAddAttachment,$btnAddProfilePic;
	protected $listIdPassportDriversLicense;
	protected $PersonId;
	
	// EmploymentHistory Object variables
	protected $EmploymentHistoryInstance;
	protected $btnSaveEmploymentHistory,$btnDeleteEmploymentHistory,$btnCancelEmploymentHistory;
	protected $btnAddExperience,$btnAddReference;
	protected $btnEmploymentHistoryNext;
	protected $EmploymentHistoryDisplay;
	protected $EmploymentHistorySkillsTagsInput;
	protected $btnAddNewEmploymentHistorySkillsTag;
	protected $EmploymentHistorySkillsTagDisplay;
	
	// Education Object variables
	protected $EducationInstance;
	protected $btnSaveEducation,$btnDeleteEducation,$btnCancelEducation;
	protected $btnAddEducation;
	protected $EducationDisplay;
	
	// Reference Object variables
	protected $ReferenceInstance;
	protected $btnSaveReference,$btnDeleteReference,$btnCancelReference;
	protected $ReferenceDisplay;

	//Profile Picture
	protected $fileUploader;
	protected $sh_Feedback;
	protected $btnInvokeFileUpload,$btnSendToRemoteServer;
	protected $sendToRemote = false;
	protected $ProfilePicture;
	
	
	//Attachment Upload
	protected $attachmentUploader;
	protected $attachmentUploadFeedback;
	protected $attachmentUploadName;
	
	
	//PDF Creation
	protected $btnCreatePdf;
	protected $DocumentGenerator;
	
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
	    $this->InitReferenceInstance();
	    $this->InitProfilePictureUpload();
	    $this->InitAttachmentUpload();
		
	    
        $objId = AppSpecificFunctions::PathInfo(0);
        if (strlen($objId) > 0 ) {
            $theObject = Person::Load($objId);
            if($theObject)
                $this->PersonId = $theObject->Id;
            if ($theObject) {
                $this->PersonInstance->setObject($theObject);
                $this->PersonInstance->setValues($theObject);
                $this->PersonInstance->refreshAll();
                $this->btnDeletePerson->Visible = true;
            } else {
                $this->PersonInstance->setObject(null);
                $this->PersonInstance->setValues(null);
                $this->btnDeletePerson->Visible = false;
            }
        } else {
            $this->PersonInstance->setObject(null);
            $this->PersonInstance->setValues(null);
            $this->btnDeletePerson->Visible = false;
        }
    }
    protected function InitPersonInstance() {
        $this->PersonInstance = new PersonController($this);
		
        $this->btnAddProfilePic = new QButton($this);
        $this->btnAddProfilePic->Text = 'ADD PROFILE PIC';
        $this->btnAddProfilePic->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnAddProfilePic->AddAction(new QClickEvent(), new QAjaxAction('btnAddProfilePic_Clicked'));
        
	    $this->listIdPassportDriversLicense = new QListBox($this);
	    $this->listIdPassportDriversLicense->AddItems(array('Please Select','ID / Passport','Drivers License'));
	    $this->listIdPassportDriversLicense->Required;
		
        $this->btnAddAttachment = new QButton($this);
        $this->btnAddAttachment->Text = 'ADD ANOTHER';
        $this->btnAddAttachment->CssClass = 'btn-sml btn-default mrg-top10 rippleclick';
        $this->btnAddAttachment->AddAction(new QClickEvent(), new QAjaxAction('btnAddAttachment_Clicked'));
        
        $this->btnSavePerson = new QButton($this);
        $this->btnSavePerson->Text = 'NEXT';
        $this->btnSavePerson->CssClass = 'btn btn-primary mrg-top10 rippleclick';
        $this->btnSavePerson->AddAction(new QClickEvent(), new QAjaxAction('btnSavePerson_Clicked'));

        $this->btnDeletePerson = new QButton($this);
        $this->btnDeletePerson->Text = 'Delete';
        $this->btnDeletePerson->CssClass = 'btn btn-danger mrg-top10 rippleclick';
        $this->btnDeletePerson->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePerson->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePerson_Clicked'));

        $this->btnCancelPerson = new QButton($this);
        $this->btnCancelPerson->Text = 'Cancel';
        $this->btnCancelPerson->CssClass = 'btn btn-default mrg-top10 rippleclick';
        $this->btnCancelPerson->AddAction(new QClickEvent(), new QAjaxAction('btnCancelPerson_Clicked'));
    }
    protected function btnSavePerson_Clicked($strFormId, $strControlId, $strParameter) {
	    $FirstNameValidate      = AppSpecificFunctions::validateFieldAsRequired($this->PersonInstance->txtFirstName);
	    $SurnameValidate        = AppSpecificFunctions::validateFieldAsRequired($this->PersonInstance->txtSurname);
	    $DateOfBirthValidate    = AppSpecificFunctions::validateFieldAsRequired($this->PersonInstance->txtDateOfBirth);
	    if ($FirstNameValidate!='' && $SurnameValidate != '' && $DateOfBirthValidate != '') {
		    if ($this->PersonInstance->saveObject()) {
			    //AppSpecificFunctions::Redirect(loadPreviousPage());
		    }
		    $js = "$('#captureNewPerson a[href=\"#Person_Employment-History\"]').tab('show')";
		    AppSpecificFunctions::ExecuteJavaScript($js);
		
	    }  else {
		    AppSpecificFunctions::ShowNotedFeedback('First name, Surname and Date of Birth need to be supplied....',false);
		    $js = "$('#captureNewPerson a[href=\"#Person_Person-Details--Verification\"]').tab('show')";
		    AppSpecificFunctions::ExecuteJavaScript($js);
	    }
    }
    protected function btnDeletePerson_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonInstance->deleteObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }
    }
    protected function btnCancelPerson_Clicked($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
    }
	protected function btnPhoneVerified_Clicked($strFormId, $strControlId, $strParameter) {
		$this->GetControl($this->PersonInstance->getControlId('PhoneVerified'))->Toggle(!$this->GetControl($this->PersonInstance->getControlId('PhoneVerified'))->IsToggled);
	}
	protected function btnIdentityVerified_Clicked($strFormId, $strControlId, $strParameter) {
		$this->GetControl($this->PersonInstance->getControlId('IdentityVerified'))->Toggle(!$this->GetControl($this->PersonInstance->getControlId('IdentityVerified'))->IsToggled);
	}
	protected function btnDriversLicenseVerified_Clicked($strFormId, $strControlId, $strParameter) {
		$this->GetControl($this->PersonInstance->getControlId('DriversLicenseVerified'))->Toggle(!$this->GetControl($this->PersonInstance->getControlId('DriversLicenseVerified'))->IsToggled);
	}
	protected function btnAddAttachment_Clicked($strFormId,$strControlId,$strParameter) {
	    AppSpecificFunctions::ToggleModal('AddIDPassportDriversLicenseModal');
	}
	protected function btnAddProfilePic_Clicked($strFormId,$strControlId,$strParameter) {
			AppSpecificFunctions::ToggleModal('profilePictureModal');
	}
	
	
	///////////////////////////////////////////Employment History//////////////////////////////////////
	protected function InitEmploymentHistoryInstance() {
		$this->EmploymentHistoryInstance = new EmploymentHistoryController($this);
		
		$this->btnAddExperience = new QButton($this);
		$this->btnAddExperience->Text = 'ADD EXPERIENCE';
		$this->btnAddExperience->CssClass = 'btn-sml btn-primary mrg-top10 rippleclick';
		$this->btnAddExperience->AddAction(new QClickEvent(), new QAjaxAction('btnAddExperience_Clicked'));
		
		$this->btnAddReference = new QButton($this);
		$this->btnAddReference->Text = 'ADD REFERENCE';
		$this->btnAddReference->CssClass = 'btn-sml btn-primary mrg-top10 rippleclick';
		$this->btnAddReference->AddAction(new QClickEvent(), new QAjaxAction('btnAddReference_Clicked'));
		
		$this->btnEmploymentHistoryNext = new QButton($this);
		$this->btnEmploymentHistoryNext->Text = 'NEXT';
		$this->btnEmploymentHistoryNext->CssClass = 'btn btn-primary mrg-top10 rippleclick';
		$this->btnEmploymentHistoryNext->AddAction(new QClickEvent(), new QAjaxAction('btnEmploymentHistoryNext_Clicked'));
		
		$this->btnSaveEmploymentHistory = new QButton($this);
		$this->btnSaveEmploymentHistory->Text = 'Save';
		$this->btnSaveEmploymentHistory->CssClass = 'btn-sml btn-primary mrg-top10 rippleclick';
		$this->btnSaveEmploymentHistory->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEmploymentHistory_Clicked'));
		
		$this->btnDeleteEmploymentHistory = new QButton($this);
		$this->btnDeleteEmploymentHistory->Text = 'Delete';
		$this->btnDeleteEmploymentHistory->CssClass = 'btn-sml btn-danger mrg-top10 rippleclick';
		$this->btnDeleteEmploymentHistory->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
		$this->btnDeleteEmploymentHistory->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEmploymentHistory_Clicked'));
		
		$this->btnCancelEmploymentHistory = new QButton($this);
		$this->btnCancelEmploymentHistory->Text = 'Cancel';
		$this->btnCancelEmploymentHistory->CssClass = 'btn-sml btn-default mrg-top10 rippleclick';
		$this->btnCancelEmploymentHistory->AddAction(new QClickEvent(), new QAjaxAction('btnCancelEmploymentHistory_Clicked'));
		
		$this->EmploymentHistorySkillsTagsInput = new QTextBox($this);
		$this->EmploymentHistorySkillsTagsInput->Name = 'New Skills Tag';
		$this->EmploymentHistorySkillsTagsInput->Placeholder = 'e.g. Builder,Tiler,Carpenter...';
		
		$this->btnAddNewEmploymentHistorySkillsTag = new QButton($this);
		$this->btnAddNewEmploymentHistorySkillsTag->Text = 'ADD';
		$this->btnAddNewEmploymentHistorySkillsTag->CssClass = 'btn-sml btn-default mrg-top20 rippleclick';
		$this->btnAddNewEmploymentHistorySkillsTag->AddAction(new QClickEvent(), new QAjaxAction('btnAddNewEmploymentHistorySkillsTag_Clicked'));
		
		$this->EmploymentHistoryDisplay = new sUIElementsBase($this);
		$ThePerson = AppSpecificFunctions::PathInfo(0);
		$EmploymentHistoryArray = EmploymentHistory::QueryArray(QQ::Equal(QQN::EmploymentHistory()->PersonObject->Id,$ThePerson));
		if ($EmploymentHistoryArray) {
			$html = '<ul class="list-group">';
			foreach($EmploymentHistoryArray as $EmploymentHistory) {
				$html.= '<li class="list-group-item">';
				$html.= '<div class="row">';
				$html.= '<div class="col-md-12"><strong>'.$EmploymentHistory->EmployerName.'</strong> - '.$EmploymentHistory->PeriodStartDate.' '.$EmploymentHistory->PeriodEndDate.'</div>';
				$html.= '</div>';
				$html.= '<div class="row">';
				$html.= '<div class="col-md-12">'.$EmploymentHistory->Title.'</div>';
				$html.= '</div>';
				$html.= '<div class="row">';
				$html.= '<div class="col-md-12">'.$EmploymentHistory->Duties.'</div>';
				$html.= '</div>';
				$html.= '</li>';
			}
			$html.= '</ul>';
		} else {
			$html = 'No Employment history to display.';
		}
		$this->EmploymentHistoryDisplay->updateControl($html);
		
		$this->EmploymentHistorySkillsTagDisplay = new sUIElementsBase($this);
		$ThePerson = AppSpecificFunctions::PathInfo(0);
		$EmploymentHistorySkillsTagArray = PersonSkillsTag::QueryArray(QQ::Equal(QQN::PersonSkillsTag()->PersonObject->Id, $ThePerson));
		if ($EmploymentHistorySkillsTagArray) {
			$html = '<div class="row">';
			foreach($EmploymentHistorySkillsTagArray as $EmploymentHistorySkillsTag) {
				$html.= '<span class="label label-success">'.$EmploymentHistorySkillsTag->SkillTag.'</span>';
			}
			$html.= '</div>';
		} else {
			$html = 'No skills tags added yet.';
		}
		$this->EmploymentHistorySkillsTagDisplay->updateControl($html);
    }
    protected function btnAddNewEmploymentHistorySkillsTag_Clicked($strFormId, $strControlId, $strParameter) {
    	$ValidateTagsInput = $this->EmploymentHistorySkillsTagsInput->Text;
	    $ThePerson = AppSpecificFunctions::PathInfo(0);
    	$TagObj = new PersonSkillsTag();
    	$TagObj->SkillTag = $ValidateTagsInput;
    	$TagObj->Person = $ThePerson;
    	$TagObj->Save();
    }
	protected function btnSaveEmploymentHistory_Clicked($strFormId, $strControlId, $strParameter) {
    	$ThePerson = Person::Load($this->PersonId);
		if ($this->EmploymentHistoryInstance->saveObject(true,$ThePerson)) {
			AppSpecificFunctions::ShowNotedFeedback('Saved!');
			AppSpecificFunctions::ToggleModal('EmploymentHistoryModal');
		} else
			AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Please try again.',false);
	}
	protected function btnDeleteEmploymentHistory_Clicked($strFormId, $strControlId, $strParameter) {
		if ($this->EmploymentHistoryInstance->deleteObject()) {
			AppSpecificFunctions::ShowNotedFeedback('Deleted!');
		} else
			AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Please try again.',false);
	}
	protected function btnAddExperience_Clicked($strFormId,$strControlId,$strParameter) {
			AppSpecificFunctions::ToggleModal('EmploymentHistoryModal');
	}
	protected function btnAddReference_Clicked($strFormId,$strControlId,$strParameter) {
			AppSpecificFunctions::ToggleModal('ReferenceModal');
	}//ReferenceModal btnAddReference_Clicked
	protected function btnEmploymentHistoryNext_Clicked($strFormId,$strControlId,$strParameter) {
		$js = "$('#captureNewPerson a[href=\"#Person_Education\"]').tab('show')";
		AppSpecificFunctions::ExecuteJavaScript($js);
	}
	////////////////////////////////// Education //////////////////////////////////////////
	protected function InitEducationInstance() {
		$this->EducationInstance = new EducationController($this);
		
		$this->btnSaveEducation = new QButton($this);
		$this->btnSaveEducation->Text = 'Save';
		$this->btnSaveEducation->CssClass = 'btn btn-primary mrg-top10 rippleclick';
		$this->btnSaveEducation->AddAction(new QClickEvent(), new QAjaxAction('btnSaveEducation_Clicked'));
		
		$this->btnDeleteEducation = new QButton($this);
		$this->btnDeleteEducation->Text = 'Delete';
		$this->btnDeleteEducation->CssClass = 'btn btn-danger mrg-top10 rippleclick';
		$this->btnDeleteEducation->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
		$this->btnDeleteEducation->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteEducation_Clicked'));
		
		$this->btnCancelEducation = new QButton($this);
		$this->btnCancelEducation->Text = 'Cancel';
		$this->btnCancelEducation->CssClass = 'btn btn-default mrg-top10 rippleclick';
		$this->btnCancelEducation->AddAction(new QClickEvent(), new QAjaxAction('btnCancelEducation_Clicked'));
		
		$this->btnAddEducation = new QButton($this);
		$this->btnAddEducation->Text = 'ADD EDUCATION';
		$this->btnAddEducation->CssClass = 'btn btn-default mrg-top20 rippleclick';
		$this->btnAddEducation->AddAction(new QClickEvent(), new QAjaxAction('btnAddEducation_Clicked'));
		
		$this->EducationDisplay = new sUIElementsBase($this);
		$ThePerson = AppSpecificFunctions::PathInfo(0);
		$EducationArray = Education::QueryArray(QQ::Equal(QQN::Education()->PersonObject->Id, $ThePerson));
		if ($EducationArray) {
			$html = '';
			foreach($EducationArray as $Education) {
				$html.= '<div class="panel panel-default">';
				$html.= '<div class="panel-body">';
				$html.= '<div class="row">';
				$html.= '<div class="col-md-12">'.$Education->Institution.' - '.$Education->StartDate.' - '.$Education->EndDate.'</div>';
				$html.= '</div>';
				$html.= '<div class="row">';
				$html.= '<div class="col-md-12">'.$Education->Qualification.'</div>';
				$html.= '</div>';
				$html.= '</div>';
				$html.= '</div>';
			}
		} else {
			$html = 'No qualifications found.';
		}
		$this->EducationDisplay->updateControl($html);
		
		$this->btnCreatePdf = new QButton($this);
		$this->btnCreatePdf->Text = 'Create PDF';
		$this->btnCreatePdf->CssClass = 'btn btn-default mrg-top10 rippleclick';
		$this->btnCreatePdf->AddAction(new QClickEvent(), new QAjaxAction('generateCV'));
	}
	protected function btnAddEducation_Clicked($strFormId, $strControlId, $strParameter) {
    	AppSpecificFunctions::ToggleModal('EducationModal');
	}
	protected function btnSaveEducation_Clicked($strFormId, $strControlId, $strParameter) {
		$ThePerson = Person::Load($this->PersonId);
    	if ($this->EducationInstance->saveObject(true,$ThePerson)) {
			AppSpecificFunctions::ToggleModal('EducationModal');
		} else
			AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Please try again.',false);
	}
	protected function btnDeleteEducation_Clicked($strFormId, $strControlId, $strParameter) {
		if ($this->EducationInstance->deleteObject()) {
			AppSpecificFunctions::ShowNotedFeedback('Deleted!');
		} else
			AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
	}
	///////////////////////////////// Reference //////////////////////////////////////////
	protected function InitReferenceInstance() {
		$this->ReferenceInstance = new ReferenceController($this);
		
		$this->btnSaveReference = new QButton($this);
		$this->btnSaveReference->Text = 'Save';
		$this->btnSaveReference->CssClass = 'btn btn-primary mrg-top10 rippleclick';
		$this->btnSaveReference->AddAction(new QClickEvent(), new QAjaxAction('btnSaveReference_Clicked'));
		
		$this->btnDeleteReference = new QButton($this);
		$this->btnDeleteReference->Text = 'Delete';
		$this->btnDeleteReference->CssClass = 'btn btn-danger mrg-top10 rippleclick';
		$this->btnDeleteReference->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
		$this->btnDeleteReference->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteReference_Clicked'));
		
		$this->btnCancelReference = new QButton($this);
		$this->btnCancelReference->Text = 'Cancel';
		$this->btnCancelReference->CssClass = 'btn btn-default mrg-top10 rippleclick';
		$this->btnCancelReference->AddAction(new QClickEvent(), new QAjaxAction('btnCancelReference_Clicked'));
		
		$this->ReferenceDisplay = new sUIElementsBase($this);
		$ThePerson = AppSpecificFunctions::PathInfo(0);
		$ReferenceArray = Reference::QueryArray(QQ::Equal(QQN::Reference()->PersonObject->Id, $ThePerson));
		$ReferenceHtml = '<div class="row" style="border: 1px solid lightgrey; background-color: lightgrey;">';
		$ReferenceHtml.= '<div class="col-lg-3">Firstname</div>';
		$ReferenceHtml.= '<div class="col-lg-3">Relationship</div>';
		$ReferenceHtml.= '<div class="col-lg-3">Tel Number</div>';
		$ReferenceHtml.= '<div class="col-lg-3">Ref Letter</div>';
		$ReferenceHtml.= '</div>';
		if ($ReferenceArray) {
			foreach ($ReferenceArray as $Reference) {
				$ReferenceHtml.= '<div class="row">';
				$ReferenceHtml.= '<div class="col-md-3">'.$Reference->FirstName.'</div>';
				$ReferenceHtml.= '<div class="col-md-3">' .$Reference->Relationship.'</div>';
				$ReferenceHtml.= '<div class="col-md-3">'.$Reference->TelephoneNumber.'</div>';
				$ReferenceHtml.= '<div class="col-md-3">'.$Reference->FileDocument .'</div>';
				$ReferenceHtml.= '</div>';
			}
		} else {
			$ReferenceHtml = 'No reference to display.';
		}
		$this->ReferenceDisplay->updateControl($ReferenceHtml);
	}
	protected function btnSaveReference_Clicked($strFormId, $strControlId, $strParameter) {
		$ThePerson = Person::Load($this->PersonId);
		if ($this->ReferenceInstance->saveObject(true,$ThePerson)) {
			AppSpecificFunctions::ShowNotedFeedback('Saved!');
		} else
			AppSpecificFunctions::ShowNotedFeedback('Could not save right now! Pleae try again.',false);
	}
	protected function btnDeleteReference_Clicked($strFormId, $strControlId, $strParameter) {
		if ($this->ReferenceInstance->deleteObject()) {
			AppSpecificFunctions::ShowNotedFeedback('Deleted!');
		} else
			AppSpecificFunctions::ShowNotedFeedback('Could not delete right now! Pleae try again.',false);
	}
    ////////////////////////////// Profile Pic ///////////////////////////////
	protected function  InitProfilePictureUpload() {
		$this->fileUploader = new profilePictureUploader($this,null,'profilePictureUploaded');
		$this->sh_Feedback = new sUIElementsBase($this);
		$this->btnInvokeFileUpload = AppSpecificFunctions::getNewActionButton($this,'Force Upload','btn btn-default','InvokeFileUpload_Action');
		$this->btnSendToRemoteServer = AppSpecificFunctions::getNewActionButton($this,'Send File To Remote Server','btn btn-warning','btnSendToRemoteServer_Clicked');
        $this->ProfilePicture = new sUIElementsBase($this);
		$this->ProfilePicturePath();
    }
    protected function ProfilePicturePath() {
    	$PersonId = AppSpecificFunctions::PathInfo(0);
    	$ProfilePictureObj = Person::QuerySingle(QQ::Equal(QQN::Person()->Id, $PersonId));
		$ProfilePictureObj->FileDocumentObject;
		
	    $ProfilePicturePath = __APP_IMAGE_ASSETS__.'/image_not_available.jpg';
	    
		$htmlResults = '<img class="img-circle" style="width:200px; height: 200px;" src="'.$ProfilePicturePath.'">';
		$this->ProfilePicture->updateControl($htmlResults);
    }
    
	protected function profilePictureUploaded($strFormId, $strControlId, $strParameter) {
	    $uploadedArray = $this->fileUploader->HandleDocumentUpload($strFormId, $strControlId, $strParameter,$this->PersonId);
	    $html = '<div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Result:</strong> The following files were uploaded: <br>';
	    foreach($uploadedArray as $file) {
		    $html .= '<br>'.$file->Path;
	    }
	    $html .= '</div>';
	    $this->sh_Feedback->updateControl($html);
	}
	
	protected function  InitAttachmentUpload() {
		$this->attachmentUploader = new attachmentUploader($this,null,'attachmentUploaded');
		$this->attachmentUploadFeedback = new sUIElementsBase($this);
		
		$this->attachmentUploadName = new QTextBox($this);
		$this->attachmentUploadName->Placeholder = 'Please supply a name for the attachment....';
	}
	protected function attachmentUploaded($strFormId, $strControlId, $strParameter) {
		$uploadedArray = $this->attachmentUploader->HandleDocumentUpload($strFormId, $strControlId, $strParameter,$this->PersonId);
		$html = '<div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Result:</strong> The following files were uploaded: <br>';
		foreach($uploadedArray as $file) {
			$html .= '<br>'.$file->Path;
		}
		$html .= '</div>';
		$this->attachmentUploadFeedback->updateControl($html);
	}
	protected function generateCV($strFormId, $strControlId, $strParameter) {
		$filename = date("Y-m-d_h-m-s").'.pdf';
		$this->DocumentGenerator = new sHtml2PdfInstance($filename,'cvTemplate.php',false);
		$this->DocumentGenerator->writePDF('P');
		return $filename;
		$FileDocumentObj = new FileDocument();
		$FileDocumentObj->FileName = $filename;
		$FileDocumentObj->Path = __SDEV_FUNCTIONS__.'/GeneratedPDFs/'.$filename;
		$FileDocumentObj->Save();
	}
}
Person_DetailForm::Run('Person_DetailForm');
?>