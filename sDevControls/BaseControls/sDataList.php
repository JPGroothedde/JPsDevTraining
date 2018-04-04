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

class sDataList {
    /**
     * @var sUIElementsBase
     */
    protected $html;
    /**
     * @var string
     */
    protected $ParentFormId;
    /**
     * @var int
     */
    /**
     * @var int
     */
    protected $CurrentItemCount,$CurrentItemIncrement;
    /**
     * @var
     */
    /**
     * @var
     */
    protected $TheEntityNode,$TheEntity;
    /**
     * @var array|null
     */
    protected $SearchableAttributes = array();
    /**
     * @var array|null
     */
    /**
     * @var array|null
     */
    /**
     * @var array|null
     */
    /**
     * @var array|bool|null
     */
    /**
     * @var array|bool|null|QListBox
     */
    /**
     * @var array|bool|null|QListBox
     */
    /**
     * @var array|bool|null|QListBox
     */
    protected $SortAttributes = array(),$SortAttributesShown = array(),$CurrentOrderByClause,$CurrentSortDirectionDown = true,$lstSortOptions,$btnSortDirection,$ShowSort = true;
    /**
     * @var QTextBox
     */
    /**
     * @var null|QTextBox
     */
    /**
     * @var null|QTextBox
     */
    protected $txtSearchBox,$SearchBoxText,$ShowSearch = true;
    /**
     * @var array|null
     */
    /**
     * @var array|null
     */
    protected $ColumnItems = array(),$ColumnWeights = array();
    /**
     * @var QQConditionAll
     */
    /**
     * @var QQConditionAll
     */
    protected $InitialQueryConditions,$CurrentQueryConditions;
    /**
     * @var sUIElementsBase
     */
    /**
     * @var sUIElementsBase
     */
    protected $action_ResetSearchClicked,$action_ApplySearchClickedOrChanged;
    /**
     * @var sUIElementsBase
     */
    protected $action_ListItemClicked;
    /**
     * @var null
     */
    protected $ActiveId = null;
    /**
     * @var string
     */
    protected $SessionIdentifier;
    /**
     * @var QButton
     */
    /**
     * @var QButton
     */
    protected $btnLoadMore,$btnToggleSortDirection;

    protected $html_ResultCount;


