<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/ProfilePicture/ProfilePictureController.php');
require(__SDEV_CONTROLS__.'/Implementations/ProfilePicture/ProfilePictureDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class ProfilePicture_ListForm extends QForm {
    // Data list variables
    protected $ProfilePictureList;
    protected $btnNewProfilePicture;

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

        $this->InitProfilePictureDataList();
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
            $this->ProfilePictureList->refreshList();
            AppSpecificFunctions::ToggleModal('ProfilePictureModal');
        }
    }
    protected function btnDeleteProfilePicture_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProfilePictureInstance->deleteObject()) {
            $this->ProfilePictureList->refreshList();
            AppSpecificFunctions::ToggleModal('ProfilePictureModal');
        }
    }
    protected function InitProfilePictureDataList() {
        $searchableAttributes = array(QQN::ProfilePicture()->ProfilePicturePath,QQN::ProfilePicture()->AccountObject->Id,QQN::ProfilePicture()->FileDocumentObject->Id);
        $SortAttributesShown = array('Profile Picture Path','Account Object','File Document Object');
        $SortAttributes = array(QQN::ProfilePicture()->ProfilePicturePath,QQN::ProfilePicture()->AccountObject->Id,QQN::ProfilePicture()->FileDocumentObject->Id);
        $columnItems = array('ProfilePicturePath','Account','FileDocument');
        $this->btnNewProfilePicture = AppSpecificFunctions::getNewActionButton($this,'Add ProfilePicture','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewProfilePicture_Clicked');
        $this->ProfilePictureList = new ProfilePictureDataList($this, QQN::ProfilePicture(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function ProfilePicture_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->ProfilePictureList->getActiveId() != $strParameter)
                $this->ProfilePictureList->setActiveId($strParameter);
            else
                $this->ProfilePictureList->setActiveId(null);
        $theObject = ProfilePicture::Load($strParameter);
        if ($theObject) {
            $this->ProfilePictureInstance->setObject($theObject);
            $this->ProfilePictureInstance->setValues($theObject);
            $this->ProfilePictureInstance->refreshAll();
            $this->btnDeleteProfilePicture->Visible = true;
            AppSpecificFunctions::ToggleModal('ProfilePictureModal');
        }
    }
    protected function ProfilePicture_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function ProfilePicture_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function ProfilePicture_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function ProfilePicture_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function ProfilePicture_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewProfilePicture_Clicked($strFormId, $strControlId, $strParameter) {
        $this->ProfilePictureList->setActiveId(null);
        $this->ProfilePictureInstance->setObject(null);
        $this->ProfilePictureInstance->setValues(null);
        $this->btnDeleteProfilePicture->Visible = false;
        AppSpecificFunctions::ToggleModal('ProfilePictureModal');
    }
}
ProfilePicture_ListForm::Run('ProfilePicture_ListForm');
?>