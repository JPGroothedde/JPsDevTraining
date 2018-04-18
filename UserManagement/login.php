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

class LoginForm extends QForm {
    protected $sUsername;
    protected $sPassword;
    protected $btnSaveLogin,$bSaveLogin = false;
    protected $btnLogin;
    protected $sh_ErrorMsg;
    protected $btnForgottenPassword;
    // Override Form Event Handlers as Needed
    public function Form_Create() {
        parent::Form_Create();

        $this->sUsername = new QTextBox($this);
        $this->sUsername->Name = "";
        $this->sUsername->Placeholder = 'Username';
        $this->sUsername->Focus();

        $this->sPassword = new QTextBox($this);
        $this->sPassword->Name = "";
        $this->sPassword->TextMode = QTextMode::Password;
        $this->sPassword->Placeholder = 'Password';

        $this->btnSaveLogin = new QButton($this);
        $this->btnSaveLogin->DisplayStyle = QDisplayStyle::Block;
        $this->btnSaveLogin->HtmlEntities = false;
        $this->btnSaveLogin->setAsToggle(true,'Remember Me','Remember Me');
        $this->btnSaveLogin->IsToggle = true;
        $this->btnSaveLogin->IsToggled = false;
        $this->btnSaveLogin->CssClass = 'btn btn-link';
        $this->btnSaveLogin->AddAction(new QClickEvent(),new QAjaxAction('btnSaveLogin_Clicked'));

        $this->btnLogin = new QButton($this);
        $this->btnLogin->Text = "Login";
        $this->btnLogin->AddAction(new QClickEvent(), new QAjaxAction("btnLogin_Click"));
        $this->btnLogin->CssClass = 'btn btn-lg btn-primary btn-block btn-mrgtop rippleclick';

        $this->btnForgottenPassword = new QButton($this);
        $this->btnForgottenPassword->Text = "Having Trouble?";
        $this->btnForgottenPassword->AddAction(new QClickEvent(), new QAjaxAction("btnForgottenPassword_Click"));
        $this->btnForgottenPassword->AddCssClass('btn btn-link');

        $this->doPostLogin();
        $this->doGetLogin();
        $this->checkPersistantLogin();

        $this->SetDefaultEnterPressedJs(QApplication::getPostBackJs($this->FormId,$this->btnLogin->getJqControlId()));
    }
    protected function btnSaveLogin_Clicked($strFormId, $strControlId, $strParameter) {
        $this->btnSaveLogin->Toggle(!$this->btnSaveLogin->IsToggled);
    }
    protected function doGetLogin() {
        if ($this->getPathInfo() == 'created') {
            QApplication::ShowNotedFeedback('<strong>Success!</strong> You have created an Administrator. You can now login with the provided details.');
            return;
        }
        if ($this->getPathInfo() == 'passwordreset') {
            QApplication::ShowNotedFeedback('<strong>Success!</strong> You have created a new password. You can now login with the provided details.');
            return;
        }
        if ($this->getPathInfo() == 'newaccount') {
            QApplication::ShowNotedFeedback('<strong>Success!</strong> You have created a new account. You can now login with the provided details.');
            return;
        }
    }
    protected function doPostLogin() {
        if (isset($_POST['Username'])) {
            if (isset($_POST['Password'])) {
                $this->sUsername->Text = $_POST['Username'];
                $this->sPassword->Text = $_POST['Password'];
                if (isset($_POST['Remember']))
                    $this->bSaveLogin = true;
                $this->btnLogin_Click();
            }
        }
    }
    protected function btnLogin_Click() {
        $objAccount = Account::LoadByUsername($this->sUsername->Text);
        if ($objAccount) {
            if (QApplication::verifyHashedPassword($this->sPassword->Text,$objAccount->Password)) {
                $_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"] = $objAccount->Id;
                $_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_UserRoleId"] = $objAccount->UserRoleObject->Id;
                
                if ($this->btnSaveLogin->IsToggled == true) {
                    $newToken = $this->getUniqueToken();
                    $objLoginToken = new LoginToken();
                    $objLoginToken->LoginToken = $newToken;
                    $objLoginToken->AccountObject = $objAccount;
                    try {
                        $objLoginToken->Save();
                        $this->setPersistantLogin($objLoginToken->LoginToken);
                        $this->RedirectToAfterLoginPage();
                    }catch (QCallerException $objExc) {
                        $objExc->IncrementOffset();
                        QApplication::DisplayAlert('Could not save login!'.$objExc->getMessage());
                    }
                } else
                    $this->RedirectToAfterLoginPage();
            } else {
                QApplication::ShowNotedFeedback('<strong>Warning!</strong> The information provided is not correct.',false);
            }
        } else {
            QApplication::ShowNotedFeedback('<strong>Warning!</strong> The information provided is not correct.',false);
        }

    }
    protected function checkPersistantLogin() {
        if (isset($_COOKIE[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)])) {
            $objLoginToken = LoginToken::QuerySingle(QQ::Equal(QQN::LoginToken()->LoginToken,$_COOKIE[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)]));
            if ($objLoginToken) {
                $objAccount = $objLoginToken->AccountObject;
                if ($objAccount) {
                    // Here we will set the session variables AccountId and Userrole
                    $_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_AccountId"] = $objAccount->Id;
                    $_SESSION[AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__)."_UserRoleId"] = $objAccount->UserRoleObject->Id;
                    $this->RedirectToAfterLoginPage();
                } else {
                    setcookie(AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__), '', time()-1000);
                    setcookie(AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__), '', time()-1000, '/');
                }
            } else {
                setcookie(AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__), '', time()-1000);
                setcookie(AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__), '', time()-1000, '/');
            }
        } else {
            // Put something here for debug purposes
        }
    }
    protected function setPersistantLogin($token) {
        $expire = time()+60*60*24*365; // Set Expiration to 1 year
        setcookie(AppSpecificFunctions::removeSpacesFromString(__LOGINTOKEN__), $token, $expire,'/');
    }
    protected function getUniqueToken() {
        $done = false;
        $token = '';
        while (!$done) {
            $token = QApplication::generateRandomString(50);
            $objLoginToken = LoginToken::LoadByLoginToken($token);
            if (!$objLoginToken)
                $done = true;
        }
        return $token;
    }
    protected function btnForgottenPassword_Click() {
        QApplication::Redirect(__SUBDIRECTORY__.'/UserManagement/forgottenpassword/');
    }
    protected function RedirectToAfterLoginPage() {
        $redirectUrl = QApplication::getAfterLoginRedirectPage();
        QApplication::Redirect($redirectUrl);
    }
    protected function getPathInfo() {
        $pathInfo = QApplication::PathInfo(0);
        if (strlen($pathInfo) > 0)
            return $pathInfo;
        else
            return 'NOTHING';
    }
}
LoginForm::Run('LoginForm');
?>