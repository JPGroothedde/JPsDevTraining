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
class sUIElementsTabs extends sUIElementsBase {
    protected $tabs,$tabContents,$activeTabIndex = 0;
    protected $TabCount;
    public function __construct($objParentObject, $strControlId = null,$tabCount = 2) {
        parent::__construct($objParentObject, $strControlId);
        $this->tabs = array();
        $this->tabContents = array();
        $this->TabCount = $tabCount;
    }

    public function addTab($name = 'New Tab',$contents = 'New Tab Content',$isDefault = false) {
        array_push($this->tabs,$name);
        array_push($this->tabContents,$contents);
        if ($isDefault)
            $this->activeTabIndex = count($this->tabs)-1;
        $this->updateUI();
    }
    public function updateUI() {
        $tabCounter = 0;
        $html = '<ul class="nav nav-tabs" role="tablist">';
        foreach ($this->tabs as $tab) {
            $activeCss = '';
            $dropDownActiveCss = '';
            if ($this->activeTabIndex == $tabCounter)
                $activeCss = ' active';
            if (($tabCounter+1)==$this->TabCount) {
                if ($this->activeTabIndex > $this->TabCount)
                    $dropDownActiveCss = 'active';
                $html .= '<li role="presentation" class="dropdown '.$dropDownActiveCss.'">
                                <a href="#" id="'.$this->getJqControlId().'_dropdown" class="dropdown-toggle" data-toggle="dropdown" aria-controls="'.$this->getJqControlId().'_dropdown-contents" aria-expanded="false">More <span class="caret"></span></a>
                                <ul class="dropdown-menu" aria-labelledby="'.$this->getJqControlId().'_dropdown" id="'.$this->getJqControlId().'_dropdown-contents">';
            }

            $html .= '<li role="presentation" class="'.$activeCss.'"><a href="#'.$tabCounter.$this->convertSpacesToUnderscores($tab).'" aria-controls="'.$tabCounter.$this->convertSpacesToUnderscores($tab).'" role="tab" data-toggle="tab">'.$tab.'</a></li>';
            $tabCounter++;
        }
        if ($tabCounter >= $this->TabCount) {
            $html .= '</ul>
                    </li>';
        }
        $html .= '</ul>';

        $tabCounter = 0;
        $html .= '<div class="tab-content" style="padding-top: 10px;">';
        foreach ($this->tabContents as $tabContents) {
            $activeCss = '';
            if ($this->activeTabIndex == $tabCounter)
                $activeCss = ' in active';
            $html .= '<div role="tabpanel" class="tab-pane fade '.$activeCss.'" id="'.$tabCounter.$this->convertSpacesToUnderscores($this->tabs[$tabCounter]).'">
                        '.$tabContents.'
                        </div>';
            $tabCounter++;
        }
        $html .= '</div>';
        $this->updateControl($html);
    }
}
?>
