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
class sUIElementsSortableAccordion extends sUIElementsBase {
    protected $panels,$startCollapsed = false,$activePanelIndex = 0;
    protected $panelCount = 0;
    protected $Initialised = false;
    protected $CollapseAll = false,$ExpandAll = false;
    protected $updateAction = null;
    public function __construct($objParentObject, $strControlId = null,$updateActionId = null) {
        parent::__construct($objParentObject, $strControlId);
        $this->panels = array();
        if ($updateActionId) {
            $this->updateAction = AppSpecificFunctions::getPostBackJs($objParentObject->FormId,$updateActionId,'','QClickEvent',false);
        }
    }
    public function addPanel($id = null,$name = 'New Panel',$contents = 'New Tab Content',$class = AccordionEntryClass::_default) {
        $this->panelCount++;
        $theIdToUse = $this->panelCount;
        if ($id)
            $theIdToUse = $id;
        $theNewPanel = new AccordionEntryDetail($theIdToUse,$name,$contents,$class,$this->panelCount);
        array_push($this->panels,$theNewPanel);
        $this->updateUI();
        return $theNewPanel->id;
    }
    public function getPanelArray() {
        // First check if the order has not been updated on the client
        if (isset($_COOKIE['#draggablePanelList_'.$this->getJqControlId().'_Order'])) {
            $theCurrentOrder = json_decode($_COOKIE['#draggablePanelList_'.$this->getJqControlId().'_Order']);
            if (is_array($theCurrentOrder)) {
                $position = 1;
                foreach ($theCurrentOrder as $itemId) {
                    foreach ($this->panels as $panel) {
                        if ($panel->id == $itemId)
                            $panel->position = $position;
                    }
                    $position++;
                }
                usort($this->panels,array($this, "cmp"));
            }
        }
        return $this->panels;
    }
    public function updatePanel($id = null,$name = null,$contents = null,$class = null) {
        if (!$id)
            return;
        foreach ($this->panels as $panel) {
            if ($panel->id == $id) {
                if ($name)
                    $panel->name = $name;
                if ($contents)
                    $panel->content = $contents;
                if ($class)
                    $panel->class = $class;
            }
        }
        $this->updateUI();
    }
    public function removePanel($id = null) {
        if (!$id)
            return;
        $key = 0;
        foreach ($this->panels as $panel) {
            if ($panel->id == $id) {
                unset($this->panels[$key]);
                $this->panels = array_values($this->panels);
                break;
            }
            $key++;
        }
        $this->updateUI();
    }
    public function collapseAll() {
        $this->CollapseAll = true;
        $this->updateUI();
        $this->CollapseAll = false;
    }
    public function expandAll() {
        $this->ExpandAll = true;
        $this->updateUI();
        $this->ExpandAll = false;
    }
    protected function cmp($a, $b) {
        return $a->position - $b->position;
        //return strcmp($a->position, $b->position);
    }
    public function updateUI() {
        if (!$this->Initialised) {
            setcookie('#draggablePanelList_'.$this->getJqControlId().'_Order', '', time()-1000);
            setcookie('#draggablePanelList_'.$this->getJqControlId().'_Order', '', time()-1000, '/');
            $this->Initialised = true;
        } else {
            // First check if the order has not been updated on the client
            if (isset($_COOKIE['#draggablePanelList_'.$this->getJqControlId().'_Order'])) {
                $theCurrentOrder = json_decode($_COOKIE['#draggablePanelList_'.$this->getJqControlId().'_Order']);
                if (is_array($theCurrentOrder)) {
                    $position = 1;
                    foreach ($theCurrentOrder as $itemId) {
                        foreach ($this->panels as $panel) {
                            if ($panel->id == $itemId)
                                $panel->position = $position;
                        }
                        $position++;
                    }
                    usort($this->panels,array($this, "cmp"));
                }
            }
        }

        $html = '<div class="panel-group" id="'.$this->getJqControlId().'_PanelGroup" role="tablist" aria-multiselectable="true">
        <ul id="draggablePanelList_'.$this->getJqControlId().'" class="list-unstyled draggablePanelList">';
        $activeCss = '';
        if ($this->ExpandAll)
            $activeCss = 'in';
        if ($this->CollapseAll)
            $activeCss = '';
        foreach ($this->panels as $panel) {
            $html .= '<li class="panel '.$panel->class.'" id="listItem_'.$panel->id.'">
                        <div class="panel-heading" role="tab" id="listItem_Panel_'.$panel->id.'_'.$this->getJqControlId().'">
                          <h4 class="panel-title">
                            <a class="collapsed accordion-toggle" role="button" data-toggle="collapse" data-parent="#'.$this->getJqControlId().'_PanelGroup" href="#collapse_listItem_Panel_'.$panel->id.'_'.$this->getJqControlId().'" aria-expanded="true" aria-controls="#collapse_listItem_Panel_'.$panel->id.'_'.$this->getJqControlId().'">
                              '.$panel->name.'
                            </a>
                          </h4>
                        </div>
                        <div id="collapse_listItem_Panel_'.$panel->id.'_'.$this->getJqControlId().'" class="panel-collapse collapse '.$activeCss.'" role="tabpanel" aria-labelledby="listItem_Panel_'.$panel->id.'_'.$this->getJqControlId().'">
                          <div class="panel-body">
                                '.$panel->content.'
                          </div>
                        </div>
                      </li>';
        }

        $html .= '</ul></div>';
        $this->updateControl($html);
        $callBackJs = '';
        if ($this->updateAction) {
            $callBackJs = $this->updateAction;
        }
        $js = 'var panelList = $(\'#draggablePanelList_'.$this->getJqControlId().'\');
        
        panelList.sortable({
            // Only make the .panel-heading child elements support dragging.
            // Omit this to make then entire <li>...</li> draggable.
            handle: \'.panel-heading\', 
            update: function() {
                var listItems = [];
                var counter = 0;
                $(\'.panel\', panelList).each(function(index, elem) {
                     var $listItem = $(elem),
                         newIndex = $listItem.index();
                         listItems[counter] = $listItem.attr("id").substring(9);
                         counter++;
                     // Persist the new indices.
                });
                console.log(JSON.stringify(listItems));
                setCookie(\'#draggablePanelList_'.$this->getJqControlId().'_Order\',JSON.stringify(listItems),1);
                '.$callBackJs.'
            }
        });';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

}
class AccordionEntryDetail {
    public $id,$name,$content,$class,$position;
    public function __construct($id,$name,$content,$class,$position) {
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
        $this->class = $class;
        $this->position = $position;
    }
}
abstract class AccordionEntryClass {
    const _default = 'panel-default';
    const primary = 'panel-primary';
    const success = 'panel-success';
    const info = 'panel-info';
    const warning = 'panel-warning';
    const danger = 'panel-danger';
}
?>
