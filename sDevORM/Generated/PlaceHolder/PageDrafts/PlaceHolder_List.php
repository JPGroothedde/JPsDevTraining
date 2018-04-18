<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PlaceHolder/PlaceHolderController.php');
require(__SDEV_CONTROLS__.'/Implementations/PlaceHolder/PlaceHolderDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!checkRole(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PlaceHolder_ListForm extends QForm {
    // Data list variables
    protected $PlaceHolderList;
    protected $btnNewPlaceHolder;

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

        $this->InitPlaceHolderDataList();
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
            $this->PlaceHolderList->refreshList();
            AppSpecificFunctions::ToggleModal('PlaceHolderModal');
        }
    }
    protected function btnDeletePlaceHolder_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PlaceHolderInstance->deleteObject()) {
            $this->PlaceHolderList->refreshList();
            AppSpecificFunctions::ToggleModal('PlaceHolderModal');
        }
    }
    protected function InitPlaceHolderDataList() {
        $searchableAttributes = array(QQN::PlaceHolder()->DummyOne,QQN::PlaceHolder()->DummyTwo,QQN::PlaceHolder()->DummyThree,QQN::PlaceHolder()->DummyFour,QQN::PlaceHolder()->DummyFive,QQN::PlaceHolder()->DummySix,QQN::PlaceHolder()->AccountObject->Id,QQN::PlaceHolder()->UserRoleObject->Id);
        $SortAttributesShown = array('Dummy One','Dummy Two','Dummy Three','Dummy Four','Dummy Five','Dummy Six','Account Object','User Role Object');
        $SortAttributes = array(QQN::PlaceHolder()->DummyOne,QQN::PlaceHolder()->DummyTwo,QQN::PlaceHolder()->DummyThree,QQN::PlaceHolder()->DummyFour,QQN::PlaceHolder()->DummyFive,QQN::PlaceHolder()->DummySix,QQN::PlaceHolder()->AccountObject->Id,QQN::PlaceHolder()->UserRoleObject->Id);
        $columnItems = array('DummyOne','DummyTwo','DummyThree','DummyFour','DummyFive','DummySix','Account','UserRole');
        $this->btnNewPlaceHolder = AppSpecificFunctions::getNewActionButton($this,'Add PlaceHolder','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewPlaceHolder_Clicked');
        $this->PlaceHolderList = new PlaceHolderDataList($this, QQN::PlaceHolder(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function PlaceHolder_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->PlaceHolderList->getActiveId() != $strParameter)
                $this->PlaceHolderList->setActiveId($strParameter);
            else
                $this->PlaceHolderList->setActiveId(null);
        $theObject = PlaceHolder::Load($strParameter);
        if ($theObject) {
            $this->PlaceHolderInstance->setObject($theObject);
            $this->PlaceHolderInstance->setValues($theObject);
            $this->PlaceHolderInstance->refreshAll();
            $this->btnDeletePlaceHolder->Visible = true;
            AppSpecificFunctions::ToggleModal('PlaceHolderModal');
        }
    }
    protected function PlaceHolder_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolder_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolder_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolder_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolder_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewPlaceHolder_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PlaceHolderList->setActiveId(null);
        $this->PlaceHolderInstance->setObject(null);
        $this->PlaceHolderInstance->setValues(null);
        $this->btnDeletePlaceHolder->Visible = false;
        AppSpecificFunctions::ToggleModal('PlaceHolderModal');
    }
    protected function btnDummyFour_Clicked($strFormId, $strControlId, $strParameter) {
        $this->GetControl($this->PlaceHolderInstance->getControlId('DummyFour'))->Toggle(!$this->GetControl($this->PlaceHolderInstance->getControlId('DummyFour'))->IsToggled);
    }

    
}
PlaceHolder_ListForm::Run('PlaceHolder_ListForm');
?>