    /**
     * sDataList constructor.
     * @param QForm $objParentObject
     * @param $EntityNode
     * @param null $SearchableAttributes
     * @param null $SearchBoxText
     * @param null $ColumnItems
     * @param null $SortAttributes
     * @param null $SortAttributesShown
     * @param null $DefaultSortAttribute
     * @param bool $DefaultSortDirectionDown
     * @param null $ColumnWeights
     * @param null $QueryConditions
     * @param int $InitialItemCount
     * @param int $ItemIncrement
     * @param null $ajaxHandle
     * @param bool $ShowSearch
     * @param bool $ShowSort
     * @param string $sessionIdentifier
     * @param bool $rememberState
     */
    public function __construct(QForm $objParentObject, $EntityNode, $SearchableAttributes = null, $SearchBoxText = null, $ColumnItems = null, $SortAttributes = null,
                                $SortAttributesShown = null, $DefaultSortAttribute = null, $DefaultSortDirectionDown = false, $ColumnWeights = null,
                                $QueryConditions = null, $InitialItemCount = 10, $ItemIncrement = 5, $ajaxHandle = null, $ShowSearch = true, $ShowSort = true,
                                $sessionIdentifier = 'DataListSessionId', $rememberState = false) {

        $this->ParentFormId = $objParentObject->FormId;

        $this->TheEntityNode = $EntityNode;
        $this->TheEntity = $this->TheEntityNode->_ClassName;
        $this->SessionIdentifier = $sessionIdentifier;

        if (!$ajaxHandle) {
            $ajaxHandle = $this->TheEntity;
        }

        $this->CurrentSortDirectionDown = $DefaultSortDirectionDown;

        if ($SearchableAttributes)
            $this->SearchableAttributes = $SearchableAttributes;
        if ($ColumnItems)
            $this->ColumnItems = $ColumnItems;
        if ($ColumnWeights)
            $this->ColumnWeights = $ColumnWeights;

        $this->lstSortOptions = new QListBox($objParentObject);
        $this->lstSortOptions->AddAction(new QChangeEvent(), new QAjaxAction($ajaxHandle.'_SortNodeChanged'));
        $this->lstSortOptions->AddCssClass('fullWidth');
        $theIndex = -1;
        $this->lstSortOptions->AddItem(new QListItem('Order By...',$theIndex));
        if ($SortAttributes && $SortAttributesShown) {
            $this->SortAttributes = $SortAttributes;
            $this->SortAttributesShown = $SortAttributesShown;
            foreach ($this->SortAttributesShown as $attr) {
                $theIndex++;
                if (!$DefaultSortAttribute)
                    $default = false;
                else
                    $default = $attr == $DefaultSortAttribute ? true:false;
                $this->lstSortOptions->AddItem(new QListItem($attr,$theIndex,$default));
            }
        }
        $this->ShowSort = $ShowSort;

        $this->CurrentItemCount = $InitialItemCount;
        $this->CurrentItemIncrement = $ItemIncrement;
        
        if ($QueryConditions) {
            $this->CurrentQueryConditions = $QueryConditions;
            $this->InitialQueryConditions = $QueryConditions;
        }
        else {
            $this->CurrentQueryConditions = QQ::All();
            $this->InitialQueryConditions = QQ::All();
        }

        $this->action_ResetSearchClicked = new sUIElementsBase($objParentObject);
        $this->action_ResetSearchClicked->AddAction(new QClickEvent(), new QAjaxAction($ajaxHandle.'_ResetSearchClicked'));
        $this->action_ApplySearchClickedOrChanged = new sUIElementsBase($objParentObject);
        $this->action_ApplySearchClickedOrChanged->AddAction(new QClickEvent(), new QAjaxAction($ajaxHandle.'_ApplySearchClickedOrChanged'));
        $this->action_ListItemClicked = new sUIElementsBase($objParentObject);
        $this->action_ListItemClicked->AddAction(new QClickEvent(), new QAjaxAction($ajaxHandle.'_ListItemClicked'));
        $this->html_ResultCount = new sUIElementsBase($objParentObject);
        $this->SearchBoxText = 'Start typing...';
        if ($SearchBoxText)
            $this->SearchBoxText = $SearchBoxText;
        $this->txtSearchBox = new QTextBox($objParentObject);

        $this->ShowSearch = $ShowSearch;

        $resetBtn = '<button onclick="qc.pA(\''.$this->ParentFormId.'\',\''.$this->action_ResetSearchClicked->getJqControlId().'\', \'QClickEvent\', \'\')" 
            class="btn btn-default" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>';
        $applySearchBtn = '<button onclick="qc.pA(\''.$this->ParentFormId.'\',\''.$this->action_ApplySearchClickedOrChanged->getJqControlId().'\', \'QClickEvent\')" 
        class="btn btn-default" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>';
        $this->txtSearchBox->RenderAsInputGroup(true,$resetBtn,$applySearchBtn,true);
        $this->txtSearchBox->Placeholder = $this->SearchBoxText;

        $this->btnLoadMore = AppSpecificFunctions::getNewActionButton($objParentObject,'Load More','btn btn-primary fullWidth',$ajaxHandle.'_LoadMoreClicked');
        $this->btnToggleSortDirection = AppSpecificFunctions::getNewActionButton($objParentObject, '','btn btn-default fullWidth',$ajaxHandle.'_SortDirectionToggled');
        $this->btnToggleSortDirection->HtmlEntities = false;
        if ($this->CurrentSortDirectionDown) {
            $this->btnToggleSortDirection->Text = '<i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>';
        } else
            $this->btnToggleSortDirection->Text = '<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>';

        $this->html = new sUIElementsBase($objParentObject);

        if ($rememberState)
            $this->getFiltersInSession();

        $this->addJs();
        
    }
    /**
     *
     */
    protected function getResultCount() {
        $this->CurrentQueryConditions = $this->InitialQueryConditions;
        $holdConditions = $this->CurrentQueryConditions;
        if (strlen($this->txtSearchBox->Text) > 1) {
            $likeText = '%'.$this->txtSearchBox->Text.'%';
            $conditionArray = array();
            for ($i=0;$i<count($this->SearchableAttributes);$i++) {
                array_push($conditionArray, QQ::Like($this->SearchableAttributes[$i], $likeText));
            }
            $this->CurrentQueryConditions = QQ::AndCondition($holdConditions,QQ::OrCondition($conditionArray));
        }

        $this->CurrentOrderByClause = QQ::OrderBy($this->getSortNode(),!$this->CurrentSortDirectionDown);
    }

