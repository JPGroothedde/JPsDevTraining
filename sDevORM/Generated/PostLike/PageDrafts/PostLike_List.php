<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PostLike/PostLikeController.php');
require(__SDEV_CONTROLS__.'/Implementations/PostLike/PostLikeDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PostLike_ListForm extends QForm {
    // Data list variables
    protected $PostLikeList;
    protected $btnNewPostLike;

    // PostLike Object variables
    protected $PostLikeInstance;
    protected $btnSavePostLike,$btnDeletePostLike;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPostLikeDataList();
        $this->InitPostLikeModal();
    }
    protected function InitPostLikeModal() {
        $this->PostLikeInstance = new PostLikeController($this);

        $this->btnSavePostLike = new QButton($this);
        $this->btnSavePostLike->Text = 'Save';
        $this->btnSavePostLike->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePostLike->AddAction(new QClickEvent(), new QAjaxAction('btnSavePostLike_Clicked'));

        $this->btnDeletePostLike = new QButton($this);
        $this->btnDeletePostLike->Text = 'Delete';
        $this->btnDeletePostLike->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePostLike->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePostLike->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePostLike_Clicked'));
    }
    protected function btnSavePostLike_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostLikeInstance->saveObject()) {
            $this->PostLikeList->refreshList();
            AppSpecificFunctions::ToggleModal('PostLikeModal');
        }
    }
    protected function btnDeletePostLike_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostLikeInstance->deleteObject()) {
            $this->PostLikeList->refreshList();
            AppSpecificFunctions::ToggleModal('PostLikeModal');
        }
    }
    protected function InitPostLikeDataList() {
        $searchableAttributes = array(QQN::PostLike()->PostLike,QQN::PostLike()->DateCreated,QQN::PostLike()->AccountObject->Id,QQN::PostLike()->PostObject->Id);
        $SortAttributesShown = array('Post Like','Date Created','Account Object','Post Object');
        $SortAttributes = array(QQN::PostLike()->PostLike,QQN::PostLike()->DateCreated,QQN::PostLike()->AccountObject->Id,QQN::PostLike()->PostObject->Id);
        $columnItems = array('PostLike','DateCreated','Account','Post');
        $this->btnNewPostLike = AppSpecificFunctions::getNewActionButton($this,'Add PostLike','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewPostLike_Clicked');
        $this->PostLikeList = new PostLikeDataList($this, QQN::PostLike(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function PostLike_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostLikeList->getActiveId() != $strParameter)
                $this->PostLikeList->setActiveId($strParameter);
            else
                $this->PostLikeList->setActiveId(null);
        $theObject = PostLike::Load($strParameter);
        if ($theObject) {
            $this->PostLikeInstance->setObject($theObject);
            $this->PostLikeInstance->setValues($theObject);
            $this->PostLikeInstance->refreshAll();
            $this->btnDeletePostLike->Visible = true;
            AppSpecificFunctions::ToggleModal('PostLikeModal');
        }
    }
    protected function PostLike_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->PostLikeList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function PostLike_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->PostLikeList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PostLike_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->PostLikeList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function PostLike_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->PostLikeList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostLike_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->PostLikeList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewPostLike_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostLikeList->setActiveId(null);
        $this->PostLikeInstance->setObject(null);
        $this->PostLikeInstance->setValues(null);
        $this->btnDeletePostLike->Visible = false;
        AppSpecificFunctions::ToggleModal('PostLikeModal');
    }
}
PostLike_ListForm::Run('PostLike_ListForm');
?>