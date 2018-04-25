<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/PersonSkillsTag/PersonSkillsTagController.php');
require(__SDEV_CONTROLS__.'/Implementations/PersonSkillsTag/PersonSkillsTagDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class PersonSkillsTag_ListForm extends QForm {
    // Data list variables
    protected $PersonSkillsTagList;
    protected $btnNewPersonSkillsTag;

    // PersonSkillsTag Object variables
    protected $PersonSkillsTagInstance;
    protected $btnSavePersonSkillsTag,$btnDeletePersonSkillsTag;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonSkillsTagDataList();
        $this->InitPersonSkillsTagModal();
    }
    protected function InitPersonSkillsTagModal() {
        $this->PersonSkillsTagInstance = new PersonSkillsTagController($this);

        $this->btnSavePersonSkillsTag = new QButton($this);
        $this->btnSavePersonSkillsTag->Text = 'Save';
        $this->btnSavePersonSkillsTag->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePersonSkillsTag->AddAction(new QClickEvent(), new QAjaxAction('btnSavePersonSkillsTag_Clicked'));

        $this->btnDeletePersonSkillsTag = new QButton($this);
        $this->btnDeletePersonSkillsTag->Text = 'Delete';
        $this->btnDeletePersonSkillsTag->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePersonSkillsTag->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePersonSkillsTag->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePersonSkillsTag_Clicked'));
    }
    protected function btnSavePersonSkillsTag_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonSkillsTagInstance->saveObject()) {
            $this->PersonSkillsTagList->refreshList();
            AppSpecificFunctions::ToggleModal('PersonSkillsTagModal');
        }
    }
    protected function btnDeletePersonSkillsTag_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonSkillsTagInstance->deleteObject()) {
            $this->PersonSkillsTagList->refreshList();
            AppSpecificFunctions::ToggleModal('PersonSkillsTagModal');
        }
    }
    protected function InitPersonSkillsTagDataList() {
        $searchableAttributes = array(QQN::PersonSkillsTag()->SkillTag,QQN::PersonSkillsTag()->PersonObject->Id);
        $SortAttributesShown = array('Skill Tag','Person Object');
        $SortAttributes = array(QQN::PersonSkillsTag()->SkillTag,QQN::PersonSkillsTag()->PersonObject->Id);
        $columnItems = array('SkillTag','Person');
        $this->btnNewPersonSkillsTag = AppSpecificFunctions::getNewActionButton($this,'Add PersonSkillsTag','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewPersonSkillsTag_Clicked');
        $this->PersonSkillsTagList = new PersonSkillsTagDataList($this, QQN::PersonSkillsTag(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function PersonSkillsTag_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonSkillsTagList->getActiveId() != $strParameter)
                $this->PersonSkillsTagList->setActiveId($strParameter);
            else
                $this->PersonSkillsTagList->setActiveId(null);
        $theObject = PersonSkillsTag::Load($strParameter);
        if ($theObject) {
            $this->PersonSkillsTagInstance->setObject($theObject);
            $this->PersonSkillsTagInstance->setValues($theObject);
            $this->PersonSkillsTagInstance->refreshAll();
            $this->btnDeletePersonSkillsTag->Visible = true;
            AppSpecificFunctions::ToggleModal('PersonSkillsTagModal');
        }
    }
    protected function PersonSkillsTag_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function PersonSkillsTag_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PersonSkillsTag_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function PersonSkillsTag_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonSkillsTag_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewPersonSkillsTag_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonSkillsTagList->setActiveId(null);
        $this->PersonSkillsTagInstance->setObject(null);
        $this->PersonSkillsTagInstance->setValues(null);
        $this->btnDeletePersonSkillsTag->Visible = false;
        AppSpecificFunctions::ToggleModal('PersonSkillsTagModal');
    }
}
PersonSkillsTag_ListForm::Run('PersonSkillsTag_ListForm');
?>