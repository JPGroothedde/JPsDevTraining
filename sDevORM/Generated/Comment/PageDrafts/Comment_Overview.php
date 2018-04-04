<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Comment/CommentController.php');
require(__SDEV_CONTROLS__.'/Implementations/Comment/CommentDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Comment_OverviewForm extends QForm {
    // Data grid variables
    protected $CommentGrid;
    protected $CommentWaitControlIcon;
    protected $btnNewComment;
    protected $selectedCommentId = -1;

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

        $this->InitCommentDataGrid();
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
            $this->CommentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('CommentModal');
        }
    }
    protected function btnDeleteComment_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->CommentInstance->deleteObject()) {
            $this->CommentGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('CommentModal');
        }
    }
    protected function InitCommentDataGrid() {
        $searchableAttributes = array(QQN::Comment()->CommentText,QQN::Comment()->DateCreated,QQN::Comment()->AccountObject->Id,QQN::Comment()->PostObject->Id);
        $headerItems = array('Comment Text','Date Created','Account Object','Post Object');
        $headerSortNodes = array(QQN::Comment()->CommentText,QQN::Comment()->DateCreated,QQN::Comment()->AccountObject->Id,QQN::Comment()->PostObject->Id);
        $columnItems = array('CommentText','DateCreated','Account','Post');
        $this->CommentWaitControlIcon = new QWaitIcon($this);
        $this->btnNewComment = new QButton($this);
        $this->btnNewComment->Text = 'Add Comment';
        $this->btnNewComment->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewComment->AddAction(new QClickEvent(), new QAjaxAction('btnNewComment_Clicked'));
        $this->CommentGrid = new CommentDataGrid($this, QQN::Comment(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->CommentWaitControlIcon, 'CommentGrid');
    }
    protected function CommentGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CommentGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CommentGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CommentGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CommentGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CommentGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CommentGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->CommentGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function CommentGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->CommentGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function CommentGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedCommentId = $strParameter;
        $theObject = Comment::Load($this->selectedCommentId);
        if ($theObject) {
            $this->CommentInstance->setObject($theObject);
            $this->CommentInstance->setValues($theObject);
            $this->CommentInstance->refreshAll();
            $this->btnDeleteComment->Visible = true;
            AppSpecificFunctions::ToggleModal('CommentModal');
        }
    }
    protected function btnNewComment_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedCommentId = -1;
        $this->CommentInstance->setObject(null);
        $this->CommentInstance->setValues(null);
        $this->btnDeleteComment->Visible = false;
        AppSpecificFunctions::ToggleModal('CommentModal');
    }
}
Comment_OverviewForm::Run('Comment_OverviewForm');
?>