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
require('sdev.inc.php');
require(__PAGE_CONTROL__.'/pageManager.php');
class RemoteAccessForm extends QForm {
    // Override Form Event Handlers as Needed
    protected $txtMaintenancePwd,$btnCheckPwd;
    public function Form_Create() {
        parent::Form_Create();
        $this->txtMaintenancePwd = new QTextBox($this);
        $this->txtMaintenancePwd->Name = 'Maintenance Password';

        $this->btnCheckPwd = AppSpecificFunctions::getNewActionButton($this,'Enter Maintenance Mode','btn btn-primary fullWidth','checkPwd');
    }
    protected function checkPwd() {
        if (!class_exists('RemoteAccess')) {
            AppSpecificFunctions::ShowNotedFeedback('Remote access not yet configured. Please set "ALLOW_REMOTE_ADMIN" to true in configuration and then regenerate the ORM',false);
            return false;
        }

        if (!__ALLOW_REMOTE_ADMIN_VIA_MAINTENANCEPWD__) {
            AppSpecificFunctions::ShowNotedFeedback('Remote access disabled',false);
            return;
        }
        if ($this->txtMaintenancePwd->Text != __MAINTENANCEPWD__) {
            AppSpecificFunctions::ShowNotedFeedback('Incorrect Maintenance Password',false);
        } else {
            $IPAddress = $_SERVER['REMOTE_ADDR'];
            $hasAccess = RemoteAccess::QuerySingle(QQ::AndCondition(QQ::Equal(QQN::RemoteAccess()->IpAddress,$IPAddress)));
            if (!$hasAccess) {
                $hasAccess = new RemoteAccess();
            }
            $hasAccess->IpAddress = $IPAddress;
            $hasAccess->AccessDateTime = QDateTime::Now();
            try {
                $hasAccess->Save();
                AppSpecificFunctions::ShowNotedFeedback('Remote Access Granted');
            } catch (QCallerException $e) {
                AppSpecificFunctions::ShowNotedFeedback('Remote access disabled: '.$e->getMessage(),false);
            }
        }
    }
}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
RemoteAccessForm::Run('RemoteAccessForm');
?>