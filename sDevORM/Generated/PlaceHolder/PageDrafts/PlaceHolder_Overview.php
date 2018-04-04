<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PlaceHolder/PlaceHolderController.php');
require(__SDEV_CONTROLS__.'/Implementations/PlaceHolder/PlaceHolderDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PlaceHolder_OverviewForm extends QForm {
    // Data grid variables
    protected $PlaceHolderGrid;
    protected $PlaceHolderWaitControlIcon;
    protected $btnNewPlaceHolder;
    protected $selectedPlaceHolderId = -1;

    // PlaceHolder Object variables
    protected $PlaceHolderInstance;
    protected $btnSavePlaceHolder,$btnDeletePlaceHolder;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPlaceHolderDataGrid();
        $this->InitPlaceHolderModal();
    }
    protected function InitPlaceHolderModal() {
        $this->PlaceHolderInstance = new PlaceHolderController($this);

        $this->btnSavePlaceHolder = new QButton($this);
        $this->btnSavePlaceHolder->Text = 'Save';
        $this->btnSavePlaceHolder->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePlaceHolder->AddAction(new QClickEvent(), new QAjaxAction('btnSavePlaceHolder_Clicked'));

        $this->btnDeletePlaceHolder = new QButton($this);
        $this->btnDeletePlaceHolder->Text = 'Delete';
        $this->btnDeletePlaceHolder->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePlaceHolder->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePlaceHolder->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePlaceHolder_Clicked'));
    }
    protected function btnSavePlaceHolder_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PlaceHolderInstance->saveObject()) {
            $this->PlaceHolderGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PlaceHolderModal');
        }
    }
    protected function btnDeletePlaceHolder_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PlaceHolderInstance->deleteObject()) {
            $this->PlaceHolderGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PlaceHolderModal');
        }
    }
    protected function InitPlaceHolderDataGrid() {
        $searchableAttributes = array(QQN::PlaceHolder()->DummyOne,QQN::PlaceHolder()->DummyTwo,QQN::PlaceHolder()->DummyThree,QQN::PlaceHolder()->DummyFour,QQN::PlaceHolder()->DummyFive,QQN::PlaceHolder()->DummySix,QQN::PlaceHolder()->AccountObject->Id,QQN::PlaceHolder()->UserRoleObject->Id);
        $headerItems = array('Dummy One','Dummy Two','Dummy Three','Dummy Four','Dummy Five','Dummy Six','Account Object','User Role Object');
        $headerSortNodes = array(QQN::PlaceHolder()->DummyOne,QQN::PlaceHolder()->DummyTwo,QQN::PlaceHolder()->DummyThree,QQN::PlaceHolder()->DummyFour,QQN::PlaceHolder()->DummyFive,QQN::PlaceHolder()->DummySix,QQN::PlaceHolder()->AccountObject->Id,QQN::PlaceHolder()->UserRoleObject->Id);
        $columnItems = array('DummyOne','DummyTwo','DummyThree','DummyFour','DummyFive','DummySix','Account','UserRole');
        $this->PlaceHolderWaitControlIcon = new QWaitIcon($this);
        $this->btnNewPlaceHolder = new QButton($this);
        $this->btnNewPlaceHolder->Text = 'Add PlaceHolder';
        $this->btnNewPlaceHolder->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewPlaceHolder->AddAction(new QClickEvent(), new QAjaxAction('btnNewPlaceHolder_Clicked'));
        $this->PlaceHolderGrid = new PlaceHolderDataGrid($this, QQN::PlaceHolder(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->PlaceHolderWaitControlIcon, 'PlaceHolderGrid');
    }
    protected function PlaceHolderGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolderGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolderGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolderGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolderGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolderGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPlaceHolderId = $strParameter;
        $theObject = PlaceHolder::Load($this->selectedPlaceHolderId);
        if ($theObject) {
            $this->PlaceHolderInstance->setObject($theObject);
            $this->PlaceHolderInstance->setValues($theObject);
            $this->PlaceHolderInstance->refreshAll();
            $this->btnDeletePlaceHolder->Visible = true;
            AppSpecificFunctions::ToggleModal('PlaceHolderModal');
        }
    }
    protected function btnNewPlaceHolder_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPlaceHolderId = -1;
        $this->PlaceHolderInstance->setObject(null);
        $this->PlaceHolderInstance->setValues(null);
        $this->btnDeletePlaceHolder->Visible = false;
        AppSpecificFunctions::ToggleModal('PlaceHolderModal');
    }
    protected function btnDummyFour_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->PlaceHolderInstance->getControlId('DummyFour'))->Toggle(!$this->GetControl($this->PlaceHolderInstance->getControlId('DummyFour'))->IsToggled);
    }

    
}
PlaceHolder_OverviewForm::Run('PlaceHolder_OverviewForm');
?>