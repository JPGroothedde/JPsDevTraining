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

class sDataGrid {
    /**
     * @var simpleHTML
     */
    protected $sh_HTML;
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    /**
     * @var int
     */
    protected $currentItemsPerPage,$currentPageIndex,$pageCount,$currentPageOffset,$totalResults,$currentSortIndex;
    /**
     * @var
     */
    /**
     * @var
     */
    protected $theDataGridEntityNode,$theDataGridEntity;
    /**
     * @var array
     */
    /**
     * @var array
     */
    protected $searchableAttributes = array(),$headerSortNodes = array();
    /**
     * @var
     */
    /**
     * @var bool
     */
    protected $currentOrderByClause,$currentSortDirectionDown = true;
    /**
     * @var
     */
    /**
     * @var
     */
    /**
     * @var bool
     */
    protected $searchBoxText,$txtSearchInput,$showSearch = true;
    /**
     * @var array
     */
    /**
     * @var array
     */
    /**
     * @var array
     */
    protected $headerItems = array(),$columnItems = array(),$exportHeaderItems = array(),$exportColumnItems = array();
    /**
     * @var QQConditionAll
     */
    /**
     * @var QQConditionAll
     */
    protected $initialQueryConditions,$queryConditions;
    /**
     * @var simpleHTML
     */
    /**
     * @var simpleHTML
     */
    /**
     * @var simpleHTML
     */
    /**
     * @var simpleHTML
     */
    protected $sh_ItemsPerPageClickAction,$sh_NavButtonsClickAction,$sh_ResetSearchClickAction,$sh_ApplySearchClickChangeAction;
    /**
     * @var simpleHTML
     */
    /**
     * @var simpleHTML
     */
    protected $sh_DataGridHeaderClickAction,$sh_DataGridRowClickAction;
    /**
     * @var
     */
    protected $parentFormId;
    /**
     * @var null
     */
    protected $objDefaultWaitIcon;
    /**
     * @var Mobile_Detect
     */
    /**
     * @var Mobile_Detect|string
     */
    protected $detect,$deviceType;
    /**
     * @var null
     */
    protected $activeId = null;
    /**
     * @var string
     */
    protected $sessionIdentifier;

    protected $RenderForMobile = false;
    protected $RenderForQuickView = false;

