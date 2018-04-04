<?php
require_once('../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();

class ErrorLogsForm extends QForm {
    protected $btnClearCustomLogs,$btnClearSystemLogs;
    public function Form_Create() {
        parent::Form_Create();
        $html = '';
        $dir = new DirectoryIterator((__INCLUDES__.'/error_log/'));
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                if ($fileinfo->getFilename() != 'index.html')
                    $html .= '<a href="'.AppSpecificFunctions::getBaseUrl().'/includes/error_log/'.$fileinfo->getFilename().'" target=blank>'.$fileinfo->getFilename().' </a><br>';
            }
        }
        $js = '$("#ViewLogsSystemLogs").html(\''.$html.'\')';
        AppSpecificFunctions::ExecuteJavaScript($js);

        $this->btnClearCustomLogs = AppSpecificFunctions::getNewActionButton($this,'Clear Custom Logs','btn btn-danger fullWidth mrg-top10 rippleclick','handleClearCustomLogs');
        $this->btnClearSystemLogs = AppSpecificFunctions::getNewActionButton($this,'Clear System Logs','btn btn-warning fullWidth mrg-top10 rippleclick','handleClearSystemLogs');
    }
    protected function handleClearCustomLogs() {
        file_put_contents(__DOCROOT__.__PHP_ASSETS__.'/DeveloperMode/CustomLog.txt','');
        AppSpecificFunctions::ShowNotedFeedback('Custom logs cleared!');
        $js = '$("#ViewLogsCustomLogs").html(\'\')';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
    protected function handleClearSystemLogs() {
        $dir = new DirectoryIterator((__INCLUDES__.'/error_log/'));
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                if ($fileinfo->getFilename() != 'index.html') {
                    unlink($fileinfo->getPath().'/'.$fileinfo->getFilename());
                }
            }
        }
        AppSpecificFunctions::ShowNotedFeedback('Custom logs cleared!');
        $html = '';
        $dir = new DirectoryIterator((__INCLUDES__.'/error_log/'));
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                if ($fileinfo->getFilename() != 'index.html')
                    $html .= '<a href="'.AppSpecificFunctions::getBaseUrl().'/includes/error_log/'.$fileinfo->getFilename().'" target=blank>'.$fileinfo->getFilename().' </a><br>';
            }
        }
        $js = '$("#ViewLogsSystemLogs").html(\''.$html.'\')';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }
}
ErrorLogsForm::Run('ErrorLogsForm');

?>