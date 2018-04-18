<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Person/PersonController.php');
require(__SDEV_CONTROLS__.'/Implementations/Person/PersonDataList.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Person_ListForm extends QForm {
    // Data list variables
    protected $PersonList;
    protected $btnNewPerson;

    // Person Object variables
    protected $PersonInstance;
    protected $btnSavePerson,$btnDeletePerson;

    //Mobile css
    protected $buttonFullWidthCss = '';
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Form_Create() {
        parent::Form_Create();

        if (AppSpecificFunctions::GetDeviceType() == 'phone')
            $this->buttonFullWidthCss = 'fullWidth mrg-bottom5';

        $this->InitPersonDataList();
        $this->InitPersonModal();
    }
    protected function InitPersonModal() {
        $this->PersonInstance = new PersonController($this);

        $this->btnSavePerson = new QButton($this);
        $this->btnSavePerson->Text = 'Save';
        $this->btnSavePerson->CssClass = 'btn btn-success rippleclick mrg-top10 fullWidth';
        $this->btnSavePerson->AddAction(new QClickEvent(), new QAjaxAction('btnSavePerson_Clicked'));

        $this->btnDeletePerson = new QButton($this);
        $this->btnDeletePerson->Text = 'Delete';
        $this->btnDeletePerson->CssClass = 'btn btn-danger rippleclick mrg-top10 fullWidth';
        $this->btnDeletePerson->AddAction(new QClickEvent(), new QConfirmAction('Are you sure?'));
        $this->btnDeletePerson->AddAction(new QClickEvent(), new QAjaxAction('btnDeletePerson_Clicked'));
    }
    protected function btnSavePerson_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonInstance->saveObject()) {
            $this->PersonList->refreshList();
            AppSpecificFunctions::ToggleModal('PersonModal');
        }
    }
    protected function btnDeletePerson_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonInstance->deleteObject()) {
            $this->PersonList->refreshList();
            AppSpecificFunctions::ToggleModal('PersonModal');
        }
    }
    protected function InitPersonDataList() {
        $searchableAttributes = array(QQN::Person()->FirstName,QQN::Person()->Surname,QQN::Person()->IDPassportNumber,QQN::Person()->DateOfBirth,QQN::Person()->TelephoneNumber,QQN::Person()->AlternativeTelephoneNumber,QQN::Person()->Nationality,QQN::Person()->EthnicGroup,QQN::Person()->DriversLicense,QQN::Person()->CurrentAddress,QQN::Person()->FileDocumentObject->Id);
        $SortAttributesShown = array('First Name','Surname','ID Passport Number','Date Of Birth','Telephone Number','Alternative Telephone Number','Nationality','Ethnic Group','Drivers License','Current Address','File Document Object');
        $SortAttributes = array(QQN::Person()->FirstName,QQN::Person()->Surname,QQN::Person()->IDPassportNumber,QQN::Person()->DateOfBirth,QQN::Person()->TelephoneNumber,QQN::Person()->AlternativeTelephoneNumber,QQN::Person()->Nationality,QQN::Person()->EthnicGroup,QQN::Person()->DriversLicense,QQN::Person()->CurrentAddress,QQN::Person()->FileDocumentObject->Id);
        $columnItems = array('FirstName','Surname','IDPassportNumber','DateOfBirth','TelephoneNumber','AlternativeTelephoneNumber','Nationality','EthnicGroup','DriversLicense','CurrentAddress','FileDocument');
        $this->btnNewPerson = AppSpecificFunctions::getNewActionButton($this,'Add Person','btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss,'btnNewPerson_Clicked');
        $this->PersonList = new PersonDataList($this, QQN::Person(),$searchableAttributes, null, $columnItems, $SortAttributes,$SortAttributesShown);
    }
    protected function Person_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonList->getActiveId() != $strParameter)
                $this->PersonList->setActiveId($strParameter);
            else
                $this->PersonList->setActiveId(null);
        $theObject = Person::Load($strParameter);
        if ($theObject) {
            $this->PersonInstance->setObject($theObject);
            $this->PersonInstance->setValues($theObject);
            $this->PersonInstance->refreshAll();
            $this->btnDeletePerson->Visible = true;
            AppSpecificFunctions::ToggleModal('PersonModal');
        }
    }
    protected function Person_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->PersonList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function Person_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->PersonList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function Person_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->PersonList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }
    protected function Person_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->PersonList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function Person_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->PersonList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function btnNewPerson_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonList->setActiveId(null);
        $this->PersonInstance->setObject(null);
        $this->PersonInstance->setValues(null);
        $this->btnDeletePerson->Visible = false;
        AppSpecificFunctions::ToggleModal('PersonModal');
    }
}
Person_ListForm::Run('Person_ListForm');
?>