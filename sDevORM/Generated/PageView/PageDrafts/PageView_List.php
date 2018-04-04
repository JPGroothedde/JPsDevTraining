<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PageView/PageViewController.php');
require(__SDEV_CONTROLS__.'/Implementations/PageView/PageViewDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PageView_ListForm extends QForm {
    // Data list variables
    protected $PageViewList;
    protected $btnNewPageView;

    // PageView Object variables
    protected $PageViewInstance;
    protected $btnSavePageView,$btnDeletePageView;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPageViewDataList();
        $this->InitPageViewModal();
    }
    protected function InitPageViewModal() {
        $this->PageViewInstance = new PageViewController($this);

        $this->btnSavePageView = new QButton($this);
        $this->btnSavePageView->Text = 'Save';
        $this->btnSavePageView->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePageView->AddAction(new QClickEvent(), new QAjaxAction('btnSavePageView_Clicked'));

        $this->btnDeletePageView = new QButton($this);
        $this->btnDeletePageView->Text = 'Delete';
        $this->btnDeletePageView->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePageView->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePageView->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePageView_Clicked'));
    }
    protected function btnSavePageView_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PageViewInstance->saveObject()) {
            $this->PageViewList->refreshList();
            AppSpecificFunctions::ToggleModal('PageViewModal');
        }
    }
    protected function btnDeletePageView_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PageViewInstance->deleteObject()) {
            $this->PageViewList->refreshList();
            AppSpecificFunctions::ToggleModal('PageViewModal');
        }
    }
    protected function InitPageViewDataList() {
        $searchableAttributes = array(QQN::PageView()->TimeStamped,QQN::PageView()->IPAddress,QQN::PageView()->PageDetails,QQN::PageView()->UserAgentDetails,QQN::PageView()->UserRole,QQN::PageView()->Username);
        $SortAttributesShown = array('Time Stamped','IP Address','Page Details','User Agent Details','User Role','Username');
        $SortAttributes = array(QQN::PageView()->TimeStamped,QQN::PageView()->IPAddress,QQN::PageView()->PageDetails,QQN::PageView()->UserAgentDetails,QQN::PageView()->UserRole,QQN::PageView()->Username);
        $columnItems = array('TimeStamped','IPAddress','PageDetails','UserAgentDetails','UserRole','Username');
        $this->btnNewPageView = AppSpecificFunctions::getNewActionButton($this,'Add PageView','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewPageView_Clicked');
        $this->PageViewList = new PageViewDataList($this, QQN::PageView(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function PageView_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->PageViewList->getActiveId() != $strParameter)
                $this->PageViewList->setActiveId($strParameter);
            else
                $this->PageViewList->setActiveId(null);
        $theObject = PageView::Load($strParameter);
        if ($theObject) {
            $this->PageViewInstance->setObject($theObject);
            $this->PageViewInstance->setValues($theObject);
            $this->PageViewInstance->refreshAll();
            $this->btnDeletePageView->Visible = true;
            AppSpecificFunctions::ToggleModal('PageViewModal');
        }
    }
    protected function PageView_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->PageViewList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function PageView_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->PageViewList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PageView_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->PageViewList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function PageView_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->PageViewList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PageView_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->PageViewList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewPageView_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PageViewList->setActiveId(null);
        $this->PageViewInstance->setObject(null);
        $this->PageViewInstance->setValues(null);
        $this->btnDeletePageView->Visible = false;
        AppSpecificFunctions::ToggleModal('PageViewModal');
    }
}
PageView_ListForm::Run('PageView_ListForm');
?>