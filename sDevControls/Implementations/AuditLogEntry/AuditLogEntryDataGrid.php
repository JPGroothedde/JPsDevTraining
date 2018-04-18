<?php
class AuditLogEntryDataGrid extends sDataGrid{


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

        if (!$this->RenderForMobile) {
            $html = '<div id="'.$this->sh_HTML->getJqControlId().'_dataGrid" class="table-responsive">';
            $html .= '<table class="table table-hover table-striped table-bordered mrg-top10">
                <thead>';
            $html .= $this->getDataGridHeader();
            $html .= '</thead>';
            foreach ($theList as $anItem) {
                $html .= '<tr
                        onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_DataGridRowClickAction->getJqControlId().'\', \'QClickEvent\', \''.$anItem->Id.'\')">';
                for ($i=0;$i<sizeof($this->columnItems);$i++) {
                    if ($this->columnItems[$i] == 'EntryTimeStamp') {
                        if ($anItem->EntryTimeStamp) {
                            $html .= '<td>'.$anItem->EntryTimeStamp->format(DATE_TIME_FORMAT_HTML.' H:i:s').'</td>';
                        } else
                            $html .= '<td>N/A</td>';
                    } else
                        $html .= '<td>'.$anItem->__get($this->columnItems[$i]).'</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</table></div>';
        } else {
            $html = '<div id="'.$this->sh_HTML->getJqControlId().'_dataGrid" class="list-group">';
            foreach ($theList as $anItem) {
                $html .= '<span onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_DataGridRowClickAction->getJqControlId().'\', \'QClickEvent\', \''.$anItem->Id.'\')" class="list-group-item">';
                for ($i=0;$i<sizeof($this->columnItems);$i++) {
                    $columnText = $anItem->__get($this->columnItems[$i]);
                    if ($this->columnItems[$i] == 'EntryTimeStamp') {
                        if ($anItem->EntryTimeStamp) {
                            $columnText = $anItem->EntryTimeStamp->format(DATE_TIME_FORMAT_HTML.' H:i:s');
                        } else
                            $columnText = 'N/A';
                    }
                    if ($i == 0) {
                        $html .= '<h4 class="list-group-item-heading">'.$columnText.'</h4>';
                    } else {
                        $html .= '<p class="list-group-item-text"><strong>'.$this->headerItems[$i].':</strong> <span class="pull-right">'.$columnText.'</span></p>';
                    }
                }
                $html .= '</span>';
            }
            $html .= '</div>';
        }
        return $html;
    }
}
?>