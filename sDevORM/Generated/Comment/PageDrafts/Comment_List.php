<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Comment/CommentController.php');
require(__SDEV_CONTROLS__.'/Implementations/Comment/CommentDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Comment_ListForm extends QForm {
    // Data list variables
    protected $CommentList;
    protected $btnNewComment;

    // Comment Object variables
    protected $CommentInstance;
    protected $btnSaveComment,$btnDeleteComment;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitCommentDataList();
        $this->InitCommentModal();
    }
    protected function InitCommentModal() {
        $this->CommentInstance = new CommentController($this);

        $this->btnSaveComment = new QButton($this);
        $this->btnSaveComment->Text = 'Save';
        $this->btnSaveComment->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSaveComment->AddAction(new QClickEvent(), new QAjaxAction('btnSaveComment_Clicked'));

        $this->btnDeleteComment = new QButton($this);
        $this->btnDeleteComment->Text = 'Delete';
        $this->btnDeleteComment->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeleteComment->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeleteComment->AddAction(new QClickEvent(), new QAjaxAction('btnDeleteComment_Clicked'));
    }
    protected function btnSaveComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CommentInstance->saveObject()) {
            $this->CommentList->refreshList();
            AppSpecificFunctions::ToggleModal('CommentModal');
        }
    }
    protected function btnDeleteComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CommentInstance->deleteObject()) {
            $this->CommentList->refreshList();
            AppSpecificFunctions::ToggleModal('CommentModal');
        }
    }
    protected function InitCommentDataList() {
        $searchableAttributes = array(QQN::Comment()->CommentText,QQN::Comment()->DateCreated,QQN::Comment()->AccountObject->Id,QQN::Comment()->PostObject->Id);
        $SortAttributesShown = array('Comment Text','Date Created','Account Object','Post Object');
        $SortAttributes = array(QQN::Comment()->CommentText,QQN::Comment()->DateCreated,QQN::Comment()->AccountObject->Id,QQN::Comment()->PostObject->Id);
        $columnItems = array('CommentText','DateCreated','Account','Post');
        $this->btnNewComment = AppSpecificFunctions::getNewActionButton($this,'Add Comment','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewComment_Clicked');
        $this->CommentList = new CommentDataList($this, QQN::Comment(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Comment_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->CommentList->getActiveId() != $strParameter)
                $this->CommentList->setActiveId($strParameter);
            else
                $this->CommentList->setActiveId(null);
        $theObject = Comment::Load($strParameter);
        if ($theObject) {
            $this->CommentInstance->setObject($theObject);
            $this->CommentInstance->setValues($theObject);
            $this->CommentInstance->refreshAll();
            $this->btnDeleteComment->Visible = true;
            AppSpecificFunctions::ToggleModal('CommentModal');
        }
    }
    protected function Comment_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->CommentList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Comment_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->CommentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Comment_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->CommentList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Comment_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->CommentList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Comment_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->CommentList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewComment_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CommentList->setActiveId(null);
        $this->CommentInstance->setObject(null);
        $this->CommentInstance->setValues(null);
        $this->btnDeleteComment->Visible = false;
        AppSpecificFunctions::ToggleModal('CommentModal');
    }
}
Comment_ListForm::Run('Comment_ListForm');
?>