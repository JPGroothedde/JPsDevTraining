<?php
class PostDataGrid extends sDataGrid{


    public function __construct($objParentObject,
                                $theDataGridEntityNode, $searchableAttributes, $searchBoxText, $headerItems, $headerSortNodes, $columnItems, $queryConditions = null,
                                $initialItemsPerPage = 5, $objWaitIcon = null, $ajaxHandle = 'default',$sessionIdentifier = 'datagridSessionId',
                                $rememberState = false,$exportHeaderItems = null,$exportColumnItems = null) {

        parent::__construct($objParentObject, $theDataGridEntityNode, $searchableAttributes, $searchBoxText,
            $headerItems, $headerSortNodes, $columnItems, $queryConditions, $initialItemsPerPage, $objWaitIcon, $ajaxHandle,
            $sessionIdentifier, $rememberState, $exportHeaderItems, $exportColumnItems);

    }
    public function getSortNode($currentSortIndex = 1) {
        return $this->headerSortNodes[$currentSortIndex];
    }
    protected function getColumnItemText($ArrayIndex = -1, $TheItem = null) {
        // This function can be overridden in the child class to display attributes in a custom way
        if (!$TheItem)
            return ' - ';
        if ($ArrayIndex < 0)
            return ' - ';
        if ($ArrayIndex > count($this->columnItems))
            return ' - ';
        if ($this->columnItems[$ArrayIndex] == "Account"){
            if($TheItem->AccountObject) {
                return $TheItem->AccountObject->FullName;

            } else {
                return 'N/A';
            }
        }
        if ($this->columnItems[$ArrayIndex] == "PostTimeStamp"){
            if($TheItem->PostTimeStamp) {
                return $TheItem->PostTimeStamp->format(DATE_TIME_FORMAT_HTML.' H:i:s');
            } else {
                return 'N/A';
            }
        }
        // Default:
        return $TheItem->__get($this->columnItems[$ArrayIndex]);
    }
}
?>