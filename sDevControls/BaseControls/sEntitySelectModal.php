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
class sEntitySelectModal {
    protected $QFormObject;
    protected $EntityType,$SearchAttributes,$DisplayAttributes;
    /**
     * @var sUIElementsBase
     */
    protected $txtSearchInput,$actionDoSearch,$actionDoSelect;
    protected $html_SearchResults;
    protected $ModalSize;

    /**
     * sEntitySelectModal constructor.
     * @param null $objParent
     * @param null $EntityType
     * @param array $SearchAttributes
     * @param array $DisplayAttributes
     * @param string $SearchFunctionCallBack
     * @param string $SelectFunctionCallBack
     * @param string $ModalSize
     */
    public function __construct($objParent = null, $EntityType = null, $SearchAttributes = array(), $DisplayAttributes = array(), $SearchFunctionCallBack = '', $SelectFunctionCallBack = '', $ModalSize = 'modal-sm') {
        $this->QFormObject = $objParent;
        $this->EntityType = $EntityType;
        $this->SearchAttributes = $SearchAttributes;
        $this->DisplayAttributes = $DisplayAttributes;
        $this->ModalSize = $ModalSize;

        $this->actionDoSearch = new sUIElementsBase($this->QFormObject);
        $this->actionDoSearch->AddAction(new QClickEvent(), new QAjaxAction($SearchFunctionCallBack));
        $this->html_SearchResults = new sUIElementsBase($this->QFormObject);
        $this->actionDoSelect = new sUIElementsBase($this->QFormObject);
        $this->actionDoSelect->AddAction(new QClickEvent(), new QAjaxAction($SelectFunctionCallBack));

        $this->txtSearchInput = new QTextBox($this->QFormObject);
        $this->txtSearchInput->RenderAsInputGroup(true,null,'<button class="btn btn-default" onclick="'.AppSpecificFunctions::getPostBackJs($this->QFormObject->FormId,$this->actionDoSearch->getJqControlId()).'" type="button">Go!</button>',true);
        $this->txtSearchInput->Placeholder = 'Search';
        $this->updateSearchResults(true);
    }
    public function ToggleModal() {
        AppSpecificFunctions::ToggleModal(str_replace(' ','',$this->EntityType).'SelectModal');
        $js = '$("#'.str_replace(' ','',$this->EntityType).'SelectModal").css( "zIndex", getHighestZIndex()+1);';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
    public function Render($blnDisplayOutput = true) {
        $html = '<div class="modal fade" id="'.str_replace(' ','',$this->EntityType).'SelectModal" tabindex="-1" role="dialog" aria-labelledby="'.str_replace(' ','',$this->EntityType).'SelectModalLabel">
                      <div class="modal-dialog '.$this->ModalSize.'" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="'.str_replace(' ','',$this->EntityType).'SelectModalLabel">Select '.$this->EntityType.'</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    '.$this->txtSearchInput->Render(false).'
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    '.$this->html_SearchResults->Render(false).'
                                </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>';
        if ($blnDisplayOutput)
            echo $html;
        else
            return $html;
    }
    public function updateSearchResults($reset = false) {
        $SearchInput = $this->txtSearchInput->Text;
        $html = '<div class="table-responsive">
                  <table class="table table-striped">
                    <thead><tr>';
        foreach ($this->DisplayAttributes as $attr) {
            $html .= '<th>'.AppSpecificFunctions::getCamelCaseSplitted($attr).'</th>';
        }
        $html .='</tr></thead>';
        if ($reset) {
            $html .= '<tr><td colspan="'.sizeof($this->DisplayAttributes).'" style="text-align:center;">Start by Searching...</td></tr>';
        } else {
            $resultSet = $this->doSearch($SearchInput);
            foreach ($resultSet as $result) {
                $html .= '<tr onclick="'.AppSpecificFunctions::getPostBackJs($this->QFormObject->FormId,$this->actionDoSelect->getJqControlId(),$result[0]).'">';
                for ($i=1;$i<sizeof($result);$i++) {
                    $html .= '<td>'.$result[$i].'</td>';
                }
                $html .= '</tr>';
            }
            if (sizeof($resultSet) == 0){
                $html .= '<tr><td colspan="'.sizeof($this->DisplayAttributes).'" style="text-align:center;">No results found</td></tr>';
            }
        }
        $html .= '</table>
                </div>';
        $this->html_SearchResults->updateControl($html);
    }
    public function getSelectedId($SelectedId = -1) {
        return $SelectedId;
    }
    protected function doSearch($SearchInput = '') {
        // Default Implementation is to query the database. Can be overridden to call some api...

        $queryConditions = null;
        $Entity = $this->EntityType;
        foreach ($this->SearchAttributes as $attr) {
            if (!$queryConditions)
                $queryConditions = QQ::Like(QQN::$Entity()->$attr,'%'.$SearchInput.'%');
            else
                $queryConditions = QQ::OrCondition($queryConditions,QQ::Like(QQN::$Entity()->$attr,'%'.$SearchInput.'%'));
        }

        $resultList = $Entity::QueryArray($queryConditions);
        $returnArray = array();
        foreach ($resultList as $obj) {
            $objAttrs = array();
            array_push($objAttrs,$obj->Id);
            foreach ($this->DisplayAttributes as $attr) {
                array_push($objAttrs,$obj->$attr);
            }
            array_push($returnArray,$objAttrs);
        }
        return $returnArray;
    }
}
?>