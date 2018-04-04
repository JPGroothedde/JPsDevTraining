<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();


class ChartExampleForm extends QForm {
    protected $btnSayHi;

    protected $chartInstance_1,$chartInstance_2,$chartInstance_3,$chartInstance_4,$chartInstance_5,$chartInstance_6;
    protected $sh_CustomLegend_Chart2;
    // Override Form Event Handlers as Needed
    public function Form_Create() {
        parent::Form_Create();
        $this->btnSayHi = new QButton($this);
        $this->btnSayHi->Text = 'Show graphs';
        $this->btnSayHi->AddAction(new QClickEvent(), new QAjaxAction('btnSayHi_Clicked',null,null,null,null,true));

        $this->chartInstance_1 = new sChartInstance($this,chartType::doughnut,null,true,100,100);
        $this->chartInstance_1->updateChart();

        $this->chartInstance_2 = new sChartInstance($this,chartType::bar);
        $this->chartInstance_2->updateChart();

        $this->sh_CustomLegend_Chart2 = new simpleHTML($this);

        $this->chartInstance_3 = new sChartInstance($this,chartType::line,null,false,100,30);
        $this->chartInstance_3->updateChart();

        $this->chartInstance_4 = new sChartInstance($this,chartType::pie);
        $this->chartInstance_4->updateChart();

        $this->chartInstance_5 = new sChartInstance($this,chartType::radar);
        $this->chartInstance_5->updateChart();

        $this->chartInstance_6 = new sChartInstance($this,chartType::polarArea);
        $this->chartInstance_6->updateChart();
    }

