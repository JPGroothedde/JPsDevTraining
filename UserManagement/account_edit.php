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
require(__PAGE_CONTROL__.'/pageManager.php');
require_once(__SDEV_ORM__.'/Implementations/Account/AccountController_Self.php');
class AccountEditForm extends QForm {
    protected $currentAccount;
    protected $AccountInstance;

    protected $btnSave;
	protected $btnCancel;
            
	protected function Form_Create() {
        if (isset($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__).'_AccountId'])) {
            $this->currentAccount = Account::Load($_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__).'_AccountId']);
        } else
            AppSpecificFunctions::Redirect ('login/');
        if (!$this->currentAccount)
            AppSpecificFunctions::Redirect ('login/');

        $this->AccountInstance = new AccountController_Self($this,$this->currentAccount);

        $this->btnSave = new QButton($this);
        $this->btnSave->Text = 'Save';
        $this->btnSave->CssClass = 'btn btn-success rippleclick fullWidth';
        $this->btnSave->AddAction(new QClickEvent(), new QAjaxAction('btnSave_Click'));

        $this->btnCancel = new QButton($this);
        $this->btnCancel->Text = 'Cancel';
        $this->btnCancel->CssClass = 'btn btn-info rippleclick fullWidth';
        $this->btnCancel->AddAction(new QClickEvent(), new QAjaxAction('btnCancel_Click'));
    }
    protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
		if ($this->AccountInstance->saveObject()) {
            AppSpecificFunctions::Redirect(loadPreviousPage());
        }

	}
    protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
        AppSpecificFunctions::Redirect(loadPreviousPage());
	}
}
AccountEditForm::Run('AccountEditForm');
?>