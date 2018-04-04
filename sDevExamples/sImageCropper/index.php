<?php
// Load the sDev Development Framework
require('../../sdev.inc.php');
AppSpecificFunctions::CheckRemoteAdmin();

class UserIndexForm extends QForm {
    protected $testCropper,$testCropperCallback;
    protected $btnGetImage;
    protected $txtImgUrl,$btnSetNewImage,$btnRemoveCropper;
    public function Form_Create() {
        parent::Form_Create();
        $this->testCropper = new sImageCropper($this);
        $this->testCropper->setImage('https://cdn.photographylife.com/wp-content/uploads/2014/06/Nikon-D810-Image-Sample-6.jpg');

        $this->testCropperCallback = new sUIElementsBase($this);
        $this->testCropperCallback->AddAction(new QClickEvent(), new QAjaxAction('testCropperCallback'));

        $this->btnGetImage = new QButton($this);
        $this->btnGetImage->Text = 'Get Image';
        $this->btnGetImage->AddAction(new QClickEvent(), new QAjaxAction('btnGetImage_Clicked'));

        $this->txtImgUrl = new QTextBox($this);
        $this->txtImgUrl->Placeholder = 'Image Url';
        $this->btnSetNewImage = new QButton($this);
        $this->btnSetNewImage->Text = 'Update Image';
        $this->btnSetNewImage->AddAction(new QClickEvent(), new QAjaxAction('btnSetNewImage_Clicked'));

        $this->btnRemoveCropper = new QButton($this);
        $this->btnRemoveCropper->Text = 'Shutdown Cropper';
        $this->btnRemoveCropper->AddAction(new QClickEvent(), new QAjaxAction('btnRemoveCropper_Clicked'));

    }
    protected function btnSetNewImage_Clicked() {
        $this->testCropper->setImage($this->txtImgUrl->Text);
    }
    protected function btnRemoveCropper_Clicked() {
        $this->testCropper->RemoveCropper();
    }
    protected function btnGetImage_Clicked() {
        $this->testCropper->getCroppedImage($this->testCropperCallback->getJqControlId());
    }
    protected function testCropperCallback($strFormId, $strControlId, $strParameter) {
        if (strlen($strParameter) > 0) {
            $js = 'window.open("'.__FILE_UPLOADED_PATH__.$strParameter.'", \'_blank\');';
            //AppSpecificFunctions::DisplayAlert(__FILE_UPLOADED_PATH__.$this->testCropper->getCroppedImage());
            AppSpecificFunctions::ExecuteJavaScript($js);
        } else {
            AppSpecificFunctions::ShowNotedFeedback('Something went wrong... Please try again.',false);
        }
    }
}
UserIndexForm::Run('UserIndexForm');
?>