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

class ForgottenPasswordForm extends QForm {
    protected $sUsername;

    protected $btnReset;
    protected $sh_ErrorMsg;

    protected $objWaitIcon;

    // Override Form Event Handlers as Needed
    public function Form_Create() {
        parent::Form_Create();

        $this->objWaitIcon = new QWaitIcon($this);
        $this->sUsername = new QTextBox($this);
        $this->sUsername->Name = "";
        //$this->sUsername->Required = true;
        $this->sUsername->CssClass = 'form-control';
        $this->sUsername->Placeholder = 'Username/Email';
        $this->sUsername->SetCustomAttribute('required', true);
        $this->sUsername->TextMode = QTextMode::Email;
        $this->sUsername->Focus();

        $this->btnReset = new QButton($this);
        $this->btnReset->Text = "Recover password";
        //$this->btnReset->CausesValidation = true;
        $this->btnReset->AddAction(new QClickEvent(), new QAjaxAction("btnReset_Click",$this->objWaitIcon));
        $this->btnReset->CssClass = 'btn btn-lg btn-primary btn-block btn-mrgtop rippleclick';
        $this->btnReset->PrimaryButton = true;

        $this->sh_ErrorMsg = new simpleHTML($this);
        $this->sh_ErrorMsg->updateControl('');
    }
    protected function btnReset_Click() {
        $theAccountToRecover = Account::LoadByUsername($this->sUsername->Text);
        if (!$theAccountToRecover) {
            $theAccountToRecover = Account::QuerySingle(QQ::Equal(QQN::Account()->EmailAddress,$this->sUsername->Text));
            if ($theAccountToRecover) {
                if (Account::QueryCount(QQ::Equal(QQN::Account()->EmailAddress,$this->sUsername->Text)) > 1) {
                    AppSpecificFunctions::ShowNotedFeedback('<strong>Warning!</strong> There are multiple accounts for that email address. Please contact the system administrator.',false);
                    return;
                }
            } else {
                AppSpecificFunctions::ShowNotedFeedback('<strong>Warning!</strong> We could not find your account. Please contact the system administrator.',false);
                return;
            }
        }

        $theResetToken = $this->generateRandomString();
        $uniqueToken = false;
        $count = 0;
        while (!$uniqueToken) {
            if ($count > 30)
                break;
            $theResetToken = $this->generateRandomString();
            $tokenExists = PasswordReset::LoadByToken($theResetToken);
            if (!$tokenExists)
               $uniqueToken = true;
            $count++;
        }
        if ($count <= 30) {
            $theTokenToUse = new PasswordReset();
            $theTokenToUse->AccountObject = $theAccountToRecover;
            $theTokenToUse->Token = $theResetToken;
            try {
                $theTokenToUse->Save();
            } catch (QCallerException $e) {
                AppSpecificFunctions::ShowNotedFeedback('<strong>Warning!</strong> Something unexpected happened. Please contact the system administrator.',false);
                return;
            }
        } else {
            AppSpecificFunctions::ShowNotedFeedback('<strong>Warning!</strong> Something unexpected happened. Please contact the system administrator.',false);
        }
        $theToEmail = $theAccountToRecover->EmailAddress;
        $subject = 'Password recovery request for '.$theAccountToRecover->FullName;
        $link = "http://".$_SERVER['SERVER_NAME'].__USRMNG__."/passwordreset/".$theTokenToUse->Token;
        $message = '<p>Dear '.$theAccountToRecover->FullName.'</p><p>Someone requested a password reset for your '.__APPNAME__.' account. If this was you, please follow the link below to complete the action.</p>
            <p>'.$link.'</p>
            <p>If you did not request this, simply ignore this email.</p>
            <p>Kind Regards<br>'.__APPNAME__.'</p>';

        $theMailToSend = new sEmailMessage(array($theToEmail),$subject,$message,null,null,array('info@stratusolve.com'));

        if (!$theMailToSend->sendMail()) {
            $message = '<strong>Error!</strong> We could not help you recover your password right now. Please try again later.';
            AppSpecificFunctions::ShowNotedFeedback($message,false);
        } else {
            $message = '<strong>Success!</strong> We have emailed you some instructions to help you recover your password.';
            AppSpecificFunctions::ShowNotedFeedback($message);
        }
        $this->sUsername->Text = '';
        $this->sUsername->Refresh();
        
    }
	protected function generateRandomString($length = 200) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}
ForgottenPasswordForm::Run('ForgottenPasswordForm');
?>