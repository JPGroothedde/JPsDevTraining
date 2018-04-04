<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();

class EntityListForm extends QForm {
    protected $DataList;
    public function Form_Create() {
        parent::Form_Create();
        $this->DataList = new sDataList($this,QQN::PlaceHolder(),
            array(QQN::PlaceHolder()->DummyOne,QQN::PlaceHolder()->DummyTwo,QQN::PlaceHolder()->DummyThree,QQN::PlaceHolder()->DummyFour,QQN::PlaceHolder()->DummyFive),
            null,array('DummyOne','DummyTwo','DummyThree','DummyFour','DummyFive'),
            array(QQN::PlaceHolder()->DummyOne,QQN::PlaceHolder()->DummyTwo,QQN::PlaceHolder()->DummyThree,QQN::PlaceHolder()->DummyFour,QQN::PlaceHolder()->DummyFive),
            array('Dummy One','Dummy Two','Dummy Three','Dummy Four','Dummy Five'),'Dummy Three',true,null,null,2,2,null,true,true);
    }

    protected function PlaceHolder_ListItemClicked($strFormId, $strControlId, $strParameter) {
        if ($this->DataList->getActiveId() != $strParameter)
            $this->DataList->setActiveId($strParameter);
        else
            $this->DataList->setActiveId(null);
    }
    protected function PlaceHolder_ApplySearchClickedOrChanged($strFormId, $strControlId, $strParameter) {
        $this->DataList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolder_SortNodeChanged($strFormId, $strControlId, $strParameter) {
        $this->DataList->ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolder_ResetSearchClicked($strFormId, $strControlId, $strParameter) {
        $this->DataList->ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolder_LoadMoreClicked($strFormId, $strControlId, $strParameter) {
        $this->DataList->doLoadMore($strFormId, $strControlId, $strParameter);
    }
    protected function PlaceHolder_SortDirectionToggled($strFormId, $strControlId, $strParameter) {
        $this->DataList->toggleSortDirection($strFormId, $strControlId, $strParameter);
    }





}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
EntityListForm::Run('EntityListForm');
?>