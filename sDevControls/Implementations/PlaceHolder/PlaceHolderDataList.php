<?php
class PlaceHolderDataList extends sDataList{
    public function __construct(QForm $objParentObject, $EntityNode, $SearchableAttributes = null, $SearchBoxText = null, $ColumnItems = null, $SortAttributes = null,
                                $SortAttributesShown = null, $DefaultSortAttribute = null, $DefaultSortDirectionDown = false, $ColumnWeights = null,
                                $QueryConditions = null, $InitialItemCount = 10, $ItemIncrement = 5, $ajaxHandle = null, $ShowSearch = true, $ShowSort = true,
                                $sessionIdentifier = 'DataListSessionId', $rememberState = false) {

        parent::__construct($objParentObject, $EntityNode, $SearchableAttributes, $SearchBoxText, $ColumnItems, $SortAttributes,
                                $SortAttributesShown, $DefaultSortAttribute, $DefaultSortDirectionDown, $ColumnWeights,
                                $QueryConditions, $InitialItemCount, $ItemIncrement, $ajaxHandle, $ShowSearch, $ShowSort,
                                $sessionIdentifier, $rememberState);

    }
    protected function getColumnItemText($ArrayIndex = -1, $TheItem = null) {
        // This function can be overridden in the child class to display attributes in a custom way
        if (!$TheItem)
            return ' - ';
        if ($ArrayIndex < 0)
            return ' - ';
        if ($ArrayIndex > count($this->ColumnItems))
            return ' - ';
        // For Accounts:
        if ($this->ColumnItems[$ArrayIndex] == 'Account') {
            if ($TheItem->AccountObject)
                return $TheItem->AccountObject->FullName;
            else
                return ' - ';
        }
        // Default:
        return $TheItem->__get($this->ColumnItems[$ArrayIndex]);
    }
}
?>