    /**
     * @param $objParentObject The QForm that will render the datagrid
     * @param $theDataGridEntityNode The QQN that will define the object type, e.g QQN::Object()
     * @param $searchableAttributes The array of attributes that can be searched on
     * @param $searchBoxText The placeholder text for the searchbox
     * @param $headerItems The items to be displayed in the table header
     * @param $headerSortNodes The items that can be sorted on
     * @param $columnItems The object attributes that will make up the column data
     * @param null $queryConditions User defined query conditions (if not QQ:All())
     * @param int $initialItemsPerPage How many items to display per page to start with
     * @param null $objWaitIcon The waitIcon that is defined in the parent QForm
     * @param string $ajaxHandle Defines the prefix for the functions to be called from the parent QForm
     * @param string $sessionIdentifier Used to restore the datagrid to its previous state
     * @param bool $rememberState If true, the datagrid will attempt to restore its previous state
     * @throws QCallerException
     */
    public function __construct($objParentObject,
                                $theDataGridEntityNode, $searchableAttributes, $searchBoxText, $headerItems, $headerSortNodes, $columnItems, $queryConditions = null,
                                    $initialItemsPerPage = 5, $objWaitIcon = null, $ajaxHandle = 'default',$sessionIdentifier = 'datagridSessionId',
                                $rememberState = false,$exportHeaderItems = null,$exportColumnItems = null) {

        $this->theDataGridEntityNode = $theDataGridEntityNode;
        $this->theDataGridEntity = $theDataGridEntityNode->_ClassName;
        $this->sessionIdentifier = $sessionIdentifier;
        
        $this->searchBoxText = $searchBoxText;

        if (count($searchableAttributes) > 0)
            $this->searchableAttributes = $searchableAttributes;
        if (count($headerItems) > 0)
            $this->headerItems = $headerItems;
        if (count($columnItems) > 0)
            $this->columnItems = $columnItems;
        if (count($exportHeaderItems) > 0)
            $this->exportHeaderItems = $exportHeaderItems;
        else
            $this->exportHeaderItems = $this->headerItems;
        if (count($exportColumnItems) > 0)
            $this->exportColumnItems = $exportColumnItems;
        else
            $this->exportColumnItems = $this->columnItems;
        if (count($headerSortNodes) > 0)
            $this->headerSortNodes = $headerSortNodes;

        $this->currentItemsPerPage = $initialItemsPerPage;
        
        if ($queryConditions) {
            $this->queryConditions = $queryConditions;
            $this->initialQueryConditions = $queryConditions;
        }
        else {
            $this->queryConditions = QQ::All();
            $this->initialQueryConditions = QQ::All();
        }

        $this->sh_ItemsPerPageClickAction = new simpleHTML($objParentObject);
        $this->sh_ItemsPerPageClickAction->AddAction(new QClickEvent(), new QAjaxAction($ajaxHandle.'_ItemsPerPageClickAction_Clicked'));
        $this->sh_NavButtonsClickAction = new simpleHTML($objParentObject);
        $this->sh_NavButtonsClickAction->AddAction(new QClickEvent(), new QAjaxAction($ajaxHandle.'_NavButtonsClickAction_Clicked'));
        $this->sh_ResetSearchClickAction = new simpleHTML($objParentObject);
        $this->sh_ResetSearchClickAction->AddAction(new QClickEvent(), new QAjaxAction($ajaxHandle.'_ResetSearchClickAction_Clicked'));
        $this->sh_ApplySearchClickChangeAction = new simpleHTML($objParentObject);
        $this->sh_ApplySearchClickChangeAction->AddAction(new QClickEvent(), new QAjaxAction($ajaxHandle.'_ApplySearchClickChangeAction_Triggered'));
        $this->sh_DataGridHeaderClickAction = new simpleHTML($objParentObject);
        $this->sh_DataGridHeaderClickAction->AddAction(new QClickEvent(), new QAjaxAction($ajaxHandle.'_DataGridHeaderClickAction_Clicked'));
        $this->sh_DataGridRowClickAction = new simpleHTML($objParentObject);
        $this->sh_DataGridRowClickAction->AddAction(new QClickEvent(), new QAjaxAction($ajaxHandle.'_DataGridRowClickAction_Clicked'));

        $this->pageCount = 1;
        $this->currentPageIndex = 1;
        $this->currentSortIndex = 0;
        $this->parentFormId = $objParentObject->FormId;
        $this->objDefaultWaitIcon = $objWaitIcon;
        $this->sh_HTML = new simpleHTML($objParentObject);
        $this->sh_HTML->SetRenderWithoutSpan(true);

        if ($rememberState)
            $this->getFiltersInSession();

        if (AppSpecificFunctions::GetDeviceType() == 'phone') {
            $this->setRenderModes(true);
        }
        $this->addJs();
        
    }
    public function setRenderModes($RenderForMobile = false,$RenderForQuickView = false) {
        $this->RenderForMobile = $RenderForMobile;
        $this->RenderForQuickView = $RenderForQuickView;
    }

    /**
     *
     */
    protected function getResultCount() {
        $this->queryConditions = $this->initialQueryConditions;
        $holdConditions = $this->queryConditions;
        if (strlen($this->txtSearchInput) > 1) {
            $likeText = '%'.$this->txtSearchInput.'%';
            $conditionArray = array();
            for ($i=0;$i<count($this->searchableAttributes);$i++) {               
                array_push($conditionArray, QQ::Like($this->searchableAttributes[$i], $likeText));
            }
            $this->queryConditions = QQ::AndCondition($holdConditions,QQ::OrCondition($conditionArray));
        }        
        $theEntity = $this->theDataGridEntity;
        $totalItemCount = $theEntity::QueryCount($this->queryConditions);
        $this->totalResults = $totalItemCount;
        $this->pageCount = ceil($this->totalResults/$this->currentItemsPerPage);
        if ($this->currentPageIndex > $this->pageCount)
                $this->currentPageIndex = $this->pageCount;
        if ($this->currentPageIndex < 1)
                $this->currentPageIndex = 1;
        $this->currentPageOffset = $this->currentItemsPerPage*($this->currentPageIndex-1);
        $this->currentOrderByClause = QQ::OrderBy($this->getSortNode(),$this->currentSortDirectionDown);
    }

