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
class sUIElementsCheckableControlGroup extends sUIElementsBase {
    /**
     * @var int
     */
    protected $ControlCount = 0;
    /**
     * @var array
     */
    protected $CheckableControlArray = array();
    /**
     * @var string
     */
    protected $CheckableControlHtml = '';
    /**
     * @var array|bool|int|mixed|null|QControl|QForm|string
     */
    protected $PostBackFormId;
    protected $ParentForm;

    /**
     * sUIElementsCheckableControlGroup constructor.
     * @param QControl|QControlBase|QForm $objParentObject
     * @param null $strControlId
     */
    public function __construct($objParentObject, $strControlId = null) {
        parent::__construct($objParentObject, $strControlId);
        $this->SetRenderWithoutSpan();
        $this->PostBackFormId = $objParentObject->FormId;
        $this->ParentForm = $objParentObject;
    }
    /**
     * his function will execute a post action to the action defined by $strActionId. This action must be defined in the parent form. Its only function is to call updateCurrentControlGroup() with the data received.
     * @param null $strActionId
     * @return null
     */
    public function setCurrentControlGroup($strActionId = null) {
        if (!$strActionId)
            return null;
        $js = 'qc.pA(\''.$this->PostBackFormId.'\',\''.$strActionId.'\', \'QClickEvent\', getCheckableControlArray_Json());';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    /**
     * This function updates the actual values for each checkable control to enable the script to return them when requested via getCheckedControls() or getAllControls()
     * @param $jsonString
     */
    public function updateCurrentControlGroup($jsonString) {
        $returnedArray = json_decode($jsonString);
        $this->CheckableControlArray = array();
        foreach ($returnedArray as $checkable) {
            $checked = false;
            if ($checkable->checked == 1)
                $checked = true;
            $CheckableControl = array("objId" => $checkable->objId, "checked" => $checkable->checked);
            array_push($this->CheckableControlArray,$CheckableControl);
        }

    }

    /**
     * @return array
     */
    public function getCheckedControls() {
        $returnArray = array();
        foreach ($this->CheckableControlArray as $array) {
            if ($array["checked"]) {
                if (!in_array($array["objId"],$returnArray))
                    array_push($returnArray,$array["objId"]);
            }
        }
        return $returnArray;
    }

    /**
     * @return array
     */
    public function getAllControls() {
        return $this->CheckableControlArray;
    }

    /**
     * @param string $Label
     * @param bool $checked
     * @param string $objId
     */
    public function addCheckableControl($Label = 'Label', $checked = false, $objId = '-1') {
        $this->ControlCount++;
        $CheckableControl = array("JQ_ID" => $this->getJqControlId()."_checkable_".$this->ControlCount,"Label" => $Label,"ObjId" => $objId);
        $css = 'label-default';
        if ($checked)
            $css = 'label-success';
        $this->CheckableControlHtml .= '<span id="'.$CheckableControl['JQ_ID'].'" class="CheckableControl label '.$css.'">'.$CheckableControl['Label'].'</span>';
        $this->updateControl($this->CheckableControlHtml);
        $this->addControlJs($CheckableControl['JQ_ID'],$checked,$CheckableControl['ObjId']);

    }
    public function Render($blnDisplayOutput = true){
        $html = parent::Render($blnDisplayOutput);
        $this->activateCheckableControls();
        return $html;
    }

    public function activateCheckableControls() {
        $js = 'RegisterCheckableControls();';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    /**
     * @param string $jqId
     * @param bool $checked
     * @param string $objId
     */
    protected function addControlJs($jqId = '-1', $checked = false, $objId = '-1') {
        $checkedString = 'false';
        if ($checked)
            $checkedString = 'true';
        $js = 'CheckableControlArray["'.$jqId.'"] = {objId : '.$objId.', checked : '.$checkedString.'};';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
?>