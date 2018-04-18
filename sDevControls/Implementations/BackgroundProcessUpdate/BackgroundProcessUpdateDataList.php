<?php
class BackgroundProcessUpdateDataList extends sDataList{
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
		if ($this->ColumnItems[$ArrayIndex] == 'UpdateDateTime') {
			if ($TheItem->UpdateDateTime) {
				return $TheItem->UpdateDateTime->format(DATE_TIME_FORMAT_HTML.' H:i:s');
			} else
				return 'N/A';
		}
		// Default:
		return $TheItem->__get($this->ColumnItems[$ArrayIndex]);
	}
}
?>