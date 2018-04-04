<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
require(__SDEV_CONTROLS__.'/BaseControls/sSummernoteInstance.php');
AppSpecificFunctions::CheckRemoteAdmin();

class WysiwygForm extends QForm {
    protected $sh_Summernote_New;
    protected $btnShow,$btnHide,$btnSave,$btnFitToScreen;

    // Override Form Event Handlers as Needed
    public function Form_Create() {
        parent::Form_Create();
        $this->sh_Summernote_New = new sSummernoteInstance($this,true,'',true);
        $dummyHtml = '<p>This is some example html text to get you started.</p><p>To edit this, simply click on the content and the WYSIWYG editor will magically appear ;)</p><p>Some more example content:</p><ul><li><span style="font-family: Impact;">This is a cool font!</span></li><li><span style="font-family: \'Comic Sans MS\';">This is another cool font!</span></li><li><span style="font-family: \'Comic Sans MS\'; background-color: rgb(57, 123, 33); color: rgb(239, 239, 239);">Something with some more colour...</span></li></ul><p>And look, a table!!! :</p><p><br></p><table class="table table-bordered"><tbody><tr><td><h3><span style="color: rgb(99, 99, 99);">Something here</span></h3></td><td><h3><span style="color: rgb(99, 99, 99);">And here</span></h3></td><td><h3><span style="color: rgb(99, 99, 99);">And here</span></h3></td><td><h3><span style="color: rgb(99, 99, 99);">Wow!</span></h3></td></tr><tr><td><pre>Row 2, cell1</pre></td><td><pre>Row2, cell2</pre></td><td><pre>Row2, cell3</pre></td><td><pre>Row2, cell4</pre></td></tr><tr><td><br></td><td><br></td><td><br></td><td><br></td></tr></tbody></table><p><br></p>';
        $this->sh_Summernote_New->setContent($dummyHtml);
        $this->sh_Summernote_New->hideSummernoteInstance();

        $this->btnSave = new QButton($this);
        $this->btnSave->Text = 'View Text';
        $this->btnSave->AddAction(new QClickEvent(), new QAjaxAction('btnSave_Clicked'));

        $this->btnShow = new QButton($this);
        $this->btnShow->Text = 'Show';
        $this->btnShow->AddAction(new QClickEvent(), new QAjaxAction('btnShow_Clicked'));

        $this->btnHide = new QButton($this);
        $this->btnHide->Text = 'Hide';
        $this->btnHide->AddAction(new QClickEvent(), new QAjaxAction('btnHide_Clicked'));
        $this->btnFitToScreen = AppSpecificFunctions::getNewActionButton($this,'Fit To Screen','btn btn-default','FitToScreen');
    }

    protected function btnSave_Clicked() {
        AppSpecificFunctions::AddCustomLog(urldecode($this->sh_Summernote_New->getContent()));
    }
    protected function btnShow_Clicked() {
        $this->sh_Summernote_New->showSummernoteInstance();
    }
    protected function btnHide_Clicked() {
        $this->sh_Summernote_New->hideSummernoteInstance();
    }
    protected function FitToScreen() {
        $this->sh_Summernote_New->FitToContainer();
    }
}

// Go ahead and run this form object to render the page and its event handlers, implicitly using
// account_edit.tpl.php as the included HTML template file
WysiwygForm::Run('WysiwygForm');
?>