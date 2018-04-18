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
class sUIElementsPanelCollapse extends sUIElementsBase {
    protected $panels,$startCollapsed = false,$activePanelIndex = 0;
    public function __construct($objParentObject, $strControlId = null) {
        parent::__construct($objParentObject, $strControlId);
        $this->panels = array();
    }

    public function addPanel($name = 'New Panel',$contents = 'New Tab Content',$class = panelClass::_default,$isDefault = false) {
        array_push($this->panels,new panelDetail($name,$contents,$class));
        if ($isDefault)
            $this->activePanelIndex = count($this->panels)-1;
        $this->updateUI();
    }
    public function setStartCollapsed($startCollapsed = true) {
        $this->startCollapsed = $startCollapsed;
    }
    public function updateUI() {
        $panelCounter = 0;
        $html = '<div class="panel-group" id="'.$this->getJqControlId().'_PanelGroup" role="tablist" aria-multiselectable="true">';
        foreach ($this->panels as $panel) {
            $activeCss = '';

            if ($this->activePanelIndex == $panelCounter)
                $activeCss = ' in';

            if ($this->startCollapsed)
                $activeCss = '';

            $html .= '<div class="panel '.$panel->class.'">
                        <div class="panel-heading" role="tab" id="'.$panelCounter.$this->convertSpacesToUnderscores($panel->name).'">
                          <h4 class="panel-title">
                            <a class="collapsed accordion-toggle" role="button" data-toggle="collapse" data-parent="#'.$this->getJqControlId().'_PanelGroup" href="#collapse_'.$panelCounter.$this->convertSpacesToUnderscores($panel->name).'" aria-expanded="true" aria-controls="#collapse_'.$panelCounter.$this->convertSpacesToUnderscores($panel->name).'">
                              '.$panel->name.'
                            </a>
                          </h4>
                        </div>
                        <div id="collapse_'.$panelCounter.$this->convertSpacesToUnderscores($panel->name).'" class="panel-collapse collapse'.$activeCss.'" role="tabpanel" aria-labelledby="'.$panelCounter.$this->convertSpacesToUnderscores($panel->name).'">
                          <div class="panel-body">
                                '.$panel->content.'
                          </div>
                        </div>
                      </div>';
            $panelCounter++;
        }

        $html .= '</div>';
        $this->updateControl($html);
    }

}
class panelDetail {
    public $name,$content,$class;
    public function __construct($name,$content,$class) {
        $this->name = $name;
        $this->content = $content;
        $this->class = $class;
    }
}
abstract class panelClass {
    const _default = 'panel-default';
    const primary = 'panel-primary';
    const success = 'panel-success';
    const info = 'panel-info';
    const warning = 'panel-warning';
    const danger = 'panel-danger';
}
?>