    /**
     * @return mixed
     */
    protected function getSortNode() {
        if ($this->lstSortOptions->SelectedValue > -1)
            return $this->SortAttributes[$this->lstSortOptions->SelectedValue];
        else
            return $this->TheEntityNode->Id;
    }

    /**
     * @return string
     */
    protected function getSearchBox($printOutput = true) {
        return $this->txtSearchBox->Render($printOutput);
    }

    /**
     * @return string
     * @throws QCallerException
     */
    protected function getDataList() {
        $theEntity = $this->TheEntity;
        $theList = $theEntity::QueryArray($this->CurrentQueryConditions, QQ::Clause($this->CurrentOrderByClause,
                                 QQ::LimitInfo($this->CurrentItemCount)));
        $MaxListSize = $theEntity::QueryCount($this->CurrentQueryConditions);
        $this->html_ResultCount->updateControl('<span class="badge">'.$MaxListSize.'</span> Results');
        if (count($theList) >= $MaxListSize) {
            $this->btnLoadMore->Visible = false;
        } else {
            $this->btnLoadMore->Visible = true;
        }
        $this->btnLoadMore->Refresh();

        if (count($this->ColumnWeights) < 1) {
            $totalCount = count($this->ColumnItems);
            $equalSize = 12;
            if ($totalCount > 0) {
                if ($totalCount < 5){
                    $equalSize = round(12/$totalCount);
                } elseif ($totalCount <= 6) {
                    $equalSize = 2;
                } elseif ($totalCount > 6) {
                    $equalSize = 1;
                }
            }

            for ($i=0;$i<sizeof($this->ColumnItems);$i++) {
                if ($i == 0) {
                    if ($totalCount == 5) {
                        $this->ColumnWeights[$i] = 4;
                    } elseif($totalCount > 6) {
                        $weight = 12- $totalCount + 1;
                        $this->ColumnWeights[$i] = $weight;
                    } else {
                        $this->ColumnWeights[$i] = $equalSize;
                    }
                } else {
                    $this->ColumnWeights[$i] = $equalSize;
                }
            }
        }
        $html = '<ul id="'.$this->html->getJqControlId().'_DataList" class="list-group">';
        foreach ($theList as $anItem) {
            $activeClass = '';
            if ($anItem->Id == $this->ActiveId)
                $activeClass = 'list-group-item-info';
            $html .= '<li onclick="qc.pA(\''.$this->ParentFormId.'\',\''.$this->action_ListItemClicked->getJqControlId().'\', \'QClickEvent\', \''.$anItem->Id.'\')" class="list-group-item '.$activeClass.' DataListItem">';
            $html .= '<div class="row">';
            for ($i=0;$i<sizeof($this->ColumnItems);$i++) {
                $columnText = $this->getColumnItemText($i,$anItem);
                $html .= '<div class="col-sm-'.$this->ColumnWeights[$i].'" style="overflow-x:scroll;">'.$columnText.'</div>';
            }
            $html .= '</div></li>';
        }
        if (count($theList) == 0) {
            $html .= '<li class="list-group-item" style="text-align: center;">No Results</li>';
        }
        $html .= '</ul>';

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
        if ($ArrayIndex > count($this->ColumnItems))
            return ' - ';
        // Default:
        return $TheItem->__get($this->ColumnItems[$ArrayIndex]);
    }

    /**
     *
     */
    public function refreshList() {
        $this->getResultCount();
        if ($this->CurrentSortDirectionDown) {
            $this->btnToggleSortDirection->Text = '<i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>';
        } else
            $this->btnToggleSortDirection->Text = '<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>';
        $this->html->updateControl($this->getDataList());
        $this->addJs();
    }

