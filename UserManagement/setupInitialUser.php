<?php
/**
 * Created by Stratusolve (Pty) Ltd in South Africa.
 * @author     johangriesel <info@stratusolve.com>
 *
 * Copyright (C) 2017 Stratusolve (Pty) Ltd - All Rights Reserved
 * Modification or removal of this script is not allowed. In order
 * to include this script within your solution you require express
 * permission from Stratusolve (Pty) Ltd.
 * Please reference the sDev SaaS Subscription license agreement. A
 * copy of this agreement can be obtained by sending an email to
 * info@stratusolve.co
 *
 *
 * THIS FILE SHOULD NOT BE EDITED. sDev assumes the integrity of this file. If you edit this file, it could be overridden by a future sDev update
 */
require('../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();
class SetupForm extends QForm {
    protected $AdminName;
    protected $AdminPass;
    protected $MaintenancePass;
    protected $btnCreateAdmin;
    public function Form_Create() {
        parent::Form_Create();
        $this->AdminName = new QTextBox($this);
        $this->AdminName->Name = 'Admin User Name';
        $this->AdminName->Text = 'admin';
        $this->AdminPass = new QTextBox($this);
        $this->AdminPass->Name = 'Admin Password';
        $this->AdminPass->Text = '';
        $this->AdminPass->TextMode = QTextMode::Password;
        $this->MaintenancePass = new QTextBox($this);
        $this->MaintenancePass->Name = 'Maintenance Password';
        $this->MaintenancePass->Text = '';
        $this->MaintenancePass->TextMode = QTextMode::Password;
        $this->btnCreateAdmin = new QButton($this);
        $this->btnCreateAdmin->Text = 'Create!';
        $this->btnCreateAdmin->AddAction(new QClickEvent(), new QAjaxAction('actionCreate'));
        $this->btnCreateAdmin->CssClass = 'btn btn-primary fullWidth rippleclick';

    }
    protected function actionCreate() {
        if (!$this->AdminName->Text) {
            QApplication::DisplayAlert('No username specified');
            return;
        }
        if (!$this->AdminPass->Text) {
            QApplication::DisplayAlert('No password specified');
            return;
        }
        if ($this->MaintenancePass->Text != __MAINTENANCEPWD__){
            QApplication::DisplayAlert('Incorrect maintenance password specified');
            return;
        }
        if (Account::LoadByUsername($this->AdminName->Text)) {
            QApplication::DisplayAlert('An account with that username already exists');
            return;
        }
        $userRole = Userrole::LoadByRole('Administrator');
        if (!$userRole)
        {
            $userRole = new Userrole();
            $userRole->Role = 'Administrator';
            try {
                $userRole->Save();
            } catch (QCallerException $objExc) {
                $objExc->IncrementOffset();
                QApplication::DisplayAlert('An error occurred. Could not create...'.$objExc->getMessage());
            }
        }
        $theNewAdmin = new Account();
        $theNewAdmin->Username = $this->AdminName->Text;
        $theNewAdmin->Password = QApplication::getHashedPassword($this->AdminPass->Text);
        $theNewAdmin->UserRoleObject = $userRole;
        try {
             $theNewAdmin->Save();
             QApplication::Redirect(__USRMNG__.'/login/created');
        } catch (QCallerException $objExc) {
                $objExc->IncrementOffset();
                QApplication::DisplayAlert('An error occurred. Could not create...'.$objExc->getMessage());
        }
    }
}
SetupForm::Run('SetupForm');

?>
