<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
require (__DOCROOT__.__SUBDIRECTORY__.'/assets/bootstrap-sass/PHP-SASS-Compiler/scss.inc.php');
use Leafo\ScssPhp\Compiler;
AppSpecificFunctions::CheckRemoteAdmin();
class BootstrapSassForm extends QForm {
    protected $html_CurrentLookAndFeel;
    protected $btnGenerateCss,$btnDone;
    protected $BootstrapVersion = '3.3.6';
    protected $BootstrapTemplate;
    public function Form_Create() {
        parent::Form_Create();
        $this->html_CurrentLookAndFeel = new sUIElementsBase($this);
        $html = '<iframe style="position:fixed;width:90%;margin:auto;height:90%;border:none;" src="'.__SUBDIRECTORY__.'/assets/bootstrap-sass/BootstrapComponents.php"></iframe>';
        $this->html_CurrentLookAndFeel->updateControl($html);
        $this->btnGenerateCss = AppSpecificFunctions::getNewActionButton($this,'Generate CSS','btn btn-primary pull-right rippleclick','GenerateCss');
        $this->btnDone = AppSpecificFunctions::getNewActionButton($this,'Done','btn btn-success rippleclick','btnDone_Clicked');
    }
    protected function GenerateCss($strFormId, $strControlId, $strParameter) {
        $scss = new Compiler();
        $bootstrapSass = file_get_contents(AppSpecificFunctions::getBaseUrl().'/assets/bootstrap-sass/v'.$this->BootstrapVersion.'/assets/stylesheets/_bootstrap.scss');
        $scss->setImportPaths('v'.$this->BootstrapVersion.'/assets/stylesheets/');
        $result =  $scss->compile($bootstrapSass);
        if ($result){
            $generatedFile = fopen('../css/bootstrap.min.css', "w") or die("Unable to open file!");
            fwrite($generatedFile, $result);
            fclose($generatedFile);
            $js = 'location.reload(true);';
            AppSpecificFunctions::ExecuteJavaScript($js);
        } else {
            AppSpecificFunctions::ShowNotedFeedback('Could not generate bootstrap css...',false);
        }
    }
    protected function btnDone_Clicked() {
        AppSpecificFunctions::Redirect(__VIRTUAL_DIRECTORY__ . __DEVTOOLS__.'/start_page.php');
    }
}

BootstrapSassForm::Run('BootstrapSassForm');
?>