    /**
     * @param null $queryConditions
     */
    public function setQueryConditions($QueryConditions = null) {
        if ($QueryConditions) {
            $this->CurrentQueryConditions = $QueryConditions;
            $this->InitialQueryConditions = $QueryConditions;
        }
        else {
            $this->CurrentQueryConditions = QQ::All();
            $this->InitialQueryConditions = QQ::All();
        }
        $this->setFiltersInSession();
    }


    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     */
    public function ApplySearchClickChangeAction_Triggered($strFormId, $strControlId, $strParameter) {
        $this->setFiltersInSession();
        $this->refreshList();
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     */
    public function ResetSearchClickAction_Clicked($strFormId, $strControlId, $strParameter) {
        $this->txtSearchBox->Text = '';
        $this->txtSearchBox->Placeholder = $this->SearchBoxText;
        $this->txtSearchBox->Refresh();
        $this->setFiltersInSession();
        $this->refreshList();
    }

    /**
     *
     */
    public function doLoadMore() {
        $this->CurrentItemCount = $this->CurrentItemCount + $this->CurrentItemIncrement;
        $this->setFiltersInSession();
        $this->refreshList();
    }

    /**
     *
     */
    public function toggleSortDirection() {
        $this->CurrentSortDirectionDown = !$this->CurrentSortDirectionDown;
        $this->setFiltersInSession();
        $this->refreshList();
    }

    /**
     * @throws Exception
     * @throws QCallerException
     */
    public function RenderList($blnPrintOutput = true) {
        $this->refreshList();
        $html = '<div class="row mrg-top10">';
        if ($this->ShowSearch)
            $html .= '<div class="col-md-6">'.$this->txtSearchBox->Render(false).'</div>';
        if ($this->ShowSort)
            $html .= '<div class="col-md-3 mrg-bottom5">'.$this->lstSortOptions->Render(false).'</div>
            <div class="col-md-1 mrg-bottom5">'.$this->btnToggleSortDirection->Render(false).'</div>
            <div class="col-md-2 mrg-bottom5" style="padding-top:5px; text-align:center;">'.$this->html_ResultCount->Render(false).'</div>';
        $html .= '</div>';
        $html .= '<div class="row mrg-top10">';
        $html .= '<div class="col-md-12">'.$this->html->Render(false).'</div>';
        $html .= '<div class="col-md-4"></div><div class="col-md-4">'.$this->btnLoadMore->Render(false).'</div><div class="col-md-4"></div>';
        $html .= '</div>';
        if ($blnPrintOutput) {
            echo $html;
            return;
        }
        else
            return $html;
    }

    /**
     * Helper function to allow you to remember the last clicked item. Useful for highlighting rows, etc
     * @param null $id
     */
    public function setActiveId($id = null) {
        $this->ActiveId = $id;
        $this->refreshList();
    }

    /**
     * @return null
     */
    public function getActiveId() {
        return $this->ActiveId;
    }

    /**
     * @return string
     */
    public function getMainElementId() {
        return $this->html->getJqControlId();
    }

    /**
     *
     */
    protected function setFiltersInSession() {
        $_SESSION['lastsearched'.$this->SessionIdentifier] = $this->txtSearchBox->Text;
        $_SESSION['currentitemcount'.$this->SessionIdentifier] = $this->CurrentItemCount;
        $_SESSION['currentsortdirectiondown'.$this->SessionIdentifier] = $this->CurrentSortDirectionDown;
    }

    /**
     *
     */
    protected function getFiltersInSession() {
        if (isset($_SESSION['lastsearched'.$this->SessionIdentifier])) {
            $this->txtSearchBox->Text = $_SESSION['lastsearched'.$this->SessionIdentifier];
            $this->txtSearchBox->Refresh();
            unset($_SESSION['lastsearched'.$this->SessionIdentifier]);
        }
        if (isset($_SESSION['currentitemsperpage'.$this->SessionIdentifier])) {
            $this->CurrentItemCount = $_SESSION['currentitemsperpage'.$this->SessionIdentifier];
            unset($_SESSION['currentitemsperpage'.$this->SessionIdentifier]);
        }
        if (isset($_SESSION['currentsortdirectiondown'.$this->SessionIdentifier])) {
            $this->CurrentSortDirectionDown = $_SESSION['currentsortdirectiondown'.$this->SessionIdentifier];
            unset($_SESSION['currentsortdirectiondown'.$this->SessionIdentifier]);
        }
    }

    /**
     *
     */
    protected function addJs() {
         AppSpecificFunctions::ExecuteJavaScript('$("#'.$this->txtSearchBox->getJqControlId().'").typing({
            start: function (event, $elem) {

            },
            stop: function (event, $elem) {
                //$("#'.$this->html->getJqControlId().'_searchButton").html(\'Searching...\')
                qc.pA(\''.$this->ParentFormId.'\',\''.$this->action_ApplySearchClickedOrChanged->getJqControlId().'\', \'QClickEvent\', $(\'#'.$this->txtSearchBox->getJqControlId().'\').val());
            },
            delay: 800
        });');
    }

}
?>
