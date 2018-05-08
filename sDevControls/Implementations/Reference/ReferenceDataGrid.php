<?php
class ReferenceDataGrid extends sDataGrid{
	protected $showSearch = false;
    public function __construct($objParentObject,
                                $theDataGridEntityNode, $searchableAttributes, $searchBoxText, $headerItems, $headerSortNodes, $columnItems, $queryConditions = null,
                                $initialItemsPerPage = 5, $objWaitIcon = null, $ajaxHandle = 'default',$sessionIdentifier = 'datagridSessionId',
                                $rememberState = false,$exportHeaderItems = null,$exportColumnItems = null) {

        parent::__construct($objParentObject, $theDataGridEntityNode, $searchableAttributes, $searchBoxText,
            $headerItems, $headerSortNodes, $columnItems, $queryConditions, $initialItemsPerPage, $objWaitIcon, $ajaxHandle,
            $sessionIdentifier, $rememberState, $exportHeaderItems, $exportColumnItems);

    }
	protected function getSearchBox() {
		return '';
    	//return '<input id="'.$this->sh_HTML->getJqControlId().'_searchBox" class="form-control" type="text" placeholder="'.$this->searchBoxText.'" value="'.$this->txtSearchInput.'">';
	}
	protected function getNavButtonsHTML() {
    	return '';
	}
	
	protected function getDataGridHeader() {
    	return '';
	}
	protected function getCurrentItemsPerPageHTML() {
    	return '';
	}
	protected function getApplySearchButton() {
    	return '';
	}
	protected function getResetFilterButton() {
    	return '';
	}
	protected function getResultCounter() {
    	return '';
	}
}
?>