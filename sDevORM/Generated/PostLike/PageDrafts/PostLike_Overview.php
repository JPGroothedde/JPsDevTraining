<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PostLike/PostLikeController.php');
require(__SDEV_CONTROLS__.'/Implementations/PostLike/PostLikeDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PostLike_OverviewForm extends QForm {
    // Data grid variables
    protected $PostLikeGrid;
    protected $PostLikeWaitControlIcon;
    protected $btnNewPostLike;
    protected $selectedPostLikeId = -1;

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

        $this->InitPostLikeDataGrid();
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
            $this->PostLikeGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PostLikeModal');
        }
    }
    protected function btnDeletePostLike_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PostLikeInstance->deleteObject()) {
            $this->PostLikeGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PostLikeModal');
        }
    }
    protected function InitPostLikeDataGrid() {
        $searchableAttributes = array(QQN::PostLike()->PostLike,QQN::PostLike()->DateCreated,QQN::PostLike()->AccountObject->Id,QQN::PostLike()->PostObject->Id);
        $headerItems = array('Post Like','Date Created','Account Object','Post Object');
        $headerSortNodes = array(QQN::PostLike()->PostLike,QQN::PostLike()->DateCreated,QQN::PostLike()->AccountObject->Id,QQN::PostLike()->PostObject->Id);
        $columnItems = array('PostLike','DateCreated','Account','Post');
        $this->PostLikeWaitControlIcon = new QWaitIcon($this);
        $this->btnNewPostLike = new QButton($this);
        $this->btnNewPostLike->Text = 'Add PostLike';
        $this->btnNewPostLike->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewPostLike->AddAction(new QClickEvent(), new QAjaxAction('btnNewPostLike_Clicked'));
        $this->PostLikeGrid = new PostLikeDataGrid($this, QQN::PostLike(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->PostLikeWaitControlIcon, 'PostLikeGrid');
    }
    protected function PostLikeGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostLikeGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostLikeGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostLikeGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostLikeGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostLikeGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostLikeGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PostLikeGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PostLikeGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->PostLikeGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PostLikeGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPostLikeId = $strParameter;
        $theObject = PostLike::Load($this->selectedPostLikeId);
        if ($theObject) {
            $this->PostLikeInstance->setObject($theObject);
            $this->PostLikeInstance->setValues($theObject);
            $this->PostLikeInstance->refreshAll();
            $this->btnDeletePostLike->Visible = true;
            AppSpecificFunctions::ToggleModal('PostLikeModal');
        }
    }
    protected function btnNewPostLike_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPostLikeId = -1;
        $this->PostLikeInstance->setObject(null);
        $this->PostLikeInstance->setValues(null);
        $this->btnDeletePostLike->Visible = false;
        AppSpecificFunctions::ToggleModal('PostLikeModal');
    }
}
PostLike_OverviewForm::Run('PostLike_OverviewForm');
?>