    protected function btnSayHi_Clicked($strFormId, $strControlId, $strParameter) {
        QApplication::HideProgressModal();
        $newDataSetArray = array("DataSet1" => array("label1" => rand(0,100),
            "label2" => rand(0,100),
            "label3" => rand(0,100),
            "label4" => rand(0,100)));
        $this->chartInstance_1->clearData();
        $this->chartInstance_1->setData($newDataSetArray);
        $this->chartInstance_1->updateSingleDatasetAttributeArray(0,'#000000');
        $this->chartInstance_1->updateChart();

        $newDataSetArray = array("DataSet1" => array("label1" => rand(0,100),
            "label2" => rand(0,100),
            "label3" => rand(0,100),
            "label4" => rand(0,100),
            "label5" => rand(0,100),
            "label6" => rand(0,100),
            "label7" => rand(0,100),
            "label8" => rand(0,100),
            "label9" => rand(0,100)),
            "DataSet2" => array("label1" => rand(0,100),
                "label2" => rand(0,100),
                "label3" => rand(0,100),
                "label4" => rand(0,100),
                "label5" => rand(0,100),
                "label6" => rand(0,100),
                "label7" => rand(0,100),
                "label8" => rand(0,100),
                "label9" => rand(0,100)),
            "DataSet3" => array("label1" => rand(0,100),
                "label2" => rand(0,100),
                "label3" => rand(0,100),
                "label4" => rand(0,100),
                "label5" => rand(0,100),
                "label6" => rand(0,100),
                "label7" => rand(0,100),
                "label8" => rand(0,100),
                "label9" => rand(0,100)));
        $this->chartInstance_2->clearData();
        $this->chartInstance_2->setData($newDataSetArray);
        $this->chartInstance_2->updateDatasetAttributeArray("DataSet1",'rgba(10, 100, 0,0.8)',
            'rgba(100, 100, 200,0.8)','rgba(10, 100, 0,0.9)','rgba(150, 0, 0,0.8)'/*,
            $pointColor = 'rgba(200, 200, 200,0.8)',$pointStrokeColor = 'rgba(200, 200, 200,0.8)'*/);
        $this->chartInstance_2->updateDatasetAttributeArray("DataSet2",'rgba(100, 100, 0,0.8)',
            'rgba(100, 120, 100,0.8)','rgba(100, 100, 0,0.9)','rgba(110, 10, 0,0.8)'/*,
            $pointColor = 'rgba(200, 200, 200,0.8)',$pointStrokeColor = 'rgba(200, 200, 200,0.8)'*/);
        $this->chartInstance_2->updateDatasetAttributeArray("DataSet3",'rgba(60, 60, 60,0.8)',
            'rgba(105, 10, 200,0.8)','rgba(60, 60, 60,0.9)','rgba(150, 80, 0,0.8)'/*,
            $pointColor = 'rgba(200, 200, 200,0.8)',$pointStrokeColor = 'rgba(200, 200, 200,0.8)'*/);
        $this->chartInstance_2->updateChart();

        $html = '<h4>Legend</h4>
                    <ul>
                        <li><p style="background-color: rgba(10, 100, 0,0.8); color:#ffffff;">DataSet1</p></li>
                        <li><p style="background-color: rgba(100, 100, 0,0.8); color:#ffffff;"> DataSet2</p></li>
                        <li><p style="background-color: rgba(60, 60, 60,0.8); color:#ffffff;"> DataSet3</p></li>
                    </ul>';
        $this->sh_CustomLegend_Chart2->updateControl($html);

        $toAdd = array();
        for ($i = 0;$i<50;$i++) {
            $toAdd["label".$i] = rand(0,100);
        }
        $newDataSetArray = array("DataSet1" => $toAdd);
        $this->chartInstance_3->clearData();
        $this->chartInstance_3->setData($newDataSetArray);
        $this->chartInstance_3->updateChart();

        $newDataSetArray = array("DataSet1" => array("label1" => rand(0,100),
            "label2" => rand(0,100),
            "label3" => rand(0,100),
            "label4" => rand(0,100)));
        $this->chartInstance_4->clearData();
        $this->chartInstance_4->setData($newDataSetArray);
        $this->chartInstance_4->updateSingleDatasetAttributeArray(0,'#FF3A3A');
        $this->chartInstance_4->updateSingleDatasetAttributeArray(1,'#3C67FF');
        $this->chartInstance_4->updateSingleDatasetAttributeArray(2,'#feD5fe');
        $this->chartInstance_4->updateSingleDatasetAttributeArray(3,'#fefeD5');
        $this->chartInstance_4->updateChart();



        $newDataSetArray = array("DataSet1" => array("label1" => rand(0,100),
            "label2" => rand(0,100),
            "label3" => rand(0,100),
            "label4" => rand(0,100),
            "label5" => rand(0,100),
            "label6" => rand(0,100),
            "label7" => rand(0,100),
            "label8" => rand(0,100),
            "label9" => rand(0,100)),
            "DataSet2" => array("label1" => rand(0,100),
                "label2" => rand(0,100),
                "label3" => rand(0,100),
                "label4" => rand(0,100),
                "label5" => rand(0,100),
                "label6" => rand(0,100),
                "label7" => rand(0,100),
                "label8" => rand(0,100),
                "label9" => rand(0,100)),
            "DataSet3" => array("label1" => rand(0,100),
                "label2" => rand(0,100),
                "label3" => rand(0,100),
                "label4" => rand(0,100),
                "label5" => rand(0,100),
                "label6" => rand(0,100),
                "label7" => rand(0,100),
                "label8" => rand(0,100),
                "label9" => rand(0,100)));
        $this->chartInstance_5->clearData();
        $this->chartInstance_5->setData($newDataSetArray);
        $this->chartInstance_5->updateDatasetAttributeArray("DataSet1",'rgba(10, 100, 0,0.8)',
            'rgba(100, 100, 200,0.8)','rgba(10, 100, 0,0.9)','rgba(150, 0, 0,0.8)'/*,
            $pointColor = 'rgba(200, 200, 200,0.8)',$pointStrokeColor = 'rgba(200, 200, 200,0.8)'*/);
        $this->chartInstance_5->updateDatasetAttributeArray("DataSet2",'rgba(100, 100, 0,0.8)',
            'rgba(100, 120, 100,0.8)','rgba(100, 100, 0,0.9)','rgba(110, 10, 0,0.8)'/*,
            $pointColor = 'rgba(200, 200, 200,0.8)',$pointStrokeColor = 'rgba(200, 200, 200,0.8)'*/);
        $this->chartInstance_5->updateDatasetAttributeArray("DataSet3",'rgba(60, 60, 60,0.8)',
            'rgba(105, 10, 200,0.8)','rgba(60, 60, 60,0.9)','rgba(150, 80, 0,0.8)'/*,
            $pointColor = 'rgba(200, 200, 200,0.8)',$pointStrokeColor = 'rgba(200, 200, 200,0.8)'*/);
        $this->chartInstance_5->updateChart();

        $newDataSetArray = array("DataSet1" => array("label1" => rand(0,100),
            "label2" => rand(0,100),
            "label3" => rand(0,100),
            "label4" => rand(0,100)));
        $this->chartInstance_6->clearData();
        $this->chartInstance_6->setData($newDataSetArray);
        $this->chartInstance_6->updateSingleDatasetAttributeArray(8,'#000000');
        $this->chartInstance_6->updateChart();
    }
    public function ChartAction_Triggered($strFormId, $strControlId, $strParameter) {
        // To be implemented in the calling class
        QApplication::DisplayAlert($strParameter);
    }
}
ChartExampleForm::Run('ChartExampleForm');
?>

