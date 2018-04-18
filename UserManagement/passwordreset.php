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
    protected $sPassword;
    protected $sPasswordConfirm;

    protected $btnReset;
    protected $sh_ErrorMsg;
    protected $hasValidToken;
    protected $theToken;

    protected $objWaitIcon;

    // Override Form Event Handlers as Needed
    public function Form_Create() {
        parent::Form_Create();
        $this->objWaitIcon = new QWaitIcon($this);
        $theToken = QApplication::PathInfo(0);
        $this->hasValidToken = false;
        if (strlen($theToken) > 0) {
            $this->theToken = Passwordreset::LoadByToken($theToken);
            if ($this->theToken)
                $this->hasValidToken = true;
        }
        $this->sPassword = new QTextBox($this);
        $this->sPassword->Name = "";
        $this->sPassword->CssClass = 'form-control';
        $this->sPassword->Placeholder = 'Password';
        $this->sPassword->TextMode = QTextMode::Password;
        $this->sPassword->Focus();
        $this->sPassword->Visible = $this->hasValidToken;

        $this->sPasswordConfirm = new QTextBox($this);
        $this->sPasswordConfirm->Name = "";
        $this->sPasswordConfirm->CssClass = 'form-control';
        $this->sPasswordConfirm->Placeholder = 'Confirm password';
        $this->sPasswordConfirm->TextMode = QTextMode::Password;
        $this->sPasswordConfirm->Visible = $this->hasValidToken;

        $this->btnReset = new QButton($this);
        $this->btnReset->Text = "Create new password";
        $this->btnReset->AddAction(new QClickEvent(), new QAjaxAction("btnReset_Click",$this->objWaitIcon));
        $this->btnReset->CssClass = 'btn btn-lg btn-primary btn-block btn-mrgtop rippleclick';
        $this->btnReset->PrimaryButton = true;
        $this->btnReset->Display = $this->hasValidToken;

        $this->sh_ErrorMsg = new simpleHTML($this);
        $this->sh_ErrorMsg->SetControlHtml('');
        if (!$this->hasValidToken)
            $this->sh_ErrorMsg->SetControlHtml('<div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <strong>Warning!</strong> This page does no longer exist!
                      <a href="login.php">Go to login page</a>
                    </div>');
    }
    protected function btnReset_Click() {
        if ((strlen($this->sPassword->Text) > 0) && (strlen($this->sPasswordConfirm->Text) > 0)) {
            if ($this->sPassword->Text != $this->sPasswordConfirm->Text) {
                QApplication::ShowNotedFeedback('<strong>Warning!</strong> The passwords did not match.',false);
                $this->sPassword->Text = '';
                $this->sPassword->Refresh();
                $this->sPasswordConfirm->Text = '';
                $this->sPasswordConfirm->Refresh();
                return;
            }
        } else {
            QApplication::ShowNotedFeedback('<strong>Warning!</strong> The passwords did not match.',false);
            $this->sPassword->Text = '';
            $this->sPassword->Refresh();
            $this->sPasswordConfirm->Text = '';
            $this->sPasswordConfirm->Refresh();
            return;
        }
        $theAccountToUpdate = $this->theToken->AccountObject;
        $theAccountToUpdate->Password = QApplication::getHashedPassword($this->sPassword->Text);
        try {
            $theAccountToUpdate->Save();
            $allTokensForThisAccount = Passwordreset::LoadArrayByAccount($theAccountToUpdate->Id);
            foreach ($allTokensForThisAccount as $aTokenToDelete) {
                $aTokenToDelete->Delete();
            }
        } catch (QCallerException $e) {
            QApplication::ShowNotedFeedback('<strong>Warning!</strong> Something unexpected happened. Please contact the system administrator.',false);
            return;
        }

        QApplication::Redirect(__USRMNG__.'/login/passwordreset');

    }
	protected function generateRandomString($length = 200) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}
ForgottenPasswordForm::Run('ForgottenPasswordForm');
?>