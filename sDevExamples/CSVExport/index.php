<?php
require('../../sdev.inc.php');
//AppSpecificFunctions::CheckRemoteAdmin();

class CSVExportForm extends QForm {
    protected $btnExportForDownload,$btnDownloadDirectly;
    protected $tableData;

    // Override Form Event Handlers as Needed
    public function Form_Create() {
        parent::Form_Create();
        $this->tableData = '';
        for ($row=0;$row<=20;$row++) {
            if ($row == 0) {
                $this->tableData .= '<table class="table table-bordered">
                <thead>';
            }
            $this->tableData .= '<tr>';
            for ($col=1;$col<=10;$col++) {
                if ($row == 0) {
                    $this->tableData .= '<th>Heading Col '.$col.'</th>';
                } else {
                    $this->tableData .= '<td>Row '.$row.', Col '.$col.'</td>';
                }
            }
            $this->tableData .= '</tr>';
            if ($row == 0) {
                $this->tableData .= '</thead>';
            }
        }
        $this->tableData .= '</table>';

        $this->btnDownloadDirectly = AppSpecificFunctions::getNewActionButton($this,'Download Direct','btn btn-primary','handleDirectDownloand');
        $this->btnExportForDownload = AppSpecificFunctions::getNewActionButton($this,'Export For Download','btn btn-success','handleExportDownloand');
    }
    protected function handleDirectDownloand() {
        AppSpecificFunctions::ExportToCSV($this->tableData,'ExampleExport');
    }
    protected function handleExportDownloand() {
        $TheFile = AppSpecificFunctions::createCSVFileForDownload($this->tableData,'ExampleExport',',',true,true);
        AppSpecificFunctions::ShowNotedFeedback('Data exported: Click <a target="_blank" href="'.AppSpecificFunctions::getBaseUrl().'/App/Downloads/CSVExportForDownload/'.urlencode($TheFile).'">here</a> to download',true,false);
    }
}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
CSVExportForm::Run('CSVExportForm');
?>