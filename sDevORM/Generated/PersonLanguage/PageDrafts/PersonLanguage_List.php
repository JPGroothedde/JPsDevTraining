<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PersonLanguage/PersonLanguageController.php');
require(__SDEV_CONTROLS__.'/Implementations/PersonLanguage/PersonLanguageDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PersonLanguage_ListForm extends QForm {
    // Data list variables
    protected $PersonLanguageList;
    protected $btnNewPersonLanguage;

    // PersonLanguage Object variables
    protected $PersonLanguageInstance;
    protected $btnSavePersonLanguage,$btnDeletePersonLanguage;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonLanguageDataList();
        $this->InitPersonLanguageModal();
    }
    protected function InitPersonLanguageModal() {
        $this->PersonLanguageInstance = new PersonLanguageController($this);

        $this->btnSavePersonLanguage = new QButton($this);
        $this->btnSavePersonLanguage->Text = 'Save';
        $this->btnSavePersonLanguage->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePersonLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnSavePersonLanguage_Clicked'));

        $this->btnDeletePersonLanguage = new QButton($this);
        $this->btnDeletePersonLanguage->Text = 'Delete';
        $this->btnDeletePersonLanguage->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePersonLanguage->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePersonLanguage->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePersonLanguage_Clicked'));
    }
    protected function btnSavePersonLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonLanguageInstance->saveObject()) {
            $this->PersonLanguageList->refreshList();
            AppSpecificFunctions::ToggleModal('PersonLanguageModal');
        }
    }
    protected function btnDeletePersonLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonLanguageInstance->deleteObject()) {
            $this->PersonLanguageList->refreshList();
            AppSpecificFunctions::ToggleModal('PersonLanguageModal');
        }
    }
    protected function InitPersonLanguageDataList() {
        $searchableAttributes = array(QQN::PersonLanguage()->Language,QQN::PersonLanguage()->PersonObject->Id,QQN::PersonLanguage()->MasterLanguageObject->Id);
        $SortAttributesShown = array('Language','Person Object','Master Language Object');
        $SortAttributes = array(QQN::PersonLanguage()->Language,QQN::PersonLanguage()->PersonObject->Id,QQN::PersonLanguage()->MasterLanguageObject->Id);
        $columnItems = array('Language','Person','MasterLanguage');
        $this->btnNewPersonLanguage = AppSpecificFunctions::getNewActionButton($this,'Add PersonLanguage','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewPersonLanguage_Clicked');
        $this->PersonLanguageList = new PersonLanguageDataList($this, QQN::PersonLanguage(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function PersonLanguage_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonLanguageList->getActiveId() != $strParameter)
                $this->PersonLanguageList->setActiveId($strParameter);
            else
                $this->PersonLanguageList->setActiveId(null);
        $theObject = PersonLanguage::Load($strParameter);
        if ($theObject) {
            $this->PersonLanguageInstance->setObject($theObject);
            $this->PersonLanguageInstance->setValues($theObject);
            $this->PersonLanguageInstance->refreshAll();
            $this->btnDeletePersonLanguage->Visible = true;
            AppSpecificFunctions::ToggleModal('PersonLanguageModal');
        }
    }
    protected function PersonLanguage_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function PersonLanguage_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PersonLanguage_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function PersonLanguage_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonLanguage_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewPersonLanguage_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonLanguageList->setActiveId(null);
        $this->PersonLanguageInstance->setObject(null);
        $this->PersonLanguageInstance->setValues(null);
        $this->btnDeletePersonLanguage->Visible = false;
        AppSpecificFunctions::ToggleModal('PersonLanguageModal');
    }
}
PersonLanguage_ListForm::Run('PersonLanguage_ListForm');
?>