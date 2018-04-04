<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PageView/PageViewController.php');
require(__SDEV_CONTROLS__.'/Implementations/PageView/PageViewDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PageView_OverviewForm extends QForm {
    // Data grid variables
    protected $PageViewGrid;
    protected $PageViewWaitControlIcon;
    protected $btnNewPageView;
    protected $selectedPageViewId = -1;

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

        $this->InitPageViewDataGrid();
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
            $this->PageViewGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PageViewModal');
        }
    }
    protected function btnDeletePageView_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PageViewInstance->deleteObject()) {
            $this->PageViewGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PageViewModal');
        }
    }
    protected function InitPageViewDataGrid() {
        $searchableAttributes = array(QQN::PageView()->TimeStamped,QQN::PageView()->IPAddress,QQN::PageView()->PageDetails,QQN::PageView()->UserAgentDetails,QQN::PageView()->UserRole,QQN::PageView()->Username);
        $headerItems = array('Time Stamped','IP Address','Page Details','User Agent Details','User Role','Username');
        $headerSortNodes = array(QQN::PageView()->TimeStamped,QQN::PageView()->IPAddress,QQN::PageView()->PageDetails,QQN::PageView()->UserAgentDetails,QQN::PageView()->UserRole,QQN::PageView()->Username);
        $columnItems = array('TimeStamped','IPAddress','PageDetails','UserAgentDetails','UserRole','Username');
        $this->PageViewWaitControlIcon = new QWaitIcon($this);
        $this->btnNewPageView = new QButton($this);
        $this->btnNewPageView->Text = 'Add PageView';
        $this->btnNewPageView->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewPageView->AddAction(new QClickEvent(), new QAjaxAction('btnNewPageView_Clicked'));
        $this->PageViewGrid = new PageViewDataGrid($this, QQN::PageView(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->PageViewWaitControlIcon, 'PageViewGrid');
    }
    protected function PageViewGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PageViewGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PageViewGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PageViewGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PageViewGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PageViewGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PageViewGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PageViewGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PageViewGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->PageViewGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PageViewGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPageViewId = $strParameter;
        $theObject = PageView::Load($this->selectedPageViewId);
        if ($theObject) {
            $this->PageViewInstance->setObject($theObject);
            $this->PageViewInstance->setValues($theObject);
            $this->PageViewInstance->refreshAll();
            $this->btnDeletePageView->Visible = true;
            AppSpecificFunctions::ToggleModal('PageViewModal');
        }
    }
    protected function btnNewPageView_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPageViewId = -1;
        $this->PageViewInstance->setObject(null);
        $this->PageViewInstance->setValues(null);
        $this->btnDeletePageView->Visible = false;
        AppSpecificFunctions::ToggleModal('PageViewModal');
    }
}
PageView_OverviewForm::Run('PageView_OverviewForm');
?>