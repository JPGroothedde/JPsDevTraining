<?php
class PageViewDataGrid extends sDataGrid{


    public function __construct($objParentObject,
                                $theDataGridEntityNode, $searchableAttributes, $searchBoxText, $headerItems, $headerSortNodes, $columnItems, $queryConditions = null,
                                $initialItemsPerPage = 5, $objWaitIcon = null, $ajaxHandle = 'default') {

        parent::__construct($objParentObject, $theDataGridEntityNode, $searchableAttributes, $searchBoxText,
            $headerItems, $headerSortNodes, $columnItems, $queryConditions, $initialItemsPerPage, $objWaitIcon, $ajaxHandle);

    }
    protected function getDataGrid() {
        $theEntity = $this->theDataGridEntity;
        $theList = $theEntity::QueryArray($this->queryConditions, QQ::Clause($this->currentOrderByClause,
            QQ::LimitInfo($this->currentItemsPerPage, $this->currentPageOffset)));

        $html = '<div id="'.$this->sh_HTML->getJqControlId().'_dataGrid" class="table-responsive">';
        $html .= '<table class="table table-hover table-striped table-bordered mrg-top10">
                <thead>';
        $html .= $this->getDataGridHeader();
        $html .= '</thead>';
        foreach ($theList as $anItem) {
            $html .= '<tr
                        onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_DataGridRowClickAction->getJqControlId().'\', \'QClickEvent\', \''.$anItem->Id.'\')">';
            for ($i=0;$i<sizeof($this->columnItems);$i++) {
                if ($this->columnItems[$i] == 'TimeStamped')
                    $html .= '<td>'.$anItem->__get($this->columnItems[$i])->format('Y/m/d h:i:s').'</td>';
                else
                $html .= '<td>'.$anItem->__get($this->columnItems[$i]).'</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table></div>';
        return $html;
    }
}
?>