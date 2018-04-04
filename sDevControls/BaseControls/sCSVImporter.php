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
class sCSVImporter {

    protected $fileUploader,$PreviewHtml,$CSVParseResult,$CSVColumnCount = 0,$CSVRowCount = 0;

    protected $Delimiter,$PreviewRows;

    protected $ImportObj,$lstAttrArray,$lstStartImportAt;

    protected $html_ImportPreview;

    protected $btnImport;
    // The idea here is to create an entity in the data model called "XYZStaging", into which we will import.
    // Then we can use our own logic to take those objects and copy them to the actual objects we want
    /**
     * sCSVImporter constructor.
     * @param $objParentObject
     * @param string $filePrefix
     * @param string $actionName
     * @param string $Delimiter
     * @param string $PreviewRows
     * @param null $importObj
     */
    public function __construct($objParentObject, $filePrefix = 'UploadedFile_', $actionName = 'CSVImport_UploadCompleted', $Delimiter = ',', $PreviewRows = '5',
                                $importObj = null) {
        $this->fileUploader = new sFileUploader($objParentObject,$filePrefix,$actionName);
        $this->Delimiter = $Delimiter;
        $this->PreviewRows = $PreviewRows;
        $this->ImportObj = $importObj;
        if ($this->ImportObj) {
            $dataModel = new DataModel();
            $this->lstAttrArray = array();
            $attrCount = 0;
            if (is_array($dataModel->getObjectAttributes($this->ImportObj))) {
                foreach ($dataModel->getObjectAttributes($this->ImportObj) as $objectAttribute) {
                    $lst = new QListBox($objParentObject);
                    $lst->Name = AppSpecificFunctions::getCamelCaseSplitted($objectAttribute);
                    $lst->CssClass = 'fullWidth';
                    $this->lstAttrArray[$attrCount] = $lst;
                    $attrCount++;
                }
            }
            //Taking this out for now since the intended use will not need this.
            /*if (is_array($dataModel->getObjectSingleRelations($this->ImportObj))) {
                foreach ($dataModel->getObjectSingleRelations($this->ImportObj) as $objectAttribute) {
                    $lst = new QListBox($objParentObject);
                    $lst->Name = $objectAttribute.' Object';
                    $lst->CssClass = 'fullWidth';
                    $this->lstAttrArray[$attrCount] = $lst;
                    $attrCount++;
                }
            }*/
        }
        $this->html_ImportPreview = new sUIElementsBase($objParentObject);
        $this->btnImport = AppSpecificFunctions::getNewActionButton($objParentObject,'Import','btn btn-primary','DoCSVImport');
        $this->lstStartImportAt = new QListBox($objParentObject);
        $this->lstStartImportAt->Name = 'Start At Row';
        $this->lstStartImportAt->DisplayStyle = QDisplayStyle::Block;
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     * @return bool
     */
    public function CSVImport_UploadCompleted($strFormId, $strControlId, $strParameter) {
        $uploadedArray = $this->fileUploader->HandleDocumentUpload($strFormId, $strControlId, $strParameter);
        if (!is_array($uploadedArray))
            return false;
        $theUploadedCSVFile = $uploadedArray[0];
        $Imported = new sCSVImport($theUploadedCSVFile->Path,1000,$this->Delimiter);
        $this->CSVParseResult = $Imported->DoImport();
        $this->PreviewHtml = '<table class="table table-condensed">';
        $PreviewTableHead = '<thead><tr>';
        $this->CSVColumnCount = 0;
        $PreviewTableBody = '<tbody>';

        $ShowMoreInPreview = false;

        if ($this->CSVParseResult) {
            $this->CSVRowCount = sizeof($this->CSVParseResult);
            $rowCount = 0;
            foreach ($this->CSVParseResult as $row) {
                $rowCount++;
                $PreviewTableBody .= '<tr>';
                $colCount = sizeof($row);
                if ($rowCount > ($this->PreviewRows+1)) {
                    $ShowMoreInPreview = true;
                    break;
                }

                for ($i = 0;$i<$colCount;$i++) {
                    $PreviewTableBody .= '<td>'.$row[$i].'</td>';
                    if ($i > $this->CSVColumnCount) {
                        $this->CSVColumnCount = $i;
                    }
                }
                $PreviewTableBody .= '</tr>';
            }
        }
        if ($ShowMoreInPreview) {
            $ItemsLeft = $this->CSVRowCount-$rowCount+2;
            $PreviewTableBody .= '<tr><td colspan="'.$this->CSVColumnCount.'" style="text-align:center;">'.$ItemsLeft.' more rows...</td></tr>';
        }
        $PreviewTableBody .= '</tbody>';
        for ($i=0;$i<=$this->CSVColumnCount;$i++) {
            $columnCountDisplayed = $i+1;
            $PreviewTableHead .= '<th>Column # '.$columnCountDisplayed.'</th>';
        }
        $PreviewTableHead .= '</tr></thead>';

        $this->PreviewHtml .= $PreviewTableHead.$PreviewTableBody.'</table>';

    }

    /**
     * @param bool $printOutput
     */
    public function Render($printOutput = true) {
        $this->fileUploader->renderUploader($printOutput);
        echo '<div id="csv_'.$this->html_ImportPreview->getJqControlId().'" class="row" style="display:none;">';
        $this->html_ImportPreview->Render();
        echo '<div class="col-md-12"><h4 class="page-header">Import Column Mapping</h4>';
        echo '</div>';
        foreach ($this->lstAttrArray as $lst) {
            echo '<div class="col-md-3">'.$lst->RenderWithName(false).'</div>';
        }
        echo '<div class="col-md-12">'.$this->lstStartImportAt->RenderWithName(false).'</div><div class="col-md-12">'.$this->btnImport->Render(false).'</div>';
        echo '</div>';
    }

    /**
     * @return sFileUploader
     */
    public function getPreviewHtml() {
        return $this->PreviewHtml;
    }

    /**
     * @return sFileUploader
     */
    public function getColumnCount() {
        return $this->CSVColumnCount;
    }

    /**
     * @return sFileUploader
     */
    public function getRowCount() {
        return $this->CSVRowCount;
    }

    /**
     * @return sFileUploader
     */
    public function getParseResult() {
        // If you want to handle the import externally
        return $this->CSVParseResult;
    }

    /**
     *
     */
    public function showImportMapping() {
        $this->html_ImportPreview->updateControl($this->PreviewHtml);
        foreach ($this->lstAttrArray as $lst) {
            $lst->RemoveAllItems();
            $lst->AddItem(new QListItem('Do not Import',-1));
            for ($i=0;$i<=$this->CSVColumnCount;$i++) {
                $columnCountDisplayed = $i+1;
                $lst->AddItem(new QListItem('Column #: '.$columnCountDisplayed,$i));
            }
        }
        $this->lstStartImportAt->RemoveAllItems();
        for ($i=0;$i<$this->CSVRowCount;$i++) {
            $columnCountDisplayed = $i+1;
            $this->lstStartImportAt->AddItem(new QListItem('Row #: '.$columnCountDisplayed,$i));
        }
        $js = '$("#csv_'.$this->html_ImportPreview->getJqControlId().'").show();';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     */
    public function DoCSVImport($strFormId, $strControlId, $strParameter) {
        if (!$this->ImportObj){
            AppSpecificFunctions::ShowNotedFeedback('No import object defined',false);
            return;
        }
        $dataModel = new DataModel();
        $importCount = 0;
        for($i=$this->lstStartImportAt->SelectedValue;$i<$this->CSVRowCount;$i++) {
            $obj = new $this->ImportObj();
            $attrCount = 0;
            $hasData = false;
            foreach ($dataModel->getObjectAttributes($this->ImportObj) as $objectAttribute) {
                if ($this->lstAttrArray[$attrCount]->SelectedValue >= 0) {
                    if (($dataModel->getObjectAttributeType($this->ImportObj,$objectAttribute) == 'DATE') ||
                        ($dataModel->getObjectAttributeType($this->ImportObj,$objectAttribute) == 'DATETIME')) {
                        if (array_key_exists($this->lstAttrArray[$attrCount]->SelectedValue,$this->CSVParseResult[$i])) {
                            if (strlen($this->CSVParseResult[$i][$this->lstAttrArray[$attrCount]->SelectedValue]) > 0) {
                                $strVal = '';
                                if (is_numeric($this->CSVParseResult[$i][$this->lstAttrArray[$attrCount]->SelectedValue])) {
                                    $strVal = strval($this->CSVParseResult[$i][$this->lstAttrArray[$attrCount]->SelectedValue]*1);
                                }
                                $obj->$objectAttribute = new QDateTime($strVal);
                                $hasData = true;
                            }
                        }
                    } else {
                        if (array_key_exists($this->lstAttrArray[$attrCount]->SelectedValue,$this->CSVParseResult[$i])) {
                            if (strlen($this->CSVParseResult[$i][$this->lstAttrArray[$attrCount]->SelectedValue]) > 0) {
                                if (is_numeric($this->CSVParseResult[$i][$this->lstAttrArray[$attrCount]->SelectedValue])) {
                                    if ($dataModel->getObjectAttributeType($this->ImportObj,$objectAttribute) == 'INT') {
                                        $obj->$objectAttribute = intval($this->CSVParseResult[$i][$this->lstAttrArray[$attrCount]->SelectedValue]);
                                    } else {
                                        $strVal = strval($this->CSVParseResult[$i][$this->lstAttrArray[$attrCount]->SelectedValue]*1);
                                        $obj->$objectAttribute = $strVal;
                                    }
                                } else {
                                    $obj->$objectAttribute = $this->CSVParseResult[$i][$this->lstAttrArray[$attrCount]->SelectedValue];
                                }
                                $hasData = true;
                            }
                        }
                    }
                }
                $attrCount++;
            }
            try {
                if ($hasData) {
                    $importCount++;
                    $obj->Save();
                }
            } catch (QCallerException $e) {

            }
        }
        return $importCount;
    }
}
?>