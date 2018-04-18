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
class sUIElementsBase extends simpleHTML {
    protected $childControls = array();
    public function __construct($objParentObject, $strControlId = null) {
        parent::__construct($objParentObject, $strControlId);
    }
    public function AddChildControl(QControl $objControl) {
        array_push($this->childControls,$objControl);
    }

    public function RefreshChildren() {
        foreach ($this->childControls as $ctl) {
            $ctl->Refresh();
        }
    }
    public function updateUI() {
        // To be implemented by inheriting classes
    }
    public function updateControl($html) {
        parent::updateControl($html);
        $this->RefreshChildren();
    }
    protected function convertSpacesToUnderscores($str = '') {
        return HtmlEntities(preg_replace('/\s+/', '_', $str));
    }

}
?>
