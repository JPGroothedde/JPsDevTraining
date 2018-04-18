<?php
require('../../sdev.inc.php');

class AnimationsForm extends QForm {
    protected $btnTest,$html_Result;
    protected $Options;
    public function Form_Create() {
        parent::Form_Create();
        $this->btnTest = AppSpecificFunctions::getNewActionButton($this,'Test','btn btn-lg btn-danger fullWidth mrg-bottom5 rippleclick','handleAction',false,'',false);
        $this->html_Result = new sUIElementsBase($this);
        $this->Options = array('bounce'
            ,'flash'
            ,'pulse'
            ,'rubberBand'
            ,'shake'
            ,'headShake'
            ,'swing'
            ,'tada'
            ,'wobble'
            ,'jello'
            ,'bounceIn'
            ,'bounceInDown'
            ,'bounceInLeft'
            ,'bounceInRight'
            ,'bounceInUp'
            ,'bounceOut'
            ,'bounceOutDown'
            ,'bounceOutLeft'
            ,'bounceOutRight'
            ,'bounceOutUp'
            ,'fadeIn'
            ,'fadeInDown'
            ,'fadeInDownBig'
            ,'fadeInLeft'
            ,'fadeInLeftBig'
            ,'fadeInRight'
            ,'fadeInRightBig'
            ,'fadeInUp'
            ,'fadeInUpBig'
            ,'fadeOut'
            ,'fadeOutDown'
            ,'fadeOutDownBig'
            ,'fadeOutLeft'
            ,'fadeOutLeftBig'
            ,'fadeOutRight'
            ,'fadeOutRightBig'
            ,'fadeOutUp'
            ,'fadeOutUpBig'
            ,'flipInX'
            ,'flipInY'
            ,'flipOutX'
            ,'flipOutY'
            ,'lightSpeedIn'
            ,'lightSpeedOut'
            ,'rotateIn'
            ,'rotateInDownLeft'
            ,'rotateInDownRight'
            ,'rotateInUpLeft'
            ,'rotateInUpRight'
            ,'rotateOut'
            ,'rotateOutDownLeft'
            ,'rotateOutDownRight'
            ,'rotateOutUpLeft'
            ,'rotateOutUpRight'
            ,'hinge'
            ,'rollIn'
            ,'rollOut'
            ,'zoomIn'
            ,'zoomInDown'
            ,'zoomInLeft'
            ,'zoomInRight'
            ,'zoomInUp'
            ,'zoomOut'
            ,'zoomOutDown'
            ,'zoomOutLeft'
            ,'zoomOutRight'
            ,'zoomOutUp'
            ,'slideInDown'
            ,'slideInLeft'
            ,'slideInRight'
            ,'slideInUp'
            ,'slideOutDown'
            ,'slideOutLeft'
            ,'slideOutRight'
            ,'slideOutUp');
    }
    protected function handleAction() {
        $optionCount = sizeof($this->Options);
        $effect = rand(0,$optionCount);
        $js = '$(\'#'.$this->btnTest->getJqControlId().'\').addClass(\'animated '.$this->Options[$effect].'\');
        setTimeout(function(){ $(\'#'.$this->btnTest->getJqControlId().'\').removeClass(\'animated '.$this->Options[$effect].'\'); }, 1000);';
        AppSpecificFunctions::ExecuteJavaScript($js);
        $this->html_Result->updateControl('Effect: '.$this->Options[$effect]);
    }
}
AnimationsForm::Run('AnimationsForm');

?>