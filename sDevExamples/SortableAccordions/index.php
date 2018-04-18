<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();

class SortableAccordionForm extends QForm {
    protected $SortableAccordion;
    protected $btnUpdatePanel,$btnAddPanel,$btnRemovePanel,$btnCollapseAll,$btnExpandAll;
    protected $idToUpdate;
    protected $updateAction;
    public function Form_Create() {
        parent::Form_Create();
        $this->updateAction = new sUIElementsBase($this);
        $this->updateAction->AddAction(new QClickEvent(), new QAjaxAction('ListUpdated'));
        $this->SortableAccordion = new sUIElementsSortableAccordion($this,null,$this->updateAction->getJqControlId());
        $this->SortableAccordion->addPanel(null,'Panel1','Content',AccordionEntryClass::primary);
        $this->SortableAccordion->addPanel(null,'Panel2','Content',AccordionEntryClass::info);
        $this->SortableAccordion->addPanel(null,'Panel3','Content',AccordionEntryClass::success);
        $this->SortableAccordion->addPanel(null,'Panel4','Content',AccordionEntryClass::_default);

        $this->SortableAccordion->updateUI();

        $this->btnUpdatePanel = AppSpecificFunctions::getNewActionButton($this,'Update A Panel','btn btn-default','UpdatePanel');
        $this->btnAddPanel = AppSpecificFunctions::getNewActionButton($this,'Add A Panel','btn btn-success','AddPanel');
        $this->btnRemovePanel = AppSpecificFunctions::getNewActionButton($this,'Remove A Panel','btn btn-danger','RemovePanel');
        $this->btnCollapseAll = AppSpecificFunctions::getNewActionButton($this,'Collapse All','btn btn-info','CollapseAll');
        $this->btnExpandAll = AppSpecificFunctions::getNewActionButton($this,'Expand All','btn btn-info','ExpandAll');
    }
    protected function ListUpdated() {
        AppSpecificFunctions::AddCustomLog('List updated! New order: '.json_encode($this->SortableAccordion->getPanelArray()));
    }
    protected function UpdatePanel() {
        $this->SortableAccordion->updatePanel($this->idToUpdate,AppSpecificFunctions::generateRandomString(5),AppSpecificFunctions::generateRandomString(500));
        AppSpecificFunctions::AddCustomLog(json_encode($this->SortableAccordion->getPanelArray()));
    }
    protected function RemovePanel() {
        foreach ($this->SortableAccordion->getPanelArray() as $item) {
            $this->SortableAccordion->removePanel($item->id);
            break;
        }
        AppSpecificFunctions::AddCustomLog(json_encode($this->SortableAccordion->getPanelArray()));
    }
    protected function AddPanel() {
        $this->idToUpdate = $this->SortableAccordion->addPanel(null,AppSpecificFunctions::generateRandomString(5),AppSpecificFunctions::generateRandomString(5000),AccordionEntryClass::danger);
    }
    protected function CollapseAll() {
        $this->SortableAccordion->collapseAll();
    }
    protected function ExpandAll() {
        $this->SortableAccordion->expandAll();
    }
}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
SortableAccordionForm::Run('SortableAccordionForm');
?>