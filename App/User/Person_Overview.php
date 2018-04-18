<?php
require('../../sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
require(__SDEV_ORM__.'/Implementations/Person/PersonController.php');
require(__SDEV_CONTROLS__.'/Implementations/Person/PersonDataGrid.php');

// Define User roles that have access to this page here. If commented out, this page is accessible to anyone
/*if (!AppSpecificFunctions::checkPageAccess(array('Administrator'))) {
        AppSpecificFunctions::Redirect(__USRMNG__.'/login/');
}*/
// Remove this line if the file needs to be accessible remotely(production)
AppSpecificFunctions::CheckRemoteAdmin();
class Person_OverviewForm extends QForm {
    // Data grid variables
    protected $PersonGrid;
    protected $PersonWaitControlIcon;
    protected $btnNewPerson;
    protected $selectedPersonId = -1;

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

        $this->InitPersonDataGrid();
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
            $this->PersonGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PersonModal');
        }
    }
    protected function btnDeletePerson_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->PersonInstance->deleteObject()) {
            $this->PersonGrid->UpdateGrid();
            AppSpecificFunctions::ToggleModal('PersonModal');
        }
    }
    protected function InitPersonDataGrid() {
        $searchableAttributes = array(QQN::Person()->FirstName,QQN::Person()->Surname,QQN::Person()->IDPassportNumber,QQN::Person()->DateOfBirth,QQN::Person()->TelephoneNumber,QQN::Person()->AlternativeTelephoneNumber,QQN::Person()->Nationality,QQN::Person()->EthnicGroup,QQN::Person()->DriversLicense,QQN::Person()->CurrentAddress,QQN::Person()->FileDocumentObject->Id);
        $headerItems = array('First Name','Surname','ID Passport Number','Date Of Birth','Telephone Number','Alternative Telephone Number','Nationality','Ethnic Group','Drivers License','Current Address','File Document Object');
        $headerSortNodes = array(QQN::Person()->FirstName,QQN::Person()->Surname,QQN::Person()->IDPassportNumber,QQN::Person()->DateOfBirth,QQN::Person()->TelephoneNumber,QQN::Person()->AlternativeTelephoneNumber,QQN::Person()->Nationality,QQN::Person()->EthnicGroup,QQN::Person()->DriversLicense,QQN::Person()->CurrentAddress,QQN::Person()->FileDocumentObject->Id);
        $columnItems = array('FirstName','Surname','IDPassportNumber','DateOfBirth','TelephoneNumber','AlternativeTelephoneNumber','Nationality','EthnicGroup','DriversLicense','CurrentAddress','FileDocument');
        $this->PersonWaitControlIcon = new QWaitIcon($this);
        $this->btnNewPerson = new QButton($this);
        $this->btnNewPerson->Text = 'Add Person';
        $this->btnNewPerson->CssClass = 'btn btn-primary rippleclick mrg-top10 '.$this->buttonFullWidthCss;
        $this->btnNewPerson->AddAction(new QClickEvent(), new QAjaxAction('btnNewPerson_Clicked'));
        $this->PersonGrid = new PersonDataGrid($this, QQN::Person(),$searchableAttributes, 'Search...', $headerItems, $headerSortNodes, $columnItems, null, 10, $this->PersonWaitControlIcon, 'PersonGrid');
    }
    protected function PersonGrid_ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonGrid->ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonGrid_NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonGrid->NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonGrid_DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonGrid->DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonGrid_ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->PersonGrid->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PersonGrid_ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->PersonGrid->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PersonGrid_DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPersonId = $strParameter;
        $theObject = Person::Load($this->selectedPersonId);
        if ($theObject) {
            $this->PersonInstance->setObject($theObject);
            $this->PersonInstance->setValues($theObject);
            $this->PersonInstance->refreshAll();
            $this->btnDeletePerson->Visible = true;
            AppSpecificFunctions::ToggleModal('PersonModal');
        }
    }
    protected function btnNewPerson_Clicked($strFormId, $strControlId, $strParameter) {
        $this->selectedPersonId = -1;
        $this->PersonInstance->setObject(null);
        $this->PersonInstance->setValues(null);
        $this->btnDeletePerson->Visible = false;
        AppSpecificFunctions::ToggleModal('PersonModal');
    }
}
Person_OverviewForm::Run('Person_OverviewForm');
?>