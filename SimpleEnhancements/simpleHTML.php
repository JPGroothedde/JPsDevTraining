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
class simpleHTML extends QActionControl{
    protected $html;
    protected $actionHelperId;
    protected $actionDisabled = false;

    public function __construct($objParentObject, $strControlId = null) {
            parent::__construct($objParentObject, $strControlId);
            $this->html = '<div id="'.$this->getJqControlId().'"></div>';
    }

    public function GetControlHtml() {
        return $this->html;
    }
    public function SetControlHtml($html) {
        $this->html = null;
        $this->html = $html;
    }
    public function getControlId() {
        return $this->getJqControlId();
    }

    public function updateControl($html) {
        $this->html = '<div id="'.$this->getJqControlId().'">';
        $this->html .= $html;
        $this->html .= '</div>';
        $this->Refresh();
    }
    public function GetControlHtmlText() {
        return $this->html;
    }
    public function SetActionHelperId($id = 0) {
        $this->actionHelperId = $id;
    }
    public function GetActionHelperId() {
        return $this->actionHelperId;
    }
    public function GetActionHelperDisabled() {
        return $this->actionDisabled;
    }
    public function SetActionHelperDisabled($disabled = false) {
        $this->actionDisabled = $disabled;
    }
}
?>
