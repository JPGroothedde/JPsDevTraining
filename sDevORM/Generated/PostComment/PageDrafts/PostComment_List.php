<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PostComment/PostCommentController.php');
require(__SDEV_CONTROLS__.'/Implementations/PostComment/PostCommentDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PostComment_ListForm extends QForm {
    // Data list variables
    protected $PostCommentList;
    protected $btnNewPostComment;

    // PostComment Object variables
    protected $PostCommentInstance;
    protected $btnSavePostComment,$btnDeletePostComment;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPostCommentDataList();
        $this->InitPostCommentModal();
    }
    protected function InitPostCommentModal() {
        $this->PostCommentInstance = new PostCommentController($this);

        $this->btnSavePostComment = new QButton($this);
        $this->btnSavePostComment->Text = 'Save';
        $this->btnSavePostComment->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePostComment->AddAction(new QClickEvent(), new QAjaxAction('btnSavePostComment_Clicked'));

        $this->btnDeletePostComment = new QButton($this);
        $this->btnDeletePostComment->Text = 'Delete';
        $this->btnDeletePostComment->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePostComment->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePostComment->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePostComment_Clicked'));
    }
    protected function btnSavePostComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostCommentInstance->saveObject()) {
            $this->PostCommentList->refreshList();
            AppSpecificFunctions::ToggleModal('PostCommentModal');
        }
    }
    protected function btnDeletePostComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostCommentInstance->deleteObject()) {
            $this->PostCommentList->refreshList();
            AppSpecificFunctions::ToggleModal('PostCommentModal');
        }
    }
    protected function InitPostCommentDataList() {
        $searchableAttributes = array(QQN::PostComment()->PostCommentText,QQN::PostComment()->PostTimeStamp,QQN::PostComment()->AccountObject->Id,QQN::PostComment()->PostObject->Id);
        $SortAttributesShown = array('Post Comment Text','Post Time Stamp','Account Object','Post Object');
        $SortAttributes = array(QQN::PostComment()->PostCommentText,QQN::PostComment()->PostTimeStamp,QQN::PostComment()->AccountObject->Id,QQN::PostComment()->PostObject->Id);
        $columnItems = array('PostCommentText','PostTimeStamp','Account','Post');
        $this->btnNewPostComment = AppSpecificFunctions::getNewActionButton($this,'Add PostComment','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewPostComment_Clicked');
        $this->PostCommentList = new PostCommentDataList($this, QQN::PostComment(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function PostComment_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostCommentList->getActiveId() != $strParameter)
                $this->PostCommentList->setActiveId($strParameter);
            else
                $this->PostCommentList->setActiveId(null);
        $theObject = PostComment::Load($strParameter);
        if ($theObject) {
            $this->PostCommentInstance->setObject($theObject);
            $this->PostCommentInstance->setValues($theObject);
            $this->PostCommentInstance->refreshAll();
            $this->btnDeletePostComment->Visible = true;
            AppSpecificFunctions::ToggleModal('PostCommentModal');
        }
    }
    protected function PostComment_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->PostCommentList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function PostComment_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->PostCommentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PostComment_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->PostCommentList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function PostComment_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->PostCommentList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostComment_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->PostCommentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewPostComment_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostCommentList->setActiveId(null);
        $this->PostCommentInstance->setObject(null);
        $this->PostCommentInstance->setValues(null);
        $this->btnDeletePostComment->Visible = false;
        AppSpecificFunctions::ToggleModal('PostCommentModal');
    }
}
PostComment_ListForm::Run('PostComment_ListForm');
?>