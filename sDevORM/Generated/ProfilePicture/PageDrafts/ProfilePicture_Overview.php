<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/ProfilePicture/ProfilePictureController.php');
require(__SDEV_CONTROLS__.'/Implementations/ProfilePicture/ProfilePictureDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class ProfilePicture_OverviewForm extends QForm {
    // Data grid variables
    protected $ProfilePictureGrid;
    protected $ProfilePictureWaitControlIcon;
    protected $btnNewProfilePicture;
    protected $selectedProfilePictureId = -1;

    // ProfilePicture Object variables
    protected $ProfilePictureInstance;
    protected $btnSaveProfilePicture,$btnDeleteProfilePicture;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitProfilePictureDataGrid();
        $this->InitProfilePictureModal();
    }
    protected function InitProfilePictureModal() {
        $this->ProfilePictureInstance = new ProfilePictureController($this);

        $this->btnSaveProfilePicture = new QButton($this);
        $this->btnSaveProfilePicture->Text = 'Save';
        $this->btnSaveProfilePicture->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveProfilePicture->AddAction(new QClickEvent(), new QAjaxAction('btnSaveProfilePicture_Clicked'));

        $this->btnDeleteProfilePicture = new QButton($this);
        $this->btnDeleteProfilePicture->Text = 'Delete';
        $this->btnDeleteProfilePicture->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteProfilePicture->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteProfilePicture->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteProfilePicture_Clicked'));
    }
    protected function btnSaveProfilePicture_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProfilePictureInstance->saveObject()) {
            $this->ProfilePictureGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('ProfilePictureModal');
        }
    }
    protected function btnDeleteProfilePicture_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProfilePictureInstance->deleteObject()) {
            $this->ProfilePictureGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('ProfilePictureModal');
        }
    }
    protected function InitProfilePictureDataGrid() {
        $searchableAttributes = array(QQN::ProfilePicture()->ProfilePicturePath,QQN::ProfilePicture()->AccountObject->Id,QQN::ProfilePicture()->FileDocumentObject->Id);
        $headerItems = array('Profile Picture Path','Account Object','File Document Object');
        $headerSortNodes = array(QQN::ProfilePicture()->ProfilePicturePath,QQN::ProfilePicture()->AccountObject->Id,QQN::ProfilePicture()->FileDocumentObject->Id);
        $columnItems = array('ProfilePicturePath','Account','FileDocument');
        $this->ProfilePictureWaitControlIcon = new QWaitIcon($this);
        $this->btnNewProfilePicture = new QButton($this);
        $this->btnNewProfilePicture->Text = 'Add ProfilePicture';
        $this->btnNewProfilePicture->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewProfilePicture->AddAction(new QClickEvent(), new QAjaxAction('btnNewProfilePicture_Clicked'));
        $this->ProfilePictureGrid = new ProfilePictureDataGrid($this, QQN::ProfilePicture(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->ProfilePictureWaitControlIcon, 'ProfilePictureGrid');
    }
    protected function ProfilePictureGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ProfilePictureGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ProfilePictureGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ProfilePictureGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ProfilePictureGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function ProfilePictureGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedProfilePictureId = $strParameter;
        $theObject = ProfilePicture::Load($this->selectedProfilePictureId);
        if ($theObject) {
            $this->ProfilePictureInstance->setObject($theObject);
            $this->ProfilePictureInstance->setValues($theObject);
            $this->ProfilePictureInstance->refreshAll();
            $this->btnDeleteProfilePicture->Visible = true;
            AppSpecificFunctions::ToggleModal('ProfilePictureModal');
        }
    }
    protected function btnNewProfilePicture_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedProfilePictureId = -1;
        $this->ProfilePictureInstance->setObject(null);
        $this->ProfilePictureInstance->setValues(null);
        $this->btnDeleteProfilePicture->Visible = false;
        AppSpecificFunctions::ToggleModal('ProfilePictureModal');
    }
}
ProfilePicture_OverviewForm::Run('ProfilePicture_OverviewForm');
?>