    /**
     * @return mixed
     */
    protected function getSortNode() {
        return $this->headerSortNodes[$this->currentSortIndex];
    }

    /**
     * @return string
     */
    protected function getCurrentItemsPerPageHTML() {
        return '<div id="'.$this->sh_HTML->getJqControlId().'_itemsPerPage">
                        <a role="button" data-toggle="dropdown" href="#">'.$this->currentItemsPerPage.' Items per page <b class="caret"></b></a>
                            <ul id="menu1" class="dropdown-menu" role="menu">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"
                                onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_ItemsPerPageClickAction->getJqControlId().'\', \'QClickEvent\', \'5\', \''.$this->objDefaultWaitIcon->ControlId.'\')">5 Items per page</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"
                                onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_ItemsPerPageClickAction->getJqControlId().'\', \'QClickEvent\', \'10\', \''.$this->objDefaultWaitIcon->ControlId.'\')">10 Items per page</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"
                                onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_ItemsPerPageClickAction->getJqControlId().'\', \'QClickEvent\', \'20\', \''.$this->objDefaultWaitIcon->ControlId.'\')">20 Items per page</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"
                                onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_ItemsPerPageClickAction->getJqControlId().'\', \'QClickEvent\', \'50\', \''.$this->objDefaultWaitIcon->ControlId.'\')">50 Items per page</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"
                                onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_ItemsPerPageClickAction->getJqControlId().'\', \'QClickEvent\', \'100\', \''.$this->objDefaultWaitIcon->ControlId.'\')">100 Items per page</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"
                                onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_ItemsPerPageClickAction->getJqControlId().'\', \'QClickEvent\', \'500\', \''.$this->objDefaultWaitIcon->ControlId.'\')">500 Items per page</a></li>
                            </ul>
                    </div>';
    }

    /**
     * @return string
     */
    protected function getNavButtonsHTML() {
        $html = '<div id="'.$this->sh_HTML->getJqControlId().'_navButtons" style="text-align:center;">';
        if ($this->totalResults > 0) {
            $html .= '<ul class="pager" style="margin-bottom:5px;margin-top:-10px;">
                        <li><a href="#" onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_NavButtonsClickAction->getJqControlId().'\', \'QClickEvent\', \'-1\', \''.$this->objDefaultWaitIcon->ControlId.'\')">Previous</a></li>
                        <li><a href="#" onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_NavButtonsClickAction->getJqControlId().'\', \'QClickEvent\', \'0\', \''.$this->objDefaultWaitIcon->ControlId.'\')">Next</a></li>
                      </ul>';
        }
        $html .= '<span class="label label-default">'.$this->currentPageIndex.' of '.$this->pageCount.' Pages</span></div>';
        return $html;
    }

    /**
     * @return string
     */
    protected function getSearchBox() {
        return '<input id="'.$this->sh_HTML->getJqControlId().'_searchBox" class="form-control" type="text" placeholder="'.$this->searchBoxText.'" value="'.$this->txtSearchInput.'">';
    }

    /**
     * @return string
     */
    protected function getApplySearchButton() {
        return '<button id="'.$this->sh_HTML->getJqControlId().'_searchButton"
                        onclick="$(this).html(\'Searching...\');qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_ApplySearchClickChangeAction->getJqControlId().'\', \'QClickEvent\', $(\'#'.$this->sh_HTML->getJqControlId().'_searchBox\').val(), \''.$this->objDefaultWaitIcon->ControlId.'\')"
                        class="btn btn-link" type="button">Search</button>';
    }

    /**
     * @return string
     */
    protected function getResetFilterButton() {
        return '<button onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_ResetSearchClickAction->getJqControlId().'\', \'QClickEvent\', \'\', \''.$this->objDefaultWaitIcon->ControlId.'\')"
            class="btn btn-link" type="button">Reset Filter</button>';
    }

    /**
     * @return string
     */
    protected function getResultCounter() {
        return '<p><span class="badge">'.$this->totalResults.'</span> Results</p>';
    }

    /**
     * @return string
     * @throws QCallerException
     */
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
                    $html .= '<td>'.$this->getColumnItemText($i,$anItem).'</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</table></div>';
        } else {
            $html = '<div id="'.$this->sh_HTML->getJqControlId().'_dataGrid" class="list-group">';
            foreach ($theList as $anItem) {
                $html .= '<span onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_DataGridRowClickAction->getJqControlId().'\', \'QClickEvent\', \''.$anItem->Id.'\')" class="list-group-item">';
                for ($i=0;$i<sizeof($this->columnItems);$i++) {
                    $columnText = $this->getColumnItemText($i,$anItem);
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

    /**
     * @param int $ArrayIndex
     * @param null $TheItem
     * @return string
     */
    protected function getColumnItemText($ArrayIndex = -1, $TheItem = null) {
        // This function can be overridden in the child class to display attributes in a custom way
        if (!$TheItem)
            return ' - ';
        if ($ArrayIndex < 0)
            return ' - ';
        if ($ArrayIndex > count($this->columnItems))
            return ' - ';
        // Default:
        return $TheItem->__get($this->columnItems[$ArrayIndex]);
    }

    protected function getDataGridHeader() {
        $sortArrow = ' <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>';
        if ($this->currentSortDirectionDown)
            $sortArrow = ' <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>';
        $noSortArrow = '';
        $html = '';
        for ($i=0;$i<sizeof($this->headerItems);$i++) {
            if ($this->currentSortIndex==$i)
                $html .= '<th 
                    onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_DataGridHeaderClickAction->getJqControlId().'\', \'QClickEvent\', \''.$i.'\')">'.$sortArrow.' '.$this->headerItems[$i].'</th>';
            else  $html .= '<th
                    onclick="qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_DataGridHeaderClickAction->getJqControlId().'\', \'QClickEvent\', \''.$i.'\')">'.$this->headerItems[$i].'</th>';
        }
        return $html;
    }
    /**
     * @return string
     * @throws QCallerException
     */
    protected function getDataGridForExport() {
        $theEntity = $this->theDataGridEntity;
        $theList = $theEntity::QueryArray($this->queryConditions, QQ::Clause($this->currentOrderByClause,
            QQ::LimitInfo($this->currentItemsPerPage, $this->currentPageOffset)));
	
	    $html = '<table>
                <thead><tr>';
	    for ($i=0;$i<sizeof($this->exportHeaderItems);$i++) {
		    $html .= '<th>'.$this->exportHeaderItems[$i].'</th>';
	    }
	    $html .= '</tr></thead>';
        foreach ($theList as $anItem) {
            $html .= '<tr>';
            for ($i=0;$i<sizeof($this->exportColumnItems);$i++) {
                $html .= '<td>'.$anItem->__get($this->exportColumnItems[$i]).'</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';
        return $html;
    }

    /**
     *
     */
    public function updateGrid() {
        $this->getResultCount();
        if ($this->RenderForQuickView) {
            $html = '<div id="'.$this->sh_HTML->getJqControlId().'">';
            $html .= '<div class="row mrg-top10">';
            $html .= '<div class="col-md-12 col-sm-12 col-xs-12">'.$this->getDataGrid().'</div>';
            $html .= '</div></div>';
        } else {
            if (AppSpecificFunctions::GetDeviceType() != 'phone'){
                $html = '<div id="'.$this->sh_HTML->getJqControlId().'">';
                $html .= '<div class="row">';
                $html .= '<div class="col-md-6">'.$this->getCurrentItemsPerPageHTML().'</div>';
                $html .= '<div class="col-md-6">'.$this->getNavButtonsHTML().'</div>';
                $html .= '</div><div class="row">';
                $html .= '<div class="col-md-4 col-sm-4 col-xs-4">'.$this->getSearchBox().'</div>';
                $html .= '<div class="col-md-4 col-sm-4 col-xs-4">'.$this->getApplySearchButton().'</div>';
                $html .= '<div class="col-md-2 col-sm-2 col-xs-2">'.$this->getResetFilterButton().'</div>';
                $html .= '<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:right; padding-top: 7px;">'.$this->getResultCounter().'</div>';
                $html .= '</div><div class="row mrg-top10">';
                $html .= '<div class="col-md-12 col-sm-12 col-xs-12">'.$this->getDataGrid().'</div>';
                $html .= '</div></div>';
            } else {
                $html = '<div id="'.$this->sh_HTML->getJqControlId().'">';
                $html .= '<div class="row">';
                $html .= '<div class="col-md-12 col-sm-12 col-xs-12">'.$this->getCurrentItemsPerPageHTML().'</div>';
                $html .= '<div class="col-md-12 col-sm-12 col-xs-12 mrg-top10">'.$this->getNavButtonsHTML().'</div>';
                $html .= '</div><div class="row mrg-top25">';
                $html .= '<div class="col-md-4">'.$this->getSearchBox().'</div>';
                $html .= '<div class="col-md-4 col-sm-4 col-xs-4">'.$this->getApplySearchButton().'</div>';
                $html .= '<div class="col-md-2 col-sm-2 col-xs-2">'.$this->getResetFilterButton().'</div>';
                $html .= '<div class="col-md-2" style="text-align:right; padding-top: 7px;">'.$this->getResultCounter().'</div>';
                $html .= '</div><div class="row mrg-top10">';
                $html .= '<div class="col-md-12 col-sm-12 col-xs-12">'.$this->getDataGrid().'</div>';
                $html .= '</div></div>';
            }
        }

        $this->sh_HTML->SetControlHtml($html);
        $this->sh_HTML->Refresh();
    }

    /**
     * @param bool $down
     */
    public function SetSortDirectionDown($down = true) {
        $this->currentSortDirectionDown = $down;
        $this->setFiltersInSession();
    }

    /**
     * @param null $queryConditions
     */
    public function setQueryConditions($queryConditions = null) {
        if ($queryConditions) {
            $this->queryConditions = $queryConditions;
            $this->initialQueryConditions = $queryConditions;
        }
        else {
            $this->queryConditions = QQ::All();
            $this->initialQueryConditions = QQ::All();
        }
        $this->setFiltersInSession();
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     */
    public function ItemsPerPageClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->currentItemsPerPage = $strParameter;
        $this->setFiltersInSession();
        $this->updateGrid();
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     */
    public function NavButtonsClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        if ($strParameter < 1) {
            if ($strParameter < 0) {
                if ($this->currentPageIndex > 2)
                     $this->currentPageIndex--;
                else
                    $this->currentPageIndex = 1;
            } else {
                if ($this->currentPageIndex < $this->pageCount)
                     $this->currentPageIndex++;
                else
                    $this->currentPageIndex = $this->pageCount;
            }
        } else {
            $this->currentPageIndex = $strParameter;
        }
        $this->setFiltersInSession();
        $this->updateGrid();
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     */
    public function DataGridHeaderClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        if ($this->currentSortIndex == $strParameter) {
            $this->currentSortDirectionDown = !$this->currentSortDirectionDown;
        } else {
            $this->currentSortIndex = $strParameter;
            $this->currentSortDirectionDown = true;
        }
        $this->setFiltersInSession();
        $this->updateGrid();
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     */
    public function DataGridRowClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        // Handle this in the main page or with a specialized DataGrid Class
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     */
    public function ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        QApplication::ExecuteJavaScript('$("#'.$this->sh_HTML->getJqControlId().'_searchBox").focus();');
        $strText = mb_strtolower($strParameter, QApplication::$EncodingType);
        if ((mb_strpos($strText, '<script', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, '<applet', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, '<embed', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, '<style', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, '<link', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, '<body', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, '<iframe', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, 'javascript:', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onfocus=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onblur=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onkeydown=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onkeyup=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onkeypress=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onmousedown=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onmouseup=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onmouseover=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onmouseout=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onmousemove=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, ' onclick=', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, '<object', 0, QApplication::$EncodingType) !== false) ||
                (mb_strpos($strText, 'background:url', 0, QApplication::$EncodingType) !== false))
                $this->txtSearchInput = 'Invalid Input';
        else
            $this->txtSearchInput = $strParameter;
        $this->setFiltersInSession();
        $this->updateGrid();
        $js = 'el = document.getElementById("'.$this->sh_HTML->getJqControlId().'_searchBox");
                el.selectionStart = el.selectionEnd = el.value.length;';
        QApplication::ExecuteJavaScript($js);
        $this->addJs();
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     */
    public function ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        unset($this->txtSearchInput);
        $this->txtSearchInput = '';
        $this->setFiltersInSession();
        $this->updateGrid();
    }

    /**
     * @throws Exception
     * @throws QCallerException
     */
    public function RenderGrid($printOutput = true) {
        $this->updateGrid();
        return $this->sh_HTML->Render($printOutput);
    }

    /**
     * Helper function to allow you to remember the last clicked item. Useful for highlighting rows, etc
     * @param null $id
     */
    public function setActiveId($id = null) {
        $this->activeId = $id;
        $this->updateGrid();
    }

    /**
     * @return null
     */
    public function getActiveId() {
        return $this->activeId;
    }

    /**
     * @return string
     */
    public function getMainElementId() {
        return $this->sh_HTML->getJqControlId();
    }

    /**
     *
     */
    protected function setFiltersInSession() {
        $_SESSION['currentpageindex'.$this->sessionIdentifier] = $this->currentPageIndex;
        $_SESSION['lastsearched'.$this->sessionIdentifier] = $this->txtSearchInput;
        $_SESSION['currentitemsperpage'.$this->sessionIdentifier] = $this->currentItemsPerPage;
        $_SESSION['currentsortindex'.$this->sessionIdentifier] = $this->currentSortIndex;
        $_SESSION['currentsortdirectiondown'.$this->sessionIdentifier] = $this->currentSortDirectionDown;
    }

    /**
     *
     */
    protected function getFiltersInSession() {
        if (isset($_SESSION['currentpageindex_'.$this->sessionIdentifier])) {
            $this->currentPageIndex = $_SESSION['currentpageindex'.$this->sessionIdentifier];
            unset($_SESSION['currentpageindex'.$this->sessionIdentifier]);
        }
        if (isset($_SESSION['lastsearched'.$this->sessionIdentifier])) {
            $this->txtSearchInput = $_SESSION['lastsearched'.$this->sessionIdentifier];
            unset($_SESSION['lastsearched'.$this->sessionIdentifier]);
        }
        if (isset($_SESSION['currentitemsperpage'.$this->sessionIdentifier])) {
            $this->currentItemsPerPage = $_SESSION['currentitemsperpage'.$this->sessionIdentifier];
            unset($_SESSION['currentitemsperpage'.$this->sessionIdentifier]);
        }
        if (isset($_SESSION['currentsortindex'.$this->sessionIdentifier])) {
            $this->currentSortIndex = $_SESSION['currentsortindex'.$this->sessionIdentifier];
            unset($_SESSION['currentsortindex'.$this->sessionIdentifier]);
        }
        if (isset($_SESSION['currentsortdirectiondown'.$this->sessionIdentifier])) {
            $this->currentSortDirectionDown = $_SESSION['currentsortdirectiondown'.$this->sessionIdentifier];
            unset($_SESSION['currentsortdirectiondown'.$this->sessionIdentifier]);
        }
        //$this->updateGrid();
    }

    /**
     *
     */
    protected function addJs() {
         QApplication::ExecuteJavaScript('$("#'.$this->sh_HTML->getJqControlId().'_searchBox").typing({
            start: function (event, $elem) {

            },
            stop: function (event, $elem) {
                $("#'.$this->sh_HTML->getJqControlId().'_searchButton").html(\'Searching...\')
                qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_ApplySearchClickChangeAction->getJqControlId().'\', \'QClickEvent\', $(\'#'.$this->sh_HTML->getJqControlId().'_searchBox\').val(), \''.$this->objDefaultWaitIcon->ControlId.'\');
            },
            delay: 1200
        });');
    }

    public function ExportToCSV($filename = '') {
        $holdItemsPerPage = $this->currentItemsPerPage;
        $this->getResultCount();
        $this->currentItemsPerPage = $this->totalResults;
        $this->getResultCount();
        if (strlen($filename) < 1)
            $filename = 'DataGrid_Export_'.QDateTime::Now(true)->format(DATE_TIME_FORMAT_HTML.'_h-i-s');
        AppSpecificFunctions::ExportToCSV($this->getDataGridForExport(),$filename);
        $this->currentItemsPerPage = $holdItemsPerPage;
    }

}
?>
