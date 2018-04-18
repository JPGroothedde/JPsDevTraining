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
class sChartInstance {
    protected $sh_Html;
    protected $parentFormId;
    protected $chartType,$datasetArray,$datasetAttributeArray;

    protected $chartHeight,$fillColor,$strokeColor,$highlightFill,$highlightStroke,$pointColor,$pointStrokeColor;
    protected $singleDatasetAttributeArray;
    protected $FixedTooltips = false;
    protected $animationSteps;

    protected $jsReferenceVariable = null;

    protected $sh_Actions;

    /**
     * @param null $objParent
     * @param string $chartType
     * @param null $datasetArray
     * @param bool|false $fixedTooltips
     * @param int $height
     * @param int $animationSteps
     * @param string $fillColor
     * @param string $strokeColor
     * @param string $highlightFill
     * @param string $highlightStroke
     * @param string $pointColor
     * @param string $pointStrokeColor
     */
    public function __construct($objParent = null,$chartType = chartType::bar,$datasetArray = null,$fixedTooltips = false,$height = 100,$animationSteps = 30,$fillColor = 'rgba(200, 200, 200,0.8)',
                                $strokeColor = 'rgba(200, 200, 200,0.8)',$highlightFill = 'rgba(0, 0, 0,0.8)',$highlightStroke = 'rgba(0, 0, 0,0.8)',
                                $pointColor = 'rgba(200, 200, 200,0.8)',$pointStrokeColor = 'rgba(200, 200, 200,0.8)') {
        $this->parentFormId = $objParent->FormId;
        $this->chartType = $chartType;
        if ($datasetArray) {
            $this->datasetArray = $datasetArray;
        } else {
            // For demo purposes, we will create some dummy data here
            $this->datasetArray = array();
        }
        $this->createDatasetAttributeArray();
        $this->createSingleDatasetAttributeArray();
        $this->initChart($objParent);
        // Only works for pie, doughnut and polar charts... Breaks the rest
        $this->FixedTooltips = $fixedTooltips;
        $this->animationSteps = $animationSteps;

        $this->chartHeight = $height;
        $this->fillColor = $fillColor;
        $this->strokeColor = $strokeColor;
        $this->highlightFill = $highlightFill;
        $this->highlightStroke = $highlightStroke;
        $this->pointColor = $pointColor;
        $this->pointStrokeColor = $pointStrokeColor;

        $initJs = "$.getScript('".__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__."/Chart.min.js', function()
                    {});";
        AppSpecificFunctions::ExecuteJavaScript($initJs);
    }

    /**
     * @param null $parentFormObj
     */
    protected function initChart($parentFormObj = null) {
        $this->sh_Html = new simpleHTML($parentFormObj);
        $this->sh_Actions = new simpleHTML($parentFormObj);
        $this->sh_Actions->AddAction(new QClickEvent(), new QAjaxAction('ChartAction_Triggered'));
    }

    /**
     * @param null $dataset
     * @param string $fillColor
     * @param string $strokeColor
     * @param string $highlightFill
     * @param string $highlightStroke
     * @param string $pointColor
     * @param string $pointStrokeColor
     */
    public function updateDatasetAttributeArray($dataset = null,$fillColor = 'rgba(200, 200, 200,0.8)',
                                                   $strokeColor = 'rgba(200, 200, 200,0.8)',$highlightFill = 'rgba(0, 0, 0,0.8)',$highlightStroke = 'rgba(0, 0, 0,0.8)',
                                                   $pointColor = 'rgba(200, 200, 200,0.8)',$pointStrokeColor = 'rgba(200, 200, 200,0.8)') {
        if (array_key_exists($dataset,$this->datasetAttributeArray)){
            $this->datasetAttributeArray[$dataset] = array("fillColor" => $fillColor,
                                                            "strokeColor" => $strokeColor,
                                                            "highlightFill" => $highlightFill,
                                                            "highlightStroke" => $highlightStroke,
                                                            "pointColor" => $pointColor,
                                                            "pointStrokeColor" => $pointStrokeColor);
        }

    }

    /**
     *
     */
    protected function createDatasetAttributeArray() {
        $this->datasetAttributeArray = $this->datasetArray;
        foreach ($this->datasetAttributeArray as $datasetAttribute) {
            $datasetAttribute = array("fillColor" => $this->fillColor,
                                        "strokeColor" => $this->strokeColor,
                                        "highlightFill" => $this->highlightFill,
                                        "highlightStroke" => $this->highlightStroke,
                                        "pointColor" => $this->pointColor,
                                        "pointStrokeColor" => $this->pointStrokeColor);
        }
    }

    /**
     *
     */
    protected function createSingleDatasetAttributeArray() {
        $this->singleDatasetAttributeArray = array();
        foreach ($this->datasetArray as $dataset) {
            foreach ($dataset as $label=>$value) {
                array_push($this->singleDatasetAttributeArray, array("value" => $value,
                                                                        "label" => $label,
                                                                        "fillColor" => '#'.$this->random_color(),
                                                                        "highlightFill" => '#'.$this->random_color()));
            }
        }
    }

    /**
     * @param null $index
     * @param string $fillColor
     * @param string $highlightFill
     */
    public function updateSingleDatasetAttributeArray($index = null,$fillColor = 'rgba(200, 200, 200,0.8)', $highlightFill = 'rgba(0, 0, 0,0.8)') {
        if (isset($this->singleDatasetAttributeArray[$index])){
            $this->singleDatasetAttributeArray[$index]["fillColor"]= $fillColor;
            $this->singleDatasetAttributeArray[$index]["highlightFill"]= $highlightFill;
        }

    }
    /**
     *
     */
    public function updateChart() {
        $html = '<canvas id="'.$this->sh_Html->getJqControlId().'_chart-area" style="width:100%;" height="'.$this->chartHeight.'"/>';
        $this->sh_Html->updateControl($html);
        $this->doChartJs();
    }
    public function getControlId() {
        return $this->sh_Html->getJqControlId().'_chart-area';
    }

    /**
     *
     */
    public function RenderChart($blnPrintOutput = true) {
        return $this->sh_Html->Render($blnPrintOutput);
    }

    /**
     * @param null $dataset
     */
    public function addDataset($dataset = null) {
        if (is_array($dataset)) {
            array_push($this->datasetArray,$dataset);
        }
    }

    /**
     *
     */
    public function clearData() {
        $this->datasetArray = array();
    }

    /**
     * @param null $dataSetArray
     */
    public function setData($dataSetArray = null) {
        if ($dataSetArray) {
            $this->datasetArray = $dataSetArray;
            $this->createDatasetAttributeArray();
            $this->createSingleDatasetAttributeArray();
        }
    }

    /**
     * @return string
     */
    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    /**
     * @return string
     */
    function random_color() {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    /**
     *
     */
    protected function doChartJs() {
        if (sizeof($this->datasetArray) > 0) {
            switch($this->chartType) {
                case chartType::bar:
                    $this->doBarJs();
                    break;
                case chartType::line:
                    $this->doLineJs();
                    break;
                case chartType::radar:
                    $this->doRadarJs();
                    break;
                case chartType::pie:
                    $this->doPieJs();
                    break;
                case chartType::polarArea:
                    $this->doPolarJs();
                    break;
                case chartType::doughnut:
                    $this->doDoughnutJs();
                    break;
                default:
                    $this->doBarJs();
                    break;
            }
        }
    }

    /**
     *
     */
    protected function doBarJs() {
        $js = 'var barChartData = {
                labels : [';
        $count = 0;
        $dataString = '';
        $firstSet = true;
        foreach ($this->datasetArray as $dataset) {
            if ($firstSet) {
                foreach ($dataset as $label=>$value) {
                    if ($count == 0) {
                        $js .= '"'.$label.'"';
                    }
                    else {
                        $js .= ',"'.$label.'"';
                    }
                    $count++;
                }
            }
            $firstSet = false;
        }
        $js .='],';
        $js .= 'datasets : [';
        $dataSets = array_keys($this->datasetArray);
        $dataSetCount = 0;
        foreach ($this->datasetArray as $dataset) {
            $count = 0;
            $dataString = '';
            foreach ($dataset as $label=>$value) {
                if ($count == 0) {
                    $dataString .= $value;
                }
                else {
                    $dataString .= ','.$value;
                }
                $count++;
            }
            $js .= '    {
                        ';

            $dataSetLabel = '';
            if (isset($dataSets[$dataSetCount])) {
                $dataSetLabel = $dataSets[$dataSetCount];
                $js .= 'label: "'.$dataSetLabel.'",';
                $attributeArray = array();
                if (isset($this->datasetAttributeArray[$dataSetLabel]))
                    $attributeArray = $this->datasetAttributeArray[$dataSetLabel];
                foreach ($attributeArray as $label=>$value) {
                    $js .= $label.': "'.$value.'",';
                }
            }

            $js .= '
                        data : ['.$dataString.']
                    },';
            $dataSetCount++;
        }


        $js .= ']

            }
                var ctx = document.getElementById("'.$this->sh_Html->getJqControlId().'_chart-area").getContext("2d");
                window.myBar_'.$this->sh_Html->getJqControlId().' = new Chart(ctx).Bar(barChartData, {
                    '.$this->getChartOptions().'
                });';
        $this->jsReferenceVariable = 'window.myBar_'.$this->sh_Html->getJqControlId().'';
        QApplication::ExecuteJavaScript($js);
    }

    /**
     *
     */
    protected function doLineJs() {
        $js = 'var lineChartData = {
                labels : [';
        $count = 0;
        $dataString = '';
        $firstSet = true;
        foreach ($this->datasetArray as $dataset) {
            if ($firstSet) {
                foreach ($dataset as $label=>$value) {
                    if ($count == 0) {
                        $js .= '"'.$label.'"';
                    }
                    else {
                        $js .= ',"'.$label.'"';
                    }
                    $count++;
                }
            }
            $firstSet = false;
        }
        $js .='],';
        $js .= 'datasets : [';
        $dataSets = array_keys($this->datasetArray);
        $dataSetCount = 0;
        foreach ($this->datasetArray as $dataset) {
            $count = 0;
            $dataString = '';
            foreach ($dataset as $label=>$value) {
                if ($count == 0) {
                    $dataString .= $value;
                }
                else {
                    $dataString .= ','.$value;
                }
                $count++;
            }
            $js .= '    {
                        ';

            $dataSetLabel = '';
            if (isset($dataSets[$dataSetCount])) {
                $dataSetLabel = $dataSets[$dataSetCount];
                $js .= 'label: "'.$dataSetLabel.'",';
                $attributeArray = array();
                if (isset($this->datasetAttributeArray[$dataSetLabel]))
                    $attributeArray = $this->datasetAttributeArray[$dataSetLabel];
                foreach ($attributeArray as $label=>$value) {
                    $js .= $label.': "'.$value.'",';
                }
            }

            $js .= '
                        data : ['.$dataString.']
                    },';
            $dataSetCount++;
        }


        $js .= ']

            }
            var ctx = document.getElementById("'.$this->sh_Html->getJqControlId().'_chart-area").getContext("2d");
            window.myLine_'.$this->sh_Html->getJqControlId().' = new Chart(ctx).Line(lineChartData, {
                '.$this->getChartOptions().'
            });';
        $this->jsReferenceVariable = 'window.myLine_'.$this->sh_Html->getJqControlId().'';
        QApplication::ExecuteJavaScript($js);
    }

    /**
     *
     */
    protected function doRadarJs() {
        $js = 'var radarChartData = {
                labels : [';
        $count = 0;
        $dataString = '';
        $firstSet = true;
        foreach ($this->datasetArray as $dataset) {
            if ($firstSet) {
                foreach ($dataset as $label=>$value) {
                    if ($count == 0) {
                        $js .= '"'.$label.'"';
                    }
                    else {
                        $js .= ',"'.$label.'"';
                    }
                    $count++;
                }
            }
            $firstSet = false;
        }
        $js .='],';
        $js .= 'datasets : [';
        $dataSets = array_keys($this->datasetArray);
        $dataSetCount = 0;
        foreach ($this->datasetArray as $dataset) {
            $count = 0;
            $dataString = '';
            foreach ($dataset as $label=>$value) {
                if ($count == 0) {
                    $dataString .= $value;
                }
                else {
                    $dataString .= ','.$value;
                }
                $count++;
            }
            $js .= '    {
                        ';

            $dataSetLabel = '';
            if (isset($dataSets[$dataSetCount])) {
                $dataSetLabel = $dataSets[$dataSetCount];
                $js .= 'label: "'.$dataSetLabel.'",';
                $attributeArray = array();
                if (isset($this->datasetAttributeArray[$dataSetLabel]))
                    $attributeArray = $this->datasetAttributeArray[$dataSetLabel];
                foreach ($attributeArray as $label=>$value) {
                    $js .= $label.': "'.$value.'",';
                }
            }

            $js .= '
                        data : ['.$dataString.']
                    },';
            $dataSetCount++;
        }


        $js .= ']

            }
            var ctx = document.getElementById("'.$this->sh_Html->getJqControlId().'_chart-area").getContext("2d");
                window.myRadar_'.$this->sh_Html->getJqControlId().' = new Chart(ctx).Radar(radarChartData, {
                    '.$this->getChartOptions().'
                });';
        $this->jsReferenceVariable = 'window.myRadar_'.$this->sh_Html->getJqControlId().'';
        QApplication::ExecuteJavaScript($js,QJsPriority::High);
    }

    /**
     *
     */
    protected function doPieJs() {
        $js = 'var pieData = [';
        foreach ($this->singleDatasetAttributeArray as $attrArray) {
            $js .= '
				{
					value: '.$attrArray["value"].',
					color:"'.$attrArray["fillColor"].'",
					highlight: "'.$attrArray["highlightFill"].'",
					label: "'.$attrArray["label"].'"
				},';

        }
        $js .= '];

                var ctx = document.getElementById("'.$this->sh_Html->getJqControlId().'_chart-area").getContext("2d");
                window.myPie = new Chart(ctx).Pie(pieData, {
                    '.$this->getChartOptions().'
                });';
        QApplication::ExecuteJavaScript($js);
    }

    /**
     *
     */
    protected function doPolarJs() {
        $js = 'var polarData = [';
        foreach ($this->singleDatasetAttributeArray as $attrArray) {
            $js .= '
				{
					value: '.$attrArray["value"].',
					color:"'.$attrArray["fillColor"].'",
					highlight: "'.$attrArray["highlightFill"].'",
					label: "'.$attrArray["label"].'"
				},';

        }
        $js .= '];

                var ctx = document.getElementById("'.$this->sh_Html->getJqControlId().'_chart-area").getContext("2d");
                window.myPolar_'.$this->sh_Html->getJqControlId().' = new Chart(ctx).PolarArea(polarData, {
                    '.$this->getChartOptions().'
                });';
        $this->jsReferenceVariable = 'window.myPolar_'.$this->sh_Html->getJqControlId().'';
        QApplication::ExecuteJavaScript($js);
    }

    /**
     *
     */
    protected function doDoughnutJs() {
        $js = 'var doughnutData = [';
        foreach ($this->singleDatasetAttributeArray as $attrArray) {
            $js .= '
				{
					value: '.$attrArray["value"].',
					color:"'.$attrArray["fillColor"].'",
					highlight: "'.$attrArray["highlightFill"].'",
					label: "'.$attrArray["label"].'"
				},';

        }
        $js .= '];

                var ctx = document.getElementById("'.$this->sh_Html->getJqControlId().'_chart-area").getContext("2d");
                window.myDoughnut_'.$this->sh_Html->getJqControlId().' = new Chart(ctx).Doughnut(doughnutData, {
                    '.$this->getChartOptions().'
                });';
        $this->jsReferenceVariable = 'window.myDoughnut_'.$this->sh_Html->getJqControlId().'';
        QApplication::ExecuteJavaScript($js);
    }

    /**
     * @return string
     */
    protected function getChartOptions() {
        $js = 'responsive : true,';
        if ($this->FixedTooltips) {
            $js .= 'onAnimationComplete: function()
                        {
                            this.showTooltip(this.segments, true);

                            //Show tooltips in bar chart (issue: multiple datasets doesnt work http://jsfiddle.net/5gyfykka/14/)
                            //this.showTooltip(this.datasets[0].bars, true);

                            //Show tooltips in line chart (issue: multiple datasets doesnt work http://jsfiddle.net/5gyfykka/14/)
                            //this.showTooltip(this.datasets[0].points, true);
                            removeAjaxOverlay();
                        },

                        tooltipEvents: [],

                        showTooltips: true,
                        animationSteps: '.$this->animationSteps.',
                        animationEasing: "easeInExpo",';
        } else {
            $js .= 'onAnimationComplete: function() {
                            removeAjaxOverlay();
                        },
                        animationSteps: '.$this->animationSteps.',
                        animationEasing: "easeInExpo",';
        }

        return $js;
    }

    /**
     * @param $strFormId
     * @param $strControlId
     * @param $strParameter
     */
    public function ChartAction_Triggered($strFormId, $strControlId, $strParameter) {
        // To be implemented in the calling class
    }

    /**
     *
     */
    public function toBase64Image() {
        // Send the image as base64 to the ChartAction_Triggered function
        $js = 'var imgUrl = '.$this->jsReferenceVariable.'.toBase64Image();
                qc.pA(\''.$this->parentFormId.'\',\''.$this->sh_Actions->getJqControlId().'\', \'QClickEvent\', imgUrl, \'\');';
        QApplication::ExecuteJavaScript($js);
    }

}
abstract class chartType {
    const bar = 'bar';
    const line = 'line';
    const radar = 'radar';
    const polarArea = 'polarArea';
    const pie = 'pie';
    const doughnut = 'doughnut';
}
?>