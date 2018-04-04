<?php
class BackgroundProcessDataList extends sDataList{
    public function __construct(QForm $objParentObject, $EntityNode, $SearchableAttributes = null, $SearchBoxText = null, $ColumnItems = null, $SortAttributes = null,
                                $SortAttributesShown = null, $DefaultSortAttribute = null, $DefaultSortDirectionDown = false, $ColumnWeights = null,
                                $QueryConditions = null, $InitialItemCount = 10, $ItemIncrement = 5, $ajaxHandle = null, $ShowSearch = true, $ShowSort = true,
                                $sessionIdentifier = 'DataListSessionId', $rememberState = false) {

        parent::__construct($objParentObject, $EntityNode, $SearchableAttributes, $SearchBoxText, $ColumnItems, $SortAttributes,
                                $SortAttributesShown, $DefaultSortAttribute, $DefaultSortDirectionDown, $ColumnWeights,
                                $QueryConditions, $InitialItemCount, $ItemIncrement, $ajaxHandle, $ShowSearch, $ShowSort,
                                $sessionIdentifier, $rememberState);

    }
}
?>