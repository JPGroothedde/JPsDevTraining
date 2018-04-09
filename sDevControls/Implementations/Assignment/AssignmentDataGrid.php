<?php
class AssignmentDataGrid extends sDataGrid{


    public function __construct($objParentObject,
                                $theDataGridEntityNode, $searchableAttributes, $searchBoxText, $headerItems, $headerSortNodes, $columnItems, $queryConditions = null,
                                $initialItemsPerPage = 5, $objWaitIcon = null, $ajaxHandle = 'default',$sessionIdentifier = 'datagridSessionId',
                                $rememberState = false,$exportHeaderItems = null,$exportColumnItems = null) {

        parent::__construct($objParentObject, $theDataGridEntityNode, $searchableAttributes, $searchBoxText,
            $headerItems, $headerSortNodes, $columnItems, $queryConditions, $initialItemsPerPage, $objWaitIcon, $ajaxHandle,
            $sessionIdentifier, $rememberState, $exportHeaderItems, $exportColumnItems);

    }

    protected function getColumnItemText($ArrayIndex = -1, $TheItem = null) {
        // This function can be overridden in the child class to display attributes in a custom way
        if (!$TheItem)
            return ' - ';
        if ($ArrayIndex < 0)
            return ' - ';
        if ($ArrayIndex > count($this->columnItems))
            return ' - ';
        if ($this->columnItems[$ArrayIndex] == 'Student') {
            if ($TheItem->SubscriptionObject) {
                if ($TheItem->SubscriptionObject->StudentObject) {
                    return $TheItem->SubscriptionObject->StudentObject->FirstName.' '.$TheItem->SubscriptionObject->StudentObject->LastName;
                }
            }
            return 'N/A';
        }
        if ($this->columnItems[$ArrayIndex] == 'Course') {
            if ($TheItem->SubscriptionObject) {
                if ($TheItem->SubscriptionObject->CourseObject) {
                    return $TheItem->SubscriptionObject->CourseObject->CourseName;
                }
            }
            return 'N/A';
        }
        // Default:
        return $TheItem->__get($this->columnItems[$ArrayIndex]);
    }
}
?>