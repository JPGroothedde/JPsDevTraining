<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');

if (!checkRole(array('User')))
    AppSpecificFunctions::Redirect(__USRMNG__.'/login/');

class UserIndexForm extends QForm {
	protected $DashBoardMenuButton;
	protected $RegisteredCVsButton;
	protected $SearchPersonInputBox;
	protected $AddNewVipButton;
    public function Form_Create() {
        parent::Form_Create();
        $this->initDashBoardForm();
    }
    protected function initDashBoardForm(){
    	$this->DashBoardMenuButton = new QButton($this);
    	$this->DashBoardMenuButton->Text = "DASHBOARD";
    	$this->DashBoardMenuButton->CssClass = 'btn btn-primary rippleclick';
    	$this->RegisteredCVsButton = new QButton($this);
    	$this->RegisteredCVsButton->Text = "REGISTERED CVs";
	    $this->RegisteredCVsButton->CssClass = 'btn btn-primary rippleclick';
    	$this->SearchPersonInputBox = new QTextBox($this);
    	$this->SearchPersonInputBox->Placeholder = 'Type here to start searching for a specific person';
    	$this->SearchPersonInputBox->AddAction(new QKeyUpEvent(), new QAjaxAction('searchVip'));
    	$this->AddNewVipButton = new  QButton($this);
    	$this->AddNewVipButton->Text = "ADD A NEW VIP";
	    $this->AddNewVipButton->CssClass = 'btn btn-primary rippleclick';
    }
    protected function searchVip($strFormId,$strControlId,$strParameter) {
    	AppSpecificFunctions::DisplayAlert($this->SearchPersonInputBox->Text);
    }
}
UserIndexForm::Run('UserIndexForm');

?>