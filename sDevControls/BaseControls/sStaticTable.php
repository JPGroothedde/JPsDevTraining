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

class sStaticTable {
    /**
     * @var simpleHTML
     */
    protected $sh_HTML;
    /**
     * @var
     */
    /**
     * @var
     */
    protected $theTableEntityNode,$theTableEntity;
    /**
     * @var
     */
    protected $SortNode;
    /**
     * @var
     */
    /**
     * @var bool
     */
    protected $currentOrderByClause,$currentSortDirectionDown = true;
    /**
     * @var array
     */
    /**
     * @var array
     */
    protected $headerItems = array(),$columnItems = array();
    /**
     * @var QQConditionAll
     */
    /**
     * @var QQConditionAll
     */
    protected $initialQueryConditions,$queryConditions;
    /**
     * @var
     */
    protected $parentFormId;
    /**
     * @var null
     */
    protected $objDefaultWaitIcon;

    /**
     * @param $objParentObject The QForm that will render the datagrid
     * @param $theTableEntityNode The QQN that will define the object type, e.g QQN::Object()
     * @param $headerItems The items to be displayed in the table header
     * @param $SortNode The item that is to be sorted on
     * @param $columnItems The object attributes that will make up the column data
     * @param bool $SortDirectionDown Defines sorting top to bottom and visa versa
     * @param null $queryConditions User defined query conditions (if not QQ:All())
     * @param null $objWaitIcon The waitIcon that is defined in the parent QForm
     * @param string $ajaxHandle Defines the prefix for the functions to be called from the parent QForm
     */
    public function __construct($objParentObject,
                                $theTableEntityNode, $headerItems, $SortNode, $columnItems, $SortDirectionDown = true,
                                $queryConditions = null, $objWaitIcon = null, $ajaxHandle = 'default') {

        $this->theTableEntityNode = $theTableEntityNode;
        $this->theTableEntity = $theTableEntityNode->_ClassName;

        if (count($headerItems) > 0)
            $this->headerItems = $headerItems;
        if (count($columnItems) > 0)
            $this->columnItems = $columnItems;
        $this->SortNode = $SortNode;

        if ($queryConditions) {
            $this->queryConditions = $queryConditions;
            $this->initialQueryConditions = $queryConditions;
        }
        else {
            $this->queryConditions = QQ::All();
            $this->initialQueryConditions = QQ::All();
        }

        $this->currentSortDirectionDown = $SortDirectionDown;
        $this->currentSortIndex = 0;
        $this->parentFormId = $objParentObject->FormId;
        $this->objDefaultWaitIcon = $objWaitIcon;
        $this->sh_HTML = new simpleHTML($objParentObject);
        $this->sh_HTML->SetRenderWithoutSpan(true);

    }

    /**
     * @return mixed
     */
    protected function getSortNode() {
        return $this->SortNode;
    }

    /**
     * @return string
     * @throws QCallerException
     */
    protected function getTable() {
        $theEntity = $this->theTableEntity;
        $this->currentOrderByClause = QQ::OrderBy($this->getSortNode(),$this->currentSortDirectionDown);
        $theList = $theEntity::QueryArray($this->queryConditions, QQ::Clause($this->currentOrderByClause));

        $html = '<div id="'.$this->sh_HTML->getJqControlId().'_staticTable" class="table-responsive">';
        $html .= '<table class="table table-hover table-striped table-bordered mrg-top10">
                <thead>';
        for ($i=0;$i<sizeof($this->headerItems);$i++) {
            $html .= '<th class="table-static">'.$this->headerItems[$i].'</th>';
        }
        $html .= '</thead>';
        foreach ($theList as $anItem) {
            $html .= '<tr class="table-static">';
            for ($i=0;$i<sizeof($this->columnItems);$i++) {
                $html .= '<td>'.$anItem->__get($this->columnItems[$i]).'</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table></div>';
        return $html;
    }

    /**
     * @param $newConditions
     */
    public function SetNewQueryConditions($newConditions) {
        $this->queryConditions = $newConditions;
        $this->updateTable();
    }

    /**
     *
     */
    public function updateTable() {
        $html = '<div id="'.$this->sh_HTML->getJqControlId().'">';
        $html .= '<div class="row mrg-top10">';
        $html .= '<div class="col-md-12 col-sm-12 col-xs-12">'.$this->getTable().'</div>';
        $html .= '</div></div>';
        $this->sh_HTML->SetControlHtml($html);
        $this->sh_HTML->Refresh();
    }

    /**
     * @throws Exception
     * @throws QCallerException
     */
    public function RenderTable($printOutput = true) {
        $this->updateTable();
        return $this->sh_HTML->Render($printOutput);
    }
}
?>
