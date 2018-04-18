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
class sImageCropper {
    /**
     * @var
     */
    /**
     * @var sUIElementsBase
     */
    protected $objParentObject,$sh_Html;

    /**
     * @param $objParentObject the parent QForm Object
     */
    public function __construct($objParentObject) {
        $this->objParentObject = $objParentObject;
        $this->sh_Html = new sUIElementsBase($this->objParentObject);
        $this->InitView();
    }

    /**
     *
     */
    protected function InitView() {
        $html = '<script src="'.__VIRTUAL_DIRECTORY__ . __APP_JS_ASSETS__.'/croppie.min.js"></script>';
        $this->sh_Html->updateControl($html);
    }

    /**
     * @param bool|true $blnDisplayOutput
     * @throws Exception
     * @throws QCallerException
     * Simply renders the cropper
     */
    public function RenderCropper($blnDisplayOutput = true) {
        $this->sh_Html->Render($blnDisplayOutput);
    }

    /**
     * Removes the cropper from the screen
     */
    public function RemoveCropper() {
        $js = 'if (window.'.$this->sh_Html->getControlId().'_croppie) {
                    window.'.$this->sh_Html->getControlId().'_croppie.destroy();
                    window.'.$this->sh_Html->getControlId().'_croppie = null;
                    }';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    /**
     * @param string $ImageUrl
     * @param int $width
     * @param int $height
     * @param int $boundarySize_px
     * Call this function to create a new image cropper on screen
     */
    public function setImage($ImageUrl = __APP_IMAGE_ASSETS__.'/image_not_available.jpg',$width = 200,$height = 200,$boundarySize_px = 200) {
        $boundaryW = $width+$boundarySize_px;
        $boundaryH = $height+$boundarySize_px;
        $js = '
        if (!window.'.$this->sh_Html->getControlId().'_croppie) {
            var el = document.getElementById(\''.$this->sh_Html->getControlId().'\');

             window.'.$this->sh_Html->getControlId().'_croppie = new Croppie(el, {
                url: \''.$ImageUrl.'\',
                viewport: { width: '.$width.', height: '.$height.'},
                boundary: { width: '.$boundaryW.', height: '.$boundaryH.' },
            });
        } else {
            window.'.$this->sh_Html->getControlId().'_croppie.destroy();
            var el = document.getElementById(\''.$this->sh_Html->getControlId().'\');

             window.'.$this->sh_Html->getControlId().'_croppie = new Croppie(el, {
                url: \''.$ImageUrl.'\',
                viewport: { width: '.$width.', height: '.$height.'},
                boundary: { width: '.$boundaryW.', height: '.$boundaryH.' },
            });
        }
        ';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

    /**
     * @param string $ParentCallBackFunction_ActionId
     * This function needs an action Id that is uses to do a call back post to the parent form. Check out the example in sDevExamples
     */
    public function getCroppedImage($ParentCallBackFunction_ActionId = '') {
        $securityToken = AppSpecificFunctions::generateRandomString(50);
        $_SESSION['sImageCropperSessionToken'] = $securityToken;
        $_SESSION['sImageCropperSuccess'] = false;
        $DoesNotExist = false;
        while (!$DoesNotExist) {
            $randomFilename = AppSpecificFunctions::generateRandomString(15).'.png';
            if (!file_exists(__DOCROOT__.__FILE_UPLOADED_PATH__.'/'.$randomFilename))
                $DoesNotExist = true;
        }
        $js = 'window.'.$this->sh_Html->getControlId().'_croppie.result(\'canvas\').then(function (src) {
                    $.post( "'.AppSpecificFunctions::getBaseUrl().'/sDevControls/BaseControls/sImageCropper/sImageCropperProcessor.php", { ImgData: src, sImageCropperSessionToken: "'.$securityToken.'" ,file : "'.$randomFilename.'"})
                          .done(function( data ) {
                            console.log( "Image Process Result: " + data );
                            if (data.indexOf("Success") >= 0)
                                qc.pA(\''.$this->objParentObject->FormId.'\',\''.$ParentCallBackFunction_ActionId.'\', \'QClickEvent\', \''.$randomFilename.'\');
                            else
                                qc.pA(\''.$this->objParentObject->FormId.'\',\''.$ParentCallBackFunction_ActionId.'\', \'QClickEvent\', \'\');
                          });

				    //$(\'#'.$this->sh_Html->getControlId().'\').append(\'<img src="\'+src+\'"/>\');
				});';
        AppSpecificFunctions::ExecuteJavaScript($js);
    }